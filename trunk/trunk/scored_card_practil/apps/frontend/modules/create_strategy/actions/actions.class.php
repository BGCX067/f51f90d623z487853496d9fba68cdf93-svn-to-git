<?php

/**
 * create_strategy actions.
 *
 * @package    practil_scorecard
 * @subpackage create_strategy
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class create_strategyActions extends sfActions
{

public function executeIndex(sfWebRequest $request)
{
    
    $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
  
    if($user!=null){
        $criterio = new Criteria();
        $criterio->add(GrupoTrabajoScPeer::OWNER_ID,$user->getId());
        $list_grupos = GrupoTrabajoScPeer::doSelect($criterio);
        $criterio->clear();
        $criterio->add(PeriodoScPeer::FLAG,'%activo%',Criteria::LIKE);
        $list_periodo = PeriodoScPeer::doSelect($criterio);
        $this->lista_grupos = $list_grupos;
        $this->lista_periodos = $list_periodo;
    }else{
        return sfView::ERROR;
    }

}

  
}
