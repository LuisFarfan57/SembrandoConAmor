-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: database
-- Tiempo de generación: 21-09-2020 a las 07:26:56
-- Versión del servidor: 10.1.44-MariaDB-1~bionic
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `SembrandoConAmor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200625152152', '2020-09-21 04:30:09', 1183),
('DoctrineMigrations\\Version20200627152009', '2020-09-21 04:30:11', 115),
('DoctrineMigrations\\Version20200627155440', '2020-09-21 04:30:11', 116),
('DoctrineMigrations\\Version20200627163916', '2020-09-21 04:30:11', 50),
('DoctrineMigrations\\Version20200627221637', '2020-09-21 04:30:11', 116);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donacion_monetaria`
--

CREATE TABLE `donacion_monetaria` (
  `id` int(11) NOT NULL,
  `familia_id` int(11) DEFAULT NULL,
  `donador_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidad` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donacion_viveres`
--

CREATE TABLE `donacion_viveres` (
  `id` int(11) NOT NULL,
  `familia_id` int(11) DEFAULT NULL,
  `donador_id` int(11) DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad_medida` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donador`
--

CREATE TABLE `donador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_electronico` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_archivo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tamanio_archivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `donador`
--

INSERT INTO `donador` (`id`, `nombre`, `correo_electronico`, `nombre_archivo`, `tamanio_archivo`) VALUES
(1, 'Luis Enrique Farfán Prado', 'luise.prado99@hotmail.com', '5f682c7526890_imagen1.jpg', 19453);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `id` int(11) NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `integrantes` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci,
  `nombre_completo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_administrador`
--

CREATE TABLE `usuario_administrador` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `donacion_monetaria`
--
ALTER TABLE `donacion_monetaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C4D82EE3D02563A3` (`familia_id`),
  ADD KEY `IDX_C4D82EE380CDAE34` (`donador_id`);

--
-- Indices de la tabla `donacion_viveres`
--
ALTER TABLE `donacion_viveres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_939A8D3AD02563A3` (`familia_id`),
  ADD KEY `IDX_939A8D3A80CDAE34` (`donador_id`);

--
-- Indices de la tabla `donador`
--
ALTER TABLE `donador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B24ABBFFF85E0677` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `donacion_monetaria`
--
ALTER TABLE `donacion_monetaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `donacion_viveres`
--
ALTER TABLE `donacion_viveres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `donador`
--
ALTER TABLE `donador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_administrador`
--
ALTER TABLE `usuario_administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `donacion_monetaria`
--
ALTER TABLE `donacion_monetaria`
  ADD CONSTRAINT `FK_C4D82EE380CDAE34` FOREIGN KEY (`donador_id`) REFERENCES `donador` (`id`),
  ADD CONSTRAINT `FK_C4D82EE3D02563A3` FOREIGN KEY (`familia_id`) REFERENCES `familia` (`id`);

--
-- Filtros para la tabla `donacion_viveres`
--
ALTER TABLE `donacion_viveres`
  ADD CONSTRAINT `FK_939A8D3A80CDAE34` FOREIGN KEY (`donador_id`) REFERENCES `donador` (`id`),
  ADD CONSTRAINT `FK_939A8D3AD02563A3` FOREIGN KEY (`familia_id`) REFERENCES `familia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
