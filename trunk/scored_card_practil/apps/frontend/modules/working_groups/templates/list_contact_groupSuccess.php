<?php $user = $sf_user->getAttribute(sfConfig::get('app_session_current_user')); ?>

<?php if(count($lista)>1): ?>
<div class="listado_estrategia" style="background: #373737;width: 575px">
        <ul >
            <li style="width: 250px;text-align: center;"><div style="width: auto;">Email</div></li>
            <li style="width: 200px;text-align: center;"><div style="width: auto;">Superior</div></li>
            <li style="width: 125px;text-align: center;"><div style="width: auto;">Eliminar</div></li>
        </ul>
</div>
<?php $conta=0; ?>
<?php foreach($lista as $row): ?>

  <?php if($row->getEmail() != $user->getEmail()): ?>
          <?php if(is_object($row->getUserSc())): ?>
                 <div style="width: 575px;"  <?php if($conta%2==0){ ?>  class="listado_contenido" <?php }else{ ?>  class="listado_contenido_impar"  <?php }?>  >
                    <ul>
                          <li style="width: 250px;padding: 0px;" ><div style="padding-left: 5px;">  <?php echo $row->getEmail() ?></div></li>
                          <li style="width: 200px;padding: 0px;" >
                              <div style="padding-left: 0px;float: left;">
                                  <select style="width: 175px;" name="cbo-bost-group" id="cbo-bost-group-<?php echo $row->getId() ?>">
                                       <option value="none" selected>[- Seleccionar -]</option>
                                       <?php foreach($lista_detalle as $subrow): ?>
                                       <?php if($row->getEmail() != $subrow->getEmail()): ?>
                                                 <?php if(is_object($subrow->getUserSc())): ?>
                                                         <?php if($row->getBostId() == $subrow->getUserSc()->getId() ): ?>
                                                                 <option value="<?php echo $subrow->getUserSc()->getId() ?>" selected> <?php echo $subrow->getEmail() ?></option>
                                                         <?php else :?>
                                                                 <option value="<?php echo $subrow->getUserSc()->getId() ?>"> <?php echo $subrow->getEmail() ?></option>
                                                         <?php endif; ?>
                                                 <?php endif; ?>
                                         <?php endif; ?>
                                       <?php  endforeach;?>
                                  </select>
                               </div>
                               <div style="padding-left: 5px;float: left;padding-top: 2px;">
                                   <a style="display: block;"  id="btn-save-id-<?php echo $row->getId() ?>" title="grabar" href="javascript:void(0)" onclick="save_bost('<?php echo $row->getId() ?>')">
                                    <?php echo image_tag('implementacion/grabar.png') ?>
                                   </a>
                                   <div title="grabando.." id="btn-save-load-<?php echo $row->getId() ?>" style="display: none;">
                                     <?php echo image_tag('implementacion/grabar-hover.png') ?>
                                   </div>

                                 </div>
                          </li>
                          <li style="width: 125px;padding: 0px;" ><div style="padding-left: 55px;"> <?php echo image_tag('implementacion/b_eliminar.gif') ?> </div></li>
                    </ul>
                 </div>
        <?php else: ?>
                  <div style="width: 575px;"  <?php if($conta%2==0){ ?>  class="listado_contenido" <?php }else{ ?>  class="listado_contenido_impar"  <?php }?>  >
                    <ul>
                          <li style="width: 250px;padding: 0px;" >
                              <div style="float: left;padding-left: 2px;"><?php echo image_tag('implementacion/warning-icon.png') ?></div>
                              <div style="float: left;padding-left: 5px;padding-top: 2px;">  <?php echo $row->getEmail() ?>
                              </div>
                          </li>
                          <li style="width: 200px;padding: 0px;" >
                              <div style="padding-left: 0px;float: left;">
                                  <select disabled style="width: 175px;" name="cbo-bost-group" id="cbo-bost-group-<?php echo $row->getId() ?>">
                                       <option value="none" selected>[- Seleccionar -]</option>
                                       <?php foreach($lista_detalle as $subrow): ?>
                                       <?php if($row->getEmail() != $subrow->getEmail()): ?>
                                                 <?php if(is_object($subrow->getUserSc())): ?>
                                                         <?php if($row->getBostId() == $subrow->getUserSc()->getId() ): ?>
                                                                 <option value="<?php echo $subrow->getUserSc()->getId() ?>" selected> <?php echo $subrow->getEmail() ?></option>
                                                         <?php else :?>
                                                                 <option value="<?php echo $subrow->getUserSc()->getId() ?>"> <?php echo $subrow->getEmail() ?></option>
                                                         <?php endif; ?>
                                                 <?php endif; ?>
                                         <?php endif; ?>
                                       <?php  endforeach;?>
                                  </select>
                               </div>
                               <div style="padding-left: 5px;float: left;padding-top: 2px;">                                   
                                   <div title="grabar" id="btn-save-load-<?php echo $row->getId() ?>" style="display: block;">
                                     <?php echo image_tag('implementacion/grabar-hover.png') ?>
                                   </div>
                                 </div>
                          </li>
                          <li style="width: 125px;padding: 0px;" ><div style="padding-left: 55px;"> <?php echo image_tag('implementacion/b_eliminar.gif') ?> </div></li>
                    </ul>
                 </div>
        <?php endif; ?>

    <?php $conta++; ?>
    <?php endif; ?>

 

<?php  endforeach;?>

<div style="float: left;width: 555px;margin-top: 25px;border: 1px solid silver;padding: 8px;">
    <div style="float: left;">
         <?php echo image_tag('implementacion/warning-icon-24.png') ?>
    </div>
    <div style="float: left;padding-top: 7px;padding-left: 3px;" class="text-score-card_doce_n">
         El usuario todavia no acepta pertenecer al grupo de trabajo.
    </div> 
</div>

<?php else: ?>

    <div style="float: left;width: 495;border: 1px solid silver;padding: 8px;">
    <div style="float: left;">
         <?php echo image_tag('implementacion/info-icon-24.png') ?>
    </div>
    <div style="float: left;padding-top: 7px;padding-left: 3px;" class="text-score-card_doce_n">
        Todavia no tienes a ningun contacto en este grupo agrega uno haciendo click <a href="javascript:void(0)" onclick="show_new_contact();" >aqui</a>.
    </div>
</div>
 <?php endif; ?>

<script type="text/javascript">
   

    function save_bost(id){
          var option = {
                    type   : 'post',
                    bostId : $(_cbo.obost+'-'+id).val(),
                    rowId  : id,
                    url    : '<?php echo url_for('working_groups/save_bost_group') ?>'
                 }

          $("#btn-save-id-"+id).hide();
          $("#btn-save-load-"+id).show();

          save_bost_group(option);
    }
  

</script>