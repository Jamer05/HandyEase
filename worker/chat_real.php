<?php
session_start();

if (isset($_SESSION['sess_user'])) {
    # database connection file
    include '../app/dbconn.php';

    include '../app/helpers/user.php';
    include '../app/helpers/conversations.php';
    include '../app/helpers/timeAgo.php';
    include '../app/helpers/last_chat.php';

    # Getting User data data
    $user = getUser($_SESSION['sess_user'], $conn);

    # Getting User conversations
    $conversations = getConversation($user['user_id'], $conn);

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HandyEase - Chat</title>

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">


        <link href="../css/style_client.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="../images/user.png">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
            href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic'
            rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet'
            type='text/css'>
        <style>
            .menu-bar-image {
                width: 400px;
                /* Adjust the width as per your requirement */
                height: auto;
                /* Maintain the aspect ratio */
            }

            .chat-container {
                max-width: 800px;
                /* Adjust the maximum width as needed */
                margin: 0 auto;
                /* Center the chat box horizontally */
                display: flex;
                flex-direction: column;
                height: 100vh;
                justify-content: space-between;
            }


            .chat-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px;
                background-color: #f8f9fa;
            }

            .chat-header h3 {
                margin-bottom: 0;
            }

            .chat-list {
                flex: 1;
                overflow-y: auto;
            }

            .chat-footer {
                padding: 10px;
                background-color: #f8f9fa;
            }
        </style>
    </head>

    <body class="application">


        <div class="navbar d-flex justify-content-center"> <!-- Apply classes here -->
            <div class="navbar-toggle" id="burgerIcon" onclick="toggleMenu()">
                <div class="burger-bar"></div>
                <div class="burger-bar"></div>
                <div class="burger-bar"></div>
            </div>
            <div class="container">
                <div class="top-menu" id="navbar-links">
                    <ul>
                        <li><a href="application.php">Application</a></li>
                        <li><a href="chat_real.php">Chat</a></li>
                        <li><a href="accepted.php">Accepted</a></li>
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

        <div class="drawer" id="menu-drawer">
            <div class="close-drawer" onclick="toggleMenu()">
                <span>&times;</span>
            </div>
            <div class="menu-items">
                <ul>
                    <li><a <?php if ($currentPage == 'application.php')
                        echo 'class="active"'; ?>
                            href='application.php'>Application</a></li>
                    <li><a href='chat_real.php'>Chat</a></li>
                    <li><a href='accepted.php'>Accepted</a></li>
                    <li><a href='logout.php'>Logout</a></li>
                    <li><a href='active.php'>Status</a></li>
                </ul>
            </div>
        </div>



        <div class="chat-container">
            <div class="chat-header">
                <div class="d-flex align-items-center">
                    <img src="../uploads/<?= $user['p_p'] ?>" class="w-25 rounded-circle">
                    <h3 class="fs-xs m-2">
                        <?= $user['name'] ?>
                    </h3>
                </div>
                <a href="application.php" class="btn btn-dark">Return</a>
            </div>
            <div class="input-group mb-3">
                <input type="text" placeholder="Search..." id="searchText" class="form-control">
                <button class="btn btn-primary" id="searchBtn">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="chat-list">
                <div class="p-2">

                    <ul class="list-group">
                        <?php if (!empty($conversations)) { ?>
                            <?php foreach ($conversations as $conversation) { ?>
                                <li class="list-group-item">
                                    <a href="chat_pr.php?user=<?= $conversation['username'] ?>"
                                        class="d-flex align-items-center justify-content-between p-2">
                                        <div class="d-flex align-items-center">
                                            <img src="../uploads/<?= $conversation['p_p'] ?>" class="w-10 rounded-circle">
                                            <h3 class="fs-xs m-2">
                                                <?= $conversation['name'] ?><br>
                                                <small>
                                                    <?php echo lastChat($_SESSION['user_id'], $conversation['user_id'], $conn); ?>
                                                </small>
                                            </h3>
                                        </div>
                                        <?php if (last_seen($conversation['last_seen']) == "Active") { ?>
                                            <div title="online">
                                                <div class="online"></div>
                                            </div>
                                        <?php } ?>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="alert alert-info text-center">
                                <i class="fa fa-comments d-block fs-big"></i>
                                No messages yet. Start a conversation.
                            </div>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="chat-footer">
                <!-- Add any footer content here -->
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $(document).ready(function () {

                // Search
                $("#searchText").on("input", function () {
                    var searchText = $(this).val();
                    if (searchText == "") return;
                    $.post('../app/ajax/client_search.php',
                        {
                            key: searchText
                        },
                        function (data, status) {
                            $(".chat-list").html(data);
                        });
                });

                // Search using the button
                $("#searchBtn").on("click", function () {
                    var searchText = $("#searchText").val();
                    if (searchText == "") return;
                    $.post('../app/ajax/client_search.php',
                        {
                            key: searchText
                        },
                        function (data, status) {
                            $(".chat-list").html(data);
                        });
                });


                /** 
                auto update last seen 
                for logged in user
                **/
                let lastSeenUpdate = function () {
                    $.get("../app/ajax/update_last_seen.php");
                }
                lastSeenUpdate();
                /** 
                auto update last seen 
                every 10 sec
                **/
                setInterval(lastSeenUpdate, 10000);

            });
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

            .menu-items .active {
                color: green;
                /* Change the color to your desired highlight color */
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

            #navbar-links a {
                font-size: 16px;
                margin-bottom: -10px;
                margin-top: -10px;
                /* Adjust the font size as needed */
            }

            .navbar li {
                list-style: none;

            }

            .login-section li {

                font-size: 16px;
                /* Adjust the font size as needed */
            }

            .navbar {

                padding: 1px 0
            }
        </style>
        <script>
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

        </script>
    </body>

    </html>
    <?php
} else {
    header("Location: worker.php");
    exit;
}
?>