-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Nov-2018 às 19:10
-- Versão do servidor: 10.1.22-MariaDB
-- PHP Version: 7.1.4

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
-- Estrutura da tabela `animal`
--

CREATE TABLE `animal` (
  `codigo` int(11) NOT NULL,
  `codigoDono` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `nick` varchar(15) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `email` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`codigo`, `codigoDono`, `nome`, `descricao`, `nick`, `senha`, `email`) VALUES
(1, 8, 'Fido', 'Sou um cachorro e mordo todo mundo', 'Fido', 'Fido', 'fido@gmail.com'),
(3, 16, 'Bustica', 'Sou um hamster e a unica coisa que eu faco é comer... comer... e comer e dormir mais um pouco para depois comer', 'Bustica', 'bustica', 'bustica@gmail.com'),
(4, 10, 'Danzinho', 'não tenho nada a dizer...\r\n\r\ngrato	', 'Adam', 'adam', 'dandan@gmail.com'),
(5, 4, 'Arizona', 'Cao muito atrevido', 'Arizona', 'arizona', 'arizona@gmail.com'),
(7, 14, 'Alerta', 'Como mouito e faco tocas no chao', 'Alerta', 'alerta', 'alerta@gmil.com'),
(9, 4, 'Alf', 'Sou grande e se mexer comigo a cobra vai fumar', 'Alf', 'alf', 'alf@gmail.com'),
(11, 6, 'Cumbuca', 'Gosto de cenouras', 'Cumbuca', 'cumbuca', 'cumbuca@gmail.com'),
(12, 6, 'Cumbuquinha', '', 'Cumbuquinha', 'cumbuquinha', 'cumbuquinha@gmail.com'),
(30, 2, 'Veludo', 'Sou peludo a beça', 'Veludo', 'veludo', 'veludo@gmail.com'),
(31, 2, 'Veludo', '', 'Vel', 'veludo2', 'veludo2@gmail.com'),
(36, 0, 'beatriz', '', 'user33', 'beatriz', 'bia291@gmail.com'),
(37, 0, 'beatriz2', '', 'user37', 'beatriz2', 'beatriz2@gmail.com'),
(38, 0, 'Sniakova', '', 'user38', 'sniakova', 'sniakova@gmail.com'),
(39, 0, 'A', '', 'user39', 'a', 'a'),
(40, 0, 'Meunome', '', 'user40', 'minhasenha', 'meuemail@emil.com'),
(41, 0, '1', '', 'user41', '1', '1'),
(42, 0, 'Giselle', '', 'user42', 'gigi', 'giselle@email.com'),
(43, 0, 'Jorge', 'Oi meu nome é jorge', 'user43', 'jorge', 'jorge@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dono`
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
-- Extraindo dados da tabela `dono`
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
-- Estrutura da tabela `interacao`
--

CREATE TABLE `interacao` (
  `codigo` int(10) NOT NULL,
  `codSeguido` int(10) NOT NULL,
  `codSeguidor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `interacao`
--

INSERT INTO `interacao` (`codigo`, `codSeguido`, `codSeguidor`) VALUES
(35, 4, 3),
(36, 5, 3),
(38, 12, 11),
(49, 3, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `codigo` int(11) NOT NULL,
  `codigoAnimal` int(11) DEFAULT NULL,
  `conteudo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dataStatus` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`codigo`, `codigoAnimal`, `conteudo`, `dataStatus`) VALUES
(1, 4, 'Ola! eu sou o Adam. Esta é a minha primeira postagem', '2017-10-05 00:00:00'),
(5, 1, 'Homem deve ser tratado como um bom vinho: no escuro, na horizontal, e com rolha na boca. BRINKS', '2017-10-13 00:00:00'),
(7, 9, 'Se seu problema é dinheiro, e voce não tem dinheiro. Logo voce não tem problema', '2017-10-19 00:00:00'),
(8, 3, 'TO FALANDO... NÃO ESTOU NÃO!!!!', '2017-10-27 00:00:00'),
(9, 3, 'DE NOVO VELHO??? TO FALANDO... NÃO ESTOU NÃO!!!!', '2017-10-28 00:00:00'),
(10, 3, 'DE NOVO VELHO??? TO FALANDO... NÃO ESTOU NÃO!!!!', '2017-10-31 00:00:00'),
(11, 7, 'Com muito sono...', '2018-03-23 00:00:00'),
(12, 7, 'Porcaria de sono ja foi embora :(...', '2018-03-23 00:00:00'),
(13, 3, 'a', '2018-07-07 00:00:00'),
(14, 4, 'e ai', '2018-07-10 17:17:17'),
(15, 4, 'cala', '2018-07-10 17:17:23'),
(16, 4, 'cala', '2018-07-10 17:25:42'),
(18, 3, 'oi', '2018-07-12 17:58:15'),
(19, 3, 'a', '2018-07-12 18:01:03'),
(20, 3, 'oi genbte', '2018-08-16 16:54:10'),
(21, 5, 'Aqi curtindo um sol em memphis', '2018-08-22 17:06:19');

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
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `dono`
--
ALTER TABLE `dono`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `interacao`
--
ALTER TABLE `interacao`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `codigoAnimal_fk` FOREIGN KEY (`codigoAnimal`) REFERENCES `animal` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
