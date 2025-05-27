<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION["role"] !== "ADMIN") {
    // Redirect to another page
    header("Location: ../login.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/admin/admin-addStaff.css" type="text/css">

    <script src="myScript.js"></script>

</head>
<body>

    <!-- Heading code lines -->
    <div id="heading">
        <img src="../images/airline-logo.png" width="100px" height="100px" class="logo">

        <h1 class="mainHeadline">Your Dream trip, a few clicks away</h1>
        
        <a href="../php/logout.php">
            <img class="userLogo" width="50px" height="50px" src="../images/user-circle.png">
            <span>Logout</span>
        </a> 
    </div>



    <!-- Navbar -->
    <div class="navbar">
        <h2>Admin Panel</h2>
        <a href="admin.php">Dashboard</a>
        <!-- <a href="admin-addFlight.php">Add Flight</a> -->
        <a href="admin-addStaff.php">Add Staff</a>
        <a href="admin-listFlight.php">Manage Airline</a>
        <a href="admin-airlineList.php">List Airlines</a>
    </div>






    <h2>Add Staff</h2>
    <div class="form-wrapper">
        <form action="../php/admin/add_staff.php" method="post">
            <label for="staff_name">Staff Name:</label><br>
            <input type="text" id="staff_name" name="staff_name" required><br><br>

            <label for="user_name">User Name:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="staff_password">Staff Password:</label><br>
            <input type="password" id="staff_password" name="staff_password" required><br><br>

            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="STAFF">Staff</option>
                <option value="HELPDESK">Help Desk</option>
            </select><br><br>

            <input type="submit" value="Submit">
        </form>
    </div>












    <div class="footer">
        <img src="../images/airline-logo.png" alt="Airline Logo" width="100px" height="100px" class="logo">
    
        <div class="content-wrapper">
            <h1 class="bottomHeadline">Follow Us On</h1>

            <div class="socialMedia-icon-container">
                <img src="../images/icon-facebook.png" alt="Facebook" width="30px" height="30px">
                <img src="../images/icon-twitter.png" alt="Twitter" width="30px" height="30px">
                <img src="../images/icon-instagram.png" alt="Instagram" width="30px" height="30px">
                <img src="../images/icon-linkedin.png" alt="LinkedIn" width="30px" height="30px">
            </div>
        </div>

        <div class="email-container">
            <p>Subscribe for our latest offers...</p>
            <input type="search" name="a" placeholder="Email address">
            <img src="../images/icon-email.png" alt="email" width="30px" height="30px">
            <p>Teams of use.Privacy Policy.Cookies</p>
        </div>

    </div>



</body>
</html>

