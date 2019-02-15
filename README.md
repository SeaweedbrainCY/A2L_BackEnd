# A2L project : Serveur
Voici le github de la partie BackEnd des applications A2L. 
Le serveur sera codé en PHP et associé à du MySQL. 
Il sera dédié et entierment controllé par les 2 applications. Autant en tant que lecture que d'écriture.
Les applications seront donc connectées à l'API de se serveur. 
/!\L'API concerne toutes les données de l'A2L, elle ne sera donc pas ouverte, seuls les developpeurs principaux auront accès aux codes du serveurs et seuls les applications sont autorisées à utiliser l'API. Pour des questions de sécurité, certaines informations de connexion de seront pas disponibles sur ce repository. 

Comment sont stockés les mot de passe ? 
Excellente question ! Hors de question de laisser des mots de passe en clair dans la nature!! Lorsque le mot de passe est rentré, l'application hash le mot de passe, et ne conserve que son hash. Et ca dès le clique sur le bouton connexion. Pas une seule variable ne contient à un moment T le mot de passe en clair. Et c'est ce hash qui sera transmis à l'API pour se connecter ou demander des informations. Le mot de passe hashé reçu par l'API est immédiatement hashé à nouveau, et une fois encore aucune variable ne contiendra le hash de l'application. Seront donc stockés, uniquement le hash du hash sur le serveur 

Mais pourquoi hasher 2 fois ? 
Tout d'abord, cela n'augmente pas la sécurité des mdp. Ils ne sont pas mieux portégés par une double hash. Cela ne la diminue evidemment pas. En revanche, il est préférable que les applications ne conservent qu'un hash du mot de passe. Une interception de celui-ci, ou une faille de l'application pourrait l'exposer et ce n'est pas le but. Ainsi il est plus sûr de ne garder qu'un hash au cas ou. Et de plus, si la base de donnée fuite, on n'a accès qu'aux hash. Enfin, dans ce scénario catastrophe, avoir accès à un hash stocké sur le serveur permettrait donc d'utiliser l'API en court-circuitant les application. Et ansi corrompre toute la base de données. Il ne faut donc pas que le hash stocké, puisse être utilisé pour se connecter à l'API. Il faut donc hashé le mot de passe déjà hashé pour éviter ce problème. 

Site web du developpeur : https://nathanstchepinsky--nathans1.repl.co

Contact : nathanstchepinsky@gmail.com

Github de l'application iOS : https://github.com/DevNathan/A2L_Application
