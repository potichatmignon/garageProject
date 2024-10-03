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

php bin/console app:create-user sachasimon92350@gmail.com employe2 employe

php bin/console app:create-user sharkpi.zhou@gmail.com employe3 employe

php bin/console app:create-user dorian93.roux@gmail.com employe4 employe


php bin/console app:create-car 'Audi R8' 87000 "L'Audi R8 est une voiture de sport du constructeur automobile allemand Audi. C'est le premier coupé GT deux-places de la marque qui rivalise ainsi avec les marques historiques de ce segment : Porsche, Ferrari, Chevrolet ou Aston Martin." 15241

php bin/console app:create-car 'Ferrari 488' 250000 "La Ferrari 488 est une supercar italienne, connue pour son design élégant et sa performance exceptionnelle. Avec son moteur V8 biturbo, elle offre une expérience de conduite inégalée." 12345

php bin/console app:create-car 'Porsche 911' 100000 "La Porsche 911 est une icône de l'automobile, alliant performance et luxe. Son design intemporel et sa technologie avancée en font un choix privilégié parmi les amateurs de voitures de sport." 67890

php bin/console app:create-car 'Chevrolet Corvette' 60000 "La Chevrolet Corvette est un symbole de l'automobile américaine, offrant un excellent rapport qualité-prix avec des performances dignes des meilleures supercars." 54321

php bin/console app:create-car 'Aston Martin Vantage' 150000 "L'Aston Martin Vantage est une voiture de sport britannique alliant élégance et puissance. Son moteur V8 et son design séduisant attirent les passionnés de conduite." 98765

php bin/console app:create-car 'McLaren 720S' 300000 "La McLaren 720S est une supercar révolutionnaire qui allie légèreté et puissance. Avec son design aérodynamique et son moteur V8, elle offre des performances de classe mondiale." 13579


```
## S'identifier sur l'onglet connexion :

Identifiants de connexions pour l'administrateur (Si et seulement si il a été ajouté en amont dans la base de donnée) :

Nom d'utilisateur : vparrot@gmail.com

Mot de passe : admin

Identifiants de connexions pour l'employé (Si et seulement si il a été ajouté en amont dans la base de donnée) :

Nom d'utilisateur : arthur.garnier1090@gmail.com

Mot de passe : employe1

Identifiants de connexions pour l'employé (Si et seulement si il a été ajouté en amont dans la base de donnée) :

Nom d'utilisateur : sachasimon92350@gmail.com

Mot de passe : employe2

Identifiants de connexions pour l'employé (Si et seulement si il a été ajouté en amont dans la base de donnée) :

Nom d'utilisateur : sharkpi.zhou@gmail.com

Mot de passe : employe3

Identifiants de connexions pour l'employé (Si et seulement si il a été ajouté en amont dans la base de donnée) :

Nom d'utilisateur : dorian93.roux@gmail.com

Mot de passe : employe4


  
