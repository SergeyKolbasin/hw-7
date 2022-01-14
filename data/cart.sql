-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 14 2022 г., 10:45
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `jetsaus`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` smallint(5) DEFAULT NULL COMMENT 'id покупки',
  `id_product` smallint(5) NOT NULL COMMENT 'id товара',
  `id_user` smallint(5) NOT NULL COMMENT 'id пользователя',
  `quantity` smallint(5) NOT NULL COMMENT 'количество товара',
  `last_action` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Корзина покупателя';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
