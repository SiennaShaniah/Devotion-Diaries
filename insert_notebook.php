<?php
// Include the database connection
include 'Database_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $userId = $mysqli->real_escape_string($_POST['userId']);
    $notebookTitle = $mysqli->real_escape_string($_POST['notebook-title']);
    
    // Attempt insert query execution
    $sql = "INSERT INTO notebooks (userId, notebook_title) VALUES ('$userId', '$notebookTitle')";
    if ($mysqli->query($sql) === true) {
        // Redirect to user.php after successful insertion
        header("Location: user.php");
        exit();
    } else {
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }
    
    // Close connection
    $mysqli->close();
}
?>
