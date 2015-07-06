CQRS + Event Sourcing
====

Il s'agit d'un projet de site e-commerce qui utilise l'architecture CQRS + Event sourcing.

Le but étant de découpler le code au maximum et d'identifier les rééls profits d'une telle architecture.

Dans un premier temps je me suis attellé à la mise en place de l'architecture elle même, ensuite j'ai axentué mon développement sur la gestion des évènements (ajout, modification, suppression).
J'ai continué par l'intégration des relations entre mes domaines tout en respectant l'architecture.

Ensuite je me suis tourné sur l'authenfication avec symfony2. Une prochaine mise à jour viendra améliorer ce système qui pour le moment est basique. De ce fait j'ai ajouté un bundle utilisateur.

Ensuite je me suis tourné vers les commandes de la console qui nous permettent de nous simplifier la vie. J'ai donc entrepris la création de plusieurs commandes dont une afin de générer l'architecture CQRS à mes nouveaux domaines. Cette commande utilise des gabarits qui seront améliorés en permettant de configurer directement mon modèle.

J'ai bataillé un peu avec symfony2 afin qu'il puisse m'uploader plsuieurs images depuis un seul champs input file.


J'ai poursuivi mon développement en implemntant le système de version des evenements qui servira dans un second temps pour l'implementation des snapshots afin d'éviter de rejouer la liste de tous les evenements, mais seulement ceux après le dernier snapshot.

Installation
=====

Une fois le code présent sur le serveur il faudra ajouter la base de données. Une fois cela fait grace à la commande on va ajouter notre premier utilisateur.

```
php app/console starkerxp:utilisateur:creer_admin <email> <motDePasse>
```


Ajout d'un nouveau Domain 
=====
Lorsque vous ajouter un nouveau domain il suffit de le générer via la console. Cette commande va vous permettre de générer les fichiers de base qu'il faudra pas la suite modifier compléter. Aujourdhui le nouveau domain comportera un id et un libelle. 
```
php app/console starkerxp:cqrs:generer:structure <bundle> <domain>
```

Todo 
=====
- Listener pour l'authenficiation
- Système de snapshots
- Amélioration du système de la console
- Test unitaires
- Test fonctionnelles
- Intégration du design
- Création du système de panier +  paypal
- Connexion via réseau sociaux

