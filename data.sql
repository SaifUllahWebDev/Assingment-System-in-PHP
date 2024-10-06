-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 10:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(255) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `batch_code` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `description`, `due_date`, `batch_code`) VALUES
(1, 'HTML', 'HELLO', '2024-10-04', 'batch 2401');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `university` varchar(45) NOT NULL,
  `batch_code` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `name`, `email`, `university`, `batch_code`, `password`) VALUES
(1, 'saif ullah', 'saifullah@gamil.com', 'karachi university', 'batch 2401', '$2y$10$gqu3.NEVj7dtC08fP94yVuJJnUHEvOT3643eOEDllJ797OUoQ6Ft.'),
(2, 'Hammad', 'hammad@gmail.com', 'karachi university', 'batch 2401', '$2y$10$XNwRhffR9LNaHrml/xmAc.kVTqpuxULPYwRUU1wVL9LzppRm7.RMe'),
(3, 'saif', 'saif@gmail.com', 'KU', 'batch 2401', '$2y$10$.13BK1phJhKEEnrFiKBX.e3aozdiHNkii6qVQ.GCgzBXnWzcqGeBu');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `id` int(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `university` varchar(30) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`id`, `name`, `email`, `university`, `department`, `password`) VALUES
(1, 'hassan', 'hassan@gmail.com', 'karachi university', 'physics', '$2y$10$Q1H6Wmbdn6fwf12lsyLXOe3bTOCYoL.f2zfSOolk.DO1LQVKINOwy'),
(2, 'Sahil', 'sahil@gmail.com', 'indus', 'CS', '$2y$10$bylfk3iEcfY6exC7pJIgEO51FzcQYs/17BPD61UitUPizISP1lMC2'),
(3, 'hassan', 'hassan@gmail.com', 'KU', 'CS', '$2y$10$UOMp8fSkZsnvuLVNcq6fTeI.Wcl2i40c.1ulIZk2g19YmXCozd2de'),
(4, 'hassan', 'hassan@gmail.com', 'KU', 'CS', '$2y$10$re12ehKwS2iAkMIWLi1QM.qtWUtPqKxyR8pkPTX26GsM5lUmckr9W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher_info`
--
ALTER TABLE `teacher_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
