-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 03:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donkey`
--

-- --------------------------------------------------------

--
-- Table structure for table `boekingen`
--

CREATE TABLE `boekingen` (
  `ID` int(11) NOT NULL,
  `StartDatum` date DEFAULT NULL,
  `PINCode` int(11) DEFAULT NULL,
  `FKtochtenID` int(11) NOT NULL,
  `FKklantenID` int(11) NOT NULL,
  `FKstatussenID` int(11) NOT NULL,
  `FKtrackerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `boekingen`
--

INSERT INTO `boekingen` (`ID`, `StartDatum`, `PINCode`, `FKtochtenID`, `FKklantenID`, `FKstatussenID`, `FKtrackerID`) VALUES
(1, '2020-09-10', 0, 8, 8, 1, NULL),
(2, '2020-09-11', NULL, 7, 3, 2, NULL),
(3, '2020-09-11', 65316, 3, 6, 3, NULL),
(4, '2020-09-16', NULL, 2, 8, 3, NULL),
(5, '2020-10-07', 89609, 4, 8, 3, NULL),
(6, '2020-10-10', NULL, 1, 8, 1, NULL),
(7, '2022-06-26', 1234, 7, 15, 3, 1),
(8, '2022-06-30', 1234, 1, 20, 3, 2),
(9, '2022-06-30', 4321, 2, 20, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gebruikersrechten`
--

CREATE TABLE `gebruikersrechten` (
  `ID` int(11) NOT NULL,
  `Recht` varchar(45) NOT NULL,
  `Rechten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gebruikersrechten`
--

INSERT INTO `gebruikersrechten` (`ID`, `Recht`, `Rechten`) VALUES
(0, 'klant', 0),
(1, 'read', 1),
(2, 'write', 2),
(3, 'update', 4),
(4, 'delete', 8),
(5, 'admin', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `herbergen`
--

CREATE TABLE `herbergen` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(50) DEFAULT NULL,
  `Adres` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Telefoon` varchar(20) DEFAULT NULL,
  `Coordinaten` varchar(20) DEFAULT NULL,
  `Gewijzigd` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `herbergen`
--

INSERT INTO `herbergen` (`ID`, `Naam`, `Adres`, `Email`, `Telefoon`, `Coordinaten`, `Gewijzigd`) VALUES
(1, 'Eifel All Inn', 'Dorfstr. 3, 56864 Bonsbeuern', 'eai@gmail.com', '0616243524', NULL, '2019-08-03 15:11:12'),
(2, 'Herberg Buchenbeuren', 'Bahnhofstr. 155, 59980 Buchenbeuren', 'hbb@buchenbeuren.de', '06989898877', NULL, '2020-07-23 15:11:12'),
(3, 'Hotel Altlay', 'Im Kammerbach 4, 53243 Altlay', 'hotel-altlay@gmail.eu', '0676453213', NULL, '2015-05-23 15:11:12'),
(4, 'Hotel Punderich', 'Frankenstr. 44, 55465 Punderich', 'punderich@hotmail.nl', '0633442188', 'N51.23554 E7.13459', '2015-07-22 06:11:12'),
(5, 'Sponheimer Muhle', 'Ahringstal 14, 45678 Enkirch', 'sponheim@t-online.de', '0678453425', NULL, '2016-05-11 15:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE `klanten` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Telefoon` varchar(20) DEFAULT NULL,
  `Wachtwoord` varchar(100) DEFAULT NULL,
  `FKgebruikersrechtenID` int(11) DEFAULT 0,
  `Gewijzigd` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`ID`, `Naam`, `Email`, `Telefoon`, `Wachtwoord`, `FKgebruikersrechtenID`, `Gewijzigd`) VALUES
(1, 'Freddy Heinek', 'f.heinenken@heineken.eu', '0612123232', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2019-05-13 06:00:35'),
(2, 'Herman Brood', 'herman@hermanbrood.nl', '0612123333', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2016-12-08 07:00:35'),
(3, 'Johnny Jordaan', 'john@jordaan.nl', '0678453425', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2018-07-18 08:00:35'),
(4, 'Linda de Mol', 'lindademol@demol.com', '0699889988', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2019-12-21 21:00:35'),
(5, 'Louis Couperus', 'I.couperus@obscura', '0600110023', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2021-03-17 11:00:35'),
(6, 'Mata Hari', 'mata.hari@gmail.eu', '0676453213', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2021-08-19 15:00:35'),
(7, 'Piet Hein', 'piet.hein@gmail.com', '0616243524', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2013-06-11 04:00:35'),
(8, 'Piet Mondriaan', 'piet@mondriaan.nl', '0698989887', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2022-05-05 23:00:35'),
(9, 'Willem Alexander van Buren', 'willem@oranje.nl', '0610000000', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2022-05-04 15:00:35'),
(10, 'Yolanthe Snijder', 'yolo@hotmail.nl', '0633442188', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2022-05-17 16:00:35'),
(11, 'Jeroen Krabbe', 'jeroenkrabbe@hotmail.com', '0699998811', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2022-05-26 17:00:35'),
(14, 'admin', 'admin@admin', '0000000000', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 5, '2022-06-13 15:13:07'),
(15, 'John', 'john@mail', '0636243554', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0, '2022-06-15 12:10:09'),
(20, 'gast', 'gast@gast', '0612345676', 'aaac7fafa76910e7a042ae9f783c08cc516ea835ee3cffb7055421a25be67a21', 0, '2022-06-25 14:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `overnachtingen`
--

CREATE TABLE `overnachtingen` (
  `ID` int(11) NOT NULL,
  `FKboekingenID` int(11) NOT NULL,
  `FKherbergenID` int(11) NOT NULL,
  `FKstatussenID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overnachtingen`
--

INSERT INTO `overnachtingen` (`ID`, `FKboekingenID`, `FKherbergenID`, `FKstatussenID`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pauzeplaatsen`
--

CREATE TABLE `pauzeplaatsen` (
  `ID` int(11) NOT NULL,
  `FKboekingenID` int(11) NOT NULL,
  `FKrestaurantsID` int(11) NOT NULL,
  `FKstatussenID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pauzeplaatsen`
--

INSERT INTO `pauzeplaatsen` (`ID`, `FKboekingenID`, `FKrestaurantsID`, `FKstatussenID`) VALUES
(1, 2, 3, 1),
(2, 3, 4, 1),
(3, 4, 5, 1),
(4, 5, 2, 3),
(5, 6, 6, 3),
(6, 1, 1, 1),
(7, 1, 2, 1),
(8, 1, 3, 1),
(9, 1, 4, 1),
(10, 1, 5, 1),
(11, 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(50) DEFAULT NULL,
  `Adres` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Telefoon` varchar(20) DEFAULT NULL,
  `Coordinaten` varchar(20) DEFAULT NULL,
  `Gewijzigd` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`ID`, `Naam`, `Adres`, `Email`, `Telefoon`, `Coordinaten`, `Gewijzigd`) VALUES
(1, 'Gasthaus Reicharts-land', 'Dauner Str. 6, 54552 Üdersdorf', 'ralph@gasthausreicharts-land.de', '0610000000', 'N50.12345 E7.12345', '2022-06-08 15:11:03'),
(2, 'Gaststätte Zur Erftquelle', 'Trierer Str. 30, 53947 Nettersheim', 'thomas-e@hotmail.com', '0699998811', 'N50.55332 E7.63456', '2022-06-06 15:11:03'),
(3, 'Gästhaus Fuchshof', 'Burgstr. 3, 53520 Nürburg', 'sabine@am-tiergarten.de', '0600110023', 'N49.12345 E7.19652', '2021-12-07 16:11:03'),
(4, 'Gästhaus Nils Müller', 'Hauptstr. 20, 56858 Altlay', 'nils@gasthaus-nilsmueller.de', '0600110023', 'N49.12345 E7.19652', '2021-01-15 16:11:03'),
(5, 'Pferderhof Gut Blumenscheid', 'Bergweilerweg, 54516 Wittlich', 'knoll@hofblumenscheid.de', '0612123333', '', '2020-03-23 16:11:03'),
(6, 'Restaurant Bürgerstube', 'Mühlental 29, 56856 Zell (Mosel)', 'linda@buergerstube-zell.de', '0699889988', 'N50.12345 E7.12345', '2022-02-05 16:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `statussen`
--

CREATE TABLE `statussen` (
  `ID` int(11) NOT NULL,
  `StatusCode` tinyint(4) DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `Verwijderbaar` bit(1) DEFAULT NULL,
  `PINtoekennen` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statussen`
--

INSERT INTO `statussen` (`ID`, `StatusCode`, `Status`, `Verwijderbaar`, `PINtoekennen`) VALUES
(1, 0, 'Aanvraag', b'1', b'0'),
(2, 10, 'Offerte', b'1', b'0'),
(3, 20, 'Definitief', b'0', b'1'),
(4, 30, 'Archief', b'0', b'0'),
(5, 127, 'test', b'0', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tochten`
--

CREATE TABLE `tochten` (
  `ID` int(11) NOT NULL,
  `Omschrijving` varchar(40) DEFAULT NULL,
  `Route` varchar(50) DEFAULT NULL,
  `AantalDagen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tochten`
--

INSERT INTO `tochten` (`ID`, `Omschrijving`, `Route`, `AantalDagen`) VALUES
(1, 'Altlay via Berenbach', 'Altlay', 6),
(2, 'Hoog langs de rivier', 'Urzig', 7),
(3, 'Langs de kyll', 'Kyll', 5),
(4, 'Leisteenroute', 'Leienkaul', 4),
(5, 'Paflurtour', 'Paflur', 3),
(6, 'Rondje Bremm', 'Bremm', 4),
(7, 'Stelvio', 'Stelvio', 8),
(8, 'Tunnelroute', 'Wittlich', 6);

-- --------------------------------------------------------

--
-- Table structure for table `trackers`
--

CREATE TABLE `trackers` (
  `ID` int(11) NOT NULL,
  `PINCode` int(11) NOT NULL,
  `Lat` double NOT NULL,
  `Lon` double NOT NULL,
  `Time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trackers`
--

INSERT INTO `trackers` (`ID`, `PINCode`, `Lat`, `Lon`, `Time`) VALUES
(1, 1234, 0, 0, 0),
(2, 1234, 0, 0, 0),
(3, 4321, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boekingen`
--
ALTER TABLE `boekingen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_boekingen_tochten_idx` (`FKtochtenID`),
  ADD KEY `fk_boekingen_klanten1_idx` (`FKklantenID`),
  ADD KEY `fk_boekingen_statussen1_idx` (`FKstatussenID`),
  ADD KEY `fk_boekingen_trackers1_idx` (`FKtrackerID`);

--
-- Indexes for table `gebruikersrechten`
--
ALTER TABLE `gebruikersrechten`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `herbergen`
--
ALTER TABLE `herbergen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_klanten_gebruikersrechten1_idx` (`FKgebruikersrechtenID`);

--
-- Indexes for table `overnachtingen`
--
ALTER TABLE `overnachtingen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_overnachtingen_boekingen1_idx` (`FKboekingenID`),
  ADD KEY `fk_overnachtingen_herbergen1_idx` (`FKherbergenID`),
  ADD KEY `fk_overnachtingen_statussen1_idx` (`FKstatussenID`);

--
-- Indexes for table `pauzeplaatsen`
--
ALTER TABLE `pauzeplaatsen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_pauzeplaatsen_boekingen1_idx` (`FKboekingenID`),
  ADD KEY `fk_pauzeplaatsen_restaurants1_idx` (`FKrestaurantsID`),
  ADD KEY `fk_pauzeplaatsen_statussen1_idx` (`FKstatussenID`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `statussen`
--
ALTER TABLE `statussen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tochten`
--
ALTER TABLE `tochten`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trackers`
--
ALTER TABLE `trackers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boekingen`
--
ALTER TABLE `boekingen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gebruikersrechten`
--
ALTER TABLE `gebruikersrechten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `herbergen`
--
ALTER TABLE `herbergen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `overnachtingen`
--
ALTER TABLE `overnachtingen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pauzeplaatsen`
--
ALTER TABLE `pauzeplaatsen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statussen`
--
ALTER TABLE `statussen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tochten`
--
ALTER TABLE `tochten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trackers`
--
ALTER TABLE `trackers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boekingen`
--
ALTER TABLE `boekingen`
  ADD CONSTRAINT `fk_boekingen_klanten1` FOREIGN KEY (`FKklantenID`) REFERENCES `klanten` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_boekingen_statussen1` FOREIGN KEY (`FKstatussenID`) REFERENCES `statussen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_boekingen_tochten` FOREIGN KEY (`FKtochtenID`) REFERENCES `tochten` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_boekingen_trackers` FOREIGN KEY (`FKtrackerID`) REFERENCES `trackers` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `klanten`
--
ALTER TABLE `klanten`
  ADD CONSTRAINT `fk_klanten_gebruikersrechten1` FOREIGN KEY (`FKgebruikersrechtenID`) REFERENCES `gebruikersrechten` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `overnachtingen`
--
ALTER TABLE `overnachtingen`
  ADD CONSTRAINT `fk_overnachtingen_boekingen1` FOREIGN KEY (`FKboekingenID`) REFERENCES `boekingen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_overnachtingen_herbergen1` FOREIGN KEY (`FKherbergenID`) REFERENCES `herbergen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_overnachtingen_statussen1` FOREIGN KEY (`FKstatussenID`) REFERENCES `statussen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pauzeplaatsen`
--
ALTER TABLE `pauzeplaatsen`
  ADD CONSTRAINT `fk_pauzeplaatsen_boekingen1` FOREIGN KEY (`FKboekingenID`) REFERENCES `boekingen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pauzeplaatsen_restaurants1` FOREIGN KEY (`FKrestaurantsID`) REFERENCES `restaurants` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pauzeplaatsen_statussen1` FOREIGN KEY (`FKstatussenID`) REFERENCES `statussen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
