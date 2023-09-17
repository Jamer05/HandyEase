<?php
session_start();

if (isset($_SESSION['username'])) {
    # database connection file
    include 'app/dbconn.php';

    include 'app/helpers/user.php';
    include 'app/helpers/conversations.php';
    include 'app/helpers/timeAgo.php';
    include 'app/helpers/last_chat.php';

    # Getting User data data
    $user = getUser($_SESSION['username'], $conn);

    # Getting User conversations
    $conversations = getConversation($user['user_id'], $conn);

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HandyEase - Chat</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/index.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="images/user.png">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .menu-bar-image {
                width: 400px;
                /* Adjust the width as per your requirement */
                height: auto;
                /* Maintain the aspect ratio */
            }

            .chat-container {
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

    <body>
        <div class="menu-bar">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="images/home1.png" alt="Home" class="menu-bar-image">
                </div>
            </div>
        </div>


        <div class="chat-container">
            <div class="chat-header">
                <div class="d-flex align-items-center">
                    <img src="uploads/<?= $user['p_p'] ?>" class="w-25 rounded-circle">
                    <h3 class="fs-xs m-2">
                        <?= $user['name'] ?>
                    </h3>
                </div>
                <a href="landpage.php" class="btn btn-dark">Return</a>
            </div>

            <div class="chat-list">
                <div class="p-2">
                    <div class="input-group mb-3">
                        <input type="text" placeholder="Search..." id="searchText" class="form-control">
                        <button class="btn btn-primary" id="searchBtn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <ul class="list-group">
                        <?php if (!empty($conversations)) { ?>
                            <?php foreach ($conversations as $conversation) { ?>
                                <li class="list-group-item">
                                    <a href="chat_pr.php?user=<?= $conversation['username'] ?>"
                                        class="d-flex align-items-center justify-content-between p-2">
                                        <div class="d-flex align-items-center">
                                            <img src="uploads/<?= $conversation['p_p'] ?>" class="w-10 rounded-circle">
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
                    $.post('app/ajax/search.php', {
                        key: searchText
                    },
                        function (data, status) {
                            $("#chatList").html(data);
                        });
                });

                // Search using the button
                $("#searchBtn").on("click", function () {
                    var searchText = $("#searchText").val();
                    if (searchText == "") return;
                    $.post('app/ajax/search.php', {
                        key: searchText
                    },
                        function (data, status) {
                            $("#chatList").html(data);
                        });
                });

                /**
                auto update last seen
                for logged in user
                **/
                let lastSeenUpdate = function () {
                    $.get("app/ajax/update_last_seen.php");
                }
                lastSeenUpdate();

                /**
                auto update last seen
                every 10 sec
                **/
                setInterval(lastSeenUpdate, 10000);
            });
        </script>
    </body>

    </html>
    <?php
} else {
    header("Location: index.php");
    exit;
}
?>