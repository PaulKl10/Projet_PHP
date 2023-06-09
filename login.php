<?php
require_once 'functions/redirect.php';
require_once 'classes/User_session.php';
ini_set('display_errors', 'on');


if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {
    redirect("index.php?error=1");
} else {
    try {
        ['pseudo' => $pseudo, 'mdp' => $mdp] = $_POST;
        $user = new User_session($pseudo, $mdp);
        $user->login();
    } catch (UserException $e) {
        redirect('index.php?error=' . $e->getCode());
    }
}
