<?php

/**
 * my_responsibilities actions.
 *
 * @package    practil_scorecard
 * @subpackage my_responsibilities
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class my_responsibilitiesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */



public function executeIndex(sfWebRequest $request)
{

     $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'), null);

    /* primero vamos a ver en que cantidad de arboles estoy relacionado para armar los tabs
     * y si en caso este relacionado mandar los valores correspondientes del primer arbol
     * para harmar el primer tabs .... los siguientes se armaran por ajax
     */

    $criterio_busqueda = new Criteria();
    $criterio_busqueda->add(IndicatorsScPeer::RESPONSABLE_ID,$user->getId());
    $criterio_busqueda->add(IndicatorsScPeer::ULTIMO_NODO,1);
    $criterio_busqueda->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
    $criterio_busqueda->add(TreeScPeer::PRODUCCION,'%production%',Criteria::LIKE);
    $criterio_busqueda->add(TreeScPeer::FLAG,1);
    $criterio_busqueda->addJoin(TreeScPeer::ID, IndicatorsScPeer::TREE_ID);
    $criterio_busqueda->addGroupByColumn(TreeScPeer::ID);

    $list_tree = TreeScPeer::doSelect($criterio_busqueda);

    if(count($list_tree)>0)
    {
            $criterio_busqueda->clear();
            $criterio_busqueda->add(IndicatorsScPeer::RESPONSABLE_ID,$user->getId());
            $criterio_busqueda->add(IndicatorsScPeer::ULTIMO_NODO,1);
            $criterio_busqueda->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
            $criterio_busqueda->add(IndicatorsScPeer::TREE_ID,$list_tree[0]->getId());
            $criterio_busqueda->addSelectColumn(IndicatorsScPeer::ID);
            $criterio_busqueda->addSelectColumn(IndicatorsScPeer::TREE_ID);
            $list_first_indicador = IndicatorsScPeer::doSelectStmt($criterio_busqueda);
            $this->list_first_indicador = $list_first_indicador;
    }

    $this->list_tree = $list_tree;
    $this->user = $user;

    ///////////////////////////////////////////////////////////////////////////////////


   /* $criterio = new Criteria();
    $criterio->add(DataIndicadoresPeer::INDICADOR_ID,24);
    $criterio->addDescendingOrderByColumn(DataIndicadoresPeer::CREATE_AT);
    $data = DataIndicadoresPeer::doSelectOne($criterio);

    $ultima_de_fecha_registro = new DateTime($data->getCreateAt());
    $ultima_de_fecha_registro = $ultima_de_fecha_registro->format('Y-m-d');
    $array = explode('-', $ultima_de_fecha_registro);

    $fecha_actual = mktime(0,0,0,date('m'),date("d"),date('Y'));
    $fecha_actual = date('Y-m-d',$fecha_actual);

   /* if($fecha_proyectada<=$fecha_actual){}
   $periodo = 1;
    //semanal
    if($periodo==1){
          $fecha_proyectada = mktime(0,0,0,$array[1],$array[2]+7,$array[0]);
          $fecha_proyectada = date('Y-m-d',$fecha_proyectada);
     //cada quincena
    }elseif($periodo==2){
            //si el dia de ultimo registro en menos a quince
            //busco el 15 de ese mes
            if($array[2]<15){
                //la fecha programada es:
               $fecha_proyectada= $this->obtener_fecha_por_dia(15);
            }else{
               $fecha_proyectada= $this->obtener_fecha_por_dia(1);
            }
     //cada mes
    }else{
        $fecha_proyectada = mktime(0,0,0,date('m')+1,1,date('Y'));
        $fecha_proyectada = date('Y-m-d',$fecha_proyectada);
    }
*/


}

