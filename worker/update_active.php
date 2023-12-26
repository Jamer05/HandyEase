<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['sess_user'])) {
    header('Location: worker.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../dbconn.php';

    // Ensure that you have a user identifier, e.g., user ID
    $user = $_SESSION['sess_user'];
    
    // Get the new status from the POST data
    $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

    // Assuming you have a 'workers' table with a 'username' column
    $query = "UPDATE worker SET active = $status WHERE username = '$user'";
    $result = mysqli_query($conn, $query);

    // Handle success or error based on $result
    if ($result) {
        // Update was successful
        echo 'Status updated successfully';
    } else {
        // Update failed
        echo 'Status update failed';
    }

    // Close the database connection and exit
    mysqli_close($conn);
    exit();
}
