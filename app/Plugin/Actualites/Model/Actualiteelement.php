<?php
class Actualiteelement extends AppModel{
	// liaisons
	var $belongsTo= array('Actualite');
	//
	var $validate = array(
		'titre' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "la date est obligatoire"
		),
		'date' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "le lieu est obligatoire"
		)
	);
}
?>