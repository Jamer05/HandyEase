<?php
include '../dbconn.php';
include '../include/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>HandyEase</title>
    <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />

    <script src="../js/jquery.min.js"></script>

    <link href="../css/style_me.css" rel="stylesheet" type="text/css" media="all" />

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
                        <li><a class="active" href="add_service.php">Add Service</a></li>|

                        <div class="clearfix"></div>
                    </ul>
                </div>

                <div class="login-section">
                    <ul>
                        <li><a class="active" href="#">Welcome
                                <?php echo $_SESSION['sess']; ?>
                            </a></li>
                        <li><a class="active" href="adminlogout.php">Logout</a></li>|
                        <li>
                            
                <div class=" clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add the following HTML code inside the body tag -->

    <div class="dashboard">
        <h1 class="Dashboard">Admin Dashboard</h1>
        <div class="container">

            <div class="card">

                <h2>Total Amount</h2>
                <?php
                // Fetch total amount from finance table
                $sql = "SELECT SUM(amount) as total_amount FROM finance";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalAmount = $row['total_amount'];
                ?>
                <p>PHP
                    <?php echo $totalAmount; ?>
                </p>
                <canvas id="totalAmountChart"></canvas>
            </div>

            <div class="card">
                <h2>Total Customers</h2>
                <?php
                // Fetch total customers from customer table
                $sql = "SELECT COUNT(*) as total_customers FROM customer";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalCustomers = $row['total_customers'];
                ?>
                <p>
                    <?php echo $totalCustomers; ?>
                </p>
                <canvas id="totalCustomersChart"></canvas>
            </div>
            <div class="card">
                <h2>Total Authorizers</h2>
                <?php
                // Fetch total authorizers from authorizer table
                $sql = "SELECT COUNT(*) as total_authorizers FROM authoriser";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalAuthorizers = $row['total_authorizers'];
                ?>
                <p>
                    <?php echo $totalAuthorizers; ?>
                </p>
                <canvas id="totalAuthorizersChart"></canvas>
            </div>
            <div class="card">
                <h2>Completed</h2>
                <?php
                // Fetch complete customers from service table
                $sql = "SELECT COUNT(*) as complete_customers FROM service WHERE transflag = 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $completeCustomers = $row['complete_customers'];
                ?>
                <p>
                    <?php echo $completeCustomers; ?>
                </p>
                <canvas id="completeCustomersChart"></canvas>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <h2>Pending/Pending Transaction</h2>
                <?php
                // Fetch complete customers from service table
                $sql = "SELECT COUNT(*) as pending_customers FROM service WHERE transflag = 0";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $pending = $row['pending_customers'];
                ?>
                <p>
                    <?php echo $pending; ?>
                </p>
                <canvas id="pendingCustomersChart"></canvas>

            </div>
            <div class="card">
                <h2>Workers</h2>
                <?php
                // Fetch total customers from customer table
                $sql = "SELECT COUNT(*) as total_workers FROM worker";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $totalWorkers = $row['total_workers'];
                ?>
                <p>
                    <?php echo $totalWorkers; ?>
                </p>
                <canvas id="totalWorkersChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Add the following CSS code in the head tag or in a separate CSS file -->
    <style>
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <script>
        // Get data from PHP variables
        var totalAmount = <?php echo $totalAmount; ?>;
        var totalCustomers = <?php echo $totalCustomers; ?>;
        var totalAuthorizers = <?php echo $totalAuthorizers; ?>;
        var completeCustomers = <?php echo $completeCustomers; ?>;
        var pending = <?php echo $pending; ?>;
        var totalWorkers = <?php echo $totalWorkers; ?>;
        // Create Total Amount chart
        var totalAmountChart = new Chart(document.getElementById('totalAmountChart'), {
            type: 'bar',
            data: {
                labels: ['Total Amount'],
                datasets: [{
                    label: 'Total Amount',
                    data: [totalAmount],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Create Total Customers chart
        var totalCustomersChart = new Chart(document.getElementById('totalCustomersChart'), {
            type: 'bar',
            data: {
                labels: ['Total Customers'],
                datasets: [{
                    label: 'Total Customers',
                    data: [totalCustomers],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Create Total Authorizer chart
        var totalAuthorizerChart = new Chart(document.getElementById('totalAuthorizersChart'), {
            type: 'bar',
            data: {
                labels: ['Total Authorizer'],
                datasets: [{
                    label: 'Total Authorizer',
                    data: [totalAuthorizers],
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    borderColor: 'rgba(255, 205, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Create Total Completed chart
        var totalCompletedChart = new Chart(document.getElementById('completeCustomersChart'), {
            type: 'bar',
            data: {
                labels: ['Total Completed'],
                datasets: [{
                    label: 'Total Completed',
                    data: [completeCustomers],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var pendingCompletedChart = new Chart(document.getElementById('pendingCustomersChart'), {
            type: 'bar',
            data: {
                labels: ['Total Pending'],
                datasets: [{
                    label: 'Total Pending',
                    data: [pending],
                    backgroundColor: 'rgba(153, 187, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var totalWorkersChart = new Chart(document.getElementById('totalWorkersChart'), {
            type: 'bar',
            data: {
                labels: ['Total Workers'],
                datasets: [{
                    label: 'Total Workers',
                    data: [totalWorkers],
                    backgroundColor: 'rgba(255, 0, 0, 0.2)', // Changed to red color with 20% opacity
                    borderColor: 'rgba(0, 255, 0, 1)', // Changed to green color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php include '../include/footer.php'; ?>

</body>

</html>