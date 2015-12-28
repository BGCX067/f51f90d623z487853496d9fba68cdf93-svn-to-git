<style type="text/css">
    .cls-row-question{
        float: left;
        margin-left: 10px;
    }
    .cls-li{
       float: left;
       width: 910px;
       height: auto;
       padding-top:5px;
       padding-bottom: 5px;
    }
   .cls-line-li{
       float: left;
       width: 910px;
       height: 3px;
    }
    .cls-question-text{
        width: 460px;
        font-family: arial,helvetica,sans-serif;
        font-size: 12px;
    }
     .cls-info-text{
        font-family: arial,helvetica,sans-serif;
        font-size: 11px;
    }
    .cls-info-text-end{
        font-family: arial,helvetica,sans-serif;
        font-size: 16px;
        font-weight: bold;
        color: #1599DE;
    }

</style>

<script type="text/javascript">
      $(document).ready(function() {
            <?php foreach($lista_preguntas as $row): ?>
                  $("#radio_<?php echo $row->getId() ?>").buttonset();
             <?php endforeach; ?>       
      });
  </script>

<div id="content-<?php echo $pk ?>">
    <div style="margin: 0 auto;width: 850px;">
        <div style="float: left;">
            <span style="padding-left: 464px;" class="cls-info-text">  Malo   </span>
        </div>
         <div style="float: left;">
            <span style="padding-left: 121px;" class="cls-info-text">  Bueno   </span>
        </div>
    </div>

    <div style="margin: 0 auto;width: 800px;">
        <ul style="margin-left: -55px;">

            <?php $conta = 1; ?>
            <?php foreach($lista_preguntas as $row): ?>
            <li class="cls-li">
                <div class="cls-row-question">
                    <div class="cls-row-question cls-question-text">
                        <div  style="padding-left: 30px;padding-top: 12px;"><?php echo $row->getQuestionHumanSc()->getQuestion()  ?></div>
                    </div>
                    <div id="radio_<?php echo $row->getId() ?>" style="float: left;">
                            <div class="cls-row-question">
                                <div style="padding-top: 7px;width: 100%;height: auto;">
                                    <input type="radio" name="radio_<?php echo $row->getId() ?>" id="radio_<?php echo $conta+1 ?>" value="1" />
                                    <label for="radio_<?php echo $conta+1 ?>">1</label>
                                </div>
                            </div>
                            <div class="cls-row-question">
                                  <div style="padding-top: 7px;">
                                    <input type="radio" name="radio_<?php echo $row->getId() ?>" id="radio_<?php echo $conta+2 ?>" value="2" />
                                    <label for="radio_<?php echo $conta+2 ?>">2</label>
                                  </div>
                            </div>
                            <div class="cls-row-question">
                                <div style="padding-top: 7px;">
                                    <input type="radio" name="radio_<?php echo $row->getId() ?>" id="radio_<?php echo $conta+3 ?>" value="3" />
                                    <label for="radio_<?php echo $conta+3 ?>">3</label>
                                </div>
                            </div>
                            <div class="cls-row-question">
                                 <div style="padding-top: 7px;">
                                    <input type="radio" name="radio_<?php echo $row->getId() ?>" id="radio_<?php echo $conta+4 ?>" value="4" />
                                    <label for="radio_<?php echo $conta+4 ?>">4</label>
                                </div>
                            </div>
                            <div class="cls-row-question">
                                  <div style="padding-top: 7px;">
                                     <input  type="radio" name="radio_<?php echo $row->getId() ?>" id="radio_<?php echo $conta+5 ?>" value="5" />
                                    <label for="radio_<?php echo $conta+5 ?>">5</label>
                                </div>
                            </div>
                        </div>
                </div>

            </li>
            <li class="cls-line-li">
                <div style="height: 1px;width: 100%;background-color:#E5E5E5;"></div>
            </li>
             <?php $conta += 5; ?>

            <?php endforeach; ?>

        </ul>

    </div>

    <div style="margin: 0 auto;width: 850px;">
        <div style="float: right;margin-top: 15px;margin-right: -25px;">
            <a onclick="end_surveys();" style="padding: 10px 40px;cursor:pointer;" class="btn-a btn-a-text">Finalizar </a>
        </div>
    </div>

</div>

<script type="text/javascript">

    function end_surveys(){
        var div = '<div style="width: 820px;height: 200px;"> '+
                   '<div class="cls-info-text-end" style="padding-top: 90px;padding-left: 300px;"> '+
                      'Gracias por responder esta encuesta. '+
                   '</div> '+
                   '</div> ';
       if(validate()){
           
           $("#content-<?php echo $pk ?>").html(div);

           var rspt = "";
            $(':radio').each(function(){
                if($(this).attr('checked')){
                     rspt=rspt+"&list[]="+$(this).val();
                 }
            });
            var option = {
                    "type":'POST',
                    "surveysId":     <?php echo $pk ?>,
                    "answers":    rspt,
                    "url":'<?php echo url_for('@humanscorecard_surveys_answers') ?>'
            }
            humanscorecard_surveys_answers(option);
       }
    }

    function validate(){       
        var cont= 0;
        var diferencia = $(':radio').length/5;
        $(':radio').each(function(){
            if($(this).attr('checked')){
                cont++;           
            }
        });
        if(cont==diferencia){
             return true;
        }
    }
</script>


<style type="text/css">
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { border: 1px solid #cccccc; background: #fcfcfc url(images/ui-bg_highlight-soft_35_fcfcfc_1x100.png) 50% 50% repeat-x; font-weight: normal; color: #333333; }
.ui-state-default a, .ui-state-default a:link, .ui-state-default a:visited { color: #333333; text-decoration: none; }
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus { border: 1px solid #dddddd; background: #dddddd url(images/ui-bg_highlight-soft_60_dddddd_1x100.png) 50% 50% repeat-x; font-weight: normal; color: #000000; }
.ui-state-hover a, .ui-state-hover a:hover { color: #000000; text-decoration: none; }
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active { border: 1px solid #000000; background: #070808 url(images/ui-bg_inset-soft_15_070808_1x100.png) 50% 50% repeat-x; font-weight: normal; color: #ffffff; }
.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited { color: #ffffff; text-decoration: none; }
.ui-widget :active { outline: none; }
</style>