 var tree = null;
 var _otxt="";
 var _ohidden="";
 var _oform="";
 var _oclass="";
 var _obtn="";
 var _odialog="";
 var _odiv="";
 var _cbo="";
 var js="";


     _otxt ={
        "ologin_user":'#txt-usuario-login',
        "ologin_password":'#txt-password-login',
        "osign_in_name":'#txtNombre',
        "osign_in_first_name":'#txtApellidos',
        "osign_in_email":'#txtEmail',
        "osign_in_password":'#txtPassword',
        "osign_in_repeat_password":'#txt-password-repeat',
        "oname_tree":'#txt-title-name-tree',
        "oname_indicador":'#txt-title-name-indicador',
        "oedit_title_indic":'#txt-title-edit-indicator',
        "oedit_description_indic":'#txt-description-edit-indicator',
        
        "oedit_min_indic":'#txt-value-mim-edit-indicator',
        "ocreate_min_indic":'#txt-value-mim-create-indicator',

        "oedit_desire_indic":'#txt-value-desire-edit-indicator',
        "ocreate_desire_indic":'#txt-value-desire-create-indicator',

        "oedit_optimindic":'#txt-value-optime-edit-indicator',
        "ocreate_optimindic":'#txt-value-optime-create-indicator',

        "oresponsable":'#txt-responsable-edit-indicator',
        "oresponsable_master":'#txt-responsable-edit-indicator-master',
        "oname_group":'#txt-name-group',
        "odivresponsable":'#txt-resposable-final',
        "oname_new_contact":'#txt-name-contact',
        "ofacebook_username":"#facebook_username",
        "otwitter_username":"#twitter_username",
        "ogoogle_fec_ini":"#fec_ini",
        "ogoogle_fec_fin":"#fec_fin",
        "newGroup" : "#txt-newgroup"

    }
      _cbo ={
        "oidgroup_tree":'#cbo-group-tree',
        "oidgroup_treePanel":'#cbo-group-tree-panel',
        "omedida_information":'#cbo-medida-information',
        "omedida_informationPanel":'#cbo-medida-information-panel',
        "oidconector":"#conector",
        "oidattribute":"#conector_atributos",
        "oidtable":"#tableId",
        "oidgroup":"#cbo-list-group",
        "oaux_manejo_data":"#cbo-manejo-data",
        "obost":"#cbo-bost-group"
    }

      _ohidden ={
        "oidtree":'#txt-id-tree',
        "idTree":'#id-tree',
        "oprevious":'#txt-id-previous',
        "oidindicator_delete":"#hd-id-indicator",
        "oidresponsable":'#hd-resposable-final',
        "oidresponsable_master":'#hd-resposable-final-master',
        "ogroupindictor":'#hd-id-grupo-indicator',
        "oidondicatoredit":'#hd-edit-indicator',
        "oundoId":'#hd-undo-id',
        "oundoProduction":'#hd-undo-production',
        "countIndicator":'#count-indicator'

    }
     _oform ={
        "osign_in":'#form_sign_in',
        "olog_in":'#form_log_in',
        "oaccount":"#frm-associate-account"
    }
     _oclass ={
        "otxt_error":'input_text_error',
         "otxt_input":'input-user',
        "otxt_tree": 'cls-txt-tree'
    }

    _obtn ={
        "ologin_in":'#signin_submit_on',
        "oassociate_account":'#btn-associate-account',
        "olog_out":'#btn-session-out',
        "ocreate_strategy":'#btn-create-strategy',
        "ocreate_tree":'#btn-create-tree',
        "osave_idicator":'#btn-save-indicator',
        "osave_strategy":'#btn-save-strategy',
        "oyesc_indicator":'#btn-yes-confirmation-delete-indicator',
        "onotc_indicator":'#btn-no-confirmation-delete-indicator',
        "osave_edit_indicator":'#btn-save-edit-indicator',
        "osave_configuracion_tree":'#btn-save-configuracion-tree',
        "odelete_tree":'#btn-delete-tree',
        "osave_group":'#btn-save-group',
        "oexecute_tree":'#btn-execute-tree',
        "onewContact":'#btn-save-new-contact',
        "oundoTree":'#btn-undo-tree'
    }

    _odialog ={
        "ocreate_strategy":'#dialog-create-strategy',
        "ocreate_indicador":'#dialog-add-indicador',
        "osave_tree":'#dialog-save-tree',
        "odelete_indicator":'#dialog-delete-indicador',
        "oconfiguration_indicador":'#dialog-configuration-indicador',
        "oconfiguration_indicador_master":'#dialog-configuration-indicador-master',
        "odelete_tree":'#dialog-show-delete-tree-production',
        "messageExit":'#dialog-message-exit'
    }

    _odiv = {
        "message_ajax":[
            {"id":0,"load":'#div-messaje-load',"description":'div load cuando se crea un arbol'},
            {"id":1,"load":'#div-messaje-load-indicator',"description":'div load cuando se crea un indicador'},
            {"id":2,"load":'#div-messaje-load-d-indicator',"description":'div load cuando se elimina un indicador'},
            {"id":3,"load":'#div-loading-edit-indicador',"description":'div load cuando se carga la edicion de un indicador'},
            {"id":4,"load":'#div-loading-children-indicador',"description":'div load cuando se carga los nodos hijos de un indicador'},
            {"id":5,"load":'#load-start-tree',"description":'div load cuando se pone en producccion un arbol'},
            {"id":6,"load":'#message-error-start-tree',"description":'mensaje de error cuando no se puede poner en produccion un div'},
            {"id":7,"load":'#div-loading-edit-indicador-master',"description":'mensaje de error cuando no se puede poner en produccion un div'},
            {"id":8,"load":'#div-loading-children-indicador-master',"description":'mensaje de error cuando no se puede poner en produccion un div'},
            {"id":9,"load":'#message-error-change-configuration',"description":''}
        ],
        "div_ajax":[
            {"id":0,"pk":'#tree-master',"description":'cuando elimino un indicador(en este div planto todo el html!)'},
            {"id":1,"pk":'#content-list',"description":'lista de contactos'},
            {"id":2,"pk":'#content-list-master',"description":'lista de contactos'}
        ],
        "div_help":[
            {"id":0,"pk":'#help-create-strategy-info',"description":'texto de informacion, dialog crear estrategia'},
            {"id":1,"pk":'#help-create-strategy-checked',"description":''},
            {"id":2,"pk":'#help-create-strategy-text',"description":''},
            {"id":3,"pk":'#help-create-strategy-iconhelp',"description":''},
            {"id":4,"pk":'#help-create-strategy-info-step-two',"description":''},
            {"id":4,"pk":'#help-create-strategy-info-step-three',"description":''}
        ],
        "div_content":[
            {"id":0,"pk":'#div-content-generl-edit-indicador',"description":'este div es el que contenedor total del div flotante'},
            {"id":1,"pk":'#div-valor-optimo',"description":'este div muestra el valor_otimo de cada indicador, si este se encuentra en el ultimo nivel'},
            {"id":2,"pk":'#contend-datos-edit-indicator-children',"description":'este div es el que contenedor de los nodos hijos'},
            {"id":3,"pk":'#div-content-responsabilidades',"description":'este div es el contenedor de las responsabilidades'},
            {"id":4,"pk":'#div-content-generl-edit-indicador-master',"description":'este div es el que contenedor total del div flotante'},
            {"id":5,"pk":'#contend-datos-edit-indicator-children-master',"description":'este div es el que contenedor total del div flotante'},
            {"id":6,"pk":'#content-ajax-contact',"description":'contentenedor lisado de contactos'},
            {"id":7,"pk":'#div-pnl-conector',"description":'es el panel de configuracion a conectores externos!'},
            {"id":8,"pk":'#pnl-message-list-delete-tree',"description":''}
        ]
    };

    js ={
        "ajax":[
            {"id":0,"parameter":'item_title',"function":'create_tree,create_indicador'},
            {"id":1,"parameter":'previous',"function":'create_indicador'},
            {"id":2,"parameter":'tree',"function":'create_indicador'},
            {"id":3,"parameter":'indicator',"function":'delete_indicador'}
        ]
    }



function requerido(lista)
{

        var cantidad = 0;
        var paso=true;
        var txtfocus="";
        for (i=lista.length-1;i>=0;i--){
         cantidad=trim($(lista[i]).val()).length;
         if(cantidad>0){
             $(lista[i]).addClass(_oclass.otxt_input).removeClass(_oclass.otxt_error);
         }else{
              $(lista[i]).addClass(_oclass.otxt_error).removeClass(_oclass.otxt_input);
              paso=false;
              txtfocus = lista[i];
            }
        }
        if(txtfocus.length>0){
            $(txtfocus).focus();
        }
        return paso;
}


function validateEmail(id){
      var texto=$(id).val();
      var filter_email=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      if (!filter_email.test(texto)){
        return false
      }
      return true;
}

function trim (myString)
{
 return myString.replace(/^\s+/g,'').replace(/\s+$/g,'');
}


function validarEmail(valor) {
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor)){
return (true)
} else {
//alert("La dirección de email es incorrecta.");
return (false);
}
}

function go_url(val){
    document.location.href=val;
}
