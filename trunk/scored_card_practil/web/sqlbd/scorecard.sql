-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.36-community-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema practil_scorecard_bd
--

CREATE DATABASE IF NOT EXISTS practil_scorecard_bd;
USE practil_scorecard_bd;

--
-- Definition of table `asignacion_sc`
--

DROP TABLE IF EXISTS `asignacion_sc`;
CREATE TABLE `asignacion_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `tree_id` int(11) NOT NULL,
  `indicador_id` int(11) NOT NULL,
  `flag` text,
  `user_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asignacion_sc_FI_1` (`grupo_id`),
  KEY `asignacion_sc_FI_2` (`tree_id`),
  KEY `asignacion_sc_FI_3` (`indicador_id`),
  KEY `asignacion_sc_FI_4` (`user_id`),
  CONSTRAINT `asignacion_sc_FK_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo_trabajo_sc` (`id`),
  CONSTRAINT `asignacion_sc_FK_2` FOREIGN KEY (`tree_id`) REFERENCES `tree_sc` (`id`),
  CONSTRAINT `asignacion_sc_FK_3` FOREIGN KEY (`indicador_id`) REFERENCES `indicators_sc` (`id`),
  CONSTRAINT `asignacion_sc_FK_4` FOREIGN KEY (`user_id`) REFERENCES `user_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asignacion_sc`
--

/*!40000 ALTER TABLE `asignacion_sc` DISABLE KEYS */;
INSERT INTO `asignacion_sc` (`id`,`grupo_id`,`email`,`tree_id`,`indicador_id`,`flag`,`user_id`,`create_at`,`update_at`) VALUES 
 (55,1,'csar0790@hotmail.com',8,62,'{\"estado\":true,\"owner_id\":1}',3,'2011-12-01 18:05:25','2011-12-01 18:05:25'),
 (56,1,'manuel.rios.alvarez@gmail.com',8,63,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:06:53','2011-12-01 18:06:53'),
 (57,1,'csar0790@hotmail.com',8,64,'{\"estado\":true,\"owner_id\":1}',3,'2011-12-01 18:07:58','2011-12-01 18:07:58'),
 (58,1,'manuel.rios.alvarez@gmail.com',8,72,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:09:11','2011-12-01 18:09:11'),
 (59,1,'csar0790@hotmail.com',8,73,'{\"estado\":true,\"owner_id\":1}',3,'2011-12-01 18:09:40','2011-12-01 18:09:40'),
 (60,1,'manuel.rios.alvarez@gmail.com',8,74,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:10:42','2011-12-01 18:10:42'),
 (61,1,'lllcesarlll@hotmail.com',8,76,'{\"estado\":true,\"owner_id\":1}',2,'2011-12-01 18:11:54','2011-12-01 18:11:54'),
 (62,1,'manuel.rios.alvarez@gmail.com',8,78,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:12:39','2011-12-01 18:12:39'),
 (63,1,'manuel.rios.alvarez@gmail.com',8,78,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:12:51','2011-12-01 18:12:51'),
 (64,1,'manuel.rios.alvarez@gmail.com',8,79,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:13:15','2011-12-01 18:13:15'),
 (65,1,'manuel.rios.alvarez@gmail.com',8,80,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:13:55','2011-12-01 18:13:55'),
 (66,1,'lllcesarlll@hotmail.com',8,65,'{\"estado\":true,\"owner_id\":1}',2,'2011-12-01 18:14:42','2011-12-01 18:14:42'),
 (67,1,'manuel.rios.alvarez@gmail.com',8,77,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:15:10','2011-12-01 18:15:10'),
 (68,1,'manuel.rios.alvarez@gmail.com',8,66,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:17:59','2011-12-01 18:17:59'),
 (69,1,'manuel.rios.alvarez@gmail.com',8,67,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:18:54','2011-12-01 18:18:54'),
 (70,1,'csar0790@hotmail.com',8,58,'{\"estado\":true,\"owner_id\":1}',3,'2011-12-01 18:19:49','2011-12-01 18:19:49'),
 (71,1,'manuel.rios.alvarez@gmail.com',8,60,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:21:49','2011-12-01 18:21:49'),
 (72,1,'manuel.rios.alvarez@gmail.com',8,61,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:23:42','2011-12-01 18:23:42'),
 (73,1,'manuel.rios.alvarez@gmail.com',8,50,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:24:14','2011-12-01 18:24:14'),
 (74,1,'manuel.rios.alvarez@gmail.com',8,49,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:24:22','2011-12-01 18:24:22'),
 (75,1,'csar0790@hotmail.com',8,51,'{\"estado\":true,\"owner_id\":1}',3,'2011-12-01 18:24:37','2011-12-01 18:24:37'),
 (76,1,'manuel.rios.alvarez@gmail.com',8,52,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:24:49','2011-12-01 18:24:49'),
 (77,1,'manuel.rios.alvarez@gmail.com',8,71,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:25:08','2011-12-01 18:25:08'),
 (78,1,'manuel.rios.alvarez@gmail.com',8,75,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:25:21','2011-12-01 18:25:21'),
 (79,1,'manuel.rios.alvarez@gmail.com',8,54,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:25:36','2011-12-01 18:25:36'),
 (80,1,'csar0790@hotmail.com',8,53,'{\"estado\":true,\"owner_id\":1}',3,'2011-12-01 18:25:52','2011-12-01 18:25:52'),
 (81,1,'manuel.rios.alvarez@gmail.com',8,55,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:26:11','2011-12-01 18:26:11'),
 (82,1,'manuel.rios.alvarez@gmail.com',8,56,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:26:27','2011-12-01 18:26:27'),
 (83,1,'csar0790@hotmail.com',8,57,'{\"estado\":true,\"owner_id\":1}',3,'2011-12-01 18:26:39','2011-12-01 18:26:39'),
 (84,1,'manuel.rios.alvarez@gmail.com',8,59,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 18:26:52','2011-12-01 18:26:52'),
 (85,1,'manuel.rios.alvarez@gmail.com',9,98,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 20:20:09','2011-12-01 20:20:09'),
 (86,1,'manuel.rios.alvarez@gmail.com',9,98,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 20:20:31','2011-12-01 20:20:31'),
 (87,1,'manuel.rios.alvarez@gmail.com',9,98,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 20:20:47','2011-12-01 20:20:47'),
 (88,1,'manuel.rios.alvarez@gmail.com',9,98,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 20:20:55','2011-12-01 20:20:55'),
 (89,1,'manuel.rios.alvarez@gmail.com',10,110,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 21:06:24','2011-12-01 21:06:24'),
 (90,1,'manuel.rios.alvarez@gmail.com',10,112,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 21:07:15','2011-12-01 21:07:15'),
 (91,1,'manuel.rios.alvarez@gmail.com',10,112,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 21:07:16','2011-12-01 21:07:16'),
 (92,1,'csar0790@hotmail.com',10,111,'{\"estado\":true,\"owner_id\":1}',3,'2011-12-01 21:07:47','2011-12-01 21:07:47'),
 (93,1,'manuel.rios.alvarez@gmail.com',10,112,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-01 21:08:53','2011-12-01 21:08:53'),
 (94,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 15:40:59','2011-12-02 15:40:59'),
 (95,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 15:47:15','2011-12-02 15:47:15'),
 (96,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 15:52:57','2011-12-02 15:52:57'),
 (97,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 19:48:25','2011-12-02 19:48:25'),
 (98,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 19:48:31','2011-12-02 19:48:31'),
 (99,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 19:48:58','2011-12-02 19:48:58'),
 (100,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 19:49:05','2011-12-02 19:49:05'),
 (101,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 19:53:01','2011-12-02 19:53:01'),
 (102,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 19:53:16','2011-12-02 19:53:16'),
 (103,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 19:58:13','2011-12-02 19:58:13'),
 (104,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 19:59:32','2011-12-02 19:59:32'),
 (105,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 20:00:10','2011-12-02 20:00:10'),
 (106,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 20:00:44','2011-12-02 20:00:44'),
 (107,1,'manuel.rios.alvarez@gmail.com',11,115,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 20:15:41','2011-12-02 20:15:41'),
 (108,1,'manuel.rios.alvarez@gmail.com',11,113,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 20:38:45','2011-12-02 20:38:45'),
 (109,1,'manuel.rios.alvarez@gmail.com',11,113,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-02 21:30:19','2011-12-02 21:30:19'),
 (110,1,'manuel.rios.alvarez@gmail.com',11,113,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-03 17:52:57','2011-12-03 17:52:57'),
 (111,1,'manuel.rios.alvarez@gmail.com',11,113,'{\"estado\":true,\"owner_id\":1}',4,'2011-12-03 18:30:49','2011-12-03 18:30:49');
/*!40000 ALTER TABLE `asignacion_sc` ENABLE KEYS */;


--
-- Definition of table `attribute`
--

DROP TABLE IF EXISTS `attribute`;
CREATE TABLE `attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_word` text NOT NULL,
  `description_short` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

/*!40000 ALTER TABLE `attribute` DISABLE KEYS */;
INSERT INTO `attribute` (`id`,`key_word`,`description_short`,`description`) VALUES 
 (1,'likes','Me gusta','Este atributo es la cantidad de likes de una página en facebook'),
 (2,'talking_about_count','Personas hablando de esto','Cantidad de personas que están hablando de esto'),
 (3,'followers_count','Seguidores','Cantidad de seguidores en Twitter'),
 (4,'ga:visits','Visitas','Cantidad de visitas en el tiempo ingresado'),
 (5,'ga:newVisits','Visitas nuevas','Cantidad de visitas nuevas en el tiempo ingresado'),
 (6,'ga:percentNewVisits','Porcentage de visitas nuevas','Procentage de visitas nuevas en el tiempo ingresado'),
 (7,'ga:avgTimeOnSite','Promedio de duración de las visitas','Promedio de duración de las visitas en el tiempo ingresado');
/*!40000 ALTER TABLE `attribute` ENABLE KEYS */;


--
-- Definition of table `audit_data_indicadores`
--

DROP TABLE IF EXISTS `audit_data_indicadores`;
CREATE TABLE `audit_data_indicadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indicador_id` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_data_indicadores_FI_1` (`indicador_id`),
  CONSTRAINT `audit_data_indicadores_FK_1` FOREIGN KEY (`indicador_id`) REFERENCES `data_indicadores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_data_indicadores`
