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
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `priority` (
  `Cliente` varchar(100) NOT NULL,
  `Attrazione` varchar(50) NOT NULL,
  `Data` date NOT NULL,
  PRIMARY KEY (`Cliente`,`Attrazione`,`Data`),
  KEY `Priority_Attrazione_FK` (`Attrazione`),
  KEY `Priority_IDX` (`Cliente`),
  CONSTRAINT `Priority_Attrazione_FK` FOREIGN KEY (`Attrazione`) REFERENCES `attrazione` (`Nome`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Priority_Cliente_FK` FOREIGN KEY (`Cliente`) REFERENCES `cliente` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priority`
--

LOCK TABLES `priority` WRITE;
/*!40000 ALTER TABLE `priority` DISABLE KEYS */;
INSERT INTO `priority` VALUES ('albatroslibero@hotmail.com','A pranzo con i delfini','2019-06-30'),('dinonacci@gmail.com','A pranzo con i delfini','2019-07-02'),('albatroslibero@hotmail.com','Abborda la nave','2019-06-30'),('angeloanastasia@gmail.com','Barche da scontro','2019-06-30'),('angeloanastasia@gmail.com','Casa dei quiz','2019-06-30'),('dinonacci@gmail.com','Casa dei quiz','2019-07-02'),('albatroslibero@hotmail.com','Cinema acquatico','2019-06-30'),('albatroslibero@hotmail.com','Gioca con i pesci','2019-06-30'),('albatroslibero@hotmail.com','Habitat caraibico','2019-06-30'),('dariocardinali2@gmail.com','Habitat caraibico','2019-06-30'),('expoxitolol@gmail.com','Habitat caraibico','2019-06-30'),('ginoilpollo@hotmail.com','Habitat caraibico','2019-06-30'),('jjones78@libero.it','Habitat caraibico','2019-06-30'),('kevinaceto@gmail.com','Habitat caraibico','2019-06-30'),('linomarzapane@gmail.com','Habitat caraibico','2019-06-30'),('lucaprestigiacomo@gmail.com','Habitat caraibico','2019-06-30'),('negritaderoma@gmail.com','Habitat caraibico','2019-06-30'),('ninomalizia87@libero.it','Habitat caraibico','2019-06-30'),('pattiniellotony@gmail.com','Habitat caraibico','2019-06-30'),('pinolakkader@gmail.com','Habitat caraibico','2019-06-30'),('pintomarcello123@gmail.com','Habitat caraibico','2019-06-30'),('uldericopiano@gmail.com','Habitat caraibico','2019-06-30'),('dinonacci@gmail.com','Habitat degli squali','2019-07-02'),('dinonacci@gmail.com','Habitat degli uccelli marini','2019-06-20'),('angeloanastasia@gmail.com','Habitat dei pinguini','2019-06-30'),('albatroslibero@hotmail.com','I Signori del Mare','2019-06-30'),('angeloanastasia@gmail.com','I Signori del Mare','2019-06-30'),('carmanello@gmail.com','I Signori del Mare','2019-06-30'),('garththedestroyer@gmail.com','I Signori del Mare','2019-06-30'),('giacomotor99@gmail.com','I Signori del Mare','2019-06-30'),('gregoriothegreg@gmail.com','I Signori del Mare','2019-06-30'),('guasconemaledetto@gmail.com','I Signori del Mare','2019-06-29'),('ninadorric@gmail.com','I Signori del Mare','2019-06-29'),('robertomaschio11@gmail.com','I Signori del Mare','2019-06-29'),('vicvance11@gmail.com','I Signori del Mare','2019-06-30'),('dinonacci@gmail.com','Le isole più belle del mondo','2019-07-02'),('dinonacci@gmail.com','Megalodon & Co','2019-07-02'),('annamariasindari@gmail.com','Museo del mare','2019-06-30'),('cristinabifulco@hotmail.com','Museo del mare','2019-06-30'),('dinonacci@gmail.com','Museo del mare','2019-07-02'),('divemontblanc@gmail.com','Museo del mare','2019-06-30'),('ernestotorregrossa@hotmail.com','Museo del mare','2019-06-30'),('gastonelagone@gmail.com','Museo del mare','2019-06-30'),('giusyespo111@libero.it','Museo del mare','2019-06-30'),('gprestg@gmail.com','Museo del mare','2019-06-30'),('mancosumarco@gmail.com','Museo del mare','2019-06-30'),('marinamari@gmail.com','Museo del mare','2019-06-30'),('maryelenamontass@gmail.com','Museo del mare','2019-06-29'),('pionterri@gmail.com','Museo del mare','2019-06-30'),('dinonacci@gmail.com','Salva il mare','2019-07-02'),('angeloanastasia@gmail.com','Tour oceanico','2019-06-30'),('drstranamore@libero.com','Tour oceanico','2019-06-29'),('filippoconlinghippo@gmail.com','Tour oceanico','2019-06-30'),('helbertgonder@hotmail.com','Tour oceanico','2019-06-29'),('leandracard@gmail.com','Tour oceanico','2019-06-29'),('leoemarinacardinali@gmail.com','Tour oceanico','2019-06-30'),('marcellaanastasia22@holibero.it','Tour oceanico','2019-06-30'),('miripartenossia@hotmail.com','Tour oceanico','2019-06-30'),('pinaleccese@gmail.com','Tour oceanico','2019-06-30'),('toniadefonte@gmail.com','Tour oceanico','2019-06-30'),('albatroslibero@hotmail.com','Tronchi in fiume','2019-06-30'),('angeloanastasia@gmail.com','Tronchi in fiume','2019-06-30'),('dinonacci@gmail.com','Trova il tesoro','2019-07-02'),('albatroslibero@hotmail.com','Viaggio nella vasca delle orche','2019-06-30'),('dinonacci@gmail.com','Viaggio nella vasca delle orche','2019-07-02');
/*!40000 ALTER TABLE `priority` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-29 14:36:05
