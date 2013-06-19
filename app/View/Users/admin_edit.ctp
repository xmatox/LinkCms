<?php

echo "<h1>";
	echo $this->Js->link(
		"Utilisateurs",
		array(
			'controller'=>'users', 
			'action'=>'list'
		),
		array('buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</h1>";

?>

<div class="users form">
	<fieldset>
		<legend>
		<?php if(!empty($this->Form->data["User"]["nom"])){ 
			echo $this->Form->data["User"]["nom"]." ".$this->Form->data["User"]["prenom"];
		}else{ 
			echo "Nouvel utilisateur";
		} ?>
		</legend>
	<?php
		echo $this->Form->create('User');
		echo $this->Form->input('id');
		echo $this->Form->input('username',array("label"=>"Login : ","size" => "30px"));
		echo $this->Form->input('password',array("type"=>"password","label"=>"Mot de passe : ","size" => "30px"));
		echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'webmaster' => 'Webmaster', 'writter' => 'Writter')
        ));
		echo $this->Form->input('nom',array("label"=>"Nom : ","size" => "30px"));
		echo $this->Form->input('prenom',array("label"=>"Prenom : ","size" => "30px"));
		//echo $this->Form->end(__('Submit', true));
		echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
	echo $this->Js->writeBuffer();
	?>
	</fieldset>

</div>
