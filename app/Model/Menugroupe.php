<?php
class Menugroupe extends AppModel{
	var $hasMany= array('Menu');
	var $belongsTo= array('Graphelement');
	function view($id=null,$idelement=null,$prefix=null){
		$pages = $this->Menu->find('all',array(
			'conditions' => array( 'Menu.menugroupe_id' => $id ),
			'order' => "Menu.ordre",
			'recursive' => 2
		));
		$this->Menu->Rubrique->locale = Configure::read('Config.language');
		$output = "<ul class='el_block drop subMenu' id='".$prefix.$idelement."'>";
		
		foreach ($pages as $e){
			$this->Menu->Rubrique->bindTranslation(array('nom','url'));
			$rub = $this->Menu->Rubrique->find('first',array(
				'conditions' => array( 'Rubrique.id' => $e["Rubrique"]["id"] )
			));
			if(Configure::read('Parameter.scrollnav')){
				$href = '<a href="#" id="r_'.$rub["Rubrique"]["id"].'" class="subNavBtn">';
			}else if($rub["Rubrique"]["contenutype_id"]==1){
				//$output .= "<li class='elb_menu ".$e["Menugroupe"]["Graphelement"]["nom"]."'><a href='".Configure::read('Parameter.prefix')."/rubriques/view/".$rub["Rubrique"]["id"]."'><span>".$rub["Rubrique"]["nom"]."</span></a></li>";
				if(!empty($rub['Rubrique']['url'])){
					$titre_attendu = strtolower(Inflector::slug($rub['Rubrique']['url'], '-'));
				}else{
					$titre_attendu = strtolower(Inflector::slug($rub['Rubrique']['nom'], '-'));
				}
				$url = Configure::read('Parameter.prefix')."/p/".$rub["Rubrique"]["id"]."/".$titre_attendu;
				$href = "<a href='".$url."'>";
			}else if($rub["Rubrique"]["contenutype_id"]==2){
				$url = $rub["Rubrique"]["url"];
				$href = "<a href='".$url."' target='_blank'>";
			}else{
				$url = "";
				$href = "<a>";
			}
				if($e["Menugroupe"]["Graphelement"]["float"]!="left"){
					$align = "vert";
				}else{
					$align = "hori";
				}
				
				$this->Menu->Rubrique->bindTranslation(array('nom','url'));
				$pages2 = $this->Menu->Rubrique->find('all',array(
					'conditions' => array( 'Rubrique.parent' => $e["Rubrique"]["id"] )
				));
				$sousactif=false;
				foreach ($pages2 as $e2){
					if(Configure::read('Page.id')==$e2["Rubrique"]["id"]){
						$sousactif=true;
						break;
					}
				}
				if(Configure::read('Page.id')==$e["Rubrique"]["id"] || $sousactif)
					$output .= "<li class='elb_menu sub actif ".$align." ".$e["Menugroupe"]["Graphelement"]["nom"]."'>";
				else
					$output .= "<li class='elb_menu sub ".$align." ".$e["Menugroupe"]["Graphelement"]["nom"]."'>";
				$output .= $href."<span>";
				if(empty($rub['Rubrique']['img_btn'])){
					$output .= $rub["Rubrique"]["nom"];
				}else{
					if(Configure::read('Page.id')==$rub["Rubrique"]["id"]){
						$output .= "<img src='".Configure::read('Parameter.prefix')."/img/general/boutons/".$rub["Rubrique"]["img_btn_actif"]."' alt='".$rub["Rubrique"]["nom"]."' />";
					}else{
						$output .= "<img src='".Configure::read('Parameter.prefix')."/img/general/boutons/".$rub["Rubrique"]["img_btn"]."' alt='".$rub["Rubrique"]["nom"]."' />";
					}
					
				}
				$output .= "</span></a>";
				
				if(!empty($pages2)){
					$output .= "<ul>";
					foreach ($pages2 as $e2){
						if(Configure::read('Page.id')==$e2["Rubrique"]["id"])
							$output .= "<li class='elb_menu sub actif ".$e["Menugroupe"]["Graphelement"]["nom"]."'>";
						else
							$output .= "<li class='elb_menu sub ".$e["Menugroupe"]["Graphelement"]["nom"]."'>";
						if(Configure::read('Parameter.scrollnav'))
							$href = '<a href="#" id="r_'.$e2["Rubrique"]["id"].'" class="subNavBtn">'.$e2["Rubrique"]["nom"]."</a></li>";
						else if($rub["Rubrique"]["contenutype_id"]==2)
							$output .= "<a href='".$e2["Rubrique"]["url"]."' target='_blank'>".$e2["Rubrique"]["nom"]."</a></li>";
						else
							$output .= "<a href='".Configure::read('Parameter.prefix')."/rubriques/view/".$e2["Rubrique"]["id"]."'>".$e2["Rubrique"]["nom"]."</a></li>";
					}
					$output .= "</ul>";
				}
				$output .= "</li>";
			
		}
		$output .= "<div class='clear'></div></ul>";
		return $output;
	}
	function getMenuMobile(){
		$pages = $this->Menu->find('all',array(
			'conditions' => array( 'Menugroupe.mobile' => true ),
			'order' => "Menu.ordre",
			'recursive' => 2
		));
		$this->Menu->Rubrique->locale = Configure::read('Config.language');
		$output = "<nav id='navigation' class='clear' role='navigation'>";
		$output .= '<label for="toggle-menu" data-icon="≡" title="menu" role="navigation" onclick=""></label>';
		$output .= '<input type="checkbox" id="toggle-menu">';
		$output .= "<ul class='mw' id='ze_mobile' style='max-height:0;overflow:hidden'>";
		
		foreach ($pages as $e){
			$this->Menu->Rubrique->bindTranslation(array('nom','url'));
			$rub = $this->Menu->Rubrique->find('first',array(
				'conditions' => array( 'Rubrique.id' => $e["Rubrique"]["id"] )
			));
			
			if($rub["Rubrique"]["contenutype_id"]==1){
				if(!empty($rub['Rubrique']['url'])){
					$titre_attendu = strtolower(Inflector::slug($rub['Rubrique']['url'], '-'));
				}else{
					$titre_attendu = strtolower(Inflector::slug($rub['Rubrique']['nom'], '-'));
				}
				$url = Configure::read('Parameter.prefix')."/p/".$rub["Rubrique"]["id"]."/".$titre_attendu;
				$href = "<a href='".$url."'>";
			}else if($rub["Rubrique"]["contenutype_id"]==2){
				$url = $rub["Rubrique"]["url"];
				$href = "<a href='".$url."' target='_blank'>";
			}else{
				$url = "";
				$href = "<a>";
			}
				if($e["Menugroupe"]["Graphelement"]["float"]!="left"){
					$align = "vert";
				}else{
					$align = "hori";
				}
				
				$this->Menu->Rubrique->bindTranslation(array('nom','url'));
				$pages2 = $this->Menu->Rubrique->find('all',array(
					'conditions' => array( 'Rubrique.parent' => $e["Rubrique"]["id"] )
				));
				$sousactif=false;
				foreach ($pages2 as $e2){
					if(Configure::read('Page.id')==$e2["Rubrique"]["id"]){
						$sousactif=true;
						break;
					}
				}
				if(Configure::read('Page.id')==$e["Rubrique"]["id"] || $sousactif)
					$output .= "<li class='mw actif'>";
				else
					$output .= "<li class='mw '>";
				$output .= $href."<span>".$rub["Rubrique"]["nom"];
				$output .= "</span></a>";
				
				if(!empty($pages2)){
					$output .= "<ul>";
					foreach ($pages2 as $e2){
						if(Configure::read('Page.id')==$e2["Rubrique"]["id"])
							$output .= "<li class='elb_menu mw sub actif ".$e["Menugroupe"]["Graphelement"]["nom"]."'>";
						else
							$output .= "<li class='elb_menu mw sub ".$e["Menugroupe"]["Graphelement"]["nom"]."'>";
						if($rub["Rubrique"]["contenutype_id"]==2)
							$output .= "<a href='".$e2["Rubrique"]["url"]."' target='_blank'>".$e2["Rubrique"]["nom"]."</a></li>";
						else
							$output .= "<a href='".Configure::read('Parameter.prefix')."/rubriques/view/".$e2["Rubrique"]["id"]."'>".$e2["Rubrique"]["nom"]."</a></li>";
					}
					$output .= "</ul>";
				}
				$output .= "</li>";
			
		}
		$output .= "<div class='clear'></div></ul></nav>";
		return $output;
	}
}
?>