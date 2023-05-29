-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 29 mai 2023 à 13:07
-- Version du serveur : 5.7.36
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
  `nom` varchar(30) NOT NULL,
  `prénom` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_likes` int(255) NOT NULL AUTO_INCREMENT,
  `id` int(255) NOT NULL,
  `id_oeuvre` int(255) NOT NULL,
  `likes` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_likes`),
  UNIQUE KEY `id` (`id`,`id_oeuvre`),
  KEY `id_oeuvre` (`id_oeuvre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `note` int(11) DEFAULT NULL,
  `commentaire` varchar(400) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

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
  `categorie` varchar(250) NOT NULL,
  `likes` int(255) DEFAULT '0',
  `premium_only` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_oeuvre`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `oeuvre`
--

INSERT INTO `oeuvre` (`id_oeuvre`, `nom_oeuvre`, `nom_artiste`, `description_oeuvre`, `picture`, `categorie`, `likes`, `premium_only`) VALUES
(1, 'La Joconde', 'Leonardo da Vinci', 'Portrait enigmatique d\'une femme au sourire mysterieux.', 'La joconde.jpg', 'peinture', 47, 0),
(2, 'Les Nympheas', 'Claude Monet', 'Serie de peintures representant des nympheas dans un etang.', 'Les_nympheas.webp', 'peinture', 18, 1),
(3, 'La Nuit etoilee', ' Vincent van Gogh', 'Paysage nocturne avec un ciel etoile tourbillonnant.', 'La Nuit etoilee.jpg', 'peinture', 18, 0),
(19, 'Guernica', 'Pablo Picasso', 'Peinture representant les horreurs de la guerre civile espagnole.', 'Guernica.jpg', 'peinture', 18, 1),
(20, 'La Persistance de la memoire', 'Salvador Dali', 'Montres molles suspendues dans un paysage surrealiste.', 'La Persistance de la memoire.jpg', 'peinture', 12, 0),
(21, 'Les Tournesols', 'Vincent van Gogh', 'Bouquet de tournesols dans un vase.', 'Les Tournesols.jpg', 'peinture', 14, 1),
(22, 'La Cene', 'Leonardo da Vinci', 'Dernier repas du Christ avec ses disciples.', 'La Cene.jpg', 'peinture', 14, 0),
(23, 'Les Demoiselles d\'Avignon', 'Pablo Picasso', 'Scene figurative representant des prostituees dans un bordel.', 'Les Demoiselles d\'Avignon.png', 'peinture', 15, 1),
(24, 'La Guerre et la Paix', 'Pablo Picasso', 'Peinture murale representant les ravages de la guerre.', 'La Guerre et la Paix.jpg', 'peinture', 14, 0),
(25, 'Les Menines', 'Diego Velazquez', 'Portrait de la famille royale espagnole.', 'Les Menines.jpg', 'peinture', 6, 1),
(26, 'David de Michel-Ange', 'Michel-Ange', 'Sculpture representant le personnage biblique de David.', 'David de Michel-Ange.jpg', 'sculpture', 12, 0),
(27, 'La Pieta', ' Michel-Ange', 'Sculpture representant la Vierge Marie tenant le corps du Christ.', 'La Pieta.jpg', 'sculpture', 13, 1),
(28, 'Le Penseur', 'Auguste Rodin', 'Sculpture d\'un homme nu en position de reflexion.', 'Le Penseur.jpg', 'sculpture', 23, 0),
(29, 'La Victoire de Samothrace', 'Inconnu ', 'Sculpture d\'une deesse ailee de la victoire.', 'La Victoire de Samothrace.jpg', 'sculpture', 24, 1),
(30, 'L\'Esclave mourant', 'Michel-Ange', 'Sculpture representant un homme en train de mourir, emprisonne dans la pierre.', 'L\'Esclave mourant.jpg', 'sculpture', 23, 0),
(31, 'La Venus de Milo', 'Inconnu', 'Sculpture d\'Aphrodite, deesse de l\'amour et de la beaute.', 'La Venus de Milo.jpg', 'sculpture', 49, 1),
(32, 'L\'Homme qui marche', 'Alberto Giacometti', 'Sculpture representant une figure humaine allongée et etiree.', 'L\'Homme qui marche.jpg', 'sculpture', 19, 0),
(33, 'La Porte de l\'Enfer', 'Auguste Rodin', 'Sculpture monumentale representant une scene de l\'Enfer de Dante.', 'La Porte de l\'Enfer.jpg', 'sculpture', 18, 1),
(34, 'Les Trois Graces', ' Jean-Baptiste Carpeaux', ' Sculpture representant les trois deesses de la mythologie grecque.', 'Les_Trois_Graces.jpg', 'sculpture', 58, 0),
(35, 'Le Discobole', 'Myron', 'Sculpture representant un athlete en train de lancer le disque.', 'Le Discobole.JPG', 'sculpture', 14, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(30) DEFAULT NULL,
  `sexe` enum('Masculin','Féminin') DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `N_commande` varchar(255) DEFAULT NULL,
  `premium` int(11) NOT NULL DEFAULT '0',
  `validated` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_oeuvre` FOREIGN KEY (`id_oeuvre`) REFERENCES `oeuvre` (`id_oeuvre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
