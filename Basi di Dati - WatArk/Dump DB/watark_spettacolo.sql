-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: watark
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `spettacolo`
--

DROP TABLE IF EXISTS `spettacolo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `spettacolo` (
  `Evento` int(11) NOT NULL,
  `Data` timestamp NOT NULL,
  `AttrazioneVicina` varchar(50) NOT NULL,
  PRIMARY KEY (`Evento`,`Data`),
  KEY `Spettacolo_Attrazione_FK` (`AttrazioneVicina`),
  KEY `Spettacolo_IDX` (`Evento`),
  CONSTRAINT `Spettacolo_Attrazione_FK` FOREIGN KEY (`AttrazioneVicina`) REFERENCES `attrazione` (`Nome`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Spettacolo_Evento_FK` FOREIGN KEY (`Evento`) REFERENCES `evento` (`Codice`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spettacolo`
--

LOCK TABLES `spettacolo` WRITE;
/*!40000 ALTER TABLE `spettacolo` DISABLE KEYS */;
INSERT INTO `spettacolo` VALUES (3,'2019-07-28 10:30:00','A pranzo con i delfini'),(3,'2019-07-30 10:30:00','A pranzo con i delfini'),(3,'2019-08-01 10:30:00','A pranzo con i delfini'),(4,'2019-07-28 13:30:00','A pranzo con i delfini'),(4,'2019-07-30 13:30:00','A pranzo con i delfini'),(4,'2019-08-01 13:30:00','A pranzo con i delfini'),(9,'2019-07-28 08:00:00','A pranzo con i delfini'),(9,'2019-07-30 08:00:00','A pranzo con i delfini'),(9,'2019-08-01 08:00:00','A pranzo con i delfini'),(11,'2019-07-28 15:30:00','A pranzo con i delfini'),(11,'2019-07-30 15:30:00','A pranzo con i delfini'),(11,'2019-08-01 15:30:00','A pranzo con i delfini'),(14,'2019-07-28 09:30:00','A pranzo con i delfini'),(14,'2019-07-30 09:30:00','A pranzo con i delfini'),(14,'2019-08-01 09:30:00','A pranzo con i delfini'),(15,'2019-07-28 10:00:00','A pranzo con i delfini'),(15,'2019-07-30 10:00:00','A pranzo con i delfini'),(15,'2019-08-01 10:00:00','A pranzo con i delfini'),(2,'2019-07-28 14:30:00','Cinema acquatico'),(2,'2019-07-30 14:30:00','Cinema acquatico'),(2,'2019-08-01 14:30:00','Cinema acquatico'),(5,'2019-07-28 16:00:00','Cinema acquatico'),(5,'2019-07-29 09:30:00','Cinema acquatico'),(5,'2019-07-30 16:00:00','Cinema acquatico'),(5,'2019-08-01 16:00:00','Cinema acquatico'),(10,'2019-07-28 16:00:00','Cinema acquatico'),(10,'2019-07-30 16:00:00','Cinema acquatico'),(10,'2019-08-01 16:00:00','Cinema acquatico'),(6,'2019-07-28 17:00:00','Habitat caraibico'),(6,'2019-07-30 17:00:00','Habitat caraibico'),(6,'2019-08-01 17:00:00','Habitat caraibico'),(12,'2019-07-28 14:00:00','Habitat caraibico'),(12,'2019-07-30 14:00:00','Habitat caraibico'),(12,'2019-08-01 14:00:00','Habitat caraibico'),(16,'2019-07-28 09:00:00','Habitat caraibico'),(16,'2019-07-30 09:00:00','Habitat caraibico'),(16,'2019-08-01 09:00:00','Habitat caraibico'),(1,'2019-07-28 11:00:00','Storia degli oceani'),(1,'2019-07-30 11:00:00','Storia degli oceani'),(1,'2019-08-01 11:00:00','Storia degli oceani'),(7,'2019-07-28 07:30:00','Storia degli oceani'),(7,'2019-07-30 07:30:00','Storia degli oceani'),(7,'2019-08-01 07:30:00','Storia degli oceani'),(8,'2019-07-28 09:30:00','Storia degli oceani'),(8,'2019-07-30 09:30:00','Storia degli oceani'),(8,'2019-08-01 09:30:00','Storia degli oceani'),(13,'2019-07-28 13:00:00','Storia degli oceani'),(13,'2019-07-30 13:00:00','Storia degli oceani'),(13,'2019-08-01 13:00:00','Storia degli oceani');
/*!40000 ALTER TABLE `spettacolo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-29 14:36:06
