<?php
include '../dbconn.php';
session_start();
if (isset($_POST['sub'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $request = mysqli_real_escape_string($conn, $_POST['selser']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $id = mysqli_real_escape_string($conn, $_POST['d']);
    $emailAuth = mysqli_real_escape_string($conn, $_POST['emailAuth']);
    $file = $_FILES['image']['name'];
    $filename = explode(".", $file);
    $actual_filename = $filename[0];
    $extension = $filename[1];
    $allowed_type = array("jpg", "jpeg", "png","JPG");
    // form validation: ensure that the form is correctly filled
    //use the alert function

    if (empty($fname)) {
        include '../include/warning.php';
        echo '<script>showAlert();</script>';

    }
    if (empty($lname)) {
        include '../include/warning.php';
        echo '<script>showAlert();</script>';

    }
    if (empty($username)) {
        include '../include/warning.php';
        echo '<script>showAlert();</script>';

    }

    if (empty($password)) {
        include '../include/warning.php';
        echo '<script>showAlert();</script>';
    }
    if (empty($phone)) {
        include '../include/warning.php';
        echo '<script>showAlert();</script>';
    }
    if (empty($emailAuth)) {
        include '../include/warning.php';
        echo '<script>showAlert();</script>';
    }
    if (empty($request)) {
        include '../include/warning.php';
        echo '<script>showAlert();</script>';
    }
    if (empty($file)) {
        include '../include/warning.php';
        echo '<script>showAlert();</script>';
    }
    $adminuser = $_SESSION['sess'];
    // Assuming $conn is a valid mysqli connection object
    // Prepare the SELECT query
    if (!in_array($extension, $allowed_type)) {
        include '../include/warning.php';
        echo '<script>invalidImage();</script>';
    } else {
        $check_query = mysqli_prepare($conn, "SELECT COUNT(*) FROM authoriser WHERE location = ? AND request = ? AND (id != ? OR username != ? OR phone != ?)");
        mysqli_stmt_bind_param($check_query, 'sssss', $location, $request, $id, $username, $phone);
        mysqli_stmt_execute($check_query);
        mysqli_stmt_store_result($check_query);
        mysqli_stmt_bind_result($check_query, $count);
        mysqli_stmt_fetch($check_query);

        // Check if the record already exists in the table
        if ($count > 0) {
            mysqli_stmt_close($check_query);
            include '../include/warning.php';
            echo '<script>exist();</script>';
            echo mysqli_error($conn);
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Proceed with adding the record
            // Proceed with adding the record
            $query = mysqli_prepare($conn, "INSERT INTO authoriser (id, firstname, lastname, request, phone,email, location, city, username, password, adminuser,image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            mysqli_stmt_bind_param($query, 'ssssssssssss', $id, $fname, $lname, $request, $phone, $emailAuth, $location, $city, $username, $hashedPassword, $adminuser, $file);

            if (mysqli_stmt_execute($query)) {
                mysqli_stmt_close($query);
                move_uploaded_file($_FILES['image']['tmp_name'], "$file");
                include '../include/success.php';
                echo '<script>added();</script>';
            } else {
                include '../include/warning.php';
                echo '<script>wrong();</script>';
            }
        }
    }
}
mysqli_close($conn);

?>