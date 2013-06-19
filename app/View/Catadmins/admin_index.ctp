<?php
echo "<h1>";
	echo $this->Html->link(
		$lacat['Catadmin']['nom'],
		array(
			'controller'=>'Catadmins', 
			'action'=>'index',
			$lacat["Catadmin"]["parent"]
		),
		array('escape'=>false)
	);
echo "</h1>";
if($lacat["Catadmin"]["parent"]==0){
	echo "<div class='ajout'>";
		echo $this->Html->link(
			"Ajouter une Rubrique",
			array(
				'controller'=>'Catadmins', 
				'action'=>'edit',
				'cat:'.$lacat["Catadmin"]["id"]
			),
			array('escape'=>false)
		);
	echo "</div>";
}


if(empty($catadmins)){
	echo "<div class='error'>Il n'y a pas de rubriques dans cette rubrique.</div>";
}else{
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Editer</li>";
	echo "</ul>";
	$nColor = 0;
	foreach ($catadmins as $g){
	
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1'>";
		}else{
			echo "<ul class='tab2'>";
		}
			echo "<li class='tab_li_titre'>";
				echo $this->Html->link(
					$g['Catadmin']['nom'],
					array(
						'controller'=>'Catadmins', 
						'action'=>'index',
						$g["Catadmin"]["id"]
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
					'controller'=>'Catadmins', 
					'action'=>'delete', 
					$g["Catadmin"]["id"]
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
						'controller'=>'Catadmins', 
						'action'=>'edit', 
						$g["Catadmin"]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
			
			
		echo "</ul>";
	}
	echo "<ul class='tabpied'></ul>";
}
?>
	