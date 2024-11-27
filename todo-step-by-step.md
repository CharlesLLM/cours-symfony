# Installation

## Installer Symfony, Mysql (ou Postgresql)

- Installez Symfony via le repo git officiel, via le cli Symfony ou via composer
- Installez MySQL soit en local, soit via Docker, soit via MAMP/WAMP/LAMP/XAMP

## Installer les autres trucs

- Installez Github Copilot (ou faites le demande dans un 1er temps)
- Installez XDebug

## Regarder les fichiers / dossiers

- Regardez le contenu du fichier composer.json
- Regardez le contenu de config/routes.yaml , config/services.yaml
- Regardez les dossiers src/ et templates/



> Si à un moment vous êtes confrontés à un erreur (dans la console ou sur votre page web), pensez à BIEN LIRE L'ERREUR OKKK ??? en général c'est facile de savoir ce qu'il faut faire pour corriger le problème.



# Entités, Migrations, Fixtures

## Entités

- Lisez le cahier des charges
- Regardez le schéma de base de donnée

> Pour chaque entité (table dans la db), le nom de l'entité == au nom de la table au singulier, en camelCase et en anglais

> Pour chaque entité (table dans la db), vous devez ajouter des propriétés grace à la commande symfony. Le nom des propriété est toujours en camelCase et en anglais. Le nom de la propriété ne doit pas contenir "id"

- Créez une entité pour chacune des tables suivantes : categories, languages, user, subscription, playlist, comment, media, movie, serie, season, episode
- Créez une entité pour chacune des tables suivantes : subscription_history, playlist_subscription, watch_history, playlist_media
- Faites les liaisons entre les différentes tables (OneToMany, ManyToMany)
- Faites la liaison entre Categorie et Media et entre Language et Media (ManyToMany)
- Faites l'héritage entre les entités Movie et Serie (Serie hérite de Media et Movie hérite de Media)

## Migration

- Créez une migration grace à la commande Symfony
- Ouvrez le fichier créé et supprimer les commentaires générés

> Supprimer les commentaires permet de dire aux autres développeurs que vous avez bien relu la migration

- Executer la migration grace à la commande Symfony/Doctrine

## Fixtures PHP

