-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 11:31 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grading`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `firstname`, `lastname`, `photo`, `created_on`, `is_deleted`) VALUES
(1, 1, 'Neovic', 'Devierte', '1575858787_avatar.png', '2019-11-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_scores`
--

CREATE TABLE `criteria_scores` (
  `id` int(11) NOT NULL,
  `subject_criteria_id` int(11) NOT NULL,
  `grading_id` int(11) NOT NULL,
  `total_score` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1- yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criteria_scores`
--

INSERT INTO `criteria_scores` (`id`, `subject_criteria_id`, `grading_id`, `total_score`, `is_deleted`) VALUES
(3, 9, 3, 50, 0),
(4, 8, 3, 40, 0),
(5, 8, 3, 40, 0),
(6, 6, 3, 10, 0),
(7, 6, 3, 10, 0),
(8, 6, 3, 10, 0),
(9, 6, 3, 10, 0),
(10, 6, 3, 10, 0),
(11, 7, 3, 20, 0),
(12, 7, 3, 20, 0),
(13, 7, 3, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gradings`
--

CREATE TABLE `gradings` (
  `id` int(11) NOT NULL,
  `period` varchar(30) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradings`
--

INSERT INTO `gradings` (`id`, `period`, `is_deleted`) VALUES
(2, '2nd Grading', 0),
(3, '1st Grading', 0),
(4, '4th Grading', 0),
(5, '3rd Grading', 0);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `user_id`, `firstname`, `lastname`, `photo`, `created_on`, `is_deleted`) VALUES
(3, 19, 'Vicente', 'Devierte', '', '2019-12-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `id` int(11) NOT NULL,
  `school_year` varchar(60) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`id`, `school_year`, `is_deleted`) VALUES
(2, '2019 - 2020', 0),
(3, '2018 - 2019', 0),
(4, '2017 - 2018', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `firstname`, `lastname`, `photo`, `created_on`, `is_deleted`) VALUES
(4, 16, 'Gemalyn', 'Cepe', '', '2019-12-10', 0),
(5, 17, 'Neovic Jr', 'Cepe', '', '2019-12-10', 0),
(6, 18, 'Tatin', 'Devierte', '', '2019-12-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_criteria_scores`
--

CREATE TABLE `student_criteria_scores` (
  `id` int(11) NOT NULL,
  `criteria_score_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_criteria_scores`
--

INSERT INTO `student_criteria_scores` (`id`, `criteria_score_id`, `student_id`, `score`) VALUES
(1, 6, 4, 10),
(2, 7, 4, 10),
(3, 8, 4, 10),
(4, 9, 4, 10),
(5, 10, 4, 10),
(6, 11, 4, 20),
(7, 12, 4, 20),
(8, 13, 4, 20),
(9, 4, 4, 40),
(10, 5, 4, 40),
(11, 3, 4, 50);

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `id` int(11) NOT NULL,
  `subject_student_id` int(11) NOT NULL,
  `grading_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_grades`
--

INSERT INTO `student_grades` (`id`, `subject_student_id`, `grading_id`, `grade`) VALUES
(8, 5, 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `student_parents`
--

CREATE TABLE `student_parents` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_parents`
--

INSERT INTO `student_parents` (`id`, `parent_id`, `student_id`) VALUES
(2, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `is_deleted`) VALUES
(6, 'Filipino VII', 0),
(7, 'Math VII', 0),
(8, 'Science VII', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject_criterias`
--

CREATE TABLE `subject_criterias` (
  `id` int(11) NOT NULL,
  `subject_teacher_id` int(11) NOT NULL,
  `criteria` varchar(30) NOT NULL,
  `percentage` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1- yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_criterias`
--

INSERT INTO `subject_criterias` (`id`, `subject_teacher_id`, `criteria`, `percentage`, `is_deleted`) VALUES
(6, 7, 'Quizzes', 10, 0),
(7, 7, 'Summative Test', 20, 0),
(8, 7, 'Long Quiz', 30, 0),
(9, 7, 'Exam', 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject_students`
--

CREATE TABLE `subject_students` (
  `id` int(11) NOT NULL,
  `subject_teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_students`
--

INSERT INTO `subject_students` (`id`, `subject_teacher_id`, `student_id`) VALUES
(2, 6, 4),
(3, 6, 5),
(4, 6, 6),
(5, 7, 4),
(6, 7, 5),
(7, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `subject_teachers`
--

CREATE TABLE `subject_teachers` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_teachers`
--

INSERT INTO `subject_teachers` (`id`, `subject_id`, `teacher_id`, `school_year_id`, `is_deleted`) VALUES
(6, 7, 6, 2, 0),
(7, 8, 5, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `firstname`, `lastname`, `photo`, `created_on`, `is_deleted`) VALUES
(5, 14, 'Neonita', 'Devierte', '1576326659_11080850_904417189603886_4320294362270876652_o.jpg', '2019-12-10', 0),
(6, 15, 'Tetai', 'Devierte', '', '2019-12-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usertype` int(11) NOT NULL COMMENT '0 - students, 1 - parents, 2- teachers, 3 - admins',
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '0 - no, 1 - yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `username`, `password`, `is_deleted`) VALUES
(1, 3, 'admin', '$2y$10$LUxzmO1J/KnMCSJ5JdLdter/LzDfADhzrJ3Lv/G0dQuiX/YhaT6QG', 0),
(14, 2, 'teacher', '$2y$10$O2kUKOmHgFhsD2.uFkro.uu2/rbNssuH8bRJ4HyMNCE0Qy/NRaPfu', 0),
(15, 2, 'teacher2', '$2y$10$PvPfybtZzgZQTiGd9RVczO.UD4c6zcCNB9/YJzgrC/SnXzZOhD51i', 0),
(16, 2, 'student1', '$2y$10$eDxrewF55JhufaLrbLERG.7JBZNAMl.UxP6HzAm74hIId3aNHkUJO', 0),
(17, 2, 'student2', '$2y$10$6WQTFq5NqfRTk8YSGHkFB.Zw2Sd0Q8.TVTOEcfYG8dshsfaMyCu1G', 0),
(18, 2, 'student3', '$2y$10$TVzEeIkql8RHqd2OdlVeSuvJhaeu0gTTQRjs.7j29gw3CBG4C4OLS', 0),
(19, 2, 'parent1', '$2y$10$K/ilvwxHL2jp8VSe/S62XeTAPsqdND1owMfendtp6t.rNEww0W/1S', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria_scores`
--
ALTER TABLE `criteria_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gradings`
--
ALTER TABLE `gradings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_criteria_scores`
--
ALTER TABLE `student_criteria_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_criterias`
--
ALTER TABLE `subject_criterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_students`
--
ALTER TABLE `subject_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_teachers`
--
ALTER TABLE `subject_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `criteria_scores`
--
ALTER TABLE `criteria_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gradings`
--
ALTER TABLE `gradings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_criteria_scores`
--
ALTER TABLE `student_criteria_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject_criterias`
--
ALTER TABLE `subject_criterias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subject_students`
--
ALTER TABLE `subject_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject_teachers`
--
ALTER TABLE `subject_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
