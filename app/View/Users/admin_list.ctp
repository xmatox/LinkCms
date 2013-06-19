<?php

echo "<h1>";
	echo $this->Js->link(
		"Utilisateurs",
		array(
			'controller'=>'users', 
			'action'=>'list'
		),
		array('buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</h1>";
	
	echo "<div class='ajout'>";
		echo $this->Js->link(
			"Ajouter un Utilisateur",
			array(
				'controller'=>'users', 
				'action'=>'edit',0
			),
			array('buffer'=>false,'update' => '#popup_edit_cont')
		);
	echo "</div>";
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Editer</li>";
	echo "</ul>";
	$nColor = 0;
	foreach ($users as $u){
		
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1'>";
		}else{
			echo "<ul class='tab2'>";
		}
			echo "<li class='tab_li_titre' style='width:400px'>";
				echo $this->Js->link(
					$u['User']['nom']." ".$u['User']['prenom'],
					array(
						'controller'=>'users', 
						'action'=>'edit',
						$u["User"]["id"]
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
					'controller'=>'users', 
					'action'=>'delete', 
					$u["User"]["id"]
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
						'controller'=>'users', 
						'action'=>'edit', 
						$u["User"]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
		echo "</ul>";
		
	}
	echo "<ul class='tabpied'></ul>";
	?>
	
	
	