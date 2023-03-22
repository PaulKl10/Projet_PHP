<?php

class Projection
{
    private string $titre;
    private string $photo;
    private string $duree;

    public function __construct($titre, $photo, $duree)
    {
        $this->titre = $titre;
        $this->photo = $photo;
        $this->duree = $duree;
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
}
