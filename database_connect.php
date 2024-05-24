<?php
$host = 'localhost';
$db_user = 'root'; 
$db_password = ''; 
$db_name = 'devdiaries'; 
$mysqli = new mysqli($host, $db_user, $db_password, $db_name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>


