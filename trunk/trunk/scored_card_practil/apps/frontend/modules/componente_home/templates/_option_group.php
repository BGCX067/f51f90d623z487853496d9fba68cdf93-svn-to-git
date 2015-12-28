<div style="float: left;width: 650px;margin-top: 25px;">
    <a href="javascript:void(0);" onclick="open_new_group()">Nuevo grupo</a>&nbsp;-
    <a href="<?php echo url_for('working_groups/listado') ?>">Listado de grupos</a>&nbsp;-
    <a href="<?php echo url_for('working_groups/solicitudes') ?>">Solicitudes</a>
</div>


<div id="add-new-group" title="Crear Nuevo Grupo">

    <div style="float: left;width: 100%;margin-top: 15px;">
        <ul style="width: 100%;margin-bottom: 15px;">
            <li>Nombre</li>
            <li><input type="text" id="txt-name-group" name="txt-name-group" /></li>
            <li>
                &nbsp;&nbsp;<a href="javascript:void(0);" id="btn-save-group">Crear</a>
            </li>
       </ul>
        <ul style="width: 100%;margin-bottom: 5px;">
             <li style="text-align: center;width: 100%;">
                 <div style="display: none;" id="div-messaje-load-group"> Cargando...</div>
             </li>
       </ul>
    </div>
</div>

<script type="text/javascript">

function open_new_group(){
    $('#txt-name-group').val('').focus();
     $('#add-new-group').dialog('open');
}

$(document).ready(function(){
     $.fx.speeds._default = 400;
     $('#add-new-group').dialog({
            autoOpen: false,
            width:300,
            minHeight:100,
            modal: true
         });
});

</script>

