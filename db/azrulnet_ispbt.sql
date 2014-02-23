-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2014 at 02:46 AM
-- Server version: 5.0.96-community
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `azrulnet_ispbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_books`
--

CREATE TABLE IF NOT EXISTS `ispbt_books` (
  `is_books_ind` int(4) NOT NULL auto_increment,
  `is_books_title` varchar(255) NOT NULL,
  `is_books_code` varchar(255) NOT NULL,
  `is_books_year` int(2) default '0',
  `is_books_price` float default '0',
  `is_books_author` varchar(255) default NULL,
  `is_books_label` varchar(255) default NULL,
  `is_books_instocks` int(255) NOT NULL,
  `is_books_outstocks` int(255) NOT NULL,
  UNIQUE KEY `is_books_code` (`is_books_code`),
  KEY `is_books_ind` (`is_books_ind`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `ispbt_books`
--

INSERT INTO `ispbt_books` (`is_books_ind`, `is_books_title`, `is_books_code`, `is_books_year`, `is_books_price`, `is_books_author`, `is_books_label`, `is_books_instocks`, `is_books_outstocks`) VALUES
(20, 'ENGLISH YEAR 4 TB', 'B024046', 4, 10, NULL, 'ENG YR 4 TB', 300, 0),
(29, 'PENDIDIKAN ISLAM TAHUN 2 JILID 2 BT', 'B092072', 2, 6, NULL, 'PI T2 JLD 2 BT', 271, 29),
(81, 'PELAJARAN JAWI TAHUN 4 BLA', 'B454004', 4, 4, '', 'JW T4 BLA', 300, 0),
(85, 'KEMAHIRAN HIDUP TAHUN 6', 'C10', 6, 8, NULL, 'KH T6 BT', 300, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_checkin`
--

CREATE TABLE IF NOT EXISTS `ispbt_checkin` (
  `is_checkin_ind` int(50) NOT NULL auto_increment,
  `is_checkin_date` varchar(11) NOT NULL,
  `is_checkin_time` varchar(11) NOT NULL,
  `is_checkin_books` varchar(255) NOT NULL,
  `is_checkin_damage` varchar(255) NOT NULL,
  `is_checkin_checkoutid` varchar(255) NOT NULL,
  `is_checkin_loaner` int(11) NOT NULL,
  `is_checkin_collector` int(11) NOT NULL,
  `is_checkin_bookstotal` int(11) NOT NULL,
  `is_checkin_damagestotal` int(11) NOT NULL,
  `is_checkin_stat` int(2) NOT NULL,
  `is_checkin_remark` varchar(255) NOT NULL,
  UNIQUE KEY `is_checkout_checkoutid` (`is_checkin_checkoutid`),
  UNIQUE KEY `is_checkin_loaner` (`is_checkin_loaner`),
  KEY `is_checkin_ind` (`is_checkin_ind`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_checkout`
--

CREATE TABLE IF NOT EXISTS `ispbt_checkout` (
  `is_checkout_ind` int(50) NOT NULL auto_increment,
  `is_checkout_date` varchar(11) NOT NULL,
  `is_checkout_time` varchar(11) NOT NULL,
  `is_checkout_books` varchar(255) NOT NULL,
  `is_checkout_damage` varchar(255) NOT NULL,
  `is_checkout_checkoutid` varchar(255) NOT NULL,
  `is_checkout_loaner` int(11) NOT NULL,
  `is_checkout_collector` int(11) NOT NULL,
  `is_checkout_bookstotal` int(11) NOT NULL,
  `is_checkout_damagestotal` int(11) NOT NULL,
  `is_checkout_stat` int(2) NOT NULL,
  `is_checkout_remark` varchar(255) default NULL,
  UNIQUE KEY `is_checkout_checkoutid` (`is_checkout_checkoutid`),
  UNIQUE KEY `is_checkout_loaner` (`is_checkout_loaner`),
  KEY `is_checkin_ind` (`is_checkout_ind`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `ispbt_checkout`
--

INSERT INTO `ispbt_checkout` (`is_checkout_ind`, `is_checkout_date`, `is_checkout_time`, `is_checkout_books`, `is_checkout_damage`, `is_checkout_checkoutid`, `is_checkout_loaner`, `is_checkout_collector`, `is_checkout_bookstotal`, `is_checkout_damagestotal`, `is_checkout_stat`, `is_checkout_remark`) VALUES
(6, '2011-09-18', '5:01:49', '', '', 'is4e750abdd2784', 0, 1, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_class`
--

CREATE TABLE IF NOT EXISTS `ispbt_class` (
  `is_class_ind` int(2) NOT NULL,
  `is_class_title` varchar(255) NOT NULL,
  KEY `is_class_ind` (`is_class_ind`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ispbt_class`
--

INSERT INTO `ispbt_class` (`is_class_ind`, `is_class_title`) VALUES
(0, 'Brilliant'),
(1, 'Excellent'),
(2, 'Smart'),
(3, 'Progressive');

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_config`
--

CREATE TABLE IF NOT EXISTS `ispbt_config` (
  `is_config_ind` int(2) NOT NULL auto_increment,
  `is_config_title` varchar(255) NOT NULL,
  `is_config_value` varchar(255) NOT NULL,
  UNIQUE KEY `is_config_title` (`is_config_title`),
  KEY `is_config_ind` (`is_config_ind`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ispbt_config`
--

INSERT INTO `ispbt_config` (`is_config_ind`, `is_config_title`, `is_config_value`) VALUES
(1, 'students_max_years', '6');

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_gender`
--

CREATE TABLE IF NOT EXISTS `ispbt_gender` (
  `is_gender_ind` int(2) NOT NULL,
  `is_gender_title` varchar(255) NOT NULL,
  KEY `is_gender_ind` (`is_gender_ind`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ispbt_gender`
--

INSERT INTO `ispbt_gender` (`is_gender_ind`, `is_gender_title`) VALUES
(0, 'Lelaki'),
(1, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_orphan`
--

CREATE TABLE IF NOT EXISTS `ispbt_orphan` (
  `is_orphan_ind` int(2) NOT NULL,
  `is_orphan_title` varchar(255) NOT NULL,
  KEY `is_orphan_ind` (`is_orphan_ind`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ispbt_orphan`
--

INSERT INTO `ispbt_orphan` (`is_orphan_ind`, `is_orphan_title`) VALUES
(0, 'Tidak'),
(1, 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_race`
--

CREATE TABLE IF NOT EXISTS `ispbt_race` (
  `is_race_ind` int(2) NOT NULL,
  `is_race_title` varchar(255) NOT NULL,
  KEY `is_race_ind` (`is_race_ind`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ispbt_race`
--

INSERT INTO `ispbt_race` (`is_race_ind`, `is_race_title`) VALUES
(0, 'Melayu'),
(1, 'Cina'),
(2, 'India'),
(3, 'Lain - Lain');

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_religion`
--

CREATE TABLE IF NOT EXISTS `ispbt_religion` (
  `is_religion_ind` int(2) NOT NULL,
  `is_religion_title` varchar(255) NOT NULL,
  KEY `is_religion_ind` (`is_religion_ind`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ispbt_religion`
--

INSERT INTO `ispbt_religion` (`is_religion_ind`, `is_religion_title`) VALUES
(0, 'Islam'),
(1, 'Kristian'),
(2, 'Buddha'),
(3, 'Hindu'),
(4, 'Lain - lain');

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_status`
--

CREATE TABLE IF NOT EXISTS `ispbt_status` (
  `is_stat_ind` int(2) NOT NULL,
  `is_stat_title` varchar(255) NOT NULL,
  KEY `is_stat_ind` (`is_stat_ind`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ispbt_status`
--

INSERT INTO `ispbt_status` (`is_stat_ind`, `is_stat_title`) VALUES
(0, 'Selesai'),
(1, 'Tangguh'),
(2, 'Batal');

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_students`
--

CREATE TABLE IF NOT EXISTS `ispbt_students` (
  `is_students_ind` int(2) NOT NULL auto_increment,
  `is_students_year` int(2) default '0',
  `is_students_class` int(2) default NULL,
  `is_students_name` varchar(255) default NULL,
  `is_students_gender` int(2) default NULL,
  `is_students_race` int(2) default NULL,
  `is_students_religion` int(2) default NULL,
  `is_students_orphan` int(2) default NULL,
  KEY `is_students_ind` (`is_students_ind`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=691 ;

--
-- Dumping data for table `ispbt_students`
--

INSERT INTO `ispbt_students` (`is_students_ind`, `is_students_year`, `is_students_class`, `is_students_name`, `is_students_gender`, `is_students_race`, `is_students_religion`, `is_students_orphan`) VALUES
(4, 6, 1, 'ABDUL GHOPUR BIN MARLIS', 0, 0, 0, 0),
(6, 5, 0, 'ABDULLAH MUKMIN', 0, 0, 0, 0),
(8, 3, 2, 'ADAM  DARIS', 0, 0, 0, 0),
(20, 2, 1, 'AHMAD AZRUL ZULFAHMI B. SHAMSUL AZNEE', 0, 0, 0, 0),
(22, 5, 0, 'AHMAD FAISAL B.MOHD.ZULKIFLI', 0, 0, 0, 0),
(27, 3, 0, 'AHMAD MUZAMMIL BIN MUHAMAD', 0, 0, 0, 0),
(29, 4, 2, 'AHMAD RAIMI ZULHILMI B SHAMSUL AZNEE', 0, 0, 0, 0),
(30, 3, 2, 'AHMAD RAMADHAN UWAIS B.ABD.RAZAK', 0, 0, 0, 0),
(34, 3, 0, 'AHMAD YUSRI AIZAD BIN AHAMAD TERMUZI', 0, 0, 0, 0),
(40, 4, 2, 'AINA NAJIHAH B. MOHD. RIDZWAN', 1, 0, 0, 0),
(42, 5, 1, 'AINGHARAN THEVAR  A/L MOGANADAS', 0, 2, 2, 0),
(43, 4, 2, 'AINNUR SHAHIRAH BT. JAMALUDIN', 1, 0, 0, 0),
(45, 6, 0, 'AISYAH NAJIHAH BT ILIAS', 1, 0, 0, 0),
(47, 3, 1, 'ALDRY FHABYAN BIN LUKMAN', 0, 0, 0, 0),
(49, 3, 0, 'AMAR HAKIMI B. KAMARULZAMAN', 0, 0, 0, 0),
(52, 4, 3, 'AMIR  WARIDZ B ABD WAHAB', 0, 0, 0, 0),
(56, 5, 1, 'AMIRUL AFIQ AHMAD AZLEE', 0, 0, 0, 0),
(59, 6, 1, 'AMIRUL AZRAI B HISHAMUDDIN', 0, 0, 0, 0),
(62, 6, 2, 'ANIS FARHANA MIDUN', 1, 0, 0, 0),
(63, 5, 0, 'ANIS NABILA BAHARUDDIN', 1, 0, 0, 0),
(65, 6, 1, 'ANUSHA A/P MOHAN KUMAR', 1, 0, 0, 0),
(66, 5, 2, 'ARIFF AS-SADIQIN BIN ABDULLAH', 0, 0, 0, 0),
(71, 3, 0, 'ASYROF HADI BIN SHIFUL ANNUAR', 0, 0, 0, 0),
(74, 5, 0, 'ATIE IZZATTY BT. ABDUL MUTALIF', 1, 0, 0, 0),
(77, 5, 1, 'AZHAR BIN AZLAN', 0, 0, 0, 0),
(84, 3, 0, 'BAVITHRAN A/L MAHANDERAN', 0, 2, 2, 0),
(87, 5, 0, 'DANIAL DANISH B KHAIRUDIN', 0, 0, 0, 0),
(88, 5, 0, 'DHASSENE A/P SANNASEROW', 1, 2, 2, 0),
(93, 3, 0, 'DZULQARNAIN ASHRAF BIN DZULKEFLI', 0, 0, 0, 0),
(104, 6, 2, 'FADLI ADHA BIN ABU BAKAR', 0, 0, 0, 0),
(105, 3, 0, 'FADZIELATI FATIN BT. MOHD.ZULKIFLI', 1, 0, 0, 0),
(111, 5, 0, 'FARAH NAJIHAH IBRAHIM', 1, 0, 0, 0),
(114, 2, 0, 'FARHAN IZWAN', 0, 0, 0, 0),
(122, 4, 2, 'FHADHLY FEBBYAN B. LUKMAN', 0, 0, 0, 0),
(136, 6, 3, 'HAZWAN SAFWAN B BUSTAMI', 0, 0, 0, 0),
(144, 3, 0, 'INSYIRAH BINTI MOHD. HANAFI', 1, 0, 0, 0),
(151, 6, 2, 'IRFAN HANNAN', 0, 0, 0, 0),
(155, 4, 0, 'JAYABRANTHA A/P BASKARAN', 1, 2, 2, 1),
(159, 6, 3, 'KHAIRIL ARSYAD MOHD KHAIDZIR', 0, 0, 0, 0),
(161, 5, 1, 'KHAIRUL IKHWAN B ABD RAZAB', 0, 0, 0, 0),
(163, 5, 0, 'KHAIRUL NIZAM B. KHAIRUL AZDAN', 0, 0, 0, 0),
(169, 5, 2, 'KHOIRUL ANWAAR B. KHAIDIR', 0, 0, 0, 0),
(171, 2, 0, 'KOMATHY', 1, 2, 2, 0),
(172, 2, 1, 'KOSHIELAA A/P RAVICHANDER', 1, 2, 2, 0),
(173, 2, 1, 'KUHANESAN A/L BALAKRISHNAN', 0, 2, 2, 0),
(175, 6, 0, 'LOGESWARY', 1, 2, 2, 0),
(176, 2, 3, 'LUKFI FAHMI B. SULANDRI', 0, 0, 0, 0),
(179, 2, 0, 'MANISHA', 1, 2, 2, 0),
(185, 4, 1, 'MOHAMAD ADILI ARIF B AZMI', 0, 0, 0, 0),
(186, 4, 2, 'MOHAMAD AIDIL B. ADNAN', 0, 0, 0, 0),
(187, 4, 3, 'MOHAMAD AKMAL FIKRI B. MAT AMIN', 0, 0, 0, 0),
(189, 2, 0, 'MOHAMAD ALIFF', 0, 0, 0, 0),
(192, 2, 1, 'MOHAMAD ASRAF B. MOHAMAD YAMIN', 0, 0, 0, 0),
(193, 4, 2, 'MOHAMAD ASRAF YAACOB', 0, 0, 0, 0),
(195, 2, 3, 'MOHAMAD AZRIN B. AZMAN', 0, 0, 0, 0),
(201, 6, 3, 'MOHAMAD HUSAINI B MOHAMAD YUSUF', 0, 0, 0, 0),
(202, 4, 1, 'MOHAMAD IKHMAL NURHALIM B. MOHD ALIAS', 0, 0, 0, 0),
(209, 2, 2, 'MOHAMAD NORIZZAT B. IBRAHIM', 0, 0, 0, 0),
(216, 5, 0, 'MOHAMAD SYAHIRUDIN B.SHARIFUDIN', 0, 0, 0, 0),
(221, 5, 2, 'MOHAMED SAFWAN ABDILLAH BIN AZIZ', 0, 0, 0, 0),
(226, 5, 2, 'MOHD ADIB HAKIMI B BUKHARI', 0, 0, 0, 0),
(227, 6, 2, 'MOHD ALIFF B MOHD ALI AZMI', 0, 0, 0, 0),
(229, 4, 0, 'MOHD AMIR NAJMI B. MOHD AZIAN', 0, 0, 0, 0),
(239, 3, 1, 'MOHD NOR AZHAR B. NAWAWI', 0, 0, 0, 1),
(241, 6, 2, 'MOHD TAQIUDIN ASAARI', 0, 0, 0, 0),
(245, 4, 0, 'MONISHA A/P ILANGOVAN', 1, 2, 2, 0),
(249, 4, 3, 'MUHAMAD ASYRAF BIN MAHMUD', 0, 0, 0, 0),
(251, 4, 3, 'MUHAMAD FAKRI B. KAMARUL RIDZUAN', 0, 0, 0, 0),
(255, 5, 2, 'MUHAMAD HAZIM BIN ABDUL SHUKUR', 0, 0, 0, 0),
(258, 6, 1, 'MUHAMAD IQBAL WAJDI', 0, 0, 0, 0),
(262, 4, 0, 'MUHAMMAD ADAM B. ILIAS', 0, 0, 0, 0),
(263, 2, 1, 'MUHAMMAD ADAM DANIEL B. SHAMSUL IMRAN', 0, 0, 0, 0),
(264, 2, 0, 'MUHAMMAD ADIB AQIL', 0, 0, 0, 0),
(279, 3, 1, 'MUHAMMAD AMIRULLAH BIN ZAMBRI', 0, 0, 0, 0),
(280, 4, 3, 'MUHAMMAD AMRIE BIN JAMAL MUHAMMAD', 0, 0, 0, 0),
(282, 2, 1, 'MUHAMMAD AQIL AKHTAR B. NOR AZNAN', 0, 0, 0, 0),
(289, 5, 3, 'MUHAMMAD FAIZ SALEHAN', 0, 0, 0, 0),
(292, 6, 1, 'MUHAMMAD FAIZZUDIN B YAAKUB', 0, 0, 0, 0),
(296, 5, 1, 'MUHAMMAD FARHAN  B  MOHAMAD GANI', 0, 0, 0, 0),
(300, 4, 0, 'MUHAMMAD FIRDAUS B.SAMDIN', 0, 0, 0, 1),
(302, 2, 3, 'MUHAMMAD HAFIZ', 0, 0, 0, 0),
(303, 5, 3, 'MUHAMMAD HAFIZ NAJMI B.HAMRAN', 0, 0, 0, 0),
(306, 3, 1, 'MUHAMMAD HAKIMI B. MD.SABUDIN', 0, 0, 0, 0),
(309, 2, 1, 'MUHAMMAD HAZIM B. AHMAD NIZAMUDDIN', 0, 0, 0, 0),
(315, 5, 2, 'MUHAMMAD HELMI BIN FADLY', 0, 0, 0, 0),
(317, 2, 3, 'MUHAMMAD IDEL', 0, 0, 0, 0),
(331, 5, 2, 'MUHAMMAD KHAIRUL ANWAR HAZMAN', 0, 0, 0, 1),
(338, 3, 1, 'MUHAMMAD NAZRI B. SANUSI', 0, 0, 0, 0),
(339, 2, 0, 'MUHAMMAD NAZRUL', 0, 0, 0, 0),
(349, 5, 3, 'MUHAMMAD SHAMIER AZFAR BIN AZHAR', 0, 0, 0, 0),
(353, 5, 2, 'MUHAMMAD SYAFIQ B SHAZANIZAM', 0, 0, 0, 0),
(356, 3, 0, 'MUHAMMAD SYAKIB ARSALAN BIN KHAIRIL', 0, 0, 0, 0),
(359, 3, 2, 'MUHAMMAD SYAMIM', 0, 0, 0, 0),
(362, 6, 3, 'MUHAMMAD YUSRY HUSHAINI B ZAMBRI', 0, 0, 0, 0),
(373, 4, 1, 'MUHAMMAH HAIRREE', 0, 0, 0, 0),
(374, 5, 3, 'MUHAMMMAD FAZZHAIREE', 0, 0, 0, 0),
(376, 4, 3, 'MUHD ALIFF IZHAM BIN ANUAR', 0, 0, 0, 0),
(377, 2, 0, 'MUHD IPZAM HAIQAL', 0, 0, 0, 0),
(379, 3, 1, 'MUHD NOR AZMI B. NAWAWI', 0, 0, 0, 1),
(384, 6, 1, 'NADIA YULIANA JAMALUDIN', 1, 0, 0, 0),
(385, 6, 1, 'NAHAZIQ BIN NASARUDDIN', 0, 0, 0, 0),
(388, 4, 1, 'NAJIHAH BT. ZULKIFLI', 1, 0, 0, 0),
(393, 3, 1, 'NAZRUL NIZAM B. NAZRI', 0, 0, 0, 0),
(409, 6, 0, 'NOR AZIZAH BT DARMANSAH', 1, 0, 0, 0),
(410, 4, 1, 'NOR AZLIN IDAYU BT. BAKRI', 1, 0, 0, 0),
(413, 6, 2, 'NOR FAZIRA BT ZAINUDIN', 1, 0, 0, 0),
(417, 4, 3, 'NOR HIDAYU BINTI MD DISA', 1, 0, 0, 0),
(419, 6, 2, 'NOR IZZATIE BINTI ABDUL RAZAK', 1, 0, 0, 0),
(431, 3, 2, 'NORFAEILIZA BT JAMROS', 1, 0, 0, 0),
(442, 4, 1, 'NUR AFIQAH  BT. SHAZANIZAM', 1, 0, 0, 0),
(447, 2, 0, 'NUR AIN NATASYA', 1, 0, 0, 0),
(448, 3, 0, 'NUR AINAA BT. ROSLAN', 1, 0, 0, 0),
(450, 3, 2, 'NUR AISHYAH BT. AMIRUDIN', 1, 0, 0, 0),
(453, 5, 2, 'NUR AISYAH NABILA BT DARWIS', 1, 0, 0, 0),
(456, 2, 3, 'NUR AMEERATUL AKMA', 1, 0, 0, 0),
(461, 4, 3, 'NUR ASYIKIN BT. MOHAMAD YAMIN', 1, 0, 0, 0),
(462, 4, 2, 'NUR ATHIRAH B. MOHD  KHAIDZIR', 1, 0, 0, 0),
(468, 5, 1, 'NUR FAQIHAH BT. LOKMAN HAKIM', 1, 0, 0, 1),
(472, 6, 2, 'NUR HIDAYAH BT AMIRUDIN', 1, 0, 0, 0),
(473, 6, 1, 'NUR HUDA AZMI', 1, 0, 0, 0),
(483, 3, 1, 'NUR NAZIF HAFIZUDIN BIN SHAMSUDIN', 0, 0, 0, 0),
(487, 3, 0, 'NUR SHAHIRA BINTI SHARIMAN', 1, 0, 0, 0),
(489, 6, 0, 'NUR SHALIANA BT SHARIMAN', 1, 0, 0, 0),
(497, 4, 1, 'NUR SYAKILA IDAYU BT.SAFRI', 1, 0, 0, 0),
(500, 5, 0, 'NUR SYAMIMI BT ABD.RAHMAN', 1, 0, 0, 0),
(505, 4, 1, 'NUR SYUHADA BT HASAN BASRI', 1, 0, 0, 0),
(506, 4, 1, 'NUR SYURAH B MOHD. NOR AZLAN', 1, 0, 0, 1),
(513, 3, 1, 'NURAZLIN BT NASIRI', 1, 0, 0, 0),
(514, 2, 3, 'NURDIANA BALKIS BT. MAHADIR', 1, 0, 0, 0),
(516, 6, 2, 'NURFARHANA RODZAIME', 1, 0, 0, 0),
(517, 2, 1, 'NURFATIHAH BT. JEFFRY', 1, 0, 0, 0),
(519, 5, 1, 'NURFAZLINA BT SYAFRI', 1, 20, 0, 0),
(528, 3, 0, 'NURINA AQILAH BT MOHD RAMLI', 1, 0, 0, 0),
(530, 3, 0, 'NURSHARIZA BT MOHD. RANI', 1, 0, 0, 0),
(536, 3, 0, 'NURUL ADILAH BT. KHAIDZIR', 1, 0, 0, 0),
(537, 4, 2, 'NURUL AFIZA BT. ALFIAN', 1, 20, 0, 0),
(568, 2, 3, 'NURUL NORAISYAH BT. ROSLI', 1, 0, 0, 0),
(570, 2, 3, 'NURUL SAFIQAH BT. MUHAMAD NIZAR', 1, 0, 0, 0),
(573, 3, 1, 'NURUL SYAZANA BT RAMLI', 1, 0, 0, 0),
(574, 4, 0, 'NURUL ZAINANI BINTI ZAINI', 1, 0, 0, 0),
(576, 3, 0, 'PRAVIN A/L RAMAKRISNAN', 0, 2, 2, 0),
(577, 3, 1, 'PRIYATHARSHINI A/P MANIYANNAN', 1, 2, 2, 0),
(579, 5, 2, 'RABIATUL ADAWIYAH BT JAAFAR', 1, 0, 0, 0),
(582, 3, 1, 'RAHULLUKMAN B. APRIZAL', 0, 0, 0, 0),
(584, 3, 2, 'RAJA MUHAMMAD AMIR B. RAJA ANUAR', 0, 0, 0, 0),
(585, 2, 0, 'RAJA ZARITH SOFIA', 1, 0, 0, 0),
(587, 6, 3, 'RASKILAH BT SALLEH', 1, 0, 0, 0),
(608, 3, 1, 'SITI ILYA MAISARAH BTE. MOHD NASIR', 1, 0, 0, 0),
(610, 6, 1, 'SITI NOORSYAFIQAH BT BAHARUDDIN', 1, 0, 0, 0),
(614, 5, 0, 'SITI NURAINA BT ROSLI', 1, 0, 0, 0),
(618, 2, 3, 'SITI ZUBAIDAH BT. ZAMRI', 1, 0, 0, 0),
(621, 2, 2, 'SOFIYA BT. MOHAMAD', 1, 20, 0, 0),
(623, 4, 3, 'SUCI MUSTIKA AYU BT. M. SHARIF', 1, 0, 0, 0),
(626, 6, 0, 'SURAJ JAYVEENTH A/L BABU', 0, 2, 2, 0),
(632, 5, 0, 'SYED  ALIFF NAJWAN BIN SYED NASI', 0, 0, 0, 0),
(633, 6, 2, 'SYED MOHD FIRDAUS', 0, 0, 0, 0),
(634, 6, 1, 'TAJUDDIN B SYARIF', 0, 0, 0, 0),
(635, 4, 1, 'TAMIL SELVAN A/L CHANDRA SEKARAN', 0, 2, 2, 0),
(645, 2, 1, 'VIKNESH A/L MURUGAIAH', 0, 2, 2, 0),
(647, 2, 0, 'WAN ABDUL AFIF', 0, 0, 0, 0),
(664, 2, 1, 'ZARIF ZAFRI B. ZAIMI', 0, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_users`
--

CREATE TABLE IF NOT EXISTS `ispbt_users` (
  `is_users_ind` int(5) NOT NULL,
  `is_users_name` varchar(255) NOT NULL,
  `is_users_pass` varchar(9) NOT NULL,
  KEY `is_users_ind` (`is_users_ind`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ispbt_years`
--

CREATE TABLE IF NOT EXISTS `ispbt_years` (
  `is_years_ind` int(3) NOT NULL,
  `is_years_digit` int(3) NOT NULL,
  `is_years_title` varchar(255) NOT NULL,
  UNIQUE KEY `is_year_digit` (`is_years_digit`),
  KEY `is_year_ind` (`is_years_ind`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ispbt_years`
--

INSERT INTO `ispbt_years` (`is_years_ind`, `is_years_digit`, `is_years_title`) VALUES
(0, 1, 'Satu'),
(1, 2, 'Dua'),
(2, 3, 'Tiga'),
(3, 4, 'Empat'),
(4, 5, 'Lima'),
(5, 6, 'Enam');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;