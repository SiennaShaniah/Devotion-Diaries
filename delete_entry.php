<?php
    // Include the database connection file
    include 'Database_connect.php';

    // Check if the delete button is clicked and entry_id is provided
    if(isset($_POST['delete_entry_id'])) {
        // Sanitize the entry_id to prevent SQL injection
        $entryId = filter_var($_POST['delete_entry_id'], FILTER_SANITIZE_NUMBER_INT);
        
        // Prepare a delete statement
        $query = "DELETE FROM entries WHERE entries_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $entryId);
        
        // Execute the delete statement
        if($stmt->execute()) {
            // Deletion successful
            echo "Entry deleted successfully.";
        } else {
            // Deletion failed
            echo "Error deleting entry: " . $mysqli->error;
        }

        // Close the statement
        $stmt->close();
    }
?>
