<?php
include 'Database_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['imageInput']) && $_FILES['imageInput']['error'] === UPLOAD_ERR_OK) {
        session_start();
        $userId = $_SESSION['userId'];
        $target_dir = "profile_pictures/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); 
        }
        $target_file = $target_dir . uniqid() . basename($_FILES["imageInput"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["imageInput"]["tmp_name"]);
        if ($check !== false) {
            if ($_FILES["imageInput"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
            } else {
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } else {
                    $query = "SELECT * FROM profpic WHERE userId = $userId";
                    $result = $mysqli->query($query);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $old_picture = $row['profpic_url'];
                        unlink($old_picture);
                        $update_query = "UPDATE profpic SET profpic_url = '$target_file' WHERE userId = $userId";
                        $mysqli->query($update_query);
                    } else {
                        $insert_query = "INSERT INTO profpic (profpic_url, userId) VALUES ('$target_file', $userId)";
                        $mysqli->query($insert_query);
                    }
                    if (move_uploaded_file($_FILES["imageInput"]["tmp_name"], $target_file)) {
                        echo "The file " . basename($_FILES["imageInput"]["name"]) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "No file selected.";
    }
}
