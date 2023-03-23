<?php
require_once __DIR__ . '/../Projection.php';
require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../functions/redirect.php';

class Anime extends Projection
{
    private string $nb_episode;

    public function __construct(string $titre, string $photo, string $duree, User $user, $nb_episode)
    {
        parent::__construct($titre, $photo, $duree, $user);
        $this->nb_episode = $nb_episode;
    }

    public function getNb_episode()
    {
        return $this->nb_episode;
    }

    public function addToBdd()
    {
        require __DIR__ . '/../../data/bdd_link.php';
        $stm = $pdo->prepare("INSERT INTO Animes (titre, photo, duree, nb_episode) VALUES (:titre, :photo, :duree, :nb_episode)");
        $stm->execute([
            'titre' => $this->getTitre(),
            'photo' => $this->getPhoto(),
            'duree' => $this->getDuree(),
            'nb_episode' => $this->getnb_episode()
        ]);

        $stm = $pdo->prepare("SELECT id FROM Users WHERE pseudo = :pseudo");
        $stm->execute([
            'pseudo' => $this->getUser()->getPseudo()
        ]);
        $user_id = $stm->fetch();

        $stm = $pdo->prepare("SELECT id FROM Animes WHERE titre = :titre");
        $stm->execute([
            'titre' => $this->getTitre()
        ]);
        $anime_id = $stm->fetch();


        $statement = $pdo->prepare("INSERT INTO L_Users_Animes (user_id, anime_id) VALUES (:user_id, :anime_id)");
        $statement->execute([
            'user_id' => $user_id['id'],
            'anime_id' => $anime_id['id']
        ]);

        redirect('dashboard.php?success=1');
    }
}
