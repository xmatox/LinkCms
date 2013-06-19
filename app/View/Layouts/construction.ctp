<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Site Internet en construction</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
img.centre{
	display:block;
	clear:both;
	margin-left:auto;
	margin-right:auto;
	vertical-align:middle;
	
}
-->
</style></head>
<body>
<?php
echo $this->Html->link(
	$this->Html->image('construction.jpg', array(
		"alt" => "En construction",'class'=>"centre"
	)),
	"http://thomas-abadie.net/",
	array('target'=>"_blank",'escape'=>false)
);
?>
</body>
</html>