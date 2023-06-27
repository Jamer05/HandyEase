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
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/user.png">
    </head>

    <body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
        <div class="w-400 p-5 shadow rounded">
            <form method="post" action="app/http/auth.php">
                <div class="d-flex
                         justify-content-center
                         align-items-center
                         flex-column">

                    <img src="images/user.png" class="w-25">
                    <h3 class="display-4 fs-1 
                        text-center">
                        LOGIN</h3>


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
                    <label class="form-label">
                        User name</label>
                    <input type="text" class="form-control" name="username">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <style>
                    .container {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 10px;
                    }

                    .left {
                        display: flex;
                        align-items: center;
                    }

                    .left-space {
                        margin-left: 4px;
                    }
                    #right-space{
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
                        <button type="submit" id ="right-space"class="btn btn-primary">LOGIN </button>
                        <a class ="left-space" href="signup.php">Sign Up</a>
                    </div>
                    <div class="right">
                        <a href="index.php" class="right-corner">Return</a>
                    </div>
                </div>

            </form>
        </div>
    </body>

    </html>
    <?php
} else {
    header("Location: landpage.php");
    exit;
}
?>