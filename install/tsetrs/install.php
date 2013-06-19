<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GesTC </title>
<link href="../css/login.css" rel="stylesheet" type="text/css" media="screen" />
<?php
if(isset($_POST["submit"])){
	if(isset($_POST["email"]) or isset($_POST["societe"]) or isset($_POST["password"])){

		$user = 'root';
		$passwd = '68yw9Sad';
		$host = 'localhost';
		
		include("../fonctions/cesame.php");
		
		$connexion = mysql_connect($host,$user,$passwd);
		
		$formatSociete = strtolower(trim($_POST["societe"]));
		$formatSociete=str_replace(' ','',$formatSociete);
		$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_]@');
		$replace = array ('e','a','i','u','o','c','_','');
		$formatSociete=preg_replace($search, $replace, $formatSociete);
		$formatSociete=substr($formatSociete,0,10);
		$email=$_POST["email"];
		$utilisateur = "guser_".$formatSociete;
		$nombase = "gbdd_".$formatSociete;
		$motdepasse = atencode($_POST["passe"]);

		

		$sql = "CREATE USER '$utilisateur'@'localhost' IDENTIFIED BY '$motdepasse';";
		mysql_query($sql) or die(mysql_error());
		
		$sql = "GRANT USAGE ON *.* TO '$utilisateur'@'localhost' IDENTIFIED BY '$motdepasse';";
		mysql_query($sql) or die(mysql_error());
		
		$sql = "CREATE DATABASE IF NOT EXISTS `$nombase` ;";
		mysql_query($sql) or die(mysql_error());
		
		$sql = "GRANT ALL PRIVILEGES ON `$nombase` . * TO '$utilisateur'@'localhost';";
		mysql_query($sql) or die(mysql_error());

		
		

		mysql_close();

		$urlSql = "init.sql";
		$connexion = mysql_connect($host,$utilisateur,$motdepasse) or die(mysql_error());
		$table = mysql_select_db($nombase) or die(mysql_error());

		$file = file_get_contents($urlSql);
	 
		if($file === false){
			die('Fichier erroné : '.$urlSql);
		}

		$requetes = explode(';', $file);

		foreach($requetes as $requete){
			$requete=trim($requete);
			if(isset($requete) and !empty($requete) and $requete!=""){
				mysql_query($requete.';') or die("erreur la : ".mysql_error()."<br/>".$requete);
			}
		}
		$sql  ="INSERT INTO `compte` (`nb`) VALUES ('1')";
		mysql_query($sql) or die(mysql_error());
		
		$nom_personnel=ucfirst(strtolower(trim($_POST['nom'])));
		$prenom_personnel=ucfirst(strtolower(trim($_POST['prenom'])));
		$id=$nom_personnel.$prenom_personnel.$_POST['tel'];
		$date=date('Y-m-d');
		$sql  = "INSERT INTO `personnels` (`id-personnel` ,`nom` ,`prenom` ,`civilite` ,`adresse` ,`telfixe` ,`telport` ,`email` ,`date`, `statut`, `password`, `actif`) VALUES ('".$id."', '".$nom_personnel."', '".$prenom_personnel."', '".$_POST['civilite-personnel']."', '', '".$_POST['tel']."', '', '".$_POST['email']."', '".$date."', 'superadmin', '".md5($motdepasse)."', 'oui')";
		mysql_query($sql) or die(mysql_error());	
		
		$sql  = "INSERT INTO `parametre` (`ID`, `nom`, `valeur`) VALUES (1, 'etat_rdv', 'valide'),(13, 'devis_supprimer', 'oui'),(14, 'devis_convertir', 'oui'),(15, 'facture_supprimer', 'oui'),(12, 'devis_ajouter', 'oui'),(17, 'voir_rdv', 'non'),(2, 'softphone', 'non')";
		mysql_query($sql) or die(mysql_error());
		
		$sql  = "INSERT INTO `statut` (`ID`, `type`, `nom`, `cheminPage`, `cheminUrl`) VALUES (1, 'administrateur', 'Administration', 'pages/', 'administrateur.php'),(2, 'teleprospecteur', 'Téléprospecteur', 'pages/', 'teleprospecteur.php'),(3, 'commercial', 'commercial', 'pages/', 'commercial.php'),(4, 'telecom', 'Téléprospecteur Commerciaux', 'pages/', 'telecom.php'),(5, 'superadmin', 'Super Administrateur', 'page/', 'superadmin.php')";
		mysql_query($sql) or die(mysql_error());
		
		$sql  = "INSERT INTO `texte_argu` (`ID`, `titre`, `texte`, `ouinon`, `rdv`, `parent`, `reponse`) VALUES (1, 'Accueil', '', 0, 1, 0, '')";
		mysql_query($sql) or die(mysql_error());
		
		$sql  = "INSERT INTO `texte_fin` (`ID`, `texte`) VALUES (0, '')";
		mysql_query($sql) or die(mysql_error());
		
		$sql  = "INSERT INTO `infos` (`nom`, `nom_complet`, `adresse`, `cp`, `ville`, `tel`, `siret`) VALUES ('".$_POST["societe"]."', '".$_POST["societe"]."', '', '', '', '".$_POST['tel']."', '')";
		mysql_query($sql) or die(mysql_error());
		
		$sql  = "INSERT INTO `tva` (`ID`, `tva`) VALUES (1, '')";
		mysql_query($sql) or die(mysql_error());
		
		mysql_close();
		
		
		$user2 = 'gestconn';
		$passwd2 = 'Y45hZDmQ8aNJvU7t';
		$host2 = 'localhost';
		$connexion = mysql_connect($host2,$user2,$passwd2) or die(mysql_error());
		$table = mysql_select_db($user2) or die(mysql_error());
		
		$sql  = "INSERT INTO `connection` (`ID` ,`utilisateur` ,`base` ,`mdp`) VALUES ('".$id."', '".atencode($utilisateur)."', '".atencode($nombase)."', '".atencode($motdepasse)."')";
		mysql_query($sql) or die(mysql_error());	
		$der_id = mysql_insert_id();
		
		$sql  = "INSERT INTO `utilisateur` (`email` ,`connection`) VALUES ('".$_POST['email']."', '".$der_id."')";
		mysql_query($sql) or die(mysql_error());	
		

	}else{
		$erreur = "Veuillez remplir tous les champs";
	}

}


