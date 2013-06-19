<?php
class Style extends AppModel{
	function liste(){
		$style = $this->find('list',array(
			'fields' => array("style","value"),
			'recursive' => -1
		));
		return $style;
	}
}
?>