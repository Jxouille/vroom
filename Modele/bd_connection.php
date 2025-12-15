<?php
const DB_CONFIG = [
  'host'     => '127.0.0.1',
  'port'     => '3306',
  'dbname'   => 'vroom',
  'username' => 'root',
  'password' => ''
];

function dbConnect() {
    try {
        $db = new PDO(
            "mysql:host=" . DB_CONFIG['host'] . ";port=" . DB_CONFIG['port'] . ";dbname=" . DB_CONFIG['dbname'].";charset=utf8mb4",
            DB_CONFIG['username'],
            DB_CONFIG['password']
        );
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

