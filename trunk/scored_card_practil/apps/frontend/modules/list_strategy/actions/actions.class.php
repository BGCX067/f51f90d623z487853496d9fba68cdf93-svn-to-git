<?php

/**
 * list_strategy actions.
 *
 * @package    practil_scorecard
 * @subpackage list_strategy
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class list_strategyActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

    $selector = $request->getParameter('select');
    $selector = ($selector=="") ? 'execution' : $selector;

    $user  = $this->getUser()->getAttribute('s_current_user',null);
    if($user!=null){

        $this->selector = $selector;

        $criterio = new Criteria();
        $criterio->add(TreeScPeer::USER_ID,$user->getId());
        $criterio->add(TreeScPeer::FLAG,1);
        $list_tree = TreeScPeer::doSelect($criterio);
        $this->list = $list_tree;


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



        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }
  }

  public function executeDelete_tree(sfWebRequest $request){

      $request->setRequestFormat('json');
      $id_tree  = $request->getParameter('treeId');
      $user     =  $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

      if($user!=null){
            $tree = TreeScPeer::retrieveByPK($id_tree);
            if(is_object($tree)){
                 //si es el dueño del arbol
                if($tree->getUserId()==$user->getId()){
                        $this->production = $tree->getProduccion();
                        $tree->setFlag(2);
                        $tree->setProduccion('not');                        
                        $tree->save();
                        $this->id   = $tree->getId();
                        $this->title = $tree->getName();                        
                        return sfView::SUCCESS;
                }else{
                    $this->message = 'owner not found';
                    return sfView::ERROR;
                }
            }else{
                $this->message = 'objet not found';
                return sfView::ERROR;
            }
      }else{
          $this->message= 'session expird';
          return sfView::ERROR;
      }


  }
  
    public function executeUndo_tree_ajax(sfWebRequest $request){

      $request->setRequestFormat('json');
      $id_tree     = $request->getParameter('treeId');
      $production  = $request->getParameter('production');
       
      $user     =  $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

      if($user!=null){
            $tree = TreeScPeer::retrieveByPK($id_tree);
            if(is_object($tree)){
                 //si es el dueño del arbol
                if($tree->getUserId()==$user->getId()){
                        $tree->setFlag(1);
                        if($production=='production'){
                             $tree->setProduccion('production');
                        }                        
                        $tree->save();              
                        return sfView::SUCCESS;
                }else{
                    $this->message = 'owner not found';
                    return sfView::ERROR;
                }
            }else{
                $this->message = 'objet not found';
                return sfView::ERROR;
            }
      }else{
          $this->message= 'session expird';
          return sfView::ERROR;
      }


  }



}
