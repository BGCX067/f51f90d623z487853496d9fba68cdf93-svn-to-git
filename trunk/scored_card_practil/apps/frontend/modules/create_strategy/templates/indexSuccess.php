<?php use_javascript('js-create-strategy.js') ?>
<style type="text/css">
    .ui-dialog .ui-dialog-titlebar{padding: 1em 1em;position: relative;}
    .ui-dialog{padding:0px;}
    .ui-widget-header{  -moz-border-radius: 4px 4px 0px 0px;
                        -webkit-border-radius: 4px 4px 0px 0px;
                        border-radius: 4px 4px 0px 0px;
                        border: 0px solid #208FEB;                        
                        color: white;
                        font-weight: bold;
                        background: #11c7ef; /* Old browsers */
                        /* IE9 SVG, needs conditional override of 'filter' to 'none' */
                        background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIxJSIgc3RvcC1jb2xvcj0iIzExYzdlZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMxODg5ZDkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
                        background: -moz-linear-gradient(top,  #11c7ef 1%, #1889d9 100%); /* FF3.6+ */
                        background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,#11c7ef), color-stop(100%,#1889d9)); /* Chrome,Safari4+ */
                        background: -webkit-linear-gradient(top,  #11c7ef 1%,#1889d9 100%); /* Chrome10+,Safari5.1+ */
                        background: -o-linear-gradient(top,  #11c7ef 1%,#1889d9 100%); /* Opera 11.10+ */
                        background: -ms-linear-gradient(top,  #11c7ef 1%,#1889d9 100%); /* IE10+ */
                        background: linear-gradient(top,  #11c7ef 1%,#1889d9 100%); /* W3C */
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#11c7ef', endColorstr='#1889d9',GradientType=0 ); /* IE6-8 */

    }


</style>

    <?php $serviceBrowser = new browser(); ?>
    <?php $navegador      =  trim(strtolower($serviceBrowser->getNAV($_SERVER['HTTP_USER_AGENT'] ))) ; ?>
    <?php if (strpos($navegador, "firefox ")===false)   :?>
    <div style="display: block;" class="message_pnl_sing_in_alert message-browser"><span>Para poder visualizar tu estragia, te sugierimos utilizar <b>Mozilla Firefox</b> , puedes descargar la ultima version desde el siguiente link </span> <a target="_blank" href="<?php echo sfConfig::get('app_url_mozilla_browser_es') ?>" class="btn-dowload-fire"><span>Descargar</span></a></div>
    <?php endif; ?>

<div class="cls-div-conent-page-tree">   

<div class="cls-configuracion-general-estrategia">
    <ul>
        <li><h2>Configuraci&oacute;n general de la estrategia</h2></li>
        <li style="padding-bottom: 15px;">
            <div class="cls-option-cge">
                <div style="padding-left: 13px;"><label>Periodo de la informaci&oacute;n : &nbsp;</label></div>
                <div>
                    <select id="cbo-medida-information-panel" name="cbo-medida-information-panel">
                    <option value="none">[-seleccionar-]</option>
                     <?php foreach($lista_periodos as $periodo): ?>
                        <option  value="<?php echo $periodo->getId() ?>"><?php echo $periodo->getDescripcion(); ?></option>
                     <?php endforeach; ?>
                    </select>
                </div>
                <div><label>Grupo de Trabajo:</label></div>
                <div>
                    <select id="cbo-group-tree-panel" name="cbo-group-tree-panel" style="min-width: 150px;">
                      <?php foreach($lista_grupos as $row):  ?>
                          <option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
                      <?php endforeach; ?>
                      </select>
                </div>
                <div>
                    <a class="cls-btn-a cls-btn-a-font" href="javascript:void(0);">Grabar</a>
                </div>
              </div>

        </li>
    </ul>
</div>


<div id="tabs" style="display: none;border: 0px solid;background: none;">
    <!-- ul es parte del teman UI -->
    <ul style="background: none;border: 0px solid;padding: 0px;">
        <li style="background: none;border: 0px solid;"><a style="cursor: pointer;" href="#tree"></a></li>
    </ul>
    
    <div id="tree" style="border-width:0px;">
               <div id="help-create-strategy-info-step-two" style="margin-left: 230px;z-index: 9000;position: absolute;display: none;width: 290px;padding-top: 70px;">
                        <div style="margin-bottom: 3px;" class="cls-option-help-step-two">
                            <div class="create-strategy-help-image-step-two"></div>
                            <div class="create-strategy-step-two">
                                <?php echo image_tag('implementacion/b_agregar.gif') ?>
                                <h4 style="display:inline-block;vertical-align: super;">Agregar Indicador</h4>
                                <p><span>Ahora puedes agregar otro indicadores partir de este para asi formar todo la estrategia</span></p>
                            </div>
                        </div>
               </div>
               <div id="help-create-strategy-info-step-three" style="margin-top: 145px;margin-left:145px;z-index: 9000;position: absolute;display: none;width: 290px;">
                        <div style="margin-bottom: 3px;" class="cls-option-help-step-three">
                            <div class="create-strategy-help-image-step-three"></div>

                            <div class="create-strategy-step-three">

                                <?php echo image_tag('implementacion/b_agregar.gif') ?>
                                <h4 style="display:inline-block;vertical-align: top;">Agregar Indicador</h4>
                                <p><span>Puedes seguir agregando indicadores a partir de este para asi formar todo la estrategia</span></p>

                                <!-- ----------------------------------------------- -->

                                <?php echo image_tag('implementacion/b_editar.gif') ?>
                                <h4 style="display:inline-block;vertical-align: top;">Editar Indicador</h4>
                                <p><span>Puedes editar los valores de cada indicador, es recomendable hacerlo cuando la estrategia este culminada al 100% </span></p>

                                <!-- ----------------------------------------------- -->

                                <?php echo image_tag('implementacion/b_eliminar.gif') ?>
                                <h4 style="display:inline-block;vertical-align: top;">Eliminar Indicador</h4>
                                <p><span> Elimina el idicador seleccionado y todos los indicadores que parten desde el.</span></p>

                            </div>

                        </div>
                   </div>


               <div class="body-tree" style="min-height: 420px; ">
                    <input type="hidden" id="id-tree" name="id-tree"  />
                    <input type="hidden" id="count-indicator" value="0" />
                    <div id="tree-master" style="width: auto;"> </div> 
              </div>
    </div>
 </div>

</div>


<div id="dialog-create-strategy" title="Configuraci&oacute;n Inicial de la Estrategia">
    <div style="float: left;width: 100%;margin-top: 0px;" class="dialog-crear-estrategia">
        <div align="right" style="display: none;padding-right: 10px;" id="help-create-strategy-iconhelp">
            <a onclick="change_configuration_help(true);layoutHelp('true');" href="javascript:void(0);"><?php echo image_tag('implementacion/help.png','title=ayuda alt=help.png') ?></a>
        </div>
        <div id="help-create-strategy-text" style="display: block;">
             <ul>
                <li style="height: auto;">
                    <div style="padding: 5px;">
                        <p style="margin: 0px;margin-top: 5px;">Siga los Siguientes pasos para crear su estrategia:</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="message_pnl_sing_in_error text-font-message" id="message-error-change-configuration" style="display: none;float: left;width: 95%;height: auto;margin-bottom: 10px;">
            Cree una estrategia antes de asignar un grupo
        </div>        
        <div style="display: inline-block;width: 270px;vertical-align: top;padding-left: 7px;">
            <ul>
               <li class="lblspan" style="padding-top: 10px;"><span>Titulo</span></li>
                <li><input type="text" id="txt-title-name-tree" name="txt-title-name-tree" /></li>
                <li class="lblspan"><span>Periodo de la informaci&oacute;n</span></li>
                <li> <select style="font-size: 13px;" id="cbo-medida-information" name="cbo-medida-information">
                            <option value="none">[-seleccionar-]</option>
                             <?php foreach($lista_periodos as $periodo): ?>
                                <option  value="<?php echo $periodo->getId() ?>"><?php echo $periodo->getDescripcion(); ?></option>
                             <?php endforeach; ?>
                     </select>
                </li>
                <li class="lblspan"><span>Grupo de Trabajo</span></li>
                <li>
                      <?php $diplay = (count($lista_grupos)<=0)? 'none' : 'block' ; ?>
                       <select style="font-size: 13px;display:<?php echo $diplay; ?>; " id="cbo-group-tree" name="cbo-group-tree" style="min-width: 150px;">
                           <option selected value="none">Seleccione grupo</option>
                              <?php foreach($lista_grupos as $row):  ?>
                                  <option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
                              <?php endforeach; ?>
                       </select>
                       <?php if(count($lista_grupos)<=0): ?>
                            <input type="text" id="txt-newgroup" name="txt-newgroup" placeholder="nombre grupo" />
                       <?php endif; ?>
                </li>
           </ul>
        </div>
        <div id="help-create-strategy-info" style="display: inline-block;width: 290px;padding-top: 10px;">
            <div style="margin-bottom: 3px;" class="cls-option-help">
                <div class="create-strategy-help-image"></div>
                <div class="create-strategy-help">
                    <h4>Titulo</h4>
                    <p><span>Es el nombre que sera utilizado para reconocer la estrategia en el fututo.</span></p>
                   
                </div>
            </div>
            <div  style="margin-bottom: 3px;" class="cls-option-help">
                <div class="create-strategy-help-image"></div>
                <div class="create-strategy-help">
                    <h4>Periodo de la informaci&oacute;;n</h4>
                    <p><span>Es la frecuencia con la que se generan los resportes de la estrategia.</span></p>

                </div>
            </div>
            <div  style="margin-bottom: 3px;" class="cls-option-help">
                <div class="create-strategy-help-image"></div>
                <div class="create-strategy-help">
                    <h4>Grupo de Trabajo</h4>
                    <p><span>Es el grupo que contiene a los participantes de la estrategia, servira para asignarles responsabilidades. </span></p>

                </div>

            </div>
        </div>
        <div style="display:block;padding-left: 5px;" id="help-create-strategy-checked">
            <input  type="checkbox" value="ck-help-ayuda"  onclick="change_configuration_help('false');layoutHelp('false');$(this).attr('checked', false);" />
            <span>No Deseo ver la ayuda nuevamente</span>
        </div>
        <div align="right" style="padding-right: 12px;margin-top: 10px;margin-bottom: 10px;">

             <div style="display: none;margin-right: 5px;" id="div-messaje-load">

                 <div style="margin-right: 2px;display: inline-block;font-size: 12px;font-weight: bold;color: #6E6E71;">Creando estrategia</div>
                 <div style="display: inline-block;vertical-align: middle;"><?php echo image_tag('implementacion/ajax-loader-newcirce.gif') ?></div>
                  

             </div>
            <input  class="btn-hummand" type="button" id="btn-create-tree" value="Crear" />
        </div>
       
       
         
    </div>
</div>

<div id="dialog-add-indicador" title="Crear Indicador">
        <input type="hidden" id="txt-id-tree" name="txt-id-tree"  />
        <input type="hidden" id="txt-id-previous" name="txt-id-previous"  />
       
        <div class="dialog-crear-indicador">
            
            <div style="display: inline-block;width: 270px;vertical-align: top;padding-left: 7px;">
                  <ul>
                       <li class="lblspan" style="padding-top: 10px;"><span>Titulo</span></li>
                       <li><input type="text" id="txt-title-name-indicador" name="txt-title-name-indicador" /></li>
                  </ul>
            </div>
           <div align="right" style="padding-right: 12px;margin-top: 10px;margin-bottom: 10px;">

             <div style="display: none;margin-right: 5px;" id="div-messaje-load-indicator">

                 <div style="margin-right: 2px;display: inline-block;font-size: 12px;font-weight: bold;color: #6E6E71;">Creando estrategia</div>
                 <div style="display: inline-block;vertical-align: middle;"><?php echo image_tag('implementacion/ajax-loader-newcirce.gif') ?></div>


             </div>
                <input class="btn-hummand" type="button" id="btn-save-indicator" value="Crear" />

            </div>
          

        </div>
</div>

<div id="dialog-delete-indicador" title="Eliminar Indicador">
    <input type="hidden" id="hd-id-indicator" name="hd-id-indicator" />
    <div class="dialog-delete-indicador" style="float: left;width: 100%;margin-top: 15px;">
        <ul style="width: 100%;margin-bottom: 15px;">
            <li style="text-align: center;width: 100%;">Al eliminar este indicador se borran tambien todos sus indicadores hijos</li>
            <li style="text-align: center;width: 100%;height:20px;">Esta Seguro que desar Eliminar este indicador? </li>
            <li style="text-align: center;">
                <div style="margin-left: 100px;margin-top: 10px;">
                    <input  type="button" id="btn-yes-confirmation-delete-indicator" value="Si" />&nbsp;&nbsp;
                    <input  type="button" id="btn-no-confirmation-delete-indicator" value="No" />
                </div>
           </li>
       </ul>
       <ul style="width: 100%;margin-bottom: 5px;">
             <li style="text-align: center;width: 100%;">
                  <div style="display: none;" id="div-messaje-load-d-indicator"> <?php echo image_tag('implementacion/ajax-loader-bar.gif') ?></div>
             </li>
       </ul>
    </div>
</div>



<div id="dialog-save-tree" title="Grabar Estrategia">
    <div style="float: left;width: 100%;margin-top: 15px;">
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


<div id="dialog-message-exit" title="HumanScorecard">
    <div class="dialog-crear-indicador">
        <div style="display: inline-block;width: 270px;vertical-align: top;padding-left: 7px;">
            <ul><li class="lblspan" style="padding-top: 10px;text-align: center;"><span>Esta seguro que desea salir, sin terminar de crear la estragia?</span></li></ul>
        </div>
        <div align="center" style="padding-right: 12px;margin-top: 25px;margin-bottom: 10px;">
            <input style="width: 50px;height: 30px;" class="btn-hummand" type="button" value="Salir" />
            <input style="width: 140px;height: 30px;"class="btn-hummand" type="button" value="Permanecer en la Web" />
        </div>
    </div>
</div>

<?php 
    
   $lib = new my_lib();
   
   if($user!=null)
   {
   
       $succesLayoutHelp = $lib->returnSucessHelp($sf_data->getRaw('user')->getOptions());
   }
   else
   {
       $succesLayoutHelp = false;
       //exit
   }

?>

<script type="text/javascript">
    



$(document).ready(function(){


     $.fx.speeds._default = 400;
     $('#add-new-group').dialog({
            autoOpen: false,
            width:300,
            minHeight:100,
            modal: true
      });
     
      layoutHelp('<?php echo $succesLayoutHelp ?>');
});



 function create_tree_c(){
        var  option =
        {
            "type":'POST',
            "url":'<?php echo url_for('tree/create_tree') ?>',
            "periodo":$(_cbo.omedida_information).val(),
            "grupo"   : $(_cbo.oidgroup_tree).val(),
            "newgrupo": $(_otxt.newGroup).val(),
            "title" : $(_otxt.oname_tree).val()
         }
        create_tree(option);
 }



function create_indicador_c(){
         var  option ={
            "type":'POST',
            "tree":$(_ohidden.oidtree).val(),
            "previous":$(_ohidden.oprevious).val(),
            "url":'<?php echo url_for('tree/create_indicador') ?>',
            "title" : $(_otxt.oname_indicador).val()
         }
         create_indicador_module_create(option);
}


$(_obtn.oyesc_indicator).click(function(){
        var  option ={
            "type":'POST',
            "indicator":$(_ohidden.oidindicator_delete).val(),
            "url":'<?php echo url_for('tree/delete_indicador') ?>'
         }
         $(_ohidden.countIndicator).val($(_ohidden.countIndicator).val()-1);
         delete_indicador_module_create(option);
});

function show_edit_indicator_module_create(id)
{
    var url  = '<?php echo url_for('@edit_strategy') ?>';
    var parm = '?id_tree='+$(_ohidden.idTree).val();
    var extra_parametro ='&from=create&node_id='+id;
    document.location.href= url+parm+extra_parametro;
}


$(_obtn.osave_configuracion_tree).click(function(){
    
   if($(_ohidden.oidtree).val()!=""){
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
   }else{
        $(_odialog.ocreate_strategy).dialog('open');
        $(_odiv.message_ajax[6].load).hide();
        $(_odiv.message_ajax[9].load).show();
   }

});

 function change_configuration_help(input)
 {
        var  option ={
                type:'POST',
                checked:input,
                option: 1,
                dataType:'json',
                url:'<?php echo url_for('create_strategy/changeHelpOption') ?>'
         }
         changeOptionHelp(option);
 }


 function save_new_group_cbo(){
        var  option ={
                "type":'POST',
                "name":$(_otxt.oname_group).val(),
                "dataType":'html',
                "url":'<?php echo url_for('working_groups/new_group_cbo') ?>'
         }
       new_group_cbo(option);
 }
 

</script>
