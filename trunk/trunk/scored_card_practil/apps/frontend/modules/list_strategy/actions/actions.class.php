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
    $user  = $this->getUser()->getAttribute('s_current_user',null);
    if($user!=null){
        $criterio = new Criteria();
        $criterio->add(TreeScPeer::USER_ID,$user->getId());
        $criterio->add(TreeScPeer::FLAG,1);
        $list_tree = TreeScPeer::doSelect($criterio);
        $this->list = $list_tree;
        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }
  }
}
