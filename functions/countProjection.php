<?php
function countProjection($table, $tableJoin, $column, $user_id): string
{
    require __DIR__ . '/../data/bdd_link.php';
    $statement = $pdo->prepare("SELECT  CONCAT(FLOOR(SUM(duree)/1440),'j ', FLOOR(MOD(SUM(duree),1440)/60),'h ',MOD(MOD(SUM(duree),1440),60),'m') AS total_formatted FROM $table
                                    JOIN $tableJoin ON $column = $tableJoin.id 
                                    JOIN Users ON user_id = Users.id
                                WHERE user_id = :id");
    $statement->execute([
        'id' => $user_id
    ]);

    $row = $statement->fetch();

    if ($row['total_formatted'] === NULL) {
        return "0H00";
    }
    return $row['total_formatted'];
}
