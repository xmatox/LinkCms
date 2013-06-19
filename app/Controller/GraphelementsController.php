<?php
class GraphelementsController extends AppController {
	public $helpers = array('Js');
	public $components = array('RequestHandler');
	function css(){
		$c = $this->Graphelement->find('all',array(
				"recursive" => -1
			));
		$this->set('graph', $c);
	}
	function admin_edit($idgroupe=null){
		$c = $this->Graphelement->find('all',array(
				"recursive" => -1
			));
		$this->set('graph', $c);
	}
	function admin_editzone($idzone=null){
		$c = $this->Graphelement->find('first',array(
				'conditions' => array( 'id' => $idzone ),
				"recursive" => -1
			));
		$this->set('graph', $c);
		$this->loadModel('Zoneelement');
		$zel = $this->Zoneelement->find('first',array(
				'conditions' => array( 'graphelement_id' => $idzone ),
				"fields" => "id",
				"recursive" => -1
			));
		$this->set('zel', $zel);
	}
	//
	function admin_ajax_settype(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$type = $this->request->query['typegraph'];
			
			if($type=="DG"){
				$data = array('active' => true);
				$this->Graphelement->id=5;
				$this->Graphelement->save($data);
				$data2 = array('active' => true);
				$this->Graphelement->id=6;
				$this->Graphelement->save($data2);
			}else if($type=="D"){
				$data = array('active' => true);
				$this->Graphelement->id=5;
				$this->Graphelement->save($data);
				$data2 = array('active' => false);
				$this->Graphelement->id=6;
				$this->Graphelement->save($data2);
			}else if($type=="G"){
				$data = array('active' => false);
				$this->Graphelement->id=5;
				$this->Graphelement->save($data);
				$data2 = array('active' => true);
				$this->Graphelement->id=6;
				$this->Graphelement->save($data2);
			}else{
				$data = array('active' => false);
				$this->Graphelement->id=5;
				$this->Graphelement->save($data);
				$data2 = array('active' => false);
				$this->Graphelement->id=6;
				$this->Graphelement->save($data2);
			} 
			echo json_encode($type);
			
			exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function ajax_recupform(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$result = $this->Graphelement->find('first',
				array( 
					'conditions' => array( 'nom' => $zone ),
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
	function ajax_actuvisu(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			
			$result = $this->Graphelement->find('all',
				array( 
					'recursive' => -1
				)
			);
            echo json_encode($result);
            exit();
        
		} else {
		}
	}
	function ajax_saveform(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
		
			$id = $this->request->data['id'];
			$width = $this->request->data['width'];
			$height = $this->request->data['height'];
			$fondcolor = $this->request->data['fondcolor'];
			$fondimg = $this->request->data['fondimg'];
			$fondimgpos = $this->request->data['fondimgpos'];
			$fondimgrepeat = $this->request->data['fondimgrepeat'];
			$Wcentre = $this->request->data['Wcentre'];
			$margin = $this->request->data['margin'];
			$padding = $this->request->data['padding'];
			$data = array('width' => $width, 'height' => $height, 'height' => $height, 'fondcolor' => $fondcolor, 'fondimg' => $fondimg, 'fondimgpos' => $fondimgpos, 'fondimgrepeat' => $fondimgrepeat, 'margin' => $margin, 'padding' => $padding);
			//
			$this->Graphelement->id=$id;
			$this->Graphelement->save($data);
			if($id==3){
				$data2 = array('width' => $width);
				$this->Graphelement->id=2;
				$this->Graphelement->save($data2);
			}
			if($id==7){
				$data2 = array('fondcolor' => $fondcolor);
				$this->Graphelement->id=2;
				$this->Graphelement->save($data2);
			}
			if($id==5 || $id==6 || $id==3){
				$data2 = array('width' => $Wcentre);
				$this->Graphelement->id=7;
				$this->Graphelement->save($data2);
			}
			echo json_encode("ok");
			exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function ajax_actueditzone(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$result = $this->Graphelement->find('first',
				array( 
					'conditions' => array( 'Graphelement.nom' => $zone),
					'recursive' => -1
				)
			);
			$aresult = array($result);
            echo json_encode($aresult);
            exit();
        
		} else {
		}
	}
	function ajax_saveeditzone(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$result = $this->Graphelement->find('first',
				array( 
					'conditions' => array( 'Graphelement.nom' => $zone),
					'fields' => 'Graphelement.id' ,
					'recursive' => -1
				)
			);
			$graphelement_id = $result["Graphelement"]["id"];
			$width = $this->request->data['width'];
			$height = $this->request->data['height'];
			$border = $this->request->data['border'];
			$margin = $this->request->data['margin'];
			$padding = $this->request->data['padding'];
			$float = $this->request->data['float'];
			$fondcolor = $this->request->data['fondcolor'];
			$borderradius = $this->request->data['borderradius'];
			$textsize = $this->request->data['textsize'];
			$textcolor = $this->request->data['textcolor'];
			$textalign = $this->request->data['textalign'];
			$textgras = $this->request->data['textgras'];
			$fondimg = $this->request->data['fondimg'];
			$fondimgpos = $this->request->data['fondimgpos'];
			$fondimgrepeat = $this->request->data['fondimgrepeat'];
			$data = array('width' => $width, 'height' => $height, 'border' => $border, 'margin' => $margin, 'padding' => $padding, 'float' => $float, 'fondcolor' => $fondcolor, 'borderradius' => $borderradius, 'textsize' => $textsize, 'textcolor' => $textcolor, 'textalign' => $textalign, 'textgras' => $textgras, 'fondimg' => $fondimg, 'fondimgpos' => $fondimgpos, 'fondimgrepeat' => $fondimgrepeat);
			//
			$this->Graphelement->id=$graphelement_id;
			$this->Graphelement->save($data);
			
			echo json_encode("ok");
			exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
	function ajax_editsize(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$zone = $this->request->data['zone'];
			$width = $this->request->data['width'];
			$height = $this->request->data['height'];
			$result = $this->Graphelement->find('first',
				array( 
					'conditions' => array( 'Graphelement.nom' => $zone),
					'fields' => 'Graphelement.id' ,
					'recursive' => -1
				)
			);
			$graphelement_id = $result["Graphelement"]["id"];
			if (isset($width)){ 
				$width = $this->request->data['width'];
			}
			if (isset($height)){ 
				$height = $this->request->data['height'];
			}
			if (isset($height) && empty($width))
				$data = array('height' => $height);
			else if (isset($width) && empty($height))
				$data = array('width' => $width);
			else
				$data = array('width' => $width, 'height' => $height);
			//
			$this->Graphelement->id=$graphelement_id;
			$this->Graphelement->save($data);
			
			echo json_encode("ok");
			exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
}
