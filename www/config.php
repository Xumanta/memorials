<?php
class Config{
    const SITE_HOST = 'http://localhost/';
    const SITE_PATH = 'memorials/';

    const DB_HOST = 'localhost';
    const DB_PORT = '3306';
    const DB_DATABASE = 'db_memorials';

    const DB_USER = 'root';
    const DB_PASS = '';

    const DEBUG_ENABLED = false;
}

/**
 *  DO NOT MODIFY
 */
if(Config::DEBUG_ENABLED){
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

?>