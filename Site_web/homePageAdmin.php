


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>A2L connexion admin</title>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="source/logo.JPG"/>

	</head>

	<body>
		<section>
			<header>
				<h1>Chère membre du bureau, bienvenue</h1>
				<h2>Cette version web est une version restreinte de l'application A2L, disponible pour tous, en attendant la sortie de l'application sur android. L'application pour iOS est déjà <a href="" title="Accéder à l'application iOS de l'A2L">disponible</a>!!</h2>
			</header>
			<article>
				<div id="connexion">
					<div class="elementConnexion">
						<form method="post" action="../infosAdmin.php">
							<p>
								<label for="Prénom">Prénom</label> : <input type="text" name="Prénom" id="Prénom" placeholder="Prénom" class="input"/>
							</p>
						</form>
					</div>
					<div class="elementConnexion">
						<form method="post" action="../infosAdmin.php">
							<p>
								<label for="Nom">Nom</label> : <input type="text" name="Nom" id="Nom" placeholder="Nom" class="input"/>
							</p>
						</form>
					</div>
				</div>
				<form method="post" action="../infosAdmin.php">
					<p>
						<label for="Nom">Mot de passe</label> : <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" class="input"/>
					</p>
				</form>
				<input type="submit" value="Connexion" class="connexionButton">
			</article>
			<article>
				<h4>Si vous avez perdu votre mot de passe ou que vous n'en avez pas alors pas de bol ......</h4>
				<h4>Seule les applications sont autorisées à modifer des mots de passes pour l'instant ;)</h4>
				<h3>Je suis adhérent et je comprends rien du tout :( <a href="homePageAdherent.php" title="Page de connexion pour les adhérents">Connecte toi ici alors</a></h3>
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


