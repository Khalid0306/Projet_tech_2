-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 26 mai 2023 à 12:24
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_tech_musee`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prénom` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `nom`, `prénom`, `created_at`, `updated_at`) VALUES
(3, 'jasonmampouya.pro@gmail.com', '$2y$10$3QYe0wVgSoRJzCcR6bf2hef1ZFyYG1Y7/357Ef79sBn5CsAMOOIaq', NULL, NULL, '2023-05-25 09:49:00', '2023-05-25 09:49:00'),
(4, 'juliamatsia@gmail.com', '$2y$10$9E.GYqkzHdx2n8lkU1x0neCa/e2VXvCSkl4XN7nPHfKAAU77A39VC', NULL, NULL, '2023-05-25 10:50:01', '2023-05-25 10:50:01');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `sujet` text NOT NULL,
  `msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `sujet`, `msg`) VALUES
(4, 'gg', 'qssssssss'),
(5, 'ssqqs', 'qsqs');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `message` text NOT NULL,
  `nom` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `sujet` text NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`message`, `nom`, `email`, `sujet`, `id`) VALUES
('sssss', 'jason stephene mampouya', 'jasonmampouya.pro@gmail.com', 'geo', 2),
('bodlldmmdmddddodooddo', 'game', 'jasonmampouya.pro@gmail.com', 'svsvvs', 3),
('kkkk', 'ii', 'op@gmail.com', 'hhh', 4),
('qsqsqq', 'jason stephene mampouya', 'jasonmampouya.pro@gmail.com', 'kk', 5);

-- --------------------------------------------------------

--
-- Structure de la table `oeuvre`
--

DROP TABLE IF EXISTS `oeuvre`;
CREATE TABLE IF NOT EXISTS `oeuvre` (
  `id_oeuvre` int(11) NOT NULL AUTO_INCREMENT,
  `nom_oeuvre` varchar(30) NOT NULL,
  `nom_artiste` varchar(30) NOT NULL,
  `description_oeuvre` varchar(300) NOT NULL,
  `picture` varchar(300) CHARACTER SET utf8mb4 NOT NULL,
  `catégorie` varchar(250) NOT NULL,
  `likes` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_oeuvre`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `oeuvre`
--

INSERT INTO `oeuvre` (`id_oeuvre`, `nom_oeuvre`, `nom_artiste`, `description_oeuvre`, `picture`, `catégorie`, `likes`) VALUES
(1, 'La Joconde', 'Leonardo da Vinci', 'Portrait énigmatique d\'une femme au sourire mystérieux.', 'La joconde.jpg', 'peinture', NULL),
(2, 'Les Nymphéas', 'Claude Monet', 'Série de peintures représentant des nymphéas dans un étang.', 'Les_nymphéas.webp', 'peinture', NULL),
(3, 'La Nuit étoilée', ' Vincent van Gogh', 'Paysage nocturne avec un ciel étoilé tourbillonnant.', 'La Nuit étoilée.jpg', 'peinture', NULL),
(19, 'Guernica', 'Pablo Picasso', 'Peinture représentant les horreurs de la guerre civile espagnole.', 'Guernica.jpg', 'peinture', NULL),
(20, 'La Persistance de la mémoire', 'Salvador Dalí', 'Montres molles suspendues dans un paysage surréaliste.', 'La Persistance de la mémoire.jpg', 'peinture', NULL),
(21, 'Les Tournesols', 'Vincent van Gogh', 'Bouquet de tournesols dans un vase.', 'Les Tournesols.jpg', 'peinture', NULL),
(22, 'La Cène', 'Leonardo da Vinci', 'Dernier repas du Christ avec ses disciples.', 'La Cène.jpg', 'peinture', NULL),
(23, 'Les Demoiselles d\'Avignon', 'Pablo Picasso', 'Scène figurative représentant des prostituées dans un bordel.', 'Les Demoiselles d\'Avignon.png', 'peinture', NULL),
(24, 'La Guerre et la Paix', 'Pablo Picasso', 'Peinture murale représentant les ravages de la guerre.', 'La Guerre et la Paix.jpg', 'peinture', NULL),
(25, 'Les Ménines', 'Diego Velázquez', 'Portrait de la famille royale espagnole.', 'Les Ménines.jpg', 'peinture', NULL),
(26, 'David de Michel-Ange', 'Michel-Ange', 'Sculpture représentant le personnage biblique de David.', 'David de Michel-Ange.jpg', 'sculpture', NULL),
(27, 'La Pieta', ' Michel-Ange', 'Sculpture représentant la Vierge Marie tenant le corps du Christ.', 'La Pieta.jpg', 'sculpture', NULL),
(28, 'Le Penseur', 'Auguste Rodin', 'Sculpture d\'un homme nu en position de réflexion.', 'Le Penseur.jpg', 'sculpture', NULL),
(29, 'La Victoire de Samothrace', 'Inconnu ', 'Sculpture d\'une déesse ailée de la victoire.', 'La Victoire de Samothrace.jpg', 'sculpture', NULL),
(30, 'L\'Esclave mourant', 'Michel-Ange', 'Sculpture représentant un homme en train de mourir, emprisonné dans la pierre.', 'L\'Esclave mourant.jpg', 'sculpture', NULL),
(31, 'La Vénus de Milo', 'Inconnu', 'Sculpture d\'Aphrodite, déesse de l\'amour et de la beauté.', 'La Vénus de Milo.jpg', 'sculpture', NULL),
(32, 'L\'Homme qui marche', 'Alberto Giacometti', 'Sculpture représentant une figure humaine allongée et étirée.', 'L\'Homme qui marche.jpg', 'sculpture', NULL),
(33, 'La Porte de l\'Enfer', 'Auguste Rodin', 'Sculpture monumentale représentant une scène de l\'Enfer de Dante.', 'La Porte de l\'Enfer.jpg', 'sculpture', NULL),
(34, 'Les Trois Grâces', ' Jean-Baptiste Carpeaux', ' Sculpture représentant les trois déesses de la mythologie grecque.', 'Les_Trois_Grâces.jpg', 'sculpture', NULL),
(35, 'Le Discobole', 'Myron', 'Sculpture représentant un athlète en train de lancer le disque.', 'Le Discobole.JPG', 'sculpture', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(100) NOT NULL,
  `description_produit` varchar(300) NOT NULL,
  `picture` varchar(300) CHARACTER SET utf8mb4 NOT NULL,
  `catégorie` varchar(250) NOT NULL,
  `quantité` int(255) DEFAULT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `description_produit`, `picture`, `catégorie`, `quantité`) VALUES
