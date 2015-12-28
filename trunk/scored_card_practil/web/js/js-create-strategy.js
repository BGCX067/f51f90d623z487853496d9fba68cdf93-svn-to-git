$(document).ready(function(){
 $.fx.speeds._default = 400;
    $("#tabs").tabs();
    $("#tabs").show();
    
    $(_odialog.ocreate_strategy).dialog({
        autoOpen: true,
        width:600,
        minHeight:100,
        modal: true,
        resizable: false,
        open:function(){
             $(_otxt.oname_tree).val('').focus();
             $(_odiv.message_ajax[9].load).hide();
        }
     });
    $(_odialog.messageExit).dialog({
        autoOpen: false,
        width:300,
        minHeight:100,
        modal: true
     });

    $(_odialog.ocreate_indicador).dialog({
        autoOpen: false,
        width:300,
        minHeight:100,
        modal: true
     });


    $(_odialog.osave_tree).dialog({
        autoOpen: false,
        width:300,
        minHeight:100,
        modal: true
     });
    $(_odialog.odelete_indicator).dialog({
        autoOpen: false,
        width:300,
        minHeight:100,
        resizable: false,
        modal: true,
        close: function() {
               $(_ohidden.oidindicator_delete).val('');
        }
     });
    $(_odialog.oconfiguration_indicador).dialog({
        autoOpen: false,
        minHeight:150,
        minWidth:400,
        resizable: false,
        modal: true
     });

     $(_obtn.oexecute_tree).click(function(){
            $(_odiv.message_ajax[6].load).fadeIn();
     });

    $(_obtn.onotc_indicator).click(function(){
        $(_odialog.odelete_indicator).dialog('close');
    });

    $(_obtn.osave_group).click(function(){
         save_new_group_cbo();
    });

    $(_obtn.osave_idicator).click(function(){
            create_indicador_c();
    });

    $(_obtn.ocreate_tree).click(function(){
            create_tree_c();
     });

    $(_otxt.oname_group).keypress(function(event){
              if (event.which == 13) {
                     save_new_group_cbo();
                }
   });

    $(_otxt.oname_tree).keypress(function(event){
              if (event.which == 13) {
                     create_tree_c();
                }
   });

   $(_otxt.oname_indicador).keypress(function(event){
              if (event.which == 13) {
                     create_indicador_c();
                }
   });

});

function layoutHelp(success)
{
     
    if(success=="true")
    {
         
       $(_otxt.oname_tree).focus();
       $( _odiv.div_help[0].pk).css('display','inline-block');
       $(".cls-option-help").fadeIn(850);
       $( _odiv.div_help[1].pk).fadeIn(850);
       $( _odiv.div_help[2].pk).fadeIn(850);
       $( _odiv.div_help[3].pk).hide();
       $(_odialog.ocreate_strategy).dialog({width: 600});
       $(_odialog.ocreate_strategy).dialog({position: 'center'});
    }
    else
    {
       
       $(_otxt.oname_tree).focus();
       $( _odiv.div_help[0].pk).hide();
       $(".cls-option-help").hide();
       $( _odiv.div_help[1].pk).hide();
       $( _odiv.div_help[2].pk).hide();
       $( _odiv.div_help[3].pk).show();
       $(_odialog.ocreate_strategy).dialog({width: 295});
       $(_odialog.ocreate_strategy).dialog({position: 'center'});
    }
}

function show_div_create_strategy()
{
         $(_ohidden.oname_tree).val('');
         $(_otxt.oname_tree).val('').focus();
         $(_odialog.ocreate_strategy).dialog('open');
}

function show_div_create_indicator_tree(idprevious)
{
         $(_ohidden.oprevious).val(idprevious);
         $(_otxt.oname_indicador).val('').focus();
         $(_odialog.ocreate_indicador).dialog('open');
         $(_odiv.div_help[4].pk).hide();
         
         
        
}

function show_div_create_indicator(idprevious)
{
         $(_ohidden.oprevious).val(idprevious);
         $(_otxt.oname_indicador).val('').focus();
         $(_odialog.ocreate_indicador).dialog('open');      
         $(_odiv.div_help[4].pk).hide();         
         $(_odiv.div_help[5].pk).hide();
}


function show_div_delete_indicator(id){
            $(_ohidden.oidindicator_delete).val(id);
            $(_odialog.odelete_indicator).dialog('open');
            $(_odiv.div_help[5].pk).hide();
}



function open_new_group(){
    $(_otxt.oname_group).val('').focus();
    $('#add-new-group').dialog('open');
}

function changeOptionHelp(options)
{
         $.ajax({
            type: options.type,
            url: options.url,
            data:{
                paso : options.option,
                checked : options.checked
            },
            error: function(){
                 
            },
            success:function(data)
            {

            }
    });
}

function changeOtionGroupPeriodo(idPeriodo,idGroup)
{
    $(_cbo.omedida_informationPanel+" option").each(function(){
        if(idPeriodo==$(this).attr('value'))
        {
            $(this).attr('selected',true);
        }        
    });
    
    $(_cbo.oidgroup_treePanel+" option").each(function(){
        if(idGroup==$(this).attr('value'))
        {
            $(this).attr('selected',true);
        }
    });
}


function onSilverlightError(sender, args) {
   var appSource = "";
   if (sender != null && sender != 0) {
      appSource = sender.getHost().Source;
   }

   var errorType = args.ErrorType;
   var iErrorCode = args.ErrorCode;

   if (errorType == "ImageError" || errorType == "MediaError") {
      return;
   }

   var errMsg = "Unhandled Error in Silverlight Application " + appSource + "\n";

   errMsg += "Code: " + iErrorCode + "    \n";
   errMsg += "Category: " + errorType + "       \n";
   errMsg += "Message: " + args.ErrorMessage + "     \n";

   if (errorType == "ParserError") {
      errMsg += "File: " + args.xamlFile + "     \n";
      errMsg += "Line: " + args.lineNumber + "     \n";
      errMsg += "Position: " + args.charPosition + "     \n";
   }
   else if (errorType == "RuntimeError") {
      if (args.lineNumber != 0) {
         errMsg += "Line: " + args.lineNumber + "     \n";
         errMsg += "Position: " + args.charPosition + "     \n";
      }
      errMsg += "MethodName: " + args.methodName + "     \n";
   }

   alert(errMsg);
}

