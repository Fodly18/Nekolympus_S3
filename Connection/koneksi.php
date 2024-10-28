<?php
$host       = "localhost";
$username   = "root";
$password   = "";
$db_name    = "db_sdkalisat";

$connection = new mysqli($host, $username,$password,$db_name);
    if(!$connection){
        echo "Database Tidak Terhubung";
    }
?>