(61, 'Réplique de La Joconde', 'Réplique fidèle de la célèbre peinture de Leonardo da Vinci, La Joconde.', 'Replique la joconde.jpg', 'Reproduction d\'œuvre d\'art', NULL),
(62, 'Buste de David', 'Sculpture en plâtre représentant le buste de David de Michel-Ange.', 'Buste de david.jpg', 'Sculpture en plâtre', NULL),
(63, 'Impression sur toile des Nymphéas', 'Impression sur toile des célèbres Nymphéas de Claude Monet.', 'Impression sur toile des Nymphéas.jpg', 'Impression artistique', NULL),
(64, 'Miniature de la Tour Eiffel en métal', 'Miniature détaillée de la Tour Eiffel en métal.', 'Miniature de la Tour Eiffel en métal.webp', 'Souvenir', NULL),
(65, 'Poster de La Nuit étoilée', 'Poster de grande qualité représentant la célèbre peinture de Vincent van Gogh, La Nuit étoilée.', 'Poster de la nuit étoilée.jpg', 'Posters et reproductions', NULL),
(66, 'Réplique de la Statue de la Liberté', 'Réplique en résine de la Statue de la Liberté.', 'Réplique de la Statue de la Liberté.jpg', 'Reproduction d\'œuvre d\'art', NULL),
(67, 'Porte-clés Les Tournesols', 'Porte-clés avec un médaillon représentant Les Tournesols de Vincent van Gogh.', 'Porte-clés Les Tournesols.webp', 'Accessoires', NULL),
(68, 'T-shirt La Cène', 'T-shirt noir avec une impression de La Cène de Leonardo da Vinci.', 'T-shirt la Céne.jpg', 'Vêtements', NULL),
(69, 'Mug Les Demoiselles d\'Avignon', 'Mug en céramique avec une reproduction des Demoiselles d\'Avignon de Pablo Picasso.', 'Mug les demoiselles d\'Avignon.jpg', 'Cadeaux', NULL),
(70, 'Livre d\'art sur les sculptures grecques', 'Livre richement illustré présentant les sculptures grecques les plus célèbres.', 'Livre d\'art sur les sculptures grecques.jpg', 'Livres d\'art', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nom` varchar(30) DEFAULT NULL,
  `prénom` varchar(30) DEFAULT NULL,
  `validated` int(2) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `updated_at`, `nom`, `prénom`, `validated`) VALUES
(7, 'jasonmampouya.pro@gmail.com', '$2y$10$JdOGE7JILX3KhZrB6pX7qOxfR0oas7iyN6zXv1DhLPvcu3RSfwMEW', '2023-05-25 09:43:38', '2023-05-26 07:59:01', NULL, NULL, 1),
(9, 'ja.mampouya@gmail.com', '$2y$10$W37audNGB9UinDua5O0Ur.nvHS86wq4PVjcrU4hJT5dn/zwULplWm', '2023-05-25 10:23:38', '2023-05-25 10:23:38', NULL, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
