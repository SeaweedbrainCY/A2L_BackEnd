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
$code = $_POST['CodeTemporaire'];

$reponse = $bdd->query('SELECT * FROM ListeAdherents WHERE Nom="'.$nom.'"');

$donnesReponse = $reponse -> fetch();

if($donnesReponse['Statut'] == "Membre du bureau" || $donnesReponse['Statut'] == "Développeur" || $donnesReponse['Statut'] == "Super-admin") { // On vérifie que le demandeur à bien le droit de demander
	if($donnesReponse['CodeTemporaire'] != ""){
		if(password_verify($code,$donnesReponse['CodeTemporaire'])) {
			?>"Success"<?php
		} else {
			?>"Code temporaire faux"<?php
		}
	} else {
	?>"Aucun code temporaire"<?php
	}
} else {
	?>"Accès au serveur refusé"<?php
}


		
$reponse -> closeCursor();