<?php

/**
 * working_groups actions.
 *
 * @package    practil_scorecard
 * @subpackage working_groups
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class working_groupsActions extends sfActions
{

public function executeIndex(sfWebRequest $request)
{
    
}

public function executeListado(sfWebRequest $request){

    $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    if($user!=null){
        $criterio_busqueda = new Criteria();
        $criterio_busqueda->add(GrupoTrabajoScPeer::OWNER_ID,$user->getId());
        $criterio_busqueda->add(GrupoTrabajoScPeer::FLAG,1);
        $listado = GrupoTrabajoScPeer::doSelect($criterio_busqueda);
        $this->list = $listado;
    }else{
        return sfView::ERROR;
    }
    
}

public function executeList_contact_group(sfWebRequest $request){
    
    $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    if($user!=null){
        $id_group = $request->getParameter('group');
        $criterio_detalle = new Criteria();
        $criterio_detalle->add(DetalleGrupoTrabajoScPeer::GRUPO_ID,$id_group);
        $lista = DetalleGrupoTrabajoScPeer::doSelect($criterio_detalle);
        $this->list = $lista;
        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }

}

public function executeSolicitudes(sfWebRequest $request){
    $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    if($user!=null){
        $criterio_busqueda = new Criteria();
        $criterio_busqueda->add(SolicitudGrupoTrabajoScPeer::EMAIL,'%'.$user->getEmail().'%',Criteria::LIKE);
        $criterio_busqueda->add(SolicitudGrupoTrabajoScPeer::RESPONDIDO,0);
        $list_solicitudes  = SolicitudGrupoTrabajoScPeer::doSelect($criterio_busqueda);
        $this->list = $list_solicitudes;
    }else{
        return sfView::ERROR;
    }
}


public function executeAccept_group(sfWebRequest $request){
    
   $invitacion_id   =  $request->getParameter('invitacion');
   $token_seguridad =  $request->getParameter('token');
   $email_token     =  $request->getParameter('email');
   $user_token      =  $request->getParameter('account');

  
   /*vamos a aceptar permanecer a un grupo
     aca realizo validacion en 5 capas
        1 reviso que la session de usuario exista
        2 que la el valor obtenido en la consulta sea un object(que la consulta sql resulte con el registro solicitado)
        3 el token de la solicitud sea correcto
        4 el email sea correcto
        5 que el usuario id sea correcto (este es id del usuario que envio la solicitud en md5)
    */
   $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    if($user!=null){
        $solicitud = SolicitudGrupoTrabajoScPeer::retrieveByPK($invitacion_id);
        if(is_object($solicitud)){
            if($token_seguridad==$solicitud->getToken()){
                if($email_token ==md5($user->getEmail()) ){
                    if($user_token== md5($solicitud->getUserId())){
                        $solicitud->setRespondido(1);
                        $solicitud->setFlag(json_encode(array("estado" => false,"respuesta" => true)));
                        $solicitud->setUpdateAt(time());
                        $solicitud->save();
                     
                        //falta cambiar los indicadores que esten relacionados al grupo
                          /*vamos a obtener todos los arboles que esten relacionados con el grupo
                          depues vamos a obtener todos los indicadores donde el usuario se encuentre
                          asignado y vamos a aumetar el ID en cada registro que encontremos*/
                        //admemas vamos hacer lo mismo en las asignaciones para tener un mejor indexacion
                        //a la hora de hacer las consultas.

                        $criterio_tree = new Criteria();
                        $criterio_tree->add(TreeScPeer::GRUPO_TRABAJO_ID,$solicitud->getGrupoId());
                        $list_tree = TreeScPeer::doSelect($criterio_tree);
                        foreach($list_tree as $row):
                            $con = Propel::getConnection();
                            $criterio_busqueda = new Criteria();
                            $criterio_busqueda->add(IndicatorsScPeer::EMAIL_RESPONSABLE,'%'.$solicitud->getEmail().'%',Criteria::LIKE);
                            $criterio_busqueda->add(IndicatorsScPeer::TREE_ID,$row->getId());
                            $criterio_update = new Criteria();
                            $criterio_update->add(IndicatorsScPeer::RESPONSABLE_ID,$user->getId());
                            BasePeer::doUpdate($criterio_busqueda, $criterio_update, $con);                            
                            $con = Propel::close();
                        endforeach;

                        $con = Propel::getConnection();
                        $criterio_asignaciones = new Criteria();
                        $criterio_asignaciones->add(AsignacionScPeer::GRUPO_ID,$solicitud->getGrupoId());
                        $criterio_asignaciones->add(AsignacionScPeer::EMAIL,'%'.$user->getEmail().'%',Criteria::LIKE);
                        $criterio_update = new Criteria();
                        $criterio_update->add(AsignacionScPeer::USER_ID,$user->getId());                       
                        BasePeer::doUpdate($criterio_asignaciones, $criterio_update, $con);
                        $con = Propel::close();
                        
                        $grupo_trabajo = new DetalleGrupoTrabajoSc();
                        $grupo_trabajo->setEmail($user->getEmail());
                        $grupo_trabajo->setUserId($user->getId());
                        $grupo_trabajo->setGrupoId($solicitud->getGrupoId());
                        $grupo_trabajo->save();
                        
                        $this->redirect('@list_working_groups');
                    }else{
                        return sfView::ERROR;
                    }
                }else{
                    return sfView::ERROR;
                }
            }else{
                return sfView::ERROR;
            }
        }else{
            return sfView::ERROR;
        }
    }else{
        return sfView::ERROR;
    }
}


public function executeSearch_contact(sfWebRequest $request)
{
    //la busqueda se realizara por el email o por el nombre
    //por ahora solo x el email
   
    $name_or_email = $request->getParameter('data');
    $group_id = $request->getParameter('workGroup');
    $current_user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'), null);
    //reviso si la session existe
    if($current_user!=null){
         $criterio_user = new Criteria();
         $criterio_user->add(DetalleGrupoTrabajoScPeer::EMAIL,'%'.$name_or_email.'%',Criteria::LIKE);
         $criterio_user->add(GrupoTrabajoScPeer::OWNER_ID,$current_user->getId());
         $criterio_user->add(GrupoTrabajoScPeer::ID,$group_id);
         $criterio_user->addJoin(DetalleGrupoTrabajoScPeer::GRUPO_ID,GrupoTrabajoScPeer::ID);
         $list_results = DetalleGrupoTrabajoScPeer::doSelect($criterio_user);
         $this->results = $list_results;
         return sfView::SUCCESS;    
    }else{
        return sfView::ERROR;
    }   

    
  }



}
