<?php
echo "<h1>";
	echo $this->Js->link(
		"Rubriques",
		array(
			'controller'=>'rubriques', 
			'action'=>'list'
		),
		array('buffer'=>false,'update' => '#popup_edit_cont')
	);
	if($lacat['Rubrique']['parent']!=0){
		echo " > ";
		echo $this->Js->link(
			$lacat['Rubrique']['nom'],
			array(
				'controller'=>'rubriques', 
				'action'=>'list',
				$lacat["Rubrique"]["parent"]
			),
			array('buffer'=>false,'update' => '#popup_edit_cont')
		);
	}else if($lacat['Rubrique']['id']!=0){
		echo " > ".$lacat['Rubrique']['nom'];
	}
echo "</h1>";

echo "<div class='ajout'>";
	echo $this->Js->link(
		"Ajouter une Rubrique",
		array(
			'controller'=>'rubriques', 
			'action'=>'edit',
			'cat'=>$lacat["Rubrique"]["id"]
		),
		array('buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</div>";

if(empty($cat)){
	echo "<div class='error'>Il n'y a pas de rubriques dans cette rubrique.</div>";
}else{
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Configurer</li>";
	echo "</ul>";
	$nColor = 0;
	foreach($cat as $c){
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1'>";
		}else{
			echo "<ul class='tab2'>";
		}
			echo "<li class='tab_li_titre'>";
				echo $this->Js->link(
					$c['Rubrique']['nom'],
					array(
						'controller'=>'rubriques', 
						'action'=>'list',
						$c["Rubrique"]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			echo "<li class='tab_li_img'>";
			if($c["Rubrique"]["id"]!=1){
				
					echo $this->Js->link(
					$this->Html->image('/admin/suprim_h20.png', array(
						"alt" => "Supprimer"
					)),
					array(
						'controller'=>'rubriques', 
						'action'=>'suprim', 
						$c["Rubrique"]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont'),
					"Etes-vous sür de vouloir supprimer cette page ?"
				);
				
			}
			echo "</li>";
			echo "<li class='tab_li_img'>";
				echo $this->Js->link(
					$this->Html->image('/admin/param.png', array(
						"alt" => "Modifier"
					)),
					array(
						'controller'=>'rubriques', 
						'action'=>'edit', 
						$c["Rubrique"]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
		echo "</ul>";
	}
	echo "<ul class='tabpied'></ul>";
}



?>
