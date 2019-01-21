Pour qui ?
=========
soon

Comment ca marche ? 
=========
soon

On vous a vendu le produit ? 
==========
Plusieurs solutions : 
* On vous l'installe sur une machine que vous possedez. (coût moyen)
* Vous vous l'installez sur votre machine. (gratuit, mais aucun SAV)
* Vous utilisez l'application en mutualisé. (coût faible)


Comment je l'installe ? 
==========
Il vous faut une machine avec PHP 7.2 minimum et un mysql.
Vous téléchargez avec le bouton en haut à droite du GitHub, ou clonez le dépot.
(je pars du principe que vous savez configurer apache ou nginx)
et apres ca se passe en ligne de commande dans le dossier racine (là ou se trouve /web et ce maginfique README) :

``composer install `` (installation des librairies et parametrage des infos de base .. (identifiant mdp de bdd, serveur, emails))

``bower install`` (installation des librairies javascript et css)

``php bin/console d:s:u --force`` (génération de la base de données)

``php bin/console fos:user:create [admin_username] [admin_password] --super-admin`` (création de l'utilisateur super administrateur (vous), ne soyez pas bête remplacez les parties entre [ ] )

deux trois autres operations, je complète des que possible.

Après cela ca devrait etre bon ...