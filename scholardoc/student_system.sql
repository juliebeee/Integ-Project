-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 01:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendarevents`
--

CREATE TABLE `calendarevents` (
  `event_id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `event_note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendarevents`
--

INSERT INTO `calendarevents` (`event_id`, `date`, `event_note`) VALUES
(1, '2024-5-21', 'hayss\r\n'),
(2, '2024-5-16', 'secret'),
(3, '2024-5-23', 'pagod\r\n'),
(4, '2024-6-02', 'swimming');

-- --------------------------------------------------------

--
-- Table structure for table `fourthyear`
--

CREATE TABLE `fourthyear` (
  `id` int(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id_no` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `year_course` varchar(100) NOT NULL,
  `school` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `1st_midterm_status` varchar(100) DEFAULT NULL,
  `1st_final_status` varchar(100) DEFAULT NULL,
  `2nd_midterm_status` varchar(100) DEFAULT NULL,
  `2nd_final_status` varchar(100) DEFAULT NULL,
  `file_0` varchar(100) DEFAULT NULL,
  `file_1` varchar(100) DEFAULT NULL,
  `file_2` varchar(100) DEFAULT NULL,
  `file_3` varchar(100) DEFAULT NULL,
  `file_4` varchar(100) DEFAULT NULL,
  `file_5` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fourthyear`
--

INSERT INTO `fourthyear` (`id`, `full_name`, `student_id_no`, `password`, `year_course`, `school`, `gender`, `address`, `contact_number`, `email_address`, `1st_midterm_status`, `1st_final_status`, `2nd_midterm_status`, `2nd_final_status`, `file_0`, `file_1`, `file_2`, `file_3`, `file_4`, `file_5`) VALUES
(1, 'Terreinz Jhaztine Motol', '42B0128', '', 'BS  Information System', 'MSC', 'Male', 'Torrijos', '9123456806', 'motol@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Jhayvie Ann Perilla', '42B0129', '', 'BS  Information System', 'MSC', 'Female', 'Sta Cruz', '9123456807', 'perilla@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Shiela Rey', '42B0130', '', 'BS  Information System', 'MSC', 'Female', 'Sta Cruz', '9123456808', 'rey@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Reizel Faith Saporna', '42B0131', '', 'BS Information Technology', 'MSC', 'Female', 'Buenavista', '9123456809', 'saporna@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Jhon Earl Sarcia', '42B0132', '$2y$10$XkGM.nqBli19lMYy0lK2EOEZMpzmhxg9Mkln2ubOJ71o4TAP.4laK', 'BS Information Technology', 'MSC', 'Male', 'Gasan', '9123456810', 'sarcia@gmail.com', 'Received', 'Received', 'Received', 'Pending', 'C:/xampp/htdocs/scholardoc/student/fileupload/sampledata.csv', NULL, NULL, NULL, NULL, NULL),
(6, 'Sedney Semilla', '42B0133', '', 'BS  Information System', 'MSC', 'Female', 'Gasan', '9123456811', 'semilla@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Remark John Tampol', '42B0134', '', 'BS  Information System', 'MSC', 'Male', 'Buenavista', '9123456812', 'tampol@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Fritz Jenner Vitto', '42B0135', '', 'BS  Information System', 'MSC', 'Male', 'Gasan', '9123456813', 'vitto@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `secondyear`
--

CREATE TABLE `secondyear` (
  `id` int(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id_no` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `year_course` varchar(100) NOT NULL,
  `school` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `1st_midterm_status` varchar(100) DEFAULT NULL,
  `1st_final_status` varchar(100) DEFAULT NULL,
  `2nd_midterm_status` varchar(100) DEFAULT NULL,
  `2nd_final_status` varchar(100) DEFAULT NULL,
  `file_0` varchar(100) DEFAULT NULL,
  `file_1` varchar(100) DEFAULT NULL,
  `file_2` varchar(100) DEFAULT NULL,
  `file_3` varchar(100) DEFAULT NULL,
  `file_4` varchar(100) DEFAULT NULL,
  `file_5` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `secondyear`
--

INSERT INTO `secondyear` (`id`, `full_name`, `student_id_no`, `password`, `year_course`, `school`, `gender`, `address`, `contact_number`, `email_address`, `1st_midterm_status`, `1st_final_status`, `2nd_midterm_status`, `2nd_final_status`, `file_0`, `file_1`, `file_2`, `file_3`, `file_4`, `file_5`) VALUES
(1, 'Wildel Bravo', '22B0111', '', 'BS Information Technology', 'MSC', 'Male', 'Buenavista', '9123456789', 'bravo@gmail.com', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Danica Cancino', '22B0112', '', 'BS  Information System', 'MSC', 'Female', 'Gasan', '9123456790', 'cancino@gmail.com', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Genese Charlire', '22B0113', '', 'BS Information Technology', 'MSC', 'Male', 'Boac', '9123456791', 'gense@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Robert Ivan Grajo', '22B0114', '', 'BS  Information System', 'MSC', 'Male', 'Boac', '9123456792', 'grajo@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Chenilain Lacap', '22B0115', '', 'BS Information Technology', 'MSC', 'Female', 'Gasan', '9123456793', 'lacap@gmail.com', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Albert Laurente', '22B0116', '', 'BS  Information System', 'MSC', 'Male', 'Mogpog', '9123456794', 'laurente@gmail.com', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Athea Lecaros', '22B0117', '', 'BS Information Technology', 'MSC', 'Female', 'Gasan', '9123456795', 'lecaros@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'John Vilson Logmao', '22B0118', '', 'BS  Information System', 'MSC', 'Male', 'Mogpog', '9123456796', 'logmao@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Julie Anne Lopez', '22B0119', '', 'BS Information Technology', 'MSC', 'Female', 'Gasan', '9123456797', 'lopez@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Marc Jomari Malacas', '22B0120', '', 'BS Information Technology', 'MSC', 'Male', 'Boac', '9123456798', 'malacas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thirdyear`
--

CREATE TABLE `thirdyear` (
  `id` int(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `student_id_no` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `year_course` varchar(100) NOT NULL,
  `school` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `1st_midterm_status` varchar(100) DEFAULT NULL,
  `1st_final_status` varchar(100) DEFAULT NULL,
  `2nd_midterm_status` varchar(100) DEFAULT NULL,
  `2nd_final_status` varchar(100) DEFAULT NULL,
  `file_0` varchar(100) DEFAULT NULL,
  `file_1` varchar(100) DEFAULT NULL,
  `file_2` varchar(100) DEFAULT NULL,
  `file_3` varchar(100) DEFAULT NULL,
  `file_4` varchar(100) DEFAULT NULL,
  `file_5` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thirdyear`
--

INSERT INTO `thirdyear` (`id`, `full_name`, `student_id_no`, `password`, `year_course`, `school`, `gender`, `address`, `contact_number`, `email_address`, `1st_midterm_status`, `1st_final_status`, `2nd_midterm_status`, `2nd_final_status`, `file_0`, `file_1`, `file_2`, `file_3`, `file_4`, `file_5`) VALUES
(1, 'Ronnel Mangue', '32B0121', '', 'BS  Information System', 'MSC', 'Male', 'Mogpog', '9123456799', 'mague@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Bea Manzano', '32B0122', '', 'BS  Information System', 'MSC', 'Female', 'Mogpog', '9123456800', 'manzano@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Princes Mandalihan', '32B0123', '', 'BS Information Technology', 'MSC', 'Female', 'Sta Cruz', '9123456801', 'mandalihan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Heidy Marcelino', '32B0124', '', 'BS Information Technology', 'MSC', 'Female', 'Mogpog', '9123456802', 'marcelino@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Cristine Joy Mayores', '32B0125', '', 'BS Information Technology', 'MSC', 'Female', 'Mogpog', '9123456803', 'mayores@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Joshua Mendoza', '32B0126', '', 'BS Information Technology', 'MSC', 'Male', 'Boac', '9123456804', 'mendoza@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'John Rey Montiano', '32B0127', '', 'BS  Information System', 'MSC', 'Male', 'Boac', '9123456805', 'montiano2gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendarevents`
--
ALTER TABLE `calendarevents`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `fourthyear`
--
ALTER TABLE `fourthyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secondyear`
--
ALTER TABLE `secondyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thirdyear`
--
ALTER TABLE `thirdyear`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