private function obtener_fecha_por_dia($fecha){

    if($fecha==1){
         $fecha_proyectada = mktime(0,0,0,date('m')+1,1,date('Y'));
         $fecha_proyectada = date('Y-m-d',$fecha_proyectada);
         return $fecha_proyectada;
    }else{
        $fecha_proyectada = mktime(0,0,0,date('m'),15,date('Y'));
        $fecha_proyectada = date('Y-m-d',$fecha_proyectada);
        return $fecha_proyectada;
    }
}



public function executeAjax_responsibilities(sfWebRequest $request){

    $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'), null);

    /* primero vamos a ver en que cantidad de arboles estoy relacionado para armar los tabs
     * y si en caso este relacionado mandar los valores correspondientes del primer arbol
     * para harmar el primer tabs .... los siguientes se armaran por ajax
     */

    $tree_id= $request->getParameter('treeid');

    $criterio_busqueda = new Criteria();
    $criterio_busqueda->add(IndicatorsScPeer::RESPONSABLE_ID,$user->getId());
    $criterio_busqueda->add(IndicatorsScPeer::ULTIMO_NODO,1);
    $criterio_busqueda->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
    $criterio_busqueda->add(IndicatorsScPeer::TREE_ID,$tree_id);


    $criterio_busqueda->addSelectColumn(IndicatorsScPeer::ID);       //0
    $criterio_busqueda->addSelectColumn(IndicatorsScPeer::TREE_ID);  //1
    $list_first_indicador = IndicatorsScPeer::doSelectStmt($criterio_busqueda);
    $this->list_first_indicador = $list_first_indicador;


    $this->user = $user;

}

public function executeSave(sfWebRequest $request){

    $lib = new my_lib();

    for($i =1; $i<10;$i++){
        $id_data = $request->getParameter('idfecha'.$i);
        if($id_data!=""){
            $data = DataIndicadoresPeer::retrieveByPK($id_data);

            if($data->getData()!=$request->getParameter('f'.$i) ){
                $data->setData($request->getParameter('f'.$i));
                $data->save();
                /*
                 * aca verificamos si el ultimo registo (de la tabla group_data)
                 * 
                */
                $rpt = $this->is_the_last_record($data);
                if($rpt){
                      $indicador = IndicatorsScPeer::retrieveByPK($data->getIndicadorId());
                      if(is_object($indicador)){
                           $respuesta  = $lib->getTipoConector($data->getIndicadorId());
                           $indicador->setValorActualEntregado($request->getParameter('f'.$i));                                                      
                           $indicador->save();
                      }


                    /*
                     * Obtengo los indicadores que tienen indicadores hijos ( ultimos indicadores )
                     * o comienzo a recacular todos los valores Actuales de todos los indicadores
                     */
                    $criterio = new Criteria();
                    $criterio->add(IndicatorsScPeer::TREE_ID,$indicador->getTreeId());
                    $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                    $criterio->add(IndicatorsScPeer::ULTIMO_NODO,1);
                    $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
                    $list_indicadores = IndicatorsScPeer::doSelect($criterio);

                    foreach($list_indicadores as $row)
                    {
                         if($row->getPreviousId()!=0){
                               $var = $this->recalcular($row,$data->getCreateAt());
                        }

                    }

                    //set a los valores de actuales de los indicadores
                }

            }
        }
    }
}

public function is_the_last_record($data){
    $connection = Propel::getConnection();
    $query = 'SELECT MAX(group_data) AS max FROM data_indicadores WHERE indicador_id = '.$data->getIndicadorId();
    $statement = $connection->prepare($query);
    $statement->execute();
    $row = $statement->fetch();
    $ultimo = $row['max'];
    $connection = Propel::close();
    if($ultimo == $data->getGroupData()){
        return true;
    }else{
        return false;
    }
}

