-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 May 2014, 16:16:23
-- Sunucu sürümü: 5.6.16
-- PHP Sürümü: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `ecoman_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `components`
--

CREATE TABLE IF NOT EXISTS `components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `components`
--

INSERT INTO `components` (`id`, `name`) VALUES
(1, 'test'),
(2, 'component name');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `flows`
--

CREATE TABLE IF NOT EXISTS `flows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `ei` varchar(50) NOT NULL,
  `cost` int(50) NOT NULL,
  `amount` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `flows`
--

INSERT INTO `flows` (`id`, `name`, `ei`, `cost`, `amount`) VALUES
(1, 'flow', 'impact', 1213, 1231);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `quantity`, `unit`, `description`) VALUES
(1, 'name', 'type', 11, 'unit', 'product description'),
(2, 'test', 'product type test', 23, 'unit of product test', 'Lorem ipsum dolor sit amet...'),
(3, 'name', 'type', 123, 'unit', 'product description'),
(4, 'test', 'test', 123, 'test', 'test'),
(5, 'product', 'type', 12333, 'unit', 'description'),
(6, 'koko', 'kokok', 444, 'lpolplop', 'olplopol');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
