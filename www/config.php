<?php
class Config{
    const DB_HOST = 'localhost';
    const DB_PORT = '3306';
    const DB_DATABASE = 'db_memorials';

    const DB_USER = 'root';
    const DB_PASS = '';

    const DEBUG_ENABLED = true;
}

/**
 *  DO NOT MODIFY
 */
if(Config::DEBUG_ENABLED){
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

set_include_path('inc/');

?>