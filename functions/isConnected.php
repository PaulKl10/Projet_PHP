<?php
require_once __DIR__ . '/redirect.php';
require_once __DIR__ . '/../classes/UserError.php';

function isConnnected()
{
    session_start();
    if (!isset($_SESSION['connected'])) {
        redirect("index.php?error=" . UserError::NO_CONNECTED);
    }
}
