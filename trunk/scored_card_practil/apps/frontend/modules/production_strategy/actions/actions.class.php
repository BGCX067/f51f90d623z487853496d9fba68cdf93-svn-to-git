<?php

/**
 * production_strategy actions.
 *
 * @package    practil_scorecard
 * @subpackage production_strategy
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class production_strategyActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
public function executeIndex(sfWebRequest $request)
{

     $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
     if($user!=null){
        $criteria = new Criteria();
        $criteria->add(TreeScPeer::USER_ID, $user->getId());
        $criteria->add(TreeScPeer::PRODUCCION,'%production%',Criteria::LIKE);
        $criteria->add(TreeScPeer::FLAG, 1);
        $user_tree = TreeScPeer::doSelect($criteria);
        $this->lista_tree_user = $user_tree;

        $criteria->clear();
        // indicadores a los cuales este usuario esta com responsables
        $criteria->add(IndicatorsScPeer::RESPONSABLE_ID, $user->getId());
        $criteria->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
        $criteria->add(TreeScPeer::FLAG,1);
        $criteria->add(TreeScPeer::PRODUCCION,'%production%',Criteria::LIKE);
        $criteria->addJoin(TreeScPeer::ID, IndicatorsScPeer::TREE_ID);
        $criteria->addGroupByColumn(IndicatorsScPeer::TREE_ID);
        $user_indicators = IndicatorsScPeer::doSelect($criteria);
        $criteria->clear();
        $this->lista_indicators_user = $user_indicators;

     }


}

public function executeAjax_mostrar_sub_tree(sfWebRequest $request)
{

  $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
  $tree_id  = $request->getParameter('tree');
  if($user!=null){

            $criterio_indicadores = new Criteria();
            $criterio_indicadores->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
            $criterio_indicadores->add(IndicatorsScPeer::RESPONSABLE_ID,$user->getId());
            $criterio_indicadores->add(IndicatorsScPeer::TREE_ID,$tree_id);
            $criterio_indicadores->add(TreeScPeer::FLAG,1);
            $criterio_indicadores->add(TreeScPeer::PRODUCCION,'%production%',Criteria::LIKE);
            $criterio_indicadores->addJoin(TreeScPeer::ID, IndicatorsScPeer::TREE_ID);
            $criterio_indicadores->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
            $list = IndicatorsScPeer::doSelect($criterio_indicadores);
            
            $array = null;
            
            foreach($list as $row){
                    $success = $this->validate_exist($array, $row->getId());
                    if($success){
                        $array[]=array($row->getId(),0,$row->getTitulo(),$row->getValorMinimo(),$row->getValorDeseado(),$row->getValorActualEntregado(),$row->getConectoresConfigure());
                        $lista_aux = $this->return_array_children($row->getId());
                            if($lista_aux!=null){
                                foreach ($lista_aux as $value) {
                                     $array[]=array($value->getId(),$value->getPreviousId(),$value->getTitulo(),$value->getValorMinimo(),$value->getValorDeseado(),$value->getValorActualEntregado(),$value->getConectoresConfigure());
                                }
                            }
                    }
            }
            $this->tree = TreeScPeer::retrieveByPK($tree_id);

            /* con esto obtengo la fecha de proyeccion actual
            */
            $criteria = new Criteria();
            $criteria->add(IndicatorsScPeer::TREE_ID,$tree_id);
            $criteria->addJoin(IndicatorsScPeer::ID, DataIndicadoresPeer::INDICADOR_ID);
            $criteria->addDescendingOrderByColumn(DataIndicadoresPeer::CREATE_AT);
            $proyeccion = DataIndicadoresPeer::doSelectOne($criteria);
            $this->fechaProyeccion   = $proyeccion->getCreateAt();


       $this->array=$array;
    }else{
       $this->array=null;
    }

}


