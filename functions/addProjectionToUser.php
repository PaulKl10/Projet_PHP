<?php
require_once __DIR__ . '/redirect.php';


function addProjectionToUser($projection, $titre, $column, $note)
{
    require 'data/bdd_link.php';
    $stm = $pdo->prepare("SELECT id FROM Users WHERE pseudo = :pseudo");
    $stm->execute([
        'pseudo' => $_SESSION['pseudo']
    ]);
    $user_id = $stm->fetch();

    $stm = $pdo->prepare("SELECT id FROM " . $projection . " WHERE titre = :titre");
    $stm->execute([
        'titre' => $titre
    ]);
    $projection_id = $stm->fetch();


    $statement = $pdo->prepare("INSERT INTO L_Users_" . $projection . " (user_id," . $column . ",note) VALUES (:user_id, :projection_id, :note)");
    $statement->execute([
        'user_id' => $user_id['id'],
        'projection_id' => $projection_id['id'],
        'note' => $note
    ]);

    redirect('dashboard.php?success=1');
}
