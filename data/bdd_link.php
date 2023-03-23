<?php

$dbConfig = parse_ini_file(__DIR__ . '/../config/db.ini');
[
    'DB_HOST' => $host,
    'DB_PORT' => $port,
    'DB_NAME' => $dbName,
    'DB_CHARSET' => $dbCharset,
    'DB_USER' => $dbUser,
    'DB_PASSWORD' => $dbPassword
] = $dbConfig;

$dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$dbCharset";
try {
    $option = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $pdo = new PDO($dsn, $dbUser, $dbPassword, $option);
} catch (PDOException $e) {
    die('Une erreur est survenue: ' . $e->getMessage());
}
