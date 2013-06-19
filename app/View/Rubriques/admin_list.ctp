<?php
echo "<h1>";
	echo $this->Html->link(
		"Rubriques",
		array(
			'controller'=>'rubriques', 
			'action'=>'list'
		),
		array('escape'=>false)
	);
	if($lacat['Rubrique']['parent']!=0){
		echo " > ";
		echo $this->Html->link(
			$lacat['Rubrique']['nom'],
			array(
				'controller'=>'rubriques', 
				'action'=>'list',
				$lacat["Rubrique"]["parent"]
			),
			array('escape'=>false)
		);
	}else if($lacat['Rubrique']['id']!=0){
		echo " > ".$lacat['Rubrique']['nom'];
	}
echo "</h1>";

echo "<div class='ajout'>";
	echo $this->Html->link(
		"Ajouter une Rubrique",
		array(
			'controller'=>'rubriques', 
			'action'=>'edit',
			'cat'=>$lacat["Rubrique"]["id"]
		),
		array('escape'=>false)
	);
echo "</div>";

if(empty($cat)){
	echo "<div class='error'>Il n'y a pas de rubriques dans cette rubrique.</div>";
}else{
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Configurer</li>";
		echo "<li class='tab_li_int'>Voir</li>";
		echo "<li class='tab_li_int'>Editer</li>";
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
				echo $this->Html->link(
					$c['Rubrique']['nom'],
					array(
						'controller'=>'rubriques', 
						'action'=>'list',
						$c["Rubrique"]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
			echo "<li class='tab_li_img'>";
			if($c["Rubrique"]["id"]!=1){
				
					echo $this->Html->link(
					$this->Html->image('/admin/suprim_h20.png', array(
						"alt" => "Supprimer"
					)),
					array(
						'controller'=>'rubriques', 
						'action'=>'suprim', 
						$c["Rubrique"]["id"]
					),
					array('escape'=>false),
					"Etes-vous sür de vouloir supprimer cette page ?"
				);
				
			}
			echo "</li>";
			echo "<li class='tab_li_img'>";
				echo $this->Html->link(
					$this->Html->image('/admin/param.png', array(
						"alt" => "Modifier"
					)),
					array(
						'controller'=>'rubriques', 
						'action'=>'edit', 
						$c["Rubrique"]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
			if(!empty($c["Contenutype"]["table"])){
				echo "<li class='tab_li_img'>";
					echo $this->Html->link(
						$this->Html->image('/admin/voir_h20.png', array(
							"alt" => "Voir"
						)),
						array(
							'controller'=>'rubriques', 
							'action'=>'view', 
							$c["Rubrique"]["id"],
							'admin'=>false
						),
						array('escape'=>false,'target'=>"_blank")
					);
				echo "</li>";
			
				echo "<li class='tab_li_img'>";
					echo $this->Html->link(
						$this->Html->image('/admin/modif_h20.png', array(
							"alt" => "Ecrire"
						)),
						array(
							'controller'=>strtolower($c["Contenutype"]["table"]), 
							'action'=>"edit", 
							$c["Rubrique"]["contenupage_id"],
							'plugin'=>strtolower($c["Contenutype"]["table"])
						),
						array('escape'=>false)
					);
				echo "</li>";
			}
			
		echo "</ul>";
	}
	echo "<ul class='tabpied'></ul>";
}



?>
