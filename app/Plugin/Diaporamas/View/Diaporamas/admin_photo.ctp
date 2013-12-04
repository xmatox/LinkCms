<?php
echo $this->Html->script("/js/multiupload2/dropfile.js");
echo $this->Html->css("/js/multiupload2/style.css");
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
<?php
echo "Photos ";
if($photo) echo $photo[$tablename]['nom'];
?>
 </legend>


<?php 
if($photo){
	$select_name = $photo[$tablename]['selection'];
	$select_location = $this->Html->image("diaporamas/".$idEv."/".$photo[$tablename]['selection'], array('alt' => $photo[$tablename]['selection']));
	//
	if($photo[$tablename]['height']<$photo[$tablename]['width']){
		$minheight = $photo[$tablename]['height']*150/$photo[$tablename]['width'];
		$minwidth = 150;
	}else{
		$minwidth = $photo[$tablename]['width']*150/$photo[$tablename]['height'];
		$minheight = 150;
	}
	
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
			select : false,
			clone : true,
			script : '../../../../js/multiupload2/upload.php',
			foldermin : '../../img/diaporamas/<?php echo $idEv; ?>',
			heightmin : '<?php echo $photo[$tablename]['height']; ?>',
			widthmin : '<?php echo $photo[$tablename]['width']; ?>'
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
		<div class="dropfile" id="dropfile_<?php echo $i; ?>" data-value="<?php echo end($namef); ?>" style="width:<?php echo $minwidth; ?>px;height:<?php echo $minheight; ?>px;">
			
			<?php echo $this->Html->image("diaporamas/".$idEv."/".$file, array('alt' => $file,'style' => "width:".$minwidth."px;height:".$minheight."px;"))?>
		</div>
	<?php } ?>
	<div class="clear"></div>
	<div class="dropfile"></div>
	
</div>


</fieldset>