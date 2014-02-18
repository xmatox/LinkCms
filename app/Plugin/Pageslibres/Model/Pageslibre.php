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
	//
	var $validate = array(
		'nom' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "le nom est obligatoire"
		),
		'contenu' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "le contenu est obligatoire"
		)
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

	// retourne infos plugin
	function getName($id=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$this->locale = Configure::read('Config.language');
		$this->bindTranslation(array('nom','contenu'));
		//
		$pages = $this->find('first',array(
			'conditions' => array( 'Pageslibre.id' => $id ),
			'recursive' => -1,
			'fields' => array("nom"),
			'autocache' => $autocache
		));
		return $pages["Pageslibre"]["nom"];
	}
	// fonction ajout d'un nouvel élément par défaut
	function savenew(){
		$this->create();
		$dat = array('nom' => "Titre", 'contenu' => "Contenu ...");
		$this->save($dat);
		$id = $this->id;
		return $id;
	}
}
?>