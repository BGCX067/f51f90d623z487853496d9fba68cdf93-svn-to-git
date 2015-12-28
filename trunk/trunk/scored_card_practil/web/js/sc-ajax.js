var separtor = "=";
var presepartor = "&";

function create_tree(option){
        $(_odiv.message_ajax[0].load).show();
        $.ajax({
                type: option.type,
                url:  option.url,
                data: js.ajax[0].parameter+separtor+option.title,
                complete:function(){
                  $(_odiv.message_ajax[0].load).hide();
                },
                success: function(data){
                    if(data.success){
                       createTree(data);
                       $(_ohidden.oidtree).val(data.treepk);
                       $(_odialog.ocreate_strategy).dialog('close');
                     }
                },
                error:function(){
                        alert('error al crear nodo');
                }
        });
}


function create_indicador(option){
        $(_odiv.message_ajax[1].load).show();
        $.ajax({
                type: option.type,
                url:  option.url,
                data: js.ajax[0].parameter+separtor+option.title+presepartor+js.ajax[1].parameter+separtor+option.previous+presepartor+js.ajax[2].parameter+separtor+option.tree,
                complete:function(){
                    $(_odiv.message_ajax[1].load).hide();
                },
                success: function(data){
                    if(data.success){
                        createindicador(data,option);
                        $(_odialog.ocreate_indicador).dialog('close');
                    }
                },
                error:function(){
                        alert('error al crear nodo');
                }
        });
}


function delete_indicador_module_create(option){
     $(_odiv.message_ajax[2].load).show();
        $.ajax({
                type: option.type,
                url:  option.url,
                data: js.ajax[3].parameter+separtor+option.indicator,
                complete:function(){
                    $(_odiv.message_ajax[2].load).hide();
                },
                success: function(data){
                    $(_odiv.div_ajax[0].pk).html(data);
                    $(_odialog.odelete_indicator).dialog('close');
                },
                error:function(){
                        alert('error al crear nodo');
                }
        });
}

function delete_indicador(option){
     $(_odiv.message_ajax[2].load).show();
        $.ajax({
                type: option.type,
                url:  option.url,
                data: js.ajax[3].parameter+separtor+option.indicator,
                complete:function(){
                    $(_odiv.message_ajax[2].load).hide();
                    parent.location.reload();
                },
                success: function(data){
                    $(_odiv.div_ajax[0].pk).html(data);
                    $(_odialog.odelete_indicator).dialog('close');
                },
                error:function(){
                        alert('error al crear nodo');
                }
        });
}

function save_edit_indicador(option){

       var  children_json = return_json_indicator_children();
        $.ajax({
                type: option.type,
                url:  option.url,
                data: {
                        title:            option.title,
                        description:      option.description,
                        valueMin:         option.valueMin,
                        valueDes:         option.valueDes,
                        valueOpt:         option.valueOpt,
                        responsableId:    option.responsableId,
                        responsableEmail: option.responsableEmail,
                        workGroup:        option.workGroup,
                        indicatorId:      option.indicatorId,
                        indicatorChildren: children_json
                },
                complete:function(){
                      parent.location.reload();
                },
                success: function(data){

                },
                error:function(){
                        alert('error al grabar indicador');
                }
        });

}

  function return_json_indicator_children(){

        var count = $("input[name='txt-indicator[]']").length;
        var json = '[';
        var contador = 1;
        $("input[name='txt-indicator[]']").each(function(){
            if(count==1){
             json = json+'{"pk":'+$(this).attr('id')+',"values":'+$(this).val()+'}';
            }else{
             if(contador==count){
                json = json+'{"pk":'+$(this).attr('id')+',"values":'+$(this).val()+'}';
             }else{
                json = json+'{"pk":'+$(this).attr('id')+',"values":'+$(this).val()+'},';
             }
            }
           contador++;
        });
        json = json+']';
        return json;
    }


function list_contact(option){
       $.ajax({
                type: option.type,
                url:  option.url,
                data: {
                    data:     option.data,
                    workGroup: option.workGroup
                },
                complete:function(){
                    $(_odiv.div_ajax[1].pk).show();
                },
                success: function(html){
                        $(_odiv.div_ajax[1].pk).html(html);
                },
                error:function(){
                        alert('lista_error');
                }
        });
}



function fill_json_indicator(option){
       $.ajax({
                type: option.type,
                url:  option.url,
                data: {
                    indicator: option.indicator
                },
                beforeSend: function(){
			$(_odiv.message_ajax[4].load).hide();
                        $(_odiv.div_content[2].pk).hide();
		},
                complete:function(){
                        $(_odiv.message_ajax[3].load).hide();
                },
                success: function(data){
                        fill_indicator(data);
                },
                error:function(){
                        alert('lista_error');
                }
        });
}

function fill_json_tree(option){
       $.ajax({
                type: option.type,
                url:  option.url,
                data: {
                    treeId: option.tree
                },
                beforeSend: function(){
			$(_odiv.message_ajax[8].load).hide();
                        $(_odiv.div_content[5].pk).hide();
		},
                complete:function(){
                        $(_odiv.message_ajax[7].load).hide();
                },
                success: function(data){
                      //  fill_indicator(data);
                },
                error:function(){
                        alert('lista_error');
                }
        });
}


