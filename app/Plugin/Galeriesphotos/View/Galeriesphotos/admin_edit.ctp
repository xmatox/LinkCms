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

/* ---  */
	echo $this->Form->create($tablename);
	echo $this->Form->input('id');
	echo "<br/><label>Nom : </label><br/>";
	echo $this->Form->input('nom',array("label"=>"","size" => "50px"));
	
	echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	
?>
</fieldset>