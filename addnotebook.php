<?php
include 'Database_connect.php'; // Include the file for database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveBtn'])) {
    $notebook_title = $_POST['notebook-title'];
    $notebook_cover = $_POST['selected-cover']; // Change this line to fetch the value from hidden input
    $userId = $_POST['userId'];

    // Prepare and bind SQL statement
    $stmt = $mysqli->prepare("INSERT INTO notebooks (notebook_title, notebook_cover, userId) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $notebook_title, $notebook_cover, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to user.php if the notebook is successfully added
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$mysqli->close();
?>
