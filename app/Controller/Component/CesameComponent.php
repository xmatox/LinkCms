<?php 
/** 
* Cripage de données
* 
* @author  Thomas Abadie SOMA Création
* @email   contact@soma-creation.net
* @version 1.0.0 
*/ 
class CesameComponent extends Component {
    
   
	// encoder données
	function atencode($mess){
		$toutCara = array ("a","b","c","d","e","f","g","h","i","j","k","l","m",
	"n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M",
	"N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9",",",".",":",";","{","}","#"," ");

		$nbCara = strlen($mess);
		$lenombre = "";
		$code = "";
		for ($i=0;$i<$nbCara;$i++){
			$leCara = substr($mess,$i,1);
			if (in_array($leCara, $toutCara)) {
				foreach($toutCara as $cle=>$valeur){
						if($valeur==$leCara){
							$lenombre.=(($cle+12)*12)+80;
							
						}
				}
			}else{
				$lenombre.=$leCara;
			}
		}
		$j=0;
		while($j<strlen($lenombre)){
			if (in_array(substr($lenombre,$j,1), $toutCara)) {
				if(substr($lenombre,$j,2)>61 or substr($lenombre,$j,1)==0 or !in_array(substr($lenombre,$j+1,1), $toutCara)){
					$new = substr($lenombre,$j,1);
					$j+=1;
				}else{
					$new = substr($lenombre,$j,2);
					$j+=2;
				}
				$code.=$toutCara[$new];
			}else{
				$code.=substr($lenombre,$j,1);
				$j+=1;
			}
		}
		
		return $code;
	}
	// decoder données
	function atdencode($mess){
		$toutCara = array ("a","b","c","d","e","f","g","h","i","j","k","l","m",
	"n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M",
	"N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9",",",".",":",";","{","}","#"," ");

		$nbCara = strlen($mess);
		$lenombre = "";
		$code = "";
		for ($i=0;$i<$nbCara;$i++){
			$leCara = substr($mess,$i,1);
			if (in_array($leCara, $toutCara)) {
				foreach($toutCara as $cle=>$valeur){
					if($valeur==$leCara){
						$lenombre.=$cle;
					}
				}
			}else{
				$lenombre.=$leCara;
			}
		}
		$j=0;
		while($j<strlen($lenombre)){
			if (in_array(substr($lenombre,$j,1), $toutCara)) {
				$new = substr($lenombre,$j,3);
				$new = (($new-80)/12)-12;
				$j+=3;
			
				$code.=$toutCara[$new];
			
			}else{
				$code.=substr($lenombre,$j,1);
				$j+=1;
			}
		}
		return $code;
	}

     
} 
?>