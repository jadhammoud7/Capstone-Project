-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 11:15 PM
-- Server version: 8.0.23
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newbie_gamers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_address` varchar(225) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `first_name`, `last_name`, `email_address`, `phone_number`, `username`, `password`) VALUES
(2, 'mohamad', 'nabaa', 'mohamad.nabaa01@lau.com', '71123805', 'MNabaa2001', 'Mn123654'),
(4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'MNabaa', '578835a5afad634f5716badf3d801e8910dec33e73ec5c9e86b8d409f229263d'),
(5, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'MNabaa111', '578835a5afad634f5716badf3d801e8910dec33e73ec5c9e86b8d409f229263d'),
(6, 'Jad', 'Hammoud', 'Jad_hammoud@gmail.com', '76939605', 'jad123', '94f855e068e112f940460fdce21adae8fb8adfd0773ce5f30828b72c2abe65b2');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `appointment_name` varchar(50) NOT NULL,
  `appointment_type` varchar(50) NOT NULL,
  `price_per_hour` int NOT NULL,
  `date` date NOT NULL,
  `hour` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `customer_id`, `appointment_name`, `appointment_type`, `price_per_hour`, `date`, `hour`, `status`) VALUES
(23, 4, 'laptop cleaning', 'Repair Service', 25, '2022-11-27', '8:00-9:30 AM', 'Done Work'),
(25, 4, 'laptop cleaning', 'Repair Service', 25, '2024-00-08', '8:00-9:30 AM', 'Done Work'),
(35, 4, 'Gears 5', 'Free Game Trial', 0, '2022-12-07', '8:00-9:30 AM', 'Pending'),
(36, 4, 'laptop cleaning', 'Repair Service', 25, '2022-12-17', '6:00-7:30 PM', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `baskets_customer_product`
--

CREATE TABLE `baskets_customer_product` (
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `cost` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `baskets_customer_product`
--

INSERT INTO `baskets_customer_product` (`customer_id`, `product_id`, `quantity`, `cost`, `price`) VALUES
(22, 20, 1, 0, 25);

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `checkout_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `shipping_country` varchar(50) NOT NULL,
  `shipping_location` varchar(225) NOT NULL,
  `shipping_company` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `order_notes` varchar(100) NOT NULL,
  `total_cost` double NOT NULL,
  `total_price` double NOT NULL,
  `tax_price` double NOT NULL,
  `total_price_including_tax` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`checkout_id`, `customer_id`, `first_name`, `last_name`, `email`, `phone_number`, `shipping_country`, `shipping_location`, `shipping_company`, `postcode`, `order_notes`, `total_cost`, `total_price`, `tax_price`, `total_price_including_tax`, `status`, `date`) VALUES
