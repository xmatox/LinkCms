<?php

echo "<h1>";
	echo "Menus";
echo "</h1>";

echo "<div class='ajout'>";
	echo $this->Html->link(
		"Ajouter un menu",
		array(
			'controller'=>'menugroupes', 
			'action'=>'edit'
		),
		array('escape'=>false)
	);
echo "</div>";

if(empty($groupe)){
	echo "<div class='error'>Il n'y a pas de menu .</div>";
}else{
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Configurer</li>";
		echo "<li class='tab_li_int'>Editer</li>";
		echo "<li class='tab_li_int'>Mobile</li>";
	echo "</ul>";
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
					$c['Menugroupe']['nom'],
					array(
						'controller'=>'menus', 
						'action'=>'list',
						$c["Menugroupe"]["id"]
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
					'controller'=>'menugroupes', 
					'action'=>'suprim', 
					$c["Menugroupe"]["id"]
				),
				array('escape'=>false),
				"Etes-vous sür de vouloir supprimer ce menu ?"
			);
			echo "</li>";
			echo "<li class='tab_li_img'>";
				echo $this->Html->link(
					$this->Html->image('/admin/param.png', array(
						"alt" => "Modifier"
					)),
					array(
						'controller'=>'menugroupes', 
						'action'=>'edit', 
						$c["Menugroupe"]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
			echo "<li class='tab_li_img'>";
				echo $this->Html->link(
					$this->Html->image('/admin/modif_h20.png', array(
						"alt" => "Ecrire"
					)),
					array(
						'controller'=>'menus', 
						'action'=>'list', 
						$c["Menugroupe"]["id"]
					),
					array('escape'=>false)
				);
			echo "</li>";
			echo "<li class='tab_li_img'>";
			if($c["Menugroupe"]["mobile"]==true) $checkmobile = "checked";
			else $checkmobile = "";
			echo $this->Form->radio('mobile',array($c["Menugroupe"]["id"]=>" "), 
				array(
					"label"=>"",
					"checked"=>$checkmobile,
					"onclick"=>
						"$.ajax({
						type: 'POST',
						url: '" . $this->Html->url( array( 'controller' => 'menugroupes', 'action' => 'ajax_setmobile', 'admin' => false ), true ) . "',
	                    data:{id: ".$c["Menugroupe"]["id"]." },
	                    success: function( data ) {}
		                });
		                return true;"
                ));
			echo "</li>";
			
		echo "</ul>";
	}
	echo "<ul class='tabpied'></ul>";
}



?>
