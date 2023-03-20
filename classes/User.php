<?php
require_once __DIR__.'/../functions/redirect.php';



class User{
    private string $pseudo;
    private string $mdp;
    

    public function __construct($pseudo, $mdp)
    {
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
    }

    public function getPseudo(): string{
        return $this->pseudo;
    }

    public function getMdp(): string{
        return $this->mdp;
    }

    public function add(){
        require_once __DIR__.'/../data/bdd_link.php';

        $statement = $pdo->query("SELECT pseudo FROM Users");

        while($row = $statement->fetch()){
            if($row['pseudo']===$this->getPseudo()){
                redirect("index.php?error=4");
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

    public function login(){
        require_once __DIR__.'/../data/bdd_link.php';
        
        $statement = $pdo->query("SELECT mdp FROM Users");

        while($row = $statement->fetch()){
            
            $result = password_verify($this->getMdp(), $row['mdp']);
            if($result === true){
                $array_bdd= $pdo->prepare("SELECT * FROM Users WHERE pseudo = :pseudo AND mdp = :pass");
            $array_bdd->execute([
                'pseudo' => $this->pseudo,
                'pass' => $row['mdp']
            ]);
            $array = $array_bdd->fetch();


            if($array===false){
                redirect("index.php?error=2");
            }

            session_start();
            $_SESSION['connected'] = true;
            $_SESSION['pseudo'] = $this->getPseudo();
            redirect("dashboard.php");
            }
        }
        redirect("index.php?error=2");
    }
}