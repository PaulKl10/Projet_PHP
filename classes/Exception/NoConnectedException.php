<?php
require_once __DIR__ . '/../UserError.php';
require_once __DIR__ . '/UserException.php';

final class NoConnectedException extends UserException
{
    public function __construct()
    {
        $this->code = UserError::NO_CONNECTED;
    }
}
