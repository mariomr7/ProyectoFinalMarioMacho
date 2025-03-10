CREATE DATABASE club;
USE club;

-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `tipo_pista` enum('Padel','Tenis','Futbol','Golf','Baloncesto') NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `dia_semana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `tipo_pista`, `id_tipo`, `dia_semana`, `hora_inicio`, `hora_fin`) VALUES
(1, 'Futbol', 1, 'Lunes', '10:00:00', '12:00:00'),
(2, 'Futbol', 2, 'Martes', '11:00:00', '13:00:00'),
(3, 'Futbol', 3, 'Miércoles', '15:00:00', '17:00:00'),
(4, 'Padel', 1, 'Jueves', '09:00:00', '11:00:00'),
(5, 'Padel', 2, 'Viernes', '08:00:00', '10:00:00'),
(6, 'Padel', 3, 'Sábado', '10:00:00', '12:00:00'),
(7, 'Tenis', 1, 'Domingo', '12:00:00', '14:00:00'),
(8, 'Tenis', 2, 'Lunes', '14:00:00', '16:00:00'),
(9, 'Tenis', 3, 'Martes', '16:00:00', '18:00:00'),
(10, 'Golf', 1, 'Miércoles', '08:00:00', '10:00:00'),
(11, 'Golf', 2, 'Jueves', '18:00:00', '20:00:00'),
(12, 'Baloncesto', 1, 'Viernes', '16:00:00', '18:00:00'),
(13, 'Baloncesto', 2, 'Sábado', '12:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pistas`
--

