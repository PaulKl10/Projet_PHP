<?php
require_once __DIR__ . '/../Projection.php';
require_once __DIR__ . '/../User.php';
require_once __DIR__ . '/../../functions/redirect.php';



class Movie extends Projection
{

    public function __construct(string $titre, string $photo, string $duree, User $user)
    {
        parent::__construct($titre, $photo, $duree, $user);
    }

    public function addToBdd()
    {
        require __DIR__ . '/../../data/bdd_link.php';
        $stm = $pdo->prepare("INSERT INTO Films (titre, photo, duree) VALUES (:titre, :photo, :duree)");
        $stm->execute([
            'titre' => $this->getTitre(),
            'photo' => $this->getPhoto(),
            'duree' => $this->getDuree()
        ]);

        $stm = $pdo->prepare("SELECT id FROM Users WHERE pseudo = :pseudo");
        $stm->execute([
            'pseudo' => $this->getUser()->getPseudo()
        ]);
        $user_id = $stm->fetch();

        $stm = $pdo->prepare("SELECT id FROM Films WHERE titre = :titre");
        $stm->execute([
            'titre' => $this->getTitre()
        ]);
        $film_id = $stm->fetch();


        $statement = $pdo->prepare("INSERT INTO L_Users_films (user_id, film_id) VALUES (:user_id, :film_id)");
        $statement->execute([
            'user_id' => $user_id['id'],
            'film_id' => $film_id['id']
        ]);

        redirect('dashboard.php?success=1');
    }
}
