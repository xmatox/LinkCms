<?php
class LanguagesController extends AppController {
	public $helpers = array('Js');
	function nlg($lang=null){
		$this->Session->write('User.language',$lang);
		$this->redirect($this->referer());
		//$this->redirect($this->referer());
		exit();
	}
	function admin_edit($id=null){
		if (!empty($this->data)) {
			if ($this->Language->save($this->data)) {
				$this->Session->setFlash(__('Le Menu à bien été enregistré', true));
				$this->redirect(array('action' => 'list'));
			} else {
				$this->Session->setFlash(__('The Menu could not be saved. Please, try again.', true));
			}
		}
		if(isset($id)){
			$this->data = $this->Language->read(null, $id);
		}
		
		
	}
	function admin_list(){
		$groupe = $this->Language->find('all',array(
				"recursive" => -1
			));
		$this->set('groupe', $groupe);
		
	}
	function admin_suprim($id = null) {
		if (!$id) {
			$this->Session->setFlash(__("Id invalide dour le menu", true));
			$this->redirect($this->referer());
		}
		if ($this->Language->delete($id)) {
			$this->Session->setFlash(__("Le menu a bien été supprimé", true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__("Le menu n'a pas pu être supprimé.", true));
		$this->redirect($this->referer());
	}
	function admin_ajax_setactive($id = null){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$value=$this->params->query["value"];
			if($value==0) $data = array('active' => false,'admin' => false);
			else if($value==1) $data = array('active' => true,'admin' => true);
			else if($value==2) $data = array('active' => false,'admin' => true);
			//
			$this->Language->id=$id;
			if($this->Language->save($data)) echo json_encode($value);
			 exit();
		}
	}
}
