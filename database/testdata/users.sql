-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 mei 2022 om 14:21
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emphasis`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `password`, `isAdmin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Quinn Jaskolski', 'lsenger@example.net', '2022-05-20 10:20:52', '0250655716', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'IyqY3RPLpX', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(2, 'Ms. Bette Waelchi', 'predovic.murphy@example.com', '2022-05-20 10:20:52', '2492123571', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'Clrp0UUey5', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(3, 'Cruz Feest Sr.', 'ioberbrunner@example.net', '2022-05-20 10:20:52', '9808061416', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'JjDlPJlkew', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(4, 'Marquis Lehner', 'maria58@example.com', '2022-05-20 10:20:52', '4427068163', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'EsJgI4d4cQ', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(5, 'Dr. Doug Will', 'flatley.orville@example.org', '2022-05-20 10:20:52', '2049224495', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'R2NskJIciC', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(6, 'Lia Murray MD', 'broderick36@example.org', '2022-05-20 10:20:52', '1456990437', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, '0ubq4upJ45', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(7, 'Sonia Hilpert PhD', 'krunolfsdottir@example.org', '2022-05-20 10:20:52', '7430877918', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'hWzbQR1lFD', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(8, 'Justus White V', 'yblanda@example.com', '2022-05-20 10:20:52', '7635574991', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'reRCsGfNc1', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(9, 'Eden Schinner', 'maverick99@example.org', '2022-05-20 10:20:52', '2441398061', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'TamXN28cji', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(10, 'Liliane Wyman', 'nona.dooley@example.com', '2022-05-20 10:20:52', '1736838959', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'tNw34zaPvY', '2022-05-20 10:20:52', '2022-05-20 10:20:52'),
(11, 'Admin', 'admin@account.com', '2022-05-20 10:20:52', '0612341234', '$2y$10$9LfA/C5kMZ7OBZ4MWC3nWupEpss4LsguES4SOH8KojpzODtjrHCNm', 1, 'ptkCwhPFyt', NULL, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
