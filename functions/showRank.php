<?php
function showRank($table, $column)
{
    require __DIR__ . '/../data/bdd_link.php';
    $statement = $pdo->query("SELECT ROUND(AVG(note),1) AS note_moyenne, $table.titre FROM `L_Users_$table`
							INNER JOIN $table ON $column = $table.id
                            GROUP BY $table.titre  
                            ORDER BY `note_moyenne`  DESC
                            LIMIT 5;"); ?>

    <div class="d-flex flex-column justify-content-center w-auto m-auto text-white my-5">
        <h3 class="text-center">TOP 5 <?php echo $table ?></h3>
        <?php
        $rank = 1;
        while ($row = $statement->fetch()) { ?>
            <div class="fs-5">
                <span class="text-warning"><?php echo $row['note_moyenne'] ?><img style="margin-bottom: 5px;" width="15px" height="auto" src="assets/images/star.png" alt="star"></span>
                <span class="text-danger"><?php echo $row['titre'] ?></span>
            </div>
        <?php
        } ?>
    </div>
<?php
}
