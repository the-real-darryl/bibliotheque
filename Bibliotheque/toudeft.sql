-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2018 at 03:19 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toudeft`
--

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `NOM` varchar(50) NOT NULL,
  `PRENOM` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `ACTIF` tinyint(1) NOT NULL DEFAULT '1',
  `DCREATION` date NOT NULL,
  `DMODIFICATION` date NOT NULL,
  `ADMIN` tinyint(1) NOT NULL,
  `LAST_ACTIVE` date DEFAULT NULL,
  `E_MAIL` varchar(324) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`NOM`, `PRENOM`, `PASSWORD`, `ACTIF`, `DCREATION`, `DMODIFICATION`, `ADMIN`, `LAST_ACTIVE`, `E_MAIL`) VALUES
('darrayl-ddbduc-i', 'desdddaaaaaaaa', 'Darryl1', 1, '2018-07-01', '2018-08-04', 1, '2018-07-01', 'd@d.com'),
('desmeules', 'darryl', 'Darryl1', 0, '2018-07-01', '2018-08-04', 0, '2018-07-04', 'da12@gmail.com'),
('desmeules', 'darryl', 'Darryl1', 1, '2018-08-05', '2018-08-05', 1, NULL, 'da@d.com'),
('a@m.com', 'jhvui', 'iubfuvfiu', 1, '2018-07-01', '2018-07-01', 1, '2018-07-01', 'Darryl1'),
('lemaitref', 'desmaitre', 'Jesuis7', 1, '2018-07-01', '2018-07-12', 1, '2018-07-01', 'le@gmail.com'),
('potatta', 'jeno', 'Darryl1', 0, '2018-08-06', '2018-08-06', 1, NULL, 'lea@c.com'),
('nikoleta', 'dzhin', 'Niki123', 1, '2018-07-01', '2018-07-02', 0, '2018-07-04', 'niki@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

CREATE TABLE `demande` (
  `PKDEMANDE` int(10) UNSIGNED NOT NULL,
  `FKEXEMPLAIRE` int(10) UNSIGNED NOT NULL,
  `FKCOMPTE` varchar(324) NOT NULL,
  `DATE` date NOT NULL,
  `ETAT` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demande`
--

INSERT INTO `demande` (`PKDEMANDE`, `FKEXEMPLAIRE`, `FKCOMPTE`, `DATE`, `ETAT`) VALUES
(1, 2, 'd@d.com', '2018-08-06', 0),
(2, 7, 'd@d.com', '2018-08-06', 0),
(3, 4, 'niki@gmail.com', '2018-08-06', 0),
(4, 4, 'niki@gmail.com', '2018-08-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `PKEVALUATION` smallint(5) UNSIGNED NOT NULL,
  `RATING_EV` tinyint(3) UNSIGNED NOT NULL,
  `COMMENTAIRE` varchar(2000) NOT NULL,
  `FKCOMPTE` varchar(324) NOT NULL,
  `FKLIVRE` varchar(13) NOT NULL,
  `CREATION` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`PKEVALUATION`, `RATING_EV`, `COMMENTAIRE`, `FKCOMPTE`, `FKLIVRE`, `CREATION`) VALUES