CREATE TABLE `pistas` (
  `tipo_pista` enum('Padel','Tenis','Futbol','Golf','Baloncesto') NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `estado` enum('Libre','Ocupada') DEFAULT 'Libre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pistas`
--

INSERT INTO `pistas` (`tipo_pista`, `id_tipo`, `estado`) VALUES
('Padel', 1, 'Ocupada'),
('Padel', 2, 'Ocupada'),
('Padel', 3, 'Ocupada'),
('Tenis', 1, 'Ocupada'),
('Tenis', 2, 'Ocupada'),
('Tenis', 3, 'Ocupada'),
('Futbol', 1, 'Ocupada'),
('Futbol', 2, 'Libre'),
('Futbol', 3, 'Libre'),
('Golf', 1, 'Libre'),
('Golf', 2, 'Libre'),
('Baloncesto', 1, 'Libre'),
('Baloncesto', 2, 'Libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `tipo_pista` enum('Padel','Tenis','Futbol','Golf','Baloncesto') NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_socio`, `tipo_pista`, `id_tipo`, `fecha`, `hora_inicio`, `hora_fin`) VALUES
(2, 2, 'Futbol', 2, '2025-02-22', '11:00:00', '13:00:00'),
(3, 3, 'Futbol', 3, '2025-02-23', '15:00:00', '17:00:00'),
(4, 4, 'Padel', 1, '2025-02-24', '09:00:00', '11:00:00'),
(5, 5, 'Padel', 2, '2025-02-25', '08:00:00', '10:00:00'),
(6, 6, 'Padel', 3, '2025-02-26', '10:00:00', '12:00:00'),
(7, 7, 'Tenis', 1, '2025-02-27', '12:00:00', '14:00:00'),
(8, 8, 'Tenis', 2, '2025-02-28', '14:00:00', '16:00:00'),
(9, 9, 'Tenis', 3, '2025-03-01', '16:00:00', '18:00:00'),
(10, 10, 'Golf', 1, '2025-03-02', '08:00:00', '10:00:00'),
(11, 11, 'Golf', 2, '2025-03-03', '18:00:00', '20:00:00'),
(12, 12, 'Baloncesto', 1, '2025-03-04', '16:00:00', '18:00:00'),
(13, 13, 'Baloncesto', 2, '2025-03-05', '12:00:00', '14:00:00'),
(16, 2, 'Padel', 2, '0000-00-00', '00:00:00', '00:00:00'),
(18, 15, 'Padel', 1, '2025-03-08', '09:00:00', '11:00:00'),
(19, 16, 'Padel', 1, '2025-03-08', '09:00:00', '11:00:00'),
(20, 15, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(21, 15, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(22, 15, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(23, 15, 'Padel', 3, '2025-03-08', '00:00:00', '00:00:00'),
(24, 15, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(25, 15, 'Tenis', 1, '2025-03-08', '00:00:00', '00:00:00'),
(26, 15, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(27, 15, 'Tenis', 1, '2025-03-08', '00:00:00', '00:00:00'),
(28, 16, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(29, 15, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(30, 16, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(31, 16, 'Padel', 1, '2025-03-08', '00:00:00', '00:00:00'),
(32, 16, 'Padel', 2, '2025-03-08', '00:00:00', '00:00:00'),
(33, 16, 'Padel', 3, '2025-03-09', '00:00:00', '00:00:00'),
(34, 16, 'Padel', 1, '2025-03-09', '00:00:00', '00:00:00'),
(35, 15, 'Tenis', 2, '2025-03-09', '00:00:00', '00:00:00'),
(36, 15, 'Tenis', 3, '2025-03-10', '00:00:00', '00:00:00'),
(37, 15, 'Futbol', 1, '2025-03-10', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id_socio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fecha_inscripcion` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id_socio`, `nombre`, `apellido`, `email`, `telefono`, `fecha_inscripcion`, `password`) VALUES
(2, 'Maria', 'Garcia', 'maria.garcia@example.com', '222222222', '2025-01-02', ''),
(3, 'Carlos', 'Lopez', 'carlos.lopez@example.com', '333333333', '2025-01-03', ''),
(4, 'Ana', 'Martinez', 'ana.martinez@example.com', '444444444', '2025-01-04', ''),
(5, 'Luis', 'Fernandez', 'luis.fernandez@example.com', '555555555', '2025-01-05', ''),
(6, 'Sofia', 'Ruiz', 'sofia.ruiz@example.com', '666666666', '2025-01-06', ''),
(7, 'Manuel', 'Sanchez', 'manuel.sanchez@example.com', '777777777', '2025-01-07', ''),
(8, 'Lucia', 'Diaz', 'lucia.diaz@example.com', '888888888', '2025-01-08', ''),
(9, 'Roberto', 'Herrera', 'roberto.herrera@example.com', '999999999', '2025-01-09', ''),
(10, 'Elena', 'Romero', 'elena.romero@example.com', '1010101010', '2025-01-10', ''),
(11, 'Javier', 'Morales', 'javier.morales@example.com', '1111111121', '2025-01-11', ''),
(12, 'Carmen', 'Ortiz', 'carmen.ortiz@example.com', '1212121212', '2025-01-12', ''),
(13, 'Pedro', 'Alvarez', 'pedro.alvarez@example.com', '1313131313', '2025-01-13', ''),
(14, 'Admin', 'Club', 'admin@club.com', '123456789', '2025-01-01', ''),
(15, 'Mario', 'Macho', 'juan.perez@example.com', '', '2025-03-08', '$2y$10$4XPvW0i3yg6jD1MaHU6suO9JwyncH93yya4NhIYqEuM883waSHul.'),
(16, 'PEPE', 'P', 'mariomacho@gmail.com', '1', '2025-03-08', '$2y$10$GL52KoR/RaNlRaQ9JotG3eo.zfRfNagAVzj11NetQdHNuWg12kTHe'),
(17, 'Mario', 'Macho', 'a@m.com', NULL, '2025-03-10', '$2y$10$213GYMz57OFC479Xv9jW5OB4O7LNtBqc1NAYXT6VTctCi1Lb5vJVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `tipo_pista` (`tipo_pista`,`id_tipo`);

--
-- Indices de la tabla `pistas`
--
ALTER TABLE `pistas`
  ADD PRIMARY KEY (`tipo_pista`,`id_tipo`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_socio` (`id_socio`),
  ADD KEY `tipo_pista` (`tipo_pista`,`id_tipo`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id_socio`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id_socio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`tipo_pista`,`id_tipo`) REFERENCES `pistas` (`tipo_pista`, `id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `socios` (`id_socio`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`tipo_pista`,`id_tipo`) REFERENCES `pistas` (`tipo_pista`, `id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;
