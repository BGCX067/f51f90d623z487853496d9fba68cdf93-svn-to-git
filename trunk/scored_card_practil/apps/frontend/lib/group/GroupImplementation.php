<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupImplementation
 *
 * @author USUARIO
 */
class GroupImplementation implements GroupInterface {

    public function listContactGroup($value,$type="id")
    {
            $criteria = new Criteria();
            $criteria->add(GrupoTrabajoScPeer::FLAG, 1);
        
        if($type=="id")
        {
            $criteria->add(GrupoTrabajoScPeer::ID, $value);
        }
        else
        {
            $criteria->add(GrupoTrabajoScPeer::NAME,'%'.$value.'%',Criteria::LIKE);
        }
            $criteria->addJoin(GrupoTrabajoScPeer::ID, DetalleGrupoTrabajoScPeer::GRUPO_ID);
            $lista  = DetalleGrupoTrabajoScPeer::doSelect($criteria);
            return array("success"=>true,"object"=>$lista,"message"=>"succes!");

    }


}
?>
