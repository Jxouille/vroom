<?php
require_once __DIR__ . '/bd_connection.php';

class Utilisateur {

    /* =========================
       RÉCUPÉRER PAR ID
    ========================= */
    public static function all() : array {
        $db = dbConnect();
        $stmt = $db->query("SELECT * FROM utilisateurs ORDER BY date_creation DESC");
        $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $values;
    }
    public static function get(int $id): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function isAdmin(int $id): bool
{
    $db = dbConnect();
    $stmt = $db->prepare("
        SELECT admin 
        FROM utilisateurs 
        WHERE id = ?
        LIMIT 1
    ");
    $stmt->execute([$id]);

    return (bool) $stmt->fetchColumn();
}


    ///recuper les detail d'un utilisateur

 public static function detail_utilisateur(int $id): ?array
    {
        $db = dbConnect();// or your PDO instance

        $sql = "
        SELECT 
            a.id,
            u.nom,             
            u.prenom,           
            u.email,            
            a.date_creation,    
            ld.nom AS depart,   
            la.nom AS arrivee   
        FROM annonces a
        JOIN utilisateurs u ON a.id_conducteur = u.id
        JOIN vehicules v ON a.id_vehicule = v.id
        JOIN lieux ld ON a.id_lieu_depart = ld.id
        JOIN lieux la ON a.id_lieu_arrivee = la.id
        WHERE a.id = :id
        AND a.statut = 'active'
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);

        $annonce = $stmt->fetch(PDO::FETCH_ASSOC);

        return $annonce ?: null;
    }



    /* =========================
       RÉCUPÉRER PAR EMAIL
    ========================= */
    public static function getByEmail(string $email): ?array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /* =========================
       CRÉER UN NOUVEL UTILISATEUR
    ========================= */
    public static function creer(array $data): bool {
        $db = dbConnect();

        // Vérifier si l'email existe déjà
        if (!empty($data['email']) && self::getByEmail($data['email'])) {
            return false;
        }

        $stmt = $db->prepare("
            INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, biographie, avatar)
            VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe, :biographie, :avatar)
        ");

        return $stmt->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'] ,
            'telephone' => $data['telephone'] ?? null,
            'mot_de_passe' => $data['mot_de_passe'],
            'biographie' => $data['biographie'] ?? null,
            'avatar' => $data['avatar'] ?? null
        ]);
    }

    /* =========================
       METTRE À JOUR UN UTILISATEUR
    ========================= */
    public static function update(int $id, array $data): bool {
        $db = dbConnect();

        $fields = [];
        $params = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
            $params[$key] = $value;
        }
        $params['id'] = $id;

        $sql = "UPDATE utilisateurs SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $db->prepare($sql);

        return $stmt->execute($params);
    }

    /* =========================
       SUPPRESSION D'UN UTILISATEUR
    ========================= */
    public static function delete(int $id): bool {
        $db = dbConnect();
        $stmt = $db->prepare("DELETE FROM utilisateurs WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /* =========================
       CONNEXION
    ========================= */
    public static function connexion(string $login, string $mot_de_passe): ?array {
        $db = dbConnect();

        // Recherche par email ou telephone
        $stmt = $db->prepare("SELECT id FROM utilisateurs WHERE email = :login OR telephone = :login");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return null;
    }
    public static function getByEmailOrTelephone(string $login): ?array {
    $db = dbConnect();

    $stmt = $db->prepare("
        SELECT * FROM utilisateurs 
        WHERE email = :login OR telephone = :login
        LIMIT 1
    ");
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
    }
    public static function updateField(int $id, string $field, string $value): bool {
        $champs_valides = ['prenom','nom','email','telephone','biographie'];
        if (!in_array($field, $champs_valides)) return false;

        $db = dbConnect();
        $stmt = $db->prepare("UPDATE utilisateurs SET $field = :value, date_mise_a_jour = NOW() WHERE id = :id");
        return $stmt->execute([':value' => $value, ':id' => $id]);
    }

    public static function getById(int $id): array {
        $db = dbConnect();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);  
    }

    public function mettreAJourPhotoProfil(int $id_utilisateur, string $chemin_photo): bool {
        $db = dbConnect();
        $requete = $this->$db->prepare(
            "UPDATE utilisateurs SET photo_profil = ? WHERE id = ?"
        );
        return $requete->execute([$chemin_photo, $id_utilisateur]);
    }
    }
?>