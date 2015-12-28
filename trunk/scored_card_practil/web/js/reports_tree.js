function createTreeReports(option){
    var treepk = "'"+option.treepk+"'";
    var div_init = '<div class="div-contenedor">'+
                   '<ul><li>'+
                   '<div class="title-indicador">'+option.title+'</div>'+
                   '<div class="cls-add-idndicador" id="container-add-indicador-tree"></div>'+
                   '</li></ul></div>';
    tree = new ECOTree('tree','tree-master3');
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
    tree.add(option.treepk,-1,div_init,null,null,null,null,null);
    tree.UpdateTree();
}

function createindicadorReports(data,option){
  var div_indicator = '<div class="div-contenedor"  ondblclick="show_record_indicator('+data.indicatorpk+')">'+
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
    var div_init = '<div class="div-contenedor" >'+
                   '<ul><li>'+
                   '<div class="title-indicador">'+option.title+'</div>'+
                   '<div class="cls-add-idndicador" id="container-add-indicador-tree"></div>'+
                   '</li></ul></div>';
    tree = new ECOTree('tree','tree-master2');
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
    tree.add(0,-1,div_init,null,null,null,null,null);
    tree.UpdateTree();

}

function create_indicador_production(data){

  var div_indicator = '<div class="div-contenedor" ondblclick="show_record_indicator('+data.indicatorpk+')">'+
                      '<ul><li>'+
                      '<div class="title-indicador">'+data.title+'</div>'+
                      '<div class="botonera-indicador">'+
                      '</li></ul></div>';
    tree.add(data.indicatorpk,data.previous,div_indicator,null,null,null,null,null);
    tree.config.canvasWidth='1000px';
    tree.config.canvasHeight='500px';
    tree.UpdateTree();
}