private function obtenerValoresDeProyecciones($indicador,$fecha)
{
    $dia  =  date("d",strtotime($fecha));
    $mes  =  date("m",strtotime($fecha));
    $anio =  date("Y",strtotime($fecha));
    $fecha   =  date("Y-m-d", mktime( 0, 0, 0,$mes,$dia,$anio ) );
    $criteria = new Criteria();
    $criteria->add(ProjectionsIndicatorsCsPeer::INDICADOR_ID,$indicador->getId());
    $criteria->add(ProjectionsIndicatorsCsPeer::FECHA,$fecha);
    $proyeccion = ProjectionsIndicatorsCsPeer::doSelectOne($criteria);



    if(is_object($proyeccion))
    {
        
        return array("success"=>true,"message"=>"exito","object" =>$proyeccion);
    }
    else
    {
        return array("success"=>false,"message"=>"proyeccion no encotrada");
    }
}


private function recalcular($nodo,$fecha = null){


    $suma_hijos = 0;
    $hijos_del_padre = $this->get_hijos($nodo->getPreviousId());

    if($hijos_del_padre!=null){

        foreach($hijos_del_padre as $row){

              $proyeccionBean =  $this->obtenerValoresDeProyecciones($row, $fecha);

              $valor_actual     = $row->getValorActualEntregado();
              $valor_porcentual = $row->getConectoresConfigure();
              $valor_minimo     = $proyeccionBean['object']->getValorMinimo();
              $valor_maximo     = $proyeccionBean['object']->getValorOptimo();
              $division         = $valor_actual/$valor_maximo;

              if($this->soy_padre($row)){
                    $valor_minimo = 0;
              }

             if($valor_actual<=$valor_minimo)
             {
                 $division = 0;
             }
             else{
                  if($division>=1){
                  $suma_hijos =$suma_hijos+($valor_porcentual/100);
                  }else{
                      $suma_hijos = $suma_hijos+ ( ($valor_actual*($valor_porcentual/100)) )/$valor_maximo;
                  }
             }

       }

       $padre = IndicatorsScPeer::retrieveByPK($nodo->getPreviousId());
       $valor_final = $suma_hijos*100;

       $padre->setValorActualEntregado($valor_final);
       $padre->save();

       $this->validar_si_tiene_padre($padre,$fecha);

    }

}

private function validar_si_tiene_padre($indicador,$fecha=null){
    if($indicador->getPreviousId()!=0){
        $this->recalcular($indicador,$fecha);
    }
}

private function soy_padre($indicador){
    $criterio = new Criteria();
    $criterio->add(IndicatorsScPeer::PREVIOUS_ID,$indicador->getId());
    $cantidad = IndicatorsScPeer::doCount($criterio);
    if($cantidad>0){
       return true;
    }else{
        return false;
    }
}

private function get_hijos($padre_id){
    $criterio = new Criteria();
    $criterio->add(IndicatorsScPeer::PREVIOUS_ID,$padre_id);
    $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
    $list = IndicatorsScPeer::doSelect($criterio);
    if(count($list)>0){
        return $list;
    }else{
       return null;
    }
}

/********************************************************  cronJob ******************************************************/
/*
cronJob se activará todos los días a las 1:00 am horas.

semanal (Todos Lunes)
quincenal (1 y 15 de cada mes)
mensual (1 de cada mes)

se activa el metodo y se evalúa:
si el presente día es Lunes, 1 ó 15. Entonces el método realiza las acciones.

________________________________________________________________________________________________

if($today=='Lunes'){

  $c->addOr(TreeScPeer::PERIODO_ID, 1); (1->semanal)

}
if($today=='1' || $today=='15'){

  $c->addOr(TreeScPeer::PERIODO_ID, 2); (2->quincenal)

}
if($today=='1'){

  $c->addOr(TreeScPeer::PERIODO_ID, 3); (3->mensual)

}
________________________________________________________________________________________________

$c = new Criteria();
$c->add(TreeScPeer::PERIODO_ID, $periodo_id); 						// el periodo debe ser el indicado
$c->add(TreeScPeer::PRODUCCION, 'production', Criteria::EQUAL); 			// el arbol debe estar en produccion
$c->add(IndicatorsScPeer::ULTIMO_NODO, 1); 						// que el nodo sea ultimo(que no tenga hijos)
$c->add(IndicatorsScPeer::FLAG, 'habilitado', Criteria::EQUAL); 			// que el nodo este habilitado
$c->add(IndicatorsScPeer::DET_NETWORK_ATTRIBUTE_ID, null, Criteria::NOT_EQUAL); 	// que el conector externo no sea null
$c->addJoin(TreeScPeer::ID, IndicatorsScPeer::TREE_ID);
$nodos_a_ser_actualizados = IndicatorsScPeer::doSelect($c);

foreach($nodos_a_ser_actualizados as $row){



}

*/


