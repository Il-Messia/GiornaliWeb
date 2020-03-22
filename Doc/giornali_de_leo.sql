--De Leo Alex 5^CIA

-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 21, 2020 alle 10:50
-- Versione del server: 10.4.8-MariaDB
-- Versione PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giornali_de_leo`
--

CREATE DATABASE `giornali_de_leo`;

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `IdAccount` int(11) NOT NULL,
  `Studente` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `PassWord` varchar(500) NOT NULL,
  `TipoAccount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `IdArticolo` int(11) NOT NULL,
  `Titolo` varchar(30) NOT NULL,
  `Abstract` varchar(100) NOT NULL,
  `Testo` text NOT NULL,
  `DataInizioVis` date NOT NULL,
  `DataFineVis` date NOT NULL,
  `Autore` int(11) NOT NULL,
  `Visionatore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ca`
--

CREATE TABLE `ca` (
  `IdCA` int(11) NOT NULL,
  `Categoria` int(11) NOT NULL,
  `Articolo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `IdCategoria` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ha`
--

CREATE TABLE `ha` (
  `IdHA` int(11) NOT NULL,
  `HotWord` int(11) NOT NULL,
  `Articolo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `hotwords`
--

CREATE TABLE `hotwords` (
  `IdHW` int(11) NOT NULL,
  `HotWord` varchar(30) NOT NULL,
  `Descrizione` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `studenti`
--

CREATE TABLE `studenti` (
  `IdStudente` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Citta` varchar(30) NOT NULL,
  `DataNascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipiaccount`
--

CREATE TABLE `tipiaccount` (
  `IdTA` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Descrizione` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`IdAccount`),
  ADD KEY `Studente` (`Studente`),
  ADD KEY `TipoAccount` (`TipoAccount`);

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`IdArticolo`),
  ADD KEY `Autore` (`Autore`),
  ADD KEY `Visionatore` (`Visionatore`);

--
-- Indici per le tabelle `ca`
--
ALTER TABLE `ca`
  ADD PRIMARY KEY (`IdCA`),
  ADD KEY `Categoria` (`Categoria`),
  ADD KEY `Articolo` (`Articolo`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indici per le tabelle `ha`
--
ALTER TABLE `ha`
  ADD PRIMARY KEY (`IdHA`),
  ADD KEY `Articolo` (`Articolo`),
  ADD KEY `HotWord` (`HotWord`);

--
-- Indici per le tabelle `hotwords`
--
ALTER TABLE `hotwords`
  ADD PRIMARY KEY (`IdHW`);

--
-- Indici per le tabelle `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`IdStudente`);

--
-- Indici per le tabelle `tipiaccount`
--
ALTER TABLE `tipiaccount`
  ADD PRIMARY KEY (`IdTA`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `account`
--
ALTER TABLE `account`
  MODIFY `IdAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `IdArticolo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ca`
--
ALTER TABLE `ca`
  MODIFY `IdCA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ha`
--
ALTER TABLE `ha`
  MODIFY `IdHA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `hotwords`
--
ALTER TABLE `hotwords`
  MODIFY `IdHW` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `studenti`
--
ALTER TABLE `studenti`
  MODIFY `IdStudente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tipiaccount`
--
ALTER TABLE `tipiaccount`
  MODIFY `IdTA` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`Studente`) REFERENCES `studenti` (`IdStudente`),
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`TipoAccount`) REFERENCES `tipiaccount` (`IdTA`);

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`Autore`) REFERENCES `account` (`IdAccount`),
  ADD CONSTRAINT `articolo_ibfk_2` FOREIGN KEY (`Visionatore`) REFERENCES `account` (`IdAccount`);

--
-- Limiti per la tabella `ca`
--
ALTER TABLE `ca`
  ADD CONSTRAINT `ca_ibfk_1` FOREIGN KEY (`Categoria`) REFERENCES `categorie` (`IdCategoria`),
  ADD CONSTRAINT `ca_ibfk_2` FOREIGN KEY (`Articolo`) REFERENCES `articolo` (`IdArticolo`);

--
-- Limiti per la tabella `ha`
--
ALTER TABLE `ha`
  ADD CONSTRAINT `ha_ibfk_1` FOREIGN KEY (`Articolo`) REFERENCES `articolo` (`IdArticolo`),
  ADD CONSTRAINT `ha_ibfk_2` FOREIGN KEY (`HotWord`) REFERENCES `hotwords` (`IdHW`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
