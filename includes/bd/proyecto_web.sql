-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 04:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyecto_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacto`
--

CREATE TABLE `contacto` (
  `idContacto` int(11) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacto`
--

INSERT INTO `contacto` (`idContacto`, `Telefono`, `Email`) VALUES
(1, '5580153735', 'rossetteismael@gmail.com'),
(2, '5580153735', 'rossetteismael@gmail.com'),
(3, '5580153735', 'rossetteismael@gmail.com'),
(4, '5580153735', 'rossetteismael@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `datospersonales`
--

CREATE TABLE `datospersonales` (
  `idDatosPersonales` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `RFC` varchar(20) DEFAULT NULL,
  `EstadoCivil` varchar(50) DEFAULT NULL,
  `CURP` varchar(20) DEFAULT NULL,
  `idDomicilio` int(11) DEFAULT NULL,
  `idContacto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datospersonales`
--

INSERT INTO `datospersonales` (`idDatosPersonales`, `Nombre`, `Edad`, `RFC`, `EstadoCivil`, `CURP`, `idDomicilio`, `idContacto`) VALUES
(1, 'Mailo', 12, 'UPDJ951225QX8', 'Soltero', 'ROZI030705HDFSAAAA', 2, 2),
(2, 'Mailongo', 32, 'Mailogon123', 'Casao', 'ROZI030705HDFSAAAA', 3, 3),
(3, 'Mailo Papitas', 12, 'LACU590927WI9', 'Viudo', 'ROZI030705HDFSAAAA', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `direccion`
--

CREATE TABLE `direccion` (
  `idDireccion` int(11) NOT NULL,
  `Pais` varchar(100) DEFAULT NULL,
  `Ciudad` varchar(100) DEFAULT NULL,
  `AlcaldiaMunicipio` varchar(100) DEFAULT NULL,
  `Calle` varchar(100) DEFAULT NULL,
  `NumeroExterior` varchar(20) DEFAULT NULL,
  `NumeroInterior` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `direccion`
--

INSERT INTO `direccion` (`idDireccion`, `Pais`, `Ciudad`, `AlcaldiaMunicipio`, `Calle`, `NumeroExterior`, `NumeroInterior`) VALUES
(1, 'Ciudad de México', 'Centro', 'Milpa Alta', 'Camino Real a San Pedro Atocpan', '43', '43'),
(2, 'Ciudad de México', 'Centro', 'Milpa Alta', 'Camino Real a San Pedro Atocpan', '43', '43'),
(3, 'Ciudad de México', 'Miguel Hidalgo', 'Tláhuac', 'Camino Real a San Pedro Atocpan', '43', '12'),
(4, 'Ciudad de México', 'Centro', 'Milpa Alta', 'Camino Real a San Pedro Atocpan', '43', '');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(350) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `id_rol`, `fecha`) VALUES
(18, 'ismael', '$2y$10$M/k553jAgBFqUlFe8225CO8oHF01w/bdtBZa/pTYskOq95Q.h52jO', 1, '2025-04-15 23:31:51'),
(19, 'hadita', '$2y$10$9FDqQnCRqRUq0b//QUkzeO/NH.HKp.fMz7FiwzmGBFheBEESg0dRy', 2, '2025-04-14 03:06:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idContacto`);

--
-- Indexes for table `datospersonales`
--
ALTER TABLE `datospersonales`
  ADD PRIMARY KEY (`idDatosPersonales`),
  ADD KEY `idDomicilio` (`idDomicilio`),
  ADD KEY `idContacto` (`idContacto`);

--
-- Indexes for table `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`idDireccion`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `datospersonales`
--
ALTER TABLE `datospersonales`
  MODIFY `idDatosPersonales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `direccion`
--
ALTER TABLE `direccion`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `datospersonales`
--
ALTER TABLE `datospersonales`
  ADD CONSTRAINT `datospersonales_ibfk_1` FOREIGN KEY (`idDomicilio`) REFERENCES `direccion` (`idDireccion`) ON DELETE CASCADE,
  ADD CONSTRAINT `datospersonales_ibfk_2` FOREIGN KEY (`idContacto`) REFERENCES `contacto` (`idContacto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
