<?php
session_start(); // Start the session
include('Database_connect.php');

// Function to handle profile picture insertion
function insertProfilePicture($userId, $profilePicture) {
    global $mysqli;

    // Prepare the insert statement
    $stmt = $mysqli->prepare("INSERT INTO user_add_information (userId, profile_picture) VALUES (?, ?)");
    
    // Bind parameters
    $stmt->bind_param("is", $userId, $profilePicture);

    // Execute the statement
    if ($stmt->execute()) {
        return true; // Insertion successful
    } else {
        // Debugging: Display error message
        echo "Error: " . $stmt->error;
        return false; // Insertion failed
    }
}

// Function to handle profile picture update
function updateProfilePicture($userId, $profilePicture) {
    global $mysqli;

    // Prepare the update statement
    $stmt = $mysqli->prepare("UPDATE user_add_information SET profile_picture = ? WHERE userId = ?");
    
    // Bind parameters
    $stmt->bind_param("si", $profilePicture, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        return true; // Update successful
    } else {
        // Debugging: Display error message
        echo "Error: " . $stmt->error;
        return false; // Update failed
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['savePicBtn']) || isset($_POST['updatePicBtn'])) {
        $profilePicture = '';

        // Check if a file was uploaded
        if (isset($_FILES['imageInput']) && $_FILES['imageInput']['error'] === UPLOAD_ERR_OK) {
            $fileTmpName = $_FILES['imageInput']['tmp_name'];
            $fileName = $_FILES['imageInput']['name'];

            // Move uploaded file to permanent location
            $uploadDirectory = "uploads/"; // Change this to your desired directory
            $profilePicture = $uploadDirectory . $fileName;
            move_uploaded_file($fileTmpName, $profilePicture);
        }

        // Retrieve userId from session
        if(isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
        } else {
            echo "User ID not found in session.";
            exit();
        }

        // Check if save button is clicked
        if (isset($_POST['savePicBtn'])) {
            if (insertProfilePicture($userId, $profilePicture)) {
                // Insertion successful, redirect to user.php
                header("Location: user.php");
                exit();
            } else {
                echo "Failed to insert profile picture.";
            }
        }

        // Check if update button is clicked
        if (isset($_POST['updatePicBtn'])) {
            if (updateProfilePicture($userId, $profilePicture)) {
                // Update successful, redirect to user.php
                header("Location: user.php");
                exit();
            } else {
                echo "Failed to update profile picture.";
            }
        }
    }
}
?>
