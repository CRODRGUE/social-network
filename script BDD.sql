-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 déc. 2022 à 17:13
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reseau_social0`
--

DROP DATABASE IF EXISTS reseau_social0;
CREATE DATABASE IF NOT EXISTS reseau_social0;
USE reseau_social0;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_com` int NOT NULL AUTO_INCREMENT,
  `text_com` varchar(120) NOT NULL,
  `date_com` datetime NOT NULL,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_com`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_com`, `text_com`, `date_com`, `id_post`, `id_user`) VALUES
(2, 'Bravo à toi ', '2022-12-08 16:14:16', 1, 2),
(3, 'Merci Gil !', '2022-12-08 16:14:38', 1, 1),
(4, 'Il y a 4 phases : Mise en place du projet / développement du produit / test du produit / déploiement de la solution ?', '2022-12-08 16:19:30', 2, 1),
(5, 'Non c\'est en 7 phases non ?', '2022-12-08 16:32:04', 2, 3),
(6, 'Presque il y a 8 phases au total => Plan / Code / Construisent / Test / Intégrer / Déployer / Exploiter / Surveiller', '2022-12-08 16:32:23', 2, 2),
(7, 'Salut ! Soit le bienvenu ', '2022-12-08 16:35:01', 3, 3),
(9, 'Peux-tu m\'en dire un peu plus sur ton problème ?', '2022-12-08 16:41:20', 4, 2),
(10, 'J\'utilise prepare(\'... LIMITE 10 OFFSET ?\') suivit de execute([10]) puis ensuite j\'utilise fetchAll()', '2022-12-08 16:45:30', 4, 1),
(11, 'C\'est normal cela s\'explique par le fait que OFFSET attend un type int il faut que t\'utilise bindValue(...) pour ça', '2022-12-08 16:49:29', 4, 2),
(12, 'Merci pour ta solution !', '2022-12-08 16:50:14', 4, 1),
(13, '=)', '2022-12-08 16:50:24', 4, 2),
(14, 'Pas de problème s\'est noté, protège-toi bien !', '2022-12-08 16:54:46', 5, 1),
(15, 'Hey ! d\'accord ', '2022-12-08 16:56:20', 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE IF NOT EXISTS `follow` (
  `id_user` int NOT NULL,
  `id_user_1` int NOT NULL,
  `status` smallint NOT NULL,
  PRIMARY KEY (`id_user`,`id_user_1`),
  KEY `id_user_1` (`id_user_1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id_user`, `id_user_1`, `status`) VALUES
(2, 1, 2),
(1, 2, 2),
(3, 2, 2),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text_post` text NOT NULL,
  `date_post` datetime NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id_post`, `text_post`, `date_post`, `id_user`) VALUES
(1, 'Salut comment allez-vous ? J\'ai une bonne nouvelle j\'ai terminé le projet enfin ! (il me reste les inserts de la BDD à faire... c\'est très chiant =/)', '2022-12-08 16:08:43', 1),
(2, 'Question DevOps // Quelles sont les différentes phases de DevOps ? ', '2022-12-08 16:17:05', 2),
(3, 'Salut ! Je viens d\'arriver... j\'aimerais faire connaissance...', '2022-12-08 16:34:23', 3),
(4, 'J\'ai un problème avec l\'utilisation du OFFSET dans une requête. Je n\'ai rien qui met retourner depuis le back-end mais dans Phpmyadmin la requête marche bien et j\'ai des valeurs qui me sont retournées...', '2022-12-08 16:39:13', 1),
(5, 'Bonjour tout le monde ! Je n\'e serai pas là dans la mesure où je suis cas contact =/', '2022-12-08 16:52:01', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reactions`
--

DROP TABLE IF EXISTS `reactions`;
CREATE TABLE IF NOT EXISTS `reactions` (
  `id_react` int NOT NULL AUTO_INCREMENT,
  `react_name` varchar(120) NOT NULL,
  `react_emoji` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_react`),
  UNIQUE KEY `react_name` (`react_name`),
  UNIQUE KEY `react_emoji` (`react_emoji`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `reactions`
--

INSERT INTO `reactions` (`id_react`, `react_name`, `react_emoji`) VALUES
(1, 'like', NULL),
(2, 'j\'adore', NULL),
(3, 'likes', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reaction_post`
--

DROP TABLE IF EXISTS `reaction_post`;
CREATE TABLE IF NOT EXISTS `reaction_post` (
  `id_user` int NOT NULL,
  `id_post` int NOT NULL,
  `id_react` int NOT NULL,
  PRIMARY KEY (`id_user`,`id_post`,`id_react`),
  KEY `id_post` (`id_post`),
  KEY `id_react` (`id_react`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `reaction_post`
--

INSERT INTO `reaction_post` (`id_user`, `id_post`, `id_react`) VALUES
(1, 1, 2),
(1, 5, 1),
(2, 1, 1),
(2, 5, 1),
(3, 2, 1),
(3, 3, 1),
(3, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `pseudo`, `mail`, `pwd`) VALUES
(1, 'cyril', 'cyril@test.ts', 'f3029a66c61b61b41b428963a2fc134154a5383096c776f3b4064733c5463d90'),
(2, 'Gil', 'gil@test.ts', 'f3029a66c61b61b41b428963a2fc134154a5383096c776f3b4064733c5463d90'),
(3, 'Jules', 'jules@test.ts', 'f3029a66c61b61b41b428963a2fc134154a5383096c776f3b4064733c5463d90'),
(5, 'CompteVide', 'comptevide@test.ts', 'f3029a66c61b61b41b428963a2fc134154a5383096c776f3b4064733c5463d90');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
