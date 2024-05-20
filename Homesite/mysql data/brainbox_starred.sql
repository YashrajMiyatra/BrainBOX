-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: brainbox
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `starred`
--

DROP TABLE IF EXISTS `starred`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `starred` (
  `star_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `star_type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`star_id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `starred_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `starred_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `starred`
--

LOCK TABLES `starred` WRITE;
/*!40000 ALTER TABLE `starred` DISABLE KEYS */;
INSERT INTO `starred` VALUES (1,23,16,1),(2,7,25,1),(3,5,45,1),(4,29,6,1),(5,35,46,1),(6,13,56,1),(7,33,20,1),(8,21,4,1),(9,19,34,1),(10,30,53,1),(11,9,68,1),(12,4,43,1),(13,26,55,1),(14,27,27,1),(15,24,12,1),(16,30,53,1),(17,8,58,1),(18,17,61,1),(19,33,6,1),(20,22,55,1),(21,4,7,1),(22,6,42,1),(23,17,43,1),(24,21,10,1),(25,32,10,1),(26,33,20,1),(27,22,14,1),(28,6,14,1),(29,18,61,1),(30,31,51,1),(31,2,3,1),(32,1,3,1),(33,4,29,1),(34,27,35,1),(35,8,42,1),(36,11,53,1),(37,30,69,1),(38,12,51,1),(39,22,68,1),(40,33,54,1),(41,2,64,1),(42,16,33,1),(43,1,45,1),(44,6,61,1),(45,32,58,1),(46,17,59,1),(47,28,32,1),(48,30,66,1),(49,6,64,1),(50,4,52,1),(51,35,69,1),(52,35,68,1),(53,35,55,1),(54,35,36,1),(55,35,23,1),(56,35,19,1);
/*!40000 ALTER TABLE `starred` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-16 14:07:59
