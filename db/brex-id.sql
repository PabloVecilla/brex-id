CREATE DATABASE  IF NOT EXISTS `brex_id` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `brex_id`;
-- MySQL dump 10.13  Distrib 8.0.41, for macos15 (arm64)
--
-- Host: localhost    Database: brex_id
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articulos` (
  `id_art` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `resumen` varchar(1000) DEFAULT NULL,
  `tematica` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `contenido` varchar(10000) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_art`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (1,'La extinción de las autoras y los autores','¿Son posibles otras Inteligencias Artificiales Generativas que no utilicen lo que no es suyo y lo que nadie les dio permiso para utilizar?','IA, propiedad intelectual','2030-04-30','Sabemos, por las crónicas del Hou Hanshu, que en el año 105 Cai Lun, un eunuco encargado de los talleres de la corte china de la dinastía Han, inventó el papel tal como lo conocemos. Mucho tiempo después, en Samarcanda, los árabes descubrieron cómo se elaboraba y comenzaron a construir molinos y fábricas en Damasco, Bagdad, El Cairo y Valencia, porque tenemos registro de que esa primera fábrica europea se construyó en Xátiva. El papel es un material delicado y frágil. Puede durar muchos siglos si está bien fabricado y se conserva con cuidado o acabar convertido en polvo en pocos años por el dióxido de azufre de la contaminación de las ciudades, el calor, la humedad, la luz, los hongos, los insectos comedores de celulosa o cuero o cola, como las cucarachas, los pececillos de plata, el piojo de los libros, las termitas, las carcomas… aunque el enemigo más insidioso es otro muy distinto, no el que destruye el papel sino el que vampiriza la sangre de la escritora o el escritor sin que ella o él se de cuenta.','img/foto5.jpg'),(2,'Premio al miserable','El algoritmo como catalizador de la negatividad y la agresión en redes sociales.','redes, sociedad, algoritmo, agresión','2026-01-01','bumborasclaaart','img/foto1.jpg'),(3,'Menos cooperación, más armas ','El coste humano del nuevo orden global','armas, cooperación','2025-06-23','España ha aprobado una partida de más de 10.000 millones de euros para gasto en defensa. Con esa cantidad, se cumpliría el compromiso histórico del 0,7% de la RNB destinado a ayuda internacional. Sin embargo, seguimos en el 0,25 %','img/foto6.jpg');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventos` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `tematica` varchar(300) NOT NULL,
  `ponentes` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `contenido` text,
  `foto` varchar(100) NOT NULL,
  `espacio` varchar(100) NOT NULL,
  PRIMARY KEY (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,'Reflexiones Constituyentes','Construcción política de las normas de una sociedad','Celia Barriga, Diana Ortega','2026-07-07','...','img/foto2.jpeg','Auditorio Filología UCM'),(2,'Veinticuatro años y un día','Investigación de las similitudes y diferencias intergeneracionales','Jules Carter, Diana Ortega','2025-05-06','...','img/foto3.jpg','Auditorio decanato UCM'),(3,'Archivos inclasificables, documentos ilegibles','Los límites de la discreción en las operaciones de inteligencia del estado','Dalia Rodríguez, Sophie Churches','2025-06-06','...','img/foto4.jpg','Salón de actos Facultad de CC Info');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles` (
  `id_perfil` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `rol` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`),
  UNIQUE KEY `id_perfil` (`id_perfil`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,'Jane','Doe','jane@doe.com','jane','$2y$12$.Gc5YjktEZnFaediMIg4juEWBbWfw.fVdqRTkHKxfpCWjLSAknSQG','admin');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-12 13:32:48
