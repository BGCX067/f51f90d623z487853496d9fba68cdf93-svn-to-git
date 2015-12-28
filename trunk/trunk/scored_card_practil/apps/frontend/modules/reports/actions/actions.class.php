<?php

/**
 * reports actions.
 *
 * @package    practil_scorecard
 * @subpackage reports
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

  //obtengo el usuario
  $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
  //listo los arboles
  $criteria = new Criteria();
  $criteria->add(TreeScPeer::USER_ID, $user->getId());
  $criteria->add(TreeScPeer::PRODUCCION,'%production%',Criteria::LIKE);
  $criteria->add(TreeScPeer::FLAG, 1);
  $list_tree = TreeScPeer::doSelect($criteria);

  if(count($list_tree)>0){
      
   $this->list_tree = $list_tree;
  }else{
     
      $this->list_tree = null;
  }

  }

    public function executeAjax_reports(sfWebRequest $request)
  {

  //obtengo el id del arbol
  $tree_id  = $request->getParameter('id_tree');
   $criterio = new Criteria();
        $criterio->add(TreeScPeer::ID,$tree_id);
        $criterio->add(TreeScPeer::FLAG,1);
        $tree = TreeScPeer::doSelectOne($criterio);
        $criterio->clear();
        if(is_object($tree)){
            $criterio->add(IndicatorsScPeer::TREE_ID,$tree->getId());
            $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
            $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
            $list_indicadores = IndicatorsScPeer::doSelect($criterio);
            $criterio->clear();
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

  }
   public function executeAjax_show_records_indicators(sfWebRequest $request)
  {

//recojo el id del indicador para este caso es ultimo de lo contrario arrojara un mensaje de error
       $id_indicators = $request->getParameter('id_indicators');
       
       //Se elimina todos los registros de las dos tablas temporales.
       TmpDataReportsPeer::doDeleteAll();
       TmpTreeScPeer::doDeleteAll();
       

       //verifico es ultimo nodo

       $criteria = new Criteria();
       $criteria ->add(IndicatorsScPeer::ID,$id_indicators);
       $indicators = IndicatorsScPeer::doSelectOne($criteria);
       $criteria->clear();
       if(is_object($indicators)){
       $this->indicator = $indicators;
           //obtengo los indicadores que son los ultimos nodos
       $criteria->add(IndicatorsScPeer::TREE_ID, $indicators->getTreeId());
       $criteria->add(IndicatorsScPeer::ULTIMO_NODO,'1',Criteria::LIKE );
       $list_last_indicators = IndicatorsScPeer::doSelect($criteria);
       $criteria->clear();
       $this->list_last_indicators = $list_last_indicators; //----------> lista de los indicadores que son ultimos nodos

       // obtengo la cantidad de registros que tiene en la tabla 'data_indicadores'
      //verifico si el indicador es  ultimo nodo
       foreach($list_last_indicators as $obj_id_indicators){
       if($obj_id_indicators->getId() == $id_indicators){ //si el id del indicador que estoy buscando es igual a uno de los ultimos nodos
           $id = $obj_id_indicators->getId();
       break;
       }
       $id = null;
       }

       if($id != null){ // si es ultimo nodo
       //Verifico la cantidad de rows que tiene

       $criteria->add(DataIndicadoresPeer::INDICADOR_ID,$id );
       $rows_in_data_indicadores = DataIndicadoresPeer::doCount($criteria);

       if($rows_in_data_indicadores>0){
        $object_rows = DataIndicadoresPeer::doSelect($criteria);
       
        $this->indicator = $indicators;
        $this->object_rows = $object_rows;
        $criteria->clear();
       }

       }else{ // si el indicador no es ultimo nodo

           //obtengo el numero de registros que tiene la tabla 'data_indicadores'
           foreach($list_last_indicators as $obj_last_indicators){
           $obj_evaluado   = $obj_last_indicators; //---> solo me hace falta obtener un indicador de esa lista para saber la cantidad de registros
           break;
           }

           //verifico los registros ingresados por ese indicador

            $criteria->add(DataIndicadoresPeer::INDICADOR_ID,$obj_evaluado->getId());
            // $rows_in_data_indicadores = DataIndicadoresPeer::doCount($criteria);
            //1) saco la informacion de los registros
            //2) $obj_evaluado->getId() ----->este ID esta en muchos registros
            $rows_in_data_indicadores = DataIndicadoresPeer::doCount($criteria); //------>numero de registros
            $data_indicators = DataIndicadoresPeer::doSelect($criteria); //---> obtengo los registros por cada ID
            // efectuo el for para replicar el arbol y llenar los valores de cada indicador

            if($rows_in_data_indicadores>0){
             //realizo el for con el numero de registros
           //    for($i=0; $i<$rows_in_data_indicadores ; $i++){
            $data_list_grafico = null;
            
            foreach($data_indicators as $reg_indicators){

                $criteria->clear();
                $criteria->add(DataIndicadoresPeer::GROUP_DATA, $reg_indicators->getGroupData()); //---> BUSCO EL PRIMER GRUPO DE DATOS
                $data_util_graficos = DataIndicadoresPeer::doSelect($criteria);

                $lista_relaciones = null;

                 //obtengo el id del arbol creado en temporal
                 $array_result =  $this->executeEspejo_reportes($indicators->getTreeId(),$data_util_graficos,$reg_indicators->getUpdateAt() );
                 $id_tmp_creado = $array_result['array'];
                 $lista_relaciones = $array_result['lista'];

               //obtengo los ultmimos nodos pero de los indicadores que estan creados en la tabla temporal
                $criteria->add(TmpDataReportsPeer::TREE_ID,$id_tmp_creado );
                $criteria->add(TmpDataReportsPeer::ULTIMO_NODO,'1',Criteria::LIKE);
                $list_tmp_last_indicators = TmpDataReportsPeer::doSelect($criteria); //----> lista de los ultimos nodos de la tabla tmp
                //$list_relation = null;

               foreach($list_tmp_last_indicators as $ob){

                $this->recalculate_tree($ob);
              }
                //obtengo el id del indicador relacionado
                 $id_relation = $this->return_relation_id($lista_relaciones,$indicators->getId());

                 //busco en la tabla temporal por el id
                 

                 $data_list_grafico[] = $id_relation;

               }


               //envio datos para el grafico

               $criteria->clear();
               $criteria->add(TmpDataReportsPeer::INDICADOR_ID, $indicators->getId());
               $list_indicators_reports = TmpDataReportsPeer::doSelect($criteria);
         //  }
           }

            $this->indicator = $indicators;
    
            $this->object_rows = $list_indicators_reports;
       }




       }else{
      // $this->indicators = null;
        $this->list_last_indicators = null;
      
        $this->object_rows = null;
       }

   }
 public function executeEspejo_reportes($tree_id, $list_data_indicador, $fecha_update) {

   // $tree_id = $request->getParameter('idTree');
   // $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($tree_id!=0){
        $tree_espejo = TreeScPeer::retrieveByPK($tree_id);
        if(is_object($tree_espejo)){
            try{
                $conn = Propel::getConnection();
                $conn->beginTransaction();
                $tree_bean = new TmpTreeSc();
                $tree_bean->setConfigureFlag($tree_espejo->getConfigureFlag());
                $tree_bean->setFlag("ok");
                $tree_bean->save();

                $criterio = new Criteria();
                $criterio->add(IndicatorsScPeer::TREE_ID,$tree_espejo->getId());
                $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                $criterio->addAscendingOrderByColumn(IndicatorsScPeer::ID);
                $list_indicadores = IndicatorsScPeer::doSelect($criterio);

                $list_relation = null;
                foreach($list_indicadores as $row){

                      $indicator_bean = new TmpDataReports();
                      $indicator_bean->setIndicadorId($row->getId());
                      $indicator_bean->setValorMinimo($row->getValorMinimo());
                      $indicator_bean->setValorDeseado($row->getValorDeseado());
                      $indicator_bean->setValorOptimo($row->getValorOptimo());
                      $indicator_bean->setTreeId($tree_bean->getId());
                      $indicator_bean->setUltimoNodo($row->getUltimoNodo());
                      $indicator_bean->setUpdateAt($fecha_update);
                      $indicator_bean->setFlag("ok");

                      if($row->getPreviousId()==0){
                           $indicator_bean->setPreviousId(0);
                      }else{

                          $id_relation = $this->return_relation_id($list_relation,$row->getPreviousId());
                          $indicator_bean->setPreviousId($id_relation);
                      }

                      if($row->getParents()!=""){

                          $parents = $this->return_parent_relation($list_relation,$row->getParents());
                          $indicator_bean->setParents($parents);
                      }


                      //preguntar si es ultmo idicador
                        //->getUltimoNodo()

                      //si es ultimo nodo tengo que pasar la data actual
                      //a  data que se esta creando ->

                      $indicator_bean->setConectoresConfigure($row->getConectoresConfigure());
                      $indicator_bean->save();
                      //actualizo el valor actual entregado



                      $relation = array('array' =>''.$row->getId().'-'.$indicator_bean->getId().'');
                      $list_relation[] =  $relation;



                }



                    foreach($list_data_indicador as $obj_data){
                        $criteria = new Criteria();
                          $id = $this->return_relation_id($list_relation,$obj_data->getIndicadorId());

                          $criteria->add(TmpDataReportsPeer::ID, $id);
                          $obj_update_tmp = TmpDataReportsPeer::doSelectOne($criteria);

                          $obj_update_tmp->setData($obj_data->getData());
                          $obj_update_tmp->save();
                      }


               $conn->commit();
               $conn= Propel::close();

               // VOY A DEVOLVER UN ARREGLO CON DOS VALORES 1) ID DEL TREE TEMPORAL, 2) LA LISTA DE LA RELACION
               $result = array('array' =>$tree_bean->getId(),"lista" => $list_relation);

               return $result;
               //$this->list_relation = $list_relation;
               //$this->redirect('@edit_strategy?id_tree='.$tree_bean->getId());
            }catch (Exception $e){
                $conn->rollBack();
               // $this->message = $e->getMessage();
                $conn= Propel::close();
                return sfView::ERROR;
            }
        }else{
               // $this->message = 'tree not definitive';
                $conn= Propel::close();
                return sfView::ERROR;
        }
    }else{
     //   $this->message = 'session expired';
        $conn= Propel::close();
        return sfView::ERROR;
    }


  }
  private function recalculate_tree($nodo){

    $suma_hijos = 0;
    $hijos_del_padre = $this->get_hijos($nodo->getPreviousId());

    if($hijos_del_padre!=null){
        foreach($hijos_del_padre as $row){

              $valor_actual     = $row->getData();
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
                      $suma_hijos = $suma_hijos+ (($valor_actual*($valor_porcentual/100)))/$valor_maximo;
                  }
             }
       }

       $padre = TmpDataReportsPeer::retrieveByPK($nodo->getPreviousId());
       $valor_final = $suma_hijos*100;
       $padre->setData($valor_final);

       $padre->save();

       //print_r('-'.$valor_final.'-');
       $this->validar_si_tiene_padre($padre);

    }
 }

private function return_relation_id($list_relation,$id){

    foreach($list_relation as $row){
            $id_array = explode('-', $row['array']);
            if($id_array[0]==$id){
                return $id_array[1];
            }
    }
}

private function return_parent_relation($list_relation,$parents){
    $parent_array =  explode('-', $parents);
    $list_parent = "";
    for($i=0;$i<count($parent_array);$i++){
        if($parent_array[$i]!=""){
            $id     =  substr($parent_array[$i], 1, strlen($parent_array[$i])-2);
            $id_aux =  $this->return_relation_id($list_relation, $id);
            $list_parent = $list_parent.'p'.$id_aux.'s-';
        }
    }
    return $list_parent;
}
private function get_hijos($padre_id){
    $criterio = new Criteria();
    $criterio->add(TmpDataReportsPeer::PREVIOUS_ID,$padre_id);
    $list = TmpDataReportsPeer::doSelect($criterio);
    if(count($list)>0){
        return $list;
    }else{
       return null;
    }
}

private function validar_si_tiene_padre($indicador){
    if($indicador->getPreviousId()!=0){
        $this->recalculate_tree($indicador);
    }
}

private function soy_padre($indicador){
    $criterio = new Criteria();
    $criterio->add(TmpDataReportsPeer::PREVIOUS_ID,$indicador->getId());
    $cantidad = TmpDataReportsPeer::doCount($criterio);
    if($cantidad>0){
       return true;
    }else{
        return false;
    }
}

public function executeAjax_show_gauge_indicators(sfWebRequest $request){

    $id = $request->getParameter('id_indicators');
    //busco el id del indicador

    $indicador = IndicatorsScPeer::retrieveByPK($id);
    $this->nombre = $indicador->getTitulo();
    $minimo = $indicador->getValorMinimo();
    $optimo = $indicador->getValorOptimo();
    $deseado = $indicador->getValorDeseado();
    $valor_actual = $indicador->getValorActualEntregado();
    if($valor_actual != null){
    $divisor = $optimo-$minimo;
    if($valor_actual<=$minimo)
    $valor_porcentaje = 0;
    else{
    $dividendo = $valor_actual-$minimo;
    $valor_porcentaje = ($dividendo*100) / $divisor;
    }
    $this->valor_porcentaje = $valor_porcentaje;
    //para mostrar
    $this->minimo = $minimo;
    $this->optimo = $optimo;
    $this->deseado = $deseado;
    $this->actual = $valor_actual;
    }else{
    $this->valor_porcentaje = null;
    //para mostrar
    $this->minimo = $minimo;
    $this->optimo = $optimo;
    $this->deseado = $deseado;
    $this->actual = null;
    }

    




    
    
    
}

}
