-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Sty 2021, 14:23
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `autobook`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `serwis`
--

CREATE TABLE `serwis` (
  `Id_klienta` int(11) NOT NULL,
  `Marka` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `Model` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `Generacja` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `VIN` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Rejestracja` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Rok` year(4) NOT NULL,
  `Data` datetime NOT NULL,
  `Przebieg` mediumint(9) NOT NULL,
  `Opis` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `serwis`
--

INSERT INTO `serwis` (`Id_klienta`, `Marka`, `Model`, `Generacja`, `VIN`, `Rejestracja`, `Rok`, `Data`, `Przebieg`, `Opis`) VALUES
(5, 'Opel', 'Zafira', 'C', 'W0L0AHM75A2096189', 'CBY69JP', 2007, '2021-01-22 00:56:52', 187546, 'wymiana przednich amortyzatorów i zbieżność');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID` int(11) NOT NULL,
  `Imie` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Nazwisko` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Haslo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Mail` text COLLATE utf8_unicode_ci NOT NULL,
  `Data_Dolaczenia` datetime NOT NULL,
  `Ostatnio_Logowany` datetime NOT NULL,
  `Adres_IP` text COLLATE utf8_unicode_ci NOT NULL,
  `Rola` enum('k','m') COLLATE utf8_unicode_ci NOT NULL COMMENT 'k - klient\r\nm - mechanik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `Imie`, `Nazwisko`, `Haslo`, `Mail`, `Data_Dolaczenia`, `Ostatnio_Logowany`, `Adres_IP`, `Rola`) VALUES
(5, 'Maciej', 'Tonn', 'maciejciej13', 'tonmaciej@maciejtonn', '2021-01-01 00:28:49', '2021-01-22 00:28:49', '185.10.123.223', 'k'),
(7, 'Jaca', 'Waca', 'sexkeks21', 'jaca@waca', '2020-08-06 00:30:49', '2021-01-22 00:30:49', '192.123.123.22', 'm');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `serwis`
--
ALTER TABLE `serwis`
  ADD PRIMARY KEY (`Id_klienta`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `serwis`
--
ALTER TABLE `serwis`
  ADD CONSTRAINT `serwis_ibfk_1` FOREIGN KEY (`Id_klienta`) REFERENCES `uzytkownicy` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
