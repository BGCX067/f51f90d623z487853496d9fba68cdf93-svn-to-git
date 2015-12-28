<?php $my_lib = new my_lib(); ?>
<script type="text/javascript">    
    var option_tree = {
        "treepk":'<?php echo 't-'.$tree->getId() ?>',
        "title":'<?php echo $tree->getName() ?>'
    }
     var data_indicador = '';
     var option_indicador = '';

$(document).ready(function(){

$("#ui-widget-overlay").css("width",screen.width);
$("#ui-widget-overlay").css("height",screen.height);
<?php if($tree->getProduccion()=='production'): ?>
    $("#ui-widget-overlay").show();
    $("#message-mirror-start-tree").show();
<?php endif; ?>
    
createTree(option_tree);
$(_ohidden.oidtree).val(option_tree.treepk);

<?php foreach ($lista_indicadores as $row): ?>
        
<?php if($row->getUltimoNodo()!=""){ $lastNode= true;}else{$lastNode= false; } ?>

<?php
$rpt = $my_lib->assessNode($row->getId());
if($rpt['resp'] ){
      $color = '#CCFFEE';
}else{
      $color = '#BCCCFF';
}
?>

    data_indicador = {
        "indicatorpk":<?php echo $row->getId() ?>,
        "title":'<?php echo $row->getTitulo() ?>',
        "value_min":'<?php echo $row->getValorMinimo() ?>',
        "value_dese":'<?php echo $row->getValorDeseado() ?>',
        "value_opti":'<?php echo $row->getValorOptimo() ?>',
        "lastNode":'<?php echo $lastNode ?>',
        "color":'<?php echo $color ?>'
    }
  
     <?php if($row->getPreviousId()!=0): ?>
          option_indicador = {"previous":<?php echo $row->getPreviousId() ?>}
     <?php else :?>
          option_indicador = {"previous":'<?php echo 't-'.$tree->getId() ?>'}
     <?php endif;?>
  
    createindicador(data_indicador,option_indicador);

<?php endforeach ; ?>
});




</script>

<div class="message_pnl_sing_in_alert" id="message-mirror-start-tree" style="display: none;position: relative;float: left;width: 75%;height: auto;margin-bottom: 10px;z-index: 500;">
    Esta estrategia se encuentra en produccion antes de poder editarla tiene que detener la estrategia.<br/>
    Desea detener la estrategia? <a href="<?php echo url_for('tree/create_mirror_tree?idTree='.$tree->getId()) ?>">Si</a>&nbsp;&nbsp;<a href="<?php echo url_for('@list_strategy') ?>">No</a>
</div>

<div class="cls-div-option-tree" style="width: 100%;">
    <fieldset style="width: 97%;" >
        <legend>Configuracion General de la Estrategia</legend>
        <ul>
            <li>
                <div>Ingreso de la informacion : &nbsp;</div>               
                <div><select id="cbo-medida-information" name="cbo-medida-information">
                        <option value="none">[-seleccionar-]</option>
                     <?php foreach($lista_periodos as $periodo): ?>
                        <option <?php if($tree->getPeriodoId()==$periodo->getId()):?>selected <?php endif; ?> value="<?php echo $periodo->getId() ?>"><?php echo $periodo->getDescripcion(); ?></option>
                     <?php endforeach; ?>
                    </select></div>
                  <div style="float: right;padding-right: 10px;">
                      <select id="cbo-group-tree" name="cbo-group-tree" onchange="change_cbo_group_tree(this)">
                          <?php foreach($lista_grupos as $row):  ?>
                              <?php if($row->getId()==$tree->getGrupoTrabajoId()): ?>
                              <option selected value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
                              <?php  else:?>
                              <option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
                              <?php endif ?>
                          <?php endforeach; ?>

                          <?php if($tree->getGrupoTrabajoId()==""): ?>
                              <option selected value="add">Agregar nuevo grupo de trabajo</option>
                          <?php  else:?>
                              <option value="add">Agregar nuevo grupo de trabajo</option>
                          <?php endif ?>
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
                    <a href="javascript:void(0);" id="btn-save-configuracion-tree">Grabar</a>
                </div>
            </li>
        </ul>
    </fieldset>
</div>

<div style="float: left;width: 100%;height: auto;">
    <ul style="width: 100%;height: auto;">
        <li style="float: left;width: 100%;height: auto;">
            
            <div style="float: left;width: 18px;height: 18px;background-color: #BCCCFF;"></div>
            <div style="float: left;">Recien creados</div>

            <div style="float: left;width: 18px;height: 18px;background-color: #CCFFEE;margin-left: 10px;"></div>
            <div style="float: left;">Informacion completa</div>
        </li>
         
    </ul>
