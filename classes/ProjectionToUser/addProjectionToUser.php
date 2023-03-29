<?php
require_once __DIR__ . '/ProjectionToUser.php';
require_once __DIR__ . '/../Exception/ProjectionException/AlreadyAddException.php';
class addProjectionToUser extends ProjectionToUser
{
    private int $note;

    public function __construct(string $projection, string $titre, string $column, string $user_pseudo, int $note)
    {
        parent::__construct($projection, $titre, $column, $user_pseudo);
        $this->note = $note;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function addToUser()
    {
        require __DIR__ . '/../../data/bdd_link.php';
        $stm = $pdo->prepare("SELECT id FROM Users WHERE pseudo = :pseudo");
        $stm->execute([
            'pseudo' => $this->getUser_pseudo()
        ]);
        $user_id = $stm->fetch();

        $stm = $pdo->prepare("SELECT id FROM " . $this->getProjection() . " WHERE titre = :titre");
        $stm->execute([
            'titre' => $this->getTitre()
        ]);
        $projection_id = $stm->fetch();

        $stm = $pdo->prepare("SELECT user_id, " . $this->getColumn() . " FROM L_Users_" . $this->getProjection() . " WHERE user_id = :user_id AND " . $this->getColumn() . "=:proj_id");
        $stm->execute([
            'user_id' => $user_id['id'],
            'proj_id' => $projection_id['id']
        ]);
        $IsExist = $stm->fetch();
        if (isset($IsExist)) {
            throw new AlreadyAddException();
        }

        $statement = $pdo->prepare("INSERT INTO L_Users_" . $this->getProjection() . " (user_id," . $this->getColumn() . ",note) VALUES (:user_id, :projection_id, :note)");
        $statement->execute([
            'user_id' => $user_id['id'],
            'projection_id' => $projection_id['id'],
            'note' => $this->getNote()
        ]);

        redirect('dashboard.php?success=1');
    }
}
