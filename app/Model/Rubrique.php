<?php
class Rubrique extends AppModel{
	var $belongsTo= array('Contenutype');
	var $hasMany= array('Rubriqueelement');
	public $actsAs = array(
		'Translate' => array(
			'nom'=>'_nom',
			'url'=>'_url',
			'metatitle'=>'_metatitle',
			'metadescription'=>'_metadescription',
			'metakeyword'=>'_metakeyword'
		),
		'Autocache'
	);
	function getList($id=0){
		
		//debug(Configure::read('Config.languages'));
		$this->bindTranslation(array('nom'));
		$allrub = $this->find('all',array(
			"conditions" => "Rubrique.parent=$id && Rubrique.id<>0",
			"fields" => "Rubrique.id,Rubrique.nom,Rubrique.parent,Rubrique.contenutype_id",
			"recursive" => -1
			//"contain" => "Contenutype"
		));
		
		if (count($allrub)>0) {
			$arub = array();
			foreach($allrub as $c){
				
				$sousrub = $this->find('all',array(
					"conditions" => "Rubrique.parent=".$c["Rubrique"]["id"]." && Rubrique.id<>0",
					"fields" => "Rubrique.id,Rubrique.nom,Rubrique.parent,Rubrique.contenutype_id",
					"recursive" => -1
				));
				if (count($sousrub)>0) {
					//$asousrub = $this->getList($c["Rubrique"]["id"]);
					array_push($arub, array("rub"=>$c,"sousrub"=>$sousrub));
				}else{
					array_push($arub, array("rub"=>$c));
				}

			}
		return $arub;
		}
		
		/*$ct = $this->find('first',array(
				"conditions" => "Rubrique.id=$id",
				"fields" => "id,nom,parent"
			));
		$this->set('lacat', $ct);*/
	}
}
?>