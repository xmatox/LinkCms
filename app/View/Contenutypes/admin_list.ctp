<?php

echo "<h1>";
	echo $this->Js->link(
		"Plugins",
		array(
			'controller'=>'contenutypes', 
			'action'=>'list'
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</h1>";
echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
	echo "</ul>";
if(empty($cat)){
	echo "<div class='error'>Il n'y a pas de plugin.</div>";
}else{
	
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
					$c['Contenutype']['nom'],
					array(
						'controller'=>strtolower($c['Contenutype']['table']), 
						'action'=>'list',
						'plugin'=>strtolower($c['Contenutype']['table'])
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
					'controller'=>strtolower($c['Contenutype']['table']), 
					'action'=>'delete',
					'plugin'=>strtolower($c['Contenutype']['table'])
				),
				array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
			);
			echo "</li>";
			
			
			
		echo "</ul>";
	}

}
$notexist = array();
foreach($listeplugin[0] as $lp){
	foreach($cat as $c){
		$exist = false;
		if ($c['Contenutype']['table']==$lp) {
			$exist = true;
			break;
		}
	}
	if(!$exist) array_push($notexist,$lp);
}
foreach($notexist as $lp){

			echo "<ul class='tab1' style='background-color:#C9C9C9'>";
		
			echo "<li class='tab_li_titre'>";
				echo $this->Js->link(
					$lp,
					array(
						'controller'=>strtolower($lp), 
						'action'=>'install',
						'plugin'=>strtolower($lp),
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
			echo "<li class='tab_li_img'>";
				echo $this->Js->link(
					$this->Html->image('/admin/add.png', array(
						"alt" => "Installer"
					)),
					array(
						'controller'=>strtolower($lp), 
						'action'=>'install',
						'plugin'=>strtolower($lp),
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
			
		echo "</ul>";
		
}
echo "<ul class='tabpied'></ul>";
?>
