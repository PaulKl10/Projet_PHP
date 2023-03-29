<?php
class UserError
{
    public const TEXTFIELD_REQUIRED = 1;
    public const USER_NOREGISTER = 2;
    public const NO_CONNECTED = 3;
    public const DUPLICATE_PSEUDO = 4;

    public static function getErrorMessage(int $code): string
    {
        switch ($code) {
            case self::TEXTFIELD_REQUIRED:
                return "Rien n'a été entré";
                break;
            case self::USER_NOREGISTER:
                return "L'utilisateur n'est pas enreigstré";
                break;
            case self::NO_CONNECTED:
                return "Vous n'êtes pas connecté";
                break;
            case self::DUPLICATE_PSEUDO:
                return "Le pseudo entré existe déjà";
                break;
            default:
                return "Une erreur est survenue";
        }
    }
}
