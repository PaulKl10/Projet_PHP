<?php
require_once __DIR__ . '/../Projection.php';
require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../functions/redirect.php';
require_once __DIR__ . '/../../functions/addProjectionToUser.php';

class Serie extends Projection
{
    private string $nb_saison;

    public function __construct(string $titre, string $photo, string $duree, int $note,  User $user, $nb_saison)
    {
        parent::__construct($titre, $photo, $duree, $note, $user);
        $this->nb_saison = $nb_saison;
    }

    public function getNb_saison()
    {
        return $this->nb_saison;
    }

    public function addToBdd()
    {
        try {
            require __DIR__ . '/../../data/bdd_link.php';
            $stm = $pdo->prepare("INSERT INTO Series (titre, photo, duree, nb_saison) VALUES (:titre, :photo, :duree, :nb_saison)");
            $stm->execute([
                'titre' => $this->getTitre(),
                'photo' => $this->getPhoto(),
                'duree' => $this->getDuree(),
                'nb_saison' => $this->getNb_saison()
            ]);

            addProjectionToUser('Series', $this->getTitre(), 'serie_id', $this->getNote(), $this->getUser()->getPseudo());
        } catch (PDOException $e) {
            redirect('series.php?error=1');
        }
    }
}
