<?php
require_once 'functions/redirect.php';
session_start();
$_SESSION=[];
session_destroy();
redirect("index.php?success=2");
