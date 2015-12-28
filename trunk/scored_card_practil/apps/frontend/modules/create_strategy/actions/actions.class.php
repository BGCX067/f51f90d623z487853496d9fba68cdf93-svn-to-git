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
        $this->user = $user;
    }else{
        return sfView::ERROR;
    }

}

public function  executeChangeHelpOption(sfWebRequest $request)
{
      
       $paso    = $request->getParameter('paso');
       $checked = $request->getParameter('checked');
       
       $user     = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
       if($user!=null)
       {
           
           $option  =  json_decode($user->getOptions());
          
           $option->{'helpStrategy'.$paso}=$checked;
           $option  =  json_encode($option);
           $user->setOptions($option);
           $user->save();           
           $this->getUser()->setAttribute(sfConfig::get('app_session_current_user'),$user);
           return sfView::SUCCESS;
           
       }else
       {
            return sfView::ERROR;
        }
}

  
}
