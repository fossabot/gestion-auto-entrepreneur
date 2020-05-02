-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 01 Mai 2020 à 15:23
-- Version du serveur :  10.1.44-MariaDB-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ge`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(255) NOT NULL,
  `entreprise` varchar(255) DEFAULT NULL,
  `genre` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` int(10) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `tel_fixe` char(14) DEFAULT NULL,
  `tel_portable` char(14) DEFAULT NULL,
  `type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE `document` (
  `id` int(255) NOT NULL,
  `idprestation` int(255) NOT NULL,
  `dateEdition` date NOT NULL,
  `type` int(2) NOT NULL,
  `annee` int(255) NOT NULL,
  `numero` int(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE `email` (
  `id` int(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `destinataire` int(255) NOT NULL,
  `prestation` int(255) NOT NULL,
  `document` int(255) NOT NULL,
  `objet` tinytext NOT NULL,
  `texte` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE `entreprise` (
  `siret` bigint(255) NOT NULL,
  `nomentreprise` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresseSiege` varchar(255) NOT NULL,
  `cp` int(10) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `telP` char(14) DEFAULT NULL,
  `telF` char(14) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `complet` varchar(255) NOT NULL,
  `court` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`id`, `complet`, `court`) VALUES
(1, '', ''),
(2, 'Monsieur', 'M.'),
(3, 'Madame', 'Mme');

-- --------------------------------------------------------

--
-- Structure de la table `modelesFactures`
--

