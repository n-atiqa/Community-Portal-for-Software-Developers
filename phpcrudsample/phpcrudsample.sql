-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2018 at 10:32 AM
-- Server version: 5.6.36-log
-- PHP Version: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpcrudsample`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procSaveUser`(IN `i_id` INT, IN `i_firstname` VARCHAR(50), IN `i_lastname` VARCHAR(50), IN `i_email` VARCHAR(50), IN `i_companyname` VARCHAR(50), IN `i_country` VARCHAR(50), IN `i_city` VARCHAR(50), IN `i_password` TEXT, IN `i_creation_time` DATETIME, IN `i_role` VARCHAR(10), IN `i_account` VARCHAR(20))
BEGIN
    if(i_id=0) then
      insert into tb_user(firstname,lastname,email,companyname,country,city,password, account_creation_time, role, account) values(i_firstname,i_lastname,i_email,i_companyname,i_country,i_city,i_password, i_creation_time, i_role, i_account);
    Else
                 update tb_user set firstname=i_firstname,lastname=i_lastname,email=i_email,companyname=i_companyname,country=i_country,city=i_city,password=i_password,role=i_role,account=i_account where id=i_id;
    end if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_feedback`
--

CREATE TABLE IF NOT EXISTS `tb_feedback` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comments` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tb_feedback`
--

INSERT INTO `tb_feedback` (`id`, `firstname`, `lastname`, `email`, `comments`) VALUES
(1, 'ttdwdwd', 'yydwdwd', 'wong@hotmail.com', 'fjkmb hiun kj;no;'),
(2, 'wew', 'frgg', 'W@hotmail.com', 'defeff'),
(3, 'efefd', 'efrfr4f', 'wong@hotmail.com', 'efervrv'),
(4, 'wong', 'lee', 'ww@hotmail.com', 'complain about ...'),
(6, 'wong', 'lee', 'ww@hotmail.com', 'complain about ...'),
(7, 'Atiqa', 'Azhar', 'shirokuma.93@gmail.com', 'Feedback'),
(8, '', '', '', ''),
(9, 'Atiqa', 'Azhar', 'shirokuma.93@gmail.com', 'feedback'),
(10, 'Atiqa', 'Azhar', 'shirokuma0219@hotmail.com', 'test'),
(11, '', '', '', ''),
(12, 'John', 'Smith', 'johnsmith@website', 'Account deactivated'),
(13, 'Mary', 'Jane', 'maryjane@website.com', ''),
(14, 'Mary', 'jane', 'maryjane@website.com', ''),
(15, 'Johnny', 'Mathews', 'dondon@website.com', 'Hello, testing to see if my comments can be seen'),
(16, 'Mary', 'Kate', 'marykate@website.com', 'This is my feedback');

-- --------------------------------------------------------

--
-- Table structure for table `tb_job`
--

CREATE TABLE IF NOT EXISTS `tb_job` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_title` varchar(40) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `details` varchar(500) NOT NULL,
  `userid` int(11) NOT NULL,
  `posted_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_job`
--

