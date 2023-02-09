-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 07:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`, `date`) VALUES
(1, 'HTML5', '2022-11-21 18:39:56'),
(2, 'Javascript', '2022-11-21 18:40:01'),
(3, 'PHP', '2022-11-21 18:40:03'),
(4, 'DBMS', '2022-11-21 18:40:08'),
(5, 'C++', '2022-11-21 19:06:31'),
(6, 'JAVA', '2022-11-21 19:11:35'),
(7, 'poem', '2022-11-24 04:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` char(50) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` varchar(256) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `comment_status` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_date`, `comment_status`, `author_id`) VALUES
(7, 2, 'hi', 'hi@gmail.com', 'Hello from hi', '2022-11-22 08:35:14', 'Aprroved', 5),
(8, 2, 'fdfd', 'w@gmail.com', 'fdfdgdd', '2022-11-22 21:41:37', 'unapproved', 5),
(9, 19, 'Tahir Ahmed', '01tahirahmed@gmail.com', 'hello', '2023-02-06 12:03:59', 'Aprroved', 6);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` char(100) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_image` varchar(255) NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL,
  `edit_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `edit_by`) VALUES
(2, 1, 'Test21', 'Tahir Uddin Ahmed', '2022-11-24 20:20:04', 'download.png', '                                                                                                                                                                        test 50001                                                                                                                                ', 'HTML, Front-end dev', 6, 'Published', 2),
(3, 2, 'write your blog', 'Tahir Ahmed', '2022-11-24 22:15:23', '1.jpg', 'write somthing ', 'HTMl, Web Development', 1, 'Published', 5),
(4, 4, 'text 120', 'Unknown', '2022-11-24 07:06:40', 'book4.jpg', '                text 100000                ', 'DBMS', 0, 'Published', 4),
(10, 6, 'just another post', 'test', '2022-11-24 02:22:15', 'me.png', '        finally implement an awesome extra feature', 'php, HTML, javascript, ', 0, 'Published', 4),
(12, 1, 'New editor ', 'Tahir Ahmed', '2022-11-23 15:52:10', 'download.jpeg', '<p><span style=\"font-family: &quot;Comic Sans MS&quot;;\">How are <u>add</u> you <b>text﻿</b></span></p><p><span style=\"font-family: &quot;Comic Sans MS&quot;;\"><b><br></b></span></p><p><span style=\"font-family: &quot;Comic Sans MS&quot;;\"><span style=\"font-family: Arial;\">hello every one, I am<a href=\"https://twitter.com/TahirUddinAhmed?t=2xhDl6YgtzS8qtQTI0xu_w&amp;s=08\" target=\"_blank\"> tahir ahmed</a></span><a href=\"https://twitter.com/TahirUddinAhmed?t=2xhDl6YgtzS8qtQTI0xu_w&amp;s=08\" target=\"_blank\">&nbsp;</a></span></p>', 'php, HTML, javascript, ', 0, 'Published', 4),
(18, 3, 'PHP Developer roadmap', 'Tahir Uddin Ahmed', '2022-11-25 03:21:20', 'download.jpg', '        <p><span style=\"color: rgb(102, 102, 102); font-size: 22.08px; text-align: justify; font-family: Verdana; background-color: rgb(255, 255, 255);\">One of the most important things you need to know to learn any type of programming language, especially PHP, is the learning process (roadmap) and the true starting point. If you learn PHP step by step and in a principled way, you will become one of the best programmers in this field. A powerful backend developer!</span></p><p><br></p>\r\n<h2>How Internet & Website Work</h2><p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Resource Name</td><td>Duration</td><td>Resource</td></tr><tr><td><p>How does the <span style=\"background-color: transparent;\">I</span><span style=\"background-color: transparent;\">nternet Work</span></p><p><br></p></td><td>9m</td><td><a href=\"https://youtu.be/x3c1ih2NJEg\" rel=\"nofollow\" style=\"color: var(--color-accent-fg); font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", \"Noto Sans\", Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\"; font-size: 16px; background-color: rgb(247, 247, 247);\" target=\"_blank\">https://youtu.be/x3c1ih2NJEg</a><br></td></tr><tr><td>How the web works - the big picture</td><td>12m</td><td><a href=\"https://youtu.be/hJHvdBlSxug\" rel=\"nofollow\" style=\"color: var(--color-accent-fg); font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", \"Noto Sans\", Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\"; font-size: 16px; background-color: rgb(247, 247, 247);\">https://youtu.be/hJHvdBlSxug</a><br></td></tr><tr><td>How does the internet work? (full course)</td><td>1h 42m</td><td><a href=\"https://youtu.be/zN8YNNHcaZc\" rel=\"nofollow\" style=\"color: var(--color-accent-fg); font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", \"Noto Sans\", Helvetica, Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\"; font-size: 16px; background-color: rgb(239, 239, 239);\">https://youtu.be/zN8YNNHcaZc</a><br></td></tr></tbody></table><p><br></p><h2><!--2--><p><br></p></h2>        ', 'roadmap, php, back-end developer', 0, 'Published', 4),
(19, 1, 'example bebina', 'bebina', '2023-02-06 00:00:00', 'faculties.php.png', '        <p>jhgdjgewjhdgjhjedgewd</p>        ', 'php, HTML, javascript, ', 1, 'Published', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` char(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` char(50) NOT NULL,
  `user_lastname` char(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL DEFAULT 'approved',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_status`, `date`) VALUES
(1, 'tahirahmed', '$2y$10$LtOTpm2y9Ken3DXXFBQs7.EIkwnALpCHWWP.fbVtoeuFlrNcvH7a.', '', '', '01tahirahmed@gmail.com', '', 'subscriber', 'pending', '2022-11-21 18:26:19'),
(2, 'tahirahmed1', '$2y$10$3pnCUNIJbCceXQHTQlO..e568V2YzOsq1Ft.T/1xJyCi0y4lowVu.', 'Tahir Uddin', 'Ahmed', '01tahirahmed@gmail.com', '', 'admin', 'approved', '2022-11-21 18:29:33'),
(3, 'test', '$2y$10$mnpRxnBAOj8oRug92mQSbeJbCCI.9roTZ8aLwxsTGQEXEW.3cUZmu', '', '', 'test12@gmail.com', '', 'subscriber', 'approved', '2022-11-21 18:57:17'),
(4, 'admin', '$2y$10$PBs/CGEdmYQyDJqGImEAX.HXmSKoP8dmM7HB91vhxqq346qanufuu', 'Tahir', 'Ahmed', 'admin@gmail.com', '', 'admin', 'approved', '2022-11-21 19:00:10'),
(5, 'tahirahmed13', '$2y$10$pw8uJFtI7t9JhDmwC74ROe8WPkjcoJ1UBHAqfl7x0YldDyAUTbOX.', '', '', 'ahmedtahir@gmail.com', '', 'subscriber', 'approved', '2022-11-21 19:03:15'),
(6, 'bebina', '$2y$10$RkezE0k6foLJZ2p0fI2fgegaem8rXKKca9ZpRRt9ifr6bb6E4oNCa', '', '', 'bebina@gmail.com', '', 'admin', 'approved', '2023-02-06 11:59:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
