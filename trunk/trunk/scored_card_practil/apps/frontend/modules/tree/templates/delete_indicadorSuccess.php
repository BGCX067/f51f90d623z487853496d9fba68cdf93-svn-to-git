<?php $my_lib = new my_lib(); ?>
<script type="text/javascript">
    var option_tree = {
        "treepk":'<?php echo 't-'.$tree->getId() ?>',
        "title":'<?php echo $tree->getName() ?>'
    }
     var data_indicador = '';
     var option_indicador = '';

$(document).ready(function(){
createTree(option_tree);
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

    createindicador(data_indicador,option_indicador);

<?php endforeach ; ?>
});

</script>