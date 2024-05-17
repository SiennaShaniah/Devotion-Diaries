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

    if (isset($_POST['save'])) {
        $stmt = $mysqli->prepare("INSERT INTO entries (notebook_id, userId, notebook_title, entry_title, entrydate_uploaded, entry_body) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $notebookId, $userId, $notebookTitle, $entryTitle, $dateUploaded, $entryBody);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update']) && isset($_POST['entryId'])) {
        $entryId = $_POST['entryId'];
        $stmt = $mysqli->prepare("UPDATE entries SET entry_title = ?, entrydate_uploaded = ?, entry_body = ? WHERE entries_id = ? AND userId = ? AND notebook_id = ?");
        $stmt->bind_param("sssiii", $entryTitle, $dateUploaded, $entryBody, $entryId, $userId, $notebookId);
        $stmt->execute();
        $stmt->close();
    }

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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet">
</head>

<body>
    <section class="header">
        <div class="logo">
            <h2><span>Devotion</span>Diaries</h2>
        </div>
        <div class="back">
            <a href="user.php" id="backToNotebooks" class="back-button">
                <i class="fas fa-arrow-left"></i>Back To Notebooks
            </a>
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
                        <input type="hidden" id="entryId" name="entryId">
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
                        <div class="form-group1">
                            <label for="entryBody">Body:</label>
                            <textarea id="entryBody" name="entryBody" rows="6" required></textarea>
                            <div class="button-group">
                                <button type="submit" name="save" class="save-button">Save</button>
                                <button type="submit" name="update" class="update-button">Update</button>
                                <button type="button" name="reset" class="reset-button" onclick="resetForm()">Reset</button>
                            </div>
                        </div>
                    </form>

                    <script>
                        function resetForm() {
                            document.getElementById('entryId').value = '';
                            document.getElementById('entryTitle').value = '';
                            document.getElementById('dateUploaded').value = '';
                            document.getElementById('entryBody').value = '';
                        }
                    </script>

                    <div class="new-container">
                        <div class="section--title2">
                            <h3 class="title">Your Entries</h3>
                        </div>

                        <?php
                        include 'Database_connect.php';
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
                        $userId = $_SESSION['userId'];
                        $notebookId = $_SESSION['notebookId'];
                        $notebookTitle = $_SESSION['notebookTitle'];
                        $query = "SELECT entries_id, entry_title, entrydate_uploaded, entry_body FROM entries WHERE userId = ? AND notebook_id = ? AND notebook_title = ?";
                        $stmt = $mysqli->prepare($query);
                        $stmt->bind_param("iis", $userId, $notebookId, $notebookTitle);
                        $stmt->execute();
                        $stmt->bind_result($entryId, $entryTitle, $entryDate, $entryBody);

                        while ($stmt->fetch()) {
                            echo '<div class="card" id="entryCard' . $entryId . '">';
                            echo '<h4 class="entry-title">' . htmlspecialchars($entryTitle) . '</h4>';
                            echo '<h4 class="entry-date">' . htmlspecialchars($entryDate) . '</h4>';
                            echo '<p class="entry-body" style="display: none;">' . htmlspecialchars($entryBody) . '</p>';
                            echo '<div class="btn-group">';
                            echo '<button type="button" class="view-btn" onclick="viewEntry(' . $entryId . ')">View</button>';
                            echo '<form method="post" action="delete_entry.php">';
                            echo '<input type="hidden" name="delete_entry_id" value="' . $entryId . '">';
                            echo '<button type="submit" class="delete-button">Delete</button>';
                            echo '</form>';
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
    </section>

    <script>
        function viewEntry(entryId) {
            var card = document.getElementById('entryCard' + entryId);
            var entryTitle = card.querySelector('.entry-title').innerText;
            var entryDate = card.querySelector('.entry-date').innerText;
            var entryBody = card.querySelector('.entry-body').innerText;

            document.getElementById('entryId').value = entryId;
            document.getElementById('entryTitle').value = entryTitle;
            document.getElementById('dateUploaded').value = entryDate;
            document.getElementById('entryBody').value = entryBody;
        }
    </script>

</body>

</html>