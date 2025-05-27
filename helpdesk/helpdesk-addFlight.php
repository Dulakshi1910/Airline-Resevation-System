<?php
session_start();

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "HELPDESK") {
    // Redirect to the login page
    header("Location: ../login.php");
    exit;
}

// Connect to the database
$conn = new mysqli("localhost", "root", "root", "iwt");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cities from the cities table
$sql_cities = "SELECT city FROM cities";
$result_cities = $conn->query($sql_cities);

// Array to store cities
$cities = [];

// Check if there are any rows returned from the query
if ($result_cities->num_rows > 0) {
    // Fetch city data and store in the $cities array
    while ($row = $result_cities->fetch_assoc()) {
        $cities[] = $row["city"];
    }
}

// Fetch airlines from the airlines table
$sql_airlines = "SELECT name FROM airlines";
$result_airlines = $conn->query($sql_airlines);

// Array to store airline names
$airlines = [];

// Check if there are any rows returned from the query
if ($result_airlines->num_rows > 0) {
    // Fetch airline data and store in the $airlines array
    while ($row = $result_airlines->fetch_assoc()) {
        $airlines[] = $row["name"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/admin/admin-addFlight.css" type="text/css">

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

    <div class="navbar">
        <h2>Helpdesk Panel</h2>
        <a href="helpdesk.php">Dashboard</a>
        <a href="helpdesk-addFlight.php">Add Flight</a>
        <a href="helpdesk-listFlight.php">Manage Airline</a>
    </div>

    <div class="form-container">
        <form method="post" action="../php/helpdesk/add_available_flight.php">
    
 <h2 class="form-title">ADD FLIGHT DETAILS</h2>
    <label for="departure">DEPARTURE</label>
    <input type="datetime-local" id="departure" name="departure" placeholder="yyyy-mm-ddTHH:MM" onchange="calculateDuration()"> <br> <br>
    <label for="arrival">ARRIVAL</label>
    <input type="datetime-local" id="arrival" name="arrival" placeholder="yyyy-mm-ddTHH:MM" onchange="calculateDuration()"> <br> <br>
    <label for="from">From</label>
    <select id="from" name="from">
        <?php
        // Loop through cities array to generate options
        foreach ($cities as $city) {
            echo "<option value=\"$city\">$city</option>";
        }
        ?>
    </select>
    <label for="to">To</label>
    <select id="to" name="to">
        <?php
        // Loop through cities array to generate options
        foreach ($cities as $city) {
            echo "<option value=\"$city\">$city</option>";
        }
        ?>
    </select>
    <label for="duration">Duration</label>
    <input type="text" id="duration" name="duration" onchange="roundToHour()">
    <label for="price">Price</label>
    <input type="text" id="price" name="price">
    <label for="airline">Select Airline</label>
    <select id="airline" name="airline">
        <?php
        // Loop through airlines array to generate options
        foreach ($airlines as $airline) {
            echo "<option value=\"$airline\">$airline</option>";
        }
        ?>
    </select>
    <button type="submit" class="proceed-button">Proceed</button>
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
    <script>
        // Function to calculate duration
        function calculateDuration() {
            var departure = new Date(document.getElementById("departure").value);
            var arrival = new Date(document.getElementById("arrival").value);
            var duration = Math.abs(arrival - departure) / 36e5; // Calculate the difference in hours
            document.getElementById("duration").value = Math.round(duration); // Round to nearest hour
        }
    </script>

</body>
</html>
