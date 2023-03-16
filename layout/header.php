<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Projet_application_web</title>
</head>
<body class='bg-black'>
<nav class="navbar navbar-dark navbar-expand-lg bg-black">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Oh my count</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php
      if(isset($_SESSION)){?>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav m-auto fs-3 gap-5">
          <a class="nav-link" aria-current="page" href="movies.php">Movies</a>
          <a class="nav-link" aria-current="page" href="series.php">Series</a>
          <a class="nav-link" aria-current="page" href="animes.php">Animes</a>
        </div>
      </div>
      <?php
      }
      ?>
    </div>
  </nav>
