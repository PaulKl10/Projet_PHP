<?php
require_once __DIR__ . '/ProjectionToUser.php';
class deleteProjectionToUser extends ProjectionToUser
{
    public function __construct(string $projection, string $titre, string $column, string $user_pseudo)
    {
        parent::__construct($projection, $titre, $column, $user_pseudo);
    }

    public function deleteToUser()
    {
        require_once 'data/bdd_link.php';
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


        $statement = $pdo->prepare("DELETE FROM L_Users_" . $this->getProjection() . " WHERE user_id=:user_id && " . $this->getColumn() . "=:projection_id");
        $statement->execute([
            'user_id' => $user_id['id'],
            'projection_id' => $projection_id['id']
        ]);

        redirect('dashboard.php?success=2');
    }
}
