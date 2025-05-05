-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2025 a las 12:00:06
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
-- Base de datos: `sheltra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `description` varchar(225) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `entry_date` date NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `animals`
--

INSERT INTO `animals` (`id`, `name`, `type`, `age`, `sex`, `size`, `description`, `foto`, `entry_date`, `state`) VALUES
(5, 'Nube', 'Roedor', '1', 'Hembra', 'Grande', 'Nube es un conejo juguetón y curioso. Le encanta explorar y comer zanahorias. Es ideal para familias con niños pequeños.', 'https://content.elmueble.com/medio/2025/03/18/conejo-enano-belier_0c663703_250318172443_900x900.webp', '2025-05-05', 'Adopción activa'),
(6, 'Luna', 'Gato', '3', 'Hembra', 'Pequeno', 'Luna es una gata juguetona y curiosa. Le encanta perseguir luces y descansar en lugares altos. Es ideal para familias que buscan una mascota activa y cariñosa.', 'https://www.zooplus.es/magazine/wp-content/uploads/2022/01/Psicologia-felina.jpeg', '2025-05-05', 'Adopción activa'),
(7, 'Max', 'Perro', '4', 'Macho', 'Mediano', 'Max es un perro leal y protector. Le encanta jugar al aire libre y es perfecto para familias activas que buscan un compañero energético.', 'https://panchoskitchen.com/cdn/shop/articles/perro-con-la-lengua-afuera-mirando-hacia-arriba.png?v=1677637524', '2025-05-05', 'Adopción activa'),
(8, 'Simba', 'Gato', '7', 'Macho', 'Mediano', 'Simba es un gato curioso y juguetón. Le encanta explorar y es ideal para hogares que buscan una mascota activa y divertida.', 'https://urgenciesveterinaries.com/wp-content/uploads/2023/09/survet-gato-caida-pelo-01.jpeg', '2025-05-05', 'Adopción activa'),
(9, 'Shelly', 'Reptil', '10', 'Hembra', 'Grande', 'Shelly es una tortuga tranquila y fácil de cuidar. Es perfecta para personas que buscan una mascota de bajo mantenimiento.', 'https://cdn0.expertoanimal.com/es/posts/6/3/3/especies_de_tortugas_de_tierra_20336_600.webp', '2025-05-05', 'Adopción activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_animal` int(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `resolution` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donations`
--

CREATE TABLE `donations` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_shelter` int(255) NOT NULL,
  `amount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `animal` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shelters`
--

CREATE TABLE `shelters` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `phone` int(9) NOT NULL,
  `address` varchar(255) NOT NULL,
  `bank_acc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `DNI`, `phone`, `address`, `bank_acc`) VALUES
(1, 'Lua', 'lua@gmail.com', '$2y$10$sHFYY94N.JkGwONB61zjIeXmGL939aa2.XyM2Z6q0MqmUxRq/2x4.', '12345678K', 123456789, 'Calle Lua, 44', 'ES98 7654 3219 8765 4321'),
(2, 'Vega', 'vega@gmail.com', '$2y$10$RBR6M9v40Xx7HSThTlyAAu/eVC8soHu.6S5do5qxGLn1UC98Lzrxy', '98765432S', 987654321, 'Calle Vega, 33', 'ES12 3456 7891 2345 6789'),
(3, 'Sonia', 'sonia@gmail.com', '$2y$10$5dYH6jzgi7pxQD0YvcOci./3ZapZ52TmsJC2ucwExloVWX6MSKlRe', '33333333F', 333333333, 'Calle Sonia, 55', 'ES33 3333 3333 3333 3333'),
(5, 'Lidia', 'lidia@gmail.com', '$2y$10$3GqcoJxcWMvDk.mPo/CJ/uoPWRvhXb7Cxdd12uXhsn4oiIAj94KGO', '11223344Q', 112233445, 'Calle Lidia, 77', 'ES12 1212 1212 1212 1212');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
