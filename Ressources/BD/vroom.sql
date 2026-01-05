-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2025 at 02:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

CREATE TABLE `annonces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_conducteur` bigint(20) UNSIGNED NOT NULL,
  `id_vehicule` bigint(20) UNSIGNED NOT NULL,
  `date_depart` date NOT NULL,
  `heure_depart` time NOT NULL,
  `datetime_depart` datetime NOT NULL,
  `prix_par_personne` decimal(10,2) NOT NULL,
  `places_disponibles` int(11) NOT NULL,
  `description` text NOT NULL,
  `id_lieu_depart` bigint(20) UNSIGNED NOT NULL,
  `id_lieu_arrivee` bigint(20) UNSIGNED NOT NULL,
  `statut` enum('active','complete','annulee','expiree') DEFAULT 'active',
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annonces`
--

INSERT INTO `annonces` (`id`, `id_conducteur`, `id_vehicule`, `date_depart`, `heure_depart`, `datetime_depart`, `prix_par_personne`, `places_disponibles`, `description`, `id_lieu_depart`, `id_lieu_arrivee`, `statut`, `date_creation`) VALUES
(1, 1, 1, '2025-07-01', '08:00:00', '2025-07-01 08:00:00', 50.00, 3, 'Trajet Casablanca → Rabat', 1, 2, 'active', '2025-12-26 10:51:52'),
(2, 2, 2, '2025-07-02', '14:30:00', '2025-07-02 14:30:00', 80.00, 2, 'Trajet Rabat → Marrakech', 2, 3, 'complete', '2025-12-26 10:51:52'),
(3, 4, 3, '2025-07-03', '09:00:00', '2025-07-03 09:00:00', 60.00, 3, 'Agadir → Marrakech', 4, 3, 'complete', '2025-12-26 10:55:21'),
(4, 5, 4, '2025-07-04', '07:30:00', '2025-07-04 07:30:00', 40.00, 2, 'Fès → Rabat', 5, 2, 'complete', '2025-12-26 10:55:21'),
(5, 6, 5, '2025-07-05', '16:00:00', '2025-07-05 16:00:00', 90.00, 3, 'Tanger → Casablanca', 6, 1, 'complete', '2025-12-26 10:55:21');

INSERT INTO `annonces` (`id`, `id_conducteur`, `id_vehicule`, `date_depart`, `heure_depart`, `datetime_depart`, `prix_par_personne`, `places_disponibles`, `description`, `id_lieu_depart`, `id_lieu_arrivee`, `statut`, `date_creation`) VALUES
(6, 1, 2, '2026-01-06', '08:00:00', '2026-01-06 08:00:00', 30.00, 3, 'Paris → Lyon', 201, 202, 'active', '2026-01-01 10:00:00'),
(7, 2, 3, '2026-01-07', '09:00:00', '2026-01-07 09:00:00', 25.00, 2, 'Marseille → Nice', 203, 204, 'active', '2026-01-01 10:00:00'),
(8, 3, 1, '2026-01-08', '07:30:00', '2026-01-08 07:30:00', 40.00, 3, 'Bordeaux → Toulouse', 205, 206, 'active', '2026-01-01 10:00:00'),
(9, 4, 4, '2026-01-09', '10:00:00', '2026-01-09 10:00:00', 20.00, 2, 'Nantes → Rennes', 207, 208, 'active', '2026-01-01 10:00:00'),
(10, 5, 5, '2026-01-10', '11:30:00', '2026-01-10 11:30:00', 35.00, 3, 'Strasbourg → Metz', 209, 210, 'active', '2026-01-01 10:00:00'),

(11, 6, 2, '2026-01-11', '13:00:00', '2026-01-11 13:00:00', 28.00, 2, 'Lille → Amiens', 211, 212, 'active', '2026-01-01 10:00:00'),
(12, 1, 3, '2026-01-12', '15:30:00', '2026-01-12 15:30:00', 45.00, 3, 'Toulouse → Montpellier', 206, 213, 'active', '2026-01-01 10:00:00'),
(13, 2, 4, '2026-01-13', '09:45:00', '2026-01-13 09:45:00', 50.00, 2, 'Paris → Bordeaux', 201, 205, 'active', '2026-01-01 10:00:00'),
(14, 3, 5, '2026-01-14', '08:30:00', '2026-01-14 08:30:00', 22.00, 3, 'Nice → Cannes', 204, 214, 'active', '2026-01-01 10:00:00'),
(15, 4, 1, '2026-01-15', '14:15:00', '2026-01-15 14:15:00', 32.00, 2, 'Lyon → Grenoble', 202, 215, 'active', '2026-01-01 10:00:00'),

(16, 5, 2, '2026-01-16', '07:45:00', '2026-01-16 07:45:00', 18.00, 3, 'Rennes → Brest', 208, 216, 'active', '2026-01-01 10:00:00'),
(17, 6, 3, '2026-01-17', '10:30:00', '2026-01-17 10:30:00', 55.00, 2, 'Marseille → Avignon', 203, 217, 'active', '2026-01-01 10:00:00'),
(18, 1, 4, '2026-01-18', '12:00:00', '2026-01-18 12:00:00', 27.00, 3, 'Lille → Calais', 211, 218, 'active', '2026-01-01 10:00:00'),
(19, 2, 5, '2026-01-19', '16:00:00', '2026-01-19 16:00:00', 38.00, 2, 'Bordeaux → Angoulême', 205, 219, 'active', '2026-01-01 10:00:00'),
(20, 3, 1, '2026-01-20', '09:15:00', '2026-01-20 09:15:00', 42.00, 3, 'Toulouse → Pau', 206, 220, 'active', '2026-01-01 10:00:00'),

(21, 4, 2, '2026-01-21', '11:30:00', '2026-01-21 11:30:00', 29.00, 2, 'Nice → Toulon', 204, 221, 'active', '2026-01-01 10:00:00'),
(22, 5, 3, '2026-01-22', '14:00:00', '2026-01-22 14:00:00', 33.00, 3, 'Paris → Chartres', 201, 222, 'active', '2026-01-01 10:00:00'),
(23, 6, 4, '2026-01-23', '08:15:00', '2026-01-23 08:15:00', 47.00, 2, 'Montpellier → Nîmes', 213, 223, 'active', '2026-01-01 10:00:00'),
(24, 1, 5, '2026-01-24', '10:00:00', '2026-01-24 10:00:00', 25.00, 3, 'Nantes → La Rochelle', 207, 224, 'active', '2026-01-01 10:00:00'),
(25, 2, 1, '2026-01-25', '13:30:00', '2026-01-25 13:30:00', 60.00, 2, 'Strasbourg → Colmar', 209, 225, 'active', '2026-01-01 10:00:00'),

(26, 3, 2, '2026-01-26', '09:45:00', '2026-01-26 09:45:00', 48.00, 3, 'Grenoble → Valence', 215, 226, 'active', '2026-01-01 10:00:00'),
(27, 4, 3, '2026-01-27', '15:00:00', '2026-01-27 15:00:00', 44.00, 2, 'Brest → Quimper', 216, 227, 'active', '2026-01-01 10:00:00'),
(28, 5, 4, '2026-01-28', '07:30:00', '2026-01-28 07:30:00', 23.00, 3, 'Rennes → Angers', 208, 228, 'active', '2026-01-01 10:00:00'),
(29, 6, 5, '2026-01-29', '17:10:00', '2026-01-29 17:10:00', 50.00, 2, 'Toulouse → Carcassonne', 206, 229, 'active', '2026-01-01 10:00:00'),
(30, 1, 1, '2026-01-30', '12:45:00', '2026-01-30 12:45:00', 35.00, 3, 'Lyon → Clermont-Ferrand', 202, 230, 'active', '2026-01-01 10:00:00'),

(31, 2, 2, '2026-01-31', '08:30:00', '2026-01-31 08:30:00', 41.00, 2, 'Paris → Lille', 201, 211, 'active', '2026-01-01 10:00:00'),
(32, 3, 3, '2026-02-01', '16:00:00', '2026-02-01 16:00:00', 27.00, 3, 'La Rochelle → Royan', 224, 231, 'active', '2026-01-01 10:00:00'),
(33, 4, 4, '2026-02-02', '10:15:00', '2026-02-02 10:15:00', 30.00, 2, 'Chartres → Orléans', 222, 232, 'active', '2026-01-01 10:00:00'),
(34, 5, 5, '2026-02-03', '14:45:00', '2026-02-03 14:45:00', 55.00, 3, 'Marseille → Lyon', 203, 202, 'active', '2026-01-01 10:00:00'),
(35, 6, 1, '2026-02-04', '09:00:00', '2026-02-04 09:00:00', 38.00, 2, 'Nîmes → Montpellier', 223, 213, 'active', '2026-01-01 10:00:00');

INSERT INTO `annonces` (`id`, `id_conducteur`, `id_vehicule`, `date_depart`, `heure_depart`, `datetime_depart`, `prix_par_personne`, `places_disponibles`, `description`, `id_lieu_depart`, `id_lieu_arrivee`, `statut`, `date_creation`) VALUES
(36, 1, 2, '2026-02-10', '08:15:00', '2026-02-10 08:15:00', 28.00, 3, 'Paris → Orléans', 201, 232, 'active', '2026-01-01 10:00:00'),
(37, 2, 3, '2026-03-05', '09:30:00', '2026-03-05 09:30:00', 42.00, 2, 'Lyon → Annecy', 202, 233, 'active', '2026-01-01 10:00:00'),
(38, 3, 1, '2026-04-18', '07:00:00', '2026-04-18 07:00:00', 55.00, 3, 'Paris → Reims', 201, 234, 'active', '2026-01-01 10:00:00'),
(39, 4, 4, '2026-05-22', '10:45:00', '2026-05-22 10:45:00', 35.00, 2, 'Nantes → Angers', 207, 228, 'active', '2026-01-01 10:00:00'),
(40, 5, 5, '2026-06-12', '14:00:00', '2026-06-12 14:00:00', 65.00, 3, 'Bordeaux → Limoges', 205, 235, 'active', '2026-01-01 10:00:00'),

(41, 6, 2, '2026-07-03', '16:30:00', '2026-07-03 16:30:00', 48.00, 2, 'Toulouse → Albi', 206, 236, 'active', '2026-01-01 10:00:00'),
(42, 1, 3, '2026-08-19', '08:00:00', '2026-08-19 08:00:00', 72.00, 3, 'Paris → Strasbourg', 201, 209, 'active', '2026-01-01 10:00:00'),
(43, 2, 4, '2026-09-01', '11:15:00', '2026-09-01 11:15:00', 58.00, 2, 'Marseille → Gap', 203, 237, 'active', '2026-01-01 10:00:00'),
(44, 3, 5, '2026-10-14', '15:00:00', '2026-10-14 15:00:00', 80.00, 3, 'Lille → Paris', 211, 201, 'active', '2026-01-01 10:00:00'),
(45, 4, 1, '2026-11-06', '07:45:00', '2026-11-06 07:45:00', 46.00, 2, 'Grenoble → Chambéry', 215, 238, 'active', '2026-01-01 10:00:00'),

(46, 5, 2, '2026-12-20', '09:00:00', '2026-12-20 09:00:00', 95.00, 3, 'Paris → Marseille', 201, 203, 'active', '2026-01-01 10:00:00'),
(47, 6, 3, '2027-01-15', '13:30:00', '2027-01-15 13:30:00', 52.00, 2, 'Nice → Antibes', 204, 239, 'active', '2026-01-01 10:00:00'),
(48, 1, 4, '2027-02-08', '10:00:00', '2027-02-08 10:00:00', 68.00, 3, 'Dijon → Lyon', 240, 202, 'active', '2026-01-01 10:00:00'),
(49, 2, 5, '2027-03-27', '17:15:00', '2027-03-27 17:15:00', 40.00, 2, 'Poitiers → Tours', 241, 242, 'active', '2026-01-01 10:00:00'),
(50, 3, 1, '2027-04-11', '08:30:00', '2027-04-11 08:30:00', 75.00, 3, 'Rennes → Caen', 208, 243, 'active', '2026-01-01 10:00:00'),

(51, 4, 2, '2027-05-09', '14:45:00', '2027-05-09 14:45:00', 60.00, 2, 'Montpellier → Perpignan', 213, 244, 'active', '2026-01-01 10:00:00'),
(52, 5, 3, '2027-06-21', '07:30:00', '2027-06-21 07:30:00', 85.00, 3, 'Paris → Clermont-Ferrand', 201, 230, 'active', '2026-01-01 10:00:00'),
(53, 6, 4, '2027-07-02', '12:00:00', '2027-07-02 12:00:00', 33.00, 2, 'Avignon → Arles', 217, 245, 'active', '2026-01-01 10:00:00'),
(54, 1, 5, '2027-08-16', '16:00:00', '2027-08-16 16:00:00', 90.00, 3, 'Nice → Marseille', 204, 203, 'active', '2026-01-01 10:00:00'),
(55, 2, 1, '2027-09-04', '09:15:00', '2027-09-04 09:15:00', 50.00, 2, 'Le Mans → Laval', 246, 247, 'active', '2026-01-01 10:00:00'),

(56, 3, 2, '2027-10-12', '11:00:00', '2027-10-12 11:00:00', 62.00, 3, 'Metz → Nancy', 210, 248, 'active', '2026-01-01 10:00:00'),
(57, 4, 3, '2027-11-18', '18:00:00', '2027-11-18 18:00:00', 78.00, 2, 'Paris → Troyes', 201, 249, 'active', '2026-01-01 10:00:00'),
(58, 5, 4, '2027-12-05', '08:45:00', '2027-12-05 08:45:00', 44.00, 3, 'Brest → Morlaix', 216, 250, 'active', '2026-01-01 10:00:00'),
(59, 6, 5, '2027-12-22', '13:30:00', '2027-12-22 13:30:00', 88.00, 2, 'Paris → Mulhouse', 201, 251, 'active', '2026-01-01 10:00:00'),
(60, 1, 1, '2027-12-30', '10:00:00', '2027-12-30 10:00:00', 58.00, 3, 'Lyon → Valence', 202, 226, 'active', '2026-01-01 10:00:00');


-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_reservation` bigint(20) UNSIGNED DEFAULT NULL,
  `id_expediteur` bigint(20) UNSIGNED DEFAULT NULL,
  `id_destinataire` bigint(20) UNSIGNED DEFAULT NULL,
  `note` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id`, `id_reservation`, `id_expediteur`, `id_destinataire`, `note`, `commentaire`, `date_creation`) VALUES
(1, 1, 3, 1, 5, 'Conducteur très sympa, trajet parfait', '2025-12-26 10:52:32'),
(2, 2, 2, 4, 4, 'Bon trajet, conducteur ponctuel', '2025-12-26 10:55:21'),
(3, 3, 1, 5, 5, 'Très agréable, je recommande', '2025-12-26 10:55:21'),
(4, 5, 3, 6, 5, 'Parfait du début à la fin', '2025-12-26 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `date_creation`) VALUES
(1, '2025-12-26 10:52:32'),
(2, '2025-12-26 10:55:21'),
(3, '2025-12-26 10:55:21'),
(4, '2025-12-26 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `documents_utilisateur`
--

CREATE TABLE `documents_utilisateur` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `type_document` enum('piece_identite','permis','carte_grise','assurance','justificatif_domicile','photo_profil') NOT NULL,
  `nom_fichier` varchar(255) NOT NULL,
  `chemin_fichier` varchar(255) NOT NULL,
  `mime_type` varchar(100) NOT NULL,
  `taille_fichier` int(11) NOT NULL,
  `statut` enum('en_attente','valide','refuse') DEFAULT 'en_attente',
  `date_expiration` date DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favoris`
