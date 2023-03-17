<?php
$dbConfig = parse_ini_file(__DIR__.'/../config/db.ini');
[
    'DB_HOST' => $host,
    'DB_PORT' => $port,
    'DB_NAME' => $dbName,
    'DB_CHARSET' => $dbCharset,
    'DB_USER' => $dbUser,
    'DB_PASSWORD' => $dbPassword
] = $dbConfig;