<?php
class Googlemap extends AppModel{
	// liaisons
	//
	var $validate = array(
		'nom' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "le nom n'est pas valide"
		),
		'adresse' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "l'adresse est obligatoire"
		),
		'width' => array(
			'rule' => array('comparison', '>=', 0),
			'required' => true,
			'allowEmpty' => false,
			'message' => "la largeur doit être supérieur à 0"
		),
		'height' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "la hauteur doit être supérieur à 0"
		)
	);
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		//
		$pages = $this->find('first',array(
			'conditions' => array( 'id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."gm".$id."'>";
		$output .= "<script language='javascript' src='".Configure::read('Parameter.prefix')."/googlemaps/js/googlemap.js'></script>";
		$output .= '<div id="address" style="display:none">'.$pages["Googlemap"]["adresse"].'</div><div id="contenuib" style="display:none">'.$pages["Googlemap"]["contenu"].'</div><div id="map_canvas" style="width:'.$pages["Googlemap"]["width"].'px; height:'.$pages["Googlemap"]["height"].'px"></div>';
		$output .= "<div class='clear'></div></div>";
		return $output;
	}
}
?>