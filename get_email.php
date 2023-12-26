<?php
include 'dbconn.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
   echo "User is not logged in.";
   exit;
}

// Verify and store the email address
$username = $_SESSION['username'];

// Establish a database connection
$mysqli = new mysqli('localhost', 'root', '', 'HandyBackup');

// Check for a successful database connection
if ($mysqli->connect_error) {
    echo "Database connection failed: " . $mysqli->connect_error;
    exit;
}

// SQL query to select the email address based on the username
$sql = "SELECT email FROM users WHERE username = '$username'"; // Enclose $username in single quotes

// Execute the query
$result = $mysqli->query($sql);

// Check if the query was successful
if (!$result) {
   echo "SQL query failed: " . $mysqli->error;
   exit;
}

// Fetch the email address from the result
if ($row = $result->fetch_assoc()) {
   $email = $row['email'];
   echo $email;
}

// Close the database connection
$mysqli->close();
?>
