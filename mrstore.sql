-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2024 a las 20:05:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mrstore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_Producto` int(11) NOT NULL,
  `id_Categoria` int(11) NOT NULL,
  `id_Proveedor` int(11) NOT NULL,
  `color` varchar(25) NOT NULL,
  `descripcion` text NOT NULL,
  `nombre_Producto` varchar(60) NOT NULL,
  `precio_Producto` float NOT NULL,
  `talla` varchar(4) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_Producto`, `id_Categoria`, `id_Proveedor`, `color`, `descripcion`, `nombre_Producto`, `precio_Producto`, `talla`, `imagen`) VALUES
(1, 10, 1, 'Azul', 'Abrigo informal de doble botonadura', 'Chaqueta', 35, 'L', './productos/producto1.jpg'),
(2, 7, 2, 'Gris', 'Camisa casual manga larga para hombre estilo entallado', 'Suéter', 19, 'M', './productos/producto2.jpg'),
(3, 17, 1, 'Azul', 'Jean estilo casual para hombre estilo entallado', 'Jean', 33, '32', './productos/producto3.jpg'),
(4, 7, 1, 'Negro', 'Pantalón casual para hombre', 'Pantalón', 25, '34', './productos/producto4.jpg'),
(5, 16, 2, 'Blanco', 'Sweeto tops sin tirantes', 'Top', 12, 'S', './productos/producto5.jpg'),
(6, 2, 3, 'Rosa', 'Conjunto de pijama de mujer con estampado', 'Pijama', 15, 'M', './productos/producto6.jpg'),
(7, 2, 3, 'Rojo', 'Vestido de hombro descubierto', 'Vestido', 12, 'M', './productos/producto7.jpg'),
(8, 7, 1, 'Negro', 'Conjunto de dos piezas EZwear', 'Conjunto', 30, 'L', './productos/producto8.jpg'),
(9, 2, 3, 'Verde', 'Con escote en forma de corazón en verde salvia', 'Vestido', 18, 'S', './productos/producto9.png'),
(10, 14, 2, 'Amarillo', 'Vestido largo de primavera', 'Aloruh', 13, 'M', './productos/producto10.png'),
(11, 2, 3, 'Blanco', 'De cintura acampanada color blanco', 'Vestido', 8.8, 'S', './productos/producto11.png'),
(12, 17, 1, 'Azul', 'Holgado de pierna suelta', 'Jean Ancho', 27.22, 'M', './productos/producto12.png'),
(13, 14, 3, 'Blanco y Negro', 'Casual con estampado de zebra', 'Vestido camisero', 16.22, 'M', './productos/producto13.png'),
(14, 7, 2, 'Verde', 'Casual con estampado floral color verde', 'Falda larga', 11.26, 'M', './productos/producto14.png'),
(15, 7, 1, 'Azul', 'Casual de manga corta', 'Camiseta', 6, 'L', './productos/producto15.png'),
(16, 12, 3, 'Rojo', 'Conjunto de dos piezas con adorno floral', 'Bikini', 9, 'S', './productos/producto16.png'),
(17, 2, 2, 'Negro', 'Asimétrico de mujer color negro', 'Vestido', 16, 'M', './productos/producto17.png'),
(18, 13, 3, 'Beige', 'De dos piezas talla plus size', 'Conjunto', 28.9, 'XL', './productos/producto18.png'),
(19, 2, 3, 'Blanco', 'De tirantes sin manga', 'Top', 16, 'M', './productos/producto19.png'),
(20, 2, 3, 'Negro', 'SXY de unicolor', 'Vestido', 12, 'S', './productos/producto20.png'),
(21, 2, 3, 'Negro', 'Espalda descubierta para mujer', 'Top', 6, 'M', './productos/producto21.png'),
(22, 5, 1, 'Gris', 'Estilo Sporsity para hombre', 'Pantalones cortos', 14, 'L', './productos/producto22.png'),
(23, 7, 1, 'Beige', 'Color beige para hombre', 'Conjunto de dos piezas', 20.3, 'L', './productos/producto23.png'),
(24, 7, 1, 'Negro', 'Sin manga casual para hombre', 'Camiseta', 15.38, 'L', './productos/producto24.png'),
(25, 6, 1, 'Negro', 'Formal con botones color negro para hombre', 'Camisa de vestir', 8.3, 'M', './productos/producto25.png'),
(26, 5, 1, 'Gris', 'Casual color gris para hombre', 'Pantalones deportivos', 16.1, 'M', './productos/producto26.png'),
(27, 7, 1, 'Marrón', 'Con bolsillo lateral de solapa', 'Pantalones cargo', 28, '34', './productos/producto27.png'),
(28, 7, 1, 'Negro', 'De vestir color negro para hombre', 'Pantalones casuales', 25, '36', './productos/producto28.png'),
(29, 7, 1, 'Negro', 'De camisa y pantalón de algodón color negro para hombre', 'Set de 2 piezas', 35, 'L', './productos/producto29.png'),
(30, 7, 1, 'Gris', 'Casual para hombre', 'Chaqueta ligera', 27.64, 'M', './productos/producto30.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_Usuario` int(11) NOT NULL,
  `cedula` char(16) NOT NULL,
  `contraseña` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombre_Completo` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `ultimo_Acceso` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `cedula`, `contraseña`, `email`, `fecha_Registro`, `nombre_Completo`, `username`, `ultimo_Acceso`) VALUES
(1, '0000000000000001', 'Pass1234!', 'juan.perez@example.com', '2024-10-29 16:27:50', 'Juan Pérez', 'juanperez', '2024-11-23 16:27:50'),
(2, '0000000000000002', 'SecurePass99$', 'maria.gomez@example.com', '2024-09-29 16:27:50', 'María Gómez', 'mariagomez', '2024-11-18 16:27:50'),
(3, '0000000000000003', 'Strong!Pass1', 'carlos.lopez@example.com', '2024-08-30 16:27:50', 'Carlos López', 'carloslopez', '2024-11-08 16:27:50'),
(4, '0000000000000004', 'P@ssword2023', 'laura.rodriguez@example.com', '2024-07-31 16:27:50', 'Laura Rodríguez', 'laurarod', '2024-10-29 16:27:50'),
(5, '0000000000000005', 'MySecureP@ss', 'ana.martinez@example.com', '2024-10-14 16:27:50', 'Ana Martínez', 'anamartinez', '2024-11-13 16:27:50'),
(6, '0000000000000006', 'TopSecret123', 'fernando.garcia@example.com', '2024-09-19 16:27:50', 'Fernando García', 'fernandog', '2024-11-03 16:27:50'),
(7, '0000000000000007', 'Password!56', 'paula.morales@example.com', '2024-09-04 16:27:50', 'Paula Morales', 'paulam', '2024-11-16 16:27:50'),
(8, '0000000000000008', 'Secret@Pass', 'julio.mendez@example.com', '2024-08-10 16:27:50', 'Julio Méndez', 'juliom', '2024-10-24 16:27:50'),
(9, '0000000000000009', '123SecureP@ss', 'sara.vargas@example.com', '2024-08-25 16:27:50', 'Sara Vargas', 'saravargas', '2024-11-20 16:27:50'),
(10, '0000000000000010', 'MyP@ssw0rd!', 'oscar.torres@example.com', '2024-09-24 16:27:50', 'Óscar Torres', 'oscartorres', '2024-11-10 16:27:50'),
(11, '0000000000000011', 'Strong#Password', 'diana.fernandez@example.com', '2024-10-04 16:27:50', 'Diana Fernández', 'dianafer', '2024-11-21 16:27:50'),
(12, '0000000000000012', 'Secur!ty2023', 'luis.ortega@example.com', '2024-10-19 16:27:50', 'Luis Ortega', 'luisortega', '2024-10-31 16:27:50'),
(13, '0000000000000013', 'TrusTedP@ss', 'gloria.santos@example.com', '2024-08-20 16:27:50', 'Gloria Santos', 'glorias', '2024-11-08 16:27:50'),
(14, '0000000000000014', 'Secure4Life$', 'hector.rivas@example.com', '2024-08-05 16:27:50', 'Héctor Rivas', 'hectorr', '2024-11-18 16:27:50'),
(15, '0000000000000015', 'P@ss2023!', 'carolina.molina@example.com', '2024-09-14 16:27:50', 'Carolina Molina', 'carolinam', '2024-11-23 16:27:50'),
(16, '0000000000000016', 'Qwerty@123', 'andres.ramirez@example.com', '2024-10-09 16:27:50', 'Andrés Ramírez', 'andresram', '2024-11-13 16:27:50'),
(17, '0000000000000017', 'Admin#1Pass', 'sofia.castillo@example.com', '2024-11-03 16:27:50', 'Sofía Castillo', 'sofiac', '2024-11-20 16:27:50'),
(18, '0000000000000018', 'SecureC0d3!', 'daniel.silva@example.com', '2024-11-18 16:27:50', 'Daniel Silva', 'daniels', '2024-11-25 16:27:50'),
(19, '0000000000000019', 'P@ssword!!', 'gabriela.castro@example.com', '2024-05-12 16:27:50', 'Gabriela Castro', 'gabrielac', '2024-09-29 16:27:50'),
(20, '0000000000000020', 'MyStrongP@ss', 'mario.rojas@example.com', '2024-11-13 16:27:50', 'Mario Rojas', 'mariorojas', '2024-11-26 16:27:50'),
(21, '050-122303-3330R', 'hola123', 'jose@gmail.com', '2024-11-28 19:51:50', 'Jose de los angeles Vivas Vallecillo', 'jose2', '2024-11-29 02:51:50'),
(22, '561-041003-1002D', '12345', 'bpmamba000@gmail.com', '2024-12-09 12:30:22', 'Miguel Nunez Davila', 'mambatronix', '2024-12-09 19:30:22'),
(23, '561-041003-10022', '123', 'bpmamba011@gmail.com', '2024-12-09 18:30:48', 'Harleem pa', 'Harr', '2024-12-10 01:30:48');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_Producto`),
  ADD KEY `id_Categoria` (`id_Categoria`),
  ADD KEY `id_Proveedor` (`id_Proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_Categoria`) REFERENCES `categorias` (`id_Categoria`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_Proveedor`) REFERENCES `proveedores` (`id_Proveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
