-- Export SQL phpMyAdmin
-- Version : 5.2.1
-- Base de données entièrement traduite en français

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Base de données : `vroom`
-- --------------------------------------------------------

-- --------------------------------------------------------
-- TABLE : reservations
-- --------------------------------------------------------
CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `id_annonce` bigint(20) UNSIGNED NOT NULL,
  `donnees_passager` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`donnees_passager`)),
  `id_passager` bigint(20) UNSIGNED DEFAULT NULL,
  'statut' ENUM('en_attente','acceptee','refusee','annulee','terminee') DEFAULT 'en_attente',
  `prix_total` decimal(10,2) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_mise_a_jour` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- TABLE : favoris
-- --------------------------------------------------------
CREATE TABLE `favoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_annonce` bigint(20) UNSIGNED NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------
-- TABLE : annonces
-- --------------------------------------------------------
CREATE TABLE `annonces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_conducteur` bigint(20) UNSIGNED NOT NULL,
  `id_vehicule` bigint(20) UNSIGNED NOT NULL,
  `date_depart` date NOT NULL,
  `heure_depart` time NOT NULL,
  'datetime_depart' DATETIME NOT NULL,
  `prix_par_personne` decimal(10,2) NOT NULL,
  `places_disponibles` int(11) NOT NULL,
  `description` text NOT NULL,
  `id_lieu_depart` bigint(20) UNSIGNED NOT NULL,
  `id_lieu_arrivee` bigint(20) UNSIGNED NOT NULL,
  'statut' ENUM('active','complete','annulee','expiree') DEFAULT 'active',
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exemple de données
INSERT INTO `annonces` (`id`, `id_conducteur`, `id_vehicule`, `date_depart`, `heure_depart`, `prix_par_personne`, `places_disponibles`, `description`, `id_lieu_depart`, `id_lieu_arrivee`, `date_creation`) VALUES
(1, 1, 1, '2025-11-30', '12:30:00', 30.00, 4, 'Quelqu’un pour partir de Beni Makada ?', 1, 2, '2025-11-25 12:43:13');

-- --------------------------------------------------------
-- TABLE : lieux
-- --------------------------------------------------------
CREATE TABLE `lieux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL
);

INSERT INTO `lieux` (`id`, `nom`, `latitude`, `longitude`) VALUES
(1, 'Beni Makada', 35.758525, -5.826401),
(2, 'Fnideq', 35.849939, -5.357550);

-- --------------------------------------------------------
-- TABLE : messages
-- --------------------------------------------------------
CREATE TABLE 'conversations' (
  'id' BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  'date_creation' TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  'id_conversation' BIGINT UNSIGNED,
  `id_expediteur` bigint(20) UNSIGNED NOT NULL,
  `id_destinataire` bigint(20) UNSIGNED NOT NULL,
  `contenu` text NOT NULL,
  `vu` tinyint(1) DEFAULT 0,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
  
);

-- --------------------------------------------------------
-- TABLE : paiements
-- --------------------------------------------------------
CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_reservation` bigint(20) UNSIGNED NOT NULL,
  `moyen_paiement` varchar(20) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  'statut' ENUM('en_attente','valide','echoue','rembourse') DEFAULT 'en_attente',
  'devise' VARCHAR(10) DEFAULT 'MAD',
  'transaction_id' VARCHAR(255),
  'receipt_url' VARCHAR(255),
  'date_paiement' TIMESTAMP NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- TABLE : avis
-- --------------------------------------------------------
CREATE TABLE `avis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_reservation` bigint(20) UNSIGNED DEFAULT NULL,
  `id_expediteur` bigint(20) UNSIGNED DEFAULT NULL,
  `id_destinataire` bigint(20) UNSIGNED DEFAULT NULL,
  `note` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- TABLE : utilisateurs
-- --------------------------------------------------------
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
  `date_mise_a_jour` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `utilisateurs` (`id`, `nom`, `telephone`, `avatar`, `biographie`, `mot_de_passe`, `token_notification`, `premiere_connexion`, `try_token`, `remember_token`, `date_creation`, `date_mise_a_jour`) VALUES
(1, 'Youssef', '+212643697818', NULL, NULL, '$2y$12$dI.BLEhCh6fCo3JBh4ck3OQVX2E2NAF09j8jarAmYjhgWz50gu5jq', NULL, 0, 0, NULL, '2025-11-25 12:42:41', '2025-11-25 12:42:41'),
(2, 'Imad', '+212643687888', NULL, NULL, '$2y$12$WnwjcyJatdGv1U4JGEDzXOt7uGRlzQFvh4Ouqm5gI2GFZ5rF3pqeK', NULL, 0, 0, NULL, '2025-11-25 12:42:53', '2025-11-25 12:42:53');

-- --------------------------------------------------------
-- TABLE : vehicules
-- --------------------------------------------------------
CREATE TABLE `vehicules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `marque` varchar(100) NOT NULL,
  `modele` varchar(100) NOT NULL,
  `annee` year(4) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `vehicules` (`id`, `id_utilisateur`, `marque`, `modele`, `annee`, `couleur`, `matricule`, `date_creation`) VALUES
