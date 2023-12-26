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
    <!-- Add these links in your HTML head section -->


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
    <script type="text/javascript" src="../js/easings.js"></script>
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
    <div class='drawer' id='menu-drawer'>
        <div class='close-drawer' onclick='toggleMenu()'>
            <span>&times;</span>
        </div>
        <div class='menu-items'>
            <ul>
                <li><a href='application.php'>Application</a></li>
                <li><a href='authcheck.php'>View</a></li>
                <li><a href='authupdate.php'>Update Account</a></li>
                <li><a href='updatework.php'>Worker Update</a></li>
                <li><a class='active' href='finances.php'>Finance</a></li>
                <li><a href='logout.php'>Logout</a></li>

            </ul>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Enter your reason for declining:</p>
            <input type="text" id="reasonInput" placeholder="Reason">
            <button onclick="submitDeclineReason()">Submit</button>

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
                            <h2>Manage Request</h2>
                            <tr>
                                <th>Display Name</th>
                                <th>Reference ID</th>
                                <th>Email</th>
                                <th>Area</th>
                                <th>Location</th>
                                <th>Fee</th>
                                <th>Request</th>
                                <th>Worker</th>
                                <th>Transaction</th>
                                <th>Details</th>
                                <th>Reject</th>
                            </tr>
                        </thread>

                        <?php
                        include '../dbconn.php';

                        $user = $_SESSION['sess_user'];
                        $query = "SELECT * FROM authoriser where username='" . $user . "'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result);
                            $id = $row[0];
                            $q = "SELECT * FROM customer join service where customer.id=service.id and service.authid='" . $id . "' and (service.status='Pending' or service.status='Ongoing' or service.status='0'  or service.status='Approved' and (service.aflag=0  or  service.transflag=0))";

                            $res = mysqli_query($conn, $q);

                            $html = ''; // Initialize HTML content
                        
                            if (mysqli_num_rows($res) > 0) {
                                while ($row = mysqli_fetch_array($res)) {
                                    if ($row[11] == '0' || $row[12] == 0) {
                                        $html .= '<tr>';
                                        $html .= '<td name="cid" style="display:none;">' . $row[0] . '</td>';
                                        $html .= '<td name="fname">' . $row[1] . ' ' . $row[2] . '</td>';
                                        $html .= '<td name="phone">' . $row[0] . '</td>';
                                        $html .= '<td name="email">' . $row[4] . '</td>';
                                        $html .= '<td name="area">' . $row[5] . '</td>';
                                        $html .= '<td name="location">' . $row[6] . '</td>';
                                        $html .= '<td name="service">₱' . $row[15] . '</td>';
                                        $html .= '<td name="status">' . $row[9] . '</td>';

                                        if ($row[11] == 0) {
                                            $html .= '<td><input type="button" value="Assign" id="button" onclick="val1()" style="background-color:green;color:white;border-radius:25px;"></td>';
                                            $t = "UPDATE service SET status = 'Pending' WHERE id = '" . $row[0] . "'";
                                            mysqli_query($conn, $t);
                                        } else {
                                            $html .= '<td name="worker">' . $row[14] . '</td>';
                                        }

                                        if ($row[14] == 'Approved') {
                                            $html .= '<td><input type="button" value="Enter" id="button"  onclick="val2()" style="background-color:green;color:white;border-radius:25px;"></td>';
                                        }
                                        else{
                                            $html .= '<td>Unable</td>';
                                        }

                                        $html .= '<td><input type="button" value="Details" id="button" onclick="val4()" style="background-color:silver;color:black;border-radius:25px;"></td>';

                                        if ($row[14] == 'Approved') {
                                            $html .= '<td>Unable</td>';
                                        } else {
                                            $html .= '<td><input type="button" value="Decline" id="button" onclick="confirmDecline()" style="background-color:red;color:white;border-radius:25px;"></td>';
                                        }

                                        $html .= '</tr>';
                                    }
                                }
                            }

                            // If no rows echoed, display "No Data"
                            if (empty($html)) {
                                $html = '<tr><td colspan="11">No Data</td></tr>';
                            }

                            echo $html; // Return the HTML content to the client
                        } else {
                            echo '<tr><td colspan="11">No Data</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    </div>

    <div class="dialog-box" id="customDialog" style="display: none;">
        <div class="dialog-content">
            <span class="close" onclick="closeDialog()">&times;</span>
            <h2>Details</h2>
            <p id="dialogContent">This is the content of the dialog box.</p>

        </div>
    </div>

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
                left: -250px;
                /* Hide the drawer on wider screens */
            }

            .navbar-toggle {
                display: none;
                /* Hide the burger icon on wider screens */
            }

            @media (max-width: 650px) {

                /* Additional styles for mobile view */
                .modal-content {
                    width: 80%;
                    margin: 10% auto;
                    background-color: #fff;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    padding: 20px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                }

                .modal-content button {
                    background-color: red;
                    color: white;
                    border: none;
                    border-radius: 25px;
                    padding: 10px 20px;
                    cursor: pointer;
                }
            }

            @media (max-width: 650px) {

                /* Center the modal */
                .modal-content {
                    margin: 15% auto;
                }

                /* Styles for buttons in mobile view */
                input[type="button"] {
                    display: block;
                    margin: 10px auto;
                }
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 60%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 24px;
                font-weight: bold;
                cursor: pointer;
            }

            /* Input and button styles */
            input[type="text"] {
                width: 100%;
                padding: 10px;
                margin: 8px 0;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            button {
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                cursor: pointer;
            }

            button:hover {
                background-color: #45a049;
            }
        }
    </style>
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
        // Function to open the modal dialog
        function openModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

        // Function to close the modal dialog
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";

        }

        // Function to handle submitting the decline reason
        function submitDeclineReason() {
            var reason = document.getElementById("reasonInput").value;

            // Encode the reason to make it safe for the URL
            var encodedReason = encodeURIComponent(reason);

            // Redirect to decline.php with the reason as a query parameter
            window.location.href = 'deleterecord.php?reason=' + encodedReason;
        }


        function submitDeclineReason() {
            var reason = document.getElementById("reasonInput").value;

            if (reason.trim() === "") {
                alert("Please provide a reason for declining.");
            } else {
                var encodedReason = encodeURIComponent(reason);
                window.location.href = 'deleterecord.php?reason=' + encodedReason;
            }
        }


        function confirmDecline() {
            if (confirm("Are you sure you want to decline this request?")) {
                openModal(); // Open the reason input modal if confirmed
            }
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
        } function val4() {
            var tableData;
            $("tr").click(function () {
                tableData = $(this).children("td").map(function () {
                    return $(this).text();
                }).get();

                tableData = JSON.stringify(tableData);

                // Set the dialog content to indicate loading
                document.getElementById("dialogContent").textContent = 'Loading...';

                // Display the custom dialog box
                document.getElementById("customDialog").style.display = "block";

                $.ajax({
                    url: 'fetch_service_data.php',
                    method: 'GET',
                    data: { tableData: tableData },
                    dataType: 'json',
                    success: function (data) {
                        if (data !== null) {
                            if (data.error) {
                                document.getElementById("dialogContent").textContent = 'Error: ' + data.error;
                            } if (data.types !== null) {
                                document.getElementById("dialogContent").innerHTML = 'Service Type: ' + data.types + '<br>';
                            }

                            if (data.dateofreq !== null) {
                                document.getElementById("dialogContent").innerHTML += 'Date: ' + data.dateofreq + '<br>';
                            }

                            if (data.brand !== null) {
                                document.getElementById("dialogContent").innerHTML += 'Brand: ' + data.brand + '<br>';
                            }

                            if (data.technology !== null) {
                                document.getElementById("dialogContent").innerHTML += 'Technology: ' + data.technology + '<br>';
                            }

                            if (data.info !== null) {
                                document.getElementById("dialogContent").innerHTML += 'Thoughts: ' + data.info;
                            }

                            // If all fields are null, you can set a default message
                            if (
                                data.types === null &&
                                data.dateofreq === null &&
                                data.brand === null &&
                                data.technology === null &&
                                data.info === null
                            ) {
                                document.getElementById("dialogContent").innerHTML = 'Data not available';
                            }

                        } else {
                            document.getElementById("dialogContent").textContent = 'Data is null or undefined';
                        }
                    },
                    error: function () {
                        document.getElementById("dialogContent").textContent = 'Error occurred while fetching service data';
                    }
                });
            });
        }

        function closeDialog() {
            // Close the custom dialog box
            document.getElementById("customDialog").style.display = "none";
        }
        function toggleMenu() {
            if (window.innerWidth <= 650) {
                const menuDrawer = document.getElementById('menu-drawer');
                if (menuDrawer.style.left === '0px' || menuDrawer.style.left === '') {
                    menuDrawer.style.left = '-250px';
                } else {
                    menuDrawer.style.left = '0';
                }
            }
        }
        if (window.innerWidth > 650) {
            menuDrawer.style.display = 'none';
        }

        // Refresh the table content with new data from the server
        // function refreshTable() {
        //     $.ajax({
        //         url: 'application.php', // Replace with the URL that returns the updated data
        //         method: 'GET',
        //         success: function (data) {
        //             $('#table-body').html(data);
        //         },
        //         error: function (xhr, status, error) {
        //             console.log('Error refreshing table: ' + error);
        //         }
        //     });
        // }

        // $(document).ready(function () {
        //     refreshTable(); // Initial table refresh when the page loads

        //     // Set an interval to refresh the table every 10 seconds (adjust the interval as needed)
        //     setInterval(refreshTable, 10000); // 10 seconds (10000 milliseconds)
        // });

    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <style>
        .dialog-box {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dialog-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        .dialog-content h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .dialog-content p {
            font-size: 16px;
            color: #333;
        }

        /* You can further customize the design to your liking. */
    </style>
</body>

</html>