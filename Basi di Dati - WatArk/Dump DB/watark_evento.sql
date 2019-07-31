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
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `evento` (
  `Codice` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` varchar(500) NOT NULL DEFAULT 'Non è disponibile una descrizione per questo evento ',
  PRIMARY KEY (`Codice`),
  UNIQUE KEY `Nome_UNIQUE` (`Nome`),
  KEY `Evento_IDX` (`Codice`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (1,'Foche estreme','Spettacolo dove tre foche sorelle, bizzarre ed incredibili, tentano di tutto per prendere il pesce dal loro amico Michele'),(2,'Orche giocattrici','Avete mai visto un\'orca giocare con una moto d\'acqua? Qui lo vedrete!'),(3,'Il mistero dei pirati maledetti','Film per i più piccoli, in cui il pirata Jack Shark tenta di salvare la principessa Marina'),(4,'Spettacoli d\'acqua','Fantastici eventi di spruzzi d\'acqua e colonne altissime di acqua'),(5,'Delfin & Delfina','Cosa accomuna i due delfini Delfin e Delfina? A voi il compito di scoprirlo!'),(6,'I pirati del Pacifico','Attenzione! I pirati sono tornati! E vogliono rubare il tuo tesoro!'),(7,'Megalodon','Un\'interessante mostra sulle origini e la caduta del Megalodon e dei suoi discendenti'),(8,'Storia delle creature marine','Scopri la storia della vita sulla terra e di come si sono evolute le forme marine'),(9,'Slittinis','Mr. Slittinis è tornato! E sarà più incredibile che mai...'),(10,'Crazy Waterman','L\'uomo pesce vi aspetta! Vi insegnerà a parlare con i pesci e a cavalcare le anguille!'),(11,'The Water Boyz','Due beffardi fratelli tentano di spaventarvi e bagnarvi tutti con le loro moto d\'acqua'),(12,'Il pinguino: un magnifico animale','Incredibile documentario sul pinguino, l\'animale più bello e sottovalutato del mondo!'),(13,'Pallanuoto e divertimento','Una incredibile partita di pallanuoto tra WaterLions e Sealmen'),(14,'Stranger Fish','Conosci tutti i pesci più strani del mondo? Scoprilo ora!'),(15,'Fishermen','Luomo che cammina sull\'acqua è tornato!'),(16,'Il mistero dei sommozzatori','Vieni a scoprire cosa si nasconde dietro al mistero dei sommozzatori di Venezia!');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
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
