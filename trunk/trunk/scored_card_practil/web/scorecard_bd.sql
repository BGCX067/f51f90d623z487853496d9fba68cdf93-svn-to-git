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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asignacion_sc`
--

/*!40000 ALTER TABLE `asignacion_sc` DISABLE KEYS */;
/*!40000 ALTER TABLE `asignacion_sc` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_indicadores`
--

/*!40000 ALTER TABLE `data_indicadores` DISABLE KEYS */;
INSERT INTO `data_indicadores` (`id`,`indicador_id`,`user_id`,`data`,`group_data`,`create_at`,`update_at`) VALUES
 (17,23,3,100,5,'2011-11-21 22:48:46','2011-11-21 22:48:46'),
 (18,24,3,200,5,'2011-11-21 22:48:46','2011-11-21 22:48:46'),
 (19,25,3,300,5,'2011-11-21 22:48:46','2011-11-21 22:48:46'),
 (20,26,3,100,5,'2011-11-21 22:48:46','2011-11-21 22:48:46'),
 (21,30,3,50,6,'2011-11-22 16:54:28','2011-11-22 16:54:28'),
 (22,31,3,80,6,'2011-11-22 16:54:28','2011-11-22 16:54:28'),
 (23,32,3,100,6,'2011-11-22 16:54:28','2011-11-22 16:54:28'),
 (24,33,3,20,6,'2011-11-22 16:54:29','2011-11-22 16:54:29'),
 (25,23,3,50,7,'2011-12-22 16:54:29','2011-11-22 16:54:29'),
 (26,24,3,20,7,'2011-12-22 16:54:29','2011-11-22 16:54:29'),
 (27,25,3,30,7,'2011-12-22 16:54:29','2011-11-22 16:54:29'),
 (28,26,3,70,7,'2011-12-22 16:54:29','2011-11-22 16:54:29'),
 (29,37,3,20,8,'2011-11-23 21:06:41','2011-11-23 21:06:41'),
 (30,38,3,50,8,'2011-11-23 21:06:41','2011-11-23 21:06:41'),
 (31,39,3,100,8,'2011-11-23 21:06:41','2011-11-23 21:06:41'),
 (32,40,3,30,8,'2011-11-23 21:06:41','2011-11-23 21:06:41'),
 (33,37,3,37,9,'2011-11-23 21:06:41','2011-12-23 21:06:41'),
 (34,38,3,20,9,'2011-11-23 21:06:41','2011-11-23 21:06:41'),
 (35,39,3,100,9,'2011-11-23 21:06:41','2011-11-23 21:06:41'),
 (36,40,3,50,9,'2011-11-23 21:06:41','2011-11-23 21:06:41');
