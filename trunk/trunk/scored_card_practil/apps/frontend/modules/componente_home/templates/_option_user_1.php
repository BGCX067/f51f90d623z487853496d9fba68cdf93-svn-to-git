

<style type="text/css">
    ul{margin: 0px;padding: 0px;float: left;}
    li{float: left;list-style: none;}
    a{text-decoration: none;}
</style>
<div>
    <ul>
        <li><a href="javascript:void(0);" id="btn-create-strategy">Crear Estrategia</a> </li>
    </ul>
</div>


<div id="dialog-create-strategy" title="Crear Estrategia">
    <div style="float: left;width: 100%;margin-top: 15px;">
        <ul style="width: 100%;margin-bottom: 5px;">
            <li>Titulo</li>
            <li><input type="text" id="txt-title-name-tree" name="txt-title-name-tree" /></li>
            <li>
                &nbsp;&nbsp;<a href="javascript:void(0);" id="btn-create-tree">Crear</a>
            </li>
       </ul>
         <ul style="width: 100%;margin-bottom: 5px;">
             <li style="text-align: center;width: 100%;">
                 <div style="display: none;" id="div-messaje-load"> Cargando...</div>
             </li>
       </ul>

    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $.fx.speeds._default = 400;
    $(_odialog.ocreate_strategy).dialog({
        autoOpen: false,
        width:400,
        modal: true,
        show : "clip",
	hide: "clip"
     });

});

 $(_obtn.ocreate_strategy).click(function(){
        $(_odialog.ocreate_strategy).dialog('open');
        $(_otxt.oname_tree).val('').focus();

 });

 $(_obtn.ocreate_tree).click(function(){
        var  option ={
            "type":'POST',
            "url":'<?php echo url_for('tree/create_tree') ?>',
            "title" : $(_otxt.oname_tree).val()
         }
        create_tree(option);
 });

</script>