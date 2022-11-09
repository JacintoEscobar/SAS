-- MariaDB dump 10.19  Distrib 10.4.25-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sas
-- ------------------------------------------------------
-- Server version	10.4.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `sas`
--

/*!40000 DROP DATABASE IF EXISTS `sas`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sas` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `sas`;

--
-- Table structure for table `asignacion`
--

DROP TABLE IF EXISTS `asignacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignacion` (
  `idAsignacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la asignación.',
  `fechaAsignacion` date NOT NULL COMMENT 'Fecha en la que el profesor asignó el cuestionario.',
  `fechaCierre` date NOT NULL COMMENT 'Fecha en la que el cuestionario dejará de estar activo para los estudiantes.',
  `idCuestionario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al cuestionario.',
  `idClase` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la clase a la cual se le asignó el cuestionario.',
  PRIMARY KEY (`idAsignacion`),
  KEY `idCuestionario` (`idCuestionario`,`idClase`),
  KEY `idClase` (`idClase`),
  CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignacion`
--

LOCK TABLES `asignacion` WRITE;
/*!40000 ALTER TABLE `asignacion` DISABLE KEYS */;
INSERT INTO `asignacion` VALUES (3,'2022-10-28','2022-11-27',1,1),(4,'2022-11-05','2022-11-18',2,1);
/*!40000 ALTER TABLE `asignacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clase`
--

DROP TABLE IF EXISTS `clase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clase` (
  `idClase` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la clase.',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la clase.',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la clase.',
  `cuatrimestre` int(11) NOT NULL COMMENT 'Número del cuatrimestre.',
  `grupo` varchar(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Grupo de la clase.',
  `carrera` enum('IBT','ITA','IIN','ITI','IET','IFI') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Carrera de la clase.',
  `codigo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de inscripción a la clase.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al profesor que imparte la clase.',
  PRIMARY KEY (`idClase`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clase`
--

LOCK TABLES `clase` WRITE;
/*!40000 ALTER TABLE `clase` DISABLE KEYS */;
INSERT INTO `clase` VALUES (1,'Programación móvil','Clase de Programación móvil.',9,'A','ITI','09AITIPro',2),(2,'Sistemas embebidos','Clase de sistemas embebidos.',9,'A','ITI','09AITISis',2),(3,'Inteligencia de negocios','Clase de Inteligencia de negocios.',9,'A','ITI','09AITIInt',2);
/*!40000 ALTER TABLE `clase` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `gener_cod` BEFORE INSERT ON `clase` FOR EACH ROW SET new.codigo = concat(

    new.idClase,

    new.cuatrimestre,

    new.grupo,

    new.carrera,

    LEFT(new.nombre, 3)

) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `creacionetiqueta`
--

DROP TABLE IF EXISTS `creacionetiqueta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creacionetiqueta` (
  `idCreacionE` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar el registro de la creación de una nueva etiqueta.',
  `idEtiqueta` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la etiqueta creada.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al profesor que creó la etiqueta.',
  PRIMARY KEY (`idCreacionE`),
  KEY `idEtiqueta` (`idEtiqueta`,`idUsuario`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `creacionetiqueta_ibfk_1` FOREIGN KEY (`idEtiqueta`) REFERENCES `etiqueta` (`idEtiqueta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `creacionetiqueta_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creacionetiqueta`
--

LOCK TABLES `creacionetiqueta` WRITE;
/*!40000 ALTER TABLE `creacionetiqueta` DISABLE KEYS */;
INSERT INTO `creacionetiqueta` VALUES (1,1000,2),(2,1001,2),(3,1002,2),(4,1003,2),(9,1006,2);
/*!40000 ALTER TABLE `creacionetiqueta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuestionario`
--

DROP TABLE IF EXISTS `cuestionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuestionario` (
  `idCuestionario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al cuestionario.',
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Título del cuestionario.',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción del cuestionario.',
  `tipo` enum('abiertas','cerradas') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de las preguntas que tendrá el cuestionario (abiertas o cerradas).',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al profesor que creó el cuestionario.',
  PRIMARY KEY (`idCuestionario`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `cuestionario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuestionario`
--

LOCK TABLES `cuestionario` WRITE;
/*!40000 ALTER TABLE `cuestionario` DISABLE KEYS */;
INSERT INTO `cuestionario` VALUES (1,'Cuestionario1','Cuestionario 1 de Laura.','cerradas',2),(2,'Cuestionario 2','Cuestionario 2 de Laura.','abiertas',2);
/*!40000 ALTER TABLE `cuestionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuestionarioresuelto`
--

DROP TABLE IF EXISTS `cuestionarioresuelto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuestionarioresuelto` (
  `idCR` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al cuestionario resuelto por un usuario alumno.',
  `idCuestionario` int(11) NOT NULL COMMENT 'Llave foránea del cuestionario resuelto.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea del usuario alumno que respondió el cuestionario.',
  PRIMARY KEY (`idCR`),
  KEY `idCuestionario` (`idCuestionario`,`idUsuario`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `cuestionarioresuelto_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cuestionarioresuelto_ibfk_2` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuestionarioresuelto`
--

LOCK TABLES `cuestionarioresuelto` WRITE;
/*!40000 ALTER TABLE `cuestionarioresuelto` DISABLE KEYS */;
INSERT INTO `cuestionarioresuelto` VALUES (9,1,3),(8,1,5),(10,2,3),(11,2,4);
/*!40000 ALTER TABLE `cuestionarioresuelto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etiqueta`
--

DROP TABLE IF EXISTS `etiqueta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etiqueta` (
  `idEtiqueta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la etiqueta de inteligencia emocional para los alumnos.',
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la etiqueta de inteligencia emocional.',
  PRIMARY KEY (`idEtiqueta`)
) ENGINE=InnoDB AUTO_INCREMENT=1007 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etiqueta`
--

LOCK TABLES `etiqueta` WRITE;
/*!40000 ALTER TABLE `etiqueta` DISABLE KEYS */;
INSERT INTO `etiqueta` VALUES (1000,'Etiqueta1'),(1001,'Etiqueta2'),(1002,'Etiqueta3'),(1003,'Etiqueta4'),(1005,'Etiqueta6'),(1006,'Etiqueta5');
/*!40000 ALTER TABLE `etiqueta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluacion` (
  `idEvaluacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar la evaluación de un alumno en un cuestionario.',
  `puntaje` int(11) NOT NULL COMMENT 'Puntaje obtenido por el alumno en el cuestionario.',
  `idCuestionario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al cuestionario evaluado.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al alumno evaluado.',
  `idEtiqueta` int(11) NOT NULL COMMENT 'Llave foránea para identificar la etiqueta asignada por el profesor al alumno en el cuestionario evaluado.',
  PRIMARY KEY (`idEvaluacion`),
  KEY `idCuestionario` (`idCuestionario`,`idUsuario`,`idEtiqueta`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idEtiqueta` (`idEtiqueta`),
  CONSTRAINT `evaluacion_ibfk_1` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `evaluacion_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `evaluacion_ibfk_3` FOREIGN KEY (`idEtiqueta`) REFERENCES `etiqueta` (`idEtiqueta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion`
--

LOCK TABLES `evaluacion` WRITE;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` VALUES (1,2,2,3,1001),(2,2,1,3,1003);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscripcion` (
  `idInscripcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la inscripción de un alumno a una clase.',
  `estado` enum('activo','pendiente','baja') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Estado de la inscripción, activo, pendiente (en proceso de baja) o baja.',
  `idClase` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la clase de la inscripción.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al alumno que se inscribió a la clase.',
  PRIMARY KEY (`idInscripcion`),
  KEY `idClase` (`idClase`,`idUsuario`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripcion`
--

LOCK TABLES `inscripcion` WRITE;
/*!40000 ALTER TABLE `inscripcion` DISABLE KEYS */;
INSERT INTO `inscripcion` VALUES (1,'activo',1,3),(2,'activo',2,3),(3,'pendiente',3,3),(4,'activo',1,5),(5,'activo',1,4),(6,'activo',2,4);
/*!40000 ALTER TABLE `inscripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materialeducativo`
--

DROP TABLE IF EXISTS `materialeducativo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materialeducativo` (
  `idMaterialEducativo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al material educativo subido por el profesor.',
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del archivo, o título dado por el profesor.',
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Directorio del archivo en el servidor, o dirección URL del enlace.',
  `idTopico` int(11) NOT NULL COMMENT 'Llave foránea para identificar al tópico al que pertenece el material educativo.',
  `idEtiqueta` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la etiqueta con la que relaciona el material educativo.',
  `tipo` enum('archivo','enlace') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de material educativo, puede ser un archivo de cualquier extensión o un enlace a algún sitio web.',
  PRIMARY KEY (`idMaterialEducativo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materialeducativo`
--

LOCK TABLES `materialeducativo` WRITE;
/*!40000 ALTER TABLE `materialeducativo` DISABLE KEYS */;
INSERT INTO `materialeducativo` VALUES (1,'Enlace1','https://www.youtube.com/watch?v=kIEWJ1ljEro',1,1000,'enlace'),(2,'Material1.docx','../material-educativo/Material1.docx',1,1001,'archivo');
/*!40000 ALTER TABLE `materialeducativo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacion` (
  `idNotificacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la notificación.',
  `mensaje` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Mensaje de la notificación.',
  `idAsignacion` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la asignación.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al alumno.',
  PRIMARY KEY (`idNotificacion`),
  KEY `idAsignacion` (`idAsignacion`,`idUsuario`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notificacion_ibfk_2` FOREIGN KEY (`idAsignacion`) REFERENCES `asignacion` (`idAsignacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
INSERT INTO `notificacion` VALUES (5,'Tienes un nuevo cuestionario. Response Cuestionario1 cuanto antes.',3,3),(6,'Tienes un nuevo cuestionario. Response Cuestionario1 cuanto antes.',3,5),(7,'Tienes un nuevo cuestionario. Response Cuestionario1 cuanto antes.',3,4),(8,'Tienes un nuevo cuestionario. Response Cuestionario 2 cuanto antes.',4,3),(9,'Tienes un nuevo cuestionario. Response Cuestionario 2 cuanto antes.',4,5),(10,'Tienes un nuevo cuestionario. Response Cuestionario 2 cuanto antes.',4,4);
/*!40000 ALTER TABLE `notificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta` (
  `idPregunta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la pregunta.',
  `pregunta` varchar(200) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Texto de la pregunta.',
  `idCuestionario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al cuestionario que contiene a la pregunta.',
  PRIMARY KEY (`idPregunta`),
  KEY `idCuestionario` (`idCuestionario`),
  CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES (1,'Pregunta1Cuestionario1',1),(2,'Pregunta2Cuestionario1',1),(3,'Pregunta3Cuestionario1',1),(4,'Pregunta4Cuestionario1',1),(5,'PreguntaAbierta1',2),(6,'PreguntaAbierta2',2),(7,'PreguntaAbierta3',2);
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registroetiqueta`
--

DROP TABLE IF EXISTS `registroetiqueta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registroetiqueta` (
  `idRegistroEtiqueta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar el registro de una etiqueta a un alumno.',
  `idEtiqueta` int(11) NOT NULL COMMENT 'Llave foránea para identificar la etiqueta asignada al alumno.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al alumno al que se le asignó la etiqueta de inteligencia emocional.',
  PRIMARY KEY (`idRegistroEtiqueta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registroetiqueta`
--

LOCK TABLES `registroetiqueta` WRITE;
/*!40000 ALTER TABLE `registroetiqueta` DISABLE KEYS */;
INSERT INTO `registroetiqueta` VALUES (2,1002,5),(3,1001,3),(4,1003,3);
/*!40000 ALTER TABLE `registroetiqueta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestaalumno`
--

DROP TABLE IF EXISTS `respuestaalumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuestaalumno` (
  `idRespuestaAlumno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la respuesta del alumno.',
  `contenido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Contenido de la respuesta en caso de que la pregunta sea abierta.',
  `idRespuestaMultiple` int(11) DEFAULT NULL COMMENT 'Llave foránea para identificar a la respuesta en caso de que sea pregunta cerrada.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al alumno que respondió.',
  PRIMARY KEY (`idRespuestaAlumno`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idRespuestaMultiple` (`idRespuestaMultiple`),
  CONSTRAINT `respuestaalumno_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `respuestaalumno_ibfk_2` FOREIGN KEY (`idRespuestaMultiple`) REFERENCES `respuestamultiple` (`idRespuestaMultiple`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestaalumno`
--

LOCK TABLES `respuestaalumno` WRITE;
/*!40000 ALTER TABLE `respuestaalumno` DISABLE KEYS */;
INSERT INTO `respuestaalumno` VALUES (29,'Respuesta1Pregunta1Cuest1',1,5),(30,'Respuesta1Pregunta2Cuest1',3,5),(31,'Respuesta2Pregunta3Cuest1',6,5),(32,'Respuesta2Pregunta4Cuest1',8,5),(33,'Respuesta1Pregunta1Cuest1',1,3),(34,'Respuesta1Pregunta2Cuest1',3,3),(35,'Respuesta1Pregunta3Cuest1',5,3),(36,'Respuesta1Pregunta4Cuest1',7,3),(46,'respuestaAbierta1',9,3),(47,'respuestaAbierta2',10,3),(48,'Respuesta3',11,3),(49,'respuestaAbierta1',9,4),(50,'Respuesta2',10,4),(51,'Respuesta3',11,4);
/*!40000 ALTER TABLE `respuestaalumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestamultiple`
--

DROP TABLE IF EXISTS `respuestamultiple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuestamultiple` (
  `idRespuestaMultiple` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la respuesta definida por el profesor.',
  `contenido` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Texto de la respuesta.',
  `tipo` enum('correcta','incorrecta') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de la respuesta si es correcta o incorrecta.',
  `idPregunta` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la pregunta a la que pertenece la respuesta.',
  PRIMARY KEY (`idRespuestaMultiple`),
  KEY `idPregunta` (`idPregunta`),
  CONSTRAINT `respuestamultiple_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`idPregunta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestamultiple`
--

LOCK TABLES `respuestamultiple` WRITE;
/*!40000 ALTER TABLE `respuestamultiple` DISABLE KEYS */;
INSERT INTO `respuestamultiple` VALUES (1,'Respuesta1Pregunta1Cuest1','correcta',1),(2,'Respuesta2Pregunta1Cuest1','incorrecta',1),(3,'Respuesta1Pregunta2Cuest1','incorrecta',2),(4,'Respuesta2Pregunta2Cuest1','correcta',2),(5,'Respuesta1Pregunta3Cuest1','incorrecta',3),(6,'Respuesta2Pregunta3Cuest1','correcta',3),(7,'Respuesta1Pregunta4Cuest1','correcta',4),(8,'Respuesta2Pregunta4Cuest1','incorrecta',4),(9,'respuestaAbierta1','correcta',5),(10,'respuestaAbierta2','correcta',6),(11,'respuestaAbierta3','correcta',7);
/*!40000 ALTER TABLE `respuestamultiple` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topico`
--

DROP TABLE IF EXISTS `topico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topico` (
  `idTopico` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al tópico.',
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Título del tópico.',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción del tópico.',
  `idUnidadAprendizaje` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la unidad de aprendizaje padre.',
  PRIMARY KEY (`idTopico`),
  KEY `idUnidadAprendizaje` (`idUnidadAprendizaje`),
  CONSTRAINT `topico_ibfk_1` FOREIGN KEY (`idUnidadAprendizaje`) REFERENCES `unidadaprendizaje` (`idUnidadAprendizaje`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topico`
--

LOCK TABLES `topico` WRITE;
/*!40000 ALTER TABLE `topico` DISABLE KEYS */;
INSERT INTO `topico` VALUES (1,'Empty Project','Primer proyecto en Android Studio.',1),(2,'Java o Kotlin','Elección de lenguaje para trabajar en Android Studio.',1),(3,'Tópico 1','Tópico 1 de la unidad de aprendizaje 2.',2);
/*!40000 ALTER TABLE `topico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidadaprendizaje`
--

DROP TABLE IF EXISTS `unidadaprendizaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidadaprendizaje` (
  `idUnidadAprendizaje` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la unidad de aprendizaje.',
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Título de la clase.',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la clase.',
  `idClase` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la clase padre de la unidad de aprendizaje.',
  PRIMARY KEY (`idUnidadAprendizaje`),
  KEY `idClase` (`idClase`),
  CONSTRAINT `unidadaprendizaje_ibfk_1` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidadaprendizaje`
--

LOCK TABLES `unidadaprendizaje` WRITE;
/*!40000 ALTER TABLE `unidadaprendizaje` DISABLE KEYS */;
INSERT INTO `unidadaprendizaje` VALUES (1,'Android Studio','Fundamentos de Android Studio.',1),(2,'Unidad 2','Unidad de aprendizaje 2 de la clase Programación móvil.',1);
/*!40000 ALTER TABLE `unidadaprendizaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al usuario.',
  `matricula` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Matrícula del usuario.',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del usuario.',
  `paterno` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Apellido paterno del usuario.',
  `materno` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Apellido materno del usuario.',
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'correo institucional del usuario.',
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre de usuario de acceso al sistema.',
  `contraseña` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'contraseña de acceso al sistema.',
  `tipo` enum('administrador','profesor','alumno') COLLATE utf8_spanish_ci NOT NULL COMMENT 'tipo de usuario.',
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'nombre de la imagen.',
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'EQJO190657','Jacinto','Escobar','Quezada','eqjo190657@upemor.edu.mx','jacinto','e1efc4c0b611956e6ae5bdb4629eda10','administrador','yoshi.png'),(2,'MCLO190493','Laura Itzel','Martínez','Chávez','mclo190493@upemor.edu.mx','laura','d2f0c294711426f440af6c188232e774','profesor','luigi.png'),(3,'DRZO190292','Zuleidi','De la Cruz','Román','drzo190292@upemor.edu.mx','zuleidi','b179a9ec0777eae19382c14319872e1b','alumno','birdo.png'),(4,'EQCO190657','Chinto','Escobar','Quezada','jacesc10@gmail.com','chinto','e1efc4c0b611956e6ae5bdb4629eda10','alumno','perfil.jpg'),(5,'BGB0190657','Benito','Bodoque','Gonzalez','jacesc22@gmail.com','benito','928732a2341b46bcdb770c7c5143dfe1','alumno','cola.jpg');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `encryp_pass` BEFORE INSERT ON `usuario` FOR EACH ROW SET new.contraseña = md5(new.contraseña) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-09 12:56:27
