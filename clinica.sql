-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 13-02-2023 a las 06:26:29
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `documento` text NOT NULL,
  `foto` text NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `rol` text NOT NULL,
  `sexo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `nombre`, `apellido`, `documento`, `foto`, `usuario`, `clave`, `rol`, `sexo`) VALUES
(1, 'Kevin Hernán', 'Tello Arévalo', '60266420', 'Vistas/img/admin/392.jpg', 'admin', 'admin', 'Administrador', 'Masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `id_consultorio` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `paciente` text NOT NULL,
  `documento` text NOT NULL,
  `doctor` text NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `id_doctor`, `id_consultorio`, `id_paciente`, `paciente`, `documento`, `doctor`, `inicio`, `fin`) VALUES
(82, 16, 34, 11, 'Sofia Auroraa Tanta Abanto', '60266420', 'Guillermo Villalobos', '2023-02-09 03:00:00', '2023-02-09 04:00:00'),
(83, 17, 33, 11, 'Sofia Aurora Tanta Abanto', '60266420', 'Maribel Correa', '2023-02-09 12:00:00', '2023-02-09 13:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`id`, `nombre`) VALUES
(33, 'Obstetricia'),
(34, 'Medicina General'),
(35, 'Ginecologia'),
(36, 'Urología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `id_consultorio` int(11) NOT NULL,
  `foto` text NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `sexo` text NOT NULL,
  `horarioE` time NOT NULL,
  `horarioS` time NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id`, `nombre`, `apellido`, `id_consultorio`, `foto`, `usuario`, `clave`, `sexo`, `horarioE`, `horarioS`, `rol`) VALUES
(6, 'Kevin', 'Tello', 36, 'Vistas/img/doctor/192.jpg', 'kevin', 'kevin', 'Masculino', '01:00:00', '12:00:00', 'Doctor'),
(8, 'Pablo', 'Lopez', 35, '', 'pablo', 'pablo', 'Masculino', '08:00:00', '18:00:00', 'Doctor'),
(14, 'Edinson', 'Caipo', 36, 'Vistas/img/doctor/785.png', 'edi', 'edi', 'Masculino', '08:00:00', '20:00:00', 'Doctor'),
(15, 'Fernando', 'Tello', 34, '', 'fer', 'fer', 'Femenino', '07:00:00', '12:00:00', 'Doctor'),
(16, 'Guillermo', 'Villalobos', 34, '', 'guille', 'guille', 'Masculino', '02:00:00', '06:00:00', 'Doctor'),
(17, 'Maribel', 'Correa', 33, '', 'Mar', 'Mar', 'Femenino', '11:00:00', '18:00:00', 'Doctor'),
(18, 'Pedro', 'Aguilar', 36, '', 'pedro', 'pedro', 'Masculino', '03:00:00', '09:00:00', 'Doctor'),
(19, 'Angie ', 'Teran', 35, '', 'angie', 'angie', 'Femenino', '08:00:00', '14:00:00', 'Doctor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `ruc` text NOT NULL,
  `telefono` text NOT NULL,
  `direccion` text NOT NULL,
  `correo` text NOT NULL,
  `logo` text NOT NULL,
  `horarioE` time NOT NULL,
  `horarioS` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `ruc`, `telefono`, `direccion`, `correo`, `logo`, `horarioE`, `horarioS`) VALUES
(1, 'Centernario del Norte', '20549494308', '+51913854639', 'Calle 5 de Marzo, Guadalupe- Peru', 'centenariodelnorte@gmail.com', 'Vistas/img/empresa/944.jpg', '04:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `documento` text NOT NULL,
  `foto` text NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `rol` text NOT NULL,
  `sexo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellido`, `documento`, `foto`, `usuario`, `clave`, `rol`, `sexo`) VALUES
(11, 'Sofia Aurora', 'Tanta Abanto', '60266420', 'Vistas/img/paciente/507.jpg', 'sofia', 'sofia', 'Paciente', 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias`
--

CREATE TABLE `secretarias` (
  `id` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `foto` text NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `secretarias`
--

INSERT INTO `secretarias` (`id`, `usuario`, `clave`, `nombre`, `apellido`, `foto`, `rol`) VALUES
(1, 'maria', 'maria', 'Maria Elizabeth', 'Oliva Gonzales', 'Vistas/img/secretaria/312.jpg', 'Secretaria'),
(2, 'kevin', 'kevin', 'Kevin Hernán', 'Tello Arévalo', 'Vistas/img/secretaria/805.jpg', 'Secretaria'),
(5, 'flor', 'flor', 'Flor', 'Llanos', '', 'Secretaria');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
