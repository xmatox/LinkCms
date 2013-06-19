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
}
?>