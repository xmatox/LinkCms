<?php
class HtmlsController extends HtmlsAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Htmls";
	public $helpers = array('Js');
	// ADMINISTRATION
	function admin_install(){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$tablenames = $this->Formate->getTableNames($this->NomPlugin);
		$tablelongname = $this->Formate->getTableLongName($this->NomPlugin);
		// CREATE - Création de la table
		$this->loadModel('Contenutype');
		$prefix = $this->Contenutype->tablePrefix;
		$this->Contenutype->query("CREATE TABLE IF NOT EXISTS `".$prefix.$tablelongname."` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `nom` varchar(150) NOT NULL,
								  `contenuhtml` text NOT NULL,
								  `contenucss` text NOT NULL,
								  `contenujs` text NOT NULL,
								  PRIMARY KEY (`id`)
								)"); 
		//Contenutype INSERT - Peut etre ajouté dans une rubrique
		$data = array('nom' => $this->NomPlugin, 'table' => $tablenames);
		$this->Contenutype->save($data);
		//Elementtype INSERT - Peut etre ajouté direstement dans une zone
		$this->loadModel('Elementtype');
		$data = array('nom' => $this->NomPlugin, 'table' => $tablenames);
		$this->Elementtype->save($data);
		$this->Session->setFlash(__('Le plugin à bien été installé', true));
		// création du dossier
		$this->redirect($this->referer());
		$path = "/img/content/";
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
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
		//Contenutype DELETE 
		$tablen = $this->Contenutype->find("first", array(
			"conditions"=>array('table' => $tablenames)
		));
		$this->Contenutype->delete($tablen["Contenutype"]["id"]);
		//Elementtype DELETE 
		$this->loadModel('Elementtype');
		$tablen = $this->Elementtype->find("first", array(
			"conditions"=>array('table' => $tablenames)
		));
		$this->Elementtype->delete($tablen["Elementtype"]["id"]);
		$this->Session->setFlash(__('Le plugin à bien été desinstallé', true));
		$this->redirect(array('controller' => 'contenutypes','action' => 'list','plugin' => false));
	}
	function admin_list($id=null){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		$this->$tablename->bindTranslation(array('contenuhtml'));
		$thecontent = $this->$tablename->find('all',array(
				"recursive" => -1
			));
		$this->set('thecontent', $thecontent);
		
		
	}
	function admin_edit($id=null){
		if ($id==0) $id=null;
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		if ($this->data) {
			$this->$tablename->locale = Configure::read('Config.languages');
			if ($this->$tablename->save($this->data)) {
				if(!isset($id)) $id = $this->$tablename->id;
				$this->Session->setFlash(__('La page à bien été enregistrée', true));
				$this->redirect(array('action' => 'edit',$id));
			} else {
				$this->Session->setFlash(__('La page n\'a pas pu être enregistrée.', true));
				
			}
		}
		if(isset($id)){
			$this->data = $this->$tablename->readAll($id);
		}
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// Nouvelle instance de classe avec le répertoire choisi
		$path = "img/content/";
		$dir = new Folder($path);
		if(!$dir->find()){
			$dir->create($path);
		}
		// Liste des fichiers dont le nom satisfait une expression régulière
		$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
		$this->set('listephotos', $jpg_files);
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
