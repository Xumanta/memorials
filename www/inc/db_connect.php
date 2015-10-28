<?php
include "../config.php";
$db = new mysqli_connect(Config.DB_HOST, Config.DB_USER, Config.DB_PASS, Config.DB_DATABASE, Config.DB_PORT) or die;
?>