<?php

   foreach($list_relation as $row){
            $id_array = explode('-', $row['array']);
                echo $id_array[0].'-'.$id_array[1].'<br/>';
    }
?>
