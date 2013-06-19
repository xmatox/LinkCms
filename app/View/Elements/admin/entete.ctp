<?php
if($this->Session->read('Auth.User.id')){
	?>
	<div id="titre_admin">Administration</div>

<div id="connect_admin">
<?php
	echo "Bonjour ";
	echo $this->Session->read('Auth.User.prenom');
	//echo " ".$this->Session->read('Auth.User.nom');
	echo " [ ";
	echo $this->Html->link(
		"Déconnection",
		array(
			'controller' => 'users', 
			'action' => 'logout'
		),
		array('escape'=>false)
	);
	echo " ] - ";
	if (!Configure::read('Parameter.production')) {
		echo $this->Html->link(
			"Accès site Internet",
			array(
				'controller' => 'rubriques', 
				'action' => 'view',
				'admin' => false,
				'plugin' => false,
				1
			),
			array('escape'=>false)
		);
	}else{
		echo $this->Html->link(
			"Accès site Internet",
			array(
				'controller' => '/', 
				'admin' => false,
				'plugin' => false
			),
			array('escape'=>false)
		);
	}
	?>
	</div>
<?php
}
?>