<?php

/**
 * tree actions.
 *
 * @package    practil_scorecard
 * @subpackage tree
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class treeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

  }


public function executeCreate_tree(sfWebRequest $request)
{
    $request->setRequestFormat('json');
    $title = $request->getParameter('item_title');

    $user  = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($user!=null){
        try{
            $conn = Propel::getConnection();
            $conn->beginTransaction();
            $tree_bean = new TreeSc();
            $tree_bean->setName($title);
            $tree_bean->setUserId($user->getId());
            $tree_bean->setConfigureFlag('');
            $tree_bean->setConfigureDesign('');
            $tree_bean->setCreateAt(time());
            $tree_bean->setUpdateAt(time());
            $tree_bean->setFlag(1);
            $tree_bean->setValorDeseado(0);
            $tree_bean->setValorMinimo(0);
            $tree_bean->setResponsableId($user->getId());
            $tree_bean->setEmailResponsable($user->getEmail());
            $tree_bean->setProduccion('not');
            $tree_bean->save();

            $tree_user_bean = new TreeUser();
            $tree_user_bean->setUserId($tree_bean->getUserId());
            $tree_user_bean->setTreeId($tree_bean->getId());
            $tree_user_bean->save();

            $conn->commit();
            $this->message = 'success';
            $this->treepk = 't-'.$tree_bean->getId();
            $this->title = $tree_bean->getName();
            return sfView::SUCCESS;
        }catch (Exception $e){
            $this->message = $e->getMessage();
            return sfView::ERROR;
        }
    }else{
        $this->message = 'session expired';
        return sfView::ERROR;
    }
}
public function executeCreate_indicador(sfWebRequest $request)
{

    $request->setRequestFormat('json');
    $title = $request->getParameter('item_title');
    $previousid = $request->getParameter('previous');
    $tree    =   $request->getParameter('tree');
    $tree    = explode("-", $tree);
    $user  = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($user!=null){
        try{
            $conn = Propel::getConnection();
            $conn->beginTransaction();
            $indicator_bean = new IndicatorsSc();
            $indicator_bean->setTitulo($title);
            $indicator_bean->setDescripcion('');
            $indicator_bean->setTreeId($tree[1]);
            $indicator_bean->setPreviousId($previousid);


            $indicator_bean->setFlag('habilitado');
            $indicator_bean->save();
                //si no es el primer nodo a patir de arbol
                if($indicator_bean->getPreviousId()!=0){
                    //obtengo el ultimo para sacar su configuracion antigua
                    $pre_indicador = IndicatorsScPeer::retrieveByPK($previousid);
                    $pre_indicador->setUltimoNodo(false);
                    $pre_indicador->setValorOptimo(100);
                    $pre_indicador->save();
                    $indicator_bean->setParents($pre_indicador->getParents().'p'.$pre_indicador->getId().'s-');
                    $indicator_bean->setUltimoNodo(true);
                    $indicator_bean->save();
                }else{
                    $indicator_bean->setUltimoNodo(true);
                    $indicator_bean->save();
                }
            $conn->commit();
            $this->message = 'success';
            $this->indicator  = $indicator_bean->getId();
            $this->title   =  $indicator_bean->getTitulo();
            $this->lastNode   =  $indicator_bean->getUltimoNodo();
            return sfView::SUCCESS;
        }catch (Exception $e){
            $this->message = $e->getMessage();
            return sfView::ERROR;
        }
    }else{
        $this->message = 'session expired';
        return sfView::ERROR;
    }
}


public function executeDelete_indicador(sfWebRequest $request)
{

    $indicator = $request->getParameter('indicator');
    $user  = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($user!=null){
        try{
            $conn = Propel::getConnection();
            $conn->beginTransaction();
            $indicadorBean = IndicatorsScPeer::retrieveByPK($indicator);
            if(is_object($indicadorBean)){
                     $id_tree = $indicadorBean->getTreeId();
                     $criterio_indicadores = new Criteria();
                     $criterio_indicadores->add(IndicatorsScPeer::PARENTS,'%p'.$indicadorBean->getId().'s%',Criteria::LIKE);

                     $criterio_update = new Criteria();
                     $criterio_update->add(IndicatorsScPeer::FLAG,'eliminado');
                     BasePeer::doUpdate($criterio_indicadores, $criterio_update, $conn);


                     //antes de eliminar el indicador vamos a revisar si el indicador antesesor
                     //seria el ultimo nodo y asi cambiarle su estado de ultimo_nodo a true
                     /*aca reviso si hay indicadores que todovia dependan del anterior indicador*/
                     $criterio_set_estado = new Criteria();
                     $criterio_set_estado->add(IndicatorsScPeer::PREVIOUS_ID,$indicadorBean->getPreviousId());
                     /*si es asi entonces no cambio nada encambio si no hay ninguno entonces quiere decir
                     * que ese indicador quedaria como ultimo y entonces tendria que cambiarle el estado */
                     $cantidad_de_registros =  IndicatorsScPeer::doCount($criterio_set_estado);
                     /* menor igual 1 por que por logica por lo menos me va botar 1 resultado esta
                      * consulta (por el indicador actual)
                      */
                     if($cantidad_de_registros<=1){
                         $indicador_update = IndicatorsScPeer::retrieveByPK($indicadorBean->getPreviousId());
                         $indicador_update->setUltimoNodo(true);
                         $indicador_update->save();
                     }
                     $indicadorBean->setFlag('eliminado');
                     $indicadorBean->save();
                     $conn->commit();

                    /*Despues de eliminar el o los nodos vamos a enviar nuevamente el arbol y
                     * sus indicadores (nodos) para que se arme nuevamente.
                     */
                    $criterio = new Criteria();
                    $criterio->add(TreeScPeer::USER_ID,$user->getId());
                    $criterio->add(TreeScPeer::ID,$id_tree);
                    $tree = TreeScPeer::doSelectOne($criterio);
                    $criterio->clear();

                    if(is_object($tree)){
                        $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                        $criterio->add(IndicatorsScPeer::TREE_ID,$tree->getId());
                        $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
                        $list_indicadores_send = IndicatorsScPeer::doSelect($criterio);
                        $this->lista_indicadores = $list_indicadores_send;
                        $this->tree = $tree;
                    }
                     $conn = Propel::close();
                     return sfView::SUCCESS;
            }else{
              $this->message = 'el indicador no existe';
               $conn = Propel::close();
              return sfView::ERROR;
            }

        }catch (Exception $e){
             $conn = Propel::close();
            return sfView::ERROR;
        }
    }else{
        $this->message = 'session expired';
         $conn = Propel::close();
        return sfView::ERROR;
    }
}

