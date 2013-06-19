<?php
echo "<h1>";
	echo $this->Html->link(
		"Menus",
		array(
			'controller'=>'menugroupes', 
			'action'=>'list'
		),
		array('escape'=>false)
	);
echo "</h1>";
?>

<fieldset>
<legend> 
<?php if(!empty($this->Form->data["Menugroupe"]["nom"])){ 
	echo $this->Form->data["Menugroupe"]["nom"];
}else{ 
	echo "Nouveau menu";
} ?>
 </legend>

<?php

	echo $this->Form->create("Menugroupe");
	echo $this->Form->input('id');
	echo "<br/><label>Nom : </label><br/>";
	echo $this->Form->input("nom",array("label"=>"","size" => "50px"));
	echo $this->Form->input("graphelement_id",array("label"=>"","type" => "hidden"));
	//echo $this->Form->end("Envoyer");
	echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	echo "</div>";
	
?>
</fieldset>