<?php	
echo "<h1>";
	echo $this->Html->link(
		$titre,
		array(
			'controller'=>'galeriesphotos',
			'action'=>'list'
		),
		array('escape'=>false)
	);
	echo " > ";
	echo $this->Html->link(
		$theevent,
		array(
			'action'=>'list',
			$theeventid
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
	echo "Nouvelle galerie";
} ?>
 </legend>

<?php
/* --- Affiche les drapeaux */
$i=0;
echo "<div style='float:left'>Selection de la langue : </div>";
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
	echo $this->Form->create($tablename);
	echo $this->Form->input('id');
	echo $this->Form->hidden('galeriesphoto_id',array("value"=>$theeventid));
	echo "<br/><label>Nom : </label>";
	echo $this->Form->input("nom",array("label"=>"","size" => "50px"));
	echo "<br/><label>Largeur : </label>";
	echo $this->Form->input('width',array("label"=>"","size" => "50px"));
	echo "<br/><label>Hauteur : </label>";
	echo $this->Form->input('height',array("label"=>"","size" => "50px"));
	$i=0;
	foreach(Configure::read('Config.languages') as $lang){
		$alang = explode("_",$lang);
		$shortlang = $alang[0];
		if($i==0) echo "<div id='input_".$shortlang."'>";
		else echo "<div id='input_".$shortlang."' style='display:none'>";
		echo "<br/><label>Texte : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputcontenu".$lang."','inputcontenu".$lang2."',true);return false;"));
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->textarea($tablename.'.contenu.'.$lang,array('class'=>'',"id" => "inputcontenu".$lang));
		echo "</div>";
		?>
		<script type="text/javascript">
			//<![CDATA[
				CKEDITOR.replace( "inputcontenu<?php echo $lang; ?>");
			//]]>
		</script>
		<?php
		$i++;
	}
	
	echo $this->Form->end("Envoyer");
	echo "</div>";
	
?>
</fieldset>