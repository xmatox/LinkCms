<?php
class Zoneelement extends AppModel{
	var $belongsTo= array('Elementtype','Graphelement');
	function getContents($zone=null){
		$result = $this->find('all',
			array( 
				'conditions' => array( 'Zoneelement.graphelement_id' => $zone ),
				'order' => array( 'Zoneelement.ordre' )
				
			)
		);
		return $result;
	}
	function savenew($contenutype_id=null){
		$elements = $this->Elementtype->find('first',
			array( 
				'conditions' => array('Elementtype.id' => $contenutype_id),
				'fields' => array('Elementtype.table')
			)
		);
		$plug = $elements['Elementtype']['table'];
		$table = substr($plug, 0, -1);
		if ($elements['Elementtype']['table']!="Menugroupes" && $elements['Elementtype']['table']!="Languages") {
			$contenu_id = ClassRegistry::init($plug.'.'.$table)->savenew();
		}else if($elements['Elementtype']['table']=="Languages"){
			$contenu_id = ClassRegistry::init($table)->savenew();
		}else{
			$contenu_id = ClassRegistry::init($table)->savenew();
		}
		return $contenu_id;
	}
}
?>