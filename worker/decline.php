<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header('Location:worker.php');
}

include '../dbconn.php';


$user = $_SESSION['username'];
$worker_flag = "SELECT id FROM worker where username ='" . $user . "'";
$result = mysqli_query($conn, $worker_flag);

if (mysqli_num_rows($result) == 1) {
    $wor = mysqli_fetch_array($result);
    $id = $wor[0];
    $q1 = "SELECT * FROM customer join service where customer.id=service.id  and (service.aflag=  '" . $id . "' and status = 'Pending')";
    $row = mysqli_fetch_array(mysqli_query($conn, $q1));
    $t = "UPDATE service SET aflag= '0' WHERE id='" . $row[0] . "'";
    mysqli_query($conn, $t);
    include '../include/success.php';
    echo '<script>decline();</script>';
    }


?>