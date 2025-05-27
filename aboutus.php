<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    
    <link rel="stylesheet" href="css/aboutus.css" type="text/css">
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
	
	
    <!-- welcome and icons set code lines -->
    <div class="nav">
        <h2 style="margin-left: 10px;">Welcome</h2>
        <div class="icon-container">
            <a href="./">
                <img src="images/icons-home.png" alt="Home" width="30px" height="30px">
                <span>Home</span>
            </a>
            <a href="./userProfile.php">
                <img src="images/icons-user.png" alt="User" width="30px" height="30px">
                <span>User</span>
            </a>
            <a href="./contactus.php">
                <img src="images/icons-phone.png" alt="Contact Us" width="30px" height="30px">
                <span>Contact</span>
            </a>
            <a href="./aboutus.php">
                <img src="images/icons-warning.png" alt="About Us" width="30px" height="30px">
                <span>About</span>
            </a>
            </div>
    </div>
        
	


    <!-- Main content -->
    <div class="main-content">
        <div class="left-panel">
            <h1>We,Singha Travels...</h1>
            <p>We are a premier travel agency dedicated to providing the best travel experiences.</p>
			<br>
            
                <h2>Our Mission</h2>
                <p>The mission of our airline ticket reservation system is to provide seamless and efficient booking experiences for travelers worldwide. 
				Through our user-friendly platform, we aim to simplify the process of planning and booking flights, ensuring convenience and accessibility for all customers. 
				With a commitment to innovation and customer satisfaction, 
				we strive to deliver reliable and personalized travel solutions that exceed expectations, empowering travelers to explore the world with ease..</p>
        </div>
        <div class="right-panel">
            <div class="banner">
			<img src="images\aboutUsBanner.png" alt="Banner Ad">
			</div>
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