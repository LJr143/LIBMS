-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2023 at 12:31 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_id`, `lname`, `fname`, `initial`, `admin_role`, `email`, `personal_email`, `phone_number`, `tele_number`, `address`, `status`, `username`, `password`, `img`) VALUES
(97, '2313123', 'Raña', 'Doormat', 'M', 'Staff', 'lorjohn143@gmail.com', 'lorjohn143@gmail.com', '09096763912', '02-1234-5678', 'Purok 3-C Sabina Homes Apokon Tagum City Davao Del Norte Philippines', 'Active', 'john', 'Password_123', 'Picture6.jpg');

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
  `pub_date` date DEFAULT NULL,
  `publisher` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `genre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `edition` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `language` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `shelf` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `copy` int NOT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'New',
  `book_img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`book_id`, `book_title`, `ISBN`, `Author_id`, `pub_date`, `publisher`, `genre`, `category`, `edition`, `language`, `description`, `shelf`, `copy`, `status`, `book_img`) VALUES
('1', 'Twin Peaks: Fire Walk with Me', '067212237-5', 'Lynch and Robert Engels', '2023-07-12', 'Skyvu', 'Crime|Drama|Mystery|Thriller', '', '1', 'Assamese', 'Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla.', '', 0, '', 'Twin Peaks Fire Walk with Me.jpg'),
('10', 'The Da Vinci Code', '978-0307277671', '6537b454fc13ae1070c77360', '2003-03-18', 'Anchor', 'null', 'null', '1', 'English', 'A thriller involving the discovery of hidden messages in art and history.', '', 10, '', 'The Da Vinci Code.jpg'),
('2', 'To Kill a Mockingbird', '978-0061120084', '6537b454fc13ae1070c77350', '1960-07-11', 'HarperCollins', 'Classic|Fiction|Legal Drama', '', '1', 'English', 'A powerful novel addressing racial injustice and moral growth in the American South.', '', 0, '', 'To Kill a Mockingbird.jpg'),
('3', 'The Hobbit', '978-0618002214', '6537b454fc13ae1070c77356', '1937-09-21', 'Houghton Mifflin', 'Fantasy|Adventure', '', '1', 'English', 'The adventures of Bilbo Baggins, a hobbit who becomes an unexpected hero.', '', 0, '', 'The Hobbit.jpg'),
('4', '1984', '978-0451524935', '6537b454fc13ae1070c77352', '1949-06-08', 'Penguin', 'Dystopian|Science Fiction', '', '1', 'English', 'A classic portrayal of a totalitarian society where thought and freedom are suppressed.', 'CN1023', 0, 'Available', '1984.jpg'),
('5', 'The Great Gatsby', '978-0743273565', 'F. Scott Fitzgerald', '1925-04-10', 'Scribner', 'Classic|Fiction', '', '1', 'English', 'A story of decadence, wealth, and unfulfilled dreams in the Roaring Twenties.', '', 0, '', 'The Great Gatsby.jpg'),
('6', 'Pride and Prejudice', '978-0141439518', '6537b454fc13ae1070c77354', '1813-01-28', 'Penguin Classics', 'Classic|Romance', '', '1', 'English', 'A tale of love, manners, and marriage in the early 19th century.', '', 0, '', 'Pride and Prejudice.jpg'),
('7', 'Harry Potter and the Sorcerer\'s Stone', '978-0590353427', '6537b454fc13ae1070c7735a', '1997-06-26', 'Scholastic', 'Fantasy|Young Adult', '', '1', 'English', 'The first book in the Harry Potter series, following the adventures of a young wizard.', '', 0, '', 'Harry Potter and the Sorcerer\'s Stone.jpg'),
('8', 'The Alchemist', '978-0061122415', '6537b454fc13ae1070c7735c', '1988-01-20', 'HarperOne', 'Fiction|Inspirational', '', '1', 'Portuguese', 'A philosophical novel about following your dreams and destiny.', '', 0, '', 'The Alchemist.jpg'),
('9', 'The Road', '978-0307387899', '6537b45', '2006-09-26', 'Vintage', 'null', 'null', '1', 'English', 'A story of a father and sons journey in a post-apocalyptic world.', 'Voluptas est totam n', 0, '', 'The Road.jpg'),
('Ea eum officiis cumq', 'Pariatur Deserunt e', 'Quia lorem quia magn', 'Est ea', NULL, 'Est voluptate repre', 'Fiction', 'option', NULL, NULL, 'Laborum molestias in', 'Voluptas est totam n', 2, 'New', '2023-ford-mustang.jpg'),
('Ea recusandae In ea', 'Sit sequi porro hic', 'Assumenda nemo et su', 'Aperiam sed deserunt', NULL, 'Qui sequi qui non ut', 'Fiction', 'option', NULL, NULL, 'Veniam aliquid minu', 'Omnis duis fugiat it', 12, 'New', '1431443-ford-f-150-raptor-wallpapers-2000x1333-for-ipad-2.jpg'),
('Ea voluptatem volupt', 'Necessitatibus volup', 'Voluptas voluptate o', 'Voluptates ut tempor', NULL, 'Corrupti eos nihil', 'Non-Fiction', 'option', NULL, NULL, 'Id commodo voluptas', 'Consequatur adipisi', 15, 'New', '2022-ford-everest-reveal-01-1646117209.jpg'),
('Ex laudantium quo l', 'Amet voluptatibus u', 'Non minima sit saepe', 'Dolor aliquid est of', NULL, 'Officiis sed quaerat', 'Fiction', 'option', NULL, NULL, 'Dicta animi cumque ', 'Est labore provident', 10, 'New', 'basic_2022-gmc-sierra-denali-ultimate-review-photo-benjamin-hunting-driving-line0020944.jpg'),
('Ipsam in natus velit', 'Blanditiis odit susc', 'Mollitia veniam ver', 'Saepe ut temporibus ', NULL, 'Ex laborum est moles', 'Non-Fiction', 'option', NULL, NULL, 'Velit exercitation m', 'Omnis ex voluptatem ', 10, 'New', '2023-Ford-Mustang-4.webp'),
('Pariatur Et dolorem', 'Porro aut qui ea neq', 'Ad consequatur Et i', 'Commodi eius amet o', NULL, 'Odit iure impedit c', 'Non-Fiction', 'option', NULL, NULL, 'Voluptas eaque aut h', 'Eiusmod fuga Error ', 20, 'New', '2022_ford_everest_00.jpg'),
('undefined', 'undefined', 'Et modi ea sit volu', 'undefined', NULL, 'undefined', 'Non-Fiction', 'option', NULL, NULL, 'Dolor aut nisi et ci', 'Quia laborum Sequi ', 0, 'New', 'Picture3.jpg');

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
-- Table structure for table `tbl_feedback`
--

DROP TABLE IF EXISTS `tbl_feedback`;
CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `initials` varchar(5) DEFAULT NULL,
  `feedback_comments` text,
  `star_count` int DEFAULT NULL,
  `feedback_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `user_id`, `fname`, `lname`, `initials`, `feedback_comments`, `star_count`, `feedback_date`) VALUES
