<?php

class Projection
{
    private string $titre;
    private string $photo;
    private string $duree;
    private int $note;
    private User $user;

    public function __construct($titre, $photo, $duree, $note, $user)
    {
        $this->titre = $titre;
        $this->photo = $photo;
        $this->duree = $duree;
        $this->note = $note;
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

    public function getNote()
    {
        return $this->note;
    }

    public function getUser()
    {
        return $this->user;
    }
}
