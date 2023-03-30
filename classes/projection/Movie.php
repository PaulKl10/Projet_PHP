<?php
require_once __DIR__ . '/Projection.php';
require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../functions/redirect.php';
require_once __DIR__ . '/../ProjectionToUser/addProjectionToUser.php';



class Movie extends Projection
{

    public function __construct(string $titre, string $photo, string $duree, int $note, User $user)
    {
        parent::__construct($titre, $photo, $duree, $note, $user);
    }

    public function addToBdd()
    {
        try {
            require __DIR__ . '/../../data/bdd_link.php';
            $stm = $pdo->prepare("INSERT INTO Films (titre, photo, duree) VALUES (:titre, :photo, :duree)");
            $stm->execute([
                'titre' => $this->getTitre(),
                'photo' => $this->getPhoto(),
                'duree' => $this->getDuree()
            ]);

            $add = new addProjectionToUser('Films', $this->getTitre(), 'film_id', $this->getUser()->getPseudo(), $this->getNote());
            $add->addToUser();
        } catch (PDOException $e) {
            redirect("movies.php?error=1");
        }
    }
}