(4, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 0, 300, 30, 330, 'Done Work', '2022-08-28'),
(5, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 0, 46, 4.6000000000000005, 50.6, 'Pending', '2022-08-28'),
(6, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'thank you', 0, 10, 1, 11, 'Pending', '2022-11-27'),
(7, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'thank you', 0, 3000, 300, 3300, 'Pending', '2022-11-27'),
(8, 4, 'Mohamad', 'Nabaa', 'mnabaa53@gmail.com', '96171123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 0, 1550, 139.5, 1534.5, 'Pending', '2022-12-07'),
(9, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '71123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 0, 30, 2.7, 29.7, 'Done Work', '2022-12-12'),
(10, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '71123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 35, 30, 2.7, 29.7, 'Done Work', '2022-12-12'),
(11, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '71123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 35, 30, 2.7, 29.7, 'Done Work', '2022-12-12'),
(12, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 0, 990, 89.10000000000001, 980.1, 'Pending', '2022-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts_customers_products`
--

CREATE TABLE `checkouts_customers_products` (
  `checkout_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` int NOT NULL,
  `total_cost` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkouts_customers_products`
--

INSERT INTO `checkouts_customers_products` (`checkout_id`, `product_id`, `quantity`, `total_price`, `total_cost`) VALUES
(4, 1, 4, 300, 0),
(5, 2, 1, 46, 0),
(5, 20, 10, 100, 0),
(5, 21, 3, 1500, 0),
(5, 20, 10, 100, 0),
(6, 20, 1, 10, 0),
(6, 20, 1, 10, 0),
(7, 1, 10, 3000, 0),
(8, 6, 1, 500, 0),
(8, 21, 1, 500, 0),
(8, 10, 1, 550, 0),
(9, 23, 1, 0, 30),
(10, 23, 1, 30, 35),
(11, 23, 1, 30, 35),
(12, 7, 1, 990, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `customer_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`customer_id`, `username`, `comment`) VALUES
(2, 'jad', 'best shop in town'),
(2, 'jad', 'hello'),
(2, 'jad', 'good quality'),
(3, 'mhmd', 'best prices!!'),
(4, 'Mohamad Nabaa', 'love it'),
(4, 'Mohamad Nabaa', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int NOT NULL,
  `first_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city` varchar(255) NOT NULL,
  `username` varchar(225) NOT NULL,
  `customer_image` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `loyalty_points` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `date_of_birth`, `phone_number`, `address`, `city`, `username`, `customer_image`, `password`, `loyalty_points`) VALUES
(2, 'jad', 'hammoud', 'jad.hammoud@gmail.com', '2022-09-06', '76939605', 'beirut ras el nabeh', 'aaramun', 'jad', '', '8384caf9895a1f9ab17aa8055b0b5869f3e8eba263aac96585f1ee871dd3d5f0', 5),
(3, 'mohamad', 'Nabaa', 'mohamad@gmail.com', '2022-08-22', '71123805', 'beirut next to fakhani second floor', 'bshamoun', 'mhmd', '', '8f9cebbfdc1a99ce7a4941ad08c34c4f1f08089ceff43b802dab3b951d6cbfd1', 0),
(4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '2022-08-01', '96171123805', 'Aramoun next to chamsine third floor', 'aaramun', 'Mohamad Nabaa', 'me.jpg', '578835a5afad634f5716badf3d801e8910dec33e73ec5c9e86b8d409f229263d', 47),
(16, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '2001-07-18', '96171123805', 'Aramoun next to chamsine third floor', 'beirut', 'Mohamad Nabaa', '', '578835a5afad634f5716badf3d801e8910dec33e73ec5c9e86b8d409f229263d', 0),
(17, 'Omar ', 'Atieh', 'omar4Atieh@hotmail.com', '2022-09-21', '878887878788', 'Bshamoun , al wadi street Al nader building block B second floor', 'bshamoun', 'omar1234567', '', '75523907535270f2f12668aea07b507433e81ed0e625b9455bdb8554855687e0', 0),
(21, 'Ahmad', 'Serhan', 'ahmadserhan@gmail.com', '2022-08-30', '45657888878', 'Bshamoun , al wadi street Al nader building block B second floor', 'beirut', 'ahmad1231234', '', '68a8b4c8464fa9bc797ce97b47bff6807ba10d8ddb061fce39b28842389888fa', 0),
(22, 'Mohamad', 'Nabaa', 'mnabaa53@gmail.com', '2001-07-18', '71123805', 'Aramoun, Lebanon', 'aramoun, lebanon', 'MNabaa53', 'addfav.png', '92f359bda0cfecfc2a5ff9f2da08d91d02a4366f33021df0477bfcee609be9b2', 0),
(23, 'Omar', 'Nabaa', 'omarnabaa318@gmail.com', '2004-10-18', '76625990', 'Sanawbar Building, 5th floor', 'beirut', 'OmarNabaa', 'addfav.png', '372a3b6c6980c77daaac003c1e9daa454218aeb55d110cecc9b077a8acfda37d', 0),
(24, 'Omar', 'Nabaa', 'omarnabaa318@gmail.com', '2004-10-18', '76625990', 'Sanawbar Building, 5th floor', 'beirut', 'OmarNabaa11', 'contact-us.jpg', '372a3b6c6980c77daaac003c1e9daa454218aeb55d110cecc9b077a8acfda37d', 0),
(25, 'Omar', 'Nabaa', 'ahmad@goodies.com.lb', '2022-10-04', '71640625', 'Aramoun, Shebaa street', 'beirut', 'mhmd2001', '287E3F52-10FC-4FCD-BC8F-B28BF7C012ED (1).png', '92f359bda0cfecfc2a5ff9f2da08d91d02a4366f33021df0477bfcee609be9b2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favorites_customer_product`
--

CREATE TABLE `favorites_customer_product` (
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favorites_customer_product`
--

INSERT INTO `favorites_customer_product` (`customer_id`, `product_id`) VALUES
(4, 21);

-- --------------------------------------------------------

--
-- Table structure for table `history_product_inventory`
--

CREATE TABLE `history_product_inventory` (
  `product_id` int NOT NULL,
  `inventory` int NOT NULL,
  `inventory_change` int NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history_product_inventory`
--

INSERT INTO `history_product_inventory` (`product_id`, `inventory`, `inventory_change`, `modified_by`, `modified_on`) VALUES
(1, 98, 1, '', ''),
(19, 5, 1, 'Mohamad Nabaa', '2022-10-15 01:39:22'),
(19, 5, 1, 'Mohamad Nabaa', '2022-10-15 01:47:26'),
(1, 86, 1, 'Store Sales', '2022-10-15 05:02:30'),
(1, 81, 1, 'Store Sales', '2022-10-15 05:03:27'),
(1, 80, 1, 'Store Sales', '2022-10-15 05:05:34'),
(1, 100, 1, 'Mohamad Nabaa', '2022-10-26 10:23:38'),
(21, 5, 1, 'Mohamad Nabaa', '2022-10-29 01:03:35'),
(2, 5, 1, 'Mohamad Nabaa', '2022-10-29 01:13:18'),
(22, 10, 10, 'Mohamad Nabaa', '2022-11-11 09:37:29'),
(22, 20, 10, 'Mohamad Nabaa', '2022-11-11 09:41:11'),
(22, 15, -5, 'Mohamad Nabaa', '2022-11-11 09:41:45'),
(22, 10, -5, 'Mohamad Nabaa', '2022-11-11 09:42:16'),
(22, 5, -5, 'Mohamad Nabaa', '2022-11-11 09:45:03'),
(22, 0, -5, 'Mohamad Nabaa', '2022-11-11 09:51:01'),
(22, 20, 20, 'Mohamad Nabaa', '2022-11-12 12:54:36'),
(22, 15, -5, 'Mohamad Nabaa', '2022-11-12 12:54:57'),
(22, 14, -1, 'Mohamad Nabaa', '2022-11-12 01:00:13'),
(22, 0, -14, 'Mohamad Nabaa', '2022-11-12 01:07:30'),
(22, 50, 50, 'Mohamad Nabaa', '2022-11-12 01:10:59'),
(22, 40, -10, 'Mohamad Nabaa', '2022-11-12 01:11:54'),
(22, 30, -10, 'Mohamad Nabaa', '2022-11-12 01:26:22'),
(22, 25, -5, 'Mohamad Nabaa', '2022-11-12 01:40:20'),
(22, 20, -5, 'Mohamad Nabaa', '2022-11-12 01:42:46'),
(22, 15, -5, 'Mohamad Nabaa', '2022-11-12 01:48:38'),
(22, 0, -15, 'Mohamad Nabaa', '2022-11-12 01:53:30'),
(22, 10, 10, 'Mohamad Nabaa', '2022-11-12 01:57:28'),
(22, 0, -10, 'Mohamad Nabaa', '2022-11-12 01:57:39'),
(23, 20, 20, 'Mohamad Nabaa', '2022-12-08 12:02:04'),
(23, 19, -1, 'Mohamad Nabaa', '2022-12-08 12:05:51'),
(23, 18, -1, 'Mohamad Nabaa', '2022-12-08 12:06:59'),
(23, 17, -1, 'Mohamad Nabaa', '2022-12-08 12:09:22'),
(23, 16, -1, 'Mohamad Nabaa', '2022-12-08 12:13:14'),
(23, 14, -2, 'Mohamad Nabaa', '2022-12-08 12:18:18'),
(23, 13, -1, 'Mohamad Nabaa', '2022-12-08 12:18:45'),
(23, 12, -1, 'Mohamad Nabaa', '2022-12-08 12:28:28'),
(23, 11, -1, 'Mohamad Nabaa', '2022-12-08 12:36:19'),
(23, 10, -1, 'Mohamad Nabaa', '2022-12-08 12:37:20'),
(23, 9, -1, 'Mohamad Nabaa', '2022-12-08 12:37:40'),
(23, 8, -1, 'Mohamad Nabaa', '2022-12-08 12:39:36'),
(23, 100, 100, 'Mohamad Nabaa', '2022-12-12 01:20:18'),
(23, 94, -1, 'Checkout Order', '2022-12-12 01:28:41'),
(23, 93, -1, 'Mohamad Nabaa', '2022-12-12 01:40:24'),
(23, 92, -1, 'Mohamad Nabaa', '2022-12-12 01:51:21'),
(23, 91, -1, 'Mohamad Nabaa', '2022-12-17 07:49:05'),
(24, 10, 10, 'Mohamad Nabaa', '2022-12-17 07:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `history_product_offers`
--

CREATE TABLE `history_product_offers` (
  `product_id` int NOT NULL,
  `old_price` int NOT NULL,
  `new_price` int NOT NULL,
  `offer_percentage` decimal(5,0) NOT NULL,
  `offer_begin_date` date NOT NULL,
  `offer_end_date` date NOT NULL,
  `last_modified_by` varchar(50) NOT NULL,
  `last_modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_product_prices`
--

CREATE TABLE `history_product_prices` (
  `product_id` int NOT NULL,
  `price` int NOT NULL,
  `price_change` varchar(5) NOT NULL,
  `modified_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `modified_on` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history_product_prices`
--

INSERT INTO `history_product_prices` (`product_id`, `price`, `price_change`, `modified_by`, `modified_on`) VALUES
(1, 225, '', '', ''),
(1, 300, '', '', ''),
(1, 350, '', '', ''),
(1, 200, '', 'Mohamad Nabaa', '2022-10-11 12:29:36'),
(1, 250, '', 'Mohamad Nabaa', '2022-10-11 12:32:14'),
(1, 300, '', 'Mohamad Nabaa', '2022-10-11 12:33:33'),
(1, 200, '', 'Mohamad Nabaa', '2022-10-11 12:38:22'),
(1, 300, '', 'Mohamad Nabaa', '2022-10-11 12:39:35'),
(19, 30, '0', 'Mohamad Nabaa', '2022-10-15 01:39:22'),
(19, 30, '0', 'Mohamad Nabaa', '2022-10-15 01:47:26'),
(21, 500, '0', 'Mohamad Nabaa', '2022-10-29 01:03:35'),
(2, 45, '- 1', 'Mohamad Nabaa', '2022-10-29 01:13:18'),
(22, 850, '0', 'Mohamad Nabaa', '2022-11-11 09:37:29'),
(23, 40, '0', 'Mohamad Nabaa', '2022-12-08 12:02:04'),
(1, 300, '300', 'Mohamad Nabaa', '2022-12-12 12:35:09'),
(23, 40, '40', 'Mohamad Nabaa', '2022-12-12 12:36:03'),
(23, 40, '40', 'Mohamad Nabaa', '2022-12-12 01:20:18'),
(24, 20, '0', 'Mohamad Nabaa', '2022-12-17 07:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `history_product_sales`
--

CREATE TABLE `history_product_sales` (
  `product_id` int NOT NULL,
  `sales_number` int NOT NULL,
  `sales_change` int NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history_product_sales`
--

INSERT INTO `history_product_sales` (`product_id`, `sales_number`, `sales_change`, `modified_by`, `modified_on`) VALUES
(1, 5, 0, '', '2022-10-11'),
(19, 0, 0, 'Mohamad Nabaa', '2022-10-15 01:39:22'),
(19, -3, 0, 'Mohamad Nabaa', '2022-10-15 01:47:26'),
(1, 1, 0, 'Store Sales', '2022-10-15 05:02:30'),
(1, 5, 0, 'Store Sales', '2022-10-15 05:03:27'),
(1, 1, 0, 'Store Sales', '2022-10-15 05:05:34'),
(21, 0, 0, 'Mohamad Nabaa', '2022-10-29 01:03:35'),
(22, 0, 0, 'Mohamad Nabaa', '2022-11-11 09:37:29'),
(22, 5, 5, 'Mohamad Nabaa', '2022-11-11 09:45:03'),
(22, 5, 5, 'Mohamad Nabaa', '2022-11-11 09:51:01'),
(22, 5, 5, 'Mohamad Nabaa', '2022-11-12 12:54:57'),
(22, 1, 1, 'Mohamad Nabaa', '2022-11-12 01:00:13'),
(22, 14, 14, 'Mohamad Nabaa', '2022-11-12 01:07:30'),
(22, 10, 10, 'Mohamad Nabaa', '2022-11-12 01:11:54'),
(22, 10, 10, 'Mohamad Nabaa', '2022-11-12 01:26:22'),
(22, 15, 5, 'Mohamad Nabaa', '2022-11-12 01:48:38'),
(22, 30, 15, 'Mohamad Nabaa', '2022-11-12 01:53:30'),
(22, 40, 10, 'Mohamad Nabaa', '2022-11-12 01:57:39'),
(23, 0, 0, 'Mohamad Nabaa', '2022-12-08 12:02:04'),
(23, 1, 1, 'Mohamad Nabaa', '2022-12-08 12:05:51'),
(23, 2, 1, 'Mohamad Nabaa', '2022-12-08 12:06:59'),
(23, 3, 1, 'Mohamad Nabaa', '2022-12-08 12:09:22'),
(23, 4, 1, 'Mohamad Nabaa', '2022-12-08 12:13:14'),
(23, 6, 2, 'Mohamad Nabaa', '2022-12-08 12:18:18'),
(23, 7, 1, 'Mohamad Nabaa', '2022-12-08 12:18:45'),
(23, 8, 1, 'Mohamad Nabaa', '2022-12-08 12:28:28'),
(23, 9, 1, 'Mohamad Nabaa', '2022-12-08 12:39:36'),
(23, 23, 1, 'Checkout Order', '2022-12-12 01:28:41'),
(23, 24, 1, 'Mohamad Nabaa', '2022-12-12 01:40:24'),
(23, 25, 1, 'Mohamad Nabaa', '2022-12-12 01:51:21'),
(23, 26, 1, 'Mohamad Nabaa', '2022-12-17 07:49:05'),
(24, 1, 0, 'Mohamad Nabaa', '2022-12-17 07:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_discounts`
--

CREATE TABLE `loyalty_discounts` (
  `loyalty_point_required` int NOT NULL,
  `discount_percentage` int NOT NULL,
  `benefitted_customers` int NOT NULL,
  `last_modified_by` varchar(50) NOT NULL,
  `last_modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loyalty_discounts`
--

INSERT INTO `loyalty_discounts` (`loyalty_point_required`, `discount_percentage`, `benefitted_customers`, `last_modified_by`, `last_modified_on`) VALUES
(10, 10, 1, 'Mohamad Nabaa', '2022-12-06 07:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` varchar(225) NOT NULL,
  `unit_cost` int NOT NULL,
  `unit_price` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(225) NOT NULL,
  `inventory` int NOT NULL,
  `sales_number` int NOT NULL,
  `has_offer` varchar(5) NOT NULL,
  `date_added` date NOT NULL,
  `last_modified_by` varchar(50) NOT NULL,
  `last_modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `unit_cost`, `unit_price`, `type`, `category`, `description`, `age`, `image`, `inventory`, `sales_number`, `has_offer`, `date_added`, `last_modified_by`, `last_modified_on`) VALUES
(1, 'Doom Eternal', 250, 300, 'Phone', 'Action', 'Hell’s armies have invaded Earth. Become the Slayer in an epic single-player campaign to conquer demons across dimensions and stop the final destruction of humanity. The only thing they fear... is you.', '15+', 'DoomEternal.jpeg', 0, 5, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-12-12 12:35:09'),
(2, 'Gears 5', 0, 45, 'cds', 'Action', 'Gears 5 follows the story of Kait Diaz, who is on a journey to find out the origin of the Locust Horde, the main antagonistic faction of the Gears of War series.', '16+', 'gears5.jpeg', 5, 0, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-11-27 11:03:14'),
(3, 'Watch Dogs - Legion', 0, 50, 'Phone', 'Action', 'Gameplay in the Watch Dogs games focuses on an open world where the player can complete missions to progress an overall story, as well as engage in various side activities.', '12+', 'watchdogs.jpeg', 0, 0, 'YES', '0000-00-00', 'Mohamad Nabaa', '2022-11-27 10:00:54'),
(4, 'Battletoads', 0, 50, 'Phone', 'Action', 'After being locked up in a fantasy simulator bunker for 26 years, the Battletoads are no longer intergalactic heroes and have fallen into modern day obscurity. Unable to settle down for a quiet, simple life, they set out to once again defeat their old longtime nemesis, The Dark Queen, to regain their lost fame. But when they confront the Queen they find out she had been in a similar predicament as them, having also been trapped and losing her powers. In the end they decide to team up with her to take down an evil alien race called the Topians, who were responsible for trapping all of them and are now the current rulers of the galaxy.', '12+', 'battletoads.jpeg', 0, 0, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-11-27 08:59:59'),
(5, 'Iphone x', 0, 350, 'Phone', 'Action', 'The iPhone X is a smartphone designed, developed and marketed by Apple Inc. The 11th generation of the iPhone, it was available to pre-order on October 27, 2017, and was released on November 3, 2017. The naming of the iPhone X (skipping the iPhone 9) is to mark the 10th anniversary of the iPhone .The iPhone X used a glass and stainless-steel form factor and \"bezel-less\" design, shrinking the bezels while not having a \"chin\", unlike many Android phones', 'Any', 'iphonex.jpeg', 0, 0, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-11-27 10:01:38'),
(6, 'Iphone 11', 0, 500, 'Phone', 'Action', 'The iPhone 11 is a smartphone designed, developed, and marketed by Apple Inc. It is the 13th generation of iPhone, succeeding the iPhone XR, and was unveiled on September 10, 2019 alongside the iPhone 11 Pro at the Steve Jobs Theater in Apple Park, Cupertino, by Apple CEO Tim Cook. Preorders began on September 13, 2019, and the phone was officially released on September 20, 2019, one day after the official public release of iOS 13.', 'Any', 'iphone11.jpeg', 0, 0, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-11-27 10:02:17'),
(7, 'Galaxy Z Fold2', 0, 990, 'Phone', 'Action', 'The Samsung Galaxy Z Fold 2 (stylized as Samsung Galaxy Z Fold2, sold as Samsung Galaxy Fold 2 in certain territories) is an Android-based foldable smartphone developed by Samsung Electronics for its Samsung Galaxy Z series, succeeding the Samsung Galaxy Z Fold. It was announced on 5 August 2020 alongside the Samsung Galaxy Note 20, the Samsung Galaxy Tab S7, the Galaxy Buds Live, and the Galaxy Watch 3. Samsung later revealed pricing and availability details on 1 September.\r\n\r\n', 'Any', 'galaxyzfold2.jpeg', 0, 0, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-11-27 10:03:02'),
(9, 'PlayStation 3', 0, 300, 'Phone', 'Action', 'The PlayStation 3 (PS3) is a home video game console developed by Sony Computer Entertainment. The successor to the PlayStation 2, it is part of the PlayStation brand of consoles. It was first released on November 11, 2006, in Japan, November 17, 2006, in North America, and March 23, 2007, in Europe and Australia. The PlayStation 3 competed primarily against Microsoft\'s Xbox 360 and Nintendo\'s Wii as part of the seventh generation of video game consoles.', 'Any', 'ps3.jpeg', 0, 0, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-11-27 10:03:40'),
(10, 'PlayStation 4', 0, 550, 'Phone', 'Action', 'The PlayStation 4 (PS4) is a home video game console developed by Sony Computer Entertainment. Announced as the successor to the PlayStation 3 in February 2013, it was launched on November 15, 2013, in North America, November 29, 2013 in Europe, South America and Australia, and on February 22, 2014 in Japan. A console of the eighth generation, it competes with Microsoft\'s Xbox One and Nintendo\'s Wii U and Switch.', 'Any', 'ps4.jpeg', 0, 0, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-11-27 10:04:18'),
(21, 'Nintendo Switch', 0, 500, 'Consoles', 'Nintendo', 'The Nintendo Switch is a video game console developed by Nintendo and released worldwide in most regions on March 3, 2017. The console itself is a tablet that can either be docked for use as a h…', '12+ age', 'nintendoswitch.jpeg', 5, 0, 'NO', '0000-00-00', 'Mohamad Nabaa', '2022-10-29 01:10:31'),
(22, 'IPhone 13 Pro', 0, 850, 'Phone', 'Action', 'iPhone 13 Pro was made for low light. The Wide camera adds a wider aperture and our largest sensor yet — and it leverages the LiDAR Scanner for Night mode portraits', '16+', 'iphone13pro.jpeg', 0, 40, 'YES', '0000-00-00', 'Mohamad Nabaa', '2022-11-12 01:57:28'),
(23, 'GTA Trilogy PS4', 35, 40, 'Phone', 'Action', 'Grand Theft Auto: The Trilogy - The Definitive Edition - Rockstar Games GTAIII, Vice City, and San Andreas updated with enhanced visuals and gameplay.', '21+ age', 'gtatrilogy.jpeg', 91, 26, 'NO', '2022-12-08', 'Mohamad Nabaa', '2022-12-12 01:20:18'),
(24, 'GTA 5', 10, 20, 'Phone', 'Action', 'Grand Theft Auto V is a 2013 action-adventure game developed by Rockstar North and published by Rockstar Games. It is the seventh main entry in the Grand Theft Auto series, following 2008\'s Grand Theft Auto IV, and the fifteenth instalment overall', '16+', 'controller_repair.jpg', 10, 1, 'NO', '2022-12-17', 'Mohamad Nabaa', '2022-12-17 07:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `products_inventory_sales`
--

CREATE TABLE `products_inventory_sales` (
  `product_id` int NOT NULL,
  `inventory_history` int NOT NULL,
  `sales_history` int NOT NULL,
  `inventory_sales_ratio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products_inventory_sales`
--

INSERT INTO `products_inventory_sales` (`product_id`, `inventory_history`, `sales_history`, `inventory_sales_ratio`) VALUES
(22, 120, 25, 25),
(23, 120, 12, 10),
(24, 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_offers`
--

CREATE TABLE `products_offers` (
  `product_id` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `old_price` int NOT NULL,
  `new_price` int NOT NULL,
  `offer_percentage` decimal(5,0) NOT NULL,
  `offer_begin_date` date NOT NULL,
  `offer_end_date` date NOT NULL,
  `last_modified_by` varchar(50) NOT NULL,
  `last_modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products_offers`
--

INSERT INTO `products_offers` (`product_id`, `type`, `category`, `old_price`, `new_price`, `offer_percentage`, `offer_begin_date`, `offer_end_date`, `last_modified_by`, `last_modified_on`) VALUES
(20, 'CDs', 'Strategy', 25, 10, '60', '2022-11-25', '2022-12-02', 'Mohamad Nabaa', '2022-12-07 11:53:17'),
(22, 'Phone', 'Action', 850, 800, '6', '2022-12-17', '2022-12-24', 'Mohamad Nabaa', '2022-12-17 08:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `category` varchar(100) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `modified_on` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category`, `added_by`, `modified_on`) VALUES
('Action', 'Mohamad Nabaa', '2022-10-27 12:51:06'),
('Strategy', 'Mohamad Nabaa', '2022-10-27 03:55:12'),
('Nintendo', 'Mohamad Nabaa', '2022-10-29 12:56:24'),
('XBOX One', 'Mohamad Nabaa', '2022-10-29 01:13:59'),
('Cell Phones', 'Mohamad Nabaa', '2022-11-11 09:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `type` varchar(100) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `modified_on` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`type`, `added_by`, `modified_on`) VALUES
('Phone', 'Mohamad Nabaa', '2022-10-27 12:19:29'),
('CDs', 'Mohamad Nabaa', '2022-10-27 12:20:02'),
('Consoles', 'Mohamad Nabaa', '2022-10-27 12:20:16'),
('Computers', 'Mohamad Nabaa', '2022-10-27 03:25:25'),
('Phone Accessories', 'Mohamad Nabaa', '2022-10-27 03:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `repair_id` int NOT NULL,
  `repair_type` varchar(255) NOT NULL,
  `price_per_hour` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`repair_id`, `repair_type`, `price_per_hour`, `description`, `image`) VALUES
(1, 'laptop cleaning', 25, 'dsdffdfddfsdfsfds', 'cpu_cleaning.jpg'),
(2, 'Laptop Cleaning', 10, 'Schedule now and bring your laptop for a special spa day. We require a total of 10$ for a one\r\nhour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(3, 'CPU Repair including gaming and normal ones', 25, 'Schedule now and bring your CPU for repair or maintanence for your CPU.This offer includes gaming CPU and normal ones. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(4, 'CPU Cleaning including gaming and normal ones', 20, 'Schedule now and bring your CPU for a special spa day for your CPU.This offer includes gaming CPU\r\nand normal ones. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(5, 'Phone Repair', 75, 'Schedule now and bring your Phones for repair or maintanence. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(6, 'PS Repair', 30, 'Schedule now and bring your ps consoles for repair or maintanence. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(7, 'Controller Repair', 15, 'Schedule now and bring your constrolers for repair or maintanence.Thos offer includes controllers for all type of consoles (ps2, ps3, ps4, ps5..). We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(9, 'Repair Laptop', 25, 'Repair all types of laptops including CPU and hard disk.', 'cpu_repair.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales_products`
--

CREATE TABLE `sales_products` (
  `sales_id` int NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int NOT NULL,
  `cost` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales_products`
--

INSERT INTO `sales_products` (`sales_id`, `product_name`, `quantity`, `cost`, `price`) VALUES
(13, 'Doom Eternal', 10, 0, 1000),
(13, 'Watch Dogs: Legion', 5, 0, 250),
(14, 'Doom Eternal', 10, 0, 1000),
(14, 'Watch Dogs: Legion', 5, 0, 250),
(15, 'Doom Eternal', 10, 0, 1000),
(15, 'Watch Dogs: Legion', 5, 0, 250),
(16, 'Doom Eternal', 10, 0, 1000),
(16, 'Watch Dogs: Legion', 5, 0, 250),
(17, 'Doom Eternal', 5, 0, 1500),
(18, 'Doom Eternal', 5, 0, 1500),
(19, 'Doom Eternal', 5, 0, 1500),
(20, 'Watch Dogs: Legion', 10, 0, 500),
(21, 'Watch Dogs: Legion', 10, 0, 500),
(22, 'Gears 5', 10, 0, 460),
(23, 'Doom Eternal', 5, 0, 1500),
(23, 'Doom Eternal', 5, 0, 1500),
(24, 'Doom Eternal', 5, 0, 1500),
(25, 'Doom Eternal', 10, 0, 3000),
(26, 'Doom Eternal', 10, 0, 3000),
(27, 'Doom Eternal', 5, 0, 1500),
(28, 'Doom Eternal', 1, 0, 300),
(30, 'Doom Eternal', 100, 0, 30000),
(35, 'IPhone 13 Pro', 5, 0, 4250),
(35, 'IPhone 13 Pro', 5, 0, 4250),
(35, 'IPhone 13 Pro', 5, 0, 4250),
(36, 'IPhone 13 Pro', 5, 0, 4250),
(36, 'IPhone 13 Pro', 5, 0, 4250),
(37, 'IPhone 13 Pro', 1, 0, 850),
(38, 'IPhone 13 Pro', 14, 0, 11900),
(39, 'IPhone 13 Pro', 10, 0, 8500),
(40, 'IPhone 13 Pro', 10, 0, 8500),
(41, 'IPhone 13 Pro', 5, 0, 4250),
(41, 'IPhone 13 Pro', 5, 0, 4250),
(41, 'IPhone 13 Pro', 5, 0, 4250),
(42, 'IPhone 13 Pro', 15, 0, 12750),
(43, 'IPhone 13 Pro', 10, 0, 8500),
(44, 'GTA 5', 4, 0, 100),
(44, 'GTA Trilogy PS4', 1, 0, 40),
(45, 'GTA Trilogy PS4', 1, 0, 40),
(46, 'GTA Trilogy PS4', 1, 0, 40),
(47, 'GTA Trilogy PS4', 1, 0, 40),
(48, 'GTA Trilogy PS4', 2, 0, 80),
(49, 'GTA Trilogy PS4', 1, 0, 40),
(50, 'GTA Trilogy PS4', 1, 0, 40),
(51, 'GTA Trilogy PS4', 1, 0, 30),
(52, 'GTA Trilogy PS4', 1, 35, 30),
(53, 'GTA Trilogy PS4', 1, 35, 30),
(54, 'GTA Trilogy PS4', 1, 35, 40);

-- --------------------------------------------------------

--
-- Table structure for table `slideshow_slides`
--

CREATE TABLE `slideshow_slides` (
  `slide1_image` varchar(100) NOT NULL,
  `slide1_text` varchar(50) NOT NULL,
  `slide2_image` varchar(100) NOT NULL,
  `slide2_text` varchar(50) NOT NULL,
  `slide3_image` varchar(100) NOT NULL,
  `slide3_text` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `slideshow_slides`
--

INSERT INTO `slideshow_slides` (`slide1_image`, `slide1_text`, `slide2_image`, `slide2_text`, `slide3_image`, `slide3_text`) VALUES
('Newbie Gamers-logos.jpeg', 'Welcome to Newbies Gamers', 'image2.jpg', 'Get your best offers here in Newbies Gamers', 'image2.jpg', 'Repair your valuable items at our shop');

-- --------------------------------------------------------

--
-- Table structure for table `store_sales`
--

CREATE TABLE `store_sales` (
  `store_sales_id` int NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_products` int NOT NULL,
  `total_quantity` int NOT NULL,
  `total_cost` int NOT NULL,
  `total_price` int NOT NULL,
  `loyalty_discount_percentage` int NOT NULL,
  `total_price_after_discount` int NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `store_sales`
--

INSERT INTO `store_sales` (`store_sales_id`, `customer_name`, `username`, `email`, `total_products`, `total_quantity`, `total_cost`, `total_price`, `loyalty_discount_percentage`, `total_price_after_discount`, `date`) VALUES
(0, 'Mohamad Nabaa', 'MNabaa111', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(1, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(2, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(3, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(4, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(5, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(6, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(7, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(8, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(9, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(10, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(11, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(12, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(12, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, ''),
(13, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 2, 15, 0, 1250, 0, 0, ''),
(14, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 2, 15, 0, 1250, 0, 0, ''),
(15, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 2, 15, 0, 1250, 0, 0, ''),
(16, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 2, 15, 0, 1250, 0, 0, ''),
(17, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 0, 1500, 0, 0, '2022-10-11 01:33:15'),
(18, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 0, 1500, 0, 0, '2022-10-11 01:33:34'),
(19, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 0, 1500, 0, 0, '2022-10-11 01:33:44'),
(20, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 0, 500, 0, 0, '2022-10-11 01:34:18'),
(21, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 0, 500, 0, 0, '2022-10-11 01:34:37'),
(22, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 0, 460, 0, 0, '2022-10-11 01:39:08'),
(23, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 0, 1500, 0, 0, '2022-10-15 04:28:48'),
(24, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 0, 1500, 0, 0, '2022-10-15 04:32:55'),
(25, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 0, 3000, 0, 0, '2022-10-15 04:58:50'),
(26, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 0, 3000, 0, 0, '2022-10-15 05:02:30'),
(27, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 0, 1500, 0, 0, '2022-10-15 05:03:28'),
(28, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 0, 300, 0, 0, '2022-10-15 05:05:34'),
(29, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, '2022-10-29 11:38:39'),
(30, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, '2022-10-29 11:41:09'),
(31, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, '2022-10-29 11:42:08'),
(32, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, '2022-10-29 11:44:09'),
(33, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, '2022-10-29 11:45:37'),
(34, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, 0, 0, 0, '2022-10-29 11:51:01'),
(35, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 5, 5, 0, 4250, 0, 0, '2022-11-11 09:45:04'),
(36, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 5, 5, 0, 4250, 0, 0, '2022-11-12 12:54:58'),
(37, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 0, 850, 0, 0, '2022-11-12 01:00:13'),
(38, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 14, 14, 0, 11900, 0, 0, '2022-11-12 01:07:31'),
(39, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 10, 10, 0, 8500, 0, 0, '2022-11-12 01:11:54'),
(40, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 10, 10, 0, 8500, 0, 0, '2022-11-12 01:26:23'),
(41, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 5, 5, 0, 4250, 0, 0, '2022-11-12 01:48:38'),
(42, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 15, 15, 0, 12750, 0, 0, '2022-11-12 01:53:31'),
(43, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 10, 10, 0, 8500, 0, 0, '2022-11-12 01:57:40'),
(44, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 0, 40, 10, -360, '2022-12-08 12:05:53'),
(45, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 0, 40, 10, -360, '2022-12-08 12:07:00'),
(46, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 0, 40, 10, -360, '2022-12-08 12:09:23'),
(47, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 0, 40, 10, 36, '2022-12-08 12:13:15'),
(48, 'jad hammoud', 'jad', 'jad.hammoud01@lau.edu', 2, 2, 0, 80, 0, 80, '2022-12-08 12:18:19'),
(49, 'jad hammoud', 'jad', 'jad.hammoud01@lau.edu', 1, 1, 0, 40, 10, 36, '2022-12-08 12:18:46'),
(50, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 0, 40, 10, 36, '2022-12-08 12:28:30'),
(51, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 0, 30, 10, 27, '2022-12-08 12:39:37'),
(52, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 35, 30, 10, 27, '2022-12-12 01:40:25'),
(53, 'jad hammoud', 'jad', 'jad.hammoud01@lau.edu', 1, 1, 35, 30, 0, 30, '2022-12-12 01:51:22'),
(54, 'jad', 'jad', 'jad.hammoud01@lau.edu', 1, 1, 35, 40, 10, 36, '2022-12-17 07:49:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`repair_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `repair_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
