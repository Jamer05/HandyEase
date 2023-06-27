<?php
require '../dbconn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['sub'])) {
	if ($_POST['worker'] != 'None') {
		$value = $_POST['worker'];
		$query = "UPDATE service set aflag='" . $value . "' where id='" . $_POST['cid'] . "'";
		if (mysqli_query($conn, $query)) {

			$q = "SELECT * FROM customer where id='" . $_POST['cid'] . "'";
			$row = mysqli_fetch_array(mysqli_query($conn, $q));
			$qu = "SELECT * FROM worker where id='" . $value . "'";
			$result = mysqli_fetch_array(mysqli_query($conn, $qu));

			$to = $row[4];
			$location = $row[6];
			$area = $row[5];

			$worker_fname = $result[1];
			$worker_lname = $result[2];
			$worker_phone = $result[5];
			$worker_email = $result[11];
			$worker_area = $result[10];
			//send email with PHPMail

			$mail = new PHPMailer(true);
			try {
				$mail->SMTPDebug = 0;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'jamerkelly0988@gmail.com';
				$mail->Password = 'wqdoherlodlpaftn';
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;

				// Recipients
				$mail->setFrom('noreply@gmail.com', 'Handyease');
				$mail->addAddress($to);

				// Content
				$mail->isHTML(true);
				$mail->Subject = '=?utf-8?B?' . base64_encode('Request has been verified') . '?=';

				$imagePath = '../images/wait.jpg'; // Path to the image file
				$imageData = file_get_contents($imagePath); // Read image data
				$imageDataEncoded = base64_encode($imageData); // Encode image data in base64


				$mail->Body = 'Your request  in ' . $location . ' , <strong>' . $area . '</strong> has been <strong>VERIFIED</strong>. <br><strong>Status: </strong>Worker has been assigned to your Area.<br>'; // Set the body of the email
				$mail->Body .= '<br><img src="data:image/jpeg;base64,' . $imageDataEncoded . '" alt="Image">'; // Add the image as inline data in the email body
				$mail->send(); // Send the email

			} catch (Exception $e) {
				echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}
			include '../include/success.php';
			echo '<script>assign();</script>';
		} else {
			echo "<script>
			 alert('Not Assigned.Please check your Server');
			 window.location.href='application.php';
			 </script>";
		}
	} else {
		echo "<script>
			 alert('Worker Not Selected');
			 window.history.back();
			 </script>";
	}
}
?>