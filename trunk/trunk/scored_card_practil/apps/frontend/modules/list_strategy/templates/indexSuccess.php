<div style="float: left;width: 550px;margin-top: 25px;">
  <?php foreach($list as $row): ?>
       <?php  $fecha = new DateTime($row->getCreateAt()); ?>
    <div class="contend-list-strategy ">
        <div class="list-strategy-first-column"><?php echo $row->getName() ?></div>
        <div class="list-strategy-second-column"><?php echo $fecha->format('d-m-Y') ?></div>
        <div class="list-strategy-edit-column"><a href="<?php echo url_for('@edit_strategy?id_tree='.$row->getId()) ?>"  ><?php echo image_tag('edit-system-icon.png', 'size=16x16') ?></a></div>
    </div>
    <?php  endforeach;?>   
</div>