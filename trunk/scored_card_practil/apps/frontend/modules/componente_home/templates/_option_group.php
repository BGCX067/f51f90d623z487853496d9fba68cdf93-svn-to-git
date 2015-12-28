<div style="display: block;padding: 15px;">
    <div class="btn-a-content">
        <a  class="btn-a-sc btn-a btn-a-text" href="javascript:void(0);" onclick="open_new_group();" >Nuevo Grupo</a>
    </div>

    <div class="btn-a-content">
          <a class="btn-a-sc btn-a btn-a-text" href="javascript:void(0);"  onclick="show_new_contact();" >Nuevo contacto</a>
    </div>

     <div class="btn-a-content">
         <a class="btn-a-sc btn-a btn-a-text" href="javascript:void(0);"  onclick="show_human();" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Human&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    </div>

</div>





<div id="add-new-group" title="Crear Nuevo Grupo" style="display: none;">
     <div class="dialog-crear-indicador" style="float: left;width: 100%;margin-top: 15px;">
           <ul>
               <li style="height: 35px;">Nombre del Grupo: <input style="width:173px;" type="text" id="txt-name-group" name="txt-name-group" /></li>
           </ul>
           <ul>
                <li>
                    <div style="margin-left: 166px;">
                         <input type="button" id="btn-save-group" value="Agregar" />
                    </div>
                </li>
            </ul>
            <ul style="width: 100%;margin-bottom: 5px;">
                 <li style="text-align: center;width: 100%;">
                       <div style="display: none;" id="div-messaje-load-group"> <?php echo image_tag('implementacion/ajax-loader-circe.gif') ?></div>
                 </li>
             </ul>
        </div>
</div>

<div id="new-contact" title="Nuevo Contacto" style="display: none;">

     <div class="dialog-crear-indicador" style="float: left;width: 100%;margin-top: 15px;">
           <ul>
               <li style="height: 35px;">Email:&nbsp;&nbsp; <input style="width:230px;" type="text" id="txt-name-contact" name="txt-name-contact" /></li>
           </ul>
           <ul>
                <li>
                    <div style="margin-left: 166px;">
                        <input type="button"  id="btn-save-new-contact" value="Agregar" />
                    </div>
                </li>
            </ul>
            <ul style="width: 100%;margin-bottom: 5px;">
                 <li style="text-align: center;width: 100%;">
                       <div style="display: none;" id="div-messaje-load-contact"> <?php echo image_tag('implementacion/ajax-loader-circe.gif') ?></div>
                 </li>
             </ul>

        </div>


</div>



<script type="text/javascript">


function open_new_group(){
    $(_otxt.oname_group).val('').focus();
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

      $(_otxt.oname_group).keypress(function(event){
                  if (event.which == 13) {
                         save_new_group();
                    }
       });
});


 $(_obtn.osave_group).click(function(){
     save_new_group();
 });

 function save_new_group(){
        var  option ={
                "type":'POST',
                "name":$(_otxt.oname_group).val(),
                "dataType":'json',
                "url":'<?php echo url_for('working_groups/new_group') ?>'
         }
       new_group(option);
 }

</script>

