-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 02:05 AM
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
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `rol` enum('Admin','User') DEFAULT 'User',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `email`, `password`, `fecha_nacimiento`, `telefono`, `rol`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(5, 'Amelia', 'Salazar', 'holaaaa@gmail.com', '$2y$10$aR/I..ZqwQ/cYfvUdImNkecd0zyLP1tTwEVP.fOl2RaDMXOt87ugK', '2000-10-10', '04125555555', 'User', '2024-05-30 00:37:30', '2024-05-30 00:37:30'),
(6, 'Admin', 'User', 'admin@example.com', '$2y$10$DBHS4bLgCEOujZjWb5cpNuvnsWFS3R.DlGpka7.DRqddE9KorbWJ.', '1990-01-01', '1234567890', 'Admin', '2024-05-30 00:42:01', '2024-05-30 00:42:01'),
(7, 'ismelia', 'hernandez', 'ismelia@gmail.com', '$2y$10$AhA48Q0FuxMnvExl408aNuZP5ArTpIiW0T5fujfrxLoMVpx72IJSS', '1964-06-26', '04125555555', 'User', '2024-05-30 11:37:18', '2024-05-30 11:37:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