?>



<form name="form1" method="post" action="">
<div class="loginConteneur">
<div class="loginFormulaire" style="height:242px;">

<?php 
if(isset($erreur)){
	echo '<p class="erreur">'.$erreur.'</p>';
}else{
	echo '<br/><br/>';
}
?>

<div class="loginGauche"> Societe : </div>
<div class="loginDroit"><input name="societe" type="text" value=""/> </div><br />
<div class="loginGauche"> </div>
<div class="loginDroit"><label>Mme<input type="radio" name="civilite-personnel" value="mme"></label>
<label>Mlle<input type="radio" name="civilite-personnel" value="mlle"></label>
<label>Mr<input type="radio" name="civilite-personnel" value="mr"></div><br />
<div class="loginGauche"> Nom : </div>
<div class="loginDroit"><input name="nom" type="text" value=""/> </div><br />
<div class="loginGauche"> Prenom : </div>
<div class="loginDroit"><input name="prenom" type="text" value=""/> </div><br />
<div class="loginGauche"> Tel : </div>
<div class="loginDroit"><input name="tel" type="text" value=""/> </div><br />
<div class="loginGauche"> Adresse E-mail : </div>
<div class="loginDroit"><input name="email" type="text" value=""/> </div><br />
<div class="loginGauche">Mot de Passe : </div>
<div class="loginDroit"><input type="password" name="passe" value=""/></div>
<div class="loginCentre"><input name="submit" value=" " type="submit" class="btnValider"/></div>
</div>
</div>

</form>

</body></html>