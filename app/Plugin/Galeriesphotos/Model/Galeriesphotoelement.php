<?php
class Galeriesphotoelement extends AppModel{
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'contenu'=>'_contenu'
		)
	);
	// liaisons
	var $belongsTo= array('Galeriesphoto');
	var $validate = array(
		'width' => array(
			'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => false,
			'message' => "Vous devez spécifier une largeur"
		),
		'height' => array(
			'rule' => 'numeric',
			'required' => false,
			'allowEmpty' => false,
			'message' => "Vous devez spécifier une hauteur"
		)
	);
}
?>