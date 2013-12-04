<?php
class ZoneelementsController extends AppController {
	public $helpers = array('Js');
	function view($zone=null){
		$result = $this->Zoneelement->getContents($zone);
		$areturn = array();
		foreach($result as $r){
			if(!empty($r['Elementtype']['table'])){
				$plug = $r['Elementtype']['table'];
				$table = substr($plug, 0, -1);
				if ($r['Elementtype']['table']!="Menugroupes" && $r['Elementtype']['table']!="Languages") {
					/*$this->loadModel($plug.'.'.$table);
					$pages = $this->$table->view($r['Zoneelement']['contenupage_id'],$r['Zoneelement']['id']);*/
					$pages = ClassRegistry::init($plug.'.'.$table)->view($r['Zoneelement']['contenupage_id'],$r['Zoneelement']['id'],"ze_");
				}else if($r['Elementtype']['table']=="Languages"){
					/*$this->loadModel($table);
					$pages = $this->$table->view("",$r['Zoneelement']['id']);*/
					$pages = ClassRegistry::init($table)->view("",$r['Zoneelement']['id'],"ze_");
					
				}else{
					/*$this->loadModel($table);
					$pages = $this->$table->view($r['Zoneelement']['contenupage_id'],$r['Zoneelement']['id']);*/
					$pages = ClassRegistry::init($table)->view($r['Zoneelement']['contenupage_id'],$r['Zoneelement']['id'],"ze_");
				}
				
				array_push($areturn,$pages);
			}
		}
		return $areturn;
	}
	//
	function viewmobile($zone=null){
		$result = $this->Zoneelement->getContents($zone);
		$areturn = array();
		foreach($result as $r){
			if(!empty($r['Elementtype']['table'])){
				$plug = $r['Elementtype']['table'];
				$table = substr($plug, 0, -1);
				if($r['Elementtype']['table']=="Languages"){
					$pages = ClassRegistry::init($table)->viewmobile("","mob".$r['Zoneelement']['id']);
					array_push($areturn,$pages);
				}
				
			}
		}
		$pages = ClassRegistry::init("Menugroupe")->getMenuMobile();
		array_push($areturn,$pages);
		return $areturn;
	}
	//
	function admin_edit(){
		$c = $this->Zoneelement->find('all',array(
				
			));
		$this->set('zone', $c);
		$type = $this->Zoneelement->Elementtype->find('list',array(
				'fields' => 'id,nom',
				'recursive' => -1
		));
		$this->set('type', $type);
		//
		$pages="";
		$this->set('pages', $pages);
	}
	//
	
