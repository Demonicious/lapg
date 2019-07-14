-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2019 at 03:22 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lapg_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_keys`
--

DROP TABLE IF EXISTS `access_keys`;
CREATE TABLE IF NOT EXISTS `access_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `access_key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_keys`
--

INSERT INTO `access_keys` (`id`, `user_id`, `access_key`) VALUES
(1, 1, '8nq0lf7f7b91bc7');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address_1`, `address_2`, `zipcode`, `city`, `state`, `country`) VALUES
(1, 1, 'Nexthon, 2nd Floor Haider Plaza, Prince Chowk', 'Gujrat, 50700', '50700', 'Gujrat', 'Punjab', 'Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `balance_held` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `user_id`, `balance_held`) VALUES
(1, 1, 500);

-- --------------------------------------------------------

--
-- Table structure for table `merchant_info`
--

DROP TABLE IF EXISTS `merchant_info`;
CREATE TABLE IF NOT EXISTS `merchant_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `merchant_name` varchar(255) NOT NULL,
  `merchant_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant_info`
--

INSERT INTO `merchant_info` (`id`, `user_id`, `merchant_name`, `merchant_desc`) VALUES
(1, 1, 'Demonicious', 'A Guy who Sells Things on the Internet.');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency` varchar(255) NOT NULL,
  `rate` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=841 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `currency`, `rate`) VALUES
(673, 'AED', 4),
(674, 'AFN', 91),
(675, 'ALL', 122),
(676, 'AMD', 538),
(677, 'ANG', 2),
(678, 'AOA', 390),
(679, 'ARS', 47),
(680, 'AUD', 2),
(681, 'AWG', 2),
(682, 'AZN', 2),
(683, 'BAM', 2),
(684, 'BBD', 2),
(685, 'BDT', 95),
(686, 'BGN', 2),
(687, 'BHD', 0),
(688, 'BIF', 2083),
(689, 'BMD', 1),
(690, 'BND', 2),
(691, 'BOB', 8),
(692, 'BRL', 4),
(693, 'BSD', 1),
(694, 'BTC', 0),
(695, 'BTN', 77),
(696, 'BWP', 12),
(697, 'BYN', 2),
(698, 'BYR', 22124),
(699, 'BZD', 2),
(700, 'CAD', 1),
(701, 'CDF', 1879),
(702, 'CHF', 1),
(703, 'CLF', 0),
(704, 'CLP', 767),
(705, 'CNY', 8),
(706, 'COP', 3626),
(707, 'CRC', 655),
(708, 'CUC', 1),
(709, 'CUP', 30),
(710, 'CVE', 110),
(711, 'CZK', 26),
(712, 'DJF', 201),
(713, 'DKK', 7),
(714, 'DOP', 58),
(715, 'DZD', 135),
(716, 'EGP', 19),
(717, 'ERN', 17),
(718, 'ETB', 33),
(719, 'EUR', 1),
(720, 'FJD', 2),
(721, 'FKP', 1),
(722, 'GBP', 1),
(723, 'GEL', 3),
(724, 'GGP', 1),
(725, 'GHS', 6),
(726, 'GIP', 1),
(727, 'GMD', 56),
(728, 'GNF', 10418),
(729, 'GTQ', 9),
(730, 'GYD', 236),
(731, 'HKD', 9),
(732, 'HNL', 28),
(733, 'HRK', 7),
(734, 'HTG', 106),
(735, 'HUF', 326),
(736, 'IDR', 15810),
(737, 'ILS', 4),
(738, 'IMP', 1),
(739, 'INR', 77),
(740, 'IQD', 1343),
(741, 'IRR', 47526),
(742, 'ISK', 142),
(743, 'JEP', 1),
(744, 'JMD', 149),
(745, 'JOD', 1),
(746, 'JPY', 122),
(747, 'KES', 116),
(748, 'KGS', 79),
(749, 'KHR', 4608),
(750, 'KMF', 494),
(751, 'KPW', 1015),
(752, 'KRW', 1329),
(753, 'KWD', 0),
(754, 'KYD', 1),
(755, 'KZT', 434),
(756, 'LAK', 9800),
(757, 'LBP', 1706),
(758, 'LKR', 199),
(759, 'LRD', 225),
(760, 'LSL', 16),
(761, 'LTL', 3),
(762, 'LVL', 1),
(763, 'LYD', 2),
(764, 'MAD', 11),
(765, 'MDL', 20),
(766, 'MGA', 4089),
(767, 'MKD', 62),
(768, 'MMK', 1705),
(769, 'MNT', 2982),
(770, 'MOP', 9),
(771, 'MRO', 403),
(772, 'MUR', 40),
(773, 'MVR', 17),
(774, 'MWK', 853),
(775, 'MXN', 21),
(776, 'MYR', 5),
(777, 'MZN', 70),
(778, 'NAD', 16),
(779, 'NGN', 406),
(780, 'NIO', 38),
(781, 'NOK', 10),
(782, 'NPR', 124),
(783, 'NZD', 2),
(784, 'OMR', 0),
(785, 'PAB', 1),
(786, 'PEN', 4),
(787, 'PGK', 4),
(788, 'PHP', 58),
(789, 'PKR', 178),
(790, 'PLN', 4),
(791, 'PYG', 6818),
(792, 'QAR', 4),
(793, 'RON', 5),
(794, 'RSD', 118),
(795, 'RUB', 71),
(796, 'RWF', 1032),
(797, 'SAR', 4),
(798, 'SBD', 9),
(799, 'SCR', 15),
(800, 'SDG', 51),
(801, 'SEK', 11),
(802, 'SGD', 2),
(803, 'SHP', 1),
(804, 'SLL', 10102),
(805, 'SOS', 660),
(806, 'SRD', 8),
(807, 'STD', 24337),
(808, 'SVC', 10),
(809, 'SYP', 581),
(810, 'SZL', 16),
(811, 'THB', 35),
(812, 'TJS', 11),
(813, 'TMT', 4),
(814, 'TND', 3),
(815, 'TOP', 3),
(816, 'TRY', 6),
(817, 'TTD', 8),
(818, 'TWD', 35),
(819, 'TZS', 2596),
(820, 'UAH', 29),
(821, 'UGX', 4171),
(822, 'USD', 1),
(823, 'UYU', 40),
(824, 'UZS', 9688),
(825, 'VEF', 11),
(826, 'VND', 26229),
(827, 'VUV', 129),
(828, 'WST', 3),
(829, 'XAF', 658),
(830, 'XAG', 0),
(831, 'XAU', 0),
(832, 'XCD', 3),
(833, 'XDR', 1),
(834, 'XOF', 658),
(835, 'XPF', 120),
(836, 'YER', 283),
(837, 'ZAR', 16),
(838, 'ZMK', 10160),
(839, 'ZMW', 14),
(840, 'ZWL', 363);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_name`, `setting_value`) VALUES
(1, 'master_key', '23f8dae3852859564f3c75425375ab1e2def1de1');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `sent_to` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `sent_to`, `timestamp`) VALUES
(1, 1, 32, 'ali@haider.com', 1563115228);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `login_key` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verified` varchar(255) NOT NULL,
  `unique_address` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `login_key`, `email`, `verified`, `unique_address`, `currency`) VALUES
(1, 'Mudassar Islam', '184c87a246338443bc78ba0fb7ca5b11', 'ba10122e669ce153530906543b4281a2', '35561f44bf5ea9d6db9d2560e75bcb29', 'demoncious@gmail.com', '1', 'yxdz-86b1a58f7efb751b3df6bf8de7ce94f00ddab292', 'pkr');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
