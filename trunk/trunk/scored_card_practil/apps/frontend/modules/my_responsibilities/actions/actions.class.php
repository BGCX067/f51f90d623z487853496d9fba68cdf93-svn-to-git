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
    $criterio_busqueda->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
    $criterio_busqueda->add(TreeScPeer::PRODUCCION,'%production%',Criteria::LIKE);
    $criterio_busqueda->add(TreeScPeer::FLAG,1);
    $criterio_busqueda->addJoin(TreeScPeer::ID, IndicatorsScPeer::TREE_ID);
    $criterio_busqueda->addGroupByColumn(TreeScPeer::ID);

    $list_tree = TreeScPeer::doSelect($criterio_busqueda);
    if(count($list_tree)>0){
            $criterio_busqueda->clear();
            $criterio_busqueda->add(IndicatorsScPeer::RESPONSABLE_ID,$user->getId());
            $criterio_busqueda->add(IndicatorsScPeer::ULTIMO_NODO,1);
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
    $criterio_busqueda->add(IndicatorsScPeer::TREE_ID,$tree_id);
    $criterio_busqueda->addSelectColumn(IndicatorsScPeer::ID);
    $criterio_busqueda->addSelectColumn(IndicatorsScPeer::TREE_ID);
    $list_first_indicador = IndicatorsScPeer::doSelectStmt($criterio_busqueda);
    $this->list_first_indicador = $list_first_indicador;
    

    $this->user = $user;

}

public function executeSave(sfWebRequest $request){

    for($i =1; $i<10;$i++){
        $id_data = $request->getParameter('idfecha'.$i);
        if($id_data!=""){
            $data = DataIndicadoresPeer::retrieveByPK($id_data);

            if($data->getData()!=$request->getParameter('f'.$i) ){
                $data->setData($request->getParameter('f'.$i));
                $data->save();
                //aca verificamos si el ultimo registro
                $rpt = $this->is_the_last_record($data);
                if($rpt){
                      $indicador = IndicatorsScPeer::retrieveByPK($data->getIndicadorId());
                      if(is_object($indicador)){
                           $indicador->setValorActualEntregado($request->getParameter('f'.$i));
                           $indicador->save();
                      }

                    $criterio = new Criteria();
                    $criterio->add(IndicatorsScPeer::TREE_ID,$indicador->getTreeId());
                    $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                    $criterio->add(IndicatorsScPeer::ULTIMO_NODO,1);
                    $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
                    $list_indicadores = IndicatorsScPeer::doSelect($criterio);

                    foreach($list_indicadores as $row){
                  
                        $var = $this->recalcular($row);
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

private function recalcular($nodo){
     
    $suma_hijos = 0;    
    $hijos_del_padre = $this->get_hijos($nodo->getPreviousId());
    
    if($hijos_del_padre!=null){
        foreach($hijos_del_padre as $row){
               
              $valor_actual     = $row->getValorActualEntregado();
              $valor_porcentual = $row->getConectoresConfigure();
              $valor_minimo     = $row->getValorMinimo();
              $valor_maximo     = $row->getValorOptimo();
              $division         = $valor_actual/$valor_maximo;

              if($this->soy_padre($row)){
                    $valor_minimo = 0;
              }

             if($valor_actual<=$valor_minimo){
                 $division = 0;
             }else{
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
       
       $this->validar_si_tiene_padre($padre);
       
    }
    
}

private function validar_si_tiene_padre($indicador){
    if($indicador->getPreviousId()!=0){
        $this->recalcular($indicador);
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


}