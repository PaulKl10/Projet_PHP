<?php
require_once 'functions/redirect.php';
require_once 'functions/uploadPic.php';
require_once 'functions/showProjection.php';

session_start();
if (!isset($_SESSION['connected'])) {
    redirect("index.php?error=3");
}
require_once 'classes/projection/Serie.php';
require_once 'classes/User.php';

if (isset($_FILES['file'])) {
    $photo = uploadPic($_FILES['file'], 'assets/images/Series/');
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $nb_saison = $_POST['nb_saison'];
    $serie = new Serie($titre, $photo, $duree, new User($_SESSION['pseudo']), $nb_saison);
    $serie->addToBdd();
}

require_once 'layout/header.php'; ?>

<h1 class="text-warning text-center my-5">Series</h1>
<p class="text-center w-50 mb-5 m-auto fs-3 text-warning">Ajouter une série à votre compte grâce à ce formulaire si il n'est pas encore enregistré sur notre site !<br> <a class="text-danger text-decoration-none" href="#suggestions">Voir suggestions en dessous</a href="#suggestions"></p>
<?php
if (!empty($_GET['error']) && $_GET['error'] === '1') { ?>
    <div class="alert alert-danger w-50 m-auto text-center">Cette série est déjà enregistré sur notre site, regardez les suggestions pour l'ajouter à votre compte </div>
<?php
}
?>
<form action="" method="POST" enctype="multipart/form-data" class="d-flex flex-column justify-content-center align-items-center gap-3">
    <div class="w-25">
        <label class="text-warning" for="picture_file">Choisir une photo</label>
        <input required type="file" class="form-control" id="picture_file" name="file">
    </div>
    <div class="w-25">
        <label class="text-warning" for="titre">Titre de la série</label>
        <input required type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="w-25">
        <label class="text-warning" for="duree">Durée de la série (en min)</label>
        <input required type="text" class="form-control" id="duree" name="duree">
    </div>
    <div class="w-25">
        <label class="text-warning" for="nb_saison">Nombre de saison(s)</label>
        <input required type="text" class="form-control" id="nb_saison" name="nb_saison">
    </div>
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-warning text-white fw-bold mb-3">Ajouter la série</button>
    </div>
</form>
<div class="ligne"></div>
<section class="container text-white text-center">
    <h3 class="my-5 text-warning" id="suggestions">Suggestions</h3>
    <form class="" action="#suggestions">
        <input type="text" name="search" placeholder="Rechercher une série"><br>
        <button type="submit" class="btn btn-warning text-white fw-bold my-3">Rechercher</button>
    </form>
    <?php showProjection('Series') ?>
</section>