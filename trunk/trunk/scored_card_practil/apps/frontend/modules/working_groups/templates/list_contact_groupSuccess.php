<?php foreach($list as $row): ?>
    <div class="contend-list-strategy ">
        <div class="list-strategy-first-column"><?php echo $row->getEmail() ?></div>      
        <div class="list-strategy-edit-column"><a href="#"><?php echo image_tag('edit-system-icon.png', 'size=16x16') ?></a></div>
    </div>
<?php  endforeach;?>   