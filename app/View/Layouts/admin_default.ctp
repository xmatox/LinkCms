
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="Author" content="http://www.soma-creation.net"/>
<meta name="language" content="fr"/>
<meta name="robots" content="index,follow,all"/>
<meta name="category" content="Internet" />

<!--<link rel="icon" href="/sitesoma2/images/logo.gif" type="image/gif" />-->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript">

	 var __prefix = "<?php echo Configure::read('Parameter.prefix'); ?>";

</script>
<?php 

echo $this->Html->css('responsive.css');
echo $this->Html->css("/admin/style"); 
echo $this->Html->script("fonction_admin.js");
echo $this->Html->script("jquery/sudoslider/jquery.sudoSlider.js");
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
echo $this->Html->script('ckeditor/ckeditor');
?>

</head>
<body>
<?php
if($this->Session->read('Auth.User.id')){
?>
	<div id="entete">
		<div id="enteteH">
		<?php
			echo $this->element("/admin/entete");
		?>
		</div>
		<div id="menu">
		<?php
			//echo $this->element("menu",array("cache"=>"1 day"));
			echo $this->element("/admin/menu");
		?>
		</div>
	</div>
<?php
}
?>
<div id="contenu" <?php if(!$this->Session->read('Auth.User.id')){ echo "class='contenulogin'";} ?>>
	<?php
		//
	    echo $this->Session->flash();
		echo $this->Session->flash('auth');
		//
		echo $content_for_layout;
	?>
	
	
</div>
<div class="clear"></div>
<div id="pieda">
<?php
	echo $this->element("/admin/pied");
?>
</div>
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>