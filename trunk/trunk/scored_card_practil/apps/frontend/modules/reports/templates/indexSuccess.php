<script type="text/javascript">



$(document).ready(function(){
  
    $("#reports_record_indicators").dialog({
            autoOpen: false,
            width:700,
            minHeight:450,
            modal: true
     });

     $.ajax({
            type: 'post',
            url: '<?php echo url_for('@ajax_reports') ?>',
            data: "id_tree=6",
            success: function(data){
                $("#show_reports_tree").html(data);
            }
    });


});

function show_record_indicator(id_indicator){
     $("#reports_record_indicators").dialog('open');
         $.ajax({
			type: 'get',
			url: '<?php echo url_for('@ajax_show_records_indicators') ?>',
			data: "id_indicators="+id_indicator,
                        dataType: "json",
			success: function(data){                                                 
                            drawChart(data);
			}

		});

  
}




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
        





</script>

<div id="div-content-reportes" style="float: left;width: auto;border: 1px solid red;height: auto;" >
<div id="show_reports_tree">

</div>

</div>

<div id="reports_record_indicators">
      <div id="chart_div"></div>
</div>
