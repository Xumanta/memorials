<?php
class _EXAMPLE_Config{
    const SITE_HOST = 'http://localhost/';
    const SITE_PATH = 'memorials/';

    const DB_HOST = 'localhost';
    const DB_PORT = '3306';
    const DB_DATABASE = 'DATABASE';

    const DB_USER = 'USER';
    const DB_PASS = 'PASSWORD';

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