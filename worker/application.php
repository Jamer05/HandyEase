<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['sess_user'])) {
    header('Location:worker.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>HandyEase</title>
    <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="../js/jquery.min.js"></script>
    <link href="../css/style_client.css" rel="stylesheet" type="text/css" media="all" />
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
    <script src="../js/wow.min.js"></script>
    <link href="../css/animate.css" rel='stylesheet' type='text/css' />
    <script>
        new WOW().init();
    </script>
    <script type="text/javascript" src="../js/move-top.js"></script>
    <script type="text/javascript" src="../js/easing.js"></script>
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

</head>

<body class="application">


    <nav class="navbar">
        <div class="container">
            <div class="top-menu">
                <ul>
                    <li class="navbar-toggle"><a href="application.php">Application</a></li>
                    <li class="navbar-toggle"><a href="chat_real.php">Chat</a></li>
                    <li class="navbar-toggle"><a href="accepted.php">Accepted</a></li>
                </ul>
            </div>
            <div class="login-section">
                <ul>
                    <ul>
                        <li class="navbar-toggle"><a href="#">Welcome
                                <?php echo $_SESSION['sess_user']; ?>
                            </a></li>
                        <li class="navbar-toggle"><a href="logout.php">Logout</a></li>
                        <li class="navbar-toggle"><a href="#"></a> </li>

                        <div class="clearfix"></div>
                    </ul>
            </div>
            <div class="clearfix"></div>

        </div>
        <div class="clearfix"></div>
    </nav>

    <div class="content">
        <div class="container">
            <div class="scrollme">
                <div class="wow fadeInDownBig" data-wow-delay="0.4s">
                    
                        <table id="customers2" class="table-responsive" align="right">
                            <div class="clearfix"></div>
                            <br>
                            <tr>
                                <th>Customer</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Area</th>
                                <th>Location</th>
                                <th>Assigner</th>
                                <th>Approve</th>
                                <th>Declined</th>


                            </tr>

                            <?php
                            include '../dbconn.php';

                            $user = $_SESSION['sess_user'];
                            // $query = "SELECT * FROM authoriser where username='" . $user . "'";
                            $worker_flag = "SELECT id FROM worker where username ='" . $user . "'";
                            // $result = mysqli_query($conn, $query);
                            $result = mysqli_query($conn, $worker_flag);


                            if (mysqli_num_rows($result) == 1) {
                                $row = mysqli_fetch_array($result);
                                $id = $row[0];
                                $q = "SELECT * FROM customer join service where customer.id=service.id  and (service.aflag = '" . $id . "' and service.status=  'Pending')";
                                $res = mysqli_query($conn, $q);
                                // Flag variable to keep track of rows echoed
                                $rows_echoed = false;

                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_array($res)) {
                                        if ($row[12] == '0') {
                                            echo "<tr id='data'></tr>";
                                            echo "<td  name='fname'>" . $row[1] . "</td>";
                                            echo "<td  name='phone'>" . $row[3] . "</td>";
                                            echo "<td  name='email'>" . $row[4] . "</td>";
                                            echo "<td  name='area'>" . $row[5] . "</td>";
                                            echo "<td  name='location'>" . $row[6] . "</td>";
                                            echo "<td name='worker'>" . $row[13] . "</td>";
                                            if ($row[12] == 0) {
                                                echo "<td><input type='button' value='  Yes  ' onclick='val1()' style='background-color:green;color:white;border-radius:25px;'></td>";
                                            }
                                            echo "<td><input type='button' value='  No  ' onclick='val2()' style='background-color:red;color:white;border-radius:25px;'></td>";
                                            echo "</tr>";
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
        </div>
    </div>

    <script type="text/javascript">
        function val1() {
            var tableData;
            $("tr").click(function () {
                tableData = $(this).children("td").map(function () {
                    return $(this).text();
                }).get();


                tableData = JSON.stringify(tableData);

                window.location.href = 'approved.php';
            });


        }



        function val2() {
            var tableData;
            $("tr").click(function () {
                tableData = $(this).children("td").map(function () {
                    return $(this).text();
                }).get();

                window.location.href = 'decline.php';
            });
        }


        // function refreshTable() {
        //     $.ajax({
        //         url: 'application.php', // Path to the script that retrieves updated data
        //         type: 'POST',
        //         success: function (data) {
        //             $('#data').html(data); // Update the table with the new data
        //         }
        //     });
        // }

        // $(document).ready(function () {
        //     setInterval(refreshTable, 1000); // Refresh the table every second (1000 milliseconds)
        // });

    </script>
 <?php include '../include/footer.php'; ?>

</body>

</html>