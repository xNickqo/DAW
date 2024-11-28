-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-11-2024 a las 11:25:28
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
-- Base de datos: `empleados1n`
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
('D001', 'RRHH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emple`
--

DROP TABLE IF EXISTS `emple`;
CREATE TABLE IF NOT EXISTS `emple` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `salario` decimal(8,2) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `cod_dpto` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`dni`),
  KEY `fk_cod_dpto` (`cod_dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emple`
--

INSERT INTO `emple` (`dni`, `nombre`, `salario`, `fecha_nac`, `cod_dpto`) VALUES
('11111111A', 'ALFONSO', '5000.00', '2024-01-01', 'D001'),
('22222222B', 'MARIA', '4000.00', '2024-01-01', 'D001');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `emple`
--
ALTER TABLE `emple`
  ADD CONSTRAINT `fk_cod_dpto` FOREIGN KEY (`cod_dpto`) REFERENCES `dpto` (`cod_dpto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
