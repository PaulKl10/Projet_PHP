<?php
require_once 'functions.php';
$dsn = "mysql:host=localhost;port=8889;dbname=projet_php;charset=utf8mb4";

try{
    $option =[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $pdo = new PDO($dsn, 'hb_php_2023','3ciBQIMZ7s_bDH4O',$option);
} catch(PDOException $e) {
    die('Une erreur est survenue: '. $e->getMessage());
}
['pseudo' => $pseudo,'mdp' => $mdp] = $_POST;

// Hacher le mot de passe
$hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

// Préparer la requête sql et la traiter
$statement = $pdo->prepare("INSERT INTO Users (pseudo,mdp) VALUES (:pseudo, :mdp)");
$statement->execute([
    ':pseudo' => $pseudo,
    ':mdp' => $hashedPassword
]);

redirect('index.php');