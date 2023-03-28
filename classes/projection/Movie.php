<?php
require_once __DIR__ . '/../Projection.php';
require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../functions/redirect.php';
require_once __DIR__ . '/../../functions/addProjectionToUser.php';



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

            addProjectionToUser('Films', $this->getTitre(), 'film_id', $this->getNote(), $this->getUser()->getPseudo());
        } catch (PDOException $e) {
            redirect("movies.php?error=1");
        }
    }
}
