var separtor = "=";
var presepartor = "&";


function create_tree(option)
{
        var successLocal = false;
        var dataLocal = "";
        var dataType = false;
        $(_odiv.message_ajax[0].load).css('display','inline-block');
        if($(_cbo.oidgroup_tree).css("display")=="none")
        {
            if(option.newgrupo=="")
            {
                alert("nombre del grupo requerido");             
            }
            else
            {
               dataType=true;
            }
        }
        $.ajax({
                type: option.type,
                url:  option.url,
                data: {
                    item_title : option.title,
                    periodo    : option.periodo,
                    grupo      : option.grupo,
                    typeSave   : dataType,
                    newgrupo   : option.newgrupo
                 },
                complete:function(){
                  if(successLocal)
                  {
                     createTree(dataLocal);
                     changeOtionGroupPeriodo(option.periodo,option.grupo);

                     // oidtree = id completo (T-01) sirve para anidar los indicadores
                     // idTree  = solamente el Id (01) sirve para tener el id del arbol actual en un hidden
                     $(_ohidden.oidtree).val(dataLocal.treepk);
                     $(_ohidden.idTree).val(dataLocal.treeId);

                     $(_odialog.ocreate_strategy).dialog('close');
                     $(_odiv.div_help[4].pk).css('display','inline-block');

                  }

                  $(_odiv.message_ajax[0].load).hide();
                },
                success: function(data){
                    if(data.success)
                    {
                       if(data.type)
                       {
                        $(_cbo.oidgroup_treePanel).append('<option value='+data.groupId+'>'+data.groupName+'</option>');
                       }
                       dataLocal    = data;
                       successLocal = true;

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
                data: {
                        title:             option.title,
                        resposableId:      option.responsableId,
                        responsableEmail:  option.responsableEmail,
                        valorMinimo:       option.valorMinimo,
                        valorDeseado:      option.valorDeseado,
                        valorOptimo:       option.valorOptimo,
                        previous:          option.previous,
                        tree:              option.tree
                      },
                complete:function(){
                    $(_odiv.message_ajax[1].load).hide();
                },
                success: function(data){
                    if(data.success){ 
                        parent.location.reload();
                    }
                },
                error:function(){
                        alert('error al crear nodo');
                }
        });
}

function create_indicador_module_create(option){


        $(_odiv.message_ajax[1].load).css('display','inline-block');
        $.ajax({
                type: option.type,
                url:  option.url,
                data: js.ajax[0].parameter+separtor+option.title+presepartor+js.ajax[1].parameter+separtor+option.previous+presepartor+js.ajax[2].parameter+separtor+option.tree,
                complete:function(){
                    $(_odiv.message_ajax[1].load).hide();
                },
                success: function(data){
                    if(data.success){
                        createIndicadorModuleCreate(data,option);
                        resize_tree_aux();
                        $(_odialog.ocreate_indicador).dialog('close');                    
                    }
                     if($(_ohidden.countIndicator).val()==0)
                     {
                        $(_odiv.div_help[5].pk).show();
                     }
                     else
                     {
                         $(_odiv.div_help[5].pk).hide();
                     }
                     $(_ohidden.countIndicator).val(parseInt($(_ohidden.countIndicator).val())+1);

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
                        conectorId:       option.conectorId,
                        attributeId:      option.attributeId,
                        tableId:          option.tableId,
                        facebook_username:option.facebook_username,
                        twitter_username: option.twitter_username,
                        fec_ini:          option.google_fec_ini,
                        fec_fin:          option.google_fec_fin,
                        indicatorId:      option.indicatorId,
                        oaux_manejo_data: option.oaux_manejo_data,
                        indicatorChildren: children_json
                },
                complete:function(){
                      //parent.location.reload();
                       document.location.href=""+option.url2+"";
                },
                success: function(data){

                },
                error:function(){
                        alert('error al grabar indicador');
                }
        });

}

function save_edit_indicador_g(option){

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
                        conectorId:       option.conectorId,
                        attributeId:      option.attributeId,
                        tableId:          option.tableId,
                        facebook_username:option.facebook_username,
                        twitter_username: option.twitter_username,
                        fec_ini:          option.google_fec_ini,
                        fec_fin:          option.google_fec_fin,
                        indicatorId:      option.indicatorId,
                        oaux_manejo_data: option.oaux_manejo_data,
                        indicatorChildren: children_json
                },
                complete:function(){
                      $('#frmconector-google-content').submit();
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
                        /*oculto la imagen ajax y el panel <Conectores Inferiores> */
			$(_odiv.message_ajax[4].load).hide();
                        $(_odiv.div_content[2].pk).hide();
		},
                complete:function(){
                        /* oculto la imagen del loadAjax */
                        $(_odiv.message_ajax[3].load).hide();
                        /* muestro todo el formulario del indicador */
                        $(_odiv.div_content[0].pk).show('clip');
                        $(_odialog.oconfiguration_indicador).dialog("option", "position", "center");
                },
                success: function(data){
                        /*invoco a la funcion para llenar los campos*/
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
                        fill_indicator(data);
                },
                error:function(){
                        alert('lista_error');
                }
        });
}


