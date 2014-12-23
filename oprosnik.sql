-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 21 2014 г., 02:39
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `oprosnik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text_answer` varchar(256) NOT NULL,
  `position_answ` tinyint(3) unsigned NOT NULL,
  `select_count` int(10) unsigned NOT NULL,
  `id_question` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `text_answer`, `position_answ`, `select_count`, `id_question`) VALUES
(52, 'хера 1<br>', 0, 2, 24),
(53, 'нихера', 1, 2, 24),
(54, 'вовсе нихера<br>', 2, 3, 24),
(56, 'ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh', 0, 0, 26),
(57, '<font size="7">test1</font>', 0, 0, 27),
(58, '<font size="7">test2</font>', 1, 0, 27),
(59, '<font size="7">sdf</font>', 2, 0, 27),
(60, '<font size="7">sadf</font>', 3, 0, 27),
(64, '<div style="text-align: right;"><span style="font-size: x-large; line-height: 1;"><u><b>1</b></u></span></div>', 0, 0, 29),
(65, '<div style="text-align: right;"><span style="font-size: x-large; line-height: 1;"><u><b>2</b></u></span></div>', 1, 0, 29),
(66, '<div style="text-align: right;"><span style="font-size: x-large; line-height: 1;"><u><b>3</b></u></span></div>', 2, 0, 29),
(67, 'ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh', 0, 0, 30),
(68, 'ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh', 0, 0, 31),
(73, 'ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh', 0, 0, 28),
(74, '<font size="3">ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh</font>', 0, 1, 32),
(75, '<font size="5">hvcbvmn</font>', 4, 0, 27),
(76, 'ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh', 0, 1, 33),
(77, '<font size="3">kjulgkuyjk</font>', 1, 1, 32),
(78, '<font size="5">нихуя<br></font>', 0, 1, 34),
(79, '<font size="5">хуя</font>', 1, 4, 34),
(80, '<font size="5">ыфвавыафваваыф</font>', 2, 1, 34),
(81, 'ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh', 0, 0, 35),
(82, 'ANSWER FOR THIS QUESTION  hjkhkjhkjhkhjk jhjhkhkjh hjkhkjh', 0, 1, 36);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_survey` int(10) unsigned NOT NULL,
  `text_quest` varchar(256) NOT NULL,
  `position_num` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_survey` (`id_survey`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `id_survey`, `text_quest`, `position_num`) VALUES
