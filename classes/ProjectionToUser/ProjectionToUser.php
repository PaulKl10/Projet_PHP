<?php
class ProjectionToUser
{
    private string $projection;
    private string $titre;
    private string $column;
    private string $user_pseudo;

    public function __construct(string $projection, string $titre, string $column, string $user_pseudo)
    {
        $this->projection = $projection;
        $this->titre = $titre;
        $this->column = $column;
        $this->user_pseudo = $user_pseudo;
    }

    public function getProjection()
    {
        return $this->projection;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getUser_pseudo()
    {
        return $this->user_pseudo;
    }
}
