<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dataIndicadoresImplementation
 *
 * @author USUARIO
 */
class dataIndicadoresImplementation
{

/*
 * Busco todos los grupos generados con el idTree,de acuerdo a eso genero
 * dataIndicadores todos los registros, para que no se genere problemas en el DataGrid
 */
public function addDataIndicatores($indicadorBean)
{
    $criteria = new Criteria();
    $criteria->add(GroupDataIndicadoresPeer::TREE_ID,$indicadorBean->getTreeId());
    $listGrupo = GroupDataIndicadoresPeer::doSelect($criteria);
    foreach($listGrupo as $row)
    {
        $dataIndicador = new DataIndicadores();
        $dataIndicador->setIndicadorId($indicadorBean->getId());
        $dataIndicador->setUserId($indicadorBean->getResponsableId());
        $dataIndicador->setData(0);
        $dataIndicador->setGroupData($row->getId());
        $dataIndicador->setCreateAt($row->getCreateAt());
        $dataIndicador->setUpdateAt($row->getCreateAt());
        $dataIndicador->save();
    }
     return array("success"=>true,"message"=>"exito");
}

public function changeOwnerIndicadores($indicadorBean,$responsable_id)
{
    $criteria = new Criteria();
    $criteria->add(DataIndicadoresPeer::INDICADOR_ID,$indicadorBean->getId());
    $listData = DataIndicadoresPeer::doSelect($criteria);
    foreach($listData as $row)
    {
        $row->setUserId($responsable_id);
        $row->save();
    }
    return array("success"=>true,"message"=>"exito");
}

/* este metodo recibe el
 * -id de un arbol 
 * -obtengo la lista de los que NO son ultimos nodos (sin discriminar a los eliminados)
 * -verifico con un for cada nodo, si se encuentra en la lista de dataIndicadores los elimino
 */

public function updateDataIndicadores($idTree)
{   
    
        $criterio = new Criteria();
        $criterio->add(IndicatorsScPeer::TREE_ID,$idTree);
        $criterio->add(IndicatorsScPeer::ULTIMO_NODO,1,Criteria::NOT_EQUAL);
        $listIndicadores       = IndicatorsScPeer::doSelect($criterio);
        $countListIndicadores  = IndicatorsScPeer::doCount($criterio);
        if($countListIndicadores>0)
        {
            foreach($listIndicadores as $row)
            {
                $criteria = new Criteria();
                $criteria->add(DataIndicadoresPeer::INDICADOR_ID, $row->getId());
                DataIndicadoresPeer::doDelete($criteria);
            }
        }
        return array("success"=>true,"message"=>"exito");

}

   



}
?>
