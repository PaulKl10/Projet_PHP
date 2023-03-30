<?php
require_once 'classes/ProjectionToUser/addProjectionToUser.php';
require_once 'classes/Exception/ProjectionException/ProjectionException.php';
require_once 'functions/redirect.php';
require_once 'functions/isConnected.php';


isConnnected();

if (empty($_GET)) {
    redirect('dashboard.php');
}

switch ($_GET['projection']) {
    case "Films":
        $column = 'film_id';
        break;
    case "Series":
        $column = 'serie_id';
        break;
    case "Animes":
        $column = 'anime_id';
        break;
}
$note = intVal($_GET['note']);

try {
    $projection = new addProjectionToUser($_GET['projection'], $_GET['titre'], $column, $_SESSION['pseudo'], $note);
    $projection->addToUser();
} catch (ProjectionException $e) {
    redirect('dashboard.php?error=' . $e->getCode());
}
