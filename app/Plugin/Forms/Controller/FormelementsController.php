<?php
class FormelementsController extends FormsAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Forms";
	public $helpers = array('Js');
	// ADMINISTRATION
	function admin_list($idForm=null){
		$tablename = "Formelement";
		$this->set('tablename', $tablename);
		$theform = $this->Formelement->Form->find('first',array(
			"conditions" => array("Form.id"=>$idForm),
			"recursive" => -1
		));
		$this->set('theform', $theform["Form"]["nom"]);
		$this->set('theformid', $theform["Form"]["id"]);
		$this->Formelement->bindTranslation(array('nom','content'));
		$thecontent = $this->Formelement->find('all',array(
			"conditions" => array("Formelement.form_id"=>$idForm),
			"order" => "Formelement.position",
			"recursive" => -1
		));
		$this->set('thecontent', $thecontent);
		
	}
	function admin_edit($idForm=null,$id=null){
		$tablename = "Formelement";
		$this->set('tablename', $tablename);
		$theform = $this->Formelement->Form->find('first',array(
			"conditions" => array("Form.id"=>$idForm),
			"recursive" => -1
		));
		$this->set('theform', $theform["Form"]["nom"]);
		$this->set('theformid', $theform["Form"]["id"]);
		if ($this->data) {
			$this->Formelement->locale = Configure::read('Config.languages');
			if ($this->Formelement->save($this->data)) {
				$this->Session->setFlash(__('La page à bien été enregistrée', true));
				$this->redirect(array('action' => 'list',$idForm));
			} else {
				$this->Session->setFlash(__('La page n\'a pas pu être enregistrée.', true));
			}
		}
		if(isset($id)){
			$this->data = $this->Formelement->readAll($id);
		}
	}
	function admin_suprim($id = null) {
		if (!$id) {
			$this->Session->setFlash(__("Id invalide pour la page", true));
			$this->redirect($this->referer());
		}
		if ($this->Formelement->delete($id)) {
			$this->Session->setFlash(__("La page a bien été supprimée", true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__("La page n'a pas pu être supprimée.", true));
		$this->redirect($this->referer());
	}
	function ajax_setposition(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$position = $this->request->data['position'];
			$data = array('position' => $position);
			// This will update Recipe with id 10
			$this->Formelement->id=$id;
			if($this->Formelement->save($data)) echo json_encode($id);
			 exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
		
	}
}
