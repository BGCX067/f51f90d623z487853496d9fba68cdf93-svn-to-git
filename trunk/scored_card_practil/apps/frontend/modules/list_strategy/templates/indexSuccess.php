

<div class="cls-div-conent-page-tree">
    <div>
        <div id="tabs2">
            <ul>
                <li><a href="#tab1">Ejecucion</a></li>
                <li><a href="#tab2">Creacion y Edicion</a></li>
            </ul>
            <div id="tab1">

                <?php if(count($lista_tree_user)>0 || count($lista_indicators_user)>0): ?>
                <div class="cls-div-conent-page-tree" style="width: 960px;">
                            <input type="hidden" name="size-tree" id="size-tree" value="<?php echo count($lista_tree_user) ?>" />
                            <div id="tabs" style="display: none;border: 0px solid;">
                                <ul style="background: none;border: 0px solid;padding: 0px;">
                                    <?php foreach($lista_tree_user as $obj_tree): ?>
                                    <li>
                                        <div style="float: left;margin-top: 6px;margin-left: 5px;">
                                            <?php echo image_tag('implementacion/icono_perfil.png') ?>
                                        </div>
                                        <div style="float: left;margin-top: 3px;">
                                            <a style="cursor: pointer;" href="#tree_<?php echo $obj_tree->getId(); ?>" onclick="mostrar_tree(<?php echo $obj_tree->getId() ?>)"><?php echo $obj_tree->getName(); ?></a>
                                        </div>
                                      </li>
                                     <?php endforeach; ?>
                                     <?php foreach($lista_indicators_user as $indicator): ?>
                                            <li><a href="#sub_tree_<?php echo $indicator->getTreeId(); ?>" onclick="mostrar_sub_tree(<?php echo $indicator->getTreeId() ?>)"><?php echo $indicator->getTreeSc()->getName(); ?></a></li>
                                     <?php endforeach; ?>
                                </ul>

                                    <?php foreach($lista_tree_user as $obj_tree): ?>
                                            <div id="tree_<?php echo $obj_tree->getId(); ?>" style="border-width:1px;"></div>
                                     <?php endforeach; ?>
                                     <?php foreach($lista_indicators_user as $indicator): ?>
                                            <div id="sub_tree_<?php echo $indicator->getTreeId(); ?>" style="border-width:1px;"></div>
                                     <?php endforeach; ?>
                            </div>
                        </div>
                <?php endif; ?>
            </div>
            <div id="tab2">
                
                   <div align="right" style="margin: 10px 0px;">
                       <a class="btn-a btn-a-text" href="<?php echo url_for('@strategy') ?>" id="btn-create-strategy">Crear Estrategia</a>
                   </div>
                
                   <div style="width: 100%;height: auto;display: none;" id="pnl-message-list-delete-tree" >
                            <input type="hidden" id="hd-undo-id" name="hd-undo-id" />
                            <input type="hidden" id="hd-undo-production" name="hd-undo-production" />
                            <div class="cls-message-info-scorecard">
                                <ul>
                                    <li style="width: 100%;">
                                        <div style="padding-left: 225px;">
                                            <div style="padding-top: 10px;">
                                                Se ha eliminado la estrategia <label style="font-weight: bold;text-decoration: underline;" id="title-tree"></label> , si desea deshacer esta accion haga <a href="javascript:void(0)" id="btn-undo-tree">click aqui</a>
                                            </div>
                                            <div style="margin-left: 1px;">
                                                 <a href="javascript:void(0);"><?php echo image_tag('implementacion/undo.png') ?></a>
                                            </div>
                                          </div>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <div class="listado_estrategia">
                            <ul >
                                <li style="width: 37%;"><div style="width: auto;padding-left: 100px;">Nombre de la Estrategia</div></li>
                                <li style="width: 21%;"><div style="width: auto;padding-left: 55px;">Fecha de creaci&oacute;n</div></li>
                                <li style="width: 12%;"><div style="width: auto;padding-left: 60px;">Editar</div></li>
                                <li style="width: 12%;"><div style="width: auto;padding-left: 55px;">Eliminar</div></li>
                                <li style="width: 15%;"><div style="width: auto;padding-left: 55px;">En producci&oacute;n</div></li>
                            </ul>
                        </div>

                      <?php $conta=0; ?>
                      <?php foreach($list as $row): ?>
                           <?php  $fecha = new DateTime($row->getCreateAt()); ?>

                        <div id="div-list-<?php echo $row->getId() ?>"   <?php if($conta%2==0){ ?>  class="listado_contenido" <?php }else{ ?>  class="listado_contenido_impar"  <?php }?>  >

                                    <ul>
                                        <li style="width: 36%;"><?php echo $row->getName() ?></li>
                                        <li style="width: 13%;padding-left: 75px;"><?php echo $fecha->format('d-m-Y') ?></li>
                                        <li style="width: 7%;padding-left: 75px;"><a title="Editar estrategia" href="<?php echo url_for('@edit_strategy?id_tree='.$row->getId()) ?>"  ><?php echo image_tag('implementacion/b_editar.gif', 'size=16x16') ?></a></li>
                                            <?php if( $row->getProduccion()=="production"): ?>
                                                 <li style="width: 7%;padding-left: 50px;"><a title="Eliminar estrategia" href="javascript:void(0);" onclick="s_dialog_delete('<?php echo $row->getId() ?>');"  ><?php echo image_tag('implementacion/b_eliminar.gif', 'size=16x16') ?></a></li>
                                            <?php else: ?>
                                                 <li style="width: 7%;padding-left: 50px;"><a title="Eliminar estrategia" href="javascript:void(0);" onclick="s_dialog_delete_f('<?php echo $row->getId() ?>');"  ><?php echo image_tag('implementacion/b_eliminar.gif', 'size=16x16') ?></a></li>
                                            <?php endif; ?>
                                        <li style="width: 8%;padding-left: 65px;">
                                            <?php if( $row->getProduccion()=="production"): ?>
                                                <?php echo image_tag('implementacion/activo.png', 'size=16x16') ?>
                                            <?php else: ?>
                                                 <?php echo image_tag('implementacion/desactivado.png', 'size=16x16') ?>
                                            <?php endif; ?>

                                        </li>
                                    </ul>

                                </div>
                          <?php $conta++; ?>
                        <?php  endforeach;?>
                
            </div>
        </div>
    </div>
