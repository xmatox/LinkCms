<?php	
echo $this->Html->script("/js/multiupload2/dropfile.js");
echo $this->Html->css("/js/multiupload2/style.css");
echo $this->Html->script("/htmls/js/html.js");
echo $this->Html->css("/admin/graph.css");
echo "<h1>";
	echo $this->Js->link(
		$titre,
		array(
			'action'=>'list'
		),
		array('buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</h1>";
?>

<fieldset>
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
	echo $this->Form->input('nom',array("label"=>"","size" => "50px"));


	$i=0;
	foreach(Configure::read('Config.languages') as $lang){
		$alang = explode("_",$lang);
		$shortlang = $alang[0];
		if($i==0) echo "<div id='input_".$shortlang."'>";
		else echo "<div id='input_".$shortlang."' style='display:none'>";
		echo "<br/><label>Contenu Html : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('htmlcontent".$lang."','htmlcontent".$lang2."');return false;"));
				//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->textarea($tablename.".contenuhtml.".$lang,array("label"=>"","size" => "50px","data-lang" => $lang,"class" => "htmlcontent","id" => "htmlcontent".$lang,"style" => "width:780px;height:250px"));
		
		echo "</div>";
		
		$i++;
	}
	echo "<br/><label style='width:380px;float:left'>Contenu CSS : </label>";
	echo "<label style='width:400px;float:left'>Contenu JS : </label>";
	echo "<div class='clear'></div>";
	echo $this->Form->textarea('contenucss',array("label"=>"","id"=>"csscontent","style" => "width:380px;height:250px;float:left"));
	echo $this->Form->textarea('contenujs',array("label"=>"","id"=>"jscontent","style" => "width:400px;height:250px;float:left"));
	echo "<div class='clear'></div>";


	echo $this->Js->submit(__("Sauvegarder"),array('id' => 'submitpage','update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();

	echo "<br/><label style='width:500px'>Ajouter des images sur le serveur : </label>";
	echo "";
?>

<script type="text/javascript">
if(isSimilarToPrefix($(location).attr('href'))){
			returnfolder = './img/general/boutons/';
		}else{
			returnfolder = '../../img/general/boutons/';
		}
	jQuery(function($){
		$('.dropfile').dropfile({
			message : 'Déposez vos fichiers',
			trash : true,
			select : false,
			clone : true,
			script : __prefix+'/js/multiupload/upload_admin.php',
				foldermin : '../../img/content/',
				returnfolder : returnfolder,
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
		<div class="dropfile" id="dropfile_<?php echo $i; ?>" data-value="<?php echo end($namef); ?>">
			<?php 
			echo $this->Html->image("content/".$file, array('alt' => $file,'style' =>"width:100%"));
			?>
		</div>
	<?php 
	
	} ?>
	<div class="dropfile"></div>
	
</div>
<div class="clear"></div>
<i>Faites glisser une image vers son contenu pour générer son code.</i>

<?php foreach(Configure::read('Config.languages') as $lang){ ?>
<div id="zoneparam<?php echo $lang; ?>" class="zoneparam" style="width:800px;margin-left:80px"></div>
	<div class="clear"></div>
<?php } ?>

</fieldset>