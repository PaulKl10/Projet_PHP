<?php
require_once 'functions/redirect.php';
require_once 'functions/uploadPic.php';
require_once 'functions/isConnected.php';
require_once 'classes/projection/Anime.php';
require_once 'classes/User.php';
require_once 'classes/WatchProjection.php';


isConnnected();

if (isset($_FILES['file'])) {
    try {
        $photo = uploadPic($_FILES['file'], 'assets/images/Animes/');
    } catch (ProjectionException $e) {
        redirect('dashboard.php?error=' . $e->getCode());
    }
    $titre = $_POST['titre'];
    $duree = $_POST['duree'];
    $note = intVal($_POST['note']);
    $nb_episode = $_POST['nb_episode'];
    $anime = new Anime($titre, $photo, $duree, $note, new User($_SESSION['pseudo']), $nb_episode);
    $anime->addToBdd();
    redirect('dashboard.php?success=1');
}
require_once 'layout/header.php'; ?>

<h1 class="text-warning text-center my-5">Animes</h1>
<p class="text-center w-75 w-lg-50 mb-3 m-auto fs-3 text-warning">Ajouter un animé à votre compte grâce à ce formulaire si il n'est pas encore enregistré sur notre site !<br> <a class="text-danger text-decoration-none" href="#suggestions">Voir suggestions en dessous</a href="#suggestions"></p>
<?php
if (!empty($_GET['error']) && $_GET['error'] === '1') { ?>
    <div class="alert alert-danger w-50 m-auto text-center">Cette animé est déjà enregistré sur notre site, regardez les suggestions pour l'ajouter à votre compte </div>
<?php
}
?>
<div class="row row-cols-1 m-auto g-5 flex-column">
    <form action="" method="POST" enctype="multipart/form-data" class="d-flex flex-column justify-content-center align-items-center gap-3 col col-lg-4 m-auto">
        <div class="w-75 w-lg-25">
            <label class="text-warning" for="picture_file">Choisir une photo</label>
            <input required type="file" class="form-control" id="picture_file" name="file">
        </div>
        <div class="w-75 w-lg-25">
            <label class="text-warning" for="titre">Titre de l'animé</label>
            <input required type="text" class="form-control" id="titre" name="titre">
        </div>
        <div class="w-75 w-lg-25">
            <label class="text-warning" for="duree">Durée de l'animé (en min)</label>
            <input required type="text" class="form-control" id="duree" name="duree">
        </div>
        <div class="w-75 w-lg-25">
            <label class="text-warning" for="nb_episode">Nombre d'épisodes</label>
            <input required type="text" class="form-control" id="nb_episode" name="nb_episode">
        </div>
        <div class="w-75 w-lg-25">
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
            <button type="submit" class="btn btn-warning text-white fw-bold mb-3">Ajouter l'animé</button>
        </div>
    </form>
    <?php
    $watch = new WatchProjection($_SESSION['id']);
    $watch->showRank($watch::ANIME); ?>
</div>
<div class="ligne wow animate__animated animate__fadeInUp"></div>
<section class="container text-white text-center wow animate__animated animate__fadeInUp">
    <h3 class=" my-5 text-warning">Suggestions</h3>
    <form class="" action="#suggestions" id="suggestions">
        <input type="text" name="search" class="form-control bg-white w-25 m-auto text-black" id="floatingInput" placeholder="Rechercher un animé"><br>
        <button type="submit" class="btn btn-warning text-white fw-bold my-3">Rechercher</button>
    </form>
    <?php
    if (isset($_GET['search'])) {
        $result = $_GET['search'];
        $watch->showProjection($watch::ANIME, $result);
    } else {
        $watch->showProjection($watch::ANIME);
    }
    ?>
</section>
<?php
require_once 'layout/footer.php';
