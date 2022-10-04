-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Ned 11. zář 2022, 18:56
-- Verze serveru: 8.0.17
-- Verze PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `praha`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `goods`
--

CREATE TABLE `goods` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `goods`
--

INSERT INTO `goods` (`id`, `name`) VALUES
(1, 'товар 1'),
(2, 'товар 2'),
(3, 'товар 3'),
(4, 'товар 4'),
(5, 'товар 5'),
(6, 'товар 6'),
(7, 'товар 7'),
(8, 'товар 8'),
(9, 'товар 9'),
(10, 'товар 10');

-- --------------------------------------------------------

--
-- Struktura tabulky `money_interval`
--

CREATE TABLE `money_interval` (
  `min` int(255) NOT NULL,
  `max` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `points_interval`
--

CREATE TABLE `points_interval` (
  `min` int(255) NOT NULL,
  `max` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `prize_types`
--

CREATE TABLE `prize_types` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `prize_types`
--

INSERT INTO `prize_types` (`id`, `name`) VALUES
(1, 'предмет'),
(2, 'деньги'),
(3, 'баллы');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'user1'),
(2, 'admin1');

-- --------------------------------------------------------

--
-- Struktura tabulky `user_points`
--

CREATE TABLE `user_points` (
  `user_id` int(255) NOT NULL,
  `points` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `user_points`
--

INSERT INTO `user_points` (`user_id`, `points`) VALUES
(1, 227);

-- --------------------------------------------------------

--
-- Struktura tabulky `user_prize`
--

CREATE TABLE `user_prize` (
  `prize_id` int(255) UNSIGNED NOT NULL,
  `user_id` int(255) UNSIGNED NOT NULL,
  `prize_type` int(255) UNSIGNED NOT NULL,
  `prize_number` int(255) UNSIGNED NOT NULL,
  `prize_sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku `user_prize`
--

INSERT INTO `user_prize` (`prize_id`, `user_id`, `prize_type`, `prize_number`, `prize_sent`) VALUES
(1, 1, 3, 30, 0),
(2, 1, 1, 1, 0),
(3, 1, 1, 0, 0),
(4, 1, 1, 7, 0),
(5, 1, 1, 5, 0),
(6, 1, 2, 34, 0),
(7, 1, 3, 99, 0),
(8, 1, 1, 8, 0),
(9, 1, 1, 2, 0),
(10, 1, 1, 1, 0),
(11, 1, 1, 7, 0),
(12, 1, 1, 2, 0),
(13, 1, 1, 1, 0),
(14, 1, 1, 9, 0),
(15, 1, 1, 3, 0),
(16, 1, 1, 4, 0),
(17, 1, 2, 50, 0),
(18, 1, 3, 0, 0),
(19, 1, 3, 50, 0),
(20, 1, 3, 48, 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `prize_types`
--
ALTER TABLE `prize_types`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `user_points`
--
ALTER TABLE `user_points`
  ADD PRIMARY KEY (`user_id`);

--
-- Klíče pro tabulku `user_prize`
--
ALTER TABLE `user_prize`
  ADD PRIMARY KEY (`prize_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku `prize_types`
--
ALTER TABLE `prize_types`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `user_prize`
--
ALTER TABLE `user_prize`
  MODIFY `prize_id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
