<?php
class WatchCounter
{
    private int $user_id;
    public const ALL = 0;
    public const MOVIE = 1;
    public const SERIE = 2;
    public const ANIME = 3;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function counter($projection)
    {
        switch ($projection) {
            case self::ALL:
                break;
            case self::MOVIE:
                $table = 'L_Users_Films';
                $tableJoin = 'Films';
                $column = 'film_id';
                break;
            case self::SERIE:
                $table = 'L_Users_Series';
                $tableJoin = 'Series';
                $column = 'serie_id';
                break;
            case self::ANIME:
                $table = 'L_Users_Animes';
                $tableJoin = 'Animes';
                $column = 'anime_id';
                break;
            default:
                return "Une erreur est survenue";
        }
        if (isset($table) && isset($column) && isset($tableJoin)) {
            require __DIR__ . '/../data/bdd_link.php';
            $statement = $pdo->prepare("SELECT  CONCAT(FLOOR(SUM(duree)/1440),'j ', FLOOR(MOD(SUM(duree),1440)/60),'h ',MOD(MOD(SUM(duree),1440),60),'m') AS total_formatted FROM $table
                                    JOIN $tableJoin ON $column = $tableJoin.id 
                                    JOIN Users ON user_id = Users.id
                                WHERE user_id = :id");
            $statement->execute([
                'id' => $this->getUserId()
            ]);

            $row = $statement->fetch();

            if ($row['total_formatted'] === NULL) {
                return "0H00";
            }
            return $row['total_formatted'];
        } else {
            require __DIR__ . '/../data/bdd_link.php';
            $statement = $pdo->prepare("SELECT CONCAT(FLOOR(SUM(duree)/1440),'j ', FLOOR(MOD(SUM(duree),1440)/60),'h ',MOD(MOD(SUM(duree),1440),60),'m') AS total_formatted FROM (
                                    SELECT duree FROM L_users_series JOIN series ON serie_id = series.id 
                                                                    JOIN Users ON user_id = Users.id 
                                    WHERE user_id = :id
                                    UNION ALL
                                    SELECT duree FROM L_users_films JOIN films ON film_id = films.id 
                                                                    JOIN Users ON user_id = Users.id 
                                    WHERE user_id = :id
                                    UNION ALL
                                    SELECT duree FROM L_users_animes JOIN animes ON anime_id = animes.id 
                                                                    JOIN Users ON user_id = Users.id 
                                    WHERE user_id = :id
                                ) AS total_duration_minutes");
            $statement->execute([
                'id' => $this->getUserId()
            ]);

            $row = $statement->fetch();

            if ($row['total_formatted'] === NULL) {
                return "0J00H00M";
            }
            return $row['total_formatted'];
        }
    }
}
