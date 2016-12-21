-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 03 Juillet 2015 à 11:14
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `kilatrou`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `Date` datetime NOT NULL,
  `Etat` int(11) NOT NULL,
  `Adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CodePostal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Pays` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PrixTotal` decimal(10,0) NOT NULL,
  `FraisPort` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_979CC42B6B3CA4B` (`id_user`),
  UNIQUE KEY `UNIQ_979CC42BDD7ADDD` (`id_product`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `id_user`, `id_product`, `Date`, `Etat`, `Adresse`, `CodePostal`, `Ville`, `Pays`, `PrixTotal`, `FraisPort`) VALUES
(1, 5, 2, '2015-07-03 11:01:40', 1, '1', '4', '2', '3', '6', '5');

-- --------------------------------------------------------

--
-- Structure de la table `pack`
--

CREATE TABLE IF NOT EXISTS `pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prix` decimal(10,0) NOT NULL,
  `Image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prix` decimal(10,0) NOT NULL,
  `Note` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `Reference`, `Description`, `Image`, `Prix`, `Note`) VALUES
(1, 'Anissa 29 ans', 'Arabiatch qui adore se fait prendre par un groupe de gars en manque de sex!\nElle veut être comblé et pour cela elle à très bien compris qu''il ne faut pas exclure une bonne \nposition de soumission avec un panel de queues pour remplir tous ses orifices.', 'http://www.zupimages.net/up/15/27/7fz2.jpg', '170', 7),
(2, 'Kathleen 25 ans', 'Elle adore les hommes sauvages et on peut dire que vous risquez de bien vous amusez avec elle ! \r\nDes positions hot et une vitesse de malade pour faire jouir cette salope !', 'http://www.zupimages.net/up/15/27/tjt4.jpg', '190', 8),
(3, 'Ashley 27 ans', 'Ashley est une salope jamais rassasiée qui en veux sur commande, \r\nelle adore les hommes qui prennent le dessus et les positions extrèmes improvisées.\r\nElle ne dira jamais "non", la sodomie est sa tasse de thé.', 'http://www.zupimages.net/up/15/27/e80c.jpg', '220', 9),
(4, 'Shyla 19 ans', 'Avec la crise cette petite pute blonde de 19 ans doit prouver qu''elle vaut le coup,\r\nEtudiante, elle assoupit les pires fantasmes de ces maitres.\r\nElle accepte même d''etre filmée en train de recevoir une bonne dose de sperme \r\nsur sa jolie petite gueule. ', 'http://zupimages.net/up/15/27/rnyq.jpg', '250', 9),
(5, 'Caterine 41 ans', 'Cette cougar adore le sexe sans prise de tête ! \nAujourd''hui, plus rien ne lui fait peur.\nPas besoin d''y aller avec des pincettes, elle adore se faire souiller.\nSa citation favorite : "Tape dans le fond, je suis pas ta mère !"', 'http://zupimages.net/up/15/27/nurv.jpg', '190', 9),
(6, 'Natacha 22 ans ', 'Cette petite cochonne rousse va prendre une sauce monumental ! Elle a besoin de plus d’émotions dans sa vie alors elle accepte volontiers d’être filmée en train de prendre son pied avec ces labradors.', 'http://www.zupimages.net/up/15/27/49dh.jpg', '185', 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `Name`, `FirstName`, `Email`, `Password`) VALUES
(5, 'soquet', 'johann', 'johann.soquet@laposte.net', 'ab4f63f9ac65152575886860dde480a1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