/*!40000 ALTER TABLE `data_indicadores` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_grupo_trabajo_sc`
--

/*!40000 ALTER TABLE `detalle_grupo_trabajo_sc` DISABLE KEYS */;
INSERT INTO `detalle_grupo_trabajo_sc` (`id`,`email`,`user_id`,`grupo_id`) VALUES
 (1,'lllcesarlll@hotmail.com',3,1),
 (2,'csar0790@hotmail.com',6,1),
 (3,'manuel.rios.alvarez@gmail.com',9,1);
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
 (1,'2011-11-21 14:56:23',1),
 (2,'2011-12-21 14:56:23',1),
 (3,'2011-11-21 20:34:14',1),
 (4,'2011-11-21 21:29:47',1),
 (5,'2011-11-21 22:48:46',1),
 (6,'2011-11-22 16:54:28',1),
 (7,'2011-12-22 16:54:28',1),
 (8,'2011-11-23 21:06:41',1),
 (9,'2011-12-23 21:06:41',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupo_trabajo_sc`
--

/*!40000 ALTER TABLE `grupo_trabajo_sc` DISABLE KEYS */;
INSERT INTO `grupo_trabajo_sc` (`id`,`name`,`owner_id`,`flag`,`create_at`,`update_at`) VALUES
 (1,'esfera',2,'1','2011-11-03 16:09:26','2011-11-03 16:09:26');
/*!40000 ALTER TABLE `grupo_trabajo_sc` ENABLE KEYS */;


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
  PRIMARY KEY (`id`),
  KEY `indicators_sc_FI_1` (`responsable_id`),
  KEY `indicators_sc_FI_2` (`tree_id`),
  CONSTRAINT `indicators_sc_FK_1` FOREIGN KEY (`responsable_id`) REFERENCES `user_sc` (`id`),
  CONSTRAINT `indicators_sc_FK_2` FOREIGN KEY (`tree_id`) REFERENCES `tree_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indicators_sc`
--

/*!40000 ALTER TABLE `indicators_sc` DISABLE KEYS */;
INSERT INTO `indicators_sc` (`id`,`titulo`,`descripcion`,`valor_minimo`,`valor_deseado`,`valor_optimo`,`responsable_id`,`tree_id`,`previous_id`,`parents`,`indicadores_hijos_configure`,`ultimo_nodo`,`valor_actual_entregado`,`conectores_configure`,`owner_indicadores`,`email_responsable`,`flag`) VALUES
 (20,'1','1',10,20,100,9,6,0,NULL,NULL,'',12,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado'),
 (21,'2','2',10,80,100,9,6,20,'p20s-',NULL,'',10,'80',NULL,'manuel.rios.alvarez@gmail.com','habilitado'),
 (22,'3','3',50,100,200,3,6,20,'p20s-',NULL,'',41,'20',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (23,'4','4',150,300,450,3,6,21,'p20s-p21s-',NULL,'1',200,'80',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (24,'5','5',100,200,400,3,6,21,'p20s-p21s-',NULL,'1',150,'20',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (25,'6','6',10,200,600,3,6,22,'p20s-p22s-',NULL,'1',300,'50',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (26,'7','7',10,50,300,3,6,22,'p20s-p22s-',NULL,'1',100,'50',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (27,'1','1',10,20,100,9,7,0,NULL,NULL,'',1,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado'),
 (28,'2','2',10,80,100,9,7,27,'p27s-',NULL,'',0,'80',NULL,'manuel.rios.alvarez@gmail.com','habilitado'),
 (29,'3','3',50,100,200,3,7,27,'p27s-',NULL,'',11,'20',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (30,'4','4',150,300,450,3,7,28,'p27s-p28s-',NULL,'1',50,'80',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (31,'5','5',100,200,400,3,7,28,'p27s-p28s-',NULL,'1',80,'20',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (32,'6','6',10,200,600,3,7,29,'p27s-p29s-',NULL,'1',100,'50',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (33,'7','7',10,50,300,3,7,29,'p27s-p29s-',NULL,'1',20,'50',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (34,'1','1',10,20,100,9,8,0,NULL,NULL,'',NULL,NULL,NULL,'manuel.rios.alvarez@gmail.com','habilitado'),
 (35,'2','2',10,80,100,9,8,34,'p34s-',NULL,'',NULL,'80',NULL,'manuel.rios.alvarez@gmail.com','habilitado'),
 (36,'3','3',50,100,200,3,8,34,'p34s-',NULL,'',NULL,'20',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (37,'4','4',150,300,450,3,8,35,'p34s-p35s-',NULL,'1',NULL,'80',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (38,'5','5',100,200,400,3,8,35,'p34s-p35s-',NULL,'1',NULL,'20',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (39,'6','6',10,200,600,3,8,36,'p34s-p36s-',NULL,'1',NULL,'50',NULL,'lllcesarlll@hotmail.com','habilitado'),
 (40,'7','7',10,50,300,3,8,36,'p34s-p36s-',NULL,'1',NULL,'50',NULL,'lllcesarlll@hotmail.com','habilitado');
/*!40000 ALTER TABLE `indicators_sc` ENABLE KEYS */;


--
-- Definition of table `periodo_sc`
--

DROP TABLE IF EXISTS `periodo_sc`;
CREATE TABLE `periodo_sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `flag` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periodo_sc`
--

/*!40000 ALTER TABLE `periodo_sc` DISABLE KEYS */;
INSERT INTO `periodo_sc` (`id`,`descripcion`,`flag`) VALUES
 (1,'cada 15 dias','activo'),
 (2,'cada mes','activo'),
 (3,'cada bimestre','activo'),
 (4,'cada trimestre','activo');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solicitud_grupo_trabajo_sc`
--

/*!40000 ALTER TABLE `solicitud_grupo_trabajo_sc` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitud_grupo_trabajo_sc` ENABLE KEYS */;


--
-- Definition of table `tmp_data_reports`
--

DROP TABLE IF EXISTS `tmp_data_reports`;
CREATE TABLE `tmp_data_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor_minimo` int(11) DEFAULT NULL,
  `valor_deseado` int(11) DEFAULT NULL,
  `valor_optimo` int(11) DEFAULT NULL,
  `tree_id` int(11) NOT NULL,
  `previous_id` int(11) DEFAULT NULL,
  `parents` text,
  `indicadores_hijos_configure` text,
  `ultimo_nodo` varchar(5) DEFAULT NULL,
  `valor_actual_entregado` int(11) DEFAULT NULL,
  `conectores_configure` text,
  PRIMARY KEY (`id`),
  KEY `tmp_data_reports_FI_1` (`tree_id`),
  CONSTRAINT `tmp_data_reports_FK_1` FOREIGN KEY (`tree_id`) REFERENCES `tmp_tree_sc` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree_sc`
--

/*!40000 ALTER TABLE `tree_sc` DISABLE KEYS */;
INSERT INTO `tree_sc` (`id`,`name`,`descripcion`,`user_id`,`grupo_trabajo_id`,`periodo_id`,`responsable_id`,`email_responsable`,`valor_minimo`,`valor_deseado`,`configure_flag`,`flag`,`create_at`,`update_at`,`configure_design`,`produccion`) VALUES
 (5,'Estrategia_prueba',NULL,2,1,1,2,'cesar.quevedo.vega@gmail.com',0,0,'','2','2011-11-21 21:25:31','2011-11-21 21:29:47','','production'),
 (6,'Estrategia_Test',NULL,3,1,1,3,NULL,NULL,NULL,'','1','2011-11-21 22:44:07','2011-11-21 22:48:46','','production'),
 (7,'Estrategia_prueba',NULL,2,1,1,NULL,NULL,NULL,NULL,'','1','2011-11-22 16:52:50','2011-11-22 16:54:27','','production'),
 (8,'Estrategia_Cicho',NULL,2,1,1,NULL,NULL,NULL,NULL,'','1','2011-11-23 21:06:28','2011-11-23 21:06:41','','production');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tree_user`
--

/*!40000 ALTER TABLE `tree_user` DISABLE KEYS */;
INSERT INTO `tree_user` (`id`,`user_id`,`tree_id`) VALUES
 (6,3,6),
 (7,2,7),
 (8,2,8);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sc`
--

/*!40000 ALTER TABLE `user_sc` DISABLE KEYS */;
INSERT INTO `user_sc` (`id`,`email`,`profile`,`password`,`created_at`,`flag`,`token_session`) VALUES
 (2,'cesar.quevedo.vega@gmail.com',2,'admin','2011-11-03 16:09:26','1',NULL),
 (3,'lllcesarlll@hotmail.com',3,'admin','2011-11-03 16:09:26','1',NULL),
 (6,'csar0790@hotmail.com',4,'admin','2011-11-03 16:09:26','1',NULL),
 (9,'manuel.rios.alvarez@gmail.com',5,'admin','2011-11-03 16:09:26','1',NULL);
/*!40000 ALTER TABLE `user_sc` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