--

CREATE TABLE `favoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_annonce` bigint(20) UNSIGNED NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favoris`
--

INSERT INTO `favoris` (`id`, `id_utilisateur`, `id_annonce`, `date_creation`) VALUES
(1, 3, 1, '2025-12-26 10:52:32'),
(2, 1, 2, '2025-12-26 10:52:32'),
(3, 2, 3, '2025-12-26 10:55:21'),
(4, 4, 4, '2025-12-26 10:55:21'),
(5, 5, 5, '2025-12-26 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `lieux`
--

CREATE TABLE `lieux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lieux`
--

INSERT INTO `lieux` (`id`, `nom`, `latitude`, `longitude`) VALUES
(1, 'Casablanca', 33.573100, -7.589800),
(2, 'Rabat', 34.020900, -6.841600),
(3, 'Marrakech', 31.629500, -7.981100),
(4, 'Agadir', 30.427800, -9.598100),
(5, 'Fès', 34.033300, -5.000000),
(6, 'Tanger', 35.759500, -5.833900);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_conversation` bigint(20) UNSIGNED DEFAULT NULL,
  `id_expediteur` bigint(20) UNSIGNED NOT NULL,
  `id_destinataire` bigint(20) UNSIGNED NOT NULL,
  `contenu` text NOT NULL,
  `vu` tinyint(1) DEFAULT 0,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `id_conversation`, `id_expediteur`, `id_destinataire`, `contenu`, `vu`, `date_creation`) VALUES
