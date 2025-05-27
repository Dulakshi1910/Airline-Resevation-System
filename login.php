<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["username"])) {
    // Redirect to the index page
    header("Location: index.php");
    exit;
}

if (isset($_GET['error']) && $_GET['error'] == 1) {
  echo '<script>alert("Error: Invalid username or password!");</script>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/login.css" type="text/css">
</head>
<body>

    <!-- Heading code lines -->
    <div id="heading">
        <img src="images\airline-logo.png" width="100px" height="100px" class="logo">

        <h1 class="mainHeadline">Your Dream trip, a few clicks away</h1>
        
        <a href="#">
            <img class="userLogo" width="50px" height="50px" src="images\user-circle.png">
        </a>
    </div>




    <div class="form-wrapper">
    <div class="container">
        <h2>User Login</h2>
        <form action="./php/login_process.php" method="post">
          <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
          </div>
          <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
          </div>
          <div>
            <button type="submit">Login</button>
          </div>
        </form>
        <p>Not a member? <a href="./signup.php">Sign Up</a></p>
      </div>
    </div>







    <div class="footer">
        <img src="images/airline-logo.png" alt="Airline Logo" width="100px" height="100px" class="logo">
    
        <div class="content-wrapper">
            <h1 class="bottomHeadline">Follow Us On</h1>

            <div class="socialMedia-icon-container">
                <img src="images/icon-facebook.png" alt="Facebook" width="30px" height="30px">
                <img src="images/icon-twitter.png" alt="Twitter" width="30px" height="30px">
                <img src="images/icon-instagram.png" alt="Instagram" width="30px" height="30px">
                <img src="images/icon-linkedin.png" alt="LinkedIn" width="30px" height="30px">
            </div>
        </div>

        <div class="email-container">
            <p>Subscribe for our latest offers...</p>
            <input type="search" name="a" placeholder="Email address">
            <img src="images\icon-email.png" alt="email" width="30px" height="30px">
            <p>Teams of use.Privacy Policy.Cookies</p>
        </div>





</body>
</html>