public function executeSave_configuracion_tree(sfWebRequest $request){

    $request->setRequestFormat('json');
    $ingreso_informacion_periodo = $request->getParameter('dataEntryValue');
    $grupo_trabajo_id   = $request->getParameter('workGroup');
    $tree_id                    = $request->getParameter('treeId');
    $user  = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($user!=null){
        $tree_id    = explode("-", $tree_id);
        $tree = TreeScPeer::retrieveByPK($tree_id[1]);
        if(is_object($tree)){
            if($ingreso_informacion_periodo!="none"){
                $tree->setPeriodoId($ingreso_informacion_periodo);
            }
            if($grupo_trabajo_id!="add"){
                if($tree->getGrupoTrabajoId()!=null){
                    //si el grupo que estoy enviando es el mismo no deberia actualizar nada
                    if($tree->getGrupoTrabajoId()!=$grupo_trabajo_id){
                            $con = Propel::getConnection();
                            $criterio_busqueda = new Criteria();
                            $criterio_busqueda->add(IndicatorsScPeer::TREE_ID,$tree->getId());
                            $criterio_update = new Criteria();
                            $criterio_update->add(IndicatorsScPeer::RESPONSABLE_ID,null);
                            $criterio_update->add(IndicatorsScPeer::EMAIL_RESPONSABLE,'');
                            BasePeer::doUpdate($criterio_busqueda, $criterio_update, $con);
                     }
                }
                $tree->setGrupoTrabajoId($grupo_trabajo_id);

            }
            $tree->save();
            $this->tree = $tree->getId();
            $con = Propel::close();
            return sfView::SUCCESS;
        }else{
            return sfView::ERROR;
        }
    }else{
        return sfView::ERROR;
    }
}

