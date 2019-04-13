<?php 
try
{
	// On se connecte à MySQL en phase de test
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur database: '.$e->getMessage());
}




$idAdherent = $_POST['idAdherent'];
$codeNotHashed = $_POST['CodeTemporaire'];
$idAdmin = $_POST['idAdmin'];
$mdpAdmin = $_POST['MdpAdmin']; // hashé sha256
if($codeNotHashed == "nil"){
	$newCode = "";
} else {
	$newCode = password_hash($codeNotHashed, PASSWORD_BCRYPT); // on l'hash en BCrypt
}




$checkInfo = $bdd->query('SELECT * FROM ListeAdherents WHERE id="'.$idAdmin.'"');

//On formatte les données récupérés
$infos = $checkInfo->fetch();

if($infos['Mdp'] != "" && $infos['Mdp'] != "none" && ($infos['Statut'] == "Super-admin" || $infos['Statut'] == "Développeur")) { //Si on detecte un mot de passe et qu'il est bien renseigné, et que l'élève est bien accredité 
	//La connexion est prête. Verification du mdp : 
	if(password_verify($mdpAdmin,$infos['Mdp'])) {
		$bdd->exec('UPDATE ListeAdherents SET CodeTemporaire = "'.$newCode.'" WHERE id = "'.$idAdherent.'"');
		?>"Success"<?php
		//Ne peut être executé que par un admin/super-admin/developpeur
	} else {
		?>"Accès au serveur refusé"<?php
	}
} else {
	?>"Accès au serveur refusé"<?php
}


?>

