<?php use_javascript('js-edit-strategy.js') ?>
<?php $my_lib = new my_lib(); ?>
<script type="text/javascript">
    var option_tree = {
        "treepk":'<?php echo 't-'.$tree->getId() ?>',
        "title":'<?php echo $tree->getName() ?>'
    }
     var data_indicador = '';
     var option_indicador = '';
$(document).ready(function(){
      $( "#tabs" ).tabs();
      $( "#tabs" ).show();

     <?php if($tree->getProduccion()=='production'): ?>
        editTreeProduction(option_tree);
     <?php else: ?>
        createTree(option_tree);
     <?php endif; ?>


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
         
     <?php if($tree->getProduccion()=='production'): ?>
         editIndicatorProduction(data_indicador,option_indicador);
     <?php else: ?>
         createindicador(data_indicador,option_indicador);
     <?php endif; ?>
<?php endforeach ; ?>
    resize_tree_aux();

});
</script>

    <?php $serviceBrowser = new browser(); ?>
    <?php $navegador      =  trim(strtolower($serviceBrowser->getNAV($_SERVER['HTTP_USER_AGENT'] ))) ; ?>
    <?php if (strpos($navegador, "firefox ")===false)   :?>
    <div style="display: block;" class="message_pnl_sing_in_alert message-browser"><span>Para poder visualizar tu estragia, te sugierimos utilizar <b>Mozilla Firefox</b> , puedes descargar la ultima version desde el siguiente link </span> <a target="_blank" href="<?php echo sfConfig::get('app_url_mozilla_browser_es') ?>" class="btn-dowload-fire"><span>Descargar</span></a></div>
    <?php endif; ?>
<div class="cls-div-conent-page-tree">
<div class="message_pnl_sing_in_alert add-message" id="message-mirror-start-tree">
    Esta estrategia se encuentra en produccion antes de poder editarla tiene que detener la estrategia.<br/>
    <b>Desea detener la estrategia?</b> <a href="<?php echo url_for('tree/create_mirror_tree?idTree='.$tree->getId()) ?>">Si</a>&nbsp;&nbsp;<a href="<?php echo url_for('@list_strategy') ?>">No</a>
</div>
<?php if($tree->getProduccion()!='production'): ?>
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
                            <option <?php if($tree->getPeriodoId()==$periodo->getId()):?>selected <?php endif; ?> value="<?php echo $periodo->getId() ?>"><?php echo $periodo->getDescripcion(); ?></option>
                     <?php endforeach; ?>
                    </select>
                </div>
                <div><label>Grupo de Trabajo:</label></div>
                <div>
                       <select id="cbo-group-tree-panel" name="cbo-group-tree-panel" style="min-width: 150px;">
                       <?php foreach($lista_grupos as $row):  ?>
                              <?php if($row->getId()==$tree->getGrupoTrabajoId()): ?>
                              <option selected value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
                              <?php  else:?>
                              <option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
                              <?php endif ?>
                        <?php endforeach; ?>
                        </select>
                </div>
                <div>
                    <a id="btn-save-configuracion-tree" onMouseOut="borderButtonUp(this);" onmouseup="borderButtonUp(this);" onMouseDown="borderButtonDown(this);"  class="cls-btn-a cls-btn-a-font" href="javascript:void(0);">Grabar</a>
                </div>
              </div>
        </li>
    </ul>
</div>
<?php else: ?>
    <!-- simplemente por que para filtrar los contactos necesito un id del grupo-->
    <input type="hidden" id="cbo-group-tree-panel" value="<?php echo $tree->getGrupoTrabajoId() ?>">