- Créez un fichier fixtures php avec la commande Symfony
- Ouvrez le fichier créé
- Créez 2 catégories différentes (Action et Aventure par exemple) en faisant du PHP Objet (donc en faisant un new Categorie() et en utilisant les setters pour mettre des données à l'intérieur)
- Chargez vos fixtures en DB grace à la commande Symfony

> Ne pas oublier le persist() et le flush(), sans ça votre fixture ne sera pas en DB

- Faites la même chose pour les langues, cette fois en utilisant un boucle for (ou foreach peu importe)
- Faites pareil en ajoutant un utilisateur, un media, une playlist
- Relier dans les fixtures les media aux catégories, aux langues et aux playlist
- Faites ça pour TOUTES les entités

## Fixtures YAML

- Installez "alice" avec composer et les recettes Symfony Flex
- Ouvrez le dossier à la racine du projet "fixtures/"
- Dans ce dossier créez un fichier categories.yaml et faites des fixtures pour les "Categorie" dedans
- Pareil pour les langues, les users, les medias ....

> C'est quand même plus simple en YAML non ?


# Templates

## Commencer à intégrer les templates

- Prenez tout les fichiers .html du dossier téléchargé sur Github et déplacez-les dans le dossier "templates/" du projet Symfony
- Pour chaque fichier, renommez l'extension en .html.twig
- Organisez vos fichiers comme vous le voulez dans des sous-dossier pour qu'il y ai une structure de dossier cohérente.
- Pour chaque fichier de template créez un Controller qui affiche le template. (Utilisez la même architecture de dossier pour vos controller et vos templates)

## Sous template et héritage

- Ajouter un fichier base.html.twig, dans ce fichier mettez toute la structure de base de vos pages (la balise head, une partie de votre balise body)

> En gros, tout le contenu commun à vos pages (menu gauche, sidebar droite, top bar, footer ...) vont dans ce fichier base.html.twig

- Ajoutez 2 "blocks" (block title, content) dans le fichier base.html.twig
- Découpez votre fichier base.html.twig en sous-template, (parts/left-menu.html.twig et parts/right-sidebar.html.twig)
- Ouvrez le fichier index.html.twig, supprimez tout le code en commun avec le fichier base.html.twig et entourez le code spécifique de votre page par un "block" content. Ajouter une titre à votre page avec le block "title"
- Découpez votre page en sous-template (par exemple un sous template pour les cards des films/séries) : 'parts/movies/movie-card.html.twig'
- Faites la même chose pour la page "discover.html.twig", "category.html.twig", "abonnement.html.twig", "list.html.twig", "detail.html.twig" et "detail_serie.html.twig"

> Vos pages doivent donc ne plus avoir de code en commun et doivent toutes avoir un block "content" et un block "title"

> Vous devez également sur toutes vos pages avoir un "include" de sous-template

- Modifier le sous template left-menu.html.twig pour ajouter les liens vers les différentes pages de l'application. Pensez aussi à utiliser des if pour ajouter des classes tailwind sur l'element actif en utilisant : {% if app.current_route == 'nom_de_la_page' %}fill-red-600{% endif %}

## Utilisez la BDD avec les templates

- Allez sur la page qui liste les catégories, identifiez le controller qui affiche la page

> Pour identifier le controller : soit on regarde l'URL et on regarde dans tout nos controllers lequel correspond, soit on install la debug toolbar de Symfony avec "composer require debug". En rafraichissant la page, en bas à droite il y a le nom du controller qui s'est executé.

- Utilisez le repository des Categories en l'injectant en dépendance, et faites un findAll() pour tout récupérer depuis la table en BDD. Passez le résultat au template. Ensuite dans votre template, utilisez une boucle "for" pour bouclez sur l'affichage du sous-template "parts/category/category-card.html.twig". Modifier le sous-template pour rendre dynamique l'affichage (afficher le nom)

> On a pas encore l'icone de la catégorie en BDD, donc on peut ajouter une propriété sur l'entité "Categorie" "icon" de type "text". Une fois ajoutée avec la commande Symfony, on doit générer une migration, la vérifier et l'executer... (quand on modifie une entité on doit toujours faire ça)

- Maintenant la page pour voir le détail d'une catégorie : on identifie le controller qui affiche la page, on ajoute un paramètre dans l'URL : "id", on injecte l'entité qu'on souhaite récupérer et on passe la résultat dans le template twig. Dans le template : on affiche le nom de la catégorie en haut en gras, on affiche les medias de la catégorie grace à la boucle for.
- On retourne dans le fichier discover.html.twig et on génère un URL dynamiquement grace à la fonction twig path()

- Faites pareil pour la page des abonnements
- Faites pareil pour les cards qui concernent les films (ajoutez les liens dynamiques avec path())
- Rendez dynamique la page pour voir le détail d'un film (toutes les infos, le listing des commentaires, du staff, du casting, des catégories ...)

> La prochaine page c'est pas que du Symfony, là ça demande à réflechir à une logique de dev : "Comment est-ce que je peux implémenter cette feature avec ce que je connais déjà ?"

- Rendez dynamique la page pour lister les playlists : Là il faut injecter 2 repositories : PlaylistRepository et PlaylistSubscriptionRepository et faire 2 'for' dans le template au niveau du selecteur. Ajoutez un peu de JS : quand on change le selecteur, on ajouter un paramètre GET dans l'URL "?selectedPlaylist=XXX" (XXX c'est l'id de la playlist selectionnée dans le selecteur).
- Quand le JS et fait, il faut retourner dans le controller et ajouter un peu de code PHP : Récupérez le paramètre de query 'selectedPlaylist' et allez chercher en BDD l'entité. Passez cette entité dans le template et affichez les films liés à cette playlist.
- Si vous revenez sur la page sans le paramètre de query 'selectedPlaylist' vous devriez avoir une erreur, corrigez l'erreur en ajoutant quelques 'if' dans le code php et dans le template twig.


- Sur la page d'accueil, ajoutez une feature pour afficher les films les plus populaires. Pour ça, ouvrez le bon controllers, injectez le MediaRepository. Dans le MediaRepository, ajoutez une methode personnaliés findPopular(), faites la requête avec le QueryBuilder pour récupérer les media les plus populaire (Populaire = un film regardé beaucoup de fois, donc souvent dans WatchHistory). Utilisez le otre methode et passez le résulats au template twig. Dans le template twig, utilisez un 'for' autour du sous-template 'parts/movies/movie-card.html.twig'



# Authentification

## 1ère étape

- Lancez la commande pour générer le formulaire de login
- Corrigez l'erreur lié à l'interface
- Rajoutez une propriété "roles" (de type json)
- Faites une migration et l'executer

## 2éme étape

- Allez faire un tour dans le security.yaml
- Ajoutez un nouveau provider de type entity (voir la doc)
- Modifiez le provider du firewall "main"
- Définissez une role_hierarchy avec 2 ou 3 roles différents

## 3éme étape

- Retournez dans les fixtures et injecter en dépendance dans le constructeur le UserPasswordHasherInterface
- Au niveau de la génération des utilisateurs, hashez le mot de passe et mettre le nouveau mdp hashé dans le user avec le setPassword()
- Ajoutez un rôle dans le user grace au setRoles()
- Relancez les fixtures

- Essayez de vous connecter sur le page de login générée par Symfony

## 4éme étape

- Une fois connecté, allez dans le template right-sidebar.html.twig, ajoutez en haut du champs de recherche une div contenant "Bonjour XXX" avec XXX le username de l'utilisateur connecté
- Déconnectez-vous. Maintenant vous avez une erreur sur la page d'accueil. Corrigez l'erreur en ajoutant un if autour de la div créée
- Allez dans left-menu.html.twig , modifiez le menu pour afficher un bouton de connexion lorsque l'on est pas connecté et un bouton de déconnexion quand on est connecté.
- Sur la page des abonnements (SubscriptionController::show), rendrendere dynamique en fonction de si l'utilisateur est connecté ou non la div qui affiche l'abonnement en cours de l'utilisateur (et afficher le nom de l'abonnement en cours si l'utilisateur à un abonnement en cours)
- Sur la page des playlists, récupérez que les playlists de l'utilisateur connecté. Si il n'est pas connecté, redirigez le keumé vers la page d'accueil.
