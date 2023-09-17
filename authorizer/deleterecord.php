<?php
session_start();
if(!isset($_SESSION['sess_user'])) {
	header('Location:authorizer.php');
}
include '../dbconn.php';
$rowdata = json_decode($_GET['tableData']);
$id = $rowdata[0];

// Instead of deleting, we will update the status in the database
$query = "UPDATE service SET status = 'Hidden' WHERE id='" . $id . "'";
if (mysqli_query($conn, $query)) {
	echo "<script>alert('Hidden Successfully');
	window.location.href='application.php';</script>";
} else {
	echo "<script>alert('Failed to Hide');
	window.location.href='application.php';</script>";
}
?>
