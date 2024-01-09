<?php
session_start();

require_once '../config.php';
$serverName = Config::SQL_SERVERNAME;
$database = Config::SQL_DATABASE;
$username = Config::SQL_USERNAME;
$password = Config::SQL_PASSWORD;

$conn = new mysqli($serverName, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = array(); // Initialize an empty array to store errors

// Function to validate password strength
function validatePassword($password) {
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChar = preg_match('/[!@#$%^&+_<>?.~\-]/', $password);
    $length = strlen($password) >= 8 && strlen($password) <= 16; // Check for password length

    return $uppercase && $lowercase && $number && $specialChar && $length;
}

// Function to check and clear email and password fields if errors exist
function clearFieldsOnErrors($errors) {
    if (in_array("Email is already in use", $errors)) {
        // Clear the email field
        $_POST['email'] = '';
    }

    if (in_array("The two passwords do not match", $errors) || in_array("Password does not meet requirements", $errors)) {
        // Clear both password fields
        $_POST['password_1'] = '';
        $_POST['password_2'] = '';
    }
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    // Check if the email is already in use
    $query = "SELECT * FROM user WHERE email = '$email'";
    $check_email = mysqli_query($conn, $query);

    if (mysqli_num_rows($check_email) > 0) {
        array_push($errors, "Email is already in use");
    } else {
        if ($password_1 !== $password_2) {
            array_push($errors, "The two passwords do not match");
        } else {
            if (!validatePassword($password_1)) {
                array_push($errors, "Password does not meet requirements");
            } else {
                $password = md5($password_1); // Hash the password

                // SQL query for registration
                $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "You are now registered and logged in";
                    header('location: ../AdminDashboard.php');
                } else {
                    array_push($errors, "Registration failed: " . mysqli_error($conn));
                }
            }
        }
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username_email = $_POST['username_email'];
    $password = md5($_POST['password']);

    if (empty($username_email) || empty($password)) {
        array_push($errors, "Username/email and password are required");
    } else {
        // SQL query for login
        $sql = "SELECT * FROM user WHERE (username = '$username_email' OR email = '$username_email') AND password = '$password'";
        $stmt = mysqli_query($conn, $sql);

        if ($stmt) {
            if (mysqli_num_rows($stmt) > 0) {
                $user = mysqli_fetch_assoc($stmt);
                $_SESSION['username'] = $user['username'];
                $_SESSION['success'] = "You are now logged in";

                // Check user role and redirect accordingly
                if ($user['role'] == 'admin') {
                    header('location: ../AdminDashboard.php');
                } else {
                    header('location: ../index.php');
                }
            } else {
                array_push($errors, "Wrong username/email or password combination");
            }
        } else {
            array_push($errors, "Login failed: " . mysqli_error($conn));
        }
    }
}


// Close the database connection
mysqli_close($conn);
?>
