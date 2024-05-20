-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2024 at 07:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brainbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(2) NOT NULL,
  `Admin_name` varchar(45) NOT NULL,
  `Admin_email` varchar(45) NOT NULL,
  `Admin_password` varchar(45) NOT NULL,
  `Admin_role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Admin_name`, `Admin_email`, `Admin_password`, `Admin_role`) VALUES
(1, 'shivam Joshi', 'shivam@brainbox.com', 'shivam@brainbox', 1),
(2, 'meet prajapati', 'meet@brainbox.com', 'meet@brainbox', 2),
(3, 'yashraj miyatra', 'yashraj@brainbox.com', 'yashraj@brainbox', 2);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone_number` int(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_txt` text DEFAULT NULL,
  `contact_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `phone_number`, `email`, `contact_txt`, `contact_date`) VALUES
(1, 'shivam joshi', 2147483647, 'shivamjoshi@gmail.com', 'report the bug \"profile page has some gilict\"', '2024-03-01 00:00:00'),
(2, 'Alex jorden', 2147483647, 'alexjorden@gmail.com', 'add new feature like chat group ', '2024-03-01 00:00:00'),
(3, 'Nick john', 2147483647, 'Nick234@gmail.com', 'i have reported some question anre solved till now please check them ', '2024-03-01 00:00:00'),
(4, 'John deo', 2147483647, 'johndeo@gmail.com', 'i have sent resume on your email please check the certifiacate i have and contanct me ', '2024-03-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `coding_lang` varchar(255) DEFAULT NULL,
  `certificates` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `github` varchar(45) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `user_id`, `company_name`, `contact`, `hobby`, `coding_lang`, `certificates`, `description`, `github`, `twitter`) VALUES
(1, 3, 'https://www.techtonions.com/learn/', 'shivamjoshi482@gmail', '[\"cricket,football\"]', '[\"java,python,php\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com/Shivamjoshi12', 'https://twitter.com/?lang=en'),
(2, 1, 'https://www.easysnippet.com/learn/', 'yash@gmail.com', '[\"coding\",\"algorithms\",\"playgames\"]', '[\"php\",\"java\",\"python\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(3, 2, 'https://www.google.com/learn/', 'vaibhav@gmail.com', '[\"cricket\",\"chess\",\"PCB-Design\"]', '[\"VB.net\",\"c++\",\"C#\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(4, 4, 'https://www.whatsapp.com/learn/', 'dhavalpatel@gmail.com', '[\"pubg\",\"online-games\",\"coding\"]', '[\"css\",\"java\",\"reactNativ\"]', '[\"uploads/certificate/OIP 1.jpeg\",\"uploads/certificate/OIP 2.jpeg\",\"uploads/certificate/OIP 3.jpeg\",\"uploads/certificate/OIP 4.jpeg\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(5, 5, 'https://www.snapchat.com/learn/', 'manish@gmail.com', '[\"cryptocoins,\"stockmarket\"\"]', '[\"javascript\",\"databasel\",\"footbal\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(6, 6, 'https://www.pubg.com/learn/', 'vrsuhank@gmail.com', '[\"cryptocoins\",\"stockmarket\"]', '[\"javascript\",\"databasel\",\"footbal\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(7, 7, 'https://www.instagram.com/learn/', 'harsh@gmail.com', '[\"pubg\",\"online-games\",\"coding\"]', '[\"VB.net\",\"c++\",\"C#\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(8, 8, 'https://www.winzo.com/learn/', 'meet@gmail.com', '[\"cricket\",\"chess\",\"PCB-Design\"]', '[\"css\",\"java\",\"reactNativ\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(9, 9, 'https://www.grow.com/learn/', 'deep@gmail.com', '[\"cricket\",\"chess\",\"ui-uxdesign\"]', '[\"java,python,php\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(10, 10, 'https://www.coludflare.com/learn/', 'jugal@gmail.com', '[\"cryptocoins,\"stockmarket\"\"]', '[\"VB.net\",\"c++\",\"C#\"]', '[\"uploads/certificate/c.png\",\"uploads/certificate/c.png\"]', 'Hii i am professional code mainly in back-end develepor', 'https://github.com', 'https://twitter.com/?lang=en'),
(11, 12, NULL, NULL, NULL, NULL, '[\"uploads/certificate/p-1.jpg\",\"uploads/certificate/me.jpg\",\"uploads/certificate/me.jpg\"]', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_txt` text NOT NULL,
  `que_keyword` varchar(255) DEFAULT NULL,
  `que_snapshot_img` varchar(255) DEFAULT NULL,
  `question_date` datetime NOT NULL DEFAULT current_timestamp(),
  `click_count` int(11) DEFAULT 0,
  `like_count` int(11) DEFAULT 0,
  `dislike_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `user_id`, `question_txt`, `que_keyword`, `que_snapshot_img`, `question_date`, `click_count`, `like_count`, `dislike_count`) VALUES
(1, 1, ' The context of climate change, how can innovative technologies and sustainable practices drive the transition to renewable energy sources? Discuss specific technological advancements and their potential impact on environmental sustainability.', '[\"Climate Change\",\"Renewable Energy\",\"Innovation\"]', 'uploads/snapshot/p-1.jpeg', '2024-02-21 00:00:00', 5, -3, 3),
(2, 3, 'Analyze the role of encryption in cybersecurity and its effectiveness in protecting sensitive data from evolving cyber threats. What are the challenges and future prospects associated with enhancing data protection through encryption?', '[\"Cybersecurity\",\"Encryption\",\"Data Protection\"]', NULL, '2024-02-22 00:24:09', 1, -1, 1),
(3, 4, 'With the increasing prevalence of remote work, how will emerging technologies shape the future job market? Explore the impacts of technology on remote collaboration, skill requirements, and the evolving nature of employment.', '[\"Future of Work\",\"Remote Collaboration\",\"Technology\"]', 'uploads/snapshot/net3.png', '2024-02-22 01:53:47', 2, 0, 0),
(4, 2, 'Replace \'your_server_endpoint\' with the actual endpoint URL on your server where you want to send the questionId. Adjust the HTTP method (GET or POST) and request payload accordingly based on your server-side implementation.', '[\"javascript\",\"error solve\",\"error handling\"]', NULL, '2024-02-22 00:24:09', 0, 0, 0),
(5, 10, 'when the thumbUpIcon function is called, it not only stores the question_id in the storedQuestionId variable but also calls the thumbUpAjax function and passes the question_id to it. You can customize the thumbUpAjax function to perform the desired AJAX call or other tasks with the question_id.', '[\"mysql\",\"suggestion\",\"ajax\"]', 'uploads/snapshot/net3.png', '2024-02-22 00:24:09', 0, 0, 0),
(6, 5, 'This PHP script checks if the request method is POST, retrieves the values of questionId and userId from the POST data, and then performs some action (in this case, saving the data to a file and returning a JSON response). You can customize the PHP script based on your specific needs and the actions you want to perform with the received data.', '[\"php\",\"solution\",\"error handling\"]', NULL, '2024-02-21 00:00:00', 0, 0, 0),
(7, 9, '$stmt = $mysqli->prepare(\"SELECT q.question_id, q.user_id, q.question_txt, q.que_keyword, q.question_date, u.username, ql.like_type', '[\"mysql querry\",\"solution\"]', NULL, '2024-02-22 00:24:09', 0, 0, 0),
(8, 6, 'I\'ve incorporated the loop into the HTML code where you output the <span> element with the material-icons class. The style attribute is dynamically set based on the conditions specified in the loop. The resulting HTML will have different styles for the thumbs up icon based on the conditions in the loop.', '[\"material-icons\",\"error\"]', NULL, '2024-02-22 00:24:09', 0, 0, 0),
(9, 8, 'This example checks if the conditions $like_owner_id === $owner_id, $like_question_id === $question_id, and $like_type === 1 are met. If all conditions are true, it sets $style to \'color: blue;\', otherwise, it sets it to \'color: black;\'. You can then use the $style variable in your HTML or CSS to apply the desired styling.', '[\"like logic\",\"ajax logic\"]', NULL, '2024-02-21 00:00:00', 0, 0, 0),
(10, 7, 'In this modified code, a new function checkUserLikeStatus is added to send an AJAX request to a server-side script (check_like_status.php), which checks whether the user has already liked the question. If the user has already liked it, the setSpanColorToBlue function is called to update the UI accordingly. This function is also called when the page loads using the DOMContentLoaded event listener.', '[\"ajax logic\",\"user function\"]', 'uploads/snapshot/net3.png', '2024-02-22 00:24:09', 0, 0, 0),
(11, 4, 'In this modified code, a new function checkUserLikeStatus is added to send an AJAX request to a server-side script (check_like_status.php), which checks whether the user has already liked the question. If the user has already liked it, the setSpanColorToBlue function is called to update the UI accordingly. This function is also called when the page loads using the DOMContentLoaded event listener.', '[\"Ajax\",\"Problem in Ajax\"]', '', '2024-02-22 08:05:43', 0, 0, 0),
(17, 4, 'a able about above across after all almost also am php java', '[\"Java\",\"PHP\"]', '', '2024-02-22 08:13:21', 1, 1, -1),
(18, 4, 'a able about above across after all almost also am php java', '[\"Java\",\"PHP\"]', '', '2024-02-22 08:13:30', 0, 0, 0),
(19, 4, 'a able about above across after all almost also am php java', '[\"Java\",\"PHP\"]', '', '2024-02-22 08:13:31', 1, -1, 1),
(20, 4, 'a able about above across after all almost also am php java', '[\"java \",\"PHP\"]', '', '2024-02-22 08:14:56', 1, -1, 1),
(21, 12, 'With the increasing prevalence of remote work, how will emerging technologies shape the future job market? Explore the impacts of technology on remote collaboration, skill requirements, and the evolving nature of employment.', '[\"remotejob\",\"technology\"]', 'uploads/snapshot/p-1.jpg', '2024-02-22 15:00:38', 0, 0, 0),
(22, 12, 'Analyze the role of encryption in cybersecurity and its effectiveness in protecting sensitive data from evolving cyber threats. What are the challenges and future prospects associated with enhancing data protection through encryption?', '[\"climatechange\",\"cybersecurity\"]', 'uploads/snapshot/p-1.jpg', '2024-02-22 15:00:43', 0, 0, 0),
(23, 13, 'button.ask {     background-color: blue;     color: #fff;     padding: 10px 15px;     border: none;     border-radius: 5px;     cursor: pointer; }  /* Hover effect for the submit button */ button.ask:hover {     background-color: #45a049; }', '[\"picture error\",\"CSS\"]', 'uploads/snapshot/Screenshot 2024-02-23 153255.png', '2024-02-24 09:05:47', 2, -2, 2),
(25, 12, 'This query generates 50 random pairs of user_id and question_id within the specified ranges (1 to 35 for user_id and 1 to 70 for question_id). The ROW_NUMBER() OVER () is used to generate sequential star_id. Adjust the ranges according to your specific requirements. Please note that the RAND() function generates a random float between 0 (inclusive) and 1 (exclusive). The FLOOR(RAND() * x) + 1 expression is used to generate a random integer between 1 and x (inclusive).', '[\"database\",\"database error\"]', 'uploads/snapshot/database design.png', '2024-03-03 11:47:20', 0, 0, 0),
(26, 12, 'With the increasing prevalence of remote work, how will emerging technologies shape the future job market? Explore the impacts of technology on remote collaboration, skill requirements, and the evolving nature of employment.Analyze the role of encryption in cybersecurity and its effectiveness in protecting sensitive data from evolving cyber threats. What are the challenges and future prospects associated with enhancing data protection through encryption?', '[\"climatechange\",\"cybersecurity\"]', '', '2024-03-03 12:02:38', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_likes`
--

