<?php
session_start();
require 'Database_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_notebook'])) {
    $notebook_id = intval($_POST['notebook_id']);
    $userId = $_SESSION['userId'];
    $stmt = $mysqli->prepare("SELECT notebook_id FROM notebooks WHERE notebook_id = ? AND userId = ?");
    $stmt->bind_param("ii", $notebook_id, $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $delete_entries = $mysqli->prepare("DELETE FROM entries WHERE notebook_id = ?");
        $delete_entries->bind_param("i", $notebook_id);
        $delete_entries->execute();
        $delete_cover = $mysqli->prepare("DELETE FROM notebook_cover WHERE notebook_id = ?");
        $delete_cover->bind_param("i", $notebook_id);
        $delete_cover->execute();
        $delete_notebook = $mysqli->prepare("DELETE FROM notebooks WHERE notebook_id = ?");
        $delete_notebook->bind_param("i", $notebook_id);
        $delete_notebook->execute();
        header("Location: user.php");
        exit();
    } else {
        echo "You do not have permission to delete this notebook.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$mysqli->close();
?>
