<?php	
echo "<h1>";
	echo $this->Js->link(
		$titre,
		array(
			'action'=>'list'
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
	echo "Nouveau Formulaire";
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
		echo "</div>";
		$i++;
	}
	echo "<br/><label>Email d'envoi : </label><br/>";
	echo $this->Form->input('sendfrom',array("label"=>"","size" => "50px"));
	echo "<br/><label>Email de reception : </label><br/>";
	echo $this->Form->input('sendto',array("label"=>"","size" => "50px"));
	echo "<br/><label>Meta titre : </label><br/>";
	echo $this->Form->input("metatitle",array("label"=>"","size" => "50px"));
	echo "<br/><label>Meta description : </label><br/>";
	echo $this->Form->input("metadescription",array("label"=>"","size" => "50px"));
	echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	
?>
</fieldset>