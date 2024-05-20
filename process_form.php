<!-- INSERTION AND UPDATE OF USER INFO -->
<?php
session_start();
require 'Database_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} else {
    die("User ID not set in session. Please log in again.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $gender = $_POST['genderSelect'] ?? '';
    $age = $_POST['ageInput'] ?? '';
    $address = $_POST['addressInput'] ?? '';
    $religion = $_POST['religionInput'] ?? '';
    $life_motto = $_POST['life_motto'] ?? '';
    $self_description = $_POST['self_description'] ?? '';
    if (isset($_POST['saveBtn'])) {
        $stmt = $mysqli->prepare("INSERT INTO user_add_information (userId, gender, age, address, religion, life_motto, self_description) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $mysqli->error);
        }
        $stmt->bind_param("isissss", $userId, $gender, $age, $address, $religion, $life_motto, $self_description);

    } elseif (isset($_POST['updateBtn'])) {
        $stmt = $mysqli->prepare("UPDATE user_add_information SET gender = ?, age = ?, address = ?, religion = ?, life_motto = ?, self_description = ? WHERE userId = ?");
        if ($stmt === false) {
            die("Error preparing statement: " . $mysqli->error);
        }
        $stmt->bind_param("sissssi", $gender, $age, $address, $religion, $life_motto, $self_description, $userId);
    }

    if ($stmt->execute()) {
        echo "Record saved successfully";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
