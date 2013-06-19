<?php
class ContenutypesController extends AppController {
	public $helpers = array('Js');
	
	function admin_list(){
		$c = $this->Contenutype->find('all',array(
				"conditions" => "id<>0",
				"recursive" => -1
			));
		$this->set('cat', $c);
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// Nouvelle instance de classe avec le répertoire choisi
		$path = "../Plugin";
		$dir = new Folder($path);
		// Liste des fichiers dont le nom satisfait une expression régulière
		$listeplugin = $dir->read();
		$this->set('listeplugin', $listeplugin);
	}
	function admin_suprim($id = null) {
		if (!$id) {
			$this->Session->setFlash(__("Id invalide dour l'évènement", true));
			$this->redirect($this->referer());
		}
		if ($this->Rubrique->delete($id)) {
			$this->Session->setFlash(__("La rubrique a bien été supprimé", true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__("La rubrique n'a pas pu être supprimé.", true));
		$this->redirect($this->referer());
	}
}
