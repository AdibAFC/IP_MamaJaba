-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 01:38 PM
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
-- Database: `mamajaba`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `contact`, `image`) VALUES
(1, 'Adiba Fairooz Chowdhury', 'afc@gmail.com', '$2y$10$.QOg0n8Lv2RjVGkxd0La.evwFo9Cwu64HzVXGkLYpXQxOxF7igWe6', '1234', 0x696d616765732f61646962612e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `DriverID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Licence` varchar(20) DEFAULT NULL,
  `Experience` varchar(50) DEFAULT NULL,
  `Rickshaw_Model` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Picture` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`DriverID`, `Name`, `Email`, `Phone`, `Licence`, `Experience`, `Rickshaw_Model`, `Password`, `Picture`) VALUES
(1, 'nurul', 'nurul@gmail.com', '123', '123d', '1', 'Bangla Rickshaw', '$2y$10$AeXxhvfVasZ66v5uSi2cmeWojhVpRTUSyzhV.W/ULWqKa8rN9/IOW', 0x696d616765732f70686f746f5f323032342d30332d30365f32322d35302d34342e6a7067),
(2, 'Bacha Mia', 'bachamia@gmail.com', '123', 'ABD123', '3', 'Bangla Rickshaw', '$2y$10$Nlsbn2Q6PiB0Kew2fdbQIuAblEkRyVCCCU1K7u.yxXTuQMKj/ytz2', 0x696d616765732f62616368612e6a7067),
(4, 'jamal', 'jamal@gmail.com', '123', 'fgjf', '1', 'bangla', '$2y$10$fsy.UJIKZ5b4T9rBkPnAve8x2Gd9Y2sBfMqjF5Yp9hUxEhHcD1STG', 0x696d616765732f62616368612e6a7067),
(9, 'kamal', 'kamal@gmail.com', '123', 'abcd', '1', 'Bangla Rickshaw', '$2y$10$5ZXcl.6zOzQhrPv3ZUFgmOOzM/akC6NuiHmK/q8CvvHcS44Ti/pTi', 0x696d616765732f64726976652e6a7067),
(10, 'sobur', 'sobur@gmail.com', '123', 'abcde', '3', 'Motor Rickshaw', '$2y$10$x8p8xqBXX8fzONrBc0jc8uXHGNnZqPIZbpfXWwcoOTms4IMGNxZRe', 0x696d616765732f637574652d736c656570696e672d616e79612d666f726765722d77616c6c70617065722d3139323078313230305f362e6a7067),
(11, 'Rahamat Ullah', 'rahamat@gmail.com', '123', 'xyz', '2', 'Motor Rickshaw', '$2y$10$mpUY3y0cDNKOeLWuDCZRSuWI4yQtMnrOfvrYzj7AiCYNpr5glmwCG', 0x696d616765732f726168616d61742e6a7067),
(12, 'Md Rahim', 'rahim@gmail.com', '123', 'xyz', '1', 'Motor Rickshaw', '$2y$10$bm.OWa9nFVx8dAQD6NupnePTC2Xx6DRtJ44btgKFoO4vsJpma9uPe', 0x696d616765732f62616368612e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `rider_id`, `driver_id`, `msg`, `time`, `is_read`) VALUES
(1, 0, 4, 'jamal has accepted your ride request, please wait at the ctg.', '2024-06-23 09:53:02', 0),
(2, 9, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-07-02 15:51:23', 1),
(3, 9, 4, 'jamal has accepted your ride request, please wait at the dhaka.', '2024-07-02 16:17:31', 1),
(4, 0, 4, 'jamal has accepted your ride request, please wait at the ctg.', '2024-07-05 06:43:16', 0),
(5, 0, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-07-05 06:50:29', 0),
(6, 0, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-07-05 06:53:21', 0),
(7, 0, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-07-05 06:55:02', 0),
(8, 0, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-07-05 06:55:51', 0),
(9, 0, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-07-05 07:08:11', 0),
(10, 0, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-07-05 15:47:00', 0),
(11, 9, 4, 'jamal has accepted your ride request, please wait at the sdfcds c.', '2024-07-05 15:47:12', 1),
(12, 9, 4, 'jamal has accepted your ride request, please wait at the anderkilla.', '2024-07-05 17:17:15', 1),
(13, 0, 4, 'jamal has accepted your ride request, please wait at the ctg.', '2024-07-05 17:19:47', 0),
(14, 9, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-08-27 20:03:32', 0),
(15, 9, 4, 'jamal has accepted your ride request, please wait at the dsdf.', '2024-08-27 20:04:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `rider_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_text` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `rider_id`, `rating`, `review_text`, `review_date`) VALUES
(1, 9, 3, 'yt', '2024-06-19 17:37:57'),
(2, 10, 3, 'good', '2024-06-21 08:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

CREATE TABLE `rider` (
  `RiderID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Picture` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rider`
--

INSERT INTO `rider` (`RiderID`, `Name`, `Email`, `Phone`, `Password`, `Picture`) VALUES
(0, 'aladin', 'aladin@gmail.com', '123', '$2y$10$.is8PU20802Vt.tNcVnhLe5EqWcbzR0xs1k4PrQuF.FHJRKJz6Ole', ''),
(1, 'Adiba Fairooz Chowdhury', 'afc@gmail.com', '123', '$2y$10$7VgNoviQVioLTdjQr5RcduUFWx1/xvtkqVUaM.qw94QIfh0Kxzi1.', 0x696d616765732f61646962612e6a7067),
(2, 'dsd', 'sssssd@gmail.com', '123', '$2y$10$k8bDg1kj3xAh4', ''),
(3, 'dfd', 'df@gmail.com', '123', '$2y$10$sZv9pSOoR14SD', ''),
(4, 'sd', 'a@gmail.com', '21', '$2y$10$.FyMBSY/S0ypF', ''),
(9, 'pp', 'p@gmail.com', '123', '$2y$10$kzV8okbI4FI9jHfAD8AdA.f7dXZ63ZgW54e08dW33jrxZa.RMDZDq', 0x696d616765732f53637265656e73686f7420323032342d30332d3038203139343632322e706e67),
(10, 'yamin iqbal', 'yamin@gmail.com', '123', '$2y$10$3/pq66skzFrhy3g9GqhWX.0b.kovf58YvWFm2gIRS8UVHI5jKfI2K', ''),
(11, 'pial', 'pial@gmail.com', '123', '$2y$10$CZpUYyFT7Xeq9AJK3cKTTeh4BcDylDpZn5zDUXrxBjQ2smRu.z85a', ''),
(12, 'user', 'user@gmail.com', '123', '$2y$10$dx5D3LyzzpTcRqS0c.5/XumRjMd8YQF/AW7OxywSnqS5b1KgQmmJ.', ''),
(13, 'xyz', 'xyz@gmail.com', '1234', '$2y$10$lmaNjFy.j2DZMM7x5YuKyeFCkPu4adAXIYm2Mftc9TxJfnaqPATh2', ''),
(14, 'xyz', 'xyzwe@gmail.com', '1234', '$2y$10$nrmqCcmRmo9OQvXU7sTiuOpvk4umYE7RYZLVNmULa6hFBkvl.Cx6.', '');

-- --------------------------------------------------------

--
-- Table structure for table `ride_requests`
--

CREATE TABLE `ride_requests` (
  `id` int(11) NOT NULL,
  `rider_id` int(11) DEFAULT NULL,
  `rider_name` varchar(255) DEFAULT NULL,
  `rider_contact` varchar(12) DEFAULT NULL,
  `pick_up_location` varchar(255) DEFAULT NULL,
  `drop_off_location` varchar(255) DEFAULT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride_requests`
--

INSERT INTO `ride_requests` (`id`, `rider_id`, `rider_name`, `rider_contact`, `pick_up_location`, `drop_off_location`, `request_time`, `status`) VALUES
(9, 9, 'pp', '123', 'sdfcds c', 'wewqr', '2024-06-18 21:17:44', 'pending'),
(11, 9, 'pp', '123', 'safd', 'asfdsasd', '2024-06-22 11:00:43', 'pending'),
(15, 0, 'aladin', '123', 'ctg', 'dhaka', '2024-06-23 09:10:42', 'accepted'),
(16, 0, 'aladin', '123', 'dsdf', 'qqqqqqqqqqqq', '2024-06-23 20:43:05', 'pending'),
(24, 9, 'pp', '123', 'anderkilla', 'subarea', '2024-07-05 17:16:47', 'accepted'),
(25, 10, 'yamin iqbal', '123', 'uSA', 'BD', '2024-07-05 17:55:22', 'pending'),
(26, 10, 'yamin iqbal', '123', 'SRH', 'CSE Building', '2024-07-05 17:55:40', 'pending'),
(27, 10, 'yamin iqbal', '123', 'main Gate', 'Tsc', '2024-07-05 17:55:53', 'pending'),
(28, 10, 'yamin iqbal', '123', 'SNK', 'Auditorium', '2024-07-05 17:56:06', 'pending'),
(29, 9, 'pp', '123', 'anderkilla', 'subarea', '2024-08-27 17:37:22', 'pending'),
(30, 9, 'pp', '123', 'dsdf', 'sdfdsgf', '2024-08-27 17:40:05', 'accepted'),
(31, 9, 'pp', '123', 'dsdf', 'sdfdsgf', '2024-08-27 17:41:08', 'accepted'),
(32, 9, 'pp', '123', 'sdf', 'sdf', '2024-08-27 17:41:49', 'pending'),
(33, 9, 'pp', '123', 'new market', 'kotwali', '2024-08-28 18:26:59', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `ride_request_declines`
--

CREATE TABLE `ride_request_declines` (
  `id` int(11) NOT NULL,
  `ride_request_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride_request_declines`
--

INSERT INTO `ride_request_declines` (`id`, `ride_request_id`, `driver_id`) VALUES
(31, 16, 9),
(34, 16, 4),
(35, 11, 4),
(36, 9, 4),
(37, 28, 4),
(38, 27, 4),
(39, 26, 4),
(40, 25, 4),
(41, 32, 4),
(42, 29, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `role` enum('admin','rider','driver') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Email`, `Password`, `role`, `created_at`) VALUES
('afc@gmail.com', '$2y$10$.QOg0n8Lv2RjVGkxd0La.evwFo9Cwu64HzVXGkLYpXQxOxF7igWe6', 'admin', '2024-03-13 05:52:55'),
('aladin@gmail.com', '$2y$10$.is8PU20802Vt.tNcVnhLe5EqWcbzR0xs1k4PrQuF.FHJRKJz6Ole', 'rider', '2024-06-13 05:52:55'),
('bachamia@gmail.com', '$2y$10$Nlsbn2Q6PiB0Kew2fdbQIuAblEkRyVCCCU1K7u.yxXTuQMKj/ytz2', 'driver', '2024-06-13 05:52:55'),
('jamal@gmail.com', '$2y$10$fsy.UJIKZ5b4T9rBkPnAve8x2Gd9Y2sBfMqjF5Yp9hUxEhHcD1STG', 'driver', '2024-07-13 05:52:55'),
('kamal@gmail.com', '$2y$10$5ZXcl.6zOzQhrPv3ZUFgmOOzM/akC6NuiHmK/q8CvvHcS44Ti/pTi', 'driver', '2024-07-13 05:52:55'),
('n@gmail.com', '$2y$10$AeXxhvfVasZ66v5uSi2cmeWojhVpRTUSyzhV.W/ULWqKa8rN9/IOW', 'driver', '2024-07-13 05:52:55'),
('p@gmail.com', '$2y$10$kzV8okbI4FI9jHfAD8AdA.f7dXZ63ZgW54e08dW33jrxZa.RMDZDq', 'rider', '2024-07-13 05:52:55'),
('pial@gmail.com', '$2y$10$CZpUYyFT7Xeq9AJK3cKTTeh4BcDylDpZn5zDUXrxBjQ2smRu.z85a', 'rider', '2024-07-13 05:52:55'),
('ps@gmail.com', '$2b$12$zSGs2BAtkl1ukKdaRizmAeagkmKdbs0BAs7HxcqG6bfYrG4/DdUDW', 'admin', '2024-05-13 05:52:55'),
('q@gmail.com', '$2y$10$IbuuB8PpdPyB/', 'rider', '2024-07-13 05:52:55'),
('rahamat@gmail.com', '$2y$10$mpUY3y0cDNKOeLWuDCZRSuWI4yQtMnrOfvrYzj7AiCYNpr5glmwCG', 'driver', '2024-07-13 05:52:55'),
('rahim@gmail.com', '$2y$10$bm.OWa9nFVx8dAQD6NupnePTC2Xx6DRtJ44btgKFoO4vsJpma9uPe', 'driver', '2024-06-13 05:52:55'),
('sc@gmail.com', '$2b$12$gbpPEzSEugasgOoNknucBeFmqaAK5xTO2WQc/vEk3yNLi565gmTES', 'admin', '2024-07-13 05:52:55'),
('sfd@gmail.com', '$2y$10$FxRuwin7SbbVg', 'rider', '2024-07-13 05:52:55'),
('sobur@gmail.com', '$2y$10$x8p8xqBXX8fzONrBc0jc8uXHGNnZqPIZbpfXWwcoOTms4IMGNxZRe', 'driver', '2024-07-13 05:52:55'),
('user@gmail.com', '$2y$10$dx5D3LyzzpTcRqS0c.5/XumRjMd8YQF/AW7OxywSnqS5b1KgQmmJ.', 'rider', '2024-06-13 05:54:51'),
('xyz@gmail.com', '$2y$10$lmaNjFy.j2DZMM7x5YuKyeFCkPu4adAXIYm2Mftc9TxJfnaqPATh2', 'rider', '2024-08-28 16:20:40'),
('xyzwe@gmail.com', '$2y$10$nrmqCcmRmo9OQvXU7sTiuOpvk4umYE7RYZLVNmULa6hFBkvl.Cx6.', 'rider', '2024-08-28 16:21:12'),
('yamin@gmail.com', '$2y$10$3/pq66skzFrhy3g9GqhWX.0b.kovf58YvWFm2gIRS8UVHI5jKfI2K', 'rider', '2024-07-13 05:52:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`DriverID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rider_id` (`rider_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `reviews_ibfk_2` (`rider_id`);

--
-- Indexes for table `rider`
--
ALTER TABLE `rider`
  ADD PRIMARY KEY (`RiderID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `ride_requests`
--
ALTER TABLE `ride_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rider_id` (`rider_id`);

--
-- Indexes for table `ride_request_declines`
--
ALTER TABLE `ride_request_declines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ride_request_id` (`ride_request_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ride_requests`
--
ALTER TABLE `ride_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ride_request_declines`
--
ALTER TABLE `ride_request_declines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`rider_id`) REFERENCES `rider` (`RiderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`DriverID`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`rider_id`) REFERENCES `rider` (`RiderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ride_requests`
--
ALTER TABLE `ride_requests`
  ADD CONSTRAINT `ride_requests_ibfk_1` FOREIGN KEY (`rider_id`) REFERENCES `rider` (`RiderID`);

--
-- Constraints for table `ride_request_declines`
--
ALTER TABLE `ride_request_declines`
  ADD CONSTRAINT `ride_request_declines_ibfk_1` FOREIGN KEY (`ride_request_id`) REFERENCES `ride_requests` (`id`),
  ADD CONSTRAINT `ride_request_declines_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`DriverID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
