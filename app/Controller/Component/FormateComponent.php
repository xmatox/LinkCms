<?php
class FormateComponent extends Component {
	public function getTableName($title) {
        $title = preg_replace('#[^a-zA-Z0-9]#', '', $title);
		$title = ucfirst($title);
		if(substr($title,-1,1)=="s"){
			$title = substr($title,0,-1);
		}
		return $title;
    }
	public function getTableNames($title) {
        $title = preg_replace('#[^a-zA-Z0-9]#', '', $title);
		$title = ucfirst($title);
		if(substr($title,-1,1)!="s"){
			$title = $title."s";
		}
		return $title;
    }
	public function getTableLongName($title) {
        $title = preg_replace('#[^a-zA-Z0-9]#', '', $title);
		$title = strtolower($title);
		if(substr($title,-1,1)!="s"){
			$title = $title."s";
		}
		return $title;
    }
}
