<?php
require_once 'functions.php';
if(empty($_POST['pseudo']) || empty($_POST['mdp'])){
    redirect("index.php?error=1");
}else{
$dsn = "mysql:host=localhost;port=8889;dbname=projet_php;charset=utf8mb4";

try{
    $option =[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $pdo = new PDO($dsn, 'hb_php_2023','3ciBQIMZ7s_bDH4O',$option);
} catch(PDOException $e) {
    die('Une erreur est survenue: '. $e->getMessage());
}
}
['pseudo' => $pseudo,'mdp' => $mdp] = $_POST;

$statement = $pdo->query("SELECT pseudo FROM Users");

while($row = $statement->fetch()){
    if($row['pseudo']===$pseudo){
        redirect("index.php?error=4");
    }
}

// Hacher le mot de passe
$hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

// Préparer la requête sql et la traiter
$statement = $pdo->prepare("INSERT INTO Users (pseudo,mdp) VALUES (:pseudo, :mdp)");
$statement->execute([
    ':pseudo' => $pseudo,
    ':mdp' => $hashedPassword
]);

redirect('index.php?success=1');