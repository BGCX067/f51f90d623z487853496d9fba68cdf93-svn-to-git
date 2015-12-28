$(document).ready(function(){
    $.fx.speeds._default = 400;

    
    populateSelect($("#conector").get(0), $.map(networks, function(maker) { return { name: maker.name, value: maker.name} }));

     $('#conector').bind('change', function() {
         
        var makerName = this.value,
                carMaker = filterByProperty(networks, 'name', makerName),
                models = [];

        if (carMaker.length > 0)
                models = $.map(carMaker[0].models, function(model) { return { name: model.description_short, value: model.id} });

        populateSelect($('#conector_atributos').get(0), models);
        $('#conector_atributos').trigger('change');
    });

    $("#conector").change(function(){
        if(this.value=='Google Analytics'){
            /* contenedores */
            $("#conector-facebook-content").hide();
            $("#conector-twitter-content").hide();
            $("#conector-google-content").show();
        }else if(this.value=='Facebook'){
            /* contenedores */
            $("#conector-twitter-content").hide();
            $("#conector-google-content").hide();
            $("#conector-facebook-content").show();
        }else if(this.value=='Twitter'){
            /* contenedores */
            $("#conector-facebook-content").hide();
            $("#conector-google-content").hide();
            $("#conector-twitter-content").show();
        }
    });

    $("#conector_atributos").change(function(){
        var option_value = $(this).val();
        if(option_value!=''){
            $("#network_description").html("* "+title[option_value]);
        }else{
            $("#network_description").html('');
        }
    });

     $("#cbo-manejo-data").change(function(){
        if(this.value=='1'){
            $("#conectores-inferiores-content").hide();
        }else if(this.value=='2'){
            $("#conectores-inferiores-content").show();
            if(false/* det_netw_attr_id!=null */){
                $("#conector-facebook-content").show();
            }
        }
        });

    $(_obtn.osave_idicator).click(function(){
      create_indicador_c();
    });

    $(_otxt.oname_indicador).keypress(function(event){
                  if (event.which == 13) {
                         create_indicador_c();
                    }
     });
     
     $(_odialog.ocreate_strategy).dialog({
        autoOpen: true,
        width:300,
        minHeight:100,
        modal: true
     });
     $(_odialog.ocreate_indicador).dialog({
        autoOpen: false,
        width:320,
        minHeight:250,
        resizable: false,
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
        width:1030,
        resizable: false,
        modal: true
     });
    $(_odialog.oconfiguration_indicador_master).dialog({
        autoOpen: false,
        minHeight:150,
        minWidth:200,
        resizable: true,
        modal: true
     });
});

function show_div_create_indicator_tree(idprevious)
{
         $(_ohidden.oprevious).val(idprevious);
         $(_otxt.oname_indicador).val('').focus();
         $(_odialog.ocreate_indicador).dialog('open');
}

function show_div_create_indicator(idprevious){
         $(_ohidden.oprevious).val(idprevious);
         $(_otxt.oname_indicador).val('').focus();
         $(_odialog.ocreate_indicador).dialog('open');
}

function metodoshow(){
    $(_odiv.message_ajax[3].load).hide();
    $(_odiv.div_content[0].pk).show('clip');
    $(_odialog.oconfiguration_indicador).dialog("option", "position", "center");
}

function desacer_cargar_responsable(){
       $(_otxt.odivresponsable).html('<input type="hidden"  id="hd-resposable-final" name="hd-resposable-final" />').hide();
       $(_otxt.oresponsable).val('').show().focus();
}

function show_div_delete_indicator(id){
            $(_ohidden.oidindicator_delete).val(id);
            $(_odialog.odelete_indicator).dialog('open');
}

function validar_rango(){
    if($(_odiv.div_content[1].pk).css('display')=="none"){
            if($(_otxt.oedit_desire_indic).val()<100 && $(_otxt.oedit_min_indic).val()>0 ){
                 if($(_otxt.oedit_desire_indic).val()>$(_otxt.oedit_min_indic).val()){
                        return true;
                 }else{ return false; }
            }else{  return false;  }
    }else{
            if($(_otxt.oedit_min_indic).val()>0 ){
                    if($(_otxt.oedit_desire_indic).val()>$(_otxt.oedit_min_indic).val()){
                         if($(_otxt.oedit_optimindic).val()>$(_otxt.oedit_desire_indic).val()){
                            return true;
                         }else{
                            return false;
                         }
                    }else{
                        return false;
                    }
            }else{
                return false;
            }
    }
}


function populateSelect(el, items) {
    el.options.length = 0;
    $.each(items, function () {
        el.options[el.options.length] = new Option(this.name, this.value);
    });
}

function filterByProperty(arr, prop, value) {
    return $.grep(arr, function (item) { return item[prop] == value });
}



