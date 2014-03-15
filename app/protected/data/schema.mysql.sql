-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 15 2014 г., 12:05
-- Версия сервера: 5.5.28
-- Версия PHP: 5.5.9-1+sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `ontico`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Likes`
--

CREATE TABLE IF NOT EXISTS `Likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `like_id` bigint(20) NOT NULL,
  `liked_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `like_id` (`like_id`),
  KEY `liked_id` (`liked_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=102 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_bin NOT NULL,
  `grade` tinyint(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5001 ;

--
-- Триггеры `Students`
--
DROP TRIGGER IF EXISTS `delete_student`;
DELIMITER //
CREATE TRIGGER `delete_student` BEFORE DELETE ON `Students`
 FOR EACH ROW BEGIN
  DELETE FROM Likes WHERE like_id=OLD.id;
  DELETE FROM Likes WHERE liked_id=OLD.id;
END
//
DELIMITER ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Likes`
--
ALTER TABLE `Likes`
  ADD CONSTRAINT `Likes_ibfk_3` FOREIGN KEY (`liked_id`) REFERENCES `Students` (`id`),
  ADD CONSTRAINT `Likes_ibfk_1` FOREIGN KEY (`like_id`) REFERENCES `Students` (`id`),
  ADD CONSTRAINT `Likes_ibfk_2` FOREIGN KEY (`liked_id`) REFERENCES `Students` (`id`);
