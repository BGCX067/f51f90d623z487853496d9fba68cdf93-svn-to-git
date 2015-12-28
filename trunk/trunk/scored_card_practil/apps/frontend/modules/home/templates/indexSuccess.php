<div class="body-tree">
        <div id="tree-master">
        </div>
</div>


<div id="dialog-add-indicador" title="Crear un indicador">
    <div style="float: left;width: 100%;margin-top: 15px;">
        <input type="hidden" name="hd-id-tree" id="hd-id-tree">
        <input type="hidden" name="hd-id-previous" id="hd-id-previous">
        <ul style="width: 100%;margin-bottom: 5px;">
            <li>Titulo</li>
            <li><input type="text" id="txt-title-name-indicador" name="txt-title-name-indicador" /></li>
            <li>
                &nbsp;&nbsp;<a href="javascript:void(0);" id="btn-create-indicador">Crear</a>
            </li>
       </ul>
       <ul style="width: 100%;margin-bottom: 5px;">
             <li style="text-align: center;width: 100%;">
                 <div style="display: none;" id="div-messaje-load-indicador"> Cargando...</div>
             </li>
       </ul>

    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $.fx.speeds._default = 400;
    $(_odialog.ocreate_indicador).dialog({
        autoOpen: false,
        width:400,
        modal: true,
        show : "clip",
	hide: "clip"
     });

});

 $(_obtn.ocreate_indicador).click(function(){
        var  option ={
            "type":'POST',
            "url":'<?php echo url_for('tree/create_indicador') ?>',
            "title" : $(_otxt.oname_indicador).val(),
            "previous" : $(_ohidden.ohdprevious).val()
         }
        create_indicador(option);
 });

</script>
