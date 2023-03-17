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
        require_once __DIR__.'/../functions/config.php';
        $dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$dbCharset";
        try{
            $option =[
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $pdo = new PDO($dsn, $dbUser, $dbPassword,$option);
        } catch(PDOException $e) {
            die('Une erreur est survenue: '. $e->getMessage());
        }
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
}