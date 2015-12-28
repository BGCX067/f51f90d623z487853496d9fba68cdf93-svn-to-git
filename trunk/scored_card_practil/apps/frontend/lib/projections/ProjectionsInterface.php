<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author USUARIO
 */
interface ProjectionsInterface {

    public function generateData($treeId);
    public function generateDataIndicadorOnline($treeId,$indicador);
    public function returnValueProjection($idicatorId,$fecha);
}
?>
