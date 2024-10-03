# garageProject

Identifiants de connexions pour l'administrateur (Si et seulement si il a été ajouté en amont dans la base de donnée) :
Nom d'utilisateur : vparrot@gmail.com
Mot de passe : admin


# Projet Symfony - Instructions d'Installation et d'Exécution en Local

## Prérequis

- **PHP > 8.3.8**
- **Un serveur Apache local**
  
Si vous utilisez WAMPP et que votre serveur n'a que 2 services sur 3 alors rendez vous dans le Win+R. 
Tapez services.msc, recherchez MYSQL80, faites clique droit et cliquez sur arrêter.
Relancez les services de WAMPP.

- **Un éditeur de code**
- **Un navigateur récent**

## Installation de l'Application Symfony

### Méthode 1 : Installation via SymfonyCLI

```bash

symfony new mon_projet --version=5.4 --webapp

cd mon_projet

git clone https://github.com/potichatmignon/garageProject.git

symfony server:start -d

Visiter l'url donnée en sortie de console

  
