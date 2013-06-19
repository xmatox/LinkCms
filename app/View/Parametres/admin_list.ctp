<?php

echo "<h1>";
	echo "Parametres";
echo "</h1>";


if(empty($groupe)){
	echo "<div class='error'>Il n'y a pas de Parametre .</div>";
}else{
	$nColor = 0;
	foreach($groupe as $c){
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1'>";
		}else{
			echo "<ul class='tab2'>";
		}
			echo "<li class='tab_li_titre'>";
				echo $this->Html->link(
					$c['Parametre']['nom']." : ".$c['Parametre']['value'],
					array(
						'controller'=>'parametres', 
						'action'=>'edit',
						$c["Parametre"]["id"]
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
						'controller'=>'parametres', 
						'action'=>'edit', 
						$c["Parametre"]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
			
			
		echo "</ul>";
	}
}



?>
