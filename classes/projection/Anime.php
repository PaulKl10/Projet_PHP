<?php
require_once __DIR__ . '/../Projection.php';
class Anime extends Projection
{
    private string $nb_episode;

    public function __construct(string $nb_episode, string $titre, string $photo, string $duree)
    {
        parent::__construct($titre, $photo, $duree);
        $this->nb_episode = $nb_episode;
    }

    public function getNb_episode()
    {
        return $this->nb_episode;
    }
}
