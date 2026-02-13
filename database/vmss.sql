-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 24, 2024 at 12:07 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `akagoroba`
--

DROP TABLE IF EXISTS `akagoroba`;
CREATE TABLE IF NOT EXISTS `akagoroba` (
  `a_id` bigint(200) NOT NULL,
  `v_id` int(11) NOT NULL,
  `place` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `a_day` int(5) NOT NULL,
  `a_month` varchar(30) NOT NULL,
  `a_year` int(5) NOT NULL,
  PRIMARY KEY (`a_id`),
  KEY `v_id` (`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akagoroba`
--

INSERT INTO `akagoroba` (`a_id`, `v_id`, `place`, `description`, `a_day`, `a_month`, `a_year`) VALUES
(1, 44, 'Miduha', 'Imirire myiza', 18, 'October', 2022),
(2, 45, 'Miduha', 'gukubura', 18, 'October', 2021),
(3, 45, 'Kumunigo', 'Imyitwarire mu ngo', 13, 'November', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `cell_table`
--

DROP TABLE IF EXISTS `cell_table`;
CREATE TABLE IF NOT EXISTS `cell_table` (
  `cell_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `cell` varchar(200) NOT NULL,
  PRIMARY KEY (`cell_id`),
  KEY `d_id` (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cell_table`
--

INSERT INTO `cell_table` (`cell_id`, `s_id`, `cell`) VALUES
(24, 1, 'Cyimo'),
(25, 2, 'Rugarama');

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

DROP TABLE IF EXISTS `citizen`;
CREATE TABLE IF NOT EXISTS `citizen` (
  `c_id` bigint(200) NOT NULL,
  `i_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `age` varchar(50) NOT NULL,
  `nationality` varchar(200) NOT NULL,
  `martial_status` varchar(200) NOT NULL,
  `nbr_in_house` int(50) NOT NULL,
  `abana_biga` int(29) NOT NULL,
  `work_type` varchar(200) NOT NULL,
  `medical_ins` varchar(200) NOT NULL,
  `land_pr` varchar(200) NOT NULL,
  `reg_day` int(30) NOT NULL,
  `reg_month` varchar(30) NOT NULL,
  `reg_year` int(11) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `i_id` (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`c_id`, `i_id`, `fname`, `phone`, `gender`, `age`, `nationality`, `martial_status`, `nbr_in_house`, `abana_biga`, `work_type`, `medical_ins`, `land_pr`, `reg_day`, `reg_month`, `reg_year`) VALUES
(17, 21, 'Kajeguhakwa Claude', 788667095, 'Male', '50-70', 'Rwandan', 'Married', 8, 3, 'Akorera leta', 'RAMA', 'Aratuye', 17, 'October', 2018),
(18, 21, 'Muhimpundu Alexia', 786907095, 'Female', '30-50', 'Rwandan', 'Widow / Widower', 3, 0, 'Arikorera', 'RAMA', 'Aratuye', 6, 'January', 2013),
(19, 21, 'Akimana Claudette', 788807652, 'Female', '30-50', 'Rwandan', 'Divorced', 4, 2, 'Akorera leta', 'MMI', 'Aratuye', 14, 'November', 2023),
(20, 22, 'Nganguje Ramadthan', 788548709, 'Male', '30-50', 'Rwandan', 'Married', 5, 3, 'Arikorera', 'Izindi', 'Aratuye', 30, 'October', 2017),
(21, 22, 'Karake Faustin', 783986163, 'Male', '30-50', 'Rwandan', 'Divorced', 2, 0, 'Arikorera', 'Mituweli', 'Arakodesha', 23, 'July', 2014),
(22, 23, 'Ndayizeye Pascal', 788654631, 'Male', '30-50', 'Rwandan', 'Married', 8, 5, 'Akorera leta', 'Mituweli', 'Aratuye', 17, 'November', 2022),
(23, 29, 'Karangwa Die Donne', 790603443, 'Male', '50-70', 'Rwandan', 'Married', 8, 5, 'Akorera leta', 'MMI', 'Aratuye', 17, 'November', 2023),
(86410503868, 8, 'Bizimana Eric', 791387285, 'Male', '30-50', 'Rwanda', 'Single', 2, 0, 'Akorera leta', 'RAMA', 'Aratuye', 13, 'October', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `district` varchar(100) NOT NULL,
  PRIMARY KEY (`d_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`d_id`, `p_id`, `district`) VALUES
(6, 1, 'Kicukiro'),
(7, 1, 'Nyarugenge'),
(8, 1, 'Gasabo');

-- --------------------------------------------------------

--
-- Table structure for table `exective`
--

DROP TABLE IF EXISTS `exective`;
CREATE TABLE IF NOT EXISTS `exective` (
  `e_id` bigint(200) NOT NULL,
  `cell_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `id_num` bigint(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`e_id`),
  KEY `v_id` (`cell_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exective`
--

INSERT INTO `exective` (`e_id`, `cell_id`, `fullname`, `email`, `contact`, `id_num`, `password`) VALUES
(5816967, 24, 'Rudahigwa Loic', 'rudahigwaloic@gmail.com', 790603443, 1200280002597063, 'king');

-- --------------------------------------------------------

--
-- Table structure for table `irondo`
--

DROP TABLE IF EXISTS `irondo`;
CREATE TABLE IF NOT EXISTS `irondo` (
  `id` bigint(200) NOT NULL,
  `v_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `contact` bigint(50) NOT NULL,
  `id_number` bigint(20) NOT NULL,
  `i_day` int(5) NOT NULL,
  `i_month` varchar(10) NOT NULL,
  `i_year` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `v_id` (`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `irondo`
--

INSERT INTO `irondo` (`id`, `v_id`, `fname`, `contact`, `id_number`, `i_day`, `i_month`, `i_year`) VALUES
(3, 45, 'Hakorimana Celestin', 787787483, 1200280002597067, 11, 'October', 2021),
(4, 45, 'kabera Gabin', 790603440, 1200280002597066, 18, 'November', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `isibo`
--

DROP TABLE IF EXISTS `isibo`;
CREATE TABLE IF NOT EXISTS `isibo` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_id` int(11) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  PRIMARY KEY (`i_id`),
  KEY `v_id` (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `isibo`
--

INSERT INTO `isibo` (`i_id`, `v_id`, `i_name`) VALUES
(7, 44, 'Ubunyarwanda'),
(8, 44, 'UBUNYANGAMUGAYO'),
(9, 44, 'GUKUNDA IGIHUGU'),
(10, 44, 'ICYEREKEZO'),
(11, 44, 'UBUTWARI'),
(12, 44, 'UBWITANGE'),
(13, 44, 'KWIHESHA AGACIRO'),
(14, 44, 'GUKUNDA UMURIMO 1'),
(15, 44, 'INDAHANGARWA'),
(16, 44, 'URUGERERO'),
(17, 44, 'IMBANZARUGAMBA'),
(18, 44, 'INDANGAMIRWA'),
(19, 44, 'IMENA'),
(20, 44, 'IMANZI'),
(21, 45, 'UBUNYARWANDA'),
(22, 45, 'ICYEREKEZO'),
(23, 45, 'GUKUNDA IGIHUGU'),
(24, 45, 'UBWITANGE'),
(25, 45, 'UBUTWARI'),
(26, 45, 'URUGERERO'),
(27, 45, 'UBUNYANGAMUGAYO'),
(29, 56, 'GUKUNDA IGIHUGU');

-- --------------------------------------------------------

--
-- Table structure for table `kwishyura`
--

DROP TABLE IF EXISTS `kwishyura`;
CREATE TABLE IF NOT EXISTS `kwishyura` (
  `k_id` bigint(200) NOT NULL,
  `v_id` int(11) NOT NULL,
  `c_id` bigint(110) NOT NULL,
  `amount` bigint(50) NOT NULL,
  `unity_amount` bigint(100) NOT NULL,
  `unpaid` bigint(100) NOT NULL,
  `k_day` int(5) NOT NULL,
  `k_month` varchar(30) NOT NULL,
  `k_year` int(5) NOT NULL,
  PRIMARY KEY (`k_id`),
  KEY `c_id` (`c_id`),
  KEY `c_id_2` (`c_id`),
  KEY `v_id` (`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kwishyura`
--

INSERT INTO `kwishyura` (`k_id`, `v_id`, `c_id`, `amount`, `unity_amount`, `unpaid`, `k_day`, `k_month`, `k_year`) VALUES
(2213947869038, 45, 18, 2000, 2000, 0, 10, 'June', 2017),
(5400831731725187, 45, 18, 1000, 2000, 1000, 12, 'January', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `leave_citizen`
--

DROP TABLE IF EXISTS `leave_citizen`;
CREATE TABLE IF NOT EXISTS `leave_citizen` (
  `l_id` bigint(200) NOT NULL,
  `i_id` int(30) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `phone` bigint(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `reg_day` int(5) NOT NULL,
  `reg_month` varchar(20) NOT NULL,
  `reg_year` int(30) NOT NULL,
  PRIMARY KEY (`l_id`),
  KEY `i_id` (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_citizen`
--

INSERT INTO `leave_citizen` (`l_id`, `i_id`, `fname`, `phone`, `gender`, `reg_day`, `reg_month`, `reg_year`) VALUES
(1, 8, 'Ngendahimana Claude', 788663801, 'Male', 19, 'March', 2012),
(4, 8, 'Kabuga Celestin', 788857902, 'Female', 15, 'November', 2022),
(5, 7, 'Mucunguzi Die donne', 786697874, 'Male', 19, 'November', 2024),
(6335118602662146, 8, 'Karangwa Juvenal', 788657686, 'Male', 16, 'August', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `mudugudu`
--

DROP TABLE IF EXISTS `mudugudu`;
CREATE TABLE IF NOT EXISTS `mudugudu` (
  `m_id` bigint(200) NOT NULL,
  `v_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phones` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `id_num` bigint(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `reg_date` date NOT NULL,
  PRIMARY KEY (`m_id`),
  KEY `v_id` (`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mudugudu`
--

INSERT INTO `mudugudu` (`m_id`, `v_id`, `fullname`, `phones`, `gender`, `id_num`, `password`, `reg_date`) VALUES
(51121012, 51, 'Kamanzi Faustin', 788657689, 'Male', 1200380002598187, '12324', '2024-01-31'),
(487198312, 45, 'Kwizera Bosco', 790603412, 'Male', 1199180074877187, '12345678', '2024-01-06'),
(33245841576, 44, 'Ntagandwa Gabins', 790603440, 'Male', 1200280002597066, '12345678', '2024-01-06'),
(42204311247, 56, 'Manzi Jospin', 790603449, 'Male', 1200280002597067, '1234', '2024-01-12'),
(828491695034530213, 47, 'Rugirangoga Janvier', 790603443, 'Male', 1200280002597063, '1234', '2024-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `mutwarasibo`
--

DROP TABLE IF EXISTS `mutwarasibo`;
CREATE TABLE IF NOT EXISTS `mutwarasibo` (
  `mut_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `phones` bigint(20) NOT NULL,
  `genders` varchar(10) NOT NULL,
  `id_num` bigint(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `reg_date` date NOT NULL,
  PRIMARY KEY (`mut_id`),
  KEY `i_id` (`i_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mutwarasibo`
--

INSERT INTO `mutwarasibo` (`mut_id`, `i_id`, `full_name`, `phones`, `genders`, `id_num`, `password`, `reg_date`) VALUES
(6, 8, 'KARIMBURA ALOYS', 788449621, 'Male', 1197080007564054, '12345678', '2023-11-30'),
(8, 7, 'KALONGIREE OLIVIER', 788524415, 'Male', 1197580027501013, '12345678', '2023-12-18'),
(9, 9, 'NKURANGA WILISON', 788580158, 'Male', 1198580007567043, '123456789', '2023-12-28'),
(10, 10, 'GAHIGI THOMAS', 783889431, 'Male', 1197880057699017, '12345678', '2023-12-28'),
(11, 21, 'MUKANSANGA FLORENCE', 786785735, 'Female', 1198370076867098, '12345678', '2024-01-04'),
(12, 22, 'GASANA VINCENT', 785194616, 'Male', 1197480074657187, '12345678', '2024-01-04'),
(13, 23, 'MURAGIJIMANA CHANTAL', 784948846, 'Female', 1197570009768076, '12345678', '2024-01-04'),
(14, 29, 'Rugirangoga Janvier', 790603449, 'Male', 1199180074877187, '1234', '2024-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(100) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`p_id`, `province`) VALUES
(1, 'Kigali city'),
(2, 'Northern province'),
(3, 'Southern Province'),
(4, 'Eastern Province'),
(5, 'Western Province');

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

DROP TABLE IF EXISTS `sector`;
CREATE TABLE IF NOT EXISTS `sector` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_id` int(11) NOT NULL,
  `sector` varchar(100) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `d_id` (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`s_id`, `d_id`, `sector`) VALUES
(1, 6, 'Masaka'),
(2, 6, 'Cyimo');

-- --------------------------------------------------------

--
-- Table structure for table `umuganda`
--

DROP TABLE IF EXISTS `umuganda`;
CREATE TABLE IF NOT EXISTS `umuganda` (
  `u_id` bigint(200) NOT NULL,
  `v_id` int(11) NOT NULL,
  `place` varchar(200) NOT NULL,
  `descriptions` varchar(250) NOT NULL,
  `u_day` int(5) NOT NULL,
  `u_month` varchar(15) NOT NULL,
  `u_year` int(5) NOT NULL,
  PRIMARY KEY (`u_id`),
  KEY `m_id` (`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `umuganda`
--

INSERT INTO `umuganda` (`u_id`, `v_id`, `place`, `descriptions`, `u_day`, `u_month`, `u_year`) VALUES
(1, 44, 'Miduha', 'Kubaka', 16, 'November', 2023),
(5, 45, 'Kumunigo', 'Guca ibigunda', 30, 'November', 2024),
(6, 56, 'Miduha', 'gutera ibiti', 17, 'November', 2024),
(9076164092, 51, 'Kumunigo', 'ghjk,', 10, 'August', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

DROP TABLE IF EXISTS `user_table`;
CREATE TABLE IF NOT EXISTS `user_table` (
  `user_id` bigint(200) NOT NULL,
  `d_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contacts` bigint(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `reg_date` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `d_id`, `full_name`, `email`, `contacts`, `password`, `reg_date`) VALUES
(1124703691725832987, 6, 'Rudahigwa Loic', 'rudahigwaloic@gmail.com', 790603443, 'king', '2024-01-08');

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

DROP TABLE IF EXISTS `village`;
CREATE TABLE IF NOT EXISTS `village` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `cell_id` int(11) NOT NULL,
  `village` varchar(50) NOT NULL,
  PRIMARY KEY (`v_id`),
  KEY `cell_id` (`cell_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`v_id`, `cell_id`, `village`) VALUES
(44, 24, 'Masaka'),
(45, 24, 'Cyimo'),
(47, 24, 'Nyakagunga'),
(49, 24, 'Urugwiro'),
(50, 24, 'Kiyovu'),
(51, 24, 'Murambi'),
(52, 24, 'Kabeza'),
(56, 25, 'Kagarama');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cell_table`
--
ALTER TABLE `cell_table`
  ADD CONSTRAINT `cell_table_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `sector` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `citizen`
--
ALTER TABLE `citizen`
  ADD CONSTRAINT `citizen_ibfk_1` FOREIGN KEY (`i_id`) REFERENCES `isibo` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `province` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exective`
--
ALTER TABLE `exective`
  ADD CONSTRAINT `exective_ibfk_1` FOREIGN KEY (`cell_id`) REFERENCES `cell_table` (`cell_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `irondo`
--
ALTER TABLE `irondo`
  ADD CONSTRAINT `irondo_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `village` (`v_id`);

--
-- Constraints for table `isibo`
--
ALTER TABLE `isibo`
  ADD CONSTRAINT `isibo_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `village` (`v_id`);

--
-- Constraints for table `mudugudu`
--
ALTER TABLE `mudugudu`
  ADD CONSTRAINT `mudugudu_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `village` (`v_id`);

--
-- Constraints for table `mutwarasibo`
--
ALTER TABLE `mutwarasibo`
  ADD CONSTRAINT `mutwarasibo_ibfk_1` FOREIGN KEY (`i_id`) REFERENCES `isibo` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sector`
--
ALTER TABLE `sector`
  ADD CONSTRAINT `sector_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `district` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `umuganda`
--
ALTER TABLE `umuganda`
  ADD CONSTRAINT `umuganda_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `village` (`v_id`);

--
-- Constraints for table `village`
--
ALTER TABLE `village`
  ADD CONSTRAINT `village_ibfk_1` FOREIGN KEY (`cell_id`) REFERENCES `cell_table` (`cell_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