(24, 185, '\n								Что ты блядь хочешь узнать<br>', 0),
(26, 187, '', 0),
(27, 188, '\n								<b><font size="6">TEST</font></b>', 0),
(28, 189, '\n								What features would you like to see here for Special Events?\n							', 0),
(29, 190, '<font size="7">\n								0\n							</font>', 0),
(30, 191, '\n								What features would you like to see here for Special Events?\n							', 0),
(31, 192, '\n								What features would you like to see here for Special Events?\n							', 0),
(32, 193, '<font size="6">bnchgjbhfkkghfjtyf</font>\n								', 0),
(33, 194, '\n								What features would you like to see here for Special Events?\n							', 0),
(34, 197, '<font size="6">что блядь ты&nbsp; хочешь нах<br></font>\n								', 0),
(35, 195, '\n								What features would you like to see here for Special Events?\n							', 0),
(36, 199, '\n								What features would you like to see here for Special Events?\n							', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `surveys`
--

CREATE TABLE IF NOT EXISTS `surveys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(512) NOT NULL,
  `type_of_select` tinyint(4) NOT NULL,
  `size_but` tinyint(3) unsigned NOT NULL,
  `back_color` varchar(20) NOT NULL,
  `layout` tinyint(3) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=241 ;

--
-- Дамп данных таблицы `surveys`
--

INSERT INTO `surveys` (`id`, `user_id`, `name`, `type_of_select`, `size_but`, `back_color`, `layout`, `active`) VALUES
(185, 1, 'adm1', 0, 1, 'rgb(255, 255, 255)', 0, 1),
(187, 1, '123', 0, 0, '', 0, 1),
(188, 1, 'testM', 0, 1, 'rgb(255, 204, 153)', 0, 1),
(189, 3, 'мой первый опрос', 0, 2, '', 0, 1),
(190, 3, 'фыв', 0, 0, '', 0, 1),
(191, 3, 'аыпвы', 0, 0, '', 0, 1),
(192, 3, '', 0, 0, '', 0, 1),
(193, 1, 'фываывфа', 0, 3, 'rgb(128, 0, 0)', 0, 1),
(194, 1, 'dsf', 0, 2, 'rgb(128, 0, 0)', 0, 1),
(195, 1, 'SDFFFFFF', 0, 1, '', 0, 1),
(196, 1, 'SDFFFFFF', 0, 0, '', 0, 0),
(197, 1, '1111', 1, 2, 'rgb(255, 255, 153)', 0, 1),
(198, 1, 'checkbox', 1, 0, '', 0, 0),
(199, 1, 'checkbox', 1, 2, '', 0, 1),
(200, 1, 'checkbox', 1, 0, '', 0, 0),
(201, 1, 'Drop-down menu', 2, 0, '', 0, 0),
(202, 1, 'deop-down', 2, 0, '', 0, 0),
(203, 1, 'deop-down', 2, 0, '', 0, 0),
(204, 1, 'deop-down', 2, 0, '', 0, 0),
(205, 1, 'deop-down', 2, 0, '', 0, 0),
(206, 1, 'deop-down', 2, 0, '', 0, 0),
(207, 1, 'deop-down', 2, 0, '', 0, 0),
(208, 1, 'deop-down', 2, 0, '', 0, 0),
(209, 1, 'deop-down', 2, 0, '', 0, 0),
(210, 1, 'deop-down', 2, 0, '', 0, 0),
(211, 1, '', 2, 0, '', 0, 0),
(212, 1, '', 2, 0, '', 0, 0),
(213, 1, '', 2, 0, '', 0, 0),
(214, 1, '', 2, 0, '', 0, 0),
(215, 1, '', 2, 0, '', 0, 0),
(216, 1, '', 2, 0, '', 0, 0),
(217, 1, '', 2, 0, '', 0, 0),
(218, 1, '', 2, 0, '', 0, 0),
(219, 1, '', 2, 0, '', 0, 0),
(220, 1, '', 2, 0, '', 0, 0),
(221, 1, '', 2, 0, '', 0, 0),
(222, 1, '', 2, 0, '', 0, 0),
(223, 1, '', 2, 0, '', 0, 0),
(224, 1, '', 2, 0, '', 0, 0),
(225, 1, '', 2, 0, '', 0, 0),
(226, 1, '', 2, 0, '', 0, 0),
(227, 1, '', 2, 0, '', 0, 0),
(228, 1, '', 2, 0, '', 0, 0),
(229, 1, '', 2, 0, '', 0, 0),
(230, 1, '', 2, 0, '', 0, 0),
(231, 1, '123', 2, 0, '', 0, 0),
(232, 1, '123', 2, 0, '', 0, 0),
(233, 1, '123', 2, 0, '', 0, 0),
(234, 1, '', 2, 0, '', 0, 0),
(235, 1, '', 2, 0, '', 0, 0),
(236, 1, '', 2, 0, '', 0, 0),
(237, 1, '', 2, 0, '', 0, 0),
(238, 1, '', 2, 0, '', 0, 0),
(239, 1, '', 2, 0, '', 0, 0),
(240, 1, '', 2, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(258) NOT NULL,
  `thank_page` varchar(1024) NOT NULL,
  `thank_back_color` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `thank_page`, `thank_back_color`, `active`) VALUES
(1, 'admin', 'admin', 'Admin', '<div align="left"><font color="#ffffff" size="6">Чтобы вы все сдохли фкавы пуыап укп ппваыпавы а павып вап ваып ваып впваып ваып ваып ваып авып ваып ваып ваып авып ваыпаы апа пвы пваып ваып вап пы авпы вп ваып вапвапвы авы авп вап ваып ваып ваып ваып вап ваып ваып ваып ваып ывап выап ывапвыап ваып ваып вап пваып ваып ваып ваып выаап ваып вп ваып ывап ывап ваып выап авып а ывп ывап авп ваып а в а авып паывп авы ав ывап ваы авып авы ппыпапыа авп па авп а ап па авп ва а аавы авп аыв ппав выпвп&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; вапваып авып вап вап&nbsp; ывпа&nbsp; ыпа ывапы вап ваып ывапвыа п ваыпывп пывп ап выап ваып ваыпы вап выпвы ваып ваып авып ваып<br></font></div>', 'rgb(51, 51, 51)', 1),
(3, 'adm', 'otex', 'Adm', '', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
