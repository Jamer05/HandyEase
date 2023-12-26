<?php
session_start();
require_once('../dbconn.php');

// Check if the user is logged in and retrieve their username.
if (!isset($_SESSION['sess_user'])) {
    header('Location: worker.php');
    exit();
}

$username = $_SESSION['sess_user'];

// Construct the SQL query to fetch the 'active' status for the user.
$query = "SELECT active FROM worker WHERE username = '$username'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch the data
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $activeStatus = $row['active'];
    } else {
        echo "No records found for the given username.";
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}
// Return the active status as a JSON response if needed.
echo json_encode(['activeStatus' => $activeStatus]);


?>
