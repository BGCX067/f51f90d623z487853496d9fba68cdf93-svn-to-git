<style type="text/css">
        label, select, option, input, a {
                font-family : "Verdana";
                font-size : 10px;
                color : black;
        }
        .copy {
                font-family : "Verdana";
                font-size : 10px;
                color : #CCCCCC;
        }
</style>


<script type="text/javascript">

    $(document).ready(function(){
        CreateTree2();
        $(".scordpractil").dblclick(function(){
            //alert($(this).attr('id') );
        });
    });


    function add_new_node(id){
          t.add(15,id, '<div class="div-contenedor">Sub-Plan2</div>',null,null,null,null,null);
          t.UpdateTree();
 }

			

			function CreateTree2() {
				t = new ECOTree('t','sample1');
                                t.config.defaultNodeWidth = 150;
				t.config.defaultNodeHeight = 50;
                                t.config.nodeColor = "#CCFFEE";
                                t.config.nodeBorderColor = "#C0C0C0";
                                t.config.linkColor = "#00000";
                                t.config.iRootOrientation = ECOTree.RO_LEFT;                                
                                t.config.linkType = "B";
                                t.config.nodeFill   = 1;
                                t.config.selectMode = 2;

				t.add(1,-1,'<div class="div-contenedor">Objetivo Principal </div>',null,null,null,null,null);
                                t.add(2,1, '<div class="div-contenedor">Plan1</div>',null,null,null,null,null);
                                t.add(3,1, '<div class="div-contenedor">Plan2 <a href="javascript:void(0)" onclick="add_new_node(3);">+</a></div>',null,null,"#FFFFCC","#FFBF00",null);
                                t.add(4,1, '<div class="div-contenedor">Plan3</div>',null,null,null,null,null);
                                t.add(5,4, '<div class="div-contenedor">sub-plan3</div>',null,null,null,null,null);
				t.add(6,5, '<div class="div-contenedor">sub-sub-plan3</div>',null,null,"#D95762",null,null);
                                t.add(7,5, '<div class="div-contenedor">sub-sub-plan3</div>',null,null,null,null,null);
				t.UpdateTree();
			}


			function ChangePosition() {
				var pos = parseInt(document.forms[0].rootPosition.value);
				t.config.iRootOrientation = pos;
				switch (pos)
				{
					case ECOTree.RO_TOP:
						t.config.topXAdjustment = 20;
						t.config.topYAdjustment = -20;
						break;
					case ECOTree.RO_BOTTOM:
						t.config.topXAdjustment = 20;
						t.config.topYAdjustment = -500;
						break;
					case ECOTree.RO_RIGHT:
						t.config.topXAdjustment = 20;
						t.config.topYAdjustment = -500;
						break;
					case ECOTree.RO_LEFT:
						t.config.topXAdjustment = 20;
						t.config.topYAdjustment = -20;
						break;
				}
				t.UpdateTree();
			}

			function ChangeLinkType() {
				t.config.linkType = document.forms[0].linktype.value;
				t.UpdateTree();
			}

			function ChangeNodeAlign() {
				t.config.iNodeJustification = parseInt(document.forms[0].nodealign.value);
				t.UpdateTree();
			}

			function Modify(what, inp, val) {
				var q = parseInt(document.forms[0][inp].value) + val;
				document.forms[0][inp].value = q;
				t.config[what] = q;
				t.UpdateTree();
			}

			function IncreaseSubtreeSep() { Modify("iSubtreeSeparation","stsep",5); }
			function DecreaseSubtreeSep() { Modify("iSubtreeSeparation","stsep",-5); }
			function IncreaseSiblingSep() { Modify("iSiblingSeparation","sbsep",5); }
			function DecreaseSiblingSep() { Modify("iSiblingSeparation","sbsep",-5); }
			function IncreaseLevelSep() { Modify("iLevelSeparation","lvsep",5); }
			function DecreaseLevelSep() { Modify("iLevelSeparation","lvsep",-5); }

			function ChangeColors() {
				var nodes = ['O','E',3,4,5,6,7,'eight',9,10,11,12,13,14,15];
				var color = document.forms[0].colorSet.value;
				var c = "";
				t.config.linkColor = color;
				switch (color)
				{
					case "red":
						c = "#FFCCCC";
						t.config.levelColors = t.config.levelBorderColors = ["#FF5555","#FF8888","#FFAAAA","#FFCCCC"];
						break;
					case "green":
						c = "#CCFFCC";
						t.config.levelColors = t.config.levelBorderColors = ["#55FF55","#88FF88","#AAFFAA","#CCFFCC"];
						break;
					case "blue":
						c = "#CCCCFF";
						t.config.levelColors = t.config.levelBorderColors = ["#5555FF","#8888FF","#AAAAFF","#CCCCFF"];
						break;
				}
				for (var n = 0; n < nodes.length; n++) {
					t.setNodeColors(nodes[n], c, color, false);
				}
				t.UpdateTree();
			}

			function ChangeSearchMode() {
				var mode = parseInt(document.forms[0].searchMode.value);
				t.config.searchMode = mode;
			}

			function SearchTree() {
				var txt = document.forms[0].search.value;
				t.searchNodes(txt);
			}

			function ChangeSelMode() {
				var mode = parseInt(document.forms[0].selMode.value);
				t.config.selectMode = mode;
				t.unselectAll();
			}

			function ChangeNodeFill() {
				var mode = parseInt(document.forms[0].nodefill.value);
				t.config.nodeFill = mode;
				t.UpdateTree();
			}

			function ChangeColorStyle() {
				var mode = parseInt(document.forms[0].colorstyle.value);
				t.config.colorStyle = mode;
				t.UpdateTree();
			}

			function ChangeUseTarget() {
				var flag = (document.forms[0].usetarget.value == "true");
				t.config.useTarget = flag;
				t.UpdateTree();
			}

			function selectedNodes() {
				var selnodes = t.getSelectedNodes();
				var s = [];
				for (var n = 0; n < selnodes.length; n++)
				{
					s.push('' + n + ': Id=' + selnodes[n].id + ', Title='+ selnodes[n].dsc + ', Metadata='+ selnodes[n].meta + '\n');
				}
				alert('The selected nodes are:\n\n' + ((selnodes.length >0) ? s.join(''): 'None.'));
			}

