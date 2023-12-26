<?php
//  session_start();
// if(!isset($_SESSION['sess_user'])) {
// 	header('Location:authorizer.php');
// }
// include '../dbconn.php';
// $rowdata = json_decode($_GET['tableData']);
// $id = $rowdata[0];

// // Instead of deleting, we will update the status in the database
// $query = "UPDATE service SET status = 'Hidden' WHERE id='" . $id . "'";
// if (mysqli_query($conn, $query)) {
// 	echo "<script>alert('ARCHIVE Successfully');
// 	window.location.href='application.php';</script>";
// } else {
// 	echo "<script>alert('Failed to Hide');
// 	window.location.href='application.php';</script>";
//}
session_start();
error_reporting(0);
if (!isset($_SESSION['sess_user'])) {
	header('Location: authorizer.php');
}

include '../dbconn.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$reason = $_GET['reason'];
$user = $_SESSION['sess_user'];
$auth_flag = "SELECT id FROM authoriser where username ='" . $user . "'";
$result = mysqli_query($conn, $auth_flag);

if (mysqli_num_rows($result) == 1) {
	$wor = mysqli_fetch_array($result);
	$id = $wor[0];
	$q1 = "SELECT * FROM customer join service where customer.id=service.id  and (service.authid=  '" . $id . "' and status = 'Pending')";
	$row = mysqli_fetch_array(mysqli_query($conn, $q1));
	// Instead of deleting, we will update the status in the database
	$query = "UPDATE service SET status = 'Hidden' WHERE id = '" . $row[0] . "'";

	if (mysqli_query($conn, $query)) {
		// Send email to notify the customer about the archiving
		try {
			$to = $row[4];
			$mail = new PHPMailer(true);

			$mail->SMTPDebug = 0;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'jamerkelly0988@gmail.com'; // Replace with your Gmail email
			$mail->Password = 'wqdoherlodlpaftn'; // Replace with your Gmail password
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;

			$mail->setFrom('noreply@gmail.com', 'Handyease');
			$mail->addAddress($to);

			$mail->isHTML(true);
			$mail->Subject = '=?utf-8?B?' . base64_encode('Request Declined') . '?=';

			// You can customize the email body as per your needs
			$mail->Body = 'Your request in ' . $row[6] . ', ' . $row[5] . ' has been declined by Operator. Reason: ' . $reason;

			$mail->send();
		} catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}

		include '../include/success.php';
		echo '<script>decline();</script>';
	} else {
		echo "<script>alert('Failed to Archive');
        window.location.href='application.php';</script>";
	}
}

?>