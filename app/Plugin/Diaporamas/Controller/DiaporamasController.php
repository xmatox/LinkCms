<?php
class DiaporamasController extends DiaporamasAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Diaporamas";
	public $helpers = array('Js');
	// ADMINISTRATION
	function admin_install($id=0){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$tablelongname = $this->Formate->getTableLongName($this->NomPlugin);
		// CREATE - Création de la table
		$this->Diaporama->query("CREATE TABLE IF NOT EXISTS `".$tablelongname."` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `nom` varchar(150) NOT NULL,
								  `selection` varchar(100) DEFAULT NULL,
								  `width` int(5) NOT NULL,
								  `height` int(5) NOT NULL,
								  `url` varchar(255) DEFAULT NULL,
								  `contenu` text,
								  `speed` int(10) DEFAULT '1000',
								  `pause` int(10) DEFAULT '5000',
								  `scroll` varchar(50) DEFAULT 'horizontal',
								  `metatitle` varchar(150) DEFAULT NULL,
								  `metadescription` varchar(255) DEFAULT NULL,
								  PRIMARY KEY (`id`)
								)"); 
		//Contenutype INSERT - Peut etre ajouté dans une rubrique
		$this->loadModel('Contenutype');
		$data = array('nom' => $this->NomPlugin, 'table' => $tablename);
		$this->Contenutype->save($data);
		//Elementtype INSERT - Peut etre ajouté direstement dans une zone
		$this->loadModel('Elementtype');
		$data = array('nom' => $this->NomPlugin, 'table' => $tablename);
		$this->Contenutype->save($data);
		// création du dossier
		$this->redirect($this->referer());
		$path = "/img/diaporamas/";
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
	}
	function test($id=0){
		$this->loadModel('Rubrique');
        $prefix = $this->Rubrique->tablePrefix;
		$this->set('test', $prefix);
		
	}
	function admin_list($id=0){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		$this->$tablename->bindTranslation(array('contenu'));
		$thecontent = $this->$tablename->find('all',array(
				"recursive" => -1
			));
		$this->set('thecontent', $thecontent);
		
	}
	function admin_edit($id=null){
		$this->redirect(array('action' => 'param',$id));
	}
	function admin_param($id=null){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		if ($this->data) {
			$this->$tablename->locale = Configure::read('Config.languages');
			if ($this->$tablename->save($this->data)) {
				$this->Session->setFlash(__('La page à bien été enregistrée', true));
			} else {
				$this->Session->setFlash(__('La page n\'a pas pu être enregistrée.', true));
			}
		}
		if(isset($id)){
			$this->data = $this->$tablename->readAll($id);
		}
	}
	function admin_photo($id=null){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		$this->set('idEv', $id);
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// Nouvelle instance de classe avec le répertoire choisi
		$path = "img/diaporamas/".$id."/";
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
		// Liste des fichiers dont le nom satisfait une expression régulière
		$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
		$this->set('listephotos', $jpg_files);
		// recup photo select
		$c = $this->$tablename->find("first", array(
				"conditions" => $tablename.".id=$id"
		));
		$this->set('photo', $c);
		
	}
	function admin_suprim($id = null) {
		if (!$id) {
			$this->Session->setFlash(__("Id invalide pour la page", true));
			$this->redirect($this->referer());
		}
		if ($this->Diaporama->delete($id)) {
			$this->Session->setFlash(__("La page a bien été supprimée", true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__("La page n'a pas pu être supprimée.", true));
		$this->redirect($this->referer());
	}
	function ajax_getselect($id=null){
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$selection = $this->request->data['selection'];
			$data = array('selection' => $selection);
			// This will update Recipe with id 10
			$this->Diaporama->id=$id;
			if($this->Diaporama->save($data)) echo json_encode($id);
			 exit();
		}
	}
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
		
	}
}
