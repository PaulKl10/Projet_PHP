<?php
require_once 'functions/redirect.php';
require_once 'functions/isConnected.php';
isConnnected();
session_start();
$_SESSION = [];
session_destroy();
redirect("index.php?success=2");
