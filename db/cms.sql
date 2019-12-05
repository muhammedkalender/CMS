-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 05 Ara 2019, 14:27:29
-- Sunucu sürümü: 5.7.26
-- PHP Sürümü: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cms`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `announcement_message` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `announcement_language` int(11) NOT NULL DEFAULT '1',
  `announcement_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `announcement_created_by` int(11) NOT NULL DEFAULT '0',
  `announcement_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `announcement_updated_by` int(11) NOT NULL DEFAULT '0',
  `announcement_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`announcement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `announcement_title`, `announcement_message`, `announcement_language`, `announcement_created_at`, `announcement_created_by`, `announcement_updated_at`, `announcement_updated_by`, `announcement_active`) VALUES
(1, 'başlık2', 'mesaj2', 1, '2019-11-30 00:00:00', 15, '2019-12-05 01:12:36', 33, 0),
(2, 'başlık', 'mesaj', 2, '2019-11-30 00:00:00', 17, '2019-12-05 01:12:07', 33, 0),
(3, 'başlık3', 'mesaj3', 1, '2019-11-30 00:00:00', 14, '2019-11-30 00:00:00', 14, 0),
(4, 'başlık', 'mesaj', 1, '2019-12-05 13:27:56', 33, '2019-12-05 13:27:56', 0, 1),
(5, 'Test', 'Mesaj', 1, '2019-12-05 14:04:20', 33, '2019-12-05 14:04:20', 0, 1),
(6, 'West2', 'Side3', 1, '2019-12-05 14:05:40', 33, '2019-12-05 14:05:40', 33, 1),
(7, 'East', 'Side\r\n\r\n\r\n', 1, '2019-12-05 14:08:06', 33, '2019-12-05 14:08:06', 0, 1),
(8, 'asdsa', 'asdasdasd', 1, '2019-12-05 14:12:04', 33, '2019-12-05 14:12:04', 0, 1),
(9, 'asdsa', 'asdasdasd', 1, '2019-12-05 14:12:08', 33, '2019-12-05 14:12:08', 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `language_codes`
--

DROP TABLE IF EXISTS `language_codes`;
CREATE TABLE IF NOT EXISTS `language_codes` (
  `language_code_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code_key` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `language_code_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`language_code_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `language_codes`
--

INSERT INTO `language_codes` (`language_code_id`, `language_code_key`, `language_code_is_active`) VALUES
(1, 'globe', 1),
(2, 'en', 1),
(3, 'tr', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_text` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `log_first_param` int(11) NOT NULL DEFAULT '0',
  `log_second_param` int(11) NOT NULL DEFAULT '0',
  `log_third_param` int(11) NOT NULL DEFAULT '0',
  `log_param_text_first` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_param_text_second` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_param_text_third` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_param_text_fourt` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_id_for_text` int(11) NOT NULL DEFAULT '0',
  `log_created_by` int(11) NOT NULL DEFAULT '0',
  `log_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_updated_by` int(11) NOT NULL DEFAULT '0',
  `log_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `logs`
--

INSERT INTO `logs` (`log_id`, `log_text`, `log_first_param`, `log_second_param`, `log_third_param`, `log_param_text_first`, `log_param_text_second`, `log_param_text_third`, `log_param_text_fourt`, `log_id_for_text`, `log_created_by`, `log_created_at`, `log_updated_by`, `log_updated_at`, `log_active`) VALUES
(1, 'test@gmail.com Mail adresli Test Name - Surname için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 1),
(2, 'test@gmail.com Mail adresli Test Name - Surname için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(3, '1aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(4, '2aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(5, '4aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(6, '5aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(7, '6aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(8, '7aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(9, '3aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(10, '8aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(11, '9aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(12, '10aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(13, '11aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 1, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(14, '120aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 13, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(15, '13aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 13, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(16, 'log_submission_insert', 14, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(17, 'log_submission_insert', 15, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(18, 'log_submission_insert', 16, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(19, 'log_submission_insert', 17, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(20, '1210aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 17, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(21, '113aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 17, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(22, 'log_submission_insert', 18, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(23, 'log_submission_insert', 19, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(24, 'log_submission_insert', 20, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(25, '13210aaa@gmail.com Mail adresli Ali - Veli için hesap oluşturuldu.', 20, 0, 0, '', '', '', '', 0, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 1),
(26, 'announcement_insert', 80, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(27, 'announcement_insert', 80, 3, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(28, 'announcement_delete', 81, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(29, 'announcement_delete', 81, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(30, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(31, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(32, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(33, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(34, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(35, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(36, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(37, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(38, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(39, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(40, 'announcement_select_success', 84, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(41, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(42, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(43, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(44, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(45, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(46, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(47, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(48, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(49, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(50, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(51, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(52, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(53, 'announcement_select_success', 84, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 00:00:00', 0, '2019-11-30 00:00:00', 1),
(54, 'user_announcement_insert', 90, 1, 7, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 22:58:33', 0, '2019-11-30 22:58:33', 1),
(55, 'user_announcement_delete', 91, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 23:00:05', 0, '2019-11-30 23:00:05', 1),
(56, 'user_announcement_delete', 91, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-11-30 23:00:06', 0, '2019-11-30 23:00:06', 1),
(57, 'user_announcement_message_insert', 100, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-12-01 01:07:11', 0, '2019-12-01 01:07:11', 1),
(58, 'user_announcement_message_insert', 100, 2, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-12-01 01:07:27', 0, '2019-12-01 01:07:27', 1),
(59, 'user_announcement_message_insert', 100, 1, 3, NULL, NULL, NULL, NULL, 0, 14, '2019-12-01 01:14:24', 0, '2019-12-01 01:14:24', 1),
(60, 'user_announcement_message_delete', 101, 1, 0, NULL, NULL, NULL, NULL, 0, 14, '2019-12-01 01:15:03', 0, '2019-12-01 01:15:03', 1),
(61, 'log_submission_insert', 21, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '2019-12-03 20:38:19', 0, '2019-12-03 20:38:19', 1),
(62, 'log_user_insert', 21, 0, 0, 'test@gmail.com', 'ali - veli', '', '', 0, 0, '2019-12-03 20:43:50', 0, '2019-12-03 20:43:50', 1),
(63, 'log_user_insert', 21, 0, 0, 'test@gmail.com', 'ali - veli', '', '', 0, 0, '2019-12-03 20:43:52', 0, '2019-12-03 20:43:52', 1),
(64, 'user_announcement_message_insert', 100, 1, 4, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 09:52:39', 0, '2019-12-05 09:52:39', 1),
(65, 'user_announcement_message_insert', 100, 1, 5, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 09:55:54', 0, '2019-12-05 09:55:54', 1),
(66, 'user_announcement_message_insert', 100, 1, 6, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 09:56:29', 0, '2019-12-05 09:56:29', 1),
(67, 'user_announcement_message_insert', 100, 1, 7, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 09:57:19', 0, '2019-12-05 09:57:19', 1),
(68, 'user_announcement_message_insert', 100, 1, 8, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 09:57:21', 0, '2019-12-05 09:57:21', 1),
(69, 'user_announcement_message_insert', 100, 1, 9, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 10:45:09', 0, '2019-12-05 10:45:09', 1),
(70, 'user_announcement_message_insert', 100, 1, 10, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 10:45:13', 0, '2019-12-05 10:45:13', 1),
(71, 'announcement_insert', 80, 4, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 13:27:56', 0, '2019-12-05 13:27:56', 1),
(72, 'announcement_insert', 80, 5, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 14:04:20', 0, '2019-12-05 14:04:20', 1),
(73, 'announcement_insert', 80, 6, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 14:05:40', 0, '2019-12-05 14:05:40', 1),
(74, 'announcement_insert', 80, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 14:08:06', 0, '2019-12-05 14:08:06', 1),
(75, 'announcement_insert', 80, 8, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 14:12:04', 0, '2019-12-05 14:12:04', 1),
(76, 'announcement_insert', 80, 9, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 14:12:08', 0, '2019-12-05 14:12:08', 1),
(77, 'announcement_update', 86, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:41:22', 0, '2019-12-05 16:41:22', 1),
(78, 'announcement_update', 86, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:41:23', 0, '2019-12-05 16:41:23', 1),
(79, 'announcement_update', 86, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:41:25', 0, '2019-12-05 16:41:25', 1),
(80, 'announcement_update', 86, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:41:26', 0, '2019-12-05 16:41:26', 1),
(81, 'announcement_update', 86, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:41:45', 0, '2019-12-05 16:41:45', 1),
(82, 'announcement_update', 86, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:41:55', 0, '2019-12-05 16:41:55', 1),
(83, 'announcement_update', 86, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:42:21', 0, '2019-12-05 16:42:21', 1),
(84, 'announcement_update', 86, 7, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:42:22', 0, '2019-12-05 16:42:22', 1),
(85, 'announcement_update', 86, 6, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:43:11', 0, '2019-12-05 16:43:11', 1),
(86, 'announcement_delete', 81, 1, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:53:24', 0, '2019-12-05 16:53:24', 1),
(87, 'announcement_delete', 81, 1, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:53:36', 0, '2019-12-05 16:53:36', 1),
(88, 'announcement_delete', 81, 2, 0, NULL, NULL, NULL, NULL, 0, 33, '2019-12-05 16:55:07', 0, '2019-12-05 16:55:07', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mails`
--

DROP TABLE IF EXISTS `mails`;
CREATE TABLE IF NOT EXISTS `mails` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_send_try` int(11) NOT NULL DEFAULT '0',
  `mail_address` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `mail_title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `mail_content` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `mail_user_id` int(11) NOT NULL DEFAULT '0',
  `mail_is_sended` tinyint(1) NOT NULL DEFAULT '0',
  `mail_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail_created_by` int(11) NOT NULL DEFAULT '0',
  `mail_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail_updated_by` int(11) NOT NULL DEFAULT '0',
  `mail_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `mails`
--

INSERT INTO `mails` (`mail_id`, `mail_send_try`, `mail_address`, `mail_title`, `mail_content`, `mail_user_id`, `mail_is_sended`, `mail_created_at`, `mail_created_by`, `mail_updated_at`, `mail_updated_by`, `mail_active`) VALUES
(1, 0, 'aaa@gmail.com', '[mail_title_register]', '[mail_template_register]', 5, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(2, 0, 'aaa@gmail.com', 'ÃœyeliÄŸiniz OluÅŸturuldu', '[mail_template_register]', 6, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(3, 0, 'aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaraları makale oluşturulmuştur.', 7, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(4, 0, 'test@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaraları makale oluşturulmuştur. Şifreniz : [[FIFTH_PARAM]]', 8, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(5, 0, 'test@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaraları makale oluşturulmuştur. Şifreniz : [[FIFTH_PARAM]]', 9, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(6, 0, 'test@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : 37LS57UVpoqjV2Mg', 10, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(7, 0, 'test@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : MNIEHkrxgmf1E0hE', 11, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(8, 0, 'test@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : 5khAKRQSjqVSW4U0', 12, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(9, 0, 'test@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : RxjuJE7mTTibKnHc', 13, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(10, 0, 'test@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : vePuXKUW7uGVoPV9', 14, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(11, 0, 'test@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Test Name Surname, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : 1k9J7HbdbE7iG6ci', 15, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(12, 0, '1aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : RymgdojtwPyqIa30', 16, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(13, 0, '2aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : uoEg7rjT5LNyYmet', 17, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(14, 0, '4aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : sROKw8cYGbH81cTE', 18, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(15, 0, '5aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : uyoSHOEea7eqyMdC', 19, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(16, 0, '6aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : cDAzlmKrid15sHsA', 20, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(17, 0, '7aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : cJTPTWAts0akwqIn', 21, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(18, 0, '3aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : 87AOJOVms2QX5iCd', 22, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(19, 0, '8aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : ftZNjhnwlQzLcLtV', 23, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(20, 0, '9aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : exukQpUaxLyH5s5s', 24, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(21, 0, '10aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : N18APaOHO80thH3B', 25, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(22, 0, '11aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 1 numaralı makale oluşturulmuştur. Şifreniz : 8E0eoiHaPoXNQkiF', 26, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(23, 0, '120aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 13 numaralı makale oluşturulmuştur. Şifreniz : b0m6Wd7CMAa0Bn48', 27, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(24, 0, '13aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 13 numaralı makale oluşturulmuştur. Şifreniz : lZYMzIalwbpTjfk8', 28, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(25, 0, '1210aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 17 numaralı makale oluşturulmuştur. Şifreniz : qjnf6dG68IIAdrii', 29, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(26, 0, '113aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 17 numaralı makale oluşturulmuştur. Şifreniz : UMRteqhI4s7lE7rW', 30, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(27, 0, '13210aaa@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar Ali Veli, 1 Numaraları EC başvurunuza karşın 20 numaralı makale oluşturulmuştur. Şifreniz : UgB7kMJyGRPa0xFy', 31, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(28, 0, 'asdas@gmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar onur yılmaz, 11 Numaraları EC başvurunuza karşın 21 numaralı makale oluşturulmuştur. Şifreniz : s61YUmvfrQHu0Pjb', 32, 0, '2019-12-03 20:38:19', 0, '2019-12-03 20:38:19', 0, 1),
(29, 0, 'muhammedkalender@protonmail.com', 'Üyeliğiniz Oluşturuldu', 'Merhabalar muhammedkalender Kalender, 11 Numaraları EC başvurunuza karşın 21 numaralı makale oluşturulmuştur. Şifreniz : ib4iUyaJghzuFKpw', 33, 0, '2019-12-03 20:38:19', 0, '2019-12-03 20:38:19', 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `submission_ec_id` int(11) NOT NULL,
  `submission_submit_date` date NOT NULL,
  `submission_paper_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `submission_presentation_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `submission_keywords` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `submission_ec_keyprases` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `submission_topics` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `submission_type_of_contribution` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `submission_invoice` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `submission_abstract_paper` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `submission_full_paper` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `submission_amount` int(11) NOT NULL DEFAULT '0',
  `submission_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submission_created_by` int(11) NOT NULL DEFAULT '0',
  `submission_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `submission_updated_by` int(11) NOT NULL DEFAULT '0',
  `submission_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`submission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `submissions`
