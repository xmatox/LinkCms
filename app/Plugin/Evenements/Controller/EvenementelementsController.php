<?php
class EvenementelementsController extends EvenementsAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Evenements";
	public $helpers = array('Js');
	// ADMINISTRATION
	function admin_list($idEvent=null,$id=null){
		$tablename = "Evenementelement";
		$this->set('tablename', $tablename);

		if ($this->data) {
			if ($this->Evenementelement->save($this->data)) {
				if(!isset($id)) $id = $this->Evenementelement->id;
				$this->Session->setFlash(__('L\'évenement à bien été enregistrée', true));
				//$this->redirect(array('action' => 'list',$id));
				$this->redirect(array('action' => 'list',$idEvent));
			} else {
				$this->Session->setFlash(__('L\'évenement n\'a pas pu être enregistrée.', true));
			}
		}
		$theevent = $this->Evenementelement->Evenement->find('first',array(
			"conditions" => array("Evenement.id"=>$idEvent),
			"recursive" => -1
		));
		$this->set('theevent', $theevent["Evenement"]["nom"]);
		$this->set('theeventid', $theevent["Evenement"]["id"]);
		$this->set('lid', $idEvent);
		$thecontent = $this->Evenementelement->find('all',array(
				"conditions" => array("Evenementelement.evenement_id"=>$idEvent),
				"order" => "date DESC",
				"recursive" => -1
			));
		$this->set('thecontent', $thecontent);
		if(isset($id)){
			$this->data = $this->Evenementelement->readAll($id);
		}
	}
	
	function admin_suprim($idEvent=null,$id=null) {
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		if (!$id) {
			$this->Session->setFlash(__("Id invalide pour l\'évenement ", true));
			$this->redirect(array('action' => 'list',$idEvent));
		}
		
		if ($this->Evenementelement->delete($id)) {
			
			$this->Session->setFlash(__("L\'évenement a bien été supprimée", true));
			$this->redirect(array('action' => 'list',$idEvent));
		}
		$this->Session->setFlash(__("L\'évenement n'a pas pu être supprimée.", true));
		$this->redirect(array('action' => 'list',$idEvent));
	}
	
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
		
	}
}