function fill_indicator(indicator)
{

        /*******lleno los campos*************/
        $(_otxt.oedit_title_indic).val(indicator.title);
        $(_otxt.oedit_description_indic).val(indicator.description);
        $(_otxt.oedit_min_indic).val(indicator.vmin);
        $(_otxt.oedit_desire_indic).val(indicator.vmax);
        $(_otxt.oedit_optimindic).val(indicator.voptime);     
        /*este hidden sirve para mantener el id actual del indicador*/
        $(_ohidden.oidondicatoredit).val(indicator.indicatorid);

        

        /*Si es un nodo tipo Hijo,los combros*/
        if(indicator.lastNode)
        {
            //como es utlimo nodo si podra seleccionar que tipo conector es <Manual o Automatico>
            $("#cbo-manejo-data").show();
            $("#label-cbo-manejo-data").show();
          
            /*verfico si el indicador esta configurado en Modo <Manual o Automatico>*/
            if(indicator.det_network_attribute_id!=null)
            {
                $("#cbo-manejo-data option[value=2]").attr('selected',true);
                /*si esta modo Automatico procedo a mostrar el formulario de configuracion*/
                $("#conectores-inferiores-content").show();
            }
            else
            {
                $("#cbo-manejo-data option[value=1]").attr('selected',true);
                /*si esta modo manual procedo a oculto el formulario de configuracion*/
                $("#conectores-inferiores-content").hide();                
            }

            $("#hd-resposable-final option").each(function () {
                 if($(this).val()==indicator.responsable)
                 {
                    $(this).attr('selected', true);
                 }
         });

          $(_odiv.div_content[7].pk).show();
          show_indicator_edit(indicator);         
        }
        /*si es nodo hijo la configuracion por defecto es Automatica, por que depende de los nodos hijos*/
        else
        {
           /*setteo el valor a automatico y  oculto la opcion y el texto (label) */
           $("#cbo-manejo-data option[value=2]").attr('selected',true);
           $("#cbo-manejo-data").hide();
           $("#label-cbo-manejo-data").hide();
           /*oculto el panel donde se configuran los conectores Externos*/
           $(_odiv.div_content[7].pk).hide();
           /* ejecuto la funcion para llenar todos los nodos hijos*/
           show_indicador_children(indicator);           
        }
       
        

}

