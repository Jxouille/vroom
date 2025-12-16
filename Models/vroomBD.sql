-- ==============================
-- Base de données : covoiturage
-- ==============================

DROP DATABASE IF EXISTS vroomBD;
CREATE DATABASE vroomBD;

USE vroomBD;

-- ==============================
-- Table : Utilisateur
-- ==============================
CREATE TABLE Utilisateur (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    photoProfil VARCHAR(255),
    role VARCHAR(50) NOT NULL,
    statusCompte VARCHAR(50) NOT NULL,
    dateInscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- ==============================
-- Table : Trajet
-- ==============================
CREATE TABLE Trajet (
    idTrajet INT AUTO_INCREMENT PRIMARY KEY,
    dateCreation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    depart VARCHAR(150) NOT NULL,
    destination VARCHAR(150) NOT NULL,
    description TEXT,
    heureDepart TIME NOT NULL,
    nbPlacesTotales INT NOT NULL,
    nbPlacesDisponibles INT NOT NULL,
    prixPlace DECIMAL(8,2) NOT NULL,
    status VARCHAR(50) NOT NULL,
    idConducteur INT NOT NULL,

    CONSTRAINT fk_trajet_utilisateur
        FOREIGN KEY (idConducteur)
        REFERENCES Utilisateur(idUser)
        ON DELETE CASCADE
);

-- ==============================
-- Table : Reservation
-- ==============================
CREATE TABLE Reservation (
    idReservation INT AUTO_INCREMENT PRIMARY KEY,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nbPlaces INT NOT NULL,
    idUser INT NOT NULL,
    idTrajet INT NOT NULL,

    CONSTRAINT fk_reservation_user
        FOREIGN KEY (idUser)
        REFERENCES Utilisateur(idUser)
        ON DELETE CASCADE,

    CONSTRAINT fk_reservation_trajet
        FOREIGN KEY (idTrajet)
        REFERENCES Trajet(idTrajet)
        ON DELETE CASCADE
);

-- ==============================
-- Table : Message
-- ==============================
CREATE TABLE Message (
    idMessage INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    dateEnvoi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    expediteur INT NOT NULL,
    destinataire INT NOT NULL,

    CONSTRAINT fk_message_expediteur
        FOREIGN KEY (expediteur)
        REFERENCES Utilisateur(idUser)
        ON DELETE CASCADE,

    CONSTRAINT fk_message_destinataire
        FOREIGN KEY (destinataire)
        REFERENCES Utilisateur(idUser)
        ON DELETE CASCADE
);

-- ==============================
-- Table : Avis
-- ==============================
CREATE TABLE Avis (
    idAvis INT AUTO_INCREMENT PRIMARY KEY,
    commentaire TEXT,
    note INT NOT NULL CHECK (note BETWEEN 1 AND 5),
    dateAvis DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    auteur INT NOT NULL,
    cible INT NOT NULL,

    CONSTRAINT fk_avis_auteur
        FOREIGN KEY (auteur)
        REFERENCES Utilisateur(idUser)
        ON DELETE CASCADE,

    CONSTRAINT fk_avis_cible
        FOREIGN KEY (cible)
        REFERENCES Utilisateur(idUser)
        ON DELETE CASCADE
);

-- ==============================
-- Table : Signalement
-- ==============================
CREATE TABLE Signalement (
    idSignalement INT AUTO_INCREMENT PRIMARY KEY,
    motif TEXT NOT NULL,
    status VARCHAR(50) NOT NULL,
    auteur INT NOT NULL,
    cible INT NOT NULL,

    CONSTRAINT fk_signalement_auteur
        FOREIGN KEY (auteur)
        REFERENCES Utilisateur(idUser)
        ON DELETE CASCADE,

    CONSTRAINT fk_signalement_cible
        FOREIGN KEY (cible)
        REFERENCES Utilisateur(idUser)
        ON DELETE CASCADE
);