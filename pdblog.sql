-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2014 at 08:50 PM
-- Server version: 5.5.34
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pdblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `pd_articles`
--

CREATE TABLE IF NOT EXISTS `pd_articles` (
  `ART_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ART_TITLE` int(11) NOT NULL,
  `ART_USER` int(11) NOT NULL,
  `ART_CREATE_DATE` datetime NOT NULL,
  `ART_PUBLISHED` datetime NOT NULL,
  `ART_PUBLISH_DATE` datetime NOT NULL,
  `ART_UNPUBLISH_DATE` datetime NOT NULL,
  `ART_ACCESS` int(11) NOT NULL,
  `ART_CONTENT` longtext NOT NULL,
  PRIMARY KEY (`ART_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pd_categories`
--

CREATE TABLE IF NOT EXISTS `pd_categories` (
  `CAT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CAT_PARENT` int(11) NOT NULL,
  `CAT_NAME` varchar(100) NOT NULL,
  `CAT_DESC` text NOT NULL,
  `CAT_ACCESS` int(11) NOT NULL,
  PRIMARY KEY (`CAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pd_salt`
--

CREATE TABLE IF NOT EXISTS `pd_salt` (
  `SALT_USER` int(11) NOT NULL,
  `SALT_KEY` varchar(45) NOT NULL,
  PRIMARY KEY (`SALT_USER`,`SALT_KEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pd_tags`
--

CREATE TABLE IF NOT EXISTS `pd_tags` (
  `TAG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TAG_CONTENT` varchar(200) NOT NULL,
  PRIMARY KEY (`TAG_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `pd_tags_article`
--

CREATE TABLE IF NOT EXISTS `pd_tags_article` (
  `TA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TA_ARTICLE` int(11) NOT NULL,
  `TA_TAG` int(11) NOT NULL,
  PRIMARY KEY (`TA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `pd_users`
--

CREATE TABLE IF NOT EXISTS `pd_users` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_USERNAME` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(150) NOT NULL,
  `USER_EMAIL` varchar(150) NOT NULL,
  `USER_FIRST` int(11) NOT NULL,
  `USER_LAST` int(11) NOT NULL,
  `USER_BIO` text NOT NULL,
  `USER_DOB` date NOT NULL,
  `USER_JOINED` datetime NOT NULL,
  `USER_LAST_IP` varchar(30) NOT NULL,
  `USER_ACTIVE` int(11) NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `pd_user_info`
--

CREATE TABLE IF NOT EXISTS `pd_user_info` (
  `INF_ID` int(11) NOT NULL AUTO_INCREMENT,
  `INF_KEY` varchar(150) NOT NULL,
  `INF_VALUE` varchar(1000) NOT NULL,
  PRIMARY KEY (`INF_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
