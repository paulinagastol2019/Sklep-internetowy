-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Paź 2021, 09:55
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `shoponline`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`cart_id`, `user_id`, `item_id`) VALUES
(39, 1, 9),
(40, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `item_name` text COLLATE utf8_polish_ci NOT NULL,
  `item_price` float NOT NULL,
  `item_image` char(250) COLLATE utf8_polish_ci NOT NULL,
  `item_brand` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `item_name`, `item_price`, `item_image`, `item_brand`) VALUES
(1, 'Plyn dezynfekujacy', 45.95, './images/product1.jpg', 'Plyny'),
(2, 'Komplet recznikow', 99.99, './images/product2.jpg', 'Reczniki'),
(3, 'Mydlo - rozne ksztalty', 7.59, './images/product3.jpg', 'Mydla'),
(4, 'Maseczki', 2.99, './images/product4.jpg', ''),
(5, 'Papier toaletowy', 2.99, './images/product5.jpg', ''),
(6, 'Chusteczki higieniczne', 11.55, './images/product6.jpg', ''),
(7, 'Reczniki kolorowe', 59.99, './images/product7.jpg', 'Reczniki'),
(8, 'Pasta do zebow + plyn', 12.35, './images/product8.jpg', ''),
(9, 'Perfumy', 159.99, './images/product9.jpg', ''),
(10, 'Zel pod prysznic - 2szt.', 26.99, './images/product10.jpg', 'Plyny'),
(11, 'Mydlo kostka prezent', 21.59, './images/product11.jpg', 'Mydla');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `user_id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(65) COLLATE utf8_polish_ci NOT NULL,
  `pass` varchar(65) COLLATE utf8_polish_ci NOT NULL,
  `surname` text COLLATE utf8_polish_ci NOT NULL,
  `adres` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`user_id`, `name`, `email`, `pass`, `surname`, `adres`) VALUES
(1, 'Paulina', 'paulina@gmail.com', '$2y$10$n63CwCoFUw/09CZTWejntuwPSA3T48LvTIqOkzH5shfAXxmQwC.dW', 'Gąstoł', 'ul.Krakowska 31, 30-855 Kraków'),
(2, 'Adam', 'adam@gmail.com', '$2y$10$Hf2jXgHjD427eCyYP9tlbuWm24HErYSX5ylWpW4SEe8/mn9Q4AFZ.', 'Nowak', ''),
(3, 'JÃ³zef', 'jozef@gmail.com', '$2y$10$LwbLoCc93biCifBY.ijX4.O5PG3wc1HMeH/6nuyt4kNXZGChGHC2K', 'GÄ…sior', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
