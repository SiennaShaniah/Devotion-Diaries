<!-- USERNAME AT THE TOP -->
<?php
session_start();
require_once 'database_connect.php';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
?>
<?php
    } else {
        echo "Error: Unable to fetch user's information.";
    }
} else {
    header("Location: loginReg.php");
    exit;
}
?>

<!-- SONG IN DASHBOARD -->
<?php
include 'Database_connect.php';
$sql = "SELECT song_title FROM songs ORDER BY songs_id DESC LIMIT 1";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $recent_song_title = $row["song_title"];
} else {
    $recent_song_title = "No songs found";
}
?>



<!-- DAILY WORD IN DASHBOARD -->
<?php
require_once 'database_connect.php';
$query = "SELECT daily_word_title FROM daily_word ORDER BY daily_word_date DESC LIMIT 1";
$result = $mysqli->query($query);

if ($result && $result->num_rows > 0) {
    $daily_word = $result->fetch_assoc();
    $daily_word_title = $daily_word['daily_word_title'];
} else {
    $daily_word_title = "No daily word available";
}
?>


<!-- PROFILE USERNAME AND EMAIL -->
<?php
require_once 'database_connect.php';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_username = $user['username'];
        $user_email = $user['email'];
?>
<?php
    } else {
        echo "Error: Unable to fetch user's information.";
    }
} else {
    header("Location: loginReg.php");
    exit;
}
?>

<!-- PROFILE USERID -->
<?php
require_once 'database_connect.php';
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
?>
<?php
} else {
    echo "User not logged in.";
}
?>


<!-- insert testimony -->
<?php
include('database_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $mysqli->real_escape_string($_POST['username']);
    $userId = $mysqli->real_escape_string($_POST['userId']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $date = $mysqli->real_escape_string($_POST['date']);
    $testimony = $mysqli->real_escape_string($_POST['testimony']);
    $rating = $mysqli->real_escape_string($_POST['ratings']);
    $sql = "INSERT INTO testimonies (userId, username, email, date, testimony, rating) VALUES ('$userId', '$username', '$email', '$date', '$testimony', '$rating')";
    if ($mysqli->query($sql) === true) {
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
}
?>



<!-- NOTEBOOKS INSERTION -->
<?php
include('database_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $notebook_title = $mysqli->real_escape_string($_POST['notebook-title']);
    // Get the selected cover image filename from the form
    $selected_cover = $mysqli->real_escape_string($_POST['selected-cover']);
    // Assuming you have a mechanism to track the logged-in user
    $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

    if ($userId) {
        // Attempt insert query execution
        $sql = "INSERT INTO notebooks (notebook_title, userId, notebook_cover) VALUES ('$notebook_title', '$userId', '$selected_cover')";
        if ($mysqli->query($sql) === true) {
            echo "Notebook added successfully!";
            // Redirect the user to user.php after successful creation
            header("Location: user.php");
            exit(); // Ensure that no further code is executed after redirection
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } else {
        // Redirect the user to the login page or handle the scenario where the user is not logged in
        header("Location: login.php");
        exit(); // Ensure that no further code is executed after redirection
    }

    // Close connection
    $mysqli->close();
}
?>



<!-- NAME.ID EMAIL NON EDITABLE -->
<?php
include 'Database_connect.php';
$userId = $_SESSION['userId'];
$sql = "SELECT username, email FROM users WHERE userId = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
?>

<!-- PROFILE INFO INSERTION AND UPDATE: -->

<?php
include 'Database_connect.php'; // Include the database connection file

// Enable error reporting for debugging
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if profile already exists for the user
    $userId = $_POST['userIdInput'];
    $existing_profile_query = "SELECT * FROM user_profile WHERE userId = ?";
    $stmt = $mysqli->prepare($existing_profile_query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $existing_profile_result = $stmt->get_result();

    if ($existing_profile_result->num_rows > 0) {
        // Update existing profile
        $update_query = "UPDATE user_profile SET 
            gender = ?, 
            age = ?, 
            address = ?, 
            religion = ?, 
            life_motto = ?, 
            self_description = ? 
            WHERE userId = ?";

        $stmt = $mysqli->prepare($update_query);
        $stmt->bind_param("sissssi", $_POST['genderSelect'], $_POST['ageInput'], $_POST['addressInput'], $_POST['religionInput'], $_POST['moto'], $_POST['selfdesc'], $userId);
        $stmt->execute();
        $stmt->close();
    } else {
        // Insert new profile
        $insert_query = "INSERT INTO user_profile (userId, username, email, gender, age, address, religion, life_motto, self_description, profile_picture) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $profile_picture = ''; // Default value if no picture uploaded

        if ($_FILES['profilePictureInput']['size'] > 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['profilePictureInput']['name']);

            // Check if file is an image
            $check = getimagesize($_FILES['profilePictureInput']['tmp_name']);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES['profilePictureInput']['size'] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow only certain file formats
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // If everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES['profilePictureInput']['tmp_name'], $target_file)) {
                    $profile_picture = $target_file;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        $stmt = $mysqli->prepare($insert_query);
        $stmt->bind_param("issssissis", $userId, $_POST['usernameInput'], $_POST['emailInput'], $_POST['genderSelect'], $_POST['ageInput'], $_POST['addressInput'], $_POST['religionInput'], $_POST['moto'], $_POST['selfdesc'], $profile_picture);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: user.php");
    exit();
}

$mysqli->close();
?>












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="user.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet">
</head>

<body>
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line menu"></i>
            <h2><span>Devotion</span>Diaries</h2>
        </div>
        <div class="profile">
            <span class="username"><?php echo $user['username']; ?></span>
            <img src="Images/signin.svg" alt="User's Image">
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
                    <a href="#" class="sidebar-link" data-target="profile">
                        <span class="icon"><i class="ri-user-line"></i></span>
                        <div class="sidebar--item">Profile</div>
                    </a>
                </li>

                <li>
                    <a href="#" class="sidebar-link" data-target="dailyWord">
                        <span class="icon"><i class="ri-file-text-line"></i></span>
                        <div class="sidebar--item">Daily Word</div>
                    </a>
                </li>

                <li>
                    <a href="#" class="sidebar-link" data-target="christianSongs">
                        <span class="icon"><i class="ri-music-line"></i></span>
                        <div class="sidebar--item">Christian Songs</div>
                    </a>
                </li>

                <li>
                    <a href="#" class="sidebar-link" data-target="testimonials">
                        <span class="icon"><i class="ri-chat-3-line"></i></span>
                        <div class="sidebar--item">Send a Testimony</div>
                    </a>
                </li>

                <li>
                    <a href="#" class="sidebar-link" data-target="notebook">
                        <span class="icon"><i class="ri-book-line"></i></span>
                        <div class="sidebar--item">Devo Notebooks</div>
                    </a>
                </li>

                <li>
                    <a href="#" class="sidebar-link" data-target="trashbin">
                        <span class="icon"><i class="ri-delete-bin-line"></i></span>
                        <div class="sidebar--item">Trashbin</div>
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

        <!-- DASHBOARD -->
        <div id="dashboard" class="tab">
            <div class="main--container">
                <div class="section--title">
                    <h3 class="title">Welcome User!</h3>
                    <h3 class="title">Dashboard</h3>
                </div>
                <div class="section--container">

                    <!-- first card -->
                    <div class="card">
                        <div class="image01">
                        </div>
                        <div class="content">
                            <a href="#">
                                <span class="title">
                                    Today's Daily Word
                                </span>
                            </a>
                            <p class="desc">
                                Access the inspirational message for today's reflection and guidance from the Word of God.
                            </p>
                            <br>
                            <div class="card123">
                                <div class="data">
                                    <p><?php echo $daily_word_title; ?></p>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="find-button" id="firstcard">Find Out More</button>
                        </div>
                    </div>


                    <!-- Second card -->
                    <div class="card">
                        <div class="image02">
                        </div>
                        <div class="content">
                            <a href="#">
                                <span class="title">Recent Added Song</span>
                            </a>
                            <p class="desc">Discover the latest addition to the collection of uplifting Christian music, that surely lift your Spirit.</p>
                            <br>
                            <div class="card123">
                                <div class="data">
                                    <p><?php echo $recent_song_title; ?></p>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="find-button" id="secondcard">Find Out More</button>
                        </div>
                    </div>

                    <!-- Third card -->
                    <div class="card">
                        <div class="image03">
                        </div>
                        <div class="content">
                            <a href="#">
                                <span class="title">
                                    Read the Bible
                                </span>
                            </a>
                            <p class="desc">
                                Quickly navigate to essential sections of the Bible for efficient study and reference.
                            </p>
                            <br>
                            <div class="card123">
                                <div class="data">
                                    <p>READ NOW!</p>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="find-button" id="findOutMoreBtn1">Find Out More</button>
                        </div>
                    </div>

                    <!-- Fourth card -->
                    <div class=" card">
                        <div class="image04">
                        </div>
                        <div class="content">
                            <a href="#">
                                <span class="title">
                                    Read Daily Devotionals
                                </span>
                            </a>
                            <p class="desc">
                                Access a convenient shortcut to your daily devotion material for spiritual enrichment.
                            </p>
                            <br>
                            <div class="card123">
                                <div class="data">
                                    <p>BE INSPIRED!</p>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="find-button" id="findOutMoreBtn2">Find Out More</button>
                        </div>
                    </div>

                    <!-- Fifth card -->
                    <div class="card">
                        <div class="image05">
                        </div>
                        <div class="content">
                            <a href="#">
                                <span class="title">
                                    Recent Notebook Created
                                </span>
                            </a>
                            <p class="desc">
                                View the most recently created or updated devotional notebooks for personal growth and reflection.
                            </p>
                            <br>
                            <div class="card123">
                                <div class="data">
                                    <p>Lorem, ipsum dolor.</p>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="find-button">Find Out More</button>
                        </div>
                    </div>

                    <!-- Sixth card -->
                    <div class="card">
                        <div class="image06">
                        </div>
                        <div class="content">
                            <a href="#">
                                <span class="title">
                                    Recent Created Entry
                                </span>
                            </a>
                            <p class="desc">
                                Display the most recently created entry, providing quick access to the latest insights."
                            </p>
                            <br>
                            <div class="card123">
                                <div class="data">
                                    <p>Lorem, ipsum dolor.</p>
                                </div>
                            </div>
                            <br>
                            <button type="button" class="find-button">Find Out More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- PROFILE -->
        <div id="profile" class="tab">
            <div class="main--container">
                <div class="section--title">
                    <h3 class="title">Profile</h3>
                </div>
                <div class="profile-page">
                    <div class="content">
                        <div class="content__cover">
                            <div class="content__avatar">
                                <img src="Images/profile/noProfile.jpg" alt="Avatar">
                            </div>

                            <div class="content__bull"><span></span><span></span><span></span><span></span><span></span>
                            </div>
                        </div>
                        <div class="content__actions"><a href="#">
                            </a><a href="#"></a></div>
                        <div class="content__title">
                            <h1><?php echo $user_username; ?></h1><span><?php echo $user_email; ?></span>
                        </div>

                        <div class="content__description">
                            <div class="carder">
                                <p><span>User ID: <br></span><?php echo $userId; ?></p>
                            </div>
                            <div class="carder">
                                <p><span>Gender: <br></span></p>
                            </div>
                            <div class="carder">
                                <p><span>Age: <br></span></p>
                            </div>
                            <div class="carder">
                                <p><span>Address: <br></span></p>
                            </div>
                            <div class="carder">
                                <p><span>Religion: <br></span></p>
                            </div>
                            <div class="carder">
                                <p><span>Life Moto: <br></span></p>
                            </div>
                            <div class="carder">
                                <p><span>Self Description: <br></span></p>
                            </div>
                        </div>

                        <ul class="content__list">
                            <li><span>0</span>Notebooks Created</li>
                            <li><span>0</span>Total Entries</li>
                            <li><span>0</span>Total Testimonies</li>
                        </ul>

                        <div class="content__button"><a class="button" href="#">
                                <div class="button__border"></div>
                                <div class="button__bg"></div>
                                <p class="button__text">Edit Profile</p>
                            </a></div>
                    </div>
                    <div class="bg">
                        <div><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
                        </div>
                    </div>
                    <div class="theme-switcher-wrapper" id="theme-switcher-wrapper"><span>Themes color</span>
                        <ul>
                            <li><em class="is-active" data-theme="one"></em></li>
                            <li><em data-theme="two"></em></li>
                            <li><em data-theme="three"></em></li>
                            <li><em data-theme="four"></em></li>
                        </ul>
                    </div>
                    <div class="theme-switcher-button" id="theme-switcher-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="currentColor" d="M352 0H32C14.33 0 0 14.33 0 32v224h384V32c0-17.67-14.33-32-32-32zM0 320c0 35.35 28.66 64 64 64h64v64c0 35.35 28.66 64 64 64s64-28.65 64-64v-64h64c35.34 0 64-28.65 64-64v-32H0v32zm192 104c13.25 0 24 10.74 24 24 0 13.25-10.75 24-24 24s-24-10.75-24-24c0-13.26 10.75-24 24-24z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL profile -->
        <div id="profileModal" class="profmodal">
            <div class="modal-content">
                <div class="title01">
                    <h3 class="modal-title">Edit Profile</h3>
                </div>
                <br>


                <form method="POST" action="">
                    <!-- Profile Picture Section -->
                    <div class="form-section">
                        <h4 class="form-title">Profile Picture</h4>
                        <input type="file" id="profilePictureInput" name="profilePictureInput" accept="image/*">
                    </div>

                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <h4 class="form-title">Personal Information</h4>
                        <h5>Username</h5>
                        <input type="text" id="usernameInput" name="usernameInput" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" readonly>
                        <h5>Email</h5>
                        <input type="text" id="emailInput" name="emailInput" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                        <h5>User ID</h5>
                        <input type="text" id="userIdInput" name="userIdInput" placeholder="User ID" value="<?php echo $userId; ?>" readonly>
                        <hr>
                        <br>
                        <select id="genderSelect" name="genderSelect" placeholder="Gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <input type="text" id="ageInput" name="ageInput" placeholder="Age">
                        <input type="text" id="addressInput" name="addressInput" placeholder="Address">
                        <input type="text" id="religionInput" name="religionInput" placeholder="Religion">
                    </div>

                    <!-- Additional Information Section -->
                    <div class="form-section">
                        <h4 class="form-title">Additional Information</h4>
                        <textarea id="moto" name="moto" placeholder="Life Moto"></textarea>
                        <textarea id="selfdesc" name="selfdesc" placeholder="Self Description"></textarea>
                    </div>

                    <!-- Buttons -->
                    <button type="submit" id="saveBtn" name="saveBtn">Save</button>
                    <button type="button" id="cancelbtn">Cancel</button>
                    <button type="button" id="resetbtn">Reset</button>
                </form>


            </div>
        </div>




        <!-- DAILY WORD -->
        <div id="dailyWord" class="tab">
            <div class="section--title">
                <h3 class="title">Daily Word</h3>
            </div>

            <div class="section--container">
                <div class="card103">
                    <div class="card-image103">
                        <img src="Images/dailyword01.png" alt="image">
                    </div>
                    <?php
                    // Include the database connection file
                    include 'Database_connect.php';

                    // Query to select the most recent daily word
                    $sql = "SELECT * FROM daily_word ORDER BY daily_word_date DESC LIMIT 1";

                    // Execute the query
                    $result = $mysqli->query($sql);

                    // Check if there is a result
                    if ($result->num_rows > 0) {
                        // Fetch the row
                        $row = $result->fetch_assoc();
                    ?>
                        <div class="date"><?php echo $row['daily_word_date']; ?></div>
                        <div class="title1"><?php echo $row['daily_word_title']; ?></div>
                        <p class="word"><?php echo $row['daily_word_text']; ?></p>
                    <?php
                    } else {
                        echo "<p>No daily word found.</p>";
                    }

                    // Close the connection
                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>



        <!-- SONGS -->
        <div id="christianSongs" class="tab">
            <div class="main--container102">
                <div class="section--title101">
                    <h3 class="title">Christian Songs</h3>
                </div>
                <div class="section--container">
                    <?php
                    include 'Database_connect.php';
                    $sql = "SELECT * FROM songs";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <!-- Song Card -->
                            <div class="song-card">
                                <div class="song-image">
                                    <img src="<?php echo $row['song_picture']; ?>" alt="<?php echo $row['song_title']; ?>">
                                </div>
                                <div class="song-details">
                                    <h4 class="song-title"><?php echo $row['song_title']; ?></h4>
                                    <p class="artist-name"><?php echo $row['song_artist']; ?></p>
                                    <hr>
                                    <div class="control-buttons">
                                        <button class="control-button play-button" onclick="playSong('<?php echo $row['song_file']; ?>')"><span class="icon"><i class="ri-play-line"></i></span></button>
                                        <button class="control-button stop-button" onclick="stopSong()"><span class="icon"><i class="ri-stop-line"></i></span></button>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>

        <!-- TESTIMONY -->
        <div id="testimonials" class="tab">
            <div class="section--title">
                <h3 class="title">Send a Testimony</h3>
            </div>
            <div class="section--container">
                <form class="form" action="#" method="post">
                    <div class="heading">Testimony Form</div>
                    <label for="username">Username:</label>
                    <div>
                        <input type="text" name="username" id="username" class="input" placeholder="user" required>
                    </div>
                    <label for="userId">User ID:</label>
                    <div>
                        <input type="text" name="userId" id="userId" class="input" placeholder="userID" required>
                    </div>
                    <label for="email">Email:</label>
                    <div>
                        <input type="text" name="email" id="email" class="input" placeholder="user@gmail.com" required>
                    </div>
                    <label for="date">Date:</label>
                    <div>
                        <input type="date" name="date" id="date" class="input" required>
                    </div>
                    <label for="testimony">Testimony:</label>
                    <div>
                        <textarea name="testimony" id="testimony" class="input" rows="5" placeholder="none" required></textarea>
                    </div>
                    <div>
                        <label for="ratings">Application Rating:</label>
                        <select name="ratings" id="ratings" class="input" required>
                            <option value="1">[1] Poor: The lowest rating, indicating a very unsatisfactory experience. Significant issues or problems were encountered, and the product or service did not meet expectations. </option>
                            <option value="2">[2] Fair: A below-average rating, suggesting that there were notable flaws or shortcomings. The experience may have been mediocre, with room for improvement.</option>
                            <option value="3">[3] Average: An okay rating, indicating a satisfactory but unremarkable experience. The product or service met basic expectations but didn't exceed them.</option>
                            <option value="4">[4] Good: A positive rating, signifying a solid experience with few issues. The product or service performed well and met expectations with some room for improvement.</option>
                            <option value="5">[5] Excellent: The highest rating, representing an outstanding experience. The product or service exceeded expectations, with exceptional performance and satisfaction.</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn">Send</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- NOTEBOOKS -->
        <div id="notebook" class="tab">
            <div class="main--container103">
                <div class="section--title104">
                    <h3 class="title04">Devo Notebooks</h3>
                    <button class="button" id="notebutton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20" fill="none" class="svg-icon">
                            <g stroke-width="1.5" stroke-linecap="round" stroke="black">
                                <circle r="7.5" cy="10" cx="10"></circle>
                                <path d="m9.99998 7.5v5"></path>
                                <path d="m7.5 9.99998h5"></path>
                            </g>
                        </svg>
                        <span class="lable">Add</span>
                    </button>
                </div>

                <div class="notesection--container">
                    <div class="notecard-row">


                        <div class="notecard">
                            <div class="noteimage">
                                <img src="Images/covers/1.png" alt="Notebook Cover">

                            </div>
                            <div class="notetitle-box">
                                <p class="notetitle">Lorem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL NOTEBOOK -->
        <div id="notemodal" class="modalnote">
            <div class="modal-content">
                <h2>Add Notebook</h2>
                <br>
                <hr>
                <form class="notebook-form" method="POST" action="insert_notebook.php">
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="notebook-title">User Id:</label>
                        <br>
                        <input type="number" id="userId" name="userId" required>
                        <br>
                        <label for="notebook-title">Notebook Title:</label>
                        <input type="text" id="notebook-title" name="notebook-title" required>
                    </div>
                    <br>
                    <br>
                    <hr>
                    <div class="addbutton-group">
                        <button type="submit" id="add-notebook" >Add</button>
                        <button type="button" id="cancel-notebook">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal for Cover Selection -->
        <div id="cover-modal" class="modalcover">
            <div class="modal-content">
                <h2>Select Cover</h2>
                <div class="cover-images">
                    <img src="Images/covers/1.png" alt="Cover 1" data-cover="Images/covers/1.png" id="cover1">
                    <img src="Images/covers/2.png" alt="Cover 2" data-cover="Images/covers/2.png" id="cover2">
                    <img src="Images/covers/3.png" alt="Cover 3" data-cover="Images/covers/3.png" id="cover3">
                    <img src="Images/covers/4.png" alt="Cover 4" data-cover="Images/covers/4.png" id="cover4">
                    <img src="Images/covers/5.png" alt="Cover 5" data-cover="Images/covers/5.png" id="cover5">
                    <img src="Images/covers/6.png" alt="Cover 6" data-cover="Images/covers/6.png" id="cover6">
                    <img src="Images/covers/7.png" alt="Cover 7" data-cover="Images/covers/7.png" id="cover7">
                    <img src="Images/covers/8.png" alt="Cover 8" data-cover="Images/covers/8.png" id="cover8">
                    <img src="Images/covers/9.png" alt="Cover 9" data-cover="Images/covers/9.png" id="cover">
                    <img src="Images/covers/10.png" alt="Cover 10" data-cover="Images/covers/10.png" id="cover10">
                </div>
            </div>
        </div>




        <!-- TRASHBIN -->
        <div id="trashbin" class="tab">
            <div class="main--container">
                <div class="section--title">
                    <h3 class="title">Trashbin</h3>
                </div>

                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Notebook Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0</td>
                                <td>None</td>
                                <td>
                                    <button class="button1">Delete</button>
                                    <button class="button1">Restore</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll('.tab');
            const sidebarLinks = document.querySelectorAll('.sidebar-link');

            // Function to show a specific tab
            function showTab(target) {
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

                // Find and activate the corresponding sidebar link
                const activeLink = document.querySelector(`[data-target="${target}"]`);
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }

            // Show dashboard tab initially
            showTab('dashboard');

            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('data-target');
                    showTab(target);
                });
            });
        });
    </script>

    <script>
        (() => {

            'use-strict'

            const themeSwiter = {

                init: function() {
                    this.wrapper = document.getElementById('theme-switcher-wrapper')
                    this.button = document.getElementById('theme-switcher-button')
                    this.theme = this.wrapper.querySelectorAll('[data-theme]')
                    this.themes = ['theme-one', 'theme-two', 'theme-three', 'theme-four']
                    this.events()
                    this.start()
                },

                events: function() {
                    this.button.addEventListener('click', this.displayed.bind(this), false)
                    this.theme.forEach(theme => theme.addEventListener('click', this.themed.bind(this), false))
                },

                start: function() {
                    let theme = this.themes[Math.floor(Math.random() * this.themes.length)]
                    document.body.classList.add(theme)
                },

                displayed: function() {
                    (this.wrapper.classList.contains('is-open')) ?
                    this.wrapper.classList.remove('is-open'): this.wrapper.classList.add('is-open')
                },

                themed: function(e) {
                    this.themes.forEach(theme => {
                        if (document.body.classList.contains(theme))
                            document.body.classList.remove(theme)
                    })
                    return document.body.classList.add(`theme-${e.currentTarget.dataset.theme}`)
                }

            }

            themeSwiter.init()

        })()
    </script>


    <!-- MODAL OF PROFILE -->
    <script>
        var modal = document.getElementById("profileModal");
        var editProfileBtn = document.querySelector(".content__button .button");
        var saveBtn = document.getElementById("saveBtn");
        var cancelBtn = document.getElementById("cancelbtn");
        var span = document.getElementsByClassName("close")[0];

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }
        editProfileBtn.onclick = function(event) {
            event.preventDefault();
            openModal();
        }
        saveBtn.onclick = function(event) {
            event.preventDefault();
            closeModal();
        }
        cancelBtn.onclick = function(event) {
            event.preventDefault();
            closeModal();
        }
        span.onclick = function() {
            closeModal();
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

    <script>
        var resetButton = document.getElementById("resetbtn");

        function resetFormFields() {
            var inputFields = document.querySelectorAll('input[type="text"], textarea, select');
            inputFields.forEach(function(element) {
                element.value = "";
            });
        }
        resetButton.addEventListener("click", function() {
            resetFormFields();
        });
    </script>


    <!-- MODAL OF NOTEBOOK -->
    <script>
        var notebookmodal = document.getElementById("notemodal");
        var addNoteBtn = document.getElementById("notebutton");
        var notebookSaveBtn = document.getElementById("add-notebook");
        var notebookCancelBtn = document.getElementById("cancel-notebook");
        var notebookSpan = document.getElementsByClassName("close")[0];

        function openNotebookModal() {
            notebookmodal.style.display = "block";
        }

        function closeNotebookModal() {
            notebookmodal.style.display = "none";
        }
        addNoteBtn.onclick = function(event) {
            event.preventDefault(); // Prevent the default button behavior
            openNotebookModal();
        }
        notebookSaveBtn.onclick = function(event) {
            event.preventDefault(); // Prevent the default button behavior
            closeNotebookModal();
        }
        notebookCancelBtn.onclick = function(event) {
            event.preventDefault(); // Prevent the default button behavior
            closeNotebookModal();
        }
        notebookSpan.onclick = function() {
            closeNotebookModal();
        }
        window.onclick = function(event) {
            if (event.target == notebookmodal) {
                closeNotebookModal();
            }
        }
    </script>

    <!-- FOR THE CARDS IN NOTEBOOK -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notecardContainer = document.querySelector('.notecard-row');
            const notecards = document.querySelectorAll('.notecard');
            const maxCardsPerRow = 5;

            function rearrangeCards() {
                let rowCounter = 0;
                let row = document.createElement('div');
                row.classList.add('notecard-row');
                notecardContainer.innerHTML = '';

                notecards.forEach((card, index) => {
                    row.appendChild(card.cloneNode(true));
                    rowCounter++;

                    if (rowCounter === maxCardsPerRow || index === notecards.length - 1) {
                        notecardContainer.appendChild(row);
                        row = document.createElement('div');
                        row.classList.add('notecard-row');
                        rowCounter = 0;
                    }
                });
            }

            function calculateCardWidth() {
                const containerWidth = notecardContainer.offsetWidth;
                const cardMargin = 10;
                const cardsPerRow = maxCardsPerRow;
                const cardWidth = (containerWidth / cardsPerRow) - cardMargin;
                notecards.forEach(card => {
                    card.style.width = `${cardWidth}px`;
                });
            }

            calculateCardWidth();
            rearrangeCards();
            const addButton = document.querySelector('#add-card-button');
            addButton.addEventListener('click', function() {
                const newCard = document.createElement('div');
                newCard.classList.add('notecard');
                newCard.innerHTML = `
    <div class="noteimage"><span class="text">Notebook Cover</span></div>
    <span class="notetitle">About Jesus</span>
    `;
                notecardContainer.appendChild(newCard);
                notecards.push(newCard);
                calculateCardWidth();
                rearrangeCards();
            });
        });
    </script>

    <!-- NOTEBOOK CARD MODAL -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectCoverButton = document.getElementById('select-cover-button');
            const coverModal = document.getElementById('cover-modal');
            const coverImages = coverModal.querySelectorAll('.cover-images img');
            const selectedCover = document.getElementById('selectedCover');

            selectCoverButton.addEventListener('click', function() {
                coverModal.style.display = 'block';
            });

            coverImages.forEach(image => {
                image.addEventListener('click', function() {
                    const newCoverSrc = this.getAttribute('data-cover');
                    selectedCover.innerHTML = `${newCoverSrc}`;
                    coverModal.style.display = 'none';
                });
            });
        });
    </script>





    <!-- IT WILL GO TO dailyWord TAB -->
    <script>
        document.getElementById("firstcard").addEventListener("click", function() {
            document.getElementById("dailyWord").style.display = "block";
        });
    </script>
    <!-- IT WILL GO TO songs TAB -->
    <script>
        document.getElementById("secondcard").addEventListener("click", function() {
            document.getElementById("christianSongs").style.display = "block";
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var findButton = document.getElementById('findOutMoreBtn1');
            findButton.addEventListener('click', function() {
                window.open('https://www.bible.com/', '_blank');
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var findButton = document.getElementById('findOutMoreBtn2');
            findButton.addEventListener('click', function() {
                window.open('https://www.intouch.org/read/daily-devotions', '_blank');
            });
        });
    </script>


    <!-- FOR THE NOTEBOOK COVER INSERTION -->
    <script>
        document.querySelectorAll('.cover-images img').forEach(function(img) {
            img.addEventListener('click', function() {
                var selectedCover = img.getAttribute('data-cover');
                document.getElementById('selectedCover').innerText = selectedCover;
                document.getElementById('selectedCoverInput').value = selectedCover;
            });
        });
    </script>

    <!-- FOR SONG PLAY AND PAUSE -->
    <script>
        var currentAudio = null;

        function playSong(songPath) {
            if (currentAudio) {
                currentAudio.pause();
            }
            var audio = new Audio(songPath);
            audio.play();
            currentAudio = audio;
        }

        function stopSong() {
            if (currentAudio) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
            }
        }
    </script>



</body>

</html>