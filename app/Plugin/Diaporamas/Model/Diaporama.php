<?php
class Diaporama extends AppModel{
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'contenu'=>'_contenu'
		)
	);
	var $validate = array(
		'width' => array(
			'rule' => 'numeric',
			'required' => true,
			'allowEmpty' => false,
			'message' => "Vous devez spécifier une largeur"
		),
		'height' => array(
			'rule' => 'numeric',
			'required' => true,
			'allowEmpty' => false,
			'message' => "Vous devez spécifier une hauteur"
		)
	);
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$this->bindTranslation(array('contenu'));
		$this->locale = Configure::read('Config.language');
		$pages = $this->find('first',array(
			'conditions' => array( 'Diaporama.id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		//debug($pages);
		if(!empty($pages["Diaporama"]["url"])){
			if($pages["Diaporama"]["url"]=="/") $url = Configure::read('Parameter.prefix');
			else $url = $pages["Diaporama"]["url"];
			$liendebut = "<a href='".$url."'>";
			$lienfin = "</a>";
		}else{
			$liendebut = "";
			$lienfin = "";
		}
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// Nouvelle instance de classe avec le répertoire choisi
		$path = "img/diaporamas/".$id."/";
		$dir = new Folder($path);
		$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
		$jpg_nb = count($jpg_files);
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."d".$id."'>";
		if(!empty($pages["Diaporama"]["contenu"])){
			$output .= "<div>".$pages["Diaporama"]["contenu"]."<div class='clear'></div></div>";
		}
		if($jpg_nb>1){
			$output .= "<div id='ze_diap".$idelement."' style='height: ".$pages["Diaporama"]["height"]."px; width: ".$pages["Diaporama"]["width"]."px; overflow: hidden;'>";
			$output .= "<ul style='margin:0'>";
			//$output .= $pages["Diaporama"]["nom"];
			foreach($jpg_files as $file){
				$output .= "<li style='list-style-type:none;margin:0;height: ".$pages["Diaporama"]["height"]."px;'>".$liendebut."<img src='".Configure::read('Parameter.prefix')."/img/diaporamas/".$id."/".$file."' alt='".$file."' />".$lienfin."</li>";
			}
			$output .= "</ul></div><div class='clear'></div>";
			if(!empty($pages["Diaporama"]["speed"])) $speed = $pages["Diaporama"]["speed"]; else $speed = 1000;
			if(!empty($pages["Diaporama"]["pause"])) $pause = $pages["Diaporama"]["pause"]; else $pause = 5000;
			if(!empty($pages["Diaporama"]["scroll"])){
				if($pages["Diaporama"]["scroll"]=="vertical"){
					$fade = "false";
					$vertical = "true";
				}else if($pages["Diaporama"]["scroll"]=="fade"){
					$fade = "true";
					$vertical = "false";
				}else{
					$fade = "false";
					$vertical = "false";
				}
			}else{ 
				$fade = "false";
				$vertical = "false";
			}
			$output .= "<script type='text/javascript'>$(document).ready(function() {
					var sudoSlider = $('#ze_diap".$idelement."').sudoSlider({ 
						auto:true,
						pause: '".$pause."',
						speed: '".$speed."',
						prevNext:false,
						fade: ".$fade.",
						vertical:".$vertical.",
						numeric:false
					});
				});</script>";
				
		}else if($jpg_nb==1){
			foreach($jpg_files as $file){
				$output .= $liendebut."<img src='".Configure::read('Parameter.prefix')."/img/diaporamas/".$id."/".$file."' alt='".$file."' />".$lienfin;
			}
		}else{
			$output = "";
		}
		$output .= "</div>";
		return $output;
	}
}
?>