<?php
echo $this->Html->css("/admin/graph.css");
echo "<h1>";
	echo $this->Js->link(
		$titre,
		array(
			'controller'=>'forms',
			'action'=>'list'
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
	echo " > ".$theform;
echo "</h1>";
echo $this->Js->link(
		"",
		array(
			'controller'=>'forms',
			'action'=>'editcss',
			$theformid
		),
		array('escape'=>false,'id'=>"zp_css",'style'=>"display: block;float:none")
	);
echo "<div class='ajout'>";
	echo $this->Js->link(
		"Ajouter un élément",
		array(
			'action'=>'edit',
			$theformid
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</div>";


if(empty($thecontent)){
	echo "<div class='error'>".$theform." est vide.</div>";
}else{
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Editer</li>";
	echo "</ul>";
	$nColor = 0;
	echo "<div id='position' data-value='/forms/formelements/ajax_setposition/'>";
	foreach($thecontent as $c){
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1' id='".$c[$tablename]["id"]."'>";
		}else{
			echo "<ul class='tab2' id='".$c[$tablename]["id"]."'>";
		}
			echo "<li class='tab_li_titre'>";
				echo $this->Js->link(
					$c[$tablename]['nom'],
					array(
						'action'=>'edit',
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
						'action'=>'edit', 
						$c[$tablename]["form_id"],
						$c[$tablename]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
		echo "</ul>";
	}
	
	echo "</div>";
	echo "<ul class='tabpied'></ul>";
}

?>