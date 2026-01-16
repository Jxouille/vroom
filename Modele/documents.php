<?php
require_once  __DIR__ . '/bd_connection.php';

class Documents {
    private PDO $bd;
    public function __construct() {
        $this->bd = dbConnect();
    }
    public static function all () {
        $bd = dbConnect();
        $stmt = $bd->query("SELECT * FROM documents_utilisateur ORDER BY date_creation DESC");
        return $stmt->fetchAll();
    }
    public static function ajouter(
        int $id_utilisateur,
        string $type_document,
        string $nom_fichier_original,
        string $chemin_fichier,
        string $type_mime,
        int $taille_fichier
    ): bool {
        $sql = "
            INSERT INTO documents_utilisateur
            (id_utilisateur, type_document, nom_fichier, chemin_fichier, mime_type, taille_fichier)
            VALUES (?, ?, ?, ?, ?, ?)
        ";
        $bd = dbConnect();
        $requete = $bd->prepare($sql);
        return $requete->execute([
            $id_utilisateur,
            $type_document,
            $nom_fichier_original,
            $chemin_fichier,
            $type_mime,
            $taille_fichier
        ]);
    }

    public static function obtenirDocumentsParUtilisateur(int $id_utilisateur): array {
        $bd = dbConnect();
        $requete = $bd->prepare("SELECT * FROM documents_utilisateur WHERE id_utilisateur = ?"
        );
        $requete->execute([$id_utilisateur]);
        return $requete->fetchAll();
    }

    public static function modifierStatut(int $id_document, string $statut): bool {
        $bd = dbConnect();
        $requete = $bd->prepare("UPDATE documents_utilisateur SET statut = ? WHERE id = ?"
        );
        return $requete->execute([$statut, $id_document]);
    }

    public static function getByUserAndType(int $id_utilisateur, string $type_document): ?array {
        $sql = "
            SELECT * FROM documents_utilisateur
            WHERE id_utilisateur = ? AND type_document = ?
            ORDER BY date_creation DESC
            LIMIT 1
        ";
        $bd = dbConnect();
        $stmt = $bd->prepare($sql);
        $stmt->execute([$id_utilisateur, $type_document]);
        return $stmt->fetch() ?: null;
    }

    public static function supprimer(int $id_document): bool {
        $bd = dbConnect();
        $sql = "DELETE FROM documents_utilisateur WHERE id = ?";
        return $bd->prepare($sql)->execute([$id_document]);
    }
    public static function getByUser(int $id_utilisateur): array {
        $bd = dbConnect();
        $stmt = $bd->prepare("SELECT * FROM documents_utilisateur WHERE id_utilisateur = ?");
        $stmt->execute([$id_utilisateur]);
        $docs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($docs as $doc) {
            $result[$doc['type_document']] = $doc;
        }
        return $result;
    }
}

?>