</div>

<div class="message_pnl_sing_in_alert" id="load-start-tree" style="display: none;float: left;width: 95%;height: auto;margin-bottom: 10px;">
    cargando.....
</div>
<div class="message_pnl_sing_in_error" id="message-error-start-tree" style="display: none;float: left;width: 95%;height: auto;margin-bottom: 10px;">
    No puede poner en marcha la estragia asegurese que todos los campos esten totalmente registrados
    y que los usuarios reponsables hallan aceptado pertenecer al grupo de trabajo.
</div>
 <div style="width: 100%;">
     <select style="float: right;" onchange="resize_tree(this)">
            <option selected value="1">1000x500</option>
            <option value="2">1500x1000</option>
            <option value="3">1500x1500</option>
            <option value="4">2000x1500</option>
        </select>
    </div>
<div class="body-tree" id="div-content-area-tree">
    <div id="tree-master" style="width: auto;"> </div>       
</div>

<?php if($tree->getProduccion()!='production'): ?>
<div style="float: left;width: 100%;height: auto;">
    <ul>
        <li><input id="btn-execute-tree" style="height: 45px;cursor: pointer;" type="button" value="Poner en marcha la Estrategia" /></li>
        <li><input id="btn-delete-tree" style="height: 45px;cursor: pointer;" type="button" value="Eliminar Estrategia" /></li>
    </ul>
</div>
<?php endif; ?>

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

<div style="height: 100%;"  id="dialog-configuration-indicador" title="Edicion Estrategia">
    <div id="message_validator"style="border: solid 1px red;display: none;" >
        Error en el Ingreso de Datos
    </div>
    <input type="hidden" id="hd-edit-indicator" name="hd-edit-indicator" />
      <input value="<?php echo $tree->getGrupoTrabajoId() ?>" type="hidden" id="hd-id-grupo-indicator" name="hd-id-grupo-indicator" />
      
      <div id="div-loading-edit-indicador" style="float: left;margin-top: 35px;margin-left: 78px;width: 300px;">
             <ul style="width: 100%;margin-bottom: 5px;">
             <li><?php echo image_tag('ajax-loader.gif')?></li>
             <li style="text-align: left;width: 100%;">
                 <div style="padding-left: 65px;" onclick="metodoshow()"> Cargando...</div>
             </li>
       </ul>
       </div>
      
        <div style="display: none;float: left;width: 100%;margin-top: 15px;height: auto;" id="div-content-generl-edit-indicador" >
           
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
                                          <div style="float: left;margin-left: 5px;" id="div-valor-optimo">
                                             <div style="float: left;">Valor Optimo</div>
                                            <div style="float: left;"><input type="text" size="5" id="txt-value-optime-edit-indicator" name="txt-value-optime-edit-indicator"/></div>
                                          </div>
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
                                 
                             </ul>

                         </fieldset>
                         <fieldset>
                             <legend>Conectores Inferiores</legend>
                             <ul>
                                <li style="width: 100%;height:100%;float: right;margin-top: 10px;">
                                         <div id="div-loading-children-indicador" style="display: none;float: left;margin-top: 10px;margin-left: 160px;width: 300px;">
                                             <ul style="width: 100%;margin-bottom: 5px;">
                                                 <li><?php echo image_tag('ajax-loader.gif')?></li>
                                                 <li style="text-align: left;width: 100%;">
                                                     <div style="padding-left: 18px;">Cargando sub-indicadores</div>
                                                 </li>
                                               </ul>
                                         </div>
                                        <div id="contend-datos-edit-indicator-children" style="display: none;float: left;margin-top: 10px;width: 100%;">
                                            
                                        </div>

                                 </li>                                
                              </ul>
                         </fieldset>
                         <div style="width: 100%;height:35px;float: right;margin-top: 10px;">
                                     <a href="javascript:void(0);" id="btn-save-edit-indicator">Grabar</a>
                         </div>
                     </div>
                 </li>
           </ul>
        </div>
</div>

