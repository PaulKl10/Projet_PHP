<?php
require_once 'functions/redirect.php';
require_once 'classes/User_register.php';

if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {
    redirect("index.php?error=1");
} else {
    try {
        ['pseudo' => $pseudo, 'mdp' => $mdp] = $_POST;
        $user = new User_register($pseudo, $mdp);
        $user->login();
    } catch (UserException $e) {
        redirect('index.php?error=' . $e->getCode());
    }
}
