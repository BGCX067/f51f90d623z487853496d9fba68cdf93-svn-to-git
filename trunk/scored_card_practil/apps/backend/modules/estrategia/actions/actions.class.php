<?php

/**
 * estrategia actions.
 *
 * @package    practil_scorecard
 * @subpackage estrategia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estrategiaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

      $this->listTree = TreeScPeer::doSelect(new Criteria());

  }

  public function executeEliminarEstrategia(sfWebRequest $request)
  {

      //el id de la estrategia(arbol)
      $idEstrategia = $request->getParameter('idTree');
      //1 eliminamos las asignaciones
      $this->fn_EliminarAsignaciones($idEstrategia);
      //2 eliminamos los indicadores
      $this->fn_EliminarIndicadores($idEstrategia);
      //3 eliminamos las relaciones entre el usuario y la estrategia
      $this->fn_EliminarTreeUser($idEstrategia);
      //4 eliminamos group_data_indicadores
      $this->fn_EliminarGroupDataIndicadores($idEstrategia);
      //5 eliminamos la estrategia
      $this->fn_EliminarTree($idEstrategia);
      $this->redirect('estrategia/index');

  }

  private function fn_EliminarAsignaciones($treeId)
  {
      $criteria = new Criteria();
      $criteria->add(AsignacionScPeer::TREE_ID, $treeId);
      AsignacionScPeer::doDelete($criteria);
  }

  private function fn_EliminarIndicadores($treeId)
  {
      /*Para eliminar indicadores por cada indicador*/
      $criteria = new Criteria();
      $criteria->add(IndicatorsScPeer::TREE_ID, $treeId);
      $listaIndicadores = IndicatorsScPeer::doSelect($criteria);
      if(count($listaIndicadores)>0)
      {
          foreach($listaIndicadores as $indicador)
          {
              //hay que buscar la dataIndicadores y eliminarlas
              $criteriaDataIndicadores = new Criteria();
              $criteriaDataIndicadores->add(DataIndicadoresPeer::INDICADOR_ID,$indicador->getId());
              DataIndicadoresPeer::doDelete($criteriaDataIndicadores);

              //hay que buscar las proyecciones y eliminarlas
              $criteriaProyecciones = new Criteria();
              $criteriaProyecciones->add(ProjectionsIndicatorsCsPeer::INDICADOR_ID,$indicador->getId());
              ProjectionsIndicatorsCsPeer::doDelete($criteriaProyecciones);

          }
              //acabado la eliminacion se procede a eliminar los indicadores
              IndicatorsScPeer::doDelete($criteria);
      }
  }

  private function fn_EliminarTreeUser($treeId)
  {
      $criteria = new Criteria();
      $criteria->add(TreeUserPeer::TREE_ID, $treeId);
      TreeUserPeer::doDelete($criteria);
  }

  private function fn_EliminarGroupDataIndicadores($treeId)
  {
      $criteria = new Criteria();
      $criteria->add(GroupDataIndicadoresPeer::TREE_ID, $treeId);
      GroupDataIndicadoresPeer::doDelete($criteria);
  }

  private function fn_EliminarTree($treeId)
  {
      $criteria = new Criteria();
      $criteria->add(TreeScPeer::ID, $treeId);
      TreeScPeer::doDelete($criteria);
  }

}
