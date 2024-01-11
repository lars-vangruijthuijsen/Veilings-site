<?php
//
require_once '../config.php';


$serverName = Config::SQL_SERVERNAME;
$database = Config::SQL_DATABASE;
$username = Config::SQL_USERNAME;
$password = Config::SQL_PASSWORD;

// Create connection
$con = new mysqli($serverName, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Database connection error: " . $con->connect_error);
} else {
//     echo "Connected successfully!";
}

// Close the connection when done (optional)
// $conn->close();
?>
