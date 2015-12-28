<div style="float: left;width: 650px;margin-top: 25px;">
    <a href="javascript:void(0);" onclick="open_new_group()">Nuevo grupo</a>&nbsp;-
    <a href="#">Listado de grupos</a>&nbsp;-
    <a href="<?php echo url_for('working_groups/solicitudes') ?>">Solicitudes</a>
</div>
<div style="float: left;width: 100%;margin-top: 30px;">
    <select style="width: 150px;" onchange="">
        <?php foreach($list as $row): ?>
        <option><?php echo $row->getName(); ?></option>
        <?php endforeach; ?>
    </select>
    <a href="javascript:void(0);" onclick="show_new_contact()">Nuevo contacto</a>
</div>

<div style="float: left;width: 100%;margin-top: 30px;" id="content-ajax-contact">
  
</div>

<div id="new-contact" title="Nuevo Contacto">
    <div style="float: left;width: 100%;margin-top: 15px;">
        <ul style="width: 100%;margin-bottom: 15px;">
            <li>Email</li>
            <li><input type="text" id="txt-name-contact" name="txt-name-contact" /></li>
            <li>
                &nbsp;&nbsp;<a href="javascript:void(0);" id="btn-save-new-contact">Crear</a>
            </li>
       </ul>
        <ul style="width: 100%;margin-bottom: 5px;">
             <li style="text-align: center;width: 100%;">
                 <div style="display: none;" id="div-messaje-load-contact"> Cargando...</div>
             </li>
       </ul>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
     $.fx.speeds._default = 400;
     $('#new-contact').dialog({
            autoOpen: false,
            width:300,
            minHeight:100,
            modal: true
      });
});

function show_new_contact(){
    $('#txt-email-contact').val('').focus();
    $('#new-contact').dialog('open');
}

</script>