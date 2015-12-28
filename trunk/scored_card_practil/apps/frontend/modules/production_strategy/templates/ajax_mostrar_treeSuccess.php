<?php $lib = new my_lib(); ?>
<?php $array_color = array('#70FF8A','#FF8787','#FF0000') ?>
<script type="text/javascript">

    var option_tree = {
        "treepk":'<?php echo 't-'.$tree->getId() ?>',
        "title":'<?php echo $tree->getName() ?>'
    }
     var data_indicador = '';
     var option_indicador = '';

$(document).ready(function(){
    createTree2(option_tree);
$(_ohidden.oidtree).val(option_tree.treepk);

<?php foreach ($lista_indicadores as $row): ?>
     <?php $proyeccionBean = $lib->obtenerValoresDeProyecciones($row, $fechaProyeccion) ?>
     <?php $valorMinimo = $proyeccionBean['object']->getValorMinimo(); ?>
     <?php $valorDeseado= $proyeccionBean['object']->getValorDeseado(); ?>
     data_indicador = {
        "indicatorpk":<?php echo $row->getId() ?>,
        "title":'<?php echo $row->getTitulo() ?>',
        "valueMin":'<?php echo $valorMinimo ?>',
        "valueDes":'<?php echo $valorDeseado ?>',
        "porcentaje":'<?php echo $row->getConectoresConfigure() ?>',
        "value":'<?php echo $row->getValorActualEntregado() ?>',
        "color":'<?php echo $lib->current_color_production($row->getId(), $array_color, $proyeccionBean) ?>'
     }
     <?php if($row->getPreviousId()!=0): ?>
          option_indicador = {"previous":<?php echo $row->getPreviousId() ?>}
     <?php else :?>
          option_indicador = {"previous":'<?php echo 't-'.$tree->getId() ?>'}
     <?php endif;?>

   create_indicador_production_owner(data_indicador,option_indicador);

<?php endforeach ; ?>


    resize_tree();

  $("#reports_record_indicators").dialog({
            autoOpen: false,
            width:800,
            minHeight:450,
            modal: true

});
});


function drawChart2(json)
{

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Label');
        data.addColumn('number', 'Value');
        data.addRows(1);
        data.setValue(0, 0, '');
        data.setValue(0, 1, parseInt(json.porcentaje));
        var chart = new google.visualization.Gauge(document.getElementById('gauge'));
        var options = {width: 250, height: 200, redFrom: 90, redTo: 100,
            yellowFrom:75, yellowTo: 90, minorTicks: 5};
        chart.draw(data, options);
 }
</script>

<div class="body-tree" >
<div id="tree-master2" style="width: auto;"></div>

</div>
<div id="reports_record_indicators">
     <div id="load_ajax_2" style="display: none;float: left;margin-left: 335px;margin-top: 140px;">

        <?php echo image_tag('ajax-loader_1.gif') ?>

    </div>
    <div id="div-report">
            <div id="titulo_indicador" style="width: 100%;"></div>
            <div id="chartDataTableReport" style="float: left;"></div>
            <div id="gauge" style="float: left;" align="center">
    </div>


      </div>
</div>
