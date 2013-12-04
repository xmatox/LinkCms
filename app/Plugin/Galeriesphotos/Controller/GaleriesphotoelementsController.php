<?php
class GaleriesphotoelementsController extends GaleriesphotosAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Galeries photos";
	public $helpers = array('Js');
	// ADMINISTRATION
	function admin_list($id=0){
		$tablename = "Galeriesphotoelement";
		$this->set('tablename', $tablename);
		$this->$tablename->bindTranslation(array('contenu'));
		$thecontent = $this->$tablename->find('all',array(
				"recursive" => -1,
				"conditions" => array("Galeriesphotoelement.galeriesphoto_id"=>$id),
			));
		$this->set('thecontent', $thecontent);

		$theevent = $this->Galeriesphotoelement->Galeriesphoto->find('first',array(
			"conditions" => array("Galeriesphoto.id"=>$id),
			"recursive" => -1
		));
		$this->set('theevent', $theevent["Galeriesphoto"]["nom"]);
		$this->set('theeventid', $theevent["Galeriesphoto"]["id"]);

		

	}
	function admin_edit($idEvent=null,$id=null){
		$tablename = "Galeriesphotoelement";
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
		$theevent = $this->Galeriesphotoelement->Galeriesphoto->find('first',array(
			"conditions" => array("Galeriesphoto.id"=>$idEvent),
			"recursive" => -1
		));
		$this->set('theevent', $theevent["Galeriesphoto"]["nom"]);
		$this->set('theeventid', $theevent["Galeriesphoto"]["id"]);
	}
	function admin_photo($idEvent=null,$id=null){
		$tablename = "Galeriesphotoelement";
		$this->set('tablename', $tablename);
		$this->set('idEv', $id);
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// Nouvelle instance de classe avec le répertoire choisi
		$path = "img/galeries/".$id."/";
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
		// Liste des fichiers dont le nom satisfait une expression régulière
		$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
		$this->set('listephotos', $jpg_files);
		// recup photo select
		$c = $this->Galeriesphotoelement->find("first", array(
				"conditions" => "Galeriesphotoelement.id=$id"
		));
		$this->set('photo', $c);
		$theevent = $this->Galeriesphotoelement->Galeriesphoto->find('first',array(
			"conditions" => array("Galeriesphoto.id"=>$idEvent),
			"recursive" => -1
		));
		$this->set('theevent', $theevent["Galeriesphoto"]["nom"]);
		$this->set('theeventid', $theevent["Galeriesphoto"]["id"]);
	}
	function admin_suprim($id = null) {
		$tablename = "Galeriesphotoelement";
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
	function ajax_getselect($id=null){
		$tablename = "Galeriesphotoelement";
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$selection = $this->request->data['selection'];
			$data = array('selection' => $selection);
			// This will update Recipe with id 10
			$this->$tablename->id=$id;
			if($this->$tablename->save($data)) echo json_encode($id);
			 exit();
		}
	}
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
		
	}
}
