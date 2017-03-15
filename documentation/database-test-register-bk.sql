-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Mar-2017 às 10:07
-- Versão do servidor: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test-register`
--
CREATE DATABASE IF NOT EXISTS `test-register` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test-register`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL COMMENT 'Nome do Cliente',
  `cpf` varchar(20) NOT NULL COMMENT 'CPF do Cliente',
  `general_registration` varchar(20) DEFAULT NULL COMMENT 'RG do Cliente',
  `date_of_birth` date NOT NULL COMMENT 'Data de nascimento do Cliente',
  `created_at` datetime NOT NULL COMMENT 'Data e hora de cadastro do Cliente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `client`
--

INSERT INTO `client` (`id`, `name`, `cpf`, `general_registration`, `date_of_birth`, `created_at`) VALUES
(1, 'Cliente 1', '713.043.687-03', '123', '1988-01-01', '2017-03-15 09:58:22'),
(2, 'Cliente 2', '687.201.365-40', '222', '2009-02-10', '2017-03-15 09:58:51'),
(3, 'Cliente 3', '687.034.367-10', '221', '2016-03-09', '2017-03-15 09:59:15'),
(4, 'Cliente 4', '897.643.540-36', '585', '1995-02-16', '2017-03-15 09:59:44'),
(5, 'Cliente 5', '986.021.387-01', '343', '1990-07-12', '2017-03-15 10:01:13'),
(6, 'Cliente 6', '978.601.057-86', '445', '2000-06-06', '2017-03-15 10:00:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `website_name` varchar(60) NOT NULL,
  `version` varchar(10) DEFAULT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `configuration`
--

INSERT INTO `configuration` (`id`, `website_name`, `version`, `state_id`) VALUES
(1, 'Estado 2', '1.0.2', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `name`, `user`, `password`) VALUES
(1, 'Usuário Teste', 'teste01', '0102e9826d6e14ee5e167f18159aa728');

-- --------------------------------------------------------

--
-- Estrutura da tabela `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `phone`
--

INSERT INTO `phone` (`id`, `client_id`, `number`) VALUES
(1, 1, '(11)1111-11111'),
(2, 1, '(22)2222-22222'),
(3, 2, '(11)1111-11111'),
(4, 5, '(25)1411-11512'),
(5, 5, '(31)5885-65855');

-- --------------------------------------------------------

--
-- Estrutura da tabela `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `initial` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `state`
--

INSERT INTO `state` (`id`, `name`, `initial`) VALUES
(1, 'Santa Catarina', 'SC'),
(2, 'Paraná', 'PR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`,`state_id`),
  ADD KEY `fk_configuration_state1_idx` (`state_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`,`client_id`),
  ADD KEY `fk_phone_client_idx` (`client_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `configuration`
--
ALTER TABLE `configuration`
  ADD CONSTRAINT `fk_configuration_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `fk_phone_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
