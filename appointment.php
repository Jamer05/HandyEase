<?php include 'dbconn.php';
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- <title>HandyEase</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="js/jquery.min.js"></script>
    <link href="css/index.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <link
        href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic'
        rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet'
        type='text/css'>
    <script src="js/wow.min.js"></script>
    <link href="css/animate.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script>
        new WOW().init();
    </script>
    <script src="js/simpleCart.min.js"> </script>
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
    </script> -->

    <title>HandyEase</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="js/jquery.min.js"></script>
    <link href="css/style_test.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script
        type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link
        href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic'
        rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet'
        type='text/css'>
    <script src="js/wow.min.js"></script>
    <link href="css/animate.css" rel='stylesheet' type='text/css' />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        new WOW().init();
    </script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1200);
            });
        });
    </script>
    <script type="text/javascript">
        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
</head>


<body class="application">
    <div class="header">
        <div class="container">
            <div>
                <a href="landpage.php"><img src="images/home1.png" id="homeImage" class="img-responsive" alt="" /></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="menu-bar">
        <div class="container">
            <div class="top-menu">
                <ul>

                    <li><a href="customer.php">Book</a></li>
                    <li><a href="chat_real.php">Chat</a></li>
                    <li><a href="appointment.php">Status</a></li>
                    <li><a href="logout.php">Signout</a></li>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>
                </ul>
            </div>

            <div class="clearfix"></div>

        </div>
        <div class="clearfix"></div>
    </div>

    <div class="content">
        <div class="container">
            <div class="clearfix"></div>
            <div class="wow fadeInDownBig" data-wow-delay="0.4s">
                <div class="table-responsive">
                    <table id="customers2" align="right">
                        <div class="clearfix"></div>
                        <br>
                        <tr>
                            <th>Customer</th>
                            <th>Request</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Worker</th>



                        </tr>

                        <?php
                        include 'dbconn.php';

                        // $user = $_SESSION['sess_user'];
                        $user_client = $_SESSION['username'];
                        // $worker_flag = "SELECT id FROM worker where username ='" . $user . "'";
                        $user_flag = "SELECT username FROM users where username ='" . $user_client . "'";
                        $result = mysqli_query($conn, $user_flag);


                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            
                            $user_name = $row[2];
                            // $q = "SELECT * FROM service join users where service.username = users.username  and (service.status = 'Pending' or service.status = 'Approved' )";
                            $q = "SELECT DISTINCT *
                            FROM service
                            JOIN users ON service.username =users.username
                            JOIN worker ON service.aflag = worker.id
                            WHERE service.status IN ('Pending', 'Approved','Ongoing')
                            AND service.username = '$user_client'";
                            
                            $res = mysqli_query($conn, $q);
                            // Flag variable to keep track of rows echoed
                            $rows_echoed = false;

                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_array($res)) {
                                    if ($row['transflag'] == 0) {
                                        echo "<tr id='data'></tr>";
                                        echo "<td  name='fname'>" . $row[1] . "</td>";
                                        echo "<td  name='phone'>" . $row[2] . "</td>";
                                        echo "<td  name='email'>" . $row[3] . "</td>";
                                        echo "<td  name='area'>" . $row[7] . "</td>";
                                        echo "<td  name='location'>" . $row[16] . "</td>";


                                        $rows_echoed = true; // Set flag to true since a row has been echoed
                                    }
                                }
                            }
                            // If no rows echoed, display "No Data"
                            if (!$rows_echoed) {
                                echo "<tr>";
                                echo "<td colspan='11'>No Data</td>";
                                echo "</tr>";
                            }

                        } else {
                            echo "<tr>";
                            echo "<td colspan='11'>No Data</td>";
                            echo "</tr>";
                        }
                        ?>

                    </table>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>

</body>

</html>