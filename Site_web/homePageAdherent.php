<?php
/*// Données à envoyer sous la forme d'un array
// A part l'URL, et éventuellement les options, il n'y aurait que ce tableau à modifier
$post = array(
    'Nom' => 'Stchepinsky Nathan',
    'DateNaissance' => '14/11/2002',
);
 
$data = http_build_query($post);
$content = file_get_contents(
    'http://localhost:8888/infoAdherent.php',
    FALSE,
    stream_context_create(
        array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($data) . "\r\n",
                'content' => $data,
            )
        )
    )
);
var_dump($content);*/

$error = $_POST["error"];


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>A2L connexion adhérents</title>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="source/logo.JPG"/>
	</head>

	<body>
		<section>
			<header>
				<h1>Chères adhérents de l'A2L, bienvenue</h1>
				<h2>Cette version web est une version restreinte de l'application A2L, disponible pour tous, en attendant la sortie de l'application sur android. L'application pour iOS est déjà <a href="" title="Accéder à l'application iOS de l'A2L">disponible</a>!!</h2>
			</header>
			<article>
				<form method="post" action="ficheAdherent.php">
					<div id="connexion">
						<div class="elementConnexion">
							<p>
								<?PHP 
								echo $error;
								if($error == "true"){?>
									<label for="Prénom">Prénom</label> : <input type="text" name="PrenomField" id="Prénom" placeholder="Prénom" class="inputError"/>
								<?PHP } else {
									?> <label for="Prénom">Prénom</label> : <input type="text" name="PrenomField" id="Prénom" placeholder="Prénom" class="input"/> <?PHP
									}?>
							</p>
						</div>
						<div class="elementConnexion">
							<p>
								<label for="Nom">Nom</label> : <input type="text" name="NomField" id="Nom" placeholder="Nom" class="input"/>
							</p>
						</div>
					</div>
					<p>
						<label for="DateNaissance">Date de naissance</label> : <input type="date" name="DateNaissanceField" id="DateNaissance" class="input"/>
					</p>
					<input type="submit" value="Connexion" class="connexionButton">
					</form>
					
			</article>
			<article>
				<h4>Pour plus d'informations téléchargez l'application A2L ou adressez-vous à un membre du bureau !</h3>
				<h3>Je suis admin et je réclame mes droits ! <a href="homePageAdmin.php" title="Page de connexion pour les adhérents">Connecte toi ici alors</a>
			</article>
		</section>

		<footer>
			<div id="footer">
				<div class="elementFooter">
					<p><a href="href="mailto:nathanstchepinsky@gmail.com title="Signaler un bug"> Signaler un bug</a></p>
				</div>
				<div class="elementFooter">
					<p><a href="" title"Aide">Qu'est ce que l'A2L ?</a></p>
				</div>
				<div class="elementFooter">
					<p>Ce site web, et l'application on été developpés par <a href="http://nathanstchepinsky--nathans1.repl.co" title="Visiter le site du developpeur">Nathan</a></p>
				</div>
			</div>
		</footer>
	</body>
</html>

<?php 
?>