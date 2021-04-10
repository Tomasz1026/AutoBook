-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Kwi 2021, 20:58
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

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
-- Struktura tabeli dla tabeli `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `mark` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `generation` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `vin` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `registration` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `car`
--

INSERT INTO `car` (`id`, `client_id`, `mark`, `model`, `generation`, `vin`, `registration`, `year`) VALUES
(1, 5, 'Opel', 'Zafira', 'C', 'W0L0AHM75A2096189', 'CBY69JP', 2007),
(2, 5, 'Skoda', 'Fabia', 'I', '2JLISJC34MC62IN37', 'PLE1180', 2004),
(3, 5, 'Volkswagen ', 'Passat', 'B3', '1MMY285G0U0JN9773', 'ELC5247', 1989),
(4, 5, 'Volkswagen ', 'Polo', 'V', '4F7TMYTX71NHE5592', 'LBI4290', 2012),
(5, 5, 'Opel', 'Mokka', '-', 'AHT3FF8J36W0C4485', 'LBI6295', 2015),
(6, 5, 'Skoda', 'Citigo', '-', '5N148VBX83UC96009', 'DOA1001', 2016),
(7, 5, 'Audi', 'A3', '8P', 'VF862P2U106ZT1990', 'NNI0168', 2005),
(8, 5, 'Ford', 'Focus', 'Mk1', 'WKKSCJPY227J07460', 'PWR5447', 1999),
(9, 7, 'BMW', '3GT', '-', '2HHVR5MW6Z51P2810', 'WT45923', 2018),
(10, 5, 'Mercedes', 'CLS', 'C219', 'SAJKR6LW0EN797637', 'PTU7449', 2009),
(11, 5, 'Alfa Romeo', '159', '-', 'SAJYKWY358V151656', 'DOA6312', 2007),
(12, 5, 'Tesla', 'S', '-', 'VF699UL4756J84529', 'NE64750', 2017);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `mileage` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `service`
--

INSERT INTO `service` (`id`, `car_id`, `date`, `mileage`, `description`) VALUES
(1, 1, '2021-02-17', '168412', 'Wymiana sprzegla oraz klockow hamulcowych tyl.'),
(2, 1, '2021-02-01', '23', 'Steven Paul Jobs - jeden z trzech założycieli, były prezes i przewodniczący rady nadzorczej Apple Inc.'),
(3, 2, '2021-04-01', '10.000', ''),
(4, 8, '2021-01-01', '230.000', '');

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
  `role` enum('k','m') COLLATE utf8_unicode_ci NOT NULL COMMENT 'k - klient\r\nm - mechanik',
  `preference` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`, `joining_date`, `last_login_date`, `ip_address`, `role`, `preference`) VALUES
(5, 'Maciej', 'Tonn', 'maciejciej13', 'tonmaciej@maciejtonn.com', '2021-01-01 00:28:49', '2021-04-10 17:49:14', '185.10.123.223', 'k', '<span class=\"list\" id=\"add_text\"><div class=\"category\"><div class=\"sub_list\"><span>Spłuczki</span><span>Kanalizy</span><div class=\"category\"><div class=\"sub_list\"><span>chuj</span><span>penis</span><div class=\"category\"><div class=\"sub_list\"><span>chuj</span><span>penis</span><div class=\"category\"><div class=\"sub_list\"><span>chuj</span><span>penis</span></div><span>Niczego</span></div></div><span>Niczego</span></div></div><span>Niczego</span></div></div><span>Wymiana</span></div><div class=\"category\"><div class=\"sub_list\"><span>Hamulców</span><span>Klocków hamulcowych</span><span>Wycieraczek</span></div><span>Naprawa</span></div><div class=\"category\">sratatata</div>'),
(7, 'Jaca', 'Waca', 'sexkeks21', 'jaca@waca.pl', '2020-08-06 00:30:49', '2021-01-22 00:30:49', '192.123.123.22', 'm', '<span class=\"list\" id=\"add_text\"><div class=\"category\"><div class=\"sub_list\"><span>Spłuczki</span><span>Kanalizy</span><div class=\"category\"><div class=\"sub_list\"><span>chuj</span><span>penis</span><div class=\"category\"><div class=\"sub_list\"><span>chuj</span><span>penis</span><div class=\"category\"><div class=\"sub_list\"><span>chuj</span><span>penis</span></div><span>Niczego</span></div></div><span>Niczego</span></div></div><span>Niczego</span></div></div><span>Wymiana</span></div><div class=\"category\"><div class=\"sub_list\"><span>Hamulców</span><span>Klocków hamulcowych</span><span>Wycieraczek</span></div><span>Naprawa</span></div><div class=\"category\">sratatata</div>');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`) USING BTREE;

--
-- Indeksy dla tabeli `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `service_users` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
