<?php
require_once 'functions/redirect.php';
require_once 'functions/uploadPic.php';
require_once 'functions/showProjection.php';

session_start();
if (!isset($_SESSION['connected'])) {
    redirect("index.php?error=3");
}
require_once 'classes/projection/Anime.php';
require_once 'classes/User.php';

if (isset($_FILES['file'])) {
    $photo = uploadPic($_FILES['file'], 'assets/images/Animes/');
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $nb_episode = $_POST['nb_episode'];
    $anime = new Anime($titre, $photo, $duree, new User($_SESSION['pseudo']), $nb_episode);
    $anime->addToBdd();
}
require_once 'layout/header.php'; ?>

<h1 class="text-warning text-center my-5">Animes</h1>
<p class="text-center fs-3 text-warning">Ajouter un animé à votre compte</p>

<form action="" method="POST" enctype="multipart/form-data" class="d-flex flex-column justify-content-center align-items-center gap-3">
    <div class="w-25">
        <label class="text-warning" for="picture_file">Choisir une photo</label>
        <input required type="file" class="form-control" id="picture_file" name="file">
    </div>
    <div class="w-25">
        <label class="text-warning" for="titre">Titre de l'animé</label>
        <input required type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="w-25">
        <label class="text-warning" for="duree">Durée de l'animé (en min)</label>
        <input required type="text" class="form-control" id="duree" name="duree">
    </div>
    <div class="w-25">
        <label class="text-warning" for="nb_episode">Nombre d'épisodes</label>
        <input required type="text" class="form-control" id="nb_episode" name="nb_episode">
    </div>
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-warning text-white fw-bold mb-3">Ajouter l'animé</button>
    </div>
</form>
<div class="ligne"></div>
<section class="container text-white text-center">
    <h3 class="my-5 text-warning">Suggestions</h3>
    <?php showProjection('Animes') ?>
</section>