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
    <link href="../css/style_test1.css" rel="stylesheet" type="text/css" media="all" />
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
    <script src="../js/simpleCart.min.js"> </script>

    <style>
        .footer {
            padding: 3em 0;
            background-color: #000;
            left: 0;
            bottom: 0;
            width: 100%;
            color: white;
            margin-top: 20px;
        }
    </style>
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
                        </li>
                        |
                        <li>
                            <a href="add_auth.php">ADD AUTHORIZER</a>
                        </li>
                        |
                        <li>
                            <div class="dropdown">
                                <a class="active">Worker</a>
                                <div class="dropdown-content">
                                    <a href="addworker.php">ADD WORKER</a>
                                    <a href="deletework.php">DELETE WORKER</a>
                                </div>
                            </div>
                        </li>
                        |
                        <li><a class="active" href="finance.php">Finance</a></li>
                        |
                        &nbsp;&nbsp;
                        <!-- <input type="text" id="searchInput" placeholder="Search..."> -->

                    </ul>
                </div>
                <div class="login-section">
                    <ul>
                        <li>Welcome
                            <?php echo $_SESSION['sess']; ?>
                        </li>
                        <li><a class="active" href="adminlogout.php">Logout</a></li>|
                        <li><a href="#"></a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bar">
            <h2 style="background-color: green; text-align: center; color:#fff;">Authorizer</h2>
        </div>

        <div class="main">
            <div class="main">
                <div class="container">
                    <div class="table-responsive">
                        <div class="wow fadeInDownBig" data-wow-delay="0.4s">
                            <div class="table-responsive">
                                <div class="row">
                                    <?php
                                    $output = "";
                                    $query = mysqli_query($conn, "SELECT * FROM authoriser");
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_array($query)) {

                                            ?>
                                            <div class="col-md-4">
                                                <div class="card"
                                                    style="width: 30rem; background: #fff; border:3px solid green; border-radius:25px; background-color:white; color: black;">
                                                    <img class='card-img-top' src='<?php echo $row[12]; ?>'
                                                        style='width: 180px; height: 180px; border-radius:50%;'>

                                                    <div class="card-body">
                                                        <h3 class="card-title">
                                                            <?php echo $row[1] . " " . $row[2]; ?>
                                                        </h3>
                                                        <br>
                                                        <p class="card-text text-justify"><strong>Authorizer ID:</strong>
                                                            <?php echo $row[0]; ?>
                                                        </p>
                                                        <p class="card-text text-justify"><strong>Service:</strong>
                                                            <?php echo $row[3]; ?>
                                                        </p>
                                                        <p class="card-text text-justify"><strong>Phone:</strong>
                                                            <?php echo $row[4]; ?>
                                                        </p>
                                                        <p class="card-text text-justify"><strong>Location:</strong>
                                                            <?php echo $row[5]; ?>
                                                        </p>
                                                        <p class="card-text text-justify"><strong>Username:</strong>
                                                            <?php echo $row[7]; ?>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo '<p class="display-1 text-center">No data found</p>';
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="spaces">

        </div>
    </div>
    </div>
    </div>

    <!--Search filters-->
    <script>
        var input = document.getElementById("searchInput");
        var table = document.getElementById("customers");
        var tbody = table.getElementsByTagName("tbody")[0];
        var headerRow = table.getElementsByTagName("thead")[0].getElementsByTagName("tr")[0];
        var noDataRow = document.getElementById("noDataRow");
        var found = false;

        input.addEventListener("input", function () {
            var filter = input.value.toLowerCase(); // Convert input to lowercase
            var rows = tbody.getElementsByTagName("tr"); // Get all table body rows

            // Loop through each row and hide/show based on filter
            var matchCount = 0; // Counter for number of matches
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td"); // Get all cells in current row
                var match = false;

                // Loop through each cell and check for a match
                for (var j = 0; j < cells.length; j++) {
                    var cellText = cells[j].innerText.toLowerCase(); // Convert cell text to lowercase
                    if (cellText.indexOf(filter) > -1) { // Check if filter matches cell text
                        match = true;
                        break;
                    }
                }

                // Hide/show row based on match
                if (match) {
                    rows[i].style.display = "";
                    matchCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Hide/show "No data" row based on filter
            if (matchCount === 0) {
                noDataRow.style.display = ""; // Show "No data" row

                // Create a new row element
                var newRow = document.createElement("tr");
                newRow.className = "no-data-row"; // Add a custom class to the new row for future reference
                // Set the innerHTML of the row to "No data" in a single cell spanning across all columns
                newRow.innerHTML = "<td colspan='" + headerRow.cells.length + "'>No data</td>";
                // Append the row to the tbody
                tbody.appendChild(newRow);
            } else {
                noDataRow.style.display = "none"; // Hide "No data" row

                // Remove any existing "No data" row from the tbody
                var existingNoDataRow = tbody.querySelector(".no-data-row");
                if (existingNoDataRow) {
                    tbody.removeChild(existingNoDataRow);
                }
            }

        });
        // Set text color in search field to black
        input.style.color = "black";
    </script>
    <br><br>
    <div class="footer">
        <div class="container">
            <p class="wow fadeInLeft" data-wow-delay="0.4s">
                &copy; Designed by &nbsp;<a href="team/index.html">OMSIM BARABIDA</a><br>
                <strong>Contact:</strong> info@handyease.com | Phone: +639777325694
            </p>
        </div>
    </div>
</body>

</html>