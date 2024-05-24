<?php
session_start();

include 'database_connect.php';

// Check if user is logged in
if (!isset($_SESSION['userId'])) {
    echo "Please log in to view your notebooks.";
    exit;
}

// Get the userId from the session
$userId = $_SESSION['userId'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_notebook'])) {
    // Get notebook ID to be deleted
    $notebook_id = $_POST['notebook_id'];

    // Start a transaction
    $mysqli->begin_transaction();

    try {
        // Check if notebook exists
        $check_notebook_query = "SELECT 1 FROM notebooks WHERE notebook_id = ?";
        $check_notebook_stmt = $mysqli->prepare($check_notebook_query);
        $check_notebook_stmt->bind_param("i", $notebook_id);
        $check_notebook_stmt->execute();
        $check_notebook_result = $check_notebook_stmt->get_result();

        if ($check_notebook_result->num_rows == 0) {
            throw new Exception("Error: Notebook with ID $notebook_id does not exist.");
        }

        // Move the notebook data to the trashbin
        $move_to_trash_query = "INSERT INTO notebook_trashbin (notebook_id, Notebook_cover_id, Notebook_cover, entries_id, entry_title, entrydate_uploaded, entry_body, notebook_title, userId)
            SELECT n.notebook_id, c.notebook_cover_id, c.Notebook_cover, e.entries_id, e.entry_title, e.entrydate_uploaded, e.entry_body, n.notebook_title, n.userId
            FROM notebooks n
            LEFT JOIN notebook_cover c ON n.notebook_id = c.notebook_id
            LEFT JOIN entries e ON n.notebook_id = e.notebook_id
            WHERE n.notebook_id = ?";

        $move_to_trash_stmt = $mysqli->prepare($move_to_trash_query);
        $move_to_trash_stmt->bind_param("i", $notebook_id);
        $move_to_trash_stmt->execute();

        // Now, delete the entries (if any)
        $delete_entries_query = "DELETE FROM entries WHERE notebook_id = ?";
        $delete_entries_stmt = $mysqli->prepare($delete_entries_query);
        $delete_entries_stmt->bind_param("i", $notebook_id);
        $delete_entries_stmt->execute();

        // Delete the cover (if any)
        $delete_cover_query = "DELETE FROM notebook_cover WHERE notebook_id = ?";
        $delete_cover_stmt = $mysqli->prepare($delete_cover_query);
        $delete_cover_stmt->bind_param("i", $notebook_id);
        $delete_cover_stmt->execute();

        // Delete the notebook
        $delete_notebook_query = "DELETE FROM notebooks WHERE notebook_id = ?";
        $delete_notebook_stmt = $mysqli->prepare($delete_notebook_query);
        $delete_notebook_stmt->bind_param("i", $notebook_id);
        $delete_notebook_stmt->execute();

        // Commit the transaction
        $mysqli->commit();

        echo "Notebook deleted successfully.";
    } catch (Exception $e) {
        // Rollback transaction
        $mysqli->rollback();
        // Print error message
        echo "Error deleting notebook: " . $e->getMessage();
        // Exit script
        exit;
    } finally {
        // Close statements
        if (isset($check_notebook_stmt)) $check_notebook_stmt->close();
        if (isset($move_to_trash_stmt)) $move_to_trash_stmt->close();
        if (isset($delete_entries_stmt)) $delete_entries_stmt->close();
        if (isset($delete_cover_stmt)) $delete_cover_stmt->close();
        if (isset($delete_notebook_stmt)) $delete_notebook_stmt->close();
    }
}

// Close connection
$mysqli->close();
?>