(1, 5, 'lalelilolu', 'd@d.com', '9780470383261', '2018-08-01'),
(3, 5, 'ijnrgigrn deigrijngrin grkj f', 'da12@gmail.com', '9781491933565', '2018-08-05'),
(4, 5, 'fiuhsui svfiuhsui svijusdvnsdv ijsdvfvi', 'd@d.com', '46848196541', '2018-08-01'),
(5, 3, 'le bleu est la couleur du ciel', 'd@d.com', '46848196541', '2018-08-05'),
(6, 4, 'le vert est la couleur du gazon', 'd@d.com', '9782746047655', '2018-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `examplaire`
--

CREATE TABLE `examplaire` (
  `PKEXEMPLAIRE` int(10) UNSIGNED NOT NULL,
  `FKLIVRE` varchar(13) NOT NULL,
  `FKPROPRIETAIRE` varchar(324) NOT NULL,
  `FKDETENTEUR` varchar(324) NOT NULL,
  `CREATION` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examplaire`
--

INSERT INTO `examplaire` (`PKEXEMPLAIRE`, `FKLIVRE`, `FKPROPRIETAIRE`, `FKDETENTEUR`, `CREATION`) VALUES
(1, '46848196541', 'd@d.com', 'd@d.com', '2018-08-01'),
(2, '9782746047655', 'da12@gmail.com', 'd@d.com', '2018-08-01'),
(3, '9781449319243', 'niki@gmail.com', 'd@d.com', '2018-08-05'),
(4, '1345454541', 'niki@gmail.com', 'niki@gmail.com', '2018-08-05'),
(5, '9781491933565', 'da12@gmail.com', 'niki@gmail.com', '2018-08-04'),
(6, '46848196541', 'le@gmail.com', 'niki@gmail.com', '2018-08-02'),
(7, '9782746047655', 'le@gmail.com', 'd@d.com', '2018-08-05'),
(8, '666677778899', 'd@d.com', 'd@d.com', '2018-08-06'),
(9, '666677778777', 'd@d.com', 'd@d.com', '2018-08-06'),
(10, '564567890987', 'd@d.com', 'd@d.com', '2018-08-06'),
(11, '123424353627', 'd@d.com', 'd@d.com', '2018-08-06'),
(12, '666677123456', 'd@d.com', 'd@d.com', '2018-08-06'),
(13, '123487906754', 'd@d.com', 'd@d.com', '2018-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE `keyword` (
  `PKKEYWORD` int(11) NOT NULL,
  `KEYWORDDESC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `livre`
--

CREATE TABLE `livre` (
  `ISBN` varchar(13) NOT NULL,
  `TITRE` varchar(100) NOT NULL,
  `AUTEUR` varchar(50) NOT NULL,
  `NOEDITION` tinyint(3) UNSIGNED NOT NULL,
  `MAISON_EDITION` varchar(50) NOT NULL,
  `LANGUE` varchar(50) NOT NULL,
  `PARUTION` year(4) DEFAULT NULL,
  `COUVERTURE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livre`
--

INSERT INTO `livre` (`ISBN`, `TITRE`, `AUTEUR`, `NOEDITION`, `MAISON_EDITION`, `LANGUE`, `PARUTION`, `COUVERTURE`) VALUES
('123424353627', 'dede', 'feran', 3, 'mamu', 'lel', 2002, 'pi (2).jpg'),
('123487906754', 'ascibcashoih', 'ooihoihh', 1, 'oioiac', 'onooi', 2009, 'pi.jpg'),
('1345454541', 'nouveau', 'nouveau', 5, 'hgr', 'hngffv', 2015, 'imageImport.jpg'),
('46848196541', 'myjrhntbegrvf', 'mnjyhrbgt', 5, 'htbgrvfecd', 'nhtbgrvf', 1952, 'imageImport.jpg'),
('564567890987', 'LELELEL', 'arnold', 2, 'le gym', 'muscule', 2013, 'pi (2).jpg'),
('666677123456', 'uasyccyg', 'kjnsacn', 2, 'ksacdbasc', 'askuiscb', 2004, 'pi.jpg'),
('666677770009', 'le chat des champs', 'poutine', 1, 'le rat mort', 'Canada', 2018, 'pi.jpg'),
('666677778777', 'le livre brun', 'de caca', 2, 'abuto', 'langue', 2013, 'pi.jpg'),
('666677778888', 'le chat des champs', 'poutine', 1, 'le rat mort', 'hebreux', 2018, 'WAMEN.tif'),
('666677778899', 'le chat des champs', 'poutine', 1, 'le rat mort', 'Canada', 2018, 'pi.jpg'),
('9780470383261', 'Data structures and algorithms in Java', 'Goodrich, Michael T.', 5, 'J. Wiley & Sons', 'anglais', 2010, 'dsjava.jpg'),
('9781449319243', 'Learning Java', 'Niemeyer, Patrick', 3, 'Sebastopol, Calif. : O\'Reilly, 2013', 'anglais', 2013, 'learningjava.jpg'),
('9781491933565', 'Learning PHP : a gentle introduction to the Web\'s most popular language', 'Sklar, David', 1, 'O\'Reilly Media', 'anglais', 2016, 'php.jpg'),
('9782746047655', 'ORACLE 11g : SQL, PL/SQL, SQL*Plus', 'Gabillaud, Jérôme', 2, 'St-Herblain : Éditions ENI, c2009. ', 'francais', 2012, 'oracle11.jpg'),
('9782746089198', 'Algorithmique : techniques fondamentales de programmation, exemples en Python', 'Ebel, Franck', 1, 'Saint-Herblain : ENI, c2014.', 'francais', 2011, 'imageImport.jpg'),
('9782746093218', 'Design patterns en PHP : les 23 modèles de conception', 'Debrauwer, Laurent ', 4, 'Saint-Herblain : Éditions ENI, c2015.', 'francais', 2012, 'designphp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `livrekeyword`
--

CREATE TABLE `livrekeyword` (
  `FKLIVRE` varchar(13) NOT NULL,
  `FKKEYWORD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `livresujet`
--

CREATE TABLE `livresujet` (
  `FKLIVRE` varchar(13) NOT NULL,
  `FKSUJET` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registre`
--

CREATE TABLE `registre` (
  `PKREGISTRE` smallint(5) NOT NULL,
  `DATE` date NOT NULL,
  `FKEXEMPLAIRE` int(10) UNSIGNED NOT NULL,
  `FKDETENTEUR` varchar(324) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registre`
--

INSERT INTO `registre` (`PKREGISTRE`, `DATE`, `FKEXEMPLAIRE`, `FKDETENTEUR`) VALUES
(1, '2018-08-06', 2, 'd@d.com');

-- --------------------------------------------------------

--
-- Table structure for table `sujet`
--

CREATE TABLE `sujet` (
  `PKSUJET` int(10) NOT NULL,
  `SUJETDESC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`E_MAIL`);

--
-- Indexes for table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`PKDEMANDE`),
  ADD KEY `FKEXEMPLAIRE` (`FKEXEMPLAIRE`),
  ADD KEY `FKCOMPTE` (`FKCOMPTE`) USING BTREE;

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`PKEVALUATION`),
  ADD KEY `utilisateur` (`FKCOMPTE`),
  ADD KEY `FKLIVRE` (`FKLIVRE`);

--
-- Indexes for table `examplaire`
--
ALTER TABLE `examplaire`
  ADD PRIMARY KEY (`PKEXEMPLAIRE`) USING BTREE,
  ADD KEY `FKPROPRIETAIRE` (`FKPROPRIETAIRE`),
  ADD KEY `FKDETENTEUR` (`FKDETENTEUR`),
  ADD KEY `FKLIVRE` (`FKLIVRE`);

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`PKKEYWORD`);

--
-- Indexes for table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `livrekeyword`
--
ALTER TABLE `livrekeyword`
  ADD KEY `FKLIVRE` (`FKLIVRE`),
  ADD KEY `FKKEYWORD` (`FKKEYWORD`);

--
-- Indexes for table `livresujet`
--
ALTER TABLE `livresujet`
  ADD KEY `FKLIVRE` (`FKLIVRE`),
  ADD KEY `FKSUJET` (`FKSUJET`);

--
-- Indexes for table `registre`
--
ALTER TABLE `registre`
  ADD PRIMARY KEY (`PKREGISTRE`),
  ADD KEY `FKEXEMPLAIRE` (`FKEXEMPLAIRE`),
  ADD KEY `FKDETENTEUR` (`FKDETENTEUR`);

--
-- Indexes for table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`PKSUJET`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demande`
--
ALTER TABLE `demande`
  MODIFY `PKDEMANDE` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `PKEVALUATION` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `examplaire`
--
ALTER TABLE `examplaire`
  MODIFY `PKEXEMPLAIRE` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `PKKEYWORD` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registre`
--
ALTER TABLE `registre`
  MODIFY `PKREGISTRE` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `PKSUJET` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`FKEXEMPLAIRE`) REFERENCES `examplaire` (`PKEXEMPLAIRE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`FKCOMPTE`) REFERENCES `compte` (`E_MAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_4` FOREIGN KEY (`FKLIVRE`) REFERENCES `livre` (`ISBN`),
  ADD CONSTRAINT `evaluation_ibfk_5` FOREIGN KEY (`FKCOMPTE`) REFERENCES `compte` (`E_MAIL`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `examplaire`
--
ALTER TABLE `examplaire`
  ADD CONSTRAINT `examplaire_ibfk_6` FOREIGN KEY (`FKLIVRE`) REFERENCES `livre` (`ISBN`),
  ADD CONSTRAINT `examplaire_ibfk_7` FOREIGN KEY (`FKPROPRIETAIRE`) REFERENCES `compte` (`E_MAIL`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `examplaire_ibfk_8` FOREIGN KEY (`FKDETENTEUR`) REFERENCES `compte` (`E_MAIL`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `livrekeyword`
--
ALTER TABLE `livrekeyword`
  ADD CONSTRAINT `livrekeyword_ibfk_1` FOREIGN KEY (`FKLIVRE`) REFERENCES `livre` (`ISBN`),
  ADD CONSTRAINT `livrekeyword_ibfk_2` FOREIGN KEY (`FKKEYWORD`) REFERENCES `keyword` (`PKKEYWORD`);

--
-- Constraints for table `livresujet`
--
ALTER TABLE `livresujet`
  ADD CONSTRAINT `livresujet_ibfk_1` FOREIGN KEY (`FKLIVRE`) REFERENCES `livre` (`ISBN`),
  ADD CONSTRAINT `livresujet_ibfk_2` FOREIGN KEY (`FKSUJET`) REFERENCES `sujet` (`PKSUJET`);

--
-- Constraints for table `registre`
--
ALTER TABLE `registre`
  ADD CONSTRAINT `registre_ibfk_1` FOREIGN KEY (`FKEXEMPLAIRE`) REFERENCES `examplaire` (`PKEXEMPLAIRE`),
  ADD CONSTRAINT `registre_ibfk_2` FOREIGN KEY (`FKDETENTEUR`) REFERENCES `compte` (`E_MAIL`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
