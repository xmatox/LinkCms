<?php
class Boutiqueproduit extends AppModel{
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'nom'=>'_nom',
			'desccourt'=>'_desccourt',
			'desclong'=>'_desclong'
		)
	);
	// liaisons
	var $belongsTo= array('Boutiquecat');
	var $validate = array(
		'nom' => array(
			'rule' => 'notEmpty',
			'required' => false,
			'allowEmpty' => false,
			'message' => "Le nom est obligatoire"
		),
		'prix' => array(
			'rule' => 'notEmpty',
			'required' => false,
			'allowEmpty' => false,
			'message' => "Le prix est obligatoire"
		)
	);
	function setlink(){
		$this->Boutiquecat->bindModel(
			array('belongsTo' => array(
					'Boutique' => array(
						'className' => 'Boutique'
					)
				)
			)
		);
	}
}
?>