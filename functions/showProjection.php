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
                <!-- Modal -->
                <div class="modal fade" id="addprojection<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="addprojectionLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-black" id="addprojectionLabel">Ajout de la projection</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="addProjectionToUser.php" method="GET">
                                    <input type="hidden" value="<?php echo $table ?>" name="projection">
                                    <input type="hidden" value="<?php echo $row['titre'] ?>" name="titre">
                                    <div>
                                        <label class="text-warning" for="note">Note</label>
                                        <select class="form-select" name="note" aria-label="Default select example">
                                            <option selected>Note sur 5 étoiles</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
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
                <!-- Modal -->
                <div class="modal fade" id="addprojection<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="addprojectionLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-black" id="addprojectionLabel">Ajout de la projection</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="addProjectionToUser.php" method="GET">
                                    <div class="d-none">
                                        <label class="text-warning" for="projection">Projection</label>
                                        <input type="text" class="form-control" id="projection" value="<?php echo $table ?>" name="projection" readonly>
                                    </div>
                                    <div class="d-none">
                                        <label class="text-warning" for="titre">Titre</label>
                                        <input type="text" class="form-control" id="titre" value="<?php echo $row['titre'] ?>" name="titre" readonly>
                                    </div>
                                    <div>
                                        <label class="text-warning" for="note">Note</label>
                                        <select class="form-select" name="note" aria-label="Default select example">
                                            <option selected>Note sur 5 étoiles</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
<?php
    }
} ?>