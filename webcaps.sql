-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2023 a las 05:40:44
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webcaps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `correo` varchar(180) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` float NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `correo`, `contraseña`, `nombre`, `apellido`, `telefono`, `estado`) VALUES
(1, 'crewcaps', 'capspalmira@gmail.com', 'crewcaps', 'ADMIN', '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'CAMISETA'),
(2, 'HOODIE'),
(3, 'GORRA'),
(4, 'JEAN'),
(5, 'JOGGER'),
(6, 'CHAQUETA'),
(7, 'BASICA'),
(10, 'PANTALONETAS'),
(12, 'SUDADERA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefono` float NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `pedido_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `email`, `telefono`, `direccion`, `pedido_id`) VALUES
(85, 'alejo', 'a', 'sneykerz22@gmail.com', 312, '4', 0),
(86, 'alejo', 'arenas', 'alejoarenasdev@gmail.com', 5, '5', 0),
(87, 'alejo', 'arenas', 'sneykerz22@gmail.com', 312, 'f', 0),
(88, 'juan', 'arenas', 'sneykerz22@gmail.com', 312, 'aaa', 0),
(89, 'alejo', 'arenas', 'alejoarenasdev@gmail.com', 312, 'asdasd', 0),
(90, 'alejo', 'arenas', 'sneykerz22@gmail.com', 312, 'a', 0),
(91, 'alejo', 'arenas', 'sneykerz22@gmail.com', 312, 'a', 0),
(92, 'alejo', 'arenas', 'sneykerz22@gmail.com', 312, 'a', 0),
(93, 'alejo', 'a', 'sneykerz22@gmail.com', 312, 'a', 0),
(94, 'alejo', 'a', 'sneykerz22@gmail.com', 312, '654', 0),
(95, 'alejo', 'arenas', 'sneykerz22@gmail.com', 312, '5', 0),
(96, 'alejo', 'arenas', 'sneykerz22@gmail.com', 312, '5', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precio` float NOT NULL,
  `talla` varchar(5) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `pedido_id`, `producto_id`, `precio`, `talla`, `cantidad`) VALUES
(62, 89, 58, 13000, 'M', 1),
(63, 90, 58, 13000, 'L', 1),
(64, 91, 58, 13000, 'M', 1),
(65, 92, 58, 13000, 'M', 1),
(66, 93, 58, 13000, 'M', 1),
(67, 94, 58, 13000, 'L', 1),
(68, 95, 58, 13000, 'S', 1),
(69, 95, 63, 20000, 'M', 1),
(70, 96, 58, 13000, 'S', 1),
(71, 96, 63, 20000, 'M', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `ruta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `ruta`) VALUES
(2, 'Camiseta/WhatsApp Image 2023-06-13 at 10.54.01 AM (4).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `lema` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `lema`) VALUES
(1, 'Rocha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_id`, `total`, `fecha`, `estado`) VALUES
(89, 89, 13000, '2023-06-15', 0),
(90, 90, 13000, '2023-06-15', 0),
(91, 91, 13000, '2023-06-15', 0),
(92, 92, 13000, '2023-06-15', 0),
(93, 93, 13000, '2023-06-15', 0),
(94, 94, 13000, '2023-06-15', 0),
(95, 95, 163000, '2023-06-15', 0),
(96, 96, 163000, '2023-06-15', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `referencia` varchar(200) NOT NULL,
  `categoria_id` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `tallas` varchar(200) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `referencia`, `categoria_id`, `foto`, `tallas`, `precio`, `stock`, `estado`, `fecha`, `descripcion`) VALUES
(58, 'Chaqueta de Dama', '6', 'WhatsApp Image 2023-06-13 at 10.54.04 AM (3).jpeg', 'S,M,L,XL', 13000, 10, 0, '2023-06-14', ''),
(63, 'Jean Ancho Negro', '4', 'WhatsApp Image 2023-06-13 at 10.54.01 AM (1).jpeg', 'S,M,L', 20000, 23, 0, '2023-06-15', ''),
(65, 'Camiseta Feid', '1', 'WhatsApp Image 2023-06-13 at 10.54.21 AM (2).jpeg', 'S,M,L,XL', 130000, 23, 0, '2023-06-15', ''),
(67, 'Chaqueta NASA unisex', '6', 'WhatsApp Image 2023-06-13 at 10.54.04 AM (4).jpeg', 'M,L,XL,XL', 90000, 10, 0, '2023-06-15', ''),
(68, 'Sudadera NASA', '12', 'WhatsApp Image 2023-06-13 at 10.54.04 AM.jpeg', '30,32,34', 80000, 10, 0, '2023-06-15', ''),
(69, 'Chaqueta Nasa EDICIÓN REFLECTIVA ', '6', 'WhatsApp Image 2023-06-13 at 10.54.05 AM.jpeg', 'M,L,XL,XL', 100000, 10, 0, '2023-06-15', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
