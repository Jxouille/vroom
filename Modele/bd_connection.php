<?php
const DB_CONFIG = [
  'host'     => '127.0.0.1', // ou "localhost"
  'port'     => '3306', // ou 3307 si la connexion ne s'établit pas et que vous utilisez MariaDB
  'dbname'   => 'vroom',
  'username' => 'root',
  'password' => '' // "root" aussi si vous utilisez MAMP
];


function dbConnect() {
	$db = new PDO(
    "mysql:host=" . DB_CONFIG['host'] . ";port=" . DB_CONFIG['port'] . ";dbname=" . DB_CONFIG['dbname'],
    DB_CONFIG['username'],
    DB_CONFIG['password']
	);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$db->exec('SET NAMES utf8');
	return $db;
}
?>