(1, 1, 1, 3, 'Salut, il reste une place ?', 0, '2025-12-26 10:52:32'),
(2, 1, 3, 1, 'Oui, bien sûr 👍', 0, '2025-12-26 10:52:32'),
(3, 2, 2, 4, 'Bonjour, le trajet est toujours dispo ?', 0, '2025-12-26 10:55:21'),
(4, 3, 5, 6, 'Je peux prendre un bagage ?', 0, '2025-12-26 10:55:21'),
(5, 4, 6, 5, 'Oui, sans problème 👍', 0, '2025-12-26 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `paiements`
--

CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_reservation` bigint(20) UNSIGNED NOT NULL,
  `moyen_paiement` varchar(20) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `statut` enum('en_attente','valide','echoue','rembourse') DEFAULT 'en_attente',
  `devise` varchar(10) DEFAULT 'MAD',
  `transaction_id` varchar(255) DEFAULT NULL,
  `receipt_url` varchar(255) DEFAULT NULL,
  `date_paiement` timestamp NULL DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paiements`
--

INSERT INTO `paiements` (`id`, `id_reservation`, `moyen_paiement`, `montant`, `statut`, `devise`, `transaction_id`, `receipt_url`, `date_paiement`, `date_creation`) VALUES
(1, 1, 'carte', 50.00, 'valide', 'MAD', 'TX123456', NULL, NULL, '2025-12-26 10:52:32'),
(2, 2, 'cash', 60.00, 'valide', 'MAD', 'TX789101', NULL, NULL, '2025-12-26 10:55:21'),
(3, 3, 'carte', 40.00, 'valide', 'MAD', 'TX112131', NULL, NULL, '2025-12-26 10:55:21'),
(4, 4, 'carte', 90.00, 'rembourse', 'MAD', 'TX415161', NULL, NULL, '2025-12-26 10:55:21'),
(5, 34, 'carte', 90.00, 'valide', 'EUR', 'TX-6952d49520b10', NULL, '2025-12-29 18:20:53', '2025-12-29 19:20:53'),
(6, 34, 'carte', 90.00, 'valide', 'EUR', 'TX-6952d5de40976', NULL, '2025-12-29 18:26:22', '2025-12-29 19:26:22'),
(7, 34, 'carte', 90.00, 'valide', 'EUR', 'TX-6952d5e3c7723', NULL, '2025-12-29 18:26:27', '2025-12-29 19:26:27'),
(8, 35, 'carte', 40.00, 'valide', 'EUR', 'TX-6952d609aef76', NULL, '2025-12-29 18:27:05', '2025-12-29 19:27:05'),
(9, 36, 'carte', 60.00, 'valide', 'EUR', 'TX-6953fa0bc8197', NULL, '2025-12-30 15:12:59', '2025-12-30 16:12:59'),
(10, 38, 'carte', 80.00, 'valide', 'EUR', 'TX-6953fa9a82df5', NULL, '2025-12-30 15:15:22', '2025-12-30 16:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `id_annonce` bigint(20) UNSIGNED NOT NULL,
  `donnees_passager` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`donnees_passager`)),
  `id_passager` bigint(20) UNSIGNED DEFAULT NULL,
  `statut` enum('en_attente','acceptee','refusee','annulee','terminee') DEFAULT 'en_attente',
  `prix_total` decimal(10,2) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_mise_a_jour` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `uuid`, `id_annonce`, `donnees_passager`, `id_passager`, `statut`, `prix_total`, `date_creation`, `date_mise_a_jour`) VALUES
(1, 'fae216d0-e248-11f0-8b54-367dda755253', 1, NULL, 3, 'en_attente', 50.00, '2025-12-26 10:52:32', '2025-12-26 10:52:32'),
(2, 'fae229fe-e248-11f0-8b54-367dda755253', 2, NULL, 1, 'en_attente', 80.00, '2025-12-26 10:52:32', '2025-12-26 10:52:32'),
(3, '5ff5195a-e249-11f0-8b54-367dda755253', 3, NULL, 2, 'acceptee', 60.00, '2025-12-26 10:55:21', '2025-12-26 10:55:21'),
(4, '5ff51b80-e249-11f0-8b54-367dda755253', 4, NULL, 1, 'en_attente', 40.00, '2025-12-26 10:55:21', '2025-12-26 10:55:21'),
(5, '5ff51c66-e249-11f0-8b54-367dda755253', 5, NULL, 3, 'terminee', 90.00, '2025-12-26 10:55:21', '2025-12-26 10:55:21'),
(32, 'res_6952cd8a9503b', 5, NULL, 10, 'en_attente', 90.00, '2025-12-29 18:50:50', '2025-12-29 18:50:50'),
(33, 'res_6952cfe6e2235', 5, NULL, 10, 'en_attente', 90.00, '2025-12-29 19:00:54', '2025-12-29 19:00:54'),
(34, 'res_6952d48937704', 5, NULL, 10, 'acceptee', 90.00, '2025-12-29 19:20:41', '2025-12-29 19:20:53'),
(35, 'res_6952d5fe375bd', 4, NULL, 10, 'acceptee', 40.00, '2025-12-29 19:26:54', '2025-12-29 19:27:05'),
(36, 'res_6953fa0308e02', 3, NULL, 20, 'acceptee', 60.00, '2025-12-30 16:12:51', '2025-12-30 16:12:59'),
(37, 'res_6953fa0fb4ea4', 3, NULL, 20, 'en_attente', 60.00, '2025-12-30 16:13:03', '2025-12-30 16:13:03'),
(38, 'res_6953fa909747e', 2, NULL, 21, 'acceptee', 80.00, '2025-12-30 16:15:12', '2025-12-30 16:15:22'),
(39, 'res_6953fa9be5b88', 2, NULL, 21, 'en_attente', 80.00, '2025-12-30 16:15:23', '2025-12-30 16:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `biographie` text DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `token_notification` varchar(255) DEFAULT NULL,
  `premiere_connexion` tinyint(1) NOT NULL DEFAULT 1,
  `try_token` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_mise_a_jour` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `note` float DEFAULT 0,
  `photo_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `telephone`, `avatar`, `biographie`, `mot_de_passe`, `token_notification`, `premiere_connexion`, `try_token`, `remember_token`, `date_creation`, `date_mise_a_jour`, `note`, `photo_profil`) VALUES
(1, 'Ali Benali', 'Utilisateur', 'user1@test.com', '0600000001', NULL, NULL, 'password_hash_1', NULL, 1, 0, NULL, '2025-12-26 10:51:52', '2025-12-26 14:40:00', 0, NULL),
(2, 'Sara Amrani', 'Utilisateur', 'user2@test.com', '0600000002', NULL, NULL, 'password_hash_2', NULL, 1, 0, NULL, '2025-12-26 10:51:52', '2025-12-26 14:40:00', 0, NULL),
(3, 'Youssef Karim', 'Utilisateur', 'user3@test.com', '0600000003', NULL, NULL, 'password_hash_3', NULL, 1, 0, NULL, '2025-12-26 10:51:52', '2025-12-26 14:40:00', 0, NULL),
(4, 'Omar El Fassi', 'Utilisateur', 'user4@test.com', '0600000004', NULL, NULL, 'password_hash_4', NULL, 1, 0, NULL, '2025-12-26 10:55:21', '2025-12-26 14:40:00', 0, NULL),
(5, 'Nadia Zahra', 'Utilisateur', 'user5@test.com', '0600000005', NULL, NULL, 'password_hash_5', NULL, 1, 0, NULL, '2025-12-26 10:55:21', '2025-12-26 14:40:00', 0, NULL),
(6, 'Hamza Idrissi', 'Utilisateur', 'user6@test.com', '0600000006', NULL, NULL, 'password_hash_6', NULL, 1, 0, NULL, '2025-12-26 10:55:21', '2025-12-26 14:40:00', 0, NULL),
(8, 'Bui', 'Thi My Anh', 'myanhbui811@gmail.com', NULL, NULL, NULL, '$2y$12$gl51UwGS4GbQJBBEv9S9nuY6kVCr74GMreRVTf9Wno4eo8CwjskCK', NULL, 1, 0, NULL, '2025-12-26 15:32:26', '2025-12-26 15:32:26', 0, NULL),
(9, 'Bui', 'Thi My Anh', 'myanhbui0811@gmail.com', NULL, NULL, NULL, '$2y$12$NE607WaiEOToMYZAsrmYmOIKtZoCsUTfXsKgk6tEjEy3V0ZdaCpLS', NULL, 1, 0, NULL, '2025-12-26 15:54:54', '2025-12-26 15:54:54', 0, NULL),
(10, 'Bui', 'Thi My', 'myanhbui@gmail.com', NULL, NULL, NULL, '$2y$12$HKCw1lreym5LTl87W3q8D.k/vpaDvp1rKDUdnJc5VVV0MoSK2bA2G', NULL, 1, 0, NULL, '2025-12-26 15:55:29', '2025-12-26 16:38:46', 0, NULL),
(15, 'Bui', 'Thi My Anh', 'myanhbui811111111111@gmail.com', NULL, NULL, NULL, '$2y$12$YymvgE0Nx3Jn9jyOcZHO0uNbR6a8BthK0lcDBiLaIxJ/R4cJ5Ku8G', NULL, 1, 0, NULL, '2025-12-30 14:58:59', '2025-12-30 14:58:59', 0, NULL),
(16, 'Bui', 'Thi My Anh', 'myanhbui82222222@gmail.com', NULL, NULL, NULL, '$2y$12$jeyL0O8en9dQXBop.bvpoeA8XQAeGrZbVfHPlA/f1tD9rvmooDxc2', NULL, 1, 0, NULL, '2025-12-30 15:12:01', '2025-12-30 15:12:01', 0, NULL),
(17, 'Bui', 'Thi My Anh', 'myanhbui811777@gmail.com', NULL, NULL, NULL, '$2y$12$CC8cfQElOSCHhmnkw8aypuFcOAp6TmR2I3YIsJIGuRV4X8HjlkHAu', NULL, 1, 0, NULL, '2025-12-30 15:26:39', '2025-12-30 15:26:39', 0, NULL),
(18, 'Bui', 'Thi My Anh', 'myanhbui819999991@gmail.com', NULL, NULL, NULL, '$2y$12$mO4wJaIvq5GcjQPLJW7GDOcZADrqAOsokPAEx5pgsc3KKiXyVuu6G', NULL, 1, 0, NULL, '2025-12-30 15:31:05', '2025-12-30 15:31:05', 0, NULL),
(19, 'Bui', 'Thi My Anh', 'myanhbui811888888888@gmail.com', NULL, NULL, NULL, '$2y$12$B1gxk4Amuy7Dn/iBqA.QQOM/1aauZvpnRLNGXe0VBRXaWgj0Yc1Qm', NULL, 1, 0, NULL, '2025-12-30 15:39:45', '2025-12-30 15:39:45', 0, NULL),
(20, 'Bui', 'Thi My Anh', 'myanhbui8110000000@gmail.com', NULL, NULL, NULL, '$2y$12$ugF0fjiju7hN6RnqiFfbv.Y4b8eFrg3lmKPdcQ6rbiX9Oq7HA4/6i', NULL, 1, 0, NULL, '2025-12-30 16:12:28', '2025-12-30 16:12:28', 0, NULL),
(21, 'Bui', 'Thi My Anh', 'myanhbui81177777@gmail.com', NULL, NULL, NULL, '$2y$12$qzywtRCK/v6IQfIuc5jmQOfoNi3DY/oeB2pJicS42gV.nWpn0JtpG', NULL, 1, 0, NULL, '2025-12-30 16:15:03', '2025-12-30 16:15:03', 0, NULL),
(22, 'Bui', 'Thi My Anh', 'thi-my-anh.bui@sep.fr', NULL, NULL, NULL, '$2y$12$lptPRiOyZ.LsN3eHytlmnu0ZcE00oGRzDAJMaEjPEjZ5eUfkuYc1m', NULL, 1, 0, NULL, '2025-12-31 10:34:07', '2025-12-31 10:34:07', 0, NULL),
(23, 'Bui', 'Thi My Anh', 'myanhbui8115555@gmail.com', NULL, NULL, NULL, '$2y$12$/MXZnObHq9kxsemZYG9ZJ.FonSUZ/ZgFODTee.44g8nmTPPVz8GG.', NULL, 1, 0, NULL, '2025-12-31 10:35:09', '2025-12-31 10:35:09', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicules`
--

