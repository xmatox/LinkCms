<?php
if($this->Session->read('Auth.User.id')){
	?>
	<div id="zoneparam" class="zoneparam">
	<?php 
		echo $this->element('edit/mep_general'); 
		echo $this->element('edit/rubriques'); 
		echo $this->element('edit/mep_zone'); 
		echo $this->element('edit/ajout_element'); 
		echo $this->element('edit/ajout_contenu'); 
		echo $this->element('edit/mep_element'); 
		echo $this->element('edit/plugins'); 
		echo $this->element('edit/menus'); 
		echo $this->element('edit/parametre'); 
	?>
	</div>
	<div class="clear"></div>
<?php
}
?>