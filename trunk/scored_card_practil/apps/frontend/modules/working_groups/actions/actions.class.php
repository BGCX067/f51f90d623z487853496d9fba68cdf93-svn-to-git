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
     
    $user   = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
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

public function executeNew_group(sfWebRequest $request){

    $request->setRequestFormat('json');
    $name_group = $request->getParameter('name');
    $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($user != null){
        $grupoBean = new GrupoTrabajoSc();
        $grupoBean->setName($name_group);
        $grupoBean->setOwnerId($user->getId());
        $grupoBean->setFlag(1);
        $grupoBean->setCreateAt(time());
        $grupoBean->setUpdateAt(time());
        $grupoBean->setHumanFlag(1);
        $grupoBean->setHumanHigher('off');
        $grupoBean->setHumanLower('on');
        $grupoBean->setHumanMe('off');
        $grupoBean->save();

        $newDetalle = new DetalleGrupoTrabajoSc();
        $newDetalle->setEmail($user->getEmail());
        $newDetalle->setUserId($user->getId());
        $newDetalle->setGrupoId($grupoBean->getId());



        $newDetalle->save();

        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }
    
}


public function executeNew_group_cbo(sfWebRequest $request){


    $name_group = $request->getParameter('name');
    $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($user != null){
        $grupoBean = new GrupoTrabajoSc();
        $grupoBean->setName($name_group);
        $grupoBean->setOwnerId($user->getId());
        $grupoBean->setFlag(1);
        $grupoBean->setCreateAt(time());
        $grupoBean->setUpdateAt(time());
        $grupoBean->setHumanFlag(1);
        $grupoBean->setHumanHigher('off');
        $grupoBean->setHumanLower('on');
        $grupoBean->setHumanMe('off');
        $grupoBean->save();

        $newDetalle = new DetalleGrupoTrabajoSc();
        $newDetalle->setEmail($user->getEmail());
        $newDetalle->setUserId($user->getId());
        $newDetalle->setGrupoId($grupoBean->getId());
        
        $newDetalle->save();

        $criterio_busqueda = new Criteria();
        $criterio_busqueda->add(GrupoTrabajoScPeer::OWNER_ID,$user->getId());
        $criterio_busqueda->add(GrupoTrabajoScPeer::FLAG,1);
        $listado = GrupoTrabajoScPeer::doSelect($criterio_busqueda);
        $this->list = $listado;

        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }

}



public function executeNew_contact_group(sfWebRequest $request){

    $request->setRequestFormat('json');
    
    $id_group = $request->getParameter('groupId');
    $email    = $request->getParameter('email');
    $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    
    if($user!=null){
         $rsp =  $this->evaluar_solicitud($email, $id_group, $user);
            if($rsp['success']){
                $criterio = new Criteria();
                $criterio->add(DetalleGrupoTrabajoScPeer::EMAIL,$email);
                $criterio->add(DetalleGrupoTrabajoScPeer::GRUPO_ID,$id_group);
                $cantidad =  DetalleGrupoTrabajoScPeer::doCount($criterio);
                if($cantidad<=0){
                    $newDetalle = new DetalleGrupoTrabajoSc();
                    $newDetalle->setEmail($email);
                    $newDetalle->setGrupoId($id_group);

                    //si ya esta en otro de mis grupos grupo
                       // autocritica...si ya esta en otro grupo no interesa
                       // se le tiene que mandar otra solicitud!
                   /* $criteria_b = new Criteria();
                    $criteria_b->add(DetalleGrupoTrabajoScPeer::EMAIL,$email);
                    $criteria_b->add(GrupoTrabajoScPeer::OWNER_ID,$user->getId());
                    $criteria_b->addJoin(GrupoTrabajoScPeer::ID, DetalleGrupoTrabajoScPeer::GRUPO_ID);
                    $count =  DetalleGrupoTrabajoScPeer::doCount($criteria_b);
                    
                    if($count>0){
                       $obj = DetalleGrupoTrabajoScPeer::doSelectOne($criteria_b);
                       if($obj->getUserId()!=null){
                         $newDetalle->setUserId($obj->getUserId());
                       }
                    }*/

                    $newDetalle->save();
                    return sfView::SUCCESS;
                }else{
                    $this->message = 'cantidad';
                    return sfView::ERROR;
                }
            }else{
                $this->message = '$rsp->false';
                return sfView::ERROR;
            }
    }else{
         $this->message = 'session';
         return sfView::ERROR;
    }
   

}