(1, 1, 'Mercedes-AMG', 'C63', '2016', 'Noire', '38800-A-4', '2025-11-25 12:42:04');

-- --------------------------------------------------------
-- TABLE : photos_vehicule
-- --------------------------------------------------------
CREATE TABLE `photos_vehicule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_vehicule` bigint(20) UNSIGNED NOT NULL,
  `url_photo` varchar(255) NOT NULL,
  `principale` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE 'notifications' (
  'id' BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  'id_utilisateur' BIGINT UNSIGNED NOT NULL,
  'type_notification' VARCHAR(50) NOT NULL,
  'contenu' TEXT NOT NULL,
  'lu' TINYINT(1) DEFAULT 0,
  'date_creation' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

CREATE TABLE 'logs' (
  'id' BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  'id_utilisateur' BIGINT UNSIGNED,
  action VARCHAR(255) NOT NULL,
  'ip' VARCHAR(50),
  'user_agent' TEXT,
  'date_creation' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE SET NULL
);


-- --------------------------------------------------------
-- INDEX
-- --------------------------------------------------------

ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `idx_resa_annonce` (`id_annonce`),
  ADD KEY `idx_resa_passager` (`id_passager`);

ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favori` (`id_utilisateur`,`id_annonce`);

ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lieux`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telephone` (`telephone`);

ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `photos_vehicule`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
-- AUTO INCREMENT
-- --------------------------------------------------------

ALTER TABLE `reservations` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `favoris` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `annonces` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `lieux` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `messages` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `paiements` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `avis` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `utilisateurs` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `vehicules` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `photos_vehicule` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- CLÉS ÉTRANGÈRES
-- --------------------------------------------------------

ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_resa_annonce` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_resa_passager` FOREIGN KEY (`id_passager`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoris`
  ADD CONSTRAINT `fk_favori_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favori_annonce` FOREIGN KEY (`id_annonce`) REFERENCES `annonces` (`id`) ON DELETE CASCADE;

ALTER TABLE `annonces`
  ADD CONSTRAINT `fk_annonce_conducteur` FOREIGN KEY (`id_conducteur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_annonce_vehicule` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_annonce_depart` FOREIGN KEY (`id_lieu_depart`) REFERENCES `lieux` (`id`),
  ADD CONSTRAINT `fk_annonce_arrivee` FOREIGN KEY (`id_lieu_arrivee`) REFERENCES `lieux` (`id`);

ALTER TABLE `messages`
  ADD CONSTRAINT `fk_message_expediteur` FOREIGN KEY (`id_expediteur`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `fk_message_dest` FOREIGN KEY (`id_destinataire`) REFERENCES `utilisateurs` (`id`);

ALTER TABLE `paiements`
  ADD CONSTRAINT `fk_paiement_resa` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

ALTER TABLE `avis`
  ADD CONSTRAINT `fk_avis_reservation` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_avis_expediteur` FOREIGN KEY (`id_expediteur`) REFERENCES `utilisateurs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_avis_destinataire` FOREIGN KEY (`id_destinataire`) REFERENCES `utilisateurs` (`id`) ON DELETE SET NULL;

ALTER TABLE `vehicules`
  ADD CONSTRAINT `fk_vehicule_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

ALTER TABLE `photos_vehicule`
  ADD CONSTRAINT `fk_photo_vehicule` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicules` (`id`) ON DELETE CASCADE;

COMMIT;
-- End of export phpMyAdmin
