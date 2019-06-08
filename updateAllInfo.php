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

$id = $_POST['id']; // ne change pas est reste unique pour tous
$nom = $_POST['Nom'];
$classe = $_POST['Classe'];
$dateNaissance = $_POST['DateNaissance'];
$statut = $_POST['Statut'];

$idAdmin = $_POST['idAdmin'];
$mdpAdmin = $_POST['MdpAdmin'];

$checkInfo = $bdd->query('SELECT * FROM ListeAdherents WHERE id="'.$idAdmin.'"');

//On formatte les données récupérés
$infos = $checkInfo->fetch();
    

if($infos['Mdp'] != "" && $infos['Mdp'] != "none" && ($infos['Statut'] == "Super-admin" || $infos['Statut'] == "Développeur")) { //Si on detecte un mot de passe et qu'il est bien renseigné, et que l'élève est bien accredité 
	//La connexion est prête. Verification du mdp : 
	if(password_verify($mdpAdmin,$infos['Mdp'])) {
		 $req = $bdd->prepare('UPDATE ListeAdherents SET Nom = :nom, Classe = :classe, DateNaissance = :dateNaissance, Statut = :statut WHERE id = :id');
		 $req->execute(array(
 			'nom' => $nom,
 			'classe' => $classe,
 			'dateNaissance' => $dateNaissance,
 			'statut' => $statut,
 			'id' => $id
 		));
		echo $nb_modifs . ' entrées ont été modifiées !';
		//Ne peut être executé que par un admin/super-admin/developpeur
	} else {
		?>"Accès au serveur refusé"<?php
	}
} else {
	?>"Accès au serveur refusé"<?php
}


?>
