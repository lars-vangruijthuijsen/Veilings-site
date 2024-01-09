<?php

require_once 'config.php';

$serverName = Config::SQL_SERVERNAME;
$database = Config::SQL_DATABASE;
$username = Config::SQL_USERNAME;
$password = Config::SQL_PASSWORD;

// Create connection
$conn = new mysqli($serverName, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
} else {
//     echo "Connected successfully!";
}

// Close the connection when done (optional)
// $conn->close();
?>
