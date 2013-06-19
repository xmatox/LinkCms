<?php

echo "<h1>";
	echo $titre;
echo "</h1>";
if(!empty($this->Form->data[$tablename]["nom"])){ 
echo "<div class='ajout'>";
	echo $this->Html->link(
		"Nouveau",
		array(
			'action'=>'list'
		),
		array('escape'=>false)
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
				echo $this->Html->link(
					$c[$tablename]['nom'],
					array(
						'controller'=>'galeriesphotoelements',
						'action'=>'list',
						$c[$tablename]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
			
			echo "<li class='tab_li_img'>";
				echo $this->Html->link(
				$this->Html->image('/admin/suprim_h20.png', array(
					"alt" => "Supprimer"
				)),
				array(
					'action'=>'suprim', 
					$c[$tablename]["id"]
				),
				array('escape'=>false)
			);
			echo "</li>";
			echo "<li class='tab_li_img'>";
				echo $this->Html->link(
					$this->Html->image('/admin/modif_h20.png', array(
						"alt" => "Modifier"
					)),
					array(
						'action'=>'list', 
						$c[$tablename]["id"]
					),
					array('escape'=>false)
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
	<?php if(!empty($this->Form->data[$tablename]["nom"])){ 
		echo $this->Form->data[$tablename]["nom"];
	}else{ 
		echo "Nouveau";
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
		
		echo "<br/><label>Nom : </label><br/>";
		echo $this->Form->input('nom',array("label"=>"","size" => "30px"));
		$i=0;
	foreach(Configure::read('Config.languages') as $lang){
		$alang = explode("_",$lang);
		$shortlang = $alang[0];
		if($i==0) echo "<div id='input_".$shortlang."'>";
		else echo "<div id='input_".$shortlang."' style='display:none'>";
		echo "<br/><label>Texte : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputcontenu".$lang."','inputcontenu".$lang2."',true);return false;"));
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->textarea($tablename.'.contenu.'.$lang,array('class'=>'',"id" => "inputcontenu".$lang));
		echo "</div>";
		?>
		<script type="text/javascript">
			//<![CDATA[
				CKEDITOR.replace( "inputcontenu<?php echo $lang; ?>");
			//]]>
		</script>
		<?php
		$i++;
	}
		echo $this->Form->end("Envoyer");
	
	?>
	</fieldset>
	
</div>
<div class="clear"></div>