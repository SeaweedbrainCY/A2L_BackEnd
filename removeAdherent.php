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

$nom = $_POST['Nom'];
$id = $_POST['id'];


//Cette API n'est destinée qu'au membre du bureau. Ainsi sans le nom et le mot de passe elle ne revoie rien du tout
//Données de l'URL :
$idAdmin = $_POST['idAdmin'];
$mdpAdmin = hash('sha256', $_POST['MdpAdmin']);

$checkInfo = $bdd->query('SELECT * FROM ListeAdherents WHERE id="'.$idAdmin.'"');

//On formatte les données récupérés
$infos = $checkInfo->fetch();

if($infos['Mdp'] != "" && $infos['Mdp'] != "none" && ($infos['Statut'] == "Membre du bureau" || $infos['Statut'] == "Super-admin" || $infos['Statut'] == "Développeur")) { //Si on detecte un mot de passe et qu'il est bien renseigné, et que l'élève est bien accredité 
	//La connexion est prête. Verification du mdp : 
	if($infos['Mdp'] == $mdpAdmin) {
		$bdd->exec('DELETE FROM ListeAdherents WHERE id = "'.$id.'" AND Nom = "'.$nom.'"');
?>"success"<?php
	} else {
		?>"Mot de passe incorrect"<?php
	}
} else {
	?>"Accès au serveur refusé"<?php
}
?>