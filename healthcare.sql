-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2014 at 01:29 AM
-- Server version: 5.0.24
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `app_patient_id` int(15) NOT NULL,
  `app_date` date NOT NULL,
  `app_time` varchar(10) default NULL,
  `app_doctorusername` varchar(50) default NULL,
  `app_patientusername` varchar(50) default NULL,
  `app_number` int(11) NOT NULL,
  `app_patientname` varchar(50) NOT NULL,
  `app_doctorname` varchar(50) NOT NULL,
  `app_hospital` varchar(50) NOT NULL,
  `app_status` varchar(50) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--


-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_username` varchar(50) NOT NULL,
  `doctor_password` varchar(50) NOT NULL,
  `doctor_email` varchar(50) NOT NULL,
  `doctor_lname` varchar(50) NOT NULL,
  `doctor_fname` varchar(50) NOT NULL,
  `doctor_mname` varchar(50) NOT NULL,
  `doctor_specialization` varchar(50) NOT NULL,
  `doctor_hospital` varchar(50) NOT NULL,
  `contactno` varchar(50) default NULL,
  `doctor_rstatus` varchar(20) default NULL,
  `doctor_licenseno` int(20) default NULL,
  `doctor_sched_wday` varchar(160) default NULL,
  `doctor_sched_sat` varchar(160) default NULL,
  `doctor_sched_sun` varchar(160) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_username`, `doctor_password`, `doctor_email`, `doctor_lname`, `doctor_fname`, `doctor_mname`, `doctor_specialization`, `doctor_hospital`, `contactno`, `doctor_rstatus`, `doctor_licenseno`, `doctor_sched_wday`, `doctor_sched_sat`, `doctor_sched_sun`) VALUES
('dileep', '5f4dcc3b5aa765d61d8327deb882cf99', 'dileep08@gmail.com', 'b', 'dileep', ' ', 'MBBS', 'Choondal', 'Althara,680505', 'approved', 456789, '8:00AM,8:30AM,9:00AM,9:30AM,10:00AM,10:30AM,11:00AM,11:30AM,12:00PM,', '9:00AM,10:00AM,11:00AM,12:00PM,', '9:00AM,10:00AM,11:00AM,12:00PM,');

-- --------------------------------------------------------

--
-- Table structure for table `notification_system`
--

CREATE TABLE IF NOT EXISTS `notification_system` (
  `notif_no` int(11) NOT NULL,
  `sender` varchar(50) default NULL,
  `receiver` varchar(50) default NULL,
  `notif_type` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_system`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(15) NOT NULL,
  `patient_username` varchar(50) default NULL,
  `patient_password` varchar(50) default NULL,
  `patient_eadd` varchar(50) default NULL,
  `patient_lname` varchar(50) default NULL,
  `patient_fname` varchar(50) default NULL,
  `patient_mname` varchar(50) default NULL,
  `patient_sickness` varchar(50) default NULL,
  `patient_age` int(11) NOT NULL,
  `patient_birthdate` date NOT NULL,
  `patient_gender` varchar(10) default NULL,
  `patient_height` int(11) NOT NULL,
  `patient_weight` int(11) NOT NULL,
  `patient_status` varchar(50) default NULL,
  `patient_address` varchar(50) default NULL,
  `patient_contactno` varchar(50) default NULL,
  `patient_rstatus` varchar(20) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_username`, `patient_password`, `patient_eadd`, `patient_lname`, `patient_fname`, `patient_mname`, `patient_sickness`, `patient_age`, `patient_birthdate`, `patient_gender`, `patient_height`, `patient_weight`, `patient_status`, `patient_address`, `patient_contactno`, `patient_rstatus`) VALUES
(360267, 'akhil', '5f4dcc3b5aa765d61d8327deb882cf99', 'pearlzmasters@gmail.com', 'shah', 'akhil', '', 'Fever', 24, '1989-10-11', 'male', 180, 55, 'single', 'Thrissur,680501', 'Thrissur,680501', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `patient_id` int(15) NOT NULL,
  `dates` date NOT NULL,
  `patientname` varchar(50) NOT NULL,
  `sickness` varchar(50) NOT NULL,
  `doctorname` varchar(50) NOT NULL,
  `casereport` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`patient_id`, `dates`, `patientname`, `sickness`, `doctorname`, `casereport`) VALUES
(360267, '2013-10-24', 'akhil  shah', 'fever', 'dileep', 'fever with cold'),
(360267, '2013-10-22', 'akhil  shah', 'cold', 'dileep', 'cold with fever');
