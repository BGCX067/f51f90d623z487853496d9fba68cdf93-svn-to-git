<?php

    $array = array(
            "success" => true,
            "pk" => $id,
            "name" => $title,
            "production" => $production,
        );
        echo json_encode($array);
?>
