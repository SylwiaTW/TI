-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Lut 2023, 13:46
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `formularz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `cena` float NOT NULL,
  `zdjecie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `cena`, `zdjecie`) VALUES
(1, 'Edukacja', 27, './ksiazki/edukacja.jpg'),
(2, 'Ekonomia obwarzanka', 55, './ksiazki/ekonomia.jpg'),
(3, 'Kapitał w XXI wieku', 64, './ksiazki/kapital.jpg'),
(4, 'Problem trzech ciał', 34, './ksiazki/problem.jpg'),
(5, 'Tajlandia', 89, './ksiazki/tajlandia.jpg'),
(6, 'Zamiast wychowania', 26, './ksiazki/zamiast.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `mail` text NOT NULL,
  `adres` text DEFAULT NULL,
  `wyksztalcenie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `imie`, `nazwisko`, `login`, `haslo`, `mail`, `adres`, `wyksztalcenie`) VALUES
(1, 'Jan', 'Kowalski', 'jkowal', '1234', 'jkowalski@mail.pl', 'Ul. Jana Pawła II 3', 'Wyższe'),
(3, 'Adam', 'Nowak', 'anowak', 'asdfg', 'anowak@mail.com', 'ul.  Kościuszki 5', 'Średnie'),
(4, 'Anna', 'Qwerty', 'aqwerty', 'qwerty', 'aqwerty@op.pl', 'Mickiewicza', 'Podstawowe'),
(5, 'Agata', 'Goj', 'agoj', 'agoj123', 'agoj@poczta.lala', 'Kopernika 3', 'Wyższe'),
(6, 'Michal', 'Zien', 'mzien', 'mzien123', 'mzien@poczta.lala', 'Słowackiego', 'Średnie'),
(7, 'Pawel', 'Gawel', 'pawel', 'qwerty', 'pawelgawel@poczta.pl', 'Pilsudskiego 1', 'Średnie'),
(10, 'Pola', 'Nowak', 'pnowak', '1234', 'pnowak@mail.pl', 'Dmowskiego 8', 'Wyższe'),
(11, 'Wanda', 'Ptotr', 'wptotr', 'qwerty', 'wptotr@ma.pl', 'Zdzisława 4', 'Wyższe'),
(12, 'Patrycja', 'Pati', 'patipati', 'pati', 'patipati@mail.pl', 'Kołobrzeg', 'Podstawowe'),
(13, 'Wiktor', 'Slowacki', 'wslowacki', '1234', 'wslowacki@mail.pl', 'Mleczowa 12', 'Podstawowe'),
(14, 'Piotr', 'Zoska', 'pzoska', '1234', 'pzoska@mail.po', 'Warszawska 7', 'Podstawowe'),
(15, 'Anna', 'Jolie', 'ajolie', '1234', 'ajolie@mail.pl', 'Górczewska 13', 'Wyższe'),
(16, 'Jan', 'Wawelski', 'Smoku', 'smok', 'smokwawelski@mail.pl', 'Zamkowa 6', 'Podstawowe'),
(17, 'Marcin', 'Wrona', 'wrona', '1234', 'wrona@ptaki.pl', 'Jaskółcza 9', 'Wyższe'),
(18, 'Waclaw', 'Fajny', 'wajny', '1234', 'wfajny@gmail.pl', 'Leśna 55', 'Podstawowe'),
(19, 'Jan', 'Konieczny', 'jkonieczny', '1234', 'kon@gmail.pl', 'Konmcowa 77', 'Podstawowe'),
(20, 'Maria', 'Hopi', 'mhopi', '1234', 'hopi@gmail.pl', 'Wesoła 99', 'Średnie'),
(21, 'Fiona', 'Shrek', 'fiona', '1234', 'fiona@gmail.pl', 'Dworkowa 16', 'Podstawowe'),
(22, 'Janusz', 'Grazyniak', 'janusz', '1234', 'januszgrazyniak@gmail.pl', 'Mazowiecka 30', 'Podstawowe'),
(24, 'Michal', 'Cwiek', 'mcwiek', '1234', 'cwieczek@gamial.pl', 'Marszalkowska 44', 'Średnie'),
(25, 'Dominika', 'Machon', 'dommach', 'qwerty', 'machon@gmail.pl', 'Machoniowa 8', 'Średnie'),
(26, 'Ewelina', 'Marciniak', 'Emarciniak', '1234', 'emar@gmail.pl', 'Nowy Świat 1', 'Średnie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zainteresowania`
--

CREATE TABLE `zainteresowania` (
  `id` int(11) NOT NULL,
  `nazwa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zainteresowania`
--

INSERT INTO `zainteresowania` (`id`, `nazwa`) VALUES
(1, 'Polityka'),
(2, 'Podróże'),
(3, 'Ekonomia'),
(4, 'Science Fiction'),
(5, 'Psychologia'),
(6, 'Ksiazki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zain_uz`
--

CREATE TABLE `zain_uz` (
  `id` int(11) NOT NULL,
  `id_uz` int(11) NOT NULL,
  `id_zain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zain_uz`
--

INSERT INTO `zain_uz` (`id`, `id_uz`, `id_zain`) VALUES
(1, 23, 1),
(2, 23, 3),
(3, 23, 5),
(4, 24, 2),
(5, 24, 3),
(6, 24, 5),
(7, 25, 1),
(8, 25, 2),
(9, 25, 4),
(10, 25, 5),
(11, 1, 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zainteresowania`
--
ALTER TABLE `zainteresowania`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zain_uz`
--
ALTER TABLE `zain_uz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `zainteresowania`
--
ALTER TABLE `zainteresowania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `zain_uz`
--
ALTER TABLE `zain_uz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
