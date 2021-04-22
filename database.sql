-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for motortester
DROP DATABASE IF EXISTS `motortester`;
CREATE DATABASE IF NOT EXISTS `motortester` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `motortester`;

-- Dumping structure for table motortester.devicerecords
DROP TABLE IF EXISTS `devicerecords`;
CREATE TABLE IF NOT EXISTS `devicerecords` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `device_sn` varchar(30) NOT NULL,
  `rms` float NOT NULL,
  `kurtosis` float NOT NULL,
  `skewness` float NOT NULL,
  `result` enum('OK','BROKEN') NOT NULL DEFAULT 'OK',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `devicerecords_fk0` (`device_sn`),
  CONSTRAINT `devicerecords_fk0` FOREIGN KEY (`device_sn`) REFERENCES `devices` (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table motortester.devicerecords: ~6 rows (approximately)
/*!40000 ALTER TABLE `devicerecords` DISABLE KEYS */;
REPLACE INTO `devicerecords` (`id`, `device_sn`, `rms`, `kurtosis`, `skewness`, `result`, `created_at`) VALUES
	(7, 'SN001', 1.2, 2.4, 5.666, 'BROKEN', '2021-04-22 13:33:49'),
	(10, 'SN002', 1.2, 2.4, 5.666, 'OK', '2021-04-22 13:34:21'),
	(11, 'SN003', 1.2, 2.4, 5.666, 'OK', '2021-04-22 13:34:25'),
	(12, 'SN004', 1.2, 2.4, 5.666, 'OK', '2021-04-22 13:34:28'),
	(13, 'SN004', 1.2, 2.4, 5.666, 'BROKEN', '2021-04-22 13:34:31'),
	(14, 'SN001', 11.2, 24.4, 54.666, 'OK', '2021-04-22 14:50:28');
/*!40000 ALTER TABLE `devicerecords` ENABLE KEYS */;

-- Dumping structure for table motortester.devices
DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `sn` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `release_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`sn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table motortester.devices: ~4 rows (approximately)
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
REPLACE INTO `devices` (`sn`, `name`, `release_date`, `created_at`, `updated_at`) VALUES
	('SN001', 'Motor Checker', '2021-04-22', '2021-04-22 10:26:15', '2021-04-22 10:26:21'),
	('SN002', 'Voltage Meter', '2021-04-23', '2021-04-22 10:26:15', '2021-04-22 10:27:22'),
	('SN003', 'Current Meter', '2021-04-24', '2021-04-22 10:27:38', '2021-04-22 10:27:38'),
	('SN004', 'Power Supply', '2021-04-25', '2021-04-22 10:27:49', '2021-04-22 10:27:49');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;

-- Dumping structure for table motortester.location
DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table motortester.location: ~195 rows (approximately)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
REPLACE INTO `location` (`id`, `name`) VALUES
	(1, 'Albania\r\n'),
	(2, 'Algeria\r\n'),
	(3, 'Andorra\r\n'),
	(4, 'Angola\r\n'),
	(5, 'Antigua and Barbuda\r\n'),
	(6, 'Argentina\r\n'),
	(7, 'Armenia\r\n'),
	(8, 'Australia\r\n'),
	(9, 'Austria\r\n'),
	(10, 'Azerbaijan\r\n'),
	(11, 'Bahamas\r\n'),
	(12, 'Bahrain\r\n'),
	(13, 'Bangladesh\r\n'),
	(14, 'Barbados\r\n'),
	(15, 'Belarus\r\n'),
	(16, 'Belgium\r\n'),
	(17, 'Belize\r\n'),
	(18, 'Benin\r\n'),
	(19, 'Bhutan\r\n'),
	(20, 'Bolivia\r\n'),
	(21, 'Bosnia and Herzegovina\r\n'),
	(22, 'Botswana\r\n'),
	(23, 'Brazil\r\n'),
	(24, 'Brunei\r\n'),
	(25, 'Bulgaria\r\n'),
	(26, 'Burkina Faso\r\n'),
	(27, 'Burundi\r\n'),
	(28, 'Cte d\'Ivoire\r\n'),
	(29, 'Cabo Verde\r\n'),
	(30, 'Cambodia\r\n'),
	(31, 'Cameroon\r\n'),
	(32, 'Canada\r\n'),
	(33, 'Central African Republic\r\n'),
	(34, 'Chad\r\n'),
	(35, 'Chile\r\n'),
	(36, 'China\r\n'),
	(37, 'Colombia\r\n'),
	(38, 'Comoros\r\n'),
	(39, 'Congo (Congo-Brazzaville)\r\n'),
	(40, 'Costa Rica\r\n'),
	(41, 'Croatia\r\n'),
	(42, 'Cuba\r\n'),
	(43, 'Cyprus\r\n'),
	(44, 'Czechia (Czech Republic)\r\n'),
	(45, 'Republic of the Congo\r\n'),
	(46, 'Denmark\r\n'),
	(47, 'Djibouti\r\n'),
	(48, 'Dominica\r\n'),
	(49, 'Dominican Republic\r\n'),
	(50, 'Ecuador\r\n'),
	(51, 'Egypt\r\n'),
	(52, 'El Salvador\r\n'),
	(53, 'Equatorial Guinea\r\n'),
	(54, 'Eritrea\r\n'),
	(55, 'Estonia\r\n'),
	(56, 'Eswatini (fmr. Swaziland)\r\n'),
	(57, 'Ethiopia\r\n'),
	(58, 'Fiji\r\n'),
	(59, 'Finland\r\n'),
	(60, 'France\r\n'),
	(61, 'Gabon\r\n'),
	(62, 'Gambia\r\n'),
	(63, 'Georgia\r\n'),
	(64, 'Germany\r\n'),
	(65, 'Ghana\r\n'),
	(66, 'Greece\r\n'),
	(67, 'Grenada\r\n'),
	(68, 'Guatemala\r\n'),
	(69, 'Guinea\r\n'),
	(70, 'Guinea-Bissau\r\n'),
	(71, 'Guyana\r\n'),
	(72, 'Haiti\r\n'),
	(73, 'Holy See\r\n'),
	(74, 'Honduras\r\n'),
	(75, 'Hungary\r\n'),
	(76, 'Iceland\r\n'),
	(77, 'India\r\n'),
	(78, 'Indonesia\r\n'),
	(79, 'Iran\r\n'),
	(80, 'Iraq\r\n'),
	(81, 'Ireland\r\n'),
	(82, 'Israel\r\n'),
	(83, 'Italy\r\n'),
	(84, 'Jamaica\r\n'),
	(85, 'Japan\r\n'),
	(86, 'Jordan\r\n'),
	(87, 'Kazakhstan\r\n'),
	(88, 'Kenya\r\n'),
	(89, 'Kiribati\r\n'),
	(90, 'Kuwait\r\n'),
	(91, 'Kyrgyzstan\r\n'),
	(92, 'Laos\r\n'),
	(93, 'Latvia\r\n'),
	(94, 'Lebanon\r\n'),
	(95, 'Lesotho\r\n'),
	(96, 'Liberia\r\n'),
	(97, 'Libya\r\n'),
	(98, 'Liechtenstein\r\n'),
	(99, 'Lithuania\r\n'),
	(100, 'Luxembourg\r\n'),
	(101, 'Madagascar\r\n'),
	(102, 'Malawi\r\n'),
	(103, 'Malaysia\r\n'),
	(104, 'Maldives\r\n'),
	(105, 'Mali\r\n'),
	(106, 'Malta\r\n'),
	(107, 'Marshall Islands\r\n'),
	(108, 'Mauritania\r\n'),
	(109, 'Mauritius\r\n'),
	(110, 'Mexico\r\n'),
	(111, 'Micronesia\r\n'),
	(112, 'Moldova\r\n'),
	(113, 'Monaco\r\n'),
	(114, 'Mongolia\r\n'),
	(115, 'Montenegro\r\n'),
	(116, 'Morocco\r\n'),
	(117, 'Mozambique\r\n'),
	(118, 'Myanmar (formerly Burma)\r\n'),
	(119, 'Namibia\r\n'),
	(120, 'Nauru\r\n'),
	(121, 'Nepal\r\n'),
	(122, 'Netherlands\r\n'),
	(123, 'New Zealand\r\n'),
	(124, 'Nicaragua\r\n'),
	(125, 'Niger\r\n'),
	(126, 'Nigeria\r\n'),
	(127, 'North Korea\r\n'),
	(128, 'North Macedonia\r\n'),
	(129, 'Norway\r\n'),
	(130, 'Oman\r\n'),
	(131, 'Pakistan\r\n'),
	(132, 'Palau\r\n'),
	(133, 'Palestine State\r\n'),
	(134, 'Panama\r\n'),
	(135, 'Papua New Guinea\r\n'),
	(136, 'Paraguay\r\n'),
	(137, 'Peru\r\n'),
	(138, 'Philippines\r\n'),
	(139, 'Poland\r\n'),
	(140, 'Portugal\r\n'),
	(141, 'Qatar\r\n'),
	(142, 'Romania\r\n'),
	(143, 'Russia\r\n'),
	(144, 'Rwanda\r\n'),
	(145, 'Saint Kitts and Nevis\r\n'),
	(146, 'Saint Lucia\r\n'),
	(147, 'Saint Vincent\r\n'),
	(148, 'Samoa\r\n'),
	(149, 'San Marino\r\n'),
	(150, 'Sao Tome and Principe\r\n'),
	(151, 'Saudi Arabia\r\n'),
	(152, 'Senegal\r\n'),
	(153, 'Serbia\r\n'),
	(154, 'Seychelles\r\n'),
	(155, 'Sierra Leone\r\n'),
	(156, 'Singapore\r\n'),
	(157, 'Slovakia\r\n'),
	(158, 'Slovenia\r\n'),
	(159, 'Solomon Islands\r\n'),
	(160, 'Somalia\r\n'),
	(161, 'South Africa\r\n'),
	(162, 'South Korea\r\n'),
	(163, 'South Sudan\r\n'),
	(164, 'Spain\r\n'),
	(165, 'Sri Lanka\r\n'),
	(166, 'Sudan\r\n'),
	(167, 'Suriname\r\n'),
	(168, 'Sweden\r\n'),
	(169, 'Switzerland\r\n'),
	(170, 'Syria\r\n'),
	(171, 'Tajikistan\r\n'),
	(172, 'Tanzania\r\n'),
	(173, 'Thailand\r\n'),
	(174, 'Timor-Leste\r\n'),
	(175, 'Togo\r\n'),
	(176, 'Tonga\r\n'),
	(177, 'Trinidad and Tobago\r\n'),
	(178, 'Tunisia\r\n'),
	(179, 'Turkey\r\n'),
	(180, 'Turkmenistan\r\n'),
	(181, 'Tuvalu\r\n'),
	(182, 'Uganda\r\n'),
	(183, 'Ukraine\r\n'),
	(184, 'United Arab Emirates\r\n'),
	(185, 'United Kingdom\r\n'),
	(186, 'United States of America\r\n'),
	(187, 'Uruguay\r\n'),
	(188, 'Uzbekistan\r\n'),
	(189, 'Vanuatu\r\n'),
	(190, 'Venezuela\r\n'),
	(191, 'Vietnam\r\n'),
	(192, 'Yemen\r\n'),
	(193, 'Zambia\r\n'),
	(194, 'Zimbabwe\r\n'),
	(195, 'None');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;

-- Dumping structure for table motortester.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table motortester.role: ~3 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
REPLACE INTO `role` (`id`, `name`) VALUES
	(1, 'Student'),
	(2, 'Teacher'),
	(3, 'Technician'),
	(4, 'None');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table motortester.userdata
DROP TABLE IF EXISTS `userdata`;
CREATE TABLE IF NOT EXISTS `userdata` (
  `username` varchar(30) NOT NULL,
  `firstname` varchar(50) NOT NULL DEFAULT '-',
  `lastname` varchar(50) NOT NULL DEFAULT '-',
  `email` varchar(50) NOT NULL,
  `location_id` int(8) NOT NULL DEFAULT 195,
  `role_id` int(8) NOT NULL DEFAULT 4,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `userdata_fk1` (`location_id`),
  KEY `userdata_fk2` (`role_id`),
  CONSTRAINT `userdata_fk0` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`),
  CONSTRAINT `userdata_fk1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  CONSTRAINT `userdata_fk2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table motortester.userdata: ~3 rows (approximately)
/*!40000 ALTER TABLE `userdata` DISABLE KEYS */;
REPLACE INTO `userdata` (`username`, `firstname`, `lastname`, `email`, `location_id`, `role_id`, `created_at`, `updated_at`) VALUES
	('ika', 'Ika', 'Noviyanti', 'ika@gmail.com', 78, 1, '2021-04-22 14:45:57', '2021-04-22 14:47:00'),
	('taufikdev88', 'Taufik', 'Hidayat', 'taufikdev88@gmail.com', 78, 3, '2021-04-22 01:25:43', '2021-04-22 11:24:16'),
	('unknown', 'Johan', 'Already', 'unknown@gmail.com', 78, 1, '2021-04-22 11:28:55', '2021-04-22 11:30:20');
/*!40000 ALTER TABLE `userdata` ENABLE KEYS */;

-- Dumping structure for table motortester.userdevices
DROP TABLE IF EXISTS `userdevices`;
CREATE TABLE IF NOT EXISTS `userdevices` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `device_sn` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`device_sn`) USING BTREE,
  UNIQUE KEY `device_sn` (`device_sn`),
  CONSTRAINT `userdevices_fk0` FOREIGN KEY (`username`) REFERENCES `userlogin` (`username`),
  CONSTRAINT `userdevices_fk1` FOREIGN KEY (`device_sn`) REFERENCES `devices` (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table motortester.userdevices: ~3 rows (approximately)
/*!40000 ALTER TABLE `userdevices` DISABLE KEYS */;
REPLACE INTO `userdevices` (`id`, `username`, `device_sn`, `created_at`) VALUES
	(1, 'taufikdev88', 'SN001', '0000-00-00 00:00:00'),
	(5, 'taufikdev88', 'SN002', '0000-00-00 00:00:00'),
	(16, 'unknown', 'SN004', '2021-04-22 12:15:41'),
	(21, 'taufikdev88', 'SN003', '2021-04-22 12:19:08');
/*!40000 ALTER TABLE `userdevices` ENABLE KEYS */;

-- Dumping structure for table motortester.userlogin
DROP TABLE IF EXISTS `userlogin`;
CREATE TABLE IF NOT EXISTS `userlogin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table motortester.userlogin: ~3 rows (approximately)
/*!40000 ALTER TABLE `userlogin` DISABLE KEYS */;
REPLACE INTO `userlogin` (`username`, `password`, `created_at`, `updated_at`) VALUES
	('ika', '85cf98ea4f2dfe58e883e46885a94566a3166751', '2021-04-22 14:45:57', '2021-04-22 14:45:57'),
	('taufikdev88', 'd1d1b17ab80c892aac96acd2aa84979981672e52', '2021-04-22 01:25:43', '2021-04-22 01:25:43'),
	('unknown', 'd1d1b17ab80c892aac96acd2aa84979981672e52', '2021-04-22 11:28:55', '2021-04-22 11:28:55');
/*!40000 ALTER TABLE `userlogin` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
