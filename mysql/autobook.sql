-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Lut 2021, 13:46
-- Wersja serwera: 10.4.16-MariaDB
-- Wersja PHP: 7.4.12

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
-- Struktura tabeli dla tabeli `service`
--

CREATE TABLE `service` (
  `client_id` int(11) NOT NULL,
  `mark` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `generation` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `vin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `registration` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `date` datetime NOT NULL,
  `mileage` mediumint(9) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `service`
--

INSERT INTO `service` (`client_id`, `mark`, `model`, `generation`, `vin`, `registration`, `year`, `date`, `mileage`, `description`) VALUES
(5, 'Opel', 'Zafira', 'C', 'W0L0AHM75A2096189', 'CBY69JP', 2007, '2021-01-22 00:56:52', 187546, 'wymiana przednich amortyzatorów i zbieżność');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `joining_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `ip_address` text COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('k','m') COLLATE utf8_unicode_ci NOT NULL COMMENT 'k - klient\r\nm - mechanik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`, `joining_date`, `last_login_date`, `ip_address`, `role`) VALUES
(5, 'Maciej', 'Tonn', 'maciejciej13', 'tonmaciej@maciejtonn.com', '2021-01-01 00:28:49', '2021-01-22 00:28:49', '185.10.123.223', 'k'),
(7, 'Jaca', 'Waca', 'sexkeks21', 'jaca@waca.pl', '2020-08-06 00:30:49', '2021-01-22 00:30:49', '192.123.123.22', 'm');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`client_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_users` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
