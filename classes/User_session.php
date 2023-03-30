<?php
require_once __DIR__ . '/../functions/redirect.php';
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Exception/UserException/DuplicatePseudoException.php';
require_once __DIR__ . '/Exception/UserException/NoRegisterException.php';

class User_session extends User
{

    private string $mdp;

    public function __construct($pseudo, $mdp)
    {
        parent::__construct($pseudo);
        $this->mdp = $mdp;
    }

    public function getMdp(): string
    {
        return $this->mdp;
    }

    public function add()
    {
        require_once __DIR__ . '/../data/bdd_link.php';

        $statement = $pdo->query("SELECT pseudo FROM Users");

        while ($row = $statement->fetch()) {
            if ($row['pseudo'] === $this->getPseudo()) {
                throw new DuplicatePseudoException();
            }
        }

        // Hacher le mot de passe
        $hashedPassword = password_hash($this->getMdp(), PASSWORD_DEFAULT);

        // Préparer la requête sql et la traiter
        $statement = $pdo->prepare("INSERT INTO Users (pseudo,mdp) VALUES (:pseudo, :mdp)");
        $statement->execute([
            ':pseudo' => $this->getPseudo(),
            ':mdp' => $hashedPassword
        ]);
    }

    public function login()
    {
        require_once __DIR__ . '/../data/bdd_link.php';

        $statement = $pdo->prepare("SELECT mdp,id FROM Users WHERE pseudo = :pseudo");
        $statement->execute([
            ':pseudo' => $this->getPseudo()
        ]);
        $info = $statement->fetch();

        if ($info) {
            $result = password_verify($this->getMdp(), $info['mdp']);
            if ($result === true) {
                session_start();
                $_SESSION['connected'] = true;
                $_SESSION['pseudo'] = $this->getPseudo();
                $_SESSION['id'] = $info['id'];
                redirect("dashboard.php");
            }
        }
        throw new NoRegisterException();
    }
}
