<?php

require __DIR__ . '/../functions/config.php';
$dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$dbCharset";
try {
    $option = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $pdo = new PDO($dsn, $dbUser, $dbPassword, $option);
} catch (PDOException $e) {
    die('Une erreur est survenue: ' . $e->getMessage());
}