<?php endif; ?>
    <div class="pasos-edit-estrategia">
     <div style="margin-left: 15px;margin-top: 10px;vertical-align: super;">
         <h2>Paso 1</h2>
     </div>
    <div style="width: 360px;margin-left: 40px;"><p>Debe de terminar de <?php echo image_tag('implementacion/b_editar.gif', 'alt=editar') ?> <b>editar todos los indicadores</b> hasta que estos se encuentren con la informaci&oacute;n completa. </p></div>
    <div style="margin-left: 65px;margin-top: 10px;vertical-align: super;">
         <h2>Paso 2</h2>
     </div>
    <div style="width: 360px;margin-left: 15px;vertical-align: super;">
        Hacer clic sobre el bot&oacute;n <b>Poner en marcha la estrategia</b>
    </div>
    </div>

<div class="message_pnl_sing_in_error text-font-message" id="message-error-start-tree-group" style="display: none;width: auto;height: auto;margin-bottom: 10px;margin-left: 5px;">
    No puede poner en marcha la estragia <b>seleccione el periodo, grupo de trabajo</b> y presione "Grabar".
</div>
<div class="message_pnl_sing_in_alert" id="load-start-tree" style="display: none;width: 98%;height: auto;margin-bottom: 10px;">
    cargando.....
</div>
<div class="message_pnl_sing_in_error text-font-message" id="message-error-start-tree" style="display: none;;width: 98%;height: auto;margin-bottom: 10px;margin-left: 3px;">
    No puede poner en marcha la estrategia asegurese que todos los campos esten totalmente registrados
    y que los usuarios reponsables hallan aceptado pertenecer al grupo de trabajo.
</div>
    <div align="right" style="width: 100%;height: auto;margin-top: 5px;margin-left: 10px;">
 
            <div style="display: inline-block;vertical-align: text-bottom;width: 18px;height: 18px;background-color: #CDCDCD;"></div>
            <div class="text-sub-bar-score-card text-sub-bar-score-card-p" style="display: inline-block;margin-left: 2px;">Recien creados</div>
            <div style="display: inline-block;vertical-align: text-bottom;width: 18px;height: 18px;background-color: #14B2DD;margin-left: 10px;"></div>
            <div class="text-sub-bar-score-card text-sub-bar-score-card-p" style="margin-right: 15px;display: inline-block;margin-left: 2px;">Informacion completa</div>
            <div style="display: inline-block;margin-right: 20px;">
                <a id="btn-execute-tree" href="javascript:void(0);" class="btn-a-sc btn-a btn-a-text">Poner en marcha la estrategia</a>
            </div>
</div>
<div id="tabs" style="display: none;border: 0px solid;background: none;">
    <ul style="background: none;border: 0px solid;padding: 0px;">
        <li style="background: none;border: 0px solid;"><a style="cursor: pointer;" href="#tree"></a></li>
    </ul>
     <div  id="ui-widget-overlay" class="ui-widget-overlay" style="z-index: 499;display: none;"></div>
    <div id="tree" style="border-width:0px;">
               <div class="body-tree" style="min-height: 420px; ">                   
                    <div id="tree-master" style="width: auto;"> </div>
              </div>
    </div>
 </div>

  </div>
