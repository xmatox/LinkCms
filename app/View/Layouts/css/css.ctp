<?php
if(isset($style)){
	echo "body{";
	foreach($style as $cle=>$value){
		if((substr($cle,0,2)!="a_") && (substr($cle,0,3)!="ah_") && (substr($cle,0,3)!="h1_") && (substr($cle,0,3)!="h2_")){
			echo $cle.":".$value.";";
		}
	}
	echo "}";
	echo "a{";
	foreach($style as $cle=>$value){
		if(substr($cle,0,2)=="a_"){
			echo substr($cle,2).":".$value.";";
		}
	}
	echo "}";
	echo "a:hover{";
	foreach($style as $cle=>$value){
		if(substr($cle,0,3)=="ah_"){
			echo substr($cle,3).":".$value.";";
		}
	}
	echo "}";
	echo "h1{";
	foreach($style as $cle=>$value){
		if(substr($cle,0,3)=="h1_"){
			echo substr($cle,3).":".$value.";";
		}
	}
	echo "}";
	echo "h2{";
	foreach($style as $cle=>$value){
		if(substr($cle,0,3)=="h2_"){
			echo substr($cle,3).":".$value.";";
		}
	}
	echo "}";
}else{
	$typegraph="";
	foreach($graph as $g){
		if($g["Graphelement"]["nom"]=="droite" && $g["Graphelement"]["active"]==false){
			echo "#".$g["Graphelement"]["nom"]."{";
				echo "display:none !important;";
			echo "}";
			/*if(empty($typegraph)) $typegraph="D";
			else $typegraph="DG";*/
		}else if($g["Graphelement"]["nom"]=="gauche" && $g["Graphelement"]["active"]==false){
			echo "#".$g["Graphelement"]["nom"]."{";
				echo "display:none !important;";
			echo "}";
			/*if(empty($typegraph)) $typegraph="G";
			else $typegraph="DG";*/
		} 
	}
	foreach($graph as $g){
		if($g["Graphelement"]["active"]){
			
			if(substr($g["Graphelement"]["nom"],-4,4)=="roll"){
				echo ".".substr($g["Graphelement"]["nom"],0,-5)." a:hover{";
					//if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";

					if(!empty($g["Graphelement"]["width"])){
						if(stripos($g["Graphelement"]["width"], "px") || stripos($g["Graphelement"]["width"], "%") || stripos($g["Graphelement"]["width"], "em"))
							echo "width:".$g["Graphelement"]["width"].";"; 
						else  
							echo "width:".$g["Graphelement"]["width"]."px;";
					}

					if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
					if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
					if(!empty($g["Graphelement"]["borderradius"])){
						echo "-moz-border-radius:".$g["Graphelement"]["borderradius"].";";
						echo "-webkit-border-radius:".$g["Graphelement"]["borderradius"].";";
					}
					if(!empty($g["Graphelement"]["margin"])) echo "margin:".$g["Graphelement"]["margin"].";";
					if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
					
					if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
					
					if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimgfolder"].$g["Graphelement"]["fondimg"]."');";
					else if(empty($g["Graphelement"]["fondimg"]) && !empty($g["Graphelement"]["fondcolor"])) echo "background-image:none;";
					if(!empty($g["Graphelement"]["fondimgrepeat"])) echo "background-repeat:".$g["Graphelement"]["fondimgrepeat"].";";
					if(!empty($g["Graphelement"]["fondimgpos"])) echo "background-position:".$g["Graphelement"]["fondimgpos"].";";
					if(!empty($g["Graphelement"]["textsize"])) echo "font-size:".$g["Graphelement"]["textsize"].";";
					if(!empty($g["Graphelement"]["textfont"])) echo "font-family:".$g["Graphelement"]["textfont"].";";
					if(!empty($g["Graphelement"]["textcolor"])) echo "color:".$g["Graphelement"]["textcolor"].";";
					if(!empty($g["Graphelement"]["textalign"])) echo "text-align:".$g["Graphelement"]["textalign"].";";
					if(!empty($g["Graphelement"]["textgras"])) echo "font-weight:".$g["Graphelement"]["textgras"].";";
				echo "}";
				echo ".".substr($g["Graphelement"]["nom"],0,-5).".actif>a{";
					//if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";
					if(!empty($g["Graphelement"]["width"])){
						if(stripos($g["Graphelement"]["width"], "px") || stripos($g["Graphelement"]["width"], "%") || stripos($g["Graphelement"]["width"], "em"))
							echo "width:".$g["Graphelement"]["width"].";"; 
						else  
							echo "width:".$g["Graphelement"]["width"]."px;";
					}
					if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
					if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
					if(!empty($g["Graphelement"]["borderradius"])){
						echo "-moz-border-radius:".$g["Graphelement"]["borderradius"].";";
						echo "-webkit-border-radius:".$g["Graphelement"]["borderradius"].";";
					}
					if(!empty($g["Graphelement"]["margin"])) echo "margin:".$g["Graphelement"]["margin"].";";
					if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
					
					if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
					
					if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimgfolder"].$g["Graphelement"]["fondimg"]."');";
					else if(empty($g["Graphelement"]["fondimg"]) && !empty($g["Graphelement"]["fondcolor"])) echo "background-image:none;";
					if(!empty($g["Graphelement"]["fondimgrepeat"])) echo "background-repeat:".$g["Graphelement"]["fondimgrepeat"].";";
					if(!empty($g["Graphelement"]["fondimgpos"])) echo "background-position:".$g["Graphelement"]["fondimgpos"].";";
					if(!empty($g["Graphelement"]["textsize"])) echo "font-size:".$g["Graphelement"]["textsize"].";";
					if(!empty($g["Graphelement"]["textfont"])) echo "font-family:".$g["Graphelement"]["textfont"].";";
					if(!empty($g["Graphelement"]["textcolor"])) echo "color:".$g["Graphelement"]["textcolor"].";";
					if(!empty($g["Graphelement"]["textalign"])) echo "text-align:".$g["Graphelement"]["textalign"].";";
					if(!empty($g["Graphelement"]["textgras"])) echo "font-weight:".$g["Graphelement"]["textgras"].";";
				echo "}";
				
			}else if(substr($g["Graphelement"]["nom"],0,4)=="menu"){
				echo ".".$g["Graphelement"]["nom"]."{";
					if(!empty($g["Graphelement"]["float"])) echo "float:".$g["Graphelement"]["float"].";";
					echo "margin:0px";
				echo "}";
				echo ".".$g["Graphelement"]["nom"].">ul{";
					if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
					echo "margin:0px";
				echo "}";
				echo ".".$g["Graphelement"]["nom"].">ul>li{";
					echo "width:100%;";
					echo "margin:0px";
				echo "}";
				echo ".".$g["Graphelement"]["nom"]." a{";
					//if(!empty($g["Graphelement"]["width"])) echo "min-width:".$g["Graphelement"]["width"]."px;";
					if(!empty($g["Graphelement"]["width"])){
						if(stripos($g["Graphelement"]["width"], "px") || stripos($g["Graphelement"]["width"], "%") || stripos($g["Graphelement"]["width"], "em"))
							echo "width:".$g["Graphelement"]["width"].";"; 
						else  
							echo "width:".$g["Graphelement"]["width"]."px;";
					}
					if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
					if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
					if(!empty($g["Graphelement"]["borderradius"])){
						echo "-moz-border-radius:".$g["Graphelement"]["borderradius"].";";
						echo "-webkit-border-radius:".$g["Graphelement"]["borderradius"].";";
					}
					if(!empty($g["Graphelement"]["margin"])) echo "margin:".$g["Graphelement"]["margin"].";";
					if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
					
					if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
					
					if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimgfolder"].$g["Graphelement"]["fondimg"]."');";
					if(!empty($g["Graphelement"]["fondimgrepeat"])) echo "background-repeat:".$g["Graphelement"]["fondimgrepeat"].";";
					if(!empty($g["Graphelement"]["fondimgpos"])) echo "background-position:".$g["Graphelement"]["fondimgpos"].";";
					if(!empty($g["Graphelement"]["textsize"])) echo "font-size:".$g["Graphelement"]["textsize"].";";
					if(!empty($g["Graphelement"]["textfont"])) echo "font-family:".$g["Graphelement"]["textfont"].";";
					if(!empty($g["Graphelement"]["textcolor"])) echo "color:".$g["Graphelement"]["textcolor"].";";
					if(!empty($g["Graphelement"]["textalign"])) echo "text-align:".$g["Graphelement"]["textalign"].";";
					if(!empty($g["Graphelement"]["textgras"])) echo "font-weight:".$g["Graphelement"]["textgras"].";";
				echo "}";
			}else if(substr($g["Graphelement"]["nom"],0,2)=="ze"){
				echo "#".$g["Graphelement"]["nom"]."{";
					if(!empty($g["Graphelement"]["width"])){
						if(stripos($g["Graphelement"]["width"], "px") || stripos($g["Graphelement"]["width"], "%") || stripos($g["Graphelement"]["width"], "em"))
							echo "width:".$g["Graphelement"]["width"].";"; 
						else  
							echo "width:".$g["Graphelement"]["width"]."px;";
					}
					//if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";
					if(!empty($g["Graphelement"]["height"])) echo "min-height:".$g["Graphelement"]["height"]."px;";
					if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
					if(!empty($g["Graphelement"]["borderradius"])){
						echo "-moz-border-radius:".$g["Graphelement"]["borderradius"].";";
						echo "-webkit-border-radius:".$g["Graphelement"]["borderradius"].";";
					}
					if(!empty($g["Graphelement"]["margin"])) echo "margin:".$g["Graphelement"]["margin"].";";
					if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
					if(!empty($g["Graphelement"]["float"])) echo "float:".$g["Graphelement"]["float"].";";
					if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
					if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimgfolder"].$g["Graphelement"]["fondimg"]."');";
					if(!empty($g["Graphelement"]["fondimgrepeat"])) echo "background-repeat:".$g["Graphelement"]["fondimgrepeat"].";";
					if(!empty($g["Graphelement"]["fondimgpos"])) echo "background-position:".$g["Graphelement"]["fondimgpos"].";";
					/*if(!empty($g["Graphelement"]["width"])) echo "width:".$g["Graphelement"]["width"]."px;";
					if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";*/
					if(!empty($g["Graphelement"]["textfont"])) echo "font-family:".$g["Graphelement"]["textfont"].";";
					if(!empty($g["Graphelement"]["textsize"])) echo "font-size:".$g["Graphelement"]["textsize"].";";
					if(!empty($g["Graphelement"]["textcolor"])) echo "color:".$g["Graphelement"]["textcolor"].";";
					if(!empty($g["Graphelement"]["textalign"])) echo "text-align:".$g["Graphelement"]["textalign"].";";
					if(!empty($g["Graphelement"]["textgras"])) echo "font-weight:".$g["Graphelement"]["textgras"].";";
				echo "}";
			}else if($g["Graphelement"]["nom"]=="pied"){
				echo "#".$g["Graphelement"]["nom"]."{";
					if(!empty($g["Graphelement"]["width"])){
						if(stripos($g["Graphelement"]["width"], "px") || stripos($g["Graphelement"]["width"], "%") || stripos($g["Graphelement"]["width"], "em"))
							echo "max-width:".$g["Graphelement"]["width"].";"; 
						else  
							echo "max-width:".$g["Graphelement"]["width"]."px;";
					}
					//if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";
					else echo "width:100%;";
					echo "margin:auto;";
					if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
					if(!empty($g["Graphelement"]["margin"])) echo "padding:".$g["Graphelement"]["margin"].";";
						if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
						if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimgfolder"].$g["Graphelement"]["fondimg"]."');";
						if(!empty($g["Graphelement"]["fondimgrepeat"])) echo "background-repeat:".$g["Graphelement"]["fondimgrepeat"].";";
						if(!empty($g["Graphelement"]["fondimgpos"])) echo "background-position:".$g["Graphelement"]["fondimgpos"].";";
					
				echo "}";
				echo "#".$g["Graphelement"]["nom"]."cont{";
					if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
					if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
					echo "margin:auto;";
					if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
					if(!empty($g["Graphelement"]["float"])) echo "float:".$g["Graphelement"]["float"].";";
					
					if(!empty($g["Graphelement"]["textfont"])) echo "font-family:".$g["Graphelement"]["textfont"].";";
					if(!empty($g["Graphelement"]["textsize"])) echo "font-size:".$g["Graphelement"]["textsize"].";";
					if(!empty($g["Graphelement"]["textcolor"])) echo "color:".$g["Graphelement"]["textcolor"].";";
					if(!empty($g["Graphelement"]["textalign"])) echo "text-align:".$g["Graphelement"]["textalign"].";";
					if(!empty($g["Graphelement"]["textgras"])) echo "font-weight:".$g["Graphelement"]["textgras"].";";
					
				echo "}";
			}else{
				if($g["Graphelement"]["nom"]=="gauche" || $g["Graphelement"]["nom"]=="droite"){
					echo "#".$g["Graphelement"]["nom"]."{";
						//if(!empty($g["Graphelement"]["width"])) echo "width:".$g["Graphelement"]["width"]."px;";
						if(!empty($g["Graphelement"]["width"])){
							if(stripos($g["Graphelement"]["width"], "px") || stripos($g["Graphelement"]["width"], "%") || stripos($g["Graphelement"]["width"], "em"))
								echo "width:".$g["Graphelement"]["width"].";"; 
							else  
								echo "width:".$g["Graphelement"]["width"]."px;";
						}
					echo "}";
				}else if($g["Graphelement"]["nom"]=="tete"){
					echo "#".$g["Graphelement"]["nom"]."{";
						if(!empty($g["Graphelement"]["width"])) echo "width:100%;";
						
						//if(!empty($g["Graphelement"]["height"])) echo "min-height:".$g["Graphelement"]["height"]."px;";
						if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
					echo "}";
				}else{
					echo "#".$g["Graphelement"]["nom"]."{";
						//if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";
						if(!empty($g["Graphelement"]["width"])){
							if(stripos($g["Graphelement"]["width"], "px") || stripos($g["Graphelement"]["width"], "%") || stripos($g["Graphelement"]["width"], "em"))
								echo "max-width:".$g["Graphelement"]["width"].";"; 
							else  
								echo "max-width:".$g["Graphelement"]["width"]."px;";
						}
						//if(!empty($g["Graphelement"]["height"])) echo "min-height:".$g["Graphelement"]["height"]."px;";
						if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
					echo "}";
				}
				echo "#".$g["Graphelement"]["nom"]."{";
					//if(!empty($g["Graphelement"]["height"])) echo "min-height:".$g["Graphelement"]["height"]."px;";
					if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
					if(!empty($g["Graphelement"]["margin"])) echo "margin:".$g["Graphelement"]["margin"].";";
					if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
					if(!empty($g["Graphelement"]["float"])) echo "float:".$g["Graphelement"]["float"].";";
					if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
					if(!empty($g["Graphelement"]["textfont"])) echo "font-family:".$g["Graphelement"]["textfont"].";";
					if(!empty($g["Graphelement"]["textsize"])) echo "font-size:".$g["Graphelement"]["textsize"].";";
					if(!empty($g["Graphelement"]["textcolor"])) echo "color:".$g["Graphelement"]["textcolor"].";";
					if(!empty($g["Graphelement"]["textalign"])) echo "text-align:".$g["Graphelement"]["textalign"].";";
					if(!empty($g["Graphelement"]["textgras"])) echo "font-weight:".$g["Graphelement"]["textgras"].";";
					if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimgfolder"].$g["Graphelement"]["fondimg"]."');";
					if(!empty($g["Graphelement"]["fondimgrepeat"])) echo "background-repeat:".$g["Graphelement"]["fondimgrepeat"].";";
					if(!empty($g["Graphelement"]["fondimgpos"])) echo "background-position:".$g["Graphelement"]["fondimgpos"].";";
				echo "}";
			}
			
			if($g["Graphelement"]["nom"]=="tete"){
				echo "#piedcont{";
					if(!empty($g["Graphelement"]["width"])){
							if(stripos($g["Graphelement"]["width"], "px") || stripos($g["Graphelement"]["width"], "%") || stripos($g["Graphelement"]["width"], "em"))
								echo "max-width:".$g["Graphelement"]["width"].";"; 
							else  
								echo "max-width:".$g["Graphelement"]["width"]."px;";
						}
					//if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";
					else echo "width:100%;";
				echo "}";
			}
		}
	}
}
?>

