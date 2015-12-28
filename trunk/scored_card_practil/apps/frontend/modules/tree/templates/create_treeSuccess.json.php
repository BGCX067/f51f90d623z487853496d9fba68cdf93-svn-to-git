<?php
if(is_object($group)){$groupId=$group->getId();$groupName=$group->getName();}else{$groupId="null";$groupName="null";}
echo  json_encode(array(
                   "success" =>  true,                  
                   "treepk" =>  $treepk,
                   "treeId" =>  $treeId,
                   "title" => $title,
                   "type" => $type,
                   "groupId" => $groupId,
                   "groupName" => $groupName,
		   "message"	=> $message
   ));
?>