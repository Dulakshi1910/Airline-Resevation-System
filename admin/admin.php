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

// Connect to the database
$conn = new mysqli("localhost", "root", "root", "iwt");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if delete action is triggered
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Prepare a delete statement
    $sql_delete = "DELETE FROM tickets_info WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $delete_id);
    // Execute the delete statement
    if ($stmt->execute()) {
        // Redirect back to admin page after deletion
        header("Location: admin.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch total number of tickets
$sqlTotalTickets = "SELECT COUNT(*) AS total_tickets FROM tickets_info";
$resultTotalTickets = $conn->query($sqlTotalTickets);
$rowTotalTickets = $resultTotalTickets->fetch_assoc();
$totalTickets = $rowTotalTickets['total_tickets'];

// Fetch data from the tickets_info table
$sql = "SELECT t.ticket_id, u.full_name, t.arrivale, t.departure, t.Destination, t.airline 
FROM tickets_info t
INNER JOIN users u ON t.username = u.username";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/admin/admin.css" type="text/css">

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

    <!-- Admin container -->
    <div class="admin-container">
        <!-- Boxes -->
        <div class="box" style="background-color: rgb(39, 108, 181);">
          <h2>Total Tickets</h2>
          <p><?php echo $totalTickets; ?></p>
        </div>
        <div class="box" style="background-color: rgb(37, 228, 97);">
          <h2>Amount</h2>
          <p>$25,000</p>
        </div>
        <div class="box" style="background-color: rgb(255, 115, 64);">
          <h2>Flight</h2>
          <p>Flight XYZ123</p>
        </div>
        <div class="box" style="background-color: rgb(77, 157, 255);">
          <h2>Departure</h2>
          <p id="departure-time"></p>
        </div>
    </div>

    <!-- Tickets Booking Info -->
    <h2 style="text-align: center;">Tickets Booking Info</h2>
    <table style="border: 1px;">
    <thead>
        <tr>
        <th>Ticket Id</th>
        <th>Name</th> 
        <th>Arrival</th>
        <th>Departure</th>
        <th>Destination</th>
        <th>Airline</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
            // Check if there are any rows returned from the query
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ticket_id"] . "</td>";
                    echo "<td>" . $row["full_name"] . "</td>";
                    echo "<td>" . $row["arrivale"] . "</td>";
                    echo "<td>" . $row["departure"] . "</td>";
                    echo "<td>" . $row["Destination"] . "</td>";
                    echo "<td>" . $row["airline"] . "</td>";
                    // Add delete action
                    echo "<td><a href='admin.php?delete_id=" . $row["ticket_id"] . "' onclick='return confirmDelete();'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data available</td></tr>";
            }
            ?>
    </tbody>
    </table>
   
    <!-- Footer -->
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

    <!-- JavaScript for updating real-time departure -->
    <script>
        // Function to update departure time
        function updateDepartureTime() {
            var now = new Date();
            var departureTimeElement = document.getElementById("departure-time");
            departureTimeElement.textContent = now.toLocaleString();
        }

        // Update departure time initially
        updateDepartureTime();

        // Update departure time every second
        setInterval(updateDepartureTime, 1000);

        function confirmDelete() {
            return confirm("Are you sure you want to delete this ticket?");
        }
    </script>

</body>
</html>
