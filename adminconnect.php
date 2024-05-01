<?php
include 'Database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $songTitle = $_POST['songTitle'];
    $songArtist = $_POST['songArtist'];
    $dateUploaded = $_POST['dateUploaded'];

    $songPicture = $_FILES['songPicture']['name'];
    $songPictureTmp = $_FILES['songPicture']['tmp_name'];
    move_uploaded_file($songPictureTmp, "uploads/" . $songPicture);

    $songFile = $_FILES['songFile']['name'];
    $songFileTmp = $_FILES['songFile']['tmp_name'];
    move_uploaded_file($songFileTmp, "uploads/" . $songFile);

    $sql = "INSERT INTO songs (song_title, song_artist, songdate_uploaded, song_picture, song_file)
            VALUES ('$songTitle', '$songArtist', '$dateUploaded', '$songPicture', '$songFile')";

if ($mysqli->query($sql) === TRUE) {
    header("Location: admin.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
}
?>