<div id="dialog-add-indicador" title="Crear Indicador">
        <input type="hidden" id="txt-id-tree" name="txt-id-tree"  />
        <input type="hidden" id="txt-id-previous" name="txt-id-previous"  />
        <div class="dialog-crear-indicador" style="float: left;width: 100%;margin-top: 15px;">
            <div class="cls-create-indicador-online">
               <ul>
                    <li>
                         <div><label>Titulo:</label></div>
                         <div>
                             <input type="text" id="txt-title-name-indicador" name="txt-title-name-indicador" />
                         </div>
                    </li>
                    <li>
                        <div><label>Responsable:</label></div>
                        <div>
                            <?php $serviceGoup = new GroupService(); ?>
                            <?php $successGroup = $serviceGoup->listContactGroup($tree->getGrupoTrabajoId()) ?>
                            <?php if($successGroup['success']): ?>
                            <select id="cbo-responsable-createIndicador">
                                   <?php foreach($successGroup['object'] as $row):  ?>
                                        <option value="<?php echo $row->getUserId() ?>"><?php echo $row->getEmail() ?></option>
                                   <?php endforeach; ?>
                            </select>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li>
                         <div style="padding: 10px 6px;vertical-align: middle;margin-bottom: 3px;" class="bg_valor_optimo">Valor Optimo</div>
                         <div><input style="width: 180px;" type="text" size="5" id="txt-value-optime-create-indicator" name="txt-value-optime-create-indicator"/></div>
                         <div style="padding: 10px 6px;vertical-align: middle;margin-bottom: 3px;" class="bg_valor_deseado">Valor Deseado</div>
                         <div><input style="width: 180px;" type="text" size="5" id="txt-value-desire-create-indicator" name="txt-value-desire-create-indicator" /></div>
                         <div style="padding: 10px 6px;vertical-align: middle;margin-bottom: 3px;" class="bg_valor_minimo">Valor Minimo</div>
                         <div><input style="width: 180px;" type="text" id="txt-value-mim-create-indicator" name="txt-value-mim-create-indicator" /></div>
                   </li>
                    <li>
                         <div style="margin-left: 147px;">
                       <input type="button" id="btn-save-indicator" value="Crear" />
                       </div>
                    </li>
               </ul>  
            </div>

            <ul style="width: 100%;margin-bottom: 5px;">
                 <li style="text-align: center;width: 100%;">
                     <div style="display: none;margin-top:-23px;margin-right:12px;" id="div-messaje-load-indicator"> <?php echo image_tag('implementacion/ajax-loader-circe.gif') ?></div>
                 </li>
             </ul>
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

