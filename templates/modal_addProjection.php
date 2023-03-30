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