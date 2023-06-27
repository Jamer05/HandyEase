<?php include '../dbconn.php'; ?>
<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require '../vendor/autoload.php'; // Load Monolog library

$logger = new Logger('logger');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../act.log', Logger::DEBUG));

$username = $_POST['username'];
$password = $_POST['password'];


if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_prepare($conn, "SELECT * FROM authoriser WHERE username=?");
    mysqli_stmt_bind_param($query, 's', $user);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);
    $numrows = mysqli_num_rows($result);

    if ($numrows == 1) {
        $row = mysqli_fetch_assoc($result);
        $dbusername = $row['username'];
        $dbpassword = $row['password'];
        $authoriser = $row['id'];

        if ($user == $dbusername && password_verify($pass, $dbpassword)) {
            session_start();
            $_SESSION['sess_user'] = $user;
            $_SESSION['authid'] = $authoriser;
            $_SESSION['user_id'] =$authoriser;  

            /* Redirect browser */
            $logger->debug("Result: SUCCESS");
            header("Location: authcheck.php");
            exit();
        } else {

            echo "<script>alert('Invalid Login Credentials');
            window.location.href='authorizer.php';</script>";
            $logger->critical("Trying to login for authorizer: $username $password");

        }

    }else {
        echo "<script>alert('Credential is never registered');
            window.location.href='authorizer.php';</script>";
            $logger->critical("Trying to login for authorizer: $username $password");
    }
} else {
    echo "<script>alert('All fields are required!');
        window.location.href='authorizer.php';</script>";
    $logger->critical("Trying to login for authorizer: $username");
}

?>