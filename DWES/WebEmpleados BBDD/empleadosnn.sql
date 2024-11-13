-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-11-2024 a las 11:24:40
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empleadosnn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dpto`
--

DROP TABLE IF EXISTS `dpto`;
CREATE TABLE IF NOT EXISTS `dpto` (
  `cod_dpto` varchar(4) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`cod_dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dpto`
--

INSERT INTO `dpto` (`cod_dpto`, `nombre`) VALUES
('D001', 'RRHH'),
('D002', 'COMPRAS'),
('D003', 'CONTABILIDAD'),
('D004', 'INFORMATICA'),
('D005', 'ECONOMIA'),
('D006', 'COMERCIO'),
('D007', 'OFIMATICA'),
('D008', 'FISICA'),
('D010', 'INFORMATICA'),
('D011', 'ECOLOGIA'),
('D012', 'DIBUJO TECNICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emple`
--

DROP TABLE IF EXISTS `emple`;
CREATE TABLE IF NOT EXISTS `emple` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `salario` decimal(8,2) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emple`
--

INSERT INTO `emple` (`dni`, `nombre`, `apellidos`, `salario`, `fecha_nac`) VALUES
('52028211A', 'Nicolas', 'Lopez Flores', '3000.00', '2024-11-21'),
('52028212A', 'Alfonso', 'Martinez', '3000.00', '2024-11-14'),
('52028213A', 'Nerea', 'Fernandez Gomez', '3500.00', '2024-11-04'),
('52028214A', 'Martin', 'Fernandez Ladrada', '2100.00', '2024-11-14'),
('52028216A', 'Martin', 'Fernandez Ladrada', '2100.00', '2024-11-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emple_dpto`
--

DROP TABLE IF EXISTS `emple_dpto`;
CREATE TABLE IF NOT EXISTS `emple_dpto` (
  `dni` varchar(9) NOT NULL,
  `cod_dpto` varchar(4) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`dni`,`cod_dpto`,`fecha_ini`),
  KEY `fk_cod_dpto` (`cod_dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emple_dpto`
--

INSERT INTO `emple_dpto` (`dni`, `cod_dpto`, `fecha_ini`, `fecha_fin`) VALUES
('52028211A', 'D004', '2024-11-06', NULL),
('52028212A', 'D004', '2024-11-06', NULL),
('52028213A', 'D002', '2024-11-06', NULL),
('52028214A', 'D004', '2024-11-06', NULL),
('52028216A', 'D004', '2024-11-06', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `emple_dpto`
--
ALTER TABLE `emple_dpto`
  ADD CONSTRAINT `fk_cod_dpto` FOREIGN KEY (`cod_dpto`) REFERENCES `dpto` (`cod_dpto`),
  ADD CONSTRAINT `fk_dni` FOREIGN KEY (`dni`) REFERENCES `emple` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
