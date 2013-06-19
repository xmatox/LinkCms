<?php
function netvar($var){
	return addslashes($var);
}
if(isset($_POST["submit"])){
	$erreur = "";
	foreach($_POST as $key=>$val){
		if(empty($val) && $key!="passwd"){
		
			$erreur = "Veuillez remplir tous les champs";
			break;
		}
	}
	if(empty($erreur)){

		$user = $_POST["user"];
		$passwd = $_POST["passwd"];
		$host = $_POST["host"];
		$database = $_POST["database"];
		$dosencours = $_POST["dosencours"];
		/*$thisurl =  dirname(dirname(__FILE__));
		$exp = explode('\\',$thisurl);
		$nbexp = count($exp);
		$prefix = $exp[$nbexp-1];*/
		$nomsite = netvar($_POST["nomsite"]);
		$prefix = strtolower(trim($nomsite));
		$prefix=str_replace(' ','',$prefix);
		$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_]@');
		$replace = array ('e','a','i','u','o','c','_','');
		$prefix=preg_replace($search, $replace, $prefix);
		$prefix=substr($prefix,0,6)."_";
		
		$nomsite = netvar($_POST["nomsite"]);
		$nom = netvar($_POST["nom"]);
		$prenom = netvar($_POST["prenom"]);
		$login = netvar($_POST["login"]);
		

		if(@mysql_connect($host,$user,$passwd)){
			if(@mysql_select_db($database)){

				$sql = file_get_contents("init.sql",FILE_USE_INCLUDE_PATH);

				//include("init.php");
				$sql = str_replace("__PREFIX", $prefix, $sql);
				$requetes = explode(' ;', $sql);
				$nbrequetes = count($requetes);
				$i=0;
				foreach ($requetes as $val) {
					if (!empty($val) && $i<$nbrequetes-1) {
						if(!mysql_query($val)){
							echo mysql_error()."<br/><br/>".$val;
							$erreur = "Une erreur est survenu lors de initialisation de votre base de données.";
							break;
						}
					}
					$i++;
				}

				if(empty($erreur)){
					$sqlParam = "INSERT INTO `".$prefix."parametres` (`id`, `intitule`, `nom`, `value`) VALUES
						(1, 'Nom du site', 'nomsite', '".$nomsite."'),
						(2, 'Langue par defaut', 'langue', 'fre'),
						(3, 'Dossier du site', 'prefix', '/".$dosencours."'),
						(4, 'Logo', 'logo', ''),
						(5, 'Favicon', 'icone', '0'),
						(6, 'Mode', 'production', '1'),
						(7, 'Mise en cache', 'cache', '0'),
						(8, 'Google analytics', 'googleanalytics', '');";
					if(!mysql_query($sqlParam)) $erreur = "Une erreur est survenu lors de initialisation des parametres.";

					$sqlUsers = "INSERT INTO `".$prefix."users` (`id`, `username`, `password`, `role`, `nom`, `prenom`, `created`, `modified`) VALUES
						(1, '".$login."', 'ad7222ce80502c418ca04de25056b9d84aade8e1', 'admin', '".$nom."', '".$prenom."', NOW(), NOW());";
					if(!mysql_query($sqlUsers)) $erreur = "Une erreur est survenu lors de initialisation des utilisateurs.";

					// création du fichier sur le serveur
					$fichierContenu = '<?php
						class DATABASE_CONFIG {
							public $default = array(
								"datasource" => "Database/Mysql",
								"persistent" => false,
								"host" => "'.$host.'",
								"login" => "'.$user.'",
								"password" => "'.$passwd.'",
								"database" => "'.$database.'",
								"prefix" => "'.$prefix.'",
								//"encoding" => "utf8",
							);
							public $dummy = array("datasource" => "DummySource");
						}';
					if(!$leFichier = fopen(ROOT."/app/Config/database.php", "wb")){
						$erreur = "Une erreur est survenu lors de la création du fichier de configuration.<br/>Verifiez les droits du dossier Config dans ".ROOT."/app/";
					}else{
						if(!fwrite($leFichier,$fichierContenu)) {
							$erreur = "Une erreur est survenu lors de l'écriture dans le fichier de configuration ".ROOT."/app/Config/database.php.";
						}else{
							fclose($leFichier);

							unlink(ROOT."/install.txt");

							//echo '<script type="text/javascript">window.location = "'.ROOT.'/admin666";document.location.href = "'.ROOT.'/admin666";</script>';
							//header('Location: '.ROOT.'/admin666'); 
						}
					}
				}
			}else{
				$erreur = "La base de données n'existe pas";
			}
		}else{
			$erreur = "Impossible de se connecter à la base de données";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>CMS </title>
<style type="text/css">
body {
	background: #E4E4E4;
	font-family: Arial, Helvetica, sans-serif;
	font-size: small;
	color: #000000;
	margin: 0px; 
	padding:0px;
}
a , a:link , a:visited{
	outline: none;
	color: #0c5674;
	text-decoration: none;
}
a:hover {
	
	text-decoration: underline;
}
.loginConteneur{
	margin-left: auto;
	margin-right: auto;
	margin-top:100px;
	padding-top:20px;
	height:400px;
	width:600px;
	text-align:center;
}
.loginFormulaire{
	margin-left: auto;
	margin-right: auto;
	border-color: #333333;
	border-width: 2px;
	height:400px;
	width:600px;
	background-color:#FFFFFF;
	text-align:center;
	border-radius: 10px;
}
.erreur{
	color:#FF0000;
	font-size:16px;
	font-weight:bold;
}
.loginGauche{
	width:49%;
	height:30px;
	float:left;
	text-align:right;
}
.loginDroit{
	width:49%;
	height:30px;
	float:right;
	text-align:left;
}
.loginCentre{
	width:100%;
	height:30px;
	float:right;
	text-align:center;
}

/*  ------------------------------------------ pied ------------------------------------------ */

.pied{
	height:32px;
	width:100%;
	background-image:url(../images/css/fond_pied.jpg);
	background-repeat:repeat-x;
	position: absolute;
	position:fixed;
	bottom:0px;
}
.mention{
	position: absolute;
	position:fixed;
	height:15px;
	width:100%;
	bottom:2px;
	margin-left:20px;
	margin-right:20px;
	font-size:12px;
	color:#e4e6e6;
}
</style>
</head>
<body>
<?php
if(isset($_POST["submit"]) && empty($erreur)){
?>
<div class="loginConteneur">
<div class="loginFormulaire">
	Installation Terminée !
	<br/><br/>
	Félicitation vous avez correctement installé ...
	<br/><br/>
	Vous pouvez dès à présent vous connecter à <a href="admin666">la console d'administration.</a>
	<br/><br/>
	Login : <b><?php echo $login; ?></b><br/>
	Mot de passe : <b>123123</b><br/>
	<i>Pensez à modifier votre mot de passe dès votre première connection.</i>
</div>
</div>
<?php
}else if(!isset($_POST["submit"]) || !empty($erreur)){
?>

<form name="form1" method="post" action="">
<div class="loginConteneur">
<div class="loginFormulaire">

<?php 
if(isset($erreur)){
	echo '<p class="erreur">'.$erreur.'</p>';
}else{
	echo '<br/><br/>';
}
?>

<div class="loginGauche"> Nom du site : </div>
<div class="loginDroit"><input name="nomsite" type="text" value=""/> </div><br />

<div class="loginGauche"> Nom : </div>
<div class="loginDroit"><input name="nom" type="text" value=""/> </div><br />
<div class="loginGauche"> Prenom : </div>
<div class="loginDroit"><input name="prenom" type="text" value=""/> </div><br />
<div class="loginGauche"> Adresse E-mail : </div>
<div class="loginDroit"><input name="login" type="text" value=""/> </div><br />

<div class="loginGauche"> Base de Données : </div>
<div class="loginDroit"><input name="database" type="text" value=""/> </div><br />
<div class="loginGauche"> Host : </div>
<div class="loginDroit"><input name="host" type="text" value=""/> </div><br />
<div class="loginGauche"> Utilisateur : </div>
<div class="loginDroit"><input name="user" type="text" value=""/> </div><br />
<div class="loginGauche">Mot de Passe : </div>
<div class="loginDroit"><input type="password" name="passwd" value=""/></div><br />
<?php 
$ados = explode('\\', ROOT);
$nbados = count($ados);
$dosencours = $ados[$nbados-1];
?>
<div class="loginGauche">Dossier : </div>
<div class="loginDroit"><input type="dosencours" name="text" value="<?php echo $dosencours; ?>"/></div><br />


<div class="loginCentre"><input name="submit" value=" Valider " type="submit" class="btnValider"/></div>
</div>
</div>

</form>
<?php } ?>
</body></html>