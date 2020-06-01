<?php 
    require __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    $DB_SERVER = getenv('DB_SERVER');
    $DB_NAME = getenv('DB_NAME');
    $DB_TABLE = getenv('DB_TABLE');
    $DB_USENAME = getenv('DB_USENAME');
    $DB_PASSWORD = getenv('DB_PASSWORD');
    $FRONTEND = getenv('FRONTEND');
?>