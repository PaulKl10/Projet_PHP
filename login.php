<?php
require_once 'functions.php';
var_dump($_POST);
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

$array_bdd= $pdo->prepare("SELECT * FROM Users WHERE pseudo = :pseudo AND mdp = :pass");
$array_bdd->execute([
    'pseudo' => $pseudo,
    'pass' => $pass
]);
$array = $array_bdd->fetch();


if($array===false){
    redirect("index.php?error=2");
}

session_start();
$_SESSION['connected'] = true;
redirect("dashboard.php");


