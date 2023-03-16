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
$pseudo = $_POST['pseudo'];
$pass = $_POST['mdp'];
$statement = $pdo->query("SELECT mdp FROM Users");

while($row = $statement->fetch()){
    
    $result = password_verify($pass, $row['mdp']);
    if($result === true){
        $array_bdd= $pdo->prepare("SELECT * FROM Users WHERE pseudo = :pseudo AND mdp = :pass");
    $array_bdd->execute([
        'pseudo' => $pseudo,
        'pass' => $row['mdp']
    ]);
    $array = $array_bdd->fetch();


    if($array===false){
        redirect("index.php?error=2");
    }

    session_start();
    $_SESSION['connected'] = true;
    redirect("dashboard.php");
    }
}
redirect("index.php?error=2");





