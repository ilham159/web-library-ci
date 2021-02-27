-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 05:42 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id13908114_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_books` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `id_shelf` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_books`, `title`, `author`, `quantity`, `year`, `id_shelf`, `file_name`) VALUES
(1, 'Web Programming', 'Rudi', 10, 2015, 2, 'webbook.jpg'),
(5, 'c++ programming', 'ilham', 19, 2015, 2, 'buku_c++_programming35.jpg');

--
-- Triggers `book`
--
DELIMITER $$
CREATE TRIGGER `insert_quantity_book1` AFTER INSERT ON `book` FOR EACH ROW BEGIN
	UPDATE borrowing SET quantity_b=quantity_b-NEW.quantity
    WHERE id_book= NEW.id_books;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `id_borrowings` int(11) NOT NULL,
  `dates` date NOT NULL,
  `limit` date NOT NULL,
  `quantity_b` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowing`
--

INSERT INTO `borrowing` (`id_borrowings`, `dates`, `limit`, `quantity_b`, `id_book`, `id_student`) VALUES
(7, '2020-05-31', '2020-05-31', 1, 5, 1);

--
-- Triggers `borrowing`
--
DELIMITER $$
CREATE TRIGGER `update_quantity_book` AFTER UPDATE ON `borrowing` FOR EACH ROW BEGIN
	UPDATE book SET quantity=quantity+OLD.quantity_b
    WHERE id_books= NEW.id_book;
    UPDATE book SET quantity=quantity-NEW.quantity_b
    WHERE id_books= NEW.id_book;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `id_major` int(11) NOT NULL,
  `major_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`id_major`, `major_name`) VALUES
(1, 'Informatics engineering'),
(2, 'psychology');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_operators` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_operators`, `nim`, `name`, `gender`, `phone`, `address`) VALUES
(1, '252323204320', 'budi budiartanto', 'L', '+628951000307', 'jl.parung');

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE `shelf` (
  `id_shelfs` int(11) NOT NULL,
  `shelf_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`id_shelfs`, `shelf_name`) VALUES
(1, 'SQL'),
(2, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_students` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `id_major` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_students`, `nim`, `name`, `gender`, `semester`, `phone`, `address`, `id_major`) VALUES
(1, '41518010007', 'ilham dyki', 'L', '4', '+6289510003066', 'jl.pedongkelan', 1),
(2, '41518010021', 'Daniel Sihombing', 'L', '4', '+6289510003068', 'jl.bekasi', 1),
(3, '41518010022', 'm. beryl boran akbar', 'L', '4', '+6289510003077', 'jl.meruya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transactions` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_total` varchar(15) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `id_borrowing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_login` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_login`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'ilham', 'dykiganteng1st@gmail.com', 'foto-gw.jpg', '$2y$10$2Zym9wZlsF8DSGGAhYh6G.dUwZnpE/SJ5DShKwKusH.QdJtkQ0qqe', 1, 1, 1588438316),
(2, 'dyki', 'ilhamdyki12345@gmail.com', 'dyki_image.jpg', '$2y$10$yqQ0Y5bD/mItMCiDXvyWYeDxgVJp5IzNzK2pwSD/YOlURGgI2qJna', 1, 1, 1589087300);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `url` varchar(600) NOT NULL,
  `icon` varchar(600) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw-fa-techmometer-alt', 1),
(2, 2, 'Books', 'books/read', 'fas fa-fw fa-book', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_books`),
  ADD KEY `book_ibfk_2` (`id_shelf`);

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`id_borrowings`),
  ADD KEY `id_book` (`id_book`),
  ADD KEY `id_student` (`id_student`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`id_major`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_operators`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`id_shelfs`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_students`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `id_major` (`id_major`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transactions`),
  ADD KEY `id_operator` (`id_operator`),
  ADD KEY `id_transaction` (`id_borrowing`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `fk_role` (`role_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_books` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `id_borrowings` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `id_major` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id_operators` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shelf`
--
ALTER TABLE `shelf`
  MODIFY `id_shelfs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_students` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transactions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`id_shelf`) REFERENCES `shelf` (`id_shelfs`);

--
-- Constraints for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `borrowing_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_books`),
  ADD CONSTRAINT `borrowing_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_students`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_major`) REFERENCES `major` (`id_major`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_operator`) REFERENCES `operator` (`id_operators`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`id_borrowing`) REFERENCES `borrowing` (`id_borrowings`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
