<ul>
<?php
    foreach($results as $row){ ?>
        <li id="<?php echo  $row->getUserSc()->getId(); ?>" onclick="cargar_responsable(this,'<?php echo $row->getEmail() ?>')" title="<?php echo $row->getEmail() ?>">
                <span><?php echo $row->getEmail() ?></span>
        </li>
<?php } ?>
        <?php if(count($results)<=0): ?>
        <li>
            <span style="padding-left:10px;font-size: 11px;"><a onclick="hide_list_contact();" href="javascript:void(0);">No se encontraron resultados</a></span>
        </li>
        <?php else: ?>
        <li>
            <span style="float:right;padding-right: 3px;"><a  onclick="hide_list_contact();" href="javascript:void(0);">Cerrar</a></span>
        </li>
        <?php endif; ?>
    
</ul>

<script type="text/javascript">
    function hide_list_contact(){
        $(_odiv.div_ajax[1].pk).hide();
    } 
    function cargar_responsable(obj,email){
        $(_otxt.oresponsable).val(email).hide();
        $(_ohidden.oidresponsable).val(obj.getAttribute('id'));
        $(_odiv.div_ajax[1].pk).hide();
        $(_ohidden.oidresponsable).before(email+'&nbsp;&nbsp;<a onclick="desacer_cargar_responsable();" href="javascript:void(0);" style="color: #27BADB;font-weight: bold;">x</a>').show();
        $(_otxt.odivresponsable).show();
    }
  
    
</script>