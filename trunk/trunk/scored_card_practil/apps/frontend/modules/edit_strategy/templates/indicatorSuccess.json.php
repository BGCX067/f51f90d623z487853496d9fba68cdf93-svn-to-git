<?php
if($indicador->getUltimoNodo()!=""){ $lastNode= true;}else{$lastNode= false; }
  
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
                   "type"       => 'POST',
                   "url"        => url_for('edit_strategy/return_nodes_childrens')
   ));
?>