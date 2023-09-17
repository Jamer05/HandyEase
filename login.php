<?php
session_start();

if (!isset($_SESSION['username'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HandyEase</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
        <script src="js/jquery.min.js"></script>
        <link href="css/index.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="icon" href="images/user.png">
        <style>
            .menu-bar-image {
                width: 400px;
                /* Adjust the width as per your requirement */
                height: auto;
                /* Maintain the aspect ratio */
            }
        </style>

    </head>

    <body>
        <div class="menu-bar">
            <div class="container">
                <a href="index.php">
                    <img src="images/home1.png" alt="Home" class="menu-bar-image">
                </a>

            </div>
        </div>


        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="w-400 p-5 shadow rounded">
                <form method="post" action="app/http/auth.php">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <img src="images/user.png" class="w-25">
                        <h3 class="display-4 fs-1 text-center">LOGIN</h3>
                    </div>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo htmlspecialchars($_GET['success']); ?>
                        </div>
                    <?php } ?>

                    <div class="mb-3">
                        <label class="form-label">User name</label>
                        <input type="text" class="form-control" name="username">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <style>
                        .container {
                            display: flex;
                            justify-content: space-between;
                            align-items: left;
                            margin-bottom: 10px;
                        }

                        .left {
                            display: flex;
                            align-items: center;
                        }

                        .left-space {
                            margin-left: 4px;
                        }

                        #right-space {
                            margin-left: -8px;
                        }

                        .right {
                            display: flex;
                            align-items: center;
                        }

                        .right-corner {
                            margin-left: auto;
                        }
                    </style>

                    <div class="container">
                        <div class="left">
                            <button type="submit" id="right-space" class="btn btn-primary">LOGIN</button>
                            <a class="left-space" href="signup.php">Sign Up</a>
                        </div>
                        <div class="right">
                        
                            <a href="index.php" class="right-corner">Return</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>

        <div class="footer">
            <div class="container">
                <p class="wow fadeInLeft" data-wow-delay="0.4s">&copy; Designed by &nbsp;<a href="team/index.html">OMSIM
                        BARABIDA</a></p>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/simpleCart.min.js"></script>
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
            new WOW().init();
        </script>
    </body>

    </html>

    <?php
} else {
    header("Location: landpage.php");
    exit;
}
?>