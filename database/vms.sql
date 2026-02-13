-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 11:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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

CREATE TABLE `akagoroba` (
  `a_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `place` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `a_day` int(5) NOT NULL,
  `a_month` varchar(30) NOT NULL,
  `a_year` int(5) NOT NULL
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

CREATE TABLE `cell_table` (
  `cell_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `cell` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `citizen` (
  `c_id` int(11) NOT NULL,
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
  `reg_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`c_id`, `i_id`, `fname`, `phone`, `gender`, `age`, `nationality`, `martial_status`, `nbr_in_house`, `abana_biga`, `work_type`, `medical_ins`, `land_pr`, `reg_day`, `reg_month`, `reg_year`) VALUES
(11, 8, 'Manzi Jospin', 7856797842, 'Male', '30-50', 'Rwandan', 'Married', 4, 2, 'Arikorera', 'Mituweli', 'Aratuye', 12, 'April', 2020),
(13, 8, 'Kamanzi Faustin', 788607912, 'Male', '30-50', 'Rwandan', 'Married', 5, 2, 'Ntakazi agira', 'Mituweli', 'Arakodesha', 26, 'June', 2015),
(14, 7, 'Ngarambe Jean Claude', 788983443, 'Male', '30-50', 'Rwandan', 'Married', 8, 3, 'Akorera leta', 'MMI', 'Aratuye', 10, 'October', 2014),
(15, 7, 'Karangwa Fabrice', 790603447, 'Male', '50-70', 'Rwandan', 'Married', 4, 1, 'Akorera abandi', 'RAMA', 'Arakodesha', 24, 'April', 2018),
(17, 21, 'Kajeguhakwa Claude', 788667095, 'Male', '50-70', 'Rwandan', 'Married', 8, 3, 'Akorera leta', 'RAMA', 'Aratuye', 17, 'October', 2018),
(18, 21, 'Muhimpundu Alexia', 786907095, 'Female', '30-50', 'Rwandan', 'Widow / Widower', 3, 0, 'Arikorera', 'RAMA', 'Aratuye', 6, 'January', 2013),
(19, 21, 'Akimana Claudette', 788807652, 'Female', '30-50', 'Rwandan', 'Divorced', 4, 2, 'Akorera leta', 'MMI', 'Aratuye', 14, 'November', 2023),
(20, 22, 'Nganguje Ramadthan', 788548709, 'Male', '30-50', 'Rwandan', 'Married', 5, 3, 'Arikorera', 'Izindi', 'Aratuye', 30, 'October', 2017),
(21, 22, 'Karake Faustin', 783986163, 'Male', '30-50', 'Rwandan', 'Divorced', 2, 0, 'Arikorera', 'Mituweli', 'Arakodesha', 23, 'July', 2014),
(22, 23, 'Ndayizeye Pascal', 788654631, 'Male', '30-50', 'Rwandan', 'Married', 8, 5, 'Akorera leta', 'Mituweli', 'Aratuye', 17, 'November', 2022),
(23, 29, 'Karangwa Die Donne', 790603443, 'Male', '50-70', 'Rwandan', 'Married', 8, 5, 'Akorera leta', 'MMI', 'Aratuye', 17, 'November', 2023),
(24, 8, 'Kabagina Claudette', 790759254, 'Female', '30-50', 'Rwandan', 'Single', 5, 3, 'Akorera abandi', 'Mituweli', 'Arakodesha', 18, 'November', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `d_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `district` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `exective` (
  `e_id` bigint(200) NOT NULL,
  `cell_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `id_num` bigint(100) NOT NULL,
  `password` varchar(200) NOT NULL
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

CREATE TABLE `irondo` (
  `id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `contact` bigint(50) NOT NULL,
  `id_number` bigint(20) NOT NULL,
  `i_day` int(5) NOT NULL,
  `i_month` varchar(10) NOT NULL,
  `i_year` int(5) NOT NULL
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

CREATE TABLE `isibo` (
  `i_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `i_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(28, 45, 'KWIHESHA AGACIRO'),
(29, 56, 'GUKUNDA IGIHUGU');

-- --------------------------------------------------------

--
-- Table structure for table `kwishyura`
--

CREATE TABLE `kwishyura` (
  `k_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `fname` varchar(110) NOT NULL,
  `amount` bigint(50) NOT NULL,
  `unity_amount` bigint(100) NOT NULL,
  `unpaid` bigint(100) NOT NULL,
  `k_day` int(5) NOT NULL,
  `k_month` varchar(30) NOT NULL,
  `k_year` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kwishyura`
--

INSERT INTO `kwishyura` (`k_id`, `v_id`, `fname`, `amount`, `unity_amount`, `unpaid`, `k_day`, `k_month`, `k_year`) VALUES
(17, 45, 'Muhimpundu Alexia', 1000, 2000, 1000, 26, 'December', 2023),
(18, 45, 'Akimana Claudette', 2000, 2000, 0, 12, 'July', 2023),
(19, 45, 'Nganguje Ramadthan', 2000, 2000, 0, 16, 'October', 2023),
(21, 44, 'Manzi Jospin', 1000, 2000, 1000, 17, 'December', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `leave_citizen`
--

CREATE TABLE `leave_citizen` (
  `l_id` int(11) NOT NULL,
  `i_id` int(30) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `phone` bigint(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `reg_day` int(5) NOT NULL,
  `reg_month` varchar(20) NOT NULL,
  `reg_year` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_citizen`
--

INSERT INTO `leave_citizen` (`l_id`, `i_id`, `fname`, `phone`, `gender`, `reg_day`, `reg_month`, `reg_year`) VALUES
(1, 8, 'Ngendahimana Claude', 788663801, 'Male', 27, 'December', 2023),
(4, 8, 'Kabuga Celestin', 788857902, 'Male', 15, 'November', 2022),
(5, 7, 'Mucunguzi Die donne', 786697874, 'Male', 19, 'November', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `mudugudu`
--

CREATE TABLE `mudugudu` (
  `m_id` bigint(200) NOT NULL,
  `v_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phones` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `id_num` bigint(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mudugudu`
--

INSERT INTO `mudugudu` (`m_id`, `v_id`, `fullname`, `phones`, `gender`, `id_num`, `password`, `reg_date`) VALUES
(487198312, 45, 'Kwizera Bosco', 790603412, 'Male', 1199180074877187, '12345678', '2024-01-06'),
(33245841576, 44, 'Ntagandwa Gabins', 790603440, 'Male', 1200280002597066, '12345678', '2024-01-06'),
(42204311247, 56, 'Manzi Jospin', 790603449, 'Male', 1200280002597067, '1234', '2024-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `mutwarasibo`
--

CREATE TABLE `mutwarasibo` (
  `mut_id` int(11) NOT NULL,
  `i_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `phones` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `id_num` bigint(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mutwarasibo`
--

INSERT INTO `mutwarasibo` (`mut_id`, `i_id`, `full_name`, `phones`, `gender`, `id_num`, `password`, `reg_date`) VALUES
(6, 8, 'KARIMBURA ALOYS', 788449621, 'Male', 1197080007564054, '12345678', '2023-11-30'),
(8, 7, 'KALONGIREE OLIVIER', 788524415, 'Male', 1197580027501013, '12345678', '2023-12-18'),
(9, 9, 'NKURANGA WILISON', 788580158, 'Male', 1198580007567043, '123456789', '2023-12-28'),
(10, 10, 'GAHIGI THOMAS', 783889431, 'Male', 1197880057699017, '12345678', '2023-12-28'),
(11, 21, 'MUKANSANGA FLORENCE', 786785735, 'Female', 1198370076867098, '12345678', '2024-01-04'),
(12, 22, 'GASANA VINCENT', 785194616, 'Male', 1197480074657187, '12345678', '2024-01-04'),
(13, 23, 'MURAGIJIMANA CHANTAL', 784948846, 'Female', 1197570009768076, '12345678', '2024-01-04'),
(14, 29, 'Rugirangoga Janvier', 790603449, 'Male', 1199180074877187, '1234', '2024-01-12'),
(15, 28, 'Manzi Jospins', 790674802, 'Male', 1199180074877786, '12345', '2024-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `p_id` int(11) NOT NULL,
  `province` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `sector` (
  `s_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `sector` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `umuganda` (
  `u_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `place` varchar(200) NOT NULL,
  `descriptions` varchar(250) NOT NULL,
  `u_day` int(5) NOT NULL,
  `u_month` varchar(15) NOT NULL,
  `u_year` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `umuganda`
--

INSERT INTO `umuganda` (`u_id`, `v_id`, `place`, `descriptions`, `u_day`, `u_month`, `u_year`) VALUES
(1, 44, 'Miduha', 'Kubaka', 16, 'November', 2023),
(5, 45, 'Kumunigo', 'Guca ibigunda', 30, 'November', 2024),
(6, 56, 'Miduha', 'gutera ibiti', 17, 'November', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` bigint(200) NOT NULL,
  `d_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contacts` bigint(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `reg_date` date NOT NULL
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

CREATE TABLE `village` (
  `v_id` int(11) NOT NULL,
  `cell_id` int(11) NOT NULL,
  `village` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(53, 24, 'Bwiza'),
(56, 25, 'Kagarama');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akagoroba`
--
ALTER TABLE `akagoroba`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `cell_table`
--
ALTER TABLE `cell_table`
  ADD PRIMARY KEY (`cell_id`),
  ADD KEY `d_id` (`s_id`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `i_id` (`i_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `exective`
--
ALTER TABLE `exective`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `v_id` (`cell_id`);

--
-- Indexes for table `irondo`
--
ALTER TABLE `irondo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `isibo`
--
ALTER TABLE `isibo`
  ADD PRIMARY KEY (`i_id`),
  ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `kwishyura`
--
ALTER TABLE `kwishyura`
  ADD PRIMARY KEY (`k_id`),
  ADD KEY `c_id` (`fname`);

--
-- Indexes for table `leave_citizen`
--
ALTER TABLE `leave_citizen`
  ADD PRIMARY KEY (`l_id`),
  ADD KEY `i_id` (`i_id`);

--
-- Indexes for table `mudugudu`
--
ALTER TABLE `mudugudu`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `mutwarasibo`
--
ALTER TABLE `mutwarasibo`
  ADD PRIMARY KEY (`mut_id`),
  ADD KEY `i_id` (`i_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `umuganda`
--
ALTER TABLE `umuganda`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `m_id` (`v_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`v_id`),
  ADD KEY `cell_id` (`cell_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akagoroba`
--
ALTER TABLE `akagoroba`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cell_table`
--
ALTER TABLE `cell_table`
  MODIFY `cell_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `citizen`
--
ALTER TABLE `citizen`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `irondo`
--
ALTER TABLE `irondo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `isibo`
--
ALTER TABLE `isibo`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kwishyura`
--
ALTER TABLE `kwishyura`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `leave_citizen`
--
ALTER TABLE `leave_citizen`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mutwarasibo`
--
ALTER TABLE `mutwarasibo`
  MODIFY `mut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `umuganda`
--
ALTER TABLE `umuganda`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `village`
--
ALTER TABLE `village`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
