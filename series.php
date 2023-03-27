<?php
require_once 'functions/redirect.php';
require_once 'functions/uploadPic.php';
require_once 'functions/showProjection.php';
require_once 'functions/isConnected.php';
require_once 'functions/showRank.php';
require_once 'classes/projection/Serie.php';
require_once 'classes/User.php';

try {
    isConnnected();
} catch (UserException $e) {
    redirect("index.php?error=" . $e->getCode());
}

if (isset($_FILES['file'])) {
    $photo = uploadPic($_FILES['file'], 'assets/images/Series/');
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $note = intVal($_POST['note']);
    $nb_saison = $_POST['nb_saison'];
    $serie = new Serie($titre, $photo, $duree, $note, new User($_SESSION['pseudo']), $nb_saison);
    $serie->addToBdd();
}

require_once 'layout/header.php'; ?>

<h1 class="text-warning text-center my-5">Series</h1>
<p class="text-center w-50 mb-3 m-auto fs-3 text-warning">Ajouter une série à votre compte grâce à ce formulaire si il n'est pas encore enregistré sur notre site !<br> <a class="text-danger text-decoration-none" href="#suggestions">Voir suggestions en dessous</a href="#suggestions"></p>
<?php
if (!empty($_GET['error']) && $_GET['error'] === '1') { ?>
    <div class="alert alert-danger w-50 m-auto text-center">Cette série est déjà enregistré sur notre site, regardez les suggestions pour l'ajouter à votre compte </div>
<?php
}
?>
<div class="row row-cols-1 m-auto g-5">
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
            <button type="submit" class="btn btn-warning text-white fw-bold mb-3">Ajouter la série</button>
        </div>
    </form>
    <?php
    showRank('Series', 'serie_id'); ?>
</div>
<div class="ligne"></div>
<section class="container text-white text-center">
    <h3 class="my-5 text-warning" id="suggestions">Suggestions</h3>
    <form class="" action="#suggestions">
        <input type="text" name="search" class="form-control bg-white w-25 m-auto text-black" id="floatingInput" placeholder="Rechercher une série"><br>
        <button type="submit" class="btn btn-warning text-white fw-bold my-3">Rechercher</button>
    </form>
    <?php showProjection('Series') ?>
</section>
<?php
require_once 'layout/footer.php';
