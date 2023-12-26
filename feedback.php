<?php
include 'dbconn.php';
session_start();
error_reporting(0);

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_GET['feedback']) && !empty($_GET['feedback'])) {
    $feedback = urldecode($_GET['feedback']);
    $user_client = $_SESSION['username'];
    $sql = "UPDATE service SET feedback = ? WHERE username = ? AND transflag = 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $feedback, $user_client);

    if ($stmt->execute()) {
        include 'include/success.php';
        echo '<script>addedFeedback();</script>';
      
    } else {
        echo '<script>alert("Failed to submit feedback.");</script>';
    }

    $stmt->close();
}