--

INSERT INTO `submissions` (`submission_id`, `submission_ec_id`, `submission_submit_date`, `submission_paper_title`, `submission_presentation_type`, `submission_keywords`, `submission_ec_keyprases`, `submission_topics`, `submission_type_of_contribution`, `submission_invoice`, `submission_abstract_paper`, `submission_full_paper`, `submission_amount`, `submission_created_at`, `submission_created_by`, `submission_updated_at`, `submission_updated_by`, `submission_active`) VALUES
(1, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(2, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(3, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(4, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(5, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(6, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(7, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(8, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(9, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(10, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(11, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(12, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(13, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(14, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(15, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(16, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(17, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(18, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(19, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(20, 1, '2019-12-30', 'Test', 'Test_PT', '', '', '', 'NASIL KATKI?', NULL, '', '', 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(21, 11, '1111-11-11', 'asdasdasd', 'option 1', '22222222222', '33333333', '4444444444', '45555555555', NULL, '6666666666666', '', 0, '2019-12-03 20:38:19', 0, '2019-12-03 20:38:19', 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `submission_comments`
--

DROP TABLE IF EXISTS `submission_comments`;
CREATE TABLE IF NOT EXISTS `submission_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_submission` int(11) NOT NULL,
  `comment_message` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `comment_status` int(11) NOT NULL DEFAULT '0',
  `comment_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_created_by` int(11) NOT NULL,
  `comment_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_updated_by` int(11) NOT NULL DEFAULT '0',
  `comment_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `submission_comments`
--

INSERT INTO `submission_comments` (`comment_id`, `comment_submission`, `comment_message`, `comment_status`, `comment_created_at`, `comment_created_by`, `comment_updated_at`, `comment_updated_by`, `comment_active`) VALUES
(1, 1, 'TEST MESAJ&quot;', 0, '2019-11-28 00:00:00', 14, '2019-11-28 00:00:00', 0, 1),
(2, 1, 'TEST MESAJ&quot;', 0, '2019-11-28 00:00:00', 14, '2019-11-28 00:00:00', 0, 1),
(3, 1, 'TEST MESAJ&quot;', 0, '2019-11-28 00:00:00', 14, '2019-11-28 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `token_user` int(11) NOT NULL,
  `token_lock` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `token_key` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `token_ip` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `token_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`token_id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `tokens`
--

INSERT INTO `tokens` (`token_id`, `token_user`, `token_lock`, `token_key`, `token_ip`, `token_created_at`, `token_active`) VALUES
(1, 14, 'FkUgggn46noyq26zFkkh4IaoBLAxieOBPtwEkjuyIzfj2mcgXCoUUqtNMJUteipHpi81k5MtHvlgUq11cxQkouKYnUMUeD6UKjuR8uz4VNcYxvBcWSK2TPih76uzoB7b', 'lDHOiWUaZeNLzUfw95yVQuS19dpnag4E8atFXtWCv2YcFOWRUFqsY4EHIFdcpXvwEeJ3pK2DkDkk1ick8fGM8V6TiC2FrjfOll882eAj7nJUNy0YsrSnayMNcRtUhMGk', '::1', '2019-11-24 00:00:00', 0),
(2, 14, '4SVfufYnNztOZyzxGyj3nrmIhsEsmNpaJYQQSYgktd9JNzrZoYcSgZ7Ev5gGLfUBEDnLrJE9hpBOo0bM3NkG3EINwKhnCkNLoFuM1mKsfoHiBGxBaKXczHKXWsAnSGNQ', 'CeEWqFM08yDFDqsyEiMK4AHw8vD8kc0vFtAgUZetcwxMpsh3A7L5GJdJgRbt4LijB9x5hSQoQvuls5ss1fOxallJLSWVNs5UDmcuYiffFsnFgcjRkrpnKgf34YZlayah', '::1', '2019-11-24 00:00:00', 0),
(3, 14, 'fcnNtLGPcea6mTFbvbzvB6oLVTLV1a17jU0DMwRghgOY4wUa09eLDE6MzjPMefnh5knxe1DcDDDwCp6O2mvwhlM7Syp8egYnbSLE5c8y5e7EnsKKUxTgbq4bRiXfLVyW', 'veQOgTc36JMf1bNyUswE352MoOh8evhyr1Zj4OWHg83weQucCsYaH2eMRCzPZrGVHnrXTKPd5ukD9sOkcjW2Rz6nOXquxcnhnpMv4vmRp1LwFzmWvqO0NrNqgW4whPVO', '::1', '2019-11-24 00:00:00', 0),
(4, 14, 'DcQrEvTRjXP3VpvnmfN5wjOFxYB8RyjTjJl1N1qHMv2wn7huZHpGTQjKKCABMBKfhg48EHqr10rg3I3O6kur39upU1N20bqJ3m1h19kHpo232uShoY2MYdTMzvnbuT8A', 'nvDTdrpqM0wIe7efr0DD9Cy63VS0IcEMbW2rQz5cuYQr5relbbWoevpAupvbvBJKZhclEuZCx2hy6ejod21kS6gpplACRJqX3IFofVtvpt98ffZH6MugiL9JuBKRSwu7', '::1', '2019-11-24 00:00:00', 0),
(5, 14, 'Sw3IBjElPZ04Rg9yus92BFU1XFlX545tj1bEIJUcRIej3hbrgaMziqj9bNXgzQrMqULKJrLebtaHAkLRkzpJHT6jDSI7sF8ndpiuFtqueTyXK6mqDjCpWU3jueKkkqb8', 'LzSvBihEePlScMuI1ZOlsvlPl02dlJKvHzUoo1yUHjNLIQwmFonhWQLItPzkBsc0QODFnXWJmBHFJLlR6n0o50M9VuG0RgAui8J2YFayUc5rnoD4XfIE37kStoeStQFm', '::1', '2019-11-24 00:00:00', 0),
(6, 14, 'AtcnMvpjQKBA67iG9yPrv95zP0oiEki3QoJ7BRxZcXvxi708akSXtm8wh4nxCGaZ31qMI2KEH9tMHeGQ9atYpX8c9XMjQDrP92Y7OmMIxhDT93ON8KS2VYq0Ta4ubWM7', 'bz6rXUa4qqHAPS0kziXrPc3oRSc2ffWKVLwtsCraFkrT2pewT5ifxOr7L2vfvMluGkzhTYz2HhBK1ICGNv62Qh6Cv2GFA3NxWTE5ZpiIQH8D7ry0MIuCjWEbMJZrjOaY', '::1', '2019-11-24 00:00:00', 0),
(7, 14, 'bKSi2J7KlurybaZoGtWa7bpPYTYF9QIpI4hdjUm4GRph07yyb2DkOmSajMoYPE1bD8BrSykHJgUsyLENP00l96809F8mlqj30lQc2Rhjc0JmXFZ80teoTgj3ieSWUWyV', '9QWzhpZ3Rz7S0JP0KcQDpRcmwYCCwNIw4WLrfHDGbVthqH0lhtuu49ZfVQ2e6BWDZ564T2fqFQy6EFZVHFM8N7oQJaO95kStXxJPSfrD0J1l28MFEmjiQeix4INcERwO', '::1', '2019-11-24 00:00:00', 0),
(8, 14, 'wz7g815NHHmJk35ncNXElrIaCVR1JeGwzcaMnHX8OjMmpzNKM5LhbzvNqf6aP2k5AnlvV7eTP9gUmWGaC5ZF7YxuJXZ7DLqAbzFy5C5Wrju0GUHB44w82oJdlSeV3S2c', 'gu3ftcOta7P5dw6Inw7n2VmR3pDLy39xUp05q6Vu9Son2PJWjyIVDcIA4Uyi7IvAHqPFHLB0COafhV9astwWovihtH7xwIJvdqcYiLkcTuTrMMlNgFXLmiNCloH3zqY9', '::1', '2019-11-24 00:00:00', 0),
(9, 14, '1KUzRYvR9bd0W1IwyxcXupqXlgLYP12bxlRIMnT1ImSE68QZa5pB0x9T8SX5ayVxIQwQjTikfdSW5waACE1E7hywqon8NCgxxeihDl5DPYHqX8rhF9lQCC576321uOuQ', 'dOpKzgyEC05cSHtiNS73HAjBoVkTGUsdZLFIn9hmcRgzXechCRNKDc6cI8zvR04eguf8bdkw9COd2AJtyoQGXCt19oRByNt8AQ5vZTa81xDg87ATEJd4JJvgrOV3vPQr', '::1', '2019-11-24 00:00:00', 0),
(10, 14, 'h7i0a4OZGXndwY5gTOYXzSdfFeK0lYVAvtdcPsb47ZUoMH0Oo0ydjp8ceMpTR7jrCfRYf3ww570XX97SFSFqxQKF9lWVYeZBxW0eZNcRSimMOVa8ympqdUBa2w9uTxbU', 'jM3o2qjt3nQ5OtelxvlN3Xaq93zbfsADjyyCQ5NbB5Bz0nb9wJfnOuqMH596jnyVZbhnV2Xz8xKF9BphXVK215dpVL1MjQ2LDYZIDaTvKchT2AGxI9M1UI7ud48jC4qr', '::1', '2019-11-24 00:00:00', 0),
(11, 14, 'LNILzXXfXc7TkWzYcNfVSounS9MeygKgh8m9Lb2g9RcLTpqu16sLuDUlrlFBIxy4gXnwIWtEk2xu6bETUiZAr8MQXBe4aInlK2BOzzqSMa7kp1CCDSYaajK6LAoB4xIs', 'xnCSJjh5jolpJOmJHmXL3089Hv1ZEOifotjyPKSKGhti2vJ9VviZZXKh6it57xIgpnCKV0EJFdeih2uV8G78Qw9YTpyuOohzKLxQ0RXZGSbpTs1YCWaFtfk2o1pXakxx', '::1', '2019-11-24 00:00:00', 0),
(12, 14, '2bxm6TjbPdoPrUoPRAexQglTJl1uJxa2oYGPav91osfgCF3smchdMniKygNINkKrPT7HqN8THlHibnahLX2LMNChZDNsp6yTJ3Lb8OPe84sW7GH8Nj322HopGvmNbFkQ', 'qpU8cjMGWpaCNYlyTJESW8kDjBqX0STb7JWAkLsImZvEl5eC9wEl0t5G3xFc4NB6V3dW55qWpGmyyYc9MD7r4JjYR4pGqHedMOECcYoTsKCrs0jofmma4q4WtSxuX9bc', '::1', '2019-11-24 00:00:00', 0),
(13, 14, '42Ek0MOQYuJDfJXGrml2p6xgLswQXd3XA0MDdOaNFN1LW5H3j64ewd96aWDKaw7GBTXOmOg7u33rjOuO4M8vCbtgK8BQBm05ZIrXsYHzWpw82aUA4MlueAOYezXST6bq', 'LyJIWTTgM0vFjuZnbmFOeB8LnTNA6bHfO6a737pTDxFHK5joqnyiIVIBnocgiRhq04NMkcQO4FOCQB84Ok9eJ2jwCykXBqPgEWsXejjJa0fLt2jVMJn4cp4K54oge973', '::1', '2019-11-24 00:00:00', 0),
(14, 14, 'ZXUV42Ln1IsvpyTzAQFyMf9QQq14w0HyqIXXAnlssxjPsnqSuZKy1BgFDjlYWi00gNemPHXN3KSz9KfZnW67AugIdsVwrUJIk1DtGmNr4VkJGnoqYhQrXtdnEFub9td2', 'yWXQ3slzFs0VtV4eQtxwPW5rbq20Y2oniVRDXcNiwr84rVG3FTmhScaOrRpy0iKe3XdE037qwGcnVJse9PPYrgpcInN3d4mzgSA6eYqIXgtU3fsZmZSwPNGfIwT7Dn0A', '::1', '2019-11-24 00:00:00', 0),
(15, 14, 'FALqaBni8BLxZqYuDs6K0MN7BaOup23zGwnky1UVckiqWoH3Ue04Tknzduu4lrk96K7aWfKEwfzRXgcpGDgTIqgXGhIUwr2Z52KMmuk57pg5Qyff6k9zfyq1snQ06kua', 'PeB76iOlbaMYEbb1Q4JMxbHE9CFOO21OE0Ir6coExZsdnzwp4zy1XkhoWhDFO7HOIsg86g2pUceRkyZF5UnUGDrFyEBiBTUbhtYEMPaAEX3yqegX7cHG9LKSvFTGrxat', '::1', '2019-11-28 00:00:00', 0),
(16, 14, '5hiBYEHDZ8jklRaz502PAGJn0lPILqYgVUMTYPi0kIemJWUu9D6I9yM588UOfY41tBZGPqUOeeKIjmsFoGTJnLG5IQFnVJF4Zpjmp8oEM0vXnRmXiFbTfiUOsJHyvRJC', 'p5C5yuuaUDrDgGrxvUcKF3b4DmcpffkcDBz8QXHJHWIhY20YvhROlpP9hVFAOfMgn2kB5wk9LpabydulAVfNYZ10KiJEXIOBtOsUPazoWEbFo4GX4cjoR1XDAvH8Rekv', '::1', '2019-11-28 00:00:00', 0),
(17, 14, 'eTZADPyWMttgk4kpqLtaocVLmRE0WF2fgYiXuATlWTnThiDbcHiNMI7LeTFO48BGRJlWlh5JmlsjaCAJ3GQt3oM4DC55d1vZK4zBECuXc8iRTeJ86POLoHzwBuDEN1br', 'vHt5NZJLhmlAAIwGIM8ZONqS7mZxPxQ1FLKepGu7hJ5tK4EeGv2XOB4T4yAYvmRUjspiX5ytWNGkEAGKzr4e5r9gKX8Xa7DHYdSgpnTWewHHBmUpP1Bl9ynptNFeVj3T', '::1', '2019-11-28 00:00:00', 0),
(18, 14, 'YmXRIUFxp0WXELCqRrdnd3GJRuauImqChdyxmZN51rSEiFF4CLEKbdWFMCEQzpfLqmDUaqR2d2qc0OrMIZewNilHIuEYGytUsfhKgz3BGFcYgHcYVdZ75I5unKKrRX8P', 'zk5Ljo9qvC2dSDe4MCzVp3hNkZ23lfPuqEpx365qEv0Iw1Z6DmKxoN68TMdU04swYzVo62696IZbzaOvP5Rl8pnegwlQoM385aeAfTZjVXnFhcvkKfJwh4kiokd7gmIo', '::1', '2019-11-28 00:00:00', 0),
(19, 14, 'h0UzqDYlFXxutlLGOVT0LYvWpCIIdJuDeQ1gmT3WxouKRtkFhjLn3zO0lM7nO14h4W7n2XLbhtGhyEVzYE5fR7yfE9fg5aVh4zPqXVWoEzDFPW9fIrljj59T0xNm0VoB', '6Vp6kHNtm5g9KKSUcd7RNImUsx3qzNBHQ8kr4QygOOgEC9oyn8VseLF6EkPy9FTMHB2PB7ymxSyzpXySKtrSurnvqpLQ6Ex2rWsYqqsJiYY0W4pSaXRXN6QhB7eIPVBB', '::1', '2019-11-28 00:00:00', 0),
(20, 14, 'QJynG3o9VeBTKf3usF2kdIgp7iLoTLRmhJKM07kgouxeuybXg1AhFWJc56bEnvI522m4oWjC7r4LhqmyExMFlQRRzR5NEFkTLqW1dhPl9WHqC1qiMKZ263v9rJT4HqUF', '4XHnYbOHeST5sfNQ10WQpz4hSxsv9LKrkA3SGgOUBkoBjn3HwWjVqoA0KUohE3YsofJ8jsM5LLzbVwl79o2vPqKve6fqjOJKKOzQWmdMwAQo7uihHyniDAck7NV6qoJ3', '::1', '2019-11-28 00:00:00', 0),
(21, 14, 'rtldn1JJEFCEyZqZaJyPlfswPNI682hSlC2zjBrOOGv35858xrs3BvxoFezl6rldnoUiUh1ZpJxdMFFQMMWhjEnbYx6sF1z8Q0D6QvnzwgHKK7wrHI6zrD8nm5SMMogH', '6xovEejK12FY5lDqhCr3B9WK55SxmRXAolrvKeVsY4sA2oZou0cLHZCz5g1kt2LwYbmJLkieuvYQquHWJDHk7FVveMNugdeOAyKJMaUNvWHmI0TeWAQ7Xmr1GRcsKUyq', '::1', '2019-11-28 00:00:00', 0),
(22, 14, '1B7mALgNCMkWoZnB4NtquHvNajZzawlnHmVWORSSK4MXYAp26KsVfsGiJ800jiUqeogBEwq14fVrbXckyznITGmrykAnvEfZpy31CGDPgCsvJbILuFNZmwp2xEy3YLLS', 'XZuzNGTRWOqP2YhAkgGXzFnVDwE9X7o6lnK4UgZ7yNJ2J2vVB0GIdchbvLdg4UyVukXWfjfQGf4ZyHwpnlHcfLoSqHO0vzuRI9Rrvu3vKyk5163N23201G3V40XVR6t3', '::1', '2019-11-28 00:00:00', 0),
(23, 14, 'r05wMYYU0h6DIrTKuyzyFQFuicvljkizl5ha3yFCdk5fNqDWvyr2UAgl9wWXvE0LyyBjlrQwU6Ck4rHY5PsW5iEwghngGndkpupDCdMNFdWpFHbwEEjBZ4r6YjHYqBfv', 'hYDriQhFxHiMU5qs1bjO2OQ0Df135PVbjgd3fs3g4DO8F45ZyZloDuYfb0A3d4zVxBe7d2gU1QSuRwX8oILYiKJzF7ZxNN0RAvCyDp7fIeGrimXslRoEEZ0JchgIAj5v', '::1', '2019-11-28 00:00:00', 0),
(24, 14, 'tb7uzm3aF8HFGPjK5PFRRrGcQq8TJIfuYd6UtLmIq42axzGJjJ4VclVynABqRsP5k14MPstxCN3FbVsarCOOd1FT6cEoJvgq1w0GC7W6zn7hEzGHHWYUGlECEf6W2gUA', 'Uod50j7Dgyd8xZhagst2Xsz7cVdJMQM9vr7ptbGlzFMVkfK6pTXCOHpbV7WboYnKfcxmNClDjW3gPOkAAB9K9CuySzq5SUzHB3An7nPhmRLV2oxvoiOnWQqykp7ZPw1H', '::1', '2019-11-28 00:00:00', 0),
(25, 14, 'NsG9EEgfSacqqhrvbHZfhvTmQZzpBjHc236tajBMlsQJe2ccw8cZhGYZPIhKuhfHyRWY5T8KIh3l3oqOTEg2OSl8N4XR36kHuasOoyL7f4aXs7t2kLLHubeQN2ixO7ll', 'igoEUxvrZtPTwx87CaXB7cr0STbMPRTlUCBQyHtH6NciSNTcw4b3uye3QoQK6OgKLqVgC3FvdfURlyjk3sJohToFX1tcpb02tjeBNB4LL1PU7pQjGT9jDZD0UtWVqu4w', '::1', '2019-11-28 00:00:00', 0),
(26, 14, 'KZomOZSulSPvBjErgryjdbuzRGvDZegT5SbaX89gKm0bkuzbDccfn7Afql9TeXTMPq0dtevX8jtiT3i8CCZawkg2glkw2edkGISWtM6MKBwyulwceyx6xW6fMv5CsBDt', 'bwqWErMbTkPqAwoeRPKAZJ3B0jUbRBpE9SCpBPpyzlFJQFoMS54HQRhGXYDw1yHFcUOoPIVTv7BBl3Jr05sdR9ucWuDd8MOi4nmvSnxMuDFBsRHrkjBol46FRaE83FxO', '::1', '2019-11-28 00:00:00', 0),
(27, 14, 'kSfx5kN5JHrAN3UO5ID7q1oUFM5ehtNOhqLrk7mCWBo7gvwkwBk9WBnQpg386aSo5uoZNF4epoROtFRwwdJyF8vRdNCd4YMFcZqT4ZyjHKsvLD3h3hoM0VsEZSFOB6LV', 'ePHyI7R5xB7C3butxNzXYLqUX8zsxJJ24TEPQsvc0ojbVFL2UBraqRrljluWMVbQ0dKQ9i64bCUIDmqNCXK8thsp4iw5t2zdlUiXHgiQKc3OSBsbGQmafeyhOQLyWdCr', '::1', '2019-11-28 00:00:00', 0),
(28, 14, 'IyPEhLksa2zLz1S0J1Ld9dzy4yHrZ4ch9s2E9xO7DdRLEc4iPWb95fJC1i6bl3PNyMspyerKACflNoz3zMmcOdaGPOMKMcrSETXl88kHrKMnf1EdBs8efsOEPLp3hR4j', 'pDtfvu1eREO4x4yqt0qUAMhQ823PK3jKvMbBEZuxdSyDWNAnzthYUKBg3WEZeRcLxnscUnL0zmJPvydQxZunlRPlFhfQIAN4x3oLhYk6IrPPkK6Lhz3Agr1qDn7VzyDJ', '::1', '2019-11-28 00:00:00', 0),
(29, 14, 'lbCWNyNveVlHnWh5hUym9NmJOynkEJ0zGZgGGntkxfAoTjHawGW3Pn1ahXiWomL2P9g5XkPgYi0uF525YcUdpvpocUejGFz4dLA8ivV4HoRBvIZXHzZX2nQwdx95ZUNZ', 'tBT62Xxna9sW8U8yTrkm4a9FdEj3mm6bXAVFrFiMGNhzEWppQxxJiOqKPKDFjZRVjATKQTidK78XuijOclmGBWzG31wc4bPFhCh7uBu0Ygkm35qNUi9PegBHeQiT2Bso', '::1', '2019-11-28 00:00:00', 0),
(30, 14, 'rz9itjKU17RHieIHHh8sMUzz8IkKxlvTM1ZsNadMmy8oiDIvdqSPiTESNtGK9gT9UhUQqnIsm0FlJSQESTWLsI1x4gLM2KlSbUR4OrWrCWCYQWCFu196APqY4MGrzSsU', 'Zvs9P95tpZcn4O8UJpVqRIofXZIdxZWgTGOfiSJD3A6E0dhFpSINoTVgaiaup56Alr35OKZZWVxniXa6ULUeaceM8N2U1DouFkwkzB7XHHwj0405swoO4cLgw5MPt9nM', '::1', '2019-11-28 00:00:00', 0),
(31, 14, 'WfwAT6lBKnEh9YMKVpCQaRbdCfh7I9ryyJqoN4rwbdzdQVaYfrDLDBGtzA1PGVNal26xqXIAiZRFn8FOAO3fj4kydI8W8eTA2LgiG2tgUXPqnh51OnYZ5HI4pOalbWH3', 'lnwMaJsvlc6m8Ht7xPwh88Cp2pxTs38Po4cOX5WwJZWBKfD1OtUaPkxpwKGpYcW99sqaUgWveMwZx8QiQyK1LG732rAZQfpLrOVyE3mTXvzTQ4PWOFt5b5VLDG15SOez', '::1', '2019-11-28 00:00:00', 0),
(32, 14, 'o6WOovwnpm8QKVs7D7PMAUjTHhWH86TKd7KqbxW9pFC61roi9kwCJbqOIw0qA9tg52EfitAljrYmbaMuwS9lcXGuN1kkEN3etESQaUGvuVtFv1FKe4tQkKQJmNcNsT4N', 'zlFEKn5cS7ZuPnP96EgPqeIiifSBop22hTNUJOSQJXHl1yxOE3jjLA27RrEJPAlZFe26AYlzPam6VXH7wGccaPrFEHU1rxSwbYJgoVxnjYrbCIqEcNbqWbLXVnO6VSRx', '::1', '2019-11-28 00:00:00', 0),
(33, 14, 'kJ82DSK58Bdy7bY5fZ9LdAAzITjAILFdiJcSj8dutmhMyMeVK2SenzUAvwMFfA75fz7p1eqmQy3n7OjqbFujVkTyIWLR08zcgbdFUFpO0uRuLoay99irCwvnusRegPN6', '2shemIRshF6u4Z5BvQV4W3KJJgeph5tAmLMNAPKyBw8N3SN8WEDYxrXJQc5PKikYpeS2j0xsfYZTixLKR53B2PzNP8QwTK8ctplHl3vvXZm2ffsD96wtVrmdSi8jMToh', '::1', '2019-11-28 00:00:00', 0),
(34, 14, 'auOmL4I0oTGFL277z1opf4urKX0vhN9WOAYSc4PLac1YjaCD8PGe1uR3MhbPBRvV2AEu9vJAAOxttW3tgnJ1cYQkIH6cOZV2gT3vnhr9AZCV5oAc5uoMC7pFN89HZObm', 'fR332XymlIqdboCvlHERg8CWCNXtKWwNVOoP8b7aF89cP6CPTRfaFrH6YOTU3dEGqCyDStolirQKUIn95l9PT5fNa1MFFoo0wK8BBxD7vXhOV9cM6Bry6nYoiadXMrOl', '::1', '2019-11-28 00:00:00', 0),
(35, 14, 'wtLorqepMnri82UehM7IR5OnIwIaA4yFLFBdk7lf807fGTf4R2QTu3QqLtrNUI6OiuoKlmSuDpAf0EI1qNALjhMCl449hSSnnH4aPzo4zkRq0UbxlqqkF9ID3eUaYOrQ', 'mSEXctl9mmFS8GwqmO9AU0qeESpm5shDf04Or13GdBt2tHXy3XLH1MYBnM33MZW2DHYVEwMs0umI7W8F0t0NzojxiKtToodM6Tmywn3UorOD8JF2ST0B0aq8N7ZQATx2', '::1', '2019-11-28 00:00:00', 0),
(36, 14, 'hRvKWvRaordEveu28BTS506Kg30gwQWUtv7IJs57Qo06uKpKDZtPsGKoPTvvuPmcTNO0tLXSVfIkcdg1MsIp2soq50roaS0bg1iJjAQ2uFNt6td3XkwfwgosjhsVe3EH', 'HA0pSrBGnb2isgAnzCO7DqCZGPMZUjsR8WN493jXM24D8nMFUCjSdQQRJTYzO5sifH700oClhEbW9OcujQuHEaJY0caiQW7suCZriKdWTPKGpoORgvu1GwjPYisks2gt', '::1', '2019-11-28 00:00:00', 0),
(37, 14, 'urS0PfVllcG2N5mIur6p1ma7UvkDl651YqG290lvFAzr5B2a2USuGnSoaikVoUt0jo1QArGvGhiRgidaQQU9VMZ70m8UHPt5aeu5UTDeuy8SjBaQUBirZKeVHIrvu8rz', 'MRFXRiuNnholOZmMYGn372F7lURPlrfaoNobSlbr8isjSLaufQzTVCjACSFKkK77r1ErOIV0Wq5DK1y2TIJmajc4RkLSXnfpJw7rlKn0nTvn3mKOJXRFDF34xGTteeRQ', '::1', '2019-11-28 00:00:00', 0),
(38, 14, '4N68b8jWOK4un4YvquoBTDuy68hjqJd7Qe6PqBX87sLkfSOI19ypauO143rlxyXNATLyIATLU7ibr2d8ksVLGAUPXnUlYNCbxCZAbULYtZbf0pBlaZ7rTIbZuUYEte3C', '0Lb8QEUgpzxSpDwUxm9FutzWSqcu2rL935gjARZ0yiMUQQgNW2n8AQk40fZydgBji7YogdDsSdAiba2hGzhYKp2ODvR5VsnUVxCONPP9raI1HMYlKH22j7efgLJXw4BL', '::1', '2019-11-28 00:00:00', 0),
(39, 14, '9vHOB3QAEYDvyhcGI5Tz5egBvBnOLNXoRcQezzubCPG1er9t3xL0RZZqy1x2QlpFEBjld6yhclRj4DiVCzKNFlpq6S7WfubNGXzl7QlVZd1xWbzC2dkUXYKW7hgmfXp8', 'AQIQiHpA28MB8hjQkbOEkNiOXGzeOmi7aTho6YJsK61eydq5hUp0KxARx1CqYOjbVbD8s10IquaB19tBqsD9hmXSlIRDMdkFIA78cF5JWKldpRyP5g91Cdb1kPs6WScX', '::1', '2019-11-28 00:00:00', 0),
(40, 14, 'BepAcLxTbNQAwRCjj0MT3UljwX8JV59PWxuTCz5cRvFrMmzEzX9QkzeLQQz0mmCfqgPGSy5YGoJ2QPfMuvb2UbVjbsr42P5JUD2XNOvX5qgtButjw3IxRnFzeHcqLWDz', 'vqXZTSJHr7x7kOCBWXFh5VXFleYSZajOXEmXzaPV8TGAT0VJ7aAoyS8hYAv3vA0E2DJW2z9Q1JP7MOm0JH2CVCeABx2T9nkMIyMEfQWUmn5aL7dmzJUReQRU0OIHuqfa', '::1', '2019-11-28 00:00:00', 0),
(41, 14, 'Fbn77IY6K5lCiXxwhf3SHEgKHGluuVzhgwBhGXferbQNkVtxUaTRBqMWOzRiibky6eSJ7jH1dzGP5ljCc01Wwkhyc8Njw077onc3XzXunCXNktEeZkDQZKe3O4nlwOgT', 'NkQX0T9ci8xM2gl5r7SWF4EZvqI7NCq8FHmZ7AAQrqmhxGphBBWanFByfUok45L23MicGnd0KU66P133nK2P67OPVFbj6mAWAPWqNiAVvyHaOuxHt899YbjTthwFLjpE', '::1', '2019-11-28 00:00:00', 0),
(42, 14, 'ZzXfFG7Z3qA4lhGcwGryNsiEvwMl88Ny6OXsWZhcrANKpC1VRdAEYdl5FtlxdbSRwSdrAlLai73q7IkEUBekhRmvbIgF4zDNk8xMNoYN6IkE00Z7mTft0UWiSza4RI8U', '1Jjt9VHf5B0OaAeiT5SgHnJ7UEUstV1GehbNEMnQaa5FfEypqfXN5Aa1qdS1Oove2gbtjlPxgoOXCm3fC92W1ua9gF4yOCCpg7sI3RxBvn84cle8EAzx2xnSTcLLB9MR', '::1', '2019-11-28 00:00:00', 0),
(43, 14, '7rnGqKCWIgEorvBiQBcSDCjHbZ7AraCTLqY0GnxQa5e3La3rjnG1t4zkS21MeJPlWk4eDzryr3Ce1t9Fq4QSnrk3asiHjzjkrBVIIyReuKNtcVjOOUCiL9oNvxpNPucU', 'tVy7brSGDCSA7lKAIYbHrOKXVWrLi3yZI7hrReHeDvjT3j5uQFmr3dnppklnQoXCS3WQYshYAoqoT1Us300jE44X3kmxWgFoyfkOlnxVfO43Iew2UIUSbplXZFyBpfNI', '::1', '2019-11-28 00:00:00', 0),
(44, 14, 'C28RWUTlS3kRTJF6HmWyvZMbmAFxNkouQiPbkOilhNsOWKeahK2ExDZPxCBn0N7BuUxCBKb3My3HVsMGBGUq8iEUShc6FiWe4z2XkSnKPqLr1GxMmzLtF9oGXrFGvqw4', 'Bf1iZetYAoPkuwfW9Z9oTkpEGFzALMVUr9F2osHNWD84LXcYBzcoAsieZm6YKF2QbvOnZsUik1YXL82fLBISgZWakJ8zNug17pcAEuz7A6rUts0GWr6tzxzu1gFGUZ5j', '::1', '2019-11-28 00:00:00', 0),
(45, 14, 'JReXq9y3av3t95qxQFlLd2fABVWckUPIhi8axYRVxKp4oiVEMsAUoMXQ3FdmLSGLmukOYC28UkAqhLLuweQCk0eFr9T5rAGU5GElmjxhqH0oHG6VD1G97pZjvOxtReyT', 'cgS5fcPWQqgSmkvq6iTqdTxpYP7dQheQz4Ika3mc4drtqB015nfdVq8CI2z1qJ4JGJlomFjbv5B7kvl05dWviilef84ev7JaedcTyC4AUmWMPVSM7rRlzxI4YVST2o3V', '::1', '2019-11-30 00:00:00', 0),
(46, 14, 's1KjziW07HrP0pfvDJQDOhdvKvSGAO60CsW8Kigg0GTMGD1ZuI83fYOxJC30OelmiEZwYtOFJd1YedjqcnaTXcwnypGBLxXEfSv1gQloXzzucXIR7OmKQwYEoV0K3wy8', 'jvvImzCp9j14DBkWN6Bgy7XbA6hhd4F5zOQCy4ERMbGknXZlhuCd9fmxU6Sbbi97ObZQew75ZcPaFDYRbOYYrgDktaFrVhetPridekEHPCLxPttSYO4KnxUswQ8O7jKH', '::1', '2019-11-30 00:00:00', 0),
(47, 14, 'EB5V2KqDOh6phUy5N6cYW4GET3mHtm01gtyL4LCSHi3oQt3AYXIRgBUElRqDoU2N86XVe53AVfhd07OhXRg8Zw8N1m6gnmatW4YKkj3icsc6OROzG4vq01Em8MIvzAdT', 'ooPSwbBMEkrqdYDwK5jqpDu6WCbMI0YEJWLFB0GioBARXq4DT8oVjhiWT0subgmjUIocn6ylOdh0dJL5Fybp8lOWuLIglH6VO3PKCRyBIXY3MT9ZyWsuYspLHkDTkN7y', '::1', '2019-11-30 00:00:00', 0),
(48, 14, 'zxkOLFtrvXGeu4dLxmJJkj8BeJwOJClfJLrOfjMk2lS1nl6qZbGOZYkGDh89w9O0XSVO5qgL3B7zkSU5LhfyNmcEgoMjn8F41XJaAu0u55kBEPQwHDpVzdqgIyNHSEau', '4rtnT4UHuTUKzGxOFI3yO21Sr4CqeZCTcM6aQMUw3o2V0VDrCpntsNb4R1vMJIQ3Mc646Ybagjv6AfSxHsv8IngtnowM0PONgqEqie9BPh7Io6XaM59VgJn5fo9vWi5Z', '::1', '2019-11-30 00:00:00', 0),
(49, 14, '4dzKzMFEm1CLUR8wH1g2GfIhLjA7H9VOgu96zDPGKLMAF9JsU168VvQc3YLXIYbc77Gwn4At1al9BRp9shiMUxlMJqsrQQgVB3TkTM5NoBRNGRaM7ePVYZqKdb77mpFQ', 'QhqNabGtoxiqoK9KQzAkTxHAfgVEQI3Z3DfqkGZxOWL4tyQ5xcAT8hYrxUEdJo5NxvBMd78H3FDprp3LqVJEOQlivacVeJ6SILwltgaiAaciei0hIzBk4zA0kUl7SYhr', '::1', '2019-11-30 00:00:00', 0),
(50, 14, '5GmgYwb9WHjaAJNl9gt35Y5yetGKx4L3OZF6fRxCltoertR9XwpfSmd2azbds5NLl2CGPUhrQvBPQ8gDUUdTVRdEgokQp8j2PNUd1yifBsEVMQb9u2wEApVdMbNLpoVR', 'nXqup9gcE4TrNbD9J18y670evhGuGApshgup49lFmL6W0ZkH9xk05MIo5QxajGk9XI3rgt3PC8VmrPrZqAuUaio1ubA66IU5pnfnoLz59AWgVV6nAoVL5Or5ZNRNhEES', '::1', '2019-11-30 00:00:00', 0),
(51, 14, 'OL30VPaZBJgb8bZxSDycFaGNh99sHBWy0EQn9mvsJVEy9FyMx6sqJXuuInjwarZ7yTEolk2iifuAZBx4PPqxgjpO1xOStEzNAVmzYP9blenZkrF3upEXgV8glesMbgjC', '4rA7IAYFuc28YwFeKq6GxisDUIIoqaivll7rZkJBRSb1En8woXf5ajM57dcFZ8h88TxZpwhYVFzEPcpz3XYeFJhmbr0r3qM1DobmrfNA8etS4RXc9liHX4p8XGQ9apey', '::1', '2019-11-30 00:00:00', 0),
(52, 14, 'wTQ5QSqXu7sorm8PJHQDlvSjuCTI9osFBuIwKBGI6IQe1UdiDOsrvDPkVunJ1skoTHzJq86XTjaIlkqQT541FpOvgS0NHc7VEmeFitt3K9KVtMPwyYyh3gdgpExHdmFJ', '8ntmLUq8fKlkILUfMCiQvDRnehlmw8idHTeOf0YVuo0qnQMKLgg13f9UDiVDDBgpo07M4KayBhAKFhbiDMqjGpSNgeR4A2zXUUwau4l3x6uNEiH58AtoOxhZeSvEc6i5', '::1', '2019-11-30 00:00:00', 0),
(53, 14, 'LrsTzKbFlsfcgumh7XJHss5cxWFGZj8eD7Xa2TApOy47xtkjYzFo5MqnAcTJgbRyfHJ62voixUdPscTUQzTdaJmuzeKRya2JE5it4he0AOBBFjDiu4g9uErBN9YNAhiS', 'kQsgJZzYkwpa5odQwQB9mhnbFGe8eKDP2bpYu0Gn06txeEEujMtyEPKznbl64De6SAeWFIUKx5Gp5GVzINNi1SRH3nDSrub4yNjxfZKxDfLZ2SzHrLvBBQNhoXWL0d1w', '::1', '2019-11-30 00:00:00', 0),
(54, 14, 'tTBMOPIjNWWALzCpTkMzUcxabkcnVZ7lhNlACqKlGf4iksnlkefqFEMnBo9hM5BP9xBSOzdNaqXpxEXe16SkMt08qe8jasFK8UgYTcb6lHMlR3PLk0r9vOZcAQEVDaOM', 'r0ZboU1aQkjZ2Xkf1b0qZ5Tv3nFJfbl4FTWqz5HJrVFcerBqhBKieVuNTJ7nNYPXjP7yAXrVAOKF5Xrz5EfXAB9pRQGq9binGvKv6tpR7iLqxHPz9dSZmj6SIxWA6wzp', '::1', '2019-11-30 00:00:00', 0),
(55, 14, 'eYx0EG16bQnDk11SOr43w1TYhVDoYhPoZotEoBqOI1gDfrFuXrJBt1roDzeQwn3cSGyWSZVIW7RmMGKhMQXtQC1onAqBRjuJSeMNuxh2h7fZZebjCfuWuGBrcuNdKCvq', 'xSd1uZXCQK8NwPLvgVKeihpWVWcbYTe9Op80TrcE3T4sC3cVFhxSysQRCa4QjyvhLjbM6ISlgp1jPQdDpJI9Qi9z8pZC30qrPTvNV31gC6OXAS3SwYacZqimOHXq8pCv', '::1', '2019-11-30 00:00:00', 0),
(56, 14, 'cmUmmigdkO7w3L0H4DXNJFl1IQ7oZ1XedyVDedrMn6FABEmDJwtY0Pbadv2iYNt0zV6PuYvOAUPsANRsKl55GcrbNzHFHaRUKpmzrwhKmDIsN5s5JsjX5p69ZKORk4a9', '5TvopbkuE5zSQj0SaIvGSillYQWcpsTEhJifAcL6hu8PKnevaHBFsHyBSA2blsjgtCMHYnpMtz8GXFvLnh9vEypXOT2cWrhB6de6k6xH5Ofu8e1GHvXSzdRnIqThJVuV', '::1', '2019-11-30 00:00:00', 0),
(57, 14, 'AuxRpflbgp5RSiX9MffxGKm4q2IuRWrI0e68Im9fzXKFEm1FspnNu5vBifYTcbTmcy8fragHR1HdN3bDrTUuE79BO21FytSYvfWCQMfRrYUAEYpNM32Zte1bKopnOIcB', 'tDMZsNFlbowuR7j7Hi8tQK8q8oltR8dfLgTWTPUzjCcakuBiRjsLdEcOAyS22AM8Vp9ahrJL5oQP4esrm3Ls6AMb3UIo1AAm5uS4JuhHJhLWnlvaAzthbcMDGFOQCi9E', '::1', '2019-11-30 00:00:00', 0),
(58, 14, 'BE4GPcMAK8wYG4tZWmzi55axjSHIcr9eC36JGZZNXOPUSjUMtd0s8WowH9FlSTOBlbOQoETUeaGTobkWiSeCDsNIsC5UqGtejMuDJb2707gTwJcDUIHHIA6TszRsXhnu', 'hecqzTxTkbNz3IMlx8NFQs6LXofNqACQNm5tPMDwf6gCc2Oys97xzBAFvhRy8sNZEU04yqYWzJx1XWhLf7BlTCgzExT5nd7OJXu1kPJjxcAehrwjNPcgW6N1oHkEb2TI', '::1', '2019-11-30 23:00:05', 0),
(59, 14, '0kCyzxgEACblsJgFDNonSecDdmj7jEuQD5FFhtDFF62oXYeYdeJj1N7x258dQay78Lju6TCodFBcuonTAek1k6Cv7LHx8HXCQvXWz4JBl3grW9C2fVc50sp3RHDu68CS', 'JnBk8TOfcWQR2pX3OK8TrVTBMcQfn9vcJLdhJQN1ItmhN1qbocFgoIasTIyfypJf9fNDX8FiMP3I6m3BPC5aHTxdoJfmMByZSH49rUpzPHK4JfOhyKbtezgOgKsdDY2O', '::1', '2019-12-01 00:55:52', 0),
(60, 14, '5neg2QgiLxT5JgE8HkGp6UHaAKHIcUHWzjlkRXeLjKMfKXQSMiGwOtSsxtQyDisU83jJkI2wAnEE9rmX5L7vQZpmG7C8D6lIWDecUAsPhvhrxpfjm9Uk5NMMObdOMzQr', 'ifW1WAd6VgIrb6OHAMepA9iBN7WNrb7bB2fH9cZglqSqI9jZhy5Ii4y6aHwMOVU8C7v3U5alKy5MCM1uwLkJytrN8NmlW4TLgBFxm0BqXU6TPFGtZDDIjyO5D2iV1PfZ', '::1', '2019-12-01 00:55:52', 0),
(61, 14, 'oHDG807iiau1KAznO5cxfX90ttTItjbv0xktjxLbCaMcunkwo732kvEw7DWTrQhdAV3cNt41gDsorTcxRJgM6rUAuDDteesIP2wQUeH7gZjqtDbNsp0lMhxZnv2AGLEV', '6rHJaGzWN3JkUlSCBlka4zeR16IHHKgB4PaGiBX4aTANXAdN9PV2tRCkbOHC6kUeya0sImjuBDr0ChcwGuZOnPhHVYGUluwy3a4tzjzVyqm4qgqxG9Ymiv36KzNOkLcH', '::1', '2019-12-01 00:55:52', 0),
(62, 14, 'q9lI1XfD0uVmy8RuNEK3V3J99bngEmCNsA6SdlJGInZLZ4o0TI3MxB1Z1Jjmsa7kzV7tEcNfnNVljtJZ6TkkEYmx9mkMl6Mlyf7m1cY1Mk4yjn1lnG6NWoaXUOTLui9s', 'RNskV9KXtqiZmVKvcNXHn7a9mNMTPEP2ZxVLtf2wgruOBE9AotUIig08ydZqGbRUN0RYsmITJOSsrncu6173E1jdVK0FIcijUofHoPlbHN1ezVjjmDxFa32Wl9GoFXZs', '::1', '2019-12-01 00:55:52', 0),
(63, 14, '4GKnir8B5qBES6jnqtjUZIMZH5BSGU7jYcBITfHBh8fF1H8X0JjK4tn15YWtKrx1Rq1um6hiWxSjkEhMRCpqRLGAyQWcymOxkTxOxTNs9rmD8LNm8Lv8T1Lk2uU0niBw', 'G9CWH0cM2Ty4garc6eomSmSDHSfk0z5QRQZ1Ijg6jVlexhLOw9G4bxVo4k6jjNqFzqB2IlY29OzG0O5UQ6QVSW8k5xq3xHdZVCSqXga3A6uV9V8PrX1OjOlOs7RrJQOt', '::1', '2019-12-01 00:55:52', 0),
(64, 14, 'VdszUMM2a3zgrjYLjZCCaC4Jfwri79xkyG3P3dnMbKorHVIH39tQ17smk1HomtBfSiqDCbHGqxZJKTD1USBQOzTKVhCvRNDbhQ0H30kPu4agoR0riJmtYpkjHBqPX0oV', 'pFmaLOJyR8bsbExlLsB19UmAHPpuzT73wgIotoinD6BVv08SPS0efxFIoX9ZKcFuCV5GRKveOcdixKKHjPvXCF7Sbaz4tbMlEi0tD1jQgMbJbFS6GJ8y3y13oTh2rLYG', '::1', '2019-12-01 01:03:17', 0),
(65, 14, 'TjW8M6FU9Qe7DSGhbAoXtzDIEUopGKlSC3E0p7RYkUMR9e3JrkFmHquMIykx58oxhD2o6YOmvGiT7dIb9Xsr0t0fECR1aPeYi1wsm7wIzZYkqlHsDDo4Jj85ceZQalnj', 'BXPER90nGF7bhpuEypoWy8qMSywPlSm60jTkhrVRCCht1A2SPnsRHIhWbHCH2vZN6LkHVXHjTB6nZWINb9spri073cfzrOTOTaGF50fFa46MwsmCQKyC6I03nUoRfEcV', '::1', '2019-12-01 01:03:17', 0),
(66, 14, 'cTFJgCM7wvmhurt3MMiShVpfsiOVFyAoxG0Tx3HVxSBpNANk23hBfdIUfgRxZLZ8TEI5rgG312AE9phclqYXtJvGvIIpC6jIWXVoitRED4Tosmq7MCsLJB6U3lrBsw9A', 'UMzFKRfcYEtR2pekXy1pVxdno72V5hoQpjKOXO7Wfk6cA4rVKctaLAdg38y0vUBuqUtPNY0zIq4alTpWU7LZg3xaHExRUqMsbaQTmRD2W1LDcSS1M9kIXLFeBGwRKnLo', '::1', '2019-12-01 01:03:17', 0),
(67, 14, 'Fcw1ulpLK53d8Ue0yFoX8kXg4qnQpVMMRJ1AJ6WY5C3ENBk4E2laZ5vXIw7paMN892aKL2MZDQVlvSqaKM5jAdSAJPUA5hpVbGwXIRsdPkOVoihx9BoAmZ8a9BT43YJQ', '1pISDEbVtsY2WdMTHdU4tHK6IdNz1KZvpY0hHUXUXA7KZURCzhw2aboclfpffZqjKgOvIdJbxYxqvYd3lsEItLXDMBKURvIZjolgq7ndwGmFl7ap4ZDxS6m5043HhtPY', '::1', '2019-12-01 01:03:18', 0),
(68, 14, '1LTiBA52aQpFTGQS7SFWekYTJiy6T8xewhgosmgqGoiAwfXqaZ3dd8l0aSPX0UaDxuWcQojmmw9fqxZ19BRhmHZx7s2Yd5qvTdl49NocsDeYqllLVjS8KZDm9b4oyie4', 'ccZp6yxz3bGmfuNqzLC5NLRMpMldp6si1qVixZ7HFlPImq9OFsXdpMVOstkU799FEhqRu29i6uvngaCtH1QiEN7VoC9UrQ2dv4ivnpETs9xnlPOyuwzUrTcVArXjACMX', '::1', '2019-12-01 01:03:22', 0),
(69, 14, 'gXtBcncLRbFCPe34P8mhsbbOu7D3RRPGmKbStDP8IkuejC6wveepx6chpWXHAsFGV171jklB0koFXEaIJXnOSHxO2rleDckT8do8C7E7gmOYFykmGXw5Gt2sYOADok6x', 'vytjewCXDY1p0Ufb43AHf5n0ajmHafe76p1wYEFs7Ka3BKmcyR0ikNShK4ZLxCH5duFHJ5y2mXEC6xBvtp1pX2if4Mm8xqmKax65unBA6Ujtf7vDzCCG9RuoYuiPP1Lm', '::1', '2019-12-01 01:03:24', 0),
(70, 14, 'y00MYan0ZiMpOdoebw2uDV30trWqVE1u1fHta2QqiGhP8FeElH16xvbeB4LC6eD4bICDDzp5XIxdGBHCzw9PzxWBAEO4aujDIzewMcYhBgq2yp2xk8EBEFJFjKqy5Lsr', 'XDCseH4mFWgvhBe5lTA72dwU50vNLGGoUdeJWGsTmQ6S9GzYgEoMZkNW1vE4BLEBEtJ9PXlBszbuNdTRx2GCl9yvSkAnRZqoDw2iLcQDJXPyBIwOfxe8TYOceTpp8uqN', '::1', '2019-12-01 01:06:09', 0),
(71, 14, 'k12Pvg4qaYD3h5pekduNAFM0YqTrcKm2154DW0sbiVaZRf6xuzDWYUdcEXzwgEIvbmbEE2cP94VChWC1W2YuZCukwaDU307wvM881BHRUASAqKCTr7eIs9HLdGXloR8D', 'RfkFXt2z9pT5uBJe1Tqm2OKSsNP2iAZZ0DmUkIXu0KGxzbrRqckgMlc4faICphbtgVAdBdv4ckMlxVJbNzCzTar1dHWJjXy29bINF2o6WRbN5kPHepgneENanRJonsXQ', '::1', '2019-12-02 22:42:18', 0),
(72, 14, 'aOvzFthEPgb0Hf6YHgnoXsVtwxXn1zYJO4xHTfeGDq7LR6zjlaE32hhYOyk3KO5XApvCCYZKFX2e37cWTJYrRAQIpDLRhtogJTKbJSSbreXY7EuC3q4zpqDz53skh9Z5', 'vzGHgvdOEs8c6wNLugVLvt0fdCmY5kRwTdROQgjOY5aEoQGUcIsTDfG7ZqxNT0kTTTBZOIatbyRML73WRSrniuSX3wNfHzca7oCbO0kqySZveIHTs8b6l9OFm1LsNJSc', '::1', '2019-12-02 23:05:17', 0),
(73, 14, 'xySkg5hrpdfG3GpIRu18oxmxi6M6U7ijNy4msqgi7q2Guq5H7Hu13zE5FQN6VbDLuTkt9pjH3FtuA0JJr3USGSdHljy1bTOPpMsBWzJYt1Cg6KAlKpDF9m0Tvet3mvAD', '4UZTrX2bxnOQKggA4fxbyh0SvdKpgxPXvcEAKl9EzFaZDXxrowBKCWlyB218C6xaJPKUuzU7kqT8lZ59v8M0AXpPRNRB2M0TzBAJhSgtbNQl3pex2mfx71WzYotzpB3v', '127.0.0.1', '2019-12-02 23:28:18', 0),
(74, 14, 'bemeJFJYZu3KkaGBXmBGdo8OwkoHS9fZHBvUH4eDvtEehVeiMjqxB5UYyIzPf3JOYxs7dmjgCQUdR4Rd1ExiRBY58wfLPa1qdeVtNwLOptvqGSKj0G3xkMni6wB7TdXI', 'fxgioFaHbKxO1syUOa0rCQOvJXO2MjOVwbNCsNlzDgZg1hn4jqYGX4w9p1avgOV9rGoL0CFEiPrqHa8YUeN3nBtxmGnf93MfMPxA5338BIcFybyx6nM84WCivMuzhB8A', '127.0.0.1', '2019-12-02 23:28:27', 0),
(75, 14, 'p6eATRDFYSmiUXqSCSFLvVF8d6Wock4YOeMlKbJzwcfBNC4C0uEsRLi6TJbygQGExv1gmEQgaq46zmYCP0zwcAwJW8pqLtIkupIitTZUV2TdzdJjueIY9BO7BVeh3mqE', 'Cho0JwXxXmzu8OEnWWQJ8TFSQPIw0X91bYWMoPXcE7XlHrhm1lI9JzCxhkGe8fQwByUxmBcinuTeU13IGscIoJfbdZnFOShAm9oI8mL9qft4AiplFMDxu3jbcnkZgCTD', '127.0.0.1', '2019-12-02 23:28:30', 0),
(76, 14, '8n9SW1VaxZFAfYUO1TI9ijHQ01nqznBhbmSfCiOGpgaFIcWTcGJPxcx1fsizqudXaklyVwx5yoOmF7Xipty7nCBaT51DhpjRHhItF4P2lNVxbA9O6MmgJKhTUWpCvwsJ', 'vDwl9lRzDZwxkU1ZfXOcqg1fq9Afnyuuj4FyvJpbIMCkuFpO1z9WXZrADvb6d1PRhkYhJvAJzn1nT5xnAV6RUfwuAwdhNkXGVRfJYRpBTWYWhVe80nV59Z2YntIuEP9O', '127.0.0.1', '2019-12-02 23:28:58', 0),
(77, 14, 'k12yo5gJD1tUIye1lXbf1P4KsOJyJxfwBZTdAFQVXNFs6xxWDJsXOD8wozGVGRWx2XTDFvLKU1MheGeAGHucFWlXfdt600mQ8y1TlNHdRT4qiNKerTGxBUM7C77bki71', 'sJ1UVEzAxRLOjZ8c1XSJg8xrDde7CBL7c59DGMuuMhzqTsGCWrTG9nRtFqi7PGjw1OVx04xy7f7CUevvLJ9aJ2baxnvzyzQfhCe1xKfiI2cSXHBAgn60iH32YUMliJs1', '127.0.0.1', '2019-12-02 23:29:08', 0),
(78, 14, '26u47RtLuP2FbcwsQOfjwKHuAuO3NCIvGUmaDm9D1YjIJETXkYb1AbyOLVXvLz7UqG0OUPx73oB1wNd8HtthNYYPSEpuPoRNNM5fg7QdDwyV3uCjhPSDMsy3hvZsPyLN', 'dXFVTQMPD7ODndfpD861s4AuikSVjwKoHyRYSRje8CalAWxbxoY4BtUNHlm88ykxetquqvhwtUu8rOb7xDikvi6glV71k4ufHWSHFGbTbfkFqdOXp5gCVs1WnlxUMTsu', '127.0.0.1', '2019-12-02 23:29:09', 0),
(79, 14, 'mSjVEbHMJBkMCFtmNA3eFe4SpvgqjXY0uBZNZF7VHFS5g77y1yBjY1Ro9A1xNm5hAtotmn09ThzmYf2JXxhYJBUlwHmEScKO4lJQKrZdMvXZTWccvSYuPbIGbukXcnam', '2vDsK9FEYzZ0rVmdABHKM5Q51V09kR9kjCyl4xWcMhQ0YiqaqmdCLlP366ft3PM1b4ANu8H1JWNhbOtupvQouZKnccgAPLsPhVZswRix1yLn2oBmoAJT7VGSbU7vK33B', '127.0.0.1', '2019-12-02 23:30:04', 0),
(80, 14, 'Wa5vVcwbsyqSDqfboS0NkvEqi1Zt4nLoJKpKZKNEnmNVDo9KVXrnrR9m6A5mqiEtoMOgjrkJUqPs1VtOtFo3rCFeVQkQoPUmhQMLFXGvPl1WdFcq0Y8mp3q32baexdio', 'i32LLP5XWTAtOt28XnfRArhZPkvuI4jJQPSDeuDaL19pI0hOlJMioipZmaMmzvs2CGx0S9Ahp6GJoL385KkIfV0RPYWfR7I24v1iSMR3QNXW1OCA7L3QwuiRhZBhrLHu', '127.0.0.1', '2019-12-02 23:30:14', 0),
(81, 14, 'nDQq1KSJSbU2XdrVZsZqRSpuQKFFlyKQYo16kIkscFam6bTVy4GoO15AVNZLmZQ5LZ7ZKVwndFyh3BTW9fuo0Oyv5TeuYPEVoJzgRuxl4dt5ORrqgcufCvTryeNIJtgd', 'HYIVbsIrCjbXAk8E3XknvbtVmduzKVb6nkkQXjN5IRazmPp3E1xlLbTkSynNSlIVuXn4KHzMAyaKAypZFTipFtsNHX1o987EyYh9dxVqddzu43Ty7KFeOVIUxYnh5FKg', '127.0.0.1', '2019-12-02 23:30:33', 0),
(82, 14, '45Kj6YS0eHGaTdbDPRFa3jbSUCuSZupMO8JbZXK3eJV02D1hf4oIF3qvEYSg03drUQlSylSGiA547629GTXcfWsPyqbPKevGhzCKSkBKm32repGBLvFymOrQzi4opVe7', 'Sp3aLMIT7qJu9vpAR5s8kBzSA75C2HqieKRhhzByJ1eWFwaJwgOEXToJ9XLUsk0ZmC7KYU18b0IfuO7fFPdcPV5jdjmUBLTKD3VP3KD7DaKKgk8LrspVqpJgNKw3rhMO', '127.0.0.1', '2019-12-02 23:30:39', 0),
(83, 14, 'PNlUccT8hgO9uauSeycppQrb0m4PSpENVjef5troP6Pcvb854kBznTHQqRAcX0J8vjhFXOxkVnyAFWuVU39FuiLGQeq0qJmSrFlXeWjbqL2dJn1i08xiHp9ExD33PGM2', 'uklJ9i1wJWvZzQ0JNjaigdxl0zHaQz4mgsxCej2VnAZXIRyq3ZrqJjoNbRCUzZ5vztQUAqku4XOkifwhDNqeXb5cNQUe6L9WCbKqys16SAtQhik7DecM7JgIx75aD5TT', '127.0.0.1', '2019-12-02 23:30:49', 0),
(84, 14, 'LTsoSTXdCHz1hvwmI1qdTyonNyjGqVRmQvXRa3KfulejpvDnzQN7bK8zg6yJDzAtmaNWcvaRkRbhSpEoBAgmPVMMwoLPBcoPCg9xlZzybS0jaEo3h7hM3DO5LQlvoK1m', 'OkU03nwxUgMi72zqUSzARZ4o1GhK7jgt6BvbnVSnuA7RCdea6GFWcSj1DKCu8Hlyxm0rrUzKy4esiRAzOULMH1dTPEKiX5M9CTSKiWBaaxY1q8gPQXkXS7Dg1G0wFls7', '127.0.0.1', '2019-12-02 23:31:05', 0),
(85, 14, 'lmZQVbHz4q8prL3GNsYKXrmQxZKIIWc1CY3pXqKn6zR7MFJvLQxt7DjyzcffF0nTGRZqdzCqYjyWEvMn6epMxWeAh4Jw1Ovb26E7qgU3P90Jx8Xtz39y0BIQYBZC2l3K', 'eiCLJjtyZwhWDPIUftFlhO0it7DkZt77OwUfyCmi4oYfxkQRUmNiKEIBzwOe8F4Ge0NlbI4TmqG0p9TZ7OuP9TH7EbRLKAB3T8JDF4HKZMS13Mcura22ESuTBLuHNgwQ', '127.0.0.1', '2019-12-02 23:31:36', 0),
(86, 14, 'KqZw6nxCvpORe1zCL4u4B9c3fxyzM7ezybBzmAX4YykRZm3qqNpUy6VNGmGfq2t9rcHkavSoKh7fErTU2wQFtX5Li1zCzeAQEbGkB0ZuRgXlj2ry0blvtoDqyEf7j2yL', '8kUyildePj4H7nbmLKSNNXnDdHeZJtOmiPKaRMib5kpJwLjnBpcq2LZFgN9sbCPx3WTJbITL0MyRxeuEoycS19dhVEj0LNuLmRvwSdZtuG9BEOBmSvjZBR21TrGGveF1', '127.0.0.1', '2019-12-02 23:55:03', 0),
(87, 14, 'Uz0y072prYPuqbyQWR4q7RJDxRQAhp8PHjjeZ1DX2jD9EbjYNEmjwlfNGxYW0uhb3zt44Q5sHqzWisY9FGrJYxGoqOBxqEPI7bxS2YXVtp5uiYeiw09iXHzi9wjb3th5', 'mvH7wVXDsKihfvU2tXiZP7ap3ESeIXQMry294HL3sPWb0R43sLOHd9c1sBm8ziC3kEyASvIQ66OarodkI4miMrHf5OXxPl0E54eqjNqsZabOv9d1eh7ulMcv1nRfP05m', '127.0.0.1', '2019-12-02 23:55:50', 0),
(88, 14, 'qGxyfcjzt17WcS9kfgc4gatdgYgHVKN3szcrMZtOu4kALHM8rFtnij83hWIOzTG15feAEPrx9xKxWSwCRXWBrdksaQ1bjvwFv96WqNvR7lVufiIHgyhrSruGdQplxJHl', 'lFrnsopvrieFGoWRFcC8yFuf7QdwNFz3c18YOxxvSQn61J80j3zPaRtdtdYLpWAWgjTtiPCwmzTGfVPacUnBn2OOmVHZH60x0maKqREbfEcFb6pJseBHdNm58HmED4nd', '127.0.0.1', '2019-12-02 23:56:04', 0),
(89, 14, '8a9keijojZ63Iwi4NL09MX5GRvzqF0I74vlGz2TSa87vOICXrOUTkckyguTRJAl8juevExZRIIxInhN1aocE7zwehZtU5GGT1DKf99svWo5VIRyyuLA3pIsKu7JKNJEO', 'AZ9dgnBxUedn4Hh3LE6o5Uv7GNpNVABAWiPhfRLkZDSq2fdrHEyOjXGxsLu6e7WX481ymNIhAK7bwdBHghnlApdHv8XK8lri3ZIIrgXEQUQJ63EBUPLIHl4dknRG2H52', '::1', '2019-12-03 19:44:28', 0),
(90, 14, 'u7N4Vv9XU4aX0ITteonbm4skBrnUe1cEmmIpudC3PV3MEszx7rWlkKzACSvC6E6PNDPy8OrQn0030ZVGbC4Jx23ieeg72VrWySC5u5etnoUD54cmDx1HxrG50XDTpHwD', 'LTAMUCeugtUFAfJcyMX8P9VeTZPo97PYiZsdwsRXZFJx3usVZ98B51IC6oDuMm7vFGvAVPaN5FZQjqnJ7G4oAUJhJquLOFV9gu52cbgDngEo5tXP8MFkuVc84IhEwgBY', '::1', '2019-12-03 19:44:32', 0),
(91, 14, 'U8CFNQCEu9Sw7XVmtCJE2MESikr2O6q8EG9z9iLh5jWB48CwIGf7BQVNgmUchC5o3YJXmCTDlAJgiDhuFbzupT8Fjl4qFp76wEtErQGHcIkq3nvUVWKqDkvf0jrENvkf', 'nIH5EuOVaG6mouoMIk3e9bGlCYYEQs1lcOpcAelcn3dPSWum3kBuX6OcC8aIUWuKt2aW0cEq2xDsNOLE61NkW9h0zzGtyvs2v88vjtAS5sIjs5ZLdRPoiuos8XLb5GTG', '::1', '2019-12-03 19:44:32', 0),
(92, 14, 'Lgdms634jnmVoAfoVNzIJjyEVaRxg3aX6DXCNRbdFOwkHxjkJMbvUJ0fOAWpNG0q5t8XivpoQnp27ohZcGqZqowcWFISf4e2lusEGdTnluJjixiVYrZZQQvQuw2CdPQl', 'NHSWmr9bCazmFutK4aynrhfRw8opuzkwhruJRdda6hM3lvk4JLR3B71m79v6LuPLb7RMSq9YUdvgDwHGQVs8R637Om03rxNtiL3NOk7qt1JDYHzRS2v5SgjeVSUbWErH', '::1', '2019-12-03 19:44:32', 0),
(93, 14, 'hkchYrCCv2FQBfJ3JOXwFYaBmLTh2gUq1kE19gpqSjNkBqdHk0YGkRpJkqgAEr7uWp6MiTSpFPwLhcod0PIe7SWgvFtFYLmZbPUE6sa60gAALGNjCjKer25jvXXbGvLW', 'BLy9xST3PX5NBDso9RFkzQEFU6I2ogGurETxKqdtSQ5zTdjiaBADT5gO8BiWDmGoaCTWzXXA8uRSazVxJ0dCu2N4nX4qG7hDYOsvhkCm8gMBLP78zfAAlQBX8IN4gkrY', '::1', '2019-12-03 20:38:30', 0),
(94, 14, 'QMKRfiscSOMV9Sz8870my6Y6WMhxOIg3mKhPA4y5ELz6ymYUU7dDcPkuEnxNwz0k6XL5XOfZwiN7M1tSjmXFWfCUWlDTogRQVt4eTmFL0jFZ5WkkcIxX3kqDyNRGnIxK', 'f6Shmum6mtrNoUQLtNOuWKUERNouGQWbeMjyyuDdupKpR7cyMgoFRvBwaAAZ1hUSWNa0Gmwl4ZReqLzbMI2o6JeOZItP0VTCAltiUruiiyfiTkB63G12xGaO30dfPjTl', '::1', '2019-12-03 20:38:31', 0),
(95, 14, 'dgsTRhsa15aObeqWefUOjLXLyKbsR6yJ3VKOReai0Huo7oDPNGfPOYDipJhzYIDbdNoxNo9sCvttKXHrTffMk5xsv5GTO1IzsZtDFLIq0C6gBTGFxV4bjG9fzITe8LL7', '2eeXFm7n9EjHOAQR9o4pD4cW5Shr622Yzm3ilh1LDslUtSwcDqCGgreQsZhcjOwJxmj6xG5ic4nnIufGHOlTKrg5ICgWE4kQEWnJE1Ucld8NB7IFQPyG5LjL2KOCimmv', '::1', '2019-12-03 20:38:31', 0),
(96, 14, 'ygJAL6PsVc4HjZStdWOhkeDoTMA4NAGk92ZOPwMNAWim5rNJ8nSOg3r7RYUMKJ1fFPlvfH7ucf64HLylPYRxoj9WVs1veT1txYEXNw2Es0h7QW1o8xenwhEySuy1Sq1o', '1FmC5cQtg18iOrQr6EjuEVaIa2yjfAEmer0y1s4MBBhx9GkNU2zlLssG9zgg9DCeNSSOICmXdiK9xJg9EjzYl4U6T2QIRhZJaRvMHFdsoZkxyh0KdTwK2VSQIgQzmofz', '::1', '2019-12-03 20:38:31', 0),
(97, 14, 'DH5QpmHsMB5i9Xlh5TY1n4dsSeNYNHB4cg8eHGbbz0ADvY5qgstai4URkku5J3q6w3bUQTzcm1Cz5lVPOzxqGbraBhEWakkCnj3DCmm8UKOCpaUGwoIXa09qItX19QJo', 'OHHAkt9bppQPdZOk5aGZTNMxMDaPhiooek5y9tvycVifRjn6cBhUyMNbZ7BHpTJmbWJzDbAKdCD4CL9VDMXqOtF3hVa2WdtUf9kgmVZF5fZE4TOXvmJ7HbRQGTN1Xnqn', '::1', '2019-12-03 20:38:32', 0),
(98, 14, 'ym2sQr4Kfs46SmgUaZT83hCuhxqcOR33WOEmbkNC1L8gZ6bS8lIm5hQGp8d88sxcajXzJdFva69Nip9eCVfKTLsufbmsCyg7Ewk3zF4FYmFHU7hRvpLKSif0RoHJvkWH', 'LNjaETsNztjsuH78LP1yedoTALvbEItfyJiijBvtmGh61wGLSOvxK25J9NKUAmlg6suVWZxdimQllTlw1o7mwWuOSygeCJcYmdNWJAqwi0GZskWizx8LtqP1xLyEV8Va', '::1', '2019-12-03 20:38:32', 0),
(99, 14, 'ouuq4nUJCsy8q4W0XmnHfedS1RVDRi3qsbgFfdpgi2mUZyVVpr8r0XdzrPwmDhNmJZp5TV2OtPeF2xAx2ntD9a3FwmfNXZhhJiYB3DKH0Y9QPWX5Sl07Opw76dvZOAuj', 'DaSFmpZH3gZHG08FoT1FDfRXdbpLWPqs9iqdtDeNltdIFgn8vh5bOab58z8lKseLWHNuMflPDRsrbmloI4p1PnPEWCGh42QfH0Mw1Fy7H1yHlZY8wvDsTN4hRKGCQUgU', '::1', '2019-12-03 20:38:33', 0),
(100, 14, 'WiJQxfdF2l8RFjgXDvFO5JmkZKQStduRESbXpmazjnJYctBsYt71Qw3Qh1EhKuugYWAseKNTXKkK96V0MUJ1nJM6JZ7htWyAGAQCuOgJeG43OgjCqnvjzI4zJuEAId8F', 'dqUXVL7ZpxZ4htqOhYY8PW0IUA3iGt1UCvoxRpYWH5hZHemSia9jXIS73Z6uAkGhxiVnc6O1y3KIpnNKdPJVOcLxwzC6dAlnAH8cO60Z3KYX6c0saDWfzQQEeEQE1lD6', '::1', '2019-12-03 20:42:18', 0),
(101, 14, '1vvSycQHof5iqNukVMLor98NIKyJ5M4QsvtD7fiNzYtA80ROZk4q0NLbdLlPbqgiigHfpdCLeq8nTmRoJLN0ja0RrnvfpK0QqzgzJXJetiXaqWmz2ki41Xg410NvOq6D', 'uSKgkMBukDmbH9kfkDPt4IgR8jTSJ1JMurfzj6pZORNYLSHHAwV06246jOhTOBK29XBLs1EIah4a8vKjtynzy8mnYykXUt78tNk0ipILW5Mvd8cOtuwQiwrsVjHkPAdR', '::1', '2019-12-03 20:42:19', 0),
(102, 14, 'ikq0y58PCGVCG1OXP9zqsTRMj0QLlUbpmdaTenWKzZYi4iNe578dGlSNOw7XD4wPNXtAsL4UA7BIGbYYBp1KfMUq7kEiyaavUxzYO4hzwn5rM8FWfmDIrv0dyzjvIU6l', 'mrBbHHGq3sKTlzdvp3HKf3NljNX1vp9MkocL6Xtmci6txg4VdC8kHvNXGft4H9dMI35Q5h7gnU2FbQ74klmCAihZMLLpk95AiKkEjezbtwyjW5dwTOBLFI2tQzcfTemb', '::1', '2019-12-03 20:42:19', 0),
(103, 14, 's9yOVFGwncOVkW86lYIyNFDOH1WhLmlMIXlRCLSKwCYkRebduKruuGZUxWCAjMG58mGHKviQh4W6CGVrc03guItBDd9cNmB1sNWATeLgarSAVjZHEgE847SeMfXniXo7', 'IkRQvXGRgSEMOSycAUnj5775MNhtvHJ6dx9B3gAoTJCAkjcXvFo3VxAM69QMyqEbOoZCJK3uvrQw3tZTNSBG7gNWBC6cYxh78zDhUTqu1FxHng5OBaS7dYaMsykd4zLG', '::1', '2019-12-03 20:42:19', 0),
(104, 14, 'GE687N0LUPTEMXQwA0PM34OlyNqRsBBzjvYrYemkkRfueQU5ijgyQ3kwQFxk9XjIHnK1mWUECe3MVaxPES3s5r1VcD7uamc5VusViGcvYiOLgkOtfRMBqFTXitBa6VRH', 'Up13k7fGL1C0WxCLsOWn7ifu1uYRCSMGCB8aNvjMiTLWmPf18UXeqkKETzbK6ufJ5Y9ynb5k6fVb8VQplrYjXjafjIRFpHwtWU2lrM3cZvliyDnHJYDNEMd7NbNu3glO', '::1', '2019-12-03 20:42:22', 0),
(105, 14, 'rnSeXWBcMafZ5Jzva3HFRt4zhqjTYtzIjCn0ACBNAY35kBcukzKou5YgUHgIVNq7ZFq2zN1Q4HyLQBBD85nyUJdg4BXh3Tc4urnPlGTlqWN3hNpJ3SkGG2gm5re7sQnb', 'pACD3Ebwnykt8BfwQmRJq1lxWaM45JBn2v4Cds4Ux1MjaykRiY3aLzFQ6xGTYJEbJXYM7EAXkEHGnzn61jOA6NtfkdXrztSLsRjHYE133bzP9KKIeMGfusCESQm5h2Jf', '::1', '2019-12-03 20:42:22', 0),
(106, 14, 'ybInZm4d3Yla1duZX55aHptNaAQ33Cz1aw3DGjVcDgfIDA8FnRwJzZUkH3VGM16P6DRRsDOZupSZc90NSuKBQ76nGrPsOLqmB52hgcfnjHfa3jvvGOwFF6SKQTYPq6RB', 'OOscHFNF80zQ9xGWOZJvoTeXKLLq6IrZlUuVjERykSzpIuefR3RwArUCObvsQ7cLMOcKsFjw1hX0EmJcSgMFKM1HGAv1las3eS66xacfLdENJLBLbImmvUgoIWp32wDk', '::1', '2019-12-03 20:42:22', 1),
(107, 33, 'jA6xcXv23ZZ1SwnQER3YbdX1LTIGfXXljQBtGEhNpDiWkltyHOBZV2QTI1OkFt6fO4JEyI84IrNlrN0PAQApm4hhMPGnVKXJPwGj13x9qGIjvr52yraMv3hih6veBYSy', 'VNYj9DPE7JLlcOnAxktF8fq4bavrae8baxWBgb4sc7klkEiBu2UTpbM7a2qtLO6i1BtGokBGOtkJryQy7vi0LKgm6VMn4DzA97mcnSfIOFaUyl4yYf994337nFkX1ZxY', '127.0.0.1', '2019-12-04 09:33:02', 0),
(108, 33, 'Lmq3GjM72UvjRVoLt7jXt4CNCezpQP6POxFo3ljZ2ztvxUQZj4KctVfRkS3WYCjPkcLFJVziTRtZ0CPbJ9Iz22xluWyxTh7DlnfpP9F33bRnzymTaRTEFBOBxANrDmnc', 'f1MQCaUNzKt5dEj112kMuyRahXMbRJRCgUzstWzlCScbaHTzFP0FnsSSIEZ13zWMs2GBu06JerGwJ1zJnekz25MDr8w5xvhHMYPu3IQos9cSVrO7JTRHMcMXTS0qQXB7', '127.0.0.1', '2019-12-04 09:33:30', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user_first_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_last_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_country` int(11) NOT NULL,
  `user_submission` int(11) NOT NULL,
  `user_ec_id` int(11) NOT NULL DEFAULT '0',
  `user_organization` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user_web_page` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user_address` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_tel` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_food` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_accommodation` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_extra_note` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_is_corresponding` tinyint(1) NOT NULL DEFAULT '0',
  `user_joined` tinyint(1) NOT NULL DEFAULT '0',
  `user_is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `user_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_created_by` int(11) NOT NULL DEFAULT '0',
  `user_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_updated_by` int(11) NOT NULL DEFAULT '0',
  `user_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_first_name`, `user_last_name`, `user_country`, `user_submission`, `user_ec_id`, `user_organization`, `user_web_page`, `user_address`, `user_tel`, `user_food`, `user_accommodation`, `user_extra_note`, `user_is_corresponding`, `user_joined`, `user_is_admin`, `user_created_at`, `user_created_by`, `user_updated_at`, `user_updated_by`, `user_active`) VALUES
(7, 'aaa@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Test Name', 'Surname', 1, 1, 1, '', '', '', '', '', '', '', 0, 0, 0, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(14, 'test@gmail.com', '285449542dc15c8e51f76ea615a6fa97', 'Test Name', 'Surname', 1, 1, 1, '', '', '', '', '', '', '', 0, 0, 1, '2019-11-24 00:00:00', 0, '2019-11-24 00:00:00', 0, 1),
(15, 'test@gmail.com', '0f4b203b5e4f2875a85b840b63a7a3cf', 'Test Name', 'Surname', 1, 1, 1, '', '', '', '', '', '', '', 0, 0, 1, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(16, '1aaa@gmail.com', '7d9ff4155ea797f740a30fe93cd2998d', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(17, '2aaa@gmail.com', '555a46fe9d4f0432f7da12443da3105b', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(18, '4aaa@gmail.com', '576432483986db7e7942f4e51a206028', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(19, '5aaa@gmail.com', 'fd667b7efc6c4d3abd50133e53a9f395', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(20, '6aaa@gmail.com', '702e703c7bb29b8880ab145247efca08', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(21, '7aaa@gmail.com', '4ded7126c94a600eaf3bbf8ef92e8bc0', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(22, '3aaa@gmail.com', '54026f3ced9aabd6963730f853fc8949', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(23, '8aaa@gmail.com', '0e215ec7aa86f7397632689e62d20410', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(24, '9aaa@gmail.com', 'daf8b9bf9cda5167b439b1f8a267bb2a', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(25, '10aaa@gmail.com', '44173601a76392fe6965920dca1a45d9', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(26, '11aaa@gmail.com', '4490a7d0c21b9300f7b08b116a92c1ae', 'Ali', 'Veli', 1, 1, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(27, '120aaa@gmail.com', '570d8768588ffdf4fd996eeb085069f9', 'Ali', 'Veli', 1, 13, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(28, '13aaa@gmail.com', '6e66660b6dde73a9c23a7f44654d468f', 'Ali', 'Veli', 1, 13, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(29, '1210aaa@gmail.com', '4ae6e934ace654c232593764dbec258b', 'Ali', 'Veli', 1, 17, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(30, '113aaa@gmail.com', '3d58389a05d39854eba6bdedcc19ed23', 'Ali', 'Veli', 1, 17, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(31, '13210aaa@gmail.com', 'bf668dc9cc6a5732bcf2b5026d864da8', 'Ali', 'Veli', 1, 20, 1, 'TEST ORGz', 'http://www.google.com', '', '', '', '', '', 0, 1, 0, '2019-11-25 00:00:00', 0, '2019-11-25 00:00:00', 0, 1),
(32, 'asdas@gmail.com', '6847cb661527e638789f4262d4fe02e7', 'onur', 'yılmaz', 1, 21, 11, 'asdasd', '', '', '', '', '', '', 1, 1, 0, '2019-12-03 20:38:19', 0, '2019-12-03 20:38:19', 0, 1),
(33, 'muhammedkalender@protonmail.com', '5e4a3c57b6b7972542aae45c4ac1645b', 'Muhammed', 'Kalender', 1, 21, 11, 'asdasd', '', '', '', '', '', '', 1, 1, 1, '2019-12-03 20:38:19', 0, '2019-12-03 20:38:19', 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_announcements`
--

DROP TABLE IF EXISTS `user_announcements`;
CREATE TABLE IF NOT EXISTS `user_announcements` (
  `user_announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_announcement_user` int(11) NOT NULL,
  `user_announcement_title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `user_announcement_message` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `user_announcement_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_announcement_created_by` int(11) NOT NULL DEFAULT '0',
  `user_announcement_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_announcement_updated_by` int(11) NOT NULL DEFAULT '0',
  `user_announcement_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_announcement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `user_announcements`
--

INSERT INTO `user_announcements` (`user_announcement_id`, `user_announcement_user`, `user_announcement_title`, `user_announcement_message`, `user_announcement_created_at`, `user_announcement_created_by`, `user_announcement_updated_at`, `user_announcement_updated_by`, `user_announcement_active`) VALUES
(1, 33, 'başlık', 'mesaj', '2019-11-30 22:58:33', 14, '2019-11-30 08:11:06', 14, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_announcement_messages`
--

DROP TABLE IF EXISTS `user_announcement_messages`;
CREATE TABLE IF NOT EXISTS `user_announcement_messages` (
  `user_announcement_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_announcement_message_announcement` int(11) NOT NULL,
  `user_announcement_message_message` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `user_announcement_message_read` tinyint(1) NOT NULL DEFAULT '0',
  `user_announcement_message_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_announcement_message_created_by` int(11) NOT NULL DEFAULT '0',
  `user_announcement_message_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_announcement_message_updated_by` int(11) NOT NULL DEFAULT '0',
  `user_announcement_message_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_announcement_message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `user_announcement_messages`
--

INSERT INTO `user_announcement_messages` (`user_announcement_message_id`, `user_announcement_message_announcement`, `user_announcement_message_message`, `user_announcement_message_read`, `user_announcement_message_created_at`, `user_announcement_message_created_by`, `user_announcement_message_updated_at`, `user_announcement_message_updated_by`, `user_announcement_message_active`) VALUES
(1, 1, 'mesaj', 0, '2019-12-01 01:07:11', 14, '2019-11-30 10:11:03', 14, 1),
(2, 1, 'mesaj', 0, '2019-12-01 01:07:27', 14, '2019-12-01 01:07:27', 0, 1),
(3, 1, 'mesaj', 1, '2019-12-01 01:14:24', 14, '2019-12-01 01:14:24', 0, 1),
(4, 1, 'mesaj', 0, '2019-12-05 09:52:39', 33, '2019-12-05 09:52:39', 0, 1),
(5, 1, 'asdasdas', 0, '2019-12-05 09:55:54', 14, '2019-12-05 09:55:54', 0, 1),
(6, 1, 'asdasd', 0, '2019-12-05 09:56:29', 33, '2019-12-05 09:56:29', 0, 1),
(7, 1, 'asdasd', 0, '2019-12-05 09:57:19', 33, '2019-12-05 09:57:19', 0, 1),
(8, 1, 'zzzz', 0, '2019-12-05 09:57:21', 33, '2019-12-05 09:57:21', 0, 1),
(9, 1, 'zxczxc', 0, '2019-12-05 10:45:09', 33, '2019-12-05 10:45:09', 0, 1),
(10, 1, 'fff', 0, '2019-12-05 10:45:13', 33, '2019-12-05 10:45:13', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
