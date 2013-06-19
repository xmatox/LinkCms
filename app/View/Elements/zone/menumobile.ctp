<?php
$elements = $this->requestAction('zoneelements/viewmobile/3');
foreach ($elements as $element){
	echo $element;
}
/*$element = $this->requestAction('menugroupes/mobile');
echo $element;*/
?>