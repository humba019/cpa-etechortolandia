CREATE DATABASE  IF NOT EXISTS `teste2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `teste2`;
-- MySQL dump 10.16  Distrib 10.1.28-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: teste2
-- ------------------------------------------------------
-- Server version	5.7.22-log

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
-- Table structure for table `ficha`
--

DROP TABLE IF EXISTS `ficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ficha` (
  `idficha` int(11) NOT NULL AUTO_INCREMENT,
  `cursoFicha` text NOT NULL,
  `generoFicha` varchar(45) NOT NULL,
  `tituloFicha` varchar(100) NOT NULL,
  `notaFicha` int(2) NOT NULL,
  `palavrascFicha` text NOT NULL,
  `areaFicha` text NOT NULL,
  `folhasFicha` varchar(5) NOT NULL,
  `dataFicha` date NOT NULL,
  `resumoFicha` text NOT NULL,
  `sujestaoFicha` text,
  `idusuarios` int(11) DEFAULT NULL,
  `uniensinoFicha` varchar(45) NOT NULL,
  `tipoFicha` varchar(45) NOT NULL,
  `abstractFicha` text NOT NULL,
  `referenciaFicha` text NOT NULL,
  `tituloIFicha` varchar(100) NOT NULL,
  PRIMARY KEY (`idficha`),
  KEY `fk_usuario_fichado_idx` (`idusuarios`),
  CONSTRAINT `fk_usuario_fichado` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ficha`
--

LOCK TABLES `ficha` WRITE;
/*!40000 ALTER TABLE `ficha` DISABLE KEYS */;
/*!40000 ALTER TABLE `ficha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orientador`
--

DROP TABLE IF EXISTS `orientador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orientador` (
  `idorientador` int(11) NOT NULL AUTO_INCREMENT,
  `nomedOrientador` varchar(45) DEFAULT NULL,
  `nomeiOrientador` varchar(45) DEFAULT NULL,
  `titulacaoOrientador` varchar(45) DEFAULT NULL,
  `idusuarios` int(11) DEFAULT NULL,
  PRIMARY KEY (`idorientador`),
  KEY `fk_usuarios_orientador_idx` (`idusuarios`),
  CONSTRAINT `fk_usuarios_orientador` FOREIGN KEY (`idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orientador`
--

LOCK TABLES `orientador` WRITE;
/*!40000 ALTER TABLE `orientador` DISABLE KEYS */;
INSERT INTO `orientador` VALUES (29,'Ralfe Filho','FILHO, Ralfe','Prof.',24),(30,'Ralfe Filho','FILHO, Ralfe','Prof.',24);
/*!40000 ALTER TABLE `orientador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `loginUsuario` varchar(15) DEFAULT NULL,
  `senhaUsuario` varchar(10) DEFAULT NULL,
  `tipoUsuario` varchar(45) DEFAULT NULL,
  `envioUsuario` varchar(20) DEFAULT NULL,
  `emailUsuario` varchar(45) DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `nomedUsuario` varchar(45) DEFAULT NULL,
  `nomeiUsuario` varchar(45) DEFAULT NULL,
  `mensagemUsuario` text,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'ana1','ana','professor','-','ana@gmail','199555557755','Ana Pimentel','PIMENTEL, Ana.',''),(2,'ana','123','aluno',NULL,'ana@gmail','19955555555','Ana Pimentel','PIMENTEL, Ana.',''),(23,'hum','123','aluno',NULL,'hum@gmail','22222222222','Humberto Barreto','BARRETO, Humberto.','iajaijai'),(24,'humberto','123','aluno',NULL,'humberto@gmail','33333333333','Humberto Alves','ALVES. Humberto','nnnnnnnnnnnnnnnnnnnnnnnnnnnn');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'teste2'
--

--
-- Dumping routines for database 'teste2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-16 19:59:25
