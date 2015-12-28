
<?php if(count($lista_tree_user)>0 || count($lista_indicators_user)>0): ?>
<div class="cls-div-conent-page-tree">
    <input type="hidden" name="size-tree" id="size-tree" value="<?php echo count($lista_tree_user) ?>" />
    <div id="tabs" style="display: none;">
        <ul>
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
                    <div id="tree_<?php echo $obj_tree->getId(); ?>"></div>
             <?php endforeach; ?>
             <?php foreach($lista_indicators_user as $indicator): ?>
                    <div id="sub_tree_<?php echo $indicator->getTreeId(); ?>"></div>
             <?php endforeach; ?>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
      $( "#tabs" ).tabs();
      $( "#tabs" ).show();
})

  google.load("visualization", "1", {packages:["linechart"]});
   google.load('visualization', '1', {packages:['gauge']});
<?php if(count($lista_tree_user)>0){ ?>
             mostrar_tree('<?php echo $lista_tree_user[0]->getId(); ?>')
<?php }else{ ?>
        <?php if(count($lista_indicators_user)>0){ ?>
             mostrar_sub_tree('<?php echo $lista_indicators_user[0]->getTreeId(); ?>')
        <?php } ?>
<?php  }?>

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
               $.ajax({
			type: 'get',
			url: '<?php echo url_for('@ajax_show_records_indicators') ?>',
			data: "id_indicators="+id_indicator,
                        dataType: "json",
			success: function(data){
                            drawChart(data);
                              $.ajax({
                                    type: 'get',
                                    url: '<?php echo url_for('@ajax_show_gauge_indicators') ?>',
                                    data: "id_indicators="+id_indicator,
                                    dataType: "json",
                                    success: function(data){
                                        drawChart2(data);
                                    }

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


</script>

<?php endif; ?>

