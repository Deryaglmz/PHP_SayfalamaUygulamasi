-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 23 Haz 2024, 09:57:52
-- Sunucu sürümü: 8.3.0
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `urun`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `id` int UNSIGNED NOT NULL,
  `urunadi` varchar(255) NOT NULL,
  `urunfiyati` double NOT NULL,
  `parabirimi` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`id`, `urunadi`, `urunfiyati`, `parabirimi`) VALUES
(1, 'Samsung S8+', 4500, 'TL'),
(2, 'Philips LCD TV', 5000, 'TL'),
(3, 'Logitech M171 Mouse', 300, 'USD'),
(4, 'MSİ Monitör', 2100, 'TL'),
(5, 'HP P1102 Yazıcı', 280, 'TL'),
(6, 'HP Pro 4115', 322, 'TL'),
(7, 'Razor Klavye', 44, 'EUR'),
(8, 'Seagate 8TB HDD', 1980, 'TL'),
(9, 'WD 4TB Black SDD', 1230, 'TL'),
(10, 'Coolermaster Kasa', 4500, 'TL'),
(11, 'Philips Kulaklık', 300, 'USD'),
(12, 'Casper Notebook', 19000, 'TL'),
(13, 'Seiko Saat', 840, 'TL'),
(14, 'Apple Macebook ', 5600, 'TL');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `urun`
--
ALTER TABLE `urun`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
