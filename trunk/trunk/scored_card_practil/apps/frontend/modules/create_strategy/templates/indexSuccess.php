<div class="cls-div-option-tree" style="width: 100%;">
    <fieldset style="width: 97%;" >
        <legend>Configuracion General de la Estrategia</legend>
        <ul>
            <li>
                <div>Periodo de la informacion : &nbsp;</div>
                <div><select id="cbo-medida-information" name="cbo-medida-information">
                        <option value="none">[-seleccionar-]</option>
                     <?php foreach($lista_periodos as $periodo): ?>
                        <option value="<?php echo $periodo->getId() ?>"><?php echo $periodo->getDescripcion(); ?></option>
                     <?php endforeach; ?>
                    </select></div>
                  <div style="float: right;padding-right: 10px;">
                      <select id="cbo-group-tree" name="cbo-group-tree" onchange="change_cbo_group_tree(this)">
                          <?php foreach($lista_grupos as $row):  ?>
                              <option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>                            
                          <?php endforeach; ?>
                              <option selected value="add">Agregar nuevo grupo de trabajo</option>
                    </select>
                  </div>
                  <div style="float: right;padding-right: 10px;">Grupo de Trabajo</div>

            </li>
        </ul>
        <ul>
            <li style="margin-top:10px;">
                <div style="float: left;padding-left: 5px;">
                    <a href="javascript:void(0);" id="">M&aacute;s</a>
                </div>
                <div style="float: right;padding-right: 10px;">
                    <a href="javascript:void(0);" id="btn-save-configuracion-tree">cambiar</a>
                </div>
            </li>
        </ul>
    </fieldset>
</div>

<div class="message_pnl_sing_in_error" id="message-error-start-tree" style="display: none;float: left;width: 95%;height: auto;margin-bottom: 10px;">
    No puede poner en marcha la estragia seleccione el periodo y un grupo de trabajo.
</div>
 <div style="width: 100%;">
     <select style="float: right;" onchange="resize_tree(this)">
            <option selected value="1">1000x500</option>
            <option value="2">1500x1000</option>
            <option value="3">1500x1500</option>
            <option value="4">2000x1500</option>
        </select>
    </div>
<div class="body-tree" style="border: 1px solid #000003;" >   
    <div id="tree-master" style="width: auto;"> </div>
</div>
<div style="float: left;width: 100%;height: auto;">
    <ul>
        <li><input id="btn-execute-tree" style="height: 45px;cursor: pointer;" type="button" value="Poner en marcha la Estrategia" /></li>
    </ul>
</div>


<div id="dialog-create-strategy" title="Crear Estrategia">
    <div style="float: left;width: 100%;margin-top: 15px;">
        <ul style="width: 100%;margin-bottom: 15px;">
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

<div id="dialog-add-indicador" title="Crear Indicador">
    <input type="hidden" id="txt-id-tree" name="txt-id-tree"  />
    <input type="hidden" id="txt-id-previous" name="txt-id-previous"  />
    <div style="float: left;width: 100%;margin-top: 15px;">
        <ul style="width: 100%;margin-bottom: 15px;">
            <li>Titulo</li>
            <li><input type="text" id="txt-title-name-indicador" name="txt-title-name-indicador" /></li>
            <li>
                &nbsp;&nbsp;<a href="javascript:void(0);" id="btn-save-indicator">Crear</a>
            </li>
       </ul>
         <ul style="width: 100%;margin-bottom: 5px;">
             <li style="text-align: center;width: 100%;">
                 <div style="display: none;" id="div-messaje-load-indicator"> Cargando...</div>
             </li>
       </ul>
    </div>
</div>

<div id="dialog-delete-indicador" title="Eliminar Indicador">
    <input type="hidden" id="hd-id-indicator" name="hd-id-indicator" />
    <div style="float: left;width: 100%;margin-top: 15px;">
        <ul style="width: 100%;margin-bottom: 15px;">
            <li style="text-align: center;">Al eliminar este indicador se borran tambien todos sus indicadores hijos</li>
            <li style="text-align: center;">Esta Seguro que desar Eliminar este indicador? </li>
            <li style="text-align: center;">
                <div style="margin-left: 100px;margin-top: 10px;">
                       <a href="javascript:void(0);" id="btn-yes-confirmation-delete-indicator">Si</a>&nbsp;&nbsp;
                       <a href="javascript:void(0);" id="btn-no-confirmation-delete-indicator">No</a>
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