CREATE TABLE `question_likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `like_type` tinyint(1) DEFAULT NULL,
  `like_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_likes`
--

INSERT INTO `question_likes` (`like_id`, `user_id`, `question_id`, `like_type`, `like_date`) VALUES
(1, 3, 1, 1, '2024-02-21 06:14:53'),
(2, 3, 2, 0, '2024-02-21 19:01:57'),
(3, 4, 3, 1, '2024-02-21 20:28:15'),
(4, 4, 2, 1, '2024-02-21 21:04:17'),
(5, 4, 1, 0, '2024-02-21 21:56:35'),
(6, 4, 4, 1, '2024-02-21 21:56:40'),
(7, 4, 7, 0, '2024-02-21 21:56:47'),
(8, 4, 20, 1, '2024-02-22 03:24:23'),
(9, 4, 19, 0, '2024-02-22 03:25:27'),
(10, 4, 17, 1, '2024-02-22 03:25:35'),
(11, 4, 11, 1, '2024-02-22 03:25:39'),
(12, 12, 20, 0, '2024-02-22 08:26:39'),
(13, 12, 19, 0, '2024-02-22 08:27:07'),
(14, 13, 23, 1, '2024-02-24 03:39:43'),
(15, 12, 5, 1, '2024-03-03 06:30:14'),
(16, 12, 7, 0, '2024-03-03 06:30:33'),
(17, 12, 25, 1, '2024-03-17 07:42:26'),
(18, 12, 17, 1, '2024-03-17 07:45:58'),
(19, 12, 17, 0, '2024-03-17 07:46:03'),
(20, 12, 3, 1, '2024-03-17 07:46:52'),
(21, 12, 3, 0, '2024-03-17 07:46:54'),
(22, 12, 1, 1, '2024-03-17 07:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `report_txt` varchar(255) DEFAULT NULL,
  `report_status` tinyint(1) DEFAULT NULL,
  `response_id` int(11) DEFAULT NULL,
  `report_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `user_id`, `question_id`, `report_txt`, `report_status`, `response_id`, `report_date`) VALUES
