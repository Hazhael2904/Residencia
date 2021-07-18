-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2021 a las 00:30:25
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `constructora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances_proyectos`
--

CREATE TABLE `avances_proyectos` (
  `idavances` int(20) NOT NULL,
  `observaciones` varchar(400) NOT NULL,
  `fecharegistro` date NOT NULL,
  `idproyectos` int(255) NOT NULL,
  `idcliente` int(255) NOT NULL,
  `idpersonal` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `avances_proyectos`
--

INSERT INTO `avances_proyectos` (`idavances`, `observaciones`, `fecharegistro`, `idproyectos`, `idcliente`, `idpersonal`) VALUES
(1, 'Etapa 1 medicion primera parte', '2021-07-01', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_citas` int(11) NOT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `observaciones` varchar(450) DEFAULT NULL,
  `estatus` varchar(50) NOT NULL,
  `fecharegistro` date NOT NULL,
  `fechaprogramacion` date NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idpersonal` int(100) NOT NULL,
  `idservicio` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_citas`, `asunto`, `observaciones`, `estatus`, `fecharegistro`, `fechaprogramacion`, `idcliente`, `idpersonal`, `idservicio`) VALUES
(3, 'Cita para Medicion', 'Presupuesto de medicion de terreno', 'Cita_en_Espera', '2021-07-07', '2021-07-14', 2, 1, 1),
(4, 'Cita para RemodelaciÃ³n de Casa', 'Presupuesto para medir terreno', 'Cita_Aprobada', '2021-07-07', '2021-07-14', 1, 1, 1),
(5, 'Cita para Construccion', 'Presupuesto,DiseÃ±o 3D,', 'Cita_en_Espera', '2021-07-13', '2021-07-15', 2, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `apellido1` varchar(100) DEFAULT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `FechaRegistro` date DEFAULT NULL,
  `Estatus` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `apellido1`, `apellido2`, `correo`, `password`, `telefono`, `direccion`, `FechaRegistro`, `Estatus`) VALUES
(1, 'Rodrigo', 'Garcia', 'Perez', 'rodrigo@hotmail.com', '12345', 317102123, 'Luis Echeverria 23', '2021-05-10', 'Activo'),
(2, 'Jesus', 'Pelayo', 'Martinez', 'jesus12@hotmail.com', '1234', 317386789, 'Pedro Moreno 12', '2021-06-23', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `color` varchar(255) NOT NULL,
  `textColor` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`) VALUES
(1, 'Evento ', 'Celebrando que no duermo', '#cac40c', '#FFFFFF', '2021-06-02 12:30:00', '2021-06-02 12:30:00'),
(2, 'Ejemplo 4', 'Ejemplo Descripcion', '#ff0040', '#FFFFFF', '2021-06-11 10:30:00', '2021-06-11 10:30:00'),
(11, 'Medicion Terreno', 'Medir Terreno Rustico', '#1e00ff', '#FFFFFF', '2021-06-16 12:30:00', '2021-06-16 12:30:00'),
(12, 'Levantamiento', 'Levantamiento de Casa', '#0805b8', '#FFFFFF', '2021-06-18 12:30:00', '2021-06-18 12:30:00'),
(13, 'Medicion Terreno', 'Medir terreno de don juan', '#ff0000', '#FFFFFF', '2021-07-01 01:30:00', '2021-07-01 01:30:00'),
(14, 'Ejemplo 3', 'jpihpihp', '#ff0000', '#FFFFFF', '2021-07-02 12:30:00', '2021-07-02 12:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencias`
--

CREATE TABLE `evidencias` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evidencias`
--

INSERT INTO `evidencias` (`id`, `image_path`) VALUES
(1, 'evidencia/1.jpg'),
(2, 'evidencia/img2.jpeg'),
(3, 'evidencia/img3.jpeg'),
(4, 'evidencia/img7.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idimagen` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idimagen`, `image_path`) VALUES
(4, 'evidencia2/img1.jpeg'),
(5, 'evidencia2/img4.jpeg'),
(6, 'evidencia2/img5.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `idpersonal` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidopat` varchar(45) DEFAULT NULL,
  `apellidomat` varchar(45) DEFAULT NULL,
  `domicilio` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `fechareg` date DEFAULT NULL,
  `estatus` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`idpersonal`, `nombre`, `apellidopat`, `apellidomat`, `domicilio`, `telefono`, `correo`, `puesto`, `fechareg`, `estatus`) VALUES
(1, 'Juan Ramon', 'Covarrubias', 'Rodriguez', 'Abasolo 159', '3171077092', 'juanramon@hotmail.com', 'Propietario Socio', '2014-04-15', 'Activo'),
(2, 'Daniel Abisai', 'Pelayo', 'Rodriguez', 'Porfirio Diaz 247', '3173881545', 'pelayo_stoner@hotmail.com', 'Co-propietario', '2014-04-15', 'Activo'),
(3, 'Mayra', 'Covarrubias', 'Rodriguez', 'Lopez Mateos 105', '3173837364', 'c-projuridico@hotmail.com', 'Juridico', '2014-04-15', 'Activo'),
(4, 'Maura', 'Castellon', 'Rodriguez', '15 de Enero 123', '3171073955', 'c-procontadora@hotmail.com', 'Contadora', '2020-04-15', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `idproyectos` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `FechRegistro` date DEFAULT NULL,
  `Estatus` varchar(45) DEFAULT NULL,
  `idservicio` int(45) DEFAULT NULL,
  `idpersonal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`idproyectos`, `nombre`, `descripcion`, `idcliente`, `FechRegistro`, `Estatus`, `idservicio`, `idpersonal`) VALUES
(1, 'Topografia', 'Medicion', 1, '2021-07-09', 'En_Proceso', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrol` int(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrol`, `descripcion`) VALUES
(1, 'Adiministrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `nombre`, `descripcion`) VALUES
(1, 'Topografia', 'Levantamienos Topograficos-Mediciones'),
(2, 'Remodelaciones', 'Reodelaciones de casa o cualquier construccion'),
(3, 'Disenos 3D', 'Diseños en 3D'),
(4, 'Construccion', 'Construccion de casas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_info`
--

CREATE TABLE `solicitud_info` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `telefono` int(10) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `estatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud_info`
--

INSERT INTO `solicitud_info` (`id`, `nombre`, `apellidos`, `tipo`, `telefono`, `correo`, `estatus`) VALUES
(1, 'Pedro', 'Ramirez Garcia', 'Construccion', 317234456, 'pedro@hotmail.com', 'Procesando'),
(3, 'Ricardo', 'Duran Mota', 'Construccion', 317386756, 'ricadu@hotmail.com', 'Procesando'),
(4, 'Jose Luis', 'Reina MagaÃ±a', 'Remodelacion', 2147483647, 'joseluis@hotmail.com', 'Proceso'),
(5, 'Pedro', 'Ramirez Garcia', 'Construccion', 317234456, 'pedro@hotmail.com', 'Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_proyecto`
--

CREATE TABLE `solicitud_proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` int(10) NOT NULL,
  `estatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `solicitud_proyecto`
--

INSERT INTO `solicitud_proyecto` (`id`, `nombre`, `apellidos`, `servicio`, `direccion`, `correo`, `telefono`, `estatus`) VALUES
(1, 'Hazhael', 'Amador Covarrubias', 'RemodelaciÃ³n de Casa', 'Luis Echeverria 178', 'amadorcovarrubias2904@hotmail.com', 2147483647, 'Procesando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` int(5) NOT NULL,
  `fecharegistro` date NOT NULL,
  `estatus` varchar(50) NOT NULL,
  `idrol` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `usuario`, `password`, `fecharegistro`, `estatus`, `idrol`) VALUES
(1, 'Juan Ramon', 'Covarrubias Rodriguez', 'juanramon@hotmail.com', 'juan001', 3627909, '2021-07-15', 'Activo', 1),
(2, 'Pedro', 'Tovar Perez', 'pedro@hotmail.com', 'pedro002', 3627909, '2021-07-15', 'Activo', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avances_proyectos`
--
ALTER TABLE `avances_proyectos`
  ADD PRIMARY KEY (`idavances`),
  ADD KEY `fk_proyectos_avances_proyectos` (`idproyectos`),
  ADD KEY `fk_cliente_avances_proyectos` (`idcliente`),
  ADD KEY `fk_personal_avances_proyectos` (`idpersonal`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_citas`),
  ADD KEY `fk_personal_citas` (`idpersonal`),
  ADD KEY `fk_servicio_citas` (`idservicio`),
  ADD KEY `fk_cliente_citas` (`idcliente`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evidencias`
--
ALTER TABLE `evidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idimagen`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`idpersonal`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`idproyectos`),
  ADD KEY `fk_personal_proyectos_idx` (`idpersonal`),
  ADD KEY `fk_cliente_proyectos_idx` (`idcliente`),
  ADD KEY `fk_servicio_proyecto` (`idservicio`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idservicio`);

--
-- Indices de la tabla `solicitud_info`
--
ALTER TABLE `solicitud_info`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_proyecto`
--
ALTER TABLE `solicitud_proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roles_usuario` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `avances_proyectos`
--
ALTER TABLE `avances_proyectos`
  MODIFY `idavances` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_citas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `evidencias`
--
ALTER TABLE `evidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idimagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `idpersonal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `idproyectos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idrol` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud_info`
--
ALTER TABLE `solicitud_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solicitud_proyecto`
--
ALTER TABLE `solicitud_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `avances_proyectos`
--
ALTER TABLE `avances_proyectos`
  ADD CONSTRAINT `fk_cliente_avances_proyectos` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `fk_personal_avances_proyectos` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`),
  ADD CONSTRAINT `fk_proyectos_avances_proyectos` FOREIGN KEY (`idproyectos`) REFERENCES `proyectos` (`idproyectos`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_cliente_citas` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `fk_personal_citas` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`),
  ADD CONSTRAINT `fk_servicio_citas` FOREIGN KEY (`idservicio`) REFERENCES `servicio` (`idservicio`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `fk_cliente_proyectos` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personal_proyectos` FOREIGN KEY (`idpersonal`) REFERENCES `personal` (`idpersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicio_proyecto` FOREIGN KEY (`idservicio`) REFERENCES `servicio` (`idservicio`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_roles_usuario` FOREIGN KEY (`idrol`) REFERENCES `roles` (`idrol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
