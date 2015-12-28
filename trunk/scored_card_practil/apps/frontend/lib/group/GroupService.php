<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupService
 *
 * @author USUARIO
 */
class GroupService {
    
     public function listContactGroup($value,$type="id")
     {
          $servicio = new GroupImplementation();
          return  $servicio->listContactGroup($value, $type);
     }
}
?>
