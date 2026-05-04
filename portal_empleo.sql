-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2026 a las 13:27:21
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
-- Base de datos: `portal_empleo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `cod_departamento` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cod_jefe_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`cod_departamento`, `nombre`, `descripcion`, `cod_jefe_departamento`) VALUES
(1, 'Recursos Humanos', 'Departamento encargado de la gestión del personal', 2),
(2, 'Mantenimiento de sistemas', 'Departamento encargado de la infraestructura hardware', 4),
(3, 'Desarrollo web', 'Departamento encargado del desarrollo y mantenimiento de las aplicaciones', 47),
(4, 'Cobros', 'Encargado de gestionar los cobros de los clientes', 53),
(5, 'Departamento de Administración', 'Gestión financiera y administrativa de la compañia', 44),
(7, 'Marketing', 'Departamento encargado de promocionar nuestra empresa', 53),
(10, 'testeos SA', 'hacer testeos para la empresa', 76);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `cod_empleado` int(11) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `telefono_personal` varchar(20) NOT NULL,
  `gmail_contacto` varchar(50) NOT NULL,
  `gmail_empresarial` varchar(50) NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `estado` enum('activo','de baja','despedido') DEFAULT 'activo',
  `rol` enum('normal','jefe','admin') DEFAULT 'admin',
  `password_hash` varchar(255) NOT NULL,
  `foto` varchar(70) DEFAULT NULL,
  `cod_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`cod_empleado`, `dni`, `nombre`, `apellidos`, `telefono_personal`, `gmail_contacto`, `gmail_empresarial`, `puesto`, `estado`, `rol`, `password_hash`, `foto`, `cod_departamento`) VALUES
