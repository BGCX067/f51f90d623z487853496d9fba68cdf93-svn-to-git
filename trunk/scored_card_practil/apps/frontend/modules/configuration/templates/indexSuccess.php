<?php
$client_id = "";
$client_secret = "";
if(is_object($google_configuration)){
    $client_id = $google_configuration->getGoogleClientId();
    $client_secret = $google_configuration->getGoogleClientSecret();
}
?>
<form action="<?php echo url_for('@configuration_save') ?>" method="post" autocomplete="off">
<h1>Configuraci&oacute;n</h1>
    <a href="<?php echo url_for('@googleConnectTutorial') ?>">Tutorial</a>
<table cellpadding="10" cellspacing="10">
    <tr>
        <td colspan="2">
            <h1>Google API Services</h1>
        </td>
    </tr>
    <tr>
        <td rowspan="2">Redirect URIs</td>
        <td>http://humanscorecard.practil.com/edit_strategy/oauthcallback</td>
    </tr>
    <tr>
        <td>http://humanscorecard.practil.com/edit_strategy/oauthcallbackTest</td>
    </tr>
    <tr>
        <td>Client ID</td>
        <td><input type="text" name="client_id" size="50" value="<?php echo $client_id ?>"/></td>
    </tr>
    <tr>
        <td>Client Secret</td>
        <td><input type="text" name="client_secret" size="50" value="<?php echo $client_secret ?>"/></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="submit" value="Guardar Cambios" />
        </td>
    </tr>
</table>
  <?php if($sf_user->hasFlash('msg')){ ?>
    <h2 style="color: red;"><?php echo $sf_user->getFlash('msg') ?></h2>
  <?php } ?>
<br />
<em>Tener en cuenta que estos datos no deben ser cambiados, a menos que sea realmente necesario</em>
</form>