public function executeExecute_tree(sfWebRequest $request){

    $request->setRequestFormat('json');
    $tree_id = $request->getParameter('treeId');
    $tree_id = explode('-', $tree_id);
    $tree_id = $tree_id[1];
    $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($user!=null){
        $tree = TreeScPeer::retrieveByPK($tree_id);
        if(is_object($tree)){
            if($tree->getFlag()==1){
                 //vamos a traer la lista de indicadores y validarlos uno x
                 $criterio = new Criteria();
                 $criterio->add(IndicatorsScPeer::TREE_ID,$tree->getId());
                 $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                 $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
                 $list_indicadores = IndicatorsScPeer::doSelect($criterio);

                 $my_lib = new my_lib();
                 $success = true;
                 foreach ($list_indicadores as $row):
                     $rpt = $my_lib->assessNode($row->getId());
                     if(!$rpt['resp']){
                         $success = false; break;
                     }
                 endforeach;
                   //si todos estan listos
                   if($success){
                       $this->message = 'success';
                       $token = md5(md5($tree->getId()).md5($user->getId()));
                       $this->getUser()->setAttribute(sfConfig::get('app_session_tree_production'),$token);
                       $this->token   = $token;
                       return sfView::SUCCESS;
                   }else{
                       $this->message = 's-005';
                       return sfView::ERROR;
                   }

            }else{
               $this->message = 'flag tree incorrect';
               return sfView::ERROR;
            }
        }else{
             $this->message = 'tree not found';
             return sfView::ERROR;
        }
    }else{
        $this->message = 'session expired';
        return sfView::ERROR;
    }

}

public function executeShow_tree(sfWebRequest $request){

      $request->setRequestFormat('json'); 
      $tree_id  = explode('-',$request->getParameter('treeId'));
      $tree_id  = $tree_id[1];
      $tree = TreeScPeer::retrieveByPK($tree_id);
      if(is_object($tree)){
           //por aqui tambien deveria validar si el usuario tiene permisos para editar este nodo
           //por si se me escapa en el la vista cliente...(pendiente)
            $this->tree= $tree;
            return sfView::SUCCESS;;
      }else{
          return sfView::ERROR;
          $this->message = 'tree no encontrado';
      }
}

public function executeStart_tree(sfWebRequest $request){

    $tree_id = $request->getParameter('treeId');
    $tree_id = explode('-', $tree_id);
    $tree_id = $tree_id[1];
    $token            = $request->getParameter('token');
    $user             = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    $token_session    = $this->getUser()->getAttribute(sfConfig::get('app_session_tree_production'),null);
    if($token_session!=null){
     if($user!=null){
        $tree = TreeScPeer::retrieveByPK($tree_id);
        if(is_object($tree)){
            if($tree->getFlag()==1){
               if($token_session==$token){
                    $tree->setProduccion('production');
                    $tree->setUpdateAt(time());
                    $tree->save();
                    $criterio = new Criteria();
                    $criterio->add(IndicatorsScPeer::TREE_ID,$tree->getId());
                    $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                    $criterio->add(IndicatorsScPeer::ULTIMO_NODO,1);
                    $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
                    $list_indicadores = IndicatorsScPeer::doSelect($criterio);

                    $group_data = new GroupDataIndicadores();
                    $group_data->setPeriodoId($tree->getPeriodoId());
                    $group_data->setCreateAt(time());
                    $group_data->save();
                    
                    foreach ($list_indicadores as $row){                        
                        $data = new DataIndicadores();
                        $data->setIndicadorId($row->getId());
                        $data->setUserId($row->getResponsableId());
                        $data->setGroupData($group_data->getId());
                        $data->setData(0);
                        $data->setCreateAt(time());
                        $data->setUpdateAt(time());
                        $data->save();
                    }
                    $this->getUser()->getAttributeHolder()->remove(sfConfig::get('app_session_tree_production'));
                    $this->redirect('@list_strategy');
               }else{
                  return sfView::ERROR;
               }
            }else{
                $this->message = 'flag tree incorrect';
                return sfView::ERROR;
            }
        }else{
            $this->message = 'tree not found';
            return sfView::ERROR;
        }
      }else{
          $this->message = 'session expired';
          return sfView::ERROR;
      }
    }else{
        $this->message = 'token error';
        return sfView::ERROR;
    }
}