DROP TABLE IF EXISTS `modelesFactures`;
CREATE TABLE `modelesFactures` (
  `id` int(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `fichier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `moyenpaiement`
--

DROP TABLE IF EXISTS `moyenpaiement`;
CREATE TABLE `moyenpaiement` (
  `nom` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
CREATE TABLE `parametres` (
  `id` int(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `var1` int(255) DEFAULT NULL,
  `texte1` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `parametres`
--

INSERT INTO `parametres` (`id`, `description`, `var1`, `texte1`) VALUES
(1, 'installation', 0, NULL),
(2, 'fichiermodel', NULL, NULL),
(3, 'informationsDevis', NULL, NULL),
(6, 'factueSujet', NULL, NULL),
(7, 'factureContent', NULL, NULL),
(8, 'devisSujet', NULL, NULL),
(9, 'devisContent', NULL, NULL),
(10, 'emailHost', NULL, NULL),
(11, 'emailUsername', NULL, NULL),
(12, 'emailPassword', NULL, NULL),
(13, 'emailSecure', NULL, NULL),
(14, 'emailPort', NULL, NULL),
(15, 'emailEmeteurAdresse', NULL, NULL),
(16, 'emailEmeteurNom', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
CREATE TABLE `prestation` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `dateouverture` datetime NOT NULL,
  `urgence` varchar(10) NOT NULL,
  `commentaire` text NOT NULL,
  `moyenpaiement` varchar(100) DEFAULT NULL,
  `remise` double DEFAULT NULL,
  `dateFacturation` date DEFAULT NULL,
  `datelivraison` date DEFAULT NULL,
  `datecloture` date DEFAULT NULL,
  `cloture` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `prestationproduit`
--

DROP TABLE IF EXISTS `prestationproduit`;
CREATE TABLE `prestationproduit` (
  `id` int(11) NOT NULL,
  `facture` int(11) NOT NULL,
  `produit` int(255) NOT NULL,
  `produitqte` int(255) NOT NULL,
  `prixfinalunitaire` double DEFAULT NULL,
  `offert` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE `produits` (
  `ref` int(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `categorie` int(11) NOT NULL,
  `prixachat` float DEFAULT NULL,
  `coefmarge` float DEFAULT NULL,
  `prixvente` float NOT NULL,
  `commentaire` text,
  `desactiver` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `var1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`id`, `description`, `var1`) VALUES
(1, 'background', '#c0c0c0'),
(2, 'background_menu', '#fe7e29'),
(3, 'titre', '#1a0a52'),
(4, 'sous_titre1', '#1d69a3'),
(5, 'sous_titre2', '#00a8d9'),
(6, 'boutonValiderBackground', '#00ff00'),
(7, 'boutonValiderTxt', '#000000'),
(8, 'boutonValiderBackgroundHover', '#80ff00'),
(9, 'boutonValiderTxtHover', '#000000'),
(10, 'boutonSupprimerBackground', '#ff0000'),
(11, 'boutonSupprimerTxt', '#ffffff'),
(12, 'boutonSupprimerBackgroundHover', '#ffffff'),
(13, 'boutonSupprimerTxtHover', '#ff0000'),
(14, 'boutonBarreBackground', '#004080'),
(15, 'boutonBarreTxt', '#ffffff'),
(16, 'boutonBarreBackgroundHover', '#5c5c5c'),
(17, 'boutonBarreTxtHover', '#ffffff'),
(18, 'tableauTitreBackground', '#2e2e2e'),
(19, 'tableauTitreTxt', '#ffffff'),
(20, 'tableauLigne1Background', '#373737'),
(21, 'tableauLigne1Txt', '#ffffff'),
(22, 'tableauLigne2Background', '#444444'),
(23, 'tableauLigne2Txt', '#ffffff'),
(24, 'badgeProfessionnelBackground', '#ff0080'),
(25, 'badgeProfessionnelTxt', '#000000'),
(26, 'badgeParticulierBackground', '#00ff00'),
(27, 'badgeParticulierTxt', '#000000'),
(28, 'badgeFactureBackground', '#00ffff'),
(29, 'badgeFactureTxt', '#000000'),
(30, 'badgeDevisBackground', '#800080'),
(31, 'badgeDevisTxt', '#ffffff');

-- --------------------------------------------------------

--
-- Structure de la table `typeactivite`
--

DROP TABLE IF EXISTS `typeactivite`;
CREATE TABLE `typeactivite` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `typeactivite`
--

INSERT INTO `typeactivite` (`id`, `nom`) VALUES
(1, 'liberale'),
(2, 'artisanale'),
(3, 'commerciale');

-- --------------------------------------------------------

--
-- Structure de la table `typeactivitedesc`
--

DROP TABLE IF EXISTS `typeactivitedesc`;
CREATE TABLE `typeactivitedesc` (
  `iddesc` int(11) NOT NULL,
  `idtype` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `typeclient`
--

DROP TABLE IF EXISTS `typeclient`;
CREATE TABLE `typeclient` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `typeclient`
--

INSERT INTO `typeclient` (`id`, `description`) VALUES
(1, 'professionnel'),
(2, 'particulier');

-- --------------------------------------------------------

--
-- Structure de la table `typedocument`
--

DROP TABLE IF EXISTS `typedocument`;
CREATE TABLE `typedocument` (
  `id` int(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `typedocument`
--

INSERT INTO `typedocument` (`id`, `description`) VALUES
(1, 'facture'),
(2, 'devis');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `genre` (`genre`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `idprestation` (`idprestation`);

--
-- Index pour la table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinataire` (`destinataire`),
  ADD KEY `document` (`document`),
  ADD KEY `prestation` (`prestation`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`siret`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modelesFactures`
--
ALTER TABLE `modelesFactures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `moyenpaiement`
--
ALTER TABLE `moyenpaiement`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moyenpayement` (`moyenpaiement`),
  ADD KEY `client` (`client`);

--
-- Index pour la table `prestationproduit`
--
ALTER TABLE `prestationproduit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facture` (`facture`),
  ADD KEY `produit` (`produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`ref`),
  ADD KEY `categorie` (`categorie`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeactivite`
--
ALTER TABLE `typeactivite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeactivitedesc`
--
ALTER TABLE `typeactivitedesc`
  ADD PRIMARY KEY (`iddesc`),
  ADD KEY `idtype` (`idtype`);

--
-- Index pour la table `typeclient`
--
ALTER TABLE `typeclient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typedocument`
--
ALTER TABLE `typedocument`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `modelesFactures`
--
ALTER TABLE `modelesFactures`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prestationproduit`
--
ALTER TABLE `prestationproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `ref` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `typeactivite`
--
ALTER TABLE `typeactivite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `typeactivitedesc`
--
ALTER TABLE `typeactivitedesc`
  MODIFY `iddesc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `typeclient`
--
ALTER TABLE `typeclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `typedocument`
--
ALTER TABLE `typedocument`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`type`) REFERENCES `typeclient` (`id`),
  ADD CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`genre`) REFERENCES `genre` (`id`);

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`idprestation`) REFERENCES `prestation` (`id`),
  ADD CONSTRAINT `document_ibfk_2` FOREIGN KEY (`type`) REFERENCES `typedocument` (`id`);

--
-- Contraintes pour la table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`destinataire`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `email_ibfk_3` FOREIGN KEY (`document`) REFERENCES `document` (`id`),
  ADD CONSTRAINT `email_ibfk_4` FOREIGN KEY (`prestation`) REFERENCES `prestation` (`id`);

--
-- Contraintes pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD CONSTRAINT `prestation_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `prestation_ibfk_2` FOREIGN KEY (`moyenpaiement`) REFERENCES `moyenpaiement` (`nom`);

--
-- Contraintes pour la table `prestationproduit`
--
ALTER TABLE `prestationproduit`
  ADD CONSTRAINT `prestationproduit_ibfk_1` FOREIGN KEY (`facture`) REFERENCES `prestation` (`id`),
  ADD CONSTRAINT `prestationproduit_ibfk_2` FOREIGN KEY (`produit`) REFERENCES `produits` (`ref`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `typeactivitedesc` (`iddesc`);

--
-- Contraintes pour la table `typeactivitedesc`
--
ALTER TABLE `typeactivitedesc`
  ADD CONSTRAINT `typeactivitedesc_ibfk_1` FOREIGN KEY (`idtype`) REFERENCES `typeactivite` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
