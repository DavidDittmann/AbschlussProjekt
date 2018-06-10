-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Jun 2018 um 22:58
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `autoshopdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellungen`
--

CREATE TABLE `bestellungen` (
  `id` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_kunden_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `kategorien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategorie` varchar(64) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `kategorien` (`id`, `kategorie`) VALUES
(3, 'Coupe'),
(2, 'Kleinwagen'),
(1, 'Limousine');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE `produkte` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `bewertung` text COLLATE utf8_german2_ci,
  `beschreibung` text COLLATE utf8_german2_ci NOT NULL,
  `preis` float NOT NULL,
  `fotolink` text COLLATE utf8_german2_ci,
  `fk_kategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`id`, `name`, `bewertung`, `beschreibung`, `preis`, `fotolink`, `fk_kategorie`) VALUES
(1, 'Audi A3', 'Der Allrounder von Audi', 'Der Renner unter den Audis', 15999, './pic/1.jpg', 1),
(2, 'Smart Pure', 'Umweltfreundlich und echter Fahrspass', 'Der Elektroflitzer von Smart', 23900, './pic/2.jpg', 2),
(3, 'Audi A3 Bluemotion', 'Extrem leiwand', 'Audi A3 extra geile VAriante', 17999, './pic/3.jpg', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `prod_bes`
--

CREATE TABLE `prod_bes` (
  `id` int(11) NOT NULL,
  `fk_best_id` int(11) NOT NULL,
  `fk_prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `pwd` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `vorname` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `nachname` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `adresse` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `plz` varchar(16) COLLATE utf8_german2_ci NOT NULL,
  `ort` varchar(32) COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_german2_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `pwd`, `vorname`, `nachname`, `adresse`, `plz`, `ort`, `email`, `is_admin`) VALUES
(8, 'Admin', 'a55e0e08248d39dd931b340e9cbe0f41', 'Adminstreet 1', '1234', 'AdminTown', 'Admin', 'Istrator', 'admin@example.com', 1),
(9, 'Username', 'a55e0e08248d39dd931b340e9cbe0f41', 'Musterstrasse 3', '1234', 'Musterort', 'Max', 'Mustermann', 'email@example.com', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kunden_id` (`fk_kunden_id`);

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategorie` (`kategorie`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `prod_bes`
--
ALTER TABLE `prod_bes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_best_id` (`fk_best_id`),
  ADD KEY `fk_prod_id` (`fk_prod_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `prod_bes`
--
ALTER TABLE `prod_bes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD CONSTRAINT `bestellungen_ibfk_1` FOREIGN KEY (`fk_kunden_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `prod_bes`
--
ALTER TABLE `prod_bes`
  ADD CONSTRAINT `prod_bes_ibfk_1` FOREIGN KEY (`fk_best_id`) REFERENCES `bestellungen` (`id`),
  ADD CONSTRAINT `prod_bes_ibfk_2` FOREIGN KEY (`fk_prod_id`) REFERENCES `produkte` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
