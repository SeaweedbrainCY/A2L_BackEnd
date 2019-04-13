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
$mdp = password_hash($_POST['Mdp'], PASSWORD_BCRYPT); // On hash le sha 256 en BCrypt
$codeTemporaire = $_POST['CodeTemporaire']; // en clair

$checkInfo = $bdd->query('SELECT * FROM ListeAdherents WHERE Nom="'.$nom.'"');

//On formatte les données récupérés
$infos = $checkInfo->fetch();

if($infos['CodeTemporaire'] != "" && password_verify($codeTemporaire, $infos['CodeTemporaire']) && ($infos['Statut'] == "Membre du bureau" || $infos['Statut'] == "Super-admin" || $infos['Statut'] == "Développeur")) { //Si on detecte un mot de passe et qu'il est bien renseigné, et que l'élève est bien accredité 
	//La connexion est prête. Verification du mdp :

		$req = $bdd->prepare('UPDATE ListeAdherents SET Mdp = :mdp, CodeTemporaire = :code WHERE Nom = :nom');
		$req->execute(array(
 			'nom' => $nom,
 			'mdp' => $mdp,
 			'code' => ''
 		));
		?>"Success"<?php
		//Ne peut être executé que par un admin/super-admin/developpeur
} else {
	?>"Accès au serveur refusé"<?php
}

?>

