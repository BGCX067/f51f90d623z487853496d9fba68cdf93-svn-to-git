<div style="background: none;min-height: 0px;height: auto;border: 0px solid;" class="cls-div-conent-page-tree" >

<?php include_component('componente_home', 'option_group') ?>
<div style="float: left;width: 100%;margin-top: 30px;">
     <div style="margin-top: 5px;float: left;">
             <span class="text-score-card_doce_n cls-title-create-edit-strategia">Listado de Grupos :</span>
     </div>
    <div style="margin-top: 2px;float: left;margin-left: 3px;">
            <select id="cbo-list-group" style="width: 150px;height: 24px;" onchange="list_contact(this)">
                <?php foreach($list as $row): ?>
                <option value="<?php echo $row->getId(); ?>"><?php echo $row->getName(); ?></option>
                <?php endforeach; ?>
            </select>
     </div>

 </div>

<div style="float: left;width: 100%;margin-top: 30px;margin-left: 19px;" id="content-ajax-contact"></div>




 </div>

<script type="text/javascript">

  function list_contact(cbo){
          var  option ={
                "type":'POST',
                "group":$(cbo).val(),
                "dataType":'json',
                "url":'<?php echo url_for('working_groups/list_contact_group') ?>'
         }
         show_list_contact(option);
}


$(document).ready(function(){
     $.fx.speeds._default = 400;
     $('#new-contact').dialog({
            autoOpen: false,
            width:300,
            minHeight:100,
            modal: true,
            open : function(){
                $(_otxt.oname_new_contact).val('').focus();
            }
      });

    <?php if(count($list)>0): ?>
              list_contact($("#cbo-list-group"));
    <?php endif; ?>




});

function show_new_contact(){
    $('#txt-email-contact').val('').focus();
    $('#new-contact').dialog({title:'Nuevo Contacto - [ ' + $(_cbo.oidgroup+' option:selected').html() +' ]'});
    if($(_cbo.oidgroup+' option:selected').html()!=""){
        $('#new-contact').dialog('open');
    }
    
}

function show_human(){
    document.location.href = '<?php echo url_for('@humanscorecard?workId=') ?>'+""+$(_cbo.oidgroup).val()+"";
}

  $(_obtn.onewContact).click(function(){

        var  option_success ={
                "type":'POST',
                "group":$(_cbo.oidgroup).val(),
                "dataType":'json',
                "url":'<?php echo url_for('working_groups/list_contact_group') ?>'
         }

       var option = {
           "type":'POST',
           "email":  $(_otxt.oname_new_contact).val(),
           "groupId":$( _cbo.oidgroup).val(),
           "url":'<?php echo url_for('working_groups/new_contact_group') ?>'
       }
       new_contact(option,option_success);
    });






</script>