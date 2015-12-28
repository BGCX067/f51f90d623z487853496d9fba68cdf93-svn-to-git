<div style="display: block;width: 800px;float: left;margin-top: 20px;">
    <?php echo html_entity_decode($success['html'])   ?>
</div>

<?php if($success['code']==3): ?>
<script type="text/javascript">
document.location.href = '<?php echo url_for('@homepage') ?>';
</script>
<?php endif; ?>