<div style="height: 100%;" id="dialog-configuration-indicador" title="Edici&oacute;n Estrategia">
    <input type="hidden" id="hd-edit-indicator" name="hd-edit-indicator" />
    <input value="<?php echo $tree->getGrupoTrabajoId() ?>" type="hidden" id="hd-id-grupo-indicator" name="hd-id-grupo-indicator" />


    <div>
        <div id="message_validator"style="border: solid 1px red;display: none;" >
            Error en el Ingreso de Datos
        </div>
        <div id="div-loading-edit-indicador" style="text-align: center;">
            <div style="margin: 20px auto;">
                 <?php echo image_tag('ajax-loader-circe.gif')?><br/><br/>
                 <?php echo image_tag('ajax-loader-text.gif')?>
            </div>
                
            
        </div>
        
        <div style="width: 100%;height: auto;" id="div-content-generl-edit-indicador" >
        
                     <div class="title-edit-indicator">
                            <input type="text" value="Title" id="txt-title-edit-indicator" name="txt-title-edit-indicator" />
                     </div>
                     <div class="contend-datos-edit-indicator" id="dialog-configuration-indicador-body">
                         <fieldset>
                             <legend><label>Datos</label></legend>

                             <div id="contenedor-datos-edit-estrategia">
                                    <div class="cls-columna-uno">
                                        <div><label for="txt-description-edit-indicator">Descripci&oacute;n del objetivo:</label></div>
                                        <div><textarea id="txt-description-edit-indicator" name="txt-description-edit-indicator"></textarea></div>
                                    </div>
                                    <div class="cls-columna-dos">
                                        <?php if($tree->getProduccion()!='production'): ?>
                                                     <div class="bg_valor_optimo">Valor Optimo</div>
                                                     <div><input type="text" size="5" id="txt-value-optime-edit-indicator" name="txt-value-optime-edit-indicator"/></div>
                                                     <div class="bg_valor_deseado">Valor Deseado</div>
                                                     <div><input type="text" size="5" id="txt-value-desire-edit-indicator" name="txt-value-desire-edit-indicator" /></div>
                                                     <div class="bg_valor_minimo">Valor Minimo</div>
                                                     <div><input type="text" id="txt-value-mim-edit-indicator" name="txt-value-mim-edit-indicator" /></div>
                                                    
                                        <?php else:  ?>
                                             <div class="message_pnl_sing_in_alert" style="width:270px;padding: 3px;">
                                                 <p>Ahora que la estrategia esta en produccion puedes editar los valores minimos, maximos,y deseados desde el modulo de proyecciones, puedes ingresar al modulo de proyeciones desde el menu superior o haciendo click <a style="color:blue;" href="<?php echo url_for('projections/index?idTree='.$tree->getid()) ?>">aqui</a> </p>
                                             </div>
                                        <?php endif; ?>

                                         <div style="width: 85px;"> <label>Responsable</label></div>
                                         <div>
                                               <?php $serviceGoup = new GroupService(); ?>
                                               <?php $successGroup = $serviceGoup->listContactGroup($tree->getGrupoTrabajoId()) ?>
                                               <?php if($successGroup['success']): ?>
                                               <select id="hd-resposable-final" name="hd-resposable-final">
                                                       <?php foreach($successGroup['object'] as $row):  ?>
                                                            <option value="<?php echo $row->getUserId() ?>"><?php echo $row->getEmail() ?></option>
                                                       <?php endforeach; ?>
                                               </select>
                                               <?php endif; ?>
                                         </div>
                                         <div  style="width: 85px;"> <label id="label-cbo-manejo-data">Ingreso de data</label></div>
                                         <div>
                                             <select id="cbo-manejo-data">
                                                 <option value="1">Manual</option>
                                                 <option value="2">Conector externo</option>
                                             </select>
                                         </div>
                                    </div>
                                   <?php if($tree->getProduccion()!='production'): ?>
                                    <div class="cls-columna-tres">
                                            <div id="help-create-strategy-info" style="display: inline-block;width: 290px;padding-top: 10px;">
                                                <div style="margin-bottom: 3px;" class="cls-option-help-step-three">                                              

                                                    <div class="edit-strategy-help">
                                                        <div class="bg_valor_optimo" style="padding: 1px;width: 13px;height: 13px;">&nbsp;</div>
                                                        <h4 style="display:inline-block;vertical-align: top;">Valor Optimo</h4>
                                                        <p><span></span></p>

                                                        <!-- ----------------------------------------------- -->

                                                        <div class="bg_valor_deseado" style="padding: 1px;width: 13px;height: 13px;">&nbsp;</div>
                                                        <h4 style="display:inline-block;vertical-align: top;">Valor Deseado</h4>
                                                        <p><span> </span></p>

                                                        <!-- ----------------------------------------------- -->

                                                        <div class="bg_valor_minimo" style="padding: 1px;width: 13px;height: 13px;">&nbsp;</div>
                                                        <h4 style="display:inline-block;vertical-align: top;">Valor Minimo</h4>
                                                        <p><span></span></p>

                                                        <h4 style="display:inline-block;vertical-align: top;">Responsable</h4>
                                                        <p><span>Es la persona encargada de este indicador</span></p>

                                                        <h4 style="display:inline-block;vertical-align: top;">Ingreso de Data</h4>
                                                        <p><span> Puede ser manual o automatica, esto indicara si la informacion sera recopilada desde un conector externo.</span></p>


                                                    </div>
                                                  </div>                                               
                                             </div>
                                             <div style="display:none;padding-left: 155px;" id="help-create-strategy-checked">
                                                 <span>No Deseo ver la ayuda </span>
                                                 <input  type="checkbox" value="ck-help-ayuda" />
                                             </div>
                                      </div>
                                       <?php endif; ?>

                             </div>


                             
                         </fieldset>
                         <fieldset id="conectores-inferiores-content">
                             <legend><label>Conectores Inferiores</label></legend>
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
                                        <div id="contend-datos-edit-indicator-children" style="display: none;padding: 25px 0px;padding: 10px;">
                                        </div>
                                        <div style="text-align: left;" id="div-pnl-conector">
                                                <select id="conector" name="conector">
                                                    <option value="Google">Google Analytics</option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="Twitter">Twitter</option>
                                                </select>
                                                <select id="conector_atributos" name="conector_atributos">
                                                    <option value="">Selecciona: </option>
                                                </select>
                                            <p id="network_description" style="text-align: justify;"></p>
                                                <div id="conector-google-content" style="display: none;">
                                                <form action="<?php echo url_for('@googleAnalyticsConnect') ?>" method="post" id="frmconector-google-content">
                                                  <input type="hidden" id="hdIndicadorId" name="hdIndicadorId" />
                                                  <div id="is_connected_google_analytics_no" style="display: none;">
                                                    <a href="javascript:void(0)" onclick="connect_google()" class="button">Conectarme a Google Analytics</a>
                                                    <?php echo $sf_user->getFlash('msg') ?>
                                                  </div>
                                                  <div id="is_connected_google_analytics_yes" style="display: none;">
                                                    Seleccione una cuenta:
                                                    <select id="tableId" name="tableId"></select>
                                                  <br /><br />
                                                    <div id="rango-fechas">
                                                      <h3>Rango de fechas</h3>
                                                        Ingrese la fecha de inicio
                                                        <input type="text" id="fec_ini" name="fec_ini" value="2011-10-01" /> ~ <?php echo date("Y-m-d") ?><input type="hidden" id="fec_fin" name="fec_fin" value="<?php echo date("Y-m-d") ?>" />
                                                      <a href="javascript:void(0)" id="obtener-google-analytics-attr" style="color: blue;">Test</a>
                                                    </div>
                                                  </div>
                                                </form>
                                                </div>
                                                <div id="conector-facebook-content" style="display: none;">
                                                        <br />
                                                    Ingrese su ID o nombre de Usuario <br /><br />
                                                    <label style="color: green;font-style: italic;"> http://www.facebook.com/<input type="text" id="facebook_username" />/</label>
                                                    <a href="javascript:void(0)" id="obtener-facebook-attr" style="color: blue;">Test</a>
                                                </div>
                                                <div id="conector-twitter-content" style="display: none;">
                                                        <br />
                                                    Ingrese Usuario <input type="text" id="twitter_username" />
                                                    <a href="javascript:void(0)" id="obtener-twitter-attr">Test</a>
                                                </div>
                                                <div id="data-valor-actual-content" style="display: none;">
                                                  Dato actual: <label id="data-valor-actual"></label>
                                                </div>
                                </div>
                                </li>
                              </ul>
                         </fieldset>
                         <div style="text-align: center;margin-top:15px;">
                             <a style="color: #FFF;" href="javascript:void(0);" id="btn-save-edit-indicator" class="btn-a-sc btn-a btn-a-text">Grabar</a>
                         </div>
                     </div>
             
        </div>
  </div>
