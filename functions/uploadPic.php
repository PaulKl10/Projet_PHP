<?php
require_once __DIR__ . '/../classes/Exception/ProjectionException/BadFormatImageException.php';
function uploadPic(array $file_upload, string $path): string
{

    $tmpName = $file_upload['tmp_name'];
    $name = $file_upload['name'];
    $size = $file_upload['size'];
    $error = $file_upload['error'];

    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    //Tableau des extensions que l'on accepte
    $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
    //Taille max que l'on accepte
    $maxSize = 800000;

    if (in_array($extension, $allowedExtensions) && $size <= $maxSize && $error == 0) {

        $uniqueName = uniqid('', true);
        //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
        $picture = $uniqueName . "." . $extension;
        //$file = 5f586bf96dcd38.73540086.jpg

        move_uploaded_file($tmpName, $path . $picture);
    } else {
        throw new BadFormatImageException();
    }
    return $picture;
}
