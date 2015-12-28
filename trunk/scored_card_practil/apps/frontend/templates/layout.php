<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
      <xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v"/>
      <style>v\:*{ behavior:url(#default#VML);}</style>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body >
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
       <div class="banner-score-card">
           <div class="logo-scorecard">
               <a href="<?php echo url_for('@homepage') ?>" title="Humanscorecard">
                <?php echo image_tag('implementacion/logo-human.gif') ?>
                </a>
        
           </div>
           <div class="logo-relationics">
               <?php echo image_tag('implementacion/logo-relationics.jpg') ?>
           </div>      
       </div>
       <div class="sub_bar_aceptor_home">
             <?php include_component('componente_home','option_user') ?>
       </div>


         
   
    <div id="div_body_init">
          <?php echo $sf_content ?>
    </div>

 

  </body>
</html>