--

/*!40000 ALTER TABLE `audit_data_indicadores` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_data_indicadores` ENABLE KEYS */;


--
-- Definition of table `data_indicadores`
--

DROP TABLE IF EXISTS `data_indicadores`;
CREATE TABLE `data_indicadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indicador_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `group_data` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_indicadores_FI_1` (`indicador_id`),
  KEY `data_indicadores_FI_2` (`user_id`),
  KEY `data_indicadores_FI_3` (`group_data`),
  CONSTRAINT `data_indicadores_FK_1` FOREIGN KEY (`indicador_id`) REFERENCES `indicators_sc` (`id`),
  CONSTRAINT `data_indicadores_FK_2` FOREIGN KEY (`user_id`) REFERENCES `user_sc` (`id`),
  CONSTRAINT `data_indicadores_FK_3` FOREIGN KEY (`group_data`) REFERENCES `group_data_indicadores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_indicadores`
--

/*!40000 ALTER TABLE `data_indicadores` DISABLE KEYS */;
INSERT INTO `data_indicadores` (`id`,`indicador_id`,`user_id`,`data`,`group_data`,`create_at`,`update_at`) VALUES 
 (7,66,4,7000,3,'2011-12-01 18:27:14','2011-12-01 18:27:14'),
 (8,67,4,5000,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (9,77,4,200,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (10,65,2,130,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (11,78,4,100,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (12,79,4,65,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (13,80,4,8,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (14,58,3,4,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (15,60,4,370,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (16,62,3,295,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (17,63,4,70000,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (18,64,3,58744,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (19,72,4,9200,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (20,73,3,1111,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (21,74,4,1000,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (22,76,2,8500,3,'2011-12-01 18:27:15','2011-12-01 18:27:15'),
 (23,110,4,15,4,'2011-12-01 21:09:44','2011-12-01 21:09:44'),
 (24,112,4,102,4,'2011-12-01 21:09:44','2011-12-01 21:09:44'),
 (25,98,4,2500000,5,'2011-12-02 21:38:34','2011-12-02 21:38:34'),
 (26,99,4,350,5,'2011-12-02 21:38:34','2011-12-02 21:38:34'),
 (27,106,4,56,5,'2011-12-02 21:38:34','2011-12-02 21:38:34'),
 (28,97,2,500,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (29,107,4,784,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (30,108,4,31,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (31,109,4,664,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (32,90,3,245,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (33,92,4,350,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (34,94,3,5877,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (35,95,4,2500,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (36,96,3,159,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (37,101,4,1025,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (38,102,3,42,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (39,103,4,2,5,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (40,98,4,3000000,6,'2011-12-02 21:38:35','2011-12-02 21:38:35'),
 (41,99,4,154,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (42,106,4,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (43,97,2,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (44,107,4,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (45,108,4,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (46,109,4,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (47,90,3,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (48,92,4,285,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (49,94,3,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (50,95,4,200,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (51,96,3,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (52,101,4,1571,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (53,102,3,0,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (54,103,4,3,6,'2011-12-03 21:38:34','2011-12-03 21:38:34'),
 (55,98,4,4000000,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (56,99,4,80,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (57,106,4,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (58,97,2,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (59,107,4,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (60,108,4,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (61,109,4,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (62,90,3,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (63,92,4,240,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (64,94,3,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (65,95,4,500,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (66,96,3,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (67,101,4,15448,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (68,102,3,0,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (69,103,4,7,7,'2011-12-04 21:38:34','2011-12-04 21:38:34'),
 (70,98,4,1500000,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (71,99,4,458,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (72,106,4,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (73,97,2,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (74,107,4,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (75,108,4,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (76,109,4,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (77,90,3,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (78,92,4,600,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (79,94,3,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (80,95,4,3000,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (81,96,3,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (82,101,4,1254,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (83,102,3,0,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (84,103,4,2,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (85,98,4,2578410,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (86,99,4,2540,8,'2011-12-05 21:38:34','2011-12-05 21:38:34'),
 (87,106,4,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (88,97,2,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (89,107,4,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (90,108,4,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (91,109,4,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (92,90,3,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (93,92,4,500,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (94,94,3,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (95,95,4,1400,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (96,96,3,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (97,101,4,15478,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (98,102,3,0,9,'2011-12-06 21:38:34','2011-12-06 21:38:34'),
 (99,103,4,1,9,'2011-12-06 21:38:34','2011-12-06 21:38:34');
/*!40000 ALTER TABLE `data_indicadores` ENABLE KEYS */;


--
-- Definition of table `det_network_attribute`
--

DROP TABLE IF EXISTS `det_network_attribute`;
CREATE TABLE `det_network_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `network_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `det_network_attribute_FI_1` (`network_id`),
  KEY `det_network_attribute_FI_2` (`attribute_id`),
  CONSTRAINT `det_network_attribute_FK_1` FOREIGN KEY (`network_id`) REFERENCES `network` (`id`),
  CONSTRAINT `det_network_attribute_FK_2` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `det_network_attribute`
--

/*!40000 ALTER TABLE `det_network_attribute` DISABLE KEYS */;
INSERT INTO `det_network_attribute` (`id`,`network_id`,`attribute_id`) VALUES 
 (1,1,1),
 (2,1,2),
 (3,2,3),
 (4,3,4),
 (5,3,5),
 (6,3,6),
 (7,3,7);
/*!40000 ALTER TABLE `det_network_attribute` ENABLE KEYS */;


--
-- Definition of table `detalle_grupo_trabajo_sc`
--

DROP TABLE IF EXISTS `detalle_grupo_trabajo_sc`;
CREATE TABLE `detalle_grupo_trabajo_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_grupo_trabajo_sc_FI_1` (`user_id`),
  KEY `detalle_grupo_trabajo_sc_FI_2` (`grupo_id`),
  CONSTRAINT `detalle_grupo_trabajo_sc_FK_1` FOREIGN KEY (`user_id`) REFERENCES `user_sc` (`id`),
  CONSTRAINT `detalle_grupo_trabajo_sc_FK_2` FOREIGN KEY (`grupo_id`) REFERENCES `grupo_trabajo_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_grupo_trabajo_sc`
--

/*!40000 ALTER TABLE `detalle_grupo_trabajo_sc` DISABLE KEYS */;
INSERT INTO `detalle_grupo_trabajo_sc` (`id`,`email`,`user_id`,`grupo_id`) VALUES 
 (1,'manuel.rios.alvarez@gmail.com',4,1),
 (2,'csar0790@hotmail.com',3,1),
 (3,'lllcesarlll@hotmail.com',2,1),
 (4,'manuel.rios.alvarez@gmail.com',NULL,1),
 (5,'manuel.rios.alvarez@gmail.com',NULL,1),
 (6,'pbazan@esfera.pe',NULL,1);
/*!40000 ALTER TABLE `detalle_grupo_trabajo_sc` ENABLE KEYS */;


--
-- Definition of table `group_data_indicadores`
--

DROP TABLE IF EXISTS `group_data_indicadores`;
CREATE TABLE `group_data_indicadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_at` datetime DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_data_indicadores_FI_1` (`periodo_id`),
  CONSTRAINT `group_data_indicadores_FK_1` FOREIGN KEY (`periodo_id`) REFERENCES `periodo_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_data_indicadores`
--

/*!40000 ALTER TABLE `group_data_indicadores` DISABLE KEYS */;
INSERT INTO `group_data_indicadores` (`id`,`create_at`,`periodo_id`) VALUES 
 (1,'2011-11-28 16:15:41',1),
 (2,'2011-12-01 17:04:27',1),
 (3,'2011-12-01 18:27:14',2),
 (4,'2011-12-01 21:09:44',1),
 (5,'2011-12-02 21:38:34',2),
 (6,'2011-12-03 21:38:34',2),
 (7,'2011-12-04 21:38:34',1),
 (8,'2011-12-05 21:38:34',2),
 (9,'2011-12-06 21:38:34',1);
/*!40000 ALTER TABLE `group_data_indicadores` ENABLE KEYS */;


--
-- Definition of table `grupo_trabajo_sc`
--

DROP TABLE IF EXISTS `grupo_trabajo_sc`;
CREATE TABLE `grupo_trabajo_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `flag` text,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grupo_trabajo_sc_FI_1` (`owner_id`),
  CONSTRAINT `grupo_trabajo_sc_FK_1` FOREIGN KEY (`owner_id`) REFERENCES `user_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupo_trabajo_sc`
--

/*!40000 ALTER TABLE `grupo_trabajo_sc` DISABLE KEYS */;
INSERT INTO `grupo_trabajo_sc` (`id`,`name`,`owner_id`,`flag`,`create_at`,`update_at`) VALUES 
 (1,'esfera',1,'1','2011-11-03 16:09:26','2011-11-03 16:09:26'),
 (2,'graf',2,'1','2011-11-03 16:09:26','2011-11-03 16:09:26'),
 (3,'prueba',4,'1',NULL,NULL),
 (4,'prueb2',4,'1',NULL,NULL),
 (5,'sa',1,'1',NULL,NULL);
/*!40000 ALTER TABLE `grupo_trabajo_sc` ENABLE KEYS */;


--
-- Definition of table `indicadores_sc_google_analytics`
--

DROP TABLE IF EXISTS `indicadores_sc_google_analytics`;
CREATE TABLE `indicadores_sc_google_analytics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refresh_token` text NOT NULL,
  `indicador_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indicadores_sc_google_analytics_FI_1` (`indicador_id`),
  CONSTRAINT `indicadores_sc_google_analytics_FK_1` FOREIGN KEY (`indicador_id`) REFERENCES `indicators_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indicadores_sc_google_analytics`
--

/*!40000 ALTER TABLE `indicadores_sc_google_analytics` DISABLE KEYS */;
INSERT INTO `indicadores_sc_google_analytics` (`id`,`refresh_token`,`indicador_id`) VALUES 
 (2,'1/5EBCSK2TVWECtckP-hUnGMsuG7fThv1ENIA4gC5m25A',115);
/*!40000 ALTER TABLE `indicadores_sc_google_analytics` ENABLE KEYS */;


--
-- Definition of table `indicators_sc`
--

DROP TABLE IF EXISTS `indicators_sc`;
CREATE TABLE `indicators_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `descripcion` text,
  `valor_minimo` int(11) DEFAULT NULL,
  `valor_deseado` int(11) DEFAULT NULL,
  `valor_optimo` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `tree_id` int(11) NOT NULL,
  `previous_id` int(11) DEFAULT NULL,
  `parents` text,
  `indicadores_hijos_configure` text,
  `ultimo_nodo` varchar(5) DEFAULT NULL,
  `valor_actual_entregado` int(11) DEFAULT NULL,
  `conectores_configure` text,
  `owner_indicadores` text,
  `email_responsable` varchar(50) DEFAULT NULL,
  `flag` text,
  `det_network_attribute_id` int(11) DEFAULT NULL,
  `username_in_network` text,
  `ga_fec_ini` datetime DEFAULT NULL,
  `ga_fec_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indicators_sc_FI_1` (`responsable_id`),
  KEY `indicators_sc_FI_2` (`tree_id`),
  KEY `indicators_sc_FI_3` (`det_network_attribute_id`),
  CONSTRAINT `indicators_sc_FK_1` FOREIGN KEY (`responsable_id`) REFERENCES `user_sc` (`id`),
  CONSTRAINT `indicators_sc_FK_2` FOREIGN KEY (`tree_id`) REFERENCES `tree_sc` (`id`),
  CONSTRAINT `indicators_sc_FK_3` FOREIGN KEY (`det_network_attribute_id`) REFERENCES `det_network_attribute` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indicators_sc`
--

/*!40000 ALTER TABLE `indicators_sc` DISABLE KEYS */;
INSERT INTO `indicators_sc` (`id`,`titulo`,`descripcion`,`valor_minimo`,`valor_deseado`,`valor_optimo`,`responsable_id`,`tree_id`,`previous_id`,`parents`,`indicadores_hijos_configure`,`ultimo_nodo`,`valor_actual_entregado`,`conectores_configure`,`owner_indicadores`,`email_responsable`,`flag`,`det_network_attribute_id`,`username_in_network`,`ga_fec_ini`,`ga_fec_fin`) VALUES 
 (48,'Difusion','',NULL,NULL,NULL,NULL,7,0,NULL,NULL,'1',NULL,NULL,NULL,NULL,'habilitado',NULL,NULL,NULL,NULL),
 (49,'Disfusion','d',33,66,100,4,8,0,NULL,NULL,'',0,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (50,'Captura','d',33,66,100,4,8,0,NULL,NULL,'',50,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (51,'Exposicion','d',33,66,100,3,8,0,NULL,NULL,'',28,NULL,NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (52,'Promocion','s',33,66,100,4,8,0,NULL,NULL,'',100,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (53,'Interacion','d',33,66,100,3,8,0,NULL,NULL,'',44,NULL,NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (54,'Fidelizacion','d',33,66,100,4,8,0,NULL,NULL,'',0,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (55,'Retroalimentacion','d',33,66,100,4,8,0,NULL,NULL,'',86,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (56,'Socializacion','d',33,66,100,4,8,0,NULL,NULL,'',37,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (57,'Facebook','d',33,66,100,3,8,56,'p56s-',NULL,'',0,'50',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (58,'Fans','d',2500,3500,5000,3,8,57,'p56s-p57s-',NULL,'1',NULL,'100',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (59,'Twitter','d',33,66,100,4,8,56,'p56s-',NULL,'',74,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (60,'seguidores','d',300,400,500,4,8,59,'p56s-p59s-',NULL,'1',370,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (61,'Trafico','d',33,66,100,4,8,51,'p51s-',NULL,'',28,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (62,'Paginas vistas','des',180000,200000,220000,3,8,61,'p51s-p61s-',NULL,'1',NULL,'33',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (63,'visitas','a',50000,60000,80000,4,8,61,'p51s-p61s-',NULL,'1',70000,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (64,'tiempo','c',2,3,5,3,8,61,'p51s-p61s-',NULL,'1',NULL,'34',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (65,'envio formulario contacto','d',100,150,300,2,8,53,'p53s-',NULL,'1',130,'33',NULL,'lllcesarlll@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (66,'impresiones adwords','d',2000000000,2147483647,2147483647,4,8,49,'p49s-',NULL,'1',7000,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (67,'clicks google adwords','d',3000,5000,10000,4,8,50,'p50s-',NULL,'1',5000,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (68,'usuarios que usan contrasena','',NULL,NULL,NULL,NULL,8,53,'p53s-',NULL,'1',NULL,NULL,NULL,NULL,'eliminado',NULL,NULL,NULL,NULL),
 (69,'usuarios con datos completos','',NULL,NULL,NULL,NULL,8,53,'p53s-',NULL,'1',NULL,NULL,NULL,NULL,'eliminado',NULL,NULL,NULL,NULL),
 (70,'usuarios con datos actualizados','',NULL,NULL,NULL,NULL,8,53,'p53s-',NULL,'1',NULL,NULL,NULL,NULL,'eliminado',NULL,NULL,NULL,NULL),
 (71,'calidad de datos de usuario','d',33,66,100,4,8,53,'p53s-',NULL,'',64,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (72,'usuarios que usan constrana','a',6000,8000,10000,4,8,71,'p53s-p71s-',NULL,'1',9200,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (73,'usuarios con datos actualizados','d',10000,13000,20000,3,8,71,'p53s-p71s-',NULL,'1',NULL,'33',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (74,'% usuarios con datos completos','d',10,20,30,4,8,71,'p53s-p71s-',NULL,'1',1000,'34',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (75,'conversion a digital','d',33,66,100,4,8,53,'p53s-',NULL,'',28,'34',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (76,'uso de estado de cuenta virtual','d',5000,8000,30000,2,8,75,'p53s-p75s-',NULL,'1',8500,'100',NULL,'lllcesarlll@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (77,'solicitudes de afiliazion','d',30,100,200,4,8,52,'p52s-',NULL,'1',200,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (78,'suscripcion a boletines','d',1500,2000,4000,4,8,54,'p54s-',NULL,'1',100,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (79,'% de aprobacion de contenido','d',20,50,70,4,8,55,'p55s-',NULL,'1',65,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (80,'net promoter score-nps','d',1,5,10,4,8,55,'p55s-',NULL,'1',8,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (81,'Disfusion','d',33,66,100,4,9,0,NULL,NULL,'',25,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (82,'Captura','d',33,66,100,4,9,0,NULL,NULL,'',0,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (83,'Exposicion','d',33,66,100,3,9,0,NULL,NULL,'',0,NULL,NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (84,'Promocion','s',33,66,100,4,9,0,NULL,NULL,'',28,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (85,'Interacion','d',33,66,100,3,9,0,NULL,NULL,'',10,NULL,NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (86,'Fidelizacion','d',33,66,100,4,9,0,NULL,NULL,'',0,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (87,'Retroalimentacion','d',33,66,100,4,9,0,NULL,NULL,'',72,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (88,'Socializacion','d',33,66,100,4,9,0,NULL,NULL,'',50,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (89,'Facebook','d',33,66,100,3,9,88,'p88s-',NULL,'',0,'50',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (90,'Fans','d',2500,3500,5000,3,9,89,'p88s-p89s-',NULL,'1',NULL,'100',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (91,'Twitter','d',33,66,100,4,9,88,'p88s-',NULL,'',100,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (92,'seguidores','d',300,400,500,4,9,91,'p88s-p91s-',NULL,'1',500,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (93,'Trafico','d',33,66,100,4,9,83,'p83s-',NULL,'',0,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (94,'Paginas vistas','des',180000,200000,220000,3,9,93,'p83s-p93s-',NULL,'1',NULL,'33',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (95,'visitas','a',50000,60000,80000,4,9,93,'p83s-p93s-',NULL,'1',1400,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (96,'tiempo','c',2,3,5,3,9,93,'p83s-p93s-',NULL,'1',NULL,'34',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (97,'envio formulario contacto','d',100,150,300,2,9,85,'p85s-',NULL,'1',NULL,'33',NULL,'lllcesarlll@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (98,'impresiones adwords','d',2000000,5000000,10000000,4,9,81,'p81s-',NULL,'1',2578410,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (99,'clicks google adwords','d',3000,5000,10000,4,9,82,'p82s-',NULL,'1',2540,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (100,'calidad de datos de usuario','d',33,66,100,4,9,85,'p85s-',NULL,'',33,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (101,'usuarios que usan constrana','a',6000,8000,10000,4,9,100,'p85s-p100s-',NULL,'1',15478,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (102,'usuarios con datos actualizados','d',10000,13000,20000,3,9,100,'p85s-p100s-',NULL,'1',NULL,'33',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (103,'% usuarios con datos completos','d',10,20,30,4,9,100,'p85s-p100s-',NULL,'1',1,'34',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (104,'conversion a digital','d',33,66,100,4,9,85,'p85s-',NULL,'',0,'34',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (105,'uso de estado de cuenta virtual','d',5000,8000,30000,2,9,104,'p85s-p104s-',NULL,'1',NULL,'100',NULL,'lllcesarlll@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (106,'solicitudes de afiliazion','d',30,100,200,4,9,84,'p84s-',NULL,'1',56,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (107,'suscripcion a boletines','d',1500,2000,4000,4,9,86,'p86s-',NULL,'1',784,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (108,'% de aprobacion de contenido','d',20,50,70,4,9,87,'p87s-',NULL,'1',31,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (109,'net promoter score-nps','d',1,5,10,4,9,87,'p87s-',NULL,'1',664,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (110,'fidelizacion','d',10,20,50,4,10,0,NULL,NULL,'1',15,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (111,'boletines','d',5,10,100,3,10,0,NULL,NULL,'',100,NULL,NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (112,'nuevo','d',25,50,100,4,10,111,'p111s-',NULL,'1',102,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',1,'relationics',NULL,NULL),
 (113,'fidelizacion','d',10,20,50,4,11,0,NULL,NULL,'1',NULL,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',4,'null','2011-10-01 00:00:00','2011-12-03 00:00:00'),
 (114,'boletines','d',5,10,100,3,11,0,NULL,NULL,'',NULL,NULL,NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (115,'nuevo','d',25,50,100,NULL,11,114,'p114s-',NULL,'1',53,'100',NULL,'','habilitado',4,'ga:51810348','2011-10-01 00:00:00','2011-12-02 00:00:00'),
 (116,'Disfusion','d',33,66,100,4,12,0,NULL,NULL,'',NULL,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (117,'Captura','d',33,66,100,4,12,0,NULL,NULL,'',NULL,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (118,'Exposicion','d',33,66,100,3,12,0,NULL,NULL,'',NULL,NULL,NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (119,'Promocion','s',33,66,100,4,12,0,NULL,NULL,'',NULL,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (120,'Interacion','d',33,66,100,3,12,0,NULL,NULL,'',NULL,NULL,NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (121,'Fidelizacion','d',33,66,100,4,12,0,NULL,NULL,'',NULL,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (122,'Retroalimentacion','d',33,66,100,4,12,0,NULL,NULL,'',NULL,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (123,'Socializacion','d',33,66,100,4,12,0,NULL,NULL,'',NULL,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (124,'Facebook','d',33,66,100,3,12,123,'p123s-',NULL,'',NULL,'50',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (125,'Fans','d',2500,3500,5000,3,12,124,'p123s-p124s-',NULL,'1',NULL,'100',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (126,'Twitter','d',33,66,100,4,12,123,'p123s-',NULL,'',NULL,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (127,'seguidores','d',300,400,500,4,12,126,'p123s-p126s-',NULL,'1',NULL,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (128,'Trafico','d',33,66,100,4,12,118,'p118s-',NULL,'',NULL,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (129,'Paginas vistas','des',180000,200000,220000,3,12,128,'p118s-p128s-',NULL,'1',NULL,'33',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (130,'visitas','a',50000,60000,80000,4,12,128,'p118s-p128s-',NULL,'1',NULL,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (131,'tiempo','c',2,3,5,3,12,128,'p118s-p128s-',NULL,'1',NULL,'34',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (132,'envio formulario contacto','d',100,150,300,2,12,120,'p120s-',NULL,'1',NULL,'33',NULL,'lllcesarlll@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (133,'impresiones adwords','d',2000000,5000000,10000000,4,12,116,'p116s-',NULL,'1',NULL,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (134,'clicks google adwords','d',3000,5000,10000,4,12,117,'p117s-',NULL,'1',NULL,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (135,'calidad de datos de usuario','d',33,66,100,4,12,120,'p120s-',NULL,'',NULL,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (136,'usuarios que usan constrana','a',6000,8000,10000,4,12,135,'p120s-p135s-',NULL,'1',NULL,'33',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (137,'usuarios con datos actualizados','d',10000,13000,20000,3,12,135,'p120s-p135s-',NULL,'1',NULL,'33',NULL,'csar0790@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (138,'% usuarios con datos completos','d',10,20,30,4,12,135,'p120s-p135s-',NULL,'1',NULL,'34',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (139,'conversion a digital','d',33,66,100,4,12,120,'p120s-',NULL,'',NULL,'34',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (140,'uso de estado de cuenta virtual','d',5000,8000,30000,2,12,139,'p120s-p139s-',NULL,'1',NULL,'100',NULL,'lllcesarlll@hotmail.com','habilitado',NULL,NULL,NULL,NULL),
 (141,'solicitudes de afiliazion','d',30,100,200,4,12,119,'p119s-',NULL,'1',NULL,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (142,'suscripcion a boletines','d',1500,2000,4000,4,12,121,'p121s-',NULL,'1',NULL,'100',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (143,'% de aprobacion de contenido','d',20,50,70,4,12,122,'p122s-',NULL,'1',NULL,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL),
 (144,'net promoter score-nps','d',1,5,10,4,12,122,'p122s-',NULL,'1',NULL,'50',NULL,'manuel.rios.alvarez@gmail.com','habilitado',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `indicators_sc` ENABLE KEYS */;


--
-- Definition of table `network`
--

DROP TABLE IF EXISTS `network`;
CREATE TABLE `network` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `network`
--

/*!40000 ALTER TABLE `network` DISABLE KEYS */;
INSERT INTO `network` (`id`,`name`) VALUES 
 (1,'Facebook'),
 (2,'Twitter'),
 (3,'Google Analytics');
/*!40000 ALTER TABLE `network` ENABLE KEYS */;


--
-- Definition of table `periodo_sc`
--

DROP TABLE IF EXISTS `periodo_sc`;
CREATE TABLE `periodo_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `flag` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periodo_sc`
--

/*!40000 ALTER TABLE `periodo_sc` DISABLE KEYS */;
INSERT INTO `periodo_sc` (`id`,`descripcion`,`flag`) VALUES 
 (1,'Semanal','activo'),
 (2,'Quincenal','activo'),
 (3,'Mensual','activo');
/*!40000 ALTER TABLE `periodo_sc` ENABLE KEYS */;


--
-- Definition of table `solicitud_grupo_trabajo_sc`
--

DROP TABLE IF EXISTS `solicitud_grupo_trabajo_sc`;
CREATE TABLE `solicitud_grupo_trabajo_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` text,
  `flag` text,
  `respondido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitud_grupo_trabajo_sc_FI_1` (`grupo_id`),
  KEY `solicitud_grupo_trabajo_sc_FI_2` (`user_id`),
  CONSTRAINT `solicitud_grupo_trabajo_sc_FK_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo_trabajo_sc` (`id`),
  CONSTRAINT `solicitud_grupo_trabajo_sc_FK_2` FOREIGN KEY (`user_id`) REFERENCES `user_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solicitud_grupo_trabajo_sc`
--

/*!40000 ALTER TABLE `solicitud_grupo_trabajo_sc` DISABLE KEYS */;
INSERT INTO `solicitud_grupo_trabajo_sc` (`id`,`grupo_id`,`email`,`create_at`,`update_at`,`user_id`,`token`,`flag`,`respondido`) VALUES 
 (4,1,'pbazan@esfera.pe','2011-12-01 16:51:45','2011-12-01 16:51:45',1,'4bebefb39f72a2f784a51d21de344a25','{\"estado\":true,\"respuesta\":false}',0);
/*!40000 ALTER TABLE `solicitud_grupo_trabajo_sc` ENABLE KEYS */;


--
-- Definition of table `tmp_data_reports`
--

DROP TABLE IF EXISTS `tmp_data_reports`;
CREATE TABLE `tmp_data_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indicador_id` int(11) DEFAULT NULL,
  `valor_minimo` int(11) DEFAULT NULL,
  `valor_deseado` int(11) DEFAULT NULL,
  `valor_optimo` int(11) DEFAULT NULL,
  `tree_id` int(11) NOT NULL,
  `previous_id` int(11) DEFAULT NULL,
  `parents` text,
  `indicadores_hijos_configure` text,
  `ultimo_nodo` varchar(5) DEFAULT NULL,
  `data` int(11) DEFAULT NULL,
  `conectores_configure` text,
  `update_at` datetime DEFAULT NULL,
  `flag` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tmp_data_reports_FI_1` (`tree_id`),
  CONSTRAINT `tmp_data_reports_FK_1` FOREIGN KEY (`tree_id`) REFERENCES `tmp_tree_sc` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_data_reports`
--

/*!40000 ALTER TABLE `tmp_data_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_data_reports` ENABLE KEYS */;


--
-- Definition of table `tmp_tree_sc`
--

DROP TABLE IF EXISTS `tmp_tree_sc`;
CREATE TABLE `tmp_tree_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor_minimo` int(11) DEFAULT NULL,
  `valor_deseado` int(11) DEFAULT NULL,
  `configure_flag` text,
  `flag` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_tree_sc`
--

/*!40000 ALTER TABLE `tmp_tree_sc` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_tree_sc` ENABLE KEYS */;


--
-- Definition of table `tree_sc`
--

DROP TABLE IF EXISTS `tree_sc`;
CREATE TABLE `tree_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `descripcion` text,
  `user_id` int(11) NOT NULL,
  `grupo_trabajo_id` int(11) DEFAULT NULL,
  `periodo_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `email_responsable` varchar(50) DEFAULT NULL,
  `valor_minimo` int(11) DEFAULT NULL,
  `valor_deseado` int(11) DEFAULT NULL,
  `configure_flag` text,
  `flag` text,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `configure_design` text,
  `produccion` text,
  PRIMARY KEY (`id`),
  KEY `tree_sc_FI_1` (`user_id`),
  KEY `tree_sc_FI_2` (`grupo_trabajo_id`),
  KEY `tree_sc_FI_3` (`periodo_id`),
  KEY `tree_sc_FI_4` (`responsable_id`),
  CONSTRAINT `tree_sc_FK_1` FOREIGN KEY (`user_id`) REFERENCES `user_sc` (`id`),
  CONSTRAINT `tree_sc_FK_2` FOREIGN KEY (`grupo_trabajo_id`) REFERENCES `grupo_trabajo_sc` (`id`),
  CONSTRAINT `tree_sc_FK_3` FOREIGN KEY (`periodo_id`) REFERENCES `periodo_sc` (`id`),
  CONSTRAINT `tree_sc_FK_4` FOREIGN KEY (`responsable_id`) REFERENCES `user_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree_sc`
--

/*!40000 ALTER TABLE `tree_sc` DISABLE KEYS */;
INSERT INTO `tree_sc` (`id`,`name`,`descripcion`,`user_id`,`grupo_trabajo_id`,`periodo_id`,`responsable_id`,`email_responsable`,`valor_minimo`,`valor_deseado`,`configure_flag`,`flag`,`create_at`,`update_at`,`configure_design`,`produccion`) VALUES 
 (6,'Profuturo',NULL,1,1,1,1,'cesar.quevedo.vega@gmail.com',0,0,'','1','2011-12-01 17:28:37','2011-12-01 17:28:37','','not'),
 (7,'Profuturo',NULL,1,NULL,NULL,1,'cesar.quevedo.vega@gmail.com',0,0,'','1','2011-12-01 17:33:13','2011-12-01 17:33:13','','not'),
 (8,'Profuturo',NULL,1,1,2,1,'cesar.quevedo.vega@gmail.com',0,0,'','2','2011-12-01 17:35:05','2011-12-01 18:27:14','','production'),
 (9,'Profuturo',NULL,1,1,2,NULL,NULL,NULL,NULL,'','2','2011-12-01 18:48:58','2011-12-02 21:38:34','','production'),
 (10,'tuempresa',NULL,1,1,1,1,'cesar.quevedo.vega@gmail.com',0,0,'','2','2011-12-01 21:05:09','2011-12-01 21:09:44','','production'),
 (11,'tuempresa',NULL,1,1,1,NULL,NULL,NULL,NULL,'','1','2011-12-01 22:50:42','2011-12-01 22:50:42','','not'),
 (12,'Profuturo',NULL,1,1,2,NULL,NULL,NULL,NULL,'','1','2011-12-03 18:36:43','2011-12-03 18:36:43','','not');
/*!40000 ALTER TABLE `tree_sc` ENABLE KEYS */;


--
-- Definition of table `tree_user`
--

DROP TABLE IF EXISTS `tree_user`;
CREATE TABLE `tree_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tree_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tree_user_FI_1` (`user_id`),
  KEY `tree_user_FI_2` (`tree_id`),
  CONSTRAINT `tree_user_FK_1` FOREIGN KEY (`user_id`) REFERENCES `user_sc` (`id`),
  CONSTRAINT `tree_user_FK_2` FOREIGN KEY (`tree_id`) REFERENCES `tree_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree_user`
--

/*!40000 ALTER TABLE `tree_user` DISABLE KEYS */;
INSERT INTO `tree_user` (`id`,`user_id`,`tree_id`) VALUES 
 (6,1,6),
 (7,1,7),
 (8,1,8),
 (9,1,9),
 (10,1,10),
 (11,1,11),
 (12,1,12);
/*!40000 ALTER TABLE `tree_user` ENABLE KEYS */;


--
-- Definition of table `user_sc`
--

DROP TABLE IF EXISTS `user_sc`;
CREATE TABLE `user_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `profile` int(11) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `flag` text,
  `token_session` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sc`
--

/*!40000 ALTER TABLE `user_sc` DISABLE KEYS */;
INSERT INTO `user_sc` (`id`,`email`,`profile`,`password`,`created_at`,`flag`,`token_session`) VALUES 
 (1,'cesar.quevedo.vega@gmail.com',2,'admin','2011-11-03 16:09:26','1',NULL),
 (2,'lllcesarlll@hotmail.com',3,'admin','2011-11-03 16:09:26','1',NULL),
 (3,'csar0790@hotmail.com',4,'admin','2011-11-03 16:09:26','1',NULL),
 (4,'manuel.rios.alvarez@gmail.com',7,'admin','2011-11-03 16:09:26','1',NULL);
/*!40000 ALTER TABLE `user_sc` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
