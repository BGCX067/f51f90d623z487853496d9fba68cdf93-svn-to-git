<?php

/**
 * inicio actions.
 *
 * @package    practil_scorecard
 * @subpackage inicio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inicioActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {


   $current_user= $this->getUser()->getAttribute('s_current_user');
   
   if($this->getUser()->isAuthenticated()):
       $this->redirect('home/index');
   else:
      $message_sign_in = $this->getUser()->getAttribute('message_sign_in',null);
      $this->message = $message_sign_in;
      $this->getUser()->setAttribute('message_sign_in',null);

      //aca verifico si llego desde una invitacion
      $token = $this->getUser()->getAttribute('s_token',null);
      $email = $this->getUser()->getAttribute('s_user_mail_url',"null");

       if($token!=null){
           $this->token = $token; $this->email = $email;
           $this->getUser()->setAttribute('s_token',null);
           $this->getUser()->setAttribute('s_user_mail_url',null);
       }else{
           $this->token = null;
           $this->getUser()->setAttribute('s_token',null);

       }
      return sfView::SUCCESS;
   endif;
    
  }
}
