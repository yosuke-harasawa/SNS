-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 21, 2020 at 04:17 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SNS`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `followed_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follow_id`, `user_id`, `followed_user_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 1, 2),
(9, 1, 4),
(10, 1, 5),
(11, 1, 6),
(12, 2, 1),
(13, 2, 3),
(14, 2, 4),
(15, 3, 1),
(16, 3, 2),
(17, 3, 4),
(18, 4, 1),
(19, 4, 2),
(20, 4, 3),
(21, 4, 5),
(22, 4, 6),
(23, 5, 1),
(24, 5, 4),
(25, 5, 6),
(26, 6, 1),
(27, 6, 5),
(28, 6, 4),
(29, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `post_id`) VALUES
(1, 1, 3),
(3, 2, 4),
(8, 3, 4),
(9, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `phone_number`, `email`, `password`, `status`) VALUES
(1, '09086891275', 'yosuke@gmail.com', '8676136cd268c6f238176072ef33789b', 'U'),
(2, '09011111111', 'kurt@gmail.com', '3954f43216f9638e7040849850da9562', 'U'),
(3, '09033333333', 'takuto@gmail.com', '6520675bc53c479fe8c4fe904fff8ce1', 'U'),
(4, '09044444444', 'yuka@gmail.com', '69b0307b07beb945ac23cc8c4c9cdfd6', 'U'),
(5, '09055555555', 'yuji@gmail.com', '33221dfb2e0a6853bae373993a4b5118', 'U'),
(6, '09066666666', 'kume@gmail.com', '1ce0fc9ce50ca9fa753228da06c73f62', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `text` varchar(140) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `text`, `picture`, `user_id`) VALUES
(1, 'Hey guys!', '', 1),
(2, 'Whats up?!', '', 2),
(3, 'error mettya haratatsuwa.', '', 3),
(4, 'We participated the competition on Valentine Day!\r\nAll we are so nervous before singing...', 'chip_kurt.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `reply_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(140) NOT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`reply_id`, `user_id`, `post_id`, `comment`, `picture`) VALUES
(1, 2, 4, 'I was drunk.', ''),
(2, 3, 4, 'Im at a payphone♪', '');

-- --------------------------------------------------------

--
-- Table structure for table `replies_to_reply`
--

CREATE TABLE `replies_to_reply` (
  `re_reply_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` varchar(140) NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `reply_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `replies_to_reply`
--

INSERT INTO `replies_to_reply` (`re_reply_id`, `user_id`, `reply`, `picture`, `reply_id`) VALUES
(1, 1, 'You are good at playing the guitar!\r\nI will buy a guitar and practice!', '', 1),
(2, 1, 'Why is your voice so sexy?!', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `retweets`
--

CREATE TABLE `retweets` (
  `retweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `retweets`
--

INSERT INTO `retweets` (`retweet_id`, `user_id`, `post_id`) VALUES
(1, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `icon`, `bio`, `location`, `login_id`) VALUES
(1, 'yosuke', 'friends.jpg', ' Hello nice to meet you!                                                                            ', 'Gunma Japan', 1),
(2, 'kurt', 'orland.jpg', 'Why I am so handsome?                                                                               ', 'Cebu Philippine', 2),
(3, 'takuto', 'takuto.jpg', 'I am terminator.                                                                                   ', 'Fukuoka Japan', 3),
(4, 'yuka', 'harley quinn.jpg', 'Dont let me down.                                                                                   ', 'Saitama Japan', 4),
(5, 'yuji', 'tobizaru.jpg', '                                                                                    ', 'Ishikawa Japan', 5),
(6, 'kume', 'akiyama.jpg', '                                                                                    ', 'Osaka Japan', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `replies_to_reply`
--
ALTER TABLE `replies_to_reply`
  ADD PRIMARY KEY (`re_reply_id`);

--
-- Indexes for table `retweets`
--
ALTER TABLE `retweets`
  ADD PRIMARY KEY (`retweet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `replies_to_reply`
--
ALTER TABLE `replies_to_reply`
  MODIFY `re_reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `retweets`
--
ALTER TABLE `retweets`
  MODIFY `retweet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
