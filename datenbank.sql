-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 29. Mai 2021 um 17:47
-- Server-Version: 10.3.27-MariaDB-0+deb10u1
-- PHP-Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `itech_sdn`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `api_keys`
--

CREATE TABLE `api_keys` (
  `ID` int(11) NOT NULL,
  `API_KEY` text NOT NULL,
  `API_STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `api_keys`
--

INSERT INTO `api_keys` (`ID`, `API_KEY`, `API_STATUS`) VALUES
(1, '1q2w3e4r5t6z7u8i9o0p', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `devices`
--

CREATE TABLE `devices` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `IP` text NOT NULL,
  `User` text NOT NULL,
  `Password` text NOT NULL,
  `Shell_Port` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `devices`
--

INSERT INTO `devices` (`ID`, `Name`, `IP`, `User`, `Password`, `Shell_Port`) VALUES
(3, 'vManage', '10.10.20.90', 'admin', 'C1sco12345', '22'),
(4, 'vBond', '10.10.20.80', 'admin', 'C1sco12345', '22'),
(5, 'vSmart', '10.10.20.70', 'admin', 'C1sco12345', '22'),
(6, 'devbox', '10.10.20.50', 'developer', 'C1sco12345', '22'),
(7, 'dc-cedge01', '10.10.20.172', 'developer', 'C1sco12345', '22'),
(8, 'dc-wan-edge01', '10.10.20.173', 'developer', 'C1sco12345', '22'),
(9, 'site1-cedge01', '10.10.20.174', 'developer', 'C1sco12345', '22'),
(10, 'site2-cedge01', '10.10.20.175', 'developer', 'C1sco12345', '22'),
(11, 'site3-vedge01', '10.10.20.178', 'developer', 'C1sco12345', '22');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_users`
--

CREATE TABLE `user_users` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `firstname` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `rights_id` int(11) NOT NULL,
  `current_theme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_users`
--

INSERT INTO `user_users` (`ID`, `name`, `firstname`, `surname`, `email`, `password`, `rights_id`, `current_theme`) VALUES
(1, 'Administrator', 'Admin', 'istrator', 'admin@example.com', '$2y$10$8iRkFXRSDuD145zJBHMCFObr003iqLMxy3AVcJ2zzXhatX2r/Nzz.', 2, 0),
(2, 'TestUser', 'Max', 'Mustermann', 'max@mustermann.de', '$2y$10$NjUz.8KXPtlIQOtS5FRlhuES.BzSu1eb5Ejo/NsV3zPxPgyg/P3VO', 1, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `user_users`
--
ALTER TABLE `user_users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `devices`
--
ALTER TABLE `devices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
