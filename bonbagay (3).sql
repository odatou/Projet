-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 29 Janvier 2023 à 14:10
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bonbagay`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
  `id_achat` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `achats`
--

INSERT INTO `achats` (`id_achat`, `id_client`, `id_article`, `quantite`, `date`) VALUES
(1, 2, 2, 8, '2023-01-19 00:00:00'),
(2, 4, 3, 9, '2023-01-19 14:58:18'),
(3, 5, 4, 20, '2023-01-19 15:25:50'),
(4, 7, 1, 123, '2023-01-20 15:03:57');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `reference` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`reference`, `nom`, `description`, `prix`) VALUES
(1, 'Laptop', 'Laptop', 600),
(2, 'Telephone', 'telephone', 300),
(3, 'Tablette', '16 Pouce', 250),
(4, 'Backup', 'Backup', 15),
(5, 'abcd', 'acd', 12),
(6, 'laptop', 'se yon laptop ki san ekran', 25),
(7, 'M-16', 'Calibre M-16', 18);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `numero` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `codepostal` int(10) UNSIGNED NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`numero`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `pays`, `telephone`) VALUES
(1, 'Junior', 'Joseph', 'Saint Domigue', 4012, 'Carrefour', '123', '244'),
(2, 'Cynthia Jean', 'Saint Claire', 'Haiti', 123, '123', '123', '244'),
(3, 'Appolon', 'Guy', 'Haiti', 6130, 'Carrefour', 'Haiti', '545383'),
(4, 'Toussaint', 'Odalson', 'Clercine', 4574, 'Clercine', 'Haiti', '1235666'),
(5, 'Pierre', 'Jacque', 'haiti', 6130, 'Carrefour', 'Azerbaijan', '1235666'),
(6, 'Pierre', 'Jacque', 'haiti', 6130, 'Carrefour', 'Azerbaijan', '1235666'),
(7, 'Pierre', 'Jacque', 'haiti', 6130, 'Carrefour', 'Azerbaijan', '1235666'),
(8, 'Jean', 'Daniel', 'Carrefour', 6130, 'Carrefour', 'Australia', '1235666'),
(9, 'Toussaint', 'Jacque', 'ji', 56, 'Carrefour', 'Bahrain', '545383');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `name`, `username`, `password`, `type`) VALUES
(123, 'Jackson', 'Jak', '1234', 'Vendeur'),
(124, 'Joseph', 'junior', '1234', 'Comptable'),
(125, 'KP', 'kervens', '1234', 'Comptable'),
(126, 'Cynthia', 'Cynn', '509', 'Admin'),
(127, 'maignan', '', '', 'vendeur'),
(128, 'maignan', 'mjmike', 'mikemjs', 'administrateur');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id_achat`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`reference`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
  MODIFY `id_achat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `reference` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
