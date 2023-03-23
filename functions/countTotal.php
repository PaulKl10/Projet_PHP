<?php
function countTotal(): string
{
    require __DIR__ . '/../data/bdd_link.php';
    $statement = $pdo->prepare("SELECT CONCAT(FLOOR(SUM(duree)/1440),'j ', FLOOR(MOD(SUM(duree),1440)/60),'h ',MOD(MOD(SUM(duree),1440),60),'m') AS total_formatted FROM (
                                    SELECT duree FROM L_users_series JOIN series ON serie_id = series.id 
                                                                    JOIN Users ON user_id = Users.id 
                                    WHERE user_id = (SELECT id FROM Users WHERE pseudo = :pseudo)
                                    UNION ALL
                                    SELECT duree FROM L_users_films JOIN films ON film_id = films.id 
                                                                    JOIN Users ON user_id = Users.id 
                                    WHERE user_id = (SELECT id FROM Users WHERE pseudo = :pseudo)
                                    UNION ALL
                                    SELECT duree FROM L_users_animes JOIN animes ON anime_id = animes.id 
                                                                    JOIN Users ON user_id = Users.id 
                                    WHERE user_id = (SELECT id FROM Users WHERE pseudo = :pseudo)
                                ) AS total_duration_minutes");
    $statement->execute([
        'pseudo' => $_SESSION['pseudo']
    ]);

    $row = $statement->fetch();

    if ($row['total_formatted'] === NULL) {
        return "0J00H00M";
    }
    return $row['total_formatted'];
}
