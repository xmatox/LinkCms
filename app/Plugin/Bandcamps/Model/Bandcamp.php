<?php
class Bandcamp extends AppModel{
	//
	var $validate = array(
		'nom' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "la date est obligatoire"
		),
		'bandid' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "le lieu est obligatoire"
		)
	);
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$pages = $this->find('first',array(
			'conditions' => array( 'Bandcamp.id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."bc".$id."'>";

		$output .= "<script language='javascript' src='".Configure::read('Parameter.prefix')."/bandcamps/js/bandcamp.js'></script>";
		$output .= "<script language='javascript' >$(document).ready(function() { recupcontent(".$pages["Bandcamp"]["bandid"]."); });</script>";
		$output .= "<div id='bccontent'></div>";
		$output .= "<div class='clear'></div>";
		
		$output .= "</div>";
		return $output;
	}
}
?>