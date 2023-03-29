<?php
require_once 'classes/ProjectionToUser/deleteProjectionToUser.php';
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

try {
    $projection = new deleteProjectionToUser($_GET['projection'], $_GET['titre'], $column, $_SESSION['pseudo']);
    $projection->deleteToUser();
} catch (PDOException $e) {
    exit('Error deleting');
}
