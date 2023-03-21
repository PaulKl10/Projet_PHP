<?php
function uploadToBdd_Users(string $picture, string $pseudo)
{
    require __DIR__ . '/../data/bdd_link.php';
    $stm = $pdo->prepare("UPDATE Users SET photo = :photo WHERE pseudo = :pseudo");
    $stm->execute([
        'photo' => $picture,
        'pseudo' => $pseudo
    ]);
}
