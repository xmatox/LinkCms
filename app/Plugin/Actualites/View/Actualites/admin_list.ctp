<?php

echo "<h1>";
	echo $titre;
echo "</h1>";
if(!empty($this->Form->data[$tablename]["nom"])){ 
echo "<div class='ajout'>";
	echo $this->Js->link(
		"Nouveau",
		array(
			'action'=>'list'
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</div>";
}

?>
<div style="margin-left:20px;margin-top:20px;">
<?php
if(empty($thecontent)){
	echo "<div class='error'>".$titre." est vide.</div>";
}else{
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Editer</li>";
	echo "</ul>";
	$nColor = 0;
	foreach($thecontent as $c){
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1'>";
		}else{
			echo "<ul class='tab2'>";
		}
			
			echo "<li class='tab_li_titre'>";
				echo $this->Js->link(
					$c[$tablename]['nom'],
					array(
						'controller'=>'actualiteelements',
						'action'=>'list',
						$c[$tablename]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
			echo "<li class='tab_li_img'>";
				echo $this->Js->link(
				$this->Html->image('/admin/suprim_h20.png', array(
					"alt" => "Supprimer"
				)),
				array(
					'action'=>'suprim', 
					$c[$tablename]["id"]
				),
				array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
			);
			echo "</li>";
			echo "<li class='tab_li_img'>";
				echo $this->Js->link(
					$this->Html->image('/admin/modif_h20.png', array(
						"alt" => "Modifier"
					)),
					array(
						'action'=>'list', 
						$c[$tablename]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
		echo "</ul>";
	}
	echo "<ul class='tabpied'></ul>";
}
?>
</div>
<div >
	<fieldset style="width:290px;margin:10px;border:1px #999 solid; background-color:#fff;">
	<legend> 
	<?php if(!empty($this->Form->data[$tablename]["nom"])){ 
		echo $this->Form->data[$tablename]["nom"];
	}else{ 
		echo "Nouveau";
	} ?>
	 </legend>
	 <script>
	$(function() {
	       $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
	});
	</script>
	<?php
		echo $this->Form->create($tablename);
		echo $this->Form->input('id');
		
		echo "<br/><label>Nom : </label><br/>";
		echo $this->Form->input('nom',array("label"=>"","size" => "30px"));
		
		//echo $this->Form->end("Envoyer");
	echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	?>
	</fieldset>
	
</div>
<div class="clear"></div>