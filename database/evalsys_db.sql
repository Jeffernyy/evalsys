-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 03:44 PM
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
-- Database: `evalsys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_list`
--

CREATE TABLE `academic_list` (
  `id` int(30) NOT NULL,
  `year` text NOT NULL,
  `semester` int(30) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Start,2=Closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_list`
--

INSERT INTO `academic_list` (`id`, `year`, `semester`, `is_default`, `status`) VALUES
(1, '2019-2020', 1, 0, 0),
(2, '2019-2020', 2, 0, 0),
(3, '2022-2023', 2, 1, 1),
(4, '2023-2024', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_l`
--

CREATE TABLE `class_l` (
  `class_id` int(10) NOT NULL,
  `program` varchar(1000) NOT NULL,
  `year` int(100) NOT NULL,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_l`
--

INSERT INTO `class_l` (`class_id`, `program`, `year`, `section`) VALUES
(1, 'BSIS', 1, 'A'),
(2, 'BSIS', 2, 'A'),
(3, 'BSIS', 3, 'A'),
(4, 'BSIS ', 4, 'A'),
(5, 'BSIS', 4, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `class_list`
--

CREATE TABLE `class_list` (
  `id` int(30) NOT NULL,
  `curriculum` text NOT NULL,
  `level` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_list`
--

INSERT INTO `class_list` (`id`, `curriculum`, `level`, `section`) VALUES
(1, 'BSIT', '1', 'A'),
(2, 'BSIT', '1', 'B'),
(3, 'BSIT', '1', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_list`
--

CREATE TABLE `criteria_list` (
  `id` int(30) NOT NULL,
  `criteria` text NOT NULL,
  `type` int(10) NOT NULL COMMENT '(1=student, 2=faculty, 3=supervisor)',
  `order_by` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria_list`
--

INSERT INTO `criteria_list` (`id`, `criteria`, `type`, `order_by`) VALUES
(1, 'Communication & Information', 1, 0),
(2, 'Instruction & Learning', 1, 1),
(4, 'Engagement & Consultation', 1, 2),
(5, 'Assessment & Academic Integrity', 1, 3),
(6, 'General Assessment', 1, 4),
(7, 'Scholarship', 2, 5),
(8, 'Professionalism', 2, 6),
(9, 'Commitment', 2, 7),
(10, 'Items', 3, 8),
(11, 'df', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `curr_list`
--

CREATE TABLE `curr_list` (
  `id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `academic_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curr_list`
--

INSERT INTO `curr_list` (`id`, `subject_id`, `class_id`, `faculty_id`, `academic_id`) VALUES
(2, 1, 1, 1, 3),
(3, 2, 1, 2, 3),
(4, 3, 2, 3, 3),
(9, 4, 2, 4, 3),
(10, 7, 3, 4, 3),
(11, 9, 3, 4, 3),
(12, 12, 3, 3, 3),
(13, 8, 3, 5, 3),
(14, 10, 3, 5, 3),
(15, 11, 3, 5, 3),
(16, 14, 3, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `deduction_list`
--

CREATE TABLE `deduction_list` (
  `id` int(11) NOT NULL,
  `deduction_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deduction_list`
--

INSERT INTO `deduction_list` (`id`, `deduction_name`) VALUES
(1, 'Pag-Ibig Loan'),
(2, 'SSS Loan'),
(3, 'La Taza Contribution'),
(4, 'Pag-Asa Loan'),
(5, 'Tagum Cooperative Loan');

-- --------------------------------------------------------

--
-- Table structure for table `employee_deduction_list`
--

CREATE TABLE `employee_deduction_list` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(25) NOT NULL,
  `deduction_id` varchar(25) NOT NULL,
  `amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_deduction_list`
--

INSERT INTO `employee_deduction_list` (`id`, `employee_id`, `deduction_id`, `amount`) VALUES
(1, '3486236', '1', '100'),
(2, '3486236', '2', '200'),
(3, '3486236', '3', '300'),
(4, '3486236', '4', '400'),
(5, '3486236', '5', '500');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_answers`
--

CREATE TABLE `evaluation_answers` (
  `evaluation_id` int(30) NOT NULL,
  `question_id` int(30) NOT NULL,
  `rate` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_answers`
--

INSERT INTO `evaluation_answers` (`evaluation_id`, `question_id`, `rate`) VALUES
(5, 1, 5),
(5, 6, 5),
(5, 7, 5),
(5, 8, 5),
(5, 9, 5),
(5, 10, 5),
(5, 3, 5),
(5, 11, 5),
(5, 12, 5),
(5, 13, 5),
(5, 14, 5),
(5, 15, 5),
(5, 16, 5),
(5, 17, 5),
(5, 18, 5),
(5, 19, 5),
(5, 20, 5),
(5, 21, 5),
(5, 22, 5),
(5, 23, 5),
(5, 24, 5),
(5, 25, 5),
(5, 26, 5),
(5, 27, 5),
(5, 29, 5),
(6, 1, 4),
(6, 6, 5),
(6, 7, 5),
(6, 8, 4),
(6, 9, 5),
(6, 10, 5),
(6, 3, 5),
(6, 11, 5),
(6, 12, 5),
(6, 13, 5),
(6, 14, 5),
(6, 15, 5),
(6, 16, 5),
(6, 17, 5),
(6, 18, 5),
(6, 19, 5),
(6, 20, 5),
(6, 21, 5),
(6, 22, 5),
(6, 23, 5),
(6, 24, 5),
(6, 25, 5),
(6, 26, 5),
(6, 27, 5),
(6, 29, 5),
(7, 1, 5),
(7, 6, 5),
(7, 7, 5),
(7, 8, 5),
(7, 9, 5),
(7, 10, 5),
(7, 3, 5),
(7, 11, 5),
(7, 12, 5),
(7, 13, 5),
(7, 14, 5),
(7, 15, 5),
(7, 16, 5),
(7, 17, 5),
(7, 18, 5),
(7, 19, 5),
(7, 20, 5),
(7, 21, 5),
(7, 22, 5),
(7, 23, 5),
(7, 24, 5),
(7, 25, 5),
(7, 26, 5),
(7, 27, 5),
(7, 29, 5),
(8, 1, 5),
(8, 6, 5),
(8, 7, 5),
(8, 8, 5),
(8, 9, 5),
(8, 10, 5),
(8, 3, 5),
(8, 11, 5),
(8, 12, 5),
(8, 13, 5),
(8, 14, 5),
(8, 15, 5),
(8, 16, 5),
(8, 17, 5),
(8, 18, 5),
(8, 19, 5),
(8, 20, 5),
(8, 21, 5),
(8, 22, 5),
(8, 23, 5),
(8, 24, 5),
(8, 25, 5),
(8, 26, 5),
(8, 27, 5),
(8, 29, 5),
(9, 1, 5),
(9, 6, 5),
(9, 7, 5),
(9, 8, 5),
(9, 9, 5),
(9, 10, 5),
(9, 3, 5),
(9, 11, 5),
(9, 12, 5),
(9, 13, 5),
(9, 14, 5),
(9, 15, 5),
(9, 16, 5),
(9, 17, 5),
(9, 18, 5),
(9, 19, 5),
(9, 20, 5),
(9, 21, 5),
(9, 22, 5),
(9, 23, 5),
(9, 24, 5),
(9, 25, 5),
(9, 26, 5),
(9, 27, 5),
(9, 29, 5),
(10, 1, 5),
(10, 6, 5),
(10, 7, 5),
(10, 8, 5),
(10, 9, 5),
(10, 10, 5),
(10, 3, 5),
(10, 11, 5),
(10, 12, 5),
(10, 13, 5),
(10, 14, 5),
(10, 15, 5),
(10, 16, 5),
(10, 17, 5),
(10, 18, 5),
(10, 19, 5),
(10, 20, 5),
(10, 21, 5),
(10, 22, 5),
(10, 23, 5),
(10, 24, 5),
(10, 25, 5),
(10, 26, 5),
(10, 27, 5),
(10, 29, 5),
(11, 1, 5),
(11, 6, 5),
(11, 7, 5),
(11, 8, 5),
(11, 9, 5),
(11, 10, 5),
(11, 3, 5),
(11, 11, 5),
(11, 12, 5),
(11, 13, 5),
(11, 14, 5),
(11, 15, 5),
(11, 16, 5),
(11, 17, 5),
(11, 18, 5),
(11, 19, 5),
(11, 20, 5),
(11, 21, 5),
(11, 22, 5),
(11, 23, 5),
(11, 24, 5),
(11, 25, 5),
(11, 26, 5),
(11, 27, 5),
(11, 29, 5),
(12, 1, 5),
(12, 6, 5),
(12, 7, 5),
(12, 8, 5),
(12, 9, 5),
(12, 10, 5),
(12, 3, 5),
(12, 11, 5),
(12, 12, 5),
(12, 13, 5),
(12, 14, 5),
(12, 15, 5),
(12, 16, 5),
(12, 17, 5),
(12, 18, 5),
(12, 19, 5),
(12, 20, 5),
(12, 21, 5),
(12, 22, 5),
(12, 23, 5),
(12, 24, 5),
(12, 25, 5),
(12, 26, 5),
(12, 27, 5),
(12, 29, 5),
(13, 1, 5),
(13, 6, 4),
(13, 7, 5),
(13, 8, 5),
(13, 9, 5),
(13, 10, 5),
(13, 31, 5),
(13, 3, 5),
(13, 11, 5),
(13, 12, 5),
(13, 13, 5),
(13, 14, 5),
(13, 15, 5),
(13, 16, 5),
(13, 17, 5),
(13, 18, 5),
(13, 19, 5),
(13, 20, 5),
(13, 21, 5),
(13, 22, 5),
(13, 23, 5),
(13, 24, 5),
(13, 25, 5),
(13, 26, 5),
(13, 27, 5),
(13, 29, 5);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_list`
--

CREATE TABLE `evaluation_list` (
  `evaluation_id` int(30) NOT NULL,
  `academic_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `restriction_id` int(30) NOT NULL,
  `date_taken` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluation_list`
--

INSERT INTO `evaluation_list` (`evaluation_id`, `academic_id`, `class_id`, `student_id`, `subject_id`, `faculty_id`, `restriction_id`, `date_taken`) VALUES
(5, 3, 1, 4, 1, 1, 2, '2023-05-18 10:52:42'),
(6, 3, 1, 1, 1, 1, 2, '2023-05-18 10:54:03'),
(7, 3, 1, 1, 2, 2, 3, '2023-05-18 15:16:02'),
(8, 3, 1, 3, 1, 1, 2, '2023-05-27 22:36:41'),
(9, 3, 1, 3, 2, 2, 3, '2023-05-27 22:50:53'),
(10, 3, 2, 2, 3, 3, 4, '2023-05-27 22:53:28'),
(11, 3, 1, 4, 2, 2, 3, '2023-05-27 23:05:28'),
(12, 3, 3, 6, 7, 4, 10, '2023-05-30 14:38:44'),
(13, 3, 2, 2, 4, 4, 9, '2023-05-30 17:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `facpeer_list`
--

CREATE TABLE `facpeer_list` (
  `id` int(10) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `group_num` int(10) NOT NULL,
  `academic_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facpeer_list`
--

INSERT INTO `facpeer_list` (`id`, `faculty_id`, `group_num`, `academic_id`) VALUES
(1, 2, 1, 3),
(2, 3, 1, 3),
(3, 1, 1, 0),
(4, 4, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_list`
--

CREATE TABLE `faculty_list` (
  `id` int(30) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `group_id` int(10) DEFAULT NULL,
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_list`
--

INSERT INTO `faculty_list` (`id`, `school_id`, `firstname`, `lastname`, `email`, `password`, `group_id`, `avatar`, `date_created`) VALUES
(1, '20140623', 'Charlene', 'Melendrez', 'melendrez_cha@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '1608011100_avatar.jpg', '2020-12-15 13:45:18'),
(2, '255866', 'Ryl John', 'De Jesus', 'rjd@faculty.com', '202cb962ac59075b964b07152d234b70', 1, 'no-image-available.png', '2023-04-27 10:27:59'),
(3, '515', 'Reygen', 'Tapispisan', 'reygentapispisan@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'no-image-available.png', '2023-05-17 21:28:25'),
(4, '20151820', 'Raffey', 'Belleza', 'rafbelleza@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, 'no-image-available.png', '2023-05-28 15:26:37'),
(5, '20000155', 'Aiza', 'Romano', 'aizaromano@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, 'no-image-available.png', '2023-05-30 14:25:15'),
(6, '3486236', 'jeffern', 'malinao', 'jeffernmalinao@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '1692883440_jeffern.png', '2023-08-24 21:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_peers`
--

CREATE TABLE `faculty_peers` (
  `id` int(10) NOT NULL,
  `group_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_peers`
--

INSERT INTO `faculty_peers` (`id`, `group_num`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_que`
--

CREATE TABLE `faculty_que` (
  `id` int(10) NOT NULL,
  `question` text NOT NULL,
  `criteria_id` int(10) NOT NULL,
  `academic_id` int(10) NOT NULL,
  `order_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_que`
--

INSERT INTO `faculty_que` (`id`, `question`, `criteria_id`, `academic_id`, `order_by`) VALUES
(1, 'I upgrade my knowledge in my field of specialization.', 7, 3, 1),
(2, 'I contribute new innovative ideas for the development of instruction, research and extension.', 7, 3, 2),
(3, 'I expose myself to new trends in other fields.', 7, 3, 3),
(4, 'I stimulate intellectual discussion with colleagues.', 7, 3, 4),
(5, 'I perform competently assigned scholarly tasks.', 7, 3, 5),
(6, 'I keep abreast with issues/concerns of local/national and international significance.', 7, 3, 6),
(7, 'I exhibit evidence of professional and cultural growth.', 7, 3, 7),
(8, 'I possess a good command of the medium of instruction.', 7, 3, 8),
(9, 'I demonstrate intellectual honesty.', 7, 3, 9),
(10, 'I maintain effective relationship with colleagues.', 8, 3, 10),
(11, 'I welcome suggestions from colleagues.', 8, 3, 11),
(12, 'I respect rights of others.', 8, 3, 12),
(13, 'I behave within the bounds of accepted norms.', 8, 3, 13),
(14, 'I handle work related pressures pleasantly with grace.', 8, 3, 14),
(15, 'I demonstrate leadership qualities.', 8, 3, 15),
(16, 'I exude enthusiasm in my job.', 9, 3, 16),
(17, 'I devote official time in the accomplishment of my official functions and research.', 9, 3, 17),
(18, 'I observe administrative protocol.', 9, 3, 18),
(19, 'I uphold the ideals of the institution.', 9, 3, 19);

-- --------------------------------------------------------

--
-- Table structure for table `fac_evals_answers`
--

CREATE TABLE `fac_evals_answers` (
  `evaluation_id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL,
  `rate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fac_evals_answers`
--

INSERT INTO `fac_evals_answers` (`evaluation_id`, `question_id`, `rate`) VALUES
(3, 2, 5),
(3, 3, 5),
(3, 4, 5),
(3, 5, 5),
(3, 6, 5),
(3, 7, 5),
(3, 8, 5),
(3, 9, 5),
(3, 10, 5),
(3, 11, 5),
(3, 12, 5),
(3, 13, 5),
(3, 14, 5),
(3, 15, 5),
(3, 16, 5),
(3, 17, 5),
(3, 18, 5),
(3, 19, 5),
(3, 20, 5),
(4, 2, 5),
(4, 3, 5),
(4, 4, 5),
(4, 5, 5),
(4, 6, 5),
(4, 7, 5),
(4, 8, 5),
(4, 9, 5),
(4, 10, 5),
(4, 11, 5),
(4, 12, 5),
(4, 13, 5),
(4, 14, 5),
(4, 15, 5),
(4, 16, 5),
(4, 17, 5),
(4, 18, 5),
(4, 19, 5),
(4, 20, 5),
(4, 21, 5),
(4, 22, 5),
(4, 23, 5);

-- --------------------------------------------------------

--
-- Table structure for table `fac_evaluation`
--

CREATE TABLE `fac_evaluation` (
  `evaluation_id` int(10) NOT NULL,
  `fac_evaluator` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `academic_id` int(10) NOT NULL,
  `date_taken` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fac_evaluation`
--

INSERT INTO `fac_evaluation` (`evaluation_id`, `fac_evaluator`, `group_id`, `faculty_id`, `academic_id`, `date_taken`) VALUES
(1, 3, 1, 1, 3, '2023-05-28 18:16:53.807383'),
(2, 2, 1, 3, 3, '2023-05-30 17:25:43.833471');

-- --------------------------------------------------------

--
-- Table structure for table `fac_self_answers`
--

CREATE TABLE `fac_self_answers` (
  `evaluation_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fac_self_answers`
--

INSERT INTO `fac_self_answers` (`evaluation_id`, `question_id`, `rate`) VALUES
(1, 2, 5),
(1, 3, 5),
(1, 4, 5),
(1, 5, 5),
(1, 6, 5),
(1, 7, 5),
(1, 8, 5),
(1, 9, 5),
(1, 10, 5),
(1, 11, 5),
(1, 12, 5),
(1, 13, 5),
(1, 14, 5),
(1, 15, 5),
(1, 16, 5),
(1, 17, 5),
(1, 18, 5),
(1, 19, 5),
(1, 20, 5),
(2, 2, 5),
(2, 3, 5),
(2, 4, 5),
(2, 5, 5),
(2, 6, 5),
(2, 7, 5),
(2, 8, 5),
(2, 9, 5),
(2, 10, 5),
(2, 11, 5),
(2, 12, 5),
(2, 13, 5),
(2, 14, 5),
(2, 15, 5),
(2, 16, 5),
(2, 17, 5),
(2, 18, 5),
(2, 19, 5),
(2, 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `fac_self_eval`
--

CREATE TABLE `fac_self_eval` (
  `evaluation_id` int(10) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `academic_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fac_self_eval`
--

INSERT INTO `fac_self_eval` (`evaluation_id`, `faculty_id`, `academic_id`) VALUES
(1, 2, 3),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `human_resources_list`
--

CREATE TABLE `human_resources_list` (
  `id` int(11) NOT NULL,
  `school_id` varchar(25) NOT NULL,
  `firstname` varchar(70) NOT NULL,
  `lastname` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `human_resources_list`
--

INSERT INTO `human_resources_list` (`id`, `school_id`, `firstname`, `lastname`, `email`, `password`, `avatar`, `date_created`) VALUES
(1, '3486236', 'jeffern', 'malinao', 'jeffernmalinao@gmail.com', '202cb962ac59075b964b07152d234b70', '1692883260_jeffern.png', '2023-08-24 13:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `pds_certificates_of_eligibility`
--

CREATE TABLE `pds_certificates_of_eligibility` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `certificate_number` varchar(100) NOT NULL,
  `given_by` varchar(100) NOT NULL,
  `rating` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pds_educational_background`
--

CREATE TABLE `pds_educational_background` (
  `id` int(11) NOT NULL,
  `level` varchar(20) NOT NULL,
  `name_of_school` varchar(100) NOT NULL,
  `degree_course` varchar(100) NOT NULL,
  `year_graduated` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pds_personal_information`
--

CREATE TABLE `pds_personal_information` (
  `id` int(11) NOT NULL,
  `lastname` varchar(70) NOT NULL,
  `firstname` varchar(70) NOT NULL,
  `middlename` varchar(70) NOT NULL,
  `profile` varchar(120) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `blood_type` varchar(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `pag_ibig_number` varchar(50) NOT NULL,
  `philhealth_number` varchar(50) NOT NULL,
  `sss_number` varchar(50) NOT NULL,
  `tin_number` varchar(50) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `spouse_name` varchar(100) NOT NULL,
  `spouse_occupation` varchar(100) NOT NULL,
  `name_of_child_1` varchar(100) NOT NULL,
  `name_of_child_2` varchar(100) NOT NULL,
  `name_of_child_3` varchar(100) NOT NULL,
  `name_of_child_4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_list`
--

CREATE TABLE `question_list` (
  `id` int(30) NOT NULL,
  `academic_id` int(30) NOT NULL,
  `question` text NOT NULL,
  `order_by` int(30) NOT NULL,
  `criteria_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_list`
--

INSERT INTO `question_list` (`id`, `academic_id`, `question`, `order_by`, `criteria_id`) VALUES
(1, 3, 'The course syllabus was explained/distributed/made available for access/reference.', 0, 1),
(2, 3, 'Course content/materials updates and requirements were discussed and/or posted on various platforms for dissemination.', 2, 2),
(3, 0, 'Question 101', 0, 1),
(4, 3, 'Makeup classes were conducted/announced for interrupted meetings.', 4, 1),
(5, 3, 'An online platform was utilized to inform/remind us of any course tasks.', 5, 1),
(6, 3, 'I was aware of/had attended synchronous or its equivalent asynchronous teaching activity.', 6, 1),
(7, 3, 'I was guided with the technology support/module instruction that I needed.', 7, 1),
(8, 3, 'I know my instructor in this course because we were communicating as a group/individually.', 8, 1),
(9, 3, 'Lectures were supplemented with learning activities and follow up/inputs from my instructor.', 9, 2),
(10, 3, 'Accomplishment/submission of assignments/course requirements was reasonable & flexible.', 10, 2),
(11, 3, 'The subject matter was explained well to the level of my understanding.', 11, 2),
(12, 3, 'I was able to access learning materials/resources (courier, LMS, group chat, fb, etc.) within the timeframe.', 12, 2),
(13, 3, 'I was provided with access and clear instruction on the submission of course requirements.', 13, 2),
(14, 3, 'The schedule of virtual office hours with the consultation of my instructor had been posted/announced.', 14, 4),
(15, 3, 'Discussion boards and platforms (LMS,FB,etc) were provided for class and/or group interaction.', 15, 4),
(16, 3, 'Group/class interaction was properly guided with worksheets and other learning resources.', 16, 4),
(17, 3, 'The different forms of online/offline interaction allowed me to engage and enjoy learning.', 17, 4),
(18, 3, 'I was able to consult with my instructor through the information given on how to reach her/him (virtual office hours, consultation, announcement, etc.).', 18, 4),
(19, 3, 'Class interaction/discussion encouraged me to contribute knowledge/experience towards a better understanding of the subject matter.', 19, 4),
(20, 3, 'Online/offline assessment tasks and requirements were given/explained with a reasonable timeframe to accomplish.', 20, 5),
(21, 3, 'The assessment tools such as test questionnaire and/or rubrics used in our class were stated /explained clearly.', 21, 5),
(22, 3, 'Proctored online exam/test was conducted with utmost care to preserve academic integrity/honesty.', 22, 5),
(23, 3, 'Varied assessments through online/offline drills, exercises, and assignments motivated me to perform better.', 23, 5),
(24, 3, 'The timely feedback on my learning assessments (taken remotely) helped me improve in the succeeding assessments/tests.', 24, 5),
(25, 3, 'I learned to uphold academic integrity in the assessment or test-taking activity in this course.', 25, 5),
(26, 3, 'Will you recommend this faculty/instructor to other students?', 27, 6),
(27, 3, 'www', 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restriction_list`
--

CREATE TABLE `restriction_list` (
  `id` int(30) NOT NULL,
  `academic_id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `class_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restriction_list`
--

INSERT INTO `restriction_list` (`id`, `academic_id`, `faculty_id`, `class_id`, `subject_id`) VALUES
(1, 3, 1, 1, 1),
(2, 3, 1, 2, 2),
(3, 3, 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student_comm`
--

CREATE TABLE `student_comm` (
  `evaluation_id` int(10) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_comm`
--

INSERT INTO `student_comm` (`evaluation_id`, `comment`) VALUES
(11, 'The teacher demonstrated exceptional knowledge and expertise in the subject matter, creating an engaging and informative learning environment for students.'),
(12, 'Very Good.'),
(13, 'fyurhj');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(30) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `class_id` int(30) NOT NULL,
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `school_id`, `firstname`, `lastname`, `email`, `password`, `class_id`, `avatar`, `date_created`) VALUES
(1, '6231415', 'John', 'Smith', 'jsmith@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '1608012360_avatar.jpg', '2020-12-15 14:06:14'),
(2, '101497', 'Aiza', 'Enguito', 'aiza_enguito@gmail.com', '202cb962ac59075b964b07152d234b70', 2, '1608012720_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg', '2020-12-15 14:12:03'),
(3, '123', 'Mike', 'Williams', 'mwilliams@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '1608034680_1605601740_download.jpg', '2020-12-15 20:18:22'),
(4, '2020004510', 'James Brian ', 'Albarina', 'james_brian@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'no-image-available.png', '2023-05-16 19:53:31'),
(5, '20200015', 'Clarish', 'Sargado', 'clasargado@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2023-05-30 14:30:12'),
(6, '2001552', 'Jeffern', 'Malinao', 'malinaojeffern@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2023-05-30 14:32:34'),
(7, '2013623', 'Katrina', 'De Ramos', 'deramoskatrina@gmail.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2023-05-30 14:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `subject_list`
--

CREATE TABLE `subject_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_list`
--

INSERT INTO `subject_list` (`id`, `code`, `subject`, `description`) VALUES
(1, 'GE5', 'Contemporary World', 'Contemporary World'),
(2, 'IS101', 'Fundamentals of Information Systems', 'Fundamentals of Information Systems'),
(3, 'CC103', 'Computer Programming 2', 'Computer Programming 2'),
(4, 'PE2', 'Physical Education 2', 'Physical Education 2'),
(5, 'NSTP2', 'CWTS 2', 'CWTS 2'),
(6, 'RIZAL', 'Life and Works of Rizal', 'Life and Works of Rizal'),
(7, 'IS106', 'IS Project Management', 'IS Project Management'),
(8, 'CAP101', 'Capstone Project 1', 'Capstone Project 1'),
(9, 'ProfEle3', 'Professional Elective 3', 'Professional Elective 3'),
(10, 'ProfTrack3', 'Analytics Modeling', 'Analytics Modeling'),
(11, 'ProfTrack4', 'Analytics Techniques and Tools', 'Analytics Techniques and Tools'),
(12, 'ProfTrack5', 'Data Mining', 'Data Mining'),
(13, 'PRAC101', 'Practicum for Information Systems', 'Practicum for Information Systems'),
(14, 'g4', 'h', 'hf');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_list`
--

CREATE TABLE `supervisor_list` (
  `id` int(10) NOT NULL,
  `school_id` int(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(1000) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisor_list`
--

INSERT INTO `supervisor_list` (`id`, `school_id`, `firstname`, `lastname`, `email`, `password`, `avatar`, `date_created`) VALUES
(1, 20200115, 'Aiza', 'Romano', 'aiza_romano@gmail.com', '202cb962ac59075b964b07152d234b70', '', '0000-00-00');

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
(1, 'Performance Evaluation System', 'jarlisondra@gmail.com', '+690 777 05859', 'Panabo City', '');

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
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `avatar`, `date_created`) VALUES
(1, 'Admin', '', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', '1607135820_avatar.jpg', '2020-11-26 10:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `visor_eval_ans`
--

CREATE TABLE `visor_eval_ans` (
  `evaluation_id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL,
  `rate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visor_eval_ans`
--

INSERT INTO `visor_eval_ans` (`evaluation_id`, `question_id`, `rate`) VALUES
(5, 2, 5),
(5, 3, 5),
(5, 4, 5),
(5, 5, 5),
(5, 6, 5),
(5, 7, 5),
(5, 8, 5),
(5, 9, 5),
(5, 10, 5),
(5, 11, 5),
(5, 12, 5),
(5, 13, 5),
(5, 14, 5),
(5, 15, 5),
(5, 16, 5),
(5, 17, 5),
(5, 18, 5),
(5, 19, 5),
(5, 20, 5),
(5, 21, 5),
(5, 22, 5),
(5, 23, 5),
(6, 2, 5),
(6, 3, 5),
(6, 4, 5),
(6, 5, 5),
(6, 6, 5),
(6, 7, 5),
(6, 8, 5),
(6, 9, 5),
(6, 10, 5),
(6, 11, 5),
(6, 12, 5),
(6, 13, 5),
(6, 14, 5),
(6, 15, 5),
(6, 16, 5),
(6, 17, 5),
(6, 18, 5),
(6, 19, 5),
(6, 20, 5),
(6, 21, 5),
(6, 22, 5),
(6, 23, 5);

-- --------------------------------------------------------

--
-- Table structure for table `visor_eval_list`
--

CREATE TABLE `visor_eval_list` (
  `evaluation_id` int(10) NOT NULL,
  `academic_id` int(10) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `visor_id` int(10) NOT NULL,
  `date_taken` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visor_eval_list`
--

INSERT INTO `visor_eval_list` (`evaluation_id`, `academic_id`, `faculty_id`, `visor_id`, `date_taken`) VALUES
(1, 3, 1, 1, '2023-05-18 15:16:50.868019'),
(2, 3, 1, 2, '2023-05-30 17:26:54.243626');

-- --------------------------------------------------------

--
-- Table structure for table `visor_q`
--

CREATE TABLE `visor_q` (
  `id` int(10) NOT NULL,
  `question` text NOT NULL,
  `criteria_id` int(10) NOT NULL,
  `academic_id` int(10) NOT NULL,
  `order_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visor_q`
--

INSERT INTO `visor_q` (`id`, `question`, `criteria_id`, `academic_id`, `order_by`) VALUES
(1, 'Comes to class regularly.', 10, 3, 1),
(2, 'Starts class on time.', 10, 3, 2),
(3, 'Makes optimum use of class hour.', 10, 3, 3),
(4, 'Conducts make-up classes whenever necessary.', 10, 3, 4),
(5, 'Does institutional services outside of teaching (e.g. registration advising, committee task)', 10, 3, 5),
(6, 'Observes official consultation hours.', 10, 3, 6),
(7, 'Makes himself available to students for completion of grades.', 10, 3, 7),
(8, 'Submits grade sheets, reports and other requirements on time.', 10, 3, 8),
(9, 'Informs department/college of possible absences.', 10, 3, 9),
(10, 'Communicates clearly in written and spoken words.', 10, 3, 10),
(11, ' Observes administrative protocol.', 10, 3, 11),
(12, 'Tends to be flexible and open-minded, or welcomes criticisms and suggestions.', 10, 3, 12),
(13, 'Observes/respects department policies.', 10, 3, 13),
(14, 'Accepts assigned task willingly.', 10, 3, 14),
(15, 'Attends official meetings.', 10, 3, 15),
(16, 'Attends official meetings.', 10, 3, 16),
(17, 'Handles disagreement with composure.', 10, 3, 17),
(18, ' Exercises his rights in making collective decisions.', 10, 3, 18),
(19, 'Accepts the rights of others in making collective decisions.', 10, 3, 19),
(20, 'Behaves in accordance with professional standards.', 10, 3, 20),
(21, 'Keeps abreast with developments in one\'s field of specialization.', 10, 3, 21),
(22, 'Exhibits exposure to recent trends.', 10, 3, 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_list`
--
ALTER TABLE `academic_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_l`
--
ALTER TABLE `class_l`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_list`
--
ALTER TABLE `class_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria_list`
--
ALTER TABLE `criteria_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curr_list`
--
ALTER TABLE `curr_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deduction_list`
--
ALTER TABLE `deduction_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_deduction_list`
--
ALTER TABLE `employee_deduction_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_list`
--
ALTER TABLE `evaluation_list`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `facpeer_list`
--
ALTER TABLE `facpeer_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_list`
--
ALTER TABLE `faculty_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_peers`
--
ALTER TABLE `faculty_peers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_que`
--
ALTER TABLE `faculty_que`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fac_evaluation`
--
ALTER TABLE `fac_evaluation`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `fac_self_eval`
--
ALTER TABLE `fac_self_eval`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `human_resources_list`
--
ALTER TABLE `human_resources_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pds_certificates_of_eligibility`
--
ALTER TABLE `pds_certificates_of_eligibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pds_educational_background`
--
ALTER TABLE `pds_educational_background`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pds_personal_information`
--
ALTER TABLE `pds_personal_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_list`
--
ALTER TABLE `question_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restriction_list`
--
ALTER TABLE `restriction_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor_list`
--
ALTER TABLE `supervisor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visor_eval_list`
--
ALTER TABLE `visor_eval_list`
  ADD PRIMARY KEY (`evaluation_id`);

--
-- Indexes for table `visor_q`
--
ALTER TABLE `visor_q`
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
-- AUTO_INCREMENT for table `class_l`
--
ALTER TABLE `class_l`
  MODIFY `class_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_list`
--
ALTER TABLE `class_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `criteria_list`
--
ALTER TABLE `criteria_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `curr_list`
--
ALTER TABLE `curr_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `deduction_list`
--
ALTER TABLE `deduction_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_deduction_list`
--
ALTER TABLE `employee_deduction_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluation_list`
--
ALTER TABLE `evaluation_list`
  MODIFY `evaluation_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `facpeer_list`
--
ALTER TABLE `facpeer_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty_list`
--
ALTER TABLE `faculty_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faculty_peers`
--
ALTER TABLE `faculty_peers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty_que`
--
ALTER TABLE `faculty_que`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fac_evaluation`
--
ALTER TABLE `fac_evaluation`
  MODIFY `evaluation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fac_self_eval`
--
ALTER TABLE `fac_self_eval`
  MODIFY `evaluation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `human_resources_list`
--
ALTER TABLE `human_resources_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pds_certificates_of_eligibility`
--
ALTER TABLE `pds_certificates_of_eligibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pds_educational_background`
--
ALTER TABLE `pds_educational_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pds_personal_information`
--
ALTER TABLE `pds_personal_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_list`
--
ALTER TABLE `question_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `restriction_list`
--
ALTER TABLE `restriction_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `supervisor_list`
--
ALTER TABLE `supervisor_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visor_eval_list`
--
ALTER TABLE `visor_eval_list`
  MODIFY `evaluation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visor_q`
--
ALTER TABLE `visor_q`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
