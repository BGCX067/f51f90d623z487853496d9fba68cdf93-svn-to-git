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
    $node_id  = $request->getParameter('node_id');
    $response = $request->getParameter('response');
    $from     = $request->getParameter('from');
    
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
            $this->network_attributes = DetNetworkAttributePeer::doSelect(new Criteria());
            $this->networks = NetworkPeer::doSelect(new Criteria());
            $this->response = $response;
            $this->from = $from;
            $this->node_id = $node_id;  
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
            $network_id = "";
            $attribute_id = "";
            if(is_object($indicadorBean->getDetNetworkAttribute())){
                $network_id = $indicadorBean->getDetNetworkAttribute()->getNetwork()->getName();
            }
            if(is_object($indicadorBean->getDetNetworkAttribute())){
                $attribute_id= $indicadorBean->getDetNetworkAttribute()->getAttributeId();
            }
            $this->network_id = $network_id;
            $this->attribute_id = $attribute_id;
            $this->det_network_attribute_id = $indicadorBean->getDetNetworkAttributeId();
            $array_xml = array();
            $c = new Criteria();
            $c->add(IndicadoresScGoogleAnalyticsPeer::INDICADOR_ID, $indicadorBean->getId());
            $something = IndicadoresScGoogleAnalyticsPeer::doSelectOne($c);
            if(is_object($something)){
                $this->is_connected_google_analytics = '1';
                $access_token = $this->useRefreshToken($indicadorBean->getId());
                if($access_token!=null){
                    $postdata = http_build_query(
                        array(
                            'start-index' => '1',
                            'max-results' => '50',
                            'v' => '2',
                            'prettyprint' => 'true',
                            'access_token' => $access_token
                        )
                    );
                    $xml_string=@file_get_contents("https://www.google.com/analytics/feeds/accounts/default"."?".$postdata);
                    if($xml_string === FALSE){
                        $this->message = 'Oops, algo se ha roto.';
                        return sfView::ERROR;
                    }else{
                        $xml = simplexml_load_string($xml_string);
                        foreach($xml->entry as $entry){
                            $row = $entry->xpath("dxp:tableId");
                            array_push($array_xml, '<option value='.$row[0].'>'.$entry->title.'</option>');
                        }
                    }
                    $this->array_xml = $array_xml;
                }else{
                    $this->is_connected_google_analytics = '0';
                    $this->array_xml = $array_xml;
                    $this->message = 'El permiso para acceder ha sido revocado';
                    return sfView::SUCCESS;
                }
            }else{
                $this->is_connected_google_analytics = '0';
                $this->array_xml = $array_xml;
            }
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
      $grupo_trabajo_id   =  $request->getParameter('workGroup');
      $conector_id        =  $request->getParameter('conectorId');/* Google, Facebook, Twitter */
      $attribute_id       =  $request->getParameter('attributeId');
      $tableId            =  $request->getParameter('tableId');
      $facebook_username  =  $request->getParameter('facebook_username');
      $twitter_username   =  $request->getParameter('twitter_username');
      $fec_ini            =  $request->getParameter('fec_ini');
      $fec_fin            =  $request->getParameter('fec_fin');
      $json_children      =  $request->getParameter('indicatorChildren');
      $oaux_manejo_data   =  $request->getParameter('oaux_manejo_data');
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
              if($responsable_email!="")
              {
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
                    if($responsable_id!="")
                    {

                        /*
                         *
                         */
                        if($responsable_id!=$indicador->getResponsableId())
                        {
                            $serviceDataIndicadores = new dataIndicadoresImplementation();
                            $serviceDataIndicadores->changeOwnerIndicadores($indicador,$responsable_id);
                        }
                        /******************************************/

                        $asignacion_indicador->setFlag(json_encode(array("estado" => true,"owner_id" => $user->getId())));
                        $asignacion_indicador->setUserId($responsable_id);
                        $indicador->setResponsableId($responsable_id);
                        $indicador->setEmailResponsable($responsable_email);
                        
                    }
                    else
                    {
                            //envio solicitud
                                //antes verificar si no le enviando una solicitud antes
                          $rsp =  $this->evaluar_solicitud($responsable_email, $grupo_trabajo_id, $user);
                          if($rsp['success'])
                          {
                               $criterio = new Criteria();
                               $criterio->add(DetalleGrupoTrabajoScPeer::EMAIL,'%'.$responsable_email.'%',Criteria::LIKE);
                               $criterio->add(DetalleGrupoTrabajoScPeer::GRUPO_ID,$grupo_trabajo_id);
                               $cantidad =  DetalleGrupoTrabajoScPeer::doCount($criterio);
                                if($cantidad<=0){
                                    $newDetalle = new DetalleGrupoTrabajoSc();
                                    $newDetalle->setEmail($responsable_email);
                                    $newDetalle->setGrupoId($grupo_trabajo_id);
                                    $newDetalle->save();
                                }
                              $indicador->setEmailResponsable($responsable_email);
                              $indicador->setResponsableId(null);
                              $asignacion_indicador->setFlag(json_encode(array("estado" => false,"owner_id" => $user->getId())));
                         }
                         else
                         {
                              $this->message = $rsp['message'];
                              return sfView::ERROR;
                         }
                    }
                      $asignacion_indicador->save();   
              }
              else
              {
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
              if($oaux_manejo_data=='1'){
                  /* ingreso manual */
                  $indicador->setDetNetworkAttributeId(null);
                  $indicador->setUsernameInNetwork(null);
                  $indicador->setValorActualEntregado(0);
                  $indicador->setGaFecIni(null);
                  $indicador->setGaFecFin(null);
              }elseif($oaux_manejo_data=='2'){
                  /* ingreso automatico */
                  if($conector_id!='' && $attribute_id!=''){
                      $c = new Criteria();
                      $c->add(NetworkPeer::NAME, $conector_id);
                      $c->add(DetNetworkAttributePeer::ATTRIBUTE_ID, $attribute_id);
                      $c->addJoin(NetworkPeer::ID, DetNetworkAttributePeer::NETWORK_ID);
                      $det_network_attribute = DetNetworkAttributePeer::doSelectOne($c);
                      if($conector_id=='Facebook'){
                          if($facebook_username!=''){
                              $indicador->setDetNetworkAttributeId($det_network_attribute->getId());
                              $indicador->setUsernameInNetwork($facebook_username);
                              /* se extrae valor de la consulta */
                              $data = $this->privateFunctionGetFacebookData($facebook_username, $det_network_attribute->getId());
                              if($data!=null){
                                  $indicador->setValorActualEntregado($data);
                              }else{
                                  $indicador->setValorActualEntregado(0);
                              }
                          }else{
                              $indicador->setDetNetworkAttributeId(null);
                              $indicador->setUsernameInNetwork(null);
                              $indicador->setValorActualEntregado(0);
                              $indicador->setGaFecIni(null);
                              $indicador->setGaFecFin(null);
                          }
                      }elseif($conector_id=='Twitter'){
                          if($twitter_username!=''){
                              $indicador->setDetNetworkAttributeId($det_network_attribute->getId());
                              $indicador->setUsernameInNetwork($twitter_username);
                              /* se extrae valor de la consulta */
                              $data = $this->privateFunctionGetTwitterData($twitter_username, $det_network_attribute->getId());
                              $indicador->setValorActualEntregado($data);
                          }else{
                              $indicador->setDetNetworkAttributeId(null);
                              $indicador->setUsernameInNetwork(null);
                              $indicador->setValorActualEntregado(0);
                              $indicador->setGaFecIni(null);
                              $indicador->setGaFecFin(null);
                          }
                      }elseif($conector_id=='Google Analytics'){
                          if($tableId!='' && $tableId!='null'){
                              $indicador->setDetNetworkAttributeId($det_network_attribute->getId());
                              $indicador->setUsernameInNetwork($tableId);
                              /* se extrae valor de la consulta */
                              $data = $this->privateFunctionGetGoogleAnalyticsData($indicador->getId(), $tableId, $fec_ini, $fec_fin, $det_network_attribute->getId());
                              $indicador->setGaFecIni($fec_ini);
                              $indicador->setGaFecFin($fec_fin);
                              $indicador->setValorActualEntregado($data);
                          }else{
                              if(is_object($det_network_attribute) ){
                                   $indicador->setDetNetworkAttributeId($det_network_attribute->getId());
                              }else{
                                   $indicador->setDetNetworkAttributeId(null);
                              }                             
                              $indicador->setUsernameInNetwork(null);
                              $indicador->setValorActualEntregado(0);
                              $indicador->setGaFecIni(null);
                              $indicador->setGaFecFin(null);
                          }
                      }
                  }else{
                      $indicador->setDetNetworkAttributeId(null);
                      $indicador->setUsernameInNetwork(null);
                      $indicador->setValorActualEntregado(0);
                      $indicador->setGaFecIni(null);
                      $indicador->setGaFecFin(null);
                  }
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
    public function executeGetFollowers(sfWebRequest $request){
        $screen_name = $request->getParameter('twitter_screen_name');
        $twitter_attr_id = $request->getParameter('twitter_attr_id');
        $atributo = DetNetworkAttributePeer::retrieveByPK($twitter_attr_id);
        $keyword = $atributo->getAttribute()->getKeyWord();
        $resp = "";
        $xml_string=@file_get_contents("http://api.twitter.com/1/users/show.xml?screen_name=".$screen_name);
        if($xml_string === FALSE){
            $resp = "El usuario ingresado es inválido";
        }else{
            $xml = simplexml_load_string($xml_string);
            if(isset($xml->$keyword)){
                if($xml->$keyword!=''){
                    $resp = $xml->$keyword;
                }else{
                    $resp = "El valor es vacío";
                }
            }else{
                $resp = "El dato que está solicitando no está disponible para este usuario";
            }
        }
        echo $resp;
        return sfView::NONE;
    }
    private function privateFunctionGetTwitterData($screen_name, $twitter_attr_id){
        $atributo = DetNetworkAttributePeer::retrieveByPK($twitter_attr_id);
        $keyword = $atributo->getAttribute()->getKeyWord();
        $xml_string=@file_get_contents("http://api.twitter.com/1/users/show.xml?screen_name=".$screen_name);
        if($xml_string === FALSE){
            $resp = 0;
        }else{
            $xml = simplexml_load_string($xml_string);
            $resp = 0;
            if(isset($xml->$keyword)){
                if($xml->$keyword!=''){
                        $resp = $xml->$keyword;
                    }else{
                        $resp = 0;
                    }
            }else{
                $resp = 0;
            }
        }
        return $resp;
    }
    public function executeGetLikes(sfWebRequest $request){
        $facebook_username = $request->getParameter('facebook_username');
        $facebook_attr_id = $request->getParameter('facebook_attr_id');
        $atributo = DetNetworkAttributePeer::retrieveByPK($facebook_attr_id);
        $keyword = $atributo->getAttribute()->getKeyWord();
        $json_string=@file_get_contents("http://graph.facebook.com/".$facebook_username."/");
        if($json_string === FALSE){
            $resp = "El usuario ingresado es inválido";
        }else{
            $json = json_decode($json_string);
            $resp = "";
            if(isset($json->{$keyword})){
                if($json->{$keyword}!=''){
                    $resp = $json->{$keyword};
                }else{
                    $resp = "El valor es vacío";
                }
            }else{
                $resp = "El dato que está solicitando no está disponible para este usuario";
            }
        }
        echo $resp;
        return sfView::NONE;
    }
    private function privateFunctionGetFacebookData($facebook_username, $facebook_attr_id){
        $atributo = DetNetworkAttributePeer::retrieveByPK($facebook_attr_id);
        $keyword = $atributo->getAttribute()->getKeyWord();
        $json_string=@file_get_contents("http://graph.facebook.com/".$facebook_username."/");
        if($json_string === FALSE){
            $resp = 0;
        }else{
            $json = json_decode($json_string);
            $resp = 0;
            if(isset($json->{$keyword})){
                if($json->{$keyword}!=''){
                    $resp = $json->{$keyword};
                }else{
                    $resp = 0;
                }
            }else{
                $resp = 0;
            }
        }
        return $resp;
    }
    public function executeGetGoogleAnalyticsData(sfWebRequest $request){
        $hdIndicadorId = $request->getParameter('hdIndicadorId');
        $tableId = $request->getParameter('tableId');
        $fec_ini = $request->getParameter('google_analytics_fec_ini');
        $fec_fin = $request->getParameter('google_analytics_fec_fin');
        $attr_id = $request->getParameter('google_analytics_attr_id');
        $access_token = $this->useRefreshToken($hdIndicadorId);
        $atributo = DetNetworkAttributePeer::retrieveByPK($attr_id);
        $keyword = $atributo->getAttribute()->getKeyWord();
        $postdata = http_build_query(
            array(
                'ids' => $tableId,
                'metrics' => $keyword,
                'start-date' => $fec_ini,
                'end-date' => $fec_fin,
                'max-results' => '1',
                'access_token' => $access_token
            )
        );
        $xml_string=@file_get_contents("https://www.google.com/analytics/feeds/data"."?".$postdata);
        if($xml_string === FALSE){
            echo 'Oops, algo se ha roto.';
        }else{
            $xml = simplexml_load_string($xml_string);
            if(isset($xml->entry)){
                $metrics = $xml->entry->xpath("dxp:metric");
                if($metrics[0]['value']!=''){
                    echo $metrics[0]['value'];
                }else{
                    echo 'El valor es vacío';
                }
            }else{
                echo 'El dato que está solicitando no está disponible para este usuario';
            }
        }
        return sfView::NONE;
    }
    private function privateFunctionGetGoogleAnalyticsData($hdIndicadorId, $tableId, $fec_ini, $fec_fin, $attr_id){
        $access_token = $this->useRefreshToken($hdIndicadorId);
        $atributo = DetNetworkAttributePeer::retrieveByPK($attr_id);
        $keyword = $atributo->getAttribute()->getKeyWord();
        $postdata = http_build_query(
            array(
                'ids' => $tableId,
                'metrics' => $keyword,
                'start-date' => $fec_ini,
                'end-date' => $fec_fin,
                'max-results' => '1',
                'access_token' => $access_token
            )
        );
        $xml_string=@file_get_contents("https://www.google.com/analytics/feeds/data"."?".$postdata);
        $resp = 0;
        if($xml_string === FALSE){
            $resp = 0;
        }else{
            $xml = simplexml_load_string($xml_string);
            if(isset($xml->entry)){
                $metrics = $xml->entry->xpath("dxp:metric");
                if($metrics[0]['value']!=''){
                    $resp = $metrics[0]['value'];
                }else{
                    $resp = 0;
                }
            }else{
                $resp = 0;
            }
        }
        return $resp;
    }
    private function useRefreshToken($hdIndicadorId){
        $c = new Criteria();
        $c->add(IndicadoresScGoogleAnalyticsPeer::INDICADOR_ID, $hdIndicadorId);
        $google_analytics = IndicadoresScGoogleAnalyticsPeer::doSelectOne($c);
        $current_user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'));

        $c = new Criteria();
        $c->add(UserGoogleConfigurationPeer::USER_ID, $current_user->getId());
        $google_configuration = UserGoogleConfigurationPeer::doSelectOne($c);
        if(!is_object($google_configuration)){
            $this->getUser()->setFlash('msg','Primero debes configurar los datos de tu cuenta Google');
            return $this->redirect('@configuration');
        }
        $google_client_id = $google_configuration->getGoogleClientId();
        $google_client_secret = $google_configuration->getGoogleClientSecret();
        if(is_object($google_analytics)){
            $postdata = http_build_query(
                array(
                    'client_id' => $google_client_id,
                    'client_secret' => $google_client_secret,
                    'refresh_token' => $google_analytics->getRefreshToken(),
                    'grant_type' => 'refresh_token'
                )
            );
            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'content' => $postdata
                )
            );
            $context  = stream_context_create($opts);
            $result = @file_get_contents('https://accounts.google.com/o/oauth2/token', false, $context);
            if($result === FALSE){
                return null;
            }else{
                $json = json_decode($result);
                return $json->{'access_token'};
            }
        }else{
            return null;
        }
    }
    public function executeGoogleAnalyticsConnect(sfWebRequest $request){
        //buscar si ya tiene configurado el google
        //si ya esta configurado se va a google
        //sino, te redirecciona a la configuracion de google client
        $current_user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'));
        $c = new Criteria();
        $c->add(UserGoogleConfigurationPeer::USER_ID, $current_user->getId());
        $google_configuration = UserGoogleConfigurationPeer::doSelectOne($c);
        if(!is_object($google_configuration)){
            $this->getUser()->setFlash('msg','Primero debes configurar los datos de tu cuenta Google');
            $this->redirect('@configuration');
        }
        $google_client_id = $google_configuration->getGoogleClientId();
        $google_client_secret = $google_configuration->getGoogleClientSecret();
        $hdIndicadorId = $request->getParameter('hdIndicadorId');
        $scope0="https://www.googleapis.com/auth/userinfo.email";
        $scope1="https://www.googleapis.com/auth/analytics.readonly";
        $scope2="https://www.google.com/analytics/feeds/data";
        $scope3="https://www.google.com/analytics/feeds/accounts";
        $redirect_uri = $this->getController()->genUrl('@oauthcallback',true);
        $url = "";
        $url .= "https://accounts.google.com/o/oauth2/auth?";
        $url .= "scope=".urlencode($scope0)."+".urlencode($scope1)."+".urlencode($scope2)."+".urlencode($scope3)."&";
        $url .= "state=".$hdIndicadorId."&";
        $url .= "access_type=offline&";
        $url .= "redirect_uri=".urlencode($redirect_uri)."&";
        $url .= "response_type=code&";
        $url .= "client_id=".$google_client_id;
        $this->redirect($url);
    }
    public function executeOauthcallback(sfWebRequest $request){
        $code = $request->getParameter('code');
        $state = $request->getParameter('state');/* indicador_id */
        $handle_error = $request->getParameter('error');
        $indicator = IndicatorsScPeer::retrieveByPK($state);
        $id_tree = $indicator->getTreeId();
        $current_user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'));
        $c = new Criteria();
        $c->add(UserGoogleConfigurationPeer::USER_ID, $current_user->getId());
        $google_configuration = UserGoogleConfigurationPeer::doSelectOne($c);
        if(!is_object($google_configuration)){
            $this->getUser()->setFlash('msg','Primero debes configurar los datos de tu cuenta Google');
            $this->redirect('@configuration');
        }
        $google_client_id = $google_configuration->getGoogleClientId();
        $google_client_secret = $google_configuration->getGoogleClientSecret();
        if($handle_error=='access_denied'){
            //$this->getUser()->setFlash('message','Oops, ha ocurrido un error. Intenta nuevamente.');
            return $this->redirect('@edit_strategy?id_tree='.$id_tree.'&node_id='.$indicator->getId().'&response=error&from=g');
        }else{
            if($code!='' && $state!=''){
                $postdata = http_build_query(
                    array(
                        'code' => $code,
                        'client_id' => $google_client_id,
                        'client_secret' => $google_client_secret,
                        'redirect_uri' => $this->getController()->genUrl('@oauthcallback',true),
                        'grant_type' => 'authorization_code'
                    )
                );
                $opts = array('http' =>
                    array(
                        'method'  => 'POST',
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'content' => $postdata
                    )
                );
                $context  = stream_context_create($opts);
                $result = @file_get_contents('https://accounts.google.com/o/oauth2/token', false, $context);
                if($result === FALSE){
                    $this->getUser()->setFlash('msg','Configurar correctamente');
                    $this->redirect('@configuration');
                }else{
                    $json = json_decode($result);
                    //consultamos el email del usuario, para adjuntarlo al registro
                    $userinfo = @file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token='.$json->{'access_token'});
                    $json_userinfo = json_decode($userinfo);
                    if($userinfo === FALSE){
                        $this->redirect('@edit_strategy?id_tree='.$id_tree.'&node_id='.$indicator->getId().'&response=error&from=g');
                    }else{
                        /* si $json->{'refresh_token'} devuelve nada, es porque anteriormente ya permitió el acceso */
                        if(isset($json->{'refresh_token'})){//primera vez que pide permiso de acceso
                            //si existe el refresh_token, se reemplaza, ya que es porque anteriormente ha revocado el permiso de acceso
                            $c = new Criteria();
                            $c->add(IndicadoresScGoogleAnalyticsPeer::GOOGLE_USER_EMAIL, $json_userinfo->{'email'});
                            $c->add(IndicadoresScGoogleAnalyticsPeer::INDICADOR_ID, $indicator->getId());
                            $indicadores_sc_google_analytics_object = IndicadoresScGoogleAnalyticsPeer::doSelectOne($c);
                            if(is_object($indicadores_sc_google_analytics_object)){
                                //obtener nodos "del arbol $id_tree" del mismo google_user_email
                                $c = new Criteria();
                                //$c->add(IndicatorsScPeer::TREE_ID, $id_tree);
                                $c->add(IndicatorsScPeer::FLAG, 'habilitado');
                                $c->add(IndicatorsScPeer::ULTIMO_NODO, 1);
                                $c->add(IndicatorsScPeer::DET_NETWORK_ATTRIBUTE_ID, null, Criteria::NOT_EQUAL);
                                $c->add(IndicadoresScGoogleAnalyticsPeer::GOOGLE_USER_EMAIL, $json_userinfo->{'email'});
                                $c->addJoin(IndicadoresScGoogleAnalyticsPeer::INDICADOR_ID, IndicatorsScPeer::ID);
                                $lista_nodos = IndicatorsScPeer::doSelect($c);
                                //obtener nodos con conector exterior pertenecientes al usuario $json_userinfo->{'email'}
                                foreach($lista_nodos as $row){
                                //actualizar su refresh_token
                                    $c = new Criteria();
                                    $c->add(IndicadoresScGoogleAnalyticsPeer::INDICADOR_ID, $row->getId());
                                    $temp = IndicadoresScGoogleAnalyticsPeer::doSelectOne($c);
                                    $temp->setRefreshToken($json->{'refresh_token'});
                                    $temp->save();
                                }
                            }else{
                                //sino, se crea
                                $indicadores_sc_google_analytics = new IndicadoresScGoogleAnalytics();
                                $indicadores_sc_google_analytics->setRefreshToken($json->{'refresh_token'});
                                $indicadores_sc_google_analytics->setGoogleUserEmail($json_userinfo->{'email'});
                                $indicadores_sc_google_analytics->setIndicadorId($indicator->getId());
                                $indicadores_sc_google_analytics->save();
                            }
                            $this->redirect('@edit_strategy?id_tree='.$id_tree.'&node_id='.$indicator->getId().'&response=success&from=g');
                        }else{
                            //buscar los nodos del mismo arbol
                            $c = new Criteria();
                            $c->add(IndicadoresScGoogleAnalyticsPeer::GOOGLE_USER_EMAIL, $json_userinfo->{'email'});
                            //$c->add(IndicatorsScPeer::TREE_ID, $indicator->getTreeId());//puede ser del mismo arbol u otro
                            $c->add(IndicatorsScPeer::FLAG, 'habilitado');
                            $c->addJoin(IndicadoresScGoogleAnalyticsPeer::INDICADOR_ID, IndicatorsScPeer::ID);
                            $object = IndicadoresScGoogleAnalyticsPeer::doSelectOne($c);
                            if(is_object($object)){
                                $indicadores_sc_google_analytics = new IndicadoresScGoogleAnalytics();
                                $indicadores_sc_google_analytics->setRefreshToken($object->getRefreshToken());
                                $indicadores_sc_google_analytics->setGoogleUserEmail($json_userinfo->{'email'});
                                $indicadores_sc_google_analytics->setIndicadorId($indicator->getId());
                                $indicadores_sc_google_analytics->save();
                            }
                            $this->redirect('@edit_strategy?id_tree='.$id_tree.'&node_id='.$indicator->getId().'&response=success&from=g');
                        }
                    }
                }
            }
        }
    }
}