</div>
<div  id="dialog-save-tree" title="Grabar Estrategia">
    <div style="float: left;width: 100%;margin-top: 15px;">
    </div>
</div>
<script type="text/javascript">

function borderButtonDown(a)
{
     $(a).css("border","1px solid #CFCFCF");
}
function borderButtonUp(a)
{
     $(a).css("border","1px solid #BFBFBF");
}


var networks = [
  <?php foreach($networks as $network){ ?>
    { name: '<?php echo $network->getName(); ?>', models: [
        <?php
        $c=new Criteria();
        $c->add(DetNetworkAttributePeer::NETWORK_ID, $network->getId());
        $atributos = DetNetworkAttributePeer::doSelect($c); ?>
          <?php $count_attr = count($atributos); ?>
          <?php $c=1; ?>
            <?php foreach($atributos as $atributo){ ?>
                { id: '<?php echo $atributo->getAttributeId(); ?>', keyword: '<?php echo $atributo->getAttribute()->getKeyWord(); ?>', description_short: '<?php echo $atributo->getAttribute()->getDescriptionShort(); ?>', name: '<?php echo $atributo->getAttribute()->getKeyWord(); ?>' }<?php
                if($count_attr!=$c){
                    echo ',';
                }?>
              <?php $c++; ?>
            <?php } ?>
        ]},
  <?php } ?>
];
var title = new Array();
<?php $count=1; ?>
<?php foreach($network_attributes as $na){ ?>
    title[<?php echo $count; ?>] = "<?php echo $na->getAttribute()->getDescription(); ?>";
<?php $count++; ?>
<?php } ?>
$(document).ready(function(){
  $("#obtener-facebook-attr").click(function(){
        var facebook_username = $("#conector-facebook-content #facebook_username").val();
        var attr_id = $("#conector_atributos").val();
        if(attr_id!='' && attr_id!='undefined' && facebook_username!=''){
            $.ajax({
                type: "post",
                url: "<?php echo url_for('edit_strategy/getLikes') ?>",
                data: "facebook_username="+facebook_username+"&facebook_attr_id="+attr_id,
                success:function(html){
                    alert(html);
                }
            });
        }else{
            alert('Ingrese username y elija atributo');
            return false;
        }
    });
    $("#obtener-twitter-attr").click(function(){
        var twitter_screen_name = $("#conector-twitter-content #twitter_username").val();
        var attr_id = $("#conector_atributos").val();
        if(attr_id!='' && attr_id!='undefined' && twitter_screen_name!=''){
            $.ajax({
                type: "post",
                url: "<?php echo url_for('edit_strategy/getFollowers') ?>",
                data: "twitter_screen_name="+twitter_screen_name+"&twitter_attr_id="+attr_id,
                success:function(html){
                    alert(html);
                }
            });
        }else{
            alert('Ingrese username y elija atributo');
            return false;
        }
    });
    $("#obtener-google-analytics-attr").click(function(){
        var hdIndicadorId = $("#hdIndicadorId").val();
        var tableId = $("#tableId").val();
        var google_analytics_fec_ini = $("#conector-google-content #fec_ini").val();
        var google_analytics_fec_fin = $("#conector-google-content #fec_fin").val();
        var attr_id = $("#conector_atributos").val();
        if(attr_id!='' && attr_id!='undefined' && google_analytics_fec_ini!='' && google_analytics_fec_fin!=''){
            $.ajax({
                type: "post",
                url: "<?php echo url_for('edit_strategy/getGoogleAnalyticsData') ?>",
                data: "hdIndicadorId="+hdIndicadorId+"&tableId="+tableId+"&google_analytics_fec_ini="+google_analytics_fec_ini+"&google_analytics_fec_fin="+google_analytics_fec_fin+"&google_analytics_attr_id="+attr_id,
                success:function(html){
                    alert(html);
                }
            });
        }else{
            alert('Ingrese rango de fechas y elija atributo');
            return false;
        }
    });
     
     <?php if($from=='g'){ ?>
            show_edit_indicator('<?php echo $node_id ?>');
     <?php }elseif($from=='create'){ ?>
             show_edit_indicator('<?php echo $node_id ?>');
     <?php } ?>
   
});

