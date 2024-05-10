<?php
include 'Database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $songTitle = htmlspecialchars($_POST['songTitle']);
    $songArtist = htmlspecialchars($_POST['songArtist']);
    $dateUploaded = $_POST['dateUploaded']; // No need for sanitization, as it's a system-generated value
    $songPicture = htmlspecialchars($_POST['songPicture']);
    $songFile = htmlspecialchars($_POST['songFile']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO songs (song_title, song_artist, songdate_uploaded, song_picture, song_file)
            VALUES ('$songTitle', '$songArtist', '$dateUploaded', '$songPicture', '$songFile')";

    // Execute the SQL query
    if ($mysqli->query($sql) === TRUE) {
        // Redirect to a success page or do further processing
        header("Location: admin.php");
        exit();
    } else {
        // Handle errors
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>