public function executeAjax_mostrar_tree(sfWebRequest $request)
{

   
    
    $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    $id_tree  = $request->getParameter('tree');
    if($user!=null){
        $criterio = new Criteria();
        $criterio->add(TreeScPeer::USER_ID,$user->getId());
        $criterio->add(TreeScPeer::PRODUCCION,'%production%',Criteria::LIKE);
        $criterio->add(TreeScPeer::ID,$id_tree);
        $tree = TreeScPeer::doSelectOne($criterio);
        $criterio->clear();
        if(is_object($tree)){
            $criterio->add(IndicatorsScPeer::TREE_ID,$tree->getId());
            $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);      
            $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
            $list_indicadores = IndicatorsScPeer::doSelect($criterio);
            $this->lista_indicadores = $list_indicadores;            
            $this->tree = $tree;

            /* con esto obtengo la fecha de proyeccion actual 
            */
            $criteria = new Criteria();
            $criteria->add(IndicatorsScPeer::TREE_ID,$tree->getId());
            $criteria->addJoin(IndicatorsScPeer::ID, DataIndicadoresPeer::INDICADOR_ID);
            $criteria->addDescendingOrderByColumn(DataIndicadoresPeer::CREATE_AT);       
            $proyeccion = DataIndicadoresPeer::doSelectOne($criteria);
            $this->fechaProyeccion   = $proyeccion->getCreateAt();
           
        }else{
            return sfView::ERROR;
        }

        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }

}


public function executeAjax_mostrar_indicators(sfWebRequest $request)
{

    $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    $id_indicators = $request->getParameter('indicators_id');
    if($user!=null){
        //busco el la cabecera desde donde se armara el arbol
        $criterio = new Criteria();
        $criterio->add(IndicatorsScPeer::ID,$id_indicators);
        $obj_indicators = IndicatorsScPeer::doSelectOne($criterio);

        $id_tree = $obj_indicators->getTreeId(); // saco el id del arbol
        $id_indicators = $obj_indicators->getId(); //saco el id del indicador
        $criterio->clear();
        $criterio->add(IndicatorsScPeer::TREE_ID,$id_tree );
        $list_indicators_by_tree = IndicatorsScPeer::doSelect($criterio); // obtengo la lista de indicadores por arbol
        $criterio->clear();

        //obtengo el arbol
        $criterio->add(TreeScPeer::ID,$id_tree );
        $tree = TreeScPeer::doSelectOne($criterio);
        $criterio->clear();
        //realizo el metodo

        $this->tree = $tree;
        $criterio->add(IndicatorsScPeer::TREE_ID,$tree->getId());
        $criterio->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
        $criterio->addAscendingOrderByColumn(IndicatorsScPeer::PREVIOUS_ID);
        $list_indicadores = IndicatorsScPeer::doSelect($criterio);
        $this->lista_indicadores = $list_indicadores;
        //variables
        $cont=0;
        $indice;
        $recurso = new practil_lib();
        $array = array();
        $array_general = array();
        //recorro la lista de los indicadores
        foreach($list_indicadores as $obj){
            if($cont==0) $indice = $id_indicators;

            if($obj->getPreviousId() == $indice){
                //obtengo el codigo del previuos
            $array_general[] = $obj->getId();
            }

        }
       // $array = $recurso->add_ids_indicators_to_array($array_general, $array);

       $flat = true;
      while($flat){

                foreach($list_indicadores as $obj2){
                 for($j=0;$j<count($array_general);$j++){
                      $indice =$array_general[$j];
                      print_r($obj2->getPreviousId());
                       if($obj2->getPreviousId() == $indice){
                //obtengo el codigo del previuos
                           print_r("entro");
                         $array_general[] = $obj->getId();
                            }

                   }

                }
               $flat = false;
      }

        print_r("salio");

        $this->arreglo = $array_general;

        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }

}



//este metodo retorna los nodos hijos de un indicador
private function return_array_children($id){

    $indicadorBean= IndicatorsScPeer::retrieveByPK($id);

    if(is_object($indicadorBean)){
       $criterio_indicadores = new Criteria();
       $criterio_indicadores->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
       $criterio_indicadores->add(IndicatorsScPeer::PARENTS,'%p'.$indicadorBean->getId().'s%',Criteria::LIKE);
       $lista_indicadores = IndicatorsScPeer::doSelect($criterio_indicadores);
       if(count($lista_indicadores)>0){
            return $lista_indicadores;
       }else{
            return null;
       }
    }
    else{
        return null;
    }
}

//este metodo envia una respuesta si encuentra un id en una lista
private function validate_exist($list,$id){
    //si ecuentra el id en la lista retorno FALSE
    //si no se ecuentra en la lista return TRUE(significa que lo voy agregar)
   if($list!=null){
          if(count($list)>0){
               foreach ($list as $obj):
                           if($obj[0]==$id){
                                return false;
                           }
               endforeach;
           }
   }


   return true;
}



}
