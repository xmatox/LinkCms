<?php
header('content-type: application/json');
//
if (!function_exists('getallheaders')) {
    function getallheaders(){
       foreach ($_SERVER as $name => $value){
           if (substr($name, 0, 5) == 'HTTP_'){
               $headers[str_replace(' ', '-', strtolower(str_replace('_', ' ', substr($name, 5))))] = $value;
           }
       }
       return $headers;
    }
}
$h = getallheaders();
//$h = $_SERVER;
$o = new stdClass();

$type = isset($h['x-file-type']) ? $h['x-file-type'] : "";

$foldermin = isset($h['x-file-foldermin']) ? $h['x-file-foldermin']."/" : "0";
$widthmin = isset($h['x-file-widthmin']) ? $h['x-file-widthmin'] : "0";
$heightmin = isset($h['x-file-heightmin']) ? $h['x-file-heightmin'] : "0";
$foldermin2 = isset($h['x-file-foldermin2']) ? $h['x-file-foldermin2']."/" : "0";
$widthmin2 = isset($h['x-file-widthmin2']) ? $h['x-file-widthmin2'] : "0";
$heightmin2 = isset($h['x-file-heightmin2']) ? $h['x-file-heightmin2'] : "0";
$foldermin3 = isset($h['x-file-foldermin3']) ? $h['x-file-foldermin3']."/" : "0";
$widthmin3 = isset($h['x-file-widthmin3']) ? $h['x-file-widthmin3'] : "0";
$heightmin3 = isset($h['x-file-heightmin3']) ? $h['x-file-heightmin3'] : "0";
	
$folderTmp = "../../img/tmp/";

if(isset($h['x-file-select'])){
	
		$nom = $h['x-file-name'];
	
	
	$o->name = $nom;
	$o->content = '<img src="../'.$foldermin.$nom.'" alt="'.$nom.'"/>';

}else if(isset($h['x-file-delete'])){
	
	if($foldermin!="0" && $foldermin!="0/"){
		if (file_exists($foldermin.$h['x-file-name'])) unlink($foldermin.$h['x-file-name']);
	}
	if($foldermin2!="0" && $foldermin2!="0/"){
		if (file_exists($foldermin2.$h['x-file-name'])) unlink($foldermin2.$h['x-file-name']);
	}
	if($foldermin3!="0" && $foldermin3!="0/"){
		if (file_exists($foldermin3.$h['x-file-name'])) unlink($foldermin3.$h['x-file-name']);
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
			
			if($foldermin!="0" && $foldermin!="0/"){
				if (file_exists($foldermin.$h['x-param-value'])) unlink($foldermin.$h['x-param-value']);
			}
			if($foldermin2!="0" && $foldermin2!="0/"){
				if (file_exists($foldermin2.$h['x-param-value'])) unlink($foldermin.$h['x-param-value']);
			}
			if($foldermin3!="0" && $foldermin3!="0/"){
				if (file_exists($foldermin3.$h['x-param-value'])) unlink($foldermin.$h['x-param-value']);
			}
			
		}
		if(isset($h['x-file-rename'])){
			$thename = $h['x-file-name'];
			$type = substr(strtolower($thename),-4);
			$thename = substr($thename,0,-4);
			$thename = filter(uniqid($thename.'_').$type);
		}else{
			$thename = filter($h['x-file-name']);
		}
		
		
		//file_put_contents('img/'.$h['HTTP_X_FILE_NAME'],$source);
		file_put_contents($folderTmp.$thename,$source);
		if($foldermin!="0" && $foldermin!="0/"){
			if($widthmin!="0"){
				creerMin($folderTmp.$thename,$foldermin,$thename,$widthmin,$heightmin,true);
			}else{
				creerMin($folderTmp.$thename,$foldermin,$thename,$widthmin,$heightmin,false);
			}
		}
		if($foldermin2!="0" && $foldermin2!="0/"){
			if($widthmin!="0"){
				creerMin($folderTmp.$thename,$foldermin2,$thename,$widthmin2,$heightmin2,true);
			}else{
				creerMin($folderTmp.$thename,$foldermin2,$thename,$widthmin2,$heightmin2,false);
			}
		}
		if($foldermin3!="0" && $foldermin3!="0/"){
			if($widthmin!="0"){
				creerMin($folderTmp.$thename,$foldermin3,$thename,$widthmin3,$heightmin3,true);
			}else{
				creerMin($folderTmp.$thename,$foldermin3,$thename,$widthmin3,$heightmin3,false);
			}
		}
		if (file_exists($folderTmp.$thename)) unlink($folderTmp.$thename);
		//
		$nom = $thename;
		
		$o->name = $nom;
		
		if($foldermin2!="0" && $foldermin2!="0/"){
		$o->content = '<img src="../../'.$foldermin2.$nom.'" alt="'.$nom.'"/>';
		}else{
		$o->content = '<img src="../../'.$foldermin.$nom.'" alt="'.$nom.'"/>';
		}
	}
}
echo json_encode($o);

function creerMin($img,$chemin,$nom,$mlargeur=100,$mhauteur=100,$cadre){
	// On supprime l'extension du nom
	$nom = substr($nom,0,-4);
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
	if(!$cadre){
		$mlargeur = $mhauteur*$dimension[0]/$dimension[1];
	}
	$miniature =imagecreatetruecolor ($mlargeur,$mhauteur); 
	//
	$white = imagecolorallocate($miniature, 255, 255, 255);
	imagefilledrectangle($miniature, 0, 0, $mlargeur,$mhauteur, $white);
	
	
	// On va gérer la position et le redimensionnement de la grande image
	if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1] ){ $dimY=$mhauteur; $dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=($mlargeur-$dimX)/2; $decalY=0;}
	if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=($mhauteur-$dimY)/2; $decalX=0;}
	if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mhauteur; $decalX=0; $decalY=0;}
	// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
	imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
	// On sauvegarde le tout
	//imagejpeg($miniature,$chemin."/".$nom.".jpg",90);
	
  switch($type){
    case '.gif': @imagegif($miniature, $chemin."/".$nom.$type); break;
    case '.jpg': @imagejpeg($miniature, $chemin."/".$nom.$type,70); break;
    case '.png': @imagepng($miniature, $chemin."/".$nom.$type); break;
  }
	return true;
}

function filter($string){
	//return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	$translit = array('Á'=>'a','À'=>'a','Â'=>'a','Ä'=>'a','Ã'=>'a','Å'=>'a','Ç'=>'c','É'=>'e','È'=>'e','Ê'=>'e','Ë'=>'e','Í'=>'i','Ï'=>'i','Î'=>'i','Ì'=>'i','Ñ'=>'n','Ó'=>'o','Ò'=>
'o','Ô'=>'o','Ö'=>'o','Õ'=>'o','Ú'=>'u','Ù'=>'u','Û'=>'u','Ü'=>'u','Ý'=>'y','á'=>'a','à'=>'a','â'=>'a','ä'=>'a','ã'=>'a','å'=>'a','ç'=>'c','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
'í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','ñ'=>'n','ó'=>'o','ò'=>'o','ô'=>'o','ö'=>'o','õ'=>'o','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','ý'=>'y','ÿ'=>'y'); 
    $string = strtr($string, $translit); 
	$string = strtolower($string);
    return preg_replace('#[^a-zA-Z0-9\-\._]#', '_', $string); // Pour des noms de fichiers par exemple 
}
?>