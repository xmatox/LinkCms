<?php
class Boutiquecat extends AppModel{
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'nom'=>'_nom',
			'desccourt'=>'_desccourt',
			'desclong'=>'_desclong'
		)
	);
	// liaisons
	var $belongsTo= array('Boutique');
	var $hasMany = array('Boutiqueproduit');
	// validations
	var $validate = array(
		'nom' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "Le nom est obligatoire"
		)
	);
}
?>