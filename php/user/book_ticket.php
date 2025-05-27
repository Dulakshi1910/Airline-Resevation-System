<?php
// Start the session
session_start();

// Establish connection to the database
$conn = new mysqli("localhost", "root", "root", "iwt");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Parse the data sent by the AJAX request
$flight_id = $_POST['flight_id'];
$arrival = $_POST['arrival'];
$departure = $_POST['departure'];
$destination = $_POST['destination'];
$source = $_POST['source'];
$airline = $_POST['airline'];
$price = $_POST['price'];
$duration = $_POST['duration'];
$passenger_count = $_POST['passenger_count'];

// SQL query to insert data into the tickets_info table
$sql = "INSERT INTO tickets_info (flight_id, username, arrivale, departure, destination, source, airline, price, duration, passenger_count) 
        VALUES ('$flight_id', '$username', '$arrival', '$departure', '$destination', '$source', '$airline', '$price', '$duration', '$passenger_count')";

if ($conn->query($sql) === TRUE) {
    echo "Ticket information saved successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
