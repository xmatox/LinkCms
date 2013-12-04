<?php

echo "<h1>";
	echo $titre;
echo "</h1>";

echo "<div class='ajout'>";
	echo $this->Js->link(
		"Ajouter",
		array(
			'actoin'=>'param'
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</div>";


if(empty($thecontent)){
	echo "<div class='error'>".$titre." est vide.</div>";
}else{
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Editer</li>";
	echo "</ul>";
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
						'controller'=>'formelements',
						'action'=>'list',
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
					'action'=>'suprim', 
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
						'action'=>'param', 
						$c[$tablename]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
		echo "</ul>";
	}
	echo "<ul class='tabpied'></ul>";
}

?>