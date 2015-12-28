<?php

/**
 * sign_in actions.
 *
 * @package    practil_scorecard
 * @subpackage sign_in
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sign_inActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
public function executeIndex(sfWebRequest $request)
{
 
}

public function executeLog_in(sfWebRequest $request)
{

      $user           = $request->getParameter('txtUsuarioLogin');
      $password       = $request->getParameter('txtPasswordLogin');

      $lib = new practil_lib();
      $url = $lib->url_practil_login($user, $password);

      $respuesta_login = file_get_contents($url);
      $decode = json_decode($respuesta_login);
      $this->getUser()->setAttribute('s_pk_practil_associate_account',null);

      if($decode->{'success'}){
            $criteria = new Criteria();
            $criteria->add(UserScPeer::PROFILE,$decode->{'pkaccount'});
            $current_user = UserScPeer::doSelectOne($criteria);
            if(is_object($current_user)){
                    $this->getUser()->setAuthenticated(true);
                    $this->getUser()->setAttribute(sfConfig::get('app_session_current_user'),$current_user);
                    $this->getUser()->setAttribute(sfConfig::get('app_session_current_user_name'),$decode->{'name'});
                    return $this->redirect('@homepage');
            }else{
                    return $this->redirect('@homepage');
            }
      }else{
          if($decode->{'code'}=="p-10004"){
            $this->token = md5($decode->{'code'});
            $this->user = $user;
            $this->getUser()->setAttribute('s_pk_practil_associate_account',$decode->{'tokenpk'});
            return 'Practil';
          }else{
             return $this->redirect('@homepage');
          }
      }
   
}


public function executeLog_out(sfWebRequest $request)
{
          $this->getUser()->setAuthenticated(false);
          $this->getUser()->getAttributeHolder()->clear();
          return $this->redirect('@homepage');
}




  
}
