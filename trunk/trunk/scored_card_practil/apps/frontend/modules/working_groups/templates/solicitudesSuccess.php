<?php include_component('componente_home', 'option_group') ?>
<div style="float: left;width: 650px;margin-top: 25px;">
    <h3>Solicitudes Pendientes:</h3>
  <?php foreach($list as $row): ?>
    <div class="contend-list-strategy ">
        <div class="list-strategy-first-column" style="width:415px;">
        <?php echo '<b>'.$row->getUserSc()->getEmail().'</b> te ha invitado a pertenecer a <b>'.$row->getGrupoTrabajoSc()->getName().'</b>'; ?>
        </div>
        <div class="list-strategy-edit-column" style="width: 60px;"><a href="<?php echo url_for('accept_group',array("invitacion"=>$row->getId(),
                                                                                                                     "token"=>$row->getToken(),
                                                                                                                     "account"=>md5($row->getUserSc()->getId())
                )) ?>">Aceptar</a></div>
        <div class="list-strategy-edit-column" style="width: 60px;"><a href="javascript:void(0);">Cancelar</a></div>
    </div>
    <?php  endforeach;?>
</div>

