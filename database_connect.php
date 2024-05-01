<?php
$host = 'localhost';
$db_user = 'root'; 
$db_password = ''; 
$db_name = 'devdiaries'; 

// Create connection
$mysqli = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>


