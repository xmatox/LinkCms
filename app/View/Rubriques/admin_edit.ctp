<?php
echo $this->Html->script("multiupload/dropfile.js");
echo $this->Html->css("/js/multiupload/style.css");
echo "<h1>";
	echo $this->Html->link(
		"Rubriques",
		array(
			'controller'=>'rubriques', 
			'action'=>'list'
		),
		array('escape'=>false)
	);
	if(isset($this->params['named']['cat']) && $this->params['named']['cat']!=0){
		echo " > ";
		echo $this->Html->link(
			$lescats[$this->params['named']['cat']],
			array(
				'controller'=>'rubriques', 
				'action'=>'list',
				$this->params['named']['cat']
			),
			array('escape'=>false)
		);
	}else if(isset($this->Form->data["Rubrique"]["parent"]) && $this->Form->data["Rubrique"]["parent"]!=0){
		echo " > ";
		echo $this->Html->link(
			$lescats[$this->Form->data["Rubrique"]["parent"]],
			array(
				'controller'=>'rubriques', 
				'action'=>'list',
				$this->Form->data["Rubrique"]["parent"]
			),
			array('escape'=>false)
		);
	}
echo "</h1>";
?>

<fieldset>
<legend> 
<?php if(!empty($this->Form->data["Rubrique"]["nom"])){ 
	echo $this->Form->data["Rubrique"]["nom"][Configure::read('Config.language')];
}else{ 
	echo "Nouvelle rubrique";
} ?>
 </legend>

<?php
/* --- Affiche les drapeaux */
$i=0;
echo "<div style='float:left'>Selection de la langue : </div>";
foreach(Configure::read('Config.languages') as $lang){
	if($i==0) echo "<div class='lang selected'>";
	else echo "<div class='lang'>";
	echo $this->Html->image('lang/'.$lang.'.png', array('alt'=>$lang))."</div>";
	$i++;
}
echo "<div class='clear'></div>";
/* ---  */
if(isset($this->params['named']['cat'])){
	$idCat = $this->params['named']['cat'];
}else{
	$idCat = $this->Form->data["Rubrique"]["parent"];
}

	echo $this->Form->create("Rubrique");
	echo $this->Form->input('id');
	echo $this->Form->input("Rubrique.parent",array("type"=>"hidden","label"=>"","value" => $idCat));
	echo "<br/><label>Type : </label><br/>";