<div  id="dialog-configuration-indicador" title="Edicion Estrategia">

      <input type="hidden" id="hd-edit-indicator" name="hd-edit-indicator" />
      <input value="" type="hidden" id="hd-id-grupo-indicator" name="hd-id-grupo-indicator" />

      <div id="div-loading-edit-indicador" style="float: left;margin-top: 35px;margin-left: 78px;width: 300px;">
             <ul style="width: 100%;margin-bottom: 5px;">
             <li><?php echo image_tag('ajax-loader.gif')?></li>
             <li style="text-align: left;width: 100%;">
                 <div style="padding-left: 65px;" onclick="metodoshow()"> Cargando...</div>
             </li>
       </ul>


        </div>
        <div style="display: none;float: left;width: 100%;margin-top: 15px;" id="div-content-generl-edit-indicador" >

            <ul style="width: 100%;margin-bottom: 5px;">
                 <li style="text-align: center;width: 100%;">
                     <div class="title-edit-indicator">
                         <input type="text" value="Title" id="txt-title-edit-indicator" name="txt-title-edit-indicator" />
                     </div>
                     <div class="contend-datos-edit-indicator">
                         <fieldset>
                             <legend>Datos</legend>
                             <ul style="width: 100%;">
                                 <li  style="width: 100%;height:100%;float: left;text-align: left;">Descripci&oacute;n del objetivo:</li>
                                 <li  style="width: 100%;height:100%;float: left;text-align: left;"><textarea cols="68" rows="4" id="txt-description-edit-indicator" name="txt-description-edit-indicator"></textarea></li>
                                 <li style="width: 100%;height:100%;float: right;">
                                     <div style="padding-top: 3px;padding-bottom: 2px;">
                                          <div style="float: left;margin-left: 5px;">Valor Minimo</div>
                                          <div style="float: left;"><input type="text" size="5" id="txt-value-mim-edit-indicator" name="txt-value-mim-edit-indicator"/></div>
                                          <div style="float: left;margin-left: 5px;">Valor Deseado</div>
                                          <div style="float: left;"><input type="text" size="5" id="txt-value-desire-edit-indicator" name="txt-value-desire-edit-indicator"/></div>
                                          <div style="float: left;margin-left: 5px;">Valor Optimo</div>
                                          <div style="float: left;"><input type="text" size="5" id="txt-value-optime-edit-indicator" name="txt-value-optime-edit-indicator"/></div>
                                      </div>
                                 </li>
                                 <li style="width: 100%;height:100%;float: right;">
                                     <div style="padding-top: 3px;padding-bottom: 2px;">
                                         <div style="float: left;margin-left: 5px;">Responsable:</div>
                                         <div style="float: left;margin-left: 5px;">
                                             <div id="txt-resposable-final" class="cls-div-responsable" style="display: none;">
                                                 <input type="hidden"  id="hd-resposable-final" name="hd-resposable-final" />
                                             </div>
                                             <input type="text" style="width: 180px;height: 27px;" name="txt-responsable-edit-indicator" id="txt-responsable-edit-indicator" />
                                             <div id="content-list" class="cls-list-contact">
                                             </div>
                                         </div>
                                         <div style="float: left;margin-left: 5px;"><a href="javascript:void(0);">opciones</a></div>
                                     </div>
                                 </li>
                                 <li style="width: 100%;height:100%;float: right;margin-top: 50px;">
                                     <a href="javascript:void(0);" id="btn-save-edit-indicator">Grabar</a>
                                 </li>
                             </ul>
                         </fieldset>
                     </div>
                 </li>
           </ul>
        </div>
</div>


<div id="dialog-save-tree" title="Grabar Estrategia">
    <div style="float: left;width: 100%;margin-top: 15px;">
            
    </div>
