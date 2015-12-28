<div style="margin-top: 200px;width: 100%;margin: 50px auto;text-align: center;">
    <?php foreach($listTree as $row): ?>
    <div style="display: block;">
        <div style="width: 300px;display: inline-block;"><?php echo $row->getName() ?></div>
        <div style="width: 80px;text-align: center;display: inline-block;"><a href="<?php echo url_for('estrategia/eliminarEstrategia?idTree='.$row->getId()) ?>">eliminar</a></div>
    </div>
 <?php endforeach; ?>
</div>