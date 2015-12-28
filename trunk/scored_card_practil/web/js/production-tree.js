function createTree2(option){

    var div_init = '<div class="div-contenedor">'+
                   '<ul><li style="height:48px;">'+
                   '<div class="title-indicador">'+option.title+'</div>'+
                   '</li><li>'+
                   '</li></ul></div>';
    tree = new ECOTree('tree','tree-master2');
    tree.config.defaultNodeWidth = 150;
    tree.config.defaultNodeHeight = 50;
    tree.config.nodeColor = "#fff";
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

function createindicador2(data,option){
  var div_indicator = '<div class="div-contenedor">'+
                      '<ul><li>'+
                      '<div class="title-indicador">'+data.title+'</div>'+
                      '<div class="botonera-indicador">'+
                      '</li></ul></div>';
    tree.add(data.indicatorpk,option.previous,div_indicator,null,null,null,null,null);
    tree.config.canvasWidth='1000px';
    tree.config.canvasHeight='500px';
    tree.UpdateTree();
}

function show_add_indicador2(previous){
    $(_ohidden.ohdprevious).val(previous);
    $(_odialog.ocreate_indicador).dialog('open');
}

/////////////////////////////////////////////////////////////

function create_sub_tree(option){

   var div_init = '<div class="div-contenedor">'+
                   '<ul><li style="height:48px;">'+
                   '<div class="title-indicador">'+option.title+'</div>'+
                   '</li><li>'+
                   '</li></ul></div>';


    tree = new ECOTree('tree','tree-master2');
    tree.config.defaultNodeWidth = 150;
    tree.config.defaultNodeHeight = 50;
    tree.config.nodeColor = "#C9C9C9";
    tree.config.nodeBorderColor = "#C0C0C0";
    tree.config.linkColor = "#00000";
    tree.config.iRootOrientation = ECOTree.RO_LEFT;
    tree.config.linkType = "B";
    tree.config.nodeFill   = 1;
    tree.config.canvasWidth='1000px';
    tree.config.canvasHeight='500px';
    tree.config.selectMode = 2;
    tree.add(0,-1,div_init,165,65,'#FFFFFF',null,null);
    tree.UpdateTree();

}

function create_indicador_production(data){

     var cls ="";
     if(data.color=="#70FF8A")     {cls = 'cls-production-css-green';}
     else if(data.color=="#FF8787"){cls = 'cls-production-css-ambar';}
     else                          {cls = 'cls-production-css-red';}

     var porcentaje ='';
      if(data.porcentaje!="")
      {
         porcentaje = '<div style="font-size: 9px;font-family: Arial;position: absolute;margin-left: -25px;height: 12px;width: 21px;margin-top:17px;background: #FFF;">'+data.porcentaje+'%</div>';
      }

          var div_indicator =  porcentaje+
                         '<div class="div-contenedor-children-aux" ondblclick="show_record_indicator('+data.indicatorpk+')">'+
                         '<ul><li style="height:60px;">'+
                               '<div class="title-indicador-children-aux" style="width: 43%;">'+
                                       '<div class="title-children-aux">'+data.title+'</div>'+
                               '</div>'+
                       '<div style="width: 20%;" class="btn-two-d-aux '+cls+'">'+
                            '<div  title="valor deseado: '+data.valueDes+'">'+data.valueDes+'</div>'+
                           '<div class="separator-children"><hr /></div>'+
                          '<div  title="valor minimo: '+data.valueMin+'">'+data.valueMin+'</div>'+
                       '</div>'+
                       '<div style="width: 33%;" class="btn-three-d-aux '+cls+'" title="valor entregado: '+data.value+'">'+data.value+'</div>'+
                       '</li></ul></div>';

  /*var div_indicator = '<div class="div-contenedor" ondblclick="show_record_indicator('+data.indicatorpk+')">'+
                      '<ul><li>'+
                      '<div class="title-indicador">'+data.title+'</div>'+
                      '<div class="botonera-indicador">'+
                      '</li></ul></div>';*/

    tree.add(data.indicatorpk,data.previous,div_indicator,186,60,null,null,null);
    tree.UpdateTree();


}

function create_indicador_production_owner(data,option){


     var cls ="";
     if(data.color=="#70FF8A")     {cls = 'cls-production-css-green';}
     else if(data.color=="#FF8787"){cls = 'cls-production-css-ambar';}
     else                          {cls = 'cls-production-css-red';}

      var porcentaje ='';    
      if(data.porcentaje!="")
      {
         porcentaje = '<div style="font-size: 9px;font-family: Arial;position: absolute;margin-left: -25px;height: 12px;width: 21px;margin-top:17px;background: #FFF;">'+data.porcentaje+'%</div>';
      }
      
      var div_indicator =  porcentaje+
                           '<div  class="div-contenedor-children-aux" ondblclick="show_record_indicator('+data.indicatorpk+')">'+
                           '<ul><li style="height:60px;">'+
                               '<div class="title-indicador-children-aux" style="width: 43%;">'+
                                       '<div class="title-children-aux">'+data.title+'</div>'+
                               '</div>'+
                           '<div style="width: 20%;" class="btn-two-d-aux '+cls+'">'+
                           '<div  title="valor deseado: '+data.valueDes+'">'+data.valueDes+'</div>'+
                           '<div class="separator-children"><hr /></div>'+
                           '<div  title="valor minimo: '+data.valueMin+'">'+data.valueMin+'</div>'+
                           '</div>'+
                           '<div style="width: 33%;" class="btn-three-d-aux '+cls+'" title="valor entregado: '+data.value+'">'+data.value+'</div>'+
                           '</li></ul></div>';



    tree.add(data.indicatorpk,option.previous,div_indicator,186,60,null,null,null);
    tree.UpdateTree();
}

function resize_tree(){
    var maximo_valor_height = 0;
    var valor_aux_height= 0;

    var maximo_valor_width = 0;
    var valor_aux_width= 0;
    
    elements = $('.econode');
    elements.each(function() {       
        valor_aux_height = $(this).css('top');
        valor_aux_width = $(this).css('left');

        valor_aux_height = valor_aux_height.substr(0,valor_aux_height.indexOf("p"));
        valor_aux_width = valor_aux_width.substr(0,valor_aux_width.indexOf("p"));

        valor_aux_height =parseInt(valor_aux_height);
         valor_aux_width =parseInt(valor_aux_width);

        if(valor_aux_height>maximo_valor_height){
            maximo_valor_height = valor_aux_height;
        } 
        
          if(valor_aux_width>maximo_valor_width){
            maximo_valor_width = valor_aux_width;
        }
    });

       
       tree.config.canvasHeight=maximo_valor_height+'px';
       tree.config.canvasWidth=maximo_valor_width+'px';
       tree.UpdateTree();
    
}



