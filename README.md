![banner](Graphics/banner.png)

# [www.opentask.tech](www.opentask.tech)

Dépot du projet de programmation web coté serveur de deuxième année.


# Changelog
<b style="color: #4caf50">v1.0.0</b> - *20 décembre 2017*
-   ajout et suppression de tâches
-   ajout et suppression de projets
-   authentification avec les nouveaux mécanismes de *PHP* *(`password_hash`, `password_verify`)*


# Le projet
Ce projet à été réalisé dans le cadre du projet de deuxième année du module
"programmation web coté serveur" de l'IUT informatique de Clermont-Ferrand.
Le but était de développer un site internet de gestion de tâches. L'utilisateur
devait pouvoir gérer des projets qui sont des groupes de tâches, ainsi que des
publiques, c'est à dire des tâches qui devaient être accessibles, que
l'utilisateur soit connecté ou non. Cette fonctionnalité peut être intéressante
dans le cas d'un intranet par exemple, de façon à gérer des tâches communes
à tous les utilisateurs. Néanmoins, nous avons ajouté quelques fonctionnalités,
comme des degrés d'importances pour les tâches (faible, normal, important ou
critique), ou la possibilité de créer un compte.

## Objectifs
-   Faire un gestionnaire de taches (*todo*)
-   Utiliser le patron *MVC*
-   Utiliser les *design paterns*

## Membres
-   Yann Surzur *(yannsurzur[@]gmail.com)*
-   Evrard Van Espen *(e.vanespen[@]protonmail.com)*

# Mention légales
## Auteurs
Le présent site a été entièrement conçu et réalisé par Yann Surzur
 et Evrard Van Espen qui sont les seuls propriétaires.

## Graphiques
Le design et la charte graphique du présent site sont placé.e.s sous licence *Creative
Commons BY-NC-SA*. Vous pouvez donc :

- **partager :** copier, distribuer et communiquer le matériel par tous moyens et sous tous formats
- **Adapter :** remixer, transformer et créer à partir du matériel

Aux conditions suivantes :
- **Attribution :** vous devez créditer l'oeuvre, intégrer un lien vers la licence et indiquer si des modifications ont été effectuées à l'oeuvre. Vous devez indiquer ces informations par tous les moyens raisonnables, sans toutefois suggérer que l'offrant vous soutient ou soutient la façon dont vous avez utilisé son Oeuvre.
- **Pas d’Utilisation Commerciale :** Vous n'êtes pas autorisé à faire un usage commercial de cette Oeuvre, tout ou partie du matériel la composant.
- **Partage dans les mêmes Conditions :** dans le cas où vous effectuez un remix, que vous transformez, ou créez à partir du matériel composant l'oeuvre originale, vous devez diffuser l'oeuvre modifiée dans les même conditions, c'est à dire avec la même licence avec laquelle l'oeuvre originale a été diffusée.

[https://creativecommons.org/licenses/by-nc-sa/2.0/fr/](https://creativecommons.org/licenses/by-nc-sa/2.0/fr/)

## Code
Le code du présent site est placé sous licence GNU AGPLv3 avec une close supplémentaire :

- **tout usage commercial du présent site est interdit sauf autorisation écrite d'un des propriétaires.**

[https://www.gnu.org/licenses/agpl-3.0.txt](https://www.gnu.org/licenses/agpl-3.0.txt)

## Photos
La photo de fond d'écran a été légèrement retouchée et provient du site unsplash.com. Elle a été captée par Daniel Leone.

# Documentation
## Maquette
Voila la maquette du projet, avec le menu affiché sur la  seconde puis la page des paramètres.

![overview](Doc/overview.png)


![overview](Doc/overviewMenu.png)

## Diagrammes
### *MLD* base de données
![mld](Doc/mld.png)

# Installation
## Téléchargement des sources
Placer les fichiers contenus dans le répertoire `www` dans un dossier accessible par votre seveur web.

### Configuration d'*Apache* ou *httpd*
Pour que le module de réécriture d'URL du fichier `.htaccess` fonctionne, il faut activer le module de réécriture :

- décommenter la ligne `LoadModule rewrite_module modules/mod_rewrite.so`

## Configuration
### Générale
Dans `config/configMaster.php` modifier la variable `$confM['ROOT_URL'] = '<RACINE_DU_SITE'`.
Par exemple avec `http://localhost` **sans le `/` à la fin**.


### Base de données
Compléter le fichier `www/config/configDatabase.php.template` avec le **nom de la base de données**,
 le nom de l'**utilisateur** et son **mot de passe**.

```
	$db['db']['base'] = '';
	$db['db']['user'] = '';
	$db['db']['pass'] = '';

```
puis le renommer en `configDatabase.php`.

## Création des tables
### Utilisateurs
```
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `UNIQ_username` UNIQUE (name)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```
### Projets

```
CREATE TABLE `project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idOwner` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idOwner` (`idOwner`),
  CONSTRAINT `FK_fkUser` FOREIGN KEY (`idOwner`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### Taches
```
CREATE TABLE `task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idProject` int(10) DEFAULT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tags` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` tinyint(4) DEFAULT '1',
  `state` tinyint(4) DEFAULT '0',
  `addDate` date NOT NULL,
  `doneDate` date DEFAULT NULL,
  `maxDate` date DEFAULT NULL,
  `extLink` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'open-task.com/easter.php',
  PRIMARY KEY (`id`),
  KEY `idProject` (`idProject`),
  CONSTRAINT `FK_fkProject` FOREIGN KEY (`idProject`) REFERENCES `project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```
