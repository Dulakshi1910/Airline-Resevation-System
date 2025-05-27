<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/index.css" type="text/css">

    <script src="myScript.js"></script>

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

    <!-- banner images -->
    <div id="image-slider">
        <img src="images\travel-banner1.jpg" alt="Banner 1" >
        <img src="images\travel-banner2.png" alt="Banner 2" >
        <img src="images\travel-banner3.jpg" alt="Banner 3" >
    </div>


    <div class="button-container">
        <button class="button">Popular Packages</button>
    </div>

    <div class="button-container">
        <button class="button">Economy Class</button>
        <button class="button">Business Class</button>
    </div>
    

    <div class="card-container">
        <div class="card">
            <img src="images\home-package-photo.png" alt="Travel Package">
            <p>Honeymoon Package</p>
            <a href="./user/ticketBooking.php"><button>Book Now</button></a>
           
        </div>

        <div class="card">
            <img src="images\home-package-photo.png" alt="Travel Package">
            <p>Family Vacation Package</p>
            <a href="./user/ticketBooking.php"><button>Book Now</button></a>

        </div>
        <div class="card">
            <img src="images\home-package-photo.png" alt="Travel Package">
            <p>Adventure Package</p>
            <a href="./user/ticketBooking.php"><button>Book Now</button></a>

        </div>
        
        <div class="card">
            <img src="images\home-package-photo.png" alt="Travel Package">
            <p>Luxury Retreat Package</p>
            <a href="./user/ticketBooking.php"><button>Book Now</button></a>

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

    </div>



</body>
</html>