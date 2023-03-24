<?php
require_once __DIR__ . '/redirect.php';


function deleteProjectionToUser($projection, $titre, $column)
{
    require_once 'data/bdd_link.php';
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


    $statement = $pdo->prepare("DELETE FROM L_Users_" . $projection . " WHERE user_id=:user_id && " . $column . "=:projection_id");
    $statement->execute([
        'user_id' => $user_id['id'],
        'projection_id' => $projection_id['id']
    ]);

    redirect('dashboard.php?success=2');
}
