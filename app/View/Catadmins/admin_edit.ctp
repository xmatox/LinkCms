
<?php
echo "<h1>";
	if(!empty($this->Form->data["Catadmin"]["nom"])){
		echo $this->Html->link(
			 $this->Form->data["Catadmin"]["nom"],
			array(
				'controller'=>'catadmin', 
				'action'=>'list',
				 $this->Form->data["Catadmin"]["parent"]
			),
			array('escape'=>false)
		);
	}else{
		echo "Nouvelle catégorie";
	}
echo "</h1>";
?>

<fieldset>
<legend> Création menu </legend>


<?php
if(!empty($this->params['named']['cat'])){
	$idCat = $this->params['named']['cat'];
}else{
	$idCat = 0;
}

	echo $this->Form->create("Catadmin",array("action"=>"edit","admin"=>true));
	echo "<br/><label>Nom  : </label><br/>";
	echo $this->Form->input("Catadmin.nom",array("label"=>"","size" => "50px"));
	echo "<br/><label>Controller  : </label><br/>";
	echo $this->Form->input("Catadmin.controller",array("label"=>"","size" => "50px"));
	echo "<br/><label>Action  : </label><br/>";
	echo $this->Form->input("Catadmin.action",array("label"=>"","size" => "50px"));
	echo "<br/><label>Catégorie  : </label><br/>";
	echo $this->Form->input("Catadmin.parent",array("options"=>$cat,"label"=>"","value" => $idCat));
	echo "<br/><label>Ordre  : </label><br/>";
	echo $this->Form->input("Catadmin.ordre",array("label"=>"","size" => "50px"));
	echo $this->Form->end("Envoyer");
	echo "</div>";
	
	
?>
</fieldset>