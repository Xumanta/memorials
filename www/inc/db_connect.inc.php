<?php
require_once 'config.php';

$db_connection = mysqli_connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_DATABASE, Config::DB_PORT);

if(!$db_connection){
    if(Config::DEBUG_ENABLED){
        die('Database connection failed: ' . mysqli_connect_errno());
    }

    die('Internal server error.');
}
?>