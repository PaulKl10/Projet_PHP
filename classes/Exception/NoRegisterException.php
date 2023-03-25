<?php

require_once __DIR__ . '/../UserError.php';
require_once __DIR__ . '/UserException.php';

final class NoRegisterException extends UserException
{
    public function __construct()
    {
        $this->code = UserError::USER_NOREGISTER;
    }
}
