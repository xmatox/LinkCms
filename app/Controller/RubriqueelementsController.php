<?php
class RubriqueelementsController extends AppController {
	public $helpers = array('Js');
	var $name = 'Rubriqueelements';
	function admin_ajax_getpages(){
		if ( $this->request->is( 'ajax' ) ) {
			if($this->request->query[ 'id' ]==0){
				$result2="";
			}else{
				$result = $this->Rubriqueelement->Contenutype->find('first',
					array( 
						'conditions' => array( 'Contenutype.id' => $this->request->query[ 'id' ] ),
						'fields' => 'table',
						'recursive' => -1
					)
				);
				
				$plug = $result['Contenutype']['table'];
				$table = substr($result['Contenutype']['table'], 0, -1);
				
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
	function ajax_saveform(){
		if ( $this->request->is( 'ajax' ) ) {
			$contenupage_id = $this->request->data['contenupage'];
			$contenutype_id = $this->request->data['contenutype'];
			$zone = $this->request->data['zone'];
			$rubrique_id = substr($zone, 2);
			// detection nouveau contenu
			if($contenupage_id=="new"){
				$contenupage_id = $this->Rubriqueelement->savenew($contenutype_id,$rubrique_id);
				$statut = "new";
			}else{
				$statut = "ok";
			}
			$data = array('graphelement_id' => 0, 'contenupage_id' => $contenupage_id, 'contenutype_id' => $contenutype_id, 'rubrique_id' => $rubrique_id);
			//
			$this->Rubriqueelement->save($data);
			$lid = $this->Rubriqueelement->id;
			//
			$data2 = array('nom' => "re_".$lid, 'active' => true);
			$this->Rubriqueelement->Graphelement->save($data2);
			$lidg = $this->Rubriqueelement->Graphelement->id;
			//
			$data3 = array('graphelement_id' => $lidg);
			$this->Rubriqueelement->save($data3);
			if($statut=="new"){
				
				echo json_encode(array("e_statut"=>$statut,"e_value"=>$this->Rubriqueelement->id));
			}else{
				echo json_encode(array("e_statut"=>$statut,"e_value"=>""));
			}
			exit();
        
		} 
	}
	function ajax_recupzone(){
		if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$rubrique_id = substr($zone, 2);
			echo json_encode($this->Rubriqueelement->view($rubrique_id));
			
            exit();
        
		}
	}
	function ajax_setposition(){
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$position = $this->request->data['position'];
			$data = array('ordre' => $position);
			// This will update Recipe with id 10
			$this->Rubriqueelement->id=$id;
			if($this->Rubriqueelement->save($data)) echo json_encode($id);
			 exit();
        
		} 
	}
	function ajax_deleteform(){
		 if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$groupe = $this->Rubriqueelement->Graphelement->find('first',array(
				'conditions' => array( 'nom' => "re_".$id),
				'fields' => 'Graphelement.id' ,
				"recursive" => -1
			));
			$graphelement_id = $groupe["Graphelement"]["id"];
			$this->Rubriqueelement->Graphelement->delete($graphelement_id);
			if($this->Rubriqueelement->delete($id)) echo json_encode($id);
			 exit();
        
		} 
	}
	function ajax_actueditzone(){
		if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$id = $this->request->data['id'];
			$result = $this->Rubriqueelement->find('first',
				array( 
					'conditions' => array( 'Rubriqueelement.id' => $id),
					'contain' => array( 'Contenutype.nom')
				)
			);
			$groupe = $this->Rubriqueelement->Graphelement->find('first',array(
				'conditions' => array( 'Graphelement.nom' => $zone),
				"recursive" => -1
			));
			$aresult = array("nom"=>$result["Contenutype"]["nom"],"css"=>$groupe);
            echo json_encode($aresult);
            exit();
        
		} 
	}
	function ajax_editcont() {
	    $zone = $this->request->data['zone'];
		$id = $this->request->data['id'];
		$type = $this->request->data['typee'];
		$result = $this->Rubriqueelement->find('first',
			array( 
				'conditions' => array( 'Rubriqueelement.id' => $id),
				'contain' => array( 'Contenutype.table')
			)
		);
		array_push($result, $type);
		echo json_encode($result);
	    exit();
	}
	function ajax_recuptablecont() {
	    $type = $this->request->data['typee'];
		$result = $this->Rubriqueelement->Contenutype->find('first',
			array( 
				'conditions' => array( 'Contenutype.id' => $type)
			)
		);
		array_push($result, $type);
		echo json_encode($result);
	    exit();
	}
}