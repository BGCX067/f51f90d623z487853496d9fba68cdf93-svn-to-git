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

    $user  = $this->getUser()->getAttribute('s_current_user',null);

    if($user!=null){
        try{
            $conn = Propel::getConnection();
            $conn->beginTransaction();
            $tree_bean = new TreeSc();
            $tree_bean->setName($title);
            $tree_bean->setUserId($user->getId());
            $tree_bean->setConfigureFlag('');
            $tree_bean->setConfigureDesign('');
            $tree_bean->setFlag(1);
            $tree_bean->save();

            $tree_user_bean = new TreeUser();
            $tree_user_bean->setUserId($tree_bean->getUserId());
            $tree_user_bean->setTreeId($tree_bean->getId());
            $tree_user_bean->save();
            
            $conn->commit();
            $this->message = 'success';
            $this->treepk  = $tree_bean->getId();
            $this->title   =  $tree_bean->getName();
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
    
}



}
