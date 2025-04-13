-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Feb 04. 08:55
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `aranyhaj`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `information` varchar(350) DEFAULT NULL,
  `image_name` varchar(50) DEFAULT NULL,
  `posted_time` datetime NOT NULL DEFAULT current_timestamp(),
  `starts_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `events`
--

INSERT INTO `events` (`id`, `title`, `location`, `information`, `image_name`, `posted_time`, `starts_at`) VALUES
(1, 'Hajvágás Akció!', 'Budapest', '20% kedvezmény minden hajvágásra a hét végéig!', 'hajvagas.jpg', '2025-01-15 09:00:00', '2025-01-20 09:00:00'),
(2, 'Új szolgáltatás: manikűr', 'Debrecen', 'Próbáld ki új manikűr szolgáltatásunkat kedvezményes áron!', 'manikur.jpg', '2025-01-12 14:30:00', '2025-01-18 10:00:00'),
(3, 'Esküvői frizurák', 'Szeged', 'Esküvőre készül? Látogasson el szalonunkba egyedi frizurákért!', 'eskuvoi_frizura.jpg', '2025-01-10 08:00:00', '2025-02-01 08:00:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `interactions`
--

CREATE TABLE `interactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `liked` int(1) DEFAULT NULL,
  `liked_time` datetime NOT NULL DEFAULT current_timestamp(),
  `watched` int(1) DEFAULT NULL,
  `watched_time` datetime NOT NULL DEFAULT current_timestamp(),
  `participation` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `interactions`
--

INSERT INTO `interactions` (`id`, `user_id`, `event_id`, `liked`, `liked_time`, `watched`, `watched_time`, `participation`) VALUES
(1, 2, 1, 1, '2025-02-03 10:31:37', 1, '2025-02-03 10:31:37', 0),
(2, 4, 2, 0, '2025-02-03 10:33:00', 1, '2025-02-03 10:33:00', 1),
(3, 5, 3, 0, '2025-02-03 10:33:00', 1, '2025-02-03 10:33:00', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `salons`
--

CREATE TABLE `salons` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `salon_name` varchar(100) NOT NULL,
  `image_name` varchar(50) NOT NULL DEFAULT 'salon.png',
  `information` varchar(350) NOT NULL,
  `city` varchar(21) NOT NULL,
  `street` varchar(80) NOT NULL,
  `zip_code` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `salons`
--

INSERT INTO `salons` (`id`, `owner_id`, `salon_name`, `image_name`, `information`, `city`, `street`, `zip_code`) VALUES
(1, 5, 'Nyugati aluljáró', 'nyuagi.png', 'Gyeretek komáim a Nyugati aluljáróba!', 'Gyál', 'Semmilyen', 0),
(2, 2, 'Penyik Barber', 'Maszek.png', 'Nincs végzetségem, ne köpjetek be. Danke schön!', 'Ócsán', 'Ócsai utca', 2364);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(38) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `image_name` varchar(255) NOT NULL DEFAULT 'foto.png',
  `admin` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `address`, `password`, `image_name`, `admin`, `created_at`) VALUES
(1, 'PenyikMetin', 'penyik@kft.com', 'Ócsa', '911', 'penyikAuto.png', 0, '2025-02-03 10:24:18'),
(2, 'PetReb', 'petReb@autosJogsi.com', 'Falván', '112', 'autosrEBEKA.jpg', 0, '2025-02-03 10:25:24'),
(3, 'Ani', 'ani@fil.com', 'Havannához közel', 'havanna', 'filak.jpg', 0, '2025-02-03 10:27:28'),
(4, 'Ash', 'axolotl@ash.com', 'Gyáli akváriumban', 'Kaja', 'ashIsCute.png', 1, '2025-02-03 10:27:28'),
(5, 'Nojé', 'nojé@gmail.com', 'Nyugati aluljáró', 'melegfedő', 'Nyugati.png', 0, '2025-02-03 10:28:28');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `interactions_ibfk_2` (`event_id`);

--
-- A tábla indexei `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `interactions`
--
ALTER TABLE `interactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `salons`
--
ALTER TABLE `salons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `interactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `interactions_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `salons`
--
ALTER TABLE `salons`
  ADD CONSTRAINT `salons_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
