<?php
echo "<h1>";
	echo $this->Html->link(
		"Rubriques",
		array(
			'controller'=>'rubriques', 
			'action'=>'list'
		),
		array('escape'=>false)
	);
echo "</h1>";
?>

<fieldset>
<legend> 
<?php if(!empty($this->Form->data["Rubrique"]["nom"])){ 
	echo $this->Form->data["Rubrique"]["nom"];
}else{ 
	echo "Nouvelle rubrique";
} ?>
 </legend>

<?php
if(isset($this->params['named']['cat'])){
	$idCat = $this->params['named']['cat'];
}else{
	$idCat = $this->Form->data["Rubrique"]["parent"];
}

	echo $this->Form->create("Rubrique");
	echo $this->Form->input('id');
	echo "<br/><label>Rubrique parente : </label><br/>";
	echo $this->Form->input("Rubrique.parent",array("options"=>$lescats,"label"=>"","value" => $idCat));
	echo "<br/><label>Type : </label><br/>";
	echo $this->Form->input("Rubrique.contenutype_id",array(
		"options"=>$type,
		"label"=>"",
		"id"=>"contenutype",
		"onchange"=> "
                $.get( '" . $this->Html->url( array( 'controller' => 'rubriques', 'action' => 'ajax_getpages' ), true ) . "',
                        { id: $( '#contenutype' ).val() },
                        function( data ) {
                            var obj = jQuery.parseJSON( data );
							$('#contenupage').empty();
							 $.each(obj, function(index, value) {
								$('#contenupage').append('<option value=\"'+ index +'\">'+ value +'</option>');
							});
                        }
                );
                return false;"
	));
	echo "<br/><label>Page : </label><br/>";
	echo $this->Form->input("Rubrique.contenupage_id",array("options"=>$pages,"label"=>"","id"=>"contenupage"));
	echo "<br/><label>Nom : </label><br/>";
	echo $this->Form->input("Rubrique.nom",array("label"=>"","size" => "50px"));
	echo "<br/><label>Description : </label><br/>";
	echo $this->Form->input("Rubrique.description",array("label"=>"","size" => "50px"));
	echo $this->Form->end("Envoyer");
	echo "</div>";
	
?>
</fieldset>