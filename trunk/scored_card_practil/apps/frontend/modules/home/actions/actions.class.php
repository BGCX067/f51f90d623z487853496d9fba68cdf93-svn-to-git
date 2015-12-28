<?php

/**
 * home actions.
 *
 * @package    practil_scorecard
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{


    
public function executeIndex(sfWebRequest $request)
{
    //validacion de session
    $userBean = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    if($userBean!=null){
        /*se realizan consultas para manejar los botones de inicio*/
        /*cantidad de Estrategias activas*/
        $criteria = new Criteria();
        $criteria->add(TreeScPeer::USER_ID,1);
        $criteria->add(TreeScPeer::FLAG,1);
        $count   = TreeScPeer::doCount($criteria);
        /*cantidad de grupos activos*/
        $criteria->clear();
        $criteria->add(GrupoTrabajoScPeer::OWNER_ID,$userBean->getId());       
        $cantidadGrupos   =  GrupoTrabajoScPeer::doCount($criteria);
        $this->count      = $count;
        $this->countGroup = $cantidadGrupos;
        return sfView::SUCCESS;
    }else{
        return sfView::ERROR;
    }
 
}

public function executeAdvanced(sfWebRequest $request)
{
  
}


}
