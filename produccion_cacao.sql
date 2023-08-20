-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2023 a las 07:04:40
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `produccion_cacao`
--
CREATE DATABASE IF NOT EXISTS `produccion_cacao` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `produccion_cacao`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `direccion`) VALUES
(1, 'Saul Ortega', 'saulortega@hotmail.com', 'Recinto Estero Verde'),
(2, 'Franklin Salinas', 'franklin_Salinas@gmail.com', 'Los Linderos, Vía San Lorenzo de Garaicoa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idinsumo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `codigo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `idproveedor`, `idinsumo`, `fecha`, `precio`, `cantidad`, `total`, `codigo`) VALUES
(1, 0, 0, '2023-01-13 17:27:50', '0.00', 0, '200.00', ''),
(2, 0, 0, '2023-02-18 17:28:14', '0.00', 0, '250.00', ''),
(3, 0, 0, '2023-03-19 17:28:31', '0.00', 0, '215.00', ''),
(4, 0, 0, '2023-04-05 17:28:45', '0.00', 0, '225.00', ''),
(5, 0, 0, '2023-05-19 17:28:57', '0.00', 0, '275.00', ''),
(6, 0, 0, '2023-06-18 17:29:14', '0.00', 0, '300.00', ''),
(7, 1, 2, '2023-07-25 23:01:41', '25.00', 3, '75.00', '71'),
(8, 1, 4, '2023-07-25 23:01:41', '15.00', 3, '45.00', '71'),
(9, 2, 2, '2023-07-25 23:05:42', '25.00', 2, '50.00', '91'),
(10, 2, 5, '2023-07-25 23:05:42', '40.00', 4, '160.00', '91'),
(11, 2, 6, '2023-07-25 23:05:42', '12.00', 6, '72.00', '91');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cosecha`
--

CREATE TABLE `cosecha` (
  `id` int(11) NOT NULL,
  `idproductor` int(11) NOT NULL,
  `idtipocosecha` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad_quintal` int(11) DEFAULT NULL,
  `cantidad_tacho` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 0,
  `codigo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cosecha`
--

INSERT INTO `cosecha` (`id`, `idproductor`, `idtipocosecha`, `fecha`, `cantidad_quintal`, `cantidad_tacho`, `estado`, `codigo`) VALUES
(1, 0, 1, '2023-07-24 16:59:16', NULL, 10, 1, '11'),
(2, 0, 2, '2023-07-24 18:33:06', 6, NULL, 1, '21'),
(3, 0, 2, '2023-08-19 23:57:01', 10, NULL, 1, '31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuidado`
--

CREATE TABLE `cuidado` (
  `id` int(11) NOT NULL,
  `idtrabajador` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `codigo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuidado`
--

INSERT INTO `cuidado` (`id`, `idtrabajador`, `fecha`, `codigo`) VALUES
(1, 2, '2023-07-25 22:58:57', '11'),
(2, 1, '2023-07-25 23:00:04', '21'),
(3, 3, '2023-07-25 23:00:38', '31'),
(6, 3, '2023-07-25 23:04:20', '61');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cuidado`
--

CREATE TABLE `detalle_cuidado` (
  `id` int(11) NOT NULL,
  `idcuidado` int(11) NOT NULL,
  `idinsumo` int(11) NOT NULL,
  `cantidad_insumo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_cuidado`
--

INSERT INTO `detalle_cuidado` (`id`, `idcuidado`, `idinsumo`, `cantidad_insumo`) VALUES
(1, 1, 1, 1),
(2, 1, 4, 1),
(3, 2, 4, 2),
(4, 2, 2, 2),
(5, 3, 5, 2),
(10, 6, 6, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `existencia` int(11) NOT NULL,
  `imagen` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`, `precio`, `existencia`, `imagen`) VALUES
(1, 'Abono orgánico - saco de 45 kg', '30.00', 22, '1.jpg'),
(2, 'Fungicida - 1 Litro', '25.00', 13, '2.jpg'),
(3, 'Insecticida - 1 Litro', '20.00', 8, '3.jpg'),
(4, 'Herbicida - 1 Litro', '15.00', 11, '4.jpg'),
(5, 'Bioestimulantes - 1 Litro', '40.00', 10, '5.jpg'),
(6, 'Complemento para el cuidado del cacao', '12.00', 10, '6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `email`, `nombre`, `direccion`) VALUES
(1, 'tiendaagrofernando@gmail.com', 'Tienda AgroFernando', 'Calle Dr. Carlos Feraud'),
(2, 'josuemaldonado1971@hotmail.com', 'Productos Agrícola de Calidad', 'Recinto Estero Verde'),
(5, 'agroquimicosmilagro@hotmail.com', 'AgroQuimicos', 'Avenida Colón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cosecha`
--

CREATE TABLE `tipo_cosecha` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_cosecha`
--

INSERT INTO `tipo_cosecha` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Tacho', 'Cosecha para la venta por Tacho'),
(2, 'Quintal', 'Cosecha para la venta por Quintal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombre`, `email`, `direccion`) VALUES
(1, 'German Calle', 'germanjurado@hotmail.com', 'Recinto Estero Verde'),
(2, 'Jamil Romero', 'jamilromero@hotmail.com', 'Los Linderos'),
(3, 'Luis Romero', 'luisromero@gmail.com', 'Recinto Río Milagro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `email`, `pass`) VALUES
(1, 'Usuario Admin', 'usuario', 'usuario@hotmail.com', '$2y$10$Tf83ZpU6j/Sf0YiJnWTE0OqBusOdphLZ31D5E.N7O68eXS2j88bRK'),
(2, 'Juan Ruben Romero', 'juan_ruben', 'juanruben1998@hotmail.com', '$2y$10$rEOhokuTYPE7dguC3RUEX.RF6aXPgcrDZ3DOp4TiOsOCmE3ogCktu'),
(7, 'Pedro Vicente', 'pvicente', 'pedrovicente@gmail.com', '$2y$10$O0XtVXcB.tQ.wBZxZ1GBHOILYB2cGFa8XarXaH6QhOKF0IQ8kql2m');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `idcosecha` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `idcosecha`, `idcliente`, `fecha`, `cantidad`, `precio`, `total`) VALUES
(1, 0, 0, '2023-01-18 16:47:26', 0, '0.00', 275),
(2, 0, 0, '2023-02-22 16:51:11', 0, '0.00', 310),
(3, 0, 0, '2023-03-23 16:51:42', 0, '0.00', 306),
(4, 0, 0, '2023-04-26 16:52:39', 0, '0.00', 350),
(5, 0, 0, '2023-05-24 16:53:33', 0, '0.00', 365),
(6, 0, 0, '2023-06-14 16:54:35', 0, '0.00', 400),
(7, 1, 1, '2023-07-24 16:59:48', 10, '7.75', 78),
(8, 2, 2, '2023-07-24 18:36:49', 7, '8.00', 56),
(9, 3, 1, '2023-08-19 23:57:12', 10, '6.00', 60);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproveedor` (`idproveedor`),
  ADD KEY `idinsumo` (`idinsumo`);

--
-- Indices de la tabla `cosecha`
--
ALTER TABLE `cosecha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtipocosecha` (`idtipocosecha`),
  ADD KEY `idproductor` (`idproductor`);

--
-- Indices de la tabla `cuidado`
--
ALTER TABLE `cuidado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproductor` (`idtrabajador`);

--
-- Indices de la tabla `detalle_cuidado`
--
ALTER TABLE `detalle_cuidado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcuidado` (`idcuidado`),
  ADD KEY `idinsumo` (`idinsumo`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_cosecha`
--
ALTER TABLE `tipo_cosecha`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_usuarios` (`usuario`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcosecha` (`idcosecha`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cosecha`
--
ALTER TABLE `cosecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cuidado`
--
ALTER TABLE `cuidado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_cuidado`
--
ALTER TABLE `detalle_cuidado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_cosecha`
--
ALTER TABLE `tipo_cosecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
