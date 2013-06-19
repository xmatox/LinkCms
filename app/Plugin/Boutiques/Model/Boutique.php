<?php
class Boutique extends AppModel{
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'nom'=>'_nom',
			'desclong'=>'_desclong'
		)
	);
	// liaisons
	var $hasMany = array('Boutiquecat');
	// validations
	var $validate = array(
		'nom' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "Le nom est obligatoire"
		),
		'paypal' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'allowEmpty' => false,
			'message' => "Le compte paypal est obligatoire"
		)
	);
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null,$var=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$this->bindTranslation(array('nom','desclong'));
		$this->locale = Configure::read('Config.language');
		$pages = $this->find('first',array(
			'conditions' => array( 'Boutique.id' => $id ),
			//'recursive' => -1,
			'autocache' => $autocache
		));
		$nbcat = count($pages["Boutiquecat"]);
		if($nbcat>1) $cat=true;
		else $cat=false;
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."bk".$id."'>";
		if (!empty($var)) {
			if ($var!="cat") {
				$avar = explode("-", $var);
				$nbvar = count($avar);
				if ($nbvar==3 || $var=="cart") {
					$output2 = $this->getcaddie($output,$id);
				}else if ($nbvar==2) {
					$output2 = $this->getfiche($output,$id,$avar[1],$cat);
				}else{
					$output2 = $this->getproduit($output,$id,$var,$var,$cat);
					
				}
				
			}else{
				$output2 = $this->getcat($output,$id,$pages);
			}
		}else{
			$output2 = $this->getcaddieshort($output,$id,$idelement);
		}
		$output2 .= "</div>";
		return $output2;
	}
	function getcat($output,$id=null,$pages=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$pagesel = $this->Boutiquecat->find('all',array(
			'conditions' => array( 'Boutiquecat.boutique_id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		$nbgal = count($pagesel);
		if($nbgal<1){
			$output .= __d('boutiques', 'Pas de catégories');
		}
		else if($nbgal==1){
			foreach ($pagesel as $bk) {
				
				$boutiquecat = $bk["Boutiquecat"];
				
				$bid=$boutiquecat["id"];
				$photo=$boutiquecat["photo"];
				$nom=$boutiquecat["nom"];

				$output2 = $this->getproduit($output,$id,$nom,$bid,false);
				$output = $output2;
				//$output = $this->redirect($id."-".$bid."/".$nom);
				//$output = '<script type="text/javascript">window.location.href="'.$bid.'/'.Inflector::slug($nom, '-').'";</script>';
			}
		}
		else{
			$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/boutiques/css/boutiques.css' />";
			if(!empty($pages["Boutique"]["desclong"])){
					$output .= "<div>".$pages["Boutique"]["desclong"]."<div class='clear'></div></div>";
				}
			foreach ($pagesel as $bk) {
				
				$boutiquecat = $bk["Boutiquecat"];
				
				$bid=$boutiquecat["id"];
				$photo=$boutiquecat["photo"];
				$nom=$boutiquecat["nom"];
				$desccourt=$boutiquecat["desccourt"];
				$desccourt = strip_tags($desccourt, '<strong><i><b><u><em>');
				if (empty($photo)) {
					$urlimg = Configure::read('Parameter.prefix')."/img/nophoto.jpg";
				}else{
					$urlimg = Configure::read('Parameter.prefix')."/img/boutiques/".$id."/".$photo;
				}
				
				App::uses('String', 'Utility');
				$desccourt = String::truncate(
				    $desccourt,
				    90,
				    array(
				        'ellipsis' => '...',
				        'exact' => false,
				        'html' => true
				    )
				);
				//$output .= "<div class='bkcat'><a href='".$id."/photos-".Inflector::slug($nom, '-')."'><img src='".Configure::read('Parameter.prefix')."/img/galeries/".$id."/".$selection."' alt='".$selection."' /></a>".$nom."</div>";
				$output .= "<div class='bkcat'>";
				$output .= "<a href='".$bid."/".Inflector::slug($nom, '-')."'><img src='".$urlimg."' alt='".$nom."' /></a>";
				$output .= "<a class='bkc_titre' href='".$bid."/".Inflector::slug($nom, '-')."'>".$nom."</a>";

				$output .= "<a class='bkc_text' href='".$bid."/".Inflector::slug($nom, '-')."'>".$desccourt."</a>";
				$output .= "</div>";
				
			}
		}
		return $output;
	}
	function getproduit($output,$id=null,$idelement=null,$var=null,$cat=true){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/boutiques/css/boutiques.css' />";
		if($cat)
		$output .= "<a href='../' ><< ".__d('boutiques', 'Retour')."</a><br/>";
		$this->setlink();
		$pagesel = $this->Boutiquecat->find('first',array(
			'conditions' => array( 'Boutiquecat.id' => $var ),
			'contain' => array("Boutiqueproduit"),
			'autocache' => $autocache
		));
		$idcat=$pagesel["Boutiquecat"]["id"];
		$desccat=$pagesel["Boutiquecat"]["desclong"];
		/*$nomcat=$pagesel["Boutiquecat"]["nom"];
		$output .= "<h2><a href='../' >".$nomcat."</a></h2><br/>";*/
		foreach ($pagesel["Boutiqueproduit"] as $boutiquecat) {
			if(!empty($desccat)){
				$output .= "<div>".$desccat."<div class='clear'></div></div>";
			}
			
			$bid=$boutiquecat["id"];
			$photo=$boutiquecat["photo"];
			$nom=$boutiquecat["nom"];
			$prix=$boutiquecat["prix"];
			$desccourt=$boutiquecat["desccourt"];
			$desccourt = strip_tags($desccourt, '<strong><i><b><u><em>');
			App::uses('String', 'Utility');
			$desccourt = String::truncate(
			    $desccourt,
			    90,
			    array(
			        'ellipsis' => '...',
			        'exact' => false,
			        'html' => true
			    )
			);
			if (empty($photo)) {
				$urlimg = Configure::read('Parameter.prefix')."/img/nophoto.jpg";
			}else{
				$urlimg = Configure::read('Parameter.prefix')."/img/boutiques/".$id."/".$idcat."/".$bid."/".$photo;
			}
			if($cat==true){
				$urllink = "../".$idcat."-".$bid."/".Inflector::slug($nom, '-');
			}else{
				$urllink = $idcat."-".$bid."/".Inflector::slug($nom, '-');
			}
			//$output .= "<div class='bkcat'><a href='".$id."/photos-".Inflector::slug($nom, '-')."'><img src='".Configure::read('Parameter.prefix')."/img/galeries/".$id."/".$selection."' alt='".$selection."' /></a>".$nom."</div>";
			$output .= "<div class='bkcat'>";
			$output .= "<a href='".$urllink."'><img src='".$urlimg."' alt='".$nom."' /></a>";
			$output .= "<a class='bkc_titre' href='".$urllink."'>".$nom." - ".$prix." €</a>";

			$output .= "<a class='bkc_text' href='".$urllink."'>".$desccourt."</a>";
			$output .= "</div>";
		}
		
		return $output;
	}
	function getfiche($output,$id,$idprod,$cat){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/boutiques/css/boutiques.css' />";
		$output .= "<script type='text/javascript' src='".Configure::read('Parameter.prefix')."/boutiques/js/boutiques.js'></script>";
		$output .= "<script type='text/javascript' src='".Configure::read('Parameter.prefix')."/boutiques/js/galerieview/jquery.easing.1.3.js'></script>";
		$output .= "<script type='text/javascript' src='".Configure::read('Parameter.prefix')."/boutiques/js/boutique.js'></script>";
		$output .= "<script type='text/javascript' src='".Configure::read('Parameter.prefix')."/boutiques/js/galerieview/jquery.galleryview-3.0-dev.js'></script>";
		$output .= "<script type='text/javascript' src='".Configure::read('Parameter.prefix')."/boutiques/js/galerieview/jquery.timers-1.2.js'></script>";
		$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/boutiques/js/galerieview/jquery.galleryview-3.0-dev.css' />";
		$this->setlink();
		$pagesel = $this->Boutiquecat->Boutiqueproduit->find('first',array(
			'conditions' => array( 'Boutiqueproduit.id' => $idprod ),
			'autocache' => $autocache
		));
		$boutiquecat = $pagesel["Boutiquecat"];
		$idcat=$boutiquecat["id"];
		$nomcat=$boutiquecat["nom"];
		if($cat) $output .= "<a href='../".$idcat."/".Inflector::slug($nomcat, '-')."' ><< ".__d('boutiques', 'Retour')."</a><br/><br/>";
		else $output .= "<a href='../".Inflector::slug($nomcat, '-')."' ><< ".__d('boutiques', 'Retour')."</a><br/><br/>";
		$boutiqueprod = $pagesel["Boutiqueproduit"];
		$photo=$boutiqueprod["photo"];
		$nom=$boutiqueprod["nom"];
		$prix=$boutiqueprod["prix"];
		$desccourt=$boutiqueprod["desccourt"];
		$desclong=$boutiqueprod["desclong"];
		$boutiquecat_id=$boutiqueprod["boutiquecat_id"];
		//$output .= "<div class='bkp_img'><img src='".Configure::read('Parameter.prefix')."/img/boutiques/".$id."/".$boutiquecat_id."/".$idprod."/".$photo."' alt='".$photo."' /></div>";
		// Import de la classe Folder
		App::uses('Folder', 'Utility');
		// Nouvelle instance de classe avec le répertoire choisi
		$path = "img/boutiques/".$id."/".$boutiquecat_id."/".$idprod."/";
		$dir = new Folder($path);
		$jpg_files = $dir->find('.+\.jpg|.+\.png|.+\.gif');
		$jpg_nb = count($jpg_files);
		$output .= "<div class='bkp_img'><ul id='photoprod'>";
		if ($jpg_nb>0) {
			foreach($jpg_files as $file){
				$output .= "<li><img src='".Configure::read('Parameter.prefix')."/img/boutiques/".$id."/".$boutiquecat_id."/".$idprod."/".$file."' alt='".$file."' /></li>";
			}
		}else{
			$output .= "<li><img src='".Configure::read('Parameter.prefix')."/img/nophoto.jpg' alt='nophoto' /></li>";
		}
		$output .= "</ul></div>";
		$output .= "<div class='bkp_textes mod' id='addcaddieid' data-value='".$id."'>";
		$output .= "<div class='bkp_titre' id='addcaddieidprod' data-value='".$idprod."'><h1>".$nom."</h1></div>";
		$output .= "<div class='separation'></div>";
		$output .= "<div class='bkp_text'>".$desccourt."</div>";
		$output .= "<div class='separation'></div>";
		$output .= "<div class='bkp_prix'>".$prix." €</div>";
		$output .= "<div class='clear'></div>";
		$urlcaddie = "../".$boutiquecat_id."-".$idprod."-cart/".Inflector::slug($nom, '-');
		$output .= "<div class='bkp_caddie' id='addcaddie' data-value='".$urlcaddie."'>".__d('boutiques', 'Add to Cart')."</div>";
		$output .= "<div class='bkp_caddie' style='margin-right:10px;'><a href='../cart/view' style='color:#fff;'>".__d('boutiques', 'Go to Cart')."</a></div>";
		$output .= "</div>";
		$output .= "<div class='clear'></div>";
		$output .= "<div class='separation'></div>";
		$output .= "<div class='bkp_text'>".$desclong."</div>";
		$output .= "<script type='text/javascript'>
					$(document).ready(function(){	
						$('#photoprod').galleryView({
							panel_width: 300,
							panel_height: 300,
							frame_width: 60,
							frame_height: 60,
						    show_filmstrip_nav: false
						});
						$('#addcaddie').click(function(e){
							addcaddie($('#addcaddieid').attr('data-value'),$('#addcaddieidprod').attr('data-value'),$('#addcaddie').attr('data-value'));
						});
					});
					</script>";
		return $output;
	}
	function getcaddie($output,$id){
		$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/boutiques/css/boutiques.css' />";
		$output .= "<script type='text/javascript' src='".Configure::read('Parameter.prefix')."/boutiques/js/boutiques.js'></script>";
		$output .= "<script type='text/javascript'>
					$(document).ready(function(){
						getcaddie('".$id."');
					});
					</script>";
		$output .= "<ul id='caddietitre'><li class='c_item'>Item</li><li class='c_prix'>Price</li><li class='c_qty'>Qty</li><li class='c_tot'>Total</li><li class='c_sup'></li></ul>";
		$output .= "<div id='caddiecontent'></div>";
		$output .= "<div class='separation' style='width:90%;margin-right:7%;'></div>";
		$output .= "<div id='caddietotal'></div>";
		$output .= "<div id='caddieship'></div>";
		$output .= "<div class='separation' style='width:90%;margin-right:7%;'></div>";
		$output .= "<div id='caddiecheck'></div>";
		return $output;
	}
	function getcaddieshort($output,$id,$idelement){
		$output .= "<link rel='stylesheet' type='text/css' href='".Configure::read('Parameter.prefix')."/boutiques/css/boutiques.css' />";
		$output .= "<script type='text/javascript' src='".Configure::read('Parameter.prefix')."/boutiques/js/boutiques.js'></script>";
		$output .= "<script type='text/javascript'>
					$(document).ready(function(){
						getcaddieshort('".$id."','".$idelement."');
					});
					</script>";
		$output .= "<div id='cs_content_".$idelement."'></div>";
		$output .= "<div class='clear'></div>";
		
		return $output;
	}
	function setlink(){
		$this->Boutiquecat->bindModel(
			array('hasMany' => array(
					'Boutiqueproduit' => array(
						'className' => 'Boutiqueproduit'
					)
				)
			)
		);
		$this->Boutiquecat->Boutiqueproduit->bindModel(
			array('belongsTo' => array(
					'Boutiquecat' => array(
						'className' => 'Boutiquecat'
					)
				)
			)
		);
	}
}
?>