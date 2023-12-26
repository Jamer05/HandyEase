<?php include '../dbconn.php';
session_start();
if(!isset($_SESSION['sess'])) {
    header('Location:admin.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>HandyEase</title>
    <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />

    <script src="../js/jquery.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Add this in the head section of your HTML -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

    <script src="https://unpkg.com/html2pdf.js/dist/html2pdf.bundle.js"></script>
    <link href="../css/newer.css" rel="stylesheet" type="text/css" media="all" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
<style>
    /* Custom styles for the Generate Report button */
    .generate-btn {
        padding: 12px 24px;
        font-size: 18px;
        background-color: #4CAF50;
        color: #fff;
        border-left: 50px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .generate-btn:hover {
        background-color: #45a049;
    }

    /* Align button to the right */
    .button-container {
        text-align: right;
    }

    /* Style for the red text in the Wage column */
    .red-text {
        color: red;
    }
</style>

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
                        </li>|
                        <li>

                            <a href="add_auth.php">ADD AUTHORIZER</a>
                        </li>|
                        <li>
                            <div class="dropdown">
                                <a class="active">Worker</a>
                                <div class="dropdown-content">
                                    <a href="addworker.php">ADD WORKER</a>
                                    <a href="deletework.php">DELETE WORKER</a>
                                </div>
                            </div>
                        </li>|
                        <li><a class="active" href="finance.php">Finance</a></li>|

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
        <div class="container">
            <div class="clearfix"></div>
            <div style="width:100%">
                <div style="width: 15%;margin-left:-2em;margin-top: 3em;float: left;font-size: 18px;">
                    <aside class="asideclass">
                        <ul style="list-style-type: none">
                            <h3 style="margin-bottom: 8px;"><strong>Service</strong></h3>

                            <li><input type="radio" class="common_selector service" value="All Service" name="type"
                                    checked>
                                All
                            </li>
                            <li><input type="radio" class="common_selector service" value="Plumber" name="type">
                                Plumber
                            </li>
                            <li><input type="radio" class="common_selector service" value="Electrician" name="type">
                                Electrician</li>
                            <li><input type="radio" class="common_selector service" value="Carpenter" name="type">
                                Carpenter</li>
                            <li><input type="radio" class="common_selector service" value="AC and Refrigerator"
                                    name="type"> AC & Refrigerator</li>
                            <li><input type="radio" class="common_selector service" value="Washing Machine" name="type">
                                Washing Machine</li>
                        </ul><br><br>

                        <ul style="list-style-type: none">
                            <h3 style="margin-bottom: 8px;"><strong>Area</strong></h3>
                            <li><input type="radio" class="common_selector city" name="city" value="All Service"
                                    checked>
                                All
                            </li>
                            <li><input type="radio" class="common_selector city" name="city" value="Sumacab">
                                Sumacab
                            </li>
                            <li><input type="radio" class="common_selector city" name="city" value="Palayan City">
                                Palayan
                            </li>
                            <li><input type="radio" class="common_selector city" name="city" value="Gapan City"> Gapan
                            </li>
                            <li><input type="radio" class="common_selector city" name="city" value="San Jose City"> San
                                Jose</li>

                        </ul>
                    </aside>
                </div>
                <div style="width: 85%;float: left;">

                    <table id="customers1">
                        <div class="clearfix"></div>
                        <br>
                        <tr>
                            <th>Transaction_no</th>
                            <th>Payer</th>
                            <th>Amount</th>
                            <th>Payee/Worker</th>
                            <th>Worker ID</th>
                            <th>Wage</th>
                            <th>Service</th>
                            <th>Date</th>
                        </tr>
                        <tbody id='tablebody'>

                            <?php
                            /**
                             * start fetching worker table
                             */
                            $query = mysqli_query($conn, "select * from finance");
                            $num_rows = mysqli_num_rows($query);
                            if($num_rows > 0) {
                                while($row = mysqli_fetch_array($query)) {
                                    echo "<tr>";
                                    echo "<td>".$row[0]."</td>";
                                    echo "<td>".$row[7]."</td>";
                                    echo "<td>".$row[2]."</td>";
                                    echo "<td>".$row[8]."</td>";
                                    echo "<td>".$row[3]."</td>";
                                    echo "<td>".$row[4]."</td>";
                                    echo "<td>".$row[6]."</td>";
                                    echo "<td>".$row[10]."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='8'>No data</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <br>
                    <div class="button-container">
                        <button onclick="generatePDF()" class="generate-btn">Generate Report</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- Include the html2pdf library -->
        <!-- Include the correct html2pdf library -->



        <script>

            $(document).ready(function () {
                // Use change event instead of click event to detect changes in radio buttons
                $('input[name="type"], input[name="city"]').change(function () {
                    var service = $('input[name="type"]:checked').val();
                    var city = $('input[name="city"]:checked').val();
                    $.post("../fetch_data.php", {
                        service: service,
                        city: city
                    }, function (result) {
                        $('#tablebody').html(result);
                        // Display "No data" if result is empty
                        if (result.trim() === '') {
                            $('#tablebody').html("<tr><td colspan='8'>No data</td></tr>");
                        }
                    });
                });
            });


            function generatePDF() {
                // Check if the table has data
                var columns = ['Payer', 'Amount', 'Payee/Worker', 'Worker ID', 'Wage', 'Service', 'Date'];

                var hasData = $('#customers1 tbody tr').length > 0;

                // Check if any row has the label "No data"
                var hasNoDataLabel = $('#customers1 tbody tr td:contains("No data")').length > 0;

                // If no data or has "No data" label, show a pop-up and return
                if (!hasData || hasNoDataLabel) {
                    alert("Nothing to generate!");
                    return;
                }

                var pdf = new jsPDF();

                // Set font size and style for the title
                pdf.setFontSize(16);
                pdf.setFont('helvetica', 'bold');

                // Centered text for 'HandyEase Customer Report'
                pdf.text('HandyEase Customer Report', 20, 30);

                // Add space below the title
                var titleSpace = 10;
                pdf.text('', 20, 30 + titleSpace);

                // Set font size and style for the service
                pdf.setFontSize(12);
                pdf.setFont('helvetica', 'normal');

                // Get the selected service
                var selectedService = $('input[name="type"]:checked').val();

                // Display the selected service
                pdf.text('Service: ' + selectedService, 20, 30 + titleSpace + 10);

                // Set font size and style for the table
                pdf.setFontSize(8);
                pdf.setFont('helvetica', 'bold'); // Set font to bold for headers

                // Set initial position
                var xOffset = 20;
                var yOffset = 30 + titleSpace + 30;

                // Set the spacing between columns
                var columnSpacing = 10;

                // Add table headers with bold text
                columns.forEach(function (columnName, colIndex) {
                    pdf.text(columnName, xOffset, yOffset);
                    xOffset += 30 + columnSpacing; // Adjust the horizontal position for each column header with spacing
                });

                // Set font style back to normal for the table content
                pdf.setFont('helvetica', 'normal');

                // Add table content
                $('#customers1 tbody tr').each(function (index, row) {
                    xOffset = 20; // Reset horizontal position for the next row

                    $(row).find('td').not(':first-child').each(function (colIndex, column) {
                        pdf.text($(column).text(), xOffset, yOffset);

                        // Add date for each row
                        if (columns[colIndex] === 'Date') {
                            var currentDate = new Date().toLocaleDateString();
                            pdf.text(currentDate, xOffset, yOffset + 5);
                        }

                        xOffset += 30 + columnSpacing; // Adjust the horizontal position for each column with spacing
                    });

                    yOffset += 10; // Adjust the vertical position for each row
                });

                // Add space below the table
                yOffset += 20;

                // Add current date
                var currentDateReport = new Date().toLocaleDateString();
                pdf.text('Report generated on ' + currentDateReport, 20, yOffset);

                // Save the PDF
                var pdfDataUri = pdf.output('datauristring');
                var newWindow = window.open();
                newWindow.document.write('<iframe width="100%" height="100%" src="' + pdfDataUri + '"></iframe>');

            }

            // Call the function when the page is loaded to check initially
        </script>

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