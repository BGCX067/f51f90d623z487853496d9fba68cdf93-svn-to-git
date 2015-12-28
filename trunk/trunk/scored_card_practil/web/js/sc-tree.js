function createTree(option){
    var treepk = "'"+option.treepk+"'";
    var div_init = '<div class="div-contenedor" ondblclick="show_edit_indicator_master('+treepk+')" >'+
                   '<ul><li style="height:48px;">'+
                   '<div class="title-indicador">'+option.title+'</div>'+                  
                   '</li><li>'+
                   '<div title="Añadir" class="cls-btn-add icon-edit-indicador" onclick="show_div_create_indicator('+treepk+');"></div>'+
                   '</li></ul></div>';
    tree = new ECOTree('tree','tree-master');
    tree.config.defaultNodeWidth = 150;
    tree.config.defaultNodeHeight = 50;
    tree.config.nodeColor = "#BCCCFF";
    tree.config.nodeBorderColor = "#C0C0C0";
    tree.config.linkColor = "#00000";
    tree.config.iRootOrientation = ECOTree.RO_LEFT;
    tree.config.linkType = "B";
    tree.config.nodeFill   = 1;
    tree.config.canvasWidth='1000px';
    tree.config.canvasHeight='500px';
    tree.config.selectMode = 2;
    tree.add(option.treepk,-1,div_init,165,65,'#FFFFFF',null,null);
    tree.UpdateTree();    
}


        
function createindicador(data,option){

 var  value_min  = '0';if(typeof(data.value_min)  != "undefined" && data.value_min != ""){value_min=data.value_min;}
  var  value_dese = '0';if(typeof(data.value_dese) != "undefined" && data.value_dese != ""){value_dese=data.value_dese;}
  var  value_opti = '0';if(typeof(data.value_opti) != "undefined" && data.value_opti != ""){value_opti=data.value_opti;}
  

var cls ="";
var cls_aux = "";
if(data.color=='#CCFFEE'){
    cls = 'cls-tree-success';
    cls_aux =  'cls-two-tree-success';

}else{
    cls = 'cls-tree-success-false';
    cls_aux =  'cls-two-tree-success-false';
}



if(!data.lastNode){
  var div_indicator =  '<div class="div-contenedor-children" ondblclick="show_edit_indicator('+data.indicatorpk+')" >'+
                       '<ul><li style="height:60px;">'+
                               '<div class="title-indicador-children">'+
                                       '<div class="title-children">'+data.title+'</div>'+
                                           '<div class="botonera-indicador">'+
                                                '<div title="Añadir" class="cls-btn-add" onclick="show_div_create_indicator('+data.indicatorpk+');"></div>'+
                                                '<div title="Editar" class="cls-btn-edit" onclick="show_edit_indicator('+data.indicatorpk+');"></div>'+
                                                '<div title="Eliminar" class="cls-btn-delete" onclick="show_div_delete_indicator('+data.indicatorpk+');"></div>'+
                                           '</div>'+
                               '</div>'+
                       '<div class="btn-two-d '+cls_aux+'">'+
                           '<div>'+value_min+'</div>'+
                           '<div class="separator-children"><hr /></div>'+
                           '<div>'+value_dese+'</div>'+
                       '</div>'+                    
                       '</li></ul></div>';
}else{

    var div_indicator =  '<div class="div-contenedor-children-aux" ondblclick="show_edit_indicator('+data.indicatorpk+')" >'+
                         '<ul><li style="height:60px;">'+
                               '<div class="title-indicador-children-aux">'+
                                       '<div class="title-children-aux">'+data.title+'</div>'+
                                           '<div class="botonera-indicador">'+
                                                '<div title="Añadir" class="cls-btn-add" onclick="show_div_create_indicator('+data.indicatorpk+');"></div>'+
                                                '<div title="Editar" class="cls-btn-edit" onclick="show_edit_indicator('+data.indicatorpk+');"></div>'+
                                                '<div title="Eliminar" class="cls-btn-delete" onclick="show_div_delete_indicator('+data.indicatorpk+');"></div>'+
                                           '</div>'+
                               '</div>'+
                       '<div class="btn-two-d-aux '+cls_aux+'">'+
                           '<div>'+value_min+'</div>'+
                           '<div class="separator-children"><hr /></div>'+
                           '<div>'+value_dese+'</div>'+
                       '</div>'+
                       '<div class="btn-three-d-aux '+cls+'" title="'+value_opti+'">'+value_opti+'</div>'+
                       '</li></ul></div>';
}



 
                   

    tree.add(data.indicatorpk,option.previous,div_indicator,175,60,'#FFFFFF',null,null);
    tree.UpdateTree();


}

function show_add_indicador(previous){
    $(_ohidden.ohdprevious).val(previous);
    $(_odialog.ocreate_indicador).dialog('open');
}


function resize_tree(cbo){
      if(tree){
            var value=$(cbo).val();
            if(value == 1){
                 tree.config.canvasWidth='1000px';
                 tree.config.canvasHeight='500px';
                 $('#div-content-area-tree').css('width', '1000px');
                 $('#div-content-area-tree').css('height', '500px');
            }else if(value == 2){
                 tree.config.canvasWidth='1500px';
                 tree.config.canvasHeight='1000px';
                 $('#div-content-area-tree').css('width', '1500px');
                 $('#div-content-area-tree').css('height', '1000px');
            }else if(value == 3){
                 tree.config.canvasWidth='1500px';
                 tree.config.canvasHeight='1500px';
                 $('#div-content-area-tree').css('width', '1500px');
                 $('#div-content-area-tree').css('height', '1500px');
            }else{
                 tree.config.canvasWidth='2000px';
                 tree.config.canvasHeight='1500px';
                 $('#div-content-area-tree').css('width', '2000px');
                 $('#div-content-area-tree').css('height', '1500px');
            }

            tree.UpdateTree();
      }
  
}
