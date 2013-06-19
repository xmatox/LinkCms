<?php

echo $this->Session->flash();
echo "<br/><br/><br/><br/>";
echo "<fieldset style='width:500px;margin:auto;'>";
	echo "<legend>  </legend>";
	echo "<div class='formCenter'>";
		echo "<br/><br/>";
		echo $this->Form->create("User",array("action"=>"login"));
		echo $this->Form->input("username",array("label"=>"Login : ","size" => "30px"));
		echo $this->Form->input("password",array("type"=>"password","label"=>"Mot de passe : ","size" => "30px"));
		echo $this->Form->end("Connexion");
		echo "<br/><br/>";
	echo "</div>";
echo "</fieldset>";

?>