function show_indicator_edit(indicator){
    var is_connected_google_analytics = indicator.is_connected_google_analytics;
    var network_id = indicator.network_id;
    var fec_ini = indicator.fec_ini;
    var attribute_id = indicator.attribute_id;
    var det_network_attribute_id = indicator.det_network_attribute_id;
    
    $("#hdIndicadorId").val(indicator.indicatorid);

    if(is_connected_google_analytics=='1'){
        $("#is_connected_google_analytics_yes").show();
        $("#is_connected_google_analytics_no").hide();
    }else if(is_connected_google_analytics=='0'){
        $("#is_connected_google_analytics_yes").hide();
        $("#is_connected_google_analytics_no").show();
    }
    
    var html = "";
    if(indicator.xml.options.length>0){
        for(var i=0;i<indicator.xml.options.length;i++){
            html = html + indicator.xml.options[i].row;
        }
    }
    $("#tableId").html(html);
    
    if(network_id=='Facebook'){
        $("#conector-facebook-content").show();
        $("#facebook_username").val(indicator.username_in_network);
    }else if(network_id=='Twitter'){
        $("#conector-twitter-content").show();
        $("#twitter_username").val(indicator.username_in_network);
    }else if(network_id=='Google Analytics'){
        $("#conector-google-content").show();
        $("#tableId option[value="+indicator.username_in_network+"]").attr('selected',true);
    }
    if(fec_ini!='' && fec_ini!=null){
        $("#rango-fechas").hide();
    }
    
    if(indicator.vactual!=null){
        $("#data-valor-actual-content").show();
    }else{
        $("#data-valor-actual-content").hide();
    }
    $("#data-valor-actual").html(indicator.vactual);
    $("#conector option[value="+network_id+"]").attr('selected',true);

    var makerName = $('#conector').val(),
            carMaker = filterByProperty(networks, 'name', makerName),
            models = [];

    if (carMaker.length > 0)
            models = $.map(carMaker[0].models, function(model) {return {name: model.description_short, value: model.id}});
        
    populateSelect($('#conector_atributos').get(0), models);
    
    $("#conector_atributos option[value="+attribute_id+"]").attr('selected',true);
    if(attribute_id!=''){
        $("#network_description").html("* "+title[$("#conector_atributos").val()]);
    }

    if(det_network_attribute_id==null){
        $("#cbo-manejo-data").change(function(){
            if(this.value=='2'){
                $("#conector-facebook-content").show();
            }else{
                $("#conector-facebook-content").hide();
            }
        });
    }
}

