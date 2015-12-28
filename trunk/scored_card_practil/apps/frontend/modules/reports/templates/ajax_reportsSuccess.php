<?php $my_lib = new my_lib(); ?>
<script type="text/javascript">
    


  var option_tree = {
        "treepk":'<?php echo 't-'.$tree->getId() ?>',
        "title":'<?php echo $tree->getName() ?>'
    }
     var data_indicador = '';
     var option_indicador = '';

$(document).ready(function(){

$("#ui-widget-overlay").css("width",screen.width);
$("#ui-widget-overlay").css("height",screen.height);
<?php if($tree->getProduccion()=='production'): ?>
    $("#ui-widget-overlay").show();
    $("#message-mirror-start-tree").show();
<?php endif; ?>

createTreeReports(option_tree);
$(_ohidden.oidtree).val(option_tree.treepk);

<?php foreach ($lista_indicadores as $row): ?>

<?php if($row->getUltimoNodo()!=""){ $lastNode= true;}else{$lastNode= false; } ?>

<?php
$rpt = $my_lib->assessNode($row->getId());
if($rpt['resp'] ){
      $color = '#CCFFEE';
}else{
      $color = '#BCCCFF';
}
?>
    data_indicador = {
        "indicatorpk":<?php echo $row->getId() ?>,
        "title":'<?php echo $row->getTitulo() ?>',
        "value_min":'<?php echo $row->getValorMinimo() ?>',
        "value_dese":'<?php echo $row->getValorDeseado() ?>',
        "value_opti":'<?php echo $row->getValorOptimo() ?>',
        "lastNode":'<?php echo $lastNode ?>',
        "color":'<?php echo $color ?>'
    }

     <?php if($row->getPreviousId()!=0): ?>
          option_indicador = {"previous":<?php echo $row->getPreviousId() ?>}
     <?php else :?>
          option_indicador = {"previous":'<?php echo 't-'.$tree->getId() ?>'}
     <?php endif;?>

    createindicadorReports(data_indicador,option_indicador);

<?php endforeach ; ?>
});



</script>


<div class="body-tree" style="border: 1px solid #000003;" >
    <div id="tree-master3" style="width: auto;"> </div>
</div>

