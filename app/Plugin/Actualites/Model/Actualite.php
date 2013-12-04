<?php
class Actualite extends AppModel{
	// liaisons
	var $hasMany = array('Actualiteelement');

	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$pages = $this->find('first',array(
			'conditions' => array( 'Actualite.id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."ac".$id."'>";
			
			$showNext = $this->Actualiteelement->find('all',array(
				'conditions' => array( 'Actualiteelement.actualite_id' => $id ),
				'fields' => array('titre','contenu',"date",'DATE_FORMAT(date, "%d/%m/%Y") AS showdate') ,
				'order' => "date DESC",
				'autocache' => $autocache
			));
			foreach($showNext as $f){
				$output .='<div style="background-color:#eeeeee;opacity:0.4; filter:alpha(opacity=40);margin-right:10px;font-weight:bold;padding:5px;font-size:12px;color:#333;">'.$f["Actualiteelement"]["titre"]." - le ".$f[0]["showdate"].'</div>';
				$output .="<div style='margin:10px;margin-left:50px'>";
				$output .=$f["Actualiteelement"]["contenu"];
				$output .="</div>";
				
				$output .= "<div class='clear'></div>";
				
				$output .="<div style='height:1px;background-color:#D6D6D6;margin-left:10px;margin-right:20px;'></div>";
			}
			
		$output .= "</div>";
		return $output;
	}
	// fonction ajout d'un nouvel élément par défaut
	function savenew(){
		$this->create();
		$dat = array('nom' => "Actualité");
		$this->save($dat);
		$id = $this->id;
		$this->Actualiteelement->create();
		$dat = array('date' => date("Y-m-d"),'titre' => "Titre News",'contenu' => "Texte de votre news ...",'actualite_id' => $id);
		$this->Actualiteelement->save($dat);
		return $id;
	}
}
?>