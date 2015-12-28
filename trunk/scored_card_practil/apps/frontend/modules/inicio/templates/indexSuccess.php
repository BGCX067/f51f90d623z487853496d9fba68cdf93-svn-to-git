<style type="text/css">
    ul{margin: 0px;}
    li{
        list-style: none;
}
</style>

<script type="text/javascript">

    var messageError = {
                        "Requerido":'Los siguientes campos del formulario son requeridos (*) ',
                        "Password":'Las Contraseñas ingresas <b>no coinciden</b>,ingreselo nuevamente.',
                        "PasswordSize":'Por motivos de seguridad las contraseñas deben tener como <b>minimo 6 letras</b>',
                        "Email":'El <b>Correo</b> ingresado no es valido,ingreselo nuevamente.'
                       };

    var input= {"name":'txtNombre',"lasName":'txtApellidos',"email":'txtEmail',"password":'txtPassword',"rePassword":'txt-password-repeat'};

    var requeridoLabel= {"name":'nombre',"lasName":'apellidos',"email":'correo',"password":'password',"rePassword":'re-password'};


  function validarForm(){

        if(requeridoForm())
        {
            if(validarEmail($("#"+input.email).val()))
            {
                if($("#"+input.password).val().length>5)
                {

                    if($("#"+input.password).val()==$("#"+input.rePassword).val())
                    {
                        hideMessageErrorSignIn();
                        return true;
                    }else
                    {
                        showMessageErrorSignIn(messageError.Password);
                        $("#"+input.password).focus().select();

                    }
                }else
                {
                    showMessageErrorSignIn(messageError.PasswordSize);
                    $("#"+input.password).focus().select();

                }

            }
            else
            {
                showMessageErrorSignIn(messageError.Email);
                $("#"+input.email).focus().select();
            }
            return false;
        }
  }


    function fillSignIn(name,lastName,email,password){
        $("#"+input.name).val(name);
        $("#"+input.lasName).val(lastName);
        $("#"+input.email).val(email);
        $("#"+input.password).val(password);
    }


    function requeridoForm(){
        ($("#"+input.name).val().length>0) ? $("#requerido-"+requeridoLabel.name).hide() : $("#requerido-"+requeridoLabel.name).show();
        ($("#"+input.lasName).val().length>0) ? $("#requerido-"+requeridoLabel.lasName).hide() : $("#requerido-"+requeridoLabel.lasName).show();
        ($("#"+input.email).val().length>0) ? $("#requerido-"+requeridoLabel.email).hide() : $("#requerido-"+requeridoLabel.email).show();
        ($("#"+input.password).val().length>0) ? $("#requerido-"+requeridoLabel.password).hide() : $("#requerido-"+requeridoLabel.password).show();
        ($("#"+input.rePassword).val().length>0) ? $("#requerido-"+requeridoLabel.rePassword).hide() : $("#requerido-"+requeridoLabel.rePassword).show();
        if($("#"+input.name).val().length>0 &&
           $("#"+input.lasName).val().length>0 &&
           $("#"+input.email).val().length>0 &&
           $("#"+input.password).val().length>0 &&
           $("#"+input.rePassword).val().length>0 ){
            $("#div-content-message-error-sing-in").fadeOut(0,function(){
                 $("#div-aux-content-message-error-sing-in").show();
            });
            return true;
        }
        else{
            $("#text-message").html(messageError.Requerido);
            $("#div-aux-content-message-error-sing-in").fadeOut(0,function(){
                 $("#div-content-message-error-sing-in").fadeIn();
            });
            return false;
        }
  }





  function showMessageErrorSignIn(message){
       $("#text-message").html(message);
       $("#div-aux-content-message-error-sing-in").fadeOut(0,function(){
                 $("#div-content-message-error-sing-in").fadeIn();
       });
   }
  function hideMessageErrorSignIn(){
       $("#div-content-message-error-sing-in").fadeOut(0,function(){
              $("#div-aux-content-message-error-sing-in").show();
        });
   }


   function f_registrar_usuario(){
            if(validarForm()){
                 document.frm_registrar_usuario.action='<?php echo url_for('user/register_user') ?>';
                 document.frm_registrar_usuario.submit();
            }
    }


$(document).ready(function(){
    <?php if($success){?>
        fillSignIn('<?php echo $arraySucces['firtname'] ?>','<?php echo $arraySucces['lastname'] ?>','<?php echo $arraySucces['email'] ?>','<?php echo $arraySucces['password'] ?>');
        showMessageErrorSignIn('<?php echo $arraySucces['message'] ?>');
     <?php } ?>
});


</script>


<div>
<form action="" method="post" id="form_sign_in" name="form_sign_in">


       <div>
        <div class="head-login-practil">       </div>
        <div class="body-login-practil">

               <ul class="ul-sign-in-practil">
                   <li style="height: auto;">
                       <noscript>
                       <div id="div-content-message-error-sing-in" style="display: block;width: 275px;">
                                   <div id="text-message" class="message-info">
                                       Javascript no esta Habilitado en su navegador, si no lo activa la pagina no funcionara correctamente.
                                   </div>
                        </div>
                        </noscript>

                       <div id="div-content-message-error-sing-in">
                           <div id="text-message" class="message-error"></div>
                       </div>
                       <div id="div-aux-content-message-error-sing-in"></div>

                   </li>
                   <li><div class="div-label texto">Nombres:</div>    <div class="div-input"> <input type="text" name="txtNombre" id="txtNombre" value=""/></div><div id="requerido-nombre" class="div-requerido">*</div></li>
                    <li><div class="div-label texto">Apellidos:</div>  <div class="div-input"> <input type="text" name="txtApellidos" id="txtApellidos" value=""/></div><div id="requerido-apellidos"  class="div-requerido">*</div></li>
                    <li><div class="div-label texto">Correo:</div>
                         <div class="div-input">
                             <?php if($token!="null"): ?>
                                <input style="border:1px solid #FFF093;background-color:#FFF9DB;" readonly="readonly" type="text" name="txtEmail" id="txtEmail" value="<?php echo $email ?>"/>
                             <?php else: ?>
                                <input type="text" name="txtEmail" id="txtEmail" value=""/>
                             <?php endif; ?>
                             <input type="hidden" name="hd-token-signin" value="<?php echo $token ?>" />
                         </div>
                         <div id="requerido-correo"  class="div-requerido">*</div> </li>

                    <li><div class="div-label texto" class="div-label">Contrase&ntilde;a:</div>            <div class="div-input"><input type="password" name="txtPassword" id="txtPassword" value=""/></div><div id="requerido-password"  class="div-requerido">*</div></li>
                    <li><div class="div-label texto" class="div-label">Confirmar Contrase&ntilde;a:</div>  <div class="div-input"><input type="password" name="txt-password-repeat" id="txt-password-repeat" value=""/></div><div id="requerido-re-password" class="div-requerido">*</div></li>
                    <li style="height:40px;padding-top: 5px;">
                        <div class="text-terminos-condiciones">Al registrarse usted acepta nuestros <a href="#" class="link-a">Terminos de servicio</a> y <a href="#" class="link-a">pol&iacute;ticas de privacidad</a>.
                    </div>

                    </li>
                    <li>
                        <a class="btn-registrar-practil" href="javascript:void(0)" onclick="f_registrar_usuario();">
                                <span class="text-btn" style="vertical-align: baseline;">Registrar</span>
                        </a>
                    </li>


                </ul>
        </div>
    </div>

</form>

</div>

