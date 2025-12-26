SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ========================
-- TABLE : reservations
-- ========================
CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `id_annonce` bigint(20) UNSIGNED NOT NULL,
  `donnees_passager` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
    DEFAULT NULL CHECK (json_valid(`donnees_passager`)),
  `id_passager` bigint(20) UNSIGNED DEFAULT NULL,
  `statut` ENUM('en_attente','acceptee','refusee','annulee','terminee') DEFAULT 'en_attente',
  `prix_total` decimal(10,2) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_mise_a_jour` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : favoris
-- ========================
CREATE TABLE `favoris` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_annonce` bigint(20) UNSIGNED NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_favori` (`id_utilisateur`,`id_annonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : lieux
-- ========================
CREATE TABLE `lieux` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : utilisateurs
-- ========================
CREATE TABLE `utilisateurs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `note` float DEFAULT 0,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `telephone` (`telephone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : vehicules
-- ========================
CREATE TABLE `vehicules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `marque` varchar(100) NOT NULL,
  `modele` varchar(100) NOT NULL,
  `annee` year(4) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : annonces
-- ========================
CREATE TABLE `annonces` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `statut` ENUM('active','complete','annulee','expiree') DEFAULT 'active',
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : conversations
-- ========================
CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_creation` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : messages
-- ========================
CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_conversation` bigint(20) UNSIGNED,
  `id_expediteur` bigint(20) UNSIGNED NOT NULL,
  `id_destinataire` bigint(20) UNSIGNED NOT NULL,
  `contenu` text NOT NULL,
  `vu` tinyint(1) DEFAULT 0,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : paiements
-- ========================
CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_reservation` bigint(20) UNSIGNED NOT NULL,
  `moyen_paiement` varchar(20) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `statut` ENUM('en_attente','valide','echoue','rembourse') DEFAULT 'en_attente',
  `devise` varchar(10) DEFAULT 'MAD',
  `transaction_id` varchar(255),
  `receipt_url` varchar(255),
  `date_paiement` timestamp NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ========================
-- TABLE : avis
-- ========================
CREATE TABLE `avis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_reservation` bigint(20) UNSIGNED DEFAULT NULL,
  `id_expediteur` bigint(20) UNSIGNED DEFAULT NULL,
  `id_destinataire` bigint(20) UNSIGNED DEFAULT NULL,
  `note` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
