<?php
echo $this->Html->css('jquery-ui-1.8.16.custom.css');
echo "<h1>";
	echo $this->Js->link(
		$titre,
		array(
			'controller'=>'actualites',
			'action'=>'list'
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
	echo " > ".$theevent;
echo "</h1>";

if(!empty($this->Form->data[$tablename]["titre"])){ 
echo "<div class='ajout'>";
	echo $this->Js->link(
		"Nouveau",
		array(
			'action'=>'list',
			$theeventid
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
					$c[$tablename]['date']." - ".$c[$tablename]['titre'],
					array(
						'action'=>'list',
						$theeventid,
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
					$theeventid,
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
						$theeventid,
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
	<fieldset style="width:390px;margin:10px;border:1px #999 solid; background-color:#fff;">
	<legend> 
	<?php if(!empty($this->Form->data[$tablename]["titre"])){ 
		echo $this->Form->data[$tablename]["titre"];
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
		echo $this->Form->hidden('actualite_id',array("value"=>$theeventid));
		echo "<br/><label>Titre : </label><br/>";
		echo $this->Form->input('titre',array("label"=>"","size" => "30px"));
		echo "<br/><label>Date : </label><br/>";
		echo $this->Form->input('date',array("label"=>"",'id'=>'datepicker', 'type'=>'text',"size" => "30px"));
		echo "<br/><label>Contenu : </label><br/>";
		
		echo $this->Form->textarea('contenu',array("label"=>"","class"=>"","id" => "infosup","size" => "30px"));
		

		//echo $this->Form->end("Envoyer");
	echo $this->Js->submit(__("Sauvegarder"),array('id' => 'submitpage','update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	
	?>
		<script type="text/javascript">
		if(CKEDITOR.instances["infosup"]) {
			
			CKEDITOR.remove(CKEDITOR.instances["infosup"]);
		}

		CKEDITOR.replace( "infosup");

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
	
</div>
<div class="clear"></div>