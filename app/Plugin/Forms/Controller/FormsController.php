<?php
class FormsController extends FormsAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Forms";
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
								  `sendfrom` varchar(150) NOT NULL,
								  `sendto` varchar(150) NOT NULL,
								  `metatitle` varchar(150) DEFAULT NULL,
								  `metadescription` varchar(255) DEFAULT NULL,
								  PRIMARY KEY (`id`)
								)"); 
		$this->Contenutype->query("CREATE TABLE IF NOT EXISTS `".$prefix."formelements` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `nom` varchar(150) NOT NULL,
								  `type` varchar(100) NOT NULL,
								  `content` text NOT NULL,
								  `position` int(11) NOT NULL,
								  `label` boolean NOT NULL,
								  `obligatoire` BOOLEAN NULL,
								  `alignement` VARCHAR( 20 ) NULL,
								  `width` INT( 3 ) NULL,
								  `form_id` int(11) NOT NULL,
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
		$this->Contenutype->query("DROP TABLE `".$prefix."formelements`"); 
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
	function admin_list(){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		$this->$tablename->bindTranslation(array('nom'));
		$thecontent = $this->$tablename->find('all',array(
				"recursive" => -1
			));
		$this->set('thecontent', $thecontent);
		
	}
	function admin_edit($id=null){
		$this->redirect(array('controller' => 'formelements','action' => 'list',$id));
	}
	function admin_param($id=null){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		if ($this->data) {
			$this->$tablename->locale = Configure::read('Config.languages');
			if ($this->$tablename->save($this->data)) {
				if(!isset($id)){
					$lid = $this->$tablename->id;
					$this->loadModel('Graphelement');
					$dat = array('nom' => "ze_fo".$lid, 'active' => true);
					$this->Graphelement->save($dat);
				}
				$this->Session->setFlash(__('La page à bien été enregistrée', true));
				$this->redirect(array('action' => 'list'));
			} else {
				$this->Session->setFlash(__('La page n\'a pas pu être enregistrée.', true));
			}
		}
		if(isset($id)){
			$this->data = $this->$tablename->readAll($id);
		}
	}
	function admin_suprim($id = null) {
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		if (!$id) {
			$this->Session->setFlash(__("Id invalide pour la page", true));
			$this->redirect($this->referer());
		}
		
		if ($this->$tablename->delete($id)) {
			$this->loadModel('Graphelement');
			$groupe = $this->Graphelement->find('first',array(
				'conditions' => array( 'nom' => "ze_fo".$id),
				'fields' => 'Graphelement.id' ,
				"recursive" => -1
			));
			$graphelement_id = $groupe["Graphelement"]["id"];
			$this->Graphelement->delete($graphelement_id);
			$this->Session->setFlash(__("La page a bien été supprimée", true));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__("La page n'a pas pu être supprimée.", true));
		$this->redirect($this->referer());
	}
	function admin_editcss($id=null){
		$tablename = $this->Formate->getTableName($this->NomPlugin);
		$this->set('tablename', $tablename);
		$this->$tablename->bindTranslation(array('nom'));
		$theform = $this->Form->find('first',array(
			"conditions" => array("Form.id"=>$id),
			"recursive" => -1
		));
		$this->set('theform', $theform["Form"]["nom"]);
		$this->set('theformid', $theform["Form"]["id"]);
		$conthtml = $this->$tablename->view($id);
		$this->set('conthtml', $conthtml);
	}
	function send($id = null) {
		if($this->data){
			$tablename = $this->Formate->getTableName($this->NomPlugin);
			$this->set('tablename', $tablename);
			$this->$tablename->bindTranslation(array('nom'));
			$thecontent = $this->$tablename->find('first',array(
				"conditions" => array("Form.id"=>$id),
				"recursive" => -1
			));
			$sendfrom = $thecontent[$tablename]["sendfrom"];
			$sendto = $thecontent[$tablename]["sendto"];
			
			$theform = $this->$tablename->Formelement->find('all',array(
				"conditions" => array("Formelement.form_id"=>$id),
				"recursive" => -1
			));
			$erreur=false;
			$output="Message du Site internet <br/><br/>";
			foreach($theform as $tf){
				if($tf["Formelement"]["type"]!="info" && $tf["Formelement"]["type"]!="infomulti"){
					if($tf["Formelement"]["obligatoire"]==true && empty($this->data["fo_".$tf["Formelement"]["id"]])){
					
						$erreur=true;
						break;
					}else{
						$output.="<b>".$tf["Formelement"]["nom"]."</b> : ".$this->data["fo_".$tf["Formelement"]["id"]]."<br/><br/>";
					}
				}
			}
			if($erreur){
				$this->Session->setFlash(__("Veuillez remplir tous les champs obligatoires", true));
			}else{
				App::uses('CakeEmail', 'Network/Email');
				$email = new CakeEmail();
				$email->from($sendfrom)
					->to($sendto)
					->subject('Message du SIte')
					->template('form')
					->viewVars(array('data' => $output))
					->emailFormat('both');
				
				if($email->send())
					$this->Session->setFlash(__("Le message a bien été envoyé", true),'default', array('class' => 'success'));
				else
					$this->Session->setFlash(__("Le message n'a pas pu être envoyé", true));
			}
		}else{
			$this->Session->setFlash(__("Le message n'a pas pu être envoyé", true));
		}
		$this->redirect($this->referer());
		exit();
	}
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
		
	}
}