function show_indicador_children(data){

       $.ajax({
                type: data.type,
                url:  data.url,
                data: {
                    indicatorPk: data.indicatorid
                },
                beforeSend: function(){
                    $(_odiv.message_ajax[4].load).show();
                    $(_odiv.div_content[2].pk).hide();
		},
                complete:function(){
                      /*Este es el panel General el <fieldset>*/
                      $("#conectores-inferiores-content").show();

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

function new_group_cbo(option){
     $.ajax({
            type: option.type,
            url: option.url,
            data:{
                name : option.name
            },
            success:function(data){
                $("#div-contenedor-group-cbo").html(data);
            },
            error:   function(){},
            complete:function(){
                $('#add-new-group').dialog('close');
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

function show_list_human(option){
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
                 $("#div-content-humman").html(data);
            }
    });
}


function new_contact(option,option_success){
      $.ajax({
            type: option.type,
            url: option.url,
            data:{
                groupId : option.groupId,
                email : option.email
            },
            error: function(){
                 alert('error al agregar contacto!');
            },
            success:function(data){
                    if(data.success){
                         show_list_contact(option_success);
                         $(_otxt.oname_new_contact).val('').focus();
                         alert("Se agrego contacto exitosamente");
                    }

            }
    });
}


function delete_tree_ajax(option){
      $(_odialog.odelete_tree).dialog('close');
      
      $.ajax({
            type: option.type,
            url: option.url,
            data:{
                treeId : option.treeId
            },
            error: function(){
                 
            },
            success:function(data){
                  if(data.success){
                       $("#div-list-"+option.treeId).fadeOut();
                       $("#title-tree").html(data.name);
                       $(_ohidden.oundoId).val(data.pk);
                       $(_ohidden.oundoProduction).val(data.production);
                       $(_odiv.div_content[8].pk).fadeIn();                       
                  }
            }
    });
}

function undo_tree_ajax(option){

       $.ajax({
            type: option.type,
            url: option.url,
            data:{
                treeId : option.treeId,
                production : option.production
            },
            error: function(){
                 $(_odiv.div_content[8].pk).show();
            },
            success:function(data){
                  if(data.success){
                       $(_ohidden.oundoId).val('');
                       $(_ohidden.oundoProduction).val('');
                       $("#div-list-"+option.treeId).fadeIn(500, function(){
                            $(_odiv.div_content[8].pk).fadeOut(1);
                       })
                  }else{
                      $(_odiv.div_content[8].pk).show();
                  }
            }

       });

}

function save_bost_group(option){

        $.ajax({
            type: option.type,
            url: option.url,
            data:{
                bostId : option.bostId,
                rowId  : option.rowId
            },
            error: function(){
                $("#btn-save-id-"+option.rowId).show();
                $("#btn-save-load-"+option.rowId).hide();
            },
            success:function(data){
                  
            },
            complete:function(){
                $("#btn-save-id-"+option.rowId).show();
                $("#btn-save-load-"+option.rowId).hide();
            }

       });

}


function save_new_question(option){
         $('#div-messaje-load-question').show();
         
         $.ajax({
            type: option.type,
            url: option.url,
            data:{
                questionText : option.questionText,
                groupId  : option.groupId
            },
            error: function(){
               $('#dialog-add-question').dialog('close');
               $('#div-messaje-load-question').hide();
            },
            success:function(data){
                $(data).insertBefore("#div-aux");
            },
            complete:function(){
                $('#dialog-add-question').dialog('close');
                $('#div-messaje-load-question').hide();
            }

       });

}

function edit_question_ajax(option){
        $.ajax({
            type: option.type,
            url: option.url,
            data:{
                questionText : option.questionText,
                questionId  : option.questionId
            },
            error: function(){
                    $('#div-question-label-'+option.questionId).show();
                    $('#div-question-edit-'+option.questionId).hide();                    
            },
            success:function(data){
                    if(data.success){
                      $('#div-question-label-'+option.questionId).html(data.question);
                    }                    
            },
            complete:function(){
                    $('#div-question-label-'+option.questionId).show();
                    $('#div-question-edit-'+option.questionId).hide();                   
            }
       });
}


function delete_question_ajax(option){
         
         $.ajax({
            type: option.type,
            url: option.url,
            data:{
                questionId : option.questionId
            },
            error: function(){
               
            },
            success:function(data){
                 if(data.success){
                    $("#row-q-"+option.questionId).fadeOut(450,'linear',function(){
                         $(this).remove();
                    });
                 }
            },
            complete:function(){
               
            }

       });

}

function save_check_question(option){
       $.ajax({
            type: option.type,
            url: option.url,
            data:{
                value : option.value,
                questionId  : option.questionId
            },
            error: function(){    } ,
            success:function(data){
                  
            },
            complete:function(){   }
           
       });
}


function change_configuration_ajax(option){
       $.ajax({
            type: option.type,
            url: option.url,
            data:{
                ckTopBoss : option.ckHigher,
                ckAuto  : option.ckMe,
                groupId : option.groupId
            },
            error: function(){    } ,
            success:function(data){

            },
            complete:function(){   }

       });
}

function change_periodo_ajax(option){
    var success = false;
     $.ajax({
            type: option.type,
            url: option.url,
            data:{
                periodoId : option.periodoId,
                grupoId : option.grupoId
            },
            error: function(){
                    success = false;
            } ,
            success:function(data){
                if(data.success){
                    success = true;
                }
            },
            complete:function(){
                return success;
            }

       });
}

function humanscorecard_state_human_ajax(option){
     $.ajax({
            type: option.type,
            url: option.url,
            data:{     
                groupId : option.groupId,
                value   : option.value
            },
            error: function(){                   
            } ,
            success:function(data){               
            },
            complete:function(){               
            }
       });
}

function humanscorecard_surveys_ajax(option){
     $.ajax({
            type: option.type,
            url: option.url,
            data:{
                surveysId : option.surveysId
            },
            error: function(){
            } ,
            success:function(data){
                $("#ecu-"+option.surveysId).html(data);
            },
            complete:function(){
            }
       });
}

function humanscorecard_surveys_answers(option){
     $.ajax({
            type: option.type,
            url: option.url,
            data:'surveysId='+option.surveysId+option.answers,
            
            error: function(){
            } ,
            success:function(data){
               
            },
            complete:function(){
            }
       });
}
