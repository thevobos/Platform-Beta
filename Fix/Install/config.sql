-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 07 Nis 2021, 01:59:28
-- Sunucu sürümü: 10.3.28-MariaDB
-- PHP Sürümü: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `denemes`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `authorities`
--

CREATE TABLE `authorities` (
  `id` int(11) NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `siteCode` varchar(60) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `user_type` varchar(24) NOT NULL DEFAULT 'user',
  `user_permissions` text DEFAULT NULL,
  `site_limit` int(24) DEFAULT 0,
  `status` set('active','passive') NOT NULL,
  `ip` varchar(20) NOT NULL,
  `lastLogin` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `authorities`
--

INSERT INTO `authorities` (`id`, `uuid`, `siteCode`, `name`, `surname`, `email`, `password`, `phone`, `user_type`, `user_permissions`, `site_limit`, `status`, `ip`, `lastLogin`, `time`) VALUES
(82, '651-2580-4844-5320', '527-9237-2216-5378', 'DEMO', 'DEMO', 'demo@demo.com', '123', '0', 'root', '[]', 0, 'active', '95.10.160.151', 1617775167, 1617731288);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `crud`
--

CREATE TABLE `crud` (
  `id` int(11) NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `siteCode` varchar(60) NOT NULL,
  `menuCategory` varchar(60) NOT NULL,
  `label` varchar(60) NOT NULL,
  `components` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `slug` set('active','passive') NOT NULL,
  `slugComponent` varchar(20) NOT NULL,
  `listing` int(20) DEFAULT 0,
  `operation` set('multiple','single') DEFAULT 'multiple',
  `language` varchar(10) NOT NULL DEFAULT 'tr',
  `ip` varchar(20) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `crud_contents`
--

CREATE TABLE `crud_contents` (
  `id` int(11) NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `contentCode` varchar(60) DEFAULT 'passive',
  `crudCode` varchar(60) DEFAULT NULL,
  `siteCode` varchar(60) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `language` varchar(10) DEFAULT 'passive',
  `category` varchar(40) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `siteCode` varchar(60) NOT NULL,
  `label` varchar(100) NOT NULL,
  `language` varchar(10) NOT NULL DEFAULT 'tr',
  `ip` varchar(20) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `uuid`, `siteCode`, `label`, `language`, `ip`, `time`) VALUES
(1, '9768-9833-5357-6032', '527-9237-2216-5378', 'Demo', 'en', '95.10.160.151', 1617733277),
(2, '1447-2991-1712-3244', '527-9237-2216-5378', 'Products', 'en', '176.88.23.13', 1617773878);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `parent` varchar(60) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `siteCode` varchar(60) DEFAULT NULL,
  `menuCategory` varchar(60) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `language` varchar(10) NOT NULL DEFAULT 'tr',
  `ip` varchar(20) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `menu_items`
--

INSERT INTO `menu_items` (`id`, `uuid`, `parent`, `sort`, `siteCode`, `menuCategory`, `label`, `link`, `cover`, `language`, `ip`, `time`) VALUES
(1, '7376-5927-2520-1632', '0', 1, '527-9237-2216-5378', '9768-9833-5357-6032', 'Home', 'home', NULL, 'en', '95.10.160.151', 1617733284),
(2, '4890-5597-6587-5988', '0', 2, '527-9237-2216-5378', '9768-9833-5357-6032', 'Blog', 'blog', NULL, 'en', '95.10.160.151', 1617733290),
(3, '1794-9765-7067-5178', '0', 6, '527-9237-2216-5378', '9768-9833-5357-6032', 'About us', 'about-us', NULL, 'en', '95.10.160.151', 1617733309),
(4, '5930-3478-2140-7181', '0', 7, '527-9237-2216-5378', '9768-9833-5357-6032', 'Contact', 'contact', NULL, 'en', '95.10.160.151', 1617733314),
(5, '1257-4263-6375-2648', '4890-5597-6587-5988', 3, '527-9237-2216-5378', '9768-9833-5357-6032', 'Technology', 'technology', NULL, 'en', '95.10.160.151', 1617733320),
(6, '2556-7626-3506-6458', '4890-5597-6587-5988', 4, '527-9237-2216-5378', '9768-9833-5357-6032', 'Social Network', 'social-network', NULL, 'en', '95.10.160.151', 1617733330),
(7, '8233-4754-9727-3777', '4890-5597-6587-5988', 5, '527-9237-2216-5378', '9768-9833-5357-6032', 'Life Style', 'life-style', NULL, 'en', '95.10.160.151', 1617733352);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `siteCode` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `authorized` text NOT NULL,
  `ip` varchar(24) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `manager` varchar(60) DEFAULT NULL,
  `domain` varchar(40) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  `logo` varchar(60) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `plugins` varchar(255) NOT NULL DEFAULT '[]',
  `install` set('active','passive') DEFAULT 'passive',
  `record_limit` int(24) DEFAULT 0,
  `ip` varchar(20) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sites`
--

INSERT INTO `sites` (`id`, `uuid`, `manager`, `domain`, `title`, `logo`, `author`, `plugins`, `install`, `record_limit`, `ip`, `time`) VALUES
(9, '527-9237-2216-5378', '651-2580-4844-5320', 'demo.demo', 'DEMO DEMO', 'logo.svg', 'DEMO DEMO', '[]', 'passive', 0, '0.0.0.0', 1584567046);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tmpstorage`
--

CREATE TABLE `tmpstorage` (
  `id` int(11) NOT NULL,
  `siteCode` varchar(60) NOT NULL,
  `v_key` varchar(60) NOT NULL,
  `v_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `uuid` varchar(60) NOT NULL,
  `siteCode` varchar(60) NOT NULL,
  `is_write` set('active','passive') NOT NULL,
  `is_read` set('active','passive') NOT NULL,
  `is_update` set('active','passive') NOT NULL,
  `is_delete` set('active','passive') NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(24) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `authorities`
--
ALTER TABLE `authorities`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siteCode` (`siteCode`),
  ADD KEY `uuid` (`uuid`),
  ADD KEY `uuid_2` (`uuid`,`siteCode`);

--
-- Tablo için indeksler `crud_contents`
--
ALTER TABLE `crud_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crudCode` (`crudCode`,`siteCode`),
  ADD KEY `uuid` (`uuid`,`siteCode`),
  ADD KEY `uuid_2` (`uuid`,`siteCode`,`language`);

--
-- Tablo için indeksler `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tmpstorage`
--
ALTER TABLE `tmpstorage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siteCode` (`siteCode`,`v_key`);

--
-- Tablo için indeksler `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `authorities`
--
ALTER TABLE `authorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Tablo için AUTO_INCREMENT değeri `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Tablo için AUTO_INCREMENT değeri `crud_contents`
--
ALTER TABLE `crud_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `tmpstorage`
--
ALTER TABLE `tmpstorage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;