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

    </style>
<body>
   <div style="height: auto; width: auto; margin:  0px auto;">
           <div class="cls-uno" >
              <div style="background-color: #00C6EA;height: 30px;width: 3px;float: left;"></div>
              <ul style="margin: 0; padding: 0; list-style-type: none; border: 0px solid;">
                  <li style="list-style-type: none; border: 0px solid; float: left;border: 0px solid;"><a><?php echo image_tag('implementacion/logo_practil.gif') ?></a></li>
                  <li  style="list-style-type: none; border: 0px solid; float: left;border: 0px solid;">&nbsp;</li>
                    <li  style="list-style-type: none; border: 0px solid; float: left;border: 0px solid; color:  white; width: 100px;"></li>
                    
                    <li  style="list-style-type: none; border: 0px solid; float: left;border: 0px solid; color:  white; width: 100px;"></li>
                    
                    <li  style="list-style-type: none; border: 0px solid; float: left;border: 0px solid; color:  white; width: 100px;"></li>
 
                    <li>
                       <?php include_component('componente_login', 'login') ?>
                    </li>
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
    <div style="width: 1000px; margin: 0 auto; height: 620px; " >
        <div class="content_practil_home_block">
            <div class="content_practil_home_block_left">
                <div class="cls-fondo-barra-uno"></div>
            </div>
            <div class="content_practil_home_block_right">
                <div>
                    <?php echo $sf_content ?>
                </div>
            </div>
        </div>
        <div class="content_scorecard_home_block">
            <div class="home">
                    <ul>
                        <li class="icon-pc">
                           <div  class="texto" style="float: left;padding-top: 10px;"><span> Controla toda tu empresa desde una sola pantalla</span></div>
                        </li>
                        <li class="icon-tuerca">
                            <div  class="texto" style="float: left;padding-top: 10px;"><span> Controla toda tu empresa desde una sola pantalla</span></div>
                        </li>
                        <li class="icon-reloj">
                            <div  class="texto" style="float: left;padding-top: 10px;"><span> Controla toda tu empresa desde una sola pantalla</span></div>
                        </li>
                    </ul>
            </div>
            <div class="home" style="width: 220px;">
                <h2>Gestion de Capital Humano</h2>
                <p>Desarrolla  las capacidades y controla los resultados de tu equipo de forma permanente</p>
            </div>
            <div class="home" style="width: 210px;">
                <h2>Estrategia Digital</h2>
                <p>Controla tu estrategia monitorando los indicadores de los principales provedores como Google Analytics, Google Addwords, Google Page Speed, Facebook, Twiter, Klout y otros</p>
            </div>
        </div>
        

     

    </div>
    <div id="pie">
          <div id="creditos" >
            <div id="creditos_izq" style="margin-top: 10px;"><a href="<?php echo url_for('acerca/index') ?>">Acerca de | Terminos y Condiciones</a></div>
            <div id="creditos_der" style="margin-top: 10px;"><a href="#">relationics.com</a><br/><a href="#">esfera.pe</a></div>
        </div>
    </div>

  </body>
</html>