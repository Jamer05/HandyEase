<?php
include '../dbconn.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require '../vendor/autoload.php'; // Load Monolog library

$logger = new Logger('logger');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../act.log', Logger::DEBUG));

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_prepare($conn, "SELECT * FROM worker WHERE username=?");
    mysqli_stmt_bind_param($query, 's', $username);
    mysqli_stmt_execute($query);
    
    $result = mysqli_stmt_get_result($query);
    $numRows = mysqli_num_rows($result);


    $sql1 = mysqli_prepare($conn, "SELECT * FROM users
    WHERE staff IS NOT NULL AND username = ?");
    mysqli_stmt_bind_param($sql1, 's', $username);
    mysqli_stmt_execute($sql1);

    $result1 = mysqli_stmt_get_result($sql1);
    $numRows1= mysqli_num_rows($result1);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        $dbUsername = $row['username'];
        $dbPassword = $row['password'];
        $dbName = $row['name'];
        $authorizer = $row['id'];

        // Password verification
        if (password_verify($password, $dbPassword)) {
            session_start();
            $_SESSION['sess_user'] = $dbUsername;
            /* Redirect browser */
            // $_SESSION['username'] = $user['username'];

            if ($numRows1 == 1) {
                $user = mysqli_fetch_assoc($result1);
                $_SESSION['sess_user'] = $dbUsername;
                $_SESSION['name'] = $user['name'];
                $_SESSION['user_id'] = $user['user_id'];
            }

            $logger->debug("Result: SUCCESS");
            header("Location: application.php");
            exit();
        } else {
            echo "<script>alert('Invalid Login Credentials');
            window.location.href='worker.php';</script>";
            $logger->critical("Trying to login for worker: $username $password");
        }
    } else {
        echo "<script>alert('Credentials are not registered');
            window.location.href='worker.php';</script>";
        $logger->critical("Trying to login for worker: $username $password");
    }
} else {
    echo "<script>alert('All fields are required!');
        window.location.href='worker.php';</script>";
    $logger->critical("Trying to login for worker: $username");
}

?>
