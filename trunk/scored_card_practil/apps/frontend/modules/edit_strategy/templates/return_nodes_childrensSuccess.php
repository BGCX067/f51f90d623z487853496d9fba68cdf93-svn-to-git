<div class="message_pnl_sing_in_alert message-comun">
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unkn
</div>
<?php if($count==1): ?>
    <?php foreach($list as $row): ?>
        <div style="display: inline-block;">
            <label><?php echo $row[2] ?></label>
            <input  name="txt-indicator[]" id="<?php echo $row[0] ?>" type="text" size="5" value="100" />
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach($list as $row): ?>
        <div style="display: inline-block;width: 170px;">
            <label style="margin-right: 10px;"><?php echo $row[2] ?></label>
            <input name="txt-indicator[]" id="<?php echo $row[0] ?>" type="text" size="5" value="<?php echo $row[1] ?>" />
        </div>
    <?php endforeach; ?>
<?php endif;?>



