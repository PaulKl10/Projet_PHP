<?php
require_once 'classes/User_session.php';
require_once 'functions/redirect.php';
require_once 'classes/Exception/UserError.php';
require_once 'classes/Exception/UserException/UserException.php';
ini_set('display_errors', 'on');

if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {
    redirect("index.php?error=" . UserError::TEXTFIELD_REQUIRED);
} else {
    try {
        ['pseudo' => $pseudo, 'mdp' => $mdp] = $_POST;
        $user = new User_session($pseudo, $mdp);
        $user->add();
    } catch (UserException $e) {
        redirect('index.php?error=' . $e->getCode());
    }
}

redirect('index.php?success=1');
