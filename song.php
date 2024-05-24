<?php
// Include database connection file
require_once 'Database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editSongId'])) {
        $editSongId = $_POST['editSongId'];
        $editSongTitle = $_POST['editSongTitle'];
        $editSongArtist = $_POST['editSongArtist'];
        $editDateUploaded = $_POST['editDateUploaded'];
        $editSongPicture = ''; 
        $editSongFile = '';
        if (!empty($_FILES['editSongPicture']['name'])) {
            $editSongPicture = 'uploads/' . basename($_FILES['editSongPicture']['name']);
            move_uploaded_file($_FILES['editSongPicture']['tmp_name'], $editSongPicture);
        }
        if (!empty($_FILES['editSongFile']['name'])) {
            $editSongFile = 'uploads/' . basename($_FILES['editSongFile']['name']);
            move_uploaded_file($_FILES['editSongFile']['tmp_name'], $editSongFile);
        } else {
            $stmt = $mysqli->prepare("SELECT song_file FROM songs WHERE songs_id = ?");
            $stmt->bind_param("i", $editSongId);
            $stmt->execute();
            $stmt->bind_result($existingSongFile);
            $stmt->fetch();
            $editSongFile = $existingSongFile; 
            $stmt->close();
        }
        if (empty($editSongId) || empty($editSongTitle) || empty($editSongArtist) || empty($editDateUploaded)) {
            echo "All fields are required.";
        } else {
            $stmt = $mysqli->prepare("UPDATE songs SET song_title = ?, song_artist = ?, songdate_uploaded = ?, song_picture = ?, song_file = ? WHERE songs_id = ?");
            if ($stmt) {
                $stmt->bind_param("sssssi", $editSongTitle, $editSongArtist, $editDateUploaded, $editSongPicture, $editSongFile, $editSongId);
                if ($stmt->execute()) {
                    echo "Song updated successfully.";
                } else {
                    echo "Error updating record: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing update statement: " . $mysqli->error;
            }
        }
    } else {
        $songTitle = $_POST['songTitle'];
        $songArtist = $_POST['songArtist'];
        $dateUploaded = $_POST['dateUploaded'];
        $songPicture = 'uploads/' . basename($_FILES["songPicture"]["name"]);
        $songFile = 'uploads/' . basename($_FILES["songFile"]["name"]);
        if (empty($songTitle) || empty($songArtist) || empty($dateUploaded) || empty($songPicture) || empty($songFile)) {
            echo "All fields are required.";
        } else {
            if (move_uploaded_file($_FILES["songPicture"]["tmp_name"], $songPicture) && move_uploaded_file($_FILES["songFile"]["tmp_name"], $songFile)) {
                $stmt = $mysqli->prepare("INSERT INTO songs (song_title, song_artist, songdate_uploaded, song_picture, song_file) VALUES (?, ?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("sssss", $songTitle, $songArtist, $dateUploaded, $songPicture, $songFile);
                    if ($stmt->execute()) {
                        echo "Song inserted successfully.";
                    } else {
                        echo "Error inserting record: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Error preparing insert statement: " . $mysqli->error;
                }
            } else {
                echo "Failed to move uploaded files.";
            }
        }
    }
    $mysqli->close();
}
?>
