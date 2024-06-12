# SAÉ 2.01 - Développement d’une application

- ### LOBREAU Romain (lobr0013)
- ### BAUDAT Louis (baud0156)

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
- dsn = ""  
- username = ""  
- password = ""  

## Programmes 

  - src
    - Entity 
      - ``TvShow.php`` = Classe qui représente une série tv 
      - ``Season.php`` = Classe qui représente une saison d'une série
      - ``Episode.php`` = Classe qui représente un episode d'une saison 
      - ``Genre.php`` = Classe qui représente le genre d'une série tv
      - ``Poster.php`` = Classe qui représente le poster d'une série ou d'une saison
      
    - Collection
      - ``EpisodeCollection`` = Classe qui permet de récupérer tous les épisodes d'une saison
      - ``SeasonCollection`` = Classe qui permet de récupérer toutes les saisons d'une série
      - ``TvshowCollection`` = Classe qui permet de récupérer toutes les séries de la base de données
      - ``GenreCollection`` = Classe qui permet de récupérer tous les genres

    - Exception
      - ``EntityNotFoundException`` = Classe héritant de OutOfBoundException et permettant d'indiquer une erreur d'entité introuvable
      - ``ParameterException`` = Classe héritant de Exception et permettant d'indiquer une erreur de paramêtre
    - Database
      - ``MyPdo.php`` = Classe héritant de PDO et permettant de se connecter à la base de données et de configurer
    - Html 
      - ``WebPage`` = Classe qui permet la creéaton d'une structure d'une page Web
      - ``AppWebPage`` = Classe héritant de WebPage et est une amélioration de celle-ci
      - ``StringEscaper`` = Trait qui permet d'échapper le nom d'une série
    - Form
      - ``TvShowForm.php`` = Classe qui permet la création d'un formulaire pour la création d'une entité.
  - public
      - css
        - ``style.css`` = Feuille de style de tout le projet
        
      - admin 
        - ``tvshow-delete.php`` = Programme permettant la suppression d'une série
        - ``tvshow-form.php`` = Programme permettant la génération de la page du formulaire d'édition/création d'une série
        - ``tvshow-save.php`` = Programme permettant la sauvegarde dans la base de donnée de l'édition/création d'un film
        
      - ``index.php`` = Page principale, permet de consulter l'ensemble des séries présentes dans la base de données
      - ``tvshow.php`` = Page permettant de consulter l'ensemble des informations d'une série
      - ``season.php`` = Page permettant de consulter l'ensemble des informations d'une saison
      - ``poster.php`` = Page permettant la récupération d'un poster d'une série/saison

    