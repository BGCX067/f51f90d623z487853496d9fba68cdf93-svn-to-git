<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreeValidator
 *
 * @author USUARIO
 */
class TreeValidator {

    
     public function TreeExists($value = null , $type_search="name")
     {

            if($value!=null)
            {
                //$criterio_busqueda = new Criteria();
                if($type_search=="id")
                {                  
                   $tree = TreeScPeer::retrieveByPK($value);
                   if(is_object($tree))
                   {
                      return array("success"=>true,"message" =>"{TreeExists}-success" , "object" => $tree);
                   }
                   else
                   {
                      return array("success"=>false,"message" =>"{TreeExists}-objeto no encontrado");
                   }
                }
                else
                {
                    return array("success"=>false,"message" =>"{TreeExists}-parametro invalido!");
                }
            }
            else
            {
                return array("success"=>false,"message" =>"{TreeExists}-parametro invalido");
            }

    }


    public function haveChildren($treeBean = null)
    {
            if($treeBean!=null && is_object($treeBean))
            {
                   $criterio_busqueda = new Criteria();
                   $criterio_busqueda->add(IndicatorsScPeer::TREE_ID, $treeBean->getId());
                   $criterio_busqueda->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                   $listIndicator    = IndicatorsScPeer::doSelect($criterio_busqueda);
                   $countIndicator   = IndicatorsScPeer::doCount ($criterio_busqueda);
                   if($countIndicator>0)
                   {
                      return array("success"=>true,"message" =>"{haveChildren}-success" , "object" => $listIndicator);
                   }
                   else
                   {
                      return array("success"=>false,"message" =>"{haveChildren}-objeto no encontrado");
                   }
            }
            else
            {
                return array("success"=>false,"message" =>"{haveChildren}-parametro invalido");
            }

    }

    
}
?>
