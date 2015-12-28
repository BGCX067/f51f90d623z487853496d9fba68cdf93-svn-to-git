
<div id="pnl_sign_in">
    <table border="0" cellpadding="0" cellspacing="0" width="380px" align="right">
        <tr>
            <td>
            <div class="title_pnl_sing_in">
                 registrate gratis scoredcard
            </div>
                <noscript>
                       <div class="message_pnl_sing_in_alert">
                            <div><span style="font-weight: bold;">JavaScript no está activado en tu navegador</span><p>
                                    Por <a href="javascript:void(0)">politicas de uso</a> debes tener activado JavaScript  <p> Gracias.</div>
                        </div>
                </noscript>
                <div style="width: 235px;">
                    <div class="message_pnl_sing_in_error" id="mensaje_error_pnl_sign_in">
                        <div> <?php echo $message{'message'} ?></div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <form action="" method="post" id="form_sign_in" name="form_sign_in">
    <table border="0" cellpadding="0" cellspacing="0" width="380px" align="right">
        <tr>
            <td height="25px" valign="bottom">Nombres</td>
        </tr>
        <tr>
            <td><input value="<?php echo $message{'firtname'} ?>" class="input_text" type="text" name="txtNombre" id="txtNombre"/></td>
        </tr>
        <tr>
            <td height="25px" valign="bottom">Apellidos</td>
        </tr>
        <tr>
            <td><input value="<?php echo $message{'lastname'} ?>" class="input_text" type="text" name="txtApellidos" id="txtApellidos"/></td>
        </tr>
        <tr>
            <td height="25px" valign="bottom">Email</td>
        </tr>
        <tr>
            <td>
                <?php if($token!=null): ?>
                <div style="width: 225px;padding: 4px;" class="message_pnl_sing_in_alert">
                        <label><?php echo $email ?></label>
                    </div>
                    <input value="<?php echo $email ?>"  class="input_text" type="hidden" name="txtEmail" id="txtEmail"/>
                <?php else: ?>
                    <input value="<?php echo $message{'email'} ?>"  class="input_text" type="text" name="txtEmail" id="txtEmail"/>
                <?php endif; ?>

                <div style="width: 235px;">
                    <div class="message_pnl_sing_in_error" id="msj_email">
                        Email no valido
                    </div>
                </div>

            </td>
        </tr>
        <tr>
            <td height="25px" valign="bottom">Contraseña</td>
        </tr>
        <tr>
            <td>
                 <input value="<?php echo $message{'password'} ?>" type="password"  class="input_text" name="txtPassword" id="txtPassword"/>
            </td>
        </tr>
        <tr>
            <td height="25px" valign="bottom">Contraseña</td>
        </tr>
        <tr>
            <td>
                 <input type="password"  class="input_text" name="txt-password-repeat" id="txt-password-repeat"/>
            </td>
        </tr>
        <p class="robotic" id="pot">
        <input name="robotest" type="text" id="robotest" class="robotest" />
        </p>
        <tr>
            <td><input id="register_user" name="register_user" class="form_btn" type="button" value="Registrar"></td>
       </tr>
    </table>
    </form>
</div>

<script type="text/javascript">



$(document).ready(function()
{

<?php if($message!=null): ?>
           $("#mensaje_error_pnl_sign_in").fadeIn(800);
<?php endif; ?>

$(_otxt.osign_in_email).keyup(function(){
  $(this).doTimeout( 'text-type', 700, function(){
     if(!validateEmail(_otxt.osign_in_email)){
          $("#msj_email").fadeIn(800);
          $("#email_success").hide();
          $("#email_not_success").hide();
           }else{
           $("#msj_email").hide();
           }
  });
});

});


 $("#register_user").click(function()
    {
        var lista_input = [_otxt.osign_in_name,_otxt.osign_in_first_name,_otxt.osign_in_email,_otxt.osign_in_password,_otxt.osign_in_repeat_password];
        var paso = requerido(lista_input);
        if(!paso){
            $("#mensaje_error_pnl_sign_in").html('<div>Todos los campos son requeridos</div>')
            $("#mensaje_error_pnl_sign_in").fadeIn(1000);
        }else{
            $("#mensaje_error_pnl_sign_in").hide();
            if(!validateEmail(_otxt.osign_in_email)){
                $("#msj_email").fadeIn(800);
                $("#email_success").hide();
                $("#email_not_success").hide();
            }else{
                if($(_otxt.osign_in_password).val()!=$(_otxt.osign_in_repeat_password).val()){
                   $("#mensaje_error_pnl_sign_in").html('<div>Las constraseñas deben ser iguales</div>')
                   $("#mensaje_error_pnl_sign_in").fadeIn(1000);
                   $(_otxt.osign_in_password).addClass(_oclass.otxt_error).removeClass(_oclass.otxt_input);
                   $(_otxt.osign_in_repeat_password).addClass(_oclass.otxt_error).removeClass(_oclass.otxt_input);

                }else{
                   $(_oform.osign_in).attr('action', '<?php echo url_for('user/register_user') ?>');
                   $(_oform.osign_in).submit();
                }
            }
        }

    });
</script>

