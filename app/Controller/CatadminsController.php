<?php
class CatadminsController extends AppController {

	var $name = 'Catadmins';
	public $helpers = array('Js');
	function admin_getCat($id = null){
		if(isset($id)){
			$c = $this->Catadmin->find('all',array(
				"conditions" => "Catadmin.parent=$id AND Catadmin.id<>0",
				"order" => "ordre"
			));
			
		}else{
			$c = $this->Catadmin->find('all',array(
				"conditions" => "Catadmin.id<>0",
				"order" => "ordre"
			));
		}
		return $c;
	}
	
	function admin_index($id = null) {
		/*$this->Catadmin->recursive = 0;
		$this->set('catadmins', $this->paginate());*/
		if (!$id) {
			$c = $this->Catadmin->find("all", array(
				"conditions" => "Catadmin.id<>0 AND Catadmin.parent=0",
				"order" => "ordre"
			));
			$ct = $this->Catadmin->find('first',array(
				"conditions" => "Catadmin.id=0",
				"fields" => "id,nom,parent"
			));
		}else{
			$c = $this->Catadmin->find("all", array(
				"conditions" => "Catadmin.id<>0 AND Catadmin.parent=$id",
				"order" => "ordre"
			));
			$ct = $this->Catadmin->find('first',array(
				"conditions" => "Catadmin.id=$id",
				"fields" => "id,nom,parent"
			));
		}
		$this->set('catadmins', $c);
		
		
		$this->set('lacat', $ct);
	}


	function admin_edit($id = null) {
		
		if (!empty($this->data)) {
			if($id) $this->Catadmin->id=$id;
			if ($this->Catadmin->save($this->data)) {
				$this->Session->setFlash(__('La rubrique à bien été enregistrée', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The catadmin could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Catadmin->read(null, $id);
		}
			$c = $this->Catadmin->find('list',array(
					'fields' => 'id,nom',
					"conditions" => "Catadmin.parent=0",
					"order" => "id",
					'recusive' => -1
			));
		$this->set('cat', $c);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for catadmin', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Catadmin->delete($id)) {
			$this->Session->setFlash(__('Catadmin deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Catadmin was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
