<!-- UPDATE USERNAME -->
<?php
session_start();
include('Database_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['usernameInput']) && !empty($_POST['usernameInput'])) {
        $newUsername = $mysqli->real_escape_string($_POST['usernameInput']);
        $userId = $_SESSION['userId'];
        $updateQuery = "UPDATE users SET username = '$newUsername' WHERE userId = '$userId'";
        if ($mysqli->query($updateQuery)) {
            $_SESSION['username'] = $newUsername;
            echo "Username updated successfully!";
        } else {
            echo "Error updating username: " . $mysqli->error;
        }
    } else {
        echo "Please provide a new username!";
    }
}
?>