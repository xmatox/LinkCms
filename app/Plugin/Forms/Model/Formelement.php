<?php
class Formelement extends AppModel{
	// liaisons
	var $belongsTo= array('Form');
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'nom'=>'_nom',
			'content'=>'_content'
		)
	);
}
?>