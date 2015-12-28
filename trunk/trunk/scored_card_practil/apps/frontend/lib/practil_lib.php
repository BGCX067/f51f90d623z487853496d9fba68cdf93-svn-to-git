<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of practil_lib
 *
 * @author USUARIO
 *
 * VERSION: 1.0
 */
class practil_lib {

public function url_practil_registrar_user($nombre,$apellido,$password,$email,$tipo_registro){
              
      $servicio_practil = sfConfig::get('app_url_practil').$this->return_module_aplication('json').'registrar?';
      $servicio_practil = $servicio_practil.'nombre='.$nombre.'&';
      $servicio_practil = $servicio_practil.'apellido='.$apellido.'&';
      $servicio_practil = $servicio_practil.'password='.$password.'&';
      $servicio_practil = $servicio_practil.'email='.$email.'&';
      $servicio_practil = $servicio_practil.'plataforma='.$this->return_pk_plataforma().'&';
      $servicio_practil = $servicio_practil.'tipo_registro='.$tipo_registro.'&';
      $servicio_practil = $servicio_practil.'token='.$this->return_token_aplication();
      return $servicio_practil;
}

public function url_practil_confirmation_account($email,$token_acount){
      $servicio_practil = sfConfig::get('app_url_practil').$this->return_module_aplication('json').'account_confirmation?';
      $servicio_practil = $servicio_practil.'email='.$email.'&';
      $servicio_practil = $servicio_practil.'token_account='.$token_acount.'&';
      $servicio_practil = $servicio_practil.'token_platform='.$this->return_token_aplication();
      return $servicio_practil;
}

public function url_practil_login($email,$password){
      $servicio_practil = sfConfig::get('app_url_practil').$this->return_module_aplication('json').'login?';
      $servicio_practil = $servicio_practil.'email='.$email.'&';
      $servicio_practil = $servicio_practil.'password='.md5($password).'&';
      $servicio_practil = $servicio_practil.'plataforma='.$this->return_pk_plataforma().'&';
      $servicio_practil = $servicio_practil.'token_platform='.$this->return_token_aplication();
      return $servicio_practil;
}


public function url_practil_associate_account($email){
      $servicio_practil = sfConfig::get('app_url_practil').$this->return_module_aplication('json').'asociar_plataforma?';
      $servicio_practil = $servicio_practil.'email='.$email.'&';
      $servicio_practil = $servicio_practil.'plataforma='.$this->return_pk_plataforma().'&';
      $servicio_practil = $servicio_practil.'token='.$this->return_token_aplication();
      return $servicio_practil;
}



private function return_api_key(){
   return md5('scoredcard');
}

private function return_token_aplication(){
   return md5('esferadigital');
}

private function return_pk_plataforma(){return '4';}

private function return_module_aplication($parameter){
    if(strtolower(trim($parameter))=="xml")
        return sfConfig::get('app_module_user_xml');
    else if(strtolower(trim($parameter))=="json")
        return sfConfig::get('app_module_user_json');
    else return null;    
}

public function return_user_id($profile = null){
    if($profile!=null){
         $criterio_busqueda_profile = new Criteria();
         $criterio_busqueda_profile->add(UserScPeer::PROFILE,$profile);
         $user = UserScPeer::doSelectOne($criterio_busqueda_profile);
         if(is_object($user)) return $user;
         else return null;
    }else{    return null; }
    
}

public function exist_contact_list($list,$email){
   $resp = false;
   $list_return = array();
   if(count($list)>0){
         $vEmail = new sfValidatorEmail(array('required'=>true));
         for ($i = 0; $i < count($list); $i++){
              try{
              $vEmail->clean(strtolower(trim($list[$i])));
              if(strtolower(trim($list[$i]))==$email){
                $resp = true;                
              }else{
                $list_return[]=strtolower(trim($list[$i]));
              }
              }catch(sfValidatorError $exc){}
         }   
       return array('success'=>$resp,'list'=>$list_return);
   }else{
       return array('success'=>$resp,'list'=>$list_return);
   }
}


public function validate_token_invitation($token,$email){

  /*   $criterio_ivitaciones = new Criteria();
     $criterio_ivitaciones->add(ContatunityInvitationTokenPeer::J_ARRAY_INFORMATION,'%'.$email.'%',Criteria::LIKE);
     $list_invitation = ContatunityInvitationTokenPeer::doSelect($criterio_ivitaciones);


     $rpt = false;
     foreach($list_invitation as $rows){
               $list = json_decode($rows->getJArrayInformation());
                  foreach ($list->{'invitation'} as $row){
                              if($row->{'email'}==$email){
                                         $fecha_registro = new DateTime($row->{'creat_at'});
                                         $fecha_registro =$fecha_registro->format('Y-m-d');
                                         $fecha_registro = date($fecha_registro);
                                         $fecha_actual = mktime(0,0,0,date('m'),date("d")-7,date('Y'));
                                         $fecha_actual = date('Y-m-d',$fecha_actual);
                                          if($fecha_registro>=$fecha_actual){                                             
                                              if($row->{'token'}==$token){
                                                  if($row->{'flag'}=='enabled'){
                                                       $rpt = true;
                                                       //aca falta cambiar el estado del token a
                                                       //   => disabled
                                                  }                                                 
                                               }
                                           }
                                }
                  }
       }
     return $rpt;
*/
}

public function add_ids_indicators_to_array($arreglo_ids,$arreglo){

    for($i=0;$i<count($arreglo_ids);$i++){

        $arreglo[] = $arreglo_ids[$i];
        
    }

    return $arreglo;
    

}
/////*********************************** REPORTS *********************************////////
public function return_name_indicators_by_id($id){

    $indicators = IndicatorsScPeer::retrieveByPK($id);
    if($indicators > 0){
        return $indicators->getName();
    }else{
        return "Desconocido";
    }
}
}
?>
