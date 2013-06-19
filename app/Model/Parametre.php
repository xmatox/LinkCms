<?php
class Parametre extends AppModel{
	function liste(){
		$parametre = $this->find('list',array(
			'fields' => array("nom","value"),
			'recursive' => -1
		));
		return $parametre;
	}
}
?>