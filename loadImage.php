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


$reponse = $bdd->query('SELECT * FROM ListeAdherents WHERE id="'.$idAdherent.'"');

$donnesReponse = $reponse -> fetch();

if($donnesReponse['ImageData'] == "none"){
?>"none"<?php
} else {
?>"<?php echo $donnesReponse['ImageData'];?>"<?php
}
		
		
