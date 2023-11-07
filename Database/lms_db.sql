-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 07, 2023 at 03:29 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id_2` (`admin_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_id`, `lname`, `fname`, `admin_role`, `email`, `status`, `username`, `password`, `img`) VALUES
(8, '2021-12345', 'Raña', 'Lorjohnny', 'Librarian', 'lorjohn143@gmail.com', 'Full-Time', 'john', 'john', 'me_sample_profile.jpg'),
(10, '2021-1233', 'Reid', 'james', 'Librarian', 'lorjohn143@gmail.com', 'Full-Time', 'jamesreid', 'akolangto', 'me-removebg (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

DROP TABLE IF EXISTS `tbl_book`;
CREATE TABLE IF NOT EXISTS `tbl_book` (
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `book_title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ISBN` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Author_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pub_date` date NOT NULL,
  `publisher` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `edition` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `language` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `shelf` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `book_img` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`book_id`, `book_title`, `ISBN`, `Author_id`, `pub_date`, `publisher`, `genre`, `edition`, `language`, `description`, `shelf`, `status`, `book_img`) VALUES
('1', 'Twin Peaks: Fire Walk with Me', '067212237-5', 'Lynch and Robert Engels', '2023-07-12', 'Skyvu', 'Crime|Drama|Mystery|Thriller', '1', 'Assamese', 'Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla.', '', '', 'Twin Peaks Fire Walk with Me.jpg'),
('10', 'The Da Vinci Code', '978-0307277671', '6537b454fc13ae1070c77360', '2003-03-18', 'Anchor', 'Mystery|Thriller|Conspiracy', '1', 'English', 'A thriller involving the discovery of hidden messages in art and history.', '', '', 'The Da Vinci Code.jpg'),
('2', 'To Kill a Mockingbird', '978-0061120084', '6537b454fc13ae1070c77350', '1960-07-11', 'HarperCollins', 'Classic|Fiction|Legal Drama', '1', 'English', 'A powerful novel addressing racial injustice and moral growth in the American South.', '', '', 'To Kill a Mockingbird.jpg'),
('3', 'The Hobbit', '978-0618002214', '6537b454fc13ae1070c77356', '1937-09-21', 'Houghton Mifflin', 'Fantasy|Adventure', '1', 'English', 'The adventures of Bilbo Baggins, a hobbit who becomes an unexpected hero.', '', '', 'The Hobbit.jpg'),
('4', '1984', '978-0451524935', '6537b454fc13ae1070c77352', '1949-06-08', 'Penguin', 'Dystopian|Science Fiction', '1', 'English', 'A classic portrayal of a totalitarian society where thought and freedom are suppressed.', 'CN1023', 'Available', '1984.jpg'),
('5', 'The Great Gatsby', '978-0743273565', 'F. Scott Fitzgerald', '1925-04-10', 'Scribner', 'Classic|Fiction', '1', 'English', 'A story of decadence, wealth, and unfulfilled dreams in the Roaring Twenties.', '', '', 'The Great Gatsby.jpg'),
('6', 'Pride and Prejudice', '978-0141439518', '6537b454fc13ae1070c77354', '1813-01-28', 'Penguin Classics', 'Classic|Romance', '1', 'English', 'A tale of love, manners, and marriage in the early 19th century.', '', '', 'Pride and Prejudice.jpg'),
('7', 'Harry Potter and the Sorcerer\'s Stone', '978-0590353427', '6537b454fc13ae1070c7735a', '1997-06-26', 'Scholastic', 'Fantasy|Young Adult', '1', 'English', 'The first book in the Harry Potter series, following the adventures of a young wizard.', '', '', 'Harry Potter and the Sorcerer\'s Stone.jpg'),
('8', 'The Alchemist', '978-0061122415', '6537b454fc13ae1070c7735c', '1988-01-20', 'HarperOne', 'Fiction|Inspirational', '1', 'Portuguese', 'A philosophical novel about following your dreams and destiny.', '', '', 'The Alchemist.jpg'),
('9', 'The Road', '978-0307387899', '6537b454fc13ae1070c7735e', '2006-09-26', 'Vintage', 'Post-Apocalyptic|Dystopian', '1', 'English', 'A story of a father and sons journey in a post-apocalyptic world.', '', '', 'The Road.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow`
--

DROP TABLE IF EXISTS `tbl_borrow`;
CREATE TABLE IF NOT EXISTS `tbl_borrow` (
  `borrow_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_barrowed` date NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`borrow_id`),
  KEY `borrow_book_id_fk` (`book_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_copy`
--

DROP TABLE IF EXISTS `tbl_copy`;
CREATE TABLE IF NOT EXISTS `tbl_copy` (
  `copy_id` int NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` int NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `copy_condition` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penalties`
--

DROP TABLE IF EXISTS `tbl_penalties`;
CREATE TABLE IF NOT EXISTS `tbl_penalties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `borrow_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Amount` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fk_penalty` (`user_id`),
  KEY `book_id_fk_penalty` (`book_id`),
  KEY `borrow_id_fk_penalty` (`borrow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_record`
--

DROP TABLE IF EXISTS `tbl_record`;
CREATE TABLE IF NOT EXISTS `tbl_record` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `activity` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reserve`
--

DROP TABLE IF EXISTS `tbl_reserve`;
CREATE TABLE IF NOT EXISTS `tbl_reserve` (
  `reserve_id` int NOT NULL,
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `reserve_date` date NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`reserve_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reserve`
--

INSERT INTO `tbl_reserve` (`reserve_id`, `book_id`, `reserve_date`, `status`) VALUES
(1, '7', '2023-10-27', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `initial` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sex` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_id`, `fname`, `lname`, `initial`, `username`, `password`, `birthdate`, `email`, `sex`, `img`) VALUES
(1, '2021-00027', 'Lorjohn', 'Rana', 'M', 'user123', 'user123', '2002-11-10', 'lmrana00027@usep.edu.ph', 'M', 'me_sample_profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

DROP TABLE IF EXISTS `tbl_wishlist`;
CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `id` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `book_title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pub_year` date NOT NULL,
  `date_wished` date NOT NULL,
  `edition` int NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `book_title`, `author`, `pub_year`, `date_wished`, `edition`, `img`, `status`) VALUES
('1', 'The Great Gatsby', 'F. Scott Fitzgerald', '1925-01-01', '2023-10-24', 1, 'The Great Gatsby.jpg', 'available'),
('2', 'To Kill a Mockingbird', 'Harper Lee', '1960-01-01', '2023-10-25', 1, 'To Kill a Mockingbird.jpg', 'listed'),
('3', '1984', 'George Orwell', '1949-01-01', '2023-10-23', 1, '1984.jpg', 'available'),
('4', 'The Catcher in the Rye', 'J.D. Salinger', '1951-01-01', '2023-10-24', 1, 'The Catcher in the Rye.jpg', 'not available'),
('5', 'Pride and Prejudice', 'Jane Austen', '1813-01-01', '2023-10-24', 1, 'Pride and Prejudice.jpg', 'listed'),
('6', 'The Hobbit', 'J.R.R. Tolkien', '1937-01-01', '2023-10-24', 1, 'The Hobbit.jpg', 'available'),
('7', 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', '1997-01-01', '2023-10-24', 1, 'Harry Potter and the Sorcerer\'s Stone.jpg', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logs`
--

DROP TABLE IF EXISTS `tb_logs`;
CREATE TABLE IF NOT EXISTS `tb_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `gender` varchar(50) NOT NULL DEFAULT '',
  `full_name` varchar(100) NOT NULL DEFAULT '',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `verifiedEmail` int NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `gender`, `full_name`, `picture`, `verifiedEmail`, `token`) VALUES
(1, 'lorjohn143@gmail.com', 'lorjohn', 'Raña', '', 'lorjohn Raña', 'https://lh3.googleusercontent.com/a/ACg8ocK4K8CTzWHRdrlWjKbHVfVSRzXVgieRZF3HN1iFmVek8aI=s96-c', 1, '113669303841118261480'),
(2, 'lmrana00027@usep.edu.ph', 'Lorjohn', 'Raña', '', 'Lorjohn Raña', 'https://lh3.googleusercontent.com/a/ACg8ocKBi8iQnZcqAtbVHERG0qjOJdASY2hJzSvmURfk9X96BUg=s96-c', 1, '106703609656260067520');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_borrowed_books`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_borrowed_books`;
CREATE TABLE IF NOT EXISTS `vw_borrowed_books` (
`book_author` varchar(100)
,`book_img` varchar(100)
,`book_title` varchar(100)
,`borrow_id` varchar(100)
,`date_barrowed` date
,`status` varchar(100)
,`user_id` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_reservation`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_reservation`;
CREATE TABLE IF NOT EXISTS `vw_reservation` (
`Author_id` varchar(100)
,`book_id` varchar(100)
,`book_title` varchar(100)
,`reserve_id` int
,`status` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_penalty`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_user_penalty`;
CREATE TABLE IF NOT EXISTS `vw_user_penalty` (
`Author_id` varchar(100)
,`book_img` varchar(100)
,`book_title` varchar(100)
,`borrow_id` varchar(50)
,`date_barrowed` date
,`status` varchar(100)
,`user_id` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_record`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_user_record`;
CREATE TABLE IF NOT EXISTS `vw_user_record` (
`activity` varchar(50)
,`date` timestamp
,`email` varchar(50)
,`fname` varchar(50)
,`img` varchar(50)
,`initial` char(5)
,`lname` varchar(50)
,`status` varchar(50)
,`user_id` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_borrowed_books`
--
DROP TABLE IF EXISTS `vw_borrowed_books`;

DROP VIEW IF EXISTS `vw_borrowed_books`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_borrowed_books`  AS SELECT `tbl_borrow`.`borrow_id` AS `borrow_id`, `tbl_borrow`.`date_barrowed` AS `date_barrowed`, `tbl_borrow`.`status` AS `status`, `tbl_borrow`.`user_id` AS `user_id`, `tbl_book`.`book_title` AS `book_title`, `tbl_book`.`Author_id` AS `book_author`, `tbl_book`.`book_img` AS `book_img` FROM (`tbl_borrow` left join `tbl_book` on((`tbl_borrow`.`book_id` = `tbl_book`.`book_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_reservation`
--
DROP TABLE IF EXISTS `vw_reservation`;

DROP VIEW IF EXISTS `vw_reservation`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_reservation`  AS SELECT `tbl_reserve`.`reserve_id` AS `reserve_id`, `tbl_reserve`.`book_id` AS `book_id`, `tbl_reserve`.`status` AS `status`, `tbl_book`.`book_title` AS `book_title`, `tbl_book`.`Author_id` AS `Author_id` FROM (`tbl_reserve` join `tbl_book` on((`tbl_reserve`.`book_id` = `tbl_book`.`book_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_user_penalty`
--
DROP TABLE IF EXISTS `vw_user_penalty`;

DROP VIEW IF EXISTS `vw_user_penalty`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_user_penalty`  AS SELECT `tbl_penalties`.`user_id` AS `user_id`, `tbl_penalties`.`borrow_id` AS `borrow_id`, `tbl_book`.`book_title` AS `book_title`, `tbl_book`.`Author_id` AS `Author_id`, `tbl_book`.`book_img` AS `book_img`, `tbl_borrow`.`date_barrowed` AS `date_barrowed`, `tbl_borrow`.`status` AS `status` FROM ((`tbl_penalties` left join `tbl_book` on((`tbl_penalties`.`book_id` = `tbl_book`.`book_id`))) left join `tbl_borrow` on((`tbl_penalties`.`borrow_id` = `tbl_borrow`.`borrow_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_user_record`
--
DROP TABLE IF EXISTS `vw_user_record`;

DROP VIEW IF EXISTS `vw_user_record`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_user_record`  AS SELECT `tbl_user`.`user_id` AS `user_id`, `tbl_record`.`date` AS `date`, `tbl_user`.`fname` AS `fname`, `tbl_user`.`lname` AS `lname`, `tbl_user`.`initial` AS `initial`, `tbl_user`.`email` AS `email`, `tbl_record`.`activity` AS `activity`, `tbl_record`.`status` AS `status`, `tbl_user`.`img` AS `img` FROM (`tbl_user` join `tbl_record` on((`tbl_user`.`user_id` = `tbl_record`.`user_id`)))  ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_borrow`
--
ALTER TABLE `tbl_borrow`
  ADD CONSTRAINT `borrow_book_id_fk` FOREIGN KEY (`book_id`) REFERENCES `tbl_book` (`book_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `borrow_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_penalties`
--
ALTER TABLE `tbl_penalties`
  ADD CONSTRAINT `book_id_fk_penalty` FOREIGN KEY (`book_id`) REFERENCES `tbl_book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrow_id_fk_penalty` FOREIGN KEY (`borrow_id`) REFERENCES `tbl_borrow` (`borrow_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk_penalty` FOREIGN KEY (`user_id`) REFERENCES `tbl_borrow` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_record`
--
ALTER TABLE `tbl_record`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_reserve`
--
ALTER TABLE `tbl_reserve`
  ADD CONSTRAINT `reserve_book_id_fk` FOREIGN KEY (`book_id`) REFERENCES `tbl_book` (`book_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_logs`
--
ALTER TABLE `tb_logs`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `tbl_admin` (`admin_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
