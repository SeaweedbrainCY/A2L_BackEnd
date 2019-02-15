<!--Fonction très utilisé puisque la racine de l'application-->
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

$id = $_POST['id']; // est totalement unique
$pointFidelite = $_POST['PointFidelite'];

$idAdmin = $_POST['idAdmin'];
$mdpAdmin = hash('sha256', $_POST['mdpAdmin']);

$checkInfo = $bdd->query('SELECT * FROM ListeAdherents WHERE id="'.$idAdmin.'"');

//On formatte les données récupérés
$infos = $checkInfo->fetch();

if($infos['Mdp'] != "" && $infos['Mdp'] != "none" && ($infos['Statut'] == "Membre du bureau" || $infos['Statut'] == "Super-admin" || $infos['Statut'] == "Développeur")) { //Si on detecte un mot de passe et qu'il est bien renseigné, et que l'élève est bien accredité 
	//La connexion est prête. Verification du mdp : 
	if($infos['Mdp'] == $mdpAdmin) {
		$bdd->exec('UPDATE ListeAdherents SET PointFidelite = "'.$pointFidelite.'" WHERE id = "'.$id.'"');
		//Ne peut être executé que par un admin/super-admin/developpeur
	} else {
		?>"Accès au serveur refusé"<?php
	}
} else {
	?>"Accès au serveur refusé"<?php
}


?>