</div>


<div id="dialog-show-delete-tree-production" title="Eliminar Estrategia">
    <input type="hidden" id="txt-id-tree" name="txt-id-tree" />
    <div style="float: left;width: 100%;margin-top: 15px;" >
        <ul style="width: 100%;margin-bottom: 15px;" >
            <li style="text-align: center;height: 20px;">Esta estrategia se encuentra en produccion.</li>
            <li style="text-align: center;height: 20px;">Esta seguro que desea eliminarla ?</li>
            <li style="text-align: center;height: 20px;">
                <div style="margin-left: 100px;margin-top: 10px;">
                    <input style="height: 22px;" class="class-btn"  type="button" id="btn-yes-confirmation-delete-indicator" value="Si" />&nbsp;&nbsp;
                    <input style="height: 22px;" class="class-btn" type="button" id="btn-no-confirmation-delete-indicator" value="No" />
                </div>
           </li>
       </ul>
       <ul style="width: 100%;margin-bottom: 5px;">
             <li style="text-align: center;width: 100%;">
                 <div style="display: none;" id="div-messaje-load-d-indicator"> Cargando...</div>
             </li>
       </ul>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
       $(_odialog.odelete_tree).dialog({
                autoOpen: false,
                width:300,
                minHeight:100,
                resizable: false,
                modal: true                
       });
    });

    function s_dialog_delete(id){
        $(_ohidden.oidtree).val(id);
        $(_odialog.odelete_tree).dialog('open');        
    }

    function s_dialog_delete_f(id){
         execute_delete(id);
    }

    $(_obtn.oyesc_indicator).click(function(){
         execute_delete($(_ohidden.oidtree).val());
    });

    function execute_delete(id){
           var option = {
                        "type":'POST',
                        "url":'<?php echo url_for('list_strategy/delete_tree') ?>',
                        "treeId" : id
            }
            delete_tree_ajax(option);            
    }

    $(_obtn.onotc_indicator).click(function(){
       $(_odialog.odelete_tree).dialog('close');
    });

    $(_obtn.oundoTree).click(function(){
        var option = {
                        "type":'POST',
                        "url":'<?php echo url_for('list_strategy/undo_tree_ajax') ?>',
                        "treeId" : $(_ohidden.oundoId).val(),
                        "production" : $(_ohidden.oundoProduction).val()
        }
        undo_tree_ajax(option);  
    });
  