INSERT INTO `tb_job` (`job_id`, `position_title`, `company_name`, `country`, `details`, `userid`, `posted_on`) VALUES
(2, 'Web Development Intern', 'cowjumpsOverMOON', 'Thailand', 'We are looking for interns who are interested in wanting to be a professional web developer!', 4, '2018-01-27 04:15:10'),
(3, 'Full Stack web Developer', 'Google', 'USA', 'Want to be a part of Google? We are hiring!', 7, '2018-01-27 12:16:12'),
(4, 'Back End Programming', 'The Back End', 'Taiwan', 'Do you want to gain experience as a professional back end programmer? Apply Now!!', 20, '2018-01-27 16:34:27'),
(5, 'Back end programming on ROR', 'Novocall', 'Singapore', 'Looking for interns that are knowledgeable on Ruby on Rails. Apply as soon as possible', 26, '2018-02-03 03:40:18'),
(6, 'Game Programmer', 'Nintendo', 'Japan', 'A new job opportunity for anyone interested working in the industry', 25, '2018-02-03 18:47:26'),
(7, 'Tester', 'Testers', 'Finland', 'Just testing codes', 27, '2018-02-03 21:58:10'),
(8, 'Java Programmer', 'JPU', 'Japan', 'Looking for  a Java Programmer', 28, '2018-02-05 11:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jobapply`
--

CREATE TABLE IF NOT EXISTS `tb_jobapply` (
  `jobapply_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(500) NOT NULL,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`jobapply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_jobapply`
--

INSERT INTO `tb_jobapply` (`jobapply_id`, `firstname`, `lastname`, `email`, `message`, `job_id`) VALUES
(1, 'Atiqa', 'Azhar', 'shirokuma0219@hotmail.com', 'Test', 3),
(2, 'Atiqa', 'Azhar', 'shirokuma0219@hotmail.com', 'ygygiuh', 2),
(3, 'John', 'Scott', 'lucido@email.com', 'Applying', 4),
(4, 'Mary', 'jane', 'maryjane@website.com', 'Hello. I am interested in applying for the job at Google. Do contact me ', 2),
(5, 'Sam', 'Smith', 'samsmith@website.com', 'I am interested', 2),
(6, 'Ikeda', 'Hidefumi', 'spyair@website.com', 'Just applying for fun', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_message`
--

CREATE TABLE IF NOT EXISTS `tb_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `time_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tb_message`
--

INSERT INTO `tb_message` (`message_id`, `from_id`, `to_id`, `subject`, `content`, `time_sent`) VALUES
(1, 25, 6, 'Test', 'Test', '2018-01-29 06:16:43'),
(2, 6, 23, 'sddfg', 'ghf', '2018-01-29 07:37:28'),
(3, 6, 23, 'Installing pyodbc and ODBC Driver', 'Testing if message can be sent', '2018-01-30 06:31:10'),
(4, 6, 23, 'Installing pyodbc and ODBC Driver', 'Test for message', '2018-01-30 06:33:17'),
(5, 6, 4, '', '', '2018-01-30 06:34:49'),
(6, 6, 25, 'To another user', 'Sending to another user', '2018-01-30 08:04:53'),
(7, 6, 7, 'to myself', 'myself', '2018-01-30 09:32:58'),
(8, 6, 7, 'To another user', 'Test Sending message to another user', '2018-01-30 09:34:23'),
(9, 6, 20, 'New Member', '', '2018-02-01 09:22:41'),
(10, 6, 25, 'New Member', 'Hello', '2018-02-01 09:23:56'),
(11, 26, 23, 'Test', 'Testing message', '2018-02-02 19:30:59'),
(12, 25, 20, 'test', 'testets', '2018-02-03 09:26:14'),
(13, 6, 3, 'kuhjk', 'kkjj', '2018-02-03 12:36:01'),
(14, 6, 7, 'Hi', 'sdfhiosrg', '2018-02-03 12:36:22'),
(15, 6, 6, 'sg', 'fgghgj', '2018-02-03 12:37:35'),
(16, 6, 6, 'jhj', 'hjhkj', '2018-02-03 12:43:40'),
(17, 6, 6, 'dsfdfg', 'fhgfh', '2018-02-03 12:45:16'),
(18, 27, 4, 'fdsfsd', 'gfgdgf', '2018-02-03 14:07:13'),
(19, 27, 26, 'Hello Mary', 'How are you?', '2018-02-03 14:08:13'),
(20, 27, 27, 'hhello', 'hello', '2018-02-03 14:11:53'),
(21, 28, 25, 'Hello', 'Hello Kyary, how are you doing?', '2018-02-05 03:58:47'),
(22, 25, 25, 'Message to oneself', 'Message to oneself', '2018-02-05 04:20:14'),
(23, 25, 25, 'helllo', 'hello', '2018-02-05 04:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_replymessage`
--

CREATE TABLE IF NOT EXISTS `tb_replymessage` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `message_id` int(11) NOT NULL,
  `time_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_replymessage`
--

INSERT INTO `tb_replymessage` (`reply_id`, `from_id`, `content`, `message_id`, `time_sent`) VALUES
(1, 6, 'Hello', 1, '2018-01-29 12:53:59'),
(2, 25, 'Hey Ikeda, I am doing fine', 21, '2018-02-05 04:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_thread`
--

CREATE TABLE IF NOT EXISTS `tb_thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`thread_id`),
  KEY `firstname` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tb_thread`
--

INSERT INTO `tb_thread` (`thread_id`, `title`, `description`, `date_created`, `userid`) VALUES
(1, 'Welcome', 'Welcome Users to the Projects/Questions & Solutions Forum where new ideas and help needed can all be found and discussed here in this forum. \r\nRemember to be nice to one another!', '2018-01-25 04:30:27', 3),
(2, 'Advice needed?', 'I am able to provide help on any programming language. If you have any questions, just type and hit the reply button and I will get back to you as soon as possible', '2018-01-25 07:45:48', 3),
(3, 'Front end project', 'Anyone have any tips to share on how to improve my UI/UX on the current project I am working on?', '2018-01-26 21:28:23', 4),
(4, 'Ruby On Rails', 'I am currently working on a web app platform. Any ideas on how I can make it better?', '2018-01-26 21:46:03', 25),
(5, 'Urgent!! ', 'Guys! I need help!! My assignment is due tonight and all my codes are not working at ALL!!!', '2018-01-26 21:58:14', 25),
(6, 'Best programming language', 'Any programming language that I should learn? I have lots of free time', '2018-01-27 07:44:39', 20),
(7, 'PHP or ROR?', 'Not sure which language I should start learning first...Any ideas? Any advice would be appreciated. Thanks!', '2018-01-27 07:49:26', 25),
(8, 'Ruby on rails project', 'ygugu', '2018-02-03 10:45:12', 25),
(9, 'frgfg', 'dgfhgjhkj', '2018-02-03 10:45:39', 25),
(10, 'Is this working', 'fdfd', '2018-02-03 14:02:40', 27),
(11, 'New Coding project', 'Would like to make a music video about coding', '2018-02-05 03:55:43', 28);

-- --------------------------------------------------------

--
-- Table structure for table `tb_threadmessage`
--

CREATE TABLE IF NOT EXISTS `tb_threadmessage` (
  `respond_id` int(11) NOT NULL AUTO_INCREMENT,
  `respond` varchar(500) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thread_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`respond_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_threadmessage`
--

INSERT INTO `tb_threadmessage` (`respond_id`, `respond`, `posted`, `thread_id`, `userid`) VALUES
(1, 'COOL BANANAS!!', '2018-01-25 07:45:48', 1, 20),
(2, 'This is a cool as forum!', '2018-01-27 06:13:32', 1, 12),
(3, 'We should have a company gathering soon!!', '2018-01-27 06:19:29', 1, 22),
(4, 'Yeah!! We should', '2018-01-27 07:51:12', 1, 23),
(5, 'OH NO!!', '2018-01-28 10:38:42', 5, 6),
(6, 'Hello', '2018-01-28 10:50:42', 2, 6),
(7, 'This is going to be fun', '2018-02-03 05:38:42', 1, 6),
(8, 'Oh it is', '2018-02-03 14:03:14', 10, 27),
(9, 'Nice to meet you all~', '2018-02-05 03:56:16', 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `companyname` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `password` text,
  `account_creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(10) NOT NULL,
  `account` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `firstname`, `lastname`, `email`, `companyname`, `city`, `country`, `password`, `account_creation_time`, `role`, `account`) VALUES
(3, 'Walter', 'wong03', 'wong@hotmail.com', 'Mymm', 'Nanaimo', 'Canada', 'Password01', '2017-12-25 14:30:08', 'admin', 'deactivate'),
(4, 'Philip', 'kok', 'philip@hotmail.com', 'Vinder', 'Atins', 'Brazil', 'Password01', '2018-01-04 17:23:50', 'user', 'active'),
(6, 'Atiqa', 'Azhar', 'shirokuma0219@hotmail.com', 'Novocall', 'Singapore', 'Singapore', '$2y$10$ojy.H.edxp8U1nXH6kvpVuguaa9ApYnyMm7QyPQhJfKFRgg3/Lv/C', '2018-01-05 12:50:28', 'admin', 'active'),
(7, 'Taemin', 'Park', 'testing@website.com', 'Meezzy', 'Cijengkol', 'Indonesia', 'Vg4wp8EP', '2018-01-06 00:58:13', 'user', 'active'),
(12, 'Eqa', 'Azhar', 'shirokuma.93@gmail.com', 'Paper company', 'Hamilton', 'New Zealand', '$2y$10$REgxv5yDpNVi6dWfqrfMyuxapnMiK00U2MykWOEbQ0vQH9bItO5fu', '2018-01-06 03:56:27', 'user', 'active'),
(20, 'Scott', 'White', 'scottwhite@website.com', 'web', 'Random8', 'Denmark', '$2y$10$FhjusXS4wbmSN0z/q3jwJeU5qO4Mp0H9.KT.QVbfGuEuuT8BcN5wW', '2018-01-07 06:36:52', 'user', 'active'),
(22, 'Toby', 'Moby', 'moby@website.com', 'Mobster', 'New York', 'America', '$2y$10$wAsizNn/GLLhU1iT2eiLEeGRjXmdI79nRWrPQugdXnEumIZ1tdAba', '2018-01-11 13:29:17', 'user', 'active'),
(23, 'Luke', 'Skywalker', 'star@wars.com', 'Disney', 'Alabama', 'USA', '$2y$10$P2iyLnqEvPNFEpkDaoRTOu8/WyoEZeB5EzfznSKm6w3vUY8uHIdze', '2018-01-13 08:10:16', 'user', 'active'),
(24, 'Michael', 'Scott', 'office@website.com', 'Dunder Mifflin', 'Pennsylvania', 'USA', '$2y$10$o.J3GtAAYZcGO8EOmrUin.YrcV832iGlFqUAKgmJWDg2qBlq.ycdG', '2018-01-14 08:11:16', 'user', 'active'),
(25, 'Kyary', 'Pamyu Pamyu', 'butter@pretz.com', 'Pretz', 'Hokkaido', 'Japan', '$2y$10$DsIVaLum1B4TSpng5KaX.uH8bis.XMtHm0qtO1jjAvLgBWwrmpDTm', '2018-01-17 05:20:00', 'user', 'active'),
(26, 'Mary', 'Jane', 'maryjane@website.com', 'Anzac', 'Auckland', 'New Zealand', '$2y$10$GMMFoA8t9pHWuF1ssHgTfeErqMCM2.ff7Kqz6Cm5AspW52foh0H9m', '2018-02-02 19:24:20', 'user', 'deactivate'),
(27, 'Sam', 'Smith', 'samsmith@website.com', 'Unemployed', 'London', 'England', '$2y$10$3U6bt9zlhlIqHgKYZZRaXuGcSJa4oiASoa.Dc2ZmO7yXjMdPhd1T.', '2018-02-03 13:46:01', 'user', 'active'),
(28, 'Ikeda', 'Hidefumi', 'spyair@website.com', 'JPU', 'Nagoya', 'Japan', '$2y$10$bNkD.16zl/jcIi25K7SwAODdam8Qwp/JnzCZBYKe4X4uBsDS/SggW', '2018-02-05 03:53:09', 'user', 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
