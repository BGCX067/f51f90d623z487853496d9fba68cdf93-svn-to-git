<script type="text/javascript">

    var option_tree = {
        "treepk":'<?php echo 't-'.$tree->getId() ?>',
        "title":'<?php echo $tree->getName() ?>'
    }
     var data_indicador = '';
     var option_indicador = '';

$(document).ready(function(){
createTree2(option_tree);
//seteo el pk
$(_ohidden.oidtree).val(option_tree.treepk);

<?php foreach ($lista_indicadores as $row): ?>
<?php if($row->getUltimoNodo()!=""){ $lastNode= true;}else{$lastNode= false; } ?>
    data_indicador = {
        "indicatorpk":<?php echo $row->getId() ?>,
        "title":'<?php echo $row->getTitulo() ?>',
        "value_min":'<?php echo $row->getValorMinimo() ?>',
        "value_dese":'<?php echo $row->getValorDeseado() ?>',
        "value_opti":'<?php echo $row->getValorOptimo() ?>',
        "lastNode":'<?php echo $lastNode ?>'
    }
     <?php if($row->getPreviousId()!=0): ?>
          option_indicador = {"previous":<?php echo $row->getPreviousId() ?>}
     <?php else :?>
          option_indicador = {"previous":'<?php echo 't-'.$tree->getId() ?>'}
     <?php endif;?>

   createindicador2(data_indicador,option_indicador);

<?php endforeach ; ?>
});


</script>
    
    <div class="body-tree" style="border: 1px solid #000003;" >
    <div id="tree-master2" style="width: auto;">


    </div>
    </div>
<?php

 for($i=0; $i<count($arreglo);$i++){
     echo $arreglo[$i];
 }
?>
   