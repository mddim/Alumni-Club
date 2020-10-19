-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 окт 2020 в 15:55
-- Версия на сървъра: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumniclubdb`
--

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE `comments` (
  `event_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `user` varchar(20) NOT NULL,
  `FN` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `comments`
--

INSERT INTO `comments` (`event_id`, `comment`, `user`, `FN`, `date`) VALUES
(7, 'HI', 'Daria Karticheva', 0, '2020-02-11 02:30:59'),
(7, 'Bye', 'Daria Karticheva', 81507, '2020-02-11 02:31:57'),
(2, 'Hi', 'Daria Karticheva', 81507, '2020-02-11 02:33:35'),
(7, 'OK', 'Maria Dimitrova', 81536, '2020-02-11 12:15:49'),
(8, 'Hi', 'Maria Dimitrova', 81536, '2020-02-11 17:03:55'),
(8, 'hi', 'Maria Dimitrova', 81536, '2020-02-11 17:06:20'),
(8, 'ne', 'Maria Dimitrova', 81536, '2020-02-11 17:11:28'),
(2, 'kak', 'Maria Dimitrova', 81536, '2020-02-11 17:13:14'),
(7, 'Zdraweeeeeeeeeite!', 'Yuliana Ganchevska', 81519, '2020-02-11 22:26:50'),
(2, 'Здравейте, приятели! Ще се забавляваме ли?', 'Yuliana Ganchevska', 81519, '2020-02-12 14:03:23'),
(6, 'Прекрасна вечер!', 'Yuliana Ganchevska', 81519, '2020-02-12 14:04:50'),
(7, 'Здравей!', 'Maria Dimitrova', 81536, '2020-02-12 18:16:54'),
(7, 'Искам да спя!!', 'Daria Karticheva', 81507, '2020-02-12 23:33:00'),
(8, 'Очаквам го с нетърпение :)', 'Yuliana Ganchevska', 81519, '2020-02-13 11:48:28'),
(8, 'Zdrawej', 'Maria Dimitrova', 81536, '2020-02-13 14:09:05'),
(4, 'kkdkdssd', 'Daria Karticheva', 81507, '2020-03-28 20:17:57'),
(5, 'hi', 'Maria Dimitrova', 81536, '2020-10-19 16:26:19'),
(1, 'aaaa', 'Maria Dimitrova', 81536, '2020-10-19 16:32:38');

-- --------------------------------------------------------

--
-- Структура на таблица `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start-time` time NOT NULL,
  `end-time` time NOT NULL,
  `name` varchar(99) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `type` varchar(99) NOT NULL,
  `status` varchar(10) NOT NULL,
  `going` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `events`
--

INSERT INTO `events` (`id`, `date`, `start-time`, `end-time`, `name`, `description`, `type`, `status`, `going`) VALUES
(1, '2020-02-20', '15:00:00', '17:00:00', 'Board games', 'StudyHub Bulgaria\r\nulitsa \"Akademik Zhak Natan\", Sofia', 'meeting', 'ended', 0),
(2, '2020-03-20', '18:00:00', '20:00:00', 'Strengthening Business and Trade for Women Entrepreneurs in Africa – Accra, Ghana', 'ulitsa \"Hadzhi Dimitar\", Sofia', 'seminar', 'ended', 3),
(3, '2020-02-28', '20:00:00', '23:00:00', 'Night Out', 'V Bar', 'meeting', 'ended', 0),
(4, '2020-04-01', '17:30:00', '19:00:00', 'Friendly Competition', 'Bay Area Aztecs', 'meeting', 'ended', 1),
(5, '2022-02-10', '10:00:00', '12:00:00', 'Golf Tournament', 'St. Sofia Golf Club & SPA', 'sports event', 'pending', 0),
(6, '2020-02-08', '20:00:00', '22:00:00', 'Night out', 'Magma club', 'meeting', 'ended', 1),
(7, '2022-03-05', '15:00:00', '17:00:00', 'Friendly Competition', 'Who said all alumni events need to be posh affairs? A good, old-fashioned beer pong tournament can ', 'sports event', 'pending', 4),
(8, '2020-03-10', '15:00:00', '17:00:00', 'Cruise', 'A boat cruise is a great option for advancement teams that are near enough to water to pull it off.', 'meeting', 'ended', 2),
(9, '2021-04-09', '18:00:00', '20:00:00', 'Speaking Event With a Famous Alumni', 'What better way to get alumni excited than to give them the opportunity to say “I went to school with Dari, Mimi, Yuli\".', 'seminar', 'pending', 0),
(10, '2020-04-04', '12:00:00', '23:00:00', 'Music Festival', 'Like beer pong, live music can be another great way to help alumni reminisce about their school years. Outdoor music festivals and concerts are typically summertime events, but if you have access to a', 'meeting', 'ended', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `people`
--

CREATE TABLE `people` (
  `FN` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `email` text CHARACTER SET utf8 NOT NULL,
  `GPSCoord` text CHARACTER SET utf8 DEFAULT NULL,
  `TmpGPSCoord` text CHARACTER SET utf8 DEFAULT NULL,
  `TmpGPSCoordTime` text CHARACTER SET utf8 DEFAULT NULL,
  `Sites` text CHARACTER SET utf8 DEFAULT NULL,
  `PhoneNumber` varchar(11) DEFAULT NULL,
  `VisabilityGroup` text CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `people`
--

INSERT INTO `people` (`FN`, `Name`, `email`, `GPSCoord`, `TmpGPSCoord`, `TmpGPSCoordTime`, `Sites`, `PhoneNumber`, `VisabilityGroup`) VALUES
(81507, 'Daria Karticheva', 'dkarticheva@yahoo.com', 'Мъглиж, Стара Загора, 6180, България', 'Кауфланд, 20, Проф.д-р Иван Странски, ж.к. Малинова долина, Студентски, Столична, София-град, 1734, България', '', 'kkkik.com;ig-dari.com;', '+3597788489', 'Колеги от специалността, завършили същата година'),
(81519, 'Yuliana Ganchevska', 'yg@gmail.com', 'Студентски град', '79, Никола Габровски, Гара Пионер, ж.к. Дианабад, Изгрев, Столична, София-град, 1700, България', '', 'fb-ma.com;yuli-ig.com;ln-ma.com', '08888888888', 'Колеги от специалността'),
(81536, 'Maria Dimitrova', 'mariadimitrova231@gmail.com', 'бул. Драган Цанков, ж.к. Яворов, Средец, Столична, София-град, 1160, България', '', '', 'facebook.com/mimdim23;ig-ma.com;', '0654789135', 'Колеги от специалността, завършили същата година'),
(99999, 'Milen Petrov', 'milen.petrov@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`FN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
