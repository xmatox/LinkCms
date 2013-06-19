<?php
header('content-type: application/json');

$h = getallheaders();
//$h = $_SERVER;
$o = new stdClass();

$type = isset($h['x-file-type']) ? $h['x-file-type'] : "";

$foldermin = isset($h['x-file-foldermin']) ? $h['x-file-foldermin']."/" : "0";
$widthmin = isset($h['x-file-widthmin']) ? $h['x-file-widthmin'] : "400";
$heightmin = isset($h['x-file-heightmin']) ? $h['x-file-heightmin'] : "400";
$foldermin2 = isset($h['x-file-foldermin2']) ? $h['x-file-foldermin2']."/" : "0";
$widthmin2 = isset($h['x-file-widthmin2']) ? $h['x-file-widthmin2'] : "150";
$heightmin2 = isset($h['x-file-heightmin2']) ? $h['x-file-heightmin2'] : "150";
	
$folderTmp = "../../img/tmp/";
$nom = filter($h['x-file-name']);
$nom = $h['x-file-name'];

if(isset($h['x-file-select'])){
	//$nom = $h['x-file-name'];
	$o->name = $nom;
	$o->content = '<img src="../'.$foldermin.$nom.'" alt="'.$nom.'"/>';

}else if(isset($h['x-file-delete'])){
	
	if($foldermin!="0"){
		if (file_exists($foldermin.$nom)) unlink($foldermin.$nom);
	}
	if($foldermin2!="0"){
		if (file_exists($foldermin2.$nom)) unlink($foldermin2.$nom);
	}
	
	$o->content = 'Le fichier a bien été supprimé';
	
}else{
	



	//$folder = "upload/";
	$source = file_get_contents('php://input');
	$types = Array('image/png','image/gif','image/jpeg');

	if(!in_array($type,$types)){
		$o->error = 'Format non supporte';
	}else{
		
		if(isset($h['x-param-value'])){
			
			if($foldermin!="0"){
				unlink($foldermin.$h['x-param-value']);
			}
			if($foldermin2!="0"){
				unlink($foldermin2.$h['x-param-value']);
			}
			
		}

		//file_put_contents('img/'.$h['HTTP_X_FILE_NAME'],$source);
		file_put_contents($folderTmp.$nom,$source);
		if($foldermin!="0"){
			creerMin($folderTmp.$nom,$foldermin,$nom,$widthmin,$heightmin);
		}
		if($foldermin2!="0"){
			creerMin($folderTmp.$nom,$foldermin2,$nom,$widthmin2,$heightmin2);
		}
		unlink($folderTmp.$nom);
		//
		$nom = $nom;
		
		$o->name = $nom;
		$o->content = '<img src="../'.$foldermin2.$nom.'" alt="'.$nom.'"/>';
	}
}
echo json_encode($o);

function creerMin($img,$chemin,$nom2,$mlargeur=100,$mhauteur=100){
	// On supprime l'extension du nom
	$nom2 = substr($nom2,0,-4);
	// On récupère les dimensions de l'image
	$dimension=getimagesize($img);
	
	$type = substr(strtolower($img),-4);

	// On cré une image à partir du fichier récup
	if($type==".jpg"){$image = imagecreatefromjpeg($img); }
	else if($type==".png"){$image = imagecreatefrompng($img); }
	else if($type==".gif"){$image = imagecreatefromgif($img); }
	// L'image ne peut etre redimensionne
	else{return false; }
	
	
	// Création des miniatures
	// On cré une image vide de la largeur et hauteur voulue
	$miniature =imagecreatetruecolor ($mlargeur,$mhauteur); 
	
  // preserve transparency
  if($type == ".gif" or $type == ".png"){
    imagecolortransparent($miniature, imagecolorallocatealpha($miniature, 0, 0, 0, 127));
    imagealphablending($miniature, false);
    imagesavealpha($miniature, true);
  }
  
  
	// On va gérer la position et le redimensionnement de la grande image
	if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ){ $dimY=$mhauteur; $dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=-($dimX-$mlargeur)/2; $decalY=0;}
	if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=-($dimY-$mhauteur)/2; $decalX=0;}
	if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mhauteur; $decalX=0; $decalY=0;}
	// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
	imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
	// On sauvegarde le tout
	//imagejpeg($miniature,$chemin."/".$nom.".jpg",90);
	
  switch($type){
    case '.gif': imagegif($miniature, $chemin."/".$nom2.$type); break;
    case '.jpg': imagejpeg($miniature, $chemin."/".$nom2.$type); break;
    case '.png': imagepng($miniature, $chemin."/".$nom2.$type); break;
  }
	return true;
}
function filter($in) {
	$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_-.]@');
	$replace = array ('e','a','i','u','o','c','_','');
	return preg_replace($search, $replace, $in);
}
?>