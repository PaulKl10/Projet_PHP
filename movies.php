<?php
require_once 'functions/redirect.php';
require_once 'functions/uploadPic.php';
require_once 'functions/showProjection.php';
require_once 'functions/showRank.php';
require_once 'functions/isConnected.php';
require_once 'classes/projection/Movie.php';
require_once 'classes/User.php';

isConnnected();


if (isset($_FILES['file'])) {
    try {
        $photo = uploadPic($_FILES['file'], 'assets/images/Films/');
    } catch (ProjectionException $e) {
        redirect('dashboard.php?error=' . $e->getCode());
    }
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $note = intVal($_POST['note']);
    $movie = new Movie($titre, $photo, $duree, $note, new User($_SESSION['pseudo']));
    $movie->addToBdd();
}

require_once 'layout/header.php';
?>


<h1 class="text-warning text-center my-5">Movies</h1>
<p class="text-center w-50 mb-3 m-auto fs-3 text-warning">Ajouter un film à votre compte grâce à ce formulaire si il n'est pas encore enregistré sur notre site !<br> <a class="text-danger text-decoration-none" href="#suggestions">Voir suggestions en dessous</a href="#suggestions"></p>
<?php
if (!empty($_GET['error']) && $_GET['error'] === '1') { ?>
    <div class="alert alert-danger w-50 m-auto text-center">Le film est déjà enregistré sur notre site, regardez les suggestions pour l'ajouter à votre compte </div>
<?php
}
?>
<div class="row row-cols-1 mb-4 m-auto g-5">
    <form action="" method="POST" enctype="multipart/form-data" class="d-flex flex-column justify-content-center align-items-center gap-3">
        <div class="w-25">
            <label class="text-warning" for="picture_file">Choisir une photo</label>
            <input required type="file" class="form-control" id="picture_file" name="file">
        </div>
        <div class="w-25">
            <label class="text-warning" for="titre">Titre du film</label>
            <input required type="text" class="form-control" id="titre" name="titre">
        </div>
        <div class="w-25">
            <label class="text-warning" for="duree">Durée du film (en min)</label>
            <input required type="text" class="form-control" id="duree" name="duree">
        </div>
        <div class="w-25">
            <label class="text-warning" for="note">Note</label>
            <select class="form-select" name="note" aria-label="Default select example">
                <option selected>Note sur 5 étoiles</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-warning text-white fw-bold mb-3">Ajouter le film</button>
        </div>
    </form><?php
            showRank('Films', 'film_id'); ?>
</div>
<div class="ligne"></div>
<section class="container text-white text-center">
    <h3 class="my-5 text-warning" id="suggestions">Suggestions</h3>
    <form class="" action="#suggestions">
        <input type="text" name="search" class="form-control bg-white w-25 m-auto text-black" id="floatingInput" placeholder="Rechercher un film"><br>
        <button type="submit" class="btn btn-warning text-white fw-bold mb-5">Rechercher</button>
    </form>
    <?php showProjection('Films') ?>
</section>
<?php
require_once 'layout/footer.php';
