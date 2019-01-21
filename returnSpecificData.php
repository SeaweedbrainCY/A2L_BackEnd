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
$nom = $_GET['Nom'];//On récupère le nom associé
$mdp = $_GET['Mdp'];//Et on récupère le HASH su mot de passe associé.

$checkInfo = $bdd->query('SELECT * FROM ListeAdherents WHERE Nom="'.$nom.'"');

//On formatte les données récupérés
$infos = $checkInfo->fetch();


if($infos['Mdp'] != "" && $infos['Mdp'] != "none" && ($infos['Statut'] != "Membre du bureau" || $infos['Statut'] != "Super-admin")) { //Si on detecte un mot de passe et qu'il est bien renseigné, et que l'élève est bien accredité 
	//La connexion est prête. Verification du mdp : 
	if($infos['Mdp'] == $mdp) {
		//On execute en MySQL pour atteindre la database voulue
		$reponse = $bdd->query('SELECT * FROM ListeAdherents');


		//Tableau total de la forme [[id:1, Nom: "nom",Statut = "adherent",DateNaissance: 2002-11-14], [id:2, Nom: "nom2",Statut = "adherent",DateNaissance: 2002-11-14]]
		$entireArray = array();


		while($donnees = $reponse->fetch()) 
		{
			//on constitue le dictionnaire
			$row['id'] = $donnees['id'];
			$row['Nom'] = $donnees['Nom'];
			$row['Statut'] = $donnees['Statut'];
			$row['DateNaissance'] = $donnees['DateNaissance'];

			//on ajoute le dictionnaire au tableau général
			$entireArray[] = $row;

		}

		//On encode en JSON, convention pour une API
		print json_encode($entireArray);

		$reponse -> closeCursor();
	} else { // Les infromations sont cohérentes mais le mot de passe est faux
		?>Mdp incorrect<?php
	}
	
} else { // Les infromations ne sont pas bonnes
	?>Autorisation refusée<?php
}



?>
