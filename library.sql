-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 23 jan. 2019 à 16:41
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `library`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `kind` varchar(255) NOT NULL,
  `published_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `kind`, `published_at`) VALUES
(1, 'L\'etranger', 'conte philosophique', '1942-01-01'),
(2, 'Harry Potter a l\'ecole des sorciers', 'Fantasy', '1997-06-26'),
(3, 'Harry Potter et la Chambre des secrets', 'Fantasy', '1998-07-02'),
(4, 'Dix petits negres', 'Roman policier', '1940-01-01'),
(5, 'Les miserables', 'Roman', '1962-01-01'),
(6, 'Illusions perdues', 'Etude de moeurs', '1837-01-01'),
(10, 'livre 1', 'test', '2010-05-06'),
(11, 'livre 2', 'test', '2010-05-06'),
(12, 'livre 3', 'test', '2010-05-06');

-- --------------------------------------------------------

--
-- Structure de la table `writer_write_book`
--

CREATE TABLE `writer_write_book` (
  `book_id` int(11) NOT NULL,
  `writter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `writer_write_book`
--

INSERT INTO `writer_write_book` (`book_id`, `writter_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(10, 7);

-- --------------------------------------------------------

--
-- Structure de la table `writter`
--

CREATE TABLE `writter` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `writter`
--

INSERT INTO `writter` (`id`, `lastname`, `firstname`, `birthday`) VALUES
(1, 'Camus ', 'Albert', '1913-11-07'),
(2, 'Rowling', 'J.K', '1965-07-31'),
(3, 'Christie', 'Agatha', '1890-09-15'),
(4, 'Hugo', 'Victor', '1802-02-26'),
(5, 'De Balzac', 'Honoré', '1799-05-20'),
(7, 'test', '1', '1978-10-15'),
(8, 'test', '2', '1978-10-15'),
(9, 'test', '3', '1978-10-15');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `writer_write_book`
--
ALTER TABLE `writer_write_book`
  ADD PRIMARY KEY (`book_id`,`writter_id`),
  ADD KEY `fk_writer_write_book_writter1_idx` (`writter_id`);

--
-- Index pour la table `writter`
--
ALTER TABLE `writter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `writter`
--
ALTER TABLE `writter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `writer_write_book`
--
ALTER TABLE `writer_write_book`
  ADD CONSTRAINT `fk_writer_write_book_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_writer_write_book_writter1` FOREIGN KEY (`writter_id`) REFERENCES `writter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
