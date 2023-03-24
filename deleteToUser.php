<?php
require_once 'functions/deleteProjectionToUser.php';
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


deleteProjectionToUser($_GET['projection'], $_GET['titre'], $column);