(1, 202100412, 'Pagas', 'Sheena Mariz', 'M', ' Praesent sapien mi, tincidunt vitae elit at, condimentum consectetur metus. Duis quis lectus dapibus lacus varius efficitur. Morbi tortor odio, vestibulum et orci sed, vulputate pretium justo. Nullam in justo elit.', 4, '2023-11-29 17:33:38'),
(2, 202100723, 'Zozobrado', 'Carla Jean', 'S', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ipsum nulla, accumsan a leo vitae, fermentum luctus ex. Etiam at orci et sapien porta pellentesque quis malesuada ligula. Donec vitae dui congue, mollis mi vitae, elementum eros. Maecenas sit amet nisl metus. Quisque vitae pretium odio, vel dignissim nisi.', 3, '2023-11-29 17:34:13'),
(3, 20210027, 'Rana', 'Lorjohn', 'M', 'Morbi eget enim vehicula sem bibendum cursus eu vel lorem. Integer lobortis risus eget diam tempus mattis. Etiam dictum eros in ex aliquam, quis mattis ante tempus. Curabitur tincidunt nisl dui, sit amet iaculis ex aliquet vitae. Quisque consectetur ultricies lobortis. Etiam justo eros, auctor a dictum ac, maximus a lorem.', 2, '2023-11-29 17:34:57'),
(4, 202100748, 'Allice', 'Monte', 'E', 'Suspendisse tincidunt sodales placerat. Duis nibh velit, volutpat et quam ut, consectetur finibus purus. Nunc et nulla eu sem finibus tincidunt non vitae mauris. Pellentesque aliquam auctor lectus eget commodo. Nullam commodo ipsum at consectetur vestibulum. Donec laoreet fringilla hendrerit. Fusce dignissim maximus suscipit.', 1, '2023-11-29 17:35:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`id`, `admin_id`, `date`, `action`) VALUES
(80, '2021-00027', '2023-11-21 16:41:45', 'admin added Lorjohn Raña'),
(81, '2021-00027', '2023-11-21 16:48:16', 'admin added Lorjohn Raña'),
(82, '2021-00027', '2023-11-21 22:35:25', 'admin edit Lorjohnny Raña'),
(83, '2021-00027', '2023-11-21 22:51:11', 'admin edit Lorjohn Raña'),
(84, '2021-00027', '2023-11-21 22:51:23', 'admin edit Lorjohn Raña'),
(85, '2021-00027', '2023-11-22 01:04:23', 'admin edit Lorjohnny Raña'),
(86, '2021-00027', '2023-11-22 01:04:48', 'admin edit Lorjohnny Raña'),
(87, '2021-00027', '2023-11-22 01:10:11', 'admin added Lorjohn Raña'),
(88, '2021-00027', '2023-11-22 01:10:26', 'admin edit Lorjohn Raña'),
(89, '2021-00027', '2023-11-22 01:11:49', 'admin added Lorjohn Raña'),
(90, '2021-00027', '2023-11-22 01:14:27', 'admin edit Lorjohn Raña'),
(91, '2021-00027', '2023-11-22 01:14:51', 'admin edit Lorjohn Raña'),
(92, '2021-00027', '2023-11-22 01:17:13', 'admin edit Lorjohn Raña'),
(93, '2021-00027', '2023-11-22 01:18:40', 'admin edit Lorjohn Raña'),
(94, '2021-00027', '2023-11-22 01:21:05', 'admin added Lorjohn Raña'),
(95, '2021-00027', '2023-11-22 01:22:51', 'admin added Lorjohn Raña'),
(96, '2021-00027', '2023-11-22 01:26:14', 'admin added Lorjohn Raña'),
(97, '2021-00027', '2023-11-22 01:27:37', 'admin added Lorjohn Raña'),
(98, '2021-00027', '2023-11-22 01:29:15', 'admin added Lorjohn Raña'),
(99, '2021-00027', '2023-11-22 01:31:12', 'admin added Lorjohn Raña'),
(100, '2021-00027', '2023-11-22 01:32:13', 'admin added Lorjohn Raña'),
(101, '2021-00027', '2023-11-22 01:32:47', 'admin added Lorjohn Raña'),
(102, '2021-00027', '2023-11-22 01:36:10', 'admin added Lorjohn Raña'),
(103, '2021-00027', '2023-11-22 01:37:24', 'admin added Lorjohn Raña'),
(104, '2021-00027', '2023-11-22 01:38:13', 'admin edit Lorjohn Raña'),
(105, '2021-00027', '2023-11-23 12:47:26', 'admin added Lorjohn Raña'),
(106, '2021-00027', '2023-11-23 12:47:51', 'admin edit Lorjohn Raña'),
(107, '2021-00027', '2023-11-23 12:48:30', 'admin edit Lorjohn Raña'),
(108, '2021-00027', '2023-11-23 12:49:04', 'admin edit Lorjohn Raña'),
(109, '2021-00027', '2023-11-23 16:01:07', 'admin edit Nova Raña'),
(110, '2021-00027', '2023-11-23 16:02:01', 'admin added Lorjohn Raña'),
(111, '2021-00027', '2023-11-23 16:04:40', 'admin added Lorjohn Raña'),
(112, '2021-00027', '2023-11-23 16:05:21', 'admin edit Lorjohn Raña'),
(113, '2021-00027', '2023-11-23 16:13:47', 'admin edit Lorjohn Raña'),
(114, '2021-00027', '2023-11-23 16:13:56', 'admin edit Lorjohn Raña'),
(115, '2021-00027', '2023-11-23 16:16:47', 'admin edit Lorjohn Raña'),
(116, '2021-00027', '2023-11-23 16:16:57', 'admin edit Lorjohn Raña'),
(117, '2021-00027', '2023-11-23 16:22:57', 'admin edit Lorjohn Raña'),
(118, '2021-00027', '2023-11-23 16:23:06', 'admin edit Lorjohn Raña'),
(119, '2021-00027', '2023-11-23 16:23:14', 'admin edit Lorjohn Raña'),
(120, '2021-00027', '2023-11-23 16:23:27', 'admin edit Lorjohn Raña'),
(121, '2021-00027', '2023-11-23 16:23:38', 'admin edit Lorjohn Raña'),
(122, '2021-00027', '2023-11-23 16:24:56', 'admin edit Lorjohn Raña'),
(123, '2021-00027', '2023-11-23 16:27:16', 'admin edit Lorjohn Raña'),
(124, '2021-00027', '2023-11-23 16:27:21', 'admin edit Lorjohn Raña'),
(125, '2021-00027', '2023-11-23 16:28:14', 'admin edit Lorjohn Raña'),
(126, '2021-00027', '2023-11-23 16:29:16', 'admin edit Lorjohn Raña'),
(127, '2021-00027', '2023-11-23 16:29:25', 'admin edit Lorjohn Raña'),
(128, '2021-00027', '2023-11-23 16:29:30', 'admin edit Lorjohn Raña'),
(129, '2021-00027', '2023-11-23 16:29:37', 'admin edit Lorjohn Raña'),
(130, '2021-00027', '2023-11-23 16:29:44', 'admin edit Lorjohn Raña'),
(131, '2021-00027', '2023-11-23 16:30:14', 'admin edit Lorjohn Raña'),
(132, '2021-00027', '2023-11-23 16:30:23', 'admin edit Lorjohn Raña'),
(133, '2021-00027', '2023-11-23 16:39:15', 'admin edit Lorjohn Raña'),
(134, '2021-00027', '2023-11-23 16:39:24', 'admin edit Lorjohn Raña'),
(135, '2021-00027', '2023-11-25 16:10:15', 'admin added Lorjohn Raña'),
(136, '2021-00027', '2023-11-27 13:28:33', 'admin added Lorjohn Raña'),
(137, '2021-00027', '2023-11-27 13:28:40', 'admin edit Lorjohn Raña'),
(138, '2021-00027', '2023-11-27 13:30:28', 'admin added Lorjohn Raña'),
(139, '2021-00027', '2023-11-27 13:30:35', 'admin edit Lorjohn Raña'),
(140, '2021-00027', '2023-11-27 13:30:48', 'admin edit Lorjohn Raña'),
(141, '2021-00027', '2023-11-27 13:32:07', 'admin edit Lorjohn Raña'),
(142, '2021-00027', '2023-11-27 13:32:34', 'admin edit Lorjohn Raña'),
(143, '2021-00027', '2023-11-27 13:32:37', 'admin edit Lorjohn Raña'),
(144, '2021-00027', '2023-11-27 13:33:26', 'admin edit Lorjohn Raña'),
(145, '2021-00027', '2023-11-27 13:33:33', 'admin edit Lorjohn Raña'),
(146, '2021-00027', '2023-11-27 13:35:39', 'admin edit Lorjohn Raña'),
(147, '2021-00027', '2023-11-27 13:38:10', 'admin edit Lorjohn Raña'),
(148, '2021-00027', '2023-11-27 13:38:13', 'admin edit Lorjohn Raña'),
(149, '2021-00027', '2023-11-27 13:39:35', 'admin edit Lorjohn Raña'),
(150, '2021-00027', '2023-11-27 13:40:04', 'admin edit Lorjohn Raña'),
(151, '2021-00027', '2023-11-27 13:40:42', 'admin edit Lorjohn Raña'),
(152, '2021-00027', '2023-11-27 13:41:41', 'admin edit Lorjohn Raña'),
(153, '2021-00027', '2023-11-27 13:41:55', 'admin edit Lorjohn Raña'),
(154, '2021-00027', '2023-11-27 13:42:04', 'admin edit Lorjohn Raña'),
(155, '2021-00027', '2023-11-27 13:44:52', 'admin edit Lorjohn Raña'),
(156, '2021-00027', '2023-11-27 13:44:55', 'admin edit Lorjohn Raña'),
(157, '2021-00027', '2023-11-27 13:46:07', 'admin edit Lorjohn Raña'),
(158, '2021-00027', '2023-11-27 13:46:10', 'admin edit Lorjohn Raña'),
(159, '2021-00027', '2023-11-27 13:47:28', 'admin edit Lorjohn Raña'),
(160, '2021-00027', '2023-11-27 13:47:36', 'admin edit Lorjohn Raña'),
(161, '2021-00027', '2023-11-27 13:49:45', 'admin edit Lorjohn Raña'),
(162, '2021-00027', '2023-11-27 13:51:58', 'admin edit Lorjohn Raña'),
(163, '2021-00027', '2023-11-27 13:52:01', 'admin edit Lorjohn Raña'),
(164, '2021-00027', '2023-11-27 13:54:29', 'admin edit Lorjohn Raña'),
(165, '2021-00027', '2023-11-27 13:54:33', 'admin edit Lorjohn Raña'),
(166, '2021-00027', '2023-11-27 13:55:22', 'admin edit Lorjohn Raña'),
(167, '2021-00027', '2023-11-27 13:59:20', 'admin edit Lorjohn Raña'),
(168, '2021-00027', '2023-11-27 13:59:56', 'admin edit Lorjohn Raña'),
(169, '2021-00027', '2023-11-27 14:03:38', 'admin edit Lorjohn Raña'),
(170, '2021-00027', '2023-11-27 14:06:47', 'admin edit Lorjohn Raña'),
(171, '2021-00027', '2023-11-27 14:06:51', 'admin edit Lorjohn Raña'),
(172, '2021-00027', '2023-11-27 14:07:01', 'admin edit Lorjohn Raña'),
(173, '2021-00027', '2023-11-27 14:07:08', 'admin edit Lorjohn Raña'),
(174, '2021-00027', '2023-11-27 14:09:02', 'admin edit Lorjohn Raña'),
(175, '2021-00027', '2023-11-27 14:09:05', 'admin edit Lorjohn Raña'),
(176, '2021-00027', '2023-11-27 14:12:15', 'admin edit Lorjohn Raña'),
(177, '2021-00027', '2023-11-27 14:12:19', 'admin edit Lorjohn Raña'),
(178, '2021-00027', '2023-11-27 14:12:25', 'admin edit Lorjohn Raña'),
(179, '2021-00027', '2023-11-27 14:15:04', 'admin edit Lorjohn Raña'),
(180, '2021-00027', '2023-11-27 14:15:12', 'admin edit Lorjohn Raña'),
(181, '2021-00027', '2023-11-27 14:15:18', 'admin edit Lorjohn Raña'),
(182, '2021-00027', '2023-11-27 14:22:59', 'admin edit Lorjohn Raña'),
(183, '2021-00027', '2023-11-27 14:23:51', 'admin edit Lorjohn Raña'),
(184, '2021-00027', '2023-11-27 14:24:06', 'admin edit Lorjohn Raña'),
(185, '2021-00027', '2023-11-27 14:25:48', 'admin edit Lorjohn Raña'),
(186, '2021-00027', '2023-11-27 14:25:57', 'admin edit Lorjohn Raña'),
(187, '2021-00027', '2023-11-27 14:26:02', 'admin edit Lorjohn Raña'),
(188, '2021-00027', '2023-11-27 14:26:10', 'admin edit Lorjohn Raña'),
(189, '2021-00027', '2023-11-27 14:27:41', 'admin edit Lorjohn Raña'),
(190, '2021-00027', '2023-11-27 14:27:58', 'admin edit Lorjohn Raña'),
(191, '2021-00027', '2023-11-27 14:28:02', 'admin edit Lorjohn Raña'),
(192, '2021-00027', '2023-11-27 14:30:39', 'admin edit Lorjohn Raña'),
(193, '2021-00027', '2023-11-27 14:30:51', 'admin edit Lorjohn Raña'),
(194, '2021-00027', '2023-11-27 14:31:03', 'admin edit Lorjohn Raña'),
(195, '2021-00027', '2023-11-27 14:32:04', 'admin edit Lorjohn Raña'),
(196, '2021-00027', '2023-11-27 14:32:12', 'admin edit Lorjohn Raña'),
(197, '2021-00027', '2023-11-27 14:33:48', 'admin edit Lorjohn Raña'),
(198, '2021-00027', '2023-11-27 14:37:32', 'admin edit Lorjohn Raña'),
(199, '2021-00027', '2023-11-27 14:37:36', 'admin edit Lorjohn Raña'),
(200, '2021-00027', '2023-11-27 14:39:09', 'admin added Lorjohn Raña'),
(201, '2021-00027', '2023-11-27 14:39:14', 'admin edit Lorjohn Raña'),
(202, '2021-00027', '2023-11-27 14:41:01', 'admin edit Lorjohn Raña'),
(203, '2021-00027', '2023-11-27 14:41:08', 'admin edit Lorjohn Raña'),
(204, '2021-00027', '2023-11-27 14:41:16', 'admin edit Lorjohn Raña'),
(205, '2021-00027', '2023-11-27 14:41:57', 'admin edit Lorjohn Raña'),
(206, '2021-00027', '2023-11-27 14:48:02', 'admin edit Lorjohn Raña'),
(207, '2021-00027', '2023-11-27 14:49:26', 'admin edit Lorjohn Raña'),
(208, '2021-00027', '2023-11-27 14:54:00', 'admin edit Lorjohn Raña'),
(209, '2021-00027', '2023-11-27 14:54:04', 'admin edit Lorjohn Raña'),
(210, '2021-00027', '2023-11-27 14:54:07', 'admin edit Lorjohn Raña'),
(211, '2021-00027', '2023-11-27 14:54:15', 'admin edit Lorjohn Raña'),
(212, '2021-00027', '2023-11-27 14:54:19', 'admin edit Lorjohn Raña'),
(213, '2021-00027', '2023-11-28 18:35:12', 'admin added Cabinet 312ad'),
(214, '2021-00027', '2023-11-28 18:59:31', 'admin edit Lorjohn Raña'),
(215, '2021-00027', '2023-11-28 19:22:07', 'admin edit Lorjohn Raña'),
(216, '2021-00027', '2023-11-28 19:22:17', 'admin edit Lorjohn Raña'),
(217, '2021-00027', '2023-11-28 19:22:59', 'admin added Cabinet 312ad'),
(218, '2021-00027', '2023-11-28 19:36:20', 'admin edit Lorjohn Raña'),
(219, '2021-00027', '2023-11-28 19:36:29', 'admin edit Doormat Raña'),
(220, '2021-00027', '2023-11-28 19:54:00', 'admin added Cabinet SADADS'),
(221, '2021-00027', '2023-11-28 19:54:27', 'admin edit Cabinet SADADS');

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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user_id`, `fname`, `lname`, `initial`, `year`, `course`, `major`, `username`, `password`, `status`, `user_type`, `email`, `usep_email`, `phone_number`, `address`, `img`) VALUES
(20, '2021-00027', 'despenser', 'kyowa', 'M', '2nd', 'BTVTED', 'Information Security', 'John123', '$2y$10$LxFDVnSXPhqNRwGoArN9yuWuj0FTnDAgU9Er9pX6a/3Skat3zihQG', 'Active', 'Student', 'lmran0027@gmail.com', 'lmran0027@gmail.com', '09096763912', 'tagum', 'Picture6.jpg'),
(21, '2021-00028', 'curtain', 'alfalink', 'M', '2nd', 'BECED', 'Information Security', 'John_1233', '$2y$10$Wm98a.c/2aMMezRv6jWRz.AvfPwn9Ejqc37coVzTFtBMs4596XufG', 'Active', 'Student', 'lmran0027@gmail.com', 'lmrana00027@gmail.com', '09096763912', 'tagum', 'Picture3.jpg'),
(24, 'Accusamus a voluptas', 'Zorita', 'Ellison', 'Tempo', '4th', 'BSED', 'Mathematics', 'zufonom', '$2y$10$2ar3.C/v2/Ze4Nm1H/X92uw93FQyixKrNrmZoYdVl93SPHxJbmNkG', 'Active', 'Student', 'jojimuj@mailinator.com', 'jojimuj@mailinator.com', '+1 (766) 718-9077', 'Dolorum mollitia sed', 'Picture5.jpg');

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
-- Stand-in structure for view `vw_borrowed_books`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_borrowed_books`;
CREATE TABLE IF NOT EXISTS `vw_borrowed_books` (
`borrow_id` varchar(100)
,`date_barrowed` date
,`status` varchar(100)
,`user_id` varchar(100)
,`book_title` varchar(100)
,`book_author` varchar(100)
,`book_img` varchar(100)
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
-- Stand-in structure for view `vw_reservation`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_reservation`;
CREATE TABLE IF NOT EXISTS `vw_reservation` (
`reserve_id` int
,`book_id` varchar(100)
,`status` varchar(25)
,`book_title` varchar(100)
,`Author_id` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_penalty`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_user_penalty`;
CREATE TABLE IF NOT EXISTS `vw_user_penalty` (
`user_id` varchar(50)
,`borrow_id` varchar(50)
,`book_title` varchar(100)
,`Author_id` varchar(100)
,`book_img` varchar(100)
,`date_barrowed` date
,`status` varchar(100)
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
-- Structure for view `vw_borrowed_books`
--
DROP TABLE IF EXISTS `vw_borrowed_books`;

DROP VIEW IF EXISTS `vw_borrowed_books`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_borrowed_books`  AS SELECT `tbl_borrow`.`borrow_id` AS `borrow_id`, `tbl_borrow`.`date_barrowed` AS `date_barrowed`, `tbl_borrow`.`status` AS `status`, `tbl_borrow`.`user_id` AS `user_id`, `tbl_book`.`book_title` AS `book_title`, `tbl_book`.`Author_id` AS `book_author`, `tbl_book`.`book_img` AS `book_img` FROM (`tbl_borrow` left join `tbl_book` on((`tbl_borrow`.`book_id` = `tbl_book`.`book_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_logs`
--
DROP TABLE IF EXISTS `vw_logs`;

DROP VIEW IF EXISTS `vw_logs`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_logs`  AS SELECT `tbl_logs`.`date` AS `date`, `tbl_logs`.`admin_id` AS `admin_id`, `tbl_logs`.`action` AS `action`, `tbl_superadmin`.`admin_role` AS `admin_role` FROM (`tbl_logs` join `tbl_superadmin` on((`tbl_logs`.`admin_id` = `tbl_superadmin`.`admin_id`))) ORDER BY `tbl_logs`.`date` AS `DESCdesc` ASC  ;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
