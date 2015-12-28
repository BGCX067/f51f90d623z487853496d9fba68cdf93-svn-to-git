<?php
/**
 * edit_strategy actions.
 *
 * @package    practil_scorecard
 * @subpackage edit_strategy
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class edit_strategyActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeStrategy(sfWebRequest $request)
  {

    $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    $id_tree  = $request->getParameter('id_tree');
    if($user!=null){
        $criterio = new Criteria();
        $criterio->add(TreeScPeer::USER_ID,$user->getId());
        $criterio->add(TreeScPeer::ID,$id_tree);
        $criterio->add(TreeScPeer::FLAG,1);
        $tree = TreeScPeer::doSelectOne($criterio);
        $criterio->clear();
        if(is_object($tree)){
            $criterio->add(IndicatorsScPeer::TREE_ID,$tree->getId());
            $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
            $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
            $list_indicadores = IndicatorsScPeer::doSelect($criterio);
            $criterio->clear();
            $criterio->add(GrupoTrabajoScPeer::OWNER_ID,$user->getId());
            $list_grupos = GrupoTrabajoScPeer::doSelect($criterio);
            $criterio->clear();
            $criterio->add(PeriodoScPeer::FLAG,'%activo%',Criteria::LIKE);
            $list_periodo = PeriodoScPeer::doSelect($criterio);
            $this->lista_indicadores = $list_indicadores;
            $this->lista_grupos = $list_grupos;
            $this->lista_periodos = $list_periodo;
            $this->tree = $tree;
            
        }else{
            return sfView::ERROR;
        }
        
        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }

  }

  //interior del div
  public function executeConfigure(sfWebRequest $request){
      
  }

   //aca vamos a crear el metodo para que devuelva los del indicador soliciado por ID
   // lo vamos a devolver los datos en fomato JSON para que sean llenados en el html x javascrip
   //si no existe el indicador devolveremos a la vista ERROR
  public function executeIndicator(sfWebRequest $request){
      $request->setRequestFormat('json');
      $id_indicador  = $request->getParameter('indicator');
      $indicadorBean = IndicatorsScPeer::retrieveByPK($id_indicador);
      if(is_object($indicadorBean)){
           //por aqui tambien deveria validar si el usuario tiene permisos para editar este nodo
           //por si se me escapa en el la vista cliente...(pendiente)
            $this->indicador= $indicadorBean;
            
            return sfView::SUCCESS;;
      }else{
          return sfView::ERROR;
          $this->message = 'indicador no encontrado';
      }
      
  }

public function executeReturn_nodes_childrens(sfWebRequest $request){

            //aca retorno lista de indicadores inferiores
            //primero valido si tiene conectores inferiores
            $indicador_padre_id = $request->getParameter('indicatorPk');            
     
            //si tiene concetores inferiores envio la lista de conectores inferiores
            //en la consuta solo necesito id-configuracion(valor asignado por padre)-titulo
            $criterio_busqueda = new Criteria();
         /*0*/   $criterio_busqueda->addSelectColumn(IndicatorsScPeer::ID);
         /*1*/   $criterio_busqueda->addSelectColumn(IndicatorsScPeer::CONECTORES_CONFIGURE);
         /*2*/   $criterio_busqueda->addSelectColumn(IndicatorsScPeer::TITULO);
            $criterio_busqueda->add(IndicatorsScPeer::PREVIOUS_ID,$indicador_padre_id);
            $criterio_busqueda->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
            $lista_indicadores_hijos = IndicatorsScPeer::doSelectStmt($criterio_busqueda);
            $this->count = IndicatorsScPeer::doCount($criterio_busqueda);
            $this->list = $lista_indicadores_hijos;
    
}


