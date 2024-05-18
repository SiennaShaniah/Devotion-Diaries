<?php
// Include database connection file
require_once 'Database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if update button is clicked
    if (isset($_POST['update-button'])) {
        // Update operation
        $editSongId = $_POST['editSongId'];
        $editSongTitle = $_POST['editSongTitle'];
        $editSongArtist = $_POST['editSongArtist'];
        $editDateUploaded = $_POST['editDateUploaded'];
        $editSongPicture = $_POST['editSongPicture'];
        $editSongFile = $_POST['editSongFile'];

        // Validate inputs
        if (empty($editSongId) || empty($editSongTitle) || empty($editSongArtist) || empty($editDateUploaded) || empty($editSongPicture) || empty($editSongFile)) {
            echo "All fields are required.";
        } else {
            // Prepare the SQL statement for update
            $stmt = $mysqli->prepare("UPDATE songs SET song_title = ?, song_artist = ?, songdate_uploaded = ?, song_picture = ?, song_file = ? WHERE songs_id = ?");
            if ($stmt) {
                $stmt->bind_param("sssssi", $editSongTitle, $editSongArtist, $editDateUploaded, $editSongPicture, $editSongFile, $editSongId);
                
                // Execute the update statement
                if ($stmt->execute()) {
                    echo "Song updated successfully.";
                } else {
                    echo "Error updating record: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error preparing update statement: " . $mysqli->error;
            }
        }
    } else {
        // Insert operation
        $songTitle = $_POST['songTitle'];
        $songArtist = $_POST['songArtist'];
        $dateUploaded = $_POST['dateUploaded'];
        $songPicture = $_POST['songPicture'];
        $songFile = $_POST['songFile'];

        // Validate inputs for insertion
        if (empty($songTitle) || empty($songArtist) || empty($dateUploaded) || empty($songPicture) || empty($songFile)) {
            echo "All fields are required.";
        } else {
            // Prepare the SQL statement for insertion
            $stmt = $mysqli->prepare("INSERT INTO songs (song_title, song_artist, songdate_uploaded, song_picture, song_file) VALUES (?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sssss", $songTitle, $songArtist, $dateUploaded, $songPicture, $songFile);
                
                // Execute the insertion statement
                if ($stmt->execute()) {
                    echo "Song inserted successfully.";
                } else {
                    echo "Error inserting record: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error preparing insert statement: " . $mysqli->error;
            }
        }
    }

    // Close the database connection
    $mysqli->close();
}
?>
