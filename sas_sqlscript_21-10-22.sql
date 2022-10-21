-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2022 at 10:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sas`
--

-- --------------------------------------------------------

--
-- Table structure for table `asignacion`
--

CREATE TABLE `asignacion` (
  `idAsignacion` int(11) NOT NULL COMMENT 'Llave primaria para identificar a la asignación.',
  `fechaAsignacion` date NOT NULL COMMENT 'Fecha en la que el profesor asignó el cuestionario.',
  `fechaCierre` date NOT NULL COMMENT 'Fecha en la que el cuestionario dejará de estar activo para los estudiantes.',
  `idCuestionario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al cuestionario.',
  `idClase` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la clase a la cual se le asignó el cuestionario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `asignacion`
--

INSERT INTO `asignacion` (`idAsignacion`, `fechaAsignacion`, `fechaCierre`, `idCuestionario`, `idClase`) VALUES
(1, '2022-10-21', '2022-11-21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clase`
--

CREATE TABLE `clase` (
  `idClase` int(11) NOT NULL COMMENT 'Llave primaria para identificar a la clase.',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la clase.',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la clase.',
  `cuatrimestre` int(11) NOT NULL COMMENT 'Número del cuatrimestre.',
  `grupo` varchar(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Grupo de la clase.',
  `carrera` enum('IBT','ITA','IIN','ITI','IET','IFI') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Carrera de la clase.',
  `codigo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Código de inscripción a la clase.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al profesor que imparte la clase.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `clase`
--

INSERT INTO `clase` (`idClase`, `nombre`, `descripcion`, `cuatrimestre`, `grupo`, `carrera`, `codigo`, `idUsuario`) VALUES
(1, 'Programación móvil', 'Clase de Programación móvil.', 9, 'A', 'ITI', '09AITIPro', 2),
(2, 'Sistemas embebidos', 'Clase de sistemas embebidos.', 9, 'A', 'ITI', '09AITISis', 2),
(3, 'Inteligencia de negocios', 'Clase de Inteligencia de negocios.', 9, 'A', 'ITI', '09AITIInt', 2);

--
-- Triggers `clase`
--
DELIMITER $$
CREATE TRIGGER `gener_cod` BEFORE INSERT ON `clase` FOR EACH ROW SET new.codigo = concat(
    new.idClase,
    new.cuatrimestre,
    new.grupo,
    new.carrera,
    LEFT(new.nombre, 3)
)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cuestionario`
--

CREATE TABLE `cuestionario` (
  `idCuestionario` int(11) NOT NULL COMMENT 'Llave primaria para identificar al cuestionario.',
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Título del cuestionario.',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción del cuestionario.',
  `tipo` enum('abiertas','cerradas') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de las preguntas que tendrá el cuestionario (abiertas o cerradas).',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al profesor que creó el cuestionario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `cuestionario`
--

INSERT INTO `cuestionario` (`idCuestionario`, `titulo`, `descripcion`, `tipo`, `idUsuario`) VALUES
(1, 'Cuestionario1', 'Cuestionario 1 de Laura.', 'cerradas', 2),
(2, 'Cuestionario 2', 'Cuestionario 2 de Laura.', 'abiertas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inscripcion`
--

CREATE TABLE `inscripcion` (
  `idInscripcion` int(11) NOT NULL COMMENT 'Llave primaria para identificar a la inscripción de un alumno a una clase.',
  `estado` enum('activo','pendiente','baja') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Estado de la inscripción, activo, pendiente (en proceso de baja) o baja.',
  `idClase` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la clase de la inscripción.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al alumno que se inscribió a la clase.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `inscripcion`
--

INSERT INTO `inscripcion` (`idInscripcion`, `estado`, `idClase`, `idUsuario`) VALUES
(1, 'baja', 1, 3),
(2, 'pendiente', 2, 3),
(3, 'pendiente', 3, 3),
(4, 'activo', 1, 5),
(5, 'activo', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `notificacion`
--

CREATE TABLE `notificacion` (
  `idNotificacion` int(11) NOT NULL COMMENT 'Llave primaria para identificar a la notificación.',
  `mensaje` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Mensaje de la notificación.',
  `idAsignacion` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la asignación.',
  `idUsuario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al alumno.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `notificacion`
--

INSERT INTO `notificacion` (`idNotificacion`, `mensaje`, `idAsignacion`, `idUsuario`) VALUES
(1, 'Tienes un nuevo cuestionario. Response Cuestionario1 cuanto antes.', 1, 5),
(2, 'Tienes un nuevo cuestionario. Response Cuestionario1 cuanto antes.', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

CREATE TABLE `pregunta` (
  `idPregunta` int(11) NOT NULL COMMENT 'Llave primaria para identificar a la pregunta.',
  `pregunta` varchar(200) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Texto de la pregunta.',
  `idCuestionario` int(11) NOT NULL COMMENT 'Llave foránea para identificar al cuestionario que contiene a la pregunta.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `pregunta`
--

INSERT INTO `pregunta` (`idPregunta`, `pregunta`, `idCuestionario`) VALUES
(1, 'Pregunta1Cuestionario1', 1),
(2, 'Pregunta2Cuestionario1', 1),
(3, 'Pregunta3Cuestionario1', 1),
(4, 'Pregunta4Cuestionario1', 1),
(5, 'PreguntaAbierta1', 2),
(6, 'PreguntaAbierta2', 2),
(7, 'PreguntaAbierta3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `respuestamultiple`
--

CREATE TABLE `respuestamultiple` (
  `idRespuestaMultiple` int(11) NOT NULL COMMENT 'Llave primaria para identificar a la respuesta definida por el profesor.',
  `contenido` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Texto de la respuesta.',
  `tipo` enum('correcta','incorrecta') COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de la respuesta si es correcta o incorrecta.',
  `idPregunta` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la pregunta a la que pertenece la respuesta.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `respuestamultiple`
--

INSERT INTO `respuestamultiple` (`idRespuestaMultiple`, `contenido`, `tipo`, `idPregunta`) VALUES
(1, 'Respuesta1Pregunta1Cuest1', 'correcta', 1),
(2, 'Respuesta2Pregunta1Cuest1', 'incorrecta', 1),
(3, 'Respuesta1Pregunta2Cuest1', 'incorrecta', 2),
(4, 'Respuesta2Pregunta2Cuest1', 'correcta', 2),
(5, 'Respuesta1Pregunta3Cuest1', 'incorrecta', 3),
(6, 'Respuesta2Pregunta3Cuest1', 'correcta', 3),
(7, 'Respuesta1Pregunta4Cuest1', 'correcta', 4),
(8, 'Respuesta2Pregunta4Cuest1', 'incorrecta', 4),
(9, 'respuestaAbierta1', 'correcta', 5),
(10, 'respuestaAbierta2', 'correcta', 6),
(11, 'respuestaAbierta3', 'correcta', 7);

-- --------------------------------------------------------

--
-- Table structure for table `topico`
--

CREATE TABLE `topico` (
  `idTopico` int(11) NOT NULL COMMENT 'Llave primaria para identificar al tópico.',
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Título del tópico.',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción del tópico.',
  `idUnidadAprendizaje` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la unidad de aprendizaje padre.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `topico`
--

INSERT INTO `topico` (`idTopico`, `titulo`, `descripcion`, `idUnidadAprendizaje`) VALUES
(1, 'Empty Project', 'Primer proyecto en Android Studio.', 1),
(2, 'Java o Kotlin', 'Elección de lenguaje para trabajar en Android Studio.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unidadaprendizaje`
--

CREATE TABLE `unidadaprendizaje` (
  `idUnidadAprendizaje` int(11) NOT NULL COMMENT 'Llave primaria para identificar a la unidad de aprendizaje.',
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Título de la clase.',
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripción de la clase.',
  `idClase` int(11) NOT NULL COMMENT 'Llave foránea para identificar a la clase padre de la unidad de aprendizaje.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `unidadaprendizaje`
--

INSERT INTO `unidadaprendizaje` (`idUnidadAprendizaje`, `titulo`, `descripcion`, `idClase`) VALUES
(1, 'Android Studio', 'Fundamentos de Android Studio.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL COMMENT 'Llave primaria para identificar al usuario.',
  `matricula` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Matrícula del usuario.',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del usuario.',
  `paterno` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Apellido paterno del usuario.',
  `materno` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Apellido materno del usuario.',
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'correo institucional del usuario.',
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre de usuario de acceso al sistema.',
  `contraseña` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'contraseña de acceso al sistema.',
  `tipo` enum('administrador','profesor','alumno') COLLATE utf8_spanish_ci NOT NULL COMMENT 'tipo de usuario.',
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'nombre de la imagen.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `matricula`, `nombre`, `paterno`, `materno`, `correo`, `usuario`, `contraseña`, `tipo`, `imagen`) VALUES
(1, 'EQJO190657', 'Jacinto', 'Escobar', 'Quezada', 'eqjo190657@upemor.edu.mx', 'jacinto', 'e1efc4c0b611956e6ae5bdb4629eda10', 'administrador', NULL),
(2, 'MCLO190493', 'Laura Itzel', 'Martínez', 'Chávez', 'mclo190493@upemor.edu.mx', 'laura', 'd2f0c294711426f440af6c188232e774', 'profesor', NULL),
(3, 'DRZO190292', 'Zuleidi', 'De la Cruz', 'Román', 'drzo190292@upemor.edu.mx', 'zuleidi', 'b179a9ec0777eae19382c14319872e1b', 'alumno', NULL),
(4, 'EQCO190657', 'Chinto', 'Escobar', 'Quezada', 'jacesc10@gmail.com', 'chinto', 'e1efc4c0b611956e6ae5bdb4629eda10', 'alumno', NULL),
(5, 'BGB0190657', 'Benito', 'Bodoque', 'Gonzalez', 'jacesc22@gmail.com', 'benito', '928732a2341b46bcdb770c7c5143dfe1', 'alumno', NULL);

--
-- Triggers `usuario`
--
DELIMITER $$
CREATE TRIGGER `encryp_pass` BEFORE INSERT ON `usuario` FOR EACH ROW SET new.contraseña = md5(new.contraseña)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`idAsignacion`),
  ADD KEY `idCuestionario` (`idCuestionario`,`idClase`),
  ADD KEY `idClase` (`idClase`);

--
-- Indexes for table `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`idClase`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD PRIMARY KEY (`idCuestionario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`idInscripcion`),
  ADD KEY `idClase` (`idClase`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`idNotificacion`),
  ADD KEY `idAsignacion` (`idAsignacion`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `idCuestionario` (`idCuestionario`);

--
-- Indexes for table `respuestamultiple`
--
ALTER TABLE `respuestamultiple`
  ADD PRIMARY KEY (`idRespuestaMultiple`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indexes for table `topico`
--
ALTER TABLE `topico`
  ADD PRIMARY KEY (`idTopico`),
  ADD KEY `idUnidadAprendizaje` (`idUnidadAprendizaje`);

--
-- Indexes for table `unidadaprendizaje`
--
ALTER TABLE `unidadaprendizaje`
  ADD PRIMARY KEY (`idUnidadAprendizaje`),
  ADD KEY `idClase` (`idClase`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `idAsignacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la asignación.', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clase`
--
ALTER TABLE `clase`
  MODIFY `idClase` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la clase.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cuestionario`
--
ALTER TABLE `cuestionario`
  MODIFY `idCuestionario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al cuestionario.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `idInscripcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la inscripción de un alumno a una clase.', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la notificación.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la pregunta.', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `respuestamultiple`
--
ALTER TABLE `respuestamultiple`
  MODIFY `idRespuestaMultiple` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la respuesta definida por el profesor.', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `topico`
--
ALTER TABLE `topico`
  MODIFY `idTopico` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al tópico.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unidadaprendizaje`
--
ALTER TABLE `unidadaprendizaje`
  MODIFY `idUnidadAprendizaje` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la unidad de aprendizaje.', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al usuario.', AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD CONSTRAINT `cuestionario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notificacion_ibfk_2` FOREIGN KEY (`idAsignacion`) REFERENCES `asignacion` (`idAsignacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `respuestamultiple`
--
ALTER TABLE `respuestamultiple`
  ADD CONSTRAINT `respuestamultiple_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `pregunta` (`idPregunta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topico`
--
ALTER TABLE `topico`
  ADD CONSTRAINT `topico_ibfk_1` FOREIGN KEY (`idUnidadAprendizaje`) REFERENCES `unidadaprendizaje` (`idUnidadAprendizaje`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unidadaprendizaje`
--
ALTER TABLE `unidadaprendizaje`
  ADD CONSTRAINT `unidadaprendizaje_ibfk_1` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
