
<?php

$data = '{"columnas":[{"name":"nombre1","type":"string"},{"name":"'.$indicator->getTitulo().'","type":"number"}],"size":[{"cantidad":'.count($object_rows).'}],"cell_data_v":[';
$json_v = '';
$contador =1;
$cantidad = count($object_rows);

foreach($object_rows  as $obj){
    if($contador==$cantidad){
        $json_v =$json_v.'{"id":'.$obj->getId().',"value":"'.$obj->getUpdateAt().'"}';
    }else{
         $json_v =$json_v.'{"id":'.$obj->getId().',"value":"'.$obj->getUpdateAt().'"},';
    }
     $contador++;
}
$json_v = $json_v.'],';

$json_h = '"cell_data_h":[';

$contador =1;
foreach($object_rows  as $row){
    if($contador==$cantidad){
         $json_h =$json_h.'{"id":'.$row->getId().',"value":'.$row->getData().'}';
    }else{
         $json_h =$json_h.'{"id":'.$row->getId().',"value":'.$row->getData().'},';
    }
    $contador++;
}
$json_h = $json_h.']}';
$data = $data.$json_v.$json_h;
echo $data;

?>



