-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Трв 06 2015 р., 16:04
-- Версія сервера: 5.5.43-0ubuntu0.14.04.1
-- Версія PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `vyo_bonuscards`
--

-- --------------------------------------------------------

--
-- Структура таблиці `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Сурогатний ключ',
  `series` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Серія карти',
  `number` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Номер карти',
  `issuance_date` datetime NOT NULL COMMENT 'Дата випуску',
  `expiration_date` datetime NOT NULL COMMENT 'Дата закінчення активності',
  `use_date` datetime NOT NULL COMMENT 'Дата використання',
  `amount` decimal(12,2) NOT NULL COMMENT 'Сума',
  `status_id` int(11) NOT NULL COMMENT 'ID статусу',
  `del_sign` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Бонусна карта' AUTO_INCREMENT=15 ;

--
-- ЗВ'ЯЗКИ ТАБЛИЦІ `card`:
--   `status_id`
--       `status` -> `id`
--

--
-- Дамп даних таблиці `card`
--

INSERT INTO `card` (`id`, `series`, `number`, `issuance_date`, `expiration_date`, `use_date`, `amount`, `status_id`, `del_sign`) VALUES
(1, 'AA', '5847124599', '2015-05-05 09:28:00', '2015-06-05 09:28:00', '0000-00-00 00:00:00', 121.50, 1, 0),
(2, 'AB', '8527419632', '2015-05-03 11:18:00', '2015-06-03 11:18:00', '2015-05-04 12:21:00', 256.75, 2, 0),
(7, 'AS', '4775782655', '2015-05-06 15:54:12', '2015-06-06 15:54:12', '0000-00-00 00:00:00', 0.00, 2, 0),
(8, 'AS', '3225344880', '2015-05-06 15:54:12', '2015-06-06 15:54:12', '0000-00-00 00:00:00', 0.00, 1, 0),
(9, 'AS', '7824969709', '2015-05-06 15:54:12', '2015-06-06 15:54:12', '0000-00-00 00:00:00', 0.00, 1, 0),
(10, 'AS', '2560048304', '2015-05-06 15:54:12', '2015-06-06 15:54:12', '0000-00-00 00:00:00', 0.00, 1, 1),
(11, 'AS', '9461996484', '2015-05-06 15:54:12', '2015-06-06 15:54:12', '0000-00-00 00:00:00', 0.00, 1, 0),
(12, 'CC', '6592026070', '2015-05-06 15:55:41', '2016-05-06 15:55:41', '0000-00-00 00:00:00', 0.00, 1, 0),
(13, 'CC', '1749901365', '2015-05-06 15:55:41', '2016-05-06 15:55:41', '0000-00-00 00:00:00', 0.00, 2, 0),
(14, 'CC', '4935831274', '2015-05-06 15:55:41', '2016-05-06 15:55:41', '0000-00-00 00:00:00', 0.00, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `card_history`
--

CREATE TABLE IF NOT EXISTS `card_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Сурогатний ключ',
  `card_id` int(11) NOT NULL COMMENT 'ID карти',
  `amount` decimal(12,2) NOT NULL COMMENT 'Сума покупки',
  `goods_id` int(11) NOT NULL COMMENT 'ID товару',
  `history_date` datetime NOT NULL COMMENT 'Дата придбання',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Історія покупок по карті' AUTO_INCREMENT=3 ;

--
-- ЗВ'ЯЗКИ ТАБЛИЦІ `card_history`:
--   `card_id`
--       `card` -> `id`
--   `goods_id`
--       `goods` -> `id`
--

--
-- Дамп даних таблиці `card_history`
--

INSERT INTO `card_history` (`id`, `card_id`, `amount`, `goods_id`, `history_date`) VALUES
(1, 2, 12.55, 1, '0000-00-00 00:00:00'),
(2, 2, 22.35, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблиці `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Сурогатний ключ',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Назва товару',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Товари' AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `goods`
--

INSERT INTO `goods` (`id`, `name`) VALUES
(1, 'Яблука'),
(2, 'Груші'),
(3, 'Абрикоси');

-- --------------------------------------------------------

--
-- Структура таблиці `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Сурогатний ключ',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Назва статусу',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Статуси карти' AUTO_INCREMENT=5 ;

--
-- Дамп даних таблиці `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'активна'),
(2, 'не активна'),
(3, 'вийшов термін дії'),
(4, 'резервний статус');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
