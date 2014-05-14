-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 14 2014 г., 17:49
-- Версия сервера: 5.5.25
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `w1_vsport`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kfkis_adz`
--

CREATE TABLE IF NOT EXISTS `kfkis_adz` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `lead` varchar(255) NOT NULL,
  `place` varchar(255) DEFAULT 'г. Волжский',
  `date_start` datetime DEFAULT NULL,
  `flags` enum('TOP','HIDDEN') DEFAULT NULL,
  `type` enum('ADVERTISEMENT','EVENT','CONTEST') DEFAULT 'ADVERTISEMENT',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `kfkis_adz`
--

INSERT INTO `kfkis_adz` (`id`, `title`, `lead`, `place`, `date_start`, `flags`, `type`) VALUES
(1, 'Юбилей АМУ ФКС &laquo;Волжанин&raquo;', 'В программе фестиваля: показательные выступления воспитанников учреждения, а так же, награждение тренеров и спортсменов «Волжанина». Приглашаются все желающие. Вход свободный.', 'ул. Набережная 6, КФП &laquo;Волга&raquo;, 11:00', '2014-05-14 00:00:00', NULL, 'ADVERTISEMENT'),
(2, 'День здоровья — 2014', '12 мая в 11:00 в спорткомплексе «Молодость» состоится спортивный праздник! Приглашаются первокурсники, преподаватели и все желающие! Приходите за победой!', 'спорткомлпекс «Молодость», 11:00', '2014-05-15 00:00:00', NULL, 'ADVERTISEMENT');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
