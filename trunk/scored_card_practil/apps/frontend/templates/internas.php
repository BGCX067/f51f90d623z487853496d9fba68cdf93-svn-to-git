<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
    <style type="text/css">
     body{
       margin: 0;padding: 0;

      }
      ul{
          margin: 0px;
       }
       li{
        list-style: none;
    }

    </style>
<body>
        <div class="contenedor_scorecard" id="contenedor_scorecard">
           <div class="bar_practil" >
                  <div style="background-color: #00C6EA;height: 30px;width: 3px;float: left;"></div>
                  <ul >
                        <li><a><?php echo image_tag('implementacion/logo_practil.gif') ?></a></li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                        <li>&nbsp;</li>
                   </ul>
                  <ul style="float: right;margin-right: 10px;">
                      <li><?php include_component('componente_home', 'welcome') ?></li>
                  </ul>
              </div>
        </div>
        <div style="margin: 0 auto;  width: 1000px;  height: 150px;  border: 0px solid orange;  position: relative;  z-index: 505;  background-color: white;">
            <div style="float: left;    width: 170px;    font-size: 25px;    font-weight: bold;     margin-top: 55px;">

                    <a href="<?php echo url_for('@homepage') ?>" title="Humanscorecard">
                         <?php echo image_tag('implementacion/logo-human.gif') ?>
                    </a>
           </div>
            <div style="  float: right;    margin-top: 65px;">
              
           </div>
       </div>
    <div style="width: 1000px; margin: 0 auto; height: 550px; " >
          <?php echo $sf_content ?>
    </div>
    <div id="pie">
        <div id="creditos" >
            <div id="creditos_izq" style="margin-top: 10px;"><a href="#">Acerca de | Terminos y Condiciones</a></div>
            <div id="creditos_der" style="margin-top: 10px;"><a href="#">relationics.com</a><br/><a href="#">esfera.pe</a></div>
        </div>
    </div>
    

  </body>
</html>