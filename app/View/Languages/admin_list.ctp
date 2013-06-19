<?php

echo "<h1>";
	echo $this->Html->link(
		"Parametres",
		array(
			'controller'=>'parametres', 
			'action'=>'list'
		),
		array('escape'=>false)
	);
echo "</h1>";

?>


<fieldset>
<legend> Langues </legend>

<?php
	foreach($groupe as $c){
		
		echo '<div style="float:left;width:150px;"><b>'.$c["Language"]["nom"].'</b></div>';
		echo '<div style="float:left">';
		
		if($c["Language"]["admin"] && $c["Language"]["active"]) $check = 1;
		else if($c["Language"]["admin"] && !$c["Language"]["active"]) $check = 2;
		else $check = 0;
		echo $this->Form->input("lang".$c["Language"]["id"],array(
			"type" => "radio",
			"options" => array(0=>"désactivé",1=>"activé",2=>"seulement dans l'administration"),
			"value"=>$check,
			"label"=>"",
			"legend"=>"",
			"id"=>$c["Language"]["id"],
			"style"=>"margin-left:20px;margin-right:5px;",
			"onchange"=> "$.get( '" . $this->Html->url( array( 'controller' => 'languages', 'action' => 'ajax_setactive',$c["Language"]["id"] ), true ) . "',
						{ value: this.value},
                        function( data ) {
                            var obj = jQuery.parseJSON( data );
							$('#".$c["Language"]["id"]."').value(obj);
                        }
                );
                return false;"
		));

		echo '</div>';
		echo '<div class="clear"></div>';
		echo "<br/>";
	}
	
?>
</fieldset>

