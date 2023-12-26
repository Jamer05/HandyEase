<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['sess_user'])) {
    header('Location: worker.php');
    exit();
}


include '../dbconn.php';

// Ensure that you have a user identifier, e.g., user ID
$user = $_SESSION['sess_user'];

// Get the new status from the POST data, for example, using a checkbox input with name 'status'
$status = "Done";  // Remove the duplicate assignment

// Assuming you have a 'service' table with a 'username' column, use single quotes around $status and $user
$query = "UPDATE service SET status = '$status' WHERE username = '$user'";
$result = mysqli_query($conn, $query);

// Handle success or error based on $result
if ($result) {
    // Update was successful
    echo 'Status updated successfully';
} else {
    // Update failed
    echo 'Status update failed';
    // You may also want to add more specific error handling here.
}

// Close the database connection and exit
mysqli_close($conn);
exit();
