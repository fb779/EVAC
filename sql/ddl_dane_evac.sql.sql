-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2016 a las 19:54:47
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `dane_evac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actiemp`
--

CREATE TABLE `actiemp` (
  `nordemp` mediumint(7) UNSIGNED NOT NULL COMMENT 'Numero de orden empresa',
  `actividad` mediumint(4) UNSIGNED NOT NULL COMMENT 'Código actividad CIIU a 4 dígitos'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Actividades de la empresa';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(10) NOT NULL,
  `numemp` bigint(10) NOT NULL,
  `ciiu3` int(4) NOT NULL,
  `tipo_usuario` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `fec_mod` date NOT NULL,
  `hora_mod` time NOT NULL,
  `nom_var` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `valor_anterior` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `valor_actual` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tabla` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_i`
--

CREATE TABLE `capitulo_i` (
  `C1_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `I1R1C1N` tinyint(1) DEFAULT NULL COMMENT 'Servicios o bienes nuevos',
  `I1R1C2N` mediumint(3) DEFAULT NULL COMMENT 'Servicios o bienes nuevos (cantidad)',
  `I1R2C1N` tinyint(1) DEFAULT NULL,
  `I1R2C2N` mediumint(3) DEFAULT NULL,
  `I1R3C1N` tinyint(1) DEFAULT NULL,
  `I1R3C2N` mediumint(3) DEFAULT NULL,
  `I1R4C2N` mediumint(6) DEFAULT NULL,
  `I1R1C1M` tinyint(1) DEFAULT NULL,
  `I1R1C2M` mediumint(3) DEFAULT NULL,
  `I1R2C1M` tinyint(1) DEFAULT NULL,
  `I1R2C2M` mediumint(3) DEFAULT NULL,
  `I1R3C1M` tinyint(1) DEFAULT NULL,
  `I1R3C2M` mediumint(3) DEFAULT NULL,
  `I1R4C2M` mediumint(6) DEFAULT NULL,
  `I1R4C1` tinyint(1) DEFAULT NULL,
  `I1R4C2` bigint(3) DEFAULT NULL,
  `I1R5C1` tinyint(1) DEFAULT NULL,
  `I1R5C2` bigint(3) DEFAULT NULL,
  `I1R6C1` tinyint(1) DEFAULT NULL,
  `I1R6C2` bigint(3) DEFAULT NULL,
  `I2R1C1` tinyint(1) DEFAULT NULL,
  `I2R2C1` tinyint(1) DEFAULT NULL,
  `I2R3C1` tinyint(1) DEFAULT NULL,
  `I2R4C1` tinyint(1) DEFAULT NULL,
  `I2R5C1` tinyint(1) DEFAULT NULL,
  `I2R6C1` tinyint(1) DEFAULT NULL,
  `I2R7C1` tinyint(1) DEFAULT NULL,
  `I2R8C1` tinyint(1) DEFAULT NULL,
  `I2R9C1` tinyint(1) DEFAULT NULL,
  `I2R10C1` tinyint(1) DEFAULT NULL,
  `I2R11C1` tinyint(1) DEFAULT NULL,
  `I2R12C1` tinyint(1) DEFAULT NULL,
  `I2R13C1` tinyint(1) DEFAULT NULL,
  `I2R14C1` tinyint(1) DEFAULT NULL,
  `I2R15C1` tinyint(1) DEFAULT NULL,
  `I3R1C1` bigint(12) DEFAULT NULL,
  `I3R1C2` bigint(12) DEFAULT NULL,
  `I3R2C1` bigint(12) DEFAULT NULL,
  `I3R2C2` bigint(12) DEFAULT NULL,
  `I4R1C1` mediumint(3) DEFAULT NULL,
  `I4R1C2` mediumint(3) DEFAULT NULL,
  `I4R2C1` mediumint(3) DEFAULT NULL,
  `I4R2C2` mediumint(3) DEFAULT NULL,
  `I4R3C1` mediumint(3) DEFAULT NULL,
  `I4R3C2` mediumint(3) DEFAULT NULL,
  `I4R4C1` mediumint(3) DEFAULT NULL,
  `I4R4C2` mediumint(3) DEFAULT NULL,
  `I4R5C1` mediumint(3) DEFAULT NULL,
  `I4R5C2` mediumint(3) DEFAULT NULL,
  `I5R1C1` tinyint(1) DEFAULT NULL,
  `I6R1C1` tinyint(1) DEFAULT NULL,
  `I7R1C1` tinyint(1) DEFAULT NULL,
  `I8R1C1` tinyint(1) DEFAULT NULL,
  `I8R2C1` tinyint(1) DEFAULT NULL,
  `I9R1C1` tinyint(1) DEFAULT NULL,
  `I9R2C1` tinyint(1) DEFAULT NULL,
  `I10R1C1` tinyint(1) DEFAULT NULL,
  `I10R2C1` tinyint(1) DEFAULT NULL,
  `I10R3C1` tinyint(1) DEFAULT NULL,
  `I10R4C1` tinyint(1) DEFAULT NULL,
  `I10R5C1` tinyint(1) DEFAULT NULL,
  `I10R6C1` tinyint(1) DEFAULT NULL,
  `I10R7C1` tinyint(1) DEFAULT NULL,
  `I10R8C1` tinyint(1) DEFAULT NULL,
  `I10R9C1` tinyint(1) DEFAULT NULL,
  `I10R10C1` tinyint(1) DEFAULT NULL,
  `I10R11C1` tinyint(1) DEFAULT NULL,
  `I10R12C1` tinyint(1) DEFAULT NULL,
  `I10R13C1` tinyint(1) DEFAULT NULL,
  `I10R14C1` tinyint(1) DEFAULT NULL,
  `OBSERVACIONES` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------
-- ########################################################
--
-- Estructura de tabla para la tabla `capitulo_i_other`
--

CREATE TABLE `capitulo_i_other` (
  `C1_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `i1r1c1n` tinyint(1) DEFAULT NULL, 
  `i1r1c2n` mediumint(3) DEFAULT NULL, 
  `i1r3c1` tinyint(1) DEFAULT NULL,
  `i1r3c2` tinyint(1) DEFAULT NULL,
  `i1r3c3` tinyint(1) DEFAULT NULL,
  `i1r3c4` tinyint(1) DEFAULT NULL,
  `i1r3c5` tinyint(1) DEFAULT NULL,
  `i1r3c6` tinyint(1) DEFAULT NULL,
  `i1r3c7` tinyint(1) DEFAULT NULL,
  `i1r3c8` tinyint(1) DEFAULT NULL,
  `i1r3c9` text DEFAULT NULL,
  `i1r4c1` tinyint(1) DEFAULT NULL,
  `OBSERVACIONES` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Estructura de tabla para la tabla `capitulo_i_other_displab`
--

CREATE TABLE `capitulo_i_other_displab` (
  `id_displab` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `C1_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `i1r2c1` int(10) DEFAULT NULL, 
  `i1r2c2` tinyint(1) DEFAULT NULL, 
  `i1r2c3` tinyint(1) DEFAULT NULL,
  `i1r2c4` tinyint(1) DEFAULT NULL,
  `i1r2c5` int(10) DEFAULT NULL,
  `i1r2c6` tinyint(1) DEFAULT NULL,
  `i1r2c7` int(10) DEFAULT NULL,
  `i1r2c8` int(10) DEFAULT NULL,
  `i1r2c9` int(10) DEFAULT NULL,
  `i1r2c10` int(10) DEFAULT NULL,
  `i1r2c11` int(10) DEFAULT NULL,
  `i1r2c12` int(10) DEFAULT NULL,
  `i1r2c13` tinyint(1) DEFAULT NULL,
  `i1r2c14` varchar(200) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- ########################################################
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_ii`
--

CREATE TABLE `capitulo_ii` (
  `C2_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `II1R1C1` bigint(9) DEFAULT NULL,
  `II1R1C2` bigint(9) DEFAULT NULL,
  `II1R2C1` bigint(9) DEFAULT NULL,
  `II1R2C2` bigint(9) DEFAULT NULL,
  `II1R3C1` bigint(9) DEFAULT NULL,
  `II1R3C2` bigint(9) DEFAULT NULL,
  `II1R4C1` bigint(9) DEFAULT NULL,
  `II1R4C2` bigint(9) DEFAULT NULL,
  `II1R5C1` bigint(9) DEFAULT NULL,
  `II1R5C2` bigint(9) DEFAULT NULL,
  `II1R6C1` bigint(9) DEFAULT NULL,
  `II1R6C2` bigint(9) DEFAULT NULL,
  `II1R7C1` bigint(9) DEFAULT NULL,
  `II1R7C2` bigint(9) DEFAULT NULL,
  `II1R8C1` bigint(9) DEFAULT NULL,
  `II1R8C2` bigint(9) DEFAULT NULL,
  `II1R9C1` bigint(9) DEFAULT NULL,
  `II1R9C2` bigint(9) DEFAULT NULL,
  `II1R10C1` bigint(9) DEFAULT NULL,
  `II1R10C2` bigint(9) DEFAULT NULL,
  `II2R1C1` bigint(9) DEFAULT NULL,
  `II3R1C1` bigint(9) DEFAULT NULL,
  `II3R1C2` bigint(9) DEFAULT NULL,
  `OBSERVACIONES` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_iii`
--

CREATE TABLE `capitulo_iii` (
  `C3_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `III1R1C1` bigint(9) DEFAULT NULL,
  `III1R1C2` bigint(9) DEFAULT NULL,
  `III1R2C1` bigint(9) DEFAULT NULL,
  `III1R2C2` bigint(9) DEFAULT NULL,
  `III1R3C1` bigint(9) DEFAULT NULL,
  `III1R3C2` bigint(9) DEFAULT NULL,
  `III1R4C1` bigint(9) DEFAULT NULL,
  `III1R4C2` bigint(9) DEFAULT NULL,
  `III1R4C3` bigint(9) DEFAULT NULL,
  `III1R4C4` bigint(9) DEFAULT NULL,
  `III1R5C1` bigint(9) DEFAULT NULL,
  `III1R5C2` bigint(9) DEFAULT NULL,
  `III1R5C3` bigint(9) DEFAULT NULL,
  `III1R5C4` bigint(9) DEFAULT NULL,
  `III1R6C1` bigint(9) DEFAULT NULL,
  `III1R6C2` bigint(9) DEFAULT NULL,
  `III1R6C3` bigint(9) DEFAULT NULL,
  `III1R6C4` bigint(9) DEFAULT NULL,
  `III1R7C1` bigint(9) DEFAULT NULL,
  `III1R7C2` bigint(9) DEFAULT NULL,
  `III1R7C3` bigint(9) DEFAULT NULL,
  `III1R7C4` bigint(9) DEFAULT NULL,
  `III1R8C1` bigint(9) DEFAULT NULL,
  `III1R8C2` bigint(9) DEFAULT NULL,
  `III2R1C1` bigint(9) DEFAULT NULL,
  `III2R1C2` bigint(9) DEFAULT NULL,
  `III2R2C1` bigint(9) DEFAULT NULL,
  `III2R2C2` bigint(9) DEFAULT NULL,
  `III2R3C1` bigint(9) DEFAULT NULL,
  `III2R3C2` bigint(9) DEFAULT NULL,
  `III2R4C1` bigint(9) DEFAULT NULL,
  `III2R4C2` bigint(9) DEFAULT NULL,
  `III2R5C1` bigint(9) DEFAULT NULL,
  `III2R5C2` bigint(9) DEFAULT NULL,
  `III2R6C1` bigint(9) DEFAULT NULL,
  `III2R6C2` bigint(9) DEFAULT NULL,
  `III2R7C1` bigint(9) DEFAULT NULL,
  `III2R7C2` bigint(9) DEFAULT NULL,
  `III2R8C1` bigint(9) DEFAULT NULL,
  `III2R8C2` bigint(9) DEFAULT NULL,
  `III2R9C1` bigint(9) DEFAULT NULL,
  `III2R9C2` bigint(9) DEFAULT NULL,
  `III2R10C1` bigint(9) DEFAULT NULL,
  `III2R10C2` bigint(9) DEFAULT NULL,
  `III3R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `III4R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `III4R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `III4R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `III4R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `III4R5C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `III4R6C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `III5R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `III6R1C1` tinyint(1) DEFAULT NULL,
  `III6R1C2` tinyint(1) DEFAULT NULL,
  `III6R2C1` tinyint(1) DEFAULT NULL,
  `III6R2C2` tinyint(1) DEFAULT NULL,
  `III6R3C1` tinyint(1) DEFAULT NULL,
  `III6R3C2` tinyint(1) DEFAULT NULL,
  `III6R4C1` tinyint(1) DEFAULT NULL,
  `III6R4C2` tinyint(1) DEFAULT NULL,
  `III6R5C1` tinyint(1) DEFAULT NULL,
  `III6R5C2` tinyint(1) DEFAULT NULL,
  `III6R6C1` tinyint(1) DEFAULT NULL,
  `III6R6C2` tinyint(1) DEFAULT NULL,
  `III6R7C1` tinyint(1) DEFAULT NULL,
  `III6R7C2` tinyint(1) DEFAULT NULL,
  `III6R8C1` tinyint(1) DEFAULT NULL,
  `III6R8C2` tinyint(1) DEFAULT NULL,
  `OBSERVACIONES` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_iv`
--

CREATE TABLE `capitulo_iv` (
  `C4_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `IV1R1C1` bigint(5) DEFAULT NULL,
  `IV1R1C2` bigint(5) DEFAULT NULL,
  `IV1R1C3` bigint(5) DEFAULT NULL,
  `IV1R1C4` bigint(5) DEFAULT NULL,
  `IV1R2C1` bigint(5) DEFAULT NULL,
  `IV1R2C2` bigint(5) DEFAULT NULL,
  `IV1R2C3` bigint(5) DEFAULT NULL,
  `IV1R2C4` bigint(5) DEFAULT NULL,
  `IV1R3C1` bigint(5) DEFAULT NULL,
  `IV1R3C2` bigint(5) DEFAULT NULL,
  `IV1R3C3` bigint(5) DEFAULT NULL,
  `IV1R3C4` bigint(5) DEFAULT NULL,
  `IV1R4C1` bigint(5) DEFAULT NULL,
  `IV1R4C2` bigint(5) DEFAULT NULL,
  `IV1R4C3` bigint(5) DEFAULT NULL,
  `IV1R4C4` bigint(5) DEFAULT NULL,
  `IV1R5C1` bigint(5) DEFAULT NULL,
  `IV1R5C2` bigint(5) DEFAULT NULL,
  `IV1R5C3` bigint(5) DEFAULT NULL,
  `IV1R5C4` bigint(5) DEFAULT NULL,
  `IV1R6C1` bigint(5) DEFAULT NULL,
  `IV1R6C2` bigint(5) DEFAULT NULL,
  `IV1R6C3` bigint(5) DEFAULT NULL,
  `IV1R6C4` bigint(5) DEFAULT NULL,
  `IV1R7C1` bigint(5) DEFAULT NULL,
  `IV1R7C2` bigint(5) DEFAULT NULL,
  `IV1R7C3` bigint(5) DEFAULT NULL,
  `IV1R7C4` bigint(5) DEFAULT NULL,
  `IV1R8C1` bigint(5) DEFAULT NULL,
  `IV1R8C2` bigint(5) DEFAULT NULL,
  `IV1R8C3` bigint(5) DEFAULT NULL,
  `IV1R8C4` bigint(5) DEFAULT NULL,
  `IV1R9C1` bigint(5) DEFAULT NULL,
  `IV1R9C2` bigint(5) DEFAULT NULL,
  `IV1R9C3` bigint(5) DEFAULT NULL,
  `IV1R9C4` bigint(5) DEFAULT NULL,
  `IV1R10C1` bigint(5) DEFAULT NULL,
  `IV1R10C2` bigint(5) DEFAULT NULL,
  `IV1R10C3` bigint(5) DEFAULT NULL,
  `IV1R10C4` bigint(5) DEFAULT NULL,
  `IV1R11C1` bigint(5) DEFAULT NULL,
  `IV1R11C2` bigint(5) DEFAULT NULL,
  `IV1R11C3` bigint(5) DEFAULT NULL,
  `IV1R11C4` bigint(5) DEFAULT NULL,
  `IV2R1C1` bigint(5) DEFAULT NULL,
  `IV2R1C2` bigint(5) DEFAULT NULL,
  `IV2R2C1` bigint(5) DEFAULT NULL,
  `IV2R2C2` bigint(5) DEFAULT NULL,
  `IV2R3C1` bigint(5) DEFAULT NULL,
  `IV2R3C2` bigint(5) DEFAULT NULL,
  `IV2R4C1` bigint(5) DEFAULT NULL,
  `IV2R4C2` bigint(5) DEFAULT NULL,
  `IV2R5C1` bigint(5) DEFAULT NULL,
  `IV2R5C2` bigint(5) DEFAULT NULL,
  `IV2R6C1` bigint(5) DEFAULT NULL,
  `IV2R6C2` bigint(5) DEFAULT NULL,
  `IV2R7C1` bigint(5) DEFAULT NULL,
  `IV2R7C2` bigint(5) DEFAULT NULL,
  `IV2R8C1` bigint(5) DEFAULT NULL,
  `IV2R8C2` bigint(5) DEFAULT NULL,
  `IV2R9C1` bigint(5) DEFAULT NULL,
  `IV2R9C2` bigint(5) DEFAULT NULL,
  `IV2R10C1` bigint(5) DEFAULT NULL,
  `IV2R10C2` bigint(5) DEFAULT NULL,
  `IV2R11C1` bigint(5) DEFAULT NULL,
  `IV2R11C2` bigint(5) DEFAULT NULL,
  `IV2R12C1` bigint(5) DEFAULT NULL,
  `IV2R12C2` bigint(5) DEFAULT NULL,
  `IV2R13C1` bigint(5) DEFAULT NULL,
  `IV2R13C2` bigint(5) DEFAULT NULL,
  `IV2R14C1` bigint(5) DEFAULT NULL,
  `IV2R14C2` bigint(5) DEFAULT NULL,
  `IV2R15C1` bigint(5) DEFAULT NULL,
  `IV2R15C2` bigint(5) DEFAULT NULL,
  `IV2R16C1` bigint(5) DEFAULT NULL,
  `IV2R16C2` bigint(5) DEFAULT NULL,
  `IV2R17C1` bigint(5) DEFAULT NULL,
  `IV2R17C2` bigint(5) DEFAULT NULL,
  `IV2R18C1` bigint(5) DEFAULT NULL,
  `IV2R18C2` bigint(5) DEFAULT NULL,
  `IV2R19C1` bigint(5) DEFAULT NULL,
  `IV2R19C2` bigint(5) DEFAULT NULL,
  `IV2R20C1` bigint(5) DEFAULT NULL,
  `IV2R20C2` bigint(5) DEFAULT NULL,
  `IV2R21C1` bigint(5) DEFAULT NULL,
  `IV2R21C2` bigint(5) DEFAULT NULL,
  `IV2R22C1` bigint(5) DEFAULT NULL,
  `IV2R22C2` bigint(5) DEFAULT NULL,
  `IV2R23C1` bigint(5) DEFAULT NULL,
  `IV2R23C2` bigint(5) DEFAULT NULL,
  `IV2R24C1` bigint(5) DEFAULT NULL,
  `IV2R24C2` bigint(5) DEFAULT NULL,
  `IV2R25C1` bigint(5) DEFAULT NULL,
  `IV2R25C2` bigint(5) DEFAULT NULL,
  `IV2R26C1` bigint(5) DEFAULT NULL,
  `IV2R26C2` bigint(5) DEFAULT NULL,
  `IV2R27C1` bigint(5) DEFAULT NULL,
  `IV2R27C2` bigint(5) DEFAULT NULL,
  `IV2R28C1` bigint(5) DEFAULT NULL,
  `IV2R28C2` bigint(5) DEFAULT NULL,
  `IV2R29C1` bigint(5) DEFAULT NULL,
  `IV2R29C2` bigint(5) DEFAULT NULL,
  `IV2R30C1` bigint(5) DEFAULT NULL,
  `IV2R30C2` bigint(5) DEFAULT NULL,
  `IV2R31C1` bigint(5) DEFAULT NULL,
  `IV2R31C2` bigint(5) DEFAULT NULL,
  `IV2R32C1` bigint(5) DEFAULT NULL,
  `IV2R32C2` bigint(5) DEFAULT NULL,
  `IV2R33C1` bigint(5) DEFAULT NULL,
  `IV2R33C2` bigint(5) DEFAULT NULL,
  `IV2R34C1` bigint(5) DEFAULT NULL,
  `IV2R34C2` bigint(5) DEFAULT NULL,
  `IV3R1C1` bigint(5) DEFAULT NULL,
  `IV3R1C2` bigint(5) DEFAULT NULL,
  `IV4R1C1` bigint(5) DEFAULT NULL,
  `IV4R1C2` bigint(5) DEFAULT NULL,
  `IV4R1C3` bigint(5) DEFAULT NULL,
  `IV4R2C1` bigint(5) DEFAULT NULL,
  `IV4R2C2` bigint(5) DEFAULT NULL,
  `IV4R2C3` bigint(5) DEFAULT NULL,
  `IV4R3C1` bigint(5) DEFAULT NULL,
  `IV4R3C2` bigint(5) DEFAULT NULL,
  `IV4R3C3` bigint(5) DEFAULT NULL,
  `IV4R4C1` bigint(5) DEFAULT NULL,
  `IV4R4C2` bigint(5) DEFAULT NULL,
  `IV4R4C3` bigint(5) DEFAULT NULL,
  `IV4R5C1` bigint(5) DEFAULT NULL,
  `IV4R5C2` bigint(5) DEFAULT NULL,
  `IV4R5C3` bigint(5) DEFAULT NULL,
  `IV4R6C1` bigint(5) DEFAULT NULL,
  `IV4R6C2` bigint(5) DEFAULT NULL,
  `IV4R6C3` bigint(5) DEFAULT NULL,
  `IV4R7C1` bigint(5) DEFAULT NULL,
  `IV4R7C2` bigint(5) DEFAULT NULL,
  `IV4R7C3` bigint(5) DEFAULT NULL,
  `IV4R8C1` bigint(5) DEFAULT NULL,
  `IV4R8C2` bigint(5) DEFAULT NULL,
  `IV4R8C3` bigint(5) DEFAULT NULL,
  `IV4R9C1` bigint(5) DEFAULT NULL,
  `IV4R9C2` bigint(5) DEFAULT NULL,
  `IV4R9C3` bigint(5) DEFAULT NULL,
  `IV4R10C1` bigint(5) DEFAULT NULL,
  `IV4R10C2` bigint(5) DEFAULT NULL,
  `IV4R10C3` bigint(5) DEFAULT NULL,
  `IV4R11C1` bigint(5) DEFAULT NULL,
  `IV4R11C2` bigint(5) DEFAULT NULL,
  `IV4R11C3` bigint(5) DEFAULT NULL,
  `IV5R1C1` bigint(5) DEFAULT NULL,
  `IV5R1C2` bigint(5) DEFAULT NULL,
  `IV5R1C3` bigint(5) DEFAULT NULL,
  `IV6R1C1` bigint(5) DEFAULT NULL,
  `IV6R1C2` bigint(5) DEFAULT NULL,
  `IV6R1C3` bigint(5) DEFAULT NULL,
  `IV6R2C1` bigint(5) DEFAULT NULL,
  `IV6R2C2` bigint(5) DEFAULT NULL,
  `IV6R2C3` bigint(5) DEFAULT NULL,
  `IV6R3C1` bigint(5) DEFAULT NULL,
  `IV6R3C2` bigint(5) DEFAULT NULL,
  `IV6R3C3` bigint(5) DEFAULT NULL,
  `IV6R4C1` bigint(5) DEFAULT NULL,
  `IV6R4C2` bigint(5) DEFAULT NULL,
  `IV6R4C3` bigint(5) DEFAULT NULL,
  `IV6R5C1` bigint(5) DEFAULT NULL,
  `IV6R5C2` bigint(5) DEFAULT NULL,
  `IV6R5C3` bigint(5) DEFAULT NULL,
  `IV6R6C1` bigint(5) DEFAULT NULL,
  `IV6R6C2` bigint(5) DEFAULT NULL,
  `IV6R6C3` bigint(5) DEFAULT NULL,
  `IV6R7C1` bigint(5) DEFAULT NULL,
  `IV6R7C2` bigint(5) DEFAULT NULL,
  `IV6R7C3` bigint(5) DEFAULT NULL,
  `IV6R8C1` bigint(5) DEFAULT NULL,
  `IV6R8C2` bigint(5) DEFAULT NULL,
  `IV6R8C3` bigint(5) DEFAULT NULL,
  `IV7R1C1` bigint(5) DEFAULT NULL,
  `IV7R1C2` bigint(5) DEFAULT NULL,
  `IV7R2C1` bigint(5) DEFAULT NULL,
  `IV7R2C2` bigint(5) DEFAULT NULL,
  `IV7R3C1` bigint(5) DEFAULT NULL,
  `IV7R3C2` bigint(5) DEFAULT NULL,
  `IV7R4C1` bigint(5) DEFAULT NULL,
  `IV7R4C2` bigint(5) DEFAULT NULL,
  `IV7R5C1` bigint(5) DEFAULT NULL,
  `IV7R5C2` bigint(5) DEFAULT NULL,
  `OBSERVACIONES` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_v`
--

CREATE TABLE `capitulo_v` (
  `C5_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `V1R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R5C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R6C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R7C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R8C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R9C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R9C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R9C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R10C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R10C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R10C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R11C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R11C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R11C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R12C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R12C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R12C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R13C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R13C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R13C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R14C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R14C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R14C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R15C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R15C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R15C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R16C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R16C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R16C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R17C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R17C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R17C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R18C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R18C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R18C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R19C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R19C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R19C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R20C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R20C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R20C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R21C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R21C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R21C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R22C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R22C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R22C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R23C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R23C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R23C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R24C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R24C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R24C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R25C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R25C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R25C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R26C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R26C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R26C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R27C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R27C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R27C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R28C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R28C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R28C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R29C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R29C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R29C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R30C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R30C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R30C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R31C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R31C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R31C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R32C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R32C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V1R32C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R5C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R6C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R7C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R8C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R9C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R10C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R11C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R12C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R13C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R14C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R15C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R16C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R17C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R18C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V2R19C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R1C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R2C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R3C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R4C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R5C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R6C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R7C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R8C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R9C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R10C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R11C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C2` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C3` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C4` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C5` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C6` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C7` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C8` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C9` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C10` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `V3R12C11` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `OBSERVACIONES` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_vi`
--

CREATE TABLE `capitulo_vi` (
  `C6_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `VI1R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI1R1C2` bigint(4) DEFAULT NULL,
  `VI1R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI1R2C2` bigint(4) DEFAULT NULL,
  `VI1R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI1R3C2` bigint(6) DEFAULT NULL,
  `VI1R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI1R4C2` bigint(4) DEFAULT NULL,
  `VI1R5C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI1R5C2` bigint(4) DEFAULT NULL,
  `VI1R6C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI1R6C2` bigint(4) DEFAULT NULL,
  `VI1R7C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI1R7C2` bigint(4) DEFAULT NULL,
  `VI1R8C2` bigint(8) DEFAULT NULL,
  `VI2R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI2R1C2` bigint(4) DEFAULT NULL,
  `VI2R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI2R2C2` bigint(4) DEFAULT NULL,
  `VI2R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI2R3C2` bigint(6) DEFAULT NULL,
  `VI2R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI2R4C2` bigint(4) DEFAULT NULL,
  `VI2R5C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI2R5C2` bigint(4) DEFAULT NULL,
  `VI2R6C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI2R6C2` bigint(4) DEFAULT NULL,
  `VI2R7C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI2R7C2` bigint(4) DEFAULT NULL,
  `VI2R8C2` bigint(4) DEFAULT NULL,
  `VI3R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI3R1C2` mediumint(5) DEFAULT NULL,
  `VI3R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI3R2C2` mediumint(5) DEFAULT NULL,
  `VI3R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI3R3C2` mediumint(5) DEFAULT NULL,
  `VI3R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI3R4C2` mediumint(5) DEFAULT NULL,
  `VI3R5C2` mediumtext COLLATE latin1_spanish_ci,
  `VI4R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI5R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI5R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI5R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI5R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI5R5C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI5R6C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI5R7C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI6R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI6R1C2` mediumint(5) DEFAULT NULL,
  `VI7R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI7R1C2` mediumtext COLLATE latin1_spanish_ci,
  `VI8R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI9R1C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI9R2C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI9R3C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI9R4C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI9R5C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI9R6C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `VI9R7C1` varchar(1) COLLATE latin1_spanish_ci DEFAULT NULL,
  `OBSERVACIONES` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_vii`
--

CREATE TABLE `capitulo_vii` (
  `C7_nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `VIIR1C1` tinyint(1) DEFAULT NULL,
  `VIIR1C2` bigint(3) DEFAULT NULL,
  `VIIR2C1` time DEFAULT NULL,
  `VIIR3C1` tinyint(1) DEFAULT NULL,
  `VIIR4C1` tinyint(1) DEFAULT NULL,
  `VIIR5C1` tinyint(1) DEFAULT NULL,
  `VIIR6C1` tinyint(1) DEFAULT NULL,
  `VIIR6C2` tinyint(1) DEFAULT NULL,
  `VIIR6C3` tinyint(1) DEFAULT NULL,
  `VIIR6C4` tinyint(1) DEFAULT NULL,
  `VIIR6C5` tinyint(1) DEFAULT NULL,
  `VIIR6C6` tinyint(1) DEFAULT NULL,
  `VIIR6C7` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caratula`
--

CREATE TABLE `caratula` (
  `nordemp` bigint(10) UNSIGNED NOT NULL,
  `regional` tinyint(2) UNSIGNED NOT NULL,
  `prioridad` tinyint(1) UNSIGNED NOT NULL,
  `tipodoc` tinyint(1) UNSIGNED NOT NULL,
  `numdoc` bigint(12) UNSIGNED NOT NULL,
  `dv` tinyint(1) UNSIGNED NOT NULL,
  `registmat` tinyint(1) UNSIGNED NOT NULL,
  `camara` mediumint(8) UNSIGNED NOT NULL,
  `numeroreg` char(14) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nompropie` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `sigla` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `depto` tinyint(2) UNSIGNED NOT NULL,
  `mpio` mediumint(3) UNSIGNED NOT NULL,
  `telefono` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `aa` mediumint(6) UNSIGNED NOT NULL,
  `fax` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `orgju` char(7) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `dirnotifi` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `depnotific` tinyint(2) UNSIGNED NOT NULL,
  `munnotific` mediumint(3) UNSIGNED NOT NULL,
  `telenotific` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `faxnotific` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `aanotifica` mediumint(6) UNSIGNED NOT NULL,
  `capsocin` tinyint(3) UNSIGNED NOT NULL,
  `capsocinpu` tinyint(3) UNSIGNED NOT NULL,
  `capsocinpr` tinyint(3) UNSIGNED NOT NULL,
  `capsocie` tinyint(3) UNSIGNED NOT NULL,
  `capsociepu` tinyint(3) UNSIGNED NOT NULL,
  `capsociepr` tinyint(3) UNSIGNED NOT NULL,
  `estagrop` tinyint(3) UNSIGNED NOT NULL,
  `estminero` tinyint(3) UNSIGNED NOT NULL,
  `estservpub` tinyint(3) UNSIGNED NOT NULL,
  `estconst` tinyint(3) UNSIGNED NOT NULL,
  `estreshot` tinyint(3) UNSIGNED NOT NULL,
  `esttrans` tinyint(3) UNSIGNED NOT NULL,
  `estcomunic` tinyint(3) UNSIGNED NOT NULL,
  `estfinanc` tinyint(3) UNSIGNED NOT NULL,
  `estservcom` tinyint(3) UNSIGNED NOT NULL,
  `estind` tinyint(3) UNSIGNED NOT NULL,
  `estcom` tinyint(3) UNSIGNED NOT NULL,
  `estser` tinyint(3) UNSIGNED NOT NULL,
  `uniaux` tinyint(3) UNSIGNED NOT NULL,
  `otrose` tinyint(3) UNSIGNED NOT NULL,
  `actie` mediumint(5) UNSIGNED NOT NULL,
  `actic` mediumint(5) UNSIGNED NOT NULL,
  `ciiu3` mediumint(4) UNSIGNED NOT NULL,
  `fechaconst` date NOT NULL,
  `fechahasta` date NOT NULL,
  `repleg` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `responde` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `teler` bigint(12) UNSIGNED NOT NULL,
  `estadoact` char(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `otro` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `emailemp` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `web` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `emailnotif` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `webnotif` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `emailres` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'email de la persona que diligencia el formulario',
  `lgg` char(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estcart` tinyint(1) NOT NULL,
  `correlativa` mediumint(7) NOT NULL,
  `envcorr` tinyint(4) NOT NULL,
  `vericorr` tinyint(4) NOT NULL,
  `fec_correo` datetime NOT NULL,
  `activa` tinyint(1) NOT NULL COMMENT 'Indica si la empresa esta activa (1) o inactiva (2)',
  `fechadist` date DEFAULT NULL,
  `novedad` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos`
--

CREATE TABLE `casos` (
  `caso` int(11) NOT NULL COMMENT 'Secuencial casos',
  `condicion` longtext COLLATE utf8_spanish_ci NOT NULL COMMENT 'formula',
  `descripcion` longtext COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion caso'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciiu3`
--

CREATE TABLE `ciiu3` (
  `CODIGO` mediumint(4) NOT NULL DEFAULT '0',
  `DESCRIP` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

CREATE TABLE `control` (
  `nordemp` bigint(10) UNSIGNED NOT NULL,
  `vigencia` mediumint(4) UNSIGNED NOT NULL,
  `estado` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `usuario` char(8) COLLATE latin1_spanish_ci NOT NULL,
  `usuariodt` char(8) COLLATE latin1_spanish_ci NOT NULL,
  `usuarioss` char(8) COLLATE latin1_spanish_ci NOT NULL,
  `ciiu3` mediumint(4) NOT NULL DEFAULT '0',
  `m1` tinyint(1) NOT NULL DEFAULT '0',
  `m2` tinyint(1) NOT NULL DEFAULT '0',
  `m3` tinyint(1) NOT NULL DEFAULT '0',
  `m4` tinyint(1) NOT NULL DEFAULT '0',
  `m5` tinyint(1) NOT NULL DEFAULT '0',
  `m6` tinyint(1) NOT NULL DEFAULT '0',
  `m7` tinyint(1) NOT NULL DEFAULT '0',
  `rese` tinyint(1) NOT NULL DEFAULT '0',
  `prioridad` tinyint(1) NOT NULL DEFAULT '0',
  `novedad` tinyint(2) NOT NULL DEFAULT '0',
  `codsede` tinyint(2) NOT NULL DEFAULT '0',
  `fecdist` date NOT NULL,
  `fecdig` date NOT NULL,
  `fecrev` date NOT NULL,
  `fecacept` date NOT NULL,
  `aceptadc` date NOT NULL COMMENT 'Fecha acepta DANE central',
  `prio2` tinyint(1) NOT NULL DEFAULT '0',
  `acceso` char(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Indica a que rol se le permite acceso a modificación (FU(fuente), CR(crítico), DC(dane central))'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `vigencia` mediumint(4) NOT NULL DEFAULT '0' COMMENT 'Periodo Devolución',
  `nordemp` bigint(10) NOT NULL DEFAULT '0' COMMENT 'Numero empresa',
  `observa` longtext CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Observación de la devolución',
  `codsede` int(2) NOT NULL DEFAULT '0' COMMENT 'Sede fuente',
  `tipo` char(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT '(DV)-Devuelto (RV)-Reenviado',
  `coddev` char(7) COLLATE latin1_bin NOT NULL COMMENT 'Quien devuelve el formulario',
  `codcrit` char(8) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Código de crítico',
  `fecha` date NOT NULL COMMENT 'Fecha Devolución/Reenvio'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divipola`
--

CREATE TABLE `divipola` (
  `dpto` tinyint(2) UNSIGNED NOT NULL,
  `muni` mediumint(3) UNSIGNED NOT NULL,
  `ndpto` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `nmuni` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edit_eam`
--

CREATE TABLE `edit_eam` (
  `nordemp` mediumint(7) NOT NULL DEFAULT '0' COMMENT 'Numero de orden',
  `novedad` mediumint(2) NOT NULL DEFAULT '0' COMMENT 'novedad',
  `pertotal` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Personal Total',
  `peraux` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Personal unidades auxiliares',
  `prodbruta` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Producción bruta',
  `prodind` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Producción industrial',
  `totvtas` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Total ventas',
  `vtaspais` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Ventas en el país',
  `vtasext` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Ventas en el exterior',
  `otrosing` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Otros Ingresos',
  `oingvtas` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Otros Ing. vtas MP.....',
  `maqeq` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Maquinaria y equipo',
  `eqinfo` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Equipo de informática y telecomunicación',
  `pertot2009` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Personal total 2009',
  `pertot2010` bigint(13) NOT NULL DEFAULT '0' COMMENT 'Personal total 2010',
  `enmarcha` char(2) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Proyectos en marcha',
  `desc_novedad` char(80) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripción novedad'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Comparación EAMvsEDIT';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edit_eas`
--

CREATE TABLE `edit_eas` (
  `nordemp` bigint(10) NOT NULL,
  `novedad` int(2) NOT NULL COMMENT 'NOvedad Anuales',
  `personal` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Personal Abuales',
  `ingresos` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Ingresos Anuales',
  `otrosing` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Otros ingresos anuales',
  `maqyeq` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Maq. y Eq. Anuales',
  `eqinf` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Eq. Info. Anuales',
  `software` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Software Anuales',
  `pertot_edit_a1` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Personal Edit P. anterior',
  `pertot_edit_a2` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Personal Edit P. anterior',
  `vtas_edit_a1` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Vtas Edit P. Anterior',
  `pertot_edit_i1` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Personal Industria P. Anterior',
  `pertot_edit_i2` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Personal Industria P. Anterior',
  `vtas_edit_i1` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Vtas Edit Industria P. Anterior',
  `enmarcha` char(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL COMMENT 'Proyectos en marcha',
  `novant` int(2) NOT NULL COMMENT 'Novedad EDIT Anterior',
  `dirbase` char(10) NOT NULL COMMENT 'INvestigacióm'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoact`
--

CREATE TABLE `estadoact` (
  `codigo` char(2) COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(80) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idestados` tinyint(2) UNSIGNED NOT NULL,
  `desc_estado` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechaacepta`
--

CREATE TABLE `fechaacepta` (
  `nordemp` bigint(9) NOT NULL,
  `acepta` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechadig`
--

CREATE TABLE `fechadig` (
  `nordemp` bigint(9) NOT NULL,
  `digita` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecharev`
--

CREATE TABLE `fecharev` (
  `nordemp` bigint(9) NOT NULL,
  `revision` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoja_casos`
--

CREATE TABLE `hoja_casos` (
  `nordemp` bigint(12) NOT NULL DEFAULT '0' COMMENT 'Numero de Orden',
  `C1` tinyint(1) DEFAULT NULL COMMENT 'Caso 1',
  `C2` tinyint(1) DEFAULT NULL COMMENT 'Caso 2',
  `C3` tinyint(1) DEFAULT NULL COMMENT 'Caso 3',
  `C4` tinyint(1) DEFAULT NULL COMMENT 'Caso 4',
  `C5` tinyint(1) DEFAULT NULL COMMENT 'Caso 5',
  `C6` tinyint(1) DEFAULT NULL COMMENT 'Caso 6',
  `C7` tinyint(1) DEFAULT NULL COMMENT 'Caso 7',
  `C8` tinyint(1) DEFAULT NULL COMMENT 'Caso 8',
  `C9` tinyint(1) DEFAULT NULL COMMENT 'Caso 9',
  `C10` tinyint(1) DEFAULT NULL COMMENT 'Caso 10',
  `C11` tinyint(1) DEFAULT NULL COMMENT 'Caso 11',
  `C12` tinyint(1) DEFAULT NULL COMMENT 'Caso 12',
  `C13` tinyint(1) DEFAULT NULL COMMENT 'Caso 13',
  `C14` tinyint(1) DEFAULT NULL COMMENT 'Caso 14',
  `C15` tinyint(1) DEFAULT NULL COMMENT 'Caso 15',
  `C16` tinyint(1) DEFAULT NULL COMMENT 'Caso 16',
  `C17` tinyint(1) DEFAULT NULL COMMENT 'Caso 17',
  `C18` tinyint(1) DEFAULT NULL COMMENT 'Caso 18',
  `C19` tinyint(1) DEFAULT NULL COMMENT 'Caso 19',
  `C20` tinyint(1) DEFAULT NULL COMMENT 'Caso 20',
  `C21` tinyint(1) DEFAULT NULL COMMENT 'Caso 21',
  `C22` tinyint(1) DEFAULT NULL COMMENT 'Caso 22',
  `C23` tinyint(1) DEFAULT NULL COMMENT 'Caso 23',
  `C24` tinyint(1) DEFAULT NULL COMMENT 'Caso 24',
  `C25` tinyint(1) DEFAULT NULL COMMENT 'Caso 25',
  `C26` tinyint(1) DEFAULT NULL COMMENT 'Caso 26',
  `C27` tinyint(1) DEFAULT NULL COMMENT 'Caso 27',
  `C28` tinyint(1) DEFAULT NULL COMMENT 'Caso 28',
  `C29` tinyint(1) DEFAULT NULL COMMENT 'Caso 29',
  `C30` tinyint(1) DEFAULT NULL COMMENT 'Caso 30',
  `C31` tinyint(1) DEFAULT NULL COMMENT 'Caso 31',
  `C32` tinyint(1) DEFAULT NULL COMMENT 'Caso 32',
  `C33` tinyint(1) DEFAULT NULL COMMENT 'Caso 33',
  `C34` tinyint(1) DEFAULT NULL COMMENT 'Caso 34',
  `C35` tinyint(1) DEFAULT NULL COMMENT 'Caso 35',
  `C36` tinyint(1) DEFAULT NULL COMMENT 'Caso 36',
  `C37` tinyint(1) DEFAULT NULL COMMENT 'Caso 37',
  `C38` tinyint(1) DEFAULT NULL COMMENT 'Caso 38',
  `C39` tinyint(1) DEFAULT NULL COMMENT 'Caso 39',
  `C40` tinyint(1) DEFAULT NULL COMMENT 'Caso 40',
  `C41` tinyint(1) DEFAULT NULL COMMENT 'Caso 41',
  `C42` tinyint(1) DEFAULT NULL COMMENT 'Caso 42',
  `C43` tinyint(1) DEFAULT NULL COMMENT 'Caso 43',
  `C44` tinyint(1) DEFAULT NULL COMMENT 'Caso 44',
  `C45` tinyint(1) DEFAULT NULL COMMENT 'Caso 45',
  `C46` tinyint(1) DEFAULT NULL COMMENT 'Caso 46',
  `C47` tinyint(1) DEFAULT NULL COMMENT 'Caso 47',
  `C48` tinyint(1) DEFAULT NULL COMMENT 'Caso 48',
  `C49` tinyint(1) DEFAULT NULL COMMENT 'Caso 49',
  `C50` tinyint(1) DEFAULT NULL COMMENT 'Caso 50',
  `C51` tinyint(1) DEFAULT NULL COMMENT 'Caso 51',
  `C52` tinyint(1) DEFAULT NULL COMMENT 'Caso 52',
  `C53` tinyint(1) DEFAULT NULL COMMENT 'Caso 53',
  `C54` tinyint(1) DEFAULT NULL COMMENT 'Caso 54',
  `C55` tinyint(1) DEFAULT NULL COMMENT 'Caso 55',
  `C56` tinyint(1) DEFAULT NULL COMMENT 'Caso 56',
  `C57` tinyint(1) DEFAULT NULL COMMENT 'Caso 57',
  `C58` tinyint(1) DEFAULT NULL COMMENT 'Caso 58',
  `C59` tinyint(1) DEFAULT NULL COMMENT 'Caso 59',
  `C60` tinyint(1) DEFAULT NULL COMMENT 'Caso 60',
  `C61` tinyint(1) DEFAULT NULL COMMENT 'Caso 61',
  `C62` tinyint(1) DEFAULT NULL COMMENT 'Caso 62',
  `C63` tinyint(1) DEFAULT NULL COMMENT 'Caso 63',
  `C64` tinyint(1) DEFAULT NULL COMMENT 'Caso 64',
  `C65` tinyint(1) DEFAULT NULL COMMENT 'Caso 65',
  `C66` tinyint(1) DEFAULT NULL COMMENT 'Caso 66',
  `C67` tinyint(1) DEFAULT NULL COMMENT 'Caso 67',
  `C68` tinyint(1) DEFAULT NULL COMMENT 'Caso 68',
  `C69` tinyint(1) DEFAULT NULL COMMENT 'Caso 69',
  `C70` tinyint(1) DEFAULT NULL COMMENT 'Caso 70',
  `C71` tinyint(1) DEFAULT NULL COMMENT 'Caso 71',
  `C72` tinyint(1) DEFAULT NULL COMMENT 'Caso 72',
  `C73` tinyint(1) DEFAULT NULL COMMENT 'Caso 73',
  `C74` tinyint(1) DEFAULT NULL COMMENT 'Caso 74',
  `C75` tinyint(1) DEFAULT NULL COMMENT 'Caso 75',
  `C76` tinyint(1) DEFAULT NULL COMMENT 'Caso 76',
  `C77` tinyint(1) DEFAULT NULL COMMENT 'Caso 77',
  `C78` tinyint(1) DEFAULT NULL COMMENT 'Caso 78',
  `C79` tinyint(1) DEFAULT NULL COMMENT 'Caso 79',
  `C80` tinyint(1) DEFAULT NULL COMMENT 'Caso 80',
  `C81` tinyint(1) DEFAULT NULL COMMENT 'Caso 81',
  `C82` tinyint(1) DEFAULT NULL COMMENT 'Caso 82',
  `C83` tinyint(1) DEFAULT NULL COMMENT 'Caso 83',
  `C84` tinyint(1) DEFAULT NULL COMMENT 'Caso 84',
  `C85` tinyint(1) DEFAULT NULL COMMENT 'Caso 85',
  `C86` tinyint(1) DEFAULT NULL COMMENT 'Caso 86',
  `C87` tinyint(1) DEFAULT NULL COMMENT 'Caso 87',
  `C88` tinyint(1) DEFAULT NULL COMMENT 'Caso 88',
  `C89` tinyint(1) DEFAULT NULL COMMENT 'Caso 89',
  `C90` tinyint(1) DEFAULT NULL COMMENT 'Caso 90',
  `C91` tinyint(1) DEFAULT NULL COMMENT 'Caso 91',
  `C92` tinyint(1) DEFAULT NULL COMMENT 'Caso 92',
  `C93` tinyint(1) DEFAULT NULL COMMENT 'Caso 93',
  `C94` tinyint(1) DEFAULT NULL COMMENT 'Caso 94',
  `C95` tinyint(1) DEFAULT NULL COMMENT 'Caso 95',
  `C96` tinyint(1) DEFAULT NULL COMMENT 'Caso 96',
  `C97` tinyint(1) DEFAULT NULL COMMENT 'Caso 97',
  `C98` tinyint(1) DEFAULT NULL COMMENT 'Caso 98',
  `C99` tinyint(1) DEFAULT NULL COMMENT 'Caso 99',
  `C100` tinyint(1) DEFAULT NULL COMMENT 'Caso 100',
  `C101` tinyint(1) DEFAULT NULL COMMENT 'Caso 101',
  `C102` tinyint(1) DEFAULT NULL COMMENT 'Caso 102',
  `C103` tinyint(1) DEFAULT NULL COMMENT 'Caso 103',
  `C104` tinyint(1) DEFAULT NULL COMMENT 'Caso 104',
  `C105` tinyint(1) DEFAULT NULL COMMENT 'Caso 105',
  `C106` tinyint(1) DEFAULT NULL COMMENT 'Caso 106',
  `C107` tinyint(1) DEFAULT NULL COMMENT 'Caso 107',
  `C108` tinyint(1) DEFAULT NULL COMMENT 'Caso 108',
  `C109` tinyint(1) DEFAULT NULL COMMENT 'Caso 109',
  `C110` tinyint(1) DEFAULT NULL COMMENT 'Caso 110',
  `C111` tinyint(1) DEFAULT NULL COMMENT 'Caso 111',
  `C112` tinyint(1) DEFAULT NULL COMMENT 'Caso 112',
  `C113` tinyint(1) DEFAULT NULL COMMENT 'Caso 113',
  `C114` tinyint(1) DEFAULT NULL COMMENT 'Caso 114',
  `C115` tinyint(1) DEFAULT NULL COMMENT 'Caso 115',
  `C116` tinyint(1) DEFAULT NULL COMMENT 'Caso 116',
  `C117` tinyint(1) DEFAULT NULL COMMENT 'Caso 117',
  `C118` tinyint(1) DEFAULT NULL COMMENT 'Caso 118',
  `C119` tinyint(1) DEFAULT NULL COMMENT 'Caso 119',
  `C120` tinyint(1) DEFAULT NULL COMMENT 'Caso 120',
  `C121` tinyint(1) DEFAULT NULL COMMENT 'Caso 121',
  `C122` tinyint(1) DEFAULT NULL COMMENT 'Caso 122',
  `C123` tinyint(1) DEFAULT NULL COMMENT 'Caso 123',
  `C124` tinyint(1) DEFAULT NULL COMMENT 'Caso 124',
  `C125` tinyint(1) DEFAULT NULL COMMENT 'Caso 125',
  `C126` tinyint(1) DEFAULT NULL COMMENT 'Caso 126',
  `C127` tinyint(1) DEFAULT NULL COMMENT 'Caso 127',
  `C128` tinyint(1) DEFAULT NULL COMMENT 'Caso 128',
  `C129` tinyint(1) DEFAULT NULL COMMENT 'Caso 129',
  `C130` tinyint(1) DEFAULT NULL COMMENT 'Caso 130',
  `C131` tinyint(1) DEFAULT NULL COMMENT 'Caso 131',
  `C132` tinyint(1) DEFAULT NULL COMMENT 'Caso 132',
  `C133` tinyint(1) DEFAULT NULL COMMENT 'Caso 133',
  `C134` tinyint(1) DEFAULT NULL COMMENT 'Caso 134',
  `C135` tinyint(1) DEFAULT NULL COMMENT 'Caso 135',
  `C136` tinyint(1) DEFAULT NULL COMMENT 'Caso 136',
  `C137` tinyint(1) DEFAULT NULL COMMENT 'Caso 137',
  `C138` tinyint(1) DEFAULT NULL COMMENT 'Caso 138',
  `C139` tinyint(1) DEFAULT NULL COMMENT 'Caso 139',
  `C140` tinyint(1) DEFAULT NULL COMMENT 'Caso 140',
  `C141` tinyint(1) DEFAULT NULL COMMENT 'Caso 141',
  `C142` tinyint(1) DEFAULT NULL COMMENT 'Caso 142',
  `C143` tinyint(1) DEFAULT NULL COMMENT 'Caso 143',
  `C144` tinyint(1) DEFAULT NULL COMMENT 'Caso 144',
  `C145` tinyint(1) DEFAULT NULL COMMENT 'Caso 145',
  `C146` tinyint(1) DEFAULT NULL COMMENT 'Caso 146',
  `C147` tinyint(1) DEFAULT NULL COMMENT 'Caso 147',
  `C148` tinyint(1) DEFAULT NULL COMMENT 'Caso 148',
  `C149` tinyint(1) DEFAULT NULL COMMENT 'Caso 149',
  `C150` tinyint(1) DEFAULT NULL COMMENT 'Caso 150',
  `C151` tinyint(1) DEFAULT NULL COMMENT 'Caso 151',
  `C152` tinyint(1) DEFAULT NULL COMMENT 'Caso 152',
  `C153` tinyint(1) DEFAULT NULL COMMENT 'Caso 153',
  `C154` tinyint(1) DEFAULT NULL COMMENT 'Caso 154',
  `C155` tinyint(1) DEFAULT NULL COMMENT 'Caso 155',
  `C156` tinyint(1) DEFAULT NULL COMMENT 'Caso 156',
  `C157` tinyint(1) DEFAULT NULL COMMENT 'Caso 157',
  `C158` tinyint(1) DEFAULT NULL COMMENT 'Caso 158',
  `C159` tinyint(1) DEFAULT NULL COMMENT 'Caso 159',
  `C160` tinyint(1) DEFAULT NULL COMMENT 'Caso 160',
  `C161` tinyint(1) DEFAULT NULL COMMENT 'Caso 161',
  `C162` tinyint(1) DEFAULT NULL COMMENT 'Caso 162',
  `C163` tinyint(1) DEFAULT NULL COMMENT 'Caso 163',
  `C164` tinyint(1) DEFAULT NULL COMMENT 'Caso 164',
  `C165` tinyint(1) DEFAULT NULL COMMENT 'Caso 165',
  `C166` tinyint(1) DEFAULT NULL COMMENT 'Caso 166',
  `C167` tinyint(1) DEFAULT NULL COMMENT 'Caso 167',
  `C168` tinyint(1) DEFAULT NULL COMMENT 'Caso 168',
  `C169` tinyint(1) DEFAULT NULL COMMENT 'Caso 169',
  `C170` tinyint(1) DEFAULT NULL COMMENT 'Caso 170',
  `C171` tinyint(1) DEFAULT NULL COMMENT 'Caso 171',
  `C172` tinyint(1) DEFAULT NULL COMMENT 'Caso 172',
  `C173` tinyint(1) DEFAULT NULL COMMENT 'Caso 173',
  `C174` tinyint(1) DEFAULT NULL COMMENT 'Caso 174',
  `C175` tinyint(1) DEFAULT NULL COMMENT 'Caso 175',
  `C176` tinyint(1) DEFAULT NULL COMMENT 'Caso 176',
  `C177` tinyint(1) DEFAULT NULL COMMENT 'Caso 177',
  `C178` tinyint(1) DEFAULT NULL COMMENT 'Caso 178',
  `C179` tinyint(1) DEFAULT NULL COMMENT 'Caso 179',
  `C180` tinyint(1) DEFAULT NULL COMMENT 'Caso 180',
  `C181` tinyint(1) DEFAULT NULL COMMENT 'Caso 181',
  `C182` tinyint(1) DEFAULT NULL COMMENT 'Caso 182',
  `C183` tinyint(1) DEFAULT NULL COMMENT 'Caso 183',
  `C184` tinyint(1) DEFAULT NULL COMMENT 'Caso 184',
  `C185` tinyint(1) DEFAULT NULL COMMENT 'Caso 185',
  `C186` tinyint(1) DEFAULT NULL COMMENT 'Caso 186',
  `C187` tinyint(1) DEFAULT NULL COMMENT 'Caso 187',
  `C188` tinyint(1) DEFAULT NULL COMMENT 'Caso 188',
  `C189` tinyint(1) DEFAULT NULL COMMENT 'Caso 189',
  `C190` tinyint(1) DEFAULT NULL COMMENT 'Caso 190',
  `C191` tinyint(1) DEFAULT NULL COMMENT 'Caso 191',
  `C192` tinyint(1) DEFAULT NULL COMMENT 'Caso 192',
  `C193` tinyint(1) DEFAULT NULL COMMENT 'Caso 193',
  `C194` tinyint(1) DEFAULT NULL COMMENT 'Caso 194',
  `C195` tinyint(1) DEFAULT NULL COMMENT 'Caso 195',
  `C196` tinyint(1) DEFAULT NULL COMMENT 'Caso 196',
  `C197` tinyint(1) DEFAULT NULL COMMENT 'Caso 197',
  `C198` tinyint(1) DEFAULT NULL COMMENT 'Caso 198',
  `C199` tinyint(1) DEFAULT NULL COMMENT 'Caso 199',
  `C200` tinyint(1) DEFAULT NULL COMMENT 'Caso 200',
  `C201` tinyint(1) DEFAULT NULL COMMENT 'Caso 201',
  `C202` tinyint(1) DEFAULT NULL COMMENT 'Caso 202',
  `C203` tinyint(1) DEFAULT NULL COMMENT 'Caso 203',
  `C204` tinyint(1) DEFAULT NULL COMMENT 'Caso 204',
  `C205` tinyint(1) DEFAULT NULL COMMENT 'Caso 205',
  `C206` tinyint(1) DEFAULT NULL COMMENT 'Caso 206',
  `C207` tinyint(1) DEFAULT NULL COMMENT 'Caso 207',
  `C208` tinyint(1) DEFAULT NULL COMMENT 'Caso 208',
  `C209` tinyint(1) DEFAULT NULL COMMENT 'Caso 209',
  `C210` tinyint(1) DEFAULT NULL COMMENT 'Caso 210',
  `C211` tinyint(1) DEFAULT NULL COMMENT 'Caso 211',
  `C212` tinyint(1) DEFAULT NULL COMMENT 'Caso 212',
  `C213` tinyint(1) DEFAULT NULL COMMENT 'Caso 213',
  `C214` tinyint(1) DEFAULT NULL COMMENT 'Caso 214',
  `C215` tinyint(1) DEFAULT NULL COMMENT 'Caso 215',
  `C216` tinyint(1) DEFAULT NULL COMMENT 'Caso 216',
  `C217` tinyint(1) DEFAULT NULL COMMENT 'Caso 217',
  `C218` tinyint(1) DEFAULT NULL COMMENT 'Caso 218',
  `C219` tinyint(1) DEFAULT NULL COMMENT 'Caso 219',
  `C220` tinyint(1) DEFAULT NULL COMMENT 'Caso 220'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE `novedades` (
  `idnovedades` tinyint(2) UNSIGNED NOT NULL,
  `desc_novedad` varchar(45) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE `observaciones` (
  `vigencia` mediumint(4) NOT NULL COMMENT 'Periodo',
  `nordemp` bigint(8) NOT NULL COMMENT 'Nro de Orden',
  `usuario` char(8) COLLATE utf8_spanish_ci NOT NULL COMMENT 'usuario que ingresa la observacion',
  `capitulo` tinyint(1) NOT NULL COMMENT 'capitulo',
  `observacion` longtext COLLATE utf8_spanish_ci NOT NULL COMMENT 'Observacion',
  `fecha` date NOT NULL COMMENT 'Fecha observacion'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organiza`
--

CREATE TABLE `organiza` (
  `codigo` char(7) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recvtas`
--

CREATE TABLE `recvtas` (
  `nordemp` bigint(10) NOT NULL,
  `I3R1C1` bigint(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regionales`
--

CREATE TABLE `regionales` (
  `dpto` int(2) UNSIGNED NOT NULL,
  `codis` tinyint(2) UNSIGNED NOT NULL,
  `nombre` char(30) COLLATE latin1_spanish_ci NOT NULL,
  `activo` tinyint(1) UNSIGNED NOT NULL,
  `codireg` int(2) UNSIGNED NOT NULL,
  `asistente` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `correo` char(80) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soportes`
--

CREATE TABLE `soportes` (
  `id` int(11) NOT NULL,
  `numemp` bigint(10) NOT NULL,
  `soporte_binario` mediumblob NOT NULL,
  `soporte_nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `soporte_peso` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `soporte_tipo` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soportesb`
--

CREATE TABLE `soportesb` (
  `id` int(11) NOT NULL,
  `numemp` bigint(10) NOT NULL,
  `soporte_binario` mediumblob NOT NULL,
  `soporte_nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `soporte_peso` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `soporte_tipo` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ident` char(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(80) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` char(2) COLLATE latin1_spanish_ci NOT NULL,
  `numemp` bigint(10) NOT NULL,
  `clave` char(16) COLLATE latin1_spanish_ci NOT NULL,
  `fcrea` date NOT NULL,
  `fexpi` date NOT NULL,
  `primera` tinyint(1) NOT NULL,
  `region` tinyint(2) NOT NULL,
  `ciiu3` mediumint(4) NOT NULL,
  `email` varchar(80) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actiemp`
--
ALTER TABLE `actiemp`
  ADD KEY `numero` (`nordemp`),
  ADD KEY `activ` (`actividad`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `capitulo_i`
--
ALTER TABLE `capitulo_i`
  ADD PRIMARY KEY (`C1_nordemp`,`vigencia`),
  ADD KEY `nordemp` (`C1_nordemp`);

-- --------------------------------------------------------
-- ########################################################
--
-- Indices de la tabla `capitulo_i_other`
--
ALTER TABLE `capitulo_i_other`
  ADD PRIMARY KEY (`C1_nordemp`,`vigencia`),
  ADD KEY `nordemp` (`C1_nordemp`);

--
-- Indices de la tabla `capitulo_i_other_displab`
--
ALTER TABLE `capitulo_i_other_displab`
  ADD PRIMARY KEY (`id_displab`),
  ADD KEY `nordemp` (`C1_nordemp`,`vigencia`);

--
-- AUTO_INCREMENT de la tabla `capitulo_i_other_displab`
--
ALTER TABLE `capitulo_i_other_displab`
  MODIFY `id_displab` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- ########################################################
-- --------------------------------------------------------

--
-- Indices de la tabla `capitulo_ii`
--
ALTER TABLE `capitulo_ii`
  ADD PRIMARY KEY (`C2_nordemp`,`vigencia`),
  ADD KEY `nordemp` (`C2_nordemp`);

--
-- Indices de la tabla `capitulo_iii`
--
ALTER TABLE `capitulo_iii`
  ADD PRIMARY KEY (`C3_nordemp`,`vigencia`),
  ADD KEY `nordemp` (`C3_nordemp`);

--
-- Indices de la tabla `capitulo_iv`
--
ALTER TABLE `capitulo_iv`
  ADD PRIMARY KEY (`C4_nordemp`,`vigencia`),
  ADD KEY `nordemp` (`C4_nordemp`);

--
-- Indices de la tabla `capitulo_v`
--
ALTER TABLE `capitulo_v`
  ADD PRIMARY KEY (`C5_nordemp`,`vigencia`),
  ADD KEY `nordemp` (`C5_nordemp`);

--
-- Indices de la tabla `capitulo_vi`
--
ALTER TABLE `capitulo_vi`
  ADD PRIMARY KEY (`C6_nordemp`,`vigencia`),
  ADD KEY `nordemp` (`C6_nordemp`);

--
-- Indices de la tabla `capitulo_vii`
--
ALTER TABLE `capitulo_vii`
  ADD PRIMARY KEY (`C7_nordemp`,`vigencia`),
  ADD KEY `nordemp` (`C7_nordemp`);

--
-- Indices de la tabla `caratula`
--
ALTER TABLE `caratula`
  ADD PRIMARY KEY (`nordemp`),
  ADD KEY `regional` (`regional`),
  ADD KEY `depto` (`depto`),
  ADD KEY `mpio` (`mpio`),
  ADD KEY `orgju` (`orgju`),
  ADD KEY `depnoti` (`depnotific`),
  ADD KEY `munoti` (`munnotific`),
  ADD KEY `ciiu3` (`ciiu3`),
  ADD KEY `estadoemp` (`estadoact`);

--
-- Indices de la tabla `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`caso`);

--
-- Indices de la tabla `ciiu3`
--
ALTER TABLE `ciiu3`
  ADD PRIMARY KEY (`CODIGO`);

--
-- Indices de la tabla `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`nordemp`,`vigencia`),
  ADD KEY `nordemp` (`nordemp`),
  ADD KEY `estado` (`estado`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `usuarioR` (`usuarioss`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD KEY `periodo` (`vigencia`,`nordemp`);

--
-- Indices de la tabla `divipola`
--
ALTER TABLE `divipola`
  ADD PRIMARY KEY (`dpto`,`muni`),
  ADD KEY `dpto` (`dpto`),
  ADD KEY `mpio` (`muni`);

--
-- Indices de la tabla `edit_eam`
--
ALTER TABLE `edit_eam`
  ADD PRIMARY KEY (`nordemp`);

--
-- Indices de la tabla `estadoact`
--
ALTER TABLE `estadoact`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idestados`);

--
-- Indices de la tabla `hoja_casos`
--
ALTER TABLE `hoja_casos`
  ADD PRIMARY KEY (`nordemp`);

--
-- Indices de la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`idnovedades`);

--
-- Indices de la tabla `observaciones`
--
ALTER TABLE `observaciones`
  ADD KEY `nordemp` (`nordemp`);

--
-- Indices de la tabla `organiza`
--
ALTER TABLE `organiza`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `regionales`
--
ALTER TABLE `regionales`
  ADD PRIMARY KEY (`codis`);

--
-- Indices de la tabla `soportes`
--
ALTER TABLE `soportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `soportesb`
--
ALTER TABLE `soportesb`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD KEY `ident` (`ident`),
  ADD KEY `numemp` (`numemp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2079389;
--
-- AUTO_INCREMENT de la tabla `casos`
--
ALTER TABLE `casos`
  MODIFY `caso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Secuencial casos', AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT de la tabla `soportes`
--
ALTER TABLE `soportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4733;
--
-- AUTO_INCREMENT de la tabla `soportesb`
--
ALTER TABLE `soportesb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1744;