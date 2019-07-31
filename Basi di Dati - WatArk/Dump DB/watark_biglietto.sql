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
-- Table structure for table `biglietto`
--

DROP TABLE IF EXISTS `biglietto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `biglietto` (
  `Data` date NOT NULL,
  `Ora` time NOT NULL,
  `Cliente` varchar(100) NOT NULL,
  `TipoPagamento` int(11) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`Data`,`Ora`,`Cliente`),
  KEY `Biglietto_TipoPagamento_FK` (`TipoPagamento`),
  KEY `Biglietto_IDX` (`Cliente`),
  KEY `Biglietto_Categoria_FK` (`Categoria`),
  CONSTRAINT `Biglietto_Categoria_FK` FOREIGN KEY (`Categoria`) REFERENCES `categoria` (`Nome`) ON UPDATE CASCADE,
  CONSTRAINT `Biglietto_Cliente_FK` FOREIGN KEY (`Cliente`) REFERENCES `cliente` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Biglietto_TipoPagamento_FK` FOREIGN KEY (`TipoPagamento`) REFERENCES `tipopagamento` (`Codice`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biglietto`
--

LOCK TABLES `biglietto` WRITE;
/*!40000 ALTER TABLE `biglietto` DISABLE KEYS */;
INSERT INTO `biglietto` VALUES ('2019-05-14','12:00:00','c.cavallo10@gmail.com',1,'Singolo - Sconto 5 Euro'),('2019-05-14','12:10:00','c.cavallo10@gmail.com',1,'Singolo - Sconto 5 Euro'),('2019-05-17','19:30:00','carmelalugo@gmail.com',4,'Singolo'),('2019-05-17','19:40:00','carmelalugo@gmail.com',4,'Famiglia'),('2019-05-21','15:30:00','gastonelagone@gmail.com',1,'Singolo'),('2019-05-25','19:30:00','pinolakkader@gmail.com',1,'Singolo'),('2019-05-25','19:40:00','pinolakkader@gmail.com',1,'Singolo'),('2019-05-27','11:30:00','marinamari@gmail.com',1,'Singolo'),('2019-05-27','11:40:00','marinamari@gmail.com',1,'Singolo'),('2019-05-27','20:00:00','ernestotorregrossa@hotmail.com',3,'Singolo'),('2019-05-27','20:10:00','ernestotorregrossa@hotmail.com',3,'Famiglia'),('2019-05-28','10:00:00','pintomarcello123@gmail.com',5,'Famiglia'),('2019-05-28','10:10:00','pintomarcello123@gmail.com',5,'Famiglia'),('2019-05-28','14:00:00','albatroslibero@hotmail.com',1,'Singolo'),('2019-05-28','14:10:00','albatroslibero@hotmail.com',1,'Singolo'),('2019-05-28','16:00:00','vicvance11@gmail.com',1,'Singolo'),('2019-05-28','16:10:00','vicvance11@gmail.com',1,'Singolo'),('2019-05-28','18:30:00','angeloanastasia@gmail.com',4,'Singolo'),('2019-05-28','18:30:00','cristinabifulco@hotmail.com',3,'Singolo'),('2019-05-28','18:30:00','giusyespo111@libero.it',2,'Gita scolastica'),('2019-05-28','18:40:00','angeloanastasia@gmail.com',4,'Singolo'),('2019-05-28','18:40:00','cristinabifulco@hotmail.com',3,'Singolo'),('2019-05-28','18:40:00','giusyespo111@libero.it',2,'Gita scolastica'),('2019-05-28','19:00:00','pionterri@gmail.com',1,'Singolo'),('2019-05-28','19:10:00','pionterri@gmail.com',1,'Singolo'),('2019-05-29','20:30:00','guasconemaledetto@gmail.com',4,'Famiglia'),('2019-05-29','20:40:00','guasconemaledetto@gmail.com',4,'Famiglia'),('2019-05-30','11:00:00','dariocardinali2@gmail.com',1,'Singolo'),('2019-05-30','11:10:00','dariocardinali2@gmail.com',1,'Singolo'),('2019-05-30','14:00:00','divemontblanc@gmail.com',5,'Famiglia - Sconto 10 Euro'),('2019-05-30','14:10:00','divemontblanc@gmail.com',5,'Famiglia - Sconto 10 Euro'),('2019-05-30','19:00:00','robertomaschio11@gmail.com',3,'Singolo'),('2019-05-30','19:10:00','robertomaschio11@gmail.com',3,'Singolo'),('2019-06-03','18:30:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-03','18:30:00','pattiniellotony@gmail.com',3,'Singolo'),('2019-06-03','18:40:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-03','18:40:00','pattiniellotony@gmail.com',3,'Singolo'),('2019-06-04','15:30:00','linomarzapane@gmail.com',1,'Singolo'),('2019-06-04','16:00:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-06','20:00:00','ginoilpollo@hotmail.com',1,'Singolo'),('2019-06-06','20:10:00','ginoilpollo@hotmail.com',1,'Singolo'),('2019-06-07','19:00:00','pinaleccese@gmail.com',3,'Singolo'),('2019-06-07','19:10:00','pinaleccese@gmail.com',3,'Singolo'),('2019-06-11','11:30:00','cristinabifulco@hotmail.com',3,'Singolo'),('2019-06-11','12:00:00','marcellaanastasia22@holibero.it',1,'Singolo'),('2019-06-11','12:10:00','marcellaanastasia22@holibero.it',1,'Singolo'),('2019-06-11','13:00:00','pintomarcello123@gmail.com',5,'Famiglia'),('2019-06-11','19:10:00','pionterri@gmail.com',1,'Singolo'),('2019-06-12','11:00:00','maryelenamontass@gmail.com',3,'Singolo'),('2019-06-12','11:10:00','maryelenamontass@gmail.com',3,'Famiglia - Sconto 10 Euro'),('2019-06-12','17:00:00','albatroslibero@hotmail.com',1,'Singolo'),('2019-06-13','11:00:00','giacomotor99@gmail.com',2,'Singolo'),('2019-06-13','13:00:00','carmanello@gmail.com',1,'Singolo - Sconto 5 Euro'),('2019-06-13','13:10:00','carmanello@gmail.com',1,'Singolo - Sconto 5 Euro'),('2019-06-13','16:00:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-13','16:30:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-14','10:00:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-15','17:30:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-16','09:10:00','helbertgonder@hotmail.com',2,'Singolo'),('2019-06-16','09:30:00','helbertgonder@hotmail.com',2,'Singolo'),('2019-06-16','17:30:00','dinonacci@gmail.com',5,'Singolo'),('2019-06-17','11:00:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-17','12:00:00','annamariasindari@gmail.com',2,'Singolo'),('2019-06-18','11:00:00','angeloanastasia@gmail.com',4,'Singolo'),('2019-06-18','11:30:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-18','11:30:00','expoxitolol@gmail.com',1,'Singolo'),('2019-06-18','11:40:00','expoxitolol@gmail.com',1,'Singolo'),('2019-06-18','12:00:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-18','15:30:00','dinonacci@gmail.com',5,'Visita turistica'),('2019-06-18','16:00:00','cristinabifulco@hotmail.com',3,'Singolo'),('2019-06-19','10:00:00','dinonacci@gmail.com',3,'Singolo'),('2019-06-19','12:30:00','cristinabifulco@hotmail.com',2,'Singolo'),('2019-06-19','13:00:00','cristinabifulco@hotmail.com',1,'Singolo'),('2019-06-19','18:30:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-20','15:00:00','cristinabifulco@hotmail.com',5,'Singolo'),('2019-06-20','17:00:00','ninomalizia87@libero.it',1,'Singolo'),('2019-06-20','17:10:00','ninomalizia87@libero.it',1,'Singolo'),('2019-06-20','19:30:00','dinonacci@gmail.com',1,'Singolo'),('2019-06-21','11:30:00','dinonacci@gmail.com',2,'Singolo'),('2019-06-21','17:00:00','filippoconlinghippo@gmail.com',1,'Singolo'),('2019-06-21','17:30:00','vicvance11@gmail.com',1,'Singolo'),('2019-06-22','11:00:00','negritaderoma@gmail.com',4,'Singolo'),('2019-06-22','11:10:00','negritaderoma@gmail.com',4,'Singolo'),('2019-06-22','11:30:00','dinonacci@gmail.com',1,'Famiglia'),('2019-06-23','18:30:00','leandracard@gmail.com',1,'Singolo'),('2019-06-23','20:00:00','stenhardcamille@hotmail.com',5,'Singolo'),('2019-06-23','20:10:00','stenhardcamille@hotmail.com',5,'Singolo'),('2019-06-25','09:30:00','cristinabifulco@hotmail.com',2,'Singolo'),('2019-06-25','13:10:00','ninadorric@gmail.com',1,'Singolo'),('2019-06-25','17:00:00','negritaderoma@gmail.com',4,'Singolo'),('2019-06-25','17:30:00','stenhardcamille@hotmail.com',5,'Singolo'),('2019-06-26','18:00:00','cristinabifulco@hotmail.com',2,'Singolo'),('2019-06-26','19:00:00','cristinabifulco@hotmail.com',1,'Singolo'),('2019-06-27','09:30:00','pinaleccese@gmail.com',3,'Singolo'),('2019-06-27','12:00:00','guasconemaledetto@gmail.com',4,'Famiglia'),('2019-06-27','14:00:00','divemontblanc@gmail.com',5,'Singolo - Sconto 5 Euro'),('2019-06-28','12:00:00','miripartenossia@hotmail.com',4,'Singolo'),('2019-06-28','12:10:00','miripartenossia@hotmail.com',4,'Singolo'),('2019-06-28','18:00:00','dinonacci@gmail.com',1,'Famiglia'),('2019-06-29','12:30:00','gprestg@gmail.com',1,'Singolo'),('2019-06-29','12:40:00','gprestg@gmail.com',1,'Singolo'),('2019-06-29','15:00:00','carmanello@gmail.com',1,'Singolo - Sconto 5 Euro'),('2019-06-29','18:30:00','kevinaceto@gmail.com',1,'Visita turistica'),('2019-06-30','15:30:00','dinonacci@gmail.com',4,'Singolo'),('2019-06-30','17:30:00','cristinabifulco@hotmail.com',1,'Famiglia'),('2019-06-30','18:00:00','toniadefonte@gmail.com',1,'Singolo'),('2019-06-30','19:30:00','dinonacci@gmail.com',4,'Famiglia - Sconto 10 Euro'),('2019-07-01','12:00:00','cristinabifulco@hotmail.com',1,'Famiglia'),('2019-07-02','11:00:00','cristinabifulco@hotmail.com',1,'Singolo'),('2019-07-03','11:00:00','pinoprocopiello@gmail.com',1,'Singolo'),('2019-07-03','11:10:00','pinoprocopiello@gmail.com',1,'Singolo'),('2019-07-04','09:30:00','mancosumarco@gmail.com',2,'Singolo - Sconto 5 Euro'),('2019-07-04','09:40:00','mancosumarco@gmail.com',2,'Singolo - Sconto 5 Euro'),('2019-07-05','13:00:00','mancosumarco@gmail.com',2,'Singolo - Sconto 5 Euro'),('2019-07-06','15:30:00','cristinabifulco@hotmail.com',4,'Singolo'),('2019-07-08','17:00:00','cristinabifulco@hotmail.com',3,'Famiglia'),('2019-07-10','18:00:00','cristinabifulco@hotmail.com',4,'Singolo - Sconto 5 Euro'),('2019-07-11','12:00:00','cristinabifulco@hotmail.com',3,'Singolo'),('2019-07-12','09:30:00','cristinabifulco@hotmail.com',2,'Singolo'),('2019-07-12','18:00:00','ninomalizia87@libero.it',1,'Singolo'),('2019-07-13','11:00:00','cristinabifulco@hotmail.com',1,'Singolo'),('2019-07-13','14:00:00','pinoprocopiello@gmail.com',1,'Singolo'),('2019-07-14','16:30:00','leandracard@gmail.com',1,'Singolo'),('2019-07-14','16:40:00','leandracard@gmail.com',1,'Singolo'),('2019-07-15','15:00:00','drstranamore@libero.com',2,'Singolo'),('2019-07-15','15:10:00','drstranamore@libero.com',2,'Singolo'),('2019-07-17','10:00:00','garththedestroyer@gmail.com',1,'Singolo'),('2019-07-18','13:00:00','helbertgonder@hotmail.com',2,'Singolo'),('2019-07-20','19:00:00','carmelalugo@gmail.com',4,'Famiglia'),('2019-07-22','11:30:00','lucaprestigiacomo@gmail.com',2,'Singolo'),('2019-07-22','11:40:00','lucaprestigiacomo@gmail.com',2,'Singolo'),('2019-07-23','10:00:00','ninadorric@gmail.com',1,'Singolo'),('2019-07-23','10:00:00','pattiniellotony@gmail.com',3,'Singolo'),('2019-07-23','10:10:00','ninadorric@gmail.com',1,'Singolo'),('2019-07-24','12:00:00','gregoriothegreg@gmail.com',1,'Singolo'),('2019-07-24','12:10:00','gregoriothegreg@gmail.com',1,'Singolo'),('2019-07-24','15:00:00','gregoriothegreg@gmail.com',1,'Singolo'),('2019-07-26','13:30:00','uldericopiano@gmail.com',1,'Singolo'),('2019-07-26','13:40:00','uldericopiano@gmail.com',1,'Singolo'),('2019-07-27','17:30:00','jjones78@libero.it',1,'Singolo'),('2019-07-27','17:40:00','jjones78@libero.it',1,'Singolo'),('2019-07-28','16:00:00','marcellaanastasia22@holibero.it',1,'Singolo'),('2019-07-28','19:00:00','leoemarinacardinali@gmail.com',2,'Singolo');
/*!40000 ALTER TABLE `biglietto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-29 14:36:04
