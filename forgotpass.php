<!DOCTYPE html>
<html>

<head>
    <title>HOME SERVICE PROVIDER</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Custom Theme files -->

    <link href="css/index.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom Theme files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!--webfont-->
    <link
        href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic'
        rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet'
        type='text/css'>
    <!--Animation-->
    <script src="js/wow.min.js"></script>
    <link href="css/animate.css" rel='stylesheet' type='text/css' />
    <script>
        new WOW().init();
    </script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1200);
            });
        });
    </script>
    <script src="js/simpleCart.min.js"> </script>
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="top-header">
                <div class="logo">
                    <a href="index.php"><img src="" class="img-responsive" alt="" /></a>
                </div><br>
                <div>
                    <a href="index.php"><img src="images/home.png" class="img-responsive" alt="" /></a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        |
                        <li><a href="customer.php">CUSTOMER</a></li>
                        |
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="login-section">
                    <ul>
                        <li><a class="active" href="authorizer.php">Authorizer Login</a> </li>
                        |
                        <li><a href="admin.php">Admin Login</a> </li>
                        |
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <div class="login-page">
                <div class="account_grid">
                    <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
                        <h3>Want to be a part of our community?</h3>
                        <p><b>Whether you want to become authorizer,worker or even admin <br>for any of these Contact
                                Admin.<b></p>
                        <div>
                            <i class="fa fa-user" style="font-size:200px; color:#5bbd50; margin-left: 0.5em;"></i>
                        </div>
                        <div class="clearfix"> </div>
                        <a class="acount-btn" href="team/index.html"><b>Contact</b></a>
                    </div>
                    <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
                        <form id="myForm" action="forgotpass.php" method="post">
                            <div>
                                <span>Username<label>*</label></span>
                                <input type="text" name="username">
                            </div>
                            <div>
                                <span>OTP<label>*</label></span>
                                <input type="text" name="otp" id="otpInput" title="See the OTP through your Gmail">

                            </div>
                            <div>
                                <span>New Password<label>*</label></span>
                                <input type="password" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            </div>
                            <div>
                                <span>Confirm Password<label>*</label></span>
                                <input type="password" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            </div>

                            <input type="submit" name="sub" value="Submit">
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="container">
                <p class="wow fadeInLeft" data-wow-delay="0.4s">&copy; Designed by &nbsp;<a href="team/index.html">OMSIM
                        BARABIDA</a></p>
            </div>
        </div>
        <!-- footer-section-ends -->
        <script type="text/javascript">
            $(document).ready(function () {
                $().UItoTop({
                    easingType: 'easeOutQuart'
                });

            });
        </script>
        <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

</body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include 'dbconn.php';

if (isset($_POST['sub_otp'])) {
    $username = $_POST['username'];

    // Check if username is empty
} elseif (!empty($username)) {
    $stmt = $conn->prepare("SELECT email FROM authoriser WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    // Generate random OTP
    $otp = mt_rand(1000000, 9999999);
    $hashed_otp = password_hash($otp_string, PASSWORD_DEFAULT);
    // Store OTP in database
    $stmt = $conn->prepare("UPDATE authoriser SET otp = ? WHERE username = ?");
    $stmt->bind_param("ss", $hashed_otp, $username);
    if ($stmt->execute()) {
        $stmt->close();

        try {
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            // Server settings
            $mail->SMTPDebug = 0; // Set to 2 for debugging
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
            $mail->Subject = 'Password Recovery OTP';
            $mail->Body = 'Your OTP for password recovery is: ' . $otp . '<br><br>';
            $mail->Body .= 'Please use this OTP to reset your password.';

            $mail->send(); // Send the email

            echo "<script>alert('OTP has been sent to your email address for password recovery. Please check your inbox.');
             window.location.href='forgotpass.php';</script>";
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        }
    } else {
        $stmt->close();
        echo "<script>alert('Failed to Change');</script>";
    }
}
if (isset($_POST['sub'])) {
    if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
        $username = $_POST['username'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        if ($pass1 == $pass2) {
            // Validate OTP
            if (!empty($_POST['otp'])) {
                $otp = $_POST['otp'];

                // Check OTP in database
                $stmt = $conn->prepare("SELECT * FROM authoriser WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $storedOTP = $row['otp'];
                $hashed_otp = $_POST['otp'];


                // Hash user inputted OTP and compare with stored hashed OTP
                if (password_verify($hashed_otp, $storedOTP)) {
                    // OTP is correct
                    // Hash the password and update the database
                    $hashedPassword = password_hash($pass1, PASSWORD_DEFAULT);

                    $query = "UPDATE authoriser SET password = ? WHERE username = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ss", $hashedPassword, $username);
                    if ($stmt->execute()) {
                        $stmt->close();
                        echo "<script>alert('Changed Successfully');
                                window.location.href='authorizer/authorizer.php';
                                </script>"; // Redirect to login page after successful password change
                    } else {
                        $stmt->close();
                        echo "<script>alert('Failed to Change');</script>";
                    }
                } else {
                    echo "<script>alert('Invalid OTP. Please try again.');</script>";
                }
            } else {
                echo "<script>alert('Please enter OTP.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all the required fields.');</script>";
    }
}
?>

</html>