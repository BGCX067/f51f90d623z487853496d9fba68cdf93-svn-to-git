<?php $lib = new my_lib(); ?>
<?php $array_color = array('#70FF8A','#FF8787','#FF0000') ?>
<script type="text/javascript">
var option_tree = {"title":'<?php echo $sf_user->getAttribute(sfConfig::get('app_session_current_user_name'),'session expird') ?>'}
var data_indicador = '';
var option_indicador = '';
$(document).ready(function(){
create_sub_tree(option_tree);
 
  <?php foreach ($array as $obj):  ?>

     <?php $proyeccionBean =  $lib->obtenerValoresDeProyecciones($obj, $fechaProyeccion,$obj[0]) ?>
     <?php $valorMinimo    =  $obj[3]; ?>
     <?php $valorDeseado   =  $obj[4]; ?>

     data_indicador = {
        "indicatorpk":'<?php echo $obj[0] ?>',
        "previous":'<?php echo $obj[1] ?>',
        "title":'<?php echo $obj[2] ?>',
        "valueMin":'<?php echo $valorMinimo ?>',
        "valueDes":'<?php echo $valorDeseado ?>',
        "porcentaje":'<?php echo $obj[6] ?>',
        "value":'<?php echo $obj[5] ?>',
        "color":'<?php echo $lib->current_color_production($obj[0], $array_color,$proyeccionBean) ?>'
    }
    create_indicador_production(data_indicador);
   <?php   endforeach; ?>
       resize_tree();

 $("#reports_record_indicators").dialog({
            autoOpen: false,
            width:800,
            minHeight:400,
            modal: true

});



});

function drawChart(json) {
$("#titulo_indicador").html('<center><h3>'+json.columnas[1].name +'</h3></center>');
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
        data.setValue(0, 0, '');
        data.setValue(0, 1, parseInt(json.porcentaje));

        var chart = new google.visualization.Gauge(document.getElementById('gauge'));
        var options = {width: 250, height: 200, redFrom: 90, redTo: 100,
            yellowFrom:75, yellowTo: 90, minorTicks: 5};
        chart.draw(data, options);

        
    
        }
</script>
<div class="body-tree"  >
    <div id="tree-master2" style="width: auto;"></div>
</div>

<div id="reports_record_indicators">
    <div id="load_ajax_2" style="display: none;float: left;margin-left: 335px;margin-top: 140px;">
        <?php echo image_tag('ajax-loader_1.gif') ?>
    </div>

    <div id="div-report">
            <div id="titulo_indicador" style="width: 100%;"></div>
            <div id="chart_div" style="float: left;"></div>
            <div id="gauge" style="float: left; " align="center">
    </div>


      </div>
</div>