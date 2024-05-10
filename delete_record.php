<!-- delete daily word -->
<?php
include('database_connect.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare statement
    $stmt = $mysqli->prepare("DELETE FROM daily_word WHERE daily_word_id = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
    
    // Close statement
    $stmt->close();
}

$mysqli->close();
?>


<!-- delete song -->

<?php
include 'Database_connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare statement
    $stmt = $mysqli->prepare("DELETE FROM songs WHERE songs_id = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Song deleted successfully";
    } else {
        echo "Error deleting song: " . $mysqli->error;
    }
    
    // Close statement
    $stmt->close();
}

$mysqli->close();
?>

<!-- DELETE THE TESTIMONY -->
<?php
include 'Database_connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare statement
    $stmt = $mysqli->prepare("DELETE FROM testimonies WHERE testimony_id = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Testimony deleted successfully";
    } else {
        echo "Error deleting testimony: " . $mysqli->error;
    }
    
    // Close statement
    $stmt->close();
}

$mysqli->close();
?>

