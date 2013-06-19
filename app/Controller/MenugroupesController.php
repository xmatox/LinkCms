<?php
class MenugroupesController extends AppController {
	public $helpers = array('Js');
	function mobile(){
		return $this->Menugroupe->getMenuMobile();
		exit;
	}
	function admin_edit($id=null){
		if (!empty($this->data)) {
			if(!isset($id)){
				
				$this->Menugroupe->Graphelement->create();
				$dat = array('nom' => "menu_".$this->data["Menugroupe"]["nom"], 'active' => true);
				$this->Menugroupe->Graphelement->save($dat);
				$graphelement_id = $this->Menugroupe->Graphelement->id;
				
				$this->Menugroupe->Graphelement->create();
				$dat = array('nom' => "menu_".$this->data["Menugroupe"]["nom"]."_roll", 'active' => true);
				$this->Menugroupe->Graphelement->save($dat);
				//
				$data = array('nom' => $this->data["Menugroupe"]["nom"], 'graphelement_id' => $graphelement_id);
			}else{
				$data = $this->data;
			}
			if ($this->Menugroupe->save($data)) {
				$this->Session->setFlash(__('Le Menu à bien été enregistré', true));
				//$this->redirect(array('action' => 'list'));
			} else {
				$this->Session->setFlash(__('The Menu could not be saved. Please, try again.', true));
			}
		}
		if(isset($id)){
			$this->data = $this->Menugroupe->read(null, $id);
		}
		
		
	}
	function admin_list(){
		$groupe = $this->Menugroupe->find('all',array(
				"recursive" => -1
			));
		$this->set('groupe', $groupe);
		
	}
	function admin_suprim($id = null) {
		if (!$id) {
			$this->Session->setFlash(__("Id invalide dour le menu", true));
			//$this->redirect($this->referer());
		}
		$groupe = $this->Menugroupe->find('first',array(
			'conditions' => array( 'Menugroupe.id' => $id),
			'fields' => 'Menugroupe.graphelement_id' ,
			"recursive" => -1
		));
		$graphelement_id = $groupe["Menugroupe"]["graphelement_id"];
		$this->Menugroupe->Graphelement->delete($graphelement_id);
		$this->Menugroupe->Graphelement->delete($graphelement_id+1);
		if ($this->Menugroupe->delete($id)) {
			$this->Session->setFlash(__("Le menu a bien été supprimé", true));
			//$this->redirect($this->referer());
		}
		else
		$this->Session->setFlash(__("Le menu n'a pas pu être supprimé.", true));
		//$this->redirect($this->referer());
	}
	
	function ajax_setmobile(){
		if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$this->Menugroupe->updateAll(
			    array('Menugroupe.mobile' => false),
			    array('Menugroupe.mobile' => true)
			);
			$data = array('mobile' => true);
			$this->Menugroupe->id=$id;
			$this->Menugroupe->save($data);
            echo json_encode($id);
            exit();
		} 
	}
	function ajax_actuvisu(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
			$id = $this->request->data['id'];
			$idgroupe = $this->request->data['idgroupe'];
			$result = $this->Menugroupe->Graphelement->find('first',
				array( 
					'conditions' => array( 'Graphelement.id' => $id),
					'recursive' => -1
				)
			);
			$result2 = $this->Menugroupe->Graphelement->find('first',
				array( 
					'conditions' => array( 'Graphelement.id' => $id+1),
					'recursive' => -1
				)
			);
			$pages = $this->Menugroupe->view($idgroupe);
			$this->set('pages', $pages);
			$aresult = array("css"=>$result,"cssroll"=>$result2,"menu"=>$pages);
            echo json_encode($aresult);
            exit();
        
		} 
	}
	function ajax_saveform(){
		 // Cas des requêtes AJAX
        if ( $this->request->is( 'ajax' ) ) {
		
			$id = $this->request->data['id'];
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
			$textfont = $this->request->data['textfont'];
			$fondimg = $this->request->data['fondimg'];
			$fondimgpos = $this->request->data['fondimgpos'];
			$fondimgrepeat = $this->request->data['fondimgrepeat'];
			$etats = $this->request->data['etats'];
			if($etats=="roll") $id = $id+1;
			$data = array('width' => $width, 'height' => $height, 'border' => $border, 'margin' => $margin, 'padding' => $padding, 'float' => $float, 'fondcolor' => $fondcolor, 'borderradius' => $borderradius, 'textsize' => $textsize, 'textcolor' => $textcolor, 'textalign' => $textalign, 'textgras' => $textgras, 'textfont' => $textfont, 'fondimg' => $fondimg, 'fondimgpos' => $fondimgpos, 'fondimgrepeat' => $fondimgrepeat);
			//
			$this->Menugroupe->Graphelement->id=$id;
			$this->Menugroupe->Graphelement->save($data);
			
			echo json_encode("ok");
			exit();
        
		} else {
			// Code qui servirait dans le cas de requêtes http classiques (par opposition à AJAX)
			// Pour nous dans cet exemple, c'est inutile...
		}
	}
}
