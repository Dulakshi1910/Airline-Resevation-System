<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
$conn = new mysqli("localhost", "root", "root", "iwt");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user details from the database
$sql_user = "SELECT full_name, username, email FROM users WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $_SESSION["username"]);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();

// Retrieve user's booked tickets from the database
$sql_tickets = "SELECT * FROM tickets_info WHERE username = ?";
$stmt_tickets = $conn->prepare($sql_tickets);
$stmt_tickets->bind_param("s", $_SESSION["username"]);
$stmt_tickets->execute();
$result_tickets = $stmt_tickets->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/userProfile.css" type="text/css">

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





    <!-- user details -->
    <h2 class="userHeading">User Details</h2>
    <div class="form-wrapper">
        <div class="user-details-box">
        <form method="post" action="./php/update_process.php">
    <h1>Hello, <?php echo $user['full_name']; ?></h1>
<label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>"><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" readonly><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>"><br>
        <div id="btn-wrap"><input type="submit" value="UPDATE">
       <button type="button" onclick="deleteAccount()" id="delete-btn">DELETE PROFILE</button></div>
        
    </form>
        </div>

        <!-- Password Box -->
        <div class="user-password-box">
        <form action="./php/update_password.php" method="post">
                <label for="old_password">Old Password:</label>
                <input type="password" id="old_password" name="old_password" required>
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <label for="confNew_password">Re-Enter Password:</label>
                <input type="password" id="confNew_password" name="confNew_password" required>
                <input type="submit" value="Change Password" onclick="return alert('password sucessfully changed')">
            </form>
        </div>
    </div>

    <!-- horizontal line -->
    <hr style="height:2px;border-width:0;color:gray;background-color:gray">
    

    <!-- user booked tickets -->
    <h2 style="text-align: center;">User Booked Tickets</h2>

    <table>
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Flight ID</th>
                <th>Outer Trip</th>
                <th>Round Trip</th>
                <th>Destination</th>
                <th>Source</th>
                <th>Airline</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Passenger count</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Output each booked ticket's details
            while ($row = $result_tickets->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ticket_id"] . "</td>";
                echo "<td>" . $row["flight_id"] . "</td>";
                echo "<td>" . $row["arrivale"] . "</td>";
                echo "<td>" . $row["departure"] . "</td>";
                echo "<td>" . $row["Destination"] . "</td>";
                echo "<td>" . $row["source"] . "</td>";
                echo "<td>" . $row["airline"] . "</td>";
                echo "<td>$" . $row["Price"] . "</td>";
                echo "<td>" . $row["duration"] . "</td>";
                echo "<td>" . $row["passenger_count"] . "</td>";
                echo "<td><button onclick=\"deleteTicket('" . $row["ticket_id"] . "')\">Delete</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </table>







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

    <script>
    function deleteAccount() {
        if (confirm("Are you sure you want to delete your profile?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Success
                        alert("Profile deleted successfully!");
                        // Redirect or perform any other action after deletion
                        window.location.href = "signup.php";
                    } else {
                        // Error
                        alert("Failed to delete profile. Please try again later.");
                    }
                }
            };
            xhr.open("POST", "./php/delete_user.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("username=<?php echo $user['username']; ?>");
        }
    }

    function deleteTicket(ticketId) {
        if (confirm("Are you sure you want to delete this ticket?")) {
            // Perform ticket deletion via AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Success
                        alert("Ticket deleted successfully!");
                        // Reload the page to reflect changes
                        window.location.reload();
                    } else {
                        // Error
                        var errorMessage = xhr.responseText; // Get the error message from the server
                        alert("Failed to delete ticket: " + errorMessage);
                        console.log(errorMessage)
                    }
                }
            };
            xhr.open("POST", "./php/user/delete_ticket.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("ticket_id=" + ticketId);
        }
    }

</script>

</body>
</html>