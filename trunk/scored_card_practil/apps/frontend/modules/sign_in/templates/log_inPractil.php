<form action="" method="post" id="frm-associate-account">
<div>
    <ul>
        <li>Scoredcard es un servicio de practil.</li>
        <li>Enlaza tu cuenta practil con scoredcard</li>
        <li><a href="javascript:void(0);" id="btn-associate-account">aqu&iacute;</a></li>
    </ul>
</div>
<input type="hidden" name="token-account" value="<?php echo $token ?>">
<input type="hidden" name="email-account" value="<?php echo $user ?>">
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $(_obtn.oassociate_account).click(function(){
            $(_oform.oaccount).attr('action','<?php echo url_for('user/asociate_account')?>');
            $(_oform.oaccount).submit();
         });
    });
</script>