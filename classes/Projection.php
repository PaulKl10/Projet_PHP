<?php

class Projection
{
    private string $titre;
    private string $photo;
    private string $duree;
    private User $user;

    public function __construct($titre, $photo, $duree, $user)
    {
        $this->titre = $titre;
        $this->photo = $photo;
        $this->duree = $duree;
        $this->user = $user;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getDuree()
    {
        return $this->duree;
    }

    public function getUser()
    {
        return $this->user;
    }
}
