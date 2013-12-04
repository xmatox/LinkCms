<?php	
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
			'action'=>'list',
			$theformid
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</h1>";

?>

<fieldset>
<legend> 
<?php if(!empty($this->Form->data[$tablename]["nom"])){ 
	echo "Modification ".$this->Form->data[$tablename]["nom"][Configure::read('Config.language')];
}else{ 
	echo "Nouvel élément";
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
	echo $this->Form->hidden('id');
	echo $this->Form->hidden('form_id',array("value"=>$theformid));
	echo "<br/><label>Type : </label><br/>";
	$atype = array(
		"text"=>"Champ texte",
		"textarea"=>"Champ texte multiligne",
		"radio"=>"Bouton radio",
		"checkbox"=>"Case à cocher",
		"liste"=>"Liste déroulante",
		"info"=>"Texte d'information",
		"infomulti"=>"Zone multimédia"
	);
	echo $this->Form->select('type',$atype,array("onchange"=>"changetype(this.value)"));
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
		echo $this->Form->input($tablename.".nom.".$lang,array("label"=>"","size" => "50px","id" => "inputnom".$lang));
		echo "<br/><label>Contenu : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputcontent".$lang."','inputcontent".$lang2."');return false;"));
				//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->textarea($tablename.".content.".$lang,array("label"=>"","class" =>"ftextearea" ,"style" => "height:100px","id" => "inputcontent".$lang));
		echo "</div>";
		if(!empty($this->Form->data[$tablename]["type"]) && $this->Form->data[$tablename]["type"]=="infomulti"){ 
			?>
			<script type="text/javascript">
				//<![CDATA[
					CKEDITOR.replace( "inputcontent<?php echo $lang; ?>");
				//]]>
			</script>
			<?php
		}
		$i++;
	}
	
	echo "<br/>".$this->Form->checkbox('label');
	echo " Afficher le Nom ";
	echo "<br/>".$this->Form->checkbox('obligatoire');
	echo " Obligatoire ";
	echo "<br/><br/><label>Type : </label><br/>";
	$aalignement = array(
		"H"=>"Horizontal",
		"V"=>"Vertical"
	);
	echo $this->Form->select('alignement',$aalignement);
	echo "<br/><br/><label>Largeur : </label><br/>";
	echo $this->Form->input("width",array("label"=>"","size" => "50px","default" => 50));
	echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	
?>
</fieldset>