public function executeCreate_mirror_tree(sfWebRequest $request){

    $tree_id = $request->getParameter('idTree');
    $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

    if($user!=null){
        $tree_current = TreeScPeer::retrieveByPK($tree_id);
        if(is_object($tree_current)){
            try{
                $conn = Propel::getConnection();
                $conn->beginTransaction();
                $tree_bean = new TreeSc();
                $tree_bean->setName($tree_current->getName());
                $tree_bean->setUserId($tree_current->getUserId());
                $tree_bean->setConfigureFlag($tree_current->getConfigureFlag());
                $tree_bean->setConfigureDesign($tree_current->getConfigureDesign());
                $tree_bean->setCreateAt(time());
                $tree_bean->setUpdateAt(time());
                $tree_bean->setFlag($tree_current->getFlag());
                $tree_bean->setProduccion('not');
                $tree_bean->setGrupoTrabajoId($tree_current->getGrupoTrabajoId());
                $tree_bean->setPeriodoId($tree_current->getPeriodoId());
                $tree_bean->save();
                $tree_user_bean = new TreeUser();
                $tree_user_bean->setUserId($tree_bean->getUserId());
                $tree_user_bean->setTreeId($tree_bean->getId());
                $tree_user_bean->save();
               

                $criterio = new Criteria();
                $criterio->add(IndicatorsScPeer::TREE_ID,$tree_current->getId());
                $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                $criterio->addAscendingOrderByColumn(IndicatorsScPeer::ID);
                $list_indicadores = IndicatorsScPeer::doSelect($criterio);
                            

                $list_relation = null;
                foreach($list_indicadores as $row){

                      $indicator_bean = new IndicatorsSc();
                      $indicator_bean->setTitulo($row->getTitulo());
                      $indicator_bean->setDescripcion($row->getDescripcion());
                      $indicator_bean->setValorMinimo($row->getValorMinimo());
                      $indicator_bean->setValorDeseado($row->getValorDeseado());
                      $indicator_bean->setValorOptimo($row->getValorOptimo());
                      $indicator_bean->setResponsableId($row->getResponsableId());               
                      $indicator_bean->setTreeId($tree_bean->getId());
                      $indicator_bean->setEmailResponsable($row->getEmailResponsable());
                      $indicator_bean->setUltimoNodo($row->getUltimoNodo());

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
                      
                      $indicator_bean->setFlag($row->getFlag());
                      $indicator_bean->setConectoresConfigure($row->getConectoresConfigure());
                      $indicator_bean->save();
                      
                      $relation = array('array' =>''.$row->getId().'-'.$indicator_bean->getId().'');
                      $list_relation[] =  $relation;
                }


               //  $conn->rollBack();
               $tree_current->setFlag(2);
               $tree_current->save();
               $conn->commit();
               $conn= Propel::close();
               $this->list_relation = $list_relation;
               $this->redirect('@edit_strategy?id_tree='.$tree_bean->getId());
            }catch (Exception $e){
                $conn->rollBack();
                $this->message = $e->getMessage();
                $conn= Propel::close();
                return sfView::ERROR;
            }
        }else{
                $this->message = 'tree not definitive';
                $conn= Propel::close();
                return sfView::ERROR;
        }
    }else{
        $this->message = 'session expired';
        $conn= Propel::close();
        return sfView::ERROR;
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

private function return_relation_id($list_relation,$id){
    foreach($list_relation as $row){
            $id_array = explode('-', $row['array']);
            if($id_array[0]==$id){
                return $id_array[1];
            }
    }
}

public function executeSendEmail_responsable(sfWebRequest $request){

    $criteria = new Criteria();

}

public function executeSet_data_tree(sfWebRequest $request){

    $criterio = new Criteria();
    $criterio->add(TreeScPeer::FLAG,1);
    $criterio->add(TreeScPeer::PRODUCCION,'%production%',Criteria::LIKE);

    $lista_tree = TreeScPeer::doSelect($criterio);


    foreach($lista_tree as $row){
            
    }
    
    
}

private function verificar_insert_data($tree){

    $tree = new TreeSc();
    $tree->getPeriodoId();
    //cada 15 dias
    $criterio = new Criteria();
    $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
    $criterio->add(IndicatorsScPeer::TREE_ID,$tree->getId());
    $indicador = IndicatorsScPeer::doSelectOne($criterio);
    $criterio->clear();
    $criterio->add(DataIndicadoresPeer::INDICADOR_ID,$indicador->getId());
    $criterio->addDescendingOrderByColumn(DataIndicadoresPeer::CREATE_AT);
    $data = DataIndicadoresPeer::doSelectOne($criterio);
    
    $criterio = new Criteria();
    $criterio->add(DataIndicadoresPeer::INDICADOR_ID,24);
    $criterio->addDescendingOrderByColumn(DataIndicadoresPeer::CREATE_AT);
    $data = DataIndicadoresPeer::doSelectOne($criterio);

    $ultima_de_fecha_registro = new DateTime($data->getCreateAt());
    $ultima_de_fecha_registro = $ultima_de_fecha_registro->format('Y-m-d');
    $array = explode('-', $ultima_de_fecha_registro);

    $fecha_actual = mktime(0,0,0,date('m'),date("d"),date('Y'));
    $fecha_actual = date('Y-m-d',$fecha_actual);

   /* if($fecha_proyectada<=$fecha_actual){}*/

    //semanal 
    if($tree->getPeriodoId()==1){        
          $fecha_proyectada = mktime(0,0,0,$array[1],$array[2]+7,$array[0]);
          $fecha_proyectada = date('Y-m-d',$fecha_proyectada);
     //cada quincena
    }elseif($tree->getPeriodoId()==2){
            //si el dia de ultimo registro en menos a quince
            //busco el 15 de ese mes
            if($array[2]<15){
                //la fecha programada es:
               $fecha_proyectada= $this->obtener_fecha_por_dia(15);
            }else{
               $fecha_proyectada= $this->obtener_fecha_por_dia(1);
            }
     //cada bimestre
    }elseif($tree->getPeriodoId()==3){
            
          $fecha_proyectada = mktime(0,0,0,$array[1],$array[2]+0,$array[0]);
          $fecha_proyectada = date('Y-m-d',$fecha_proyectada);
    //cada trimestre
    }else{
         $fecha_proyectada = mktime(0,0,0,$array[1],$array[2]+0,$array[0]);
         $fecha_proyectada = date('Y-m-d',$fecha_proyectada);
    }
    
    
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

public function executeDelete_tree(sfWebRequest $request){    
    $tree_id = $request->getParameter('treePk');
    $tree = TreeScPeer::retrieveByPK($tree_id);
    if(is_object($tree)){
        $tree->setFlag(2);
        $tree->save();
        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }

}


}