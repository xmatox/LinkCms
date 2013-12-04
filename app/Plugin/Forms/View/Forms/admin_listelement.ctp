<?php

echo "<h1>";
	echo $this->Js->link(
		$titre,
		array(
			'action'=>'list'
		),
		array('buffer'=>false,'update' => '#popup_edit_cont')
	);
	echo " > ".$theform;
echo "</h1>";

echo "<div class='ajout'>";
	echo $this->Js->link(
		"Ajouter",
		array(
			'action'=>'editelement',
			$theformid
		),
		array('buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</div>";


if(empty($thecontent)){
	echo "<div class='error'>".$theform." est vide.</div>";
}else{
	$nColor = 0;
	foreach($thecontent as $c){
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1'>";
		}else{
			echo "<ul class='tab2'>";
		}
			echo "<li class='tab_li_titre'>";
				echo $this->Js->link(
					$c[$tablename]['nom'],
					array(
						'action'=>'editelement',
						$c[$tablename]["form_id"],
						$c[$tablename]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
			echo "<li class='tab_li_img'>";
				echo $this->Js->link(
				$this->Html->image('/admin/suprim_h20.png', array(
					"alt" => "Supprimer"
				)),
				array(
					'action'=>'suprimelement', 
					$c[$tablename]["id"]
				),
				array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
			);
			echo "</li>";
			echo "<li class='tab_li_img'>";
				echo $this->Js->link(
					$this->Html->image('/admin/modif_h20.png', array(
						"alt" => "Modifier"
					)),
					array(
						'action'=>'editelement', 
						$c[$tablename]["form_id"],
						$c[$tablename]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
		echo "</ul>";
	}
}

?>