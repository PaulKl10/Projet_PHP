<?php
class User
{
    private string $pseudo;

    public function __construct($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }
}
