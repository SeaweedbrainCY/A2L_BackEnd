# A2L project : Serveur
Voici le github de la partie BackEnd des applications A2L. 
Le serveur sera codé en PHP et associé à du MySQL. 
Il sera entierment controllé par les 2 applications (iOS et web). Autant en lecture qu'écriture.
Les applications seront donc connectées à l'API de ce serveur. 
/!\L'API concerne toutes les données de l'A2L, elle est donc 100% ouverte et libre d'être utilisée par quiconque en voit l'utilité et PROFITE À L'ASSOCIATION DE L'A2L AINSI QUE SES AHDÉRENTS. En cas d'abus, les développeurs se réservent le droit de la fermer à tout moment. Pour des questions de sécurité, certaines informations de connexion de seront pas disponibles sur ce repository. 


## Comment sont stockés les mot de passe ? 
Excellente question ! Hors de question de laisser des mots de passe en clair dans la nature!! Lorsque le mot de passe est rentré, l'application hash le mot de passe, et ne conserve que son hash. Les mots de passes sauvegardés par l'application seront hashés en SHA256 afin de limiter les fuites. Et cela dès le clique sur le bouton « connexion ». Pas une seule variable ne contient à un moment T le mot de passe en clair. Et c'est ce hash qui sera transmis à l'API pour se connecter ou demander des informations. Le mot de passe hashé reçu par l'API est immédiatement hashé à nouveau, et une fois encore aucune variable ne contiendra le hash de l'application. Seront donc stockés, uniquement le hash du hash sur le serveur. Cette fois, le mot de passe sera stocké en BCrypt, qui est de loin, la méthode de hash la plus sûr de nos jours.


## Mais pourquoi hasher 2 fois ? 
Tout d'abord, cela n'augmente pas la sécurité des mdp. Ils ne sont pas mieux portégés par un double hash. Cela ne la diminue evidemment pas. En revanche, il est préférable que les applications ne conservent qu'un hash du mot de passe. Une interception de celui-ci, ou une faille de l'application pourrait l'exposer et ce n'est pas le but. Ainsi il est plus sûr de ne garder qu'un hash au cas où. Et de plus, si la base de donnée fuite, on n'a accès qu'aux hash. Enfin, dans ce scénario catastrophe, avoir accès à un hash stocké sur le serveur permettrait donc d'utiliser l'API en court-circuitant les application. Et ansi corrompre toute la base de données. Il ne faut donc pas que le hash stocké, puisse être utilisé pour se connecter à l'API. Il faut donc hashé le mot de passe déjà hashé pour éviter ce problème.
Afin de pouvoir utiliser le BCrypt, nous sommes obligé de fournir à l'API, un hash strcitement identique d'une connexion à l'autre. C'est pourquoi nous sommes contraints d'utiliser 2 méthodes différentes et non 2 fois du BCrypt


# Gestion des failles et protection contre les attaques 

## Failles XSS : 
Les application gèrent elle même en verifiant le contenu transmis à l'API. Seuls certains caractères spécieux sont autorisés et le contenu doit être correct. De plus, comme l'application ne montre à l'utilisateur que les données qu'elle est capable de traité. Si les données ne sont pas sous la forme d'un dictionnaire ou d'une string d'une valeur connue, alors l'application ne retourne rien du tout. 

## Injection MySQL : 
Une fois de plus, n'est envoyé à l'API que les données dont on est sûr. Les requêtes au serveur don protégées pas des requêtes préparées et surtout, même si l'injection est effectuée, les données reçu ne correpondront pas à celles attendues pas l'application qu'elle verra comme un erreur. 

## Attaque par dictionnaire ou force brute directement sur l'application : 
Le nombre de tentative de mot de passe est limité à 5 toutes les 5min, puis 1 toutes les t+30min. En cas de trop nombreuse récidives, l'application est bloquée. Seul un super-admin pourra la débloquer. Le fonctionnement sera détaillé dans le code source de l'application. 
Pour le site web, des 'delay(1);' on été mis en place qui devrait plus que ralentir toute brute force.

## Attaque par dictionnaire ou brut force depuis l'API : 
Tout d'abord, les codes de connexion à la base de données sont strictment confidentiels et propres à l'application. Si toute fois, l'attaquant arrive à acceder à l'API et donc lancer une attaque, je lui souhaite mes plus sincères condoléances car je rappelle que le mot de passe transmis est hashé par l'application une première fois ... On oublie donc les attaque par dico et surtout j'espère qu'il a rien prévu pour le prochain siècle parce que pour générer 256 caractères .....

En resumé le principe est de garder un hash différent dans les 2 softwares qui le garde en memoire. 

*Par application, il est sous entendu l'application iOS et le site web

#### Site web du developpeur : https://nathanstchepinsky--nathans1.repl.co

#### Contact : nathanstchepinsky@gmail.com

#### Github de l'application iOS : https://github.com/DevNathan/A2L_Application
