<?php
include 'Database_connect.php';

// Check if ID is provided
if(isset($_GET['id'])) {
    $testimonyId = $_GET['id'];

    // Fetch testimony info from the database
    $sql = "SELECT userId, username, email, testimony, rating FROM testimonies WHERE testimony_id = $testimonyId";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Return testimony info in JSON format
        echo json_encode($row);
    } else {
        echo "Testimony not found";
    }
} else {
    echo "Testimony ID not provided";
}
$mysqli->close();
?>
