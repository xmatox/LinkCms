<?php
class BoutiquesController extends BoutiquesAppController {
	// Nom du plugin - Sans espace ni caratères spéciaux
	private $NomPlugin = "Boutiques";
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
								  `paypal` varchar(255) NOT NULL,
								  `desclong` text DEFAULT NULL,
								  PRIMARY KEY (`id`)
								)"); 
		$this->Contenutype->query("CREATE TABLE IF NOT EXISTS `".$prefix."boutiquecats` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `nom` varchar(150) NOT NULL,
								  `photo` varchar(150) DEFAULT NULL,
								  `desccourt` varchar(255) DEFAULT NULL,
								  `desclong` text DEFAULT NULL,
								  `boutique_id` int(11) NOT NULL,
								  PRIMARY KEY (`id`)
								)"); 
		$this->Contenutype->query("CREATE TABLE IF NOT EXISTS `".$prefix."boutiqueproduits` (
								  `id` int(11) NOT NULL AUTO_INCREMENT,
								  `nom` varchar(150) NOT NULL,
								  `prix` int(20) NOT NULL,
								  `photo` varchar(150) DEFAULT NULL,
								  `desccourt` varchar(255) DEFAULT NULL,
								  `desclong` text DEFAULT NULL,
								  `boutiquescat_id` int(11) NOT NULL,
								  PRIMARY KEY (`id`)
								)"); 
		//Contenutype INSERT - Peut etre ajouté dans une rubrique
		$data = array('nom' => $this->NomPlugin, 'table' => $tablenames);
		$this->Contenutype->save($data);
		//Elementtype INSERT - Peut etre ajouté direstement dans une zone
		$this->loadModel('Elementtype');
		$data = array('nom' => $this->NomPlugin, 'table' => $tablenames);
		$this->Elementtype->save($data);
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// création du dossier
		$path = "img/boutiques/";
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
		$this->Contenutype->query("DROP TABLE `".$prefix."boutiquecats`"); 
		$this->Contenutype->query("DROP TABLE `".$prefix."boutiqueproduits`"); 
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
		$this->$tablename->bindTranslation(array('nom','desclong'));
		$thecontent = $this->$tablename->find('all',array(
				"recursive" => -1
			));
		$this->set('thecontent', $thecontent);
	}
	function admin_edit($id=null){
		$this->redirect(array('controller' => 'boutiquecats','action' => 'list',$id));
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
	function ajax_addcaddie() {
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$idprod = $this->request->data['idprod'];
			if ($this->Session->read("caddieboutique.".$id.".".$idprod)) {
				$nb = $this->Session->read("caddieboutique.".$id.".".$idprod.".nb");
				$nb++;
			}else{
				$nb = 1;
			}
			$this->Session->write("caddieboutique.".$id.".".$idprod,array("id"=>$idprod,"nb"=>$nb));

			echo json_encode($idprod);
			exit();
		}
	}
	function ajax_delcaddie() {
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$idprod = $this->request->data['idprod'];
			if ($this->Session->read("caddieboutique.".$id.".".$idprod)) {
				$this->Session->delete("caddieboutique.".$id.".".$idprod);
			}
			echo json_encode($idprod);
			exit();
		}
	}
	function ajax_moinscaddie() {
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$idprod = $this->request->data['idprod'];
			if ($this->Session->read("caddieboutique.".$id.".".$idprod)) {
				$nb = $this->Session->read("caddieboutique.".$id.".".$idprod.".nb");
				if($nb>1) {
					$nb--;
					$this->Session->write("caddieboutique.".$id.".".$idprod,array("id"=>$idprod,"nb"=>$nb));
				}
			}
			echo json_encode($idprod);
			exit();
		}
	}
	function ajax_pluscaddie() {
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$idprod = $this->request->data['idprod'];
			if ($this->Session->read("caddieboutique.".$id.".".$idprod)) {
				$nb = $this->Session->read("caddieboutique.".$id.".".$idprod.".nb");
				$nb++;
				$this->Session->write("caddieboutique.".$id.".".$idprod,array("id"=>$idprod,"nb"=>$nb));
			}
			echo json_encode($idprod);
			exit();
		}
	}
	function ajax_getcaddie() {
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$cad = $this->Session->read("caddieboutique.".$id);
			$toutcad = $this->Session->read("caddieboutique");
			$thecontent2 = $this->Boutique->find('first',array(
				"recursive" => -1,
				"conditions" => array("Boutique.id"=>$id),
				"fields" => array("Boutique.id","Boutique.paypal")
			));
			
			
			$pp=$thecontent2["Boutique"]["paypal"];
			$output =array();

			if($toutcad){
				if($cad){
					foreach ($cad as $c) {
						$pid = $c["id"];
						$nb = $c["nb"];
						$this->Boutique->setlink();
						$thecontent = $this->Boutique->Boutiquecat->Boutiqueproduit->find('first',array(
							"contain" => array("Boutiquecat.boutique_id"),
							"conditions" => array("Boutiqueproduit.id"=>$pid),
							"fields" => array("Boutiqueproduit.id","Boutiqueproduit.nom","Boutiqueproduit.prix","Boutiqueproduit.boutiquecat_id","Boutiquecat.boutique_id")
						));
						$aresult = array(
							"id"=>$thecontent["Boutiqueproduit"]["id"],
							"nom"=>$thecontent["Boutiqueproduit"]["nom"],
							"prix"=>$thecontent["Boutiqueproduit"]["prix"],
							"nb"=>$nb,
							"idbout"=>$thecontent["Boutiquecat"]["boutique_id"]
							);
						array_push($output, $aresult);
					}
				}
				
				foreach ($toutcad as $key=>$cad) {
					$lid = $key;
					if($lid!=$id){
						foreach ($cad as $c) {
							$pid = $c["id"];
							$nb = $c["nb"];
							$this->Boutique->setlink();
							$thecontent = $this->Boutique->Boutiquecat->Boutiqueproduit->find('first',array(
								"contain" => array("Boutiquecat.boutique_id"),
								"conditions" => array("Boutiqueproduit.id"=>$pid),
								"fields" => array("Boutiqueproduit.id","Boutiqueproduit.nom","Boutiqueproduit.prix","Boutiqueproduit.boutiquecat_id","Boutiquecat.boutique_id")
							));
							
							$thecontent2 = $this->Boutique->find('first',array(
								"recursive" => -1,
								"conditions" => array("Boutique.id"=>$thecontent["Boutiquecat"]["boutique_id"]),
								"fields" => array("Boutique.id","Boutique.paypal")
							));
							if($pp==$thecontent2["Boutique"]["paypal"]){
								$aresult = array(
									"id"=>$thecontent["Boutiqueproduit"]["id"],
									"nom"=>$thecontent["Boutiqueproduit"]["nom"],
									"prix"=>$thecontent["Boutiqueproduit"]["prix"],
									"nb"=>$nb,
									"idbout"=>$thecontent["Boutiquecat"]["boutique_id"]
									);
								array_push($output, $aresult);
							}
						}
					}
				}
				
			}else{
				//$output = "no";
			}
			$this->loadModel("Rubrique");
			$thecontent3 = $this->Rubrique->Rubriqueelement->find('first',array(
				"contain" => array("Contenutype","Rubrique"),
				"conditions" => array("Rubriqueelement.contenupage_id"=>$id,"Contenutype.table"=>"Boutiques"),
				"fields" => array("Rubrique.id")
			));
			$aresult2 = array(
				"paypal"=>$thecontent2["Boutique"]["paypal"],
				"idrub"=>$thecontent3["Rubrique"]["id"]
			);
			array_push($output, $aresult2);
			echo json_encode($output);
			exit();
		}
	}
	function beforeRender() {
		$this->set('titre', $this->NomPlugin);
		
	}
}
