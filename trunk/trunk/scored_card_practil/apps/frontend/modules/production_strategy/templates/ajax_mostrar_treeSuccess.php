<?php $lib = new my_lib(); ?>
<?php $array_color = array('#70FF8A','#FFDB87','#FF0000') ?>
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

     data_indicador = {
        "indicatorpk":<?php echo $row->getId() ?>,
        "title":'<?php echo $row->getTitulo() ?>',
        "valueMin":'<?php echo $row->getValorMinimo() ?>',
        "valueDes":'<?php echo $row->getValorDeseado() ?>',
        "value":'<?php echo $row->getValorActualEntregado() ?>',
        "color":'<?php echo $lib->current_color_production($row->getId(), $array_color) ?>'
     }
     <?php if($row->getPreviousId()!=0): ?>
          option_indicador = {"previous":<?php echo $row->getPreviousId() ?>}
     <?php else :?>
          option_indicador = {"previous":'<?php echo 't-'.$tree->getId() ?>'}
     <?php endif;?>

   create_indicador_production_owner(data_indicador,option_indicador);

<?php endforeach ; ?>
  $("#reports_record_indicators").dialog({
            autoOpen: false,
            width:800,
            minHeight:450,
            modal: true

});
});




function drawChart(json) {

		var data = new google.visualization.DataTable();
                for(var i = 0;i < json.columnas.length;i++){
                      data.addColumn( json.columnas[i].type, json.columnas[i].name);
                }
		data.addRows(json.size[0].cantidad);

                for(var j = 0;j < json.cell_data_v.length;j++){
                      data.setCell(j, 0, json.cell_data_v[j].value);
                }

                for(var k = 0;k < json.cell_data_h.length;k++){
                      data.setCell(k, 1, json.cell_data_h[k].value);
                }
		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		chart.draw(data, {width: 500, height: 240, legend: 'bottom', title: json.columnas[1].name });

	}

        function drawChart2(json){
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Label');
        data.addColumn('number', 'Value');
        data.addRows(1);
        data.setValue(0, 0, '"'+json.nombre+'"');
        data.setValue(0, 1, parseInt(json.porcentaje));
        var chart = new google.visualization.Gauge(document.getElementById('gauge'));
        var options = {width: 400, height: 120, redFrom: 90, redTo: 100,
            yellowFrom:75, yellowTo: 90, minorTicks: 5};
        chart.draw(data, options);
        }
</script>

<div class="body-tree" >
<div id="tree-master2" style="width: auto;"></div>

</div>
<div id="reports_record_indicators">
    <div id="chart_div" style="float: left;"></div>
      <div id="gauge" style="float: left;">

      </div>
</div>
