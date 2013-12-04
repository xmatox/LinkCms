<?php
echo $this->Html->css('jquery-ui-1.8.16.custom.css');
echo "<h1>";
	echo $this->Js->link(
		$titre,
		array(
			'controller'=>'evenements',
			'action'=>'list'
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
	echo " > ".$theevent;
echo "</h1>";



if(!empty($this->Form->data[$tablename]["lieu"])){ 
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
	$nbShow = count($thecontent);
	$i=0;
	foreach($thecontent as $c){
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1'>";
		}else{
			echo "<ul class='tab2'>";
		}
			
			echo "<li style='float:left;margin-top:5px;margin-left:5px;color:#999'><i>".($nbShow-$i)." / </i></li>";
			echo "<li class='tab_li_titre'>";
				echo $this->Js->link(
					$c[$tablename]['date']." - ".$c[$tablename]['lieu'],
					array(
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
		$i++;
	}
	echo "<ul class='tabpied'></ul>";
}
?>
</div>
<div >
	<fieldset style="width:390px;margin:10px;border:1px #999 solid; background-color:#fff;">
	<legend> 
	<?php if(!empty($this->Form->data[$tablename]["lieu"])){ 
		echo $this->Form->data[$tablename]["lieu"];
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
		echo $this->Form->hidden('evenement_id',array("value"=>$theeventid));
		echo "<br/><label>Date : </label><br/>";
		echo $this->Form->input('date',array("label"=>"",'id'=>'datepicker', 'type'=>'text',"size" => "30px"));
		echo "<br/><label>Lieu : </label><br/>";
		echo $this->Form->input('lieu',array("label"=>"","size" => "30px"));
		echo "<br/><label>Informations : </label><br/>";
		echo $this->Form->input('info',array("label"=>"","size" => "30px"));
		echo "<br/><label>Lien <i>(optionnel)</i> : </label><br/>";
		echo $this->Form->input('lien',array("label"=>"","size" => "30px"));
		echo "<br/><label>Informations détaillées <i>(optionnel)</i> : </label><br/>";
		echo $this->Form->textarea('infosup',array("label"=>"","class"=>"","id"=>"infosup","size" => "30px"));
		echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	
	?>
		<script type="text/javascript">
		if(CKEDITOR.instances["infosup"]) {
			
			CKEDITOR.remove(CKEDITOR.instances["infosup"]);
		}

		CKEDITOR.replace( "infosup");

		</script>
	</fieldset>
	
</div>
<div class="clear"></div>