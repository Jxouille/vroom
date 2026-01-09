<?php
class Authentification_code {

    public static function generer($email): int {
        $code = random_int(100000, 999999);
        $expiration = date('Y-m-d H:i:s', time() + 120);
        $sql = "INSERT INTO verification_codes (email, code, date_expire)
        VALUES (:email, :code, :date_expire)";

        $db = dbConnect();
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':code'  => $code,
            ':date_expire'  => $expiration]);
        return $code;
    }
    public static function verifier($email, $code): bool {
        $db = dbConnect();
        $stmt = $db->prepare("
            SELECT * FROM verification_codes
            WHERE email = ? AND code = ?
            ORDER BY date_cree DESC
            LIMIT 1
        ");
        $stmt->execute([$email, $code]);
        $row = $stmt->fetch();

        // Nettoyage des codes expirés
        $now = date('Y-m-d H:i:s');
        $db->prepare("DELETE FROM verification_codes WHERE date_expire < ?")
        ->execute([$now]);

        if (!$row) {
            return false; // Code incorrect
        }

        if (strtotime($row['date_expire']) < time()) {
            return false; // Code expiré
        }

        // Nettoyage des codes utilisés
        $db->prepare("DELETE FROM verification_codes WHERE email = ?")->execute([$email]);
        return true;
    }
}
