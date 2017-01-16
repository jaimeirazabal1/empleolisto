-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2017 a las 21:19:00
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empleolisto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_user` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `company_user`, `url`, `status`, `created`) VALUES
(1, 10, 'ernest', NULL, '2017-01-13 15:16:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_fields`
--

CREATE TABLE `company_fields` (
  `id` int(11) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `bg_color` varchar(20) DEFAULT NULL,
  `bg_url` varchar(255) DEFAULT NULL,
  `texto` varchar(140) DEFAULT NULL,
  `agradecimiento` text,
  `aviso_privacidad` text,
  `company_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `company_fields`
--

INSERT INTO `company_fields` (`id`, `logo_url`, `bg_color`, `bg_url`, `texto`, `agradecimiento`, `aviso_privacidad`, `company_id`, `created`) VALUES
(1, 'upload/1484320965_5.jpg', '#000000', 'upload/1484321566_1.jpg', 'jaime Irazabal 16923509                                                                                                                    d', 'mi agradecimiento', 'mi aviso de privacidad', 1, '2017-01-13 15:16:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_perfiles`
--

CREATE TABLE `company_perfiles` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `telefono1` varchar(20) NOT NULL,
  `telefono2` varchar(20) NOT NULL,
  `puesto` varchar(35) NOT NULL,
  `experiencia` varchar(220) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_plan`
--

CREATE TABLE `company_plan` (
  `id` int(11) NOT NULL,
  `meses` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `company_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `company_plan`
--

INSERT INTO `company_plan` (`id`, `meses`, `activo`, `company_id`, `created`) VALUES
(1, 12, 1, 1, '2017-01-13 15:16:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_puesto`
--

CREATE TABLE `company_puesto` (
  `id` int(11) NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `company_puesto`
--

INSERT INTO `company_puesto` (`id`, `puesto`, `activo`, `company_id`) VALUES
(3, 'Operador De Linea', 1, 1),
(4, 'Ventas', 1, 1),
(5, 'Seguridad', 1, 1),
(6, 'Seguridad 2', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_user`
--

CREATE TABLE `company_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `company_user`
--

INSERT INTO `company_user` (`id`, `username`, `password`, `role`, `created`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'admin', '2017-01-11 19:02:29'),
(10, 'ernesto', '8f91bdb4de0142710ac1718345b96308', NULL, '2017-01-13 15:16:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `company_fields`
--
ALTER TABLE `company_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `company_perfiles`
--
ALTER TABLE `company_perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `company_plan`
--
ALTER TABLE `company_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `company_puesto`
--
ALTER TABLE `company_puesto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `company_user`
--
ALTER TABLE `company_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `company_fields`
--
ALTER TABLE `company_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `company_perfiles`
--
ALTER TABLE `company_perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `company_plan`
--
ALTER TABLE `company_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `company_puesto`
--
ALTER TABLE `company_puesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `company_user`
--
ALTER TABLE `company_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
