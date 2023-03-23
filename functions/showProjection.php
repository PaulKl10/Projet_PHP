<?php
function showProjection($table, $tableJoin, $column)
{
    require __DIR__ . '/../data/bdd_link.php';
    $statement = $pdo->prepare("SELECT * FROM $table 
                                        JOIN $tableJoin ON $column = $tableJoin.id 
                                        JOIN Users ON user_id = Users.id
                                    WHERE user_id = (
                                    SELECT id FROM Users WHERE pseudo = :pseudo
                                    )");
    $statement->execute([
        'pseudo' => $_SESSION['pseudo']
    ]); ?>
    <div class="row row-cols-1 gap-4 my-4">
        <?php
        while ($row = $statement->fetch()) { ?>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img class="movieList" src="assets/images/<?php echo $tableJoin ?>/<?php echo $row['photo'] ?>" alt="photo">
                <span><?php echo $row['titre'] ?></span>
            </div>

        <?php
        }
        ?>
    </div>
<?php } ?>