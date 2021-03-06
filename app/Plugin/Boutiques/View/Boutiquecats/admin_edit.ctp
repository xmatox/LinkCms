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
		$theevent,
		array(
			'action'=>'list',
			$theeventid
		),
		array('escape'=>false)
	);
echo "</h1>";

?>

<fieldset>
<legend> 
<?php if(empty($this->Form->data[$tablename]["nom"])){ 
	echo "Nouvelle catégorie";
}
?>
 </legend>
Photo :
	<script type="text/javascript">
		jQuery(function($){
			$('.dropfile').dropfile({
				message : 'Déposez vos fichiers',
				trash : false,
				select : false,
				clone : false,
				inputmaj : $('#input_photo'),
				script : '../../../../../js/multiupload2/upload2.php',
				foldermin : '../../img/boutiques/<?php echo $theeventid; ?>',
				heightmin : '200',
				widthmin : '200'
			});
			
			
		});
	</script>
	<div id="dropfile_content" style="margin-top:30px;">

		<?php if(!empty($this->Form->data[$tablename]["photo"])){ 
		?>
			<div class="dropfile" id="dropfile_img" data-value="<?php echo $this->Form->data[$tablename]['photo']; ?>" >
				
				<?php echo $this->Html->image("boutiques/".$theeventid."/".$this->Form->data[$tablename]["photo"], array('alt' => $this->Form->data[$tablename]["photo"],'style' => "height:100%;width:100%;"))?>
			</div>
		<?php }else{ ?>
		
		<div class="dropfile"></div>
		<?php } ?>
	</div>
<div class="clear"></div>
<br/>
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
	echo $this->Form->hidden('boutique_id',array("value"=>$theeventid));
	echo $this->Form->input('photo', array('type' => 'hidden',"id"=>"input_photo"));
	$i=0;
		foreach(Configure::read('Config.languages') as $lang){
			$alang = explode("_",$lang);
			$shortlang = $alang[0];
			if($i==0) echo "<div id='input_".$shortlang."'>";
			else echo "<div id='input_".$shortlang."' style='display:none'>";
			echo "<br/><label>Nom : </label>";
			foreach(Configure::read('Config.languages') as $lang2){
				if($lang!=$lang2){
					echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputnom".$lang."','inputnom".$lang2."');return false;"));
					//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
				}
			}
			echo "<div class='copylang'>Copier contenu : </div>";
			echo "<br/><br/>";
			echo $this->Form->input($tablename.".nom.".$lang,array("label"=>"","size" => "50px","id" => "inputnom".$lang));
			echo "<br/><label>Description courte : </label>";
			foreach(Configure::read('Config.languages') as $lang2){
				if($lang!=$lang2){
					echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputcontenu".$lang."','inputcontenu".$lang2."',true);return false;"));
				}
			}
			echo "<div class='copylang'>Copier contenu : </div>";
			echo "<br/><br/>";
			echo $this->Form->textarea($tablename.'.desccourt.'.$lang,array('class'=>'',"id" => "inputcontenu".$lang));
			echo "<br/><label>Description longue : </label>";
			foreach(Configure::read('Config.languages') as $lang2){
				if($lang!=$lang2){
					echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputcontenu2".$lang."','inputcontenu2".$lang2."',true);return false;"));
				}
			}
			echo "<div class='copylang'>Copier contenu : </div>";
			echo "<br/><br/>";
			echo $this->Form->textarea($tablename.'.desclong.'.$lang,array('class'=>'',"id" => "inputcontenu2".$lang));
			echo "</div>";
			?>
			<script type="text/javascript">
				//<![CDATA[
					CKEDITOR.replace( "inputcontenu<?php echo $lang; ?>");
					CKEDITOR.replace( "inputcontenu2<?php echo $lang; ?>");
				//]]>
			</script>
			<?php
			$i++;
		}
	
	echo $this->Form->end("Envoyer");
	echo "</div>";
	
?>
</fieldset>