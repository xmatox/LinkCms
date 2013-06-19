<?php
class Galeriesphoto extends AppModel{
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'contenu'=>'_contenu'
		)
	);
	// liaisons
	var $hasMany = array('Galeriesphotoelement');
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null,$var=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$this->bindTranslation(array('contenu'));
		$this->locale = Configure::read('Config.language');
		$pages = $this->find('first',array(
			'conditions' => array( 'Galeriesphoto.id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."gp".$id."'>";
		if (!empty($var)) {
			$output .= "<script language='javascript' src='".Configure::read('Parameter.prefix')."/js/jquery/lightbox/lightbox.js'></script>";
			$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/js/jquery/lightbox/lightbox.css' />";
			$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/galeriesphotos/css/galeriesphoto.css' />";
			$output .= "<a href='../' ><< Retour</a><br/>";
			$pagesel = $this->Galeriesphotoelement->find('first',array(
				'conditions' => array( 'Galeriesphotoelement.id' => $var ),
				'recursive' => -1,
				'autocache' => $autocache
			));
			$galerie = $pagesel["Galeriesphotoelement"];
			if(!empty($galerie["contenu"])){
				$output .= "<div>".$galerie["contenu"]."<div class='clear'></div></div>";
			}
			
			$id=$galerie["id"];
			// Import de la classe Folder
			App::uses('Folder', 'Utility');
			// Nouvelle instance de classe avec le répertoire choisi
			$path = "img/galeries/".$id."/";
			$dir = new Folder($path);
			$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
			$jpg_nb = count($jpg_files);
			
			foreach($jpg_files as $file){
				$output .= "<div class='galeriep'><a href='".Configure::read('Parameter.prefix')."/img/galeries/".$id."/".$file."' rel='lightbox[galeries]' ><img src='".Configure::read('Parameter.prefix')."/img/galeries/".$id."/".$file."' alt='".$file."' /></a></div>";
					
			}
		}else{
			$pagesel = $this->Galeriesphotoelement->find('all',array(
				'conditions' => array( 'Galeriesphotoelement.galeriesphoto_id' => $id ),
				'recursive' => -1,
				'autocache' => $autocache
			));
			$nbgal = count($pagesel);
			if($nbgal<1){
				$output .= "Pas de galerie";
			}else if($nbgal==1){
				$galerie = $pagesel[0]["Galeriesphotoelement"];
				$id=$galerie["id"];
				// Import de la classe Folder
				App::uses('Folder', 'Utility');
				// Nouvelle instance de classe avec le répertoire choisi
				$path = "img/galeries/".$id."/";
				$dir = new Folder($path);
				$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
				$jpg_nb = count($jpg_files);
				$output .= "<script language='javascript' src='".Configure::read('Parameter.prefix')."/js/jquery/lightbox/lightbox.js'></script>";
				$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/js/jquery/lightbox/lightbox.css' />";
				$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/galeriesphotos/css/galeriesphoto.css' />";
				if(!empty($galerie["contenu"])){
					$output .= "<div>".$galerie["contenu"]."<div class='clear'></div></div>";
				}
				foreach($jpg_files as $file){
					$output .= "<div class='galeriep'><a href='".Configure::read('Parameter.prefix')."/img/galeries/".$id."/".$file."' rel='lightbox[galeries]' ><img src='".Configure::read('Parameter.prefix')."/img/galeries/".$id."/".$file."' alt='".$file."' /></a></div>";
					
				}
				
			}else{
				$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/galeriesphotos/css/galeriesphoto.css' />";
				if(!empty($pages["Galeriesphoto"]["contenu"])){
						$output .= "<div>".$pages["Galeriesphoto"]["contenu"]."<div class='clear'></div></div>";
					}
				foreach ($pagesel as $gp) {
					
					$galerie = $gp["Galeriesphotoelement"];
					
					$id=$galerie["id"];
					$selection=$galerie["selection"];
					$nom=$galerie["nom"];
					$output .= "<div class='galerieps'><a href='".$id."/photos-".Inflector::slug($nom, '-')."'><img src='".Configure::read('Parameter.prefix')."/img/galeries/".$id."/".$selection."' alt='".$selection."' /></a>".$nom."</div>";
					
				}
			}
		}
		
		$output .= "</div>";
		return $output;
	}
}
?>