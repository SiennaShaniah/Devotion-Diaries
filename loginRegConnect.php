<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'Database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (empty($username) || empty($email) || empty($password)) {
            echo "Please fill in all fields.";
        } else {
            $check_query = "SELECT * FROM users WHERE email = ?";
            if ($stmt = $mysqli->prepare($check_query)) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "A user with this email already exists.";
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
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
    } else {
        echo "Please fill in all fields.";
    }
    $mysqli->close();
}
?>


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'Database_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    if ($email === 'admin123@gmail.com' && $password === 'admin123') {
        session_start();
        $_SESSION['admin_loggedin'] = true;
        header("Location: admin.php");
        exit();
    }
    $sql = "SELECT userId, username, email, password FROM users WHERE email = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($userId, $username, $email, $hashed_password);
            $stmt->fetch();
            $hashed_password = trim($hashed_password);
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['user_loggedin'] = true;
                $_SESSION['userId'] = $userId;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                header("Location: user.php");
                exit();
            } else {
                $notification_message = "Incorrect password.";
            }
        } else {
            $notification_message = "No user found with this email.";
        }
        $stmt->close();
    } else {
        $notification_message = "Failed to prepare the SQL statement.";
    }
}   
$mysqli->close();
?>


