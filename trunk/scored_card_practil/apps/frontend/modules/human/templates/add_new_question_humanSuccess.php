<div  class="title-contenido-group-human" id="row-q-<?php echo $pregunta->getId() ?>">
        <ul>
            <li style="width: 40px;">
                <div style="padding-left: 8px; ">
                    <?php if($pregunta->getFlag()==1): ?>
                        <input type="checkbox"  />
                    <?php else:?>
                        <input type="checkbox" checked/>
                    <?php endif; ?>
                </div>
            </li>
            <li style="width: 350px;">
                <div ondblclick="edit_question('<?php echo $pregunta->getId() ?>')" id="div-question-label-<?php echo $pregunta->getId(); ?>">
                    <?php echo  $pregunta->getQuestion(); ?>
                </div>
                <div style="display: none;" id="div-question-edit-<?php echo $pregunta->getId(); ?>">
                    <input class="cls-input-text-edit-question" value="<?php echo  $pregunta->getQuestion(); ?>" type="text" id="txt-question-edit-<?php echo $pregunta->getId(); ?>" name="<?php echo $pregunta->getId(); ?>" />
                </div>
            </li>
            <li style="width: 80px;padding-left: 8px;"><div><a title="Editar Pregunta" href="javascript:void(0);" onclick="edit_question('<?php echo $pregunta->getId() ?>')" ><?php echo image_tag('implementacion/b_editar.gif', 'size=16x16') ?></a></div></li>
            <li style="width: 80px;padding-left: 8px;"><div><a title="Eliminar Pregunta" href="javascript:void(0);" onclick="delete_question('<?php echo $pregunta->getId() ?>')"><?php echo image_tag('implementacion/b_eliminar.gif', 'size=16x16') ?></a></div></li>
         </ul>
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