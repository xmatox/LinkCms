<?php

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
		$thebout,
		array(
			'controller'=>'boutiquecats',
			'action'=>'list',
			$theboutid
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

echo "<div class='ajout'>";
	echo $this->Html->link(
		"Ajouter",
		array(
			'action'=>'edit',
			$theeventid,
			0
		),
		array('escape'=>false)
	);
echo "</div>";


if(empty($thecontent)){
	echo "<div class='error'>Il n'y a pas de galerie.</div>";
}else{
echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Editer</li>";
		echo "<li class='tab_li_int'>Photos</li>";
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
				echo $this->Html->link(
					$c[$tablename]['nom'],
					array(
						'action'=>'edit',
						$theeventid,
						$c[$tablename]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
			
			echo "<li class='tab_li_img'>";
				echo $this->Html->link(
				$this->Html->image('/admin/suprim_h20.png', array(
					"alt" => "Supprimer"
				)),
				array(
					'action'=>'suprim', 
					$c[$tablename]["id"]
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
						'action'=>'edit', 
						$theeventid,
						$c[$tablename]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
		
			echo "<li class='tab_li_img'>";
				echo $this->Html->link(
				$this->Html->image('/admin/photo.png', array(
					"alt" => "Photo",
					"height" => "20px"
				)),
				array(
					'action'=>'photo', 
						$theeventid,
					$c[$tablename]["id"]
				),
				array('escape'=>false)
			);
			echo "</li>";
			
		echo "</ul>";
	}
	echo "<ul class='tabpied'></ul>";
}



?>