<div style="height: 100%;"  id="dialog-configuration-indicador-master" title="Edicion Estrategia">
      <input type="hidden" id="hd-edit-indicator-master" name="hd-edit-indicator-master" />
   
      <div id="div-loading-edit-indicador-master" style="float: left;margin-top: 35px;margin-left: 78px;width: 300px;">
             <ul style="width: 100%;margin-bottom: 5px;">
             <li><?php echo image_tag('ajax-loader.gif')?></li>
             <li style="text-align: left;width: 100%;">
                 <div style="padding-left: 65px;" onclick="metodoshow()"> Cargando...</div>
             </li>
       </ul>
       </div>

        <div style="display: none;float: left;width: 100%;margin-top: 15px;height: auto;" id="div-content-generl-edit-indicador-master" >

            <ul style="width: 100%;margin-bottom: 5px;">
                 <li style="text-align: center;width: 100%;">
                     <div class="title-edit-indicator">
                         <input type="text" value="Title" id="txt-title-edit-indicator-master" name="txt-title-edit-indicator-master" />
                     </div>
                     <div class="contend-datos-edit-indicator">
                         <fieldset>
                             <legend>Datos</legend>
                             <ul style="width: 100%;">
                                 <li  style="width: 100%;height:100%;float: left;text-align: left;">Descripci&oacute;n del objetivo:</li>
                                 <li  style="width: 100%;height:100%;float: left;text-align: left;"><textarea cols="68" rows="4" id="txt-description-edit-indicator-master" name="txt-description-edit-indicator-master"></textarea></li>
                                 <li style="width: 100%;height:100%;float: right;">
                                     <div style="padding-top: 3px;padding-bottom: 2px;">
                                          <div style="float: left;margin-left: 5px;">Valor Minimo</div>
                                          <div style="float: left;"><input type="text" size="5" id="txt-value-mim-edit-indicator-master-master" name="txt-value-mim-edit-indicator-master"/></div>
                                          <div style="float: left;margin-left: 5px;">Valor Deseado</div>
                                          <div style="float: left;"><input type="text" size="5" id="txt-value-desire-edit-indicator-master" name="txt-value-desire-edit-indicator-master"/></div>
                                        </div>
                                 </li>
                                 <li style="width: 100%;height:100%;float: right;">
                                     <div style="padding-top: 3px;padding-bottom: 2px;">
                                         <div style="float: left;margin-left: 5px;">Responsable:</div>
                                         <div style="float: left;margin-left: 5px;">
                                             <div id="txt-resposable-final-master" class="cls-div-responsable" style="display: none;">
                                                 <input type="hidden"  id="hd-resposable-final-master" name="hd-resposable-final-master" />
                                             </div>
                                             <input type="text" style="width: 180px;height: 27px;" name="txt-responsable-edit-indicator-master" id="txt-responsable-edit-indicator-master" />
                                             <div id="content-list-master" class="cls-list-contact">
                                             </div>
                                         </div>
                                         <div style="float: left;margin-left: 5px;"><a href="javascript:void(0);">opciones</a></div>
                                     </div>
                                 </li>

                             </ul>

                         </fieldset>
                         <fieldset>
                             <legend>Conectores Inferiores</legend>
                             <ul>
                                <li style="width: 100%;height:100%;float: right;margin-top: 10px;">
                                         <div id="div-loading-children-indicador-master" style="display: none;float: left;margin-top: 10px;margin-left: 160px;width: 300px;">
                                             <ul style="width: 100%;margin-bottom: 5px;">
                                                 <li><?php echo image_tag('ajax-loader.gif')?></li>
                                                 <li style="text-align: left;width: 100%;">
                                                     <div style="padding-left: 18px;">Cargando sub-indicadores</div>
                                                 </li>
                                               </ul>
                                         </div>
                                        <div id="contend-datos-edit-indicator-children-master" style="display: none;float: left;margin-top: 10px;width: 100%;">

                                        </div>

                                 </li>
                              </ul>
                         </fieldset>
                         <div style="width: 100%;height:35px;float: right;margin-top: 10px;">
                                     <a href="javascript:void(0);" id="btn-save-edit-indicator-master">Grabar</a>
                         </div>
                     </div>
                 </li>
           </ul>
        </div>
</div>

<div  id="dialog-save-tree" title="Grabar Estrategia">
    <div style="float: left;width: 100%;margin-top: 15px;">
    </div>
</div>


<script type="text/javascript">

