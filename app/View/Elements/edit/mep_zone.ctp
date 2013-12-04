
	<div id="zp_save" class="zp_save"></div>
	<div id="zp_openclose" class="zp_close"></div>
	<div id="zp_name" class="zp_name"></div>
	<div id="zp_cont" class="zp_cont">
		Largeur : <br/><input type="text" id="zp_width" title="Accept : px(pixel), %(pourcent) or em(relative)" /><br/><br/>
		Hauteur : <br/><input type="text" id="zp_height" title="Accept : px(pixel), %(pourcent) or em(relative)" /><br/><br/>
		Couleur de fond : <br/><input type="text" id="zp_fondcolor"  value="#00ff00" title="Code Couleur Hexadécimal" /><br/><br/>
		Espacement exterieur : <br/><input type="text" id="zp_margin4" title="A Gauche" style="width:40px" /> - <input type="text" id="zp_margin1" title="En Haut" style="width:40px" /> - <input type="text" id="zp_margin3" title="En Bas" style="width:40px" /> - <input type="text" id="zp_margin2" title="A Droite" style="width:40px" /><br/><br/>
		Espacement interrieur : <br/><input type="text" id="zp_padding4" title="A Gauche" style="width:40px" /> - <input type="text" id="zp_padding1" title="En Haut" style="width:40px" /> - <input type="text" id="zp_padding3" title="En Bas" style="width:40px" /> - <input type="text" id="zp_padding2" title="A Droite" style="width:40px" /><br/><br/>
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
		Image de fond : <br/><input type="hidden" id="zp_fondimg"  />
		<div id="supprimg" class="supprimg">Supprimer l'image</div>
		<br/><br/>
		<div id="dropfile_content" style="margin:auto;">
			<div id="dropfile" class="dropfile"></div>
		</div>
	</div>
<script type="text/javascript">
	jQuery(function($){
		
		$('#dropfile').dropfile({
			message : 'Déposez vos fichiers',
			trash : false,
			select : false,
			clone : false,
			rename : false,
			inputmaj : $('#zp_fondimg'),
			script : __prefix+'/js/multiupload/upload.php',
			foldermin : '0',
			widthmin : '0',
			heightmin : '0'
		});
	});
</script>