<?php
require_once __DIR__ . '/../classes/WatchProjection.php';
?>

<section class="container row row-cols-1 row-cols-md-3 text-white text-center m-auto mt-5">
    <h2 class="m-auto"><?php $watch = new WatchProjection($_SESSION['id']);
                        echo $watch->counter($watch::ALL); ?></h2>
    <div class="ligne my-3"></div>
    <div class="col">
        <h3>Films</h3>
        <h5><?php echo $watch->counter($watch::MOVIE) ?></h5>
        <?php $watch->showProjectionToUser($watch::MOVIE) ?>
        <a class="wow animate__animated animate__fadeInUp" href="movies.php"><img class="img-fluid rounded-circle w-25" src="assets/images/add-icon.png" alt="add icon"></a>
    </div>
    <div class="col">
        <h3>Series</h3>
        <h5><?php echo $watch->counter($watch::SERIE); ?></h5>
        <?php $watch->showProjectionToUser($watch::SERIE) ?>
        <a class="wow animate__animated animate__fadeInUp" href="series.php"><img class="img-fluid rounded-circle w-25" src="assets/images/add-icon.png" alt="add icon"></a>
    </div>
    <div class="col">
        <h3>Animes</h3>
        <h5><?php echo $watch->counter($watch::ANIME); ?></h5>
        <?php $watch->showProjectionToUser($watch::ANIME) ?>
        <a class="wow animate__animated animate__fadeInUp" href="animes.php"><img class="img-fluid rounded-circle w-25" src="assets/images/add-icon.png" alt="add icon"></a>
    </div>
</section>