<div id="zp_elstyle" style="display:none;">
		<div id="zp_save_elstyle" class="zp_save"></div>
		<div id="zp_openclose_elstyle" class="zp_close"></div>
		<div id="zp_name_elstyle" class="zp_name"></div>
		<div id="zp_cont_elstyle" class="zp_cont">
			Alignement : 
			<select id="zpe_float">
				<option value="">Vertical</option>
				<option value="left">Horizontal à Gauche</option>
				<option value="right">Horizontal à Droite</option>
			</select><br/><br/>
			Largeur : <input type="text" id="zpe_width" title="Accept : px(pixel), %(pourcent) or em(relative)" /><br/><br/>
			Hauteur : <input type="text" id="zpe_height" title="Accept : px(pixel), %(pourcent) or em(relative)" /><br/><br/>
			Bordure : Epaisseur<select id="zpe_border1"><option value="0px"></option><option value="1px">1px</option><option value="2px">2px</option><option value="3px">3px</option><option value="4px">4px</option><option value="5px">5px</option></select> - Couleur<input type="text" id="zpe_border2" title="Code Couleur Hexadécimal" style="width:80px" /><br/><br/>
			Bordure arrondi : <input type="text" id="zpe_borderradius1" title="Haut Gauche" style="width:25px" /> - <input type="text" id="zpe_borderradius2" title="Haut Droite" style="width:25px" /> - <input type="text" id="zpe_borderradius3" title="Bas Droite" style="width:25px" /> - <input type="text" id="zpe_borderradius4" title="Bas Gauche" style="width:25px" /><br/><br/>
			Espacement exterieur : <br/><input type="text" id="zpe_margin4" title="A Gauche" style="width:25px" /> - <input type="text" id="zpe_margin1" title="En Haut" style="width:25px" /> - <input type="text" id="zpe_margin3" title="En Bas" style="width:25px" /> - <input type="text" id="zpe_margin2" title="A Droite" style="width:25px" /><br/><br/>
			Espacement interrieur : <br/><input type="text" id="zpe_padding4" title="A Gauche" style="width:25px" /> - <input type="text" id="zpe_padding1" title="En Haut" style="width:25px" /> - <input type="text" id="zpe_padding3" title="En Bas" style="width:25px" /> - <input type="text" id="zpe_padding2" title="A Droite" style="width:25px" /><br/><br/>

			Couleur de fond : <input type="text" id="zpe_fondcolor" title="Code Couleur Hexadécimal"  value=""/><br/><br/>
			Taille du texte : <input type="text" id="zpe_textsize" /><br/><br/>
			Couleur du texte : <input type="text" id="zpe_textcolor"  title="Code Couleur Hexadécimal"/><br/><br/>
			Alignement du texte : <select id="zpe_textalign"><option value="left">A Gauche</option><option value="center">Center</option><option value="right">A Droite</option></select><br/><br/>
			Epaisseur du texte : <select id="zpe_textgras"><option value="normal">Normal</option><option value="bold">Gras</option></select><br/><br/>
			
			Position de l'image de fond : 
			<select id="zpe_fondimgpos">
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
			<select id="zpe_fondimgrepeat">
			<option value=""></option>
			<option value="no-repeat">Pas répété</option>
			<option value="repeat-x">Horizontal</option>
			<option value="repeat-y">Vertical</option>
			<option value="repeat">Les deux</option>
			</select><br/><br/>
			Image de fond : <input type="hidden" id="zpe_fondimg" />
			<div id="supprimg_e" class="supprimg">Supprimer l'image</div>
			<br/><br/>
			<div id="dropfile_content_e" style="margin:auto;">
				<div id="dropfile_e" class="dropfile"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<script type="text/javascript">
	jQuery(function($){
		
		$('#dropfile_e').dropfile({
			message : 'Déposez vos fichiers',
			trash : false,
			select : false,
			clone : false,
			rename : false,
			inputmaj : $('#zpe_fondimg'),
			script : __prefix+'/js/multiupload/upload.php',
			foldermin : '0',
			widthmin : '0',
			heightmin : '0'
		});
		
	});
</script>