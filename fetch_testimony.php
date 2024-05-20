<?php
include 'Database_connect.php';

$testimony_id = $_GET['testimony_id'];
$sql = "SELECT testimony_id, userId, username, rating FROM testimonies WHERE testimony_id=$testimony_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([]);
}

$mysqli->close();
?>
