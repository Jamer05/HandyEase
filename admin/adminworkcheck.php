<?php include '../dbconn.php';
include '../include/warning.php';
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
        type='../text/css'>
    <script src="../js/wow.min.js"></script>
    <link href="../css/animate.css" rel='stylesheet' type='text/css' />
    <script>
        new WOW().init();
    </script>
    <script type="text/javascript" src="../js/move-top.js"></script>
    <script type="text/javascript" src="j../js/easing.js"></script>
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
</head>

<body>
    <div class="header">
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
                        <input type="text" id="searchInput" placeholder="Search..." style="color:black;"
                            onforminput="searchDatabase();">
                        <!-- <button onclick="searchDatabase()" style="color:black;">Search</button> -->
                        <div id="searchResults"></div>
                        <div class="clearfix"></div>
                    </ul>
                </div>
                <div class="login-section">
                    <ul>
                        <li>Welcome
                            <?php echo $_SESSION['sess']; ?>
                        </li>
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
        <div class="bar">
            <h2 style="background-color: green; text-align: center; color:#fff;">Worker</h2>
        </div>
        <div class="main">
            <div class="container">
                <div class="clearfix"></div>
                <table id="customers1" style="width:80%;" class="table-responsive">
                    <div class="clearfix"></div>
                    <br>
                    <tr>
                        <th>Worker_id</th>
                        <th>Worker First_Name</th>
                        <th> Worker Last Name</th>
                        <th> Worker Phone Number</th>
                        <th>Profession</th>
                        <th>Area</th>
                        <th>Authorizer id</th>
                    </tr>
                    <?php
                    /**
                     * fetch data from table
                     */
                    $query = mysqli_query($conn, "select * from worker");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td>" . $row[1] . "</td>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[5] . "</td>";
                            echo "<td>" . $row[6] . "</td>";
                            echo "<td>" . $row[10] . "</td>";
                            echo "<td>" . $row[7] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='7'>No data</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <br><br><br><br>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    </div>
    <script>
        function searchDatabase() {
            var searchKey = document.getElementById("searchInput").value;

            // Make an AJAX request to the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var results = JSON.parse(xhr.responseText);
                    displayResults(results);
                }
            };

            // Send the search key to the server
            xhr.open("GET", "search.php?searchKey=" + encodeURIComponent(searchKey), true);
            xhr.send();
        }
        window.onload = function () {
            var input = document.getElementById("searchInput");
            var table = document.getElementById("customers1");
            var tableRows = table.getElementsByTagName("tr");
            var noDataRow = document.getElementById("noDataRow");
            var found = false;

            input.addEventListener("input", function () {
                var filter = input.value.toLowerCase(); // Convert input to lowercase

                // Loop through each row and hide/show based on filter
                var matchCount = 0; // Counter for number of matches
                for (var i = 1; i < tableRows.length; i++) { // Start from index 1 to exclude the header row
                    var cells = tableRows[i].getElementsByTagName("td"); // Get all cells in current row
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
                        tableRows[i].style.display = "";
                        matchCount++;
                    } else {
                        tableRows[i].style.display = "none";
                    }
                }

                // Hide/show "No data" row based on filter
                if (matchCount === 0) {
                    noData();
                } else {
                    noDataRow.style.display = "none"; // Hide "No data" row
                }
            });
        };


    </script>

</body>

</html>