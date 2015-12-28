 <?php if(count($list_tree)>0): ?>
<script type="text/javascript">
    $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tabs").tabs();
        
    });
</script>
<?php $my_lib = new my_lib() ?>

<div id="div-content-responsabilidades" style="float: left;width: auto;border: 1px solid red;height: auto;" >
<div id="tabs">
            <ul>
                <?php   $c_ajax = 1; ?>
                <?php foreach($list_tree as $row): ?>
                <?php if($c_ajax==1): ?>
                     <li><a href="#tree-<?php echo $row->getId() ?>"><?php echo $row->getName() ?></a></li>
                <?php else: ?>
                     <li><a onclick="ajax_my_responsabi('<?php echo $row->getId() ?>')" href="#tree-<?php echo $row->getId() ?>"><?php echo $row->getName() ?></a></li>
                <?php endif; ?>
                
                <?php $c_ajax++; ?>
                <?php endforeach; ?>
            </ul>
                 <?php $contador = 1; ?>
                 <?php foreach($list_tree as $row): ?>
                    <div id="tree-<?php echo $row->getId() ?>">
                        <?php if($contador==1): ?>
                           <?php $c=1;
                                 $var = '[';
                           ?>
                            <?php foreach($list_first_indicador as $indicator): ?>

                                <?php
                                if($c==1){
                                    $list_model=  $my_lib->returnCol_model($user, $indicator);
                                    $col_names =  $my_lib->returnCol_names($user, $indicator);
                                }
                                $list      =  $my_lib->returnData_indicadores($user, $indicator);
                                if(count($list_first_indicador)==$c){
                                    $var = $var.$list.',';
                                }else{
                                   $var = $var.$list.',';
                                }
                                
                                
                                ?>
                                 <?php $c++; ?>
                            <?php endforeach; ?>
                                <div style="float: left;margin-top: 5px;">
                                        <table id="rowed5"><tr><td></td></tr></table>
                                </div>
                                
                              <?php
                               $var = $var.']';                              
                            ?>
                        <?php endif; ?>
                    </div>
                    <?php $contador++; ?>
                 <?php endforeach; ?>
</div>    
</div>





<script type="text/javascript">


	var lastsel2;
jQuery("#rowed5").jqGrid({
	datatype: "local",
	height: 250,
   	colNames:<?php echo $col_names ?>,
   	colModel: <?php echo $list_model ?>,
	onSelectRow: function(id){
		if(id && id!==lastsel2){
			jQuery('#rowed5').jqGrid('restoreRow',lastsel2);
			jQuery('#rowed5').jqGrid('editRow',id,true);
			lastsel2=id;
		}
	},
	 
        editurl: "<?php echo url_for('my_responsibilities/save') ?>",
	caption: "Responsabilidades"

});



var mydata2 = <?php echo $var ?>;

for(var i=0;i < mydata2.length;i++)
     jQuery("#rowed5").jqGrid('addRowData',mydata2[i].id,mydata2[i]);


 function ajax_my_responsabi(id){

       $.ajax({
                type: 'POST',
                url:  '<?php echo url_for('my_responsibilities/ajax_responsibilities')  ?>',
                data: 'treeid='+id,
                complete:function(){
              
                },
                success: function(html){
                    $("#tree-"+id).html(html)
                },
                error:function(){
                        alert('error al crear nodo');
                }
        });
 }


 </script>

<?php endif; ?>