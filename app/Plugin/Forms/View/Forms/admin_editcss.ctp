<?php	
echo $this->Html->script("/js/jquery/colorpicker/js/colorpicker.js");
echo $this->Html->script("/js/jquery/colorpicker/js/eye.js");
echo $this->Html->script("/js/jquery/colorpicker/js/utils.js");
echo $this->Html->script("/js/jquery/colorpicker/js/layout.js?ver=1.0.2");
echo $this->Html->css("/js/jquery/colorpicker/css/colorpicker.css");
echo $this->Html->css("/js/jquery/colorpicker/css/layout.css");

echo $this->Html->script("/js/multiupload/dropfile.js");
echo $this->Html->css("/js/multiupload/style.css");

echo $this->Html->css('style.css');
echo $this->Html->css("menu.css");
echo $this->Html->script("graph/editcss.js");
echo $this->Html->css("/admin/graph.css");
echo "<h1>";
	echo $this->Js->link(
		$titre,
		array(
			'controller'=>'forms',
			'action'=>'list'
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
	echo " > ";
	echo $this->Js->link(
		$theform,
		array(
			'controller'=>'formelements',
			'action'=>'list',
			$theformid
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</h1>";
?>

<div id="zonevisu2" data-value="<?php echo $theformid; ?>">
	<div id="centre" style="border:1px #999 solid">
	<?php
	echo $conthtml;
	?>	
	</div>
</div>

<div id="zoneparam" style="height:auto;width:600px" data-value="ze_fo<?php echo $theformid; ?>">
<div id="zp_save" class="save"></div>
	Alignement : 
	<select id="zp_float">
		<option value="">Vertical</option>
		<option value="left">Horizontal</option>
	</select><br/><br/>
	Largeur : <input type="text" id="zp_width" /><br/><br/>
	Hauteur : <input type="text" id="zp_height" /><br/><br/>
	Bordure : Epaisseur<select id="zp_border1"><option value="0px"></option><option value="1px">1px</option><option value="2px">2px</option><option value="3px">3px</option><option value="4px">4px</option><option value="5px">5px</option></select> - Couleur<input type="text" id="zp_border2" style="width:80px" /><br/><br/>
	Bordure arrondi : Haut Gauche<input type="text" id="zp_borderradius1" style="width:25px" /> - Haut Droite<input type="text" id="zp_borderradius2" style="width:25px" /> - Bas Droite<input type="text" id="zp_borderradius3" style="width:25px" /> - Bas Gauche<input type="text" id="zp_borderradius4" style="width:25px" /><br/><br/>
	Espacement exterieur : Haut<input type="text" id="zp_margin1" style="width:25px" /> - Droite<input type="text" id="zp_margin2" style="width:25px" /> - bas<input type="text" id="zp_margin3" style="width:25px" /> - gauche<input type="text" id="zp_margin4" style="width:25px" /><br/><br/>
	Espacement interrieur : Haut<input type="text" id="zp_padding1" style="width:25px" /> - Droite<input type="text" id="zp_padding2" style="width:25px" /> - bas<input type="text" id="zp_padding3" style="width:25px" /> - gauche<input type="text" id="zp_padding4" style="width:25px" /><br/><br/>
	Couleur de fond : <input type="text" id="zp_fondcolor"  value=""/><br/><br/>
	Taille du texte : <input type="text" id="zp_textsize"/><br/><br/>
	Couleur du texte : <input type="text" id="zp_textcolor"/><br/><br/>
	Alignement du texte : <select id="zp_textalign"><option value="left">A Gauche</option><option value="center">Center</option><option value="right">A Droite</option></select><br/><br/>
	Epaisseur du texte : <select id="zp_textgras"><option value="normal">Normal</option><option value="bold">Gras</option></select><br/><br/>
	
	Position de l'image de fond : 
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
	Répétition de l'image de fond : 
	<select id="zp_fondimgrepeat">
	<option value=""></option>
	<option value="no-repeat">Pas répété</option>
	<option value="repeat-x">Horizontal</option>
	<option value="repeat-y">Vertical</option>
	<option value="repeat">Les deux</option>
	</select><br/><br/>
	Image de fond : <input type="text" id="zp_fondimg" /><br/><br/>
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
			script : '../../../../js/multiupload/upload.php',
			foldermin : '0',
			widthmin : '0',
			heightmin : '0'
		});
		
		
	});
</script>