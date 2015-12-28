<script type="text/javascript">
    $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;
</script>

<div style="margin: 0 auto;width: 950px;">
<?php foreach($listaIndicadores as $row){ ?>
<div class="cls-contenedor-projection">
                <table id="tableIndicador_<?php echo $row->getId() ?>"><tr><td></td></tr></table>
       </div>
<?php } ?>
</div>
<?php  $libGrid  = new ProjectionsGrid(); ?>
<script type="text/javascript">
      <?php foreach($listaIndicadores as $indicador){ ?>
          
      <?php $col_names  = $libGrid->returnCol_names($indicador) ?>
      <?php $list_model = $libGrid->returnCol_model($indicador) ?>
      <?php $data       = $libGrid->returnData_indicadores($indicador) ?>

           var lastsel2;
           jQuery("#tableIndicador_<?php echo $indicador->getId() ?>").jqGrid({
                datatype: "local",
                height: 66,
                colNames:<?php echo $col_names ?>,
                colModel: <?php echo $list_model ?>,
                onSelectRow: function(id){
                   
                        if(id && id!==lastsel2){
                                jQuery('#tableIndicador_<?php echo $indicador->getId() ?>').jqGrid('restoreRow',lastsel2);
                                jQuery('#tableIndicador_<?php echo $indicador->getId() ?>').jqGrid('editRow',id,true);
                                lastsel2=id;
                        }
                },

                editurl: "<?php echo url_for('projections/saveProjections') ?>",
                caption: "<?php echo $indicador->getTitulo(); ?>"
            });
            var mydata2 = <?php echo $data ?>;
            var contadoScript = 1;
            for(var i=0;i < mydata2.length;i++)
            {

                 if(contadoScript==1)
                 {
                   
                   jQuery("#tableIndicador_<?php echo $indicador->getId() ?>").jqGrid('addRowData','valor_min-'+contadoScript+'<?php echo $indicador->getId() ?>',mydata2[i]);
                 }
                 else if(contadoScript==2)
                 {
                    jQuery("#tableIndicador_<?php echo $indicador->getId() ?>").jqGrid('addRowData','valor_des-'+contadoScript+'<?php echo $indicador->getId() ?>',mydata2[i]);
                 }
                 else
                 {
                    jQuery("#tableIndicador_<?php echo $indicador->getId() ?>").jqGrid('addRowData','valor_opt-'+contadoScript+'<?php echo $indicador->getId() ?>',mydata2[i]);
                    contadoScript=0;
                 }
                 contadoScript=contadoScript+1;
            }
            
                
<?php } ?>

</script>




	