private function evaluar_solicitud($email,$grupo,$userBean){
    //solo puede enviar otra solicitud a la misma persona si
                //-es otra solicitud de otro grupo
                //-si el flag es 2 == Solicitud vencida
    $criterio_solicitud = new Criteria();
    $criterio_solicitud->add(SolicitudGrupoTrabajoScPeer::GRUPO_ID,$grupo);
    $criterio_solicitud->add(SolicitudGrupoTrabajoScPeer::EMAIL,'%'.$email.'%',Criteria::LIKE);
    //FLAG,'1' == activa
    $criterio_solicitud->add(SolicitudGrupoTrabajoScPeer::FLAG,'%estado":true%',Criteria::LIKE);
    $cantidad_registros = SolicitudGrupoTrabajoScPeer::doCount($criterio_solicitud);

   try{
       $con = Propel::getConnection();

       $con->beginTransaction();
        if($cantidad_registros>0){
            //no le envio solicitud
            $obj = array("success"=>true,"message"=>"no le envio solicitud");
            $con = Propel::close();
            return $obj;
        }else{
            $solicitudBean = new SolicitudGrupoTrabajoSc();
            $solicitudBean->setGrupoId($grupo);
            $solicitudBean->setEmail($email);
            $solicitudBean->setCreateAt(time());
            $solicitudBean->setUpdateAt(time());
            $solicitudBean->setUserId($userBean->getId());
            //formar el token
            $token = md5($grupo.$email.rand($userBean->getId(),1000));
            $solicitudBean->setToken($token);
            $solicitudBean->setFlag(json_encode(array("estado" => true,"respuesta" => false)));
            $solicitudBean->setRespondido(0);
            $solicitudBean->save();
           try{
               $message = $this->getMailer()->compose();
               $message->setSubject('Te invintaron a unirte a practil-scoredcard');
               $message->setTo($email);
               $message->setFrom(array('cquevedo@esfera.pe' => 'Practil'));
               $html = $this->getPartial('send_email/send_invitation_group', array(
                  'uri'=>sfConfig::get('app_url_scorecard').'confirmation/confirmation_group?token='.$token.'&email='.$email.'&group_id='.$grupo
               ));
               $message->setBody($html, 'text/html');
               $this->getMailer()->send($message);
               $con->commit();
               $con = Propel::close();
               $obj = array("success"=>true,"message"=>"le envie solicitud");
               return $obj;
           }catch (Exception $e){
                $con->rollBack();
                $con = Propel::close();
                $obj = array("success"=>false,"message"=>$e->getMessage());
                return $obj;
           }

        }

    }catch (Exception $e){
        $con->rollBack();
        $con = Propel::close();
        $obj = array("success"=>false,"message"=>"se general");
        return $obj;
    }

}


public function executeList_contact_group(sfWebRequest $request){    
    $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    $grupo_id = $request->getParameter('groupId');
    if($user!=null){
        $criterio = new Criteria();
        $criterio->add(DetalleGrupoTrabajoScPeer::GRUPO_ID,$grupo_id);
        $list = DetalleGrupoTrabajoScPeer::doSelect($criterio);
        $this->lista = $list;
        $this->lista_detalle = $list;

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
                        
                        $criterio_detalle = new Criteria();
                        $criterio_detalle->add(DetalleGrupoTrabajoScPeer::GRUPO_ID,$solicitud->getGrupoId());
                        $criterio_detalle->add(DetalleGrupoTrabajoScPeer::EMAIL,'%'.$user->getEmail().'%',Criteria::LIKE);
                        
                        $bean_detalle = DetalleGrupoTrabajoScPeer::doSelectOne($criterio_detalle);
                        $bean_detalle->setUserId($user->getId());
                        $bean_detalle->save();                     
                        
                        $this->redirect('@list_working_groups');
                    }else{
                        print_r('user token');
                        return sfView::ERROR;
                    }
                
            }else{
                 print_r('$token_seguridad');
                return sfView::ERROR;
            }
        }else{
            print_r('solicitud objet');

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

  public function executeSave_bost_group(sfWebRequest $request){

    $request->setRequestFormat('json');
    $user       = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    $bost_id   = $request->getParameter('bostId');
    $rowId  = $request->getParameter('rowId');

    if($user!=null){
        $row = DetalleGrupoTrabajoScPeer::retrieveByPK($rowId);
        if(is_object($row)){
            if($bost_id=="none"){
                $row->setBostId(0);
            }else{
                $row->setBostId($bost_id);
            }
                $row->save();
           return sfView::SUCCESS;
        }else{
            return sfView::ERROR;
        }
    }else{
        return sfView::ERROR;
    }
      
  }



}
