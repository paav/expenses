-- MySQL dump 10.15  Distrib 10.0.15-MariaDB, for Linux (i686)
--
-- Host: localhost    Database: expenses
-- ------------------------------------------------------
-- Server version	10.0.15-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `contractor`
--

LOCK TABLES `contractor` WRITE;
/*!40000 ALTER TABLE `contractor` DISABLE KEYS */;
INSERT INTO `contractor` VALUES (1,'Медведь-Север',1,'Красноярск','Северное Шоссе 17а',''),(2,'Exist.ru',1,'Красноярск','Шахтеров 18а',''),(3,'Autodoc',1,'Красноярск','Березина 1а',''),(7,'Парагон',2,'Красноярск','Кецховели 45','Очень хорошая мастерская'),(8,'СВАвто',2,'Красноярск','Высотная 2г','Очень плохая мастерская'),(10,'У Михалыча',2,'Красноярск','Металлургов 2а',''),(12,'24driver.ru',2,'','Телевизорный 3',''),(13,'24driver.ru',1,'','Телевизорный 3',''),(14,'Делал сам',2,'',' ',''),(15,'Медведь-Север',2,'Красноярск','ул. Северное Шоссе 19д','Очень дорогая мастерская.');
/*!40000 ALTER TABLE `contractor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contractor_type`
--

LOCK TABLES `contractor_type` WRITE;
/*!40000 ALTER TABLE `contractor_type` DISABLE KEYS */;
INSERT INTO `contractor_type` VALUES (1,'Магазин'),(2,'Мастерская');
/*!40000 ALTER TABLE `contractor_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `expense`
--

LOCK TABLES `expense` WRITE;
/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
INSERT INTO `expense` VALUES (1,'2014-09-12',NULL,NULL,2,1,'',1.00,250.00,1,NULL,3),(2,'2014-09-12',NULL,NULL,13,1,'',4.00,300.00,2,NULL,3),(3,'2014-09-14',105000,302.12,7,2,NULL,NULL,NULL,NULL,2,NULL),(5,'2014-09-12',NULL,NULL,1,1,NULL,1.00,1500.00,5,NULL,NULL),(6,'2014-09-12',105000,0.00,14,2,NULL,NULL,NULL,NULL,5,NULL),(7,'2014-09-12',NULL,NULL,1,1,NULL,4.00,410.00,4,NULL,8),(8,'2014-09-12',105000,0.00,14,2,NULL,NULL,NULL,NULL,4,NULL),(12,'2008-04-28',NULL,NULL,1,1,NULL,4.00,130.00,9,NULL,16),(13,'2014-09-17',NULL,NULL,1,1,NULL,1.00,493.00,10,NULL,16),(14,'2008-04-28',NULL,NULL,1,1,NULL,1.00,30.52,11,NULL,16),(18,'2011-06-24',105000,743.75,15,2,NULL,NULL,NULL,NULL,8,NULL),(19,'2011-06-24',NULL,1173.00,1,1,NULL,2.50,586.50,12,NULL,20),(20,'2011-06-24',105000,318.75,15,2,NULL,NULL,NULL,NULL,9,NULL),(21,'2014-09-18',105000,1168.75,15,2,NULL,NULL,NULL,NULL,10,NULL),(22,'2014-09-18',NULL,NULL,1,1,NULL,1.00,374.25,13,NULL,21),(23,'2015-01-01',105000,4143.75,15,2,'Меняли два спереди.',NULL,NULL,NULL,11,NULL),(24,'2011-07-18',NULL,NULL,1,1,NULL,2.00,2663.90,14,NULL,23),(25,'2015-01-01',105505,1414.00,7,2,'afa',NULL,NULL,NULL,1,NULL),(26,'2015-01-01',105505,1414.00,7,2,'afa',NULL,NULL,NULL,1,NULL),(27,'2015-01-01',10666,11111.00,12,2,'aaaaaaaaaaaaaaa aaaaaaaaaaaaa',NULL,NULL,NULL,3,NULL),(28,'2015-01-01',105505,1234.00,8,2,'bbb',NULL,NULL,NULL,5,NULL),(29,'2015-01-01',101111,224.00,7,2,'bbb',NULL,NULL,NULL,1,NULL),(30,'2015-01-01',NULL,NULL,2,1,NULL,1.00,800.00,3,NULL,33),(31,'2015-01-01',NULL,NULL,3,1,NULL,1.00,3.00,3,NULL,33),(32,'2015-01-01',105505,222.00,7,2,'dfdfd',NULL,NULL,NULL,5,NULL),(33,'2015-01-01',105505,3434.00,8,2,'dfdd',NULL,NULL,NULL,5,NULL),(34,'2015-01-01',1111,3333.00,8,2,'ffff',NULL,NULL,NULL,5,NULL),(35,'2015-01-01',NULL,NULL,2,1,NULL,1.00,1111.00,4,NULL,NULL),(36,'2015-01-01',105505,9999.00,7,2,'zzzzz',NULL,NULL,NULL,2,NULL);
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `expense_type`
--

LOCK TABLES `expense_type` WRITE;
/*!40000 ALTER TABLE `expense_type` DISABLE KEYS */;
INSERT INTO `expense_type` VALUES (1,'Запчасть'),(2,'Работа');
/*!40000 ALTER TABLE `expense_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (1,'Замена тормозной жидкости',''),(2,'Замена моторного масла',''),(3,'Замена антифриза',''),(4,'Замена свечей зажигания',''),(5,'Замена воздушного фильтра',''),(6,'Замена салонного фильтра',''),(7,'Замена моторного масла с промывкой',''),(8,'Развал-схождение',''),(9,'Масло в МКПП замена',''),(10,'Топливная система промывка',''),(11,'Замена подшипника ступицы','');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `part`
--

LOCK TABLES `part` WRITE;
/*!40000 ALTER TABLE `part` DISABLE KEYS */;
INSERT INTO `part` VALUES (1,8,'','Purflux','LS 287','очень хороший фильтр'),(2,2,'Supreme Synthetic 1л','Petro-Canada','MY2030','очень хорошее масло'),(3,3,'','Sakura','CAC-2345','Очень хороший фильтр'),(4,4,'','Denso','3431','Очень хорошая свеча'),(5,3,NULL,'Mitsubishi','7803A004',''),(6,6,'React Performance','Castrol','4008177071676',''),(7,7,'Advanced','Mobil','151154',''),(8,2,'Mobil 1 New Life 0w40','','',''),(9,2,'Mobil 10w40','Mobil','','Промывка'),(10,8,'','Mitsubishi','MR984204',''),(11,9,'Прокладка сливной пробки','Mitsubishi','MD05317',''),(12,9,'Масло трасмиссионное Mobil 75W90 SHC 1л','ExxonMobil','',''),(13,9,'Промывочная жидкость топливной системы Wynns','Wynns','',''),(14,10,'Misubishi',NULL,'','');
/*!40000 ALTER TABLE `part` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `part_type`
--

LOCK TABLES `part_type` WRITE;
/*!40000 ALTER TABLE `part_type` DISABLE KEYS */;
INSERT INTO `part_type` VALUES (1,'Антифриз'),(2,'Масло моторное'),(3,'Фильтр воздушный'),(4,'Свеча зажигания'),(5,'Фильтр салона'),(6,'Жидкость тормозная'),(7,'Жидкость охлаждающая'),(8,'Фильтр маслянный'),(9,'Другое'),(10,'Подшипник ступицы передний');
/*!40000 ALTER TABLE `part_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-10 20:45:11
