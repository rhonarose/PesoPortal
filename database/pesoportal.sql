-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 02:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesoportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(63, 'Rose', 'rose@gmail.com', '$2y$10$3oGSFEnBpSoMGuwi.7WxKeEV9LbHHJyn10ElKhp9bMyT83I1Updna'),
(64, 'Rose', 'rose@gmail.com', '$2y$10$7DSoDDkpzKMW2VWQWhw4JOcPX8MtPN5kN9JXsLUj7BuhUX1xdkH66'),
(65, 'Jek', 'jek@gmail.com', '$2y$10$rEC21MX7oMCq6ji2t/ohFOpn3yZEsBVFBXA5bdNIKuS9BwpLrIkyC'),
(66, 'rhona', 'rhona@gmail.com', '$2y$10$ztKsSF6uE0JRE/2ftYNT8esBJ9qnALSGZuR5ujV81i2Hxn4ipXGqe'),
(67, 'Rose', 'rose@gmail.com', '$2y$10$O7lEY2TPgtR3bZS7/perF.cgf3R/iZOFGR4JsxMCPdC2BrIV3OaIy'),
(68, 'PESO', 'peso@gmail.com', '$2y$10$VGsCF0Q856nh6K59kLX4Geyb88UFEyWZQqXeKdPr9CWTeEoZTSGZu');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `username`, `email`, `password`) VALUES
(178, 'Bert', 'bert@gmail.com', '$2y$10$Bk37YZtGUWXhfXJ3QxRdIe/Lej2N2FxvrgIEZkKeukDRus7gx/V3S'),
(180, 'Rose', 'rose@gmail.com', '$2y$10$CSKPLYdkgwRlDKqt4nZVFuZMWgSlVwB4aNo9vPfBBGVXw.gWVJBfu'),
(181, 'Rhona', 'rhona@gmail.com', '$2y$10$ElSESn47/51t7E.lD0VjFuqY55ztLB5ShLVnhxwHJiZgj2b7LNYee'),
(182, 'Jek', 'jek@gmail.com', '$2y$10$2Z/fkoMqD8RiueBDRW4NSOURpC4OSnDlQpiAJHUfHKF2JQ49oDfoC'),
(183, 'Jericho', 'jericho@gmail.com', '$2y$10$OpG3vd7Ru5nb/CuhzzPIDOE7mYFaWjffTuKZ34J2bfzztT3/0LG5m'),
(184, 'Ian', 'ian@gmail.com', '$2y$10$BlSSPI0I2Yg4iPRtgWr3EOQ07UBny38gpm1IfYB5H7DYq6ctxIXde'),
(185, 'RoseC', 'rosec@gmail.com', '$2y$10$.iDENZVSRhxm3e4LMVJwGOd364OqfFix/ko5aTIhwZylcK5yme0xO'),
(186, 'Jay', 'jay@gmail.com', '$2y$10$QvseIm5QNJ1xFhY2J4R5fO2lm.Ea3CwUJmgE35rulTOylGco3fCK.'),
(187, 'Bwel', 'bwel@gmail.com', '$2y$10$YAZI7AlSGXg5Mo3ddgnS4ucK0awyXnkG5E8gzcxsqx.enRa3A5LIO'),
(188, 'Jeco', 'jeco@gmail.com', '$2y$10$mxgC22841L/d1UsqkCmATOOtMbVVZGTrkFWkRC7gX/62PXCuJyHw.'),
(189, 'Jerico', 'jerico@gmail.com', '$2y$10$dEgFuMmnqOv1Mczd4c/v0uD6hJDbTIMGOHv1q9t9VAq83EIq1tiky'),
(190, 'Jaira', 'jaira@gmail.com', '$2y$10$cMkU8akqWvmRujsHgwv21OXs8hZm82P/sFMn3pMzUeog9Ly7ksaBi'),
(191, 'Ishi', 'ishi@gmail.com', '$2y$10$MfUf65UbJT.o9nNzv8BxYOEyMYeEekC/4K0WIACP5e5Sx9LfT4bq6'),
(198, 'Gina', 'gina@gmail.com', '$2y$10$5YRYBgb8I.x6hpPmtXCBIe8XiBO/c/oYanUCD/8FlAwtJ/QgWNNzW'),
(199, 'Mae', 'mae@gmail.com', '$2y$10$Wg3v02ZoeyXn.FfWR5ZSS.U2bxdKpzDK.ICGiq5WS7cH6bq8i6xha'),
(200, 'Niz', 'niz@gmail.com', '$2y$10$uLrS8A1o6XsKzafZS.Pg9e9tykiztdpqst/KMKecN.rPvwZ1afaNi'),
(201, 'Rob', 'rob@gmail.com', '$2y$10$to4hq.stiNG96Iy9hLVNiu0hQmiepfRYgoammeCCITK6wPcUcOSBK'),
(202, 'Marie', 'marie@gmail.com', '$2y$10$pgi20loBs47dYVU4W365.e4Zz.d/UwV3LjGnuRpkMIGc06Sdew/t2'),
(203, 'RR', 'rr@gmail.com', '$2y$10$2OBuys34nzsu66LUnVqxzOXaDABVRHvffOP/BcNsbrMP5JsSVoAyq'),
(204, 'Dennis', 'dennis@gmail.com', '$2y$10$Vgyvtvkd2/czzH1GPSVJg.AzxvskQK48YniOsaIp7C3tB3xtXc3Zq'),
(205, 'f', 'f@gmail.com', '$2y$10$JqXedzfLud/.f8twdUCK7e0bs4WHFBi/Hgq48gGXiP5xZBpL2FkZW'),
(206, 'r@gmail.com', 'r@gmail.com', '$2y$10$b.fNS1DPzEXvZB9KGU/VUeyB5udLaWmKKpkY/BSqTLowBRN8d2/oC'),
(207, 'q', 'q@gmail.com', '$2y$10$2L9b1mipOfrfgNi7JZQQnewJtkPCvgyJcSoS8LDkYWQWq2xzwqCga'),
(208, 'w', 'w@gmail.com', '$2y$10$v.7OnPCsumbZDar7eGkI.O6Hxy1GBAnc7ivGNoQJLhqDAGnoHhoMu'),
(209, 'e', 'e@gmail.com', '$2y$10$TFkK.CxvX7lWki67Gf12V.rudDs0ZgPs..g5dUNSW6bAq3EJ6e6Mi'),
(210, 't', 't@gmail.com', '$2y$10$hNNbixxLnOs8jWuI1XFRsuCcPgiQqxI5Do6NImfJ1yph0KulV.Sy2'),
(211, 'y', 'y@gmail.com', '$2y$10$HMzM9tSRCmkJZK/B5tizj.3FczLzp.iMb5mDSCHVyt4p9Bk8sYu4O'),
(212, 'u', 'u@gmail.com', '$2y$10$52SJ5NCt4qV8G9vRsZcwK.06VpkQOPJYC3ZO8DCn1t03PNGt34bae'),
(213, 'i', 'i@gmail.com', '$2y$10$xpWSCypsqq4BjHE23CwHFuiAKQpHUY/LPIjG4V58E99TepwrNv9hK'),
(214, 'Rhona22', 'o@gmail.com', '$2y$10$.YZdD/V0.BV7/Aob.MMfJeELG9XqaSSm.ZUEDvhXAgLTLndE0IsJe'),
(215, 'p', 'p@gmail.com', '$2y$10$C43pJnuo8ejC7FbjzgQq0ujS69kL/J7HBIIy0NvWX5X/sza7xQbWe'),
(216, 's', 's@gmail.com', '$2y$10$/mjVwrJe1YH1aDMrrx836eDriG9vapXuQIMSMdhjHMU3W/YBDv1ny');

