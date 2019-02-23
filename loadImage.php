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

//Cette API n'est destinée qu'au membre du bureau. Ainsi sans le nom et le mot de passe elle ne revoie rien du tout
//Données de l'URL :
$idAdmin = $_POST['idAdmin'];//On récupère le nom associé
$mdpAdmin = hash('sha256', $_POST['MdpAdmin']);//Et on récupère le HASH su mot de passe associé.

$idAdherent = $_POST['idAdherent'];


$checkInfo = $bdd->query('SELECT * FROM ListeAdherents WHERE id="'.$idAdmin.'"');

//On formatte les données récupérés
$infos = $checkInfo->fetch();


if($infos['Mdp'] != "" && $infos['Mdp'] != "none" && ($infos['Statut'] == "Membre du bureau" || $infos['Statut'] == "Super-admin" || $infos['Statut'] == "Développeur")) { //Si on detecte un mot de passe et qu'il est bien renseigné, et que l'élève est bien accredité 
	//La connexion est prête. Verification du mdp : 
	if($infos['Mdp'] == $mdpAdmin) {
		//On execute en MySQL pour atteindre la database voulue
		$reponse = $bdd->query('SELECT * FROM ListeAdherents WHERE id="'.$idAdherent.'"');

		$donnesReponse = $reponse -> fetch();

		if($donnesReponse['ImageData'] == ""){
			?>"Aucune données"<?php
		} else {
			?>"<?php echo $donnesReponse['ImageData'];?>"<?php
		}
		
		

		$reponse -> closeCursor();
	} else { // Les infromations sont cohérentes mais le mot de passe est faux
		?>"Mdp incorrect"<?php
	}
	
} else { // Les infromations ne sont pas bonnes
	?>"Autorisation refusée"<?php
}