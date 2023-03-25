<?php
function countProjection($table, $tableJoin, $column): string
{
    require __DIR__ . '/../data/bdd_link.php';
    $statement = $pdo->prepare("SELECT  CONCAT(FLOOR(SUM(duree)/1440),'j ', FLOOR(MOD(SUM(duree),1440)/60),'h ',MOD(MOD(SUM(duree),1440),60),'m') AS total_formatted FROM $table
                                    JOIN $tableJoin ON $column = $tableJoin.id 
                                    JOIN Users ON user_id = Users.id
                                WHERE user_id = (
                                SELECT id FROM Users WHERE pseudo = :pseudo
                            )");
    $statement->execute([
        'pseudo' => $_SESSION['pseudo']
    ]);

    $row = $statement->fetch();

    if ($row['total_formatted'] === NULL) {
        return "0H00";
    }
    return $row['total_formatted'];
}
