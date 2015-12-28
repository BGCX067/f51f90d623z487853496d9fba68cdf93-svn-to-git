<?php if($count==1): ?>
    <?php foreach($list as $row): ?>
        <div style="float: left;width: 100%;margin-top: 3px;">
            <div style="float: left;width: 145px;text-align: left;"><?php echo $row[2] ?></div>
            <div style="float: left;margin-left: 5px;"><input  name="txt-indicator[]" id="<?php echo $row[0] ?>" type="text" size="5" value="100" /></div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach($list as $row): ?>
        <div style="float: left;width: 100%;margin-top: 3px;">
            <div style="float: left;width: 145px;text-align: left;"><?php echo $row[2] ?></div>
            <div style="float: left;margin-left: 5px;"><input name="txt-indicator[]" id="<?php echo $row[0] ?>" type="text" size="5" value="<?php echo $row[1] ?>" /></div>
        </div>
    <?php endforeach; ?>
<?php endif;?>



