-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2022 a las 02:00:56
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `idClase` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cuatrimestre` int(11) NOT NULL,
  `grupo` varchar(1) NOT NULL,
  `carrera` enum('IBT','ITA','IIN','ITI','IET','IFI') NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`idClase`, `nombre`, `descripcion`, `cuatrimestre`, `grupo`, `carrera`, `codigo`, `idUsuario`) VALUES
(1, 'Programación móvil', 'Programación móvil.', 9, 'A', 'ITI', 'Pro9AITI', 1),
(2, 'Inteligencia de negocios', 'Inteligencia de negocios.', 9, 'A', 'ITI', 'Int9AITI', 1),
(3, 'Sistemas embebidos', 'Sistemas embebidos.', 9, 'A', 'ITI', 'Sis9AITI', 1),
(4, 'Programacion', 'Fundamentos de programacion.', 3, 'A', 'ITI', 'Pro3AITI', 5),
(5, 'POO', 'Programacion Orientada a Objetos.', 6, 'B', 'ITI', 'POO6BITI', 7),
(6, 'Fundamentos de POO', 'Fundamentos de Programacion Orientada a Objetos.', 5, 'B', 'ITI', 'Fun5BITI', 7);

--
-- Disparadores `clase`
--
DELIMITER $$
CREATE TRIGGER `generar_codigo` BEFORE INSERT ON `clase` FOR EACH ROW SET new.codigo = concat(
    LEFT(new.nombre, 3),
    new.cuatrimestre,
    new.grupo,
    new.carrera
)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `idInscripcion` int(11) NOT NULL,
  `estado` enum('Activo','Pendiente','Baja') NOT NULL,
  `idClase` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`idInscripcion`, `estado`, `idClase`, `idUsuario`) VALUES
(1, 'Baja', 2, 2),
(2, 'Baja', 3, 2),
(3, 'Pendiente', 1, 2),
(4, 'Baja', 4, 4),
(5, 'Activo', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topico`
--

CREATE TABLE `topico` (
  `idTopico` int(11) NOT NULL,
  `titulo` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idUnidadAprendizaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `topico`
--

INSERT INTO `topico` (`idTopico`, `titulo`, `descripcion`, `idUnidadAprendizaje`) VALUES
(1, 'Sintaxis de Java', 'Se aprende lo básico de cómo escribir código en Java.', 1),
(2, 'Tipado en Java', 'Se aprende sobre el tipado que maneja Java.', 1),
(3, 'if', 'Se ve a profundidad el funcionamiento y usos de if y sus variantes.', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadaprendizaje`
--

CREATE TABLE `unidadaprendizaje` (
  `idUnidadAprendizaje` int(11) NOT NULL,
  `titulo` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `idClase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidadaprendizaje`
--

INSERT INTO `unidadaprendizaje` (`idUnidadAprendizaje`, `titulo`, `descripcion`, `idClase`) VALUES
(1, 'Fundamentos de POO', 'Se aprenden los conceptos básicos de POO en Java.', 6),
(2, 'Estructuras de control', 'Estructuras de control en Java.', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `paterno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `materno` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contraseña` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('administrador','profesor','alumno') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `paterno`, `materno`, `correo`, `usuario`, `contraseña`, `tipo`) VALUES
(1, 'Jacinto', 'Escobar', 'Quezada', 'jacesc10@gmail.com', 'jasi', 'b0520cf884ac16e8f6e5a21caf0fd453', 'profesor'),
(2, 'Laura Itzel', 'Martínez', 'Chávez', 'jacesc22@gmail.com', 'laura', '680e89809965ec41e64dc7e447f175ab', 'alumno'),
(3, 'Zuleidi', 'De la Cruz', 'Román', 'zuleidi.dcr@gmail.com', 'zuly', '3261abc9007b0843b2b11cb8b4b67de4', 'administrador'),
(4, 'Regina', 'Escobar', 'Ruiz', 'jacjr1210@hotmail.com', 'regina', '9a2a3ba925fdace5fda8c833c1f617c8', 'alumno'),
(5, 'Mia', 'Escobar', 'Ruiz', 'jacjr1210@hotmail.com', 'mia', 'e1efc4c0b611956e6ae5bdb4629eda10', 'profesor'),
(6, 'Matias Jorel', 'Ortiz', 'Quezada', 'jacjr1210@hotmail.com', 'mati', 'b31b9b6bfd41ae0e02ad82fc005bfc65', 'alumno'),
(7, 'Karla', 'Gonzalez', 'Benitez', 'jacesc10@gmail.com', 'karla', '5fcd162c2418ef549b7b912976468942', 'profesor'),
(8, 'Jacinto', 'Escobar', 'Quezada', 'jacesc10@gmail.com', 'jas', 'b0520cf884ac16e8f6e5a21caf0fd453', 'profesor');

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `encriptar_contraseña` BEFORE INSERT ON `usuario` FOR EACH ROW SET new.contraseña = MD5(new.contraseña)
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`idClase`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`idInscripcion`),
  ADD KEY `Codigo` (`idClase`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `topico`
--
ALTER TABLE `topico`
  ADD PRIMARY KEY (`idTopico`),
  ADD KEY `idUnidadAprendizaje` (`idUnidadAprendizaje`);

--
-- Indices de la tabla `unidadaprendizaje`
--
ALTER TABLE `unidadaprendizaje`
  ADD PRIMARY KEY (`idUnidadAprendizaje`),
  ADD KEY `idClase` (`idClase`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `idClase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `idInscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `topico`
--
ALTER TABLE `topico`
  MODIFY `idTopico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `unidadaprendizaje`
--
ALTER TABLE `unidadaprendizaje`
  MODIFY `idUnidadAprendizaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `topico`
--
ALTER TABLE `topico`
  ADD CONSTRAINT `topico_ibfk_1` FOREIGN KEY (`idUnidadAprendizaje`) REFERENCES `unidadaprendizaje` (`idUnidadAprendizaje`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `unidadaprendizaje`
--
ALTER TABLE `unidadaprendizaje`
  ADD CONSTRAINT `unidadaprendizaje_ibfk_1` FOREIGN KEY (`idClase`) REFERENCES `clase` (`idClase`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
