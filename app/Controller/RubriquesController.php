<?php
class RubriquesController extends AppController {
	var $name = 'Rubriques';
	public $helpers = array('Js');
	
	function view($id=null,$titre='',$var=null){
		$this->set('idrub', $id);
		if (!empty($var)) {
			$titre2=$var;
			$var=$titre;
			$titre=$titre2;
		}
		$this->Rubrique->locale = Configure::read('Config.language');
		$this->Rubrique->bindTranslation(array('nom','url'));
		$rub = $this->Rubrique->find('first',array(
			"conditions" => "Rubrique.id=$id"
		));
		if (!$rub) {
			if(Configure::read('Parameter.production'))
				$this->redirect("/");
			else
				$this->redirect("/p/1");
		}
		// url
		if($rub['Rubrique']['id']!=1){
			if(!empty($rub['Rubrique']['url'])){
				$titre_attendu = strtolower(Inflector::slug($rub['Rubrique']['url'], '-'));
				
			}else{
				$titre_attendu = strtolower(Inflector::slug($rub['Rubrique']['nom'], '-'));
				
			}
			if($titre != $titre_attendu && empty($var))
			{
				$this->redirect(array($id,$titre_attendu), 301);
			}
		}else{
		
			if($this->params->url){
				if(Configure::read('Parameter.production'))
					$this->redirect("/");
				/*else if(!Configure::read('Parameter.production') && $this->params->url!="/p/1")
					$this->redirect("/p/1");*/
			}
		}
		// recup meta 
		if(!empty($rub["Rubrique"]["metatitle"])) $this->set('title_for_layout', $rub["Rubrique"]["metatitle"]." - ".Configure::read('Parameter.nomsite'));
		else $this->set('title_for_layout', $rub["Rubrique"]["nom"]." - ".Configure::read('Parameter.nomsite'));
		if(!empty($rub["Rubrique"]["metadescription"])) $this->set('metadesc_for_layout', $rub["Rubrique"]["metadescription"].", ".Configure::read('Parameter.nomsite'));
		else $this->set('metadesc_for_layout', $rub["Rubrique"]["nom"].", ".Configure::read('Parameter.nomsite'));
		if(!empty($rub["Rubrique"]["metakeyword"])) $this->set('metakey_for_layout', $rub["Rubrique"]["metakeyword"].", ".Configure::read('Parameter.nomsite'));
		else $this->set('metakey_for_layout', $rub["Rubrique"]["nom"].", ".Configure::read('Parameter.nomsite'));
		//
		
		
		$conthtml = $this->Rubrique->Rubriqueelement->view($rub['Rubrique']['id']);
		
		$this->set('conthtml', $conthtml);
		// url admin
		if($this->Session->read('Auth.User.role')=="admin"){
			$allrub = $this->Rubrique->getList();
			$this->set('allrub', $allrub);
			//
			$this->set('rub', $rub);
			$this->loadModel('Elementtype');
			$type = $this->Elementtype->find('list',array(
				'fields' => 'id,nom',
				'recursive' => -1
			));
			$this->set('type', $type);
			$this->loadModel('Contenutype');
			$typec = $this->Contenutype->find('list',array(
				'fields' => 'id,nom',
				'recursive' => -1
			));
			$this->set('typec', $typec);
			//
			$typecat = $this->Contenutype->find('all',array(
				"conditions" => "id<>0",
				"recursive" => -1
			));
			$this->set('typecat', $typecat);
			// Import de la classe Folder
			App::uses('Folder', 'Utility');
			// Nouvelle instance de classe avec le répertoire choisi
			$path = "../Plugin";
			$dir = new Folder($path);
			// Liste des fichiers dont le nom satisfait une expression régulière
			$listeplugin = $dir->read();
			$this->set('listeplugin', $listeplugin);
			//
			$this->loadModel('Menugroupe');
			$groupe = $this->Menugroupe->find('all',array(
				"recursive" => -1
			));
			$this->set('groupe', $groupe);
		}
	}
	function admin_edit($id=null){
		if ($this->data) {
			$this->Rubrique->locale = Configure::read('Config.languages');
			if ($this->Rubrique->save($this->data)) {
				$this->Session->setFlash(__('La rubrique à bien été enregistrée', true));
				//$this->redirect(array('action' => 'list',$this->data["Rubrique"]["parent"]));
			} else {
				$this->Session->setFlash(__('The Rubrique could not be saved. Please, try again.', true));
			}
		}
		if(isset($id)){
			$this->data = $this->Rubrique->readAll($id);
		}
		$c = $this->Rubrique->find('list',array(
				'fields' => 'id,nom',
				'recursive' => -1
		));
		$this->set('lescats', $c);
		//
		$type = $this->Rubrique->Contenutype->find('list',array(
				'fields' => 'id,nom',
				'recursive' => -1
		));
		$this->set('type', $type);
		//
		if(isset($id) && $this->data['Contenutype']['id']!=0){
			$plug = $this->data['Contenutype']['table'];
			$table = substr($plug, 0, -1);
			$this->loadModel($plug.'.'.$table);
			$pages = $this->$table->find('list',array(
					'fields' => 'id,nom',
					'recursive' => -1
			));
		}else{
			$pages = "";
		}
		
		$this->set('pages', $pages);
	}
	function admin_list($id=0){
		
		//debug(Configure::read('Config.languages'));
		$this->Rubrique->bindTranslation(array('nom'));
		$c = $this->Rubrique->find('all',array(
				"conditions" => "Rubrique.parent=$id && Rubrique.id<>0",
				"contain" => "Contenutype"
			));
		$this->set('cat', $c);
		$ct = $this->Rubrique->find('first',array(
				"conditions" => "Rubrique.id=$id",
				"fields" => "id,nom,parent"
			));
		$this->set('lacat', $ct);
	}
	function admin_suprim($id = null) {
		if (!$id) {
			$this->Session->setFlash(__("Id invalide dour l'évènement", true));
		}
		if($id!=1){
			if ($this->Rubrique->delete($id,true)) {
				$this->Session->setFlash(__("La rubrique a bien été supprimé", true));
			}else{
				$this->Session->setFlash(__("La rubrique n'a pas pu être supprimé.", true));
			}
		}else{
			$this->Session->setFlash(__("Cette rubrique ne peut pas être supprimé", true));
		}
		//$this->redirect($this->referer());
	}
	function admin_ajax_getpages(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			if($this->request->query[ 'id' ]==0){
				$result2="";
			}else{
				$result = $this->Rubrique->Contenutype->find('first',
					array( 
						'conditions' => array( 'Contenutype.id' => $this->request->query[ 'id' ] ),
						'fields' => 'table',
						'recursive' => -1
					)
				);
				
				$plug = $result['Contenutype']['table'];
				$table = substr($result['Contenutype']['table'], 0, -1);
				
				$this->loadModel($plug.'.'.$table);
				$result2 = $this->$table->find('list',array(
						'fields' => 'id,nom',
						'recursive' => -1
				));
			}
            // On encode au format JSON et on affiche directement ce résultat (pour le récupérer dans la vue)
            echo json_encode($result2);
 
            // Il faut penser à terminer le script brutalement pour court-circuiter les mécanismes
            // de CakePHP (méthodes de la classe mère AppController par exemple)
            exit();
        }
        else {
            // Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
            // Pour nous dans cet exemple, c'est inutile...
        }
	}
}
