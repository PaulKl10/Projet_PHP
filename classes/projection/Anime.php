<?php
require_once __DIR__ . '/Projection.php';
require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../functions/redirect.php';
require_once __DIR__ . '/../ProjectionToUser/addProjectionToUser.php';

class Anime extends Projection
{
    private string $nb_episode;

    public function __construct(string $titre, string $photo, string $duree, int $note,  User $user, $nb_episode)
    {
        parent::__construct($titre, $photo, $duree, $note, $user);
        $this->nb_episode = $nb_episode;
    }

    public function getNb_episode()
    {
        return $this->nb_episode;
    }

    public function addToBdd()
    {
        try {
            require __DIR__ . '/../../data/bdd_link.php';
            $stm = $pdo->prepare("INSERT INTO Animes (titre, photo, duree, nb_episode) VALUES (:titre, :photo, :duree, :nb_episode)");
            $stm->execute([
                'titre' => $this->getTitre(),
                'photo' => $this->getPhoto(),
                'duree' => $this->getDuree(),
                'nb_episode' => $this->getnb_episode()
            ]);

            $add = new addProjectionToUser('Animes', $this->getTitre(), 'anime_id', $this->getUser()->getPseudo(), $this->getNote());
            $add->addToUser();
        } catch (PDOException $e) {
            redirect("animes.php?error=1");
        }
    }
}
