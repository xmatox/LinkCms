<?php
echo $this->Html->script("/boutiques/js/dropfile.js");
echo $this->Html->css("/boutiques/js/style.css");
echo "<h1>";
	echo $this->Html->link(
		$titre,
		array(
			'controller'=>'boutiques',
			'action'=>'list'
		),
		array('escape'=>false)
	);
	echo " > ";
	echo $this->Html->link(
		$thebout,
		array(
			'controller'=>'boutiquecats',
			'action'=>'list',
			$theboutid
		),
		array('escape'=>false)
	);
	echo " > ";
	echo $this->Html->link(
		$theevent,
		array(
			'action'=>'list',
			$theeventid
		),
		array('escape'=>false)
	);
	echo " > ".$photo[$tablename]['nom'];
echo "</h1>";
?>

<fieldset>



<?php 
if($photo){
	if (!empty($photo[$tablename]['photo'])) {
		$select_name = $photo[$tablename]['photo'];
		$select_location = $this->Html->image("boutiques/".$theboutid."/".$theeventid."/".$idEv."/".$photo[$tablename]['photo'], array('alt' => $photo[$tablename]['photo']));
	}else{
		$select_name = "";
		$select_location = "";
	}
	//
	
	
}else{
	$select_name = "";
	$select_location = "";
}
echo $this->Form->create($tablename,array(
	'controller'=>$tablename,
	"id"=>"formPhoto",
	"action"=>"select",
	"admin"=>true,
	$idEv
));
echo $this->Form->input('id', array('type' => 'hidden',"value" => $idEv));
echo $this->Form->input('selection', array('type' => 'hidden',"id"=>"input_name","value" => $select_name));
echo $this->Form->input('input_location', array('type' => 'hidden',"id"=>"input_location","value" => $select_location));
echo $this->Form->input("evenement_id",array('type' => 'hidden',"label"=>"","value" => $idEv));
echo "</form>";


?>
	
	
<script type="text/javascript">
	jQuery(function($){
		$('.dropfile').dropfile({
			message : 'Déposez vos fichiers',
			trash : true,
			select : true,
			clone : true,
			script : '../../../../../js/multiupload2/upload2.php',
			foldermin : '../../img/boutiques/<?php echo $theboutid; ?>/<?php echo $theeventid; ?>/<?php echo $idEv; ?>',
			heightmin : '400',
			widthmin : '400'
		});
		
		
	});
</script>


<div id="dropfile_content" style="margin-top:30px;">

	<?php 
	$i=0;
	foreach($listephotos as $file){
		$namef = explode("/",$file);
		$i++;
	?>
		<div class="dropfile" id="dropfile_<?php echo $i; ?>" data-value="<?php echo end($namef); ?>" >
			
			<?php echo $this->Html->image("boutiques/".$theboutid."/".$theeventid."/".$idEv."/".$file, array('alt' => $file,'style' => "width:100%;height:100%;"))?>
		</div>
	<?php } ?>
	<div class="clear"></div>
	<div class="dropfile"></div>
	
</div>


</fieldset>