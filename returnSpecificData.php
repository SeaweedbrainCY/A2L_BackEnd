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

?>