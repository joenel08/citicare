-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2025 at 03:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_list`
--

CREATE TABLE `academic_list` (
  `id` int(30) NOT NULL,
  `year` text NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_list`
--

INSERT INTO `academic_list` (`id`, `year`, `is_default`) VALUES
(2, '2019-2020', 0),
(3, '2020-2021', 1),
(4, '2021-2022', 0);

-- --------------------------------------------------------

--
-- Table structure for table `adviser_finaldefense_score`
--

CREATE TABLE `adviser_finaldefense_score` (
  `a_fd_s` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `deliverables` float NOT NULL,
  `attendance` float NOT NULL,
  `attitude` float NOT NULL,
  `date_scored` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adviser_finalfinaldefense_score`
--

CREATE TABLE `adviser_finalfinaldefense_score` (
  `a_fd_s` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `deliverables` float NOT NULL,
  `attendance` float NOT NULL,
  `attitude` float NOT NULL,
  `date_scored` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_list`
--

CREATE TABLE `class_list` (
  `cl_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `tl_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_enrolled` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(11) NOT NULL,
  `collegeName` varchar(100) NOT NULL,
  `collegeAbb` varchar(10) NOT NULL,
  `logoImg` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `collegeName`, `collegeAbb`, `logoImg`, `date_added`) VALUES
(1, 'College of Computing Studies Information and Communication Technologyf', 'ccsict', '1721568360_pngwing.com (7).png', '2024-07-20 23:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `ps_id` int(11) NOT NULL,
  `paper_comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `defense_schedule`
--

CREATE TABLE `defense_schedule` (
  `ds_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `tl_id` int(11) NOT NULL,
  `schedule` datetime NOT NULL,
  `date_requested` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_list`
--

CREATE TABLE `faculty_list` (
  `id` int(30) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `college_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `faculty_type` tinyint(4) NOT NULL COMMENT '1=Dean\r\n2=Program Chair\r\n3 = secretary\r\n4 plain faculty\r\n5 cos faculty\r\n6 staff',
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `signature` text DEFAULT NULL,
  `avatar` text DEFAULT '\'no-image-available.png\'',
  `isVerified` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_list`
--

INSERT INTO `faculty_list` (`id`, `school_id`, `college_id`, `program_id`, `firstname`, `lastname`, `faculty_type`, `email`, `password`, `signature`, `avatar`, `isVerified`, `date_created`) VALUES
(2, '2835826', 1, 20, 'Rose Mary', 'Laggui', 2, 'sampleprogramchair@gmail.com', '85b954cf9565b9c54add85f09281a50b', '2_signature_1736775172.png', 'no-image-available.png', 1, '2024-07-21 22:24:56'),
(3, '453', 1, 20, 'dsg', 'dkfgj', 4, 'plain_faculty@gmail.com', '85b954cf9565b9c54add85f09281a50b', '', '\'no-image-available.png\'', 1, '2024-09-07 22:04:53'),
(4, '2174', 1, 20, 'dsjgh', 'hjdg', 5, 'cos@gmail.com', '85b954cf9565b9c54add85f09281a50b', '', '\'no-image-available.png\'', 1, '2024-09-07 22:05:21'),
(5, 'e3576', 1, 20, 'Ivy', 'Tarun', 1, 'dean@gmail.com', '85b954cf9565b9c54add85f09281a50b', '1732360740_download.png', '\'no-image-available.png\'', 1, '2024-09-07 22:06:03'),
(6, '986387', 1, 20, 'djsghsdg', 'fkjdhfh', 4, 'sampleadviser@gmail.com', 'fd7ab343a521997a51080cb54c8edb37', '', '\'no-image-available.png\'', 1, '2024-11-01 13:12:31'),
(7, '38765', 1, 20, 'kdhgs', 'fk', 5, 'samplepanelmember@gmail.com', '2e65419344b337c2d05157c6311838de', '', '\'no-image-available.png\'', 1, '2024-11-01 13:13:23'),
(8, '982357', 1, 20, 'dflkhj', 'dfkn', 4, 'samplepanelmember1@gmail.com', '2e65419344b337c2d05157c6311838de', '', '\'no-image-available.png\'', 1, '2024-11-01 13:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `final_group_final_defense_scores`
--

CREATE TABLE `final_group_final_defense_scores` (
  `gfd_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `intro` decimal(5,2) DEFAULT NULL,
  `sop` decimal(5,2) DEFAULT NULL,
  `scope` decimal(5,2) DEFAULT NULL,
  `rrl` decimal(5,2) DEFAULT NULL,
  `solid_background` decimal(10,0) NOT NULL,
  `auxiliary_theories` decimal(10,0) NOT NULL,
  `sources` decimal(5,2) NOT NULL,
  `rrl_scope` decimal(5,2) NOT NULL,
  `comprehensive_discussion` decimal(5,2) DEFAULT NULL,
  `methodology` decimal(5,2) DEFAULT NULL,
  `requirements_specification` decimal(5,2) DEFAULT NULL,
  `design_tools` decimal(5,2) DEFAULT NULL,
  `techniques` decimal(5,2) DEFAULT NULL,
  `panel_id` int(11) DEFAULT NULL,
  `defense_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupings_list`
--

CREATE TABLE `groupings_list` (
  `g_id` int(11) NOT NULL,
  `tl_id` int(11) NOT NULL,
  `group_no` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_grouped` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_final_defense_scores`
--

CREATE TABLE `group_final_defense_scores` (
  `gfd_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `intro` decimal(5,2) DEFAULT NULL,
  `sop` decimal(5,2) DEFAULT NULL,
  `scope` decimal(5,2) DEFAULT NULL,
  `significance` decimal(5,2) DEFAULT NULL,
  `rrl` decimal(5,2) DEFAULT NULL,
  `solid_background` decimal(5,2) DEFAULT NULL,
  `auxiliary_theories` decimal(5,2) DEFAULT NULL,
  `sources` decimal(5,2) DEFAULT NULL,
  `rrl_scope` decimal(5,2) DEFAULT NULL,
  `methodology` decimal(5,2) DEFAULT NULL,
  `requirements_specs` decimal(5,2) DEFAULT NULL,
  `design_tools` decimal(5,2) DEFAULT NULL,
  `techniques` decimal(5,2) DEFAULT NULL,
  `panel_id` int(11) DEFAULT NULL,
  `defense_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `gm_id` int(11) NOT NULL,
  `tl_id` int(11) NOT NULL,
  `g_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `isAccepted` int(11) NOT NULL,
  `date_chosen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `individual_finaldefense_scores`
--

CREATE TABLE `individual_finaldefense_scores` (
  `fd_id` int(11) NOT NULL,
  `academic_id` int(11) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `comprehensiveness` decimal(5,2) DEFAULT NULL,
  `contribution` decimal(5,2) DEFAULT NULL,
  `delivery` decimal(5,2) DEFAULT NULL,
  `panel_id` int(11) DEFAULT NULL,
  `defense_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `individual_finalfinaldefense_scores`
--

CREATE TABLE `individual_finalfinaldefense_scores` (
  `fd_id` int(11) NOT NULL,
  `academic_id` int(11) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `comprehensiveness` decimal(5,2) DEFAULT NULL,
  `contribution` decimal(5,2) DEFAULT NULL,
  `delivery` decimal(5,2) DEFAULT NULL,
  `panel_id` int(11) DEFAULT NULL,
  `defense_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `link_subjects`
--

CREATE TABLE `link_subjects` (
  `ls_id` int(11) NOT NULL,
  `sub_id_1` int(11) NOT NULL,
  `sub_id_2` int(11) NOT NULL,
  `date_linked` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `link_teachingload`
--

CREATE TABLE `link_teachingload` (
  `lt_id` int(11) NOT NULL,
  `tl_id_1` int(11) NOT NULL,
  `tl_id_2` int(11) NOT NULL,
  `date_linked` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `link_teachingload`
--

INSERT INTO `link_teachingload` (`lt_id`, `tl_id_1`, `tl_id_2`, `date_linked`) VALUES
(2, 2, 1, '2024-11-13 15:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `oral_proposal`
--

CREATE TABLE `oral_proposal` (
  `op_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `commentsAndSuggestion` text NOT NULL,
  `dateOral` date NOT NULL DEFAULT current_timestamp(),
  `dateGraded` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `panel_members`
--

CREATE TABLE `panel_members` (
  `pm_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `g_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `isAdviser` tinyint(4) NOT NULL,
  `isAcceptedAdviser` tinyint(4) NOT NULL,
  `isAcceptedPM` tinyint(4) NOT NULL,
  `date_chosen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paperreferences`
--

CREATE TABLE `paperreferences` (
  `pr_id` int(11) NOT NULL,
  `ps_id` int(11) NOT NULL,
  `paperReference` text NOT NULL,
  `referenceLink` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paper_submission`
--

CREATE TABLE `paper_submission` (
  `ps_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `g_id` int(11) NOT NULL,
  `paperTitle` varchar(500) NOT NULL,
  `thesisData` text NOT NULL,
  `thesisVersion` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `forChecking` tinyint(4) NOT NULL COMMENT '0=No, 1=Yes',
  `date_submitted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `dep_id` int(11) NOT NULL,
  `programs` varchar(10) NOT NULL,
  `department` varchar(200) NOT NULL,
  `college` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`dep_id`, `programs`, `department`, `college`) VALUES
(20, 'BSIT', 'Bachelor of Science in Information Technology', 1),
(21, 'BSCS', 'Bachelor of Science in Computer Science', 1),
(22, 'BSCPE', 'Bachelor of Science in Computer Engineering', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section_list`
--

CREATE TABLE `section_list` (
  `sec_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `sectionName` varchar(50) NOT NULL,
  `sectionDescription` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section_list`
--

INSERT INTO `section_list` (`sec_id`, `college_id`, `program_id`, `sectionName`, `sectionDescription`, `date_added`) VALUES
(1, 1, 20, '3 A', 'sdhj fh', '2024-07-21 23:31:57'),
(2, 1, 21, 'BSCS 3', 'sdkhj sdkfhj', '2024-10-30 12:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(30) NOT NULL,
  `college_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `class_id` int(30) NOT NULL,
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `isVerified` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `college_id`, `program_id`, `school_id`, `firstname`, `lastname`, `email`, `password`, `class_id`, `avatar`, `isVerified`, `date_created`) VALUES
(1, 31, 20, '6231415', 'John', 'Smith', 'jsmith@sample.com', 'ad6a280417a0f533d8b670c61667e1a0', 1, '1608012360_avatar.jpg', 1, '2020-12-15 14:06:14'),
(2, 31, 20, '101497', 'Claire', 'Blake', 'cblake@sample.com', 'ad6a280417a0f533d8b670c61667e1a0', 1, '1608012720_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg', 1, '2020-12-15 14:12:03'),
(3, 31, 20, '123', 'Mike', 'Williams', 'mwilliams@sample.com', 'ad6a280417a0f533d8b670c61667e1a0', 1, '1608034680_1605601740_download.jpg', 0, '2020-12-15 20:18:22'),
(4, 1, 20, '09735', 'dkjg', 'dkjh', 'samplenewstudent@gmail.com', 'ad6a280417a0f533d8b670c61667e1a0', 1, 'no-image-available.png', 0, '2024-11-01 11:47:55'),
(5, 1, 20, '38765', 'cmdn', 'dfjng', 'samplenewstudent1@gmail.com', 'ad6a280417a0f533d8b670c61667e1a0', 1, 'no-image-available.png', 0, '2024-11-01 11:48:21'),
(6, 1, 20, '29865265', 'sample', 'again', 'sampleagain@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'no-image-available.png', 1, '2024-12-10 14:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `subject_list`
--

CREATE TABLE `subject_list` (
  `sub_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `subjectCode` varchar(50) NOT NULL,
  `subjectName` text NOT NULL,
  `subjectDescription` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_list`
--

INSERT INTO `subject_list` (`sub_id`, `academic_id`, `college_id`, `program_id`, `subjectCode`, `subjectName`, `subjectDescription`, `date_added`) VALUES
(5, 4, 1, 20, 'T101', 'Capstone', 'fhd dkhg kdkgh ', '2024-07-21 22:57:03'),
(8, 4, 1, 20, '123', 'sfsdgdg', 'dsfdsgsd', '2024-11-01 17:16:09'),
(9, 4, 1, 20, 'T102', 'Thesis Dissertation 2', 'ldfkhg kdg', '2024-11-12 19:31:05'),
(10, 3, 1, 21, 'R1', 'Research', 'sgasgasg', '2025-01-13 21:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Thesis Management', 'info@sample.comm', '+6948 8542 623', '2102  Caldwell Road, Rochester, New York, 14608', '');

-- --------------------------------------------------------

--
-- Table structure for table `teachingload_list`
--

CREATE TABLE `teachingload_list` (
  `tl_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `groupNo` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachingload_list`
--

INSERT INTO `teachingload_list` (`tl_id`, `academic_id`, `college_id`, `program_id`, `teacher_id`, `subject_id`, `section_id`, `groupNo`, `date_created`) VALUES
(1, 3, 31, 20, 2, 5, 1, 2, '2024-07-22 14:36:10'),
(3, 3, 1, 21, 3, 10, 2, 0, '2025-01-13 21:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `thesis_defended`
--

CREATE TABLE `thesis_defended` (
  `td_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `date_defended` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `title_defended`
--

CREATE TABLE `title_defended` (
  `tid_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `academic_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date_marked` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `title_submissions`
--

CREATE TABLE `title_submissions` (
  `t_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `researchTitle` varchar(255) NOT NULL,
  `objectives` text NOT NULL,
  `isAccepted` tinyint(4) NOT NULL,
  `date_submitted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `isVerified` tinyint(4) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `avatar`, `isVerified`, `date_created`) VALUES
(1, 'Administrator', '', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', '1607135820_avatar.jpg', 1, '2020-11-26 10:57:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_list`
--
ALTER TABLE `academic_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adviser_finaldefense_score`
--
ALTER TABLE `adviser_finaldefense_score`
  ADD PRIMARY KEY (`a_fd_s`);

--
-- Indexes for table `adviser_finalfinaldefense_score`
--
ALTER TABLE `adviser_finalfinaldefense_score`
  ADD PRIMARY KEY (`a_fd_s`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `defense_schedule`
--
ALTER TABLE `defense_schedule`
  ADD PRIMARY KEY (`ds_id`);

--
-- Indexes for table `faculty_list`
--
ALTER TABLE `faculty_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_group_final_defense_scores`
--
ALTER TABLE `final_group_final_defense_scores`
  ADD PRIMARY KEY (`gfd_id`);

--
-- Indexes for table `groupings_list`
--
ALTER TABLE `groupings_list`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `group_final_defense_scores`
--
ALTER TABLE `group_final_defense_scores`
  ADD PRIMARY KEY (`gfd_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`gm_id`);

--
-- Indexes for table `individual_finaldefense_scores`
--
ALTER TABLE `individual_finaldefense_scores`
  ADD PRIMARY KEY (`fd_id`);

--
-- Indexes for table `individual_finalfinaldefense_scores`
--
ALTER TABLE `individual_finalfinaldefense_scores`
  ADD PRIMARY KEY (`fd_id`);

--
-- Indexes for table `link_subjects`
--
ALTER TABLE `link_subjects`
  ADD PRIMARY KEY (`ls_id`);

--
-- Indexes for table `link_teachingload`
--
ALTER TABLE `link_teachingload`
  ADD PRIMARY KEY (`lt_id`);

--
-- Indexes for table `oral_proposal`
--
ALTER TABLE `oral_proposal`
  ADD PRIMARY KEY (`op_id`);

--
-- Indexes for table `panel_members`
--
ALTER TABLE `panel_members`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `paperreferences`
--
ALTER TABLE `paperreferences`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `paper_submission`
--
ALTER TABLE `paper_submission`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`dep_id`),
  ADD KEY `college` (`college`);

--
-- Indexes for table `section_list`
--
ALTER TABLE `section_list`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachingload_list`
--
ALTER TABLE `teachingload_list`
  ADD PRIMARY KEY (`tl_id`);

--
-- Indexes for table `thesis_defended`
--
ALTER TABLE `thesis_defended`
  ADD PRIMARY KEY (`td_id`);

--
-- Indexes for table `title_defended`
--
ALTER TABLE `title_defended`
  ADD PRIMARY KEY (`tid_id`);

--
-- Indexes for table `title_submissions`
--
ALTER TABLE `title_submissions`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_list`
--
ALTER TABLE `academic_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `adviser_finaldefense_score`
--
ALTER TABLE `adviser_finaldefense_score`
  MODIFY `a_fd_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `adviser_finalfinaldefense_score`
--
ALTER TABLE `adviser_finalfinaldefense_score`
  MODIFY `a_fd_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `class_list`
--
ALTER TABLE `class_list`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `defense_schedule`
--
ALTER TABLE `defense_schedule`
  MODIFY `ds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty_list`
--
ALTER TABLE `faculty_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `final_group_final_defense_scores`
--
ALTER TABLE `final_group_final_defense_scores`
  MODIFY `gfd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groupings_list`
--
ALTER TABLE `groupings_list`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_final_defense_scores`
--
ALTER TABLE `group_final_defense_scores`
  MODIFY `gfd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `gm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `individual_finaldefense_scores`
--
ALTER TABLE `individual_finaldefense_scores`
  MODIFY `fd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `individual_finalfinaldefense_scores`
--
ALTER TABLE `individual_finalfinaldefense_scores`
  MODIFY `fd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `link_subjects`
--
ALTER TABLE `link_subjects`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `link_teachingload`
--
ALTER TABLE `link_teachingload`
  MODIFY `lt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oral_proposal`
--
ALTER TABLE `oral_proposal`
  MODIFY `op_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `panel_members`
--
ALTER TABLE `panel_members`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `paperreferences`
--
ALTER TABLE `paperreferences`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paper_submission`
--
ALTER TABLE `paper_submission`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `section_list`
--
ALTER TABLE `section_list`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachingload_list`
--
ALTER TABLE `teachingload_list`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thesis_defended`
--
ALTER TABLE `thesis_defended`
  MODIFY `td_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `title_defended`
--
ALTER TABLE `title_defended`
  MODIFY `tid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `title_submissions`
--
ALTER TABLE `title_submissions`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
