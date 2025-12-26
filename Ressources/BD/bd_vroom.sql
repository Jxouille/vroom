-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2025 at 12:42 PM
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
(2, 2, 2, '2025-07-02', '14:30:00', '2025-07-02 14:30:00', 80.00, 2, 'Trajet Rabat → Marrakech', 2, 3, 'active', '2025-12-26 10:51:52'),
(3, 4, 3, '2025-07-03', '09:00:00', '2025-07-03 09:00:00', 60.00, 3, 'Agadir → Marrakech', 4, 3, 'active', '2025-12-26 10:55:21'),
(4, 5, 4, '2025-07-04', '07:30:00', '2025-07-04 07:30:00', 40.00, 2, 'Fès → Rabat', 5, 2, 'active', '2025-12-26 10:55:21'),
(5, 6, 5, '2025-07-05', '16:00:00', '2025-07-05 16:00:00', 90.00, 3, 'Tanger → Casablanca', 6, 1, 'active', '2025-12-26 10:55:21');

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
(4, 4, 'carte', 90.00, 'rembourse', 'MAD', 'TX415161', NULL, NULL, '2025-12-26 10:55:21');

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
(5, '5ff51c66-e249-11f0-8b54-367dda755253', 5, NULL, 3, 'terminee', 90.00, '2025-12-26 10:55:21', '2025-12-26 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
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
  `note` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `telephone`, `avatar`, `biographie`, `mot_de_passe`, `token_notification`, `premiere_connexion`, `try_token`, `remember_token`, `date_creation`, `date_mise_a_jour`, `note`) VALUES
(1, 'Ali Benali', '0600000001', NULL, NULL, 'password_hash_1', NULL, 1, 0, NULL, '2025-12-26 10:51:52', '2025-12-26 10:51:52', 0),
(2, 'Sara Amrani', '0600000002', NULL, NULL, 'password_hash_2', NULL, 1, 0, NULL, '2025-12-26 10:51:52', '2025-12-26 10:51:52', 0),
(3, 'Youssef Karim', '0600000003', NULL, NULL, 'password_hash_3', NULL, 1, 0, NULL, '2025-12-26 10:51:52', '2025-12-26 10:51:52', 0),
(4, 'Omar El Fassi', '0600000004', NULL, NULL, 'password_hash_4', NULL, 1, 0, NULL, '2025-12-26 10:55:21', '2025-12-26 10:55:21', 0),
(5, 'Nadia Zahra', '0600000005', NULL, NULL, 'password_hash_5', NULL, 1, 0, NULL, '2025-12-26 10:55:21', '2025-12-26 10:55:21', 0),
(6, 'Hamza Idrissi', '0600000006', NULL, NULL, 'password_hash_6', NULL, 1, 0, NULL, '2025-12-26 10:55:21', '2025-12-26 10:55:21', 0);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
