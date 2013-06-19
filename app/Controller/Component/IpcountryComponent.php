<?php
class IpcountryComponent extends Component {
	public function getCountry() {
		$serveur = "www.soma-creation.com";
		$document = "/ipcountry/get.php";
		$url = "http://www.soma-creation.com/ipcountry/get.php";
		$response = file_get_contents($url);
		if($response=='"FR"'){
			$return = "fre";
		}else if($response=='"CN"'){
			$return = "chi";
		}else if($response=='"DE"'){
			$return = "ger";
		}else if($response=='"ES"'){
			$return = "spa";
		}else if($response=='"JP"'){
			$return = "jap";
		}else if($response=='"RU"'){
			$return = "rus";
		}else{
			$return = "eng";
		} 
		/*$socket = fsockopen($serveur, 80, $codeErreur, $msgErreur);

		if (!$socket)
		{
		    echo "La connexion via la socket a échouée.<br />";
		    echo "Code d'erreur: $codeErreur<br />";
		    echo "Message d'erreur: $msgErreur<br />";
		    exit();
		}

		// Envoi de données au serveur
		fputs($socket, "GET $document HTTP/1.1\r\n");
		fputs($socket, "Host: $serveur\r\n");
		fputs($socket, "\r\n");// Marque la fin des entêtes

		// Lecture de la réponse et affichage du code source
		while (!feof($socket))
		{
		    $donnees = fgets($socket, 512);

		    $response.= htmlentities($donnees, ENT_QUOTES).'<br />';
		}*/
		return $return;
    }
	public function getDomaine(){
    	$dom = explode(".", $_SERVER['HTTP_HOST']);
    	$nbdom = count($dom);
    	$ext = $dom[$nbdom-1];
    	if(isset($ext) && !empty($ext) && $nbdom>1){
	    	if($ext=="com" || $ext=="net" || $ext=="info" || $ext=="biz" || $ext=="org"){
	    		$return = "default";
	    	}else if($ext=="fr"){
	    	    $return = "fre";
	    	}else if($ext=="ru"){
	    		$return = "rus";
	    	}else if($ext=="de" || $ext=="at"){
	    		$return = "ger";
	    	}else if($ext=="cn"){
	    		$return = "chi";
	    	}else if($ext=="jp"){
	    		$return = "jap";
	    	}else if($ext=="es"){
	    		$return = "spa";
	    	}else if($ext=="uk"){
	    		$return = "eng";
	    	}else{
	    		$return = "default";
	    	}
	    }else{
	    	$return = "default";
	    }
		return $return;
    }
}