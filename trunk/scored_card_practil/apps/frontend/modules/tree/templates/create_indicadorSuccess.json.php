<?php
echo  json_encode(array(
                   "success" =>  true,
                   "indicatorpk" =>  $indicator,
                   "title" =>  $title,                  
                   "lastNode"    => $lastNode,
		   "message"	=> $message
   ));
?>  