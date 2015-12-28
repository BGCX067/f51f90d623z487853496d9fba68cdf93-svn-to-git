<style type="text/css">
.cls-input-text-edit-question{
    width: 345px;
    height: 20px;
    border: 1px solid #E9E9E9;
}
.cls-input-text-edit-question:hover{
    border: 1px solid #F0FF6B;
}

.cls-input-text-edit-question:focus{
    border: 1px solid #F0FF6B;
}

.cls-check-question{
    cursor: pointer;
}


</style>

<div style="width: 750px;margin:20px auto;">
    <div style="float: left;">
                <div style="display: inline-block;vertical-align: middle;">
                    <label class="cls-txt"><b>Seleccione un Grupo:&nbsp;</b></label>
                </div>
                <div style="display: inline-block;">
                    <select id="cbo-list-group" style="width: 150px;height: 24px;" onchange="list_human(this)">
                        <?php foreach($list as $row): ?>
                        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
</div>


<div style="width: 750px;margin:0 auto;" id="div-content-humman">
         

</div>

  

<div id="dialog-add-question" title="Nueva Pregunta" style="display: none;">
     <div class="dialog-crear-indicador" style="float: left;width: 100%;margin-top: 15px;">
           <ul>
               <li style="height: 35px;">Pregunta:
                   ¿
                   <input style="width:350px;" type="text" id="txt-question" name="txt-question" />
                   ?
               </li>
           </ul>
           <ul>                 
                <li>
                    <div style="margin-left: 280px;">
                        <div style="display: none;margin-right:10px;float: left;margin-top: 9px;" id="div-messaje-load-question"> <?php echo image_tag('implementacion/ajax-loader-circe.gif') ?></div>
                        <div style="float: left;">
                             <input type="button" id="btn-save-question" value="Agregar" />
                        </div>
                    </div>
                   
                </li>
            </ul>            
        </div>
</div>


<script type="text/javascript">

    $(document).ready(function(){

         $.fx.speeds._default = 400;
         $('#dialog-add-question').dialog({
                autoOpen: false,
                width:450,
                minHeight:150,
                modal: true,
                open:function(){
                    $("#txt-question").val('').focus();
                }
          });

           
    });

 function open_question(){
          $('#dialog-add-question').dialog('open');
    }


    function list_human(cbo){
         var  option ={
                "type":'POST',
                "group":$(cbo).val(),
                "dataType":'json',
                "url":'<?php echo url_for('@humanscorecard_list_human_group') ?>'
         }
         show_list_human(option);
    }

   

    $("#btn-save-question").click(function(){
          var option = {
           "type":'POST',
           "questionText":  $("#txt-question").val(),
           "groupId": $("#hd-group-id-humman").val(),
           "url":'<?php echo url_for('@humanscorecard_ajax') ?>'
          }
          save_new_question(option);
    });


 function change_flag_question(check){
        var option = {
           "type":'POST',
           "questionId":  $(check).attr('name'),
           "value":       $(check).attr('checked'),
           "url":'<?php echo url_for('@humanscorecard_edit_check_ajax') ?>'
          }
         save_check_question(option);
 }

 function edit_question(id){
    $('#div-question-label-'+id).hide();
    $('#div-question-edit-'+id).show('open').focus();
    $('#txt-question-edit-'+id).focus().select();
 }

 function delete_question(id){
   var option = {
       "type":'POST',
       "questionId":id,
       "url": '<?php echo url_for('@humanscorecard_delete_question') ?>'
   }
   delete_question_ajax(option);
  
 }


   function change_flag_configuration(){
        var option = {
           "type":'POST',
           "ckHigher":   $("#ck-higher").attr('checked'),
           "ckMe":       $("#ck-auto").attr('checked'),
           "groupId":    $("#hd-group-id-humman").val(),
           "url":'<?php echo url_for('@humanscorecard_edit_configuration') ?>'
          }
     change_configuration_ajax(option);
  }

  function change_state_human(radio){
        $("#pnl-message-list-delete-tree").hide();
         var option = {
                               "type":'POST',
                               "groupId":    $("#hd-group-id-humman").val(),
                               "value":    $(radio).val(),
                               "url":'<?php echo url_for('@humanscorecard_state_human') ?>'
                            }
        if($(radio).val()=="on"){
            if($("#cbo-medida-information").val()=="none"){
                $("#pnl-message-list-delete-tree").fadeIn(500,function(){
                    $(radio).attr('checked', false);
                    $("#rd-human-score-card-off").attr('checked', true);                    
                });
                
            }else{
                
                  humanscorecard_state_human_ajax(option);
            }
        }else{
                humanscorecard_state_human_ajax(option);
        }

  }

  function change_periodo(comboxBox){
       $("#pnl-message-list-delete-tree").hide();
       var option = {
            "type":'POST',            
            "periodoId":     $(comboxBox).val(),
            "grupoId":       $("#hd-group-id-humman").val(),
            "url":'<?php echo url_for('@humanscorecard_edit_periodo') ?>'
       }
       
    if($(comboxBox).val()=="none"){
             change_periodo_ajax(option);
             $("#rd-human-score-card-on").attr('checked', false);
             $("#rd-human-score-card-off").attr('checked', true);            
    }else{
         change_periodo_ajax(option);
    }
  }

</script>
