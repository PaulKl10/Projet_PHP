<?php
class WatchProjection
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
                $table = 'Films';
                $column = 'film_id';
                break;
            case self::SERIE:
                $table = 'Series';
                $column = 'serie_id';
                break;
            case self::ANIME:
                $table = 'Animes';
                $column = 'anime_id';
                break;
            default:
                return "Une erreur est survenue";
        }
        if (isset($table) && isset($column)) {
            require __DIR__ . '/../data/bdd_link.php';
            $statement = $pdo->prepare("SELECT  CONCAT(FLOOR(SUM(duree)/1440),'j ', FLOOR(MOD(SUM(duree),1440)/60),'h ',MOD(MOD(SUM(duree),1440),60),'m') AS total_formatted FROM L_Users_$table
                                    JOIN $table ON $column = $table.id 
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

    public function showProjectionToUser($projection)
    {
        switch ($projection) {
            case self::MOVIE:
                $table = 'Films';
                $column = 'film_id';
                break;
            case self::SERIE:
                $table = 'Series';
                $column = 'serie_id';
                break;
            case self::ANIME:
                $table = 'Animes';
                $column = 'anime_id';
                break;
            default:
                return "Une erreur est survenue";
        }
        require __DIR__ . '/../data/bdd_link.php';
        $statement = $pdo->prepare("SELECT * FROM L_Users_$table 
                                        JOIN $table ON $column = $table.id 
                                        JOIN Users ON user_id = Users.id
                                    WHERE user_id = :id ORDER BY $table.titre");
        $statement->execute([
            'id' => $this->getUserId()
        ]); ?>
        <div class="row row-cols-1 gap-5 my-4">
            <?php
            while ($row = $statement->fetch()) { ?>
                <div class="d-flex flex-column justify-content-center align-items-center wow animate__animated animate__fadeInUp">
                    <img class="movieList" src="assets/images/<?php echo $table ?>/<?php echo $row['photo'] ?>" alt="photo">
                    <span><?php echo $row['titre'] ?></span>
                    <span><?php echo $row['note'] ?> <img style="margin-bottom: 5px;" width="15px" height="auto" src="assets/images/star.png" alt="star"></span>
                    <a class="" href="deleteProjectionToUser.php?titre=<?php echo $row['titre'] ?>&&projection=<?php echo $table ?>"><img class="img-fluid rounded-circle" width="30px" height="auto" src="assets/images/supp.png" alt="supp icon"></a>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
    }

    public function showProjection($projection, $result = NULL)
    {
        switch ($projection) {
            case self::MOVIE:
                $table = 'Films';
                break;
            case self::SERIE:
                $table = 'Series';
                break;
            case self::ANIME:
                $table = 'Animes';
                break;
            default:
                return "Une erreur est survenue";
        }

        require __DIR__ . '/../data/bdd_link.php';
        if ($result !== NULL) {
            $search = "%$result%";
            $statement = $pdo->prepare("SELECT * FROM $table WHERE titre LIKE :search ORDER BY titre");
            $statement->execute([
                'search' => $search
            ]); ?>
            <div class="row row-cols-5 g-4 my-4">
                <?php
                while ($row = $statement->fetch()) { ?>
                    <a class="wow animate__animated animate__fadeInUp" data-bs-toggle="modal" data-bs-target="#addprojection<?php echo $row['id'] ?>" style="text-decoration: none; cursor:pointer">
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
                    <a class="wow animate__animated animate__fadeInUp" data-bs-toggle="modal" data-bs-target="#addprojection<?php echo $row['id'] ?>" style="text-decoration: none; cursor:pointer">
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
    }

    public function showRank($projection)
    {
        switch ($projection) {
            case self::MOVIE:
                $table = 'Films';
                $column = 'film_id';
                break;
            case self::SERIE:
                $table = 'Series';
                $column = 'serie_id';
                break;
            case self::ANIME:
                $table = 'Animes';
                $column = 'anime_id';
                break;
            default:
                return "Une erreur est survenue";
        }
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
                <div class="fs-5 wow animate__animated animate__fadeInUp"">
                    <span class=" text-warning"><?php echo $row['note_moyenne'] ?><img style="margin-bottom: 5px;" width="15px" height="auto" src="assets/images/star.png" alt="star"></span>
                    <span class="text-danger"><?php echo $row['titre'] ?></span>
                </div>
            <?php
            } ?>
        </div>
<?php
    }
}
