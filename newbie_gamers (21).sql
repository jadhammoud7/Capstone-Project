-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2022 at 04:19 PM
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
  `price_per_hour` int NOT NULL,
  `date` date NOT NULL,
  `hour` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `customer_id`, `appointment_name`, `price_per_hour`, `date`, `hour`, `status`) VALUES
(7, 4, 'Repair Laptop', 0, '2022-07-26', '8:00-9:30 AM', 'Done Work'),
(8, 4, 'Repair Laptop', 0, '2022-07-26', '8:00-9:30 AM', 'Done Work'),
(10, 4, 'Repair Laptop', 0, '2022-07-28', '8:00-9:30 AM', 'Pending'),
(11, 4, 'Repair Laptop', 0, '2022-07-28', '8:00-9:30 AM', 'Pending'),
(12, 4, 'Repair Laptop', 0, '2022-07-28', '10:00-11:30 AM', 'Pending'),
(13, 4, 'Repair Laptop', 0, '2022-07-28', '12:00-1:30 PM', 'Pending'),
(14, 4, 'Repair Laptop', 0, '2022-07-28', '2:00-3:30 PM', 'Pending'),
(15, 4, 'Repair Laptop', 0, '2022-07-28', '2:00-3:30 PM', 'Pending'),
(16, 4, 'Repair Laptop', 0, '2022-07-28', '4:00-5:30 PM', 'Pending'),
(17, 4, 'Repair Laptop', 0, '2022-07-30', '8:00-9:30 AM', 'Pending'),
(20, 4, 'Repair Laptop', 0, '2022-08-30', '8:00-9:30 AM', 'Pending'),
(21, 4, 'Repair Laptop', 0, '2022-08-30', '8:00-9:30 AM', 'Pending'),
(22, 4, 'Repair Laptop', 0, '2022-08-30', '8:00-9:30 AM', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `baskets_customer_product`
--

CREATE TABLE `baskets_customer_product` (
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `total_price` double NOT NULL,
  `tax_price` double NOT NULL,
  `total_price_including_tax` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`checkout_id`, `customer_id`, `first_name`, `last_name`, `email`, `phone_number`, `shipping_country`, `shipping_location`, `shipping_company`, `postcode`, `order_notes`, `total_price`, `tax_price`, `total_price_including_tax`, `status`, `date`) VALUES
(4, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 300, 30, 330, 'Done Work', '2022-08-28'),
(5, 4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '96171123805', 'Lebanon', 'Aramoun, Lebanon', 'LAU', '1548', 'none', 46, 4.6000000000000005, 50.6, 'Pending', '2022-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts_customers_products`
--

CREATE TABLE `checkouts_customers_products` (
  `checkout_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkouts_customers_products`
--

INSERT INTO `checkouts_customers_products` (`checkout_id`, `product_id`, `quantity`, `total_price`) VALUES
(4, 1, 4, 300),
(5, 2, 1, 46);

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
(1, 'admin', 'i am admin'),
(1, 'admin', 'hello i am jad'),
(4, 'Mohamad Nabaa', 'love it');

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
  `password` varchar(225) NOT NULL,
  `loyalty_points` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `date_of_birth`, `phone_number`, `address`, `city`, `username`, `password`, `loyalty_points`) VALUES
(2, 'jad', 'hammoud', 'jad.hammoud@gmail.com', '2022-09-06', '76939605', 'beirut ras el nabeh', 'aaramun', 'jad', '8384caf9895a1f9ab17aa8055b0b5869f3e8eba263aac96585f1ee871dd3d5f0', 0),
(3, 'mohamad', 'Nabaa', 'mohamad@gmail.com', '2022-08-22', '71123805', 'beirut next to fakhani second floor', 'bshamoun', 'mhmd', '8f9cebbfdc1a99ce7a4941ad08c34c4f1f08089ceff43b802dab3b951d6cbfd1', 0),
(4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '2022-08-01', '+96171123805', 'Aramoun next to chamsine third floor', 'aaramun', 'Mohamad Nabaa', '578835a5afad634f5716badf3d801e8910dec33e73ec5c9e86b8d409f229263d', 91),
(16, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '2001-07-18', '96171123805', 'Aramoun next to chamsine third floor', 'beirut', 'Mohamad Nabaa', '578835a5afad634f5716badf3d801e8910dec33e73ec5c9e86b8d409f229263d', 0),
(17, 'Omar ', 'Atieh', 'omar4Atieh@hotmail.com', '2022-09-21', '878887878788', 'Bshamoun , al wadi street Al nader building block B second floor', 'bshamoun', 'omar1234567', '75523907535270f2f12668aea07b507433e81ed0e625b9455bdb8554855687e0', 0),
(21, 'Ahmad', 'Serhan', 'ahmadserhan@gmail.com', '2022-08-30', '45657888878', 'Bshamoun , al wadi street Al nader building block B second floor', 'beirut', 'ahmad1231234', '68a8b4c8464fa9bc797ce97b47bff6807ba10d8ddb061fce39b28842389888fa', 0);

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
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history_product_inventory`
--

CREATE TABLE `history_product_inventory` (
  `product_id` int NOT NULL,
  `inventory` int NOT NULL,
  `inventory_change` varchar(5) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history_product_inventory`
--

INSERT INTO `history_product_inventory` (`product_id`, `inventory`, `inventory_change`, `modified_by`, `modified_on`) VALUES
(1, 98, '', '', ''),
(19, 5, '0', 'Mohamad Nabaa', '2022-10-15 01:39:22'),
(19, 5, '0', 'Mohamad Nabaa', '2022-10-15 01:47:26'),
(20, 5, '0', 'Mohamad Nabaa', '2022-10-15 01:53:23'),
(20, 10, '+ 5', 'Mohamad Nabaa', '2022-10-15 01:57:55'),
(20, 10, '+ 5', 'Mohamad Nabaa', '2022-10-15 02:03:18'),
(20, 10, '+ 5', 'Mohamad Nabaa', '2022-10-15 02:08:08'),
(1, 86, '- 10', 'Store Sales', '2022-10-15 05:02:30'),
(1, 81, '- 5', 'Store Sales', '2022-10-15 05:03:27'),
(1, 80, '- 1', 'Store Sales', '2022-10-15 05:05:34');

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
(20, 30, '0', 'Mohamad Nabaa', '2022-10-15 01:53:23'),
(20, 25, '- 5', 'Mohamad Nabaa', '2022-10-15 01:57:55'),
(20, 25, '- 5', 'Mohamad Nabaa', '2022-10-15 02:03:18'),
(20, 25, '- 5', 'Mohamad Nabaa', '2022-10-15 02:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `history_product_sales`
--

CREATE TABLE `history_product_sales` (
  `product_id` int NOT NULL,
  `sales_number` int NOT NULL,
  `sales_change` varchar(5) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history_product_sales`
--

INSERT INTO `history_product_sales` (`product_id`, `sales_number`, `sales_change`, `modified_by`, `modified_on`) VALUES
(1, 5, '', '', '2022-10-11'),
(19, 0, '0', 'Mohamad Nabaa', '2022-10-15 01:39:22'),
(19, -3, '0', 'Mohamad Nabaa', '2022-10-15 01:47:26'),
(20, 0, '0', 'Mohamad Nabaa', '2022-10-15 01:53:23'),
(1, 1, '+ 10', 'Store Sales', '2022-10-15 05:02:30'),
(1, 5, '+ 5', 'Store Sales', '2022-10-15 05:03:27'),
(1, 1, '+ 1', 'Store Sales', '2022-10-15 05:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` varchar(225) NOT NULL,
  `price` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(225) NOT NULL,
  `inventory` int NOT NULL,
  `sales_number` int NOT NULL,
  `last_modified_by` varchar(50) NOT NULL,
  `last_modified_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `type`, `category`, `description`, `age`, `image`, `inventory`, `sales_number`, `last_modified_by`, `last_modified_on`) VALUES
(1, 'Doom Eternal', 300, 'cds', 'XBOX Cd', 'Hell’s armies have invaded Earth. Become the Slayer in an epic single-player campaign to conquer demons across dimensions and stop the final destruction of humanity. The only thing they fear... is you.', '15+', '', 80, 5, 'Store Sales', '2022-10-15 05:05:34'),
(2, 'Gears 5', 46, 'cds', 'XBOX Cd', 'Gears 5 follows the story of Kait Diaz, who is on a journey to find out the origin of the Locust Horde, the main antagonistic faction of the Gears of War series.', '16+', '', 0, 0, '', ''),
(3, 'Watch Dogs: Legion', 50, 'cds', 'XBOX Cd', 'Gameplay in the Watch Dogs games focuses on an open world where the player can complete missions to progress an overall story, as well as engage in various side activities.', '12+', '', 0, 0, '', ''),
(4, 'Battletoads', 50, 'cds', 'XBOX Cd', 'After being locked up in a fantasy simulator bunker for 26 years, the Battletoads are no longer intergalactic heroes and have fallen into modern day obscurity. Unable to settle down for a quiet, simple life, they set out to once again defeat their old longtime nemesis, The Dark Queen, to regain their lost fame. But when they confront the Queen they find out she had been in a similar predicament as them, having also been trapped and losing her powers. In the end they decide to team up with her to take down an evil alien race called the Topians, who were responsible for trapping all of them and are now the current rulers of the galaxy.', '12+', '', 0, 0, '', ''),
(5, 'Iphone x', 350, 'phones', 'Cellphone', 'The iPhone X is a smartphone designed, developed and marketed by Apple Inc. The 11th generation of the iPhone, it was available to pre-order on October 27, 2017, and was released on November 3, 2017. The naming of the iPhone X (skipping the iPhone 9) is to mark the 10th anniversary of the iPhone .The iPhone X used a glass and stainless-steel form factor and \"bezel-less\" design, shrinking the bezels while not having a \"chin\", unlike many Android phones', 'Any', '', 0, 0, '', ''),
(6, 'Iphone 11', 500, 'phone', 'Cellphone', 'The iPhone 11 is a smartphone designed, developed, and marketed by Apple Inc. It is the 13th generation of iPhone, succeeding the iPhone XR, and was unveiled on September 10, 2019 alongside the iPhone 11 Pro at the Steve Jobs Theater in Apple Park, Cupertino, by Apple CEO Tim Cook. Preorders began on September 13, 2019, and the phone was officially released on September 20, 2019, one day after the official public release of iOS 13.', 'Any', '', 0, 0, '', ''),
(7, 'Galaxy Z Fold2', 990, 'phones', 'Cellphone', 'The Samsung Galaxy Z Fold 2 (stylized as Samsung Galaxy Z Fold2, sold as Samsung Galaxy Fold 2 in certain territories) is an Android-based foldable smartphone developed by Samsung Electronics for its Samsung Galaxy Z series, succeeding the Samsung Galaxy Z Fold. It was announced on 5 August 2020 alongside the Samsung Galaxy Note 20, the Samsung Galaxy Tab S7, the Galaxy Buds Live, and the Galaxy Watch 3. Samsung later revealed pricing and availability details on 1 September.\r\n\r\n', 'Any', '', 0, 0, '', ''),
(8, 'Sonic', 46, 'cds', 'PS3 Cd', 'Sonic the Hedgehog CD is a 1993 platform game for the Sega CD developed and published by Sega. The story follows Sonic the Hedgehog as he attempts to save an extraterrestrial body, Little Planet, from Doctor Robotnik. Like other Sonic games, Sonic runs and jumps through several themed levels while collecting rings and defeating robots. Sonic CD is distinguished by its time travel feature, a key aspect to the story and gameplay. By traveling through time, players can access different versions of stages, featuring alternative layouts, music, and graphics.', '9+', '', 0, 0, '', ''),
(9, 'PlayStation 3', 300, 'console', 'PS3', 'The PlayStation 3 (PS3) is a home video game console developed by Sony Computer Entertainment. The successor to the PlayStation 2, it is part of the PlayStation brand of consoles. It was first released on November 11, 2006, in Japan, November 17, 2006, in North America, and March 23, 2007, in Europe and Australia. The PlayStation 3 competed primarily against Microsoft\'s Xbox 360 and Nintendo\'s Wii as part of the seventh generation of video game consoles.', 'Any', '', 0, 0, '', ''),
(10, 'PlayStation 4', 550, 'console', 'PS4', 'The PlayStation 4 (PS4) is a home video game console developed by Sony Computer Entertainment. Announced as the successor to the PlayStation 3 in February 2013, it was launched on November 15, 2013, in North America, November 29, 2013 in Europe, South America and Australia, and on February 22, 2014 in Japan. A console of the eighth generation, it competes with Microsoft\'s Xbox One and Nintendo\'s Wii U and Switch.', 'Any', '', 0, 0, '', ''),
(20, 'GTA 5', 25, 'cds', 'strategy', 'Grand Theft Auto V is a 2013 action-adventure game developed by Rockstar North and published by Rockstar Games. It is the seventh main entry in the Grand Theft Auto series, following 2008\'s Grand Theft Auto IV, and the fifteenth instalment overall', '16+', 'GTA5.jpg', 10, 0, 'Mohamad Nabaa', '2022-10-15 02:08:08');

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
(1, 'laptop cleaning', 25, 'dsdffdfddfsdfsfds', NULL),
(2, 'Laptop Cleaning', 10, 'Schedule now and bring your laptop for a special spa day. We require a total of 10$ for a one\r\nhour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(3, 'CPU Repair including gaming and normal ones', 25, 'Schedule now and bring your CPU for repair or maintanence for your CPU.This offer includes gaming CPU and normal ones. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(4, 'CPU Cleaning including gaming and normal ones', 20, 'Schedule now and bring your CPU for a special spa day for your CPU.This offer includes gaming CPU\r\nand normal ones. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(5, 'Phone Repair', 75, 'Schedule now and bring your Phones for repair or maintanence. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(6, 'PS Repair', 30, 'Schedule now and bring your ps consoles for repair or maintanence. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
(7, 'Controller Repair', 15, 'Schedule now and bring your constrolers for repair or maintanence.Thos offer includes controllers for all type of consoles (ps2, ps3, ps4, ps5..). We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_products`
--

CREATE TABLE `sales_products` (
  `sales_id` int NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales_products`
--

INSERT INTO `sales_products` (`sales_id`, `product_name`, `quantity`, `price`) VALUES
(13, 'Doom Eternal', 10, 1000),
(13, 'Watch Dogs: Legion', 5, 250),
(14, 'Doom Eternal', 10, 1000),
(14, 'Watch Dogs: Legion', 5, 250),
(15, 'Doom Eternal', 10, 1000),
(15, 'Watch Dogs: Legion', 5, 250),
(16, 'Doom Eternal', 10, 1000),
(16, 'Watch Dogs: Legion', 5, 250),
(17, 'Doom Eternal', 5, 1500),
(18, 'Doom Eternal', 5, 1500),
(19, 'Doom Eternal', 5, 1500),
(20, 'Watch Dogs: Legion', 10, 500),
(21, 'Watch Dogs: Legion', 10, 500),
(22, 'Gears 5', 10, 460),
(23, 'Doom Eternal', 5, 1500),
(23, 'Doom Eternal', 5, 1500),
(24, 'Doom Eternal', 5, 1500),
(25, 'Doom Eternal', 10, 3000),
(26, 'Doom Eternal', 10, 3000),
(27, 'Doom Eternal', 5, 1500),
(28, 'Doom Eternal', 1, 300);

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
  `total_price` int NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `store_sales`
--

INSERT INTO `store_sales` (`store_sales_id`, `customer_name`, `username`, `email`, `total_products`, `total_quantity`, `total_price`, `date`) VALUES
(0, 'Mohamad Nabaa', 'MNabaa111', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(1, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(2, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(3, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(4, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(5, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(6, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(7, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(8, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(9, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(10, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(11, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(12, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(12, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 0, 0, 0, ''),
(13, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 2, 15, 1250, ''),
(14, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 2, 15, 1250, ''),
(15, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 2, 15, 1250, ''),
(16, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 2, 15, 1250, ''),
(17, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 1500, '2022-10-11 01:33:15'),
(18, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 1500, '2022-10-11 01:33:34'),
(19, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 1500, '2022-10-11 01:33:44'),
(20, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 500, '2022-10-11 01:34:18'),
(21, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 500, '2022-10-11 01:34:37'),
(22, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 460, '2022-10-11 01:39:08'),
(23, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 1500, '2022-10-15 04:28:48'),
(24, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 1500, '2022-10-15 04:32:55'),
(25, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 3000, '2022-10-15 04:58:50'),
(26, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 10, 3000, '2022-10-15 05:02:30'),
(27, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 5, 1500, '2022-10-15 05:03:28'),
(28, 'Mohamad Nabaa', 'Mohamad Nabaa', 'mnabaa53@gmail.com', 1, 1, 300, '2022-10-15 05:05:34');

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `repair_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;