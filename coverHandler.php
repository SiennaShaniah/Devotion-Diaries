<?php
session_start();

include 'database_connect.php';

// Initialize $disable_save_button variable
$disable_save_button = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $notebook_id = $_POST['notebookId'];
    $user_id = $_SESSION['userId']; // Assuming you have stored userId in session
    $notebook_cover = $_POST['coverInput'];

    // Check if there is an existing cover for this notebook and user
    $existing_cover_query = "SELECT notebook_cover_id FROM notebook_cover WHERE notebook_id = ? AND userId = ?";
    $existing_cover_stmt = $mysqli->prepare($existing_cover_query);
    $existing_cover_stmt->bind_param("ii", $notebook_id, $user_id);
    $existing_cover_stmt->execute();
    $existing_cover_result = $existing_cover_stmt->get_result();

    if ($existing_cover_result->num_rows > 0) {
        // Update existing cover
        $update_stmt = $mysqli->prepare("UPDATE notebook_cover SET Notebook_cover = ? WHERE notebook_id = ? AND userId = ?");
        $update_stmt->bind_param("sii", $notebook_cover, $notebook_id, $user_id);

        if ($update_stmt->execute()) {
            echo "Notebook cover updated successfully.";
        } else {
            echo "Error updating notebook cover: " . $mysqli->error;
        }

        $update_stmt->close();
    } else {
        // Insert new cover
        $insert_stmt = $mysqli->prepare("INSERT INTO notebook_cover (notebook_id, userId, Notebook_cover) VALUES (?, ?, ?)");
        $insert_stmt->bind_param("iis", $notebook_id, $user_id, $notebook_cover);

        if ($insert_stmt->execute()) {
            echo "Notebook cover inserted successfully.";
            // Update $disable_save_button to true since cover has been inserted
            $disable_save_button = true;
        } else {
            echo "Error inserting notebook cover: " . $mysqli->error;
        }

        $insert_stmt->close();
    }

    $existing_cover_stmt->close();
}

// Close connection
$mysqli->close();
?>
