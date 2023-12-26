<?php include 'dbconn.php';
session_start();
error_reporting(0);
if (!isset($_SESSION['username'])) {
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>HandyEase</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="js/jquery.min.js"></script>
    <link href="css/index.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script
        type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link
        href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic'
        rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet'
        type='text/css'>
    <script src="js/wow.min.js"></script>
    <link href="css/animate.css" rel='stylesheet' type='text/css' />
    <script>
        new WOW().init();
    </script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({ scrollTop: $(this.hash).offset().top }, 1200);
            });
        });
    </script>

</head>

<body>
    <div class="header">
        <div class="container">
            <div>
                <a href="landpage.php"><img src="images/home1.png" class="img-responsive" alt="" /></a>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>

    <div class="menu-bar">
        <div class="container">
            <div class="top-menu">
                <ul>
                    <li><a href="customer.php">Book</a></li>
                    <li><a href="chat_real.php">Chat</a></li>
                    <li><a href="appointment.php">Updates</a></li>
                    <li><a href="logout.php">Signout</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="main">
        <div class="container">
            <div class="register">
                <form action="addcus.php" method="post">
                    <div class="register-top-grid">
                        <h3>BOOK APPOINTMENT</h3>
                        <div class="wow fadeInLeft" data-wow-delay="0.4s">
                            <span>Id<label>*</label></span>
                            <input type="text" name="Id" id="cusid" readonly>
                        </div>
                        <div class="wow fadeInLeft" data-wow-delay="0.4s">
                            <span>Username<label>*</label></span>
                            <input type="text" name="Username" id="uname" readonly>
                        </div>
                        <div class="wow fadeInLeft" data-wow-delay="0.4s">
                            <span>Display Name<label>*</label></span>
                            <input type="text" name="Name" id="displayName" pattern="^[a-zA-Z'. -]+$">
                        </div>

                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Email Address <label>*</label></span>
                            <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Locality<label>*</label></span>
                            <select name="locality">
                                <option value="Nueva Ecija">Nueva Ecija</option>
                            </select>
                        </div>

                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>City<label>*</label></span>
                            <select name="city">
                                <option value="Sumacab">Sumacab</option>
                                <option value="Palayan City">Palayan City</option>
                                <option value="Gapan City">Gapan City</option>
                                <option value="San Jose City">San Jose City</option>
                                <option value="San Antonio">San Antonio</option>
                            </select>
                        </div>
                        <div class="wow fadeInLeft" data-wow-delay="0.4s">
                            <span>Complete Address<label>*</label></span>
                            <input type="text" name="bar_street">
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Phone number<label>*</label></span>
                            <input type="text" name="phone" pattern="^(09|\+639)\d{9}$">
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Service<label>*</label></span>
                            <select name="selser">
                                <option value="AC and Refrigerator">AC & Refrigerator</option>
                            </select>
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Brand<label>*</label></span>
                            <select name="selbrand">
                                <option value="">Select Brand</option>
                                <option value="LG">LG</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Whirlpool">Whirlpool</option>
                                <option value="Panasonic">Panasonic</option>
                                <option value="Sharp">Sharp</option>
                                <option value="Toshiba">Toshiba</option>
                                <option value="Fujidenzo">Fujidenzo</option>
                                <option value="Haier">Haier</option>
                                <option value="Kelvinator">Kelvinator</option>
                                <option value="Kolin">Kolin</option>
                            </select>
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Device type<label>*</label></span>
                            <select name="seltype">
                                <option value="">Select Device Type</option>
                                <option value="Window">Window</option>
                                <option value="Split">Split</option>
                                <option value="Tower">Tower</option>
                                <option value="Cassete">Cassete</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Concealed">Concealed</option>
                                <option value="U-shaped Window">U-shaped Window</option>

                            </select>
                        </div>
                        <div class="wow fadeInRight" data-wow-delay="0.4s">
                            <span>Technology<label>*</label></span>
                            <select name="seltech">
                                <option value="">Select Device Technology</option>
                                <option value="Inverter">Inverter</option>
                                <option value="Non-Inverter">Non-Inverter</option>
                                <!-- remove the default option -->
                            </select>
                        </div>
                        <div class="wow fadeInLeft" data-wow-delay="0.4s">
                            <span>Additional Information(Issue)<label>*</label></span>
                            <input type="text" name="Information" pattern="^[a-zA-Z'. -]+$">
                        </div>

                        <!-- Add button that will show the price and details -->
                        <button type="button" class="btn btn-default" id="showDetailsBtn">Show Pricing</button>
                        <!-- It should be show here -->
                        <div id="dynamicDetails"></div>
                        <input type="hidden" name="checkup" id="checkup_fee" value="">
                        <input type="hidden" name="types" id="types" value="">
                        <div id="error" style="color: red;"></div>

                    </div>
                    <div class="clearfix"> </div>
                    <div class="clearfix"> </div>
                    <div class="register-but">
                        <input type="submit" value="Submit">
                    </div>
                    <div class="clearfix"> </div>
                </form>
            </div>
        </div>
    </div>

    <div id="dynamicDetails" style="display: none;">
        <!-- Dynamic content will be placed here -->
    </div>

    <?php
    $query = mysqli_query($conn, "SELECT * FROM customer order by id desc limit 1");
    if (mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_array($query);
        $id = $row[0];
        $num = substr($id, 3);
        $numrows = ((int) $num) + 1;
    }
    ?>

    <script type="text/javascript">
        String.prototype.padLeft = function (length, character) {
            return new Array(length - this.length + 1).join(character || '0') + this;
        }
        var num = '<?php echo $numrows; ?>';
        var username = '<?php echo $_SESSION['username'] ?>';
        var str = 'CUS';
        var str1 = num.padLeft(7, '0');
        str += str1;
        document.getElementById("cusid").value = str;
        document.getElementById("uname").value = username;
        document.getElementById("displayName").value = username;
    </script>

    <!-- Add button that will show the price and details -->
    <button type="button" class="btn btn-default" id="showDetailsBtn">Show details</button>
    <!-- It should be shown here -->
    <div id="dynamicDetails"></div>

    <script>
        // Get references to the select elements
        const serviceSelect = document.querySelector('select[name="selser"]');
        const deviceTypeSelect = document.querySelector('select[name="seltype"]');

        // Get references to the container and button
        const dynamicDetailsContainer = document.getElementById('dynamicDetails');
        const showDetailsBtn = document.getElementById('showDetailsBtn');

        // Define pricing for each type of refrigerator (in Philippine Pesos)
        const devicePricing = {
            'LG': {
                'Inverter': {
                    'Window': "400",
                    'Split': "450",
                    'Tower': "500",
                    'Cassette': "550",
                    'Suspended': "600",
                    'Concealed': "650",
                    'U-shaped Window': "700"
                },
                'Non-Inverter': {
                    'Window': "350",
                    'Split': "400",
                    'Tower': "450",
                    'Cassette': "500",
                    'Suspended': "550",
                    'Concealed': "600",
                    'U-shaped Window': "650"
                }
            },
            'Samsung': {
                'Inverter': {
                    'Window': "420",
                    'Split': "470",
                    'Tower': "520",
                    'Cassette': "570",
                    'Suspended': "620",
                    'Concealed': "670",
                    'U-shaped Window': "720"
                },
                'Non-Inverter': {
                    'Window': "380",
                    'Split': "430",
                    'Tower': "480",
                    'Cassette': "530",
                    'Suspended': "580",
                    'Concealed': "630",
                    'U-shaped Window': "680"
                }
            },
            'Whirlpool': {
                'Inverter': {
                    'Window': "450",
                    'Split': "500",
                    'Tower': "550",
                    'Cassette': "600",
                    'Suspended': "650",
                    'Concealed': "700",
                    'U-shaped Window': "750"
                },
                'Non-Inverter': {
                    'Window': "400",
                    'Split': "450",
                    'Tower': "500",
                    'Cassette': "550",
                    'Suspended': "600",
                    'Concealed': "650",
                    'U-shaped Window': "700"
                }
            },
            'Panasonic': {
                'Inverter': {
                    'Window': "470",
                    'Split': "520",
                    'Tower': "570",
                    'Cassette': "620",
                    'Suspended': "670",
                    'Concealed': "720",
                    'U-shaped Window': "770"
                },
                'Non-Inverter': {
                    'Window': "420",
                    'Split': "470",
                    'Tower': "520",
                    'Cassette': "570",
                    'Suspended': "620",
                    'Concealed': "670",
                    'U-shaped Window': "720"
                }
            },
            'Sharp': {
                'Inverter': {
                    'Window': "500",
                    'Split': "550",
                    'Tower': "600",
                    'Cassette': "650",
                    'Suspended': "700",
                    'Concealed': "750",
                    'U-shaped Window': "800"
                },
                'Non-Inverter': {
                    'Window': "450",
                    'Split': "500",
                    'Tower': "550",
                    'Cassette': "600",
                    'Suspended': "650",
                    'Concealed': "700",
                    'U-shaped Window': "750"
                }
            },
            'Toshiba': {
                'Inverter': {
                    'Window': "520",
                    'Split': "570",
                    'Tower': "620",
                    'Cassette': "670",
                    'Suspended': "720",
                    'Concealed': "770",
                    'U-shaped Window': "820"
                },
                'Non-Inverter': {
                    'Window': "470",
                    'Split': "520",
                    'Tower': "570",
                    'Cassette': "620",
                    'Suspended': "670",
                    'Concealed': "720",
                    'U-shaped Window': "770"
                }
            },
            'Fujidenzo': {
                'Inverter': {
                    'Window': "550",
                    'Split': "600",
                    'Tower': "650",
                    'Cassette': "700",
                    'Suspended': "750",
                    'Concealed': "800",
                    'U-shaped Window': "850"
                },
                'Non-Inverter': {
                    'Window': "500",
                    'Split': "550",
                    'Tower': "600",
                    'Cassette': "650",
                    'Suspended': "700",
                    'Concealed': "750",
                    'U-shaped Window': "800"
                }
            },
            'Haier': {
                'Inverter': {
                    'Window': "570",
                    'Split': "620",
                    'Tower': "670",
                    'Cassette': "720",
                    'Suspended': "770",
                    'Concealed': "820",
                    'U-shaped Window': "870"
                },
                'Non-Inverter': {
                    'Window': "520",
                    'Split': "570",
                    'Tower': "620",
                    'Cassette': "670",
                    'Suspended': "720",
                    'Concealed': "770",
                    'U-shaped Window': "820"
                }
            },
            'Kelvinator': {
                'Inverter': {
                    'Window': "600",
                    'Split': "650",
                    'Tower': "700",
                    'Cassette': "750",
                    'Suspended': "800",
                    'Concealed': "850",
                    'U-shaped Window': "900"
                },
                'Non-Inverter': {
                    'Window': "550",
                    'Split': "600",
                    'Tower': "650",
                    'Cassette': "700",
                    'Suspended': "750",
                    'Concealed': "800",
                    'U-shaped Window': "850"
                }
            },
            // Add other brands, device types, and their respective prices here
        };

        showDetailsBtn.addEventListener('click', function () {
            // Get the selected brand, device type, and technology
            const selectedBrand = document.querySelector('select[name="selbrand"]').value;
            const selectedDeviceType = document.querySelector('select[name="seltype"]').value;
            const selectedTechnology = document.querySelector('select[name="seltech"]').value;

            // Check if any of the dropdowns is empty
            if (selectedBrand === '' || selectedDeviceType === '' || selectedTechnology === '') {
                // Display a message asking the user to select all options
                document.getElementById("error").textContent = "Please select Brand, Device Type, and Technology.";
                // Clear the dynamic details container
                dynamicDetailsContainer.innerHTML = '';
            } else {
                // Get the price based on the selected brand, device type, and technology
                const selectedDevicePrice = devicePricing[selectedBrand][selectedTechnology][selectedDeviceType];

                // Set the "Check Up Fee" value in the hidden input field
                document.getElementById("checkup_fee").value = selectedDevicePrice;
                document.getElementById("types").value = selectedDeviceType;

                // Generate the dynamic content
                const dynamicContent = `
            <p>Device: ${selectedBrand}</p>
            <p>Device Type: ${selectedDeviceType}</p>
            <p>Technology: ${selectedTechnology}</p>
            <p name="price">Check Up Fee: <span name="price" style="color: red;">₱${selectedDevicePrice} Per Unit</span></p>
        `;

                // Update the container with the dynamic content
                dynamicDetailsContainer.innerHTML = dynamicContent;

                // Clear the error message
                document.getElementById("error").textContent = "";
            }
        });

    </script>

    <!-- footer-section-ends -->
    <script type="text/javascript">
        $(document).ready(function () {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
    <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    <?php include 'include/footer.php'; ?>
    <script>
        // var my_handlers = {
        //    fill_provinces: function () {
        //       var region_text = $(this).find("option:selected").text();
        //       $('#province').ph_locations('fetch_list', [{ "region_name": region_text }]);
        //    },

        //    fill_cities: function () {
        //       var province_text = $(this).find("option:selected").text();
        //       $('#city').ph_locations('fetch_list', [{ "province_name": province_text }]);
        //    },

        //    fill_barangays: function () {
        //       var city_text = $(this).find("option:selected").text();
        //       $('#barangay').ph_locations('fetch_list', [{ "city_name": city_text }]);
        //    }
        // };

        // $(document).ready(function () {
        //    $('#province').on('change', my_handlers.fill_cities);
        //    $('#city').on('change', my_handlers.fill_barangays);

        //    $('#province').ph_locations({ 'location_type': 'provinces', 'use_displayed_value': true });
        //    $('#city').ph_locations({ 'location_type': 'cities', 'use_displayed_value': true });
        //    $('#barangay').ph_locations({ 'location_type': 'barangays', 'use_displayed_value': true });

        //    $('#city').ph_locations('fetch_list', [{ "province_code": "0349" }]);
        // });

    </script>
</body>

</html>