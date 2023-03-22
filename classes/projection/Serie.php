<?php
require_once __DIR__ . '/../Projection.php';
class Serie extends Projection
{
    private string $nb_saison;

    public function __construct(string $nb_saison, string $titre, string $photo, string $duree)
    {
        parent::__construct($titre, $photo, $duree);
        $this->nb_saison = $nb_saison;
    }

    public function getNb_saison()
    {
        return $this->nb_saison;
    }
}
