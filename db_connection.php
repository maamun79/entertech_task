<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'entertech_task';

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if( !$conn ) {
    echo 'Error to connect database';
}
?>