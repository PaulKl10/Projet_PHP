<?php
require_once __DIR__ . '/redirect.php';
require_once __DIR__ . '/../classes/Exception/NoConnectedException.php';

function isConnnected()
{
    session_start();
    if (!isset($_SESSION['connected'])) {
        throw new NoConnectedException();
    }
}
