<?php	
if(!empty($this->Form->data[$tablename]["nom"])){
	echo $this->Html->script("/googlemaps/js/googlemap.js");
}
echo "<h1>";
	echo $this->Html->link(
		$titre,
		array(
			'action'=>'list'
		),
		array('escape'=>false)
	);
echo "</h1>";
?>

<fieldset>
<legend> 
<?php if(!empty($this->Form->data[$tablename]["nom"])){ 
	echo $this->Form->data[$tablename]["nom"];
}else{ 
	echo "Nouveau";
} ?>
 </legend>
<?php
	echo $this->Form->create($tablename);
	echo $this->Form->input('id');
	
	echo "<br/><label>Nom : </label><br/>";
	echo $this->Form->input('nom',array("label"=>"","size" => "50px"));
	echo "<br/><label>Largeur : </label><br/>";
	echo $this->Form->input('width',array("label"=>""));
	echo "<br/><label>Hauteur : </label><br/>";
	echo $this->Form->input('height',array("label"=>""));
	echo "<br/><label>Adresse : </label><br/>";
	echo $this->Form->input('adresse',array("label"=>"","id"=>"address"));
	echo "<br/><label>Contenu infobulle : </label><br/>";
	echo $this->Form->textarea('contenu',array("label"=>"","id"=>"contenuib"));
	?>
		<script type="text/javascript">
			//<![CDATA[
				CKEDITOR.replace( "contenuib");
			//]]>
		</script>
		<?php
	echo $this->Form->end("Envoyer");
if(!empty($this->Form->data[$tablename]["nom"])){
	echo '<div id="map_canvas" style="width:'.$this->Form->data[$tablename]["width"].'px; height:'.$this->Form->data[$tablename]["height"].'px"></div>';
}
?>
</fieldset>
