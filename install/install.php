<?php
function netvar($var){
	return addslashes($var);
}
if(isset($_POST["submit"]) || isset($_POST["next"])){
	$erreur = "";
	foreach($_POST as $key=>$val){
		if(empty($val) && $key!="passwd" && $key!="dosencours"){
			$erreur = "Veuillez remplir tous les champs";
			break;
		}
	}
	if(isset($_POST["next"]) && $_POST["next"]=="2"){
		$user = $_POST["user"];
		$passwd = $_POST["passwd"];
		$host = $_POST["host"];
		$database = $_POST["database"];
		if(!mysql_connect($host,$user,$passwd)){
			$erreur = "Impossible de se connecter à la base de donnée, vérifiez vos identifiants de connection";
		}
		else if(!mysql_select_db($database)){
			$erreur = "La connection à la base de donnée a échoué, vérifiez vos identifiants de connection";
		}
	}
}
if(isset($_POST["submit"]) && empty($erreur)){
	$user = $_POST["user"];
	$passwd = $_POST["passwd"];
	$host = $_POST["host"];
	$database = $_POST["database"];
	$dosencours = $_POST["dosencours"];
	$typeinstall = $_POST["typeinstall"];
	if($dosencours == "/") $dosencours = "";
	else if(substr($dosencours, 0,1) != "/") $dosencours = "/".$dosencours;
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
			if($typeinstall=="entreprise")
				$sql = file_get_contents("init_entreprise.sql",FILE_USE_INCLUDE_PATH);
			else
				$sql = file_get_contents("init_standard.sql",FILE_USE_INCLUDE_PATH);
			//
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
					(3, 'Dossier du site', 'prefix', '".$dosencours."'),
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>Link To The Web</title>
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
	margin-top: 20px;
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
.filEtape{
	width: 100%;
	height: 30px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
}
.fe_install{
	width: 157px;
	height: 25px;
	background-color: #999;
	color: #fff;
	padding-top: 5px;
	padding-left: 20px;
	font-size: 19px;
	text-align: left;
	float: left;
}
.fe_etape{
	width: 140px;
	height: 22px;
	background-color: #f6f3f3;
	color: #666;
	padding-top: 8px;
	font-size: 16px;
	float: left;
	border-left: 1px solid #ddd;
}
.fe_etape_now{
	width: 140px;
	height: 22px;
	background-color: #f6f3f3;
	color: #666;
	padding-top: 8px;
	font-size: 15px;
	font-weight: bold;
	float: left;
	border-left: 1px solid #ddd;
}
.fe_etape_ok{
	width: 140px;
	height: 22px;
	background-color: #41c404;
	color: #fff;
	padding-top: 8px;
	font-size: 16px;
	float: left;
	border-left: 1px solid #ddd;
}
</style>
</head>
<body>
<?php
if(isset($_POST["submit"]) && empty($erreur)){
?>
<div class="loginConteneur">
	<div class="loginFormulaire">
		<br/>
		<div class="filEtape">
			<div class="fe_install">Installation</div>
			<div class="fe_etape_ok">Général</div>
			<div class="fe_etape_ok">Base de Donnée</div>
			<div class="fe_etape_ok">Finalisation</div>
		</div>
		Installation Terminée !
		<br/><br/>
		Félicitation vous avez correctement installé Link To The Web
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
		<br/>
		<div class="filEtape">
			<div class="fe_install">Installation</div>
			<?php if(!isset($_POST["next"]) || ($_POST["next"]=="1" && !empty($erreur))){ ?>
				<div class="fe_etape_now">Général</div><div class="fe_etape">Base de Donnée</div><div class="fe_etape">Finalisation</div>
			<?php }else{ if($_POST["next"]=="1" || !empty($erreur)){ ?>
				<div class="fe_etape_ok">Général</div><div class="fe_etape_now">Base de Donnée</div><div class="fe_etape">Finalisation</div>
			<?php }else if($_POST["next"]=="2"){ ?>
				<div class="fe_etape_ok">Général</div><div class="fe_etape_ok">Base de Donnée</div><div class="fe_etape_now">Finalisation</div>
			<?php } } ?>
		</div>
		<?php 
		if(isset($erreur)){
			echo '<p class="erreur">'.$erreur.'</p>';
		}else{
			echo '<br/>';
		}
		if(!isset($_POST["next"]) || ($_POST["next"]=="1" && !empty($erreur))){
		?>
			<h1>Informations Générales</h1>
			<div class="loginGauche"> Nom du site : </div>
			<div class="loginDroit"><input name="nomsite" type="text" value=""/> </div><br />
			<h2>Administrateur</h2>
			<div class="loginGauche"> Nom : </div>
			<div class="loginDroit"><input name="nom" type="text" value=""/> </div><br />
			<div class="loginGauche"> Prenom : </div>
			<div class="loginDroit"><input name="prenom" type="text" value=""/> </div><br />
			<div class="loginGauche"> Adresse E-mail : </div>
			<div class="loginDroit"><input name="login" type="text" value=""/> </div><br />
			<input name="next" type="hidden" value="1"/>
			<div class="loginCentre"><input name="nextBtn" value=" Suivant " type="submit" class="btnValider"/></div>
		<?php }else{ 
			if($_POST["next"]=="1" || !empty($erreur)){
		?>
				<h1>Base de donnée</h1>
				<input name="nomsite" type="hidden" value="<?php echo $_POST["nomsite"]; ?>"/>
				<input name="nom" type="hidden" value="<?php echo $_POST["nom"]; ?>"/>
				<input name="prenom" type="hidden" value="<?php echo $_POST["prenom"]; ?>"/>
				<input name="login" type="hidden" value="<?php echo $_POST["login"]; ?>"/>
				<div class="loginGauche"> Base de Données : </div>
				<div class="loginDroit"><input name="database" type="text" value=""/> </div><br />
				<div class="loginGauche"> Host : </div>
				<div class="loginDroit"><input name="host" type="text" value=""/> </div><br />
				<div class="loginGauche"> Utilisateur : </div>
				<div class="loginDroit"><input name="user" type="text" value=""/> </div><br />
				<div class="loginGauche">Mot de Passe : </div>
				<div class="loginDroit"><input name="passwd" type="password" value=""/></div><br />
				<input name="next" type="hidden" value="2"/>
				<div class="loginCentre"><input name="nextBtn" value=" Suivant " type="submit" class="btnValider"/></div>
		<?php 
			}else if($_POST["next"]=="2"){
				$ados = explode('\\', ROOT);
				$nbados = count($ados);
				$dosencours = "";
				for($i=$nbados-1;$i>0;$i--){
					$dosencours .= "/";
					$dosencours .= $ados[$nbados-$i];
					
				}
				?>
				<h1>Informations Installation</h1>
				<input name="nomsite" type="hidden" value="<?php echo $_POST["nomsite"]; ?>"/>
				<input name="nom" type="hidden" value="<?php echo $_POST["nom"]; ?>"/>
				<input name="prenom" type="hidden" value="<?php echo $_POST["prenom"]; ?>"/>
				<input name="login" type="hidden" value="<?php echo $_POST["login"]; ?>"/>
				<input name="database" type="hidden" value="<?php echo $_POST["database"]; ?>"/>
				<input name="host" type="hidden" value="<?php echo $_POST["host"]; ?>"/>
				<input name="user" type="hidden" value="<?php echo $_POST["user"]; ?>"/>
				<input name="passwd" type="hidden" value="<?php echo $_POST["passwd"]; ?>"/>
				<div class="loginGauche">Type d'installation : </div>
				<div class="loginDroit">
					<select name="typeinstall" id="typeinstall">
						<option value="standard">Standard</option>
						<option value="entreprise">Entreprise</option>
					</select>
				</div><br />
				<div class="loginGauche">Dossier : </div>
				<div class="loginDroit"><input type="text" name="dosencours" value="<?php echo $dosencours; ?>"/></div><br />
				<div class="loginCentre"><input name="submit" value=" Valider " type="submit" class="btnValider"/></div>
			<?php 
			} 
		}
		?>
	</div>
</div>

</form>
<?php } ?>
</body></html>