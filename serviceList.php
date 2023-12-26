<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/service.css">
</head>

<body>
    <section class="products">

        <div class="all-products">
            <?php
            include '../dbconn.php';

            function countAvailableWorkersInRoles($specificRoles)
            {
                global $conn;
                $roleCounts = array();

                foreach ($specificRoles as $role) {
                    $query = "SELECT COUNT(*) as count FROM worker WHERE profession = '$role' AND active = 1";
                    $result = mysqli_query($conn, $query);

                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $count = $row['count'];
                        $roleCounts[$role] = $count;
                    }
                }

                return $roleCounts;
            }

            ?>

            <?php
            $products = array(
                "Refrigerator" => array("AC", "Refrigerator"),
                "Aircondition" => array("AC"),
                "Washing Machine" => array("Electrician"),
                "Plumber" => array("Plumber")
            );
            ?>



            <div class="product">
                <img src="images/ref.avif">
                <div class="product-info">
                    <h4 class="product-title">Refrigerator</h4>
                    <p class="product-price">Check Up fee starts above Php 300.00</p>
                    <p class="product-price">Available Workers:
                        <?php
                        $roles = array("AC and Refrigerator");
                        $roleCounts = countAvailableWorkersInRoles($roles);
                        if (count($roleCounts) > 0) {
                            $total = array_sum($roleCounts);
                            echo $total;
                        } else {
                            echo "No worker available";
                        }
                        ?>
                    </p>
                    <a class="product-btn" href="refrigerator.php"
                        onclick="return checkWorkerAvailability(<?php echo $total; ?>)">Book Request</a>
                </div>
            </div>

            <div class="product">
                <img src="images/aircon.png">
                <div class="product-info">
                    <h4 class="product-title">Aircondition</h4>
                    <p class="product-price">Check Up fee starts above Php 300.00</p>
                    <p class="product-price">Available Workers:
                        <?php
                        $roles = array("AC and Refrigerator");
                        $roleCounts = countAvailableWorkersInRoles($roles);
                        if (count($roleCounts) > 0) {
                            $total = array_sum($roleCounts);
                            echo $total;
                        } else {
                            echo "No worker available";
                        }
                        ?>
                    </p>
                    <a class="product-btn" href="aircondition.php"
                        onclick="return checkWorkerAvailability(<?php echo $total; ?>)">Book Request</a>

                </div>
            </div>

            <div class="product">
                <img src="images/washing.avif">
                <div class="product-info">
                    <h4 class="product-title">Washing Machine</h4>
                    <p class="product-price">Check Up fee starts above Php 300.00</p>
                    <p class="product-price">Available Workers:
                        <?php
                        $roles = array("Washing Machine");
                        $roleCounts = countAvailableWorkersInRoles($roles);
                        if (count($roleCounts) > 0) {
                            $total = array_sum($roleCounts);
                            echo $total;
                        } else {
                            echo "No worker available";
                        }
                        ?>
                    </p>
                    <a class="product-btn" href="washing.php"
                        onclick="return checkWorkerAvailability(<?php echo $total; ?>)">Book Request</a>

                </div>
            </div>

            <div class="product">
                <img src="images/plumb.png">
                <div class="product-info">
                    <h4 class="product-title">Electrician</h4>
                    <p class="product-price">Check Up fee starts above Php 300.00</p>
                    <p class="product-price">Available Workers:
                        <?php
                        $roles = array("Electrician");
                        $roleCounts = countAvailableWorkersInRoles($roles);
                        if (count($roleCounts) > 0) {
                            $total = array_sum($roleCounts);
                            echo $total;
                        } else {
                            echo "No worker available";
                        }
                        ?>
                    </p>
                    <a class="product-btn" href="electrician.php"
                        onclick="return checkWorkerAvailability(<?php echo $total; ?>)">Book Request</a>

                </div>
            </div>

            <div class="product">
                <!-- <img src="images/plumb.png"> -->
                <div class="product-info">
                    <h4 class="product-title">Coming soon!</h4>
                    <!-- <p class="product-price">Check Up fee starts above Php 300.00</p>
                    <p class="product-price">Available Workers: -->
                        <?php
                        // $roles = array("Electrician");
                        // $roleCounts = countAvailableWorkersInRoles($roles);
                        // if (count($roleCounts) > 0) {
                        //     $total = array_sum($roleCounts);
                        //     echo $total;
                        // } else {
                        //     echo "No worker available";
                        // }
                        ?>
                    </p>
                    <a class="product-btn" href="electrician.php"
                        onclick="return checkWorkerAvailability(<?php echo $total; ?>)">Coming Soon!</a>

                </div>
            </div>

            <div class="product">
                <!-- <img src="images/plumb.png"> -->
                <div class="product-info">
                    <h4 class="product-title">Coming soon!</h4>
                    <!-- <p class="product-price">Check Up fee starts above Php 300.00</p>
                    <p class="product-price">Available Workers: -->
                        <?php
                        // $roles = array("Electrician");
                        // $roleCounts = countAvailableWorkersInRoles($roles);
                        // if (count($roleCounts) > 0) {
                        //     $total = array_sum($roleCounts);
                        //     echo $total;
                        // } else {
                        //     echo "No worker available";
                        // }
                        ?>
                    </p>
                    <a class="product-btn" href="electrician.php"
                        onclick="return checkWorkerAvailability(<?php echo $total; ?>)">Coming Soon!</a>

                </div>
            </div>


        </div>
    </section>

    <script>
        function checkWorkerAvailability(totalWorkers) {
            if (totalWorkers === 0) {
                alert("No workers are available right now. Please try again later.");
                return false; // Prevent the link action
            }
            return true; // Allow the link action to proceed
        }
    </script>



</body>

</html>