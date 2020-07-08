-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Jul-2020 às 09:57
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secretfriend_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `passwd_recover`
--

CREATE TABLE `passwd_recover` (
  `id_recover` int(11) NOT NULL,
  `token_recover` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rafflefriend`
--

CREATE TABLE `rafflefriend` (
  `id_raffle` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `nome_user1` varchar(255) NOT NULL,
  `email_user1` varchar(255) NOT NULL,
  `nome_user2` varchar(255) NOT NULL,
  `email_user2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rafflegroup`
--

CREATE TABLE `rafflegroup` (
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome_grupo` varchar(100) NOT NULL,
  `desc_grupo` varchar(200) NOT NULL,
  `data_sorteio` date NOT NULL,
  `preco_min` varchar(50) NOT NULL,
  `preco_max` varchar(50) NOT NULL,
  `cod_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nome_user` varchar(100) NOT NULL,
  `sobrenome_user` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `passwd_recover`
--
ALTER TABLE `passwd_recover`
  ADD PRIMARY KEY (`id_recover`);

--
-- Indexes for table `rafflefriend`
--
ALTER TABLE `rafflefriend`
  ADD PRIMARY KEY (`id_raffle`),
  ADD KEY `id_group` (`id_group`);

--
-- Indexes for table `rafflegroup`
--
ALTER TABLE `rafflegroup`
  ADD PRIMARY KEY (`id_group`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `passwd_recover`
--
ALTER TABLE `passwd_recover`
  MODIFY `id_recover` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rafflefriend`
--
ALTER TABLE `rafflefriend`
  MODIFY `id_raffle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rafflegroup`
--
ALTER TABLE `rafflegroup`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
