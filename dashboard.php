<?php
require_once 'functions/redirect.php';
session_start();
if (!isset($_SESSION['connected'])) {
    redirect("index.php?error=3");
}

// Upload d'image pour photo de profile 
if (isset($_FILES['file'])) {
    require_once 'functions/uploadPic.php';
    $file = uploadPic($_FILES['file'], './assets/images/profile_pic/');
    require_once 'functions/uploadToBdd_Users.php';
    uploadToBdd_Users($file, $_SESSION['pseudo']);
}


require_once 'layout/header.php'; ?>
<h1 class="text-warning text-center my-5">Dashboard</h1>
<?php
if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger w-50 m-auto text-center">
        <?php switch ($_GET['error']) {
            case "1":
                echo "Mauvaise extension ou taille trop grande";
                break;
        } ?>
    </div>
<?php
}
?>
<section class="text-white row">
    <div class="col">
        <div class="gap-4 d-flex flex-column justify-content-center align-items-center ms-auto" style="width:200px">
            <?php
            require 'data/bdd_link.php';
            $statement = $pdo->prepare("SELECT photo_u FROM Users WHERE pseudo = :pseudo");
            $statement->execute([
                'pseudo' => $_SESSION['pseudo']
            ]);
            $picture = $statement->fetch();
            if ($picture['photo_u'] === NULL) { ?>
                <img class="profile_pic" src="assets/images/defaut.jpeg" alt="defaut">
            <?php
            } else { ?>
                <img class="profile_pic" src="assets/images/profile_pic/<?php echo $picture['photo_u'] ?>" alt="photo">
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
<section class="container row row-cols-1 row-cols-md-3 text-white text-center m-auto mt-5">
    <h2 class="m-auto">Count : 0:00:00</h2>
    <div class="ligne my-3"></div>
    <div class="col">
        <h3>Films</h3>
        <h5>0:00:00</h5>
        <?php
        $statement = $pdo->prepare("SELECT * FROM L_Users_films 
                                        JOIN Films ON film_id = Films.id 
                                        JOIN Users ON user_id = Users.id
                                    WHERE user_id = (
                                    SELECT id FROM Users WHERE pseudo = :pseudo
                                    )");
        $statement->execute([
            'pseudo' => $_SESSION['pseudo']
        ]); ?>
        <div class="row row-cols-1 gap-4 mt-4">
            <?php
            while ($row = $statement->fetch()) { ?>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <img class="movieList" src="assets/images/movies/<?php echo $row['photo'] ?>" alt="photo">
                    <span><?php echo $row['titre'] ?></span>
                </div>

            <?php
            }
            ?>
        </div>
        <a class="" href="movies.php"><img class="img-fluid rounded-circle w-25" src="assets/images/add-icon.png" alt="add icon"></a>
    </div>
    <div class="col">
        <h3>Series</h3>
        <h5>0:00:00</h5>
        <a class="" href="series.php"><img class="img-fluid rounded-circle w-25" src="assets/images/add-icon.png" alt="add icon"></a>
    </div>
    <div class="col">
        <h3>Animes</h3>
        <h5>0:00:00</h5>
        <a class="" href="animes.php"><img class="img-fluid rounded-circle w-25" src="assets/images/add-icon.png" alt="add icon"></a>
    </div>
</section>

<?php
require_once 'layout/footer.php';
