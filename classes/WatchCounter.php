<?php
class WatchCounter
{
    private int $user_id;
    private int $projection;
    public const ALL = 0;
    public const MOVIE = 1;
    public const SERIE = 2;
    public const ANIME = 3;

    public function __construct($projection, $user_id)
    {
        $this->projection = $projection;
        $this->user_id = $user_id;
    }
}
