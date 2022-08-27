-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2022 at 01:09 PM
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
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `appointment_name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `hour` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `customer_id`, `appointment_name`, `date`, `hour`, `status`) VALUES
(4, 4, 'Repair Laptop', '2022-07-25', '8:00-9:30 AM', 'Pending'),
(5, 4, 'Repair Laptop', '2022-07-26', '8:00-9:30 AM', 'Pending'),
(6, 4, 'Repair Laptop', '2022-07-26', '8:00-9:30 AM', 'Pending'),
(7, 4, 'Repair Laptop', '2022-07-26', '8:00-9:30 AM', 'Pending'),
(8, 4, 'Repair Laptop', '2022-07-26', '8:00-9:30 AM', 'Pending'),
(9, 1, 'Phone Repair', '2022-07-30', '6:00-7:30 PM', 'Pending');

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

--
-- Dumping data for table `baskets_customer_product`
--

INSERT INTO `baskets_customer_product` (`customer_id`, `product_id`, `quantity`, `price`) VALUES
(4, 1, 3, 150),
(4, 9, 2, 600);

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
  `total_price_including_tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts_customers_products`
--

CREATE TABLE `checkouts_customers_products` (
  `checkout_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 'admin', 'hello i am jad');

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
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `date_of_birth`, `phone_number`, `address`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin@hotmail.com', '2022-08-10', '76666666', 'beirut', 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(2, 'jad', 'hammoud', 'jad.hammoud@gmail.com', '2022-09-06', '76939605', 'beirut', 'jad', '8384caf9895a1f9ab17aa8055b0b5869f3e8eba263aac96585f1ee871dd3d5f0'),
(3, 'mohamad', 'Nabaa', 'mohamad@gmail.com', '2022-08-22', '71123805', 'beirut', 'mhmd', '8f9cebbfdc1a99ce7a4941ad08c34c4f1f08089ceff43b802dab3b951d6cbfd1'),
(4, 'Mohamad', 'Nabaa', 'mohamad.nabaa01@lau.edu', '2022-08-01', '+96171123805', 'Aramoun', 'Mohamad Nabaa', '578835a5afad634f5716badf3d801e8910dec33e73ec5c9e86b8d409f229263d');

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
  `image` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `type`, `category`, `description`, `age`, `image`) VALUES
