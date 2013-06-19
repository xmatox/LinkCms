<?php
class Form extends AppModel{
	// liaisons
	var $hasMany = array('Formelement');
	// Multilangues
	public $actsAs = array(
		'Translate' => array(
			'nom'=>'_nom'
		)
	);
	var $validate = array(
		'sendfrom' => array(
			'rule' => 'email',
			'required' => true,
			'allowEmpty' => false,
			'message' => "l'Email d'envoi n'est pas valide"
		),
		'sendto' => array(
			'rule' => 'email',
			'required' => true,
			'allowEmpty' => false,
			'message' => "l'Email de reception n'est pas valide"
		)
	);
	// fonction d'affichage
	// return du html à afficher
	function view($id=null,$idelement=null,$prefix=null){
		if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
		$pages = $this->find('first',array(
			'conditions' => array( 'Form.id' => $id ),
			'recursive' => -1,
			'autocache' => $autocache
		));
		if($idelement) $output = "<div class='el_block' id='".$prefix.$idelement."'>";
		else $output = "<div class='el_block' id='".$prefix."fo".$id."'>";
			//$this->Formelement->bindTranslation(array('nom','content'));
			$form = $this->Formelement->find('all',array(
				'conditions' => array( 'Formelement.form_id' => $id ),
				'order' => "Formelement.position",
				'autocache' => $autocache
			));
			$output .='<form action="'.Configure::read('Parameter.prefix').'/forms/forms/send/'.$id.'" method="post">';
			foreach($form as $f){
				if($f["Formelement"]["label"]){
					$output .='<br/><label for="inputFo'.$f["Formelement"]["id"].'">';
					$output .=$f["Formelement"]["nom"];
					if($f["Formelement"]["obligatoire"]){
						$output .=" (*)";
					}
					$output .=' : </label>';
					if($f["Formelement"]["alignement"]=="V"){
						$output .="<br/>";
					}
				}else{
					if($f["Formelement"]["obligatoire"]){
						$output .=" (*)";
					}
				}
				if($f["Formelement"]["width"]!=0){
					$width= " style='width:".$f["Formelement"]["width"]."px' ";
				}else{
					$width="";
				}
				if($f["Formelement"]["type"]=="text"){
					$output .='<input type="text" name="fo_'.$f["Formelement"]["id"].'" id="inputFo'.$f["Formelement"]["id"].'" value="'.$f["Formelement"]["content"].'" '.$width.' /><br/>';
				}else if($f["Formelement"]["type"]=="textarea"){
					$output .='<textarea id="inputFo'.$f["Formelement"]["id"].'" name="fo_'.$f["Formelement"]["id"].'" '.$width.'>'.$f["Formelement"]["content"].'</textarea><br/>';
				}else if($f["Formelement"]["type"]=="radio"){
					$acontent = explode(";",$f["Formelement"]["content"]);
					foreach($acontent as $ac){
						$output .='<input type="radio" name="fo_'.$f["Formelement"]["id"].'" value="'.$ac.'" /> '.$ac.' ';
						if($f["Formelement"]["alignement"]=="V"){
							$output .="<br/>";
						}
					}
					if($f["Formelement"]["alignement"]!="V"){
						$output .='<br/>';
					}
				}else if($f["Formelement"]["type"]=="checkbox"){
					$output .='<input type="checkbox" name="fo_'.$f["Formelement"]["id"].'" value="'.$f["Formelement"]["content"].'" /> '.$f["Formelement"]["content"].'<br/>';
				}else if($f["Formelement"]["type"]=="liste"){	
					$output .='<select name="fo_'.$f["Formelement"]["id"].'" '.$width.'>';
					$acontent = explode(";",$f["Formelement"]["content"]);
					foreach($acontent as $ac){
						$output .='<option value="'.$ac.'">'.$ac.'</option>';
					}
					$output .='</select><br/>';
				}else if($f["Formelement"]["type"]=="info"){
					$output .= "<div>".$f["Formelement"]["content"]."</div>";
				}else if($f["Formelement"]["type"]=="infomulti"){
					$output .= "<div>".$f["Formelement"]["content"]."<div class='clear'></div></div>";
					
				}
			}
			$output .='<br/><input type="submit" value="'.__('Envoyer').'">';
			$output .='</form>';
		$output .= "</div>";
		return $output;
	}
}
?>