<!-- COUNT FOR HOW MANY USERS -->
<?php
include('database_connect.php');
$sql = "SELECT COUNT(*) AS total_users FROM users";
$result = $mysqli->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $total_users = $row['total_users'];
    $result->close();
} else {
    $total_users = 0;
}
?>



<!-- DAILY WORD IN DASHBOARD -->
<?php
require 'Database_connect.php';
$dailyWordTitle = '';
$query = "SELECT daily_word_title FROM daily_word ORDER BY daily_word_id DESC LIMIT 1";
$result = $mysqli->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dailyWordTitle = $row['daily_word_title'];
} else {
    $dailyWordTitle = 'No daily word available';
}
?>


<!-- SONG INDASHBOARD -->
<?php
include 'Database_connect.php';
$sql = "SELECT song_title FROM songs ORDER BY songs_id DESC LIMIT 1";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latestSongTitle = $row["song_title"];
} else {
    $latestSongTitle = "None";
}
?>


<!-- // Retrieve the most recent testimony -->
<?php
include 'Database_connect.php';

$select_recent_sql = "SELECT username FROM testimonies ORDER BY testimony_id DESC LIMIT 1";
$result_recent = $mysqli->query($select_recent_sql);

if ($result_recent->num_rows > 0) {
    $row_recent = $result_recent->fetch_assoc();
    $recent_username = $row_recent["username"];
} else {
    $recent_username = "None";
}

?>



