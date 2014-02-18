<?php
class Evenement extends AppModel{
	// liaisons
	var $hasMany = array('Evenementelement');
	public $actsAs = array('Autocache');
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$pages = $this->find('first',array(
			'conditions' => array( 'Evenement.id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."ev".$id."'>";
		
			$output .='<div style="background-color:#eeeeee;opacity:0.4; filter:alpha(opacity=40);margin-right:10px;font-weight:bold;padding:5px;font-size:12px;color:#333;">Prochains '.$pages["Evenement"]["nom"].'</div>';
			$showNext = $this->Evenementelement->find('all',array(
				'conditions' => array( 'Evenementelement.evenement_id' => $id, 'date >= CURRENT_DATE()' ),
				'fields' => array('lieu','info','infosup','lien',"date",'DATE_FORMAT(date, "%d/%m/%Y") AS showdate') ,
				'order' => "date ASC",
				'autocache' => $autocache
			));
			$i=0;
			foreach($showNext as $f){
				$i++;
				$output .="<div style='margin:10px;margin-left:50px'>";
					$output .="<b>le ".$f[0]["showdate"]." : ".$f["Evenementelement"]["lieu"]."</b> ";
					if($f["Evenementelement"]["info"]) $output .= $f["Evenementelement"]["info"];
					if($f["Evenementelement"]["lien"]) $output .= " <a href='".$f["Evenementelement"]["lien"]."'>".$f["Evenementelement"]["lien"]."</a>";
					if($f["Evenementelement"]["infosup"]){
						$output .= '<div style="float:right"><a href="#" onClick="$(\'#evf'.$i.'\').toggle(\'slow\');return false;">+ d\'infos</a></div>';
						$output .= "<div id='evf".$i."' style='display:none;margin-top:5px;'>".$f["Evenementelement"]["infosup"]."</div>";
						$output .= "<div class='clear'></div>";
					}
					
				$output .="</div>";
				$output .="<div style='height:1px;background-color:#D6D6D6;margin-left:10px;margin-right:20px;'></div>";
			}
			
			$output .='<div style="background-color:#eeeeee;opacity:0.4; filter:alpha(opacity=40);margin-right:10px;font-weight:bold;padding:5px;font-size:12px;color:#333;">'.$pages["Evenement"]["nom"].' Passés</div>';
			$showPass = $this->Evenementelement->find('all',array(
				'conditions' => array( 'Evenementelement.evenement_id' => $id, 'date < CURRENT_DATE()' ),
				'fields' => array('lieu','info','lien',"date",'DATE_FORMAT(date, "%d/%m/%Y") AS showdate') ,
				'order' => "date DESC",
				'autocache' => $autocache
			));
			foreach($showPass as $f){
				$output .="<div style='margin:10px;margin-left:50px'>";
					$output .="<b>le ".$f[0]["showdate"]." : ".$f["Evenementelement"]["lieu"]."</b> ";
					if($f["Evenementelement"]["info"]) $output .= $f["Evenementelement"]["info"];
					if($f["Evenementelement"]["lien"]) $output .= " <a href='".$f["Evenementelement"]["lien"]."'>".$f["Evenementelement"]["lien"]."</a>";
					$output .="<br/>";
				$output .="</div>";
				$output .="<div style='height:1px;background-color:#D6D6D6;margin-left:10px;margin-right:20px;'></div>";
			}
		$output .= "</div>";
		return $output;
	}
	// retourne infos plugin
	function getName($id=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$pages = $this->find('first',array(
			'conditions' => array( 'Evenement.id' => $id ),
			'recursive' => -1,
			'fields' => array("nom"),
			'autocache' => $autocache
		));
		return $pages["Evenement"]["nom"];
	}
	// fonction ajout d'un nouvel élément par défaut
	function savenew(){
		$this->create();
		$dat = array('nom' => "Evènement");
		$this->save($dat);
		$id = $this->id;
		$this->Evenementelement->create();
		$dat = array('date' => date("Y-m-d"),'lieu' => "Lieu",'info' => "Texte Information ",'infosup' => "",'lien' => "",'evenement_id' => $id);
		$this->Evenementelement->save($dat);
		return $id;
	}
}
?>