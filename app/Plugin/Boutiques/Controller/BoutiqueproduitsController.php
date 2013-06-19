<?php
class BoutiqueproduitsController extends BoutiquesAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Boutiques";
	// ADMINISTRATION
	function admin_list($id=0){
		$tablename = "Boutiqueproduit";
		$this->set('tablename', $tablename);
		$this->$tablename->bindTranslation(array('nom','desccourt','desclong'));
		$thecontent = $this->$tablename->find('all',array(
				"recursive" => -1,
				"conditions" => array("Boutiqueproduit.boutiquecat_id"=>$id),
			));
		$this->set('thecontent', $thecontent);
		$this->$tablename->setlink();
		$theevent = $this->$tablename->Boutiquecat->find('first',array(
			"conditions" => array("Boutiquecat.id"=>$id),
			"contain" => array("Boutique.id","Boutique.nom")
		));
		$this->set('theevent', $theevent["Boutiquecat"]["nom"]);
		$this->set('theeventid', $theevent["Boutiquecat"]["id"]);
		$this->set('thebout', $theevent["Boutique"]["nom"]);
		$this->set('theboutid', $theevent["Boutique"]["id"]);
		

	}
	function admin_edit($idEvent=null,$id=0){
		$tablename = "Boutiqueproduit";
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
		if(isset($id) && $id!=0){
			$this->data = $this->$tablename->readAll($id);
		}
		$this->$tablename->setlink();
		$theevent = $this->$tablename->Boutiquecat->find('first',array(
			"conditions" => array("Boutiquecat.id"=>$idEvent),
			"contain" => array("Boutique.id","Boutique.nom")
		));
		$this->set('theevent', $theevent["Boutiquecat"]["nom"]);
		$this->set('theeventid', $theevent["Boutiquecat"]["id"]);
		$this->set('thebout', $theevent["Boutique"]["nom"]);
		$this->set('theboutid', $theevent["Boutique"]["id"]);

	}
	function admin_photo($idEvent=null,$id=null){
		$tablename = "Boutiqueproduit";
		$this->set('tablename', $tablename);
		$this->set('idEv', $id);
		
		$this->$tablename->setlink();
		$theevent = $this->$tablename->Boutiquecat->find('first',array(
			"conditions" => array("Boutiquecat.id"=>$idEvent),
			"contain" => array("Boutique.id","Boutique.nom")
		));
		$this->set('theevent', $theevent["Boutiquecat"]["nom"]);
		$this->set('theeventid', $theevent["Boutiquecat"]["id"]);
		$this->set('thebout', $theevent["Boutique"]["nom"]);
		$this->set('theboutid', $theevent["Boutique"]["id"]);
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// Nouvelle instance de classe avec le répertoire choisi
		$path = "img/boutiques/".$theevent["Boutique"]["id"]."/".$idEvent."/";
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
		$path = "img/boutiques/".$theevent["Boutique"]["id"]."/".$idEvent."/".$id."/";
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
		// Liste des fichiers dont le nom satisfait une expression régulière
		$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
		$this->set('listephotos', $jpg_files);
		// recup photo select
		$this->$tablename->bindTranslation(array('nom','desccourt','desclong'));
		$c = $this->$tablename->find("first", array(
				"conditions" => "Boutiqueproduit.id=$id"
		));
		$this->set('photo', $c);
	}
	function admin_suprim($id = null) {
		$tablename = "Boutiqueproduit";
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
		$tablename = "Boutiqueproduit";
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$photo = $this->request->data['selection'];
			$data = array('photo' => $photo);
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
