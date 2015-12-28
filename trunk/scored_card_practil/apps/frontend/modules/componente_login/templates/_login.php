<?php if(!$sf_user->isAuthenticated()): ?>
<form action="" method="POST" id="form_log_in" name="form_log_in">
   
      <!-- <div class="login">-->
       <div style="float: right;margin-top: 3px;">
       
           <div style="float: left;margin-right: 5px;">
               <!--<input tabindex="1" class="input_text"   id="txt-usuario-login" name="txtUsuarioLogin" value="" title="username" type="text">-->
      <input id="txt-usuario-login" class="input-user" type="text" name="txtUsuarioLogin" onblur="if(this.value == '') {this.value = 'usuario';}" onfocus="if(this.value == 'usuario' ){this.value='';}" value="usuario" tabindex="1"/>
       </div>
           <div style="float: left;margin-right: 5px;">
               <!--<input  tabindex="2" class="input_text"  id="txt-password-login" name="txtPasswordLogin" type="password">-->
       <input id="txt-password-login" class="input-user" type="password" onblur="if(this.value == '') {this.value = '';}" onfocus="if(this.value == '' ){this.value='';}" value="" name="txtPasswordLogin" tabindex="2"/>
       </div>
       
           <div style="float: left; margin-top: 3px;">
               <a class="btn btn_sing_in_score"  id="signin_submit_on"  tabindex="3"  href="javascript:void(0);" >
           <span class="text-btn">Entrar</span>
       </a>
       </div>
           <!--<input type="button"  tabindex=3 id="signin_submit_on" value="Sign in" >-->
       </div>
       <!--</div>-->
</form>
<script type="text/javascript">
        function login_success(){
          var lista_input = [_otxt.ologin_user,_otxt.ologin_password];
            var paso = requerido(lista_input);
            if(paso){
               $(_oform.olog_in).attr('action', '<?php echo url_for('sign_in/log_in') ?>');
               $(_oform.olog_in).submit();
           }   
        }

      $(_obtn.ologin_in).click(function() {          
                login_success();
           
       });

       $(document).ready(function(){
           $(_otxt.ologin_user).focus();

             $(_otxt.ologin_user).keypress(function(event){
                  if (event.which == 13) {
                        login_success();
                    }
                 });

           $(_otxt.ologin_password).keypress(function(event){
                  if (event.which == 13) {
                          login_success();
                    }
                 });
       });     
</script>
<?php else: ?>
<div class="div-option-user" style="float: right;">
    <div style="padding-top: 11px;"><a id="show-option-user" href="javascript:void(0);"> <?php echo $sf_user->getAttribute(sfConfig::get('app_session_current_user_name'))?></a></div>
    <div style="float: left;padding-top: 11px;"><a id="show-option-user-img" href="javascript:void(0);"><?php echo image_tag('implementacion/flecha.png') ?></a></div>
</div>
<div  style="display: none;float: right;width: 110px;" id="div-pnl-option-user" >
    <ul>
        <li class="li-option-user"><a href="<?php echo url_for('sign_in/log_out')?>">logout</a></li>
    </ul>
</div>


<script type="text/javascript">
    $("#show-option-user , #show-option-user-img").click(function(){
        $("#div-pnl-option-user").toggle();
    });

    $("#div-pnl-option-user").hover(
    function(){},
    function(){
        $("#div-pnl-option-user").hide();
    });

</script>
<?php endif; ?>