<?php
require_once 'functions/redirect.php';
session_start();
if (!isset($_SESSION['connected'])) {
    redirect("index.php?error=3");
}
require_once 'layout/header.php'; ?>

<h1 class="text-warning text-center my-5">Series</h1>
<p class="text-center fs-3 text-warning">Ajouter une série à votre compte</p>

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