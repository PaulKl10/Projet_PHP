<?php

require_once __DIR__ . '/../ProjectionError.php';
require_once __DIR__ . '/ProjectionException.php';

final class BadFormatImageException extends ProjectionException
{
    public function __construct()
    {
        $this->code = ProjectionError::BAD_FORMAT_IMAGE;
    }
}
