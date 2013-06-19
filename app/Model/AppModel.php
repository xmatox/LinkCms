<?php
App::uses('Model', 'Model');
class AppModel extends Model {
	var $actsAs = array('Containable');
	public $locale = 'fre';
	public function setLanguage($locale) {
        $this->locale = $locale;
    }
	public function readAll($id=null){
		$datas = $this->read(null,$id);
		foreach($datas as $field=>$trad){
			if(strpos($field,'_')===0){
				$name = str_replace('_','',$field);
				$datas[$this->name][$name] = array();
				foreach($trad as $t){
					$locale = $t["locale"];
					$datas[$this->name][$name][$locale] = $t["content"];
				}
			}
		}
		return $datas;
	}
	
}
