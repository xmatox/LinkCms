<?php
class Rubriqueelement extends AppModel{
	var $belongsTo= array(
		'Contenutype',
		'Rubrique',
		'Graphelement'
	);
	function view($id=null,$var=null){
		
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$output = "<div class='el_blocks' id='r_".$id."'>";
		//$this->setlink();
		$elements = $this->find('all',
			array( 
				'conditions' => array( 'Rubriqueelement.rubrique_id' => $id ),
				'order' => array( 'Rubriqueelement.ordre' ),
				'autocache' => $autocache
				
			)
		);
		//debug($elements);
		$themodel = "";
		foreach($elements as $r){
			if(!empty($r['Contenutype']['table'])){
				$plug = $r['Contenutype']['table'];
				$table = substr($plug, 0, -1);
				
				if ($r['Contenutype']['table']!="Menugroupes" && $r['Contenutype']['table']!="Languages") {
					if(empty($var)) $var="cat";
						$pages = ClassRegistry::init($plug.'.'.$table)->view($r['Rubriqueelement']['contenupage_id'],$r['Rubriqueelement']['id'],"re_",$var);
				}else if($r['Contenutype']['table']=="Languages"){
					$pages = ClassRegistry::init($table)->view("","re_".$r['Rubriqueelement']['id'],"re_");
				}else{
					$pages = ClassRegistry::init($table)->view($r['Rubriqueelement']['contenupage_id'],"re_".$r['Rubriqueelement']['id'],"re_");
				}
				$output .= $pages;
				$themodel = $table;
			}
		}
		$output .= "<div class='clear'></div></div>";

		return $output;
	}
}
?>