<?php
require_once 'classes/User.php';
require_once 'functions/redirect.php';

if(empty($_POST['pseudo']) || empty($_POST['mdp'])){
    redirect("index.php?error=1");
}else{
    ['pseudo' => $pseudo,'mdp' => $mdp] = $_POST;
    $user = new User($pseudo,$mdp);
    $user->add();
}

redirect('index.php?success=1');