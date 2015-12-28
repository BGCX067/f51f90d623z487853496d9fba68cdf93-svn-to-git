<html>
<head>
    <?php use_helper('I18N') ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
</head>
<body>
<table>
     <tr>
         <td>            
            <?php echo __('send_email._send_invitation.Te han invitado a unirte a Practil-Scorecard') ?>
         </td>
     </tr>
     <tr>
         <td><h2><?php echo __('send_email._send_new_user.Entra desde el siguiente link') ?></h2></td>
         <td><a target="_blank"  href="<?php  echo $uri ?>"><?php echo __('send_email._send_new_user.click Aqui') ?></a></td>
     </tr>    
 </table>
</body>
</html>