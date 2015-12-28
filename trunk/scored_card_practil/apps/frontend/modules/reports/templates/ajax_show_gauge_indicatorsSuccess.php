<?php
if($valor_porcentaje>100){
    $valor_porcentaje = 100;
}
echo $json = '{"porcentaje": '.$valor_porcentaje.',"nombre": "'.$nombre.'"}';

?>