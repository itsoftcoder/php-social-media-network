-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2019 at 12:09 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_author` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `user_id`, `post_id`, `comment`, `comment_author`, `created_at`) VALUES
(1, 1, 11, 'nice', 'ismail_hossain_498077', '2019-10-24 16:27:47'),
(2, 1, 11, 'very good', 'alamin_hossain_294531', '2019-10-24 16:35:01'),
(3, 2, 10, 'very good', 'alamin_hossain_294531', '2019-10-25 02:24:45'),
(4, 1, 8, 'wow nice looking', 'ismail_hossain_498077', '2019-10-25 02:27:08'),
(5, 1, 8, 'go ahead boy', 'ismail_hossain_498077', '2019-10-25 02:32:30'),
(6, 1, 7, 'nice very nice', 'ismail_hossain_498077', '2019-10-25 02:49:19'),
(7, 1, 11, 'just amazing', 'alamin_hossain_294531', '2019-10-25 03:30:46'),
(8, 1, 11, 'wow very nice', 'alamin_hossain_294531', '2019-10-25 03:31:12'),
(9, 1, 11, 'it is absolutly better', 'alamin_hossain_294531', '2019-10-25 03:31:43'),
(10, 1, 11, 'think you fine', 'alamin_hossain_294531', '2019-10-25 03:32:00'),
(11, 1, 11, 'oh man cool cool', 'alamin_hossain_294531', '2019-10-25 03:32:26'),
(12, 2, 10, 'thank all', 'ismail_hossain_498077', '2019-10-25 03:42:52'),
(13, 2, 10, 'wow nice', 'shuvo_talukdar_752230', '2019-10-25 05:05:47'),
(14, 3, 12, 'wow dear very fine post', 'alamin_hossain_294531', '2019-10-25 07:42:52'),
(15, 3, 12, 'nice graphic dosto', 'khorshed_alom_53196', '2019-10-25 10:08:52'),
(16, 2, 10, 'wow brother nice picture', 'khorshed_alom_53196', '2019-10-25 10:13:12'),
(17, 4, 13, 'nice looking dear', 'alamin_hossain_294531', '2019-10-26 03:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(200) NOT NULL,
  `upload_image` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `upload_image`, `created_at`, `updated_at`) VALUES
(5, 1, 'i am a bangladeshi', 'images (12).jpg', '2019-10-22 15:33:21', NULL),
(7, 1, 'You are not running with administrator rights! This will work for easy\r\n', 'Surah maryam.mp4_20190420_174056.062.jpg', '2019-10-22 15:40:57', '2019-10-24 11:29:49'),
(8, 1, 'i am a successfully created posts controller and upload easy and i am very happy', 'WIN_20190125_15_05_24_Pro.jpg', '2019-10-23 08:19:37', NULL),
(10, 2, 'this is my first post', 'download.jpg', '2019-10-24 03:22:23', NULL),
(11, 1, 'most application stuff but whenever you do something with services', 'Surah maryam.mp4_20190420_174222.250.jpg', '2019-10-24 11:33:06', NULL),
(12, 3, 'hey i am a shuvo taluckdar this is my first post here', 'images (3).jpg', '2019-10-25 05:05:13', NULL),
(13, 4, 'hey my name is khorshed alom . this is my first post', 'images (9).jpg', '2019-10-25 10:07:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `gender` varchar(60) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cover_pic` varchar(255) DEFAULT NULL,
  `posts` varchar(200) DEFAULT NULL,
  `status` text DEFAULT NULL,
  `relationship` text DEFAULT NULL,
  `recovery_account` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_name`, `email`, `pass`, `country`, `gender`, `dob`, `image`, `description`, `cover_pic`, `posts`, `status`, `relationship`, `recovery_account`, `created_at`, `updated_at`) VALUES
(1, 'alamin', 'hossain', 'alamin_hossain_294531', 'alamin@gmail.com', '2468135790', 'Bangladesh', 'Male', '2000-05-29', '32592221_235126367041879_136084745988603904_1.jpg', 'php web developer and computer engineer', 'images (6).jpg', 'no', 'verified', 'single', 'ismail', '2019-10-26 09:50:59', '2019-10-26 04:50:28'),
(2, 'ismail', 'hossain', 'ismail_hossain_498077', 'ismail@gmail.com', '12345678900', 'Bangladesh', 'Male', '2002-07-22', '36319047_626404294401797_4008913952871284736_n.jpg', 'student of alim madrasha', 'images (4).jpg', 'no', 'verified', 'Single', 'alamin', '2019-10-26 10:02:00', '2019-10-26 10:01:41'),
(3, 'shuvo', 'talukdar', 'shuvo_talukdar_752230', 'shuvo@gmail.com', '123456789000', 'Bangladesh', 'Male', '2000-06-21', '32592221_235126367041879_136084745988603904_o.jpg', 'this is the defualt description', 'images (8).jpg', 'no', 'verified', '...', 'iwanttointerstedandunivers', '2019-10-25 05:03:47', NULL),
(4, 'khorshed', 'alom', 'khorshed_alom_53196', 'khorshed@gmail.com', '1234567890000', 'Pakistan', 'Male', '1999-10-25', 'images.jpg', 'this is the defualt description', 'images (10).jpg', 'no', 'verified', '...', 'iwanttointerstedandunivers', '2019-10-25 10:05:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `msg_body` varchar(220) NOT NULL,
  `msg_seen` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `user_to`, `user_from`, `msg_body`, `msg_seen`, `send_date`) VALUES
(1, 1, 4, 'how are you friend', 'no', '2019-10-25 12:32:34'),
(2, 3, 4, 'hello how are you ?', 'no', '2019-10-25 12:35:52'),
(3, 2, 4, 'how are you young star ?', 'no', '2019-10-25 12:36:41'),
(4, 4, 1, 'i am fine thank you . and you ?', 'no', '2019-10-25 12:38:26'),
(5, 3, 1, 'how are you friend ?', 'no', '2019-10-25 12:38:57'),
(6, 1, 4, 'I am also fine . what do you do ?', 'no', '2019-10-25 12:43:30'),
(7, 4, 1, 'i am preparation for final exam,what do you do also ?', 'no', '2019-10-25 12:46:44'),
(8, 2, 1, 'how are brother ?', 'no', '2019-10-25 13:01:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
