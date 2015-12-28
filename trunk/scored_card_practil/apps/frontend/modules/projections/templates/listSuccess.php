<div class="cls-contenedor-list-projection">
    <div class="head-list-proyecion">
        <ul>
            <li style="width: 550px;"><span>Nombre de la Estrategia</span></li>
            <li style="width: 120px;"><span>Fecha de creaci&oacute;n</span></li>
            <li style="width: 120px;"><span>Ver proyecciones</span></li>
            <li style="width: 120px;"><span>En producci&oacute;n</span></li>
        </ul>
    </div>


<?php $conta=0; ?>
<?php foreach($list as $row): ?>
<?php  $fecha = new DateTime($row->getCreateAt()); ?>
<div  <?php if($conta%2==0){ ?>  class="list-proyecion-par" <?php }else{ ?>  class="list-proyecion-impar"  <?php }?>  >
       <ul>
            <li style="width: 550px;text-align: left;padding-left: 10px;"><span><?php echo $row->getName() ?></span></li>
            <li style="width: 120px;"><span><?php echo $fecha->format('d-m-Y') ?></span></li>
            <li style="width: 120px;"><a style="vertical-align: middle;" title="ver proyecciones" href="<?php echo url_for('projections/index?idTree='.$row->getId()) ?>"  ><?php echo image_tag('implementacion/b_editar.gif', 'size=16x16') ?></a></li>
            <li style="width: 120px;">
                <?php if( $row->getProduccion()=="production"): ?>
                    <?php echo image_tag('implementacion/activo.png', 'size=16x16') ?>
                <?php else: ?>
                     <?php echo image_tag('implementacion/desactivado.png', 'size=16x16') ?>
                <?php endif; ?>
            </li>
        </ul>
 </div>
<?php $conta++; ?>
<?php  endforeach;?>
</div>