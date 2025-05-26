-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2025 a las 09:09:16
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
-- Base de datos: `bibliotec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `id` int(11) NOT NULL,
  `numero_control` varchar(20) NOT NULL,
  `nombre_libro` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `editorial` varchar(255) NOT NULL,
  `fecha_solicitud` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carritos`
--

INSERT INTO `carritos` (`id`, `numero_control`, `nombre_libro`, `autor`, `editorial`, `fecha_solicitud`) VALUES
(1, '20231234', 'Sistemas de potencia', 'Woodson', 'Wiley', '2025-05-26'),
(2, '20231234', 'Estabilidad de sistemas eléctricos', 'Kundur', 'McGraw-Hill', '2025-05-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `editorial` varchar(100) DEFAULT NULL,
  `area` enum('quimica','mecanica','sistemas','electrica') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `editorial`, `area`) VALUES
(1, 'calculos diferenciales', 'juan', 'ito', 'quimica'),
(2, 'Contratacion Cafeteria', 'juan', 'ito', 'mecanica'),
(3, 'cumpleaños', 'juan', 'ito', 'mecanica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librosa`
--

CREATE TABLE `librosa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `editorial` varchar(255) NOT NULL,
  `area` enum('Quimica','Mecanica','Sistemas','Electrica') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `librosa`
--

INSERT INTO `librosa` (`id`, `nombre`, `autor`, `editorial`, `area`) VALUES
(1, 'Algoritmos', 'Donald Knuth', 'Addison-Wesley', 'Sistemas'),
(2, 'Estructuras de datos', 'Thomas Cormen', 'MIT Press', 'Sistemas'),
(3, 'Programación avanzada', 'José García', 'McGraw-Hill', 'Sistemas'),
(4, 'Matemáticas discretas', 'Kenneth Rosen', 'McGraw-Hill', 'Sistemas'),
(5, 'Sistemas operativos', 'Andrew Tanenbaum', 'Pearson', 'Sistemas'),
(6, 'Redes de computadoras', 'Abraham Silberschatz', 'Wiley', 'Sistemas'),
(7, 'Ingeniería de software', 'Robert C. Martin', 'Prentice Hall', 'Sistemas'),
(8, 'Bases de datos', 'Elmasri & Navathe', 'Pearson', 'Sistemas'),
(9, 'Compiladores', 'Alfred V. Aho', 'Addison-Wesley', 'Sistemas'),
(10, 'Análisis de algoritmos', 'Robert Sedgewick', 'Addison-Wesley', 'Sistemas'),
(11, 'Sistemas de potencia', 'Woodson', 'Wiley', 'Electrica'),
(12, 'Estabilidad de sistemas eléctricos', 'Kundur', 'McGraw-Hill', 'Electrica'),
(13, 'Control automático', 'Muhammad', 'Pearson', 'Electrica'),
(14, 'Sistemas de control', 'Bolton', 'Pearson', 'Electrica'),
(15, 'Electrónica analógica', 'Savitzky', 'McGraw-Hill', 'Electrica'),
(16, 'Transformadores', 'Hughes', 'Wiley', 'Electrica'),
(17, 'Circuitos eléctricos', 'Ghosh', 'McGraw-Hill', 'Electrica'),
(18, 'Máquinas eléctricas', 'Sauer', 'McGraw-Hill', 'Electrica'),
(19, 'Electromagnetismo', 'Young', 'Pearson', 'Electrica'),
(20, 'Electricidad básica', 'Nagarajan', 'McGraw-Hill', 'Electrica'),
(21, 'Mecánica de materiales', 'Roark', 'McGraw-Hill', 'Mecanica'),
(22, 'Diseño de máquinas', 'Shigley', 'McGraw-Hill', 'Mecanica'),
(23, 'Mecánica vectorial', 'Beer', 'McGraw-Hill', 'Mecanica'),
(24, 'Termodinámica', 'Fox', 'Wiley', 'Mecanica'),
(25, 'Dinámica', 'Meriam', 'Wiley', 'Mecanica'),
(26, 'Mecánica de fluidos', 'White', 'McGraw-Hill', 'Mecanica'),
(27, 'Resistencia de materiales', 'Hibbeler', 'Pearson', 'Mecanica'),
(28, 'Física para ingeniería', 'Kleppner', 'Cambridge', 'Mecanica'),
(29, 'Transferencia de calor', 'Chapra', 'McGraw-Hill', 'Mecanica'),
(30, 'Vibraciones mecánicas', 'Merriam', 'Wiley', 'Mecanica'),
(31, 'Termodinámica química', 'Peter Atkins / Julio de Paula', 'McGraw-Hill', 'Quimica'),
(32, 'Procesos químicos', 'Richard M. Felder, Ronald W. Rousseau', 'McGraw-Hill', 'Quimica'),
(33, 'Ingeniería de procesos', 'Warren D. Seider', 'Wiley', 'Quimica'),
(34, 'Reacciones químicas', 'Octave Levenspiel', 'Wiley', 'Quimica'),
(35, 'Diseño de plantas químicas', 'Max S. Peters, Klaus D. Timmerhaus', 'McGraw-Hill', 'Quimica'),
(36, 'Fenómenos de transporte', 'Robert B. Bird, Warren E. Stewart, Edwin N. Lightfoot', 'Wiley', 'Quimica'),
(37, 'Ingeniería bioquímica', 'James M. Lee', 'Cambridge University Press', 'Quimica'),
(38, 'Dinámica de procesos', 'Dale E. Seborg, Thomas F. Edgar', 'Wiley', 'Quimica'),
(39, 'Balances de materia', 'B. I. Bhatt', 'McGraw-Hill', 'Quimica'),
(40, 'Equilibrio químico', 'Stanley I. Sandler', 'Wiley', 'Quimica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `control` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` enum('alumno','profesor','administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `control`, `nombre`, `password`, `tipo`) VALUES
(1, '21010945', 'francisco', '123456789', 'alumno'),
(2, '21010', 'luis', '123456789', 'alumno'),
(3, '12', 'admin', '1', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `librosa`
--
ALTER TABLE `librosa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `control` (`control`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `librosa`
--
ALTER TABLE `librosa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
