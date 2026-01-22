<?php
const DB_CONFIG = [
  'host'     => 'localhost',  // 178.33.122.21
  'port'     => '3306',
  'dbname'   => 'vroom',   // hangardb_axst62997 <- corrigé
  'username' => 'root',    // axst62997
  'password' => ''    // lgtSzUiSvt6SOQIiV91pya2w
];

function dbConnect() {
    try {
        $db = new PDO(
            "mysql:host=" . DB_CONFIG['host'] . 
            ";port=" . DB_CONFIG['port'] . 
            ";dbname=" . DB_CONFIG['dbname'] . 
            ";charset=utf8mb4",
            DB_CONFIG['username'],
            DB_CONFIG['password']
        );
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
