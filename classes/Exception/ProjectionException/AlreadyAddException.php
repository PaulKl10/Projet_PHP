<?php

require_once __DIR__ . '/../ProjectionError.php';
require_once __DIR__ . '/ProjectionException.php';

final class AlreadyAddException extends ProjectionException
{
    public function __construct()
    {
        $this->code = ProjectionError::ALREADY_ADD;
    }
}
