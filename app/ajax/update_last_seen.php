<?php  

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])||isset($_SESSION['sess_user'])) {
	
	# database connection file
	include '../dbconn.php';

	# get the logged in user's username from SESSION
	$id = $_SESSION['user_id'];

	$sql = "UPDATE users
	        SET last_seen = NOW() 
	        WHERE user_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

}else {
	header("Location: ../../index.php");
	exit;
}