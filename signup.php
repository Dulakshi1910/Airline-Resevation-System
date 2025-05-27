<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/signup.css" type="text/css">
</head>
<body>

    <!-- Heading code lines -->
    <div id="heading">
        <img src="images\airline-logo.png" width="100px" height="100px" class="logo">

        <h1 class="mainHeadline">Your Dream trip, a few clicks away</h1>
        
        <a href="#">
            <img class="userLogo" width="50px" height="50px" src="images\user-circle.png">
            <?php
            session_start();
                if (isset($_SESSION["username"])) {
                    echo '<div id="login-logout"><a href="./php/logout.php">Logout</a></div>';
                } else {
                    echo '<div id="login-logout"><a href="login.php">Login</a>/<a href="signup.php">Sign Up</a></div>';
                }
                ?>
        </a>
    </div>





        <div class="form-wrapper">
            <div class="container">
                <h2>Registration Form</h2>
                <form action="./php/signup_process.php" method="post">
                  <label for="full_name">Full Name:</label>
                  <input type="text" id="full_name" name="full_name" required>
                  
                  <label for="email">Email Address:</label>
                  <input type="email" id="email" name="email" required>
                  
                  <label for="username">Username:</label>
                  <input type="text" id="username" name="username" required>
                  
                  <label for="password">Password:</label>
                  <input type="password" id="password" name="password" required>
                  
                  <label for="confirm_password">Confirm Password:</label>
                  <input type="password" id="confirm_password" name="confirm_password" required>
                  
                  <!-- <button type="submit" class="submit-button" onclick="return alert("")">Submit</button> -->
                  <button type="submit" class="submit-button" onclick="alert('Sign Up succesfull')">Submit</button>
                </form>
                
                <p>If you are already registered, please <a href="login.php">login here</a>.</p>
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