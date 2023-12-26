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
                        <option value="Plumber">Plumber</option>
                     </select>
                  </div>
                  <div class="wow fadeInRight" data-wow-delay="0.4s">
                     <span>Repair type<label>*</label></span>
                     <select name="seltype">
                        <option value="Repair of Leakage">Repair of Leakage</option>
                        <option value="Toilet Repairs">Toilet Repairs</option>
                        <option value="Water Heater Service">Water Heater Service</option>
                        <option value="Garbage Disposal Repair and Replacement">Garbage Disposal Repair and Replacement</option>
                        <option value="Angle Stop Repair">Angle Stop Repair</option>
                        <option value="Gas Piping">Gas Piping</option>
                        <option value="Sewer Main Installation and Repair">Sewer Main Installation and Repair</option>
                        <option value="Drain Cleaning">Drain Cleaning</option> 
                    </select>
                  </div>

                  <div class="wow fadeInLeft" data-wow-delay="0.4s">
                     <span>Additional Information<label>*</label></span>
                     <input type="text" name="Information" pattern="^[a-zA-Z'. -]+$">
                  </div>

                  <!-- Add button that will show the price and details -->
                  <button type="button" class="btn btn-default" id="showDetailsBtn">Show Pricing</button>
                  <!-- It should be show here -->
                  <div id="dynamicDetails"></div>
                  <input type="hidden" name="checkup" id ="checkup_fee" value="">
                  <input type="hidden" name="types" id ="types" value="">
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
      "Repair of Leakage": "395",
      "Toilet Repairs": "450",
      "Water Heater Service": "500",
      "Garbage Disposal Repair and Replacement": "400",
      "Single Door Commercial": "550"
      // Add more types and prices as needed
   };

   // Add an event listener to the "Show details" button
   showDetailsBtn.addEventListener('click', function () {
   // Get the selected service and device type
   const selectedService = serviceSelect.value;
   const selectedDeviceType = deviceTypeSelect.value;

   // Get the price based on the selected device type
   const selectedDevicePrice = devicePricing[selectedDeviceType];

   // Set the "Check Up Fee" value in the hidden input field
   document.getElementById("checkup_fee").value = selectedDevicePrice;
   document.getElementById("types").value = selectedDeviceType;
   // Generate the dynamic content
   const dynamicContent = `
      <p>Device: ${selectedService}</p>
      <p>Device Type: ${selectedDeviceType}</p>
      <p name="price">Check Up Fee: <span name="price" style="color: red;">₱${selectedDevicePrice} Per Unit</span></p>
   `;

   // Update the container with the dynamic content
   dynamicDetailsContainer.innerHTML = dynamicContent;

   // Clear the error message
   document.getElementById("error").textContent = "";
});

// Add a form submit event listener
document.querySelector("form").addEventListener("submit", function (e) {
   // Check if the checkup fee field is empty
   if (document.getElementById("checkup_fee").value === "") {
      e.preventDefault(); // Prevent the form from submitting
      // Display an error message
      document.getElementById("error").textContent = "Please click 'Show Pricing' before submitting.";
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