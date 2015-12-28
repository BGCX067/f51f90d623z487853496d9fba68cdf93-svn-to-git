<?php

echo  json_encode(array(
                   "success" =>  true,
                   "treeId"   => $tree->getId(),
		   "title"       => $tree->getName(),
		   "description" => $tree->getDescripcion(),
		   "vmin"        => $tree->getValorMinimo(),
		   "vmax"        => $tree->getValorDeseado(),
		   "responsable" => $tree->getResponsableId(),
                   "email"       => $tree->getEmailResponsable(),
                   "type"        => 'POST',
                   "url"         => url_for('edit_strategy/return_nodes_childrens_master')
   ));
?>