<?php
session_start();
include 'Database_connect.php';
$gender = $_POST['genderSelect']; 
$age = $_POST['ageInput']; 
$address = $_POST['addressInput']; 
$religion = $_POST['religionInput']; 
$life_motto = $_POST['life_motto']; 
$self_description = $_POST['self_description']; 
$userId = $_SESSION['userId']; 
$stmt = $mysqli->prepare("INSERT INTO user_add_information (userId, gender, age, address, religion, life_motto, self_description) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isissis", $userId, $gender, $age, $address, $religion, $life_motto, $self_description);
if ($stmt->execute()) {
    header("Location: user.php");
    exit(); 
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$mysqli->close();
?>



      