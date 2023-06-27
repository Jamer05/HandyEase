<?php
// Assuming you have already established a database connection
// and retrieved the initial list of customers from the database

// Check if a service or city is selected
if (isset($_POST['service']) || isset($_POST['city'])) {
    $service = $_POST['service'];
    $city = $_POST['city'];

    // Construct the SQL query based on the selected service or city
    $query = "SELECT * FROM customers WHERE 1=1"; // Start with a true condition

    // Add the service filter if a service is selected
    if (!empty($service)) {
        $query .= " AND service = '$service'";
    }

    // Add the city filter if a city is selected
    if (!empty($city)) {
        $query .= " AND city = '$city'";
    }

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check for errors in the query
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Fetch the filtered results
    $filteredCustomers = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $filteredCustomers[] = $row;
    }

    // Return the filtered results as JSON
    echo json_encode($filteredCustomers);
} else {
    // Return all customers if no filters are selected
    $query = "SELECT * FROM customers";
    $result = mysqli_query($conn, $query);
    $allCustomers = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $allCustomers[] = $row;
    }
    echo json_encode($allCustomers);
}

?>