<?php
class Language extends AppModel{
	var $belongsTo= array('Graphelement');
	function liste(){
		$langs = $this->find('list',array(
			'conditions' => array("active"=>true),
			'fields' => array("id","prefix"),
			'recursive' => -1
		));
		return $langs;
	}
	function listeadmin(){
		$langs = $this->find('list',array(
			'conditions' => array("admin"=>true),
			'fields' => array("id","prefix"),
			'recursive' => -1
		));
		return $langs;
	}
	function view($id=null,$idelement=null,$params=null,$prefix=null){
		$langs = $this->find('all',array(
			'conditions' => array("active"=>true),
			'recursive' => -1
		));
		$output = "<div class='el_block flags' id='".$prefix.$idelement."'>";
		foreach($langs as $lang){
			$shortlang = $lang["Language"]["prefix"];
			//$urls = $this->Html->url(array('controller'=>'rubriques','action'=>'view',3));
			$urls = "/languages/nlg/".$lang["Language"]["prefix"];
			$output .= "<div class='flag'><a href='".Configure::read('Parameter.prefix').$urls."'><img src='".Configure::read('Parameter.prefix')."/img/lang/".$shortlang.".png' 'alt'=".$shortlang." /></a></div>";
			//$output .= $this->Html->image('lang/'.$shortlang.'.png', array('alt'=>$shortlang))."</div>";
		}
		$output .= "<div class='clear'></div></div>";
		return $output;
	}
	function viewmobile($id=null,$idelement=null,$params=null,$prefix=null){
		$langs = $this->find('all',array(
			'conditions' => array("active"=>true),
			'recursive' => -1
		));
		$output = "<div class='mobflags' id='".$prefix.$idelement."'>";
		foreach($langs as $lang){
			$shortlang = $lang["Language"]["prefix"];
			//$urls = $this->Html->url(array('controller'=>'rubriques','action'=>'view',3));
			$urls = "/languages/nlg/".$lang["Language"]["prefix"];
			$output .= "<div class='flag' style='padding:25px'><a href='".Configure::read('Parameter.prefix').$urls."'><img src='".Configure::read('Parameter.prefix')."/img/lang/".$shortlang.".png' 'alt'=".$shortlang." /></a></div>";
			//$output .= $this->Html->image('lang/'.$shortlang.'.png', array('alt'=>$shortlang))."</div>";
		}
		$output .= "<div class='clear'></div></div>";
		return $output;
	}
}
?>