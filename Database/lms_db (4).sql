-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2023 at 03:16 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

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
  `initial` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `personal_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tele_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Active',
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id_2` (`admin_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_id`, `lname`, `fname`, `initial`, `admin_role`, `email`, `personal_email`, `phone_number`, `tele_number`, `address`, `status`, `username`, `password`, `img`) VALUES
(97, '2313123', 'Rana', 'Lorjohn', 'M', 'Staff', 'lmrana00027@usep.edu.ph', 'lorjohn143@gmail.com', '09096763912', '123-1234', 'Tagum city', 'Active', 'john', 'pass', 'me-removebg (1).png'),
(109, 'Ab adipisci eos cons', 'Ford', 'Hamish', 'Paria', 'Staff', 'nulowu@mailinator.com', 'bato@mailinator.com', '+1 (487) 372-49', '+1 (913) 255-76', 'Molestiae expedita o', 'Suspended', 'juquja', '$2y$10$Exc2IdHeW82ljDEAGurdye20nL3C7hOscNHcZ2bw3rw', 'Picture5.jpg'),
(110, 'Rem quaerat harum vo', 'Hall', 'Mason', 'Aperi', 'Staff', 'romesegy@mailinator.com', 'pevynyvix@mailinator.com', '+1 (892) 542-67', '+1 (777) 343-25', 'Veniam natus odit q', 'Active', 'lucojo', '$2y$10$U5oiX2yad5BYGkkyWIAdJ.fv5GpIleKoN0AHpmcXWaX', '400865813_325398640382436_4221974037372489828_n.jpg'),
(111, 'Quo mollit dicta tem', 'Walker', 'Kirk', 'Qui m', 'Staff', 'xiwy@mailinator.com', 'cyfabitely@mailinator.com', '+1 (292) 853-94', '+1 (416) 364-24', 'Incidunt ipsam in d', 'Active', 'pojut', '$2y$10$pu/o6IgI6VOi.IGqZup4s.hu6MfSg/XzHShkXePDiOE', 'smcti_logo-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

DROP TABLE IF EXISTS `tbl_book`;
CREATE TABLE IF NOT EXISTS `tbl_book` (
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `book_title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ISBN` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publisher` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Others',
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `shelf` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `copy` int NOT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'New',
  `book_img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `book_addition_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `ISBN` (`ISBN`),
  KEY `copy_id` (`copy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`book_id`, `book_title`, `ISBN`, `author`, `publisher`, `genre`, `category`, `description`, `shelf`, `copy`, `status`, `book_img`, `book_addition_date`) VALUES
('B1', 'To Kill a Mockingbird', '9780061120084', 'Harper Lee', 'HarperCollins', 'Fiction', 'null', 'A story set in the American South during the 1930s that addresses racial injustice.', 'ShelfA', 5, 'New', 'To Kill a Mockingbird.jpg', '2023-12-13 17:59:08'),
('B10', 'The Hobbit', '9780547928227', 'J.R.R. Tolkien', 'Houghton Mifflin', 'null', 'null', 'A fantasy novel following the journey of Bilbo Baggins as he joins a quest to reclaim treasure guarded by the dragon Smaug.', 'ShelfJ', 10, 'New', 'The Hobbit.jpg', '2023-12-13 17:59:08'),
('B2', '1984', '9780451524935', 'George Orwell', 'Signet Classics', 'null', 'null', 'A novel depicting a totalitarian society and the dangers of government overreach.', 'ShelfB', 3, 'New', '1984.jpg', '2023-12-13 17:59:08'),
('B3', 'The Great Gatsby', '9780743273565', 'F. Scott Fitzgerald', 'Scribner', 'Fiction', 'null', 'A tale of wealth, decadence, and the American Dream set in the Roaring Twenties.', 'ShelfC', 7, 'New', 'The Great Gatsby.jpg', '2023-12-13 17:59:08'),
('B4', 'To the Lighthouse', '9780156907392', 'Virginia Woolf', 'Houghton Mifflin Harcourt', 'Fiction', 'null', 'A novel exploring the passage of time and the complexity of human relationships.', 'ShelfD', 2, 'New', 'To The Lighthouse.jpg', '2023-12-13 17:59:08'),
('B5', 'The Catcher in the Rye', '9780241950425', 'J.D. Salinger', 'Penguin Books', 'Fiction', 'null', 'A story narrated by a disenchanted teenager, Holden Caulfield, during his experiences in New York City.', 'ShelfE', 6, 'New', 'The Catcher in the Rye.jpg', '2023-12-13 17:59:08'),
('B6', 'One Hundred Years of Solitude', '9780061120091', 'Gabriel García Márquez', 'Harper & Row', 'null', 'null', 'A multi-generational tale blending magical and real elements, exploring the Buendía family in Macondo.', 'ShelfF', 4, 'New', 'One Hundred Years Of Solitude.jpg', '2023-12-13 17:59:08'),
('B7', 'Brave New World', '9780060850524', 'Aldous Huxley', 'Harper Perennial', 'null', 'null', 'A novel depicting a future society where people are conditioned for conformity and happiness.', 'ShelfG', 8, 'New', 'Brave New World.jpg', '2023-12-13 17:59:08'),
('B8', 'Pride and Prejudice', '9780141439518', 'Jane Austen', 'Penguin Classics', 'Fiction', 'null', 'A romantic novel exploring themes of love, class, and societal expectations in 19th-century England.', 'ShelfH', 1, 'New', 'Pride and Prejudice.jpg', '2023-12-13 17:59:08'),
('B9', 'Romeo and Juliet', '9780743477116', 'William Shakespeare', 'Simon & Schuster', 'null', 'null', 'A tragic play depicting the ill-fated love story between Romeo Montague and Juliet Capulet.', 'ShelfI', 9, 'New', 'Romeo and Juliet.jpg', '2023-12-13 17:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_rating`
--

DROP TABLE IF EXISTS `tbl_book_rating`;
CREATE TABLE IF NOT EXISTS `tbl_book_rating` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rating_book_id_fk` (`book_id`),
  KEY `rating_book_id_user_fk` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_book_rating`
--

INSERT INTO `tbl_book_rating` (`id`, `user_id`, `book_id`, `comment`, `rating`) VALUES
(1, '2021-00027', 'B4', '', 0),
(2, '2021-00027', 'B4', 'ssfdfdsfsdfsdf', 4),
(3, '2021-00027', 'B4', '', 0),
(4, '2021-00027', 'B4', '', 0),
(5, '2021-00027', 'B4', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_borrow`
--

DROP TABLE IF EXISTS `tbl_borrow`;
CREATE TABLE IF NOT EXISTS `tbl_borrow` (
  `borrow_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `transaction_id` int NOT NULL,
  `date` timestamp NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Borrowed',
  PRIMARY KEY (`borrow_id`),
  KEY `user_id_fk` (`user_id`),
  KEY `book_id_fk` (`book_id`),
  KEY `borrow_transaction_id_fk` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_borrow`
--

INSERT INTO `tbl_borrow` (`borrow_id`, `user_id`, `book_id`, `transaction_id`, `date`, `status`) VALUES
(29, '2021-00027', 'B5', 1092, '2023-12-14 11:23:58', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_college`
--

DROP TABLE IF EXISTS `tbl_college`;
CREATE TABLE IF NOT EXISTS `tbl_college` (
  `id` int NOT NULL AUTO_INCREMENT,
  `college_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `college_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `college_id` (`college_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_college`
--

INSERT INTO `tbl_college` (`id`, `college_id`, `college_name`) VALUES
(28, 'C0001', 'College of Teacher Education and Technology'),
(29, 'CO002', 'College of Engineering '),
(31, 'COL-4321', 'School Of Law');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_copy`
--

DROP TABLE IF EXISTS `tbl_copy`;
CREATE TABLE IF NOT EXISTS `tbl_copy` (
  `copy_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `total_copy` int NOT NULL,
  `copy_on_hand` int NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`copy_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

DROP TABLE IF EXISTS `tbl_course`;
CREATE TABLE IF NOT EXISTS `tbl_course` (
  `id` int NOT NULL AUTO_INCREMENT,
  `college_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `course_major` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`id`),
  KEY `college_id_FK` (`college_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `college_id`, `course_name`, `course_major`) VALUES
(8, 'CO002', 'Bachelor of Early Childhood Education', 'NA'),
(11, 'C0001', 'Bachelor of Science in Information Technology', 'Information Security'),
(12, 'COL-4321', 'law', 'International Law');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

DROP TABLE IF EXISTS `tbl_feedback`;
CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `feedback_comments` text,
  `star_count` int DEFAULT NULL,
  `feedback_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`feedback_id`),
  KEY `feedback_user_id_fk` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `user_id`, `feedback_comments`, `star_count`, `feedback_date`) VALUES
(5, '2021-00027', 'DSDASDSADSDSADSA', 4, '2023-12-13 20:15:23'),
(6, '2021-00027', '', 4, '2023-12-13 20:21:09'),
(7, '2021-00027', 'dfsdfdsgsdds', 4, '2023-12-13 20:22:21'),
(8, '2021-00027', 'dfsdfdsgsdds', 3, '2023-12-13 20:22:36'),
(9, '2021-00027', 'sdsdsdsadasdsa', 4, '2023-12-13 20:25:03'),
(10, '2021-00027', 'sdsadsddsad', 4, '2023-12-13 20:29:25'),
(11, '2021-00027', 'ddsccsvfgrgg', 3, '2023-12-13 20:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

DROP TABLE IF EXISTS `tbl_logs`;
CREATE TABLE IF NOT EXISTS `tbl_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id_log_FK` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id`, `admin_id`, `date`, `action`) VALUES
(230, '2021-00027', '2023-12-13 17:28:33', 'admin added Mason Hall'),
(231, '2021-00027', '2023-12-13 17:33:57', 'admin added Kirk Walker');

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
  KEY `book_id_fk_penalty` (`book_id`),
  KEY `borrow_id_fk_penalty` (`borrow_id`),
  KEY `user_id_fk_penalty` (`user_id`)
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
  `reserve_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `transaction_id` int NOT NULL,
  `date` timestamp NOT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`reserve_id`),
  KEY `book_id` (`book_id`),
  KEY `reserve_user_id_fk` (`user_id`),
  KEY `reserve_transaction_id_fk` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reserve`
--

INSERT INTO `tbl_reserve` (`reserve_id`, `user_id`, `book_id`, `transaction_id`, `date`, `status`) VALUES
(21, '2021-00027', 'B4', 1093, '2023-12-14 11:25:47', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shelf`
--

DROP TABLE IF EXISTS `tbl_shelf`;
CREATE TABLE IF NOT EXISTS `tbl_shelf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shelf_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `shelf_category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shelf`
--

INSERT INTO `tbl_shelf` (`id`, `shelf_id`, `shelf_category`) VALUES
(5, 'COL124', 'General Information');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_superadmin`
--

DROP TABLE IF EXISTS `tbl_superadmin`;
CREATE TABLE IF NOT EXISTS `tbl_superadmin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `initial` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_superadmin`
--

INSERT INTO `tbl_superadmin` (`id`, `admin_id`, `fname`, `lname`, `initial`, `admin_role`, `email`, `username`, `password`, `img`) VALUES
(1, '2021-00027', 'lorjohn', 'Rana', '', 'Librarian', 'lmrana00027@usep.edu.ph', 'admin', 'admin', 'me-removebg (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

DROP TABLE IF EXISTS `tbl_transaction`;
CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `book_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `transaction_type` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `date_requested` date NOT NULL,
  `date_return` date DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `trans_user_id_fk` (`user_id`),
  KEY `trans_book_id_fk` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1094 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`id`, `user_id`, `book_id`, `transaction_type`, `date_requested`, `date_return`, `status`) VALUES
(1092, '2021-00027', 'B5', 'Borrow', '2023-12-14', NULL, 'Approved'),
(1093, '2021-00027', 'B4', 'Reserve', '0000-00-00', '0000-00-00', 'Approved');

--
-- Triggers `tbl_transaction`
--
DROP TRIGGER IF EXISTS `after_transaction_approval`;
DELIMITER $$
CREATE TRIGGER `after_transaction_approval` AFTER UPDATE ON `tbl_transaction` FOR EACH ROW BEGIN
    IF NEW.status = 'Approved' AND OLD.status != 'Approved' THEN
        IF NEW.transaction_type = 'Borrow' THEN
            INSERT INTO tbl_borrow (user_id, book_id, transaction_id, date, status)
            VALUES (NEW.user_id, NEW.book_id, NEW.id, NOW(), NEW.status);
        ELSEIF NEW.transaction_type = 'Reserve' THEN
            INSERT INTO tbl_reserve (user_id, book_id, transaction_id, date, status)
            VALUES (NEW.user_id, NEW.book_id, NEW.id, NOW(), NEW.status);
        END IF;
    END IF;
END
$$
DELIMITER ;

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
  `year` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `course` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `major` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Active',
  `user_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Student',
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `usep_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `account_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_id`, `fname`, `lname`, `initial`, `year`, `course`, `major`, `username`, `password`, `status`, `user_type`, `email`, `usep_email`, `phone_number`, `address`, `img`, `account_creation_date`) VALUES
(20, '2021-00027', 'despenser', 'kyowa', 'M', '4th', 'BTVTED', 'Information Security', 'John123', '$2y$10$LxFDVnSXPhqNRwGoArN9yuWuj0FTnDAgU9Er9pX6a/3Skat3zihQG', 'Active', 'Student', 'lmran0027@gmail.com', 'lmran0027@gmail.com', '09096763912', 'tagum', 'icons8-user-50.png', '0000-00-00 00:00:00'),
(27, '2021-10028', 'Lorjohn', 'Rana', 'M', '3rd', 'BSIT', 'Information Security', 'lmrana', '$2y$10$/nsDdEQV4Ow2Xp8QHOtZQ.Vx5fLd.XKpJNf/aa6is53VVpdPyYFWa', 'Active', 'Student', 'lorjohn143@gmail.com', 'lorjohn143@usep.edu.ph', '09096763912', 'Sabina Homes Apokon', '265063833_435018991361457_3478573601706912404_n.jp', '0000-00-00 00:00:00'),
(29, '2021-12345', 'Warren', 'Hartman', 'M', '5th', 'BSED', 'Mathematics', 'nisobufy', '$2y$10$R.YaqsXvyfmYLlC/bBGadeIYAcIuW.mJi26Wx3m8NXmP4lCI8bj4a', 'Active', 'Student', 'jucucaryq@gmail.com', 'jymeseqez@usep.edu.ph', '09096763912', 'Vel distinctio Vita', 'logo.png', '2023-12-13 17:10:35'),
(31, '2021-21132', 'Hilda', 'Downs', 'M', '4th', 'BSABE', 'Information Security', 'cyjalidew', '$2y$10$0KxpebM9MHWcpVhG50ECuOGUFj9AyEjjqaKQt8WqrSVgd81nPgloi', 'Active', 'Student', 'maseli@gmail.com', 'kumeriruj@usep.edu.ph', '09096763912', 'Consequat Vero cons', 'IMG_9747__1_-removebg-preview.png', '2023-12-13 17:40:09'),
(30, '2021-43212', 'Hasad', 'Mcneil', 'M', '2nd', 'BSIT', 'English', 'qepixofune', '$2y$10$hzGSwnrrjl9mNVRpUbj6XOXd/H1.okRGyDEBr3x0A5Cipv1nKGRMG', 'Active', 'Student', 'qikusibyhi@gmail.com', 'copymomina@usep.edu.ph', '09096763912', 'Quaerat quis corrupt', '400865813_325398640382436_4221974037372489828_n.jp', '2023-12-13 17:15:09');

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
-- Stand-in structure for view `vw_book_request`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_book_request`;
CREATE TABLE IF NOT EXISTS `vw_book_request` (
`id` int
,`transaction_type` varchar(25)
,`date_requested` date
,`status` varchar(25)
,`user_id` varchar(50)
,`fname` varchar(50)
,`lname` varchar(50)
,`initial` char(5)
,`year` varchar(50)
,`course` varchar(100)
,`major` varchar(100)
,`book_id` varchar(100)
,`book_title` varchar(100)
,`author` varchar(100)
,`shelf` varchar(100)
,`book_img` varchar(100)
,`publisher` varchar(100)
,`category` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_borrow_counts`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_borrow_counts`;
CREATE TABLE IF NOT EXISTS `vw_borrow_counts` (
`category` varchar(100)
,`borrow_count` bigint
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_course`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_course`;
CREATE TABLE IF NOT EXISTS `vw_course` (
`college_id` varchar(100)
,`course_id` int
,`course_name` varchar(100)
,`course_major` varchar(100)
,`college_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_logs`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_logs`;
CREATE TABLE IF NOT EXISTS `vw_logs` (
`date` timestamp
,`admin_id` varchar(50)
,`action` varchar(50)
,`admin_role` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_record`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_user_record`;
CREATE TABLE IF NOT EXISTS `vw_user_record` (
`user_id` varchar(50)
,`date` timestamp
,`fname` varchar(50)
,`lname` varchar(50)
,`initial` char(5)
,`email` varchar(50)
,`activity` varchar(50)
,`status` varchar(50)
,`img` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_book_request`
--
DROP TABLE IF EXISTS `vw_book_request`;

DROP VIEW IF EXISTS `vw_book_request`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_book_request`  AS SELECT `tbl_transaction`.`id` AS `id`, `tbl_transaction`.`transaction_type` AS `transaction_type`, `tbl_transaction`.`date_requested` AS `date_requested`, `tbl_transaction`.`status` AS `status`, `tbl_user`.`user_id` AS `user_id`, `tbl_user`.`fname` AS `fname`, `tbl_user`.`lname` AS `lname`, `tbl_user`.`initial` AS `initial`, `tbl_user`.`year` AS `year`, `tbl_user`.`course` AS `course`, `tbl_user`.`major` AS `major`, `tbl_book`.`book_id` AS `book_id`, `tbl_book`.`book_title` AS `book_title`, `tbl_book`.`author` AS `author`, `tbl_book`.`shelf` AS `shelf`, `tbl_book`.`book_img` AS `book_img`, `tbl_book`.`publisher` AS `publisher`, `tbl_book`.`category` AS `category` FROM ((`tbl_transaction` join `tbl_user` on((`tbl_transaction`.`user_id` = `tbl_user`.`user_id`))) join `tbl_book` on((`tbl_transaction`.`book_id` = `tbl_book`.`book_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_borrow_counts`
--
DROP TABLE IF EXISTS `vw_borrow_counts`;

DROP VIEW IF EXISTS `vw_borrow_counts`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_borrow_counts`  AS SELECT `vw_book_request`.`category` AS `category`, count(`vw_book_request`.`id`) AS `borrow_count` FROM `vw_book_request` WHERE ((`vw_book_request`.`transaction_type` = 'Borrow') AND (`vw_book_request`.`status` = 'Approved')) GROUP BY `vw_book_request`.`category``category`  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_course`
--
DROP TABLE IF EXISTS `vw_course`;

DROP VIEW IF EXISTS `vw_course`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_course`  AS SELECT `tbl_college`.`college_id` AS `college_id`, `tbl_course`.`id` AS `course_id`, `tbl_course`.`course_name` AS `course_name`, `tbl_course`.`course_major` AS `course_major`, `tbl_college`.`college_name` AS `college_name` FROM (`tbl_course` join `tbl_college` on((`tbl_course`.`college_id` = `tbl_college`.`college_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_logs`
--
DROP TABLE IF EXISTS `vw_logs`;

DROP VIEW IF EXISTS `vw_logs`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_logs`  AS SELECT `tbl_logs`.`date` AS `date`, `tbl_logs`.`admin_id` AS `admin_id`, `tbl_logs`.`action` AS `action`, `tbl_superadmin`.`admin_role` AS `admin_role` FROM (`tbl_logs` join `tbl_superadmin` on((`tbl_logs`.`admin_id` = `tbl_superadmin`.`admin_id`))) ORDER BY `tbl_logs`.`date` AS `DESCdesc` ASC  ;

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
-- Constraints for table `tbl_book_rating`
--
ALTER TABLE `tbl_book_rating`
  ADD CONSTRAINT `rating_book_id_fk` FOREIGN KEY (`book_id`) REFERENCES `tbl_book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_book_id_user_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_borrow`
--
ALTER TABLE `tbl_borrow`
  ADD CONSTRAINT `book_id_fk` FOREIGN KEY (`book_id`) REFERENCES `tbl_book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrow_transaction_id_fk` FOREIGN KEY (`transaction_id`) REFERENCES `tbl_transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_copy`
--
ALTER TABLE `tbl_copy`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`book_id`) REFERENCES `tbl_book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD CONSTRAINT `college_id_FK` FOREIGN KEY (`college_id`) REFERENCES `tbl_college` (`college_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `feedback_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_record`
--
ALTER TABLE `tbl_record`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_reserve`
--
ALTER TABLE `tbl_reserve`
  ADD CONSTRAINT `reserve_book_id_fk` FOREIGN KEY (`book_id`) REFERENCES `tbl_book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserve_transaction_id_fk` FOREIGN KEY (`transaction_id`) REFERENCES `tbl_transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserve_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD CONSTRAINT `trans_book_id_fk` FOREIGN KEY (`book_id`) REFERENCES `tbl_book` (`book_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `trans_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
