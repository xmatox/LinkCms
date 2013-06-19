<?php
class Evenementelement extends AppModel{
	// liaisons
	var $belongsTo= array('Evenement');
	//
	var $validate = array(
		'date' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "la date est obligatoire"
		),
		'lieu' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "le lieu est obligatoire"
		)
	);
}
?>