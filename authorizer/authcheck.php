<?php include "../dbconn.php";
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

<body class="authcheck">
    <div class="header">
        <div class="menu-bar">
            <div class="container">

                <div class="navbar-toggle" id="burgerIcon" onclick="toggleMenu()">
                    <div class="burger-bar"></div>
                    <div class="burger-bar"></div>
                    <div class="burger-bar"></div>
                </div>
                <div class="top-menu" id="navbar-links">
                    <ul>
                        <li><a href="application.php">Application</a></li>
                        <li><a href="authcheck.php">View</a></li>
                        <li><a href="authupdate.php">Update Account</a></li>
                        <li><a href="updatework.php">Worker Update</a></li>
                        <li><a class="active" href="finances.php">Finance</a></li>
                    </ul>
                </div>
                <div class="login-section">
                    <ul>
                        <li><a class="active" href="#">Welcome
                                <?php echo $_SESSION['sess_user']; ?>
                            </a></li>
                        <li><a class="active" href="logout.php">Logout</a></li>

                    </ul>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="container">
                <div class="clearfix"></div>
                <div class="table-container">
                    <table class="table-responsive" id="customers2" align="right">
                        <div class="clearfix"></div>
                        <tbody id="table-body">
                            <thread>
                                <br>
                                <h2>Workers</h2>
                                <tr>
                                    <th>Worker_id</th>
                                    <th>First_Name</th>
                                    <th>Last Name</th>
                                    <th>Phone Number</th>
                                    <th>Profession</th>
                                    <th>Area</th>
                                    <th>Location</th>
                                    <th>Update</th>
                                </tr>

                                <?php

                                $user = $_SESSION['sess_user'];
                                $query = "SELECT * FROM authoriser where username='" . $user . "'";
                                $result = mysqli_query($conn, $query);
                                if (mysqli_num_rows($result) == 1) {
                                    $row = mysqli_fetch_array($result);
                                    $id = $row[0];
                                    $q = "SELECT * FROM worker where authid='" . $id . "'";
                                    $res = mysqli_query($conn, $q);

                                    if (mysqli_num_rows($res) > 0) {
                                        while ($row = mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>" . $row[0] . "</td>";
                                            echo "<td>" . $row[1] . "</td>";
                                            echo "<td>" . $row[2] . "</td>";
                                            echo "<td>" . $row[5] . "</td>";
                                            echo "<td>" . $row[6] . "</td>";
                                            echo "<td>" . $row[10] . "</td>";
                                            echo "<td>" . $row[9] . "</td>";
                                            echo '<td><input type="button" value="Alter" id="button" onclick="wid(\'' . $row[0] . '\')" style="background-color:green;color:white;border-radius:25px;"></td>';

                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No data</td></tr>"; // Display "No data" message
                                    }
                                }
                                ?>
                            </thread>
                    </table>
                </div>
            </div>

            <div class="clearfix"></div>


            <style>
                h2 {
                    color: black;
                    font-size: 40px;
                    text-align: center;
                    margin-bottom: 10px;
                }

                .burger-bar {
                    width: 30px;
                    height: 3px;
                    background-color: #fff;
                    margin: 6px 0;
                    border-radius: 2px;
                    cursor: pointer;
                    transition: 0.4s;
                }

                .drawer {
                    position: fixed;
                    top: 0;
                    left: -250px;
                    /* Initially hidden on wider screens */
                    width: 250px;
                    height: 100%;
                    background-color: #222;
                    z-index: 1000;
                    overflow-y: auto;
                    transition: 0.3s;
                }

                .menu-items {
                    padding: 20px 0;
                }

                .menu-items ul {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }

                .menu-items li {
                    margin: 10px 0;
                }

                .menu-items a {
                    text-decoration: none;
                    color: #fff;
                    font-size: 18px;
                    display: block;
                    padding: 10px;
                    transition: 0.3s;
                }

                .menu-items a:hover {
                    background-color: #333;
                    border-left: 3px solid #00ff00;
                    /* Add a left border for better style */
                }

                .close-drawer {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    font-size: 24px;
                    cursor: pointer;
                }

                .close-drawer span {
                    color: #fff;
                }

                @media (max-width: 650px) {
                    .navbar-toggle.active+#menu-drawer {
                        left: 0;
                    }

                    .navbar-toggle.active .burger-bar {
                        background-color: transparent;
                    }

                    .navbar-toggle.active .burger-bar::before,
                    .navbar-toggle.active .burger-bar::after {
                        top: 0;
                        transform: rotate(45deg);
                    }

                    .navbar-toggle.active .burger-bar::after {
                        transform: rotate(-45deg);
                    }

                    .top-menu,
                    .login-section {
                        display: none;
                    }
                }

                @media (min-width: 651px) {
                    .drawer {
                        left: 0;
                    }

                    .navbar-toggle {
                        display: none;
                    }
                }
            </style>
            <script>

                function wid(workerId) {

                    console.log("Worker ID selected: " + workerId);
                    // Redirect to updatework.php with the worker ID as a parameter
                    window.location.href = 'updatework.php?workerId=' + workerId;
                }

                function toggleMenu() {
                    const menuDrawer = document.getElementById('menu-drawer');
                    if (window.innerWidth <= 650) {
                        if (menuDrawer.style.left === '0px' || menuDrawer.style.left === '') {
                            menuDrawer.style.left = '-250px';
                        } else {
                            menuDrawer.style.left = '0';
                        }
                    } else {
                        // Hide the menu drawer on wider screens
                        menuDrawer.style.left = '-250px';
                    }
                }
                function hideMenuDrawerOnWideScreen() {
                    const menuDrawer = document.getElementById('menu-drawer');
                    const screenWidth = window.innerWidth;

                    if (screenWidth > 650) {
                        menuDrawer.style.left = '-250px';
                    }
                }

                // Call the function when the page loads and when the window resizes
                window.addEventListener('load', hideMenuDrawerOnWideScreen);
                window.addEventListener('resize', hideMenuDrawerOnWideScreen);

            </script>
        </div>
    </div>
</body>

</html>