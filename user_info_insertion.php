<?php
// Start or resume the session
session_start();

// Include the database connection file
include 'Database_connect.php';

// Retrieve form data
$gender = $_POST['genderSelect']; // Corrected name
$age = $_POST['ageInput']; // Corrected name
$address = $_POST['addressInput']; // Corrected name
$religion = $_POST['religionInput']; // Corrected name
$life_motto = $_POST['life_motto']; // Corrected name
$self_description = $_POST['self_description']; // Corrected name

// Get userId from session
$userId = $_SESSION['userId']; // Assuming you stored userId in the session upon login

// Prepare INSERT statement
$stmt = $mysqli->prepare("INSERT INTO user_add_information (userId, gender, age, address, religion, life_motto, self_description) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("isissis", $userId, $gender, $age, $address, $religion, $life_motto, $self_description);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to user.php
    header("Location: user.php");
    exit(); // Ensure that no further code is executed after redirection
} else {
    echo "Error: " . $stmt->error;
}

// Close statement
$stmt->close();

// Close connection
$mysqli->close();
?>



      