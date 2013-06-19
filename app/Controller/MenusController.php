<?php
class MenusController extends AppController {
	public $helpers = array('Js');
	
	function admin_list($idgroupe=null){
		
		$c = $this->Menu->Menugroupe->find('first',array(
				'conditions' => array( 'Menugroupe.id' => $idgroupe )
			));
		$this->set('groupe', $c);
		$this->set('idgroupe', $idgroupe);
		//
		$pages = $this->Menu->Menugroupe->view($idgroupe);
		$this->set('pages', $pages);
	}
	//
	function ajax_recup($id=null){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			if(!$id) $id=0;
			$idgroupe = $this->request->data['idgroupe'];
			$result = $this->Menu->find('all',
				array( 
					'conditions' => array( 'Menu.parent' => $id,'Menu.menugroupe_id' => $idgroupe, ),
					'order' => 'Menu.ordre ASC',
					'recursive' => -1
				)
			);
            // On encode au format JSON et on affiche directement ce résultat (pour le récupérer dans la vue)
            echo json_encode($result);
 
            // Il faut penser à terminer le script brutalement pour court-circuiter les mécanismes
            // de CakePHP (méthodes de la classe mère AppController par exemple)
            exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function ajax_add($parent=null){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			if(!$parent) $parent=0;
			$ordre = $this->request->data['ordre'];
			$idgroupe = $this->request->data['idgroupe'];
			$data = array('ordre' => $ordre, 'parent' => $parent, 'menugroupe_id' => $idgroupe);
			// This will update Recipe with id 10
			$this->Menu->save($data);
			$newid = $this->Menu->id;
            // On encode au format JSON et on affiche directement ce résultat (pour le récupérer dans la vue)
            echo json_encode($newid);
 
            // Il faut penser à terminer le script brutalement pour court-circuiter les mécanismes
            // de CakePHP (méthodes de la classe mère AppController par exemple)
            exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function ajax_rub(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$this->Menu->Rubrique->bindTranslation(array('nom','url'));
			$result = $this->Menu->Rubrique->find('all',
				array( 
					'conditions' => array( 'Rubrique.parent' => 0,'Rubrique.id <>' => 0 ),
					'recursive' => -1
				)
			);
           echo json_encode($result);
            exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function ajax_saveform(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			//$nom = $this->request->data['nom'];
			$rub = $this->request->data['rub'];
			$data = array('rubrique_id' => $rub);
			// This will update Recipe with id 10
			$this->Menu->id=$id;
			
			if($this->Menu->save($data)) echo json_encode($id);
			 exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function ajax_deleteform(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			if($this->Menu->delete($id)) echo json_encode($id);
			 exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function ajax_setposition(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$position = $this->request->data['position'];
			$data = array('ordre' => $position);
			// This will update Recipe with id 10
			$this->Menu->id=$id;
			if($this->Menu->save($data)) echo json_encode($id);
			 exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
}