(1, 'Doom Eternal', 50, 'cds', 'XBOX Cd', 'Hell’s armies have invaded Earth. Become the Slayer in an epic single-player campaign to conquer demons across dimensions and stop the final destruction of humanity. The only thing they fear... is you.', '15+', ''),
(2, 'Gears 5', 46, 'cds', 'XBOX Cd', 'Gears 5 follows the story of Kait Diaz, who is on a journey to find out the origin of the Locust Horde, the main antagonistic faction of the Gears of War series.', '16+', ''),
(3, 'Watch Dogs: Legion', 50, 'cds', 'XBOX Cd', 'Gameplay in the Watch Dogs games focuses on an open world where the player can complete missions to progress an overall story, as well as engage in various side activities.', '12+', ''),
(4, 'Battletoads', 50, 'cds', 'XBOX Cd', 'After being locked up in a fantasy simulator bunker for 26 years, the Battletoads are no longer intergalactic heroes and have fallen into modern day obscurity. Unable to settle down for a quiet, simple life, they set out to once again defeat their old longtime nemesis, The Dark Queen, to regain their lost fame. But when they confront the Queen they find out she had been in a similar predicament as them, having also been trapped and losing her powers. In the end they decide to team up with her to take down an evil alien race called the Topians, who were responsible for trapping all of them and are now the current rulers of the galaxy.', '12+', ''),
(5, 'Iphone x', 350, 'phones', 'Cellphone', 'The iPhone X is a smartphone designed, developed and marketed by Apple Inc. The 11th generation of the iPhone, it was available to pre-order on October 27, 2017, and was released on November 3, 2017. The naming of the iPhone X (skipping the iPhone 9) is to mark the 10th anniversary of the iPhone .The iPhone X used a glass and stainless-steel form factor and \"bezel-less\" design, shrinking the bezels while not having a \"chin\", unlike many Android phones', 'Any', ''),
(6, 'Iphone 11', 500, 'phone', 'Cellphone', 'The iPhone 11 is a smartphone designed, developed, and marketed by Apple Inc. It is the 13th generation of iPhone, succeeding the iPhone XR, and was unveiled on September 10, 2019 alongside the iPhone 11 Pro at the Steve Jobs Theater in Apple Park, Cupertino, by Apple CEO Tim Cook. Preorders began on September 13, 2019, and the phone was officially released on September 20, 2019, one day after the official public release of iOS 13.', 'Any', ''),
(7, 'Galaxy Z Fold2', 990, 'phones', 'Cellphone', 'The Samsung Galaxy Z Fold 2 (stylized as Samsung Galaxy Z Fold2, sold as Samsung Galaxy Fold 2 in certain territories) is an Android-based foldable smartphone developed by Samsung Electronics for its Samsung Galaxy Z series, succeeding the Samsung Galaxy Z Fold. It was announced on 5 August 2020 alongside the Samsung Galaxy Note 20, the Samsung Galaxy Tab S7, the Galaxy Buds Live, and the Galaxy Watch 3. Samsung later revealed pricing and availability details on 1 September.\r\n\r\n', 'Any', ''),
(8, 'Sonic', 46, 'cds', 'PS3 Cd', 'Sonic the Hedgehog CD is a 1993 platform game for the Sega CD developed and published by Sega. The story follows Sonic the Hedgehog as he attempts to save an extraterrestrial body, Little Planet, from Doctor Robotnik. Like other Sonic games, Sonic runs and jumps through several themed levels while collecting rings and defeating robots. Sonic CD is distinguished by its time travel feature, a key aspect to the story and gameplay. By traveling through time, players can access different versions of stages, featuring alternative layouts, music, and graphics.', '9+', ''),
(9, 'PlayStation 3', 300, 'console', 'PS3', 'The PlayStation 3 (PS3) is a home video game console developed by Sony Computer Entertainment. The successor to the PlayStation 2, it is part of the PlayStation brand of consoles. It was first released on November 11, 2006, in Japan, November 17, 2006, in North America, and March 23, 2007, in Europe and Australia. The PlayStation 3 competed primarily against Microsoft\'s Xbox 360 and Nintendo\'s Wii as part of the seventh generation of video game consoles.', 'Any', ''),
(10, 'PlayStation 4', 550, 'console', 'PS4', 'The PlayStation 4 (PS4) is a home video game console developed by Sony Computer Entertainment. Announced as the successor to the PlayStation 3 in February 2013, it was launched on November 15, 2013, in North America, November 29, 2013 in Europe, South America and Australia, and on February 22, 2014 in Japan. A console of the eighth generation, it competes with Microsoft\'s Xbox One and Nintendo\'s Wii U and Switch.', 'Any', '');

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `repair_type` varchar(255) NOT NULL,
  `price_per_hour` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `repair`
--

INSERT INTO `repair` (`repair_type`, `price_per_hour`, `description`, `image`) VALUES
('Repair Laptop', 10, 'Schedule now and bring your ps consoles for repair or maintanence. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
('Laptop Cleaning', 10, 'Schedule now and bring your laptop for a special spa day. We require a total of 10$ for a one\r\nhour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
('CPU Repair including gaming and normal ones', 25, 'Schedule now and bring your CPU for repair or maintanence for your CPU.This offer includes gaming CPU and normal ones. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
('CPU Cleaning including gaming and normal ones', 20, 'Schedule now and bring your CPU for a special spa day for your CPU.This offer includes gaming CPU\r\nand normal ones. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
('Phone Repair', 75, 'Schedule now and bring your Phones for repair or maintanence. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
('PS Repair', 30, 'Schedule now and bring your ps consoles for repair or maintanence. We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL),
('Controller Repair', 15, 'Schedule now and bring your constrolers for repair or maintanence.Thos offer includes controllers for all type of consoles (ps2, ps3, ps4, ps5..). We require a total of 10$ for a one hour work. Don\'t hesitate to contact us for any concerns or information.', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
