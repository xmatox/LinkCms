<?php
class ParametresController extends AppController {
	public $helpers = array('Js');
	function admin_edit($id=null){
		if (!empty($this->data)) {
			foreach($this->data["Parametre"] as $data){
				$this->Parametre->create();
				$d = array("value"=>$data["value"]);
				$this->Parametre->id = $data["id"];
				$this->Parametre->save($d);
				
			}
			$this->Session->setFlash(__('Le parametre à bien été enregistré', true));
			
		}
		if(isset($id)){
			$this->data = $this->Parametre->read(null, $id);
			
		}
		$param = $this->Parametre->find('all',array(
				"recursive" => -1
			));
		$this->set('param', $param);
		
		$this->loadModel('Language');
		$groupe = $this->Language->find('list',array(
				"fields" => array("prefix","nom"),
				"conditions" => array("active"=>true),
				"recursive" => -1
			));
		$this->set('groupe', $groupe);
	}
	function admin_list(){
		$groupe = $this->Parametre->find('all',array(
				"recursive" => -1
			));
		$this->set('groupe', $groupe);
		
	}
	
}
