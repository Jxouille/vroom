<?php
require_once __DIR__ . '/bd_connection.php';// Fichier de connexion PDO

class FAQ {

    // Récupérer toutes les questions par thème
    public static function all(): array {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("SELECT q.id, q.question, q.reponse, q.statut, q.date_creation, t.nom_theme
                               FROM faq_questions q
                               JOIN faq_themes t ON q.theme_id = t.id
                               ORDER BY t.nom_theme, q.date_creation DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function update(int $id, array $data): bool {
        $db = dbConnect();
        $fields = [];
        $params = [':id' => $id];

        $map = [
            'question',
            'reponse',
            'statut',
            'auteur',
            'date_reponse'
        ];

        foreach ($map as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = :$field";
                $params[":$field"] = $data[$field];
            }
        }

        if (empty($fields)) return false;

        $sql = "UPDATE faq_questions SET " . implode(', ', $fields) . " WHERE id = :id";
        return $db->prepare($sql)->execute($params);
    }

    // Récupérer les questions par thème
    public static function getByTheme(int $theme_id): array {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("SELECT * FROM faq_questions WHERE theme_id = ? AND statut='active' ORDER BY date_creation DESC");
        $stmt->execute([$theme_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un thème
    public static function getThemes(): array {
        $pdo = dbConnect();
        $stmt = $pdo->query("SELECT * FROM faq_themes ORDER BY nom_theme");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter une question
    public static function ajouter(int $theme_id, string $question, string $reponse, string $auteur): bool {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("INSERT INTO faq_questions (theme_id, question, reponse, auteur) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$theme_id, $question, $reponse, $auteur]);
    }

    // Mettre à jour une question
    public static function modifier(int $id, string $champ, $valeur): bool {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("UPDATE faq_questions SET $champ = ?, date_modification = NOW() WHERE id = ?");
        return $stmt->execute([$valeur, $id]);
    }

    // Supprimer une question
    public static function supprimer(int $id): bool {
        $pdo = dbConnect();
        $stmt = $pdo->prepare("DELETE FROM faq_questions WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
