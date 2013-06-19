<?php
class StylesController extends AppController {
	public $components = array('RequestHandler');
	public $helpers = array('Js');
	function cssgeneral(){
		$c = $this->Style->liste();
		$this->set('style', $c);
	}
	function admin_edit($id=null){
		if (!empty($this->data)) {
			foreach($this->data["Style"] as $data){
				$this->Style->create();
				$d = array("value"=>$data["value"]);
				$this->Style->id = $data["id"];
				$this->Style->save($d);
				
			}
			$this->Session->setFlash(__('Le style à bien été enregistré', true));
			
		}
		if(isset($id)){
			$this->data = $this->Style->read(null, $id);
			
		}
		$param = $this->Style->find('all',array(
				"recursive" => -1
			));
		$this->set('param', $param);
		
	}
}