(2, '87654321B', 'Ana', 'Gómez Cuartero', '600654321', 'ana.gomez@gmail.com', 'a.gomez@empresa.com', 'Gerente de RRHH', 'activo', 'jefe', '$2y$10$4JY38cG0IcQw4B5FSBV9VOrg5a80e.Go1swpF7./yfQqYUfVwmC8G', 'ana gomez.png', 1),
(3, '13579135N', 'Oscar', 'Calvo Cuartero', '600123456', 'oscar.martinez@gmail.com', 'os.martinez@empresa.com', 'Asistente', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', 'oscar calvo.jpg', 1),
(4, '99880088P', 'Sonia', 'Lorenza Sánchez', '611234567', 'sonia.gomez@gmail.com', 's.gomez@empresa.com', 'Jefa de mantenimiento', 'activo', 'jefe', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', 'sonia lorenza.jpg', 2),
(5, '34567890C', 'Miguel', 'Ruiz Fernández', '622345678', 'miguel.ruiz@gmail.com', 'm.ruiz@empresa.com', 'Desarrollador', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 3),
(6, '11223344T', 'Pepe', 'Martinez Martinez', '666778899', 'pepepersonal@gmail.com', 'pepeempresa@gmail.com', '', 'activo', 'admin', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 1),
(7, '00000000Z', 'prueba', 'admin', '600000000', 'prueba.admin@gmail.com', 'admin@empresa.com', 'Administrador del sistema', 'activo', 'admin', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', 'admin.webp', NULL),
(38, '00197756T', 'Juan', 'Pérez García', '600111111', 'juanp@gmail.com', 'juan.perez@empresa.com', 'Desarrollador', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 3),
(39, '12345678B', 'María', 'López Sánchez', '600111112', 'maria@gmail.com', 'maria.lopez@empresa.com', 'RRHH', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 1),
(40, '12345678C', 'Carlos', 'Gómez Ruiz', '600111113', 'carlos.gomez@gmail.com', 'carlos.gomez@empresa.com', 'Administrador', 'activo', 'admin', '$2y$10$18K3hZXhVBcboIzxWPqZeeqKQHYgjzaOhvJXwzDcMiSJooglVFaNK', 'Carlos_gomez.webp', 5),
(41, '12345678D', 'Laura', 'Martín Díaz', '600111114', 'laura@gmail.com', 'laura.martin@empresa.com', 'Desarrollador', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 3),
(42, '12345678E', 'Pedro', 'Santos Vega', '600111115', 'pedro@gmail.com', 'pedro.santos@empresa.com', 'Contable', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 4),
(43, '12345678F', 'Lucía', 'Navarro Gil', '600111116', 'lucia@gmail.com', 'lucia.navarro@empresa.com', 'RRHH', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 1),
(44, '12345678G', 'Miguel', 'Torres León', '600111117', 'miguel@gmail.com', 'miguel.torres@empresa.com', 'Jefe Administración', 'activo', 'jefe', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 5),
(45, '12345678H', 'Sara', 'Ortega Cruz', '600111118', 'sara@gmail.com', 'sara.ortega@empresa.com', 'Secretaria', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 1),
(46, '12345678I', 'David', 'Ramírez Mora', '600111119', 'david@gmail.com', 'david.ramirez@empresa.com', 'Desarrollador', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 3),
(47, '12345678J', 'Elena', 'Castro Peña', '600111120', 'elena@gmail.com', 'elena.castro@empresa.com', 'Jefa de Desarrollo', 'activo', 'jefe', '$2y$10$WFwl2suvCrtDOJQSU1aLpe.XBtrO3gu2qKomCbTqMn2tuXz3TZ/Wy', '', 3),
(48, '12345678K', 'Pablo', 'Herrera Soto', '600111121', 'pablo@gmail.com', 'pablo.herrera@empresa.com', 'Contable', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 4),
(49, '12345678L', 'Ana', 'Molina Rubio', '600111122', 'ana@gmail.com', 'ana.molina@empresa.com', 'Desarrolladora web', 'activo', 'normal', '$2y$10$h7cdu3cqnpQahyXlHcuF6uPZ1CeSJHj9Udm9qWhp0N.e.EDSNcj4W', 'generica.jpg', 3),
(50, '12345678M', 'Raúl', 'Delgado Pardo', '600111123', 'raul@gmail.com', 'raul.delgado@empresa.com', 'Soporte IT', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 2),
(51, '12345678N', 'Carmen', 'Iglesias Soler', '600111124', 'carmen.isoler@gmail.com', 'carmen.iglesias@empresa.com', 'Administrativa', 'activo', 'normal', '$2y$10$FlvV4dDRcEFtsklwC7EPSu643Wtqlu8hxJ8xfKQBs4q0kwVOeRtzW', 'carmen_sole.jpg', 5),
(52, '12345678O', 'Jorge', 'Vidal Campos', '600111125', 'jorge@gmail.com', 'jorge.vidal@empresa.com', 'Recruiter', 'activo', 'normal', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 1),
(53, '01679941N', 'Tomas', 'Sancho Gutierrez', '600123456', 'tomas.sancho@gmail.com', 'tomas.sancho@empresa.com', 'Jefe de Marketing', 'activo', 'jefe', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, 4),
(54, '12345678A', 'probar', 'probar empleado', '600123456', 'pruempleo@gmail.com', 'pruempleo@empresa.com', 'Jefe de Departamento prueba', 'activo', 'jefe', '$2y$10$yoVmoc.ufoQK0aCHJKsPIev5OdrMJhZC8lfVqV.v6Te6ZMqmbuRPO', NULL, NULL),
(73, '19880148K', 'Manolo', 'Olmo Iberico', '4155462', 'olmo@personal.com', 'olmo@empresa.com', 'Revisor de la web', 'activo', 'admin', '$2y$10$Ze3gEHRUs6qeIep/nzLsMuukx.oHEUaC/2Esyt0l8yaNIGx4kbWRK', 'olmo.webp', NULL),
(74, '00195546N', 'tessa', 'gonzales', '215881354', 'teresa.contacto@gmail.com', 'teresa.empresa@gmail.com', 'hola', 'de baja', 'normal', '$2y$10$.f95hEzTMA7gE6uZmbi.yu06wxnT.Uj.sbCGVZB5h5Jgv27UcXq5W', '', 10),
(76, '00119233R', 'testeo', 'testeador', '11009978', 'testeo@gmail.com', 'testeo@empresa.com', 'testeador', 'despedido', 'jefe', '$2y$10$.2Vv/.Rt/LWjWHokTfPEuep/Y7gpUieLZfdg4vGCQINN49U1H6EzC', 'pago facil.webp', 10),
(79, '76352297A', 'Mario', 'Romero torres', '196335218', 'Mario.torres@gmail.com', 'Mario.torres@empresa.com', 'Analista de Marketing', 'activo', 'normal', '$2y$10$mkHnq1egJ8mjGLl2tHTn3eIuo8eRD0nZ1ndmnlptZP5fWRsb3PlEO', NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichajes`
--

CREATE TABLE `fichajes` (
  `cod_fichaje` int(11) NOT NULL,
  `cod_empleado` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `tipo` enum('entrada','salida') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichajes`
--

INSERT INTO `fichajes` (`cod_fichaje`, `cod_empleado`, `fecha_hora`, `tipo`) VALUES
(3, 2, '2025-11-03 09:00:00', 'entrada'),
(4, 2, '2025-11-03 18:00:00', 'salida'),
(5, 3, '2025-11-03 09:00:00', 'entrada'),
(6, 3, '2025-11-03 18:00:00', 'salida'),
(7, 4, '2025-11-03 09:00:00', 'entrada'),
(8, 4, '2025-11-03 18:00:00', 'salida'),
(9, 5, '2025-11-03 09:00:00', 'entrada'),
(10, 5, '2025-11-03 18:00:00', 'salida'),
(15, 2, '2025-12-01 09:00:00', 'entrada'),
(16, 2, '2025-12-01 18:00:00', 'salida'),
(17, 3, '2025-12-01 09:00:00', 'entrada'),
(18, 3, '2025-12-01 18:00:00', 'salida'),
(19, 4, '2025-12-01 09:00:00', 'entrada'),
(20, 4, '2025-12-01 18:00:00', 'salida'),
(21, 5, '2025-12-01 09:00:00', 'entrada'),
(22, 5, '2025-12-01 18:00:00', 'salida'),
(27, 2, '2025-12-02 09:00:00', 'entrada'),
(28, 2, '2025-12-02 18:00:00', 'salida'),
(29, 3, '2025-12-02 09:00:00', 'entrada'),
(30, 3, '2025-12-02 18:00:00', 'salida'),
(31, 4, '2025-12-02 09:00:00', 'entrada'),
(32, 4, '2025-12-02 18:00:00', 'salida'),
(33, 5, '2025-12-02 09:00:00', 'entrada'),
(34, 5, '2025-12-02 18:00:00', 'salida'),
(39, 2, '2025-12-03 09:00:00', 'entrada'),
(40, 2, '2025-12-03 18:00:00', 'salida'),
(41, 3, '2025-12-03 09:00:00', 'entrada'),
(42, 3, '2025-12-03 18:00:00', 'salida'),
(43, 4, '2025-12-03 09:00:00', 'entrada'),
(44, 4, '2025-12-03 18:00:00', 'salida'),
(45, 5, '2025-12-03 09:00:00', 'entrada'),
(46, 5, '2025-12-03 18:00:00', 'salida'),
(51, 2, '2025-12-04 09:00:00', 'entrada'),
(52, 2, '2025-12-04 18:00:00', 'salida'),
(53, 3, '2025-12-04 09:00:00', 'entrada'),
(54, 3, '2025-12-04 18:00:00', 'salida'),
(55, 4, '2025-12-04 09:00:00', 'entrada'),
(56, 4, '2025-12-04 18:00:00', 'salida'),
(57, 5, '2025-12-04 09:00:00', 'entrada'),
(58, 5, '2025-12-04 18:00:00', 'salida'),
(63, 2, '2025-12-05 09:00:00', 'entrada'),
(64, 2, '2025-12-05 18:00:00', 'salida'),
(65, 3, '2025-12-05 09:00:00', 'entrada'),
(66, 3, '2025-12-05 18:00:00', 'salida'),
(67, 4, '2025-12-05 09:00:00', 'entrada'),
(68, 4, '2025-12-05 18:00:00', 'salida'),
(69, 5, '2025-12-05 09:00:00', 'entrada'),
(70, 5, '2025-12-05 18:00:00', 'salida'),
(75, 2, '2025-12-08 09:00:00', 'entrada'),
(76, 2, '2025-12-08 18:00:00', 'salida'),
(77, 3, '2025-12-08 09:00:00', 'entrada'),
(78, 3, '2025-12-08 18:00:00', 'salida'),
(79, 4, '2025-12-08 09:00:00', 'entrada'),
(80, 4, '2025-12-08 18:00:00', 'salida'),
(81, 5, '2025-12-08 09:00:00', 'entrada'),
(82, 5, '2025-12-08 18:00:00', 'salida'),
(87, 2, '2025-12-09 09:00:00', 'entrada'),
(88, 2, '2025-12-09 18:00:00', 'salida'),
(89, 3, '2025-12-09 09:00:00', 'entrada'),
(90, 3, '2025-12-09 18:00:00', 'salida'),
(91, 4, '2025-12-09 09:00:00', 'entrada'),
(92, 4, '2025-12-09 18:00:00', 'salida'),
(93, 5, '2025-12-09 09:00:00', 'entrada'),
(94, 5, '2025-12-09 18:00:00', 'salida'),
(99, 2, '2025-12-10 09:00:00', 'entrada'),
(100, 2, '2025-12-10 18:00:00', 'salida'),
(101, 3, '2025-12-10 09:00:00', 'entrada'),
(102, 3, '2025-12-10 18:00:00', 'salida'),
(103, 4, '2025-12-10 09:00:00', 'entrada'),
(104, 4, '2025-12-10 18:00:00', 'salida'),
(105, 5, '2025-12-10 09:00:00', 'entrada'),
(106, 5, '2025-12-10 18:00:00', 'salida'),
(111, 2, '2025-12-11 09:00:00', 'entrada'),
(112, 2, '2025-12-11 18:00:00', 'salida'),
(113, 3, '2025-12-11 09:00:00', 'entrada'),
(114, 3, '2025-12-11 18:00:00', 'salida'),
(115, 4, '2025-12-11 09:00:00', 'entrada'),
(116, 4, '2025-12-11 18:00:00', 'salida'),
(117, 5, '2025-12-11 09:00:00', 'entrada'),
(118, 5, '2025-12-11 18:00:00', 'salida'),
(123, 2, '2025-12-12 09:00:00', 'entrada'),
(124, 2, '2025-12-12 18:00:00', 'salida'),
(125, 3, '2025-12-12 09:00:00', 'entrada'),
(126, 3, '2025-12-12 18:00:00', 'salida'),
(127, 4, '2025-12-12 09:00:00', 'entrada'),
(128, 4, '2025-12-12 18:00:00', 'salida'),
(129, 5, '2025-12-12 09:00:00', 'entrada'),
(130, 5, '2025-12-12 18:00:00', 'salida'),
(155, 6, '2026-03-03 15:46:22', 'entrada'),
(156, 6, '2026-03-03 15:50:07', 'salida'),
(157, 6, '2026-03-03 15:51:24', 'entrada'),
(158, 6, '2026-03-03 15:53:06', 'salida'),
(159, 6, '2026-03-03 15:53:11', 'entrada'),
(160, 6, '2026-03-03 15:53:19', 'salida'),
(161, 7, '2026-03-04 13:23:09', 'entrada'),
(162, 7, '2026-03-04 13:31:40', 'salida'),
(163, 2, '2026-03-04 13:31:45', 'entrada'),
(164, 2, '2026-03-04 13:31:50', 'salida'),
(165, 7, '2026-03-04 13:31:54', 'entrada'),
(166, 7, '2026-03-05 13:31:15', 'entrada'),
(167, 7, '2026-03-08 08:12:04', 'entrada'),
(168, 5, '2026-03-08 08:12:14', 'entrada'),
(169, 2, '2026-03-08 08:12:22', 'entrada'),
(170, 2, '2026-03-08 08:13:31', 'salida'),
(171, 5, '2026-03-08 08:13:36', 'entrada'),
(172, 5, '2026-03-08 08:13:40', 'salida'),
(173, 7, '2026-03-08 08:13:46', 'entrada'),
(174, 7, '2026-03-08 08:14:21', 'salida'),
(175, 6, '2026-03-08 08:14:30', 'entrada'),
(176, 7, '2026-03-11 13:42:34', 'entrada'),
(177, 7, '2026-03-11 13:42:45', 'salida'),
(178, 2, '2026-03-11 13:43:09', 'entrada'),
(179, 2, '2026-03-11 15:27:57', 'salida'),
(180, 4, '2026-03-11 15:28:36', 'entrada'),
(181, 7, '2026-03-12 13:54:36', 'entrada'),
(182, 7, '2026-03-12 13:55:18', 'salida'),
(183, 2, '2026-03-12 13:55:22', 'entrada'),
(184, 2, '2026-03-12 13:55:34', 'salida'),
(185, 4, '2026-03-12 13:55:37', 'entrada'),
(186, 4, '2026-03-12 13:56:29', 'salida'),
(187, 7, '2026-03-12 13:56:33', 'entrada'),
(188, 49, '2026-03-13 12:57:28', 'entrada'),
(189, 7, '2026-03-16 12:02:51', 'entrada'),
(190, 7, '2026-03-17 08:25:05', 'entrada'),
(191, 7, '2026-03-17 10:36:44', 'salida'),
(192, 7, '2026-03-17 10:49:38', 'entrada'),
(193, 7, '2026-03-18 10:35:04', 'entrada'),
(194, 7, '2026-03-22 08:16:54', 'entrada'),
(195, 7, '2026-03-22 08:17:21', 'salida'),
(196, 6, '2026-03-22 08:17:46', 'entrada'),
(197, 7, '2026-03-23 12:23:52', 'entrada'),
(198, 7, '2026-03-23 13:02:26', 'salida'),
(199, 49, '2026-03-23 13:02:30', 'entrada'),
(200, 49, '2026-03-23 13:02:41', 'salida'),
(201, 2, '2026-03-23 13:02:46', 'entrada'),
(202, 2, '2026-03-23 13:04:57', 'salida'),
(203, 7, '2026-03-23 13:05:01', 'entrada'),
(204, 7, '2026-03-23 13:05:27', 'salida'),
(205, 2, '2026-03-23 13:05:31', 'entrada'),
(206, 2, '2026-03-23 13:11:25', 'salida'),
(207, 4, '2026-03-23 13:11:30', 'entrada'),
(208, 7, '2026-03-25 13:16:39', 'entrada'),
(209, 7, '2026-03-26 14:01:09', 'entrada'),
(210, 6, '2026-03-27 10:11:09', 'entrada'),
(211, 6, '2026-03-27 10:12:19', 'salida'),
(212, 7, '2026-03-27 10:12:24', 'entrada'),
(213, 7, '2026-03-27 10:16:17', 'salida'),
(214, 52, '2026-03-27 10:16:35', 'entrada'),
(215, 52, '2026-03-27 10:17:18', 'salida'),
(216, 7, '2026-03-27 10:17:22', 'entrada'),
(217, 7, '2026-03-27 10:17:46', 'salida'),
(218, 52, '2026-03-27 10:17:49', 'entrada'),
(219, 52, '2026-03-27 10:24:53', 'salida'),
(220, 7, '2026-03-27 10:24:56', 'entrada'),
(221, 7, '2026-03-29 08:53:43', 'entrada'),
(222, 7, '2026-03-29 08:56:31', 'entrada'),
(223, 7, '2026-03-30 09:07:24', 'entrada'),
(224, 7, '2026-03-30 09:15:08', 'salida'),
(225, 52, '2026-03-30 09:15:12', 'entrada'),
(226, 52, '2026-03-30 09:56:41', 'salida'),
(227, 6, '2026-03-30 09:56:47', 'entrada'),
(228, 6, '2026-03-30 09:56:48', 'salida'),
(229, 4, '2026-03-30 09:57:09', 'entrada'),
(230, 4, '2026-03-30 10:11:17', 'salida'),
(231, 4, '2026-03-30 10:11:22', 'entrada'),
(232, 7, '2026-03-31 10:58:43', 'entrada'),
(233, 7, '2026-03-31 11:14:27', 'salida'),
(234, 4, '2026-03-31 11:14:31', 'entrada'),
(235, 4, '2026-03-31 11:14:48', 'salida'),
(236, 7, '2026-03-31 11:14:54', 'entrada'),
(237, 7, '2026-03-31 11:30:55', 'salida'),
(238, 7, '2026-03-31 11:30:58', 'entrada'),
(239, 7, '2026-03-31 11:31:21', 'salida'),
(240, 7, '2026-03-31 11:31:41', 'entrada'),
(241, 7, '2026-03-31 11:33:01', 'salida'),
(242, 7, '2026-03-31 11:33:05', 'entrada'),
(243, 7, '2026-03-31 11:35:43', 'salida'),
(244, 4, '2026-03-31 11:35:47', 'entrada'),
(245, 4, '2026-03-31 11:35:51', 'salida'),
(246, 7, '2026-03-31 11:35:54', 'entrada'),
(247, 7, '2026-04-03 09:06:30', 'entrada'),
(248, 7, '2026-04-03 09:27:51', 'salida'),
(250, 7, '2026-04-03 10:02:59', 'entrada'),
(251, 7, '2026-04-03 10:17:11', 'salida'),
(254, 7, '2026-04-03 10:19:11', 'entrada'),
(255, 7, '2026-04-03 10:21:16', 'salida'),
(256, 73, '2026-04-03 10:21:20', 'entrada'),
(257, 7, '2026-04-03 10:38:17', 'entrada'),
(258, 7, '2026-04-07 08:15:03', 'entrada'),
(259, 7, '2026-04-07 14:12:24', 'entrada'),
(260, 7, '2026-04-08 13:03:36', 'entrada'),
(261, 7, '2026-04-08 13:55:10', 'salida'),
(262, 7, '2026-04-08 14:44:50', 'entrada'),
(263, 7, '2026-04-08 14:54:00', 'salida'),
(264, 40, '2026-04-08 14:54:09', 'entrada'),
(265, 40, '2026-04-08 14:54:10', 'salida'),
(266, 7, '2026-04-08 14:54:15', 'entrada'),
(267, 7, '2026-04-08 14:55:03', 'salida'),
(268, 40, '2026-04-08 14:55:12', 'entrada'),
(269, 7, '2026-04-09 11:13:02', 'entrada'),
(270, 7, '2026-04-10 13:42:58', 'entrada'),
(271, 7, '2026-04-14 12:00:12', 'entrada'),
(272, 7, '2026-04-14 12:20:55', 'salida'),
(273, 79, '2026-04-14 12:21:02', 'entrada'),
(274, 79, '2026-04-14 12:21:03', 'salida'),
(275, 7, '2026-04-14 12:21:07', 'entrada'),
(276, 7, '2026-04-14 12:43:59', 'salida'),
(277, 6, '2026-04-14 12:44:04', 'entrada'),
(278, 6, '2026-04-14 12:45:24', 'salida'),
(279, 40, '2026-04-14 12:45:33', 'entrada'),
(280, 40, '2026-04-14 12:45:36', 'salida'),
(281, 7, '2026-04-14 12:45:41', 'entrada'),
(282, 7, '2026-04-14 12:45:44', 'salida'),
(283, 7, '2026-04-14 12:52:06', 'entrada'),
(284, 7, '2026-04-22 09:12:48', 'entrada'),
(285, 7, '2026-04-22 09:13:25', 'salida'),
(286, 7, '2026-04-22 09:13:29', 'entrada'),
(287, 7, '2026-04-22 09:13:49', 'salida'),
(288, 7, '2026-04-22 09:13:56', 'entrada'),
(289, 7, '2026-04-22 09:17:17', 'salida'),
(290, 7, '2026-04-22 09:17:21', 'entrada'),
(291, 7, '2026-04-22 09:17:57', 'salida'),
(292, 7, '2026-04-22 09:18:01', 'entrada'),
(293, 7, '2026-04-22 09:20:52', 'salida'),
(294, 7, '2026-04-22 09:20:55', 'entrada'),
(295, 7, '2026-04-22 09:24:21', 'salida'),
(296, 7, '2026-04-22 09:24:26', 'entrada'),
(297, 7, '2026-04-22 09:24:29', 'salida'),
(298, 7, '2026-04-22 09:24:32', 'entrada'),
(299, 73, '2026-04-22 11:16:53', 'entrada'),
(300, 73, '2026-04-22 11:17:47', 'salida'),
(301, 73, '2026-04-22 11:17:51', 'entrada'),
(302, 73, '2026-04-22 12:13:50', 'salida'),
(303, 51, '2026-04-22 12:14:06', 'entrada'),
(304, 51, '2026-04-22 12:15:03', 'salida'),
(305, 7, '2026-04-22 12:15:06', 'entrada'),
(306, 7, '2026-04-22 12:15:14', 'salida'),
(307, 2, '2026-04-22 12:15:19', 'entrada'),
(308, 2, '2026-04-22 12:22:01', 'salida'),
(309, 7, '2026-04-22 12:22:05', 'entrada'),
(310, 7, '2026-04-22 12:54:49', 'salida'),
(311, 73, '2026-04-23 13:32:36', 'entrada'),
(312, 73, '2026-04-23 13:37:42', 'salida'),
(313, 2, '2026-04-23 13:37:45', 'entrada'),
(314, 2, '2026-04-23 13:38:37', 'salida'),
(315, 7, '2026-04-23 13:38:41', 'entrada'),
(316, 7, '2026-04-23 13:39:01', 'salida'),
(317, 47, '2026-04-23 13:39:18', 'entrada'),
(318, 47, '2026-04-23 13:39:35', 'salida'),
(319, 7, '2026-04-23 13:39:39', 'entrada'),
(320, 7, '2026-04-23 13:41:47', 'salida'),
(321, 7, '2026-04-29 12:48:06', 'entrada'),
(322, 7, '2026-04-29 13:02:20', 'salida'),
(323, 2, '2026-04-29 13:02:23', 'entrada'),
(324, 7, '2026-05-04 08:04:29', 'entrada'),
(325, 7, '2026-05-04 08:06:10', 'salida'),
(326, 4, '2026-05-04 08:06:18', 'entrada'),
(327, 4, '2026-05-04 08:06:31', 'salida'),
(328, 2, '2026-05-04 08:06:36', 'entrada'),
(329, 2, '2026-05-04 08:07:37', 'salida'),
(330, 7, '2026-05-04 08:07:41', 'entrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `cod_incidencia` int(11) NOT NULL,
  `cod_empleado_reportante` int(11) NOT NULL,
  `cod_empleado_gestor` int(11) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `gravedad` enum('leve','moderada','grave','urgente') DEFAULT 'grave',
  `atendida` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_creacion` datetime NOT NULL,
  `fecha_resolucion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`cod_incidencia`, `cod_empleado_reportante`, `cod_empleado_gestor`, `descripcion`, `gravedad`, `atendida`, `fecha_creacion`, `fecha_resolucion`) VALUES
(2, 2, NULL, 'Quiero cambiar mi contraseña por \"qwerty\"', 'leve', 0, '2025-11-04 10:15:00', NULL),
(3, 6, NULL, 'No se ve de desplegable', 'moderada', 0, '2025-11-24 11:00:00', NULL),
(4, 4, NULL, 'Quiero 30 dias de vacaciones', 'leve', 0, '2025-12-22 11:45:00', NULL),
(5, 2, 6, 'El ordenador no enciende', 'grave', 1, '2026-02-27 13:30:00', '2026-03-01 11:00:00'),
(6, 3, 6, 'Problema con acceso al correo corporativo', 'moderada', 1, '2026-03-01 10:15:00', '2026-03-04 12:00:00'),
(7, 49, 7, 'Me duele la cabeza', 'leve', 1, '2026-03-13 13:38:39', '2026-03-27 10:16:02'),
(9, 52, 7, 'Falta informacion del departamento recursos humanos', 'grave', 1, '2026-03-27 10:24:51', '2026-03-27 10:25:06'),
(10, 52, NULL, 'necesito que me arreglen el teclado', 'urgente', 0, '2026-03-30 09:35:12', NULL),
(11, 52, NULL, 'reporte de prueba para testeo', 'leve', 0, '2026-03-30 09:56:08', NULL),
(12, 2, 7, 'los desplegables de la seccion departamento no funcionan al clickar \"ver mas\"', 'grave', 1, '2026-04-23 13:38:25', '2026-04-23 13:39:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominas`
--

CREATE TABLE `nominas` (
  `cod_nomina` int(11) NOT NULL,
  `cod_empleado` int(11) NOT NULL,
  `periodo` date NOT NULL,
  `sueldo_base` decimal(10,2) NOT NULL,
  `complementos` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cont_comun` decimal(10,2) NOT NULL DEFAULT 0.00,
  `formacion` decimal(10,2) NOT NULL DEFAULT 0.00,
  `desempleo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `irpf` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nominas`
--

INSERT INTO `nominas` (`cod_nomina`, `cod_empleado`, `periodo`, `sueldo_base`, `complementos`, `cont_comun`, `formacion`, `desempleo`, `irpf`, `total`) VALUES
(2, 2, '2026-01-01', 2200.00, 350.00, 110.00, 20.00, 40.00, 300.00, 2080.00),
(3, 6, '2026-01-01', 1500.00, 100.00, 75.00, 12.00, 25.00, 180.00, 1308.00),
(5, 2, '2026-02-01', 2200.00, 350.00, 110.00, 20.00, 40.00, 300.00, 2080.00),
(6, 6, '2026-02-01', 1500.00, 100.00, 75.00, 12.00, 25.00, 180.00, 1308.00),
(8, 2, '2025-12-01', 2200.00, 350.00, 110.00, 20.00, 40.00, 300.00, 2080.00),
(9, 6, '2025-12-01', 1500.00, 100.00, 75.00, 12.00, 25.00, 180.00, 1308.00),
(10, 3, '2026-01-01', 2200.00, 0.00, 103.40, 2.20, 34.10, 330.00, 1730.30),
(11, 3, '2026-02-01', 2200.00, 0.00, 103.40, 2.20, 34.10, 330.00, 1730.30),
(12, 3, '2025-12-01', 2200.00, 0.00, 103.40, 2.20, 34.10, 330.00, 1730.30),
(13, 4, '2026-01-01', 3200.00, 0.00, 150.40, 3.20, 49.60, 480.00, 2516.80),
(14, 4, '2026-02-01', 3200.00, 0.00, 150.40, 3.20, 49.60, 480.00, 2516.80),
(15, 4, '2025-11-01', 3200.00, 0.00, 150.40, 3.20, 49.60, 480.00, 2516.80),
(16, 5, '2026-01-01', 3500.00, 0.00, 164.50, 3.50, 54.25, 525.00, 2752.75),
(17, 5, '2026-02-01', 3500.00, 0.00, 164.50, 3.50, 54.25, 525.00, 2752.75),
(18, 5, '2025-12-12', 3500.00, 0.00, 164.50, 3.50, 54.25, 525.00, 2752.75),
(19, 7, '2026-01-31', 1500.00, 200.00, 100.00, 20.00, 30.00, 250.00, 1300.00),
(20, 7, '2026-02-28', 1500.00, 200.00, 100.00, 20.00, 30.00, 250.00, 1300.00),
(21, 7, '2026-03-31', 1500.00, 200.00, 100.00, 20.00, 30.00, 250.00, 1300.00),
(25, 74, '2026-04-28', 1200.00, 100.00, 56.40, 1.20, 18.60, 132.00, 1091.80),
(28, 54, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(29, 73, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(30, 74, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(31, 39, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(32, 43, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(33, 45, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(34, 47, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(35, 51, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(36, 52, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(37, 50, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(38, 38, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(39, 41, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(40, 46, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(41, 49, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(42, 42, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(43, 48, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(44, 40, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(45, 44, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(46, 53, '2026-02-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(47, 76, '2026-02-28', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(59, 54, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(60, 73, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(61, 74, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(62, 39, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(63, 43, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(64, 45, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(65, 47, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(66, 51, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(67, 52, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(68, 50, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(69, 38, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(70, 41, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(71, 46, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(72, 49, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(73, 42, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(74, 48, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(75, 40, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(76, 44, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(77, 53, '2026-03-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(78, 76, '2026-03-28', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(94, 49, '2026-04-01', 1500.00, 180.00, 70.50, 2.25, 23.25, 165.00, 1419.00),
(96, 79, '2026-04-29', 1800.00, 199.99, 84.60, 2.70, 27.90, 342.00, 1542.79),
(126, 2, '2026-03-01', 2200.00, 350.00, 110.00, 20.00, 40.00, 300.00, 2080.00),
(127, 3, '2026-03-01', 2200.00, 0.00, 103.40, 2.20, 34.10, 330.00, 1730.30),
(128, 6, '2026-03-01', 1500.00, 100.00, 75.00, 12.00, 25.00, 180.00, 1308.00),
(129, 4, '2026-03-01', 3200.00, 0.00, 150.40, 3.20, 49.60, 480.00, 2516.80),
(130, 5, '2026-03-01', 3500.00, 0.00, 164.50, 3.50, 54.25, 525.00, 2752.75),
(132, 2, '2026-04-01', 2200.00, 350.00, 110.00, 20.00, 40.00, 300.00, 2080.00),
(225, 3, '2026-04-01', 2200.00, 0.00, 103.40, 2.20, 34.10, 330.00, 1730.30),
(226, 4, '2026-04-01', 3200.00, 0.00, 150.40, 3.20, 49.60, 480.00, 2516.80),
(227, 5, '2026-04-01', 3500.00, 0.00, 164.50, 3.50, 54.25, 525.00, 2752.75),
(228, 6, '2026-04-01', 1500.00, 100.00, 75.00, 12.00, 25.00, 180.00, 1308.00),
(229, 38, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(230, 39, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(231, 40, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(232, 41, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(233, 42, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(234, 43, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(235, 44, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(236, 45, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(237, 46, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(238, 47, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(239, 48, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(240, 50, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(241, 51, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(242, 52, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(243, 53, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(244, 54, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(256, 76, '2026-04-28', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(257, 7, '2026-04-30', 1500.00, 200.00, 100.00, 20.00, 30.00, 250.00, 1300.00),
(258, 73, '2026-04-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(259, 7, '2026-05-30', 2000.00, 220.00, 95.00, 3.00, 31.00, 380.00, 1711.00),
(260, 2, '2026-05-01', 2200.00, 350.00, 110.00, 20.00, 40.00, 300.00, 2080.00),
(261, 3, '2026-05-01', 2200.00, 0.00, 103.40, 2.20, 34.10, 330.00, 1730.30),
(262, 4, '2026-05-01', 3200.00, 0.00, 150.40, 3.20, 49.60, 480.00, 2516.80),
(263, 5, '2026-05-01', 3500.00, 0.00, 164.50, 3.50, 54.25, 525.00, 2752.75),
(264, 6, '2026-05-01', 1500.00, 100.00, 75.00, 12.00, 25.00, 180.00, 1308.00),
(265, 38, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(266, 39, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(267, 40, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(268, 41, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(269, 42, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(270, 43, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(271, 44, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(272, 45, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(273, 46, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(274, 47, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(275, 48, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(276, 49, '2026-05-01', 1500.00, 180.00, 70.50, 2.25, 23.25, 165.00, 1419.00),
(277, 50, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(278, 51, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(279, 52, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(280, 53, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(281, 54, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(282, 73, '2026-05-01', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(283, 74, '2026-05-28', 1200.00, 100.00, 56.40, 1.20, 18.60, 132.00, 1091.80),
(284, 76, '2026-05-28', 1300.00, 100.00, 61.10, 1.30, 20.15, 143.00, 1174.45),
(285, 79, '2026-05-29', 1800.00, 199.99, 84.60, 2.70, 27.90, 342.00, 1542.79);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`cod_departamento`),
  ADD KEY `fk_jefe_departamento_empleado` (`cod_jefe_departamento`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`cod_empleado`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `fk_empleado_departamento` (`cod_departamento`);

--
-- Indices de la tabla `fichajes`
--
ALTER TABLE `fichajes`
  ADD PRIMARY KEY (`cod_fichaje`),
  ADD KEY `fk_fichaje_empleado` (`cod_empleado`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`cod_incidencia`),
  ADD KEY `fk_incidencia_empleado_gestor` (`cod_empleado_gestor`),
  ADD KEY `fk_incidencia_empleado_reportante` (`cod_empleado_reportante`);

--
-- Indices de la tabla `nominas`
--
ALTER TABLE `nominas`
  ADD PRIMARY KEY (`cod_nomina`),
  ADD UNIQUE KEY `cod_empleado` (`cod_empleado`,`periodo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `cod_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `cod_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `fichajes`
--
ALTER TABLE `fichajes`
  MODIFY `cod_fichaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `cod_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `nominas`
--
ALTER TABLE `nominas`
  MODIFY `cod_nomina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `fk_jefe_departamento_empleado` FOREIGN KEY (`cod_jefe_departamento`) REFERENCES `empleados` (`cod_empleado`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_empleado_departamento` FOREIGN KEY (`cod_departamento`) REFERENCES `departamentos` (`cod_departamento`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `fichajes`
--
ALTER TABLE `fichajes`
  ADD CONSTRAINT `fk_fichaje_empleado` FOREIGN KEY (`cod_empleado`) REFERENCES `empleados` (`cod_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `fk_incidencia_empleado_gestor` FOREIGN KEY (`cod_empleado_gestor`) REFERENCES `empleados` (`cod_empleado`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_incidencia_empleado_reportante` FOREIGN KEY (`cod_empleado_reportante`) REFERENCES `empleados` (`cod_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nominas`
--
ALTER TABLE `nominas`
  ADD CONSTRAINT `fk_nomina_empleado` FOREIGN KEY (`cod_empleado`) REFERENCES `empleados` (`cod_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
