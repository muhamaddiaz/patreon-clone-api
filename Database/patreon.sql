-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 23, 2019 at 02:14 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `patreon`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment_body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_post`, `id_user`, `comment_body`, `created_at`) VALUES
(12, 5, 7, 'didiyeu bisa teu ?', '2019-04-15 16:06:27'),
(15, 16, 3, 'didiyeu bisa teu ?', '2019-04-17 02:24:49'),
(18, 19, 10, 'didiyeu', '2019-04-19 01:42:42'),
(19, 16, 10, 'coba deui ahh', '2019-04-19 01:43:07'),
(20, 18, 10, 'hi', '2019-04-19 01:43:57'),
(21, 20, 11, 'comment coba', '2019-04-19 02:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'hello', 1, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `post_title`, `post_body`, `created_at`) VALUES
(5, 6, 'halo dunia lain lagi', 'Lorem ipsum sit dolor amet', '2019-04-15 00:06:18'),
(8, 9, 'ini post pertama fevib', 'kenapa coba ?', '2019-04-15 00:19:44'),
(16, 3, 'ini post pertama fevib', 'apa sih?', '2019-04-15 07:48:51'),
(18, 7, 'ini post pertama fevib', 'hehehe', '2019-04-18 23:38:33'),
(19, 10, 'Halo ini diaz', 'sanss', '2019-04-19 01:42:15'),
(20, 11, 'Something happen ?', 'did happen ?', '2019-04-19 02:12:15'),
(22, 7, 'ini post pertama sayah', 'hehe', '2019-04-19 02:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `creating` varchar(100) DEFAULT NULL,
  `user_photo` varchar(100) DEFAULT NULL,
  `user_background` varchar(100) DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `creating`, `user_photo`, `user_background`, `password`, `created_at`) VALUES
(3, 'Samsul Ulum', 'muhamaddiaz', 'muhamaddiaz10@gmail.com', 'muhamaddiaz are creating cooked', 'foto1.jpg', 'foto2.jpg', '$2y$10$ExaZsgc/GMb94nZ21eI5PeyQsA41NksVNwA9BeUEeW4xHUUY092Uq', '2019-04-09 12:06:59'),
(6, 'Muhamad Diaz', 'muhamaddiazr', 'muhamaddiaz11@gmail.com', NULL, 'foto1.jpg', 'foto2.jpg', '$2y$10$gQJ1uWvCmBt0a9fgyhsTFuZxgMjQJQ/PWlgBG/ZWs/Sq1NX5zD0ze', '2019-04-09 12:29:30'),
(7, 'Samsul Ulum', 'samsss', 'sams@gmail.com', 'steven is creating Cooking Tutorial', NULL, NULL, '$2y$10$8jF0ZeDjULPzGS3qKJneyuiRunEDOHBDmuq1ZMnmufEdQbdvB1C8K', '2019-04-14 08:53:38'),
(8, 'Sergio Ramos', 'sergio', 'sergio@gmail.com', NULL, NULL, NULL, '$2y$10$7yKjKP.gaVf/KEzT3EH32evxgjXSsp/4e8thzRzYGsIcCktB/q5mq', '2019-04-15 00:18:46'),
(9, 'fevib', 'fevib', 'fevib@getcoolmail.info', NULL, NULL, NULL, '$2y$10$9eUfgGqTAIduAxr3gJBJDe0sblHnF46X0Pyqww50Ynm7a1nT3dJge', '2019-04-15 00:19:15'),
(10, 'Diaz Ramdani', 'diazram', 'diazram@gmail.com', 'diazram is creating Something Amazing', NULL, NULL, '$2y$10$IAk4nrOM2Do282A2vWlh4Or.hE.YtLzcv93cRSOM9tZBUDgGqGR6S', '2019-04-19 01:41:21'),
(11, 'Rae Carlos', 'rae', 'rae@gmail.com', 'rae are creating Video Maker', NULL, NULL, '$2y$10$wMrvmedFfm8lhMcArYNXpO7V/av.bsAif.h6DQ6zLK8nCjLfK9JMy', '2019-04-19 02:11:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `COMMENTS_POST_FOREIGN_KEY` (`id_post`),
  ADD KEY `COMMENTS_USER_FOREIGN_KEY` (`id_user`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `POSTS_USER_FOREIGN_KEY` (`id_user`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `COMMENTS_POST_FOREIGN_KEY` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `COMMENTS_USER_FOREIGN_KEY` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `POSTS_USER_FOREIGN_KEY` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
