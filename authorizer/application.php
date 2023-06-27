<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['sess_user'])) {
    header('Location:authorizer.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>HandyEase</title>
    <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />

    <script src="../js/jquery.min.js"></script>

    <link href="../css/style_test.css" rel="stylesheet" type="text/css" media="all" />

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

    <div class="header">
        <div class="container">
        </div>
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li><a href="application.php">APPlication</a></li>|
                        <li><a href="authcheck.php">view</a></li>|
                        <li><a href="authupdate.php">Update Account</a></li>|
                        <li><a href="updatework.php">Worker Update</a></li>|
                        <li><a class="active" href="finances.php">Finance</a></li>|
                        <li><a  href="chat_real.php">chat</a></li>|

                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="login-section">
                    <ul>
                        <li><a class="active" href="#">Welcome
                                <?php echo $_SESSION['sess_user']; ?>
                            </a></li>
                        <li><a class="active" href="logout.php">Logout</a></li>
                        <li><a href="#"></a> </li>

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
                            <th>Customer Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Area</th>
                            <th>Location</th>
                            <th>Request</th>
                            <th>Worker</th>
                            <th>Transaction</th>
                            <th>Delete</th>
                        </tr>

                        <?php
                        include '../dbconn.php';

                        $user = $_SESSION['sess_user'];
                        $query = "SELECT * FROM authoriser where username='" . $user . "'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $id = $row[0];
                            $q = "SELECT * FROM customer join service where customer.id=service.id and service.authid='" . $id . "' and (service.aflag=0 or service.transflag=0)";
                            $res = mysqli_query($conn, $q);

                            // Flag variable to keep track of rows echoed
                            $rows_echoed = false;

                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_array($res)) {
                                    if ($row[10] == '0' || $row[11] == 0) {
                                        echo "<tr id'data'></tr>";
                                        echo "<td  name='cid'>" . $row[0] . "</td>";
                                        echo "<td  name='fname'>" . $row[1] . "</td>";
                                        echo "<td  name='lname'>" . $row[2] . "</td>";
                                        echo "<td  name='phone'>" . $row[3] . "</td>";
                                        echo "<td  name='email'>" . $row[4] . "</td>";
                                        echo "<td  name='area'>" . $row[5] . "</td>";
                                        echo "<td  name='location'>" . $row[6] . "</td>";
                                        echo "<td  name='service'>" . $row[8] . "</td>";

                                        if ($row[10] == 0) {
                                            echo "<td><input type='button' value='Assign' id = 'button' onclick='val1()' style='background-color:green;color:white;border-radius:25px;'></td>";
                                            $t = "UPDATE service SET status= 'Pending' WHERE id='" . $row[0] . "'";
                                            mysqli_query($conn, $t);
                                        } else
                                            echo "<td name='worker'>" . $row[13] . "</td>";
                                        if ($row[11] == 0) {
                                            echo "<td><input type='button' value='Enter' id = 'button'  onclick='val2()' style='background-color:green;color:white;border-radius:25px;'></td>";
                                        }
                                        echo "<td><input type='button' value='Delete'  id = 'button'  onclick='val3()' style='background-color:red;color:white;border-radius:25px;'></td>";
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
                <div class="clearfix"></div>
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

                window.location.href = 'status.php?tableData=' + tableData;
            });


        }

        function val2() {
            var tableData;
            $("tr").click(function () {
                tableData = $(this).children("td").map(function () {
                    return $(this).text();
                }).get();


                tableData = JSON.stringify(tableData);
                //$.post('status.php', {'tableData':tableData}, function(response) {
                //});

                window.location.href = 'transaction.php?tableData=' + tableData;
            });
        }

        function val3() {
            var tableData;
            $("tr").click(function () {
                tableData = $(this).children("td").map(function () {
                    return $(this).text();
                }).get();


                tableData = JSON.stringify(tableData);

                window.location.href = 'deleterecord.php?tableData=' + tableData;
            });
        }


        // function refreshTable() {
        //     $.ajax({
        //         url: 'application.php', // Path to the script that retrieves updated data
        //         type: 'POST',
        //         success: function (data) {
        //             $('#button').html(data); // Update the table with the new data
        //         }
        //     });
        // }

        // $(document).ready(function () {
        //     setInterval(refreshTable, 10000); // Refresh the table every second (1000 milliseconds)
        // });

    </script>


</body>

</html>