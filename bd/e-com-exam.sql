-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 juil. 2023 à 23:14
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-com-exam`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ID`, `nom`, `description`) VALUES
(2, 'Frig Electrique', 'PPPPPP'),
(4, 'Koudjo', 'BBBBBBBBB'),
(5, 'Ama', 'hjjkhkjnjlk ljpoiuiuiou\r\n                    ');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `date_commande` date NOT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `montant_total` decimal(10,2) NOT NULL,
  `Client_ID` int NOT NULL,
  `Customer_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Client_ID` (`Client_ID`),
  KEY `fk_commande_customer` (`Customer_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`ID`, `date_commande`, `statut`, `montant_total`, `Client_ID`, `Customer_ID`) VALUES
(8, '2023-07-17', 'En cours', '115000.00', 10, 0),
(7, '2023-07-17', 'En cours', '65000.00', 9, 0),
(9, '2023-07-17', 'En cours', '65000.00', 11, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commandeline`
--

DROP TABLE IF EXISTS `commandeline`;
CREATE TABLE IF NOT EXISTS `commandeline` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `quantite` int NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `Client_ID` int NOT NULL,
  `Commande_ID` int NOT NULL,
  `Produit_ID` int NOT NULL,
  `Customer_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Client_ID` (`Client_ID`),
  KEY `Commande_ID` (`Commande_ID`),
  KEY `Produit_ID` (`Produit_ID`),
  KEY `fk_commandeline_customer` (`Customer_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandeline`
--

INSERT INTO `commandeline` (`ID`, `quantite`, `prix_unitaire`, `Client_ID`, `Commande_ID`, `Produit_ID`, `Customer_ID`) VALUES
(8, 2, '25000.00', 6, 4, 23, 0),
(7, 4, '5000.00', 6, 4, 21, 0),
(6, 1, '5000.00', 5, 3, 21, 0),
(5, 3, '25000.00', 5, 3, 23, 0),
(9, 2, '5000.00', 7, 5, 21, 0),
(10, 3, '25000.00', 7, 5, 23, 0),
(11, 2, '5000.00', 8, 6, 21, 0),
(12, 1, '25000.00', 8, 6, 23, 0),
(13, 2, '25000.00', 9, 7, 23, 0),
(14, 3, '5000.00', 9, 7, 21, 0),
(15, 2, '25000.00', 10, 8, 23, 0),
(16, 13, '5000.00', 10, 8, 21, 0),
(17, 3, '5000.00', 11, 9, 21, 0),
(18, 2, '25000.00', 11, 9, 23, 0);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`ID`, `nom`, `adresse`, `email`, `mot_de_passe`) VALUES
(11, 'Koudjo', 'Bè-KPOTA, Lomé', '92045717', '96144727'),
(9, 'Yasmine', 'Bè-KPOTA, Lomé', '92045717', 'Simon'),
(10, 'Bonjour', 'Bè-KPOTA', '92045717', '96144727');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `prix` decimal(10,2) NOT NULL,
  `quantite_stock` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Categorie_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Categorie_ID` (`Categorie_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`ID`, `nom`, `description`, `prix`, `quantite_stock`, `image`, `Categorie_ID`) VALUES
(23, 'QQQQQQQQ', '\r\n                HHHHH', '25000.00', 24, 'fichier2.png', NULL),
(21, 'QQQQQQQQ', 'Bonjour\r\n                ', '5000.00', 250, 'client lancé.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `nom`, `adresse`, `email`, `mot_de_passe`) VALUES
(5, 'admin', 'BBBB', 'admin@admin.com', '1234'),
(4, 'CCCCC', 'BBBB', 'petroodoh8@gmail.com', '123'),
(3, 'aaaaaaaap', 'Bè-KPOTA, Lomé', 'petroodoh8@gmail.com', '1234');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
