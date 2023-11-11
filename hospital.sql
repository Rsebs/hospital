-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2023 a las 05:27:32
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bills`
--

CREATE TABLE `bills` (
  `ordered_id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `ordered_description` varchar(255) NOT NULL,
  `ordered_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bills`
--

INSERT INTO `bills` (`ordered_id`, `pat_id`, `doc_id`, `medicine_id`, `ordered_description`, `ordered_amount`) VALUES
(1, 1, 1, 1, 'El paciente sufre de dolores de cabeza. Se le recomienda que tome una pastilla de Acetaminofén cada 8 horas. Si el dolor persiste debe de consultarse de nuevo.', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctors`
--

CREATE TABLE `doctors` (
  `doc_id` int(11) NOT NULL,
  `doc_document` varchar(255) NOT NULL,
  `doc_firstName` varchar(100) NOT NULL,
  `doc_secondName` varchar(100) DEFAULT NULL,
  `doc_firstLastName` varchar(100) NOT NULL,
  `doc_secondLastName` varchar(100) DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `doc_email` varchar(255) DEFAULT NULL,
  `doc_number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doctors`
--

INSERT INTO `doctors` (`doc_id`, `doc_document`, `doc_firstName`, `doc_secondName`, `doc_firstLastName`, `doc_secondLastName`, `gender_id`, `doc_email`, `doc_number`) VALUES
(1, '1000758181', 'Sebastián', '', 'Ruiz', 'Jaramillo', 1, 'sebastianruizj2014@gmail.com', '3025301357');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genders`
--

CREATE TABLE `genders` (
  `gender_id` int(11) NOT NULL,
  `gender_cod` char(10) NOT NULL,
  `gender_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genders`
--

INSERT INTO `genders` (`gender_id`, `gender_cod`, `gender_name`) VALUES
(1, 'M', 'Masculino'),
(2, 'F', 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `medicine_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `medicine_name`, `medicine_description`) VALUES
(1, 'Acetaminofén', 'Se usa para aliviar el dolor leve o moderado de las cefaleas, dolores musculares, períodos menstruales, resfriados, y los dolores de garganta, , muelas, espalda, así como de las reacciones a las vacunas (inyecciones) y para reducir la fiebre.'),
(2, 'Naproxeno', 'Se usa para reducir la fiebre y aliviar los dolores leves por cefaleas, dolores musculares, artritis, periodos menstruales, resfriado común; dolor de muelas y dolor de espalda.'),
(3, 'Loratadina', 'Alivia los síntomas asociados a la rinitis alérgica (por ejemplo, fiebre del heno) tales como estornudos, goteo o picor nasal y escozor o picor en los ojos en adultos y niños mayores de 6 años, que pesen más de 30 kg.'),
(4, 'Amoxicilina', 'Se usa para tratar ciertas infecciones causadas por bacterias, como la neumonía, la bronquitis (infección de las vías respiratorias que van a los pulmones) y las infecciones de los oídos, la nariz, la garganta, las vías urinarias y la piel.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patients`
--

CREATE TABLE `patients` (
  `pat_id` int(11) NOT NULL,
  `pat_document` varchar(255) NOT NULL,
  `pat_firstName` varchar(100) NOT NULL,
  `pat_secondName` varchar(100) DEFAULT NULL,
  `pat_firstLastName` varchar(100) NOT NULL,
  `pat_secondLastName` varchar(100) DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `pat_email` varchar(255) DEFAULT NULL,
  `pat_number` varchar(10) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `patients`
--

INSERT INTO `patients` (`pat_id`, `pat_document`, `pat_firstName`, `pat_secondName`, `pat_firstLastName`, `pat_secondLastName`, `gender_id`, `pat_email`, `pat_number`, `doc_id`) VALUES
(1, '1000758173', 'Juan', 'Fernando', 'Ruiz', 'Jaramillo', 1, 'juanruiz@gmail.com', '3025301357', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_userName` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_userName`, `user_password`) VALUES
(1, 'Rsebs', '$2y$10$nbV25/.sB1Ahqj.4wbetT.vgbkXmLOsey6Zj7gQmTDbStgq6N0ZHC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`ordered_id`),
  ADD KEY `orderedPatId_patId` (`pat_id`),
  ADD KEY `orderedDoctorId_docId` (`doc_id`),
  ADD KEY `orderedMedicineId_medicineId` (`medicine_id`);

--
-- Indices de la tabla `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doc_id`),
  ADD UNIQUE KEY `doc_document` (`doc_document`),
  ADD KEY `docGenderId_genderId` (`gender_id`);

--
-- Indices de la tabla `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`),
  ADD UNIQUE KEY `gender_cod` (`gender_cod`),
  ADD UNIQUE KEY `gender_name` (`gender_name`);

--
-- Indices de la tabla `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`),
  ADD UNIQUE KEY `medicine_name` (`medicine_name`);

--
-- Indices de la tabla `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`pat_id`),
  ADD UNIQUE KEY `pat_document` (`pat_document`),
  ADD KEY `patGenderId_genderId` (`gender_id`),
  ADD KEY `patDoctorId_doctorId` (`doc_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_userName` (`user_userName`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bills`
--
ALTER TABLE `bills`
  MODIFY `ordered_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `patients`
--
ALTER TABLE `patients`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `orderedDoctorId_docId` FOREIGN KEY (`doc_id`) REFERENCES `doctors` (`doc_id`),
  ADD CONSTRAINT `orderedMedicineId_medicineId` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`medicine_id`),
  ADD CONSTRAINT `orderedPatId_patId` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`pat_id`);

--
-- Filtros para la tabla `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `docGenderId_genderId` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`);

--
-- Filtros para la tabla `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patDoctorId_doctorId` FOREIGN KEY (`doc_id`) REFERENCES `doctors` (`doc_id`),
  ADD CONSTRAINT `patGenderId_genderId` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
