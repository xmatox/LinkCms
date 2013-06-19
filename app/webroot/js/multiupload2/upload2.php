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
	$o->content = '<img src="../../../'.$foldermin.$nom.'" alt="'.$nom.'"/>';

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
		//file_put_contents($folderTmp.$thename,$source);
		if($foldermin!="0" && $foldermin!="0/"){
			file_put_contents($foldermin.$thename,$source);
			if($widthmin!="0"){
				//creerMin($folderTmp.$thename,$foldermin,$thename,$widthmin,$heightmin,true);
				smart_resize_image( $foldermin.$thename, $widthmin, $heightmin, false );
			}else{
				//creerMin($folderTmp.$thename,$foldermin,$thename,$widthmin,$heightmin,false);
				smart_resize_image( $foldermin.$thename, $widthmin, $heightmin, false );
			}
		}
		if($foldermin2!="0" && $foldermin2!="0/"){
			file_put_contents($foldermin2.$thename,$source);
			if($widthmin!="0"){
				//creerMin($folderTmp.$thename,$foldermin2,$thename,$widthmin2,$heightmin2,true);
				smart_resize_image( $foldermin2.$thename, $widthmin, $heightmin, true );
			}else{
				//creerMin($folderTmp.$thename,$foldermin2,$thename,$widthmin2,$heightmin2,false);
				smart_resize_image( $foldermin2.$thename, $widthmin, $heightmin, true );
			}
		}
		if($foldermin3!="0" && $foldermin3!="0/"){	
			file_put_contents($foldermin3.$thename,$source);
			if($widthmin!="0"){
				//creerMin($folderTmp.$thename,$foldermin3,$thename,$widthmin3,$heightmin3,true);
				smart_resize_image( $foldermin3.$thename, $widthmin, $heightmin, true );
			}else{
				//creerMin($folderTmp.$thename,$foldermin3,$thename,$widthmin3,$heightmin3,false);
				smart_resize_image( $foldermin3.$thename, $widthmin, $heightmin, true );
			}
		}
		//if (file_exists($folderTmp.$thename) && ($foldermin!="0" && $foldermin!="0/")) unlink($folderTmp.$thename);
		//
		$nom = $thename;
		
		$o->name = $nom;
		
		if($foldermin2!="0" && $foldermin2!="0/"){
		$o->content = '<img src="'.$foldermin2.$nom.'" alt="'.$nom.'" style="width:100%" />';
		}else if($foldermin!="0" && $foldermin!="0/"){
		$o->content = '<img src="../../../'.$foldermin.$nom.'" alt="'.$nom.'" style="width:100%" />';
		}else{
		$o->content = '<img src="../../../'.$folderTmp.$nom.'" alt="'.$nom.'" style="width:100%" />';
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


/* -------------- V2 ----------------*/


function smart_resize_image( $file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false )
{
	if ( $height <= 0 && $width <= 0 ) {
		return false;
	}

	$info = getimagesize($file);
	$image = '';

	$final_width = 0;
	$final_height = 0;
	list($width_old, $height_old) = $info;

	if ($proportional) {
		if ($width == 0) $factor = $height/$height_old;
		elseif ($height == 0) $factor = $width/$width_old;
		else $factor = min ( $width / $width_old, $height / $height_old);   

		$final_width = round ($width_old * $factor);
		$final_height = round ($height_old * $factor);

	}
	else {
		$final_width = ( $width <= 0 ) ? $width_old : $width;
		$final_height = ( $height <= 0 ) ? $height_old : $height;
	}

	switch ( $info[2] ) {
		case IMAGETYPE_GIF:
			$image = imagecreatefromgif($file);
			break;
		case IMAGETYPE_JPEG:
			$image = imagecreatefromjpeg($file);
			break;
		case IMAGETYPE_PNG:
			$image = imagecreatefrompng($file);
			break;
		default:
		return false;
	}

	$image_resized = imagecreatetruecolor( $final_width, $final_height );
	
	if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
		$trnprt_indx = imagecolortransparent($image);

		// If we have a specific transparent color
		if ($trnprt_indx >= 0) {

			// Get the original image's transparent color's RGB values
			$trnprt_color    = imagecolorsforindex($image, $trnprt_indx);

			// Allocate the same color in the new image resource
			$trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

			// Completely fill the background of the new image with allocated color.
			imagefill($image_resized, 0, 0, $trnprt_indx);

			// Set the background color for new image to transparent
			imagecolortransparent($image_resized, $trnprt_indx);


		}
		// Always make a transparent background color for PNGs that don't have one allocated already
		elseif ($info[2] == IMAGETYPE_PNG) {

			// Turn off transparency blending (temporarily)
			imagealphablending($image_resized, false);

			// Create a new transparent color for image
			$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

			// Completely fill the background of the new image with allocated color.
			imagefill($image_resized, 0, 0, $color);

			// Restore transparency blending
			imagesavealpha($image_resized, true);
		}
	}else{
		$white = imagecolorallocate($image_resized, 255, 255, 255);
		imagefilledrectangle($image_resized, 0, 0, $final_width,$final_height, $white);
	}
	// On va gérer la position et le redimensionnement de la grande image
	if($width_old<($final_width/$final_height)*$height_old ){ $dimY=$final_height; $dimX=$final_height*$width_old/$height_old; $decalX=($final_width-$dimX)/2; $decalY=0;}
	if($width_old>($final_width/$final_height)*$height_old){ $dimX=$final_width; $dimY=$final_width*$height_old/$width_old; $decalY=($final_height-$dimY)/2; $decalX=0;}
	if($width_old==($final_width/$final_height)*$height_old){ $dimX=$final_width; $dimY=$final_height; $decalX=0; $decalY=0;}
	// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
	//imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
	imagecopyresampled($image_resized, $image, $decalX,$decalY, 0, 0, $dimX,$dimY, $width_old, $height_old);

	if ( $delete_original ) {
		if ( $use_linux_commands )
			exec('rm '.$file);
		else
			@unlink($file);
	}

	switch ( strtolower($output) ) {
		case 'browser':
			$mime = image_type_to_mime_type($info[2]);
			header("Content-type: $mime");
			$output = NULL;
			break;
		case 'file':
			$output = $file;
			break;
		case 'return':
			return $image_resized;
			break;
		default:
		break;
	}

	switch ( $info[2] ) {
		case IMAGETYPE_GIF:
			imagegif($image_resized, $output);
			break;
		case IMAGETYPE_JPEG:
			imagejpeg($image_resized, $output);
			break;
		case IMAGETYPE_PNG:
			imagepng($image_resized, $output);
			break;
		default:
		return false;
	}

	return true;
}
?>