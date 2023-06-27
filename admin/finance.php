<?php include '../dbconn.php';
session_start();
if (!isset($_SESSION['sess'])) {
    header('Location:admin.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>HandyEase</title>
    <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />

    <script src="../js/jquery.min.js"></script>

    <link href="../css/newer.css" rel="stylesheet" type="text/css" media="all" />

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

<body>

    <div class="header">
        <div class="container">

        </div>
        <div class="menu-bar">
            <div class="container">
                <div class="top-menu">
                    <ul>
                        <li>
                            <div class="dropdown">
                                <a class="active">View</a>
                                <div class="dropdown-content">
                                    <a href="adminauthcheck.php">View Authoriser</a>
                                    <a href="adminworkcheck.php">View Worker</a>

                                </div>
                            </div>
                        </li>|
                        <li>

                            <a href="add_auth.php">ADD AUTHORIZER</a>
                        </li>|
                        <li>
                            <div class="dropdown">
                                <a class="active">Worker</a>
                                <div class="dropdown-content">
                                    <a href="addworker.php">ADD WORKER</a>
                                    <a href="deletework.php">DELETE WORKER</a>
                                </div>
                            </div>
                        </li>|
                        <li><a class="active" href="finance.php">Finance</a></li>|

                        <div class="clearfix"></div>
                    </ul>
                </div>

                <div class="login-section">
                    <ul>
                        <li><a class="active" href="#">Welcome
                                <?php echo $_SESSION['sess']; ?>
                            </a></li>
                        <li><a class="active" href="adminlogout.php">Logout</a></li>|
                        <li><a class="active" href="dashboard.php">Dashboard</a></li>
                        <li><a href="#"></a> </li>

                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="container">
            <div class="clearfix"></div>
            <div style="width:100%">
                <div style="width: 15%;margin-left:-2em;margin-top: 3em;float: left;font-size: 18px;">
                    <aside class="asideclass">
                        <ul style="list-style-type: none">
                            <h3 style="margin-bottom: 8px;"><strong>Service</strong></h3>
                            <li><input type="radio" class="common_selector service" value="Plumber" name="type" checked>
                                Plumber
                            </li>
                            <li><input type="radio" class="common_selector service" value="Electrician" name="type">
                                Electrician</li>
                            <li><input type="radio" class="common_selector service" value="Carpenter" name="type">
                                Carpenter</li>
                            <li><input type="radio" class="common_selector service" value="AC and Refrigerator"
                                    name="type"> AC & Refrigerator</li>
                            <li><input type="radio" class="common_selector service" value="Washing Machine" name="type">
                                Washing Machine</li>
                        </ul><br><br>

                        <ul style="list-style-type: none">
                            <h3 style="margin-bottom: 8px;"><strong>Area</strong></h3>
                            <li><input type="radio" class="common_selector city" name="city" value="Sumacab" checked>
                                Sumacab
                            </li>
                            <li><input type="radio" class="common_selector city" name="city" value="Palayan City">
                                Palayan
                            </li>
                            <li><input type="radio" class="common_selector city" name="city" value="Gapan City"> Gapan
                            </li>
                            <li><input type="radio" class="common_selector city" name="city" value="San Jose City"> San
                                Jose</li>

                        </ul>
                    </aside>
                </div>
                <div class="wow fadeInDownBig" data-wow-delay="0.4s" style="width: 85%;float: left;">
                    <table id="customers1">
                        <div class="clearfix"></div>
                        <br>
                        <tr>
                            <th>Transaction_no</th>
                            <th>Payer</th>
                            <th>Amount</th>
                            <th>Payee/Worker</th>
                            <th>Worker ID</th>
                            <th>Wage</th>
                            <th>Service</th>
                            <th>Date</th>
                        </tr>
                        <tbody id='tablebody'>

                            <?php
                            /**
                             * start fetching worker table
                             */
                            $query = mysqli_query($conn, "select * from finance");
                            $num_rows = mysqli_num_rows($query);
                            if ($num_rows > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                                    echo "<tr>";
                                    echo "<td>" . $row[0] . "</td>";
                                    echo "<td>" . $row[7] . "</td>";
                                    echo "<td>" . $row[2] . "</td>";
                                    echo "<td>" . $row[8] . "</td>";
                                    echo "<td>" . $row[3] . "</td>";
                                    echo "<td>" . $row[4] . "</td>";
                                    echo "<td>" . $row[6] . "</td>";
                                    echo "<td>" . $row[10] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='8'>No data</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <script>
            $(document).ready(function () {
                // Use change event instead of click event to detect changes in radio buttons
                $('input[name="type"], input[name="city"]').change(function () {
                    var service = $('input[name="type"]:checked').val();
                    var city = $('input[name="city"]:checked').val();
                    $.post("../fetch_data.php", {
                        service: service,
                        city: city
                    }, function (result) {
                        $('#tablebody').html(result);
                        // Display "No data" if result is empty
                        if (result.trim() === '') {
                            $('#tablebody').html("<tr><td colspan='8'>No data</td></tr>");
                        }
                    });
                });
            });
        </script>
</body>

</html>