</div>


<script type="text/javascript">
    
$(document).ready(function() {
    $.fx.speeds._default = 400;
    $(_odialog.ocreate_strategy).dialog({
        autoOpen: true,
        width:300,
        minHeight:100,
        modal: true
     });
   $(_odialog.ocreate_indicador).dialog({
        autoOpen: false,
        width:300,
        minHeight:100,
        modal: true
     });
    $(_odialog.osave_tree).dialog({
        autoOpen: false,
        width:300,
        minHeight:100,
        modal: true
     });

    $(_odialog.odelete_indicator).dialog({
        autoOpen: false,
        width:300,
        minHeight:100,
        resizable: false,
        modal: true,
        close: function() {
               $(_ohidden.oidindicator_delete).val('');
        }
     });

    $(_odialog.oconfiguration_indicador).dialog({
        autoOpen: false,
        minHeight:150,
        minWidth:400,
        resizable: false,
        modal: true
     });

});

$(_obtn.ocreate_tree).click(function(){
        var  option ={
            "type":'POST',
            "url":'<?php echo url_for('tree/create_tree') ?>',
            "title" : $(_otxt.oname_tree).val()
         }
        create_tree(option);
 });

$(_obtn.osave_idicator).click(function(){
        var  option ={
            "type":'POST',
            "tree":$(_ohidden.oidtree).val(),
            "previous":$(_ohidden.oprevious).val(),
            "url":'<?php echo url_for('tree/create_indicador') ?>',
            "title" : $(_otxt.oname_indicador).val()
         }
         create_indicador(option);
});

$(_obtn.osave_strategy).click(function(){
    
});


$(_obtn.oexecute_tree).click(function(){
       $(_odiv.message_ajax[6].load).show();
});



function show_div_create_indicator(idprevious){
         $(_ohidden.oprevious).val(idprevious);
         $(_otxt.oname_indicador).val('').focus();
         $(_odialog.ocreate_indicador).dialog('open');         
}

function show_div_delete_indicator(id){
            $(_ohidden.oidindicator_delete).val(id);
            $(_odialog.odelete_indicator).dialog('open');
}

$(_obtn.onotc_indicator).click(function(){
    $(_odialog.odelete_indicator).dialog('close');
});

$(_obtn.oyesc_indicator).click(function(){
        var  option ={
            "type":'POST',
            "indicator":$(_ohidden.oidindicator_delete).val(),
            "url":'<?php echo url_for('tree/delete_indicador') ?>'
         }
         delete_indicador(option);
});

function show_edit_indicator(id){
    if($(_ohidden.ogroupindictor).val()!=""){
         $(_odialog.oconfiguration_indicador).dialog('open');
         $(_odiv.div_content[0].pk).hide(0,function(){
                $(_odiv.message_ajax[3].load).show();
                $(_odialog.oconfiguration_indicador).dialog("option", "position", "center");
            });
            $(_odiv.div_ajax[1].pk).hide();
            $(_otxt.odivresponsable).html('<input type="hidden"  id="hd-resposable-final" name="hd-resposable-final" />').hide();
            $(_otxt.oresponsable).val('').show().focus();

            var  option ={
                "type":'POST',
                "indicator":id,
                "dataType":'json',
                "url":'<?php echo url_for('@indicator') ?>'
             }
         fill_json_indicator(option);
    }else{
        alert('no se puede editar el indicador\n Seleccione un grupo de Trabajo');
    }
}

function change_cbo_group_tree(cbo){
    if($(cbo).val()=='add'){

    }
}

$(_obtn.osave_configuracion_tree).click(function(){
     var  option ={
            "type":'POST',
            "dataEntryValue":$(_cbo.omedida_information).val(),
            "workGroup":$(_cbo.oidgroup_tree).val(),
            "treeId":$(_ohidden.oidtree).val(),
            "source":'create',
            "url_second":'<?php echo url_for('@edit_strategy?id_tree=') ?>',
            "url":'<?php echo url_for('tree/save_configuracion_tree') ?>'
     }
            save_configuration_tree(option);


});


</script>
