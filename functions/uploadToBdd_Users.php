<?php
function uploadToBdd_Users(string $picture, string $pseudo)
{
    require __DIR__ . '/../data/bdd_link.php';
    $stm = $pdo->prepare("UPDATE Users SET photo_u = :photo WHERE pseudo = :pseudo");
    $stm->execute([
        'photo' => $picture,
        'pseudo' => $pseudo
    ]);
}