function fill_indicator(indicator){

        $(_otxt.oedit_title_indic).val(indicator.title);
        $(_otxt.oedit_description_indic).val(indicator.description);
        $(_otxt.oedit_min_indic).val(indicator.vmin);
        $(_otxt.oedit_desire_indic).val(indicator.vmax);
        $(_otxt.oedit_optimindic).val(indicator.voptime);
        $(_otxt.oresponsable).val(indicator.email);
        $(_ohidden.oidondicatoredit).val(indicator.indicatorid);
        $("#hdIndicadorId").val(indicator.indicatorid);
        var is_connected_google_analytics = indicator.is_connected_google_analytics;
        if(is_connected_google_analytics=='1'){
            $("#is_connected_google_analytics_yes").show();
            $("#is_connected_google_analytics_no").hide();
        }else if(is_connected_google_analytics=='0'){
            $("#is_connected_google_analytics_yes").hide();
            $("#is_connected_google_analytics_no").show();
        }

        var html = "";
        for(var i=0;i<indicator.xml.options.length;i++){
            html = html + indicator.xml.options[i].row;
        }
        $("#tableId").html(html);

        if(indicator.responsable!=null){
            $(_otxt.oresponsable).hide();
            $(_ohidden.oidresponsable).val(indicator.responsable);
            $(_ohidden.oidresponsable).before(indicator.email+'&nbsp;&nbsp;<a onclick="desacer_cargar_responsable();" href="javascript:void(0);" style="color: #27BADB;font-weight: bold;">x</a>').show();
            $(_otxt.odivresponsable).show();
        }
        if(indicator.lastNode){
          $(_odiv.div_content[1].pk).show();
        }else{
          $(_odiv.div_content[1].pk).hide();
          show_indicador_children(indicator);
          $(_odiv.message_ajax[4].load).show();
        }

        $(_odiv.message_ajax[3].load).hide();
        $(_odiv.div_content[0].pk).show('clip');
        $(_odialog.oconfiguration_indicador).dialog("option", "position", "center");

}

function show_indicador_children(data){

       $.ajax({
                type: data.type,
                url:  data.url,
                data: {
                    indicatorPk: data.indicatorid
                },
                beforeSend: function(){
                    $(_odiv.div_content[2].pk).hide();
		},
                complete:function(){
                      $(_odiv.message_ajax[4].load).hide(0,function(){
                             $(_odiv.div_content[2].pk).show();
                      });
                },
                success: function(data){
                     $(_odiv.div_content[2].pk).html(data);
                },
                error:function(){
                        alert('lista_error');
                }
        });
}


function save_configuration_tree(option){

       $.ajax({
                type: option.type,
                url:  option.url,
                data: {
                    dataEntry:      option.dataEntry,
                    dataEntryValue: option.dataEntryValue,
                    workGroup:      option.workGroup,
                    treeId:         option.treeId
                },
                complete:function(){

                },
                success: function(data){
                    if(option.source=="edit"){
                        parent.location.reload();
                    }else{
                        window.location.href=option.url_second+data.tree;
                    }
                },
                error:function(){
                        alert('lista_error');
                }
        });
}


function execute_tree(option){
     $(_odiv.message_ajax[5].load).show();
     $(_odiv.message_ajax[6].load).hide();

        $.ajax({
                type: option.type,
                url:  option.url,
                data: {
                    treeId: option.treeId
                },
                complete:function(){
                     $(_odiv.message_ajax[5].load).hide();
                      tree.UpdateTree();
                },
                success: function(data){
                    if(data.success){
                          window.location.href=option.final_url+'?token'+separtor+data.s_token+presepartor+'treeId'+separtor+option.treeId;
                    }else{
                        if(data.message!='s-005'){
                           $(_odiv.message_ajax[6].load).html(data.message);
                        }
                        $(_odiv.message_ajax[6].load).show();
                    }
                },
                error:function(){
                        alert('lista_error');
                }
        });
}

function show_tree_production(option){
   eliminar_contenido_divs_indicators();
      $.ajax({
            type: option.type,
            url: option.url,
            data:{
                tree : option.treePk
            },
            success: function(data){
               $("#tree_"+option.treePk).html(data);
            }
    });
}

function show_sub_tree(option){
      eliminar_contenido_divs_indicators();
      $.ajax({
            type: option.type,
            url: option.url,
            data:{
                tree : option.treePk
            },
            success: function(data){
               $("#sub_tree_"+option.treePk).html(data);
            }
    });
}

function new_group(option){

      $.ajax({
            type: option.type,
            url: option.url,
            data:{
                name : option.name
            },
            error: function(){
                 alert('error al crear grupo');
            },
            complete:function(){
                 parent.location.reload();
            }

    });

}

function show_list_contact(option){
    $.ajax({
            type: option.type,
            url: option.url,
            data:{
                groupId : option.group
            },
            error: function(){
                 alert('error al cargar grupo!');
            },
            success:function(data){
                 $(_odiv.div_content[6].pk).html(data);
            }
    });

}

