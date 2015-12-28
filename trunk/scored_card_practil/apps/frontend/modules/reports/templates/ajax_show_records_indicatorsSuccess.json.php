<?php
    $service = new ProjectionsService();
    $data      =  '{"columnas":[{"name":"'.$indicator->getTitulo().'"}],"array":[';
    $dataValue = "";
    $contador = 1;
    foreach($object_rows  as $obj)
    {
            $data = $data.'{"fecha":"'.date('d-m-Y', strtotime($obj->getUpdateAt())).'","data":';
            $response = $service->returnValueProjection($indicator->getId(), date('Y-m-d 00:00:00', strtotime($obj->getUpdateAt())) );
        
            $dataValue = ($contador == count($object_rows))?
            $obj->getData().',"vo":'.$response['vo'].',"vd":'.$response['vo'].',"vm":'.$response['vm'].'}]}' :
            $obj->getData().',"vo":'.$response['vo'].',"vd":'.$response['vo'].',"vm":'.$response['vm'].'},';
        
        $contador++;
        $data = $data.$dataValue;
    }
echo $data;
?>