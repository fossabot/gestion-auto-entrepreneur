# Gestion auto entrepreneur

<p align="center">
    <img title="" src="https://github.com/Jonathanb-74/gestion-auto-entrepreneur/blob/master/.documentation/logo.png" alt="Logo application" width="415" data-align="center">
    <br><span>Par <a href="http://jonathan-brea.fr">Jonathan BREA</a></span>
</p>

## Sommaire

1. [Présentation](#présentation)

2. [Installation](#installation)
   
   1. [Prérequis](#Prérequis)
   
   2. [Téléchargement des fichiers](#Téléchargement-des-fichiers)
   
   3. [Création de la base de données à l'aide de phpMyAdmin](#création-de-la-base-de-données-à-laide-de-phpmyadmin)

3. [Configuration de l'application](#configuration-de-lapplication)
   
   1. [Connexion à la base de données](#connexion-à-la-base-de-données)
   
   2. [Saisie des informations de l'entreprise](#saisie-des-informations-de-lentreprise)

4. Prise en main

5. Crédits

## Présentation

Cette application web à pour but de faciliter la gestion administrative d'un auto entrepreneur. 

Cette application sous forme de site web permet d'être simplement utilisée sur PC, tablette et smartphone via un navigateur.

Après avoir créé vos produits et vos clients, vous pourrez utiliser le gestionnaire de prestation, pour garder une trace de votre travail. De plus cette application vous permet de générer automatiquement des devis et des factures et si vous le souhaitez, les envoyer par mail de manière simple.

## Installation

### Prérequis:

Cette application à besoin d'un serveur web et d'une base de données pour 
fonctionner.

Si vous disposez d'un hébergement en ligne et que les caractéristiques le 
permettent (création de sous domaines, création de bases de données), vous 
pouvez héberger votre application en ligne. Cette méthode vous permet d'avoir 
accès à l'application depuis n'importe où dans le monde (vous devez avoir accès 
à internet).

Si vous ne disposez pas de serveur web, vous pouvez en installer un sur votre 
PC de travail. Cette manipulation est très simple. Je vous conseille WAMP (ou XAMPP), cette solution permet d'installer le serveur WEB ainsi que le serveur de base de 
données via une seule application. Vous trouverez un grand nombre de tuto et docs sur internet pour vous expliquer leurs fonctionnements.

## Téléchargement des fichiers

### Si vous êtes sur Windows et que vous utilisez WAMP (ou XAMPP) ou un hébergement PRO (ex: OVH)

En premier, vous devez télécharger l'archive contenant les fichiers sources: 

1. Utilisez le bouton (vert) "**Clone or download**" en haut de la liste des fichiers.

2. Sélectionnez "**Download ZIP**".

3. Enregistrez l'archive dans le répetoire de votre choix.

4. Décompressez l'archive.

5. Placez tous les fichiers dans le répetoirede votre serveur web
   
   1. Si vous utilisez WAMP, vous devez placer les fichiers dans  `C:\wamp64\www\`
   
   2. Si vous utilisez XAMPP, vous devez placer les fichiers dans `c:\xampp\htdocs\`
   
   3. Si vous utilisez un hébergement en ligne, la manipulation varie en fonction de l'hébergeur, vous devez vous renseigner sur la parche à suivre.

## Création de la base de données à l'aide de phpMyAdmin

phpMyAdmin est une application web qui permet de gérer vos bases de données de manière graphique via une page web. Si vous utilisez WAMP (ou XAMPP), cet outil est déjà installé. Si vous utilisez un hébergeur en ligne, cette manipulation sera peut-être différente. 

1. Connectez-vous à phpMyAdmin via un navigateur à l'adresse: `localhost/phpmyadmin`
   
   1. Si vous devez vous connecter, saisissez `root` dans utilisateur et ne saisissez pas de mot de passe.

2. Maintenant, vous devez créer un utilisateur et une base de données spécifique à l'application:
   
   1. Dans le menu en haut de la page sélectionnez `Comptes utilisateurs`, puis dans la page qui s'ouvre, `Ajouter un compte utilisateur`.
      
      <p align="center">
          <img title="" src="https://github.com/Jonathanb-74/gestion-auto-entrepreneur/blob/master/.documentation/pmaCreationUtilisateurBtn1.PNG" alt="Btn création utilisateur 1" width="300" data-align="center">
          <br><br>
          <img title="" src="https://github.com/Jonathanb-74/gestion-auto-entrepreneur/blob/master/.documentation/pmaCreationUtilisateurBtn2.PNG" alt="Btn création utilisateur 2" width="300" data-align="center">
      </p>
   
   2. Saisissez un nom d'utilisateur (ex: `gestion-micro-entreprise`, `gestio`, `gme`), un mot de passe (vous pouvez générer un mot de passe aléatoire, ce mot de passe ne sera à saisir qu'une seule fois), enfin cochez la case `Créer une base portant son nom ...`.  **<u>ATTENTION:</u> ces informations sont très importantes, gardez-les dans un bloc-notes pour la suite.**
      
      <p align="center">
          <img title="" src="https://github.com/Jonathanb-74/gestion-auto-entrepreneur/blob/master/.documentation/pmaFormCreationUtilisateur.png" alt="Formulaire de création de l'utilisateur" width="800" data-align="center">
      </p>
   
   3. Après avoir créé la BDD, cliquez sur celle-ci dans la liste de gauche, puis sélectionnez `Importer` dans le menu en haut de la page.
   
   4. Utilisez le bouton `Parcourir ...` pour selectionner le fichier `BDD.sql` obtenu lors du téléchargement des fichiers.
      
      <p align="center">
          <img title="" src="https://github.com/Jonathanb-74/gestion-auto-entrepreneur/blob/master/.documentation/pmaImporter.png" alt="Importation de la structure de la BDD" width="800" data-align="center">
      </p>
   
   5. Puis cliquez sur `Exécute` en bas de la page.
   
   6. Si aucune erreur n'apparaît, vous avez terminé cette étape, sinon renseignez vous sur internet pour résoudre l'erreur. 

## Configuration de l'application

Maintenant vous pouvez proceder à la configuration de l'application.

### Connexion à la base de données

1. Connectez-vous à l'application web via un navigateur à l'adresse: `localhost`

2. Si tout s'est bien passé, vous devriez arrver sur une page nommée: `Installation de la BDD`
   
   <p align="center">
          <img title="" src="https://github.com/Jonathanb-74/gestion-auto-entrepreneur/blob/master/.documentation/appInstallBdd.png" alt="Page de configuration de la BDD" width="800" data-align="center">
      </p>

3. Le formulaire de cette page vous permet de cnnecter la base de données précédament installée à l'application
   
   1. Saisissez l'adresse du serveur, si vous utilisez WAMP (ou XAMPP) saisissez `localhost`, si vous utilisez un hébergement en ligne renseignez-vous sur l'adresse du serveur.
   
   2. Pour l'utilisateur et la base de donnée, saisissez le nom d'utilisateur que vous avez créer sur phpMyAdmin à l'étape précédente. Enfin saisissez le mot de passe
   
   3. Terminez par `Valider`
   
   4. Si aucune erreur n'apparaît, vous avez terminé cette étape, sinon renseignez vous sur internet pour résoudre l'erreur.

### Saisie des informations de l'entreprise

<p align="center">
 <img title="" src="https://github.com/Jonathanb-74/gestion-auto-entrepreneur/blob/master/.documentation/appInstallEntrepriseInfo.png" alt="Page de configuration des informations de l'entreprise" width="800" data-align="center">
 </p>

<u>ATTENTION:</u> ces informations sont très importantes, elles servirons pour la création des factures. Vérifiez bien avant de valider, certaines infirmations comme le numéro SIRET ne sont pas modifiable

- L'adresse email sera utilisée lorsqu'un client souhaite répondre à un email envoyé depuis l'application.

- Vous devez saisir au moins un des deux numéros de téléphones.

- Terminez par `Valider`

- Si aucune erreur n'apparaît, vous avez terminé cette étape, sinon renseignez vous sur internet pour résoudre l'erreur.
