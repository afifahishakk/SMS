-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 03:29 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_sms`
--
CREATE DATABASE IF NOT EXISTS `db_sms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_sms`;

-- --------------------------------------------------------

--
-- Table structure for table `academic`
--

CREATE TABLE IF NOT EXISTS `academic` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_type_id` int(11) NOT NULL,
  `BM` char(11) NOT NULL,
  `BA` char(11) NOT NULL,
  `MM` char(11) NOT NULL,
  `SN` char(11) NOT NULL,
  `SEJ` char(11) NOT NULL,
  `PQS` char(11) NOT NULL,
  `PSI` char(11) NOT NULL,
  `year` int(11) NOT NULL,
  `student_ic` varchar(55) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `academic`
--

INSERT INTO `academic` (`a_id`, `a_type_id`, `BM`, `BA`, `MM`, `SN`, `SEJ`, `PQS`, `PSI`, `year`, `student_ic`) VALUES
(1, 1, 'A', 'A+', 'A', 'A', 'B+', 'A', 'A', 2021, '081230113333'),
(2, 2, 'A+', 'A+', 'A+', 'A+', 'A+', 'A+', 'A+', 2021, '081230113333');

-- --------------------------------------------------------

--
-- Table structure for table `academic_type`
--

CREATE TABLE IF NOT EXISTS `academic_type` (
  `a_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_type` varchar(55) NOT NULL,
  PRIMARY KEY (`a_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `academic_type`
--

INSERT INTO `academic_type` (`a_type_id`, `a_type`) VALUES
(1, 'Penilaian Peperiksaan 1'),
(2, 'Peperiksaan Pertengahan Tahun'),
(3, 'Peperiksaan Percubaan'),
(4, 'Peperiksaan Akhir Tahun');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(55) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `gender_id` char(11) NOT NULL,
  `photo` text NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `marriage_status` varchar(55) NOT NULL,
  `salary` decimal(11,2) NOT NULL,
  `ic_no` varchar(55) NOT NULL,
  `ic_attachment` text NOT NULL,
  `spouse_name` varchar(55) DEFAULT NULL,
  `spouse_email` varchar(55) DEFAULT NULL,
  `spouse_phone` varchar(55) DEFAULT NULL,
  `spouse_occupation` varchar(55) DEFAULT NULL,
  `spouse_workplace_address` text,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `name`, `email`, `phone`, `gender_id`, `photo`, `nationality_id`, `address`, `marriage_status`, `salary`, `ic_no`, `ic_attachment`, `spouse_name`, `spouse_email`, `spouse_phone`, `spouse_occupation`, `spouse_workplace_address`) VALUES
('admin', 'Aliah Afifah', 'aliah@gmail.com', '0122022202', 'F', 'face23.jpg', 1, '--', 'Single', '3500.00', '12345', 'ic-test.jpg', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `announcement_id` varchar(55) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `announcement_date` date NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `title`, `description`, `announcement_date`, `image`) VALUES
('ANCMT00001', 'Solat Hajat', 'some description of Solat Hajat will be placed here.  some description of Solat Hajat will be placed here.  some description of Solat Hajat will be placed here.  ', '2021-02-01', 'flat-character-moslem-male-sit-pray_2482-321.jpg'),
('ANCMT00002', 'Sambutan Berbuka Puasa', 'some description of Sambutan Berbuka Puasawill be placed here.  some description of Sambutan Berbuka Puasawill be placed here.  some description of Sambutan Berbuka Puasawill be placed here.  ', '2021-02-02', 'ramadhan-kareem-greeting-design-with-mosque-background_86707-13.jpg'),
('ANCMT00003', 'Mencari Malam Lailatul Qadr', 'some description of Mencari Malam Lailatul Qadr will be placed here.  some description of Mencari Malam Lailatul Qadr will be placed here.  some description of Mencari Malam Lailatul Qadr will be placed here.  ', '2021-02-01', 'marhaban-ya-ramadhan-greeeting-poster_43605-1634.jpg'),
('ANCMT00004', 'Sambutan Aidilfitri', 'some description of Sambutan Aidilfitri will be placed here.  some description of Sambutan Aidilfitri will be placed here.  some description of Sambutan Aidilfitri will be placed here.  ', '2021-02-01', 'cresent-decorative-eid-mubarak-moon-design_1017-13355.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(55) NOT NULL,
  `nationality_id` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country`, `nationality_id`) VALUES
(1, 'Afghanistan', 2),
(2, 'Albania', 2),
(3, 'Algeria', 2),
(4, 'American Samoa', 2),
(5, 'Andorra', 2),
(6, 'Angola', 2),
(7, 'Anguilla', 2),
(8, 'Antigua & Barbuda', 2),
(9, 'Argentina', 2),
(10, 'Armenia', 2),
(11, 'Aruba', 2),
(12, 'Australia', 2),
(13, 'Austria', 2),
(14, 'Azerbaijan', 2),
(15, 'Bahamas', 2),
(16, 'Bahrain', 2),
(17, 'Bangladesh', 2),
(18, 'Barbados', 2),
(19, 'Belarus', 2),
(20, 'Belgium', 2),
(21, 'Belize', 2),
(22, 'Benin', 2),
(23, 'Bermuda', 2),
(24, 'Bhutan', 2),
(25, 'Bolivia', 2),
(26, 'Bonaire', 2),
(27, 'Bosnia & Herzegovina', 2),
(28, 'Botswana', 2),
(29, 'Brazil', 2),
(30, 'British Indian Ocean Ter', 2),
(31, 'Brunei', 2),
(32, 'Bulgaria', 2),
(33, 'Burkina Faso', 2),
(34, 'Burundi', 2),
(35, 'Cambodia', 2),
(36, 'Cameroon', 2),
(37, 'Canada', 2),
(38, 'Canary Islands', 2),
(39, 'Cape Verde', 2),
(40, 'Cayman Islands', 2),
(41, 'Central African Republic', 2),
(42, 'Chad', 2),
(43, 'Channel Islands', 2),
(44, 'Chile', 2),
(45, 'China', 2),
(46, 'Christmas Island', 2),
(47, 'Cocos Island', 2),
(48, 'Colombia', 2),
(49, 'Comoros', 2),
(50, 'Congo', 2),
(51, 'Cook Islands', 2),
(52, 'Costa Rica', 2),
(53, 'Cote DIvoire', 2),
(54, 'Croatia', 2),
(55, 'Cuba', 2),
(56, 'Curacao', 2),
(57, 'Cyprus', 2),
(58, 'Czech Republic', 2),
(59, 'Denmark', 2),
(60, 'Djibouti', 2),
(61, 'Dominica', 2),
(62, 'Dominican Republic', 2),
(63, 'East Timor', 2),
(64, 'Ecuador', 2),
(65, 'Egypt', 2),
(66, 'El Salvador', 2),
(67, 'Equatorial Guinea', 2),
(68, 'Eritrea', 2),
(69, 'Estonia', 2),
(70, 'Ethiopia', 2),
(71, 'Falkland Islands', 2),
(72, 'Faroe Islands', 2),
(73, 'Fiji', 2),
(74, 'Finland', 2),
(75, 'France', 2),
(76, 'French Guiana', 2),
(77, 'French Polynesia', 2),
(78, 'French Southern Ter', 2),
(79, 'Gabon', 2),
(80, 'Gambia', 2),
(81, 'Georgia', 2),
(82, 'Germany', 2),
(83, 'Ghana', 2),
(84, 'Gibraltar', 2),
(85, 'Great Britain', 2),
(86, 'Greece', 2),
(87, 'Greenland', 2),
(88, 'Grenada', 2),
(89, 'Guadeloupe', 2),
(90, 'Guam', 2),
(91, 'Guatemala', 2),
(92, 'Guinea', 2),
(93, 'Guyana', 2),
(94, 'Haiti', 2),
(95, 'Hawaii', 2),
(96, 'Honduras', 2),
(97, 'Hong Kong', 2),
(98, 'Hungary', 2),
(99, 'Iceland', 2),
(100, 'Indonesia', 2),
(101, 'India', 2),
(102, 'Iran', 2),
(103, 'Iraq', 2),
(104, 'Ireland', 2),
(105, 'Isle of Man', 2),
(106, 'Israel', 2),
(107, 'Italy', 2),
(108, 'Jamaica', 2),
(109, 'Japan', 2),
(110, 'Jordan', 2),
(111, 'Kazakhstan', 2),
(112, 'Kenya', 2),
(113, 'Kiribati', 2),
(114, 'Korea North', 2),
(115, 'Korea South', 2),
(116, 'Kuwait', 2),
(117, 'Kyrgyzstan', 2),
(118, 'Laos', 2),
(119, 'Latvia', 2),
(120, 'Lebanon', 2),
(121, 'Lesotho', 2),
(122, 'Liberia', 2),
(123, 'Libya', 2),
(124, 'Liechtenstein', 2),
(125, 'Lithuania', 2),
(126, 'Luxembourg', 2),
(127, 'Macau', 2),
(128, 'Macedonia', 2),
(129, 'Madagascar', 2),
(130, 'Malaysia', 1),
(131, 'Malawi', 2),
(132, 'Maldives', 2),
(133, 'Mali', 2),
(134, 'Malta', 2),
(135, 'Marshall Islands', 2),
(136, 'Martinique', 2),
(137, 'Mauritania', 2),
(138, 'Mauritius', 2),
(139, 'Mayotte', 2),
(140, 'Mexico', 2),
(141, 'Midway Islands', 2),
(142, 'Moldova', 2),
(143, 'Monaco', 2),
(144, 'Mongolia', 2),
(145, 'Montserrat', 2),
(146, 'Morocco', 2),
(147, 'Mozambique', 2),
(148, 'Myanmar', 2),
(149, 'Nambia', 2),
(150, 'Nauru', 2),
(151, 'Nepal', 2),
(152, 'Netherland Antilles', 2),
(153, 'Netherlands (Holland, Europe)', 2),
(154, 'Nevis', 2),
(155, 'New Caledonia', 2),
(156, 'New Zealand', 2),
(157, 'Nicaragua', 2),
(158, 'Niger', 2),
(159, 'Nigeria', 2),
(160, 'Niue', 2),
(161, 'Norfolk Island', 2),
(162, 'Norway', 2),
(163, 'Oman', 2),
(164, 'Pakistan', 2),
(165, 'Palau Island', 2),
(166, 'Palestine', 2),
(167, 'Panama', 2),
(168, 'Papua New Guinea', 2),
(169, 'Paraguay', 2),
(170, 'Peru', 2),
(171, 'Philippines', 2),
(172, 'Pitcairn Island', 2),
(173, 'Poland', 2),
(174, 'Portugal', 2),
(175, 'Puerto Rico', 2),
(176, 'Qatar', 2),
(177, 'Republic of Montenegro', 2),
(178, 'Republic of Serbia', 2),
(179, 'Reunion', 2),
(180, 'Romania', 2),
(181, 'Russia', 2),
(182, 'Rwanda', 2),
(183, 'St Barthelemy', 2),
(184, 'St Eustatius', 2),
(185, 'St Helena', 2),
(186, 'St Kitts-Nevis', 2),
(187, 'St Lucia', 2),
(188, 'St Maarten', 2),
(189, 'St Pierre & Miquelon', 2),
(190, 'St Vincent & Grenadines', 2),
(191, 'Saipan', 2),
(192, 'Samoa', 2),
(193, 'Samoa American', 2),
(194, 'San Marino', 2),
(195, 'Sao Tome & Principe', 2),
(196, 'Saudi Arabia', 2),
(197, 'Senegal', 2),
(198, 'Seychelles', 2),
(199, 'Sierra Leone', 2),
(200, 'Singapore', 2),
(201, 'Slovakia', 2),
(202, 'Slovenia', 2),
(203, 'Solomon Islands', 2),
(204, 'Somalia', 2),
(205, 'South Africa', 2),
(206, 'Spain', 2),
(207, 'Sri Lanka', 2),
(208, 'Sudan', 2),
(209, 'Suriname', 2),
(210, 'Swaziland', 2),
(211, 'Sweden', 2),
(212, 'Switzerland', 2),
(213, 'Syria', 2),
(214, 'Tahiti', 2),
(215, 'Taiwan', 2),
(216, 'Tajikistan', 2),
(217, 'Tanzania', 2),
(218, 'Thailand', 2),
(219, 'Togo', 2),
(220, 'Tokelau', 2),
(221, 'Tonga', 2),
(222, 'Trinidad & Tobago', 2),
(223, 'Tunisia', 2),
(224, 'Turkey', 2),
(225, 'Turkmenistan', 2),
(226, 'Turks & Caicos Is', 2),
(227, 'Tuvalu', 2),
(228, 'Uganda', 2),
(229, 'United Kingdom', 2),
(230, 'Ukraine', 2),
(231, 'United Arab Emirates', 2),
(232, 'United States of America', 2),
(233, 'Uruguay', 2),
(234, 'Uzbekistan', 2),
(235, 'Vanuatu', 2),
(236, 'Vatican City State', 2),
(237, 'Venezuela', 2),
(238, 'Vietnam', 2),
(239, 'Virgin Islands (Brit)', 2),
(240, 'Virgin Islands (USA)', 2),
(241, 'Wake Island', 2),
(242, 'Wallis & Futana Is', 2),
(243, 'Yemen', 2),
(244, 'Zaire', 2),
(245, 'Zambia', 2),
(246, 'Zimbabwe', 2);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE IF NOT EXISTS `enrollment` (
  `ic` varchar(55) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `gender_id` char(11) NOT NULL,
  `photo` text NOT NULL,
  `address` text NOT NULL,
  `ic_copy` text NOT NULL,
  `purpose` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'Processing',
  `parent` varchar(55) NOT NULL,
  PRIMARY KEY (`ic`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`ic`, `name`, `dob`, `nationality_id`, `country_id`, `gender_id`, `photo`, `address`, `ic_copy`, `purpose`, `status`, `parent`) VALUES
('081230113333', 'Imran', '2021-04-13', 1, 130, 'M', 'blogtamsu-cooper-laude-2.jpg', 'No 47 Taman Setia Indah. ', 'ic-imran.jpg', 'Both', 'Approved', 'ahmad'),
('081230114444', 'Nur Yasmin', '2012-03-01', 1, 130, 'F', 'face5.jpg', 'no 7 jalan mesra ', 'ic yasmin.jpg', 'Both', 'Approved', 'ahmad'),
('081230115553', 'Ahmad Amirul', '2021-05-09', 1, 130, 'M', 'face7.jpg', 'no 18 jalan sepertiga malam', 'ic-test.jpg', 'SPM', 'Approved', 'ahmad'),
('081230115555', 'Ahmad Ilham', '2021-02-01', 1, 130, 'M', 'cooper-loveliest-baby-boy-makes-everyone-melted-4b25cc0b.jpg', 'No 47 Taman Setia Indah. ', 'ic-ilham.jpg', 'SPM', 'Approved', 'hafiz'),
('1812027777', 'Amirul Mukminin', '2021-05-18', 1, 130, 'M', 'face15.jpg', 'alamat amirul mukminin dekat mana', 'ic-test.jpg', 'Tahfiz', 'Processing', 'ahmad');

-- --------------------------------------------------------

--
-- Table structure for table `fee_category`
--

CREATE TABLE IF NOT EXISTS `fee_category` (
  `fee_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_category` varchar(55) NOT NULL,
  PRIMARY KEY (`fee_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fee_category`
--

INSERT INTO `fee_category` (`fee_category_id`, `fee_category`) VALUES
(1, 'Keperluan Asas'),
(2, 'Keperluan Pelajar Lelaki'),
(3, 'Keperluan Pelajar Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
  `gender_id` char(11) NOT NULL,
  `gender` varchar(55) NOT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender`) VALUES
('F', 'Female'),
('M', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `hafazan`
--

CREATE TABLE IF NOT EXISTS `hafazan` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `day` varchar(55) NOT NULL,
  `day_position` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `month` char(11) NOT NULL,
  `year` int(11) NOT NULL,
  `talaqi_start_juz` varchar(55) NOT NULL,
  `talaqi_start_surah` varchar(55) NOT NULL,
  `talaqi_start_halaman` varchar(55) NOT NULL,
  `talaqi_end_juz` varchar(55) NOT NULL,
  `talaqi_end_surah` varchar(55) NOT NULL,
  `talaqi_end_halaman` varchar(55) NOT NULL,
  `hafazan_start_juz` varchar(55) NOT NULL,
  `hafazan_start_surah` varchar(55) NOT NULL,
  `hafazan_start_halaman` varchar(55) NOT NULL,
  `hafazan_end_juz` varchar(55) NOT NULL,
  `hafazan_end_surah` varchar(55) NOT NULL,
  `hafazan_end_halaman` varchar(55) NOT NULL,
  `ulangan_baru_start_juz` varchar(55) NOT NULL,
  `ulangan_baru_start_surah` varchar(55) NOT NULL,
  `ulangan_baru_start_halaman` varchar(55) NOT NULL,
  `ulangan_baru_end_juz` varchar(55) NOT NULL,
  `ulangan_baru_end_surah` varchar(55) NOT NULL,
  `ulangan_baru_end_halaman` varchar(55) NOT NULL,
  `ulangan_lama_start_juz` varchar(55) NOT NULL,
  `ulangan_lama_start_surah` varchar(55) NOT NULL,
  `ulangan_lama_start_halaman` varchar(55) NOT NULL,
  `ulangan_lama_end_juz` varchar(55) NOT NULL,
  `ulangan_lama_end_surah` varchar(55) NOT NULL,
  `ulangan_lama_end_halaman` varchar(55) NOT NULL,
  `remark` text NOT NULL,
  `student_ic` varchar(55) NOT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `hafazan`
--

INSERT INTO `hafazan` (`h_id`, `date`, `day`, `day_position`, `week`, `month`, `year`, `talaqi_start_juz`, `talaqi_start_surah`, `talaqi_start_halaman`, `talaqi_end_juz`, `talaqi_end_surah`, `talaqi_end_halaman`, `hafazan_start_juz`, `hafazan_start_surah`, `hafazan_start_halaman`, `hafazan_end_juz`, `hafazan_end_surah`, `hafazan_end_halaman`, `ulangan_baru_start_juz`, `ulangan_baru_start_surah`, `ulangan_baru_start_halaman`, `ulangan_baru_end_juz`, `ulangan_baru_end_surah`, `ulangan_baru_end_halaman`, `ulangan_lama_start_juz`, `ulangan_lama_start_surah`, `ulangan_lama_start_halaman`, `ulangan_lama_end_juz`, `ulangan_lama_end_surah`, `ulangan_lama_end_halaman`, `remark`, `student_ic`) VALUES
(11, '2021-05-17', 'Mon', 2, 3, 'May', 2021, 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'mon', 'remark for monday', '081230113333'),
(12, '2021-05-16', 'Sun', 1, 3, 'May', 2021, 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sun', 'sunsun', 'sun', 'sun', 'sun', 'sun', 'sun', 'remark for sun', '081230113333'),
(13, '2021-05-19', 'Wed', 4, 3, 'May', 2021, 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'wed', 'remark for wed', '081230113333'),
(14, '2021-05-18', 'Tue', 3, 3, 'May', 2021, 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'qtue', 'tue', 'tue', 'tue', 'tue', 'tue', 'tue', 'reamark for tuseday', '081230113333'),
(15, '2021-05-20', 'Thu', 5, 3, 'May', 2021, 'thu', 'thu', 'thu', 'thu', 'thu', 'thu', 'thu', 'thu', 'thu', 'qvthu', 'thu', 'thu', 'thu', 'thu', 'thu', 'thuthu', 'thu', 'thu', 'thu', 'thu', 'vthu', 'thu', 'thu', 'thu', 'remark for thursday', '081230113333'),
(16, '2021-05-21', 'Fri', 6, 3, 'May', 2021, 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'v', 'v', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'fri', 'remark for friday', '081230113333'),
(17, '2021-05-17', 'Mon', 2, 3, 'May', 2021, 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'monday yasmin', 'remark for monday yasmin', '081230114444');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `UserID` varchar(50) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `UserLvl` int(11) NOT NULL DEFAULT '4',
  `Status` varchar(55) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserID`, `Password`, `UserLvl`, `Status`) VALUES
('admin', 'admin', 1, 'Active'),
('ahmad', 'ahmad', 4, 'Active'),
('hafiz', 'hafiz', 4, 'Active'),
('nadia', 'nadia', 2, 'Active'),
('suhaila', 'suhaila', 2, 'Active'),
('wahida', 'wahida', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_fee`
--

CREATE TABLE IF NOT EXISTS `monthly_fee` (
  `m_fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `fee` decimal(11,2) NOT NULL,
  PRIMARY KEY (`m_fee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `monthly_fee`
--

INSERT INTO `monthly_fee` (`m_fee_id`, `year`, `fee`) VALUES
(1, 2021, '250.00');

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE IF NOT EXISTS `nationality` (
  `nationality_id` int(11) NOT NULL AUTO_INCREMENT,
  `nationality` varchar(55) NOT NULL,
  PRIMARY KEY (`nationality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`nationality_id`, `nationality`) VALUES
(1, 'Citizen'),
(2, 'Non-Citizen');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
  `username` varchar(55) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender_id` char(11) NOT NULL,
  `phone_no` varchar(22) NOT NULL,
  `email` varchar(55) NOT NULL,
  `photo` text NOT NULL,
  `address` text NOT NULL,
  `occupation` varchar(55) NOT NULL,
  `salary` decimal(11,2) NOT NULL,
  `relationship_id` int(11) NOT NULL,
  `ic_attachment` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`username`, `name`, `gender_id`, `phone_no`, `email`, `photo`, `address`, `occupation`, `salary`, `relationship_id`, `ic_attachment`) VALUES
('ahmad', 'Ahmad', 'M', '0102540290', 'ahmad@gmail.com', '9ac2b80c25d602a31fa4e531609360dd_192.jpg', 'No 7 Jalan Ke Syurga, Langit ke 7. Taman-taman Syurga.', 'freelance programmer', '3000.00', 2, 'ic-ahmad.jpg'),
('hafiz', 'Hafiz', 'M', '0199099909', 'Hafiz@gmail.com', 'face13.jpg', 'No 7 Jalan Ke Syurga, Langit ke 7. Taman-taman Syurga.', 'freelancer', '3000.00', 2, 'ic hafiz.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` varchar(55) NOT NULL,
  `payment_date` date NOT NULL,
  `student_ic` varchar(55) NOT NULL,
  `p_type_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `payment_option` varchar(55) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `paid_amount` decimal(11,2) NOT NULL,
  `balance` decimal(11,2) NOT NULL,
  `proof` text NOT NULL,
  `payment_status` varchar(55) NOT NULL DEFAULT 'Pending',
  `parent` varchar(55) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `student_ic`, `p_type_id`, `month`, `year`, `payment_option`, `amount`, `paid_amount`, `balance`, `proof`, `payment_status`, `parent`) VALUES
('PAY00001', '2021-02-01', '081230115555', 1, 0, 0, 'Cash', '0.00', '0.00', '0.00', '', 'Declined', 'hafiz'),
('PAY00002', '2021-02-01', '081230115555', 2, 2, 2021, 'Online Banking', '0.00', '0.00', '0.00', 'RM300 PAYMENT PROOF.txt', 'Declined', 'hafiz'),
('PAY00003', '0000-00-00', '081230114444', 0, 0, 0, 'Cash', '0.00', '0.00', '0.00', '', 'Pending', ''),
('PAY00004', '2021-05-17', '081230114444', 1, 0, 0, 'Cash', '210.00', '210.00', '0.00', '', 'Paid', 'ahmad'),
('PAY00005', '2021-05-17', '081230114444', 2, 5, 2021, 'Cash', '250.00', '150.00', '100.00', '', 'Partial Paid', 'ahmad'),
('PAY00006', '2021-05-18', '081230115553', 1, 0, 0, 'cash', '210.00', '100.00', '110.00', '', 'Partial Paid', 'ahmad'),
('PAY00007', '2021-05-18', '081230115553', 2, 5, 2021, 'cash', '250.00', '100.00', '150.00', '', 'Partial Paid', 'ahmad');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE IF NOT EXISTS `payment_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(55) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`status_id`, `status`) VALUES
(1, 'Pending'),
(2, 'Declined'),
(3, 'Partial Paid'),
(4, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE IF NOT EXISTS `performance` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_ic` varchar(55) NOT NULL,
  `hafazan` varchar(55) NOT NULL,
  `exam` varchar(55) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `performance`
--

INSERT INTO `performance` (`p_id`, `student_ic`, `hafazan`, `exam`) VALUES
(3, '081230115555', 'Cemerlang', '5A');

-- --------------------------------------------------------

--
-- Table structure for table `registration_fee`
--

CREATE TABLE IF NOT EXISTS `registration_fee` (
  `r_fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_category_id` int(11) NOT NULL,
  `fee_type` varchar(55) NOT NULL,
  `fee` decimal(11,2) NOT NULL,
  PRIMARY KEY (`r_fee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `registration_fee`
--

INSERT INTO `registration_fee` (`r_fee_id`, `fee_category_id`, `fee_type`, `fee`) VALUES
(1, 1, 'Yuran Pendaftaran', '100.00'),
(3, 2, 'Cadar', '25.00'),
(4, 2, 'Kain Jubah Coklat', '30.00'),
(5, 3, 'Cadar', '25.00'),
(6, 3, 'Kain Jubah Coklat (Untuk pengajian sahaja)', '30.00');

-- --------------------------------------------------------

--
-- Table structure for table `registration_status`
--

CREATE TABLE IF NOT EXISTS `registration_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(55) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `registration_status`
--

INSERT INTO `registration_status` (`status_id`, `status`) VALUES
(1, 'Processing'),
(2, 'Rejected'),
(3, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
  `relationship_id` int(11) NOT NULL AUTO_INCREMENT,
  `relationship` varchar(55) NOT NULL,
  PRIMARY KEY (`relationship_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`relationship_id`, `relationship`) VALUES
(1, 'Grandparents'),
(2, 'Parent'),
(3, 'Uncle'),
(4, 'Aunt'),
(5, 'Guardian');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `username` varchar(55) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `gender_id` char(11) NOT NULL,
  `photo` text NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL,
  `address` text NOT NULL,
  `marriage_status` varchar(55) NOT NULL,
  `salary` decimal(11,2) NOT NULL,
  `ic_no` varchar(55) NOT NULL,
  `ic_attachment` text NOT NULL,
  `spouse_name` varchar(55) DEFAULT NULL,
  `spouse_email` varchar(55) DEFAULT NULL,
  `spouse_phone` varchar(55) DEFAULT NULL,
  `spouse_occupation` varchar(55) DEFAULT NULL,
  `spouse_workplace_address` text,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`username`, `name`, `email`, `phone`, `gender_id`, `photo`, `nationality_id`, `type`, `address`, `marriage_status`, `salary`, `ic_no`, `ic_attachment`, `spouse_name`, `spouse_email`, `spouse_phone`, `spouse_occupation`, `spouse_workplace_address`) VALUES
('nadia', 'Nur Nadia', 'nadia@gmail.com', '0188088808', 'F', 'face26.jpg', 1, 'Tahfiz', 'no 7 jalan sesuci debu shah alam', 'single', '2500.00', '881230119999', 'ic-nadia.jpg', 'Nazim', 'nazim@gmail.com', '0133033303', 'Programmer', 'No 21 Jalan Pegawai '),
('suhaila', 'Siti Suhaila', 'suhaila@gmail.com', '0133033303', 'F', 'face2.jpg', 1, 'Academic', 'no 57 taman setia alam shah alam', 'married', '2500.00', '881230117777', 'ic suhaila.jpg', 'suhaimi', 'suhaimi@gmail.com', '0133303003', 'programmer', 'lot 9 jalan maju jaya shah alam'),
('wahida', 'Nurul Wahida', 'wahida@gmail.com', '0133033303', 'F', 'face5.jpg', 2, 'Academic', 'no 77 jalan murni shah alam', 'single mother', '2500.00', '8812306666', 'ic wahida.jpg', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
