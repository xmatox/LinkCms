<?php
echo "body{";
foreach($style as $cle=>$value){
	if((substr($cle,0,2)!="a_") && (substr($cle,0,3)!="ah_")){
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
// view > Layout > css
	/*
	if(substr($g["Graphelement"]["nom"],-4,4)=="roll"){
		echo ".".substr($g["Graphelement"]["nom"],0,-5)." a:hover{";
			if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";
			if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
			if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
			if(!empty($g["Graphelement"]["borderradius"])){
				echo "-moz-border-radius:".$g["Graphelement"]["borderradius"].";";
				echo "-webkit-border-radius:".$g["Graphelement"]["borderradius"].";";
			}
			if(!empty($g["Graphelement"]["margin"])) echo "margin:".$g["Graphelement"]["margin"].";";
			if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
			
			if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
			
			if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimg"]."');";
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
			if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";
			if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
			if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
			if(!empty($g["Graphelement"]["borderradius"])){
				echo "-moz-border-radius:".$g["Graphelement"]["borderradius"].";";
				echo "-webkit-border-radius:".$g["Graphelement"]["borderradius"].";";
			}
			if(!empty($g["Graphelement"]["margin"])) echo "margin:".$g["Graphelement"]["margin"].";";
			if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
			
			if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
			
			if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimg"]."');";
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
			if(!empty($g["Graphelement"]["width"])) echo "max-width:".$g["Graphelement"]["width"]."px;";
			if(!empty($g["Graphelement"]["height"])) echo "height:".$g["Graphelement"]["height"]."px;";
			if(!empty($g["Graphelement"]["border"])) echo "border:".$g["Graphelement"]["border"].";";
			if(!empty($g["Graphelement"]["borderradius"])){
				echo "-moz-border-radius:".$g["Graphelement"]["borderradius"].";";
				echo "-webkit-border-radius:".$g["Graphelement"]["borderradius"].";";
			}
			if(!empty($g["Graphelement"]["margin"])) echo "margin:".$g["Graphelement"]["margin"].";";
			if(!empty($g["Graphelement"]["padding"])) echo "padding:".$g["Graphelement"]["padding"].";";
			
			if(!empty($g["Graphelement"]["fondcolor"])) echo "background-color:".$g["Graphelement"]["fondcolor"].";";
			
			if(!empty($g["Graphelement"]["fondimg"])) echo "background-image:url('".Configure::read('Parameter.prefix')."/img/graph/".$g["Graphelement"]["fondimg"]."');";
			if(!empty($g["Graphelement"]["fondimgrepeat"])) echo "background-repeat:".$g["Graphelement"]["fondimgrepeat"].";";
			if(!empty($g["Graphelement"]["fondimgpos"])) echo "background-position:".$g["Graphelement"]["fondimgpos"].";";
			if(!empty($g["Graphelement"]["textsize"])) echo "font-size:".$g["Graphelement"]["textsize"].";";
			if(!empty($g["Graphelement"]["textfont"])) echo "font-family:".$g["Graphelement"]["textfont"].";";
			if(!empty($g["Graphelement"]["textcolor"])) echo "color:".$g["Graphelement"]["textcolor"].";";
			if(!empty($g["Graphelement"]["textalign"])) echo "text-align:".$g["Graphelement"]["textalign"].";";
			if(!empty($g["Graphelement"]["textgras"])) echo "font-weight:".$g["Graphelement"]["textgras"].";";
		echo "}";
	*/
?>