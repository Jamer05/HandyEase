<?php
include 'dbconn.php';
session_start();
if(!isset($_SESSION['username'])) {
	header('Location:index.php');
}

$rowdata = json_decode($_GET['tableData1']);
$id = $rowdata[0];

// Instead of deleting, we will update the status in the database
$query = "UPDATE service SET status = 'Hidden' WHERE id='" . $id . "'";
if (mysqli_query($conn, $query)) {
	echo "<script>alert('Successfully Cancelled');
	window.location.href='appointment.php';</script>";
} else {
	echo "<script>alert('Failed to Cancel');
	window.location.href='appointment.php';</script>";
}
?>
