# SAÉ 2.01 - Développement d’une application

- ### LOBREAU Romain 
- ### BAUDAT Louis

## Serveur Web Local
Pour lancer le serveur web local, il suffit de lancer la commande suivante dans le répertoire du projet :
- php -d display_errors -S localhost:8000 -t public/

On peut ensuite vérifier et interrogez le serveur __http://localhost:8000/__ pour voir que cela fonctionne.

## Style de codage

Recherchez « fixer » dans les paquets Composer :
- composer search fixer

Demandez la dépendance de développement sur « friendsofphp/php-cs-fixer » :
- composer require friendsofphp/php-cs-fixer --dev

Vérifiez le bon fonctionnement de PHP CS Fixer :
- php vendor/bin/php-cs-fixer

Lancez une première vérification manuelle avec la commande :
- php vendor/bin/php-cs-fixer fix --dry-run  
  L'option « --dry-run » (test à blanc) demande une exécution normale, mais aucun fichier n'est modifié.

Lancez une nouvelle vérification manuelle avec la commande :
- php vendor/bin/php-cs-fixer fix --dry-run --diff  
  L'option « --diff » affiche les différences entre l'original et ce qui est ou serait corrigé.

Lancez une dernière vérification manuelle avec la commande et corrige :
- php vendor/bin/php-cs-fixer fix
  dsn = "mysql:host=mysql;dbname=cutron01_music;charset=utf8"
  username = "web"
  password = "web"
  Grâce à composer, on peut lancer le serveur grâce à la commande :
- composer start:linux

On peut tester et fix le code sans que le serveur ne s'arrete au bout de 300 secondes avec les codes :
- "start": [
  "Composer\\Config::disableProcessTimeout",  
  "phpunit"
  ],  
  "start:linux": ["bin/run-server.sh"],  
  "test:cs": ["php vendor/bin/php-cs-fixer"],  
  "fix:cs": ["php vendor/bin/php-cs-fixer fix"]  

## Configuration de la base de données
Dans le fichier .mypdo.ini on retrouve 3 attributs :
- dsn = "mysql:host=mysql;dbname=cutron01_music;charset=utf8"  
- username = "web"  
- password = "web"  