$typec = array("0"=>"Catégorie","1"=>"Page");
	echo $this->Form->input("Rubrique.contenutype_id",array(
		"options"=>$typec,
		"label"=>"",
		"id"=>"contenutype"
	));
	/*echo $this->Form->input("Rubrique.contenutype_id",array(
		"options"=>$typec,
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
	echo $this->Form->input("Rubrique.contenupage_id",array("options"=>$pages,"label"=>"","id"=>"contenupage"));*/
	$i=0;
	foreach(Configure::read('Config.languages') as $lang){
		if($i==0) echo "<div id='input_".$lang."'>";
		else echo "<div id='input_".$lang."' style='display:none'>";
		echo "<br/><label>Nom : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputnom".$lang."','inputnom".$lang2."');return false;"));
				//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->input("Rubrique.nom.".$lang,array("label"=>"","size" => "50px","id" => "inputnom".$lang));
		
		
		echo "<br/><label>Url : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputurl".$lang."','inputurl".$lang2."');return false;"));
				//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->input("Rubrique.url.".$lang,array("label"=>"","size" => "50px","id" => "inputurl".$lang));
		
		echo "<br/><label>Meta titre : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputmetatitle".$lang."','inputmetatitle".$lang2."');return false;"));
				//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->input("Rubrique.metatitle.".$lang,array("label"=>"","size" => "50px","id" => "inputmetatitle".$lang));
		
		
		echo "<br/><label>Meta description : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputmetadescription".$lang."','inputmetadescription".$lang2."');return false;"));
				//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->input("Rubrique.metadescription.".$lang,array("label"=>"","size" => "50px","id" => "inputmetadescription".$lang));
		
		echo "<br/><label>Meta keyword : </label>";
		foreach(Configure::read('Config.languages') as $lang2){
			if($lang!=$lang2){
				echo $this->Html->link($this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2)),'#',array('escape'=>false,'class'=>'copylang','onclick'=>"copytext('inputmetakeyword".$lang."','inputmetakeyword".$lang2."');return false;"));
				//echo "<a class='lang2' style='display:inline' href='#' onClick=''>".$this->Html->image('lang/'.$lang2.'.png', array('alt'=>$lang2))."</a>";
			}
		}
		echo "<div class='copylang'>Copier contenu : </div>";
		echo "<br/><br/>";
		echo $this->Form->input("Rubrique.metakeyword.".$lang,array("label"=>"","size" => "50px","id" => "inputmetakeyword".$lang));
		
		
		echo "</div>";
	
		$i++;
	}
	?>
	<script type="text/javascript">
		jQuery(function($){
			$('#dropfile_bnt').dropfile({
				message : 'Déposez vos fichiers',
				trash : false,
				select : false,
				clone : false,
				rename : false,
				inputmaj : $('#img_btn'),
				script : __prefix+'/js/multiupload/upload_admin.php',
				foldermin : '../../img/general/boutons/',
				heightmin : '0',
				widthmin : '0'
			});
		});
		jQuery(function($){
			$('#dropfile_bnt_actif').dropfile({
				message : 'Déposez vos fichiers',
				trash : false,
				select : false,
				clone : false,
				rename : false,
				inputmaj : $('#img_btn_actif'),
				script : __prefix+'/js/multiupload/upload_admin.php',
				foldermin : '../../img/general/boutons/',
				heightmin : '0',
				widthmin : '0'
			});
		});
	</script>
	<br/><br/>
		<div id="dropfile_content_bnt" style="margin-top:5px;float:left;width:200px;">
Image Bouton :
			<?php if(!empty($this->Form->data["Rubrique"]["img_btn"])){ 
			?>
				<div class="dropfile" id="dropfile_bnt" data-value="<?php echo $this->Form->data["Rubrique"]['img_btn']; ?>" >
					
					<?php echo $this->Html->image("general/boutons/".$this->Form->data["Rubrique"]["img_btn"], array('alt' => $this->Form->data["Rubrique"]["img_btn"],'style' => "max-height:100%;max-width:100%;"))?>
				</div>
			<?php }else{ ?>
			
				<div class="dropfile" id="dropfile_bnt"></div>
			<?php } ?>
			<div id="supprimg_bnt" class="supprimg">Supprimer l'image</div>
		</div>

		<div id="dropfile_content_bnt_actif" style="margin-top:5px;float:left;width:200px;">
Image Bouton Actif :
			<?php if(!empty($this->Form->data["Rubrique"]["img_btn_actif"])){ 
			?>
				<div class="dropfile" id="dropfile_bnt_actif" data-value="<?php echo $this->Form->data["Rubrique"]['img_btn_actif']; ?>" >
					
					<?php echo $this->Html->image("general/boutons/".$this->Form->data["Rubrique"]["img_btn_actif"], array('alt' => $this->Form->data["Rubrique"]["img_btn_actif"],'style' => "max-height:100%;max-width:100%;"))?>
				</div>
			<?php }else{ ?>
			
				<div class="dropfile" id="dropfile_bnt_actif"></div>
			<?php } ?>
			<div id="supprimg_bnt_actif" class="supprimg">Supprimer l'image</div>
		</div>

		
	

<div class="clear"></div>

<?php
echo $this->Form->input('Rubrique.img_btn', array('type' => 'hidden',"id"=>"img_btn"));
echo $this->Form->input('Rubrique.img_btn_actif', array('type' => 'hidden',"id"=>"img_btn_actif"));
	//echo $this->Form->end("Envoyer");
	echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
?>
</fieldset>