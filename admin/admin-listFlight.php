<?php
session_start();

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "ADMIN") {
    // Redirect to the login page or any other page for unauthorized access
    header("Location: ../login.php");
    exit;
}

// Connect to the database
$conn = new mysqli("localhost", "root", "root", "iwt");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from available_flights table
$sql = "SELECT * FROM available_flights";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight List</title>
    <link rel="stylesheet" href="../css/admin/admin-listFlight.css" type="text/css">
    <script src="myScript.js"></script>
</head>
<body>
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

    <h2 style="text-align: center;">Flight List</h2>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Arrival</th>
                <th>Departure</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Airline</th>
                <th>Seats</th>
                <th>Price</th>
                <th>Duration</th>
                <th >Action</th>


            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='row_" . $row["id"] . "'>";
                    // Output table cells for each column
                    // Output input field for price with unique id
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["arrival"] . "</td>";
                    echo "<td>" . $row["departure"] . "</td>";
                    echo "<td>" . $row["source"] . "</td>";
                    echo "<td>" . $row["destination"] . "</td>";
                    echo "<td>" . $row["airline"] . "</td>";
                    echo "<td>" . $row["seats"] . "</td>";
                    echo "<td><input type='number' id='price_" . $row["id"] . "' name='price' value='" . $row["price"] . "'></td>";
                    echo "<td>" . $row["duration"] . "</td>";
                    // Add onclick event to Update button
                    echo "<td><button onclick='if(confirmUpdate()) updatePrice(" . $row["id"] . ");'>Update</button><br><br><button onclick='deleteFlight(" . $row["id"] . ");'>Delete</button></td>";
                    // echo "<td style='display: flex; gap: 10px; width: 500px;'>...</td>";

                    // echo "<td><button onclick='if(confirmUpdate()) updatePrice(" . $row["id"] . ");'>Update</button><button onclick='deleteFlight(" . $row["id"] . ");'>Delete</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No flights available</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
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
        function updatePrice(rowId) {
            // Get the new price from the input field
            var newPrice = document.getElementById('price_' + rowId).value;
            
            // Send an AJAX request to update the price
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the price in the table if the update was successful
                    if (this.responseText.trim() === 'success') {
                        document.getElementById('price_' + rowId).setAttribute('value', newPrice);
                    } else {
                        alert('Failed to update price.');
                    }
                }
            };
            xhttp.open("POST", "../php/admin/update_price.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id=" + rowId + "&price=" + newPrice);
        }
        function confirmUpdate() {
            return confirm("Are you sure you want to update?");
        }

        function deleteFlight(flightId) {
        if (confirm("Are you sure you want to delete this flight?")) {
            // Send an AJAX request to delete the flight
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Check if deletion was successful
                    if (this.responseText.trim() === 'success') {
                        // Remove the row from the table
                        document.getElementById('row_' + flightId).remove();
                        alert('Flight deleted successfully.');
                    } else {
                        alert('Failed to delete flight.');
                    }
                }
            };
            xhttp.open("POST", "../php/admin/delete_flight.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id=" + flightId);
        }
    }

    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }

    </script>
</body>
</html>
