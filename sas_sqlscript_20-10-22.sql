-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2022 at 10:28 PM
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
(1, 'activo', 1, 3),
(2, 'pendiente', 2, 3),
(3, 'pendiente', 3, 3);

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
(3, 'DRZO190292', 'Zuleidi', 'De la Cruz', 'Román', 'drzo190292@upemor.edu.mx', 'zuleidi', 'b179a9ec0777eae19382c14319872e1b', 'alumno', NULL);

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
-- Indexes for table `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`idClase`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`idInscripcion`),
  ADD KEY `idClase` (`idClase`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

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
-- AUTO_INCREMENT for table `clase`
--
ALTER TABLE `clase`
  MODIFY `idClase` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la clase.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `idInscripcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar a la inscripción de un alumno a una clase.', AUTO_INCREMENT=4;

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
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria para identificar al usuario.', AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE;

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