</script>

<h4>ECOTree Advanced Sample&nbsp;<span class="copy">&copy;2006 Emilio Cortegoso Lobato</span></h4>
	<form id="mainform">
			<div>
			<label>Root position:</label>
			<select id="rootPosition" onchange="ChangePosition();" >
				<option value="0" selected>Top</option>
				<option value="1">Bottom</option>
				<option value="2">Right</option>
				<option value="3">Left</option>
			</select>
			<label>Link type:</label>
			<select id="linktype" onchange="ChangeLinkType();" >
				<option value="M" selected>Manhattan</option>
				<option value="B">Bézier</option>
			</select>
			<label>Node Alignment:</label>
			<select id="nodealign" onchange="ChangeNodeAlign();" >
				<option value="0" selected>Top</option>
				<option value="1">Center</option>
				<option value="2">Bottom</option>
			</select>
			<label>Subtree Sep.:</label>

                        <a href="javascript:DecreaseSubtreeSep();"><?php echo image_tag('less.gif') ?></a>
			<input id="stsep" value=80 size="3" maxlength="3" readonly />
			<a href="javascript:IncreaseSubtreeSep();"><?php echo image_tag('plus.gif') ?></a>
			<label>Sibling Sep.:</label>
			<a href="javascript:DecreaseSiblingSep();"><?php echo image_tag('less.gif') ?></a>
			<input id="sbsep" value=40 size="3" maxlength="3" readonly />
			<a href="javascript:IncreaseSiblingSep();"><?php echo image_tag('less.gif') ?></a>
			<label>Level Sep.:</label>
			<a href="javascript:DecreaseLevelSep();"><?php echo image_tag('less.gif') ?></a>
			<input id="lvsep" value=40 size="3" maxlength="3" readonly/>
			<a href="javascript:IncreaseLevelSep();"><?php echo image_tag('plus.gif') ?></a>
			</div>
			<div>
			<label>Color combination:</label>
			<select id="colorSet" onchange="ChangeColors();" >
				<option value="red">Red</option>
				<option value="green">Green</option>
				<option value="blue" selected>Blue</option>
			</select>
			&nbsp;
			<label>Selection mode:</label>
			<select id="selMode" onchange="ChangeSelMode();" >
				<option value=0 selected>Multiple</option>
				<option value=1>Single</option>
				<option value=2>None</option>
			</select>
			&nbsp;
			<label>Hyperlinks:</label>
			<select id="usetarget" onchange="ChangeUseTarget();" >
				<option value="true" selected>Yes</option>
				<option value="false">No</option>
			</select>
			&nbsp;
			<label>Search mode:</label>
			<select id="searchMode" onchange="ChangeSearchMode();" >
				<option value=0 selected>Title</option>
				<option value=1>Metadata</option>
				<option value=2>Both</option>
			</select>
			&nbsp;
			<label>Search:</label>
			<input id="search" value="" size="10" maxlength="20"/>
			<a href="javascript:SearchTree();"><?php echo image_tag('search.gif','align="absbottom"') ?> </a>
			</div>
			<div>
			&nbsp;
			<label>Node fill:</label>
			<select id="nodefill" onchange="ChangeNodeFill();" >
				<option value=0 selected>Gradient</option>
				<option value=1>Solid</option>
			</select>
			&nbsp;
			<label>Color style:</label>
			<select id="colorstyle" onchange="ChangeColorStyle();" >
				<option value=0 selected>Node colors</option>
				<option value=1>Level colors</option>
			</select>

			<a href="javascript:t.collapseAll();">Collapse All</a>
			<a href="javascript:t.expandAll();">Expand All</a>
			<a href="javascript:t.selectAll();">Select All</a>
			<a href="javascript:t.unselectAll();">Unselect All</a>
			<a href="javascript:selectedNodes();">Show selected</a>
			</div>
		</form>

<div id="sample1">
		</div>




