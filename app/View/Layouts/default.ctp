<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-FR">
<head>
<?php echo $this->Html->charset(); ?>
<meta http-equiv="content-language" content="fr-FR" />
<meta name="Author" content="http://www.soma-creation.net"/>
<meta name="language" content="fr"/>
<meta name="robots" content="index,follow,all"/>
<meta name="category" content="Music" />
<meta name="viewport" content="width=device-width">
<title>
	<?php echo $title_for_layout; ?>
</title>
<meta name="description" content="<?php echo $metadesc_for_layout; ?>" />
<meta name="Keywords" content="<?php echo $metakey_for_layout; ?>" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css">
<script type="text/javascript">
	$(document).ready(function() {
		var __prefix = '<?php echo Configure::read('Parameter.prefix'); ?>';
		var __idrub = '<?php echo $idrub; ?>';
	});
	var __prefix = '<?php echo Configure::read('Parameter.prefix'); ?>';
	var __idrub = '<?php echo $idrub; ?>';
</script>
	<?php
		if(Configure::read('Parameter.icone')==true){
			echo $this->Html->meta('favicon.ico',Configure::read('Parameter.prefix').'/img/general/icone/favicon.ico',array('type' => 'icon'));
		}else{
			echo $this->Html->meta('favicon.ico',Configure::read('Parameter.prefix').'/favicon.ico',array('type' => 'icon'));
		}

		if(Configure::read('Parameter.scrollnav')==true){
			echo $this->Html->script("jquery/smint/jquery.smint.js");
			echo $this->Html->script("jquery/smint/initsmint.js");
		}
		/*echo $this->Html->css('knacss/knacss.css');
		echo $this->Html->css('knacss/nav.css');*/
		echo $this->Html->css('responsive.css');
		echo $this->Html->css('style.css');
		echo $this->Html->css('general.css');
		echo $this->Html->css("cssgeneral.css");
		echo $this->Html->css("menu.css");
		echo $this->Html->script("menu.js");
		echo $this->Html->script("fonction.js");
		echo $this->Html->script("jquery/sudoslider/jquery.sudoSlider.min.js");
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		if($this->Session->read('Auth.User.role')=="admin" || $this->Session->read('Auth.User.role')=="webmaster"){
			echo $this->Html->css('edit.css');
			echo $this->Html->script("/js/jquery/colorpicker/js/colorpicker.js");
			echo $this->Html->script("/js/jquery/colorpicker/js/eye.js");
			echo $this->Html->script("/js/jquery/colorpicker/js/utils.js");
			echo $this->Html->script("/js/jquery/colorpicker/js/layout.js?ver=1.0.2");
			echo $this->Html->css("/js/jquery/colorpicker/css/colorpicker.css");
			echo $this->Html->css("/js/jquery/colorpicker/css/layout.css");
			echo $this->Html->script("/js/multiupload/dropfile.js");
			echo $this->Html->css("/js/multiupload/style.css");
			echo $this->Html->css('/admin/graph.css');
			echo $this->Html->script("fonction_user.js");
			echo $this->Html->script("graph/graph_user.js");
			echo $this->Html->script("graph/zone_user.js");
			echo $this->Html->script("graph/editzone_user.js");
			echo $this->Html->script("graph/rub_user.js");
			echo $this->Html->script('ckeditor/ckeditor');
		}
	//
	if(Configure::read('Parameter.cache')) $autocache=true; else $autocache=false;
	if(Configure::read('Parameter.googleanalytics')!=""){
	?>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '<?php echo Configure::read("Parameter.googleanalytics"); ?>']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	<?php } ?>
</head>
<body id="fond">
	<div id='mobilehead' class='clear'>
		<?php
		echo $this->element('zone/menumobile', array('cache' => $autocache));
		?>
		<div class='clear'></div>
	</div>
	<?php 
	if($this->Session->read('Auth.User.role')=="admin"){
		echo $this->element('edit/general');
		$supclass = " resizable";
		$supclass2 = " editable";
		$supclass_contenu = " resizable_contenu";
		$supclass_tete = " resizable_tete";
		$supclass_pied = " resizable_pied";
		$supclass_gauche = " resizable_gauche";
		$supclass_droite = " resizable_droite";
		$supclass_centre = " editable_centre";
	}else{
		$supclass = "";
		$supclass2 = "";
		$supclass_contenu = "";
		$supclass_tete = "";
		$supclass_pied = "";
		$supclass_gauche = "";
		$supclass_droite = "";
		$supclass_centre = "";
	}
	 ?>
		<div id="contenu" class="line center<?php echo $supclass_contenu; ?>">
			<div id="tete" class="header line mod <?php echo $supclass_tete.$supclass2; ?>">
				<?php
				echo $this->element('zone/tete', array('cache' => $autocache));
				?>
			</div>
			<div class="row gut">
				<div id="gauche" class="col mod <?php echo $supclass_gauche.$supclass2; ?>">
					<?php
					echo $this->element('zone/gauche', array('cache' => $autocache));
					?>
				</div>
				
				<div id="centre" class="col <?php echo $supclass_contenu.$supclass_centre; ?>">
					<?php echo $this->Session->flash(); ?>

				<?php echo $this->fetch('content'); ?>
				</div>
				<div id="droite" class="col mod <?php echo $supclass_droite.$supclass2; ?>">
					<?php
					echo $this->element('zone/droite', array('cache' => $autocache));
					?>
				</div>
			</div>
		</div>
		<div id="pied" class="footer line <?php echo $supclass_pied.$supclass2; ?>">
			<div id="piedcont">
				<?php
				echo $this->element('zone/pied', array('cache' => $autocache));
				?>
			</div>
		</div>
	<?php 
	//admin edit
	if($this->Session->read('Auth.User.role')=="admin" || $this->Session->read('Auth.User.role')=="webmaster"){
		if(!empty($rub)){
			echo "<div class='editadmin'><a>EDITER</a><div class='editadmincont'>".$simpleEdit."</div></div>";
		}
	}
	//echo $this->element('sql_dump'); 
	//admin edit
	/*if($this->Session->read('Auth.User.role')=="admin"){
		if(!empty($rub)){
			$urladmin = $this->Html->link(
				"EDITER LA PAGE EN COURS",
				array(
					'controller'=>strtolower($rub["Contenutype"]["table"]), 
					'action'=>"edit", 
					$rub["Rubrique"]["contenupage_id"],
					'plugin'=>strtolower($rub["Contenutype"]["table"]),
					'admin'=>true
				),
				array('escape'=>false,'target'=>"_blank")
			);
			echo "<div class='editadmin hide_mobile'>".$urladmin."</div>";
		}
	}*/
	?>
</body>
</html>
