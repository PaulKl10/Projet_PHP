<?php
function showProjection($table)
{
    require __DIR__ . '/../data/bdd_link.php';
    $statement = $pdo->query("SELECT * FROM $table"); ?>
    <div class="row row-cols-5 gap-4 my-4">
        <?php
        while ($row = $statement->fetch()) { ?>
            <a href="addToUser.php?titre=<?php echo $row['titre'] ?>&&projection=<?php echo $table ?>" style="text-decoration: none;">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <img class="movieList" src="assets/images/<?php echo $table ?>/<?php echo $row['photo'] ?>" alt="photo">
                    <span class="movieTitre"><?php echo $row['titre'] ?></span>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
<?php } ?>