</script>




<script type="text/javascript">


      $("#tabs2").tabs();
      <?php if($selector == 'execution'): ?>
            $('#tabs2').tabs('select', 0);
      <?php else: ?>
            $('#tabs2').tabs('select', 1);
      <?php endif; ?>
      
        <?php if(count($lista_tree_user)>0 || count($lista_indicators_user)>0): ?>
          $( "#tabs" ).tabs();
          $( "#tabs" ).show();
        <?php endif; ?>




<?php if(count($lista_tree_user)>0 || count($lista_indicators_user)>0): ?>

  google.load("visualization", "1", {packages:["corechart"]});
  //google.setOnLoadCallback(drawChartDataTableReport);
   
  google.load('visualization', '1', {packages:['gauge']});

<?php if(count($lista_tree_user)>0){ ?>
           mostrar_tree('<?php echo $lista_tree_user[0]->getId(); ?>')
<?php }else{ ?>
        <?php if(count($lista_indicators_user)>0){ ?>
             mostrar_sub_tree('<?php echo $lista_indicators_user[0]->getTreeId(); ?>')
        <?php } ?>
<?php  }?>

function drawChartDataTableReport(parametro)
{
       // $("#titulo_indicador").html('<center><h3>'+json.columnas[1].name +'</h3></center>');
       alert(parametro);
        var superArray = [];
        var array  =  ['Year', 'Data', 'Valor Optimo', 'Valor Deseado', 'Valor Minimo'];
        superArray.push( array );
        for(var i=0 ; i<10 ; i++)
        {
             var array  =  ['Fecha1'+i,  Math.floor(Math.random()*11),Math.floor(Math.random()*11),Math.floor(Math.random()*11),Math.floor(Math.random()*11)];
             superArray.push( array );
        }
       
       

        var data = google.visualization.arrayToDataTable(
        superArray
        );

        var options = {
          title: "Reporte Indicador 1",
          width: 500,
          height: 240
          
        };

        var chart = new google.visualization.LineChart(document.getElementById('chartDataTableReport'));
        chart.draw(data, options);
}

function drawChart(json)
{

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


function mostrar_tree(id_tree){
     option = {
       "type":'POST',
       "treePk":id_tree,
       "url":'<?php echo url_for('production_strategy/ajax_mostrar_tree') ?>'
   }
   show_tree_production(option);
}

function mostrar_sub_tree(idTree){
   option = {
       "type":'POST',
       "treePk":idTree,
       "url":'<?php echo url_for('production_strategy/ajax_mostrar_sub_tree') ?>'
   }
   show_sub_tree(option);
}

function show_record_indicator(id_indicator){

   $("#reports_record_indicators").dialog('open');
            $("#div-report").hide();
            $("#load_ajax_2").show();
               $.ajax({
			type: 'get',
			url: '<?php echo url_for('@ajax_show_records_indicators') ?>',
			data: "id_indicators="+id_indicator,
                        dataType: "json",
			success: function(data){
                                drawChartDataTableReport(data);
                             /* $.ajax({
                                    type: 'get',
                                    url: '<?php //echo url_for('@ajax_show_gauge_indicators') ?>',
                                    data: "id_indicators="+id_indicator,
                                    dataType: "json",
                                    success: function(data){
                                        drawChart2(data);
                                    },
                                    complete:function(){

                                    }
                                });*/
			},complete: function(){
                            $("#load_ajax_2").hide(0,function(){
                                           $("#div-report").show();
                                        });


                                    }



		});


}



function eliminar_contenido_divs_indicators(){
<?php if(count($lista_tree_user)>0){ ?>
<?php foreach($lista_tree_user as $tree): ?>
    $("#tree_<?php echo $tree->getId(); ?>").html('');
<?php endforeach; ?>
<?php } ?>
<?php if(count($lista_indicators_user)>0){ ?>
<?php foreach($lista_indicators_user as $row): ?>
    $("#sub_tree_<?php echo $row->getTreeId();?>").html('');
<?php endforeach; ?>
<?php } ?>
}


<?php endif; ?>


</script>