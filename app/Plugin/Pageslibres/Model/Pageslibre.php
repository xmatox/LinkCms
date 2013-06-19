<?php
class Pageslibre extends AppModel{
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'nom'=>'_nom',
			'contenu'=>'_contenu'
		),
		'Autocache'
	);
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$this->locale = Configure::read('Config.language');
		$this->bindTranslation(array('nom','contenu'));
		//
		$pages = $this->find('first',array(
			'conditions' => array( 'Pageslibre.id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."pl".$id."'>";
		$output .= $pages["Pageslibre"]["contenu"];
		$output .= "<div class='clear'></div></div>";
		return $output;
	}
}
?>