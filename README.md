# garageProject

# Projet Symfony - Instructions d'Installation et d'Exécution en Local

## Prérequis

- **PHP > 8.3.8**
- **Un serveur Apache local**
  
Si vous utilisez WAMPP et que votre serveur n'a que 2 services sur 3 alors rendez vous dans le Win+R. *

Tapez services.msc, recherchez MYSQL80, faites clique droit et cliquez sur arrêter.

Relancez les services de WAMPP.

- **Un éditeur de code**
- **Un navigateur récent**

## Installation de l'Application Symfony

### Méthode 1 : Installation via SymfonyCLI

```bash

scoop install symfony-cli

```

Il faut télécharger lʼexécutable de Symfony CLI. Lʼexécutable est téléchargeable directement sur le site de Symfony.

Dans la section Binaries, cliquez sur la version correspondant à votre système : 386 pour les ordinateurs Intel 32 bits et amd64 pour les ordinateurs avec un processeur AMD 64 bits.

Allez dans C:\Program Files et créez un dossier Symfony

Déplacez l'archive téléchargée et décompréssée la.

Dans la barre de recherche de Windows, tapez « env ». Le premier résultat devrait être « Modifier les variables dʼenvironnement système ». 

Cliquez dessus, la fenêtre des Propriétés système va sʼafficher.

Cliquez alors sur le bouton « Variables dʼenvironnement ». Cela ouvrira la fenêtre des variables dʼenvironnement.

Dans la section « Variables système », choisissez « Path » et cliquez sur le bouton « Modifier ». Cela va ouvrir une troisième fenêtre pour modifier cette variable.

Cliquez sur le bouton « Nouveau » et saisissez le chemin du dossier contenant lʼexécutable de Symfony CLI (symfony.exe) décompressé à lʼétape 4. Dans notre cas ce sera : « C:\Program Files\Symfony ».

 Cliquez sur les boutons « OK » des trois fenêtres afin de toutes les fermer

```bash

cd C:\'Program Files'\Symfony

git clone https://github.com/potichatmignon/garageProject.git

symfony server:start -d


```

Visiter l'url donnée en sortie de console afin que le site web s'affiche correctment


## Ajouter des éléments dans la base de donnée

```bash
php bin/console doctrine:database:create

php bin/console make:migration

php bin/console doctrine:migrations:migrate

php bin/console app:create-user vparrot@gmail.com admin admin

php bin/console app:create-user arthur.garnier1090@gmail.com employe1 employe

php bin/console app:create-car 'Audi R8' 87000 "L'Audi R8 est une voiture de sport du constructeur automobile allemand Audi. C'est le premier coupé GT deux-places de la marque qui rivalise ainsi avec les marques historiques de ce segment : Porsche, Ferrari, Chevrolet ou Aston Martin." 15241

```

Identifiants de connexions pour l'administrateur (Si et seulement si il a été ajouté en amont dans la base de donnée) :

Nom d'utilisateur : vparrot@gmail.com

Mot de passe : admin


  
