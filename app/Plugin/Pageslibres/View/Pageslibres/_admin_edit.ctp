<?php	
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
<?php if(!empty($this->Form->data["Pageslibre"]["nom"])){ 
	echo $this->Form->data["Pageslibre"]["nom"];
}else{ 
	echo "Nouvelle page";
} ?>
 </legend>

<?php
/* --- Affiche les drapeaux */
$i=0;
foreach(Configure::read('Config.languages') as $lang){
	$alang = explode("_",$lang);
	$shortlang = $alang[0];
	if($i==0) echo "<div class='lang selected'>";
	else echo "<div class='lang'>";
	echo $this->Html->image('lang/'.$shortlang.'.png', array('alt'=>$shortlang))."</div>";
	$i++;
}
echo "<div class='clear'></div>";
/* ---  */

	echo $this->Form->create("Pageslibre");
	echo $this->Form->input('id');
	$i=0;
	foreach(Configure::read('Config.languages') as $lang){
		$alang = explode("_",$lang);
		$shortlang = $alang[0];
		if($i==0) echo "<div id='input_".$shortlang."'>";
		else echo "<div id='input_".$shortlang."' style='display:none'>";
		echo "<br/><label>Nom : </label><br/>";
		echo $this->Form->input("Pageslibre.nom.".$lang,array("label"=>"","size" => "50px"));
		echo "<br/><label>Contenu : </label><br/>";
		echo $this->Form->textarea('Pageslibre.contenu.'.$lang,array('class'=>'ckeditor'));
		echo "</div>";
		$i++;
	}
?>
<script type="text/javascript">
	//<![CDATA[
		CKEDITOR.replace( 'CmspageContenu' ,
		{
			extraPlugins : 'stylesheetparser',
			contentsCss : '/js/ckeditor/ckeditor.css',
			stylesSet : []
		});
	//]]>
</script>
<?php
	
	echo "<br/><label>Meta titre : </label><br/>";
	echo $this->Form->input("metatitle",array("label"=>"","size" => "50px"));
	echo "<br/><label>Meta description : </label><br/>";
	echo $this->Form->input("metadescription",array("label"=>"","size" => "50px"));
	echo $this->Form->end("Envoyer");
	echo "</div>";
	
?>
</fieldset>