	function ajax_recupform(){
		if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$result = $this->Zoneelement->find('all',
				array( 
					'conditions' => array( 'Graphelement.nom' => $zone ),
					'contain' => array( 'Graphelement.nom','Elementtype.table','Elementtype.nom' ),
					'order' => array( 'Zoneelement.ordre' )
					
				)
			);

			$json = array();
			foreach($result as $r){
				$plug = $r['Elementtype']['table'];
				$table = substr($plug, 0, -1);
				$this->loadModel($table);
				//$this->loadModel('Menu');
				$pages = $this->$table->find('first',array(
						'fields' => 'nom',
						'conditions' => array( 'id' => $r['Zoneelement']['contenupage_id'] ),
						'recursive' => -1
				));
				
				 array_push($json,array(
					"nom"=>$pages[$table]['nom'],
					"type"=>$r['Elementtype']['nom'],
					"id"=>$r['Zoneelement']['id'],
					"ordre"=>$r['Zoneelement']['ordre'],
					"elementtype_id"=>$r['Zoneelement']['elementtype_id'],
					"graphelement_id"=>$r['Zoneelement']['graphelement_id'],
					"contenupage_id"=>$r['Zoneelement']['contenupage_id']
				));
				
			}
            echo json_encode($json);
            exit();
        
		}
	}
	function ajax_recupzone(){
		if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$result = $this->Zoneelement->find('first',
				array( 
					'conditions' => array( 'Graphelement.nom' => $zone ),
					'contain' => array( 'Graphelement.id'),
					'order' => array( 'Zoneelement.ordre' )
				)
			);
			$id_zone = $result["Graphelement"]["id"];
			echo json_encode($this->view($id_zone));
			


			/*$json = array();
			foreach($result as $r){
				$plug = $r['Elementtype']['table'];
				$table = substr($plug, 0, -1);
				$this->loadModel($table);
				//$this->loadModel('Menu');
				$pages = $this->$table->find('first',array(
						'fields' => 'nom',
						'conditions' => array( 'id' => $r['Zoneelement']['contenupage_id'] ),
						'recursive' => -1
				));
				
				 array_push($json,array(
					"nom"=>$pages[$table]['nom'],
					"type"=>$r['Elementtype']['nom'],
					"id"=>$r['Zoneelement']['id'],
					"ordre"=>$r['Zoneelement']['ordre'],
					"elementtype_id"=>$r['Zoneelement']['elementtype_id'],
					"graphelement_id"=>$r['Zoneelement']['graphelement_id'],
					"contenupage_id"=>$r['Zoneelement']['contenupage_id']
				));
				
			}
            // On encode au format JSON et on affiche directement ce résultat (pour le récupérer dans la vue)
            echo json_encode($json);*/
            exit();
        
		}
	}
	function admin_ajax_getpages(){
		 if ( $this->request->is( 'ajax' ) ) {
			if($this->request->query[ 'id' ]==0){
				$result2="";
			}else{
				$result = $this->Zoneelement->Elementtype->find('first',
					array( 
						'conditions' => array( 'Elementtype.id' => $this->request->query[ 'id' ] ),
						'fields' => 'table',
						'recursive' => -1
					)
				);
				
				$plug = $result['Elementtype']['table'];
				$table = substr($result['Elementtype']['table'], 0, -1);
				
				$this->loadModel($table);
				$result2 = $this->$table->find('list',array(
						'fields' => 'id,nom',
						'recursive' => -1
				));
			}
            echo json_encode($result2);
            exit();
        }
	}
	function ajax_saveform($elementtype_id=null,$contenupage_id=null,$zone=null){
		if ( $this->request->is( 'ajax' ) ) {
		
			if(!$elementtype_id) $elementtype_id = $this->request->data['elementtype'];
			if(!$contenupage_id) $contenupage_id = $this->request->data['contenupage'];
			if(!$zone) $zone = $this->request->data['zone'];
			
			$graph = $this->Zoneelement->Graphelement->find('first',
				array( 
					'conditions' => array( 'Graphelement.nom' => $zone ),
					'fields' => array( 'Graphelement.id' )
				)
			);
			$graphelement_id = $graph["Graphelement"]["id"];
			// detection nouveau contenu
			if($contenupage_id=="new"){
				$contenupage_id = $this->Zoneelement->savenew($elementtype_id);
				$statut = "new";
			}else{
				$statut = "ok";
			}
			$data = array('graphelement_id' => $graphelement_id, 'contenupage_id' => $contenupage_id, 'elementtype_id' => $elementtype_id);
			//
			$this->Zoneelement->save($data);
			$lid = $this->Zoneelement->id;
		
			//
			$data2 = array('nom' => "ze_".$lid, 'active' => true);
			$this->Zoneelement->Graphelement->save($data2);
			if($statut=="new"){
				
				echo json_encode(array("e_statut"=>$statut,"e_value"=>$lid));
			}else{
				echo json_encode(array("e_statut"=>$statut,"e_value"=>""));
			}
			exit();
        
		}
	}
	function ajax_deleteform(){
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$groupe = $this->Zoneelement->Graphelement->find('first',array(
				'conditions' => array( 'nom' => "ze_".$id),
				'fields' => 'Graphelement.id' ,
				"recursive" => -1
			));
			$graphelement_id = $groupe["Graphelement"]["id"];
			$this->Zoneelement->Graphelement->delete($graphelement_id);
			if($this->Zoneelement->delete($id)) echo json_encode($id);
			 exit();
        
		}
	}
	function ajax_actueditzone(){
		if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$id = $this->request->data['id'];
			$result = $this->Zoneelement->find('first',
				array( 
					'conditions' => array( 'Zoneelement.id' => $id),
					'contain' => array( 'Elementtype.nom')
				)
			);
			$groupe = $this->Zoneelement->Graphelement->find('first',array(
				'conditions' => array( 'Graphelement.nom' => $zone),
				"recursive" => -1
			));
			$aresult = array("nom"=>$result["Elementtype"]["nom"],"css"=>$groupe);
            echo json_encode($aresult);
            exit();
        
		}
	}
	function ajax_setposition(){
		 if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$position = $this->request->data['position'];
			$data = array('ordre' => $position);
			// This will update Recipe with id 10
			$this->Zoneelement->id=$id;
			if($this->Zoneelement->save($data)) echo json_encode($id);
			 exit();
        
		}
	}
	function ajax_editcont() {
	    $zone = $this->request->data['zone'];
		$id = $this->request->data['id'];
		$type = $this->request->data['typee'];
		$result = $this->Zoneelement->find('first',
			array( 
				'conditions' => array( 'Zoneelement.id' => $id),
				'contain' => array( 'Elementtype.table')
			)
		);
		array_push($result, $type);
		echo json_encode($result);
	    exit();
	}
}
