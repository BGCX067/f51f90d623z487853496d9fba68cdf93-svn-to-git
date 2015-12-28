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
        "oedit_desire_indic":'#txt-value-desire-edit-indicator',
        "oedit_optimindic":'#txt-value-optime-edit-indicator',
        "oresponsable":'#txt-responsable-edit-indicator',    
        "oresponsable_master":'#txt-responsable-edit-indicator-master',
        "oname_group":'#txt-name-group',
        "odivresponsable":'#txt-resposable-final'

    }
      _cbo ={
        "oidgroup_tree":'#cbo-group-tree',
        "omedida_information":'#cbo-medida-information'
    }

      _ohidden ={
        "oidtree":'#txt-id-tree',
        "oprevious":'#txt-id-previous',
        "oidindicator_delete":"#hd-id-indicator",
        "oidresponsable":'#hd-resposable-final',
        "oidresponsable_master":'#hd-resposable-final-master',
        "ogroupindictor":'#hd-id-grupo-indicator',
        "oidondicatoredit":'#hd-edit-indicator'

    }    
     _oform ={
        "osign_in":'#form_sign_in',
        "olog_in":'#form_log_in',
        "oaccount":"#frm-associate-account"
    }
     _oclass ={
        "otxt_error":'input_text_error',
        "otxt_input":'input_text',
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
        "oexecute_tree":'#btn-execute-tree'
    }

    _odialog ={
        "ocreate_strategy":'#dialog-create-strategy',
        "ocreate_indicador":'#dialog-add-indicador',
        "osave_tree":'#dialog-save-tree',
        "odelete_indicator":'#dialog-delete-indicador',
        "oconfiguration_indicador":'#dialog-configuration-indicador',
        "oconfiguration_indicador_master":'#dialog-configuration-indicador-master'
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
        "div_content":[
            {"id":0,"pk":'#div-content-generl-edit-indicador',"description":'este div es el que contenedor total del div flotante'},
            {"id":1,"pk":'#div-valor-optimo',"description":'este div muestra el valor_otimo de cada indicador, si este se encuentra en el ultimo nivel'},
            {"id":2,"pk":'#contend-datos-edit-indicator-children',"description":'este div es el que contenedor de los nodos hijos'},
            {"id":3,"pk":'#div-content-responsabilidades',"description":'este div es el contenedor de las responsabilidades'},
            {"id":4,"pk":'#div-content-generl-edit-indicador-master',"description":'este div es el que contenedor total del div flotante'},
            {"id":5,"pk":'#contend-datos-edit-indicator-children-master',"description":'este div es el que contenedor total del div flotante'},
            {"id":6,"pk":'#content-ajax-contact',"description":'contentenedor lisado de contactos'}
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

