-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 04:55 AM
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
-- Database: `dancesociety`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `danceName` varchar(255) NOT NULL,
  `dateTime` datetime NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `user_ID` char(20) NOT NULL,
  `user_Name` varchar(50) NOT NULL,
  `user_Email` varchar(50) NOT NULL,
  `booking_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`danceName`, `dateTime`, `quantity`, `user_ID`, `user_Name`, `user_Email`, `booking_ID`) VALUES
('Kpop', '2024-05-06 10:56:00', 2, 'USR_Bryan', 'Bryan', 'bryan@gmail.com', 'BK_6635a3edb277a'),
('Kpop', '2024-05-29 10:30:00', 1, 'USR_Xin', 'Xin', 'shingdyleong0107@gmail.com', 'BK_663840b22fc25');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` char(15) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `surname`, `email`, `phone`, `message`) VALUES
('Bryan', 'tay', 'bryan@gmail.com', '011-7485632', 'ihgfdxcvbnmoi45678+jjhcxz22iufdsxo765g78ki)*&');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`name`, `description`, `image`) VALUES
('ADF Australian Dance Fesival', 'Ignite your passion and unleash your inner dancer with the ultimate dance extravaganza – the Australian Dance Festival! No matter who you are, the Australian Dance Festival has something extraordinary in store for you.', 'uploads/dance2.jpg'),
('Bates Dance Festival', 'The Bates Dance Festival is an annual event celebrating contemporary dance, held at Bates College in Lewiston, Maine. It brings together dancers, choreographers, and enthusiasts from around the world for performances, workshops, and discussions.', 'uploads/dance3.jpg'),
('Folk Dance', 'Folk dance is a type of dance that is a vernacular, usually recreational, expression of a past or present culture. ', 'uploads/folkDance.jpg'),
('Jazz', 'Jazz dance is a social dance style that emerged at the turn of the 20th century when African American dancers began blending traditional African steps with European styles of movement.', 'uploads/jazz.png'),
('National Dance Competition', 'Step into a celebration of culture and tradition at a folk dance event. Here, the essence of a community is brought to life through lively music, vibrant costumes, and spirited movements', 'uploads/dance6.jpg'),
('Tap Dance', 'Tap dance style of dance in which a dancer wearing shoes fitted with heel and toe taps sounds out audible beats by rhythmically striking the floor or any other hard surface.', 'uploads/TapDance.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` char(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gender` char(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` char(15) NOT NULL,
  `Birthday` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Password`, `Name`, `Gender`, `Email`, `Phone`, `Birthday`) VALUES
('USR_Ken', '$2y$10$v8XyR5QdObnrFvK8zofCvurJwmjSWZSX81r6jVdwtQyuVMFz0G4x.', 'Ken', 'Male', 'ken123@gmail.com', '012-1245786', '08/05/2004'),
('USR_Xin', '$2y$10$Icc0yMpP0KV4s1tIsR.vI.SABpHNzK50Zs7T7ZzDlQdrzNnIg0ikW', 'Xin', 'Female', 'shingdyleong0107@gmail.com', '011-7485631', '07/01/2005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