<!-- UPDATE AND INSERT DAILY WORD -->
<?php
require_once 'Database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update-button'])) {
        $dailyWordId = $_POST['editDailyWordId'];
        $date = $_POST['date'];
        $title = $_POST['title'];
        $dailyWordText = $_POST['dailyWordText'];
        if (empty($dailyWordId) || empty($date) || empty($title) || empty($dailyWordText)) {
            echo "All fields are required.";
        } else {
            $stmt = $mysqli->prepare("UPDATE daily_word SET daily_word_date = ?, daily_word_title = ?, daily_word_text = ? WHERE daily_word_id = ?");
            if ($stmt) {
                $stmt->bind_param("sssi", $date, $title, $dailyWordText, $dailyWordId);
                if ($stmt->execute()) {
                    echo "Daily word updated successfully.";
                } else {
                    echo "Error updating record: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing update statement: " . $mysqli->error;
            }
        }
    } else {
        $date = isset($_POST['date']) ? $_POST['date'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $dailyWordText = isset($_POST['dailyWordText']) ? $_POST['dailyWordText'] : null;
        if (empty($date) || empty($title) || empty($dailyWordText)) {
            header("Location: admin.php?error=missing_fields");
            exit();
        } else {
            $stmt = $mysqli->prepare("INSERT INTO daily_word (daily_word_date, daily_word_title, daily_word_text) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sss", $date, $title, $dailyWordText);
                if ($stmt->execute()) {
                    echo "Daily word inserted successfully.";
                } else {
                    echo "Error inserting record: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing insert statement: " . $mysqli->error;
            }
        }
    }
}
$mysqli->close();
?>













<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>admin</title>
</head>

<body class="body">
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line menu"></i>
            <h2><span>Devotion</span>Diaries</h2>
        </div>
        <div class="profile">
            <h3 id="profadmin">Admin</h3>
            <img src="Images/signin.svg" alt="">
        </div>
    </section>

    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href="#" class="sidebar-link active" data-target="dashboard">
                        <span class="icon"><i class="ri-dashboard-line"></i></span>
                        <div class="sidebar--item">Dashboard</div>
                    </a>
                </li>


                <li>
                    <a href="#" class="sidebar-link" data-target="dailyWord">
                        <span class="icon"><i class="ri-book-line"></i></span>
                        <div class="sidebar--item">Daily Word</div>
                    </a>
                </li>


                <li>
                    <a href="#" class="sidebar-link" data-target="testimonials">
                        <span class="icon"><i class="ri-chat-4-line"></i></span>
                        <div class="sidebar--item">Testimonials</div>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-link" data-target="christianSongs">
                        <span class="icon"><i class="ri-music-line"></i></span>
                        <div class="sidebar--item">Christian Songs</div>
                    </a>
                </li>
            </ul>
            <ul class="sidebar--bottom--items">
                <li>
                    <a href="index.php">
                        <span class="icon"><i class="ri-logout-box-r-line"></i></span>
                        <div class="sidebar--item">Logout</div>
                    </a>
                </li>
            </ul>
        </div>



        <div id="dashboard" class="tab">
            <div class="main--container">
                <div class="section--title">
                    <h3 class="title">Admin Dashboard</h3>
                </div>

                <div class="cards">
                    <div class="card card-1">
                        <div class="card--title">
                            <span class="card--icon icon"><i class="ri-users-line"></i></span>
                            <span>Total number of users</span>
                        </div>

                        <h3 class="card--value"><?php echo $total_users; ?></i></h3>
                    </div>


                    <div class="card card-2">
                        <div class="card--title">
                            <span class="card--icon icon"><i class="ri-calendar-event-line"></i></span>
                            <span>Today's Word</span>
                        </div>
                        <h3 class="card--value"><?php echo htmlspecialchars($dailyWordTitle); ?></h3>
                        <button class="card--button" id="dailyWordButton">Daily Word</button>
                    </div>


                    <div class="card card-3">
                        <div class="card--title">
                            <span class="card--icon icon"><i class="ri-chat-4-line"></i></span>
                            <span>Recent Testimony</span>
                        </div>
                        <h3 class="card--value"><?php echo $recent_username; ?></i></h3>
                        <button class="card--button" id="testbutton">Testimonials</button>
                    </div>


                    <div class="card card-4">
                        <div class="card--title">
                            <span class="card--icon icon"><i class="ri-music-line"></i></span>
                            <span>Recent Christian song uploads</span>
                        </div>
                        <h3 class="card--value"><?php echo $latestSongTitle; ?></i></h3>
                        <button class="card--button" id="songsbuttonkick">Songs</button>
                    </div>
                </div>


                <div class="table">
                    <div class="section--title01">
                        <h3 class="title">Users Information</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'database_connect.php';
                            $sql = "SELECT userId, username, email FROM users";

                            // Execute the query
                            $result = $mysqli->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["userId"] . "</td>";
                                    echo "<td>" . $row["username"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No users found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div id="dailyWord" class="tab" style="display: none;">
            <div class="main--container">
                <div class="section--title03">
                    <h3 class="title">Upload Daily Word </h3>
                </div>
                <br>

                <form id="dailyWordForm" method="POST" action="">
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="dailyWordText">Daily Word Text:</label>
                        <textarea id="dailyWordText" name="dailyWordText" required></textarea>
                    </div>
                    <input type="hidden" id="dailyWordId" name="dailyWordId">
                    <div class="button-group">
                        <button type="submit" class="submit-button">Submit</button>
                        <button type="button" class="cancel-button">Cancel</button>
                    </div>
                </form>
                <br>

                <div class="table">
                    <div class="section--title01">
                        <h3 class="title">Daily Word Information</h3>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('database_connect.php');
                            $sql = "SELECT * FROM daily_word ORDER BY daily_word_id ASC";
                            $result = $mysqli->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["daily_word_id"] . "</td>";
                                    echo "<td>" . $row["daily_word_date"] . "</td>";
                                    echo "<td>" . $row["daily_word_title"] . "</td>";
                                    echo "<td data-date='" . $row["daily_word_date"] . "' data-title='" . $row["daily_word_title"] . "' data-text='" . $row["daily_word_text"] . "'>";
                                    echo "<div class='button-group'>";
                                    echo "<button type='button' class='edit-button' onclick='openEditModal(this)'>Edit</button>";
                                    echo "<button type='button' class='delete-button' onclick='deleteRecord(this)'>Delete</button>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No daily word information available</td></tr>";
                            }
                            $mysqli->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal for editing -->
        <div id="editModal" class="dailymodal">
            <div class="modal-content">
                <h2 class="modal-title">Edit Daily Word</h2>
                <div class="modal-body">

                    <form id="editForm" method="post" action="">
                        <input type="hidden" id="editDailyWordId" name="editDailyWordId">

                        <div class="form-group">
                            <label for="editDate">Date:</label>
                            <input type="date" id="editDate" name="date">
                        </div>
                        <div class="form-group">
                            <label for="editTitle">Title:</label>
                            <input type="text" id="editTitle" name="title">
                        </div>
                        <div class="form-group">
                            <label for="editDailyWordText">Daily Word Text:</label>
                            <textarea id="editDailyWordText" name="dailyWordText"></textarea>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="update-button" name="update-button">Update</button>
                            <button type="button" class="cancel-button" onclick="closeEditModal()">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script>
            function openEditModal(button) {
                var modal = document.getElementById("editModal");
                modal.style.display = "block";

                var row = button.closest("tr");
                var id = row.cells[0].innerText;
                var date = row.cells[1].innerText;
                var title = row.cells[2].innerText;
                var text = row.cells[3].getAttribute("data-text");

                document.getElementById("editDate").value = date;
                document.getElementById("editTitle").value = title;
                document.getElementById("editDailyWordText").value = text;
                document.getElementById("editDailyWordId").value = id;
            }

            function closeEditModal() {
                var modal = document.getElementById("editModal");
                modal.style.display = "none";
            }
        </script>

        <script>
            function deleteRecord(button) {
                var row = button.closest("tr");
                var id = row.querySelector("td").innerText.trim(); // Assuming ID is the first column
                var confirmation = confirm("Are you sure you want to delete this record?");
                if (confirmation) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            row.remove();
                        }
                    };
                    xhttp.open("GET", "delete_record.php?id=" + id, true);
                    xhttp.send();
                }
            }
        </script>



        <div id="testimonials" class="tab" style="display: none;">
            <div class="main--container">
                <div class="section--title03">
                    <h3 class="title">Testimonials</h3>
                </div>
                <br>


                <div class="table">
                    <div class="section--title01">
                        <h3 class="title">User's Testimonials</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include 'Database_connect.php';
                            if (isset($_POST['upload'])) {
                                $testimony_id = $_POST['testimony_id'] ?? null;
                                $username = $_POST['username'] ?? null;
                                $userId = $_POST['userId'] ?? null;
                                $rating = $_POST['rating'] ?? null;

                                if ($testimony_id && $username && $userId && $rating) {
                                    // Update testimony status to "uploaded"
                                    $update_sql = "UPDATE testimonies SET status='uploaded' WHERE testimony_id=$testimony_id";
                                    if ($mysqli->query($update_sql) === TRUE) {
                                        echo "Record updated successfully";
                                    } else {
                                        echo "Error updating record: " . $mysqli->error;
                                    }
                                } else {
                                    echo "Missing fields";
                                }
                            }

                            // Fetch testimonies
                            $sql = "SELECT testimony_id, userId, date, username, status FROM testimonies";
                            $result = $mysqli->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["testimony_id"] . "</td>";
                                    echo "<td>" . $row["date"] . "</td>";
                                    echo "<td>" . $row["username"] . "</td>";
                                    echo "<td>";
                                    echo "<button class='view-btn' onclick='openModal(" . $row["testimony_id"] . ")'>View More</button>";
                                    echo "<button class='delete-btn' onclick='deleteTestimony(" . $row["testimony_id"] . ")'>Delete</button>";
                                    echo "</td>";
                                    echo "<td>" . ($row["status"] == 'uploaded' ? 'Uploaded' : '') . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            $mysqli->close();
                            ?>

                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>

        <script>
            function openModal(testimony_id) {
                fetch('fetch_testimony.php?testimony_id=' + testimony_id)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('testimony_id').value = data.testimony_id;
                        document.getElementById('username').value = data.username;
                        document.getElementById('userId').value = data.userId;
                        document.getElementById('rating').value = data.rating;
                    });
            }

          
        </script>


        <!-- MODAL VIEW MORE-->
        <div id="viewMore" class="modalview">
            <div class="modal-content" style="background-color: #d8e9c7;">
                <h2>User Testimony</h2>
                <form method="post" action="">
                    <input type="hidden" name="testimony_id" id="testimony_id">
                    <input type="hidden" name="username" id="username">
                    <input type="hidden" name="userId" id="userId">
                    <input type="hidden" name="rating" id="rating">

                    <div class="addbutton-group">
                        <button type="button" id="cancel01">Cancel</button>
                    </div>
                </form>
                <br>
                <hr>
                <label>UserId:</label>
                <div class="userId">
                    <p id="userIdDisplay"></p>
                </div>
                <label>Username:</label>
                <div class="username">
                    <p id="usernameDisplay"></p>
                </div>
                <label>Email:</label>
                <div class="email">
                    <p id="email"></p>
                </div>
                <label>Ratings:</label>
                <div class="rate">
                    <h4 id="rate"></h4>
                </div>
                <hr>
                <label>Testimony Content:</label>
                <div class="content">
                    <p id="content"></p>
                </div>
            </div>
        </div>

        <script>
            function deleteTestimony(testimonyId) {
                var confirmation = confirm("Are you sure you want to delete this testimony?");
                if (confirmation) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {

                            location.reload();
                        }
                    };
                    xhttp.open("GET", "delete_record.php?id=" + testimonyId, true); // Corrected filename
                    xhttp.send();
                }
            }
        </script>






        <!-- CHRISTIAN SONGS HTML -->
        <div id="christianSongs" class="tab" style="display: none;">
            <div class="main--container">
                <div class="section--title03">
                    <h3 class="title">Christian Songs</h3>
                </div>
                <br>

                <div class="upload--form">
                    <form action="adminconnect.php" method="POST">
                        <div class="form--group">
                            <label for="songTitle">Song Title:</label>
                            <input type="text" id="songTitle" name="songTitle" required>
                        </div>
                        <div class="form--group">
                            <label for="songArtist">Song Artist:</label>
                            <input type="text" id="songArtist" name="songArtist" required>
                        </div>
                        <div class="form--group">
                            <label for="dateUploaded">Date Uploaded:</label>
                            <input type="date" id="dateUploaded" name="dateUploaded" required>
                        </div>
                        <div class="form--group">
                            <label for="songPicture">Song Picture Path:</label>
                            <input type="text" id="songPicture" name="songPicture" placeholder="Images/songCovers/IMAGE NAME.FILE EXTENSION" required>
                        </div>
                        <div class="form--group">
                            <label for="songFile">Song File Path:</label>
                            <input type="text" id="songFile" name="songFile" placeholder="song/SONGNAME.FILE EXTENSION" required>
                        </div>
                        <div class="form--group">
                            <button type="submit" id="songbtn">Upload Song</button>
                        </div>
                    </form>

                </div>


                <div class="table">
                    <div class="section--title01">
                        <h3 class="title">Uploaded Christian Songs</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Song Title</th>
                                <th>Date Uploaded</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'Database_connect.php';
                            $sql = "SELECT * FROM songs";
                            $result = $mysqli->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["songs_id"] . "</td>";
                                    echo "<td>" . $row["song_title"] . "</td>";
                                    echo "<td>" . $row["songdate_uploaded"] . "</td>";
                                    echo "<td>";
                                    echo "<div class='button-group'>";
                                    echo "<button type='button' class='edit-button' onclick='openEditSongModal(" . $row["songs_id"] . ", \"" . addslashes($row["song_title"]) . "\", \"" . addslashes($row["song_artist"]) . "\", \"" . $row["songdate_uploaded"] . "\", \"" . addslashes($row["song_picture"]) . "\", \"" . addslashes($row["song_file"]) . "\")'>Edit</button>";
                                    echo "<button type='button' class='delete-button' onclick='deleteSong(" . $row["songs_id"] . ")'>Delete</button>";
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td>0</td>";
                                echo "<td>None</td>";
                                echo "<td>00-00-0000</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            function deleteSong(id) {
                var confirmation = confirm("Are you sure you want to delete this song?");
                if (confirmation) {
                    // AJAX request
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            // If deletion is successful, reload the page to update the table
                            location.reload();
                        }
                    };
                    xhttp.open("GET", "delete_record.php?id=" + id, true);
                    xhttp.send();
                }
            }
        </script>

        <div id="editsongModal" class="modal">
            <div class="modal-contents" style="background-color: #97BC62">
                <h2>Edit Song Information</h2>
                <form id="editForm" method="post" action="adminconnect.php">
                    <input type="hidden" id="editSongId" name="editSongId">
                    <div class="form-group">
                        <label for="editSongTitle">Song Title:</label>
                        <input type="text" id="editSongTitle" name="editSongTitle">
                    </div>
                    <div class="form-group">
                        <label for="editSongArtist">Song Artist:</label>
                        <input type="text" id="editSongArtist" name="editSongArtist">
                    </div>
                    <div class="form-group">
                        <label for="editDateUploaded">Date Uploaded:</label>
                        <input type="date" id="editDateUploaded" name="editDateUploaded">
                    </div>
                    <div class="form-group">
                        <label for="editSongPicture">Song Picture Path:</label>
                        <input type="text" id="editSongPicture" name="editSongPicture">
                    </div>
                    <div class="form-group">
                        <label for="editSongFile">Song File Path:</label>
                        <input type="text" id="editSongFile" name="editSongFile">
                    </div>
                    <div class="form-group" id="songbtns">
                        <button type="submit" class="update-button" name="update-button">Update</button>
                        <button type="button" class="cancel-button" onclick="closeEditSongModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openEditSongModal(songId, songTitle, songArtist, dateUploaded, songPicture, songFile) {
                document.getElementById('editSongId').value = songId;
                document.getElementById('editSongTitle').value = songTitle;
                document.getElementById('editSongArtist').value = songArtist;
                document.getElementById('editDateUploaded').value = dateUploaded;
                document.getElementById('editSongPicture').value = songPicture;
                document.getElementById('editSongFile').value = songFile;

                var modal = document.getElementById("editsongModal");
                modal.style.display = "block";
            }

            function closeEditSongModal() {
                var modal = document.getElementById("editsongModal");
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                var modal = document.getElementById("editsongModal");
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>




    </section>











    <script>
        // FOR THE SIDEBAR
        let body = document.querySelector(".body")


        let menu = document.querySelector(".menu")
        let sidebar = document.querySelector(".sidebar")
        let mainContainer = document.querySelector(".main--container")

        menu.onclick = function() {
            sidebar.classList.toggle("activemenu")
        }
        mainContainer.onclick = function() {
            sidebar.classList.remove("activemenu")
        }
    </script>

    <!-- tabs -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll('.tab');
            const sidebarLinks = document.querySelectorAll('.sidebar-link');

            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('data-target');

                    tabs.forEach(tab => {
                        if (tab.id === target) {
                            tab.style.display = 'block';
                        } else {
                            tab.style.display = 'none';
                        }
                    });

                    sidebarLinks.forEach(sidebarLink => {
                        sidebarLink.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        });
    </script>


    <!-- IT WILL GO TO DAILY WORD TAB -->
    <script>
        document.getElementById("dailyWordButton").addEventListener("click", function() {
            document.getElementById("dailyWord").style.display = "block";
        });
    </script>

    <!-- IT WILL GO TO songs TAB -->
    <script>
        document.getElementById("songsbuttonkick").addEventListener("click", function() {
            document.getElementById("christianSongs").style.display = "block";
        });
    </script>

    <script>
        document.getElementById("testbutton").addEventListener("click", function() {
            document.getElementById("testimonials").style.display = "block";
        });
    </script>

    <!-- CANCEL THE FORMS -->
    <script>
        document.querySelector(".cancel-button").addEventListener("click", function() {
            document.getElementById("dailyWordForm").reset();
        });
    </script>


    <script>
        function openModal(testimonyId) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var testimonyInfo = JSON.parse(this.responseText);
                    document.getElementById("userIdDisplay").innerText = testimonyInfo.userId;
                    document.getElementById("usernameDisplay").innerText = testimonyInfo.username;
                    document.getElementById("email").innerText = testimonyInfo.email;
                    document.getElementById("content").innerText = testimonyInfo.testimony;
                    document.getElementById("rate").innerText = testimonyInfo.rating;

                    var modal = document.getElementById("viewMore");
                    modal.style.display = "block";
                }
            };
            xmlhttp.open("GET", "get_testimony_info.php?id=" + testimonyId, true);
            xmlhttp.send();
        }

        window.onload = function() {
            var cancelButton = document.getElementById("cancel01");
            cancelButton.onclick = function() {
                var modal = document.getElementById("viewMore");
                modal.style.display = "none";
            };
        }
    </script>


</body>

</html>