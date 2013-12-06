<?php
echo $this->Html->script("/js/jquery/colorpicker/js/colorpicker.js");
echo $this->Html->script("/js/jquery/colorpicker/js/eye.js");
echo $this->Html->script("/js/jquery/colorpicker/js/utils.js");
echo $this->Html->script("/js/jquery/colorpicker/js/layout.js?ver=1.0.2");
echo $this->Html->css("/js/jquery/colorpicker/css/colorpicker.css");
echo $this->Html->css("/js/jquery/colorpicker/css/layout.css");

echo "<h1>";
	echo $this->Js->link(
		"Styles",
		array(
			'controller'=>'styles', 
			'action'=>'edit'
		),
		array('escape'=>false)
	);
echo "</h1>";
?>

<fieldset>
<legend> 
Style CSS du site
 </legend>

<?php
$afontsize = array(
	"0.6em"=>"0.6em",
	"0.8em"=>"0.8em",
	"1.0em"=>"1.0em",
	"1.2em"=>"1.2em",
	"1.3em"=>"1.3em",
	"1.4em"=>"1.4em",
	"1.5em"=>"1.5em",
	"1.6em"=>"1.6em",
	"1.8em"=>"1.8em",
	"2.0em"=>"2.0em",
	"2.4em"=>"2.4em",
	"3.0em"=>"3.0em"
);
$afontfamily = array(
	"Arial"=>"Arial",
	"Verdana"=>"Verdana",
	"Helvetica"=>"Helvetica",
	"Times New Roman"=>"Times New Roman",
	"Impact"=>"Impact"
);
$aunderline = array(
	"none"=>"Pas souligné",
	"underline"=>"Souligné"
);
	
	echo $this->Form->create("Style");
	$i=0;
	foreach($param as $p){
		echo $this->Form->input($i.'.id',array("label"=>"", "type" => "hidden", "value" => $p["Style"]["id"]));
		echo "<br/><label>".$p["Style"]["nom"]." : </label>";
		if (preg_match("/color/i", $p["Style"]["style"])) {
			echo $this->Form->input($i.".value",array("label"=>"","size" => "20px","class" => "textcolor","value" => $p["Style"]["value"]));
		}else if(preg_match("/size/i", $p["Style"]["style"])){
			echo $this->Form->input($i.".value",array("label"=>"","options" => $afontsize,"default" => "12px","value" => $p["Style"]["value"]));
		}else if(preg_match("/family/i", $p["Style"]["style"])){
			echo $this->Form->input($i.".value",array("label"=>"","options" => $afontfamily,"default" => "Arial","value" => $p["Style"]["value"]));
		}else if(preg_match("/decoration/i", $p["Style"]["style"])){
			echo $this->Form->input($i.".value",array("label"=>"","options" => $aunderline,"default" => "none","value" => $p["Style"]["value"]));
		}else{
			echo $this->Form->input($i.".value",array("label"=>"","size" => "50px","value" => $p["Style"]["value"]));
		}
		$i++;
	}
	//echo $this->Form->end("Envoyer");
	echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
?>
</fieldset>