(3, 12, 23, 'image is inappropiate please check the abusive image and resolve the problem as son as posible', 1, NULL, '2024-03-01'),
(4, 11, 3, 'Content is realted to durgs and 18+ age content language resolve this ', 1, NULL, '2024-03-01'),
(5, 6, 5, 'Content is realted to durgs and 18+ age content language resolve this ', 1, NULL, '2024-03-01'),
(6, 6, NULL, 'Content is realted to durgs and 18+ age content language resolve this ', 1, 2, '2024-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `response_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `response_txt` text NOT NULL,
  `response_date` datetime NOT NULL,
  `click_count` int(11) DEFAULT 0,
  `like_count` int(11) DEFAULT 0,
  `dislike_count` int(11) DEFAULT 0,
  `response_img` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`response_id`, `user_id`, `question_id`, `response_txt`, `response_date`, `click_count`, `like_count`, `dislike_count`, `response_img`) VALUES
(1, 1, 3, 'I think both are better in their place like if you talk about jio is better than alivable in rural and most of areas developed and developed areas in India . But I think Airtel offer more high speed internet in urban areas', '2024-02-21 00:00:00', 0, 0, 0, 'uploads/response/p-1.jpg'),
(2, 2, 3, 'I think both are better in their place like if you talk about jio is better than alivable in rural and most of areas developed and developed areas in India . But I think Airtel offer more high speed internet in urban areas', '2024-02-21 00:00:00', 0, 0, 0, NULL),
(3, 4, 10, 'In this modified code, a new function checkUserLikeStatus is added to send an AJAX request to a server-side script (check_like_status.php), which checks whether the user has already liked the question. If the user has already liked it, the setSpanColorToBlue function is called to update the UI accordingly. This function is also called when the page loads using the DOMContentLoaded event listener.', '2024-02-22 08:03:45', 0, 0, 0, NULL),
(4, 12, 3, 'ewfewfewfewfewfewfe', '2024-03-01 12:55:52', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `starred`
--

CREATE TABLE `starred` (
  `starred_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `star_type` tinyint(1) DEFAULT NULL,
  `star_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `starred`
--

INSERT INTO `starred` (`starred_id`, `user_id`, `question_id`, `star_type`, `star_date`) VALUES
(1, 3, 1, 1, '2024-02-21 00:00:00'),
(2, 4, 20, 1, '2024-02-22 08:54:15'),
(3, 4, 10, 1, '2024-02-22 08:55:41'),
(4, 4, 9, 1, '2024-02-22 08:55:46'),
(5, 12, 22, 1, '2024-02-22 15:16:03'),
(6, 13, 22, 1, '2024-02-24 09:09:18'),
(7, 13, 21, 1, '2024-02-24 09:09:20'),
(8, 13, 19, 1, '2024-02-24 09:09:22'),
(9, 13, 17, 1, '2024-02-24 09:09:24'),
(10, 13, 10, 1, '2024-02-24 09:09:26'),
(11, 13, 7, 1, '2024-02-24 09:09:27'),
(12, 13, 5, 1, '2024-02-24 09:09:29'),
(13, 13, 23, 1, '2024-02-25 10:52:06'),
(14, 12, 10, 1, '2024-03-03 11:53:49'),
(15, 12, 7, 1, '2024-03-03 11:53:53'),
(16, 12, 5, 1, '2024-03-03 11:53:55'),
(17, 12, 26, 1, '2024-03-06 15:35:05'),
(18, 12, 25, 1, '2024-03-17 13:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about_you` text DEFAULT NULL,
  `interest` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `about_you`, `interest`, `pic`, `registration_date`) VALUES
(1, 'Yash Soni', 'shivxlcode@gmail.com', '$2y$10$myu5Z10vBii4rXD38m/tee2SncsZe2preDspe0zRDFfbj1z5D17UK', 'teacher', '[\"php\",\"java\",\"python\"]', 'uploads/profile/p-1.jpg', '2024-02-21'),
(2, 'Vaibhav Joshi', 'Vaibhav@gmail.com', '$2y$10$BcexEMbiO1xWF93lgonMeeCRsh5QMyfgn5Vv0JD70ozZzaniVQBMC', 'software tester', '[\"VB.net\",\"c++\",\"C#\"]', 'uploads/profile/p-2.jpg', '2024-02-21'),
(3, 'Shivam Joshi', 'shivamjoshi@gmail.com', '$2y$10$CorJSBk9vQ0yxp9OnQKP6uuhLQkkfKNhthDrYMuewvR/U4UgYTcIq', 'coder', '[\"css\",\"java\",\"reactNativ\"]', 'uploads/profile/p-3.jpeg', '2024-02-21'),
(4, 'Dhaval Patel', 'dhavalpatel@gmail.com', '$2y$10$rT2v4hn0N4zbzDhNAq4j8.s9klO91LVuZYsOQbPUn44HlUIwtDW8W', 'software  Engineer', '[\"javascript\",\"html\",\"python\"]', 'uploads/profile/p-4.jpg', '2024-02-24'),
(5, 'Manish Soni', 'manishsoni@gmail.com', '$2y$10$rT2v4hn0N4zbzDhNAq4j8.s9klO91LVuZYsOQbPUn44HlUIwtDW8W', 'Database Engineer', '[\"javascript\",\"databasel\",\"footbal\"]', 'uploads/profile/p-2.jpg', '2024-02-21'),
(6, 'Vrushank Patel', 'vrushank@gmail.com', '$2y$10$rT2v4hn0N4zbzDhNAq4j8.s9klO91LVuZYsOQbPUn44HlUIwtDW8W', 'Businessmen ', '[\"  Cryptocurrency\",\"businessmen\",\"stockmarket\"]', 'uploads/profile/p-1.jpg', '2024-02-21'),
(7, 'Harsh Soni', 'harsh@gmail.com', '$2y$10$CorJSBk9vQ0yxp9OnQKP6uuhLQkkfKNhthDrYMuewvR/U4UgYTcIq', 'Youtuber', '[\"callofduty\",\"Pubg\",\"onlinegame\"]', 'uploads/profile/p-3.jpeg', '2024-02-21'),
(8, 'Meet  Prajapati', 'meet@gmail.com', '$2y$10$rT2v4hn0N4zbzDhNAq4j8.s9klO91LVuZYsOQbPUn44HlUIwtDW8W', 'Programmer', '[\"javascript\",\"database\",\"mysql\"]', 'uploads/profile/p-4.jpg', '2024-02-21'),
(9, 'Deep Bhagat', 'deep@gmail.com', '$2y$10$rT2v4hn0N4zbzDhNAq4j8.s9klO91LVuZYsOQbPUn44HlUIwtDW8W', 'App Developer', '[\"css\",\"java\",\"reactNativ\"]', 'uploads/profile/p-2.jpg', '2024-02-21'),
(10, 'Jugal Joshi', 'jugal@gmail.com', '$2y$10$rT2v4hn0N4zbzDhNAq4j8.s9klO91LVuZYsOQbPUn44HlUIwtDW8W', 'IOS developer', '[\"javascript\",\"java\",\"swift\"]', 'uploads/profile/p-1.jpg', '2024-02-21'),
(11, 'Manav joshi', 'manav@gmail.com', '$2y$10$HNa2L/ZJPbXCxufzWxROHu6HdrB/vLeA7yWqZMzSJ.O4UL8h7/wXi', NULL, 'Array', 'uploads/profile/p-1.jpg', '2024-02-22'),
(12, 'Yashraj miyatra', 'yashraj@gmail.com', '$2y$10$bOLjaM.Qo.m9tyoqWKCxw.0yf1/b10McTSz0/qq3/e3OP8ua6fzVm', NULL, 'Array', 'uploads/profile/p-1.jpg', '2024-02-22'),
(13, 'Mohit Soni', 'mohit@gmail.com', '$2y$10$9cMbE11VJ14gyUmTPtQ9xuyD3Xh1GC.t/5kzDb2wLTxCgjhsIl8Ke', NULL, 'Array', 'uploads/profile/R.jfif', '2024-02-24'),
(14, 'jaysoni', 'jaysoni@gmail.com', '$2y$10$ouyp4laWAAooGO7uqc.IfexdYuTNJRvSInu1gf7lrv32RXICkMEvq', NULL, 'Array', 'uploads/profile/cmp.png', '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `user_action`
--

CREATE TABLE `user_action` (
  `action_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `que_keyword` varchar(255) DEFAULT NULL,
  `search_keyword` varchar(255) DEFAULT NULL,
  `starred_keyword` varchar(255) DEFAULT NULL,
  `like_keyword` varchar(255) DEFAULT NULL,
  `user_action_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_action`
--

INSERT INTO `user_action` (`action_id`, `user_id`, `que_keyword`, `search_keyword`, `starred_keyword`, `like_keyword`, `user_action_date`) VALUES
(1, 1, '[\"php\",\"java\",\"python\"]', '[\"php\",\"java\",\"python\"]', '[\"php\",\"java\",\"python\"]', '[\"php\",\"java\",\"python\"]', '2024-02-21 00:00:00'),
(2, 3, '[\"picture error \",\"mysql\"]', NULL, NULL, NULL, '2024-02-22 00:00:00'),
(3, 4, '[\"World Wars\"][\"Geography\"][\"Geography\"][\"Geography\"][\"World Wars\"][\"World Wars\"][\"World Wars\"][\"World Wars\"][\"World Wars\"][\"World Wars\"][\"Java\",\"PHP\"][\"Java\",\"PHP\"][\"Java\",\"PHP\"][\"java \",\"PHP\"]', NULL, NULL, NULL, '2024-02-22 00:00:00'),
(4, 12, '[\"Java\"][\"Java\"]', NULL, NULL, NULL, '2024-02-22 00:00:00'),
(5, 13, '[\"picture error\",\"CSS\"]', NULL, NULL, NULL, '2024-02-24 00:00:00'),
(6, 12, '[\"database\"]', NULL, NULL, NULL, '2024-03-02 00:00:00'),
(7, 12, '[\"database\",\"database error\"][\"climatechange\",\"cybersecurity\"]', NULL, NULL, NULL, '2024-03-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wp_e_events`
--

CREATE TABLE `wp_e_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_data` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `user_id` (`user_id`);
ALTER TABLE `question` ADD FULLTEXT KEY `idx_question_txt` (`question_txt`);

--
-- Indexes for table `question_likes`
--
ALTER TABLE `question_likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `response_id` (`response_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `starred`
--
ALTER TABLE `starred`
  ADD PRIMARY KEY (`starred_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_action`
--
ALTER TABLE `user_action`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wp_e_events`
--
ALTER TABLE `wp_e_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at_index` (`created_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `question_likes`
--
ALTER TABLE `question_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `starred`
--
ALTER TABLE `starred`
  MODIFY `starred_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_action`
--
ALTER TABLE `user_action`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wp_e_events`
--
ALTER TABLE `wp_e_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `question_likes`
--
ALTER TABLE `question_likes`
  ADD CONSTRAINT `question_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `question_likes_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `starred`
--
ALTER TABLE `starred`
  ADD CONSTRAINT `starred_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `starred_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `user_action`
--
ALTER TABLE `user_action`
  ADD CONSTRAINT `user_action_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