$(document).ready(function(){
  
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
        minWidth:200,
        resizable: true,
        modal: true
     });
    $(_odialog.oconfiguration_indicador_master).dialog({
        autoOpen: false,
        minHeight:150,
        minWidth:200,
        resizable: true,
        modal: true
     });

     $(_otxt.oresponsable).keyup(function(){
          $(this).doTimeout( 'text-type', 250, function(){
                var  option ={
                    "type":'POST',
                    "url":'<?php echo url_for('working_groups/search_contact') ?>',
                    "workGroup":$(_cbo.oidgroup_tree).val(),
                    "data" : $(this).val()                    
                }
                list_contact(option);
          });
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

$(_obtn.osave_edit_indicator).click(function(){



     var  option ={
            "type":'POST',
            "title":            $(_otxt.oedit_title_indic).val(),
            "description":      $(_otxt.oedit_description_indic).val(),
            "valueMin":         $(_otxt.oedit_min_indic).val(),
            "valueDes":         $(_otxt.oedit_desire_indic).val(),
            "valueOpt":         $(_otxt.oedit_optimindic).val(),
            "responsableId":    $(_ohidden.oidresponsable).val(),
            "responsableEmail": $(_otxt.oresponsable).val(),
            "workGroup":        $(_cbo.oidgroup_tree).val(),
            "indicatorId":      $(_ohidden.oidondicatoredit).val(),
            "url":'<?php echo url_for('@saveindicador') ?>'
         }
         save_edit_indicador(option);

  

});



$(_obtn.oyesc_indicator).click(function(){
        var  option ={
            "type":'POST',
            "indicator":$(_ohidden.oidindicator_delete).val(),
            "url":'<?php echo url_for('tree/delete_indicador') ?>'            
         }
         delete_indicador(option);
});

$(_obtn.osave_configuracion_tree).click(function(){
     var  option ={
            "type":'POST',            
            "dataEntryValue":$(_cbo.omedida_information).val(),
            "workGroup":$(_cbo.oidgroup_tree).val(),
            "treeId":$(_ohidden.oidtree).val(),
            "source":'edit',
            "url":'<?php echo url_for('tree/save_configuracion_tree') ?>'
     } 
            save_configuration_tree(option);     
   
});

$(_obtn.oexecute_tree).click(function(){
     var  option ={
            "type":'POST',
            "treeId":$(_ohidden.oidtree).val(),
            "url":'<?php echo url_for('tree/execute_tree') ?>',
            "final_url" :'<?php echo url_for('tree/start_tree') ?>'
     }
     execute_tree(option);
});

function show_div_create_indicator(idprevious){
         $(_ohidden.oprevious).val(idprevious);
         $(_otxt.oname_indicador).val('').focus();
         $(_odialog.ocreate_indicador).dialog('open');
}   

function metodoshow(){
    $(_odiv.message_ajax[3].load).hide();
    $(_odiv.div_content[0].pk).show('clip');
    $(_odialog.oconfiguration_indicador).dialog("option", "position", "center");
}


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

function show_edit_indicator_master(id){

    if($(_ohidden.ogroupindictor).val()!=""){
         $(_odialog.oconfiguration_indicador).dialog('open');
         
         $(_odiv.div_content[4].pk).hide(0,function(){
                $(_odiv.message_ajax[3].load).show();
                $(_odialog.oconfiguration_indicador_master).dialog("option", "position", "center");
        });
        $(_odiv.div_ajax[2].pk).hide();
        $(_otxt.odivresponsable).html('<input type="hidden"  id="hd-resposable-final-master" name="hd-resposable-final-master" />').hide();
        $(_otxt.oresponsable_master).val('').show().focus();

        var  option ={
                "type":'POST',
                "tree":id,
                "dataType":'json',
                "url":'<?php echo url_for('tree/show_tree') ?>'
         }      
         fill_json_tree(option);
    }else{
        alert('no se puede editar el indicador\n Seleccione un grupo de Trabajo');
    }
}

function desacer_cargar_responsable(){
       $(_otxt.odivresponsable).html('<input type="hidden"  id="hd-resposable-final" name="hd-resposable-final" />').hide();
       $(_otxt.oresponsable).val('').show().focus();
}

function change_cbo_group_tree(cbo){
    if($(cbo).val()=='add'){
      
    }
}

function show_div_delete_indicator(id){
            $(_ohidden.oidindicator_delete).val(id);
            $(_odialog.odelete_indicator).dialog('open');
}

function validar_rango(){   
    if($(_odiv.div_content[1].pk).css('display')=="none"){
            if($(_otxt.oedit_desire_indic).val()<100 && $(_otxt.oedit_min_indic).val()>0 ){
                 if($(_otxt.oedit_desire_indic).val()>$(_otxt.oedit_min_indic).val()){
                        return true;
                 }else{ return false; }
            }else{  return false;  }
    }else{
            if($(_otxt.oedit_min_indic).val()>0 ){
                    if($(_otxt.oedit_desire_indic).val()>$(_otxt.oedit_min_indic).val()){
                         if($(_otxt.oedit_optimindic).val()>$(_otxt.oedit_desire_indic).val()){
                            return true;
                         }else{
                            return false;
                         }
                    }else{
                        return false;
                    }
            }else{
                return false;
            }
    }
}

</script>
<div  id="ui-widget-overlay" class="ui-widget-overlay" style="z-index: 499;display: none;"></div>
