<?php
function showProjection($table)
{
    require __DIR__ . '/../data/bdd_link.php';
    if (isset($_GET['search'])) {
        $search = "%" . $_GET['search'] . "%";
        $statement = $pdo->prepare("SELECT * FROM $table WHERE titre LIKE :search ORDER BY titre");
        $statement->execute([
            'search' => $search
        ]); ?>
        <div class="row row-cols-5 g-4 my-4">
            <?php
            while ($row = $statement->fetch()) { ?>
                <a data-bs-toggle="modal" data-bs-target="#addprojection<?php echo $row['id'] ?>" style="text-decoration: none; cursor:pointer">
                    <div class="projection d-flex flex-column justify-content-center align-items-center">
                        <img class="movieList" src="assets/images/<?php echo $table ?>/<?php echo $row['photo'] ?>" alt="photo">
                        <span class="movieTitre"><?php echo $row['titre'] ?></span>
                    </div>
                </a>
            <?php
                require __DIR__ . '/../templates/modal_addProjection.php';
            }
            ?>
        </div>
    <?php
    } else {
        $statement = $pdo->query("SELECT * FROM $table ORDER BY titre"); ?>
        <div class="row row-cols-5 g-4 my-4">
            <?php
            while ($row = $statement->fetch()) { ?>
                <a data-bs-toggle="modal" data-bs-target="#addprojection<?php echo $row['id'] ?>" style="text-decoration: none; cursor:pointer">
                    <div class="projection d-flex flex-column justify-content-center align-items-center">
                        <img class="movieList" src="assets/images/<?php echo $table ?>/<?php echo $row['photo'] ?>" alt="photo">
                        <span class="movieTitre"><?php echo $row['titre'] ?></span>
                    </div>
                </a>
            <?php
                require __DIR__ . '/../templates/modal_addProjection.php';
            }
            ?>
        </div>
<?php
    }
} ?>