<?php  
session_start();

# check if username & password submitted
if (isset($_POST['username']) && isset($_POST['password'])) {

   # database connection file
   include '../dbconn.php';
   
   # get data from POST request and store them in variables
   $password = $_POST['password'];
   $username = $_POST['username'];
   
   # simple form validation
   if (empty($username)) {
      # error message
      $em = "Username is required";

      # redirect to 'index.php' and pass the error message
      header("Location: ../../login.php?error=$em");
   } else if (empty($password)) {
      # error message
      $em = "Password is required";

      # redirect to 'index.php' and pass the error message
      header("Location: ../../login.php?error=$em");
   } else {
      $sql = "SELECT * FROM users WHERE staff NOT LIKE '%TRUE%' AND username = ?";

      $stmt = $conn->prepare($sql);
      $stmt->execute([$username]);

      # check if the username exists
      if ($stmt->rowCount() === 1) {
         # fetch user data
         $user = $stmt->fetch();

         # if both usernames are strictly equal
         if ($user['username'] === $username) {
            # verify the encrypted password
            if (password_verify($password, $user['password'])) {
               # successfully logged in
               # create the SESSION
               $_SESSION['username'] = $user['username'];
               $_SESSION['name'] = $user['name'];
               $_SESSION['user_id'] = $user['user_id'];

               # redirect to 'home.php'
               header("Location: ../../landpage.php");
            } else {
               # error message
               $em = "Incorrect Username or password";

               # redirect to 'index.php' and pass the error message
               header("Location: ../../login.php?error=$em");
            }
         } else {
            # error message
            $em = "Incorrect Username or password";

            # redirect to 'index.php' and pass the error message
            header("Location: ../../login.php?error=$em");
         }
      } else {
         # error message
         $em = "Username does not exist";

         # redirect to 'index.php' and pass the error message
         header("Location: ../../login.php?error=$em");
      }
   }
} else {
   header("Location: ../../login.php");
   exit;
}