public function executeCronUpdateIndicatorScData(sfWebRequest $request)
{

        /*if($request->getParameter('tkn')=='99f0fdaa821a859060509c744824be2a'){*/
            $today = date("Y-m-d");

            $year = substr($today,0,4);
            $month = substr($today,5,2);
            $day = substr($today,8,2);

            // 1 (para lunes) hasta 7 (para domingo)
            $number_day = date('N',mktime(0,0,0,$month,$day,$year));
            $number_day = intval($number_day);

            if($number_day==1)
            { /* si es lunes */
                $this->actualizarNodosPorPeriodo(1);
            }
            if($day=='01' || $day=='15')
            {
                $this->actualizarNodosPorPeriodo(2);
            }
            if($day=='01'){
                $this->actualizarNodosPorPeriodo(3);
            }
       /* }*/
        return sfView::NONE;
}

private function actualizarNodosPorPeriodo($periodo_id){
        $c = new Criteria();
        $c->add(TreeScPeer::PERIODO_ID, $periodo_id);
        $c->add(TreeScPeer::PRODUCCION, 'production');
        $c->add(IndicatorsScPeer::ULTIMO_NODO, 1);
        $c->add(IndicatorsScPeer::FLAG, 'habilitado');
        $c->addJoin(TreeScPeer::ID, IndicatorsScPeer::TREE_ID);
        $nodos = IndicatorsScPeer::doSelect($c);       

        if(count($nodos)>0){
            $group_data_indicadores = new GroupDataIndicadores();
            $group_data_indicadores->setCreateAt(time());
            $group_data_indicadores->setTreeId($nodos[0]->getTreeId());
            $group_data_indicadores->save();

            //$nodos es sòlo los ultimos nodos de un arbol
            foreach($nodos as $row){
                $data_indicadores = new DataIndicadores();
                $data_indicadores->setIndicadorId($row->getId());
                $data_indicadores->setUserId($row->getResponsableId());

                $c = new Criteria();
                $c->add(DataIndicadoresPeer::INDICADOR_ID, $row->getId());
                $c->addDescendingOrderByColumn(DataIndicadoresPeer::CREATE_AT);
                $c->setLimit(1);
                $data_anterior_indicador = DataIndicadoresPeer::doSelectOne($c);

                if($row->getDetNetworkAttributeId()==null){ /* si es null, es conector interno (manualmente) */
                    $data_indicadores->setData(0);

                    $row->setValorActualEntregado(0);
                    $row->save();
                }else{
                    $data_indicadores->setData($this->getIndicatorScData($row->getId()));
                    $row->setValorActualEntregado($this->getIndicatorScData($row->getId()));
                    $row->save();
                }
                $data_indicadores->setGroupData($group_data_indicadores->getId());
                $data_indicadores->setCreateAt(time());
                $data_indicadores->setUpdateAt(time());
                $data_indicadores->save();
            }

            $ultima_fecha_del_array = $data_indicadores->getCreateAt();


            if(count($nodos)>0)
            {
                 /*
                 * Obtengo los indicadores que tienen indicadores hijos ( ultimos indicadores )
                 * o comienzo a recacular todos los valores Actuales de todos los indicadores
                 */
                $criterio = new Criteria();
                $criterio->add(IndicatorsScPeer::TREE_ID,$nodos[0]->getTreeId());
                $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                $criterio->add(IndicatorsScPeer::ULTIMO_NODO,1);
                $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
                $list_indicadores = IndicatorsScPeer::doSelect($criterio);

                foreach($list_indicadores as $row)
                {
                     if($row->getPreviousId()!=0){
                           $var = $this->recalcular($row,$ultima_fecha_del_array);
                    }

                }
            }
            
        }
    }
    //devuelve la metrica designada en la bd: tabla: attribute.
    private function getIndicatorScData($indicator_sc_id){

	$nodo = IndicatorsScPeer::retrieveByPk($indicator_sc_id);

	$det_net_attr_id = $nodo->getDetNetworkAttributeId();
	$network_id = $nodo->getDetNetworkAttribute()->getNetworkId();
	$usernameInNetwork = $nodo->getUsernameInNetwork();

        $atributo = DetNetworkAttributePeer::retrieveByPK($det_net_attr_id);
        $keyword = $atributo->getAttribute()->getKeyWord();

        $resp = 0;
	if($network_id=='1'){ /* Facebook */
            $json_string=@file_get_contents("http://graph.facebook.com/".$usernameInNetwork."/");
	    if($json_string === FALSE){
                $resp = 0;
            }else{
                $json = json_decode($json_string);
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
	}elseif($network_id=='2'){ /* Twitter */
            $xml_string=@file_get_contents("http://api.twitter.com/1/users/show.xml?screen_name=".$usernameInNetwork);
	    if($xml_string === FALSE){
                $resp = 0;
            }else{
		$xml = simplexml_load_string($xml_string);
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
	}elseif($network_id=='3'){ /* Google Analytics */
            $access_token = $this->useRefreshToken($nodo->getId());
            if($access_token!=null){
                $postdata = http_build_query(
                array(
                        'ids' => $usernameInNetwork,
                        'metrics' => $keyword,
                        'start-date' => $nodo->getGaFecFin(),
                        'end-date' => date("Y-m-d"),
                        'max-results' => '1',
                        'access_token' => $access_token
                    )
                );

                $xml_string=@file_get_contents("https://www.google.com/analytics/feeds/data"."?".$postdata);
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

        if(is_object($google_analytics)){
            $postdata = http_build_query(
                array(
                    'client_id' => sfConfig::get('app_google_client_id'),
                    'client_secret' => sfConfig::get('app_google_client_secret'),
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
            $result = file_get_contents('https://accounts.google.com/o/oauth2/token', false, $context);

            $json = json_decode($result);

            return $json->{'access_token'};
        }else{
            return null;
        }
    }




private function executeValorReal($dataBean){


    $anterior = $this->executeBuscar_anterior($dataBean);

    if($anterior!=null){

            return $dataBean->getData()-$anterior->getData();
    }else{
            return 0;
    }

}

private function executeBuscar_anterior($dataBean){

    $criterio_busqueda = new Criteria();
    $criterio_busqueda->add(DataIndicadoresPeer::INDICADOR_ID,$dataBean->getIndicadorId());
    $c_data         = DataIndicadoresPeer::doCount($criterio_busqueda);
    $list_data         = DataIndicadoresPeer::doSelect($criterio_busqueda);
    if($c_data>0){

          //si hay un solo registro no hay anterior
            if($c_data==1){
                return null;//no hay anterior
            }else{
                //vamos verificar si el el primero
                if($list_data[0]->getId() == $dataBean->getId() /*-si el el primero-*/){
                    return null;//no hay anterior
                }else{
                    $contador = 0;
                    foreach($list_data as $row){
                            if($row->getId()==$dataBean->getId()){
                                return $list_data[$contador-1];
                            }
                            $contador++;
                    }
                    return null;
                }
            }
    }else{
        return null;//no hay anterior
    }
}

}