-- --------------------------------------------------------

--
-- Table structure for table `educational_background`
--

CREATE TABLE `educational_background` (
  `educ_background_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `elementary_school` varchar(255) DEFAULT NULL,
  `elementary_course` varchar(255) DEFAULT NULL,
  `elementary_year_graduated` int(11) DEFAULT NULL,
  `elementary_level` varchar(50) DEFAULT NULL,
  `elementary_year_last_attended` int(11) DEFAULT NULL,
  `elementary_awards` varchar(255) DEFAULT NULL,
  `secondary_school` varchar(255) DEFAULT NULL,
  `secondary_course` varchar(255) DEFAULT NULL,
  `secondary_year_graduated` int(11) DEFAULT NULL,
  `secondary_level` varchar(50) DEFAULT NULL,
  `secondary_year_last_attended` int(11) DEFAULT NULL,
  `secondary_awards` varchar(255) DEFAULT NULL,
  `tertiary_school` varchar(255) DEFAULT NULL,
  `tertiary_course` varchar(255) DEFAULT NULL,
  `tertiary_year_graduated` int(11) DEFAULT NULL,
  `tertiary_level` varchar(50) DEFAULT NULL,
  `tertiary_year_last_attended` int(11) DEFAULT NULL,
  `tertiary_awards` varchar(255) DEFAULT NULL,
  `graduate_school` varchar(255) DEFAULT NULL,
  `graduate_course` varchar(255) DEFAULT NULL,
  `graduate_year_graduated` int(11) DEFAULT NULL,
  `graduate_level` varchar(50) DEFAULT NULL,
  `graduate_year_last_attended` int(11) DEFAULT NULL,
  `graduate_awards` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educational_background`
--

INSERT INTO `educational_background` (`educ_background_id`, `applicant_id`, `elementary_school`, `elementary_course`, `elementary_year_graduated`, `elementary_level`, `elementary_year_last_attended`, `elementary_awards`, `secondary_school`, `secondary_course`, `secondary_year_graduated`, `secondary_level`, `secondary_year_last_attended`, `secondary_awards`, `tertiary_school`, `tertiary_course`, `tertiary_year_graduated`, `tertiary_level`, `tertiary_year_last_attended`, `tertiary_awards`, `graduate_school`, `graduate_course`, `graduate_year_graduated`, `graduate_level`, `graduate_year_last_attended`, `graduate_awards`) VALUES
(69, 178, 'towerville Elementary school', '', 2011, '', 0, '', 'towerville National Highschool', '', 2017, '', 0, '', 'bulaan state university', 'BS in Information Technology', 0, 'Fourth Year', 2023, '', '', '', 0, '', 0, ''),
(117, 199, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(118, 202, 'ertert', '', 0, '', 0, '', 'fgdf', '', 0, '', 0, '', 'fdg', '', 0, '', 0, '', 'tretert', '', 0, '', 0, ''),
(119, 203, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(120, 205, 'ertert', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(121, 206, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(122, 207, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(123, 207, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(124, 208, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(125, 209, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(126, 210, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(127, 211, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(128, 212, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(129, 213, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(130, 214, 'Towerville Elementary School', '', 2011, '', 0, '', 'Towerville National Highschool', '', 2017, '', 0, '', 'Bulacan State University-Sarmiento Campus', 'BS in Information Technology', 0, 'Fourth Year', 2023, '', '', '', 0, '', 0, ''),
(131, 215, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, ''),
(132, 216, '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '', '', '', 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `eligibility`
--

CREATE TABLE `eligibility` (
  `eligibility_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `eligibility1` varchar(255) DEFAULT NULL,
  `rating1` varchar(255) DEFAULT NULL,
  `examdate1` date DEFAULT NULL,
  `professional_license1` varchar(255) DEFAULT NULL,
  `valid1` date DEFAULT NULL,
  `eligibility2` varchar(255) DEFAULT NULL,
  `rating2` varchar(255) DEFAULT NULL,
  `examdate2` date DEFAULT NULL,
  `professional_license2` varchar(255) DEFAULT NULL,
  `valid2` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eligibility`
--

INSERT INTO `eligibility` (`eligibility_id`, `applicant_id`, `eligibility1`, `rating1`, `examdate1`, `professional_license1`, `valid1`, `eligibility2`, `rating2`, `examdate2`, `professional_license2`, `valid2`) VALUES
(93, 199, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(94, 202, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(95, 203, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(96, 205, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(97, 206, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(98, 207, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(99, 207, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(100, 208, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(101, 209, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(102, 210, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(103, 211, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(104, 212, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(105, 213, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(106, 214, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(107, 215, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00'),
(108, 216, '', '', '0000-00-00', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `company_name`, `email`, `password`) VALUES
(91, 'Jek', 'jek1@gmail.com', '$2y$10$rkYMMdWGKNA8yXZhT04Efe6vlJNgYi6h358oqPjn3H47mfmjlxeNK'),
(92, 'RRCC', 'rrcc@gmail.com', '$2y$10$KH1rRG31SJcjBQt5eyLDuumpmmFWiimP2gZEMVxlXBroIcaRt0z/u'),
(93, 'JYL', 'jyl@gmail.com', '$2y$10$c/ipLBFsji7ERl1.3bmDq./Tzqqi7Vo3FGAh5PxiQz8X0vxt96NdO'),
(94, 'JY', 'jy@gmail.com', '$2y$10$uq6TH4rnEizw80rtwM2FYuHH7j7I.7eAP.N5W08wyQEWoVy5mSBza');

-- --------------------------------------------------------

--
-- Table structure for table `employer_info`
--

CREATE TABLE `employer_info` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `employer_website` varchar(255) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `english_read` tinyint(1) DEFAULT NULL,
  `english_write` tinyint(1) DEFAULT NULL,
  `english_speak` tinyint(1) DEFAULT NULL,
  `english_understand` tinyint(1) DEFAULT NULL,
  `filipino_read` tinyint(1) DEFAULT NULL,
  `filipino_write` tinyint(1) DEFAULT NULL,
  `filipino_speak` tinyint(1) DEFAULT NULL,
  `filipino_understand` tinyint(1) DEFAULT NULL,
  `other_language` varchar(255) DEFAULT NULL,
  `other_read` tinyint(1) DEFAULT NULL,
  `other_write` tinyint(1) DEFAULT NULL,
  `other_speak` tinyint(1) DEFAULT NULL,
  `other_understand` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `applicant_id`, `english_read`, `english_write`, `english_speak`, `english_understand`, `filipino_read`, `filipino_write`, `filipino_speak`, `filipino_understand`, `other_language`, `other_read`, `other_write`, `other_speak`, `other_understand`) VALUES
(126, 185, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0),
(128, 199, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0),
(129, 202, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(130, 203, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(131, 205, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(132, 206, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(133, 207, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(134, 207, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(135, 208, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(136, 209, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(137, 210, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(138, 211, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(139, 212, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(140, 213, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(141, 214, 1, 1, 1, 1, 1, 1, 1, 1, '', 0, 0, 0, 0),
(142, 215, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0),
(143, 216, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nsrp_form`
--

CREATE TABLE `nsrp_form` (
  `nsrp_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `personal_info_id` int(11) DEFAULT NULL,
  `preference_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `educ_background_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `eligibility_id` int(11) DEFAULT NULL,
  `work_experience_id` int(11) DEFAULT NULL,
  `skills_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `personal_info_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `house_no_street_village` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality_city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `height` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `landline_number` varchar(15) DEFAULT NULL,
  `cellphone_number` varchar(15) NOT NULL,
  `tin` varchar(20) NOT NULL,
  `gsis_sss_id` varchar(20) NOT NULL,
  `pagibig_no` varchar(20) NOT NULL,
  `philhealth_no` varchar(20) NOT NULL,
  `disability` varchar(50) DEFAULT NULL,
  `employment_status` varchar(20) DEFAULT NULL,
  `employment_type` varchar(255) DEFAULT NULL,
  `actively_looking_for_work` varchar(3) NOT NULL,
  `how_long_looking_for_work` varchar(255) DEFAULT NULL,
  `willing_to_work_immediately` varchar(3) NOT NULL,
  `if_no_when` varchar(255) DEFAULT NULL,
  `is_4ps_beneficiary` varchar(3) NOT NULL,
  `household_id_4ps` varchar(255) DEFAULT NULL,
  `profile_picture` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`personal_info_id`, `applicant_id`, `surname`, `first_name`, `middle_name`, `suffix`, `birthdate`, `birthplace`, `sex`, `religion`, `civil_status`, `house_no_street_village`, `barangay`, `municipality_city`, `province`, `height`, `email`, `landline_number`, `cellphone_number`, `tin`, `gsis_sss_id`, `pagibig_no`, `philhealth_no`, `disability`, `employment_status`, `employment_type`, `actively_looking_for_work`, `how_long_looking_for_work`, `willing_to_work_immediately`, `if_no_when`, `is_4ps_beneficiary`, `household_id_4ps`, `profile_picture`) VALUES
(89, 182, '', 'rhona ', '', '', '0000-00-00', '', '', '', '', '', '', 'San Jose Del Monte', 'Bulacan', '', 'jek@gmail.com', '', '', '', '', '', '', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', '', '', '', '', '', '', NULL),
(90, 191, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Minuyan Proper', 'San Jose Del Monte', 'Bulacan', '180', 'ishi@gmail.com', '', '1234567890', '1234567890', '2222222', '3333333333333', '1234567890', '', 'Unemployed', 'Others / student ', 'No', '', 'No', '', 'No', '', NULL),
(94, 198, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Male', 'Roman Catholic', 'Single', 'blk 1 lot 2', 'Francisco Homes - Yakal', 'San Jose Del Monte', 'Bulacan', '183', 'gina@gmail.com', '', '1234567890', '1234567890', '2222222', 'fghgfhg', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', '', '', NULL),
(95, 199, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Fatima IV', 'San Jose Del Monte', 'Bulacan', '45', 'mae@gmail.com', '123456', '1234567890', '1234567890', '2222222', 'fghgfhg', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(96, 200, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Married', 'blk 23 lot 7', 'Gaya-Gaya', 'San Jose Del Monte', 'Bulacan', '183', 'niz@gmail.com', '1234567890', '1234567890', '1234567890', '2222222', 'fghgfhg', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(97, 201, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 1 lot 1', 'Fatima IV', 'San Jose Del Monte', 'Bulacan', '183', 'rob@gmail.com', '', '1234567890', '1111111', '2222222', '5555555555555555', '444444444444444', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(98, 202, 'cortez', 'rhona ', 'yu', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Gaya-Gaya', 'San Jose Del Monte', 'Bulacan', '183', 'marie@gmail.com', '1234567890', '1234567890', '1234567890', '2222222', '3333333333333', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(99, 203, 'cortez', 'jericho', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Iglesia Ni Cristo', 'Single', 'blk 23 lot 7', 'Francisco Homes - Yakal', 'San Jose Del Monte', 'Bulacan', '183', 'rr@gmail.com', '', '1234567890', '1234567890', '2222222', 'fghgfhg', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', '', '', '', '', '', '', NULL),
(100, 205, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Fatima IV', 'San Jose Del Monte', 'Bulacan', '183', 'f@gmail.com', '1234567890', '1234567890', '1111111', '2222222', '3333333333333', '444444444444444', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(101, 206, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Bagong Buhay III', 'San Jose Del Monte', 'Bulacan', '180', 'r@gmail.com', '', '1234567890', '1111111', '2222222', 'fghgfhg', '444444444444444', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(102, 207, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Born Again Christian', 'Single', 'blk 23 lot 7', 'Bagong Buhay I', 'San Jose Del Monte', 'Bulacan', '183', 'q@gmail.com', '', '1234567890', '222222222222222', '2222222', '3333333333333', '8888888888888', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(103, 207, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'gfhgh', 'Bagong Buhay I', 'San Jose Del Monte', 'Bulacan', '45', 'q@gmail.com', '', '1234567890', '1111111', '2222222', '1234567890', '444444444444444', '', 'Unemployed', 'Others / student ', 'No', '', 'No', '', 'No', '', NULL),
(104, 208, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Married', 'blk 23 lot 7', 'Gaya-Gaya', 'San Jose Del Monte', 'Bulacan', '183', 'w@gmail.com', '', '1234567890', '1234567890', '2222222', '3333333333333', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(105, 209, 'llanes', 'jericho', 'yu', '', '2001-07-04', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Assumption', 'San Jose Del Monte', 'Bulacan', '183', 'e@gmail.com', '', '1234567890', '1111111', '2222222', '5555555555555555', '8888888888888', '', 'Unemployed', 'Others / student ', 'No', '', 'No', '', 'No', '', NULL),
(106, 210, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Assumption', 'San Jose Del Monte', 'Bulacan', '183', 't@gmail.com', '', '1234567890', '1234567890', '2222222', 'fghgfhg', '8888888888888', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(107, 211, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Married', 'blk 23 lot 7', 'Francisco Homes - Mulawin', 'San Jose Del Monte', 'Bulacan', '183', 'y@gmail.com', '', '1234567890', '1234567890', '2222222', 'fghgfhg', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(108, 212, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Francisco Homes - Yakal', 'San Jose Del Monte', 'Bulacan', '183', 'u@gmail.com', '', '1234567890', '1234567890', '2222222', '3333333333333', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(109, 213, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Bagong Buhay I', 'San Jose Del Monte', 'Bulacan', '45', 'i@gmail.com', '', '1234567890', '1111111', '2222222', '3333333333333', '1234567890', '', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(110, 214, 'Cortez', 'Rhona Rose', 'Cuaro', '', '2002-11-22', 'Bulacan', 'Female', 'Roman Catholic', 'Single', 'Blk 23 Lot 7 Ph1A Towerville', 'Minuyan Proper', 'San Jose Del Monte', 'Bulacan', '154', 'o@gmail.com', '', '09632259136', '000-000-000', '000-00-0000', '0000-0000-0000', '00-0000000000-0', '', 'Unemployed', 'Others / Student ', 'No', '', 'No', '', 'No', '', NULL),
(111, 215, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Gaya-Gaya', 'San Jose Del Monte', 'Bulacan', '183', 'p@gmail.com', '', '1234567890', '1234567890', '2222222', '3333333333333', '1234567890', '[\"Visual\",\"Hearing\",\"Speech\",\"Physical\",\"N\\/A\"]', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL),
(112, 216, 'cortez', 'rhona ', 'cuaro', '', '2002-11-22', 'bulacan', 'Female', 'Roman Catholic', 'Single', 'blk 23 lot 7', 'Francisco Homes - Yakal', 'San Jose Del Monte', 'Bulacan', '180', 's@gmail.com', '', '1234567890', '1234567890', '2222222', '1234567890', '8888888888888', '\"Visual, Hearing, Speech, Physical, N\\/A\"', 'Unemployed', 'New Entrant/Fresh Gradate /  ', 'No', '', 'No', '', 'No', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preference` (
  `preference_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `preferred_occupation1` varchar(255) NOT NULL,
  `preferred_occupation2` varchar(255) NOT NULL,
  `preferred_occupation3` varchar(255) DEFAULT NULL,
  `preferred_occupation4` varchar(255) DEFAULT NULL,
  `preferred_location1` varchar(10) NOT NULL,
  `local_location1` varchar(255) NOT NULL,
  `local_location2` varchar(255) DEFAULT NULL,
  `local_location3` varchar(255) DEFAULT NULL,
  `preferred_location2` varchar(10) NOT NULL,
  `overseas_location1` varchar(255) NOT NULL,
  `overseas_location2` varchar(255) NOT NULL,
  `overseas_location3` varchar(255) NOT NULL,
  `expected_salary` varchar(50) NOT NULL,
  `passport_number` varchar(50) DEFAULT NULL,
  `passport_expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preference`
--

INSERT INTO `preference` (`preference_id`, `applicant_id`, `preferred_occupation1`, `preferred_occupation2`, `preferred_occupation3`, `preferred_occupation4`, `preferred_location1`, `local_location1`, `local_location2`, `local_location3`, `preferred_location2`, `overseas_location1`, `overseas_location2`, `overseas_location3`, `expected_salary`, `passport_number`, `passport_expiry_date`) VALUES
(53, 178, 'Data analyst', 'web developer', '', '', 'Overseas', '', '', '', '', '', '', '', '100,000', '', '0000-00-00'),
(54, 178, 'Data analyst', 'web developer', '', '', 'Overseas', '', '', '', '', '', '', '', '100,000', '', '0000-00-00'),
(55, 202, 'gdfgdf', 'fgdfg', 'fgdg', 'dffgd', '1', 'Cavite', 'Bulacan', 'Qc', '1', 'Japan', 'Singapore', 'Canada', '', '', '0000-00-00'),
(56, 203, '', '', '', '', '1', '', '', '', '1', '', '', '', '', '', '0000-00-00'),
(57, 205, 'gdfgdf', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(58, 206, 'gdfgdf', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(59, 207, 'gdfgdf', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(60, 207, 'gddfg', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(61, 208, 'gdfgdf', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(62, 209, 'gdfgdf', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(63, 210, 'gdfgdf', '', '', '', '1', 'Cavite', '', '', '1', '', '', '', '', '', '0000-00-00'),
(64, 211, 'gdfgdf', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(65, 212, 'gdfgdf', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(66, 213, 'gddfg', '', '', '', '1', 'Cavite', '', '', '1', 'Japan', '', '', '', '', '0000-00-00'),
(67, 214, 'Data Analyst', 'Wed Developer', 'Data Scientist', '', '1', 'Cavite', 'Bulacan', 'Qc', '1', 'Japan', 'Singapore', 'Canada', '100,000', '', '0000-00-00'),
(68, 215, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00'),
(69, 216, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skills_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `skills` varchar(500) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skills_id`, `applicant_id`, `skills`, `category_id`) VALUES
(1, 209, 'Welding, Metalworking', NULL),
(2, 210, 'Structural Steel Technician', NULL),
(3, 210, 'Safety protocol', NULL),
(4, 210, 'Electrical Maintenance Supervisor', NULL),
(5, 211, 'Wiring installation', NULL),
(6, 211, 'Electrical troubleshooting', NULL),
(7, 211, 'Electrical engineering', NULL),
(8, 211, 'Energy efficiency analysis', NULL),
(12, 213, 'Computer skills', 27),
(13, 213, 'Data entry and record-keeping', 21),
(14, 214, 'Computer skills', 27),
(15, 214, 'Basic web development and content management', 19),
(16, 214, 'Food and beverage service', 22),
(17, 216, 'Welding', 3),
(18, 216, 'Food and beverage service', 22);

-- --------------------------------------------------------

--
-- Table structure for table `skill_categories`
--

CREATE TABLE `skill_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill_categories`
--

INSERT INTO `skill_categories` (`category_id`, `category_name`) VALUES
(1, 'Electrical Installation and Maintenance (EIM) (NCII)'),
(2, 'Masonry (NCII)'),
(3, 'Steelworks'),
(4, 'Scaffolding'),
(5, 'Food and Beverage Services (FBS) (NCII)'),
(6, 'Mechatronics Servicing Course'),
(7, 'Agricultural Crops Production (NC I)'),
(8, 'Automotive Servicing (NC II)'),
(9, 'Bartending (NC II)'),
(10, 'Caregiving (NC II)'),
(11, 'Mechatronics Servicing'),
(12, 'Instrumentation and Control Servicing '),
(13, 'Beauty Care (NC II)'),
(14, 'Bookkeeping (NC III)'),
(15, ' Bread and Pastry Production (NC II)'),
(16, 'Carpentry (NC II)'),
(17, 'Central Sterile Processing Technology'),
(18, 'Central Sterile Service'),
(19, 'Computer Systems Servicing (NC II)'),
(20, 'Construction Painting (NC II)'),
(21, 'Contact Center Services (NC II)'),
(22, ' Cookery (NC II)'),
(23, 'Customer Services (NC II)'),
(24, 'Dressmaking (NC II)'),
(25, 'Driving (NC II)'),
(26, ' Events Management Services (NC III)'),
(27, 'Front Office Services (NC II)'),
(28, 'Gas Tungsten Arc Welding (GTAW) (NC II)'),
(29, 'Health Care Services (NC II)'),
(30, 'Heavy Equipment Operation (Forklift) (NC II)'),
(31, 'Heavy Equipment Operation (Rigid On-Highway Dump Truck) (NC II)'),
(32, 'Heavy Equipment Operation (Wheel Loader) (NC II)'),
(33, 'Hilot (Wellness Massage) (NC II)'),
(34, 'Housekeeping (NC II)'),
(35, 'Japanese Language and Culture (N4) Level I'),
(36, 'Japanese Language and Culture N5-N4 Level 1'),
(37, 'Microfinance Technology (NC II)'),
(38, 'Pharmacy Services (NC III)'),
(39, 'Plumbing (NC I)'),
(40, 'Plumbing (NC II)'),
(41, 'RAC Servicing (DomRac) (NC II)'),
(42, 'RAC Servicing (PACU/CRE) (NC III)'),
(43, 'Scaffolding Works NC II (Supported Type Scaffold)'),
(44, 'Shielded Metal Arc Welding (SMAW) (NC I)'),
(45, 'Shielded Metal Arc Welding (SMAW) (NC II)'),
(46, 'Tile Setting (NC II)'),
(47, 'Trainers Methodology Level I');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `training_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `course_name_1` varchar(255) DEFAULT NULL,
  `course_duration_start_1` date DEFAULT NULL,
  `course_duration_end_1` date DEFAULT NULL,
  `training_institution_1` varchar(255) DEFAULT NULL,
  `certificates_received_1` varchar(255) DEFAULT NULL,
  `course_name_2` varchar(255) DEFAULT NULL,
  `course_duration_start_2` date DEFAULT NULL,
  `course_duration_end_2` date DEFAULT NULL,
  `training_institution_2` varchar(255) DEFAULT NULL,
  `certificates_received_2` varchar(255) DEFAULT NULL,
  `course_name_3` varchar(255) DEFAULT NULL,
  `course_duration_start_3` date DEFAULT NULL,
  `course_duration_end_3` date DEFAULT NULL,
  `training_institution_3` varchar(255) DEFAULT NULL,
  `certificates_received_3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`training_id`, `applicant_id`, `course_name_1`, `course_duration_start_1`, `course_duration_end_1`, `training_institution_1`, `certificates_received_1`, `course_name_2`, `course_duration_start_2`, `course_duration_end_2`, `training_institution_2`, `certificates_received_2`, `course_name_3`, `course_duration_start_3`, `course_duration_end_3`, `training_institution_3`, `certificates_received_3`) VALUES
(44, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(45, 178, 'housekeeping', '2019-08-08', '2019-10-08', 'headwaters college', 'NC II', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(46, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(47, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(48, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(49, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(50, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(51, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(52, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(53, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(54, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(55, 178, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(56, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(57, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(58, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(59, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(60, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(61, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(62, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(63, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(64, 180, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(65, 181, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(66, 182, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(67, 183, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(68, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(69, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(70, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(71, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(72, NULL, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(73, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(74, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(75, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(76, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(77, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(78, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(79, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(80, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(81, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(82, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(83, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(84, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(85, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(86, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(87, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(88, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(89, 184, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(90, 185, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(91, 185, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(93, 199, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(94, 202, 'fsdjgfsdgf', '0000-00-00', '0000-00-00', '', '', 'gdgdf', '0000-00-00', '0000-00-00', '', '', 'tryry', '0000-00-00', '0000-00-00', '', ''),
(95, 203, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(96, 205, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(97, 206, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(98, 207, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(99, 207, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(100, 208, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(101, 209, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(102, 210, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(103, 211, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(104, 212, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(105, 213, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(106, 214, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(107, 215, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(108, 216, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `work_experience_id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `company_name1` varchar(255) DEFAULT NULL,
  `company_address1` varchar(255) DEFAULT NULL,
  `position1` varchar(255) DEFAULT NULL,
  `inclusive_dates_start1` varchar(20) DEFAULT NULL,
  `inclusive_dates_end1` varchar(20) NOT NULL,
  `status1` varchar(20) DEFAULT NULL,
  `company_name2` varchar(255) DEFAULT NULL,
  `company_address2` varchar(255) DEFAULT NULL,
  `position2` varchar(255) DEFAULT NULL,
  `inclusive_dates_start2` varchar(20) DEFAULT NULL,
  `inclusive_dates_end2` varchar(20) NOT NULL,
  `status2` varchar(20) DEFAULT NULL,
  `company_name3` varchar(255) DEFAULT NULL,
  `company_address3` varchar(255) DEFAULT NULL,
  `position3` varchar(255) DEFAULT NULL,
  `inclusive_dates_start3` varchar(20) DEFAULT NULL,
  `inclusive_dates_end3` varchar(20) NOT NULL,
  `status3` varchar(20) DEFAULT NULL,
  `company_name4` varchar(255) DEFAULT NULL,
  `company_address4` varchar(255) DEFAULT NULL,
  `position4` varchar(255) DEFAULT NULL,
  `inclusive_dates_start4` varchar(20) DEFAULT NULL,
  `inclusive_dates_end4` varchar(20) NOT NULL,
  `status4` varchar(20) DEFAULT NULL,
  `company_name5` varchar(255) DEFAULT NULL,
  `company_address5` varchar(255) DEFAULT NULL,
  `position5` varchar(255) DEFAULT NULL,
  `inclusive_dates_start5` varchar(20) DEFAULT NULL,
  `inclusive_dates_end5` varchar(20) NOT NULL,
  `status5` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`work_experience_id`, `applicant_id`, `company_name1`, `company_address1`, `position1`, `inclusive_dates_start1`, `inclusive_dates_end1`, `status1`, `company_name2`, `company_address2`, `position2`, `inclusive_dates_start2`, `inclusive_dates_end2`, `status2`, `company_name3`, `company_address3`, `position3`, `inclusive_dates_start3`, `inclusive_dates_end3`, `status3`, `company_name4`, `company_address4`, `position4`, `inclusive_dates_start4`, `inclusive_dates_end4`, `status4`, `company_name5`, `company_address5`, `position5`, `inclusive_dates_start5`, `inclusive_dates_end5`, `status5`) VALUES
(43, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(44, 178, 'los arcos', 'tungko', 'housekeeping', '2018-06-30', '2018-07-12', 'Part-time', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(45, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(46, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(47, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(48, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(49, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(50, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(51, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(52, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(53, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(54, 178, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(55, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(56, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(57, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(58, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(59, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(60, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(61, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(62, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(63, 180, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(65, 182, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(66, 183, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(67, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(68, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(69, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(70, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(71, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(72, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(73, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(74, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(75, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(76, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(77, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(78, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(79, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(80, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(81, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(82, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(83, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(84, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(85, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(86, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(87, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(88, 184, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(89, 185, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(90, 185, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(92, 199, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(93, 202, 'ffds', '', '', '', '', '', 'dsfdfsf', '', '', '', '', '', 'dsfsd', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(94, 203, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(95, 205, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(96, 206, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(97, 207, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(98, 207, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(99, 208, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(100, 209, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(101, 210, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(102, 211, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(103, 212, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(104, 213, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(105, 214, 'Los Arcos de Hermano Resort', 'Tungkong Mangga', 'Housekeeping', '2018-05-30', '2018-06-12', 'Contractual', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(106, 215, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(107, 216, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educational_background`
--
ALTER TABLE `educational_background`
  ADD PRIMARY KEY (`educ_background_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD PRIMARY KEY (`eligibility_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_info`
--
ALTER TABLE `employer_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_id` (`employer_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `nsrp_form`
--
ALTER TABLE `nsrp_form`
  ADD PRIMARY KEY (`nsrp_id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `personal_info_id` (`personal_info_id`),
  ADD KEY `preference_id` (`preference_id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `educ_background_id` (`educ_background_id`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`personal_info_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`preference_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skills_id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `fk_skills_category` (`category_id`);

--
-- Indexes for table `skill_categories`
--
ALTER TABLE `skill_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`work_experience_id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `educational_background`
--
ALTER TABLE `educational_background`
  MODIFY `educ_background_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `eligibility`
--
ALTER TABLE `eligibility`
  MODIFY `eligibility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `employer_info`
--
ALTER TABLE `employer_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `nsrp_form`
--
ALTER TABLE `nsrp_form`
  MODIFY `nsrp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `personal_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `preference`
--
ALTER TABLE `preference`
  MODIFY `preference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skills_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `skill_categories`
--
ALTER TABLE `skill_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `work_experience_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `educational_background`
--
ALTER TABLE `educational_background`
  ADD CONSTRAINT `educational_background_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD CONSTRAINT `eligibility_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `employer_info`
--
ALTER TABLE `employer_info`
  ADD CONSTRAINT `employer_info_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`);

--
-- Constraints for table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `language_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `nsrp_form`
--
ALTER TABLE `nsrp_form`
  ADD CONSTRAINT `nsrp_form_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`),
  ADD CONSTRAINT `nsrp_form_ibfk_2` FOREIGN KEY (`personal_info_id`) REFERENCES `personal_info` (`personal_info_id`),
  ADD CONSTRAINT `nsrp_form_ibfk_3` FOREIGN KEY (`preference_id`) REFERENCES `preference` (`preference_id`),
  ADD CONSTRAINT `nsrp_form_ibfk_4` FOREIGN KEY (`language_id`) REFERENCES `language` (`language_id`),
  ADD CONSTRAINT `nsrp_form_ibfk_5` FOREIGN KEY (`educ_background_id`) REFERENCES `educational_background` (`educ_background_id`);

--
-- Constraints for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD CONSTRAINT `personal_info_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `preference`
--
ALTER TABLE `preference`
  ADD CONSTRAINT `preference_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `fk_skills_category` FOREIGN KEY (`category_id`) REFERENCES `skill_categories` (`category_id`),
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD CONSTRAINT `work_experience_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
