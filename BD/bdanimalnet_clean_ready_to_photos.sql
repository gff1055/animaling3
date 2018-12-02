-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2018 at 11:23 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdanimalnet`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `codigo` int(11) NOT NULL,
  `codigoDono` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `nick` varchar(15) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `email` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`codigo`, `codigoDono`, `nome`, `foto`, `descricao`, `nick`, `senha`, `email`) VALUES
(62, 0, 'Um', '', '', 'user1', 'um', 'um@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dono`
--

CREATE TABLE `dono` (
  `codigo` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `nascimento` date NOT NULL,
  `sexo` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dono`
--

INSERT INTO `dono` (`codigo`, `usuario`, `senha`, `nome`, `sobrenome`, `nascimento`, `sexo`, `email`) VALUES
(2, 'b', 'b', 'b', 'b', '2017-05-02', NULL, 'b@b.com'),
(3, 'c', 'c', 'c', 'c', '2017-05-03', NULL, 'c@c.com.br'),
(4, 'henri2', 'henrisenha', 'henrique2', 'dourado2', '2017-07-17', 'M', 'novo_henriquedourado2@hotmal.com'),
(6, 'bia', 'biamaria', 'Maria', 'Bia', '2017-06-13', 'F', 'bia@gmail.com'),
(7, 'Cambia', 'camilabeatriz', 'Camila', 'Beatriz', '2017-09-21', 'F', 'camilabeatriz@gmail.com'),
(8, 'Brube', 'brunobernardo', 'Bruno', 'Bernardo', '2016-09-21', 'M', 'brunobernardo@gmail.com'),
(10, 'daieliza', 'daianeeliza', 'Daiane', 'Eliza', '2013-05-16', 'F', 'daianeeliza@gmail.com'),
(14, 'incognito', 'password27', 'firstName27', 'php', '2016-05-24', 'M', 'email271@email271.com'),
(15, 'user03', 'password27', 'firstName27', 'lastName27', '2017-07-27', 'M', 'email03@email.com'),
(16, 'MigMath', 'miguelmatheus', 'Miguel', 'Matheus', '2017-09-20', 'M', 'miguelmatheus@gmail.com'),
(17, 'Julisa', 'juliaisabela', 'Julia', 'Isabela', '2015-08-20', 'F', 'juliaisabela@gmail.com'),
(18, 'user10', 'lauralarissa', 'Laura', 'Larissa', '2014-07-19', 'f', 'lauralarissa@gmail.com'),
(19, 'henro', 'henriquerodrigo', 'Henrique', 'Rodrigo', '2013-06-18', 'M', 'henriquerodrigo@gmail.com'),
(20, 'user20', 'iurysapori', 'Iury', 'Sapori', '2012-04-15', 'M', 'iurysantos@gmail.com'),
(21, 'user21', 'isadorasilva', 'Isadora', 'Silva', '2012-05-17', 'F', 'isadorasilva@gmail.com'),
(22, 'user22', 'daniellacerda', 'Daniel', 'Lacerda', '1994-10-20', 'M', 'DaviLacerda@gmail.com'),
(23, 'user23', 'beatrizcastro', 'Beatriz', 'Castro', '2010-10-05', 'F', 'beatrizcastro@gmail.com'),
(24, 'user24', 'aaronbatista', 'Aaron', 'Batista', '2016-06-25', 'M', 'aaronbatista@hotmal.com'),
(25, 'user25', 'abelbellucci', 'Abel394', 'Bellucci3', '2015-05-24', 'M', 'abelbellucci@hotmal.com'),
(26, 'user26', 'abelbellucci', 'Abel', 'Bellucci', '2015-05-24', 'M', 'abelbellucci2@hotmal.com');

-- --------------------------------------------------------

--
-- Table structure for table `interacao`
--

CREATE TABLE `interacao` (
  `codigo` int(10) NOT NULL,
  `codSeguido` int(10) NOT NULL,
  `codSeguidor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `codigo` int(11) NOT NULL,
  `codigoAnimal` int(11) DEFAULT NULL,
  `fotopost` varchar(200) NOT NULL,
  `conteudo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dataStatus` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `dono`
--
ALTER TABLE `dono`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `interacao`
--
ALTER TABLE `interacao`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codigoAnimal_fk` (`codigoAnimal`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `dono`
--
ALTER TABLE `dono`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `interacao`
--
ALTER TABLE `interacao`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `codigoAnimal_fk` FOREIGN KEY (`codigoAnimal`) REFERENCES `animal` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
