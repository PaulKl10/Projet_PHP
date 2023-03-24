<?php
require_once 'functions/addProjectionToUser.php';
require_once 'functions/redirect.php';

if (empty($_GET)) {
    redirect('dashboard.php');
}
session_start();
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
    addProjectionToUser($_GET['projection'], $_GET['titre'], $column);
} catch (PDOException $e) {
    redirect('dashboard.php?error=2');
}
