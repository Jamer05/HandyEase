<?php include 'dbconn.php'; ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'vendor/autoload.php'; // Load Monolog library

$logger = new Logger('app_logger');
$logger->pushHandler(new StreamHandler(__DIR__ . '/act.log', Logger::DEBUG));


$errors = array();
// receive all input values from the form
$id = mysqli_real_escape_string($conn, $_POST['Id']);
$fname = mysqli_real_escape_string($conn, $_POST['Username']);
$lname = mysqli_real_escape_string($conn, $_POST['Name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$area = mysqli_real_escape_string($conn, $_POST['city']);
$location = mysqli_real_escape_string($conn, $_POST['locality']);
$request = mysqli_real_escape_string($conn, $_POST['selser']);
$dateofreq = mysqli_real_escape_string($conn, date("Y-m-d"));
$price = mysqli_real_escape_string($conn, $_POST['price']);
$aflag = 0;
$transflag = 0;
$status = 'Ongoing';
$logger->alert("Trying to book: $fname");
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
  array_push($errors, "Location is required");
}
if (empty($email)) {
  array_push($errors, "Email is required");
}
if (empty($area)) {
  array_push($errors, "Locality/Area is required");
}

if (count($errors) == 0) {
  $query = "SELECT * FROM authoriser where location='" . $location . "' and request='" . $request . "'";
  $result = mysqli_query($conn, $query);
  $numrows = mysqli_num_rows($result);
  if ($numrows == 1) {
    $row = mysqli_fetch_array($result);
    $authid = $row[0];
  }
  $query = mysqli_prepare($conn, "INSERT INTO customer (id,firstname,lastname,phone,email,area,city) VALUES (?,?,?,?,?,?,?)");
  mysqli_stmt_bind_param($query, 'sssssss', $id, $fname, $lname, $phone, $email, $area, $location);

  $query1 = mysqli_prepare($conn, "INSERT INTO service (id,username,request,dateofreq,authid,aflag,transflag,status) VALUES (?,?,?,?,?,?,?,?)");
  mysqli_stmt_bind_param($query1, 'ssssssis', $id,$fname, $request, $dateofreq, $authid, $aflag, $transflag, $status);
  //if authid is empty don't let customer book
  if (empty($authid)) {
    $logger->error("No authoriser found for $location");
    include 'include/warning.php';
    echo '<script>unavailableService();</script>';
  } else {
    if (mysqli_stmt_execute($query) && mysqli_stmt_execute($query1)) {
      mysqli_stmt_close($query);
      mysqli_stmt_close($query1);

      // Send email notification
      $mail = new PHPMailer(true);
      try {

        // Server settings
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
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = '=?utf-8?B?' . base64_encode('Pending Request') . '?=';

        $imagePath = 'images/pending.jpg'; // Path to the image file
        $imageData = file_get_contents($imagePath); // Read image data
        $imageDataEncoded = base64_encode($imageData); // Encode image data in base64

        $mail->Body = 'Your request for ' . $request . ' at ' . $location . ' in ' . $area . ' is pending.'; // Set the body of the email
        $mail->Body .= '<br><img src="data:image/jpeg;base64,' . $imageDataEncoded . '" alt="Image">'; // Add the image as inline data in the email body
        $mail->send(); // Send the email

        $query = mysqli_prepare($conn, "INSERT INTO customer (id,firstname,lastname,phone,email,area,city) VALUES (?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($query, 'sssssss', $id, $fname, $lname, $phone, $email, $area, $location);

        $query1 = mysqli_prepare($conn, "INSERT INTO service (id,request,dateofreq,authid,aflag,transflag) VALUES (?,?,?,?,?,?)");
        mysqli_stmt_bind_param($query1, 'sssssi', $id, $request, $dateofreq, $authid, $aflag, $transflag);
        //logssssss
        $logger->debug("Result: SUCCESS");
        $logger->debug('Request submitted', array('id' => $id, 'firstname' => $fname, 'lastname' => $lname, 'phone' => $phone, 'email' => $email, 'area' => $area, 'city' => $location, 'request' => $request, 'dateofreq' => $dateofreq, 'authid' => $authid, 'aflag' => $aflag, 'transflag' => $transflag));
        include 'include/success.php';
        echo '<script>showAlert();</script>';
        mysqli_stmt_execute($query);
        mysqli_stmt_execute($query1);

        mysqli_stmt_close($query);
        mysqli_stmt_close($query1);
        // Log a message when a request is received
      } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
      }
      // Perform other database operations and redirects here
      // ...
    } else {
      echo "No record found for the requested service at the specified location.";
    }
  }
} else {
  include 'include/warning.php';
  echo '<script>showAlert1();</script>';

}
mysqli_close($conn);
?>