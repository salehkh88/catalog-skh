<?php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';  
$DB_NAME = 'my_list';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
$mysqli->set_charset('utf8mb4');

if ($mysqli->connect_error) {
    die('DB error: ' . $mysqli->connect_error);
}
?>