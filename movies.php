<?php
require_once 'functions/redirect.php';
require_once 'functions/uploadPic.php';
require_once 'functions/showProjection.php';

session_start();
if (!isset($_SESSION['connected'])) {
    redirect("index.php?error=3");
}
require_once 'classes/projection/Movie.php';
require_once 'classes/User.php';

if (isset($_FILES['file'])) {
    $photo = uploadPic($_FILES['file'], 'assets/images/Films/');
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $movie = new Movie($titre, $photo, $duree, new User($_SESSION['pseudo']));
    $movie->addToBdd();
}

require_once 'layout/header.php';
?>


<h1 class="text-warning text-center my-5">Movies</h1>
<p class="text-center fs-3 text-warning">Ajouter un film à votre compte</p>

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
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-warning text-white fw-bold mb-3">Ajouter le film</button>
    </div>
</form>
<div class="ligne"></div>
<section class="container text-white text-center">
    <h3 class="my-5 text-warning">Suggestions</h3>
    <?php showProjection('Films') ?>
</section>