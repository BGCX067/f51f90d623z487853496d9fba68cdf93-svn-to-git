<?php


class userActions extends sfActions
{

public function executeIndex(sfWebRequest $request)
{   
}


public function executeConfirm(sfWebRequest $request)
{

}

/* 26 mayo 2011
* La funcion que cumple Register_user es registrar al usuario
* en primera estancia (con datos basicos) se le envia un email
* de confirmacion para que active su cuenta,pero pordra ingresar
* sin necesidad de este por un periodo de 15 dias (esto se verificara en el login)
* Con esto el usuario podra realizar diferentes acciones en la agenda..pero
* no todas ya que tendra que acabar el registro de su informacion para poder usar
* todos los recursos permitdos de contactunity a los usuarios Free.
* Accion usado en el modulo:
* -inicio/index (submit)*/

/*Estado del usuario
* 1=recien ingresado (valido por 15 dias)
* 2=cuenta activada2
* 88=dado de baja
*/
public function executeRegister_user(sfWebRequest $request)
{
    $email            = $request->getParameter('txtEmail');
    $firt_name        = $request->getParameter('txtNombre');
    $last_name        = $request->getParameter('txtApellidos');
    $password         = $request->getParameter('txtPassword');
    $password_repeat  = $request->getParameter('txt-password-repeat');
    //validaciones respectivas
    $vEmail = new sfValidatorEmail(array('required'=>true));
    $vString= new sfValidatorString(array('required'=>true));
    try{$vEmail->clean(strtolower(trim($email)));}
    catch(sfValidatorError $exc){return sfView::ERROR;} 
    try{$vString->clean(strtolower(trim($firt_name)));}
    catch(sfValidatorError $exc){return sfView::ERROR;}
    try{$vString->clean(strtolower(trim($last_name)));}
    catch(sfValidatorError $exc){return sfView::ERROR;}
    if($password!=$password_repeat){return sfView::ERROR;}
    /*convierto los espacios en blanco en + para que no suceda
     * algun error al usar el web-service   */
    $email     = str_replace(' ', '+', $email);
    $firt_name = str_replace(' ', '+', $firt_name);
    $last_name = str_replace(' ', '+', $last_name);

      
       try{
           $conection = Propel::getConnection();
           $conection->beginTransaction();
           $new_user = new UserSc();
           $new_user->setEmail($email);
           $new_user->setPassword($password);
           $new_user->setFlag('1');
           $new_user->save();
           //procedo a registrar al usuario en practil
            $lib = new practil_lib();
            $url = $lib->url_practil_registrar_user($firt_name,$last_name,md5($password),$email,'1');
            //si la url se forma correctamente
            if($url!=null){
                 $respuesta_registrar = file_get_contents($url);
                 $decode = json_decode($respuesta_registrar);
                 $codigo_respuesta = $decode->{'success'};
                 //si el registro en practil es correcto
                 if($codigo_respuesta){
                    $new_user->setProfile($decode->{'accountpk'});
                    $new_user->save();
                    
                    $conection->commit();
                    $this->send_mail_scoredcard($decode->{'stoken'},$new_user->getEmail());
                    return sfView::SUCCESS;
                 }else{
                    if($decode->{'code'} =="p-10003"){
                          $respt =  array('firtname'=>$firt_name,'lastname'=>$last_name,'email'=>$email,'password'=>$password,'message' =>'el e-mail ya se encuentra registrado!');
                          $message_sign_in = $this->getUser()->setAttribute('message_sign_in',$respt);
                          $conection->rollBack();
                          $this->redirect('@homepage');
                    }else if($decode->{'code'} =="p-20009"){
                          $respt =  array('firtname'=>$firt_name,'lastname'=>$last_name,'email'=>$email,'password'=>$password,'message' =>'el e-mail ya se encuentra asociado a una cuenta!');
                          $message_sign_in = $this->getUser()->setAttribute('message_sign_in',$respt);
                          $conection->rollBack();
                          $this->redirect('@homepage');
                    }else{
                         $this->message = 'error en practil--'.$url.'--';
                         $conection->rollBack();
                         return sfView::ERROR;
                    }
                 }
            }else{
                $conection->rollBack();
                $this->message = 'error en url';
                return sfView::ERROR;
             }            
       }catch (Exception $e){
           $conection->rollBack();
           $this->message = 'error en try';
           return sfView::ERROR;
       }
       
        
   
}

                        
public function executeAsociate_account(sfWebRequest $request){

    $token = $request->getParameter('token-account');
    $pk_practil = $this->getUser()->getAttribute('s_pk_practil_associate_account',null);
    $email = $request->getParameter('email-account');
    
    if($token == md5('p-10004')){
       if($pk_practil!=null){
           $lib = new practil_lib();
           $url= $lib->url_practil_associate_account($email);
           $respuesta_servicio = file_get_contents($url);
           $decode = json_decode($respuesta_servicio);
               if($decode->{'success'}){
                       $new_user = new UserSc();
                       $new_user->setEmail($email);
                       $new_user->setPassword('practil');
                       $new_user->setFlag('1');
                       $new_user->setProfile($decode->{'accountpk'});
                       $new_user->save();
                       return sfView::SUCCESS;
               }else{
                    $this->getUser()->setAttribute('s_pk_practil_associate_account',null);
                    return sfView::ERROR;
               }
           
       }else{
        $this->getUser()->setAttribute('s_pk_practil_associate_account',null);
        return sfView::ERROR;
       }
    }else{
       $this->getUser()->setAttribute('s_pk_practil_associate_account',null);
       return sfView::ERROR;
    }
}


private function send_mail_scoredcard($token,$email){
      try{           
           $message = $this->getMailer()->compose();
           $message->setSubject('Confirmacion de Cuenta Practil');
           $message->setTo($email);
           $message->setFrom(array('cquevedo@esfera.pe' => 'Practil'));
           $html = $this->getPartial('send_email/send_new_user', array(
           'uri'=>sfConfig::get('app_url_scorecard').'confirmation?token='.$token.'&email='.$email
           ));
           $message->setBody($html, 'text/html');
           $this->getMailer()->send($message);
           return true;
       }catch (Exception $e){
           return false;
       }
}







  
}
