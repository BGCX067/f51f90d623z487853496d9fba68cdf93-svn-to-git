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


      $message_sign_in   = $this->getUser()->getAttribute('message_sign_in',null);
      if($message_sign_in!=null){
          $this->arraySucces = $message_sign_in;
          $this->success = true;
      }else{
          $this->arraySucces = null;
          $this->success = false;
      }
      $this->getUser()->getAttributeHolder()->remove('message_sign_in');
      /**************************************************************************/


      $this->token =  $this->getUser()->getAttribute('s_tokenSignIn',"null");
      $this->email =  $this->getUser()->getAttribute('s_userMailUrlSignIn','null');
      /**************************************************************************/
      $this->getUser()->setAttribute('s_tokenSignIn',"null");
      $this->getUser()->setAttribute('s_userMailUrlSignIn','null');

 
      
      return sfView::SUCCESS;
 
    
  }
}
