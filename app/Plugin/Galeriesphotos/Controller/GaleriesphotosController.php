<?php
class GaleriesphotosController extends GaleriesphotosAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Galeries photos";
	public $helpers = array('Js');
	// ADMINISTRATION
	function admin_install($id=0){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$tablenames = $this->Formate->getTableNames($this->NomPlugin);
		$tablelongname = $this->Formate->getTableLongName($this->NomPlugin);
		// CREATE - Création de la table
		$this->loadModel('Contenutype');
		$prefix = $this->Contenutype->tablePrefix;
		$this->Contenutype->query("CREATE TABLE IF NOT EXISTS `".$prefix.$tablelongname."` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `nom` varchar(150) NOT NULL,
								  `contenu` text,
								  PRIMARY KEY (`id`)
								)"); 
		$this->Contenutype->query("CREATE TABLE IF NOT EXISTS `".$prefix."galeriesphotoelements` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `nom` varchar(150) NOT NULL,
								  `selection` varchar(100) DEFAULT NULL,
								  `width` int(5) NOT NULL,
								  `height` int(5) NOT NULL,
								  `contenu` text,
								  `galeriesphoto_id` int(11) NOT NULL,
								  PRIMARY KEY (`id`)
								)"); 
		//Contenutype INSERT - Peut etre ajouté dans une rubrique
		$data = array('nom' => $this->NomPlugin, 'table' => $tablenames);
		$this->Contenutype->save($data);
		//Elementtype INSERT - Peut etre ajouté direstement dans une zone
		/*$this->loadModel('Elementtype');
		$data = array('nom' => $this->NomPlugin, 'table' => $tablename);
		$this->Contenutype->save($data);*/
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// création du dossier
		$path = "img/galeries/";
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
		$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
		debug($dir->find());
		$this->Session->setFlash(__('Le plugin à bien été installé', true));
		$this->redirect(array('controller' => 'contenutypes','action' => 'list','plugin' => false));
	}
	function admin_delete(){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$tablenames = $this->Formate->getTableNames($this->NomPlugin);
		$tablelongname = $this->Formate->getTableLongName($this->NomPlugin);
		$c = $this->$tablename->delete();
		// DELETE - Supression de la table
		$this->loadModel('Contenutype');
		$prefix = $this->Contenutype->tablePrefix;
		$this->Contenutype->query("DROP TABLE `".$prefix.$tablelongname."`"); 
		$this->Contenutype->query("DROP TABLE `".$prefix."galeriesphotoelements`"); 
		//Contenutype DELETE 
		$tablen = $this->Contenutype->find("first", array(
			"conditions"=>array('table' => $tablenames)
		));
		$this->Contenutype->delete($tablen["Contenutype"]["id"]);
		//Elementtype DELETE 
		/*$this->loadModel('Elementtype');
		$tablen = $this->Elementtype->find("first", array(
			"conditions"=>array('table' => $tablenames)
		));
		$this->Elementtype->delete($tablen["Elementtype"]["id"]);*/
		$this->Session->setFlash(__('Le plugin à bien été desinstallé', true));
		$this->redirect(array('controller' => 'contenutypes','action' => 'list','plugin' => false));
	}
	function admin_list($id=null){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		

		if ($this->data) {
			$this->$tablename->locale = Configure::read('Config.languages');
			if ($this->$tablename->save($this->data)) {
				$this->Session->setFlash(__('La page à bien été enregistrée', true));
				$this->redirect(array('action' => 'list'));
			} else {
				$this->Session->setFlash(__('La page n\'a pas pu être enregistrée.', true));
			}
		}
		if(isset($id)){
			$this->data = $this->$tablename->readAll($id);
		}
		$this->$tablename->bindTranslation(array('contenu'));
		$thecontent = $this->$tablename->find('all',array(
				"recursive" => -1
			));
		$this->set('thecontent', $thecontent);
	}
	function admin_edit($id=null){
		$this->redirect(array('controller' => 'galeriesphotoelements','action' => 'list',$id));
	}
	function admin_suprim($id = null) {
		$tablename = $this->Formate->getTableName($this->NomPlugin);
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
