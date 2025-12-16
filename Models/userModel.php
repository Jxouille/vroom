<?php

function getDBConnection() {
    $host = 'localhost';
    $dbname = 'vroomBD';
    $username = 'root'; 
    $password = '';    

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Erreur de connexion a la base de donnees : " . $e->getMessage());
    }
}

function inscrireUtilisateur($nom, $prenom, $email, $mdp, $role = "Utilisateur", $photoProfil = null) {

    $db = getDBConnection();

    $stmt = $db->prepare("SELECT idUser FROM Utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        return ["success" => false, "message" => "Cet email est deja utilise."];
    }

    
    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

    
    $stmt = $db->prepare("INSERT INTO Utilisateur (nom, prenom, email, mdp, photoProfil, role, statusCompte) VALUES (?, ?, ?, ?, ?, ?, 'Actif')");
    $success = $stmt->execute([$nom, $prenom, $email, $mdpHash, $photoProfil, $role]);

    if ($success) {
        return ["success" => true, "message" => "Inscription reussie."];
    } else {
        return ["success" => false, "message" => "Erreur lors de l'inscription."];
    }
}

function connecterUtilisateur($email, $mdp) {
    $db = getDBConnection();

    
    $stmt = $db->prepare("SELECT * FROM Utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mdp, $user['mdp'])) {
        
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        $_SESSION['user'] = [
            'idUser' => $user['idUser'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        return ["success" => true, "message" => "Connexion reussie."];
    } else {
        return ["success" => false, "message" => "Email ou mot de passe incorrect."];
    }
}

?>