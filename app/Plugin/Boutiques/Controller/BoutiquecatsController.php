<?php
class BoutiquecatsController extends BoutiquesAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Boutiques";
	// ADMINISTRATION
	function admin_list($id=0){
		$tablename = "Boutiquecat";
		$this->set('tablename', $tablename);
		$this->$tablename->bindTranslation(array('nom','desccourt','desclong'));
		$thecontent = $this->$tablename->find('all',array(
				"recursive" => -1,
				"conditions" => array("Boutiquecat.boutique_id"=>$id),
			));
		$this->set('thecontent', $thecontent);
		//$this->$tablename->Boutique->bindTranslation(array('nom','desclong'));
		$theevent = $this->$tablename->Boutique->find('first',array(
			"conditions" => array("Boutique.id"=>$id),
			"recursive" => -1
		));
		$this->set('theevent', $theevent["Boutique"]["nom"]);
		$this->set('theeventid', $theevent["Boutique"]["id"]);
	}
	function admin_edit($idEvent=null,$id=null){
		$tablename = "Boutiquecat";
		$this->set('tablename', $tablename);
		if ($this->data) {
			$this->$tablename->locale = Configure::read('Config.languages');
			if ($this->$tablename->save($this->data)) {
				$this->Session->setFlash(__('La page à bien été enregistrée', true));
				$this->redirect(array('action' => 'list',$idEvent,$id));
			} else {
				$this->Session->setFlash(__('La page n\'a pas pu être enregistrée.', true));
			}
		}
		if(isset($id)){
			$this->data = $this->$tablename->readAll($id);
		}
		$theevent = $this->$tablename->Boutique->find('first',array(
			"conditions" => array("Boutique.id"=>$idEvent),
			"recursive" => -1
		));
		$this->set('theevent', $theevent["Boutique"]["nom"]);
		$this->set('theeventid', $theevent["Boutique"]["id"]);
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// Nouvelle instance de classe avec le répertoire choisi
		$path = "img/boutiques/".$idEvent."/";
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
		// Liste des fichiers dont le nom satisfait une expression régulière
		$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
		$this->set('listephotos', $jpg_files);
	}
	function admin_suprim($id = null) {
		$tablename = "Boutiquecat";
		if (!$id) {
			$this->Session->setFlash(__("Id invalide pour la page", true));
			$this->redirect($this->referer());
		}
		if ($this->$tablename->delete($id)) {
			$this->Session->setFlash(__("La page a bien été supprimée", true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__("La page n'a pas pu être supprimée.", true));
		$this->redirect($this->referer());
	}
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
		
	}
}