$(_obtn.ocreate_tree).click(function(){
        var  option ={
            "type":'POST',
            "url":'<?php echo url_for('tree/create_tree') ?>',
            "title" : $(_otxt.oname_tree).val()
         }
        create_tree(option);
 });

/*Funcion crea un indicador asi la estrategia este en produccion */
function create_indicador_c(){
         var  option =
         {   
            "type":'POST',
            "tree":             $(_ohidden.oidtree).val(),
            "previous":         $(_ohidden.oprevious).val(),
            "title":            $(_otxt.oname_indicador).val(),            
            "valorMinimo":      $(_otxt.ocreate_min_indic).val(),
            "valorDeseado":     $(_otxt.ocreate_desire_indic).val(),
            "valorOptimo":      $(_otxt.ocreate_optimindic).val(),
            "responsableId":    $("#cbo-responsable-createIndicador").val(),
            "responsableEmail": $('#cbo-responsable-createIndicador option:selected').text(),
            "url":'<?php echo url_for('tree/createIndicadorOnline') ?>'

         }
         create_indicador(option);
}
function connect_google(){
    var  option ={
            "type":'POST',
            "title":            $(_otxt.oedit_title_indic).val(),
            "description":      $(_otxt.oedit_description_indic).val(),
            "valueMin":         $(_otxt.oedit_min_indic).val(),
            "valueDes":         $(_otxt.oedit_desire_indic).val(),
            "valueOpt":         $(_otxt.oedit_optimindic).val(),
            "responsableId":    $(_ohidden.oidresponsable).val(),
            "responsableEmail": $('#hd-resposable-final option:selected').text(),
            "workGroup":        $(_cbo.oidgroup_tree).val(),
            "conectorId":       $(_cbo.oidconector).val(),
            "attributeId":      $(_cbo.oidattribute).val(),
            "tableId":          $(_cbo.oidtable).val(),
            "facebook_username":$(_otxt.ofacebook_username).val(),
            "twitter_username": $(_otxt.otwitter_username).val(),
            "google_fec_ini":   $(_otxt.ogoogle_fec_ini).val(),
            "google_fec_fin":   $(_otxt.ogoogle_fec_fin).val(),
            "oaux_manejo_data": $(_cbo.oaux_manejo_data).val(),
            "indicatorId":      $(_ohidden.oidondicatoredit).val(),
            "url":              '<?php echo url_for('@saveindicador') ?>'
         }
   save_edit_indicador_g(option);
}
$(_obtn.osave_edit_indicator).click(function(){
     var  option ={
            "type":'POST',
            "title":            $(_otxt.oedit_title_indic).val(),
            "description":      $(_otxt.oedit_description_indic).val(),
            "valueMin":         $(_otxt.oedit_min_indic).val(),
            "valueDes":         $(_otxt.oedit_desire_indic).val(),
            "valueOpt":         $(_otxt.oedit_optimindic).val(),
            "responsableId":    $(_ohidden.oidresponsable).val(),
            "responsableEmail": $('#hd-resposable-final option:selected').text(),
            "workGroup":        $(_cbo.oidgroup_tree).val(),
            "conectorId":       $(_cbo.oidconector).val(),
            "attributeId":      $(_cbo.oidattribute).val(),
            "tableId":          $(_cbo.oidtable).val(),
            "facebook_username":$(_otxt.ofacebook_username).val(),
            "twitter_username": $(_otxt.otwitter_username).val(),
            "google_fec_ini":   $(_otxt.ogoogle_fec_ini).val(),
            "google_fec_fin":   $(_otxt.ogoogle_fec_fin).val(),
            "indicatorId":      $(_ohidden.oidondicatoredit).val(),
            "oaux_manejo_data": $(_cbo.oaux_manejo_data).val(),
            "url":              '<?php echo url_for('@saveindicador') ?>',
            "url2":             '<?php echo url_for('edit_strategy/strategy') ?>'+'?id_tree='+<?php echo $tree->getId() ?>
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

$(_obtn.onotc_indicator).click(function(){
          $(_odialog.odelete_indicator).dialog('close');
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
function show_edit_indicator(id){
    /*si exite un grupo te trabajo seleccionado*/
    if($(_ohidden.ogroupindictor).val()!="")
    {
         /* muestro la ventana flotante */
         $(_odialog.oconfiguration_indicador).dialog('open');
         /* escondo todo el formulario (lo mostrare cuando halla cargado toda la informacion) */
         $(_odiv.div_content[0].pk).hide(0,function(){
                /* muestro la imagen del loadAjax */
                $(_odiv.message_ajax[3].load).show();
                /* alineo la ventana flotante siempre al centro  */
                $(_odialog.oconfiguration_indicador).dialog("option", "position", "center");
            });
         
        /*creo las opciones para buscar la informacion del indicador (via ajax)*/
        var  option ={
                "type":'POST',
                "indicator":id,
                "dataType":'json',
                "url":'<?php echo url_for('@indicator') ?>'
             }
         /* ejecuto el ajax para obenter y llenar la informacion del indicador*/
         fill_json_indicator(option);
    }
    else
    {
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
</script>
