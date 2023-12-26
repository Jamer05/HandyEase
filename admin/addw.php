<?php include '../dbconn.php'; ?>
<?php
session_start();
$errors = array();
// receive all input values from the form
$id = mysqli_real_escape_string($conn, $_POST['Id']);
$fname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lname = mysqli_real_escape_string($conn, $_POST['lastname']);
$username = mysqli_real_escape_string($conn, $_POST['worker_username']);
$password = mysqli_real_escape_string($conn, $_POST['worker_password']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$area = mysqli_real_escape_string($conn, $_POST['city']);
$location = mysqli_real_escape_string($conn, $_POST['locality']);
$request = mysqli_real_escape_string($conn, $_POST['selser']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$staff = 'TRUE';

// form validation: ensure that the form is correctly filled
if (empty($fname)) {
	array_push($errors, "Firstname is required");
}
if (empty($lname)) {
	array_push($errors, "Lastname is required");
}
if (empty($phone)) {
	array_push($errors, "Phone Number is required");
}
if (empty($request)) {
	array_push($errors, "Service is required");
}
if (empty($location)) {
	array_push($errors, "City is required");
}
if (empty($area)) {
	array_push($errors, "Locality/Area is required");
}
if (empty($email)) {
	array_push($errors, "Email is required");
}

$adminuser = $_SESSION['sess'];


if (count($errors) == 0) {

	$que = "SELECT * FROM authoriser WHERE location='" . $location . "' and request='" . $request . "'";
	$result = mysqli_query($conn, $que);
	$rows = mysqli_num_rows($result);
	if ($rows == 1) {
		$row = mysqli_fetch_array($result);
		$authid = $row[0];
	}
	/**
	 * start insert data
	 */$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	$query = mysqli_prepare($conn, "INSERT INTO worker (id, firstname, lastname, username, password, phone, profession, authid, area, location, adminuser, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($query, 'ssssssssssss', $id, $fname, $lname, $username, $hashedPassword, $phone, $request, $authid, $area, $location, $adminuser, $email);

	$query_chat = mysqli_prepare($conn, "INSERT INTO users (name, username, password, staff,email) VALUES (?,?, ?, ?, ?)");
	mysqli_stmt_bind_param($query_chat, 'sssss', $fname, $username, $hashedPassword, $staff,$email);

	if (mysqli_stmt_execute($query) && mysqli_stmt_execute($query_chat)) {
		include '../include/success.php';
		echo '<script>added();</script>';
	} else {
		include '../include/warning.php';
		echo '<script>wrong();</script>';
	}

} else {
	include '../include/warning.php';
	echo '<script>showAlert();</script>';
}
mysqli_close($conn);
?>