public function executeSave_indicator(sfWebRequest $request)
{
      $request->setRequestFormat('json');
      $indicadorId        =  $request->getParameter('indicatorId');
      $titulo             =  $request->getParameter('title');
      $descripcion        =  $request->getParameter('description');
      $valor_minimo       =  $request->getParameter('valueMin');
      $valor_deseado      =  $request->getParameter('valueDes');
      $valor_optimo       =  $request->getParameter('valueOpt');
      $responsable_id     =  $request->getParameter('responsableId');
      $responsable_email  =  $request->getParameter('responsableEmail');
      $grupo_trabajo_id   = $request->getParameter('workGroup');
      $json_children      = $request->getParameter('indicatorChildren');


      $json = json_decode($json_children);
      if(count($json)>0){
            foreach($json as $row){
             $indicador_children = IndicatorsScPeer::retrieveByPK($row->{'pk'});
             $indicador_children->setConectoresConfigure($row->{'values'});
             $indicador_children->save();
           }
      }

      //primero validamos y esta logeado
      //segundo validamos si el idicador existe
      //tercero verificamos si se asigno un usuario
          //(si se le asigno un usuario)cuarto vamos a revisar si el usuario que es asignado esta en e grupo de trabajo
          /*si no esta en grupo de trabajo envio una solictud ( antes verifico si no le mande una solicitud antes)
           * por que no se va estar mandando varias solicitudes al mismo usuario
           * en este caso las solicitudes son 1 vez por grupo de trabajo y no por indicador
           */
      //despues de vefiricar grabamos la primera vesion del indicador con los datos secundarios

  
      
      $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
      if($user!=null){
          $indicador = IndicatorsScPeer::retrieveByPK($indicadorId);
          if(is_object($indicador)){

       
              if($responsable_email!=""){
                  
               /* aca vamos crear el registro de asignaciones, esta tabla me permite manejar un
                historial  de las asignacion de resposanble x indicador
                asi podre ver todas los responsables de un determinado indicador.*/
                $asignacion_indicador = new AsignacionSc();
                $asignacion_indicador->setGrupoId($grupo_trabajo_id);
                $asignacion_indicador->setEmail($responsable_email);
                $asignacion_indicador->setTreeId($indicador->getTreeId());
                $asignacion_indicador->setIndicadorId($indicador->getId());               
                $asignacion_indicador->setCreateAt(time());
                $asignacion_indicador->setUpdateAt(time());

              /**********************************************************************/
                

                    if($responsable_id!=""){
                        $asignacion_indicador->setFlag(json_encode(array("estado" => true,"owner_id" => $user->getId())));
                        $asignacion_indicador->setUserId($responsable_id);
                        $indicador->setResponsableId($responsable_id);
                        $indicador->setEmailResponsable($responsable_email);
                    }else{
                        //envio solicitud
                            //antes verificar si no le enviando una solicitud antes
                      $rsp =  $this->evaluar_solicitud($responsable_email, $grupo_trabajo_id, $user);
                     
                      if($rsp['success']){ 
                          $indicador->setEmailResponsable($responsable_email);
                          $indicador->setResponsableId(null);
                          $asignacion_indicador->setFlag(json_encode(array("estado" => false,"owner_id" => $user->getId())));
                     }else{
                          $this->message = $rsp['message'];
                          return sfView::ERROR;
                      }
                    }

                      $asignacion_indicador->save();   
              }else{
                   $indicador->setResponsableId(null);
                   $indicador->setEmailResponsable('');
              }

                       
              if($descripcion!=""){
                  $indicador->setDescripcion($descripcion);
              }
              if($valor_minimo!=""){
                  $indicador->setValorMinimo($valor_minimo);
              }
              if($valor_deseado!=""){
                  $indicador->setValorDeseado($valor_deseado);
              }
              if($valor_optimo!=""){
                  $indicador->setValorOptimo($valor_optimo);
              }
              if($titulo!=""){
                  $indicador->setTitulo($titulo);
              }
             
              $indicador->save();
              
          }else{
              $this->message = 'not found indicator';
              return sfView::ERROR;
          }
      }else{
          $this->message = 'session expired';
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



}
