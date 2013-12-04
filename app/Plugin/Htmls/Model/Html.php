<?php
class Html extends AppModel{
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'contenuhtml'=>'_contenuhtml'
		),
		'Autocache'
	);
	//
	var $validate = array(
		'nom' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "le nom n'est pas valide"
		)
	);
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		//
		$this->locale = Configure::read('Config.language');
		$this->bindTranslation(array('contenuhtml'));
		$pages = $this->find('first',array(
			'conditions' => array( 'Html.id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."ht".$id."'>";
		$output .= "<style type='text/css'>".$pages["Html"]["contenucss"]."</style>";
		$output .= $pages["Html"]["contenuhtml"];
		$output .= "<script language='javascript'>".$pages["Html"]["contenujs"]."</script>";
		$output .= "<div class='clear'></div></div>";
		return $output;
	}
	// fonction ajout d'un nouvel élément par défaut
	function savenew(){
		$this->create();
		$dat = array('nom' => "Titre",'contenuhtml' => "Contenu");
		$this->save($dat);
		$id = $this->id;
		return $id;
	}
}
?>