<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['sess_user'])) {
    header('Location: worker.php');
    exit();
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>

<head>
    <title>HandyEase</title>
    <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="../js/jquery.min.js"></script>
    <link href="../css/style_client.css" rel="stylesheet" type='text/css' media='all' />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script type='text/javascript'>
        addEventListener('load', function () {
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
    <script src='../js/wow.min.js'></script>
    <link href='../css/animate.css' rel='stylesheet' type='text/css' />
    <script>
        new WOW().init();
    </script>
    <script type='text/javascript' src='../js/move-top.js'></script>
    <script type='text/javascript' src='../js/easings.js'></script>
    <script type='text/javascript'>
        jQuery(document).ready(function ($) {
            $('.scroll').click(function (event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1200);
            });
        });
    </script>

<style>
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

        h2 {
            color: black;
            font-size: 40px;
            text-align: center;
            margin-bottom: -5rem;
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
            .rounded-button{
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

<body class='application'>
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

    <div class='content'>
        <div class='scrollme'>
            <br><br>
            <h2>Active Status:</h2>
            <button class='rounded-button' id='active' data-active="<?php echo $activeStatus; ?>">
                <?php echo $activeStatus == 0 ? 'Off' : 'On'; ?>
                <div id="statusText"></div>
            </button>
        </div>

    </div>

    <script>

        const burgerIcon = document.getElementById('burgerIcon');
        const menuDrawer = document.getElementById('menu-drawer');

        const active = document.getElementById('active');
        const toggleSwitch = document.getElementById('toggleSwitch');
        const Text = document.getElementById('statusText');
        const initialActiveState = active.getAttribute('data-active');

        if (initialActiveState === "0") {
            setButtonState(0);
        } else {
            setButtonState(1);
        }

        // Function to fetch and update active status
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
                    const activeStatus = data.activeStatus; // Extract the activeStatus
                    console.log('Active Status Value:', activeStatus);

                    // Assuming that 'activeStatus' is either '0' or '1', you can update the button's state
                    setButtonState(parseInt(activeStatus, 10)); // Parse 'activeStatus' as an integer
                })
                .catch(error => {
                    console.error('Error fetching active status:', error);
                });
        }


        console.log('Script loaded');

        // ... Rest of your JavaScript code


        // Call the function to update the button's status on page load
        updateActiveStatus();

        // Function to set the button state
        function setButtonState(state) {
            console.log('Setting button state to:', state);
            if (state === 0) {
                console.log('State is 0 - setting button to Off');
                active.textContent = 'Off';
                active.style.backgroundColor = 'red';
            } else {
                console.log('State is not 0 - setting button to On');
                active.textContent = 'On';
                active.style.backgroundColor = 'chartreuse';
            }
            localStorage.setItem('activeState', state);

            // Update the data-active attribute for real-time changes
            active.setAttribute('data-active', state);
        }


        let isOn = true;


        active.addEventListener('click', function () {
            if (isOn) {
                setActiveStatus(0); // Send a request to set "active" to 0 (Off)
                active.textContent = 'Off';
                active.style.backgroundColor = 'red';
            } else {
                setActiveStatus(1); // Send a request to set "active" to 1 (On)
                active.textContent = 'On';
                active.style.backgroundColor = 'chartreuse';
            }
            isOn = !isOn;
        });

        function setActiveStatus(status) {
            // Send an AJAX request to update the "active" field in the database
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_active.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response if needed
                }
            };
            xhr.send('status=' + status);
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

        // toggle switch
        toggleSwitch.addEventListener('change', function () {
            const status = toggleSwitch.checked ? 1 : 0;
            setActiveStatus(status);
        });
        // set toggleswitch state
        const activeState = active.getAttribute('data-active');
        if (activeState === "0") {
            toggleSwitch.checked = false;
        } else {
            toggleSwitch.checked = true;
        }

        // Function to set the toggle switch state
        function setToggleSwitchState(state) {
            console.log('Setting toggle switch state to:', state);
            toggleSwitch.checked = state == 1;

            // Update the data-active attribute for real-time changes
            toggleSwitch.setAttribute('data-active', state);

            // Update the display of the current state
            statusText.textContent = state == 0 ? 'Off' : 'On';

            // Save the state to localStorage
            localStorage.setItem('toggleSwitchState', state);
        }

        // Function to handle toggle switch changes
        function handleToggleSwitchChange() {
            const status = toggleSwitch.checked ? 1 : 0;
            setToggleSwitchState(status);

            // You can add additional logic here to perform any actions when the toggle switch changes
        }

        // Attach the event listener for toggle switch changes
        toggleSwitch.addEventListener('change', handleToggleSwitchChange);

        // Function to get the initial toggle switch state from localStorage
        function getInitialToggleState() {
            return localStorage.getItem('toggleSwitchState') || 0;
        }

        // Call the function to set the initial toggle switch state
        const initialToggleState = getInitialToggleState();
        setToggleSwitchState(initialToggleState);
    </script>

    <?php include '../include/footer.php'; ?>
</body>

</html>