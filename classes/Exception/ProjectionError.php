<?php
class ProjectionError
{
    public const BAD_FORMAT_IMAGE = 1;
    public const ALREADY_ADD = 2;

    public static function getErrorMessage(int $code): string
    {
        switch ($code) {
            case self::BAD_FORMAT_IMAGE:
                return "Mauvaise extension ou taille trop grande";
                break;
            case self::ALREADY_ADD:
                return "Cette projection a déjà été ajouté à votre compte";
                break;
            default:
                return "Une erreur est survenue";
        }
    }
}
