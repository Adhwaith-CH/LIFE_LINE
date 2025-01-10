-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 04:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lifeline`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'lifeline@2024', 'lifeline123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bloodgroup`
--

CREATE TABLE `tbl_bloodgroup` (
  `blood_id` int(10) NOT NULL,
  `blood_group` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bloodgroup`
--

INSERT INTO `tbl_bloodgroup` (`blood_id`, `blood_group`) VALUES
(52, 'O POSITIVE'),
(53, 'O NEGATIVE'),
(54, 'A POSITIVE'),
(55, 'A NEGATIVE'),
(56, 'B POSITIVE'),
(57, 'B NEGATIVE'),
(58, 'AB POSITIVE'),
(59, 'AB NEGATIVE'),
(62, 'A+VE'),
(63, 'A-VE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(10) NOT NULL,
  `complaint_title` varchar(100) NOT NULL,
  `complaint_description` varchar(100) NOT NULL,
  `complaint_reply` varchar(100) NOT NULL,
  `complaint_status` varchar(100) NOT NULL,
  `complaint_date` date NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_title`, `complaint_description`, `complaint_reply`, `complaint_status`, `complaint_date`, `user_id`) VALUES
(4, 'basil', 'complaint.....', 'ok', '', '2024-08-30', 49),
(5, 'basil', 'my first complaint', '', '', '2024-09-07', 59);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(99, 'KASARAGOD'),
(100, 'KANNUR'),
(101, 'KOZHIKODE'),
(103, 'WAYANAD'),
(104, 'MALAPPURAM'),
(105, 'THRISSUR'),
(106, 'PALAKKAD'),
(107, 'ERNAKULAM'),
(108, 'IDUKKI'),
(109, 'KOTTAYAM'),
(110, 'ALAPPUZHA'),
(111, 'PATHANAMTHITTA'),
(112, 'KOLLAM'),
(113, 'THIRUVANANTHAPURAM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donorrequest`
--

CREATE TABLE `tbl_donorrequest` (
  `donorrequest_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `drequest_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `donorrequest_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_donorrequest`
--

INSERT INTO `tbl_donorrequest` (`donorrequest_id`, `request_id`, `drequest_status`, `user_id`, `donorrequest_date`) VALUES
(6, 9, 1, 48, '2024-08-30'),
(7, 9, 1, 50, '2024-08-30'),
(8, 9, 1, 51, '2024-08-30'),
(9, 11, 1, 50, '2024-09-02'),
(10, 14, 1, 52, '2024-09-04'),
(11, 15, 1, 64, '2024-09-07'),
(12, 23, 0, 64, '2024-09-08'),
(13, 25, 0, 61, '2024-09-13'),
(14, 26, 0, 61, '2024-09-13'),
(15, 31, 0, 61, '2024-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(30) NOT NULL,
  `district_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(43, 'CHALAKUDI', '105'),
(44, 'KODUNGALLUR', '105'),
(45, 'KOTHAMANGALAM', '107'),
(46, 'MUVATTUPUZHA', '107');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(100) NOT NULL,
  `bloodgroup_id` varchar(100) NOT NULL,
  `type_id` varchar(100) NOT NULL,
  `place_id` varchar(100) NOT NULL,
  `request_requireddate` varchar(12) NOT NULL,
  `request_requestdate` varchar(12) NOT NULL,
  `request_quantity` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `request_status` int(11) NOT NULL DEFAULT 0,
  `userinfo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`request_id`, `bloodgroup_id`, `type_id`, `place_id`, `request_requireddate`, `request_requestdate`, `request_quantity`, `user_id`, `request_status`, `userinfo_id`) VALUES
(9, '53', '20', '43', '2024-11-30', '2024-08-30', '3', 49, 2, 0),
(10, '52', '20', '45', '2024-08-30', '2024-08-30', '5', 51, 1, 0),
(11, '53', '20', '45', '2024-09-02', '2024-09-02', '2', 48, 1, 0),
(12, '52', '20', '46', '2024-09-02', '2024-09-02', '2', 48, 1, 0),
(13, '52', '20', '45', '2024-09-02', '2024-09-02', '2', 51, 0, 0),
(14, '55', '20', '43', '2024-09-05', '2024-09-04', '4', 48, 0, 0),
(15, '54', '20', '43', '2024-09-07', '2024-09-07', '4', 59, 1, 0),
(16, '53', '20', '45', '2024-09-09', '2024-09-08', '2', 59, 1, 0),
(17, '52', '21', '45', '2024-09-08', '2024-09-08', '12', 59, 1, 0),
(18, '54', '20', '43', '2024-09-08', '2024-09-08', '21', 59, 1, 0),
(19, '54', '20', '43', '2024-09-08', '2024-09-08', '12', 59, 1, 0),
(20, '55', '20', '43', '2024-09-08', '2024-09-08', '12', 59, 1, 0),
(21, '52', '20', '43', '2024-09-08', '2024-09-08', '2', 59, 1, 0),
(22, '53', '20', '43', '2024-09-08', '2024-09-08', '2', 59, 0, 0),
(23, '52', '20', '46', '2024-09-08', '2024-09-08', '3', 59, 0, 0),
(24, '54', '20', '43', '2024-09-13', '2024-09-13', '2', 59, 0, 0),
(25, '56', '20', '45', '2024-09-13', '2024-09-13', '3', 59, 0, 0),
(26, '55', '20', '43', '2024-09-13', '2024-09-13', '3', 59, 0, 0),
(27, '57', '20', '44', '2024-09-13', '2024-09-13', '3', 59, 0, 0),
(28, '55', '20', '45', '2024-09-18', '2024-09-18', '3', 59, 0, 0),
(29, '54', '20', '43', '2024-09-23', '2024-09-23', '2', 59, 0, 0),
(30, '54', '20', '43', '2024-10-21', '2024-10-21', '2', 59, 0, 0),
(31, '54', '20', '45', '2024-10-22', '2024-10-21', '4', 59, 0, 0),
(32, '54', '20', '45', '2024-10-21', '2024-10-21', '2', 59, 0, 0),
(33, '53', '20', '45', '2024-10-21', '2024-10-21', '12', 59, 0, 0),
(34, '53', '20', '45', '2024-10-22', '2024-10-21', '14', 59, 0, 0),
(35, '53', '20', '46', '2024-10-21', '2024-10-21', '6', 59, 0, 0),
(36, '56', '20', '45', '2024-10-21', '2024-10-21', '12', 59, 0, 0),
(37, '53', '20', '43', '2024-10-22', '2024-10-21', '7', 59, 0, 0),
(38, '54', '20', '45', '2024-10-22', '2024-10-21', '100', 59, 0, 0),
(39, '53', '20', '46', '2024-10-25', '2024-10-21', '50', 59, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(20, 'BLOOD'),
(21, 'PLATELETS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_address` varchar(200) NOT NULL,
  `user_email` varchar(300) NOT NULL,
  `place_id` int(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_contact` varchar(11) NOT NULL,
  `user_dob` date DEFAULT NULL,
  `user_photo` varchar(100) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `user_height` varchar(30) NOT NULL,
  `user_weight` varchar(30) NOT NULL,
  `blood_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_address`, `user_email`, `place_id`, `gender`, `user_password`, `user_contact`, `user_dob`, `user_photo`, `user_status`, `user_height`, `user_weight`, `blood_id`) VALUES
(59, 'Adhwaith Hari', 'Chomattil House puthenchira (po) Mankidi, vayanasala', 'adhwaithhari2004@gmail.com', 43, 'male', '123', '9567577128', '2006-08-11', '1161876-free-assassins-creed-all-assassins-wallpaper-2880x1800-for-mobile.jpg', 1, '100', '90', 54),
(60, 'Adhwaith Hari', 'Chomattil House puthenchira (po) Mankidi, vayanasala', 'adhwaithhari2@gmail.com', 44, 'male', '123', '9567577128', '2006-09-01', 'Screenshot (27).png', 1, '110', '30', 54),
(61, 'Adhwaith Hari', 'Chomattil House puthenchira (po) Mankidi, vayanasala', 'adhwaithhari04@gmail.com', 46, 'male', '11', '9567577128', '2006-09-01', 'Screenshot (27).png', 1, '167', '80', 54),
(62, 'Adhwaith Hari', 'Chomattil House puthenchira (po) Mankidi, vayanasala', 'adhwaithhari4@gmail.com', 45, 'male', '12', '9567577128', '2006-09-01', 'Screenshot (27).png', 0, '', '', 0),
(64, 'Adhwaith Hari', 'Chomattil House puthenchira (po) Mankidi, vayanasala', 'adhwaithhari24@gmail.com', 45, 'male', '1', '9567577128', '2006-09-01', 'Screenshot (26).png', 1, '100', '80', 63),
(65, 'user 1', 'hjhjh', 'adhwaith@gmail.com', 45, 'male', '11', '9567577128', '2006-09-04', '1161876-free-assassins-creed-all-assassins-wallpaper-2880x1800-for-mobile.jpg', 1, '100', '80', 55);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userinfo`
--

CREATE TABLE `tbl_userinfo` (
  `userinfo_id` int(100) NOT NULL,
  `user_height` varchar(100) NOT NULL,
  `user_weight` varchar(100) NOT NULL,
  `user_bloodgroup` varchar(50) NOT NULL,
  `user_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userinfo`
--

INSERT INTO `tbl_userinfo` (`userinfo_id`, `user_height`, `user_weight`, `user_bloodgroup`, `user_id`) VALUES
(11, '100', '90', '57', '48'),
(12, '100', '90', '55', '48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_bloodgroup`
--
ALTER TABLE `tbl_bloodgroup`
  ADD PRIMARY KEY (`blood_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_donorrequest`
--
ALTER TABLE `tbl_donorrequest`
  ADD PRIMARY KEY (`donorrequest_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_userinfo`
--
ALTER TABLE `tbl_userinfo`
  ADD PRIMARY KEY (`userinfo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_bloodgroup`
--
ALTER TABLE `tbl_bloodgroup`
  MODIFY `blood_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `tbl_donorrequest`
--
ALTER TABLE `tbl_donorrequest`
  MODIFY `donorrequest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `request_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_userinfo`
--
ALTER TABLE `tbl_userinfo`
  MODIFY `userinfo_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
