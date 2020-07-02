-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2020 at 01:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecorner`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `A_id` int(11) NOT NULL,
  `A_firstname` varchar(45) NOT NULL,
  `A_lastname` varchar(45) NOT NULL,
  `A_username` varchar(45) NOT NULL,
  `A_email` varchar(45) NOT NULL,
  `A_password` varchar(45) NOT NULL,
  `A_confirmpassword` varchar(45) NOT NULL,
  `A_gender` varchar(8) NOT NULL,
  `A_mobilenumber` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carousel`
--

CREATE TABLE `tbl_carousel` (
  `C_id` int(11) NOT NULL,
  `C_name` varchar(45) NOT NULL,
  `C_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `P_id` int(11) NOT NULL,
  `P_name` varchar(45) NOT NULL,
  `P_category` varchar(10) NOT NULL,
  `P_price` double(10,2) NOT NULL,
  `P_image` varchar(500) NOT NULL,
  `P_quantity` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`P_id`, `P_name`, `P_category`, `P_price`, `P_image`, `P_quantity`) VALUES
(1, 'Coffee Capuccino ', 'Coffee', 1087.00, 'images/poster/Coffee1.jpg', 90),
(2, 'Coffee Capuccino', 'Coffee', 1723.00, 'images/poster/Coffee2.jpg', 100),
(3, 'Coffee Capuccino', 'Coffee', 1900.00, 'images/poster/Coffee3.jpg', 100),
(4, 'Coffee Capuccino', 'Coffee', 2000.00, 'images/poster/Coffee4.jpg', 100),
(5, 'Grilled Beef', 'Main Dish', 600.00, 'images/poster/dish3.jpg', 100),
(6, 'Grilled Beef', 'Main Dish', 1723.00, 'images/poster/dish2.jpg', 100),
(7, 'Grilled Beef', 'Main Dish', 1900.00, 'images/poster/dish4.jpg', 100),
(8, 'Grilled Beef', 'Main Dish', 600.00, 'images/poster/dish5.jpg', 100),
(9, 'Lemonade Juice', 'Drinks', 555.00, 'images/poster/drink1.jpg', 100),
(10, 'Pineapple Juice', 'Drinks', 600.00, 'images/poster/drink2.jpg', 200),
(11, 'Soda Drinks', 'Drinks', 600.00, 'images/poster/drink3.jpg', 100),
(12, 'Lemonade Juice', 'Drinks', 600.00, 'images/poster/drink4.jpg', 200),
(13, 'Pineapple Juice', 'Drinks', 545.00, 'images/poster/drink5.jpg', 90),
(14, 'Soda Drinks', 'Drinks', 600.00, 'images/poster/drink6.jpg', 100),
(15, 'Hot Cake Honey', 'Desserts', 600.00, 'images/poster/dessert1.jpg', 100),
(16, 'Hot Cake Honey', 'Desserts', 450.00, 'images/poster/dessert2.jpg', 100),
(17, 'Hot Cake Honey', 'Desserts', 545.00, 'images/poster/dessert3.jpg', 100),
(18, 'Hot Cake Honey', 'Desserts', 600.00, 'images/poster/dessert4.jpg', 100),
(19, 'Hot Cake Honey', 'Desserts', 600.00, 'images/poster/dessert5.jpg', 100),
(20, 'Hot Cake Honey', 'Desserts', 450.00, 'images/poster/dessert6.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `U_id` int(11) NOT NULL,
  `U_firstname` varchar(45) NOT NULL,
  `U_lastname` varchar(45) NOT NULL,
  `U_username` varchar(45) NOT NULL,
  `U_email` varchar(45) NOT NULL,
  `U_password` varchar(45) NOT NULL,
  `U_confirmpassword` varchar(45) NOT NULL,
  `U_gender` varchar(45) NOT NULL,
  `U_city` varchar(45) NOT NULL,
  `U_address` varchar(100) NOT NULL,
  `U_place` varchar(45) NOT NULL,
  `U_country` varchar(45) NOT NULL,
  `U_telephone` int(12) NOT NULL,
  `U_mobilenumber` int(12) NOT NULL,
  `U_cardtnumber` int(15) NOT NULL,
  `U_carddate` int(6) NOT NULL,
  `U_cardCVC` int(4) NOT NULL,
  `U_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`U_id`, `U_firstname`, `U_lastname`, `U_username`, `U_email`, `U_password`, `U_confirmpassword`, `U_gender`, `U_city`, `U_address`, `U_place`, `U_country`, `U_telephone`, `U_mobilenumber`, `U_cardtnumber`, `U_carddate`, `U_cardCVC`, `U_image`) VALUES
(1, 'Irosha', 'Dasanayaka', 'Irosha Dasanayaka', 'nayanajithirosha@gmail.com', 'irosha@1234', '', 'Male', '', '', '', 'SriLanka', 0, 777777777, 0, 0, 0, 'Coffee4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`A_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`P_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`U_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `A_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `U_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
