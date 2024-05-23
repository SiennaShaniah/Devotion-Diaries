<?php
session_start();

include 'database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $notebook_id = $_POST['notebookId'];
    $user_id = $_SESSION['userId']; // Assuming you have stored userId in session
    $notebook_cover = $_POST['coverInput'];

    // Prepare SQL statement
    $stmt = $mysqli->prepare("INSERT INTO notebook_cover (notebook_id, userId, Notebook_cover) VALUES (?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("iis", $notebook_id, $user_id, $notebook_cover);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Notebook cover inserted successfully.";
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$mysqli->close();
?>
