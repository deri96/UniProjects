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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cliente` (
  `Email` varchar(100) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(100) NOT NULL,
  `Indirizzo` varchar(200) NOT NULL,
  `DataNascita` date NOT NULL,
  `VIP` date DEFAULT NULL,
  PRIMARY KEY (`Email`),
  KEY `Cliente_IDX` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES ('albatroslibero@hotmail.com','albatrone','Filippo','Uccello','Via Verdi 34, Francavilla Fontana','1965-01-30',NULL),('angeloanastasia@gmail.com','anaang','Angelo','Anastasia','Via Leonida 44, Taranto','1969-12-22',NULL),('annamariasindari@gmail.com','annasindari','Annamaria','Sindari','Via Puglie 189, Taranto','1989-04-30',NULL),('c.cavallo10@gmail.com','alfhaeren','Ciro','Cavallo','Via Dante 83, Taranto','1973-11-10',NULL),('carmanello@gmail.com','manelloxis','Carmelo','Manello','Via Di Palma 134, Taranto','1961-04-23',NULL),('carmelalugo@gmail.com','gnappe','Carmela','Lugo','Via Occhinegro 19, Carosino','1967-11-18',NULL),('cristinabifulco@hotmail.com','cristhebest','Cristina','Bifulco','Via Palermo 40, Taranto','1995-05-15',NULL),('dariocardinali2@gmail.com','cardinello889','Dario','Cardinali','Via Marconi 78, Grottaglie','1997-03-01',NULL),('davidestramaccia@msn.com','stramaccio','Davide','Stramaccia','Via Boccaccio 10, Villa Castelli','1989-03-04',NULL),('dinonacci@gmail.com','12345678','Cataldo','Nacci','Via 25 Settembre 25, Taranto','1986-12-24','2019-06-30'),('divemontblanc@gmail.com','primavere','Marie','LaCorrentine','Rue Avignon 3, Parigi','1965-11-02',NULL),('drstranamore@libero.com','stranamoreconder','Damiano','Orignani','Strada delle camelie 11, Monacizzo','1951-05-02',NULL),('ernestotorregrossa@hotmail.com','grossatorre','Ernesto','Torregrossa','Piazza Castello 4, Taranto','1962-02-04',NULL),('expoxitolol@gmail.com','xpx12345','Paolo','Esposito','Via per Latiano 4, Oria','2000-05-29',NULL),('filippoconlinghippo@gmail.com','fippo','Filippo','Fanelli','Via Dante 18, Taranto','1986-02-18',NULL),('garththedestroyer@gmail.com','garthering','Gareth','Wilkinson','Via Bachelet 107, Taranto','1998-10-17',NULL),('gastonelagone@gmail.com','gaspgast','Gastone','Lagone','Via Roma 7, San Giorgio Jonico','1982-07-07',NULL),('giacomotor99@gmail.com','thornag','Giacomo','Torregrossa','Piazza Castello 4, Taranto','1999-06-28',NULL),('ginoilpollo@hotmail.com','coccode','Luigi','Amadori','Via Amalfi 76 Brindisi','1992-08-09',NULL),('giusyespo111@libero.it','1234','Giuseppina','Esposito','Via per Latiano 6, Oria','1965-12-31',NULL),('gprestg@gmail.com','hcsdj','Lucia','Prestigiacomo','Via Monte Bianco, Aosta','1991-03-12',NULL),('gregoriothegreg@gmail.com','gregdegreg','Gregorio','Mancanelli','Via Roma 9, San Pietro in Bevagna','1984-05-14',NULL),('guasconemaledetto@gmail.com','assurbanipal','Michele','Dell\'Oglio','Via Tienamen, Lucca','1982-07-18',NULL),('helbertgonder@hotmail.com','helbert','Alberto','Gonderini','Via Piscopiello 12, Lama','1992-08-16',NULL),('jjones78@libero.it','81737822','Joe','Jones','Via Washington 35, Pizzo Calabro','1952-06-18',NULL),('kevinaceto@gmail.com','kkostn','Kevin','Aceto','Piazza Barberini 11, Napoli','1971-05-19',NULL),('leandracard@gmail.com','lecard','Leandra','Cardinali','Via Marconi 78, Grottaglie','1995-09-11',NULL),('leoemarinacardinali@gmail.com','leoemarina','Leonardo','Cardinali','Via Marconi 78, Grottaglie','1964-10-22',NULL),('linomarzapane@gmail.com','uomofocaccina','Lino','Marzapane','Via Di Palma 32, Taranto','1986-07-24',NULL),('lucaprestigiacomo@gmail.com','lcprestg','Luca','Prestigiacomo','Contrada delle Piante 76, Foggia','1990-11-07',NULL),('mancosumarco@gmail.com','mancomanco','Marco','Mancosu','Viale Di Vittorio 7, Grottaglie','1978-02-28',NULL),('marcellaanastasia22@holibero.it','anmarncjsdk','Marcella','Anastasia','Via Leonida 44, Taranto','1989-05-11',NULL),('marinamari@gmail.com','marmarmarmar','Marina','Mari','Via per San Giorgio Jonico 67, Taranto','1985-02-11',NULL),('maryelenamontass@gmail.com','maryelena','Maria Elena','Montassori','Via Giulio Cesare 18, Grottaglie','1983-11-29',NULL),('miripartenossia@hotmail.com','cavalloditroia','Miriana','Partenossia','Via Roma 2, Montemesola','1991-07-11',NULL),('mirkodainelli@libero.it','agvz','Mirko','Dainelli','Via Cuba 5, Taranto','1991-04-13',NULL),('negritaderoma@gmail.com','nulfaronde','Francesca','Osuwunde','Via Tuscolana 341, Roma','1982-07-25',NULL),('ninadorric@gmail.com','spakzivas','Nina','Dorric','Contrada delle Piante 76, Foggia','1994-08-30',NULL),('ninomalizia87@libero.it','maliziosetto','Nino','Malizia','Via Lecce 11, Martina Franca','1967-01-18',NULL),('pattiniellotony@gmail.com','pattiniello','Antonio','Pattelli','Via Giulio Cesare 18, Grottaglie','1977-08-03',NULL),('pinaleccese@gmail.com','ackvf','Pina','Leccese','Via Conte di Cavour 76, Carosino','1959-11-27',NULL),('pinolakkader@gmail.com','kkadder','Giuseppe','Laccaderina','Via Rubichi 190, Grottaglie','1984-11-03',NULL),('pinoprocopiello@gmail.com','procos','Giuseppe','Procopiello','Viale Lilla 3, Francavilla Fontana','1961-12-07',NULL),('pintomarcello123@gmail.com','maccello','Marcello','Pinto','Via Volturno 34, Taranto','1970-01-30',NULL),('pionterri@gmail.com','proglevino','Pio','Pinto','Via Volturno 32, Taranto','1972-11-07',NULL),('robertomaschio11@gmail.com','masculo','Roberto','Maschio','Via San Francesco 56, Francavilla Fontana','1990-07-21',NULL),('stenhardcamille@hotmail.com','strudel','Camille','Stenhard','Via 25 Settembre 25, Taranto','1987-10-14',NULL),('toniadefonte@gmail.com','1234','Antonia','De Fonte','Via per Porto Mercantile, Taranto','1978-06-19',NULL),('uldericopiano@gmail.com','udpi','Ulderico','Piano','Viale Buenos Aires 3, Milano','1965-05-15',NULL),('vicvance11@gmail.com','gusmckoa','Vittorio','Vancinieri','Via Sassari 2, Roma','1959-10-24',NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-29 14:36:07
