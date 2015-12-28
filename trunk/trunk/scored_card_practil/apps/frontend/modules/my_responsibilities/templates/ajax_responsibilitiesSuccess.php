<?php
    $my_lib = new my_lib();
    $c=1;
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
       $var = $var.$list;
    }

    ?>
     <?php $c++; ?>
<?php endforeach; ?>
    <div style="float: left;margin-top: 5px;">
            <table id="row_current"><tr><td></td></tr></table>
    </div>

  <?php
   $var = $var.']';
?>
<script type="text/javascript">

	var lastse;
jQuery("#row_current").jqGrid({
	datatype: "local",
	height: 250,
   	colNames:<?php echo $col_names ?>,
   	colModel: <?php echo $list_model ?>,
	onSelectRow: function(id){
		if(id && id!==lastse){
			jQuery('#row_current').jqGrid('restoreRow',lastse);
			jQuery('#row_current').jqGrid('editRow',id,true);
			lastse=id;
		}
	},

        editurl: "<?php echo url_for('my_responsibilities/save') ?>",
	caption: "Responsabilidades"
});

var mydata_aux = <?php echo $var ?>;

for(var i=0;i < mydata_aux.length;i++)
     jQuery("#row_current").jqGrid('addRowData',mydata_aux[i].id,mydata_aux[i]);
 </script>