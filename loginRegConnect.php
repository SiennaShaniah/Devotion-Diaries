<?php
session_start();

$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'devdiaries';

// Create connection
$mysqli = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Changed from firstname and lastname
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['registration_success'] = true;
                header("Location: loginReg.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $mysqli->close();
}
?>


<?php
session_start();

// Database configuration settings
$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'devdiaries';

// Create connection
$mysqli = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    // Handle form submission
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Admin credentials
    $admin_email = 'admin123@gmail.com';
    $admin_password = 'admin123';

    // Admin login check
    if ($email == $admin_email && $password == $admin_password) {
        // Start a new session for admin
        session_regenerate_id();
        $_SESSION['admin_loggedin'] = true;

        // Redirect admin to the admin page
        header("location: admin.php");
        exit();
    }

    // User login check
    $sql = "SELECT userId, username, email, password FROM users WHERE email = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $email);

        // Execute the statement
        $stmt->execute();
        $stmt->store_result();

        // Check if the email exists in the database
        if ($stmt->num_rows == 1) {
            // Bind the result variables
            $stmt->bind_result($userId, $username, $email, $hashed_password);
            $stmt->fetch();

            // Verify the password with the hashed password in the database
            if (password_verify($password, $hashed_password)) {
                // Start a new session for the user
                session_regenerate_id();
                $_SESSION['user_loggedin'] = true;
                $_SESSION['userId'] = $userId;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;

                // Redirect user to the user page
                header("location: user.php");
                exit();
            }
        }
        
        // Redirect user to login page with error message
        header("location: login.php?error=1");
        exit();
    }
}

// Close the database connection
$mysqli->close();
?>
