<?php
require_once 'functions.php';
session_start();
if(!isset($_SESSION['connected'])){
    redirect("index.php?error=3");
}

require_once 'layout/header.php';?>
<h1 class="text-warning text-center">Dashboard</h1>

<?php
// $dsn = "mysql:host=localhost;port=8889;dbname=projet_php;charset=utf8mb4";

// try{
//     $option =[
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ];
//     $pdo = new PDO($dsn, 'hb_php_2023','3ciBQIMZ7s_bDH4O',$option);
// } catch(PDOException $e) {
//     die('Une erreur est survenue: '. $e->getMessage());
// }

// $statement = $pdo->query("SELECT * FROM L_Users_films 
//                 JOIN Films ON film_id = Films.id 
//                 Join Users ON user_id = Users.id");
// // $statement = $pdo->query("INSERT INTO Films (titre, photo, duree) VALUES ('Forrest Gump', 'forrestgump.jpg', '142')");

// while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
//     var_dump($row);
// }
require_once 'layout/footer.php';
