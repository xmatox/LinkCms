<?php
echo $this->Html->script("/js/jquery/colorpicker/js/colorpicker.js");
echo $this->Html->script("/js/jquery/colorpicker/js/eye.js");
echo $this->Html->script("/js/jquery/colorpicker/js/utils.js");
echo $this->Html->script("/js/jquery/colorpicker/js/layout.js?ver=1.0.2");
echo $this->Html->css("/js/jquery/colorpicker/css/colorpicker.css");
echo $this->Html->css("/js/jquery/colorpicker/css/layout.css");

echo $this->Html->script("/js/multiupload/dropfile.js");
echo $this->Html->css("/js/multiupload/style.css");

echo $this->Html->script("/js/graph/graph.js");
echo $this->Html->css("/admin/graph.css");



echo "<h1>";
	echo "Graphisme";
echo "</h1>";
$typegraph="";
foreach($graph as $g){
	if($g["Graphelement"]["nom"]=="droite" && $g["Graphelement"]["active"]==true){
		if(empty($typegraph)) $typegraph="D";
		else $typegraph="DG";
	}else if($g["Graphelement"]["nom"]=="gauche" && $g["Graphelement"]["active"]==true){
		if(empty($typegraph)) $typegraph="G";
		else $typegraph="DG";
	} 
}

?>

<fieldset>
<legend> 
Choix du zoning :
</legend> 

<div id="graph1" <?php if(empty($typegraph)) echo "class='graphselect'"; ?> onclick="$.get( '<?php echo $this->Html->url( array( 'controller' => 'graphelements', 'action' => 'ajax_settype' ), true ); ?>', { typegraph: '' } ,function( data ) { if(data){ location.reload(); } }); return false;" ></div>
<div id="graph2" <?php if($typegraph=="G") echo "class='graphselect'"; ?> onclick="$.get( '<?php echo $this->Html->url( array( 'controller' => 'graphelements', 'action' => 'ajax_settype' ), true ); ?>', { typegraph: 'G' } ,function( data ) { if(data){ location.reload(); } } ); return false;" ></div>
<div id="graph3" <?php if($typegraph=="D") echo "class='graphselect'"; ?> onclick="$.get( '<?php echo $this->Html->url( array( 'controller' => 'graphelements', 'action' => 'ajax_settype' ), true ); ?>', { typegraph: 'D' } ,function( data ) { if(data){ location.reload(); } } ); return false;" ></div>
<div id="graph4" <?php if($typegraph=="DG") echo "class='graphselect'"; ?> onclick="$.get( '<?php echo $this->Html->url( array( 'controller' => 'graphelements', 'action' => 'ajax_settype' ), true ); ?>', { typegraph: 'DG' } ,function( data ) { if(data){ location.reload(); } } ); return false;" ></div>

</fieldset>
<br/>
<i>Cliquez sur une zone pour la sélectionner.<br/>Pour selectionner le fond recliquer sur la zone selectionné.<br/>
<div id="zonevisu">
	<div id="zbody" class="zoneselect">
		<div id="zcontenu">
			<div id="tete" class="zheader selectit">
				
			</div>
			<div id="gauche" class="znav selectit">
				
			</div>
			<div id="centre" class="zcontent selectit">
				
			</div>
			<div id="droite" class="znav selectit">
				
			</div>
			<div class="clear selectit"></div>
			
		</div>
		<div id="pied" class="zfooter selectit">
				<div id="piedcont"></div>
		</div>
	</div>
</div>

<div id="zoneparam">
	<div id="zp_save"></div>
	<div id="zp_name"></div><br/>
	Largeur : <br/><input type="text" id="zp_width" /><br/><br/>
	Hauteur : <br/><input type="text" id="zp_height" /><br/><br/>
	Couleur de fond : <br/><input type="text" id="zp_fondcolor"  value="#00ff00"/><br/><br/>
	Espacement exterieur : <br/>Haut<input type="text" id="zp_margin1" style="width:25px" /> - Droite<input type="text" id="zp_margin2" style="width:25px" /> - bas<input type="text" id="zp_margin3" style="width:25px" /> - gauche<input type="text" id="zp_margin4" style="width:25px" /><br/><br/>
	Espacement interrieur : <br/>Haut<input type="text" id="zp_padding1" style="width:25px" /> - Droite<input type="text" id="zp_padding2" style="width:25px" /> - bas<input type="text" id="zp_padding3" style="width:25px" /> - gauche<input type="text" id="zp_padding4" style="width:25px" /><br/><br/>
	Position de l'image de fond : <br/>
	<select id="zp_fondimgpos">
	<option value=""></option>
	<option value="top left">En haut à gauche</option>
	<option value="left">Centré à gauche</option>
	<option value="bottom left">En bas à gauche</option>
	<option value="top center">En haut centré</option>
	<option value="center">Centré</option>
	<option value="bottom center">En bas Centré</option>
	<option value="top right">En haut à droite</option>
	<option value="right">Centré à droite</option>
	<option value="bottom right">En bas à droite</option>
	</select><br/><br/>
	Répétition de l'image de fond : <br/>
	<select id="zp_fondimgrepeat">
	<option value=""></option>
	<option value="no-repeat">Pas répété</option>
	<option value="repeat-x">Horizontal</option>
	<option value="repeat-y">Vertical</option>
	<option value="repeat">Les deux</option>
	</select><br/><br/>
	Image de fond : <br/><input type="text" id="zp_fondimg"  /><br/><br/>
	<div id="dropfile_content" style="margin:auto;">
		<div class="dropfile"></div>
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript">
	jQuery(function($){
		$('.dropfile').dropfile({
			message : 'Déposez vos fichiers',
			trash : false,
			select : false,
			clone : false,
			rename : true,
			inputmaj : $('#zp_fondimg'),
			script : '../../js/multiupload/upload.php',
			foldermin : '0',
			widthmin : '0',
			heightmin : '0'
		});
		
		
	});
</script>