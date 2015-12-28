<?php
if($indicador->getUltimoNodo()!=""){ $lastNode= true;}else{$lastNode= false; }

$array_xml_raw = $sf_data->getRaw('array_xml');
$array_options = array();
foreach ($array_xml_raw as $row){
    $array_options[] = array(
        "row" =>  $row,
    );
}
  
echo  json_encode(array(
                   "success" =>  true,
                   "indicatorid"   => $indicador->getId(),
		   "title"       => $indicador->getTitulo(),
		   "description" => $indicador->getDescripcion(),
		   "vmin"        => $indicador->getValorMinimo(),
		   "vmax"        => $indicador->getValorDeseado(),
		   "voptime"     => $indicador->getValorOptimo(),
		   "responsable" => $indicador->getResponsableId(),
                   "lastNode"    => $lastNode,
                   "email"       => $indicador->getEmailResponsable(),
                   "type"        => 'POST',
                   "url"         => url_for('edit_strategy/return_nodes_childrens'),
                   "is_connected_google_analytics" => $is_connected_google_analytics,
                   "xml" => array(
                       "options"=>$array_options
                   ),
                   "fec_ini"     =>$indicador->getGaFecIni(),
                   "fec_fin"     =>$indicador->getGaFecFin(),
                   "vactual"     =>$indicador->getValorActualEntregado(),
                   "network_id"  =>$network_id,
                   "attribute_id"  =>$attribute_id,
                   "username_in_network"  =>$indicador->getUsernameInNetwork(),
                    "det_network_attribute_id" =>$det_network_attribute_id
   ));
?>