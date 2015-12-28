 <div style="float: left;margin-top: 10px;width: 550px;">
     <input type="hidden" value="<?php echo $group->getId() ?>" id="hd-group-id-humman" />
            <div class="human-ul-option">
                <ul>
                    <li>
                        <div style="float: left;">
                            <?php if($group->getHumanHigher()=="off"): ?>
                            <input class="cls-check-question" id="ck-higher" type="checkbox" onclick="change_flag_configuration();"  />
                            <?php else:?>
                                <input class="cls-check-question" id="ck-higher" type="checkbox" checked onclick="change_flag_configuration();"  />
                            <?php endif; ?>
                        </div>
                        <div style="float: left;padding-top: 3px;" class="cls-txt">evaluar superiores</div>
                    </li>
                    <li>
                        <div style="float: left;">
                            <?php if($group->getHumanMe()=="off"): ?>
                            <input  class="cls-check-question" type="checkbox" id="ck-auto" onclick="change_flag_configuration();" />
                            <?php else:?>
                                <input  class="cls-check-question" type="checkbox" id="ck-auto" checked  onclick="change_flag_configuration();" />
                            <?php endif; ?>

                        </div>
                        <div style="float: left;padding-top: 3px;" class="cls-txt">auto evaluacion</div>
                    </li>
                </ul>
            </div>
         </div>
        <div style="float: left;margin-top: 10px;">
        <div class="listado_human">
            <ul>
                <li style="width: 40px;"><div style="width: auto;">&nbsp;</div></li>
                <li style="width: 350px;"><div style="width: auto;padding-left: 145px;">Preguntas</div></li>
                <li style="width: 80px;"><div style="width: auto;">Editar</div></li>
                <li style="width: 80px;"><div style="width: auto;">Eliminar</div></li>
            </ul>
        </div>
            <?php $cont=10; ?>
            <?php foreach($list_question as $row): ?>
                <div  class="title-contenido-group-human" id="row-q-<?php echo $row->getId() ?>">
                    <ul>
                        <li style="width: 40px;">
                            <div style="padding-left: 8px; ">
                                <?php if($row->getFlag()==1): ?>
                                    <input class="cls-check-question" type="checkbox" name="<?php echo $row->getId() ?>" onclick="change_flag_question(this)" />
                                <?php else:?>
                                    <input class="cls-check-question" type="checkbox" name="<?php echo $row->getId() ?>" checked onclick="change_flag_question(this)"/>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li style="width: 350px;">
                            <div title="<?php echo $row->getQuestion(); ?>" ondblclick="edit_question('<?php echo $row->getId() ?>')" id="div-question-label-<?php echo $row->getId(); ?>">
                                <?php
                                  $cantidad = strlen($row->getQuestion());
                                      if($cantidad>55){
                                          $question= substr($row->getQuestion(), 0, 52);
                                          $question = $question.' ....';
                                          echo $question;
                                      }else{
                                          echo $row->getQuestion();
                                      }

                                ?>
                            </div>
                            <div style="display: none;" id="div-question-edit-<?php echo $row->getId(); ?>">
                                <input tabindex="<?php echo $cont ?>" class="cls-input-text-edit-question" value="<?php echo  $row->getQuestion(); ?>" type="text" id="txt-question-edit-<?php echo $row->getId(); ?>" name="<?php echo $row->getId(); ?>" />
                            </div>
                        </li>
                        <li style="width: 80px;padding-left: 8px;"><div><a title="Editar Pregunta" href="javascript:void(0);" onclick="edit_question('<?php echo $row->getId() ?>')" ><?php echo image_tag('implementacion/b_editar.gif', 'size=16x16') ?></a></div></li>
                        <li style="width: 80px;padding-left: 8px;"><div><a title="Eliminar Pregunta" href="javascript:void(0);" onclick="delete_question('<?php echo $row->getId() ?>')"><?php echo image_tag('implementacion/b_eliminar.gif', 'size=16x16') ?></a></div></li>
                     </ul>
                </div>
            <?php $cont++; ?>
            <?php endforeach; ?>
            <div id="div-aux"></div>

        </div>
    <div style="float: left;margin-top: 10px;width: auto;">
        <div class="cls-txt" style="float: left;margin-top: 10px;width: auto;padding-top: 2px;" >
            <b> Peridodo de Encuestas :</b> &nbsp;
           </div>
       <div style="float: left;margin-top: 10px;width: auto;" >
           <select id="cbo-medida-information" name="cbo-medida-information" onchange="change_periodo(this)">
                            <option value="none" selected>[-seleccionar-]</option>
                         <?php foreach($lista_periodos as $periodo): ?>
                            <option <?php if($group->getHumanPeriodoId()==$periodo->getId() ){ ?> selected <?php } ?> value="<?php echo $periodo->getId() ?>"><?php echo $periodo->getDescripcion(); ?></option>
                         <?php endforeach; ?>
            </select>
       </div>
       <div style="float: left;margin-top: 10px;width: auto;padding-left: 161px;">
            <a class="btn-a btn-a-text" href="javascript:void(0);" onclick="open_question()">Agregar Pregunta</a>
        </div>
    </div>

    <div style="float: left;margin-top: 10px;width: auto;">
           <div style="float: left;margin-top: 10px;width: auto;padding-left: 175px;">
                   <label>Activo</label>
               <?php if($group->getHumanFlag()==1): ?>
                   <input value="on" onchange="change_state_human(this)"  class="cls-check-question" type="radio" name="rd-human-score-card"  id="rd-human-score-card-on"  />
                   <label>Desactivado</label>
                 <input  value="off" onchange="change_state_human(this)"  class="cls-check-question" type="radio" name="rd-human-score-card" id="rd-human-score-card-off" checked />
               <?php else: ?>
                 <input value="on" onchange="change_state_human(this)"  class="cls-check-question" type="radio" name="rd-human-score-card"  id="rd-human-score-card-on" checked />
                   <label>Desactivado</label>
                 <input value="off" onchange="change_state_human(this)" class="cls-check-question" type="radio" name="rd-human-score-card"  id="rd-human-score-card-off" />
               <?php endif; ?>
            </div>
    </div>


      <div style="width: 565px;;height: auto;display: none;float: left;  " id="pnl-message-list-delete-tree" >
          <div class="cls-message-info-scorecard" style="padding: 7px;">
            <ul>
                <li style="width: 100%;">
                    <div style="padding-left: 10px;text-align: center">
                        <div style="padding-top: 5px;">
                            No puede activar las preguntas, debe tener almenos <b>una pregunta y seleccionar un Periodo de Encuestas</b>
                        </div>
                      </div>
                </li>
            </ul>

        </div>
    </div>



<script type="text/javascript">

    $(document).ready(function(){

        $(".cls-input-text-edit-question").keypress(function(event){
                  if (event.which == 13) {
                            var option = {
                               "type":'POST',
                               "questionText":  $(this).val(),
                               "questionId":    $(this).attr('name'),
                               "url":'<?php echo url_for('@humanscorecard_edit_ajax') ?>'
                              }
                           edit_question_ajax(option);
                    }
            });
    });

    </script>
