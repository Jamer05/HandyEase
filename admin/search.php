<?php
include '../dbconn.php';
// Retrieve the search key from the request
$searchKey = $_GET["searchKey"];

/**
 * Perform the database search
 */

$sql = "SELECT * FROM worker WHERE firstname LIKE '%$searchKey%'";
$result = $conn->query($sql);

// Prepare the results
$results = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $results[] = $row["firstname"];
    }
}

// Send the results as JSON
header('Content-Type: application/json');
echo json_encode($results);

// Close the database connection
$conn->close();
?>