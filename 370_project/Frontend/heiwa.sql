-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 07:00 AM
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
-- Database: `heiwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_dashboard`
--

CREATE TABLE `admin_dashboard` (
  `name` varchar(100) NOT NULL,
  `biography` varchar(3000) NOT NULL,
  `list_of_books` varchar(1000) NOT NULL,
  `list_of_social_media` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'zarin@g.mail.com', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `author_dashboard`
--

CREATE TABLE `author_dashboard` (
  `name` varchar(100) NOT NULL,
  `biography` varchar(3000) NOT NULL,
  `lists_of_books` varchar(1000) NOT NULL,
  `social_media` varchar(1000) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author_dashboard`
--

INSERT INTO `author_dashboard` (`name`, `biography`, `lists_of_books`, `social_media`, `email`, `password`) VALUES
('Celeste Ng', 'American author recognized for \"Little Fires Everywhere,\" exploring complex family dynamics.', 'Little Fires Everywhere, Everything I Never Told You', 'twitter.com/pronounced_ing', 'celesteng@email.com', '1234'),
('Colson Whitehead', 'American author known for \"The Underground Railroad,\" winner of the Pulitzer Prize for Fiction.', 'The Underground Railroad, Zone One', 'twitter.com/colsonwhitehead', 'colsonwhitehead@email.com', '1234'),
('Delia Owens', 'American author, zoologist, and co-author of non-fiction works, gained fame with \"Where the Crawdads Sing.\"', 'Where the Crawdads Sing, Cry of the Kalahari', 'N/A', 'deliaowens@email.com', '1234'),
('Donna Tartt', 'American author known for \"The Goldfinch,\" winner of the Pulitzer Prize for Fiction.', 'The Goldfinch, The Secret History', 'twitter.com/donnatartt', 'donnatartt@email.com', '1234'),
('Erin Morgenstern', 'American author of \"The Night Circus,\" a novel blending fantasy and magic.', 'The Night Circus, The Starless Sea', 'instagram.com/erinmorgenstern', 'erinmorgenstern@email.com', '1234'),
('Hanya Yanagihara', 'American novelist, author of \"A Little Life,\" a powerful exploration of friendship.', 'A Little Life, The People in the Trees', 'facebook.com/hanyayanagihara', 'hanyayanagihara@email.com', '1234'),
('Heiwa', '', '', '', 'heiwa@gmail', '55555'),
('Min Jin Lee', 'Korean-American author known for \"Pachinko,\" exploring the Korean immigrant experience.', 'Pachinko, Free Food for Millionaires', 'instagram.com/minjinlee11', 'minjinlee@email.com', '1234'),
('Sally Rooney', 'Irish author acclaimed for \"Normal People,\" exploring complex relationships and societal dynamics.', 'Normal People, Conversations with Friends', 'instagram.com/sallyrooney', 'sallyrooney@email.com', '1234'),
('Ta-Nehisi Coates', 'American author acclaimed for \"The Water Dancer,\" combining history and magical realism.', 'The Water Dancer, Between the World and Me', 'facebook.com/TaNehisiCoates', 'tanehisicoates@email.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `b_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `a_name` varchar(100) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `links` varchar(200) NOT NULL,
  `pub_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`b_id`, `book_name`, `a_name`, `genre`, `links`, `pub_date`) VALUES
(101, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', 'drive-link', '1960-07-11'),
(102, '1984', 'George Orwell', 'Dystopian Fiction', 'drive-link', '1949-06-08'),
(103, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 'drive-link', '1925-04-10'),
(104, 'Pride and Prejudice', 'Jane Austen', 'Romance', 'drive-link', '1813-01-28'),
(105, 'The Catcher in the Rye', 'J.D. Salinger', 'Fiction', 'drive-link', '1951-07-16'),
(106, 'Moby-Dick', 'Herman Melville', 'Adventure', 'drive-link', '1851-10-18'),
(107, 'Frankenstein', 'Mary Shelley', 'Gothic Fiction', 'drive-link', '1818-01-01'),
(108, 'Brave New World', 'Aldous Huxley', 'Science Fiction', 'drive-link', '1932-10-27'),
(109, 'The Picture of Dorian Gray', 'Oscar Wilde', 'Gothic Fiction', 'drive-link', '1890-06-20'),
(110, 'A Tale of Two Cities', 'Charles Dickens', 'Historical Fiction', 'drive-link', '1859-07-01'),
(111, 'The Goldfinch', 'Donna Tartt', 'Fiction', 'drive-link', '2013-10-22'),
(112, 'The Night Circus', 'Erin Morgenstern', 'Fantasy', 'drive-link', '2011-09-13'),
(113, 'A Little Life', 'Hanya Yanagihara', 'Fiction', 'drive-link', '2015-03-10'),
(114, 'The Underground Railroad', 'Colson Whitehead', 'Historical Fiction', 'drive-link', '2016-08-02'),
(115, 'Where the Crawdads Sing', 'Delia Owens', 'Mystery, Coming-of-Age', 'drive-link', '2018-08-14'),
(116, 'Normal People', 'Sally Rooney', 'Fiction, Romance', 'drive-link', '2018-08-28'),
(117, 'The Silent Patient', 'Alex Michaelides', 'Psychological Thriller', 'drive-link', '2019-02-05'),
(118, 'The Water Dancer', 'Ta-Nehisi Coates', 'Historical Fiction, Magical Realism', 'drive-link', '2019-09-24'),
(119, 'Pachinko', 'Min Jin Lee', 'Historical Fiction', 'drive-link', '2017-02-07'),
(120, 'Little Fires Everywhere', 'Celeste Ng', 'Fiction', 'drive-link', '2017-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `reader_nid` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `reader_nid` int(50) NOT NULL,
  `book_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`reader_nid`, `book_id`) VALUES
(123455, 76835463);

-- --------------------------------------------------------

--
-- Table structure for table `reader`
--

CREATE TABLE `reader` (
  `reader_nid` int(11) NOT NULL,
  `reader_name` varchar(100) NOT NULL,
  `reader_email` varchar(100) NOT NULL,
  `reader_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reader`
--

INSERT INTO `reader` (`reader_nid`, `reader_name`, `reader_email`, `reader_password`) VALUES
(0, 'reader_name', '', ''),
(4334, 'Heiwa', 'raisa@gmail.com', 'abraraisa@22'),
(252525252, 'Zarin Tasnim', 'zarin@gmail.com', '11111111'),
(543543546, 'Heiwa', 'heiwa@gmail', '1111111111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_dashboard`
--
ALTER TABLE `admin_dashboard`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `author_dashboard`
--
ALTER TABLE `author_dashboard`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD UNIQUE KEY `b_id` (`b_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`reader_nid`,`book_id`);

--
-- Indexes for table `reader`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`reader_nid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
