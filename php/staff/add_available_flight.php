<?php
session_start();

// Check if the user is not logged in or is not an admin
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "STAFF") {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $departure = $_POST["departure"];
    $arrival = $_POST["arrival"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $duration = $_POST["duration"];
    $price = $_POST["price"];
    $airline = $_POST["airline"];
    
    // Fetch the number of seats from the airlines table
    $sql_seats = "SELECT seats FROM airlines WHERE name = '$airline'";
    $result_seats = $conn->query($sql_seats);
    
    if ($result_seats->num_rows > 0) {
        $row = $result_seats->fetch_assoc();
        $seats = $row["seats"];
        
        // Prepare and execute SQL statement to insert data into available_flights table
        $sql_insert = "INSERT INTO available_flights (departure, arrival, source, destination, duration, price, airline, seats) 
                       VALUES ('$departure', '$arrival', '$from', '$to', '$duration', '$price', '$airline', '$seats')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Flight details added successfully.";
            header("Location: ../../staff/staff.php");
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    } else {
        echo "Error: No seats information found for the selected airline.";
    }
}
?>
