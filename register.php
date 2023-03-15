<?php
$dsn = "mysql:host=localhost;port=8889;dbname=projet_php;charset=utf8mb4";

try{
    $option =[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $pdo = new PDO($dsn, 'hb_php_2023','3ciBQIMZ7s_bDH4O',$option);
} catch(PDOException $e) {
    die('Une erreur est survenue: '. $e->getMessage());
}
['login' => $login,'mdp' => $mdp] = $_POST;
// $statement = $pdo->query("SELECT * FROM L_Users_films 
//                 JOIN Films ON film_id = Films.id 
//                 Join Users ON user_id = Users.id");
$statement = $pdo->query("INSERT INTO Users (pseudo,mdp) VALUES ($login, $mdp)");