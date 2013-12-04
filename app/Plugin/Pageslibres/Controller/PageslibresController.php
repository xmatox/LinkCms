<?php
class PageslibresController extends PageslibresAppController {
	// Nom du plugin
	private $NomPlugin = "Pages libres";
	public $helpers = array('Js');
	// ADMINISTRATION
	function admin_list($id=0){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		// liste avec champ traduit
		$this->Pageslibre->bindTranslation(array('nom','contenu'));
		$lespages = $this->Pageslibre->find('all',array(
				"recursive" => -1
			));
		$this->set('lespages', $lespages);
	}
	function admin_edit($id=null){
		$this->layout = 'admin_user';
		if ($this->data) {
			$this->Pageslibre->locale = Configure::read('Config.languages');
			if ($this->Pageslibre->save($this->data)) {
				$this->Session->setFlash(__('La page à bien été enregistrée', true));
			} else {
				$this->Session->setFlash(__('La page n\'a pas pu être enregistrée. (Tous les champs sont obligatoires)', true));
			}
		}
		if(isset($id)){
			// recupérer en multilangue
			$this->data = $this->Pageslibre->readAll($id);
		}
	}
	function admin_suprim($id = null) {
		if (!$id) {
			$this->Session->setFlash(__("Id invalide pour la page", true));
		$this->redirect(array('action'=>'list'));
		}
		if ($this->Pageslibre->delete($id)) {
			$this->Session->setFlash(__("La page a bien été supprimée", true));
		$this->redirect(array('action'=>'list'));
		}
		$this->Session->setFlash(__("La page n'a pas pu être supprimée.", true));
		$this->redirect(array('action'=>'list'));
	}
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
	}
}
