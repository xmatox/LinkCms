<?php
class ActualiteelementsController extends ActualitesAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Actualites";
	public $helpers = array('Js');
	// ADMINISTRATION
	function admin_list($idEvent=null,$id=null){
		$tablename = "Actualiteelement";
		$this->set('tablename', $tablename);

		if ($this->data) {
			if ($this->Actualiteelement->save($this->data)) {
				if(!isset($id)) $id = $this->Actualiteelement->id;
				$this->Session->setFlash(__('L\'actualité à bien été enregistrée', true));
				//$this->redirect(array('action' => 'list',$idEvent,$id));
				//$this->redirect(array('action' => 'list'));
			} else {
				$this->Session->setFlash(__('L\'actualité n\'a pas pu être enregistrée.', true));
			}
		}
		$theevent = $this->Actualiteelement->Actualite->find('first',array(
			"conditions" => array("Actualite.id"=>$idEvent),
			"recursive" => -1
		));
		$this->set('theevent', $theevent["Actualite"]["nom"]);
		$this->set('theeventid', $theevent["Actualite"]["id"]);
		$this->set('lid', $idEvent);
		$thecontent = $this->Actualiteelement->find('all',array(
				"conditions" => array("Actualiteelement.actualite_id"=>$idEvent),
				"order" => "date DESC",
				"recursive" => -1
			));
		$this->set('thecontent', $thecontent);
		if(isset($id)){
			$this->data = $this->Actualiteelement->readAll($id);
		}
	}
	
	function admin_suprim($idEvent=null,$id=null) {
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		if (!$id) {
			$this->Session->setFlash(__("Id invalide pour l\'actualité ", true));
			$this->redirect(array('action' => 'list',$idEvent));
		}
		
		if ($this->Actualiteelement->delete($id)) {
			
			$this->Session->setFlash(__("L\'actualité a bien été supprimée", true));
			$this->redirect(array('action' => 'list',$idEvent));
		}
		$this->Session->setFlash(__("L\'actualité n'a pas pu être supprimée.", true));
		$this->redirect(array('action' => 'list',$idEvent));
	}
	
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
		
	}
}
