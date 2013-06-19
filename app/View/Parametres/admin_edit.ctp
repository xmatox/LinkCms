<?php

echo $this->Html->script("/js/multiupload/dropfile.js");
echo $this->Html->css("/js/multiupload/style.css");

echo "<h1>";
	echo $this->Html->link(
		"Parametres",
		array(
			'controller'=>'parametres', 
			'action'=>'edit'
		),
		array('escape'=>false)
	);
echo "</h1>";
?>

<fieldset>
<legend> 
Paramètre du site
 </legend>

<?php

	/*echo $this->Form->create("Parametre");
	echo $this->Form->input('id');
	echo $this->Form->input("nom",array("label"=>"","type" => "hidden"));
	echo "<br/><label>Valeur : </label><br/>";
	if($this->Form->data["Parametre"]["id"]==2)
		echo $this->Form->input("value",array("label"=>"","options" => $groupe));
	else
		echo $this->Form->input("value",array("label"=>"","size" => "50px"));
	echo $this->Form->end("Envoyer");
	echo "</div>";*/
	
	
	echo $this->Form->create("Parametre");
	$i=0;
	foreach($param as $p){
		echo "<br class='clear' /><label>".$p["Parametre"]["intitule"]." : </label>";
		echo $this->Form->input($i.'.id',array("label"=>"", "type" => "hidden", "value" => $p["Parametre"]["id"]));
		if($p["Parametre"]["id"]==2)
			echo $this->Form->input($i.".value",array("label"=>"","options" => $groupe,"value" => $p["Parametre"]["value"]));
		else if($p["Parametre"]["id"]==7)
		{
			$prod=array(true=>' Activer ',false=>' Desactiver ');
			echo $this->Form->radio($i.".value",$prod,array("label"=>"",'legend' => false,"id"=>"value_".$i,"value" => $p["Parametre"]["value"]));
			echo "<br/>";
		}
		else if($p["Parametre"]["id"]==6)
		{
			$prod=array(true=>' Production ',false=>' Test ');
			echo $this->Form->radio($i.".value",$prod,array("label"=>"",'legend' => false,"id"=>"value_".$i,"value" => $p["Parametre"]["value"]));
			echo "<br/>";
		}
		else if($p["Parametre"]["id"]==5)
		{
			if($p["Parametre"]["value"]) $checked = "checked";
			else $checked = "";
			echo $this->Form->checkbox($i.".value",array("label"=>"","id"=>"value_".$i,"size" => "50px","checked" => $checked,"value" => $p["Parametre"]["value"]));
			echo "<br/>";
		}
		else if($p["Parametre"]["id"]==4){
			echo $this->Form->input($i.".value",array("label"=>"","id"=>"value_".$i,"type" => "hidden","value" => $p["Parametre"]["value"]));
		?>
		<div id="dropfile_content" style="margin:auto;">
		
			<?php
			if(!empty($p["Parametre"]["value"])){
			echo '<div class="dropfile" id="dropfile1" style="margin:auto;width:auto">';
				echo $this->Html->image('general/logo/'.$p["Parametre"]["value"], array(
						"alt" => $p["Parametre"]["value"],
						"style" => "position:relative;"
					));
			}
			else
			echo '<div class="dropfile" id="dropfile1" style="margin:auto;">';
			echo '</div>';
			?>
			
		</div>
		
		<div class="clear"></div>
		<?php
		}else
			echo $this->Form->input($i.".value",array("label"=>"","id"=>"value_".$i,"size" => "50px","value" => $p["Parametre"]["value"]));
		
		$i++;
	}
	echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	//echo $this->Form->end("Envoyer");
?>
</fieldset>

<script type="text/javascript">
			jQuery(function($){
				$('#dropfile1').dropfile({
					message : 'Déposez vos fichiers',
					trash : false,
					select : false,
					clone : false,
					rename : true,
					inputmaj : $('#value_3'),
					script : '../../js/multiupload/upload.php',
					foldermin : '../../img/general/icone',
					widthmin : '0',
					heightmin : '16',
					foldermin2 : '../../img/general/logo',
					widthmin2 : '0',
					heightmin2 : '150'
				});
				
				
			});
		</script>