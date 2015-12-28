<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectionsService
 *
 * @author USUARIO
 */
class ProjectionsService
{
    
     public function generateData($treeId)
     {
          $servicio = new ProjectionsImplementation();
          return  $servicio->generateData($treeId);
     }
     public function generateDataIndicadorOnline($treeId,$indicador)
     {
         $servicio = new ProjectionsImplementation();
         return  $servicio->generateDataIndicadorOnline($treeId, $indicador);
     }

     public function returnValueProjection($idicatorId,$fecha)
     {
         $servicio = new ProjectionsImplementation();
         return  $servicio->returnValueProjection($idicatorId, $fecha);
     }


}
?>
