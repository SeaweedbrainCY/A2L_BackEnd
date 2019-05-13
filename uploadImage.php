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
$data = $_POST['data'];


		$bdd->exec('UPDATE ListeAdherents SET ImageData = "'.$data.'" WHERE id = "'.$id.'"');
		//Ne peut être executé que par un admin/super-admin/developpeur



?>