CREATE TABLE `vehicules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `marque` varchar(100) NOT NULL,
  `modele` varchar(100) NOT NULL,
  `annee` year(4) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicules`
--

INSERT INTO `vehicules` (`id`, `id_utilisateur`, `marque`, `modele`, `annee`, `couleur`, `matricule`, `date_creation`) VALUES
(1, 1, 'Dacia', 'Logan', '2019', 'Blanc', 'AA-123-BB', '2025-12-26 10:51:52'),
(2, 2, 'Toyota', 'Yaris', '2021', 'Noir', 'CC-456-DD', '2025-12-26 10:51:52'),
(3, 4, 'Hyundai', 'i10', '2020', 'Gris', 'EE-789-FF', '2025-12-26 10:55:21'),
(4, 5, 'Peugeot', '208', '2018', 'Rouge', 'GG-321-HH', '2025-12-26 10:55:21'),
(5, 6, 'Volkswagen', 'Golf', '2022', 'Bleu', 'II-654-JJ', '2025-12-26 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_annonce_conducteur` (`id_conducteur`),
  ADD KEY `fk_annonce_vehicule` (`id_vehicule`),
  ADD KEY `fk_annonce_depart` (`id_lieu_depart`),
  ADD KEY `fk_annonce_arrivee` (`id_lieu_arrivee`);

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_avis_reservation` (`id_reservation`),
  ADD KEY `fk_avis_sender` (`id_expediteur`),
  ADD KEY `fk_avis_receiver` (`id_destinataire`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents_utilisateur`
--
ALTER TABLE `documents_utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doc_user` (`id_utilisateur`);

--
-- Indexes for table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favori` (`id_utilisateur`,`id_annonce`),
  ADD KEY `fk_favoris_annonce` (`id_annonce`);

--
-- Indexes for table `lieux`
--
ALTER TABLE `lieux`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_conversation` (`id_conversation`),
  ADD KEY `fk_message_sender` (`id_expediteur`),
  ADD KEY `fk_message_receiver` (`id_destinataire`);

--
-- Indexes for table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paiement_reservation` (`id_reservation`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `fk_reservation_annonce` (`id_annonce`),
  ADD KEY `fk_reservation_passager` (`id_passager`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- Indexes for table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vehicule_user` (`id_utilisateur`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents_utilisateur`
--
ALTER TABLE `documents_utilisateur`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lieux`
--
ALTER TABLE `lieux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `fk_annonce_arrivee` FOREIGN KEY (`id_lieu_arrivee`) REFERENCES `lieux` (`id`),
  ADD CONSTRAINT `fk_annonce_conducteur` FOREIGN KEY (`id_conducteur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_annonce_depart` FOREIGN KEY (`id_lieu_depart`) REFERENCES `lieux` (`id`),
  ADD CONSTRAINT `fk_annonce_vehicule` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `fk_avis_receiver` FOREIGN KEY (`id_destinataire`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `fk_avis_reservation` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id`),
  ADD CONSTRAINT `fk_avis_sender` FOREIGN KEY (`id_expediteur`) REFERENCES `utilisateurs` (`id`);

--
-- Constraints for table `documents_utilisateur`
--
ALTER TABLE `documents_utilisateur`
  ADD CONSTRAINT `fk_doc_user` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `fk_favoris_annonce` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favoris_user` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_message_conversation` FOREIGN KEY (`id_conversation`) REFERENCES `conversations` (`id`),
  ADD CONSTRAINT `fk_message_receiver` FOREIGN KEY (`id_destinataire`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `fk_message_sender` FOREIGN KEY (`id_expediteur`) REFERENCES `utilisateurs` (`id`);

--
-- Constraints for table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `fk_paiement_reservation` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservation_annonce` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id`),
  ADD CONSTRAINT `fk_reservation_passager` FOREIGN KEY (`id_passager`) REFERENCES `utilisateurs` (`id`);

--
-- Constraints for table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `fk_vehicule_user` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
