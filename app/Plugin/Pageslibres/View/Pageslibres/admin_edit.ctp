<?php	
echo "<h1>";
	echo $this->Js->link(
		$titre,
		array(
			'action'=>'list'
		),
		array('buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</h1>";
?>

<fieldset>
<legend> 
<?php if(!empty($this->Form->data["Pageslibre"]["nom"])){ 
	echo "Modification ".$this->Form->data["Pageslibre"]["nom"][Configure::read('Config.language')];
}else{ 
	echo "Nouvelle page";
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

	echo $this->Form->create("Pageslibre");
	echo $this->Form->input('id');
	$i=0;
	foreach(Configure::read('Config.languages') as $lang){
		$alang = explode("_",$lang);
		$shortlang = $alang[0];
		if($i==0) echo "<div id='input_".$shortlang."'>";
		else echo "<div id='input_".$shortlang."' style='display:none'>";
		echo "<br/><label>Nom : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputnom".$lang."','inputnom".$lang2."');return false;"));
				//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->input("Pageslibre.nom.".$lang,array("label"=>"","size" => "50px","id" => "inputnom".$lang));
		echo "<br/><label>Contenu : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputcontenu".$lang."','inputcontenu".$lang2."',true);return false;"));
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->textarea('Pageslibre.contenu.'.$lang,array('class'=>'',"id" => "inputcontenu".$lang));
		echo "</div>";
		
		?>
		<script type="text/javascript">
		if(CKEDITOR.instances["inputcontenu<?php echo $lang; ?>"]) {
			
			CKEDITOR.remove(CKEDITOR.instances["inputcontenu<?php echo $lang; ?>"]);
		}

		CKEDITOR.replace( "inputcontenu<?php echo $lang; ?>");

		</script>
		<?php
		$i++;
	}
	echo $this->Js->submit(__("Sauvegarder"),array('id' => 'submitpage','update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	echo "</div>";
	
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#submitpage").hover(function(){
		updateElementCK();
	});
	
});
function updateElementCK(){
	for ( instance in CKEDITOR.instances ){
		CKEDITOR.instances[instance].updateElement();
	}
}
</script>
</fieldset>