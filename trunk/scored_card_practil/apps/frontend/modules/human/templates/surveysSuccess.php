 <?php if(count($lista_head)>0): ?>


<style type="text/css">

    ul.tabs {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
	height: 32px;
	border-bottom: 1px solid #999;
	border-left: 1px solid #999;
	width: 920px;
         
}
ul.tabs li {
	float: left;
	margin: 0;
	padding: 0;
	height: 31px;
	line-height: 31px;
	border: 1px solid #999;
	border-left: none;
	margin-bottom: -1px;
	overflow: hidden;
	position: relative;
	background: #e0e0e0;

}
ul.tabs li a {
	text-decoration: none;	
	display: block;
	font-size: 12px;
	padding: 0 20px;
	border: 1px solid #fff;
	outline: none;
        color: #000;


}
ul.tabs li a:hover {
	background: #ccc;
}
html ul.tabs li.active, html ul.tabs li.active a:hover  {
	background: #fff;
	border-bottom: 1px solid #fff;
  
}


.tab_container {
	border: 1px solid #999;
	border-top: none;
	overflow: hidden;
	clear: both;
	float: left; width: 100%;
	background: #fff;
        width: 920px;
        padding-top: 40px;
}
.tab_content {
	padding: 20px;
	font-size: 1.2em;

}


</style>

<script type="text/javascript">
$(document).ready(function()
{
	$(".tab_content").hide();
	$("ul.tabs li:first").addClass("active").show();
	$(".tab_content:first").show();


        $("ul.tabs li a").css("color","#000");
        $("ul.tabs li:first").find("a").css("color","#1599DE");

	$("ul.tabs li").click(function()
       {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();

                 $("ul.tabs li a").css("color","#000");
                 $(this).find("a").css("color","#1599DE");

		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});
}); 
</script>




<div style="min-height: 0px;height: auto;border: 0px solid;" id="div-content-responsabilidades" class="cls-div-conent-page-tree" >
    <?php $lib = new my_lib(); ?>


<ul class="tabs">
 <?php foreach($lista_head as $row): ?>
                <li><a style="cursor: pointer;" onclick="show_question('<?php echo $row->getId() ?>')" href="#ecu-<?php echo $row->getId() ?>">
                        <?php $obj =  $lib->getDataUser($row->getUserSc()->getProfile()); ?>
                        <?php  if($obj!=null): ?>
                             <?php echo $obj[0]->{'name'}.' '.$obj[0]->{'lastName'} ?>
                        <?php else:?>
                            <?php echo $row->getUserSc()->getEmail() ?>
                        <?php endif; ?>
                    </a></li>
               <?php endforeach; ?>
</ul>

<div class="tab_container">
    <?php foreach($lista_head as $row): ?>
                  <div id="ecu-<?php echo $row->getId() ?>" style="border-width:1px;float: left;padding-bottom: 25px;width: 910px;">

                   </div>
   <?php endforeach; ?>
</div>



</div>
<?php endif; ?>

<script type="text/javascript">  
    function show_question(id){
        var option = {
            "type":'POST',
            "surveysId":     id,
            "url":'<?php echo url_for('@humanscorecard_surveys_ajax') ?>'
        }
       limpiar_other_div();
        humanscorecard_surveys_ajax(option);
    }
    function limpiar_other_div(){
          <?php foreach($lista_head as $row): ?>
                  $("#ecu-<?php echo $row->getId() ?>").html('');
            <?php endforeach; ?>
    }

    <?php if(count($lista_head)>0): ?>
        show_question('<?php echo $lista_head[0]->getId() ?>');
    <?php endif; ?>
</script>