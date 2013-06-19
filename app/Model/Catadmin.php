<?php
class Catadmin extends AppModel{
	var $name='Catadmin';
	function getCat($id = null){
		if(isset($id)){
			$c = $this->find('all',array(
				"conditions" => "Catadmin.parent=$id AND Catadmin.id<>0",
				"order" => "ordre"
			));
			
		}else{
			$c = $this->find('all',array(
				"conditions" => "Catadmin.id<>0",
				"order" => "ordre"
			));
		}
		return $c;
	}
}
?>