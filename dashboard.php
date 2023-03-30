<?php
require_once 'functions/redirect.php';
require_once 'functions/isConnected.php';
require_once 'classes/Exception/ProjectionException/ProjectionException.php';
require_once 'classes/Exception/ProjectionError.php';


isConnnected();


// Upload d'image pour photo de profile 
if (isset($_FILES['file'])) {
    try {
        require_once 'functions/uploadPic.php';
        $file = uploadPic($_FILES['file'], './assets/images/profile_pic/');
    } catch (ProjectionException $e) {
        redirect('dashboard.php?error=' . $e->getCode());
    }

    require_once 'functions/uploadToBdd_Users.php';
    uploadToBdd_Users($file, $_SESSION['pseudo']);
}


require_once 'layout/header.php'; ?>
<h1 class="text-warning text-center my-4">Dashboard</h1>
<?php
if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger w-50 my-4 m-auto text-center">
        <?php echo ProjectionError::getErrorMessage($_GET['error']); ?>
    </div>
<?php
}
?>
<?php
if (isset($_GET['success'])) { ?>
    <div class="alert alert-success w-50 m-auto text-center my-4">
        <?php switch ($_GET['success']) {
            case "1":
                echo "Votre enregistrement à bien eu lieu";
                break;
            case "2":
                echo "La suppression de votre projection a bien eu lieu";
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
<?php
require_once 'templates/showAndCountProjections.php';
require_once 'layout/footer.php';
