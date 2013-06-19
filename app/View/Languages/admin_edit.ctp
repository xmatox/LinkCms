<?php
echo "<h1>";
	echo $this->Html->link(
		"Parametres",
		array(
			'controller'=>'parametres', 
			'action'=>'list'
		),
		array('escape'=>false)
	);
echo "</h1>";
?>

<fieldset>
<legend> 
<?php 
	echo $this->Form->data["Parametre"]["nom"];
?>
 </legend>

<?php

	echo $this->Form->create("Parametre");
	echo $this->Form->input('id');
	echo $this->Form->input("nom",array("label"=>"","type" => "hidden"));
	echo "<br/><label>Valeur : </label><br/>";
	echo $this->Form->input("value",array("label"=>"","size" => "50px"));
	echo $this->Form->end("Envoyer");
	
	echo "</div>";
	
?>
</fieldset>