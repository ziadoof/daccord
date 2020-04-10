-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: godeal
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CD1DE18A98260155` (`region_id`),
  CONSTRAINT `FK_CD1DE18A98260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=977 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,84,'Ain','AIN'),(2,32,'Aisne','AISNE'),(3,84,'Allier','ALLIER'),(4,93,'Alpes-de-Haute-Provence','ALPES DE HAUTE PROVENCE'),(5,93,'Hautes-Alpes','HAUTES ALPES'),(6,93,'Alpes-Maritimes','ALPES MARITIMES'),(7,84,'Ardèche','ARDECHE'),(8,44,'Ardennes','ARDENNES'),(9,76,'Ariège','ARIEGE'),(10,44,'Aube','AUBE'),(11,76,'Aude','AUDE'),(12,76,'Aveyron','AVEYRON'),(13,93,'Bouches-du-Rhône','BOUCHES DU RHONE'),(14,28,'Calvados','CALVADOS'),(15,84,'Cantal','CANTAL'),(16,75,'Charente','CHARENTE'),(17,75,'Charente-Maritime','CHARENTE MARITIME'),(18,24,'Cher','CHER'),(19,75,'Corrèze','CORREZE'),(21,27,'Côte-d\'Or','COTE D OR'),(22,53,'Côtes-d\'Armor','COTES D ARMOR'),(23,75,'Creuse','CREUSE'),(24,75,'Dordogne','DORDOGNE'),(25,27,'Doubs','DOUBS'),(26,84,'Drôme','DROME'),(27,28,'Eure','EURE'),(28,24,'Eure-et-Loir','EURE ET LOIR'),(29,53,'Finistère','FINISTERE'),(30,76,'Gard','GARD'),(31,76,'Haute-Garonne','HAUTE GARONNE'),(32,76,'Gers','GERS'),(33,75,'Gironde','GIRONDE'),(34,76,'Hérault','HERAULT'),(35,53,'Ille-et-Vilaine','ILLE ET VILAINE'),(36,24,'Indre','INDRE'),(37,24,'Indre-et-Loire','INDRE ET LOIRE'),(38,84,'Isère','ISERE'),(39,27,'Jura','JURA'),(40,75,'Landes','LANDES'),(41,24,'Loir-et-Cher','LOIR ET CHER'),(42,84,'Loire','LOIRE'),(43,84,'Haute-Loire','HAUTE LOIRE'),(44,52,'Loire-Atlantique','LOIRE ATLANTIQUE'),(45,24,'Loiret','LOIRET'),(46,76,'Lot','LOT'),(47,75,'Lot-et-Garonne','LOT ET GARONNE'),(48,76,'Lozère','LOZERE'),(49,52,'Maine-et-Loire','MAINE ET LOIRE'),(50,28,'Manche','MANCHE'),(51,44,'Marne','MARNE'),(52,44,'Haute-Marne','HAUTE MARNE'),(53,52,'Mayenne','MAYENNE'),(54,44,'Meurthe-et-Moselle','MEURTHE ET MOSELLE'),(55,44,'Meuse','MEUSE'),(56,53,'Morbihan','MORBIHAN'),(57,44,'Moselle','MOSELLE'),(58,27,'Nièvre','NIEVRE'),(59,32,'Nord','NORD'),(60,32,'Oise','OISE'),(61,28,'Orne','ORNE'),(62,32,'Pas-de-Calais','PAS DE CALAIS'),(63,84,'Puy-de-Dôme','PUY DE DOME'),(64,75,'Pyrénées-Atlantiques','PYRENEES ATLANTIQUES'),(65,76,'Hautes-Pyrénées','HAUTES PYRENEES'),(66,76,'Pyrénées-Orientales','PYRENEES ORIENTALES'),(67,44,'Bas-Rhin','BAS RHIN'),(68,44,'Haut-Rhin','HAUT RHIN'),(69,84,'Rhône','RHONE'),(70,27,'Haute-Saône','HAUTE SAONE'),(71,27,'Saône-et-Loire','SAONE ET LOIRE'),(72,52,'Sarthe','SARTHE'),(73,84,'Savoie','SAVOIE'),(74,84,'Haute-Savoie','HAUTE SAVOIE'),(75,11,'Paris','PARIS'),(76,28,'Seine-Maritime','SEINE MARITIME'),(77,11,'Seine-et-Marne','SEINE ET MARNE'),(78,11,'Yvelines','YVELINES'),(79,75,'Deux-Sèvres','DEUX SEVRES'),(80,32,'Somme','SOMME'),(81,76,'Tarn','TARN'),(82,76,'Tarn-et-Garonne','TARN ET GARONNE'),(83,93,'Var','VAR'),(84,93,'Vaucluse','VAUCLUSE'),(85,52,'Vendée','VENDEE'),(86,75,'Vienne','VIENNE'),(87,75,'Haute-Vienne','HAUTE VIENNE'),(88,44,'Vosges','VOSGES'),(89,27,'Yonne','YONNE'),(90,27,'Territoire de Belfort','TERRITOIRE DE BELFORT'),(91,11,'Essonne','ESSONNE'),(92,11,'Hauts-de-Seine','HAUTS DE SEINE'),(93,11,'Seine-Saint-Denis','SEINE SAINT DENIS'),(94,11,'Val-de-Marne','VAL DE MARNE'),(95,11,'Val-d\'Oise','VAL D OISE'),(100,94,'Corse-du-Sud','CORSE DU SUD'),(101,94,'Haute-Corse','HAUTE CORSE'),(971,1,'Guadeloupe','GUADELOUPE'),(972,2,'Martinique','MARTINIQUE'),(973,3,'Guyane','GUYANE'),(974,4,'La Réunion','LA REUNION'),(976,6,'Mayotte','MAYOTTE');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-11  0:14:16
