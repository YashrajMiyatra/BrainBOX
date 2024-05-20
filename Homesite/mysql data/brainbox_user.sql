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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `about_you` varchar(45) DEFAULT NULL,
  `interest` varchar(45) DEFAULT NULL,
  `pic` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'mohan','shivamjoshi4826@gmail.com','$2y$10$mtHlTSzTnd3o2vpJC6wtc.vJmQbHG.J5Dqah4Dw9gXxqdU2vgHX6a','2023-12-01 00:00:00','software developer','[\"Java\",\"php\",\"c\"]','uploads/profile/p-1.jpg'),(2,'Vruashank','shivamjoshi482@gmail.com','$2y$10$dGgEmx4UBMyTbSKnmIZ7Nu68kFZp9MNSx9FmfWGz6h1GeKhKAXcvq','2023-12-02 00:00:00','Back-end-Developer','[\"Java\",\"coding\"]','uploads/profile/p-2.jpg'),(3,'Harsh','test@gmail.com','$2y$10$H0Xr1jhkRsPixl2p6w10b.5tXgSyUnytenuFdtqBc5aHkrjyi88K.','2023-12-10 00:00:00','Software Developer','[\"php\",\"C++\",\"C#\"]','uploads/profile/p-3.jpeg'),(4,'Mantahan','king@gmail.com','$2y$10$umVfB.TsoPgxESHYw88NNOQD3JJifRNQfFTERH3a5rikx/rP7Zrpm','2023-12-11 00:00:00','Football player','[\"Java\",\"coding\",\"cricket\"]','uploads/profile/p-4.jpg'),(5,'Codesnippet','code@gmail.com','$2y$10$iuAI8Ph0KCiTfdVPrwOYbuXXkj1me6.6zjXVdePoJPFUophoGUSqu','2023-12-14 00:00:00','Software tester','[\"Java\"]','uploads/profile/p-5.png'),(6,'Jay','jay@gmail.com','$2y$10$2fxARsCTt2lFSexlKMNb/.W52u6WrXdoXJPzYDNQJNg6/ZUqXro7.','2023-12-14 00:00:00','Youtuber','[\"Java\",\"php\",\"error\"]','uploads/profile/p-6.jpg'),(7,'Mehul','kying@gmail.com','$2y$10$lg3VdCim2OQEIJ5hi1D4wOKjn.5uyEWHBhlaZplP8rx.35pSBNl7S','2023-12-20 00:00:00','Software developer','[\"Databsae\",\"DSA\",\"coding\"]','uploads/profile/p-7.png'),(8,'Om','f@gmail.com','$2y$10$55hzDE4.m3WhSRtds9vq8e.Xh6F1PSWYyR/XV9WRrdhUIczQ/PgYu','2023-12-21 00:00:00','Software engineer','[\"mysql\"]','uploads/profile/p-8.png'),(9,'Deep','h@gmail.com','$2y$10$tV06prXhV9z225OcGVD.kOXhsi0TghvNW7uGumX4HnkSq3bngE3nW','2023-12-22 00:00:00','Principal','[\"Java\",\"php\"\"]','uploads/profile/p-1.jpg'),(10,'Meet','meet@gmail.com','$2y$10$FEOe4Gnq3y/HoUo7FXUrrezgR87L7bQi5MozuezIFtGace8ahW/RO','2023-12-24 00:00:00','HOD of bca department','[\"Java\",\"php\",\"c\"]','uploads/profile/p-1.jpg'),(11,'Kishan','sf@gmail.com','$2y$10$hMbIS/qWlUAb9dQimhcR0uUTkT0GjDn8HvknMjzf5IXOplIFlqquy','2023-12-25 00:00:00','Frontend developer','[\"mysql\"]','uploads/profile/p-1.jpg'),(12,'Codemaster','codemaster@gmail.com','$2y$10$Avbm6WKOkVUzZoI69sCDoOMiv2kgZ46Hq/ExQUf/ES93FaJ8kgjMC','2023-12-25 00:00:00','React native developer','[\"Java\",\"coding\",\"cricket\"]','uploads/profile/p-2.jpg'),(13,'Shruti','shi@gmail.com','$2y$10$bfAl8dH5FCr3mJmmoEsmluKxhHyz7iAVDa4xsK.5sW.SGsDQsiBcu','2023-12-26 00:00:00','Note Js','[\"Java\",\"coding\",\"cricket\"]','uploads/profile/p-3.jpeg'),(14,'Priya','n@gamil.com','$2y$10$bect4G32ZqTWSp318FsvsOAe/zfSY3cvLb898S/SF97yIicay62nC','2023-12-28 00:00:00','Javascript builder','[\"Java\",\"coding\",\"cricket\"]','uploads/profile/p-4.jpg'),(15,'Manav','Q@gmail.com','$2y$10$WWnxZHHeQnxiYEmpeJ4KZuUzLqHUj9ub3pCBM54PFeVhMzXSZVBE2','2024-01-01 00:00:00','Javascript applications','[\"Databsae\",\"DSA\",\"coding\"]','uploads/profile/p-5.png'),(16,'Dhruv','codeboy@gmail.com','$2y$10$lsdryZv55kzRJ27RuvznweQROlF25lBArit8VHCwAq1ZwGrbTsmjS','2024-01-02 00:00:00','PHP developer','[\"Databsae\",\"DSA\",\"coding\"]','uploads/profile/p-6.jpg'),(17,'Jaimin','yash@gmail.com','$2y$10$ayYfOVJKdVnz7HtdAdZFwuD/mcQTltgeFz.VO5RTaZbA3p.9PtFMO','2024-01-03 00:00:00','Python developer','[\"Databsae\",\"DSA\",\"coding\"]','uploads/profile/p-7.png'),(18,'Jugal','jugal@gmail.com','$2y$10$lAm.kRLSxWLsw6.Am5jv6O3TPc65GdWasK2ypioEpITxLR9cneSQy','2024-01-04 00:00:00','Cricket player','[\"php\",\"C++\",\"C#\"]','uploads/profile/p-8.png'),(19,'Trithraj','meeet@gmail.com','$2y$10$XROIP0rNvM9vEnt8JLGCRusf8ZQ/ewLzp9p3XzzdUUsZ.zj1pkrTW','2024-01-05 00:00:00','Application tester','[\"php\",\"C++\",\"C#\"]','uploads/profile/p-1.jpg'),(20,'Bhushan','bhushan@gmail.com','$2y$10$JZoezBmuPrJXEiIEliiIPefK20KNJX0F6lsHj98iuj/kJzzwcNiYC','2024-01-06 00:00:00','Petroleum business owner','[\"php\",\"C++\",\"C#\"]','uploads/profile/p-1.jpg'),(21,'Prakash','shivamcode@gmail.com','$2y$10$1K623c2.hbbCH9MsA9u11uuASdS58MxFNi6HOsyyhBFZ/lQ6d/wYi','2024-01-07 00:00:00','Teacher','[\"php\",\"C++\",\"C#\"]','uploads/profile/p-1.jpg'),(22,'Elon Musk','x@gmail.com','$2y$10$WElJthFf2Q.Ur.P5QKottOoriFSJTBTMKWE3NQTLHdgE4gNiUq.tS','2024-01-08 00:00:00','C developer','[\"mysql\"]','uploads/profile/p-2.jpg'),(23,'Aakash','p@gmail.com','$2y$10$p2fP1vHVGSvV4kXhp53UYeFPreuyYy.daMSg.Mp2rP4aGGNL1IaKm','2024-01-09 00:00:00','C# developer','[\"mysql\"]','uploads/profile/p-3.jpeg'),(24,'Jayesh','j@gmail.com','$2y$10$w05ca8MFxFtzAXb6CTdpeOWwvHDDuDouKg00ErWL9vrAoWGVTl5QW','2024-01-10 00:00:00','PCB developer','[\"mysql\"]','uploads/profile/p-4.jpg'),(25,'Dilip','codehero@gmail.com','$2y$10$HfvM/V7TWRG2xKqFSg.l4O1Kc45eyiv2o1D9lfU6.qsvfsf813vdS','2024-01-11 00:00:00','Python developer','[\"footbal\"]','uploads/profile/p-5.png'),(26,'Hiren','codeher00o@gmail.com','$2y$10$.BHRWu7dyKTDOj1jxzlyj.LaO3VQUXulK2ypgFk15K11bTBgCFwWW','2024-01-12 00:00:00','Flask developer','[\"footbal\"]','uploads/profile/p-6.jpg'),(27,'Hiten','hero@gmail.com','$2y$10$Rdt7rgm0DgRUr86xauJ5o.xCPgdOV3TT7d6HhLyjd7KGPfdIVIDpW','2024-01-13 00:00:00','Api developer','[\"game\"]','uploads/profile/p-7.png'),(28,'Mihir','herocode@gmail.com','$2y$10$Fz0RSV7CK7kgLZhJn3XmGeMyBJ9VyNWHm1wTm2.syAnXzssiGqceC','2024-01-14 00:00:00','API tester','[\"footbal\"]','uploads/profile/p-8.png'),(29,'Bhavin','codevillan@gmail.com','$2y$10$iBrwEssKw1ReMMIe23euUOO.SPbqQsWt0BjsZda7y3VeC7mQaPCsq','2024-01-15 00:00:00','API in Postman','[\"cricket\"]','uploads/profile/p-1.jpg'),(30,'Mahek','vrushank@gmail.com','$2y$10$S.KpXWpLlKYGhCSuxPL2JORS3/UkEH7MjzSb13JZ0wuxwwAi5shfe','2024-01-16 00:00:00','Front end developer','[\"css\"]','uploads/profile/p-1.jpg'),(31,'Rakesh','villan@gmail.cpm','$2y$10$rcg/IKErtBBr8jH7/paKiei8J.lXyCsFLk3nuHm8/4whNcPsyIzq6','2024-01-16 00:00:00','Figma front end','[\"javascritp\"]','uploads/profile/p-1.jpg'),(32,'Rohan','jazz@gmail.com','$2y$10$bSpwoPirNiQ.Qldkhgp3O.zUJx3Eyywl7FtuxfIxV0XfsSrww.MSK','2024-01-17 00:00:00','Template maker','[\"cricket\"]','uploads/profile/p-2.jpg'),(33,'Bhavik','trith@gmai.com','$2y$10$7KM8f4V4O7G4C.tdPdZuBe0vJsA9DvmYlu9ZFaxmc1Y8M171gbcpC','2024-01-18 00:00:00','Designer','[\"nodejs\"]','uploads/profile/p-3.jpeg'),(34,'shivamjoshi','shivxlcode@gmail.com','$2y$10$hFXEH6TRDF4FJ37lmkKIPubxxq1Mxw7q22a/Cz1y3OpAj5X7M7CBC','2024-01-19 00:00:00','Database manager','[\" Reactnative\"]','uploads/profile/p-4.jpg'),(35,'pratyan','pratyanjmodh1205@gmail.com','$2y$10$AnNpRLXonceCUMpRJtI/cujGllaL7.y5RuxtVkh.OTSUre9xsY05i','2024-01-20 00:00:00','manager','Reactnative\"]','uploads/profile/p-5.png');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-16 14:08:00
