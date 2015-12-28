<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
   
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>

  <body >

 <div id="div_main_init">
    <div id="div_head_init" style="position: relative;z-index: 500;">
         <?php include_component('componente_login','login') ?>
    </div>
     <div style="position: relative;z-index: 500;">
    <?php include_component('componente_home','option_user') ?>
    </div>
    <div id="div_body_init">
          <?php echo $sf_content ?>
    </div>
</div>



  </body>
</html>
