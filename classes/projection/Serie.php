<?php
require_once __DIR__ . '/../Projection.php';
require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../functions/redirect.php';

class Serie extends Projection
{
    private string $nb_saison;

    public function __construct(string $titre, string $photo, string $duree, User $user, $nb_saison)
    {
        parent::__construct($titre, $photo, $duree, $user);
        $this->nb_saison = $nb_saison;
    }

    public function getNb_saison()
    {
        return $this->nb_saison;
    }

    public function addToBdd()
    {
        require __DIR__ . '/../../data/bdd_link.php';
        $stm = $pdo->prepare("INSERT INTO Series (titre, photo, duree, nb_saison) VALUES (:titre, :photo, :duree, :nb_saison)");
        $stm->execute([
            'titre' => $this->getTitre(),
            'photo' => $this->getPhoto(),
            'duree' => $this->getDuree(),
            'nb_saison' => $this->getNb_saison()
        ]);

        $stm = $pdo->prepare("SELECT id FROM Users WHERE pseudo = :pseudo");
        $stm->execute([
            'pseudo' => $this->getUser()->getPseudo()
        ]);
        $user_id = $stm->fetch();

        $stm = $pdo->prepare("SELECT id FROM Series WHERE titre = :titre");
        $stm->execute([
            'titre' => $this->getTitre()
        ]);
        $serie_id = $stm->fetch();


        $statement = $pdo->prepare("INSERT INTO L_Users_Series (user_id, serie_id) VALUES (:user_id, :serie_id)");
        $statement->execute([
            'user_id' => $user_id['id'],
            'serie_id' => $serie_id['id']
        ]);

        redirect('dashboard.php?success=1');
    }
}
