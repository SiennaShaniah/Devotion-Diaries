<?php
include 'Database_connect.php';

session_start();

if (isset($_GET['notebook_id'])) {
    $_SESSION['notebookId'] = $_GET['notebook_id'];

    $notebookId = $_SESSION['notebookId'];
    $query = "SELECT notebook_title FROM notebooks WHERE notebook_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $notebookId);
    $stmt->execute();
    $stmt->bind_result($notebookTitle);
    $stmt->fetch();
    $stmt->close();

    $_SESSION['notebookTitle'] = $notebookTitle;
}

if (!isset($_SESSION['notebookId']) || !isset($_SESSION['notebookTitle'])) {
    header("Location: error_page.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entryTitle = $_POST['entryTitle'];
    $dateUploaded = $_POST['dateUploaded'];
    $entryBody = $_POST['entryBody'];
    $userId = $_SESSION['userId'];
    $notebookId = $_SESSION['notebookId'];
    $notebookTitle = $_SESSION['notebookTitle'];

    $stmt = $mysqli->prepare("INSERT INTO entries (notebook_id, userId, notebook_title, entry_title, entrydate_uploaded, entry_body) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $notebookId, $userId, $notebookTitle, $entryTitle, $dateUploaded, $entryBody);
    $stmt->execute();
    $stmt->close();

    $entryTitle = $dateUploaded = $entryBody = "";
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebook Section</title>
    <link rel="stylesheet" href="notebook.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <section class="header">
        <div class="logo">
            <h2><span>Devotion</span>Diaries</h2>
        </div>
        <div class="back">
            <h4>Back To Notebooks</h4>
        </div>
        <div class="noteName">
            <h3>Notebook Title</h3>
            <hr>
            <h3 class="note">
                <?php
                include 'Database_connect.php';
                if (isset($_GET['notebook_id'])) {
                    $notebook_id = intval($_GET['notebook_id']);
                    $query = "SELECT notebook_title FROM notebooks WHERE notebook_id = ?";
                    $stmt = $mysqli->prepare($query);
                    $stmt->bind_param("i", $notebook_id);
                    $stmt->execute();
                    $stmt->bind_result($notebook_title);
                    $stmt->fetch();
                    $stmt->close();

                    if ($notebook_title) {
                        echo '<h3 class="note">' . htmlspecialchars($notebook_title) . '</h3>';
                    } else {
                        echo '<h3 class="note">Notebook not found</h3>';
                    }
                } else {
                    echo '<h3 class="note">No notebook specified</h3>';
                }
                $mysqli->close();
                ?>
            </h3>

        </div>
    </section>

    <section class="main">
        <div id="entry" class="tab">
            <div class="main--container">
                <div class="section--title">
                    <h3 class="title">Make an Entry</h3>
                </div>

                <div class="section--container">
                    <form id="entryForm" action="" method="POST">
                        <div class="form-group">
                            <label for="entryTitle">Title:</label>
                            <input type="text" id="entryTitle" name="entryTitle" required>
                        </div>
                        <br>
                        <div class="form--group">
                            <label for="date">Date:</label>
                            <input type="date" id="dateUploaded" name="dateUploaded" required>
                        </div>
                        <br>
                        <hr>
                        <div class="form-group1">
                            <label for="entryBody"></label>
                            <textarea id="entryBody" name="entryBody" rows="6" required></textarea>
                            <div class="button-group">
                                <button type="submit" class="save-button">Save</button>
                            </div>
                        </div>
                    </form>


                    <div class="new-container">
                        <div class="section--title2">
                            <h3 class="title">Your Entries:</h3>
                        </div>
                        

                        <?php
                        // Include the database connection file
                        include 'Database_connect.php';

                        

                        // Set notebook ID and title from URL parameters if available
                        if (isset($_GET['notebook_id'])) {
                            $_SESSION['notebookId'] = $_GET['notebook_id'];

                            // Retrieve notebook title from the database based on notebook ID
                            $notebookId = $_SESSION['notebookId'];
                            $query = "SELECT notebook_title FROM notebooks WHERE notebook_id = ?";
                            $stmt = $mysqli->prepare($query);
                            $stmt->bind_param("i", $notebookId);
                            $stmt->execute();
                            $stmt->bind_result($notebookTitle);
                            $stmt->fetch();
                            $stmt->close();

                            // Set notebook title in session
                            $_SESSION['notebookTitle'] = $notebookTitle;
                        }

                        // Check if notebookId and notebookTitle session variables are set
                        if (!isset($_SESSION['notebookId']) || !isset($_SESSION['notebookTitle'])) {
                            // Redirect the user to an error page or handle it in some other way
                            header("Location: error_page.php");
                            exit(); // Terminate script execution
                        }

                        // Retrieve user ID from session
                        $userId = $_SESSION['userId'];

                        // Retrieve notebook ID and title from session
                        $notebookId = $_SESSION['notebookId'];
                        $notebookTitle = $_SESSION['notebookTitle'];

                        // Retrieve entries from the database based on user ID, notebook ID, and notebook title
                        $query = "SELECT entry_title FROM entries WHERE userId = ? AND notebook_id = ? AND notebook_title = ?";
                        $stmt = $mysqli->prepare($query);
                        $stmt->bind_param("iis", $userId, $notebookId, $notebookTitle);
                        $stmt->execute();
                        $stmt->bind_result($entryTitle);

                        // Fetch and display entries in cards
                        while ($stmt->fetch()) {
                            echo '<div class="card">';
                            echo '<h5>Notebook Title :   </h5>';
                            echo '<br>';
                            echo '<h4 class="entry-title">  ' . htmlspecialchars($entryTitle) . '</h4>';
                            echo '<div class="btn-group">';
                            echo '<button class="view-btn">View</button>';
                            echo '<button type="button" class="update-button">Update</button>';
                            echo '<button type="button" class="delete-button">Delete</button>';
                            echo '</div>';
                            echo '</div>';
                        }

                        $stmt->close();
                        $mysqli->close();
                        ?>


                    </div>
                </div>
            </div>
        </div>


        </div>
    </section>


</body>

</html>