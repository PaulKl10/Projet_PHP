<?php
require_once 'functions/redirect.php';
session_start();
if(!isset($_SESSION['connected'])){
    redirect("index.php?error=3");
}

// Upload d'image pour photo de profile 
if(isset($_FILES['file'])){
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
}

$tabExtension = explode('.', $name);
$extension = strtolower(end($tabExtension));
//Tableau des extensions que l'on accepte
$extensions = ['jpg', 'png', 'jpeg', 'gif'];
//Taille max que l'on accepte
$maxSize = 400000;

if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){

    $uniqueName = uniqid('', true);
    //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
    $file = $uniqueName.".".$extension;
    //$file = 5f586bf96dcd38.73540086.jpg

    move_uploaded_file($tmpName, './images/'.$file);
}
else{
    echo "Mauvaise extension ou taille trop grande";
}

require_once 'layout/header.php';?>
<h1 class="text-warning text-center my-5">Dashboard</h1>
<section class="text-white row">
    <div class="col">
        <div class="gap-4 d-flex flex-column justify-content-center align-items-center ms-auto" style="width:200px">
            <?php
            require_once __DIR__.'/data/bdd_link.php';
            $statement = $pdo->prepare("SELECT photo FROM Users WHERE pseudo = :pseudo");
            $statement->execute([
                'pseudo' => $_SESSION['pseudo']
            ]);
            $picture = $statement->fetch();
            if ($picture['photo'] === NULL){?>
            <img class="profile_pic" src="assets/images/defaut.jpeg" alt="defaut">
            <?php
            }
            ?>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Modifier la photo</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="picture_file" name="file">
                            <label class="input-group-text" for="picture_file">Upload</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
            
        </div>
    </div>
    <div class="col p-0">
        <h2>Compte de <?php echo $_SESSION['pseudo']; ?></h2>
    </div>
</section>
<section class="container row row-cols-1 row-cols-md-3 text-white text-center m-auto mt-3">
    <div class="ligne my-3"></div>
    <div class="col">
        <h3>Films</h3>
    </div>
    <div class="col">
        <h3>Series</h3>
    </div>
    <div class="col">
        <h3>Animes</h3>
    </div>
</section>

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
