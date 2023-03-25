<?php
require_once 'classes/User_register.php';
require_once 'functions/redirect.php';
require_once 'classes/UserError.php';
require_once 'classes/Exception/UserException.php';

if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {
    redirect("index.php?error=" . UserError::TEXTFIELD_REQUIRED);
} else {
    try {
        ['pseudo' => $pseudo, 'mdp' => $mdp] = $_POST;
        $user = new User_register($pseudo, $mdp);
        $user->add();
    } catch (UserException $e) {
        redirect('index.php?error=' . $e->getCode());
    }
}

redirect('index.php?success=1');
