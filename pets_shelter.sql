-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 17, 2025 at 03:08 PM
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
-- Database: `pets_shelter`
--

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `name`, `age`, `type`, `sex`, `breed`, `image`, `description`) VALUES
(16, 'Bella', '3', 'cat', 'Female', 'Siamese', 'uploads/1739472189_Bella.webp', 'Bella is a talkative and social Siamese cat who enjoys following people around the house. She’s affectionate and loves warm spots to nap in.'),
(12, 'Benny', '1', 'rabbit', 'Male', 'Holland Lop', 'uploads/1739471976_Benny.webp', 'Benny is a playful little Holland Lop who loves munching on carrots and hopping around the house. He’s gentle and loves to be petted.'),
(14, 'Coco', '4', 'bird', 'Female', 'African Grey Parrot', 'uploads/1739472076_Coco.webp', 'Coco is a smart African Grey who loves mimicking human speech. She enjoys fresh fruits, and her favorite activity is playing with puzzle toys.'),
(15, 'Max', '2', 'dog', 'Male', 'Border Collie', 'uploads/1739472107_Max.webp', 'Max is a highly intelligent and active Border Collie who excels at agility training. He’s great at learning tricks and loves herding anything that moves!'),
(11, 'Luna', '2', 'cat', 'Female', 'Maine Coon', 'uploads/1739471912_Luna.webp', 'Luna is a fluffy and affectionate Maine Coon who loves cuddles and climbing furniture. She’s very curious and enjoys watching birds from the window.'),
(10, 'Charlie', '3', 'dog', 'Male', 'Golden Retriever', 'uploads/1739471758_Charlie.webp', 'Charlie is an energetic and friendly Golden Retriever who loves playing fetch and splashing in the water. He’s great with kids and enjoys long walks in the park.'),
(17, 'Thumper', '0', 'rabbit', 'Male', 'Netherland Dwarf', 'uploads/1739472237_Thumper.webp', 'Thumper is a tiny, energetic Netherland Dwarf rabbit with a love for digging and exploring. He’s very friendly and enjoys being around people.'),
(18, 'Kiwi', '2', 'bird', 'Female', 'Budgerigar', 'uploads/1739472266_Kiwi.webp', 'Kiwi is a bright and cheerful budgie who loves chirping and flying around the room. She enjoys millet treats and loves to perch on shoulders.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
