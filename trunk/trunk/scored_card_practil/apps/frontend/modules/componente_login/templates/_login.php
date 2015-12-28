<?php if(!$sf_user->isAuthenticated()): ?>
<form action="" method="POST" id="form_log_in" name="form_log_in">
   
       <div class="login">
       <label for="username">Usuario</label>
       <input tabindex="1" class="input_text"   id="txt-usuario-login" name="txtUsuarioLogin" value="" title="username" type="text">
        
       <label for="password">Contraseña </label>
       <input  tabindex="2" class="input_text"  id="txt-password-login" name="txtPasswordLogin" type="password">
       <input type="button"  tabindex=3 id="signin_submit_on" value="Sign in" >
       </div>
</form>
<script type="text/javascript">
      $(_obtn.ologin_in).click(function() {          
        var lista_input = [_otxt.ologin_user,_otxt.ologin_password];
        var paso = requerido(lista_input);
        if(paso){
           $(_oform.olog_in).attr('action', '<?php echo url_for('sign_in/log_in') ?>');
           $(_oform.olog_in).submit();
       }
           
       });

       $(document).ready(function(){
           $(_otxt.ologin_user).focus();
       });     
</script>
<?php else: ?>
<div>
    <a href="<?php echo url_for('sign_in/log_out') ?>" id="btn-session-out">cerrar session</a>
</div>
<?php endif; ?>