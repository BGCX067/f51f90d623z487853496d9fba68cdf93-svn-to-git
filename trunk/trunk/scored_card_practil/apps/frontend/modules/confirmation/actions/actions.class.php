<?php

/**
 * confirmacion actions.
 *
 * @package    aceptor
 * @subpackage confirmacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class confirmationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
public function executeIndex(sfWebRequest $request)
{   

    $email          = $request->getParameter('email');
    $token_acount   = $request->getParameter('token');

    $lib = new practil_lib();
    $url = $lib->url_practil_confirmation_account($email, $token_acount);
    $respuesta = file_get_contents($url);
    $decode = json_decode($respuesta);   
    $codigo_respuesta = $decode->{'code'};

    if($codigo_respuesta=="j-1003"){
         $this->getUser()->setAttribute('ses_confirmacion',true);
         $this->redirect('confirmation/response?email='.$email);
    }else{
         $this->getUser()->setAttribute('ses_confirmacion',false);
         $this->redirect('confirmation/response?email='.$email);
    }

}


public function executeResponse(sfWebRequest $request){
   $email = $request->getParameter('email');
   $this->email = $email;
   $respuesta =  $this->getUser()->getAttribute('ses_confirmacion',false);
   if($respuesta){
       $this->getUser()->getAttributeHolder()->remove('ses_confirmacion');
       return sfView::SUCCESS;
   }else{
       $this->getUser()->getAttributeHolder()->remove('ses_confirmacion');
       return sfView::ERROR;
   }
}



public function executeConfirmation_group(sfWebRequest $request){
    
    $user           = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    $email          = $request->getParameter('email');
    $token          = $request->getParameter('token');
    $grupo_id       = $request->getParameter('group_id');

    if($user!=null){
        $criterio_busqueda = new Criteria();
        $criterio_busqueda->add(SolicitudGrupoTrabajoScPeer::EMAIL,'%'.$email.'%',Criteria::LIKE);
        $criterio_busqueda->add(SolicitudGrupoTrabajoScPeer::TOKEN,$token);
        $criterio_busqueda->add(SolicitudGrupoTrabajoScPeer::GRUPO_ID,$grupo_id);   
        $solicitud  = SolicitudGrupoTrabajoScPeer::doSelectOne($criterio_busqueda);
     
        //si no encuentra la solicitud con el token correcto
        if(is_object($solicitud)){
            //en esta parte verifico si el token ya vencio
            $respuesta = json_decode($solicitud->getFlag());
            if($respuesta->{'estado'}){
                $this->redirect('@list_working_groups');
            }else{
                return sfView::ERROR;
            }
        }else{              
               return sfView::ERROR;
        }

    }else{
        $this->redirect('@homepage');
    }



}







}
