<ul>
    <li ><?php echo image_tag('implementacion/sub-bar-start.png') ?></li>
    <li class="font-sub-bar-aceptor">
        
        <div id="menu-list-strategy" class="text-sub-bar-score-card"><a href="<?php echo url_for('@list_strategy?select=execution') ?>" id="btn-list-strategy">Mis Estrategias</a> </div>
        <div class="btn-sub-bar-separate"></div>

        <div id="menu-list-strategy" class="text-sub-bar-score-card"><a href="<?php echo url_for('projections/list') ?>" id="btn-list-strategy">Mis Proyecciones</a> </div>
        <div class="btn-sub-bar-separate"></div>
        
       <div id="menu-production-responsibilities" class="text-sub-bar-score-card"><a href="<?php echo url_for('@responsibilities') ?>" id="btn-list-tabs-indicator">Mis Responsabilidades</a> </div>
       <div class="btn-sub-bar-separate"></div>

       <div id="menu-production-responsibilities" class="text-sub-bar-score-card"><a href="<?php echo url_for('@humans_surveys') ?>" id="btn-list-tabs-indicator">Mi Desempeño</a> </div>

    </li>
    <li><a><?php echo image_tag('implementacion/sub-bar-end.png') ?></a></li>
</ul>

<script type="text/javascript">

    $("#menu-production-tree").click(function(){
        $('#btn-production_strategy').attr('href', function(i, val) {  document.location.href=val; });
    });
    
    $("#menu-list-strategy").click(function(){
        $('#btn-list-strategy').attr('href', function(i, val) {  document.location.href=val; });
    });

    $("#menu-working-groups").click(function(){
        $('#btn-working-groups').attr('href', function(i, val) {  document.location.href=val; });
    });
     $("#menu-production-responsibilities").click(function(){
        $('#btn-list-tabs-indicator').attr('href', function(i, val) {  document.location.href=val; });
    });


    $("#menu-strategy").hover(function(){
    $("#btn-create-strategy").removeClass('cls-text-menu').addClass('cls-text-menu-hover')
    },
    function(){
    $("#btn-create-strategy").removeClass('cls-text-menu-hover').addClass('cls-text-men')
    }
    );

    $("#menu-list-strategy").hover(function(){
    $("#btn-list-strategy").removeClass('cls-text-menu').addClass('cls-text-menu-hover')
    },
    function(){
    $("#btn-list-strategy").removeClass('cls-text-menu-hover').addClass('cls-text-men')
    }
    );


    $("#menu-production-responsibilities").hover(function(){
    $("#btn-list-tabs-indicator").removeClass('cls-text-menu').addClass('cls-text-menu-hover')
    },
    function(){
    $("#btn-list-tabs-indicator").removeClass('cls-text-menu-hover').addClass('cls-text-men')
    }
    );





</script>