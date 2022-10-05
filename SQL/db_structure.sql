-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Úte 04. říj 2022, 02:38
-- Verze serveru: 8.0.17
-- Verze PHP: 7.3.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: praha
--
CREATE DATABASE IF NOT EXISTS praha DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE praha;

-- --------------------------------------------------------

--
-- Struktura tabulky bank_acc
--

CREATE TABLE bank_acc (
  id int(11) NOT NULL,
  pred_acc varchar(11) NOT NULL,
  acc_num varchar(11) NOT NULL,
  bank_kod varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='наш банковский счет.';

-- --------------------------------------------------------

--
-- Struktura tabulky goods
--

CREATE TABLE goods (
  id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  g_limit int(10) UNSIGNED NOT NULL COMMENT 'лимит товаров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku goods
--

INSERT INTO goods (id, `name`, g_limit) VALUES
(1, 'подарок 1', 10),
(2, 'подарок 2', 10),
(3, 'подарок 3', 10),
(4, 'подарок 4', 10),
(5, 'подарок 5', 10),
(6, 'подарок 6', 10),
(7, 'подарок 7', 10),
(8, 'подарок 8', 10),
(9, 'подарок 9', 10),
(10, 'подарок 10', 10);

-- --------------------------------------------------------

--
-- Struktura tabulky money_interval
--

CREATE TABLE money_interval (
  id int(11) NOT NULL COMMENT 'единственная строка в таблице',
  min int(255) NOT NULL,
  max int(255) NOT NULL,
  m_limit int(10) UNSIGNED NOT NULL COMMENT 'лимит денег'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku money_interval
--

INSERT INTO money_interval (id, `min`, `max`, m_limit) VALUES
(1, 1, 100, 1000);

-- --------------------------------------------------------

--
-- Struktura tabulky points_interval
--

CREATE TABLE points_interval (
  id int(11) UNSIGNED NOT NULL,
  min int(255) NOT NULL,
  max int(255) NOT NULL,
  m_coef int(11) NOT NULL COMMENT 'коэфициент обмена на деньги',
  g_coef int(11) NOT NULL COMMENT 'not used'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku points_interval
--

INSERT INTO points_interval (id, `min`, `max`, m_coef, g_coef) VALUES
(1, 1, 100, 10, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky prize_types
--

CREATE TABLE prize_types (
  id int(255) UNSIGNED NOT NULL,
  name varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vypisuji data pro tabulku prize_types
--

INSERT INTO prize_types (id, `name`) VALUES
(1, 'предмет'),
(2, 'деньги'),
(3, 'баллы');

-- --------------------------------------------------------

--
-- Struktura tabulky users
--

CREATE TABLE users (
  user_id int(255) NOT NULL,
  user_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  email varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  full_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  user_acc varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  password varchar(255) NOT NULL,
  admin tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky user_points
--

CREATE TABLE user_points (
  user_id int(255) NOT NULL,
  points int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky user_prize
--

CREATE TABLE user_prize (
  prize_id int(255) UNSIGNED NOT NULL,
  user_id int(255) UNSIGNED NOT NULL,
  prize_type int(255) UNSIGNED NOT NULL,
  prize_number int(255) UNSIGNED NOT NULL,
  prize_sent tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku bank_acc
--
ALTER TABLE bank_acc
  ADD PRIMARY KEY (id);

--
-- Klíče pro tabulku goods
--
ALTER TABLE goods
  ADD PRIMARY KEY (id);

--
-- Klíče pro tabulku money_interval
--
ALTER TABLE money_interval
  ADD PRIMARY KEY (id);

--
-- Klíče pro tabulku points_interval
--
ALTER TABLE points_interval
  ADD PRIMARY KEY (id) USING BTREE;

--
-- Klíče pro tabulku prize_types
--
ALTER TABLE prize_types
  ADD PRIMARY KEY (id);

--
-- Klíče pro tabulku users
--
ALTER TABLE users
  ADD PRIMARY KEY (user_id);

--
-- Klíče pro tabulku user_points
--
ALTER TABLE user_points
  ADD PRIMARY KEY (user_id);

--
-- Klíče pro tabulku user_prize
--
ALTER TABLE user_prize
  ADD PRIMARY KEY (prize_id);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku bank_acc
--
ALTER TABLE bank_acc
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku goods
--
ALTER TABLE goods
  MODIFY id int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pro tabulku money_interval
--
ALTER TABLE money_interval
  MODIFY id int(11) NOT NULL AUTO_INCREMENT COMMENT 'единственная строка в таблице', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku points_interval
--
ALTER TABLE points_interval
  MODIFY id int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku prize_types
--
ALTER TABLE prize_types
  MODIFY id int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku users
--
ALTER TABLE users
  MODIFY user_id int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku user_prize
--
ALTER TABLE user_prize
  MODIFY prize_id int(255) UNSIGNED NOT NULL AUTO_INCREMENT;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
