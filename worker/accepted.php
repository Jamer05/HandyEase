<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['sess_user'])) {
    header('Location:worker.php');
}
$currentPage = basename($_SERVER['PHP_SELF']);
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

    <style>
        /* add some design of h2 */
        h2 {

            font-size: 30px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            position: relative;
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #75FF33;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .menu-items .active {
            color: green;
            /* Change the color to your desired highlight color */
        }

        .rounded-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: chartreuse;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 100px;
            margin: 0 auto;
            margin-top: 10rem;
            display: none;
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

            .rounded-button {
                display: block;
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
</head>

<body class="application">

    <div class='navbar'>
        <div class='container'>
            <div class='navbar-toggle' id='burgerIcon' onclick='toggleMenu()'>
                <div class='burger-bar'></div>
                <div class='burger-bar'></div>
                <div class='burger-bar'></div>
            </div>
            <div class='container'>
                <div class='top-menu' id='navbar-links'>
                    <ul>
                        <li><a href='application.php'>Application</a></li>
                        <li><a href='chat_real.php'>Chat</a></li>
                        <li><a href='accepted.php'>Accepted</a></li>
                    </ul>
                </div>
                <div class='login-section'>
                    <ul>
                        <li>Welcome
                            <?php echo $_SESSION['sess_user']; ?>
                        </li>
                        <li><a href='logout.php'>Logout</a></li>

                        <li><!-- Rounded switch -->
                            <label class="switch">
                                <input type="checkbox" id="toggleSwitch" data-active="<?php echo $activeStatus; ?>">

                                <span class="slider round"></span>
                            </label>
                        </li>
                        <span>
                            <b>Status</b>
                            <div id="statusText"></div>
                        </span>
                    </ul>
                </div>
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
                <li><a href='chat_real.php'>Chat</a></li>
                <li><a href='accepted.php'>Accepted</a></li>
                <li><a href='logout.php'>Logout</a></li>
                <li><a <?php if ($currentPage == 'active.php')
                    echo 'class="active"'; ?> href='active.php'>Status</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="clearfix"></div>
            <div class="table-container">
                <table class="table-responsive" id="customers2" align="right">
                    <div class="clearfix"></div>
                    <tbody id="table-body">
                        <div class="clearfix"></div>
                        <br>
                        <h2>Accepted Request</h2>
                        <tr>
                            <th>Customer</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Area</th>
                            <th>Location</th>
                            <th>Assigner</th>
                            <th>Mark as Done</th>
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
                            // $q = "SELECT * FROM customer join service where customer.id=service.id  and (service.aflag = '" . $id . "' and service.status=  'Approved')";
                            $q = "SELECT customer.*, service.*, worker.active
                            FROM customer
                            JOIN service ON customer.id = service.id
                            LEFT JOIN worker ON customer.id = worker.id
                            WHERE service.aflag = '" . $id . "'
                            AND service.status = 'Approved'";
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
                                        echo "<td name='Assigner'>" . $row[13] . "</td>";
                                        echo "<td><input type='button' value='Done' onclick='markAsDone()' style='background-color:green;color:white;border-radius:25px;'></td>";
                                        echo "</tr>";
                                        // echo "<td><input type='button' value='  No  ' onclick='val2()' style='background-color:red;color:white;border-radius:25px;'></td>";
                                        // echo "</tr>";
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
                    </tbody>
                </table>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <script type="text/javascript">
        ///////////////////////////////////////////////////////////////////////////////
        const toggleSwitch = document.getElementById('toggleSwitch');
        const statusText = document.getElementById('statusText');
        const initialActiveState = toggleSwitch.getAttribute('data-active');

        // Function to fetch and update active status
        function updateActiveStatus() {
            fetch('get_active_status.php?' + Math.random())
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Parse the response as JSON
                })
                .then(data => {
                    const activeStatus = parseInt(data.activeStatus, 10);
                    console.log('Active Status Value:', activeStatus);
                    setToggleSwitchState(activeStatus); // Update the toggle switch state based on the fetched active status
                })
                .catch(error => {
                    console.error('Error fetching active status:', error);
                });
        }

        // Function to set the toggle switch state
        function setToggleSwitchState(state) {
            console.log('Setting toggle switch state to:', state);
            toggleSwitch.checked = state === 1;

            // Update the data-active attribute for real-time changes
            toggleSwitch.setAttribute('data-active', state);

            // Update the display of the current state
            statusText.textContent = state === 0 ? 'Off' : 'On';

            // Save the state to localStorage
            localStorage.setItem('toggleSwitchState', state);
            console.log('Toggle switch state updated to:', state);
        }

        // Function to handle toggle switch changes
        function handleToggleSwitchChange() {
            const status = toggleSwitch.checked ? 1 : 0;
            console.log('Toggle switch changed. New status:', status);
            setToggleSwitchState(status);

            // You can add additional logic here to perform any actions when the toggle switch changes
        }
        function setActiveStatus(status) {
            // Send an AJAX request to update the "active" field in the database
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_active.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log('update_active.php successfully executed.');
                    } else {
                        console.error('Error updating active status:', xhr.statusText);
                    }
                }
            };
            xhr.send('status=' + status);
        }

        // Attach the event listener for toggle switch changes
        toggleSwitch.addEventListener('change', handleToggleSwitchChange);
        toggleSwitch.addEventListener('change', function () {
            const status = toggleSwitch.checked ? 1 : 0;
            setActiveStatus(status);
        });

        // Function to get the initial toggle switch state from localStorage
        function getInitialToggleState() {
            return localStorage.getItem('toggleSwitchState') || 0;
        }

        // Call the function to set the initial toggle switch state
        const initialToggleState = getInitialToggleState();
        setToggleSwitchState(initialToggleState);

        // Call the function to update the button's status on page load
        updateActiveStatus();

        ///////////////////////////////////////////////////////////////////////////////////////////
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

        // Check window width and initial state for drawer menu
        const menuDrawer = document.getElementById('menu-drawer');
        if (window.innerWidth > 650) {
            menuDrawer.style.left = '-250px'; // Hide the drawer menu on wider screens
        }w

        function markAsDone() {
            var tableData;
            $("tr").click(function () {
                tableData = $(this).children("td").map(function () {
                    return $(this).text();
                }).get();

                window.location.href = 'done.php';
            });
        }
    </script>
    <?php include '../include/footer.php'; ?>
</body>

</html>