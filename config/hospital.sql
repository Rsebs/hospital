-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2023 a las 02:34:28
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
  `id` int(11) NOT NULL,
  `pat_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `edit_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genders`
--

CREATE TABLE `genders` (
  `id` int(11) NOT NULL,
  `cod` char(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `edit_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `genders`
--

INSERT INTO `genders` (`id`, `cod`, `name`, `create_date`, `edit_date`) VALUES
(1, 'M', 'Masculino', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(2, 'F', 'Femenino', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(3, 'O', 'Otro', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(4, 'N', 'No Binario', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(5, 'A', 'Ambiguo', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(6, 'C', 'Preferir no decir', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(7, 'T', 'Transgénero', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(8, 'B', 'Bigénero', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(9, 'D', 'Dual', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(10, 'P', 'Poligénero', '2023-11-17 01:32:51', '2023-11-17 01:32:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `edit_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `description`, `create_date`, `edit_date`) VALUES
(1, 'Acetaminofén', 'Se usa para aliviar el dolor leve o moderado de las cefaleas, dolores musculares, períodos menstruales, resfriados, y los dolores de garganta, , muelas, espalda, así como de las reacciones a las vacunas (inyecciones) y para reducir la fiebre.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(2, 'Naproxeno', 'Se usa para reducir la fiebre y aliviar los dolores leves por cefaleas, dolores musculares, artritis, periodos menstruales, resfriado común; dolor de muelas y dolor de espalda.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(3, 'Loratadina', 'Alivia los síntomas asociados a la rinitis alérgica (por ejemplo, fiebre del heno) tales como estornudos, goteo o picor nasal y escozor o picor en los ojos en adultos y niños mayores de 6 años, que pesen más de 30 kg.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(4, 'Amoxicilina', 'Se usa para tratar ciertas infecciones causadas por bacterias, como la neumonía, la bronquitis (infección de las vías respiratorias que van a los pulmones) y las infecciones de los oídos, la nariz, la garganta, las vías urinarias y la piel.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(5, 'Ibuprofeno', 'Se utiliza para aliviar el dolor y reducir la fiebre causados por diversas condiciones como dolor de cabeza, dolor de muelas, dolor menstrual, lesiones leves y artritis.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(6, 'Omeprazol', 'Ayuda a reducir la producción de ácido en el estómago y se utiliza para tratar condiciones como la acidez estomacal, el reflujo gastroesofágico (ERGE) y úlceras estomacales.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(7, 'Dipirona', 'Es un analgésico y antipirético que se utiliza para aliviar el dolor y reducir la fiebre.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(8, 'Dexametasona', 'Es un corticosteroide que se utiliza para tratar diversas condiciones inflamatorias y alérgicas, así como para suprimir el sistema inmunológico en algunos casos.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(9, 'Paracetamol', 'Se utiliza para aliviar el dolor leve a moderado y reducir la fiebre. También puede utilizarse para tratar condiciones como el resfriado común y la gripe.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(10, 'Cetirizina', 'Se utiliza para aliviar los síntomas de la alergia, como estornudos, picazón en los ojos o la nariz, y goteo nasal; también se usa para tratar la urticaria y picazón en la piel.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(11, 'Aspirina', 'Se utiliza para aliviar el dolor, reducir la fiebre y tratar la inflamación. También puede ser utilizada en la prevención de enfermedades cardiovasculares.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(12, 'Ranitidina', 'Ayuda a reducir la producción de ácido en el estómago y se utiliza para tratar la acidez estomacal, úlceras estomacales y el reflujo gastroesofágico (ERGE).', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(13, 'Ciprofloxacino', 'Es un antibiótico que se utiliza para tratar diversas infecciones bacterianas, incluyendo infecciones del tracto urinario y respiratorio.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(14, 'Metformina', 'Se utiliza para tratar la diabetes tipo 2 al ayudar a controlar los niveles de azúcar en la sangre. También puede ser utilizada para el síndrome de ovario poliquístico (SOP).', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(15, 'Clonazepam', 'Es un medicamento anticonvulsivo utilizado para tratar trastornos epilépticos y trastornos de ansiedad.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(16, 'Atorvastatina', 'Se utiliza para reducir los niveles elevados de colesterol y triglicéridos en la sangre, así como para prevenir enfermedades cardiovasculares.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(17, 'Losartán', 'Es un medicamento utilizado para tratar la hipertensión arterial y reducir el riesgo de accidentes cerebrovasculares en personas con presión arterial alta y problemas del corazón.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(18, 'Alprazolam', 'Es un ansiolítico utilizado para tratar trastornos de ansiedad y pánico. También puede ser utilizado como coadyuvante en el tratamiento de la depresión.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(19, 'Escitalopram', 'Es un antidepresivo utilizado para tratar trastornos depresivos y de ansiedad, como el trastorno de ansiedad generalizada.', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(20, 'Warfarina', 'Es un anticoagulante utilizado para prevenir la formación de coágulos sanguíneos y tratar ciertos problemas de coagulación.', '2023-11-17 01:32:51', '2023-11-17 01:32:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `second_name` varchar(100) DEFAULT NULL,
  `first_last_name` varchar(100) NOT NULL,
  `second_last_name` varchar(100) DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `edit_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `patients`
--

INSERT INTO `patients` (`id`, `document`, `first_name`, `second_name`, `first_last_name`, `second_last_name`, `gender_id`, `email`, `contact_number`, `create_date`, `edit_date`) VALUES
(1, '1000100', 'John', 'Doe', 'Smith', 'Miller', 1, 'john.doe@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(2, '1000101', 'Jane', 'Doe', 'Johnson', 'Brown', 2, 'jane.doe@example.com', '9876543210', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(3, '1000102', 'Michael', 'Jackson', 'Williams', 'Taylor', 1, 'michael.jackson@example.com', '1112223333', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(4, '1000103', 'Emily', 'Williams', 'Davis', 'Jones', 2, 'emily.williams@example.com', '4445556666', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(5, '1000104', 'Robert', 'Smith', 'Johnson', 'Anderson', 1, 'robert.smith@example.com', '7778889999', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(6, '1000105', 'Sophia', 'Johnson', 'Wilson', 'Lee', 2, 'sophia.johnson@example.com', '1239874560', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(7, '1000106', 'Matthew', 'Taylor', 'Martinez', 'Garcia', 1, 'matthew.taylor@example.com', '9876541230', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(8, '1000107', 'Olivia', 'Brown', 'White', 'Clark', 2, 'olivia.brown@example.com', '3214567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(9, '1000108', 'Daniel', 'Jones', 'Martinez', 'Thomas', 1, 'daniel.jones@example.com', '6543217890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(10, '1000109', 'Ava', 'Miller', 'Harris', 'Johnson', 2, 'ava.miller@example.com', '9871234560', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(11, '1000110', 'Ethan', 'Thomas', 'Davis', 'Garcia', 1, 'ethan.thomas@example.com', '7894561230', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(12, '1000111', 'Isabella', 'Clark', 'Anderson', 'Harris', 2, 'isabella.clark@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(13, '1000112', 'William', 'Anderson', 'Brown', 'Taylor', 1, 'william.anderson@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(14, '1000113', 'Mia', 'Garcia', 'Smith', 'Thomas', 2, 'mia.garcia@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(15, '1000114', 'Alexander', 'Harris', 'Johnson', 'Davis', 1, 'alexander.harris@example.com', '6789012345', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(16, '1000115', 'Grace', 'Lee', 'Miller', 'Clark', 2, 'grace.lee@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(17, '1000116', 'James', 'Wilson', 'White', 'Jones', 1, 'james.wilson@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(18, '1000117', 'Avery', 'Thomas', 'Brown', 'Williams', 2, 'avery.thomas@example.com', '5678901234', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(19, '1000118', 'Scarlett', 'Davis', 'Anderson', 'Garcia', 2, 'scarlett.davis@example.com', '8901234567', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(20, '1000119', 'Logan', 'Miller', 'Jackson', 'Taylor', 1, 'logan.miller@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(21, '1000120', 'Ella', 'Johnson', 'Jones', 'Wilson', 2, 'ella.johnson@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(22, '1000121', 'Benjamin', 'Smith', 'Martinez', 'Brown', 1, 'benjamin.smith@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(23, '1000122', 'Liam', 'Taylor', 'Martinez', 'Clark', 1, 'liam.taylor@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(24, '1000123', 'Chloe', 'Jones', 'Anderson', 'Miller', 2, 'chloe.jones@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(25, '1000124', 'Christopher', 'Brown', 'Wilson', 'Harris', 1, 'christopher.brown@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(26, '1000125', 'Aria', 'Anderson', 'Garcia', 'Smith', 2, 'aria.anderson@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(27, '1000126', 'Henry', 'Garcia', 'Harris', 'Jones', 1, 'henry.garcia@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(28, '1000127', 'Aubrey', 'Williams', 'Davis', 'Miller', 2, 'aubrey.williams@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(29, '1000128', 'Jackson', 'Thomas', 'Clark', 'White', 1, 'jackson.thomas@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(30, '1000129', 'Penelope', 'Clark', 'Johnson', 'Taylor', 2, 'penelope.clark@example.com', '5678901234', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(31, '1000130', 'Wyatt', 'Miller', 'Brown', 'Jones', 1, 'wyatt.miller@example.com', '6789012345', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(32, '1000131', 'Sofia', 'Harris', 'Taylor', 'Garcia', 2, 'sofia.harris@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(33, '1000132', 'Oliver', 'Jones', 'Martinez', 'Wilson', 1, 'oliver.jones@example.com', '8901234567', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(34, '1000133', 'Emma', 'Garcia', 'Taylor', 'Harris', 2, 'emma.garcia@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(35, '1000134', 'Lucas', 'Brown', 'Clark', 'Miller', 1, 'lucas.brown@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(36, '1000135', 'Avery', 'Smith', 'Williams', 'Thomas', 2, 'avery.smith@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(37, '1000136', 'Evelyn', 'Davis', 'Anderson', 'Jones', 2, 'evelyn.davis@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(38, '1000137', 'Mason', 'Thomas', 'Garcia', 'Harris', 1, 'mason.thomas@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(39, '1000138', 'Harper', 'Miller', 'Wilson', 'Clark', 2, 'harper.miller@example.com', '5678901234', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(40, '1000139', 'Landon', 'Johnson', 'Brown', 'Taylor', 1, 'landon.johnson@example.com', '6789012345', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(41, '1000140', 'Addison', 'Harris', 'Jones', 'Davis', 2, 'addison.harris@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(42, '1000141', 'Carter', 'Wilson', 'Smith', 'Anderson', 1, 'carter.wilson@example.com', '8901234567', '2023-11-17 01:32:51', '2023-11-17 01:32:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personals`
--

CREATE TABLE `personals` (
  `id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `second_name` varchar(100) DEFAULT NULL,
  `first_last_name` varchar(100) NOT NULL,
  `second_last_name` varchar(100) DEFAULT NULL,
  `gender_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `edit_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personals`
--

INSERT INTO `personals` (`id`, `document`, `first_name`, `second_name`, `first_last_name`, `second_last_name`, `gender_id`, `email`, `contact_number`, `create_date`, `edit_date`) VALUES
(1, '1000100', 'John', 'Doe', 'Smith', 'Miller', 1, 'john.doe@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(2, '1000101', 'Jane', 'Doe', 'Johnson', 'Brown', 2, 'jane.doe@example.com', '9876543210', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(3, '1000102', 'Michael', 'Jackson', 'Williams', 'Taylor', 1, 'michael.jackson@example.com', '1112223333', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(4, '1000103', 'Emily', 'Williams', 'Davis', 'Jones', 2, 'emily.williams@example.com', '4445556666', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(5, '1000104', 'Robert', 'Smith', 'Johnson', 'Anderson', 1, 'robert.smith@example.com', '7778889999', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(6, '1000105', 'Sophia', 'Johnson', 'Wilson', 'Lee', 2, 'sophia.johnson@example.com', '1239874560', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(7, '1000106', 'Matthew', 'Taylor', 'Martinez', 'Garcia', 1, 'matthew.taylor@example.com', '9876541230', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(8, '1000107', 'Olivia', 'Brown', 'White', 'Clark', 2, 'olivia.brown@example.com', '3214567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(9, '1000108', 'Daniel', 'Jones', 'Martinez', 'Thomas', 1, 'daniel.jones@example.com', '6543217890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(10, '1000109', 'Ava', 'Miller', 'Harris', 'Johnson', 2, 'ava.miller@example.com', '9871234560', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(11, '1000110', 'Ethan', 'Thomas', 'Davis', 'Garcia', 1, 'ethan.thomas@example.com', '7894561230', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(12, '1000111', 'Isabella', 'Clark', 'Anderson', 'Harris', 2, 'isabella.clark@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(13, '1000112', 'William', 'Anderson', 'Brown', 'Taylor', 1, 'william.anderson@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(14, '1000113', 'Mia', 'Garcia', 'Smith', 'Thomas', 2, 'mia.garcia@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(15, '1000114', 'Alexander', 'Harris', 'Johnson', 'Davis', 1, 'alexander.harris@example.com', '6789012345', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(16, '1000115', 'Grace', 'Lee', 'Miller', 'Clark', 2, 'grace.lee@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(17, '1000116', 'James', 'Wilson', 'White', 'Jones', 1, 'james.wilson@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(18, '1000117', 'Avery', 'Thomas', 'Brown', 'Williams', 2, 'avery.thomas@example.com', '5678901234', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(19, '1000118', 'Scarlett', 'Davis', 'Anderson', 'Garcia', 2, 'scarlett.davis@example.com', '8901234567', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(20, '1000119', 'Logan', 'Miller', 'Jackson', 'Taylor', 1, 'logan.miller@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(21, '1000120', 'Ella', 'Johnson', 'Jones', 'Wilson', 2, 'ella.johnson@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(22, '1000121', 'Benjamin', 'Smith', 'Martinez', 'Brown', 1, 'benjamin.smith@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(23, '1000122', 'Liam', 'Taylor', 'Martinez', 'Clark', 1, 'liam.taylor@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(24, '1000123', 'Chloe', 'Jones', 'Anderson', 'Miller', 2, 'chloe.jones@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(25, '1000124', 'Christopher', 'Brown', 'Wilson', 'Harris', 1, 'christopher.brown@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(26, '1000125', 'Aria', 'Anderson', 'Garcia', 'Smith', 2, 'aria.anderson@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(27, '1000126', 'Henry', 'Garcia', 'Harris', 'Jones', 1, 'henry.garcia@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(28, '1000127', 'Aubrey', 'Williams', 'Davis', 'Miller', 2, 'aubrey.williams@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(29, '1000128', 'Jackson', 'Thomas', 'Clark', 'White', 1, 'jackson.thomas@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(30, '1000129', 'Penelope', 'Clark', 'Johnson', 'Taylor', 2, 'penelope.clark@example.com', '5678901234', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(31, '1000130', 'Wyatt', 'Miller', 'Brown', 'Jones', 1, 'wyatt.miller@example.com', '6789012345', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(32, '1000131', 'Sofia', 'Harris', 'Taylor', 'Garcia', 2, 'sofia.harris@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(33, '1000132', 'Oliver', 'Jones', 'Martinez', 'Wilson', 1, 'oliver.jones@example.com', '8901234567', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(34, '1000133', 'Emma', 'Garcia', 'Taylor', 'Harris', 2, 'emma.garcia@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(35, '1000134', 'Lucas', 'Brown', 'Clark', 'Miller', 1, 'lucas.brown@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(36, '1000135', 'Avery', 'Smith', 'Williams', 'Thomas', 2, 'avery.smith@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(37, '1000136', 'Evelyn', 'Davis', 'Anderson', 'Jones', 2, 'evelyn.davis@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(38, '1000137', 'Mason', 'Thomas', 'Garcia', 'Harris', 1, 'mason.thomas@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(39, '1000138', 'Harper', 'Miller', 'Wilson', 'Clark', 2, 'harper.miller@example.com', '5678901234', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(40, '1000139', 'Landon', 'Johnson', 'Brown', 'Taylor', 1, 'landon.johnson@example.com', '6789012345', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(41, '1000140', 'Addison', 'Harris', 'Jones', 'Davis', 2, 'addison.harris@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(42, '1000141', 'Carter', 'Wilson', 'Smith', 'Anderson', 1, 'carter.wilson@example.com', '8901234567', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(43, '1000142', 'Grace', 'Anderson', 'Taylor', 'Smith', 2, 'grace.anderson@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(44, '1000143', 'Lucas', 'Johnson', 'Miller', 'Clark', 1, 'lucas.johnson@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(45, '1000144', 'Aria', 'Smith', 'Davis', 'Thomas', 2, 'aria.smith@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(46, '1000145', 'Leo', 'Garcia', 'Brown', 'Jones', 1, 'leo.garcia@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(47, '1000146', 'Stella', 'Smith', 'Davis', 'Miller', 2, 'stella.smith@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(48, '1000147', 'Nathan', 'Johnson', 'Martinez', 'Wilson', 1, 'nathan.johnson@example.com', '5678901234', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(49, '1000148', 'Hazel', 'Miller', 'Anderson', 'Harris', 2, 'hazel.miller@example.com', '6789012345', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(50, '1000149', 'Caleb', 'Thomas', 'Clark', 'Brown', 1, 'caleb.thomas@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(51, '1000150', 'Luna', 'Harris', 'Taylor', 'Garcia', 2, 'luna.harris@example.com', '8901234567', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(52, '1000151', 'Jack', 'Brown', 'Jones', 'Smith', 1, 'jack.brown@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(53, '1000152', 'Aurora', 'Garcia', 'Miller', 'Davis', 2, 'aurora.garcia@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(54, '1000153', 'Elijah', 'Taylor', 'Clark', 'Jones', 1, 'elijah.taylor@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(55, '1000154', 'Madison', 'Jones', 'Harris', 'Wilson', 2, 'madison.jones@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(56, '1000155', 'Owen', 'Harris', 'Anderson', 'Thomas', 1, 'owen.harris@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(57, '1000156', 'Scarlet', 'Miller', 'Johnson', 'Brown', 2, 'scarlet.miller@example.com', '5678901234', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(58, '1000157', 'Isaac', 'Thomas', 'Clark', 'Garcia', 1, 'isaac.thomas@example.com', '6789012345', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(59, '1000158', 'Nova', 'Garcia', 'Wilson', 'Jones', 2, 'nova.garcia@example.com', '7890123456', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(60, '1000159', 'Cameron', 'Johnson', 'Miller', 'Smith', 1, 'cameron.johnson@example.com', '8901234567', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(61, '1000160', 'Aaliyah', 'Smith', 'Harris', 'Taylor', 2, 'aaliyah.smith@example.com', '9012345678', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(62, '1000161', 'Gabriel', 'Harris', 'Davis', 'Jones', 1, 'gabriel.harris@example.com', '1234567890', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(63, '1000162', 'Lily', 'Jones', 'Taylor', 'Clark', 2, 'lily.jones@example.com', '2345678901', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(64, '1000163', 'Max', 'Brown', 'Smith', 'Johnson', 1, 'max.brown@example.com', '3456789012', '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(65, '1000164', 'Sophie', 'Johnson', 'Garcia', 'Miller', 2, 'sophie.johnson@example.com', '4567890123', '2023-11-17 01:32:51', '2023-11-17 01:32:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `edit_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_pass`, `last_login`, `create_date`, `edit_date`) VALUES
(1, 'user01', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(2, 'user02', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(3, 'user03', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(4, 'user04', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(5, 'user05', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(6, 'user06', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(7, 'user07', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(8, 'user08', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(9, 'user09', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(10, 'user10', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(11, 'user11', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(12, 'user12', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(13, 'user13', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(14, 'user14', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(15, 'user15', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(16, 'user16', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(17, 'user17', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(18, 'user18', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(19, 'user19', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(20, 'user20', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(21, 'user21', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(22, 'user22', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(23, 'user23', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(24, 'user24', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(25, 'user25', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(26, 'user26', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(27, 'user27', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(28, 'user28', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(29, 'user29', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(30, 'user30', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(31, 'user31', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(32, 'user32', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(33, 'user33', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(34, 'user34', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(35, 'user35', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(36, 'user36', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(37, 'user37', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(38, 'user38', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(39, 'user39', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(40, 'user40', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(41, 'user41', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(42, 'user42', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(43, 'user43', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(44, 'user44', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(45, 'user45', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(46, 'user46', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(47, 'user47', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(48, 'user48', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(49, 'user49', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(50, 'user50', 'pass', NULL, '2023-11-17 01:32:51', '2023-11-17 01:32:51'),
(51, 'Rsebs', '$2y$10$WvtZl2yehSO.H4WnwdvgzO5hH.xDyj4W1XhdD8gma0rM.ConTkCwu', '2023-11-16 20:33:06', '2023-11-17 01:32:59', '2023-11-17 01:33:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pat_id` (`pat_id`),
  ADD KEY `per_id` (`per_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indices de la tabla `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cod` (`cod`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document` (`document`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indices de la tabla `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document` (`document`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `personals`
--
ALTER TABLE `personals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`id`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`per_id`) REFERENCES `personals` (`id`),
  ADD CONSTRAINT `bills_ibfk_3` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`);

--
-- Filtros para la tabla `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`);

--
-- Filtros para la tabla `personals`
--
ALTER TABLE `personals`
  